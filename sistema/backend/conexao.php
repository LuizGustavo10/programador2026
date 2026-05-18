<?php
    $endereco = "localhost";
    $nome = "ecolote";
    $usuario = "root";
    $senha = "";

    $conexao = mysqli_connect($endereco, $usuario, $senha, $nome);

    //se houver algum erro
    if(!$conexao){
        echo "Erro na conexão";
    }else {
        echo "Parabéns, conectou!";
    }

?>