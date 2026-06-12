<?php
    $endereco = "localhost";
    $nome = "ecolote";
    $usuario = "root";
    $senha = "";

    // $endereco = "localhost";
    // $nome = "u822474892_ecolote";
    // $usuario = "u822474892_ecoloteuser";
    // $senha = "@Senac2026";

    $conexao = mysqli_connect($endereco, $usuario, $senha, $nome);

    if(!$conexao){
        die("Erro na conexao");
    }
?>
