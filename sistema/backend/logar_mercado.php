<?php
include './conexao.php';

$email = $_REQUEST['email'];
$senha = $_REQUEST['senha'];

$sql = "SELECT * FROM mercado WHERE email='$email' AND senha='$senha' ";
$resultado = mysqli_query($conexao, $sql);
$colunas = mysqli_fetch_assoc($resultado);

if(mysqli_num_rows($resultado) > 0){
    session_start();

    $_SESSION['usuario'] = $colunas['nome'];
    $_SESSION['email'] = $colunas['email'];
    $_SESSION['senha'] = $colunas['senha'];
    $_SESSION['tipo'] = 'mercado';
    $_SESSION['mercado_id'] = $colunas['id'];

    header('location:../produto.php');
}else{
    header('location:../login_mercado.php');
}
?>
