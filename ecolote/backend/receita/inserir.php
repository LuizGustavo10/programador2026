<?php
include '../conexao.php';
include '../validacao.php';
include '../upload.php';

if(($_SESSION['tipo'] ?? 'admin') != 'admin'){
    header('Location: ../../produto.php');
    exit;
}

$nome = $_REQUEST['nome'];
$descricao = $_REQUEST['descricao'];
$foto = salvarUpload('foto');

$sql = "INSERT INTO receita(nome, foto, descricao) VALUES ('$nome','$foto','$descricao')";
mysqli_query($conexao, $sql);

header('Location: ../../receita.php');
?>
