<?php
include '../conexao.php';
include '../validacao.php';
include '../upload.php';

$nome = $_REQUEST['nome'];
$preco = formatarPrecoBanco($_REQUEST['preco']);
$disponibilidade = $_REQUEST['disponibilidade'];
$imagem = salvarUpload('imagem');
$mercado = ($_SESSION['tipo'] ?? 'admin') == 'mercado' ? $_SESSION['mercado_id'] : $_REQUEST['mercado'];
$receitas = $_POST['receitas'] ?? [];

$sql = "INSERT INTO produto(nome, preco, disponibilidade, imagem, mercado_id)
VALUES ('$nome','$preco','$disponibilidade','$imagem','$mercado')";

mysqli_query($conexao, $sql);
$produtoId = mysqli_insert_id($conexao);

foreach($receitas as $receitaId){
    mysqli_query($conexao, "INSERT INTO produto_receita(produto_id, receita_id) VALUES ('$produtoId', '$receitaId')");
}

header('Location: ../../produto.php');
?>
