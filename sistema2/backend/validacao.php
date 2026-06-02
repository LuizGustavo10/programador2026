<?php
//iniciar sessão
session_start();
//se não existar a variavel de sessão cpf e senha
if(!isset($_SESSION["email"]) or !isset($_SESSION["senha"])){
    //destruir sessão anterior
    session_destroy();

    //limpar variáveis de sessão
    unset($_SESSION['email']);
    unset($_SESSION['senha']);

    //manda login
    header('location:../sistema/login.php');
} 

?>