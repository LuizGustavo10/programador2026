<?php
include '../conexao.php';
include '../validacao.php';
include '../upload.php';

if(($_SESSION['tipo'] ?? 'admin') != 'admin'){
    header('Location: ../../produto.php');
    exit;
}

$nome = $_REQUEST['nome'];
$email = $_REQUEST['email'];
$cnpj = $_REQUEST['cnpj'];
$senha = $_REQUEST['senha'];
$endereco = $_REQUEST['endereco'];
$telefone = $_REQUEST['telefone'];
$foto = salvarUpload('foto');
$mapa = $_REQUEST['mapa'];

$sql = "INSERT INTO mercado(nome, email, cnpj, senha, endereco, telefone, foto, mapa)
VALUES ('$nome','$email','$cnpj','$senha','$endereco','$telefone','$foto','$mapa')";

mysqli_query($conexao, $sql);
header('Location: ../../mercado.php');
?>
