<?php
require_once "../controller/Controlador.php";
include "layout/cabecalho.php";
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
        .container-table {
    display: flex;
    justify-content: flex-end; 
    align-items: center;
    margin: 0 auto;
    width: 100%; 
}

.table {
    width: 80%; /* Ajuste a largura da tabela */
    max-width: 1000px; /* Limita a largura máxima da tabela */
    border-collapse: collapse;
    background-color: #f9f9f9;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
    margin: 20px auto; /* Centraliza horizontalmente com uma margem superior */
    margin-left: 20%; /* Mover a tabela um pouco para a direita */
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
<main>
    <!-- Modal -->
    <div id="myModal" class="modal">
        <!-- Conteúdo do modal -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <section class="conteudo-formulario-cadastro">
                <form id="form-log" method="POST" action="../processamento/processamento.php" class="container mt-5">
                    <label for="inputNome">Nome</label>
                    <input id="inputNome" type="text" class="form-control mb-3" placeholder="Nome" name="inputNome"
                        required>

                    <label for="inputCPF">CPF</label>
                    <input id="inputCPF" type="text" class="form-control mb-3" placeholder="CPF" name="inputCPF"
                        maxlength="11" required>

                    <label for="inputEmail">Email</label>
                    <input id="inputEmail" type="email" class="form-control mb-3" placeholder="Email" name="inputEmail"
                        required>

                    <label for="inputSenha">Senha</label>
                    <input id="inputSenha" type="password" class="form-control mb-3" placeholder="Senha"
                        name="inputSenha" required>

                    <button id="botao-log" type="submit" class="btn btn-success">CADASTRAR-SE</button>
                </form>
            </section>
        </div>
    </div>

    <!-- Modal alterar -->
    <div id="myModalAlterar" class="modal">
        <!-- Conteúdo do modal -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <?php
                    $controlador = new Controlador();
                    echo $controlador->visualizarProdutosModal();
                ?>
        </div>
    </div>

    <section class="conteudo-visualizar">
        <section class="conteudo-visualizar-box">
            <h1>Gerenciamento de Clientes</h1>
        </section>
        <!-- <h3>Gerenciamento de Clientes</h3> -->
        <div class="button-container">
        <a class="btn btn-primary mb-3 openModal">Cadastrar novo cliente</a>
</div>

        <table class="table table-borderless zebrado">
            <thead class="table">
                <tr>
                    <th>Cod</th>
                    <th>CPF</th>
                    <th>Nome</th>
                    <th>Email</th>

                    <th></th>
                </tr>
            </thead>
            <?php
                        $controlador = new Controlador();
                        echo $controlador->visualizarClientes();
                    ?>
        </table>
    </section>

</main>
<script>
//MODAL CADASTRO
var modalCad = document.getElementById("myModal");
var btnsModalCad = document.querySelectorAll(".openModal");
var spanCad = document.getElementsByClassName("close")[0];

// Para cada botão de cadastro, adicionar um evento de clique para abrir o modal
btnsModalCad.forEach(function(btn) {
    btn.onclick = function() {
        modalCad.style.display = "block";
    }
});

// Quando o usuário clicar no botão de fechar (para o modal de cadastro), fechar o modal
spanCad.onclick = function() {
    modalCad.style.display = "none";
}

// Quando o usuário clicar fora do modal fechar o modal
window.onclick = function(event) {
    if (event.target == modalCad) {
        modalCad.style.display = "none";
    }
}
</script>

