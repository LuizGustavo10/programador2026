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

