CREATE DATABASE IF NOT EXISTS quermesse;
USE quermesse;

CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    categoria_id INT,
    emoji VARCHAR(10),
    ativo BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
);

CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    total DECIMAL(10,2) NOT NULL,
    forma_pagamento ENUM('pix', 'cash', 'card') NOT NULL,
    status ENUM('pendente', 'preparando', 'pronto', 'entregue') DEFAULT 'pendente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE pedido_itens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT,
    produto_id INT,
    quantidade INT NOT NULL,
    preco_unitario DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (pedido_id) REFERENCES pedidos(id) ON DELETE CASCADE,
    FOREIGN KEY (produto_id) REFERENCES produtos(id)
);

INSERT INTO categorias (nome) VALUES 
('Salgados'),
('Bebidas'),
('Doces'),
('Refeições'),
('Sobremesas');

INSERT INTO produtos (nome, preco, categoria_id, emoji) VALUES
('Coxinha', 5.00, 1, '🥟'),
('Pastel', 6.50, 1, '🥮'),
('Esfirra', 4.50, 1, '🥙'),
('Pão de Queijo', 3.00, 1, '🧀'),
('Bolinha de Queijo', 4.00, 1, '🧀'),
('Refrigerante Lata', 5.00, 2, '🥤'),
('Suco Natural', 6.00, 2, '🧃'),
('Água Mineral', 3.00, 2, '💧'),
('Café', 2.50, 2, '☕'),
('Chá Gelado', 4.00, 2, '🫖'),
('Brigadeiro', 2.00, 3, '🍫'),
('Beijinho', 2.00, 3, '🍬'),
('Cajuzinho', 2.00, 3, '🥜'),
('Bolo no Pote', 8.00, 3, '🍰'),
('Pudim', 6.00, 3, '🍮'),
('Cachorro Quente', 12.00, 4, '🌭'),
('Lasanha', 15.00, 4, '🍝'),
('Prato Feito', 18.00, 4, '🍛'),
('Sorvete', 7.00, 5, '🍦'),
('Açaí', 10.00, 5, '🟣'),
('Mousse', 5.00, 5, '🍮');