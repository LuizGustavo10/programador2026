<?php
include '../conexao.php';
include '../validacao.php';
include '../upload.php';

$id= $_REQUEST['id'];
$nome = $_REQUEST['nome'];
$preco = formatarPrecoBanco($_REQUEST['preco']);
$disponibilidade = $_REQUEST['disponibilidade'];
$imagem = salvarUpload('imagem', $_POST['imagem_atual'] ?? '');
$mercado = ($_SESSION['tipo'] ?? 'admin') == 'mercado' ? $_SESSION['mercado_id'] : $_REQUEST['mercado'];
$receitas = $_POST['receitas'] ?? [];
$filtroMercado = ($_SESSION['tipo'] ?? 'admin') == 'mercado' ? " AND mercado_id='".$_SESSION['mercado_id']."' " : "";

$sql = "UPDATE produto SET nome='$nome', preco='$preco', disponibilidade='$disponibilidade',
imagem='$imagem', mercado_id='$mercado' WHERE id='$id' $filtroMercado";

mysqli_query($conexao, $sql);
mysqli_query($conexao, "DELETE FROM produto_receita WHERE produto_id='$id'");

foreach($receitas as $receitaId){
    mysqli_query($conexao, "INSERT INTO produto_receita(produto_id, receita_id) VALUES ('$id', '$receitaId')");
}

header('Location: ../../produto.php');
?>
