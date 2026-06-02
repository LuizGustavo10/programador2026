<?php
include '../conexao.php';
include '../upload.php';

$nome = $_REQUEST['nome'];
$preco = $_REQUEST['preco'];
$disponibilidade = $_REQUEST['disponibilidade'];
$imagem = salvarUpload('imagem');
$mercado = $_REQUEST['mercado'];

$sql = "INSERT INTO produto(nome, preco, disponibilidade, imagem, mercado_id)
VALUES ('$nome','$preco','$disponibilidade','$imagem','$mercado')";

$resultado = mysqli_query($conexao, $sql);

header('Location: ../../produto.php');
?>
