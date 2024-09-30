<?php
require_once("../controller/Controlador.php");
$controlador = new Controlador();

if(
    isset($_POST['inputCod']) &&
    isset($_POST['inputNome']) &&
   
    isset($_POST['inputCPF']) && 
    isset($_POST['inputEmail']) &&
    isset($_POST['inputSenha'])
   )
{   
    $cod = $_POST['inputCod'];
    $nome = $_POST['inputNome'];

    $cpf = $_POST['inputCPF'];

    $email = $_POST['inputEmail'];
    $senha = $_POST['inputSenha'];

    echo $cod;
    
    $controlador->alterarCliente($cod, $nome, $cpf, $email, $senha);
    session_destroy();
    session_start();
    header('Location:../view/clienteGerenciaUsuario.php');
    die();
}