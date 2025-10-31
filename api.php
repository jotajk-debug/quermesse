<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");

include_once 'config.php';

$method = $_SERVER['REQUEST_METHOD'];
$db = new Database();
$conn = $db->getConnection();

if (!$conn) {
    echo json_encode(["success" => false, "message" => "Erro de conexão com o banco"]);
    exit;
}

switch($method) {
    case 'GET':
        if(isset($_GET['action'])) {
            switch($_GET['action']) {
                case 'getProdutos':
                    $categoria = isset($_GET['categoria']) ? $_GET['categoria'] : 'all';
                    $query = "SELECT p.*, c.nome as categoria_nome 
                             FROM produtos p 
                             LEFT JOIN categorias c ON p.categoria_id = c.id 
                             WHERE p.ativo = 1";
                    
                    if($categoria != 'all') {
                        $query .= " AND c.nome = :categoria";
                        $stmt = $conn->prepare($query);
                        $stmt->bindParam(':categoria', $categoria);
                    } else {
                        $stmt = $conn->prepare($query);
                    }
                    
                    $stmt->execute();
                    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    echo json_encode($produtos);
                    break;

                case 'getCategorias':
                    $query = "SELECT * FROM categorias";
                    $stmt = $conn->prepare($query);
                    $stmt->execute();
                    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    echo json_encode($categorias);
                    break;

                case 'getRelatorioVendas':
                    $data = isset($_GET['data']) ? $_GET['data'] : date('Y-m-d');
                    
                    $query_total = "SELECT 
                        COUNT(*) as total_pedidos,
                        SUM(total) as total_vendas,
                        SUM(CASE WHEN forma_pagamento = 'pix' THEN total ELSE 0 END) as total_pix,
                        SUM(CASE WHEN forma_pagamento = 'cash' THEN total ELSE 0 END) as total_cash,
                        SUM(CASE WHEN forma_pagamento = 'card' THEN total ELSE 0 END) as total_card
                    FROM pedidos 
                    WHERE DATE(created_at) = :data";
                    
                    $stmt_total = $conn->prepare($query_total);
                    $stmt_total->bindParam(':data', $data);
                    $stmt_total->execute();
                    $total_vendas = $stmt_total->fetch(PDO::FETCH_ASSOC);
                    
                    $query_produtos = "SELECT 
                        p.nome,
                        p.emoji,
                        SUM(pi.quantidade) as total_vendido,
                        SUM(pi.quantidade * pi.preco_unitario) as total_receita
                    FROM pedido_itens pi
                    JOIN produtos p ON pi.produto_id = p.id
                    JOIN pedidos pd ON pi.pedido_id = pd.id
                    WHERE DATE(pd.created_at) = :data
                    GROUP BY p.id, p.nome, p.emoji
                    ORDER BY total_vendido DESC
                    LIMIT 10";
                    
                    $stmt_produtos = $conn->prepare($query_produtos);
                    $stmt_produtos->bindParam(':data', $data);
                    $stmt_produtos->execute();
                    $produtos_vendidos = $stmt_produtos->fetchAll(PDO::FETCH_ASSOC);
                    
                    echo json_encode([
                        'success' => true,
                        'data' => $data,
                        'total_vendas' => $total_vendas,
                        'produtos_vendidos' => $produtos_vendidos
                    ]);
                    break;
            }
        }
        break;

    case 'POST':
        $input = json_decode(file_get_contents("php://input"), true);
        
        if(isset($input['action']) && $input['action'] == 'criarPedido') {
            try {
                $conn->beginTransaction();
                
                $total = $input['total'];
                if($input['forma_pagamento'] == 'pix') {
                    $total = $total * 0.95;
                }
                
                $query = "INSERT INTO pedidos (total, forma_pagamento) VALUES (:total, :forma_pagamento)";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':total', $total);
                $stmt->bindParam(':forma_pagamento', $input['forma_pagamento']);
                $stmt->execute();
                
                $pedido_id = $conn->lastInsertId();
                
                $query_item = "INSERT INTO pedido_itens (pedido_id, produto_id, quantidade, preco_unitario) 
                              VALUES (:pedido_id, :produto_id, :quantidade, :preco_unitario)";
                $stmt_item = $conn->prepare($query_item);
                
                foreach($input['itens'] as $item) {
                    $stmt_item->bindParam(':pedido_id', $pedido_id);
                    $stmt_item->bindParam(':produto_id', $item['id']);
                    $stmt_item->bindParam(':quantidade', $item['quantity']);
                    $stmt_item->bindParam(':preco_unitario', $item['price']);
                    $stmt_item->execute();
                }
                
                $conn->commit();
                
                echo json_encode([
                    "success" => true,
                    "pedido_id" => $pedido_id,
                    "message" => "Pedido criado com sucesso!"
                ]);
                
            } catch(Exception $e) {
                $conn->rollBack();
                echo json_encode([
                    "success" => false,
                    "message" => "Erro ao criar pedido: " . $e->getMessage()
                ]);
            }
        }
        break;
}
?>