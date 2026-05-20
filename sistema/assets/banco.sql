/* COMANDOS DDL - LINGUAGEM DE DEFINIÇÃO DE DADOS */
CREATE TABLE usuario(
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nome VARCHAR(45),
    cpf VARCHAR(15),
    email VARCHAR(45),
    senha VARCHAR(45)
);

ALTER TABLE usuario ADD salario INT;

-- DROP TABLE usuario;

/* COMANDOS DML - LINGUAGEM DE MANIPULAÇÃO DE DADOS */
INSERT INTO usuario(nome, cpf, email, senha) VALUES
("Enzo", "123.123.123-12", "enzo@gmail.com", "123"),
("Valentina", "321.321.321-32", "val@gmail.com", "123"),
("Admin", "111.111.111-11", "admin@gmail.com", "111");

UPDATE usuario SET salario = 3000;
UPDATE usuario SET salario = 5000 WHERE id=1;

DELETE FROM usuario WHERE id = 2;

SELECT * FROM usuario;
SELECT nome, salario FROM usuario;
SELECT nome, salario FROM usuario WHERE salario > 4000;

CREATE TABLE mercado (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(120) NOT NULL,
    cnpj VARCHAR(20) NOT NULL,
    email VARCHAR(120) NOT NULL,
    senha VARCHAR(120) NOT NULL,
    endereco VARCHAR(200) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    foto VARCHAR(255) NOT NULL,
    mapa VARCHAR(20)
);

INSERT INTO mercado(nome, cnpj, email, senha, endereco, telefone, foto, mapa) VALUES
("Gugão","02.163.753/0006-58", "gugao@gmail.com","123","Av.A.Homernezes","(44) 9996-2547","1","1");

CREATE TABLE produto(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(120),
    preco DECIMAL(10,2),
    disponibilidade VARCHAR(30) NOT NULL,
    imagem VARCHAR(255),
    mercado_id INT NOT NULL,
    FOREIGN KEY mercado.id REFERENCES produto.mercado_id;

);