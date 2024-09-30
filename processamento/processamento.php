<?php

session_start();
require_once("../controller/Controlador.php");
require_once ("../model/FactoryProduto.php");

$controlador = new Controlador();

//Login
if(isset($_POST['inputEmailLog']) 
&& isset($_POST['inputSenhaLog'])){

    //$_SESSION['estaLogado'] = TRUE;
    $email = $_POST['inputEmailLog'];
    $senha = $_POST['inputSenhaLog'];

    $controlador->verificaLogin($email, $senha);
    die();
    
}

//Cadastro de Cliente
if(isset($_POST['inputNome']) &&
   isset($_POST['inputCPF']) && 
   isset($_POST['inputEmail']) &&
   isset($_POST['inputSenha'])
   
   )
{   
    $cod = "";
    $nome = $_POST['inputNome'];
    $cpf = $_POST['inputCPF'];
    $email = $_POST['inputEmail'];
    $senha = $_POST['inputSenha'];
    
    $controlador->cadastrarCliente($cod,$nome,$cpf, $email, $senha);

    header('Location:../view/login.php');
    die();
}



//Cadastro de Produto
if (
    !empty($_POST['inputNomeProd']) && 
    !empty($_POST['inputFabricanteProd']) && 
    !empty($_POST['inputDescricaoProd']) && 
    !empty($_POST['inputValorProd']) && 
    !empty($_FILES['inputimagemProd']) &&
    !empty($_POST['inputSexoProd']) &&
    !empty($_POST['inputTipoProd']) &&
    !empty($_POST['inputTamanhoProd']) &&
    !empty($_POST['inputMaterialProd'])
) {
    // Obter os dados do formulário
    $dados = [
        'nome' => $_POST['inputNomeProd'],
        'fabricante' => $_POST['inputFabricanteProd'],
        'descricao' => $_POST['inputDescricaoProd'],
        'valor' => $_POST['inputValorProd'],
        'sexo' => $_POST['inputSexoProd'],
        'tipo' => $_POST['inputTipoProd'],
        'tamanho' => $_POST['inputTamanhoProd'],
        'material' => $_POST['inputMaterialProd'],
        'quadro' => $_POST['inputQuadroProd'] ?? null,
        'marca' => $_POST['inputMarcaProd'] ?? null,
        'cor' => $_POST['inputCorProd'] ?? null,
    ];

    // Upload da imagem
    $imagem_produto = $_FILES['inputimagemProd']['name'];
    $imagem_temp = $_FILES['inputimagemProd']['tmp_name'];
    $upload_dir = "../imagens/uploads/";
    $dados['imagem_destino'] = $upload_dir . $imagem_produto;

    if (move_uploaded_file($imagem_temp, $dados['imagem_destino'])) {
        $controlador->cadastrarProduto($dados);
        header('Location:../view/cadastroProduto.php');

        //caso precise verificar os dados
        //echo json_encode($dados);
        die();
    } else {
        echo "Erro ao fazer upload da imagem.";
    }
}


?>