<?php
include '../conexao.php';
include '../validacao.php';
include '../upload.php';

if(($_SESSION['tipo'] ?? 'admin') != 'admin'){
    header('Location: ../../produto.php');
    exit;
}

$id= $_REQUEST['id'];
$nome = $_REQUEST['nome'];
$email = $_REQUEST['email'];
$cnpj = $_REQUEST['cnpj'];
$senha = $_REQUEST['senha'];
$endereco = $_REQUEST['endereco'];
$telefone = $_REQUEST['telefone'];
$foto = salvarUpload('foto', $_POST['foto_atual'] ?? '');
$mapa = $_REQUEST['mapa'];

$sql = "UPDATE mercado SET nome='$nome', email='$email', cnpj='$cnpj', senha='$senha', endereco='$endereco',
telefone='$telefone', foto='$foto', mapa='$mapa'
WHERE id='$id' ";

mysqli_query($conexao, $sql);
header('Location: ../../mercado.php');
?>
