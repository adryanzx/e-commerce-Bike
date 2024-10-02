<?php
include "layout/cabecalho.php";
require_once "../controller/Controlador.php";
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Cadastrar Cliente</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar">
                <ul class="nav flex-column">
                <li class="nav-item">
                        <a class="nav-link btn btn-dark mb-2" href="home.php">Ver Relatorio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-dark mb-2" href="gerenciaCliente.php">Cadastrar usuários</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-dark mb-2" href="cadastroProduto.php">Cadastrar Produtos</a>
                    </li>
                    
                    
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger mb-2" href="login.php">Log Out</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-success mb-2" href="inicio.php">Ir para o site</a>
                    </li>
                </ul>
            </div>

<style>

    /* Estilos personalizados para a tabela */
    .sidebar {
            background-color: #343a40;
            padding: 15px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 200px;
        }

        .main-content {
            margin-left: 220px;
            padding: 20px;
        }
        .table {
    width: 80%; /* Ajuste a largura da tabela */
    max-width: 1000px; /* Limita a largura máxima da tabela */
    border-collapse: collapse;
    background-color: #f9f9f9;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
    margin: 20px auto; /* Centraliza horizontalmente com uma margem superior */
    margin-left: 15%; /* Mover a tabela um pouco para a direita */
}

.table th, .table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.table thead th {
    background-color: #4CAF50;
    color: white;
    text-transform: uppercase;
}

.table tbody tr:hover {
    background-color: #f1f1f1;
}

.table tbody tr:nth-child(even) {
    background-color: #f2f2f2;
}

.table tbody td {
    font-size: 16px;
    color: #333;
}

.zebrado {
    background-color: #eaf0f1;
}

.table tbody td a {
    text-decoration: none;
    color: #007BFF;
    font-weight: bold;
}

.table tbody td a:hover {
    color: #0056b3;
    text-decoration: underline;
}

/* Responsividade */
@media screen and (max-width: 768px) {
    .table thead {
        display: none;
    }

    .table, .table tbody, .table tr, .table td {
        display: block;
        width: 100%;
    }

    .table tbody tr {
        margin-bottom: 15px;
    }

    .table tbody td {
        text-align: right;
        padding-left: 50%;
        position: relative;
    }
    h1{
    text-align: center; /* Centraliza o texto */
}

    .table tbody td:before {
        content: attr(data-label);
        position: absolute;
        left: 0;
        padding-left: 15px;
        font-weight: bold;
        text-transform: uppercase;
    }
}

        </style>
<h1 style="text-align: center;">Relatório de Vendas</h1>
<div class="container-md bg-white opacity-75 rounded-3 p-4 mt-3">
   
        <?php
        $controlador = new Controlador();
        echo $controlador->botoesBaixarRelatorio();
        ?>
    <div class="row mt-3">
        <div class="col-12">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Cod. Venda</th>
                        <th>Cliente</th>
                        <th>Valor Total</th>
                        <th>Data da Venda</th>
                        <th>Endereço de Entrega</th>
                        <th>Detalhes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $controlador = new Controlador();
                    echo $controlador->exibirRelatorioVendas();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>

    //baixar JSON já gerado por aqui !!
    document.getElementById("downloadJson").addEventListener("click", function() {
        const link = document.createElement("a");
        link.href = "../model/JSON/relatorio_vendas.json";
        link.download = "relatorio_vendas.json";
        link.click();
    });

    //baixar CSV já gerado por aqui !!
    document.getElementById("downloadCsv").addEventListener("click", function() {
        const link = document.createElement("a");
        link.href = "../model/JSON/relatorio_vendas.csv";
        link.download = "relatorio_vendas.csv";
        link.click();
    });

</script>
