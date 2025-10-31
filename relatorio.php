<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Vendas - Quermesse da Igreja</title>
    <style>
        /* Estilos do relatório (mantenha os mesmos do código anterior) */
        :root {
            --primary: #8B4513;
            --primary-dark: #654321;
            --secondary: #2F4F4F;
            --light: #f8f9fa;
            --dark: #343a40;
            --success: #28a745;
            --warning: #ffc107;
            --info: #17a2b8;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f5f5f5, #e8f4f8);
            color: var(--dark);
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        header {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 20px 0;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border-bottom: 4px solid #D2691E;
        }
        
        .logo {
            font-size: 2.2rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
        }
        
        .subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            text-align: center;
        }
        
        .nav-tabs {
            display: flex;
            gap: 10px;
            margin: 20px 0;
            flex-wrap: wrap;
            justify-content: center;
        }
        
        .nav-btn {
            padding: 10px 20px;
            background: white;
            border: 2px solid var(--primary);
            border-radius: 25px;
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .nav-btn:hover, .nav-btn.active {
            background: var(--primary);
            color: white;
        }
        
        .filtros {
            background: white;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            border: 1px solid #e0e0e0;
        }
        
        .filtro-group {
            display: flex;
            gap: 15px;
            align-items: center;
            flex-wrap: wrap;
        }
        
        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-primary {
            background: var(--primary);
            color: white;
        }
        
        .btn-primary:hover {
            background: var(--primary-dark);
        }
        
        .card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            border: 1px solid #e0e0e0;
        }
        
        .card-title {
            font-size: 1.4rem;
            color: var(--secondary);
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 3px solid var(--primary);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }
        
        .stat-card {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 25px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 8px;
        }
        
        .stat-label {
            font-size: 1rem;
            opacity: 0.9;
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .table th, .table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .table th {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            font-weight: 600;
        }
        
        .table tr:hover {
            background-color: #f8f9fa;
        }
        
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .print-btn {
            background: var(--success);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            cursor: pointer;
            margin-left: 15px;
            font-weight: 600;
        }
        
        input[type="date"] {
            padding: 10px 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
        }
        
        @media print {
            .nav-tabs, .filtros, .print-btn {
                display: none;
            }
            
            .card {
                box-shadow: none;
                border: 1px solid #ddd;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">⛪ Quermesse da Igreja</div>
            <div class="subtitle">Relatório de Vendas - Sistema de Gestão</div>
        </div>
    </header>

    <div class="container">
        <div class="nav-tabs">
            <a href="index.php" class="nav-btn">🛒 Fazer Pedidos</a>
            <a href="relatorio.php" class="nav-btn active">📊 Relatório de Vendas</a>
        </div>

        <div class="filtros">
            <div class="filtro-group">
                <label for="dataRelatorio" style="font-weight: 600;">Data do Relatório:</label>
                <input type="date" id="dataRelatorio" value="<?php echo date('Y-m-d'); ?>">
                <button class="btn btn-primary" onclick="carregarRelatorio()">📈 Carregar Relatório</button>
                <button class="print-btn" onclick="window.print()">🖨️ Imprimir Relatório</button>
            </div>
        </div>

        <div id="loadingRelatorio" style="text-align: center; display: none; padding: 40px;">
            <div class="loading"></div>
            <p style="margin-top: 15px; color: #666;">Carregando relatório...</p>
        </div>

        <div id="relatorioConteudo">
            <!-- Conteúdo do relatório será carregado aqui -->
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            carregarRelatorio();
        });

        function carregarRelatorio() {
            const data = document.getElementById('dataRelatorio').value;
            const loading = document.getElementById('loadingRelatorio');
            const conteudo = document.getElementById('relatorioConteudo');
            
            loading.style.display = 'block';
            conteudo.innerHTML = '';
            
            fetch(`api.php?action=getRelatorioVendas&data=${data}`)
                .then(response => response.json())
                .then(data => {
                    loading.style.display = 'none';
                    if (data.success) {
                        renderizarRelatorio(data);
                    } else {
                        conteudo.innerHTML = '<div class="card"><p style="text-align: center; padding: 30px; color: var(--danger);">Erro ao carregar relatório.</p></div>';
                    }
                })
                .catch(error => {
                    loading.style.display = 'none';
                    conteudo.innerHTML = '<div class="card"><p style="text-align: center; padding: 30px; color: var(--danger);">Erro ao carregar relatório.</p></div>';
                    console.error('Erro:', error);
                });
        }

        function renderizarRelatorio(data) {
            const total = data.total_vendas;
            const produtos = data.produtos_vendidos;
            
            let html = `
                <div class="card">
                    <h2 class="card-title">📈 Resumo do Dia - ${data.data}</h2>
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-number">${total.total_pedidos || 0}</div>
                            <div class="stat-label">Total de Pedidos</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">R$ ${(total.total_vendas || 0).toFixed(2)}</div>
                            <div class="stat-label">Total em Vendas</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">R$ ${(total.total_pix || 0).toFixed(2)}</div>
                            <div class="stat-label">Vendas PIX</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">R$ ${(total.total_cash || 0).toFixed(2)}</div>
                            <div class="stat-label">Vendas Dinheiro</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">R$ ${(total.total_card || 0).toFixed(2)}</div>
                            <div class="stat-label">Vendas Cartão</div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <h2 class="card-title">🏆 Produtos Mais Vendidos</h2>
            `;
            
            if (produtos.length > 0) {
                html += `
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Quantidade Vendida</th>
                                <th>Total Arrecadado</th>
                            </tr>
                        </thead>
                        <tbody>
                `;
                
                produtos.forEach(produto => {
                    html += `
                        <tr>
                            <td>${produto.emoji} ${produto.nome}</td>
                            <td><strong>${produto.total_vendido}</strong> unidades</td>
                            <td style="color: var(--success); font-weight: 600;">R$ ${parseFloat(produto.total_receita).toFixed(2)}</td>
                        </tr>
                    `;
                });
                
                html += `</tbody></table>`;
            } else {
                html += `<p style="text-align: center; padding: 30px; color: #666;">Nenhuma venda registrada para esta data.</p>`;
            }
            
            html += `</div>`;
            
            document.getElementById('relatorioConteudo').innerHTML = html;
        }
    </script>
</body>
</html>