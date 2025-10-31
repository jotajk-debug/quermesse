<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quermesse da Igreja - Sistema de Pedidos</title>
    <style>
        :root {
            --primary: #8B4513;
            --primary-dark: #654321;
            --secondary: #2F4F4F;
            --light: #f8f9fa;
            --dark: #343a40;
            --success: #28a745;
            --danger: #dc3545;
            --warning: #ffc107;
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
            min-height: 100vh;
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
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .logo {
            font-size: 2.2rem;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .nav-tabs {
            display: flex;
            gap: 10px;
        }
        
        .nav-btn {
            padding: 10px 20px;
            background: rgba(255,255,255,0.2);
            border: 2px solid white;
            border-radius: 25px;
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .nav-btn:hover, .nav-btn.active {
            background: white;
            color: var(--primary);
        }
        
        .cart-icon {
            position: relative;
            cursor: pointer;
            font-size: 1.5rem;
        }
        
        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: var(--danger);
            color: white;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: bold;
        }
        
        .main-content {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 25px;
            margin-top: 25px;
        }
        
        @media (max-width: 968px) {
            .main-content {
                grid-template-columns: 1fr;
            }
            
            .header-content {
                flex-direction: column;
                text-align: center;
            }
        }
        
        .products-section {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            border: 1px solid #e0e0e0;
        }
        
        .section-title {
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 3px solid var(--primary);
            color: var(--secondary);
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .categories {
            display: flex;
            gap: 12px;
            margin-bottom: 25px;
            overflow-x: auto;
            padding-bottom: 15px;
        }
        
        .category-btn {
            padding: 10px 20px;
            background: var(--light);
            border: 2px solid #ddd;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s;
            white-space: nowrap;
            font-weight: 500;
        }
        
        .category-btn.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }
        
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }
        
        .product-card {
            border: 2px solid #f0f0f0;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            background: white;
        }
        
        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            border-color: var(--primary);
        }
        
        .product-image {
            width: 100%;
            height: 120px;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            font-size: 3rem;
        }
        
        .product-name {
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--secondary);
        }
        
        .product-price {
            color: var(--primary);
            font-weight: bold;
            font-size: 1.2rem;
            margin-bottom: 15px;
        }
        
        .add-to-cart {
            background: var(--primary);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
            font-weight: 600;
            font-size: 1rem;
        }
        
        .add-to-cart:hover {
            background: var(--primary-dark);
        }
        
        .order-summary {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            border: 1px solid #e0e0e0;
            height: fit-content;
            position: sticky;
            top: 20px;
        }
        
        .order-items {
            margin-bottom: 20px;
            max-height: 350px;
            overflow-y: auto;
        }
        
        .order-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }
        
        .item-info {
            display: flex;
            flex-direction: column;
            flex: 1;
        }
        
        .item-name {
            font-weight: 500;
            color: var(--secondary);
        }
        
        .item-price {
            color: #666;
            font-size: 0.9rem;
        }
        
        .item-controls {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .quantity-btn {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            border: 2px solid #ddd;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s;
        }
        
        .quantity-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
        }
        
        .remove-item {
            color: var(--danger);
            cursor: pointer;
            font-size: 1.2rem;
            padding: 5px;
        }
        
        .order-total {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            font-size: 1.3rem;
            margin: 25px 0;
            padding-top: 20px;
            border-top: 3px solid #eee;
            color: var(--secondary);
        }
        
        .payment-methods {
            margin-bottom: 25px;
        }
        
        .payment-option {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
            padding: 15px;
            border: 2px solid #eee;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .payment-option:hover {
            border-color: var(--primary);
        }
        
        .payment-option.selected {
            border-color: var(--primary);
            background: rgba(139, 69, 19, 0.05);
        }
        
        .payment-icon {
            margin-right: 15px;
            font-size: 1.8rem;
        }
        
        .checkout-btn {
            background: var(--success);
            color: white;
            border: none;
            padding: 15px;
            border-radius: 10px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
            font-weight: 600;
        }
        
        .checkout-btn:hover:not(:disabled) {
            background: #218838;
        }
        
        .checkout-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
        }
        
        .receipt {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            display: none;
            max-width: 320px;
            margin: 25px auto;
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
            border: 2px dashed #8B4513;
        }
        
        .receipt-header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px dashed #000;
            padding-bottom: 15px;
        }
        
        .receipt-items {
            margin-bottom: 20px;
        }
        
        .receipt-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        
        .receipt-total {
            border-top: 2px dashed #000;
            padding-top: 15px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            font-size: 1.1rem;
        }
        
        .receipt-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.8rem;
            color: #666;
        }
        
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.7);
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }
        
        .modal-content {
            background: white;
            padding: 30px;
            border-radius: 15px;
            max-width: 500px;
            width: 90%;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
        
        .modal-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 25px;
            flex-wrap: wrap;
        }
        
        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-primary {
            background: var(--primary);
            color: white;
        }
        
        .btn-primary:hover {
            background: var(--primary-dark);
        }
        
        .btn-secondary {
            background: var(--secondary);
            color: white;
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
        
        .empty-cart-message {
            text-align: center;
            color: #666;
            font-style: italic;
            padding: 30px;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    ⛪ Quermesse da Igreja
                </div>
                <div class="nav-tabs">
                    <a href="index.php" class="nav-btn active">🛒 Fazer Pedido</a>
                    <a href="relatorio.php" class="nav-btn">📊 Relatório</a>
                </div>
                <div class="cart-icon" id="cartIcon">
                    🛒
                    <div class="cart-count" id="cartCount">0</div>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="main-content">
            <div class="products-section">
                <h2 class="section-title">📋 Cardápio da Quermesse</h2>
                
                <div class="categories" id="categoriesContainer">
                    <button class="category-btn active" data-category="all">📦 Todos</button>
                </div>
                
                <div class="products-grid" id="productsGrid">
                    <div style="text-align: center; padding: 40px; color: #666;">
                        <div class="loading"></div>
                        <p>Carregando produtos...</p>
                    </div>
                </div>
            </div>
            
            <div class="order-summary">
                <h2 class="section-title">🛍️ Seu Pedido</h2>
                
                <div class="order-items" id="orderItems">
                    <p class="empty-cart-message">Seu carrinho está vazio</p>
                </div>
                
                <div class="order-total">
                    <span>Total:</span>
                    <span id="orderTotal">R$ 0,00</span>
                </div>
                
                <div class="payment-methods">
                    <h3 style="margin-bottom: 15px; color: var(--secondary);">💳 Forma de Pagamento</h3>
                    
                    <div class="payment-option" data-method="pix">
                        <div class="payment-icon">📱</div>
                        <div>
                            <div style="font-weight: 600;">PIX</div>
                            <small style="color: var(--success);">5% de desconto</small>
                        </div>
                    </div>
                    
                    <div class="payment-option" data-method="cash">
                        <div class="payment-icon">💵</div>
                        <div>
                            <div style="font-weight: 600;">Dinheiro</div>
                            <small>Pagamento à vista</small>
                        </div>
                    </div>
                    
                    <div class="payment-option" data-method="card">
                        <div class="payment-icon">💳</div>
                        <div>
                            <div style="font-weight: 600;">Cartão</div>
                            <small>Crédito/Débito</small>
                        </div>
                    </div>
                </div>
                
                <button class="checkout-btn" id="checkoutBtn" disabled>
                    <span id="checkoutText">✅ Finalizar Pedido</span>
                    <div class="loading" id="checkoutLoading" style="display: none;"></div>
                </button>
            </div>
        </div>
        
        <div class="receipt" id="receipt">
            <div class="receipt-header">
                <h3>QUERMESSE DA IGREJA</h3>
                <p>Evento Beneficente</p>
                <p>================================</p>
            </div>
            
            <div class="receipt-items" id="receiptItems">
            </div>
            
            <div class="receipt-total">
                <span>TOTAL:</span>
                <span id="receiptTotal">R$ 0,00</span>
            </div>
            
            <div class="receipt-footer">
                <p>*** OBRIGADO PELA DOAÇÃO ***</p>
                <p>Que Deus abençoe!</p>
                <p>================================</p>
            </div>
        </div>
    </div>
    
    <div class="modal" id="successModal">
        <div class="modal-content">
            <h2 style="color: var(--success); margin-bottom: 15px;">🎉 Pedido Realizado com Sucesso!</h2>
            <p>Seu pedido foi enviado para a cozinha e em breve estará pronto.</p>
            <p style="margin: 15px 0; font-weight: 600;">Número do pedido: <span id="pedidoNumero" style="color: var(--primary);">#000</span></p>
            <div class="modal-buttons">
                <button class="btn btn-primary" id="newOrderBtn">🆕 Novo Pedido</button>
                <button class="btn btn-secondary" id="viewReceiptBtn">🧾 Ver Comprovante</button>
            </div>
        </div>
    </div>

    <script>
        let cart = [];
        let selectedPaymentMethod = null;
        let currentCategory = 'all';
        let produtos = [];
        let categorias = [];

        const productsGrid = document.getElementById('productsGrid');
        const orderItems = document.getElementById('orderItems');
        const orderTotal = document.getElementById('orderTotal');
        const cartCount = document.getElementById('cartCount');
        const checkoutBtn = document.getElementById('checkoutBtn');
        const checkoutText = document.getElementById('checkoutText');
        const checkoutLoading = document.getElementById('checkoutLoading');
        const categoriesContainer = document.getElementById('categoriesContainer');
        const receipt = document.getElementById('receipt');
        const receiptItems = document.getElementById('receiptItems');
        const receiptTotal = document.getElementById('receiptTotal');
        const successModal = document.getElementById('successModal');
        const newOrderBtn = document.getElementById('newOrderBtn');
        const viewReceiptBtn = document.getElementById('viewReceiptBtn');
        const pedidoNumero = document.getElementById('pedidoNumero');

        document.addEventListener('DOMContentLoaded', () => {
            carregarCategorias();
            carregarProdutos();
            setupEventListeners();
        });

        function carregarCategorias() {
            fetch('api.php?action=getCategorias')
                .then(response => response.json())
                .then(data => {
                    categorias = data;
                    renderCategorias();
                })
                .catch(error => {
                    console.error('Erro ao carregar categorias:', error);
                });
        }

        function carregarProdutos(categoria = 'all') {
            let url = 'api.php?action=getProdutos';
            if (categoria !== 'all') {
                url += `&categoria=${categoria}`;
            }

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    produtos = data;
                    renderProducts();
                })
                .catch(error => {
                    console.error('Erro ao carregar produtos:', error);
                    productsGrid.innerHTML = '<p style="text-align: center; padding: 40px; color: var(--danger);">Erro ao carregar produtos. Tente novamente.</p>';
                });
        }

        function renderCategorias() {
            const allButton = categoriesContainer.querySelector('[data-category="all"]');
            categoriesContainer.innerHTML = '';
            categoriesContainer.appendChild(allButton);

            categorias.forEach(categoria => {
                const categoryBtn = document.createElement('button');
                categoryBtn.className = 'category-btn';
                categoryBtn.setAttribute('data-category', categoria.nome);
                categoryBtn.textContent = `📦 ${categoria.nome}`;
                categoriesContainer.appendChild(categoryBtn);
            });

            document.querySelectorAll('.category-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    document.querySelectorAll('.category-btn').forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');
                    currentCategory = btn.getAttribute('data-category');
                    carregarProdutos(currentCategory);
                });
            });
        }

        function renderProducts() {
            productsGrid.innerHTML = '';
            
            if (produtos.length === 0) {
                productsGrid.innerHTML = '<p style="text-align: center; padding: 40px; color: #666;">Nenhum produto encontrado.</p>';
                return;
            }

            produtos.forEach(product => {
                const productCard = document.createElement('div');
                productCard.className = 'product-card';
                productCard.innerHTML = `
                    <div class="product-image">${product.emoji || '🍕'}</div>
                    <div class="product-name">${product.nome}</div>
                    <div class="product-price">R$ ${parseFloat(product.preco).toFixed(2)}</div>
                    <button class="add-to-cart" data-id="${product.id}">Adicionar</button>
                `;
                productsGrid.appendChild(productCard);
            });
            
            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', (e) => {
                    const productId = parseInt(e.target.getAttribute('data-id'));
                    addToCart(productId);
                });
            });
        }

        function setupEventListeners() {
            document.querySelectorAll('.payment-option').forEach(option => {
                option.addEventListener('click', () => {
                    document.querySelectorAll('.payment-option').forEach(o => o.classList.remove('selected'));
                    option.classList.add('selected');
                    selectedPaymentMethod = option.getAttribute('data-method');
                    updateCheckoutButton();
                });
            });
            
            checkoutBtn.addEventListener('click', finalizeOrder);
            newOrderBtn.addEventListener('click', startNewOrder);
            viewReceiptBtn.addEventListener('click', viewReceipt);
        }

        function addToCart(productId) {
            const product = produtos.find(p => p.id === productId);
            const existingItem = cart.find(item => item.id === productId);
            
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({
                    id: product.id,
                    nome: product.nome,
                    preco: parseFloat(product.preco),
                    quantity: 1,
                    emoji: product.emoji
                });
            }
            
            updateCart();
        }

        function removeFromCart(productId) {
            cart = cart.filter(item => item.id !== productId);
            updateCart();
        }

        function updateQuantity(productId, change) {
            const item = cart.find(item => item.id === productId);
            if (item) {
                item.quantity += change;
                if (item.quantity <= 0) {
                    removeFromCart(productId);
                } else {
                    updateCart();
                }
            }
        }

        function updateCart() {
            const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
            cartCount.textContent = totalItems;
            
            orderItems.innerHTML = '';
            
            if (cart.length === 0) {
                orderItems.innerHTML = '<p class="empty-cart-message">Seu carrinho está vazio</p>';
            } else {
                cart.forEach(item => {
                    const orderItem = document.createElement('div');
                    orderItem.className = 'order-item';
                    orderItem.innerHTML = `
                        <div class="item-info">
                            <div class="item-name">${item.emoji} ${item.nome}</div>
                            <div class="item-price">R$ ${item.preco.toFixed(2)}</div>
                        </div>
                        <div class="item-controls">
                            <button class="quantity-btn minus" data-id="${item.id}">-</button>
                            <span style="font-weight: 600; min-width: 20px; text-align: center;">${item.quantity}</span>
                            <button class="quantity-btn plus" data-id="${item.id}">+</button>
                            <span class="remove-item" data-id="${item.id}" title="Remover">🗑️</span>
                        </div>
                    `;
                    orderItems.appendChild(orderItem);
                });
                
                document.querySelectorAll('.quantity-btn.minus').forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        const id = parseInt(e.target.getAttribute('data-id'));
                        updateQuantity(id, -1);
                    });
                });
                
                document.querySelectorAll('.quantity-btn.plus').forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        const id = parseInt(e.target.getAttribute('data-id'));
                        updateQuantity(id, 1);
                    });
                });
                
                document.querySelectorAll('.remove-item').forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        const id = parseInt(e.target.getAttribute('data-id'));
                        removeFromCart(id);
                    });
                });
            }
            
            const total = cart.reduce((sum, item) => sum + (item.preco * item.quantity), 0);
            orderTotal.textContent = `R$ ${total.toFixed(2)}`;
            
            updateCheckoutButton();
        }

        function updateCheckoutButton() {
            checkoutBtn.disabled = !(cart.length > 0 && selectedPaymentMethod);
        }

        function finalizeOrder() {
            if (cart.length === 0 || !selectedPaymentMethod) return;

            checkoutText.style.display = 'none';
            checkoutLoading.style.display = 'inline-block';
            checkoutBtn.disabled = true;

            const total = cart.reduce((sum, item) => sum + (item.preco * item.quantity), 0);
            
            const pedidoData = {
                action: 'criarPedido',
                itens: cart,
                total: total,
                forma_pagamento: selectedPaymentMethod
            };

            fetch('api.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(pedidoData)
            })
            .then(response => response.json())
            .then(data => {
                checkoutText.style.display = 'inline-block';
                checkoutLoading.style.display = 'none';

                if (data.success) {
                    pedidoNumero.textContent = '#' + data.pedido_id;
                    generateReceipt(total, data.pedido_id);
                    successModal.style.display = 'flex';
                } else {
                    alert('Erro ao finalizar pedido: ' + data.message);
                    checkoutBtn.disabled = false;
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                checkoutText.style.display = 'inline-block';
                checkoutLoading.style.display = 'none';
                alert('Erro ao conectar com o servidor');
                checkoutBtn.disabled = false;
            });
        }

        function generateReceipt(total, pedidoId) {
            receiptItems.innerHTML = '';
            
            cart.forEach(item => {
                const receiptItem = document.createElement('div');
                receiptItem.className = 'receipt-item';
                receiptItem.innerHTML = `
                    <span>${item.quantity}x ${item.nome}</span>
                    <span>R$ ${(item.preco * item.quantity).toFixed(2)}</span>
                `;
                receiptItems.appendChild(receiptItem);
            });
            
            const paymentLine = document.createElement('div');
            paymentLine.className = 'receipt-item';
            let paymentText = '';
            let finalTotal = total;
            
            switch(selectedPaymentMethod) {
                case 'pix':
                    paymentText = 'PIX (5% desc)';
                    finalTotal = total * 0.95;
                    break;
                case 'cash':
                    paymentText = 'Dinheiro';
                    break;
                case 'card':
                    paymentText = 'Cartão';
                    break;
            }
            
            paymentLine.innerHTML = `
                <span>${paymentText}</span>
                <span>R$ ${finalTotal.toFixed(2)}</span>
            `;
            receiptItems.appendChild(paymentLine);
            
            const pedidoLine = document.createElement('div');
            pedidoLine.className = 'receipt-item';
            pedidoLine.innerHTML = `
                <span>Pedido #${pedidoId}</span>
                <span>${new Date().toLocaleDateString()}</span>
            `;
            receiptItems.appendChild(pedidoLine);
            
            receiptTotal.textContent = `R$ ${finalTotal.toFixed(2)}`;
        }

        function startNewOrder() {
            cart = [];
            selectedPaymentMethod = null;
            document.querySelectorAll('.payment-option').forEach(o => o.classList.remove('selected'));
            updateCart();
            successModal.style.display = 'none';
            receipt.style.display = 'none';
        }

        function viewReceipt() {
            successModal.style.display = 'none';
            receipt.style.display = 'block';
            receipt.scrollIntoView({ behavior: 'smooth' });
        }
    </script>
</body>
</html>