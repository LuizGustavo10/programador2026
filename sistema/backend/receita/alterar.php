<?php
include '../conexao.php';
include '../validacao.php';
include '../upload.php';

if(($_SESSION['tipo'] ?? 'admin') != 'admin'){
    header('Location: ../../produto.php');
    exit;
}

$id = $_REQUEST['id'];
$nome = $_REQUEST['nome'];
$descricao = $_REQUEST['descricao'];
$foto = salvarUpload('foto', $_POST['foto_atual'] ?? '');

$sql = "UPDATE receita SET nome='$nome', foto='$foto', descricao='$descricao' WHERE id='$id'";
mysqli_query($conexao, $sql);

header('Location: ../../receita.php');
?>
