<?php

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>BikeScriptzx - Cliente</title>
    <link rel="stylesheet" href="../css/indexx.css">
    <link rel="stylesheet" href="../css/footerr.css">
    <link rel="stylesheet" href="../css/formm.css">
    <link rel="stylesheet" href="../css/gridd.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-s3QAG/Rg9BYLllDZ7tL0JCUUDvb/W+gJxvh+yMTxOKWpsqmM2axfChazddWJW6WA29oQmbpWzOyjUhQb5tbqWQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


        <style>
        /* Estilização para o ícone do carrinho e o círculo de notificação */
        .nav-list {
            display: flex;
            list-style: none;
        }

        .nav-list li {
            margin-right: 20px;
            position: relative; /* Necessário para o posicionamento absoluto do círculo */
        }

        /* Estilização do círculo */
        .cart-badge {
            position: absolute;
            bottom: 0; /* Alinha ao canto inferior esquerdo */
            left: 0;
            background-color: red;
            color: white;
            width: 15px;
            height: 15px;
            border-radius: 50%;
            text-align: center;
            font-size: 10px;
        }
        .link-white {
  color: white; /* Define a cor do texto como branco */
}

.link-white:hover {
  color: rgba(255, 255, 255, 0.9); /* Pode ajustar a opacidade ao passar o mouse, se desejar */
}

    </style>
    

</head>

<body>
    <?php
        $controlador = new Controlador();
        echo $controlador->exibirQuantidadeCarrinho();
    ?>


    <header class="cabeça">
        <nav>
            <div class="logo">
                <a href="home.php">
                    <img src="../imagens/logo.png" class="logo-img transition-soft">
                </a>
            </div>
            <div class="mobile-menu">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>

            <ul class="nav-list">
                <li><a href="clienteVerProduto.php">Produtos</a></li>
                <li>
                    <a href="clienteCarrinho.php">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="cart-badge">0</span> <!-- Círculo com o número -->
                    </a>
                </li>
                <li><a href="clienteGerenciaUsuario.php"><i class="fa fa-user"></i></a></li>
                <li><a href="../processamento/sair.php">Sair</a></li>
            </ul>
        </nav>
    </header>
    