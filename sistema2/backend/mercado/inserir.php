<?php
include '../conexao.php';
include '../upload.php';

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

$resultado = mysqli_query($conexao, $sql);

header('Location: ../../mercado.php');
?>
