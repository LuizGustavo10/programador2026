<?php
    include '../conexao.php';
    include '../validacao.php';

    $id = $_REQUEST['id'];
    $filtroMercado = ($_SESSION['tipo'] ?? 'admin') == 'mercado' ? " AND mercado_id='".$_SESSION['mercado_id']."' " : "";

    mysqli_query($conexao, "DELETE FROM produto_receita WHERE produto_id='$id'");
    $sql= "DELETE FROM produto WHERE id='$id' $filtroMercado";
    mysqli_query($conexao, $sql);

    header('Location:../../produto.php');
?>
