<?php
include '../conexao.php';
include '../validacao.php';

if(($_SESSION['tipo'] ?? 'admin') != 'admin'){
    header('Location: ../../produto.php');
    exit;
}

$id = $_REQUEST['id'];

mysqli_query($conexao, "DELETE FROM produto_receita WHERE receita_id='$id'");
mysqli_query($conexao, "DELETE FROM receita WHERE id='$id'");

header('Location: ../../receita.php');
?>
