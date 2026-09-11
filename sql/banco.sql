CREATE DATABASE IF NOT EXISTS estoque_loja;

USE estoque_loja;
ALTER TABLE produtos;

DESCRIBE PRODUTOS; 

CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    marca VARCHAR(50),
    preco DECIMAL(10,2) NOT NULL,
    estoque INT NOT NULL DEFAULT 0
);
CREATE TABLE IF NOT EXISTS clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    telefone VARCHAR(20)
);
CREATE TABLE vendas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT,
    data_venda DATETIME DEFAULT CURRENT_TIMESTAMP,
    valor_total DECIMAL(10,2) NOT NULL DEFAULT 0,

    FOREIGN KEY (cliente_id) REFERENCES clientes(id)
);
CREATE TABLE itens_venda (
    id INT AUTO_INCREMENT PRIMARY KEY,
    venda_id INT NOT NULL,
    produto_id INT NOT NULL,
    quantidade INT NOT NULL,
    preco_unitario DECIMAL(10,2) NOT NULL,

    FOREIGN KEY (venda_id) REFERENCES vendas(id),
    FOREIGN KEY (produto_id) REFERENCES produtos(id)
);
INSERT INTO produtos (nome, categoria, marca, preco, estoque)
VALUES
('Violão Acústico', 'Violão', 'Giannini', 799.90, 10),
('Guitarra Elétrica', 'Guitarra', 'Tagima', 1499.90, 5),
('Teclado Musical', 'Teclado', 'Yamaha', 1899.90, 4),
('Contrabaixo', 'Baixo', 'Tagima', 1599.90, 6),
('Bateria Acústica', 'Bateria', 'Michael', 2499.90, 2);

SELECT * FROM produtos;