<?php
require_once "../controller/Controlador.php";
include "layout/cabecalho.php";
?>
<!DOCTYPE html>
<html>

<head>
    <title>Cadastrar Produtos</title>
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
    padding-right: 80px; 
}

/* Estilos para a tabela */
.table {
    width: 80%; /* Aumenta a largura da tabela para ocupar 80% da tela */
    max-width: 1000px; /* Limita a largura máxima da tabela */
    border-collapse: collapse;
    background-color: #f9f9f9;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
    margin-top: 20px;
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
                <form action="../processamento/processamento.php" method="POST" enctype="multipart/form-data">
                    <label>Cadastrar Produto</label>
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="inputNomeProd" placeholder="Nome"></input>
                    </div>
                    <div class="mb-3">
                        <label for="fabricante" class="form-label">Fabricante</label>
                        <input type="text" class="form-control" name="inputFabricanteProd" placeholder="Fabricante">
                    </div>
                    <div class="mb-3">
                        <label for="descrição" class="form-label">Descrição</label>
                        <input type="text" class="form-control" name="inputDescricaoProd" placeholder="Descrição">
                    </div>
                    <div class="mb-3">
                        <label for="valor" class="form-label">Valor</label>
                        <input type="text" class="form-control" name="inputValorProd" placeholder="Valor">
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Imagem</label>
                        <input class="form-control" type="file" id="formFile" name="inputimagemProd"
                            accept="image/jpeg, image/png" required>
                    </div>
                    <div class="mb-3">
                        <label for="valor" class="form-label">Sexo</label>
                        <select class="form-select" name="inputSexoProd">
                            <option value="Masculino">Masculino</option>
                            <option value="Feminino">Feminino</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tamanho</label>
                        <input type="text" class="form-control" name="inputTamanhoProd" placeholder="Tamanho (M) ou 39">
                    </div>


                    <div class="mb-3">
                        <label for="material" class="form-label">Material</label>
                        <input type="text" class="form-control" name="inputMaterialProd" placeholder="Material">
                    </div>

                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo</label>
                        <select id="tipoSelect" class="form-select" name="inputTipoProd">
                            <option value="BIKE">Bike</option>
                            <option value="SAPATILHA">Sapatilha</option>
                            <option value="OCULOS">Oculos</option>
                        </select>
                    </div>

                    <section id="bike" class="bike hidden">
                        <div class="mb-3">
                            <label for="quadro" class="form-label">quadro</label>
                            <input type="number" class="form-control" name="inputQuadroProd"
                                placeholder="Quadro"></input>
                        </div>
                    </section>

                    <section id="Sapatilha" class="sapatilha hidden">
                        <div class="mb-3">
                            <label for="Marca" class="form-label">Marca</label>
                            <input type="text" class="form-control" name="inputMarcaoProd"
                                placeholder="Marca"></input>
                        </div>
                    </section>

                    <section id="oculos" class="oculos hidden">
                        <div class="mb-3">
                            <label for="cor" class="form-label">cor</label>
                            <input type="text" class="form-control" name="inputCorProd"
                                placeholder="Cor"></input>
                        </div>
                    </section>

                    <button type="submit" class="btn btn-success">Cadastrar</button>
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
            <h1>Gerenciamento de Produtos</h1>
        </section>
        <!-- <h3>Gerenciamento de Produtos</h3> -->
        <div class="button-container">
        <a class="btn btn-primary mb-3 openModal">Cadastrar novo produto</a>
    </div>

        <div class="container-table">
        <table class="table table-borderless zebrado">
       
            <thead>
       
                <tr>
                    <th>Cod</th>
                    <th>Nome do produto</th>
                    <th>Fabricante</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Sexo</th>
                    <th>Tipo</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
</div>
            <?php
                        $controlador = new Controlador();
                        echo $controlador->visualizarProdutos();
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


var opcBike = document.getElementById("bike");

//começa com bota aparecendo
opcBike.style.display = "block";


document.addEventListener('DOMContentLoaded', (event) => {
    const tipoSelect = document.getElementById('tipoSelect');

    tipoSelect.addEventListener('change', (event) => {
        const selectedValue = event.target.value;
        console.log('Valor selecionado:', selectedValue);

        var opcBike = document.getElementById("bike");
        var opcSapatilha = document.getElementById("sapatilha");
        var opcOculos = document.getElementById("oculos");
 

        if (selectedValue == "Bike") {
            opcBike.style.display = "block";
            opcSapatilha.style.display = "none";
            opcOculos.style.display = "none";
        } else if (selectedValue == "Sapatilha") {
            opcBike.style.display = "none";
            opcSapatilha.style.display = "block";
            opcOculos.style.display = "none";


        } else if (selectedValue == "Oculos") {
            opcBike.style.display = "none";
            opcSapatilha.style.display = "none";
            opcOculos.style.display = "block";

        } 
    });
});
</script>

