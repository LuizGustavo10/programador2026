<?php
//importando o banco
include '../conexao.php';

//receber dados do frontend
$id= $_REQUEST['id'];
$nome = $_REQUEST['nome'];
$preco = $_REQUEST['preco'];
$disponibilidade = $_REQUEST['disponibilidade'];
$imagem = $_REQUEST['imagem'];
$mercado = $_REQUEST['mercado'];

$sql = "UPDATE produto SET nome='$nome', preco='$preco', disponibilidade='$disponibilidade',
imagem='$imagem', mercado_id='$mercado' WHERE id='$id' ";

$resultado = mysqli_query($conexao, $sql);

header('Location:../../produto.php');

?>