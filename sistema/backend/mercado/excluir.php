<?php

    include '../conexao.php';

    $id = $_REQUEST['id'];

    $sql= "DELETE FROM mercado WHERE id='$id' ";
    $resultado = mysqli_query($conexao, $sql);

    header('Location:../../mercado.php');
?>