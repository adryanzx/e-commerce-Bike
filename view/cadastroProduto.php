<?php
require_once "../controller/Controlador.php";
include "layout/cabecalho.php";
?>


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
            <h1>Produtos</h1>
        </section>
        <h3>Gerenciamento de Produtos</h3>
        <a class="btn btn-primary mb-3 openModal">Cadastrar novo produto</a>

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

<?php
  include "layout/rodape.php";
?>  