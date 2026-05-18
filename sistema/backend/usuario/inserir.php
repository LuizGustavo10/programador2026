<?php
include '../conexao.php';
//receber os dados dos names do frontend
$nome = $_REQUEST['nome'];
$email = $_REQUEST['email'];
$cpf = $_REQUEST['cpf'];
$senha = $_REQUEST['senha'];

//inserção em SQL - linguagem do banco
$sql = "INSERT INTO usuario(nome, email, cpf, senha) 
VALUES ('$nome','$email','$cpf','$senha')";
//executar
$resultado = mysqli_query($conexao, $sql);
//atualizar a pagina
// header('Location:../../principal.php');
?>