<?php
    $endereco = "localhost";
    $nome = "ecolote";
    $usuario = "root";
    $senha = "";

    $conexao = mysqli_connect($endereco, $usuario, $senha, $nome);

    if(!$conexao){
        echo "Erro na conexao";
    }
?>
