<?php

    include '../conexao.php';
    include '../validacao.php';

    if(($_SESSION['tipo'] ?? 'admin') != 'admin'){
        header('Location: ../../produto.php');
        exit;
    }

    $id = $_REQUEST['id'];

    $sql= "DELETE FROM mercado WHERE id='$id' ";
    $resultado = mysqli_query($conexao, $sql);

    header('Location:../../mercado.php');
?>
