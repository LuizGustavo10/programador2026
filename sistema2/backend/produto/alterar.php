<?php
include '../conexao.php';
include '../upload.php';

$id= $_REQUEST['id'];
$nome = $_REQUEST['nome'];
$preco = $_REQUEST['preco'];
$disponibilidade = $_REQUEST['disponibilidade'];
$imagem = salvarUpload('imagem', $_POST['imagem_atual'] ?? '');
$mercado = $_REQUEST['mercado'];

$sql = "UPDATE produto SET nome='$nome', preco='$preco', disponibilidade='$disponibilidade',
imagem='$imagem', mercado_id='$mercado' WHERE id='$id' ";

$resultado = mysqli_query($conexao, $sql);

header('Location: ../../produto.php');
?>
