<?php
    //conectar com banco
    include './conexao.php';

    //receber o email e senha do front-end por requisição
    $email = $_REQUEST['email'];
    $senha = $_REQUEST['senha'];

    //SQL que busca no banco um usuário com email e senha especifica
    $sql = "SELECT * FROM usuario WHERE email='$email' AND senha='$senha' ";
    //executar SQL
    $resultado = mysqli_query($conexao, $sql);
    //pegar valores das colunas do banco
    $colunas = mysqli_fetch_assoc($resultado);

    //imprimir o encontrado
    echo $colunas['nome'];
  
    //se o numero de linhas for maior que zero buscados, pode logar
    if(mysqli_num_rows($resultado) > 0){
        session_start();

        //variáveis de sessão
        $_SESSION['usuario'] = $colunas['nome'];
        $_SESSION['email'] = $colunas['email'];
        $_SESSION['senha'] = $colunas['senha'];

        //direciona para a pagina principal
        header('location:../principal.php');
    }else{
        //mantem a pessoa no login caso errar
        header('location:../login.php');
    }

?>