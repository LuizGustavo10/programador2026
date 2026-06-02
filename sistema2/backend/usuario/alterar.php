<?php

//importando o banco
include '../conexao.php';

//receber dados do frontend
$id= $_REQUEST['id'];
$nome= $_REQUEST['nome'];
$email= $_REQUEST['email'];
$cpf= $_REQUEST['cpf'];
$senha= $_REQUEST['senha'];

$sql = "UPDATE usuario SET nome='$nome', email='$email', cpf='$cpf', senha='$senha' 
WHERE id='$id' ";

$resultado = mysqli_query($conexao, $sql);

header('Location:../../principal.php');

?>