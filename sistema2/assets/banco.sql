CREATE DATABASE IF NOT EXISTS ecolote;
USE ecolote;

CREATE TABLE IF NOT EXISTS usuario(
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nome VARCHAR(45),
    cpf VARCHAR(15),
    email VARCHAR(45),
    senha VARCHAR(45),
    salario INT
);

CREATE TABLE IF NOT EXISTS mercado (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(120) NOT NULL,
    cnpj VARCHAR(20) NOT NULL,
    email VARCHAR(120) NOT NULL,
    senha VARCHAR(120) NOT NULL,
    endereco VARCHAR(200) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    foto VARCHAR(255),
    mapa VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS produto(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(120),
    preco DECIMAL(10,2),
    disponibilidade VARCHAR(30) NOT NULL,
    imagem VARCHAR(255),
    mercado_id INT NOT NULL,
    FOREIGN KEY (mercado_id) REFERENCES mercado(id)
);

INSERT INTO usuario(nome, cpf, email, senha, salario) VALUES
("Enzo", "123.123.123-12", "enzo@gmail.com", "123", 3000),
("Valentina", "321.321.321-32", "val@gmail.com", "123", 3000),
("Admin", "111.111.111-11", "admin@gmail.com", "111", 5000);

INSERT INTO mercado(nome, cnpj, email, senha, endereco, telefone, foto, mapa) VALUES
("Gugao Mercado", "02.163.753/0006-58", "gugao@gmail.com", "123", "Av. A. Homernezes", "(44) 99996-2547", "imagem/1779909443_346b3f2a__imagem2.png", ""),
("Mercado Economia", "12.345.678/0001-99", "economia@gmail.com", "123", "Rua das Flores, 120", "(44) 99988-1122", "imagem/1779909435_197d16b4__imagem1.png", ""),
("Super Bom Preco", "98.765.432/0001-10", "bompreco@gmail.com", "123", "Av. Brasil, 450", "(44) 99877-6655", "imagem/1779910131_b7d13cfb__imagem3.png", "");

INSERT INTO produto(nome, preco, disponibilidade, imagem, mercado_id) VALUES
("Detergente YPE", 2.00, "ativo", "imagem/1779909443_346b3f2a__imagem2.png", 1),
("Arroz 5kg", 19.90, "ativo", "imagem/1779909435_197d16b4__imagem1.png", 1),
("Feijao 1kg", 7.50, "ativo", "imagem/1779910131_b7d13cfb__imagem3.png", 2),
("Leite 1L", 4.29, "ativo", "imagem/1779909443_346b3f2a__imagem2.png", 2),
("Macarrao", 3.99, "ativo", "imagem/1779909435_197d16b4__imagem1.png", 3),
("Cafe 500g", 14.90, "ativo", "imagem/1779910131_b7d13cfb__imagem3.png", 3);
