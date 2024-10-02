<?php
require_once("../model/BancoDeDados.php");
require_once("../model/Cliente.php");
require_once("../model/Produto.php");
require_once("../model/Carrinho.php");
require_once("../model/Venda.php");
require_once("../model/Endereco.php");
require_once ("../model/FactoryProduto.php");
require_once("../model/JsonToCsvAdapter.php");
require_once("../model/SessionManager.php");


class Controlador{

    private $bancoDeDados;

    function __construct(){

        $this->bancoDeDados = BancoDeDados::getInstance();
    }

    public function verificaLogin($email, $senha) {
        $usuarioLogado = $this->bancoDeDados->verificaLoginBD($email, $senha);
        SessionManager::destroySession();
    
        if (!empty($usuarioLogado[0])) {
            SessionManager::set("cod", $usuarioLogado[0]['cod']);
            SessionManager::set("nome", $usuarioLogado[0]['nome']);
    
            // Verifica se o e-mail contém o domínio @admin
            if (strpos($email, '@admin') !== false) {
                // Usuário administrador
                SessionManager::set("usuario_tipo", "admin");
                header('Location:../view/painel.php'); // Redireciona para o painel do administrador
            } else {
                // Usuário cliente
                SessionManager::set("usuario_tipo", "cliente");
                header('Location:../view/inicio.php'); // Redireciona para a página inicial do cliente
            }
            exit; // Para garantir que nenhum código adicional seja executado após o redirecionamento
        } else {
            echo "E-mail ou senha incorretos.";
        }
    }
    


    public function adcionarCarrinho($cliente_cod,$produto_cod,$quantidade){
        $carrinho = new Carrinho($cliente_cod,$produto_cod,$quantidade);
        $this->bancoDeDados->inserirCarrinho($carrinho);
    }

    public function visualizarProdutosCarrinho(){
        $prod = "";
        $usuarioLogado = SessionManager::get("cod");
        $endereco = $this->bancoDeDados->retornarEndereco($usuarioLogado);
        $codEndereco = $endereco !== null ? $endereco['cod'] : 0;
        $listaProdutosCarrinho = $this->bancoDeDados->retornarProdutosCarrinho($usuarioLogado);
    
        // Estilo CSS com animações e hover
        $prod .= "<style>
            .product-row {
                display: flex;
               box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
                justify-content: space-between;
                align-items: center;
                padding: 15px 0;
                border-bottom: 1px solid #ddd;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }
    
            .product-row:hover {
                transform: scale(1.02);
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            }
    
            .product-row img {
                border-radius: 8px;
                object-fit: cover;
                transition: transform 0.3s ease;
            }
    
            .product-row img:hover {
                transform: rotate(3deg) scale(1.05);
            }
    
            .product-info {
                display: flex;
                align-items: center;
            }
    
            .product-details {
                display: flex;
                flex-direction: column;
                margin-left: 15px;
                color: #444;
            }
    
            .product-details h6 {
                font-size: 1.1rem;
                color: #333;
                margin: 0;
            }
    
            .product-price, .product-quantity {
                font-size: 1rem;
                color: #666;
                text-align: center;
            }
    
            .quantity-buttons {
                display: flex;
                align-items: center;
            }
    
            .quantity-buttons input {
                text-align: center;
                border: none;
                background: transparent;
                width: 40px;
                font-size: 1rem;
            }
    
            .quantity-buttons .btn {
                padding: 5px 10px;
                font-size: 1rem;
                transition: background-color 0.3s ease;
            }
    
            .quantity-buttons .btn:hover {
                background-color: #ffc107;
                color: white;
            }
    
            .btn-danger {
                background-color: #dc3545;
                color: #fff;
                padding: 5px 10px;
                border: none;
                cursor: pointer;
                transition: background-color 0.3s ease, transform 0.2s ease;
            }
    
            .btn-danger:hover {
                background-color: #c82333;
                transform: scale(1.1);
            }
    
            .modal {
                display: none;
                position: fixed;
                z-index: 1;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                animation: fadeIn 0.5s ease;
            }
    
            .modal-content {
                background-color: rgba(0, 0, 0, 0.5);
                margin: 15% auto;
                padding: 20px;
                border-radius: 10px;
                width: 60%;
                animation: slideIn 0.5s ease;
            }
    
            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }
    
            @keyframes slideIn {
                from { transform: translateY(-100px); opacity: 0; }
                to { transform: translateY(0); opacity: 1; }
            }
    
            .modal-content label {
                font-weight: bold;
            }
    
            .modal .close {
                color: #ffff;
                float: right;
                font-size: 28px;
                font-weight: bold;
                transition: color 0.3s ease;
            }
    
            .modal .close:hover,
            .modal .close:focus {
                text-decoration: none;
                cursor: pointer;
            }
    
        </style>";
    
        // Construindo a visualização dos produtos no carrinho
        while ($produto = mysqli_fetch_assoc($listaProdutosCarrinho)) {
            $prod .=
            "<div class='product-row'>" .
                "<div class='product-info'>" .
                    "<img src='" . $produto["caminho_imagem"] . "' width='100' height='100' alt='Product Image'>" .
                    "<div class='product-details'>" .
                        "<h6>" . $produto["nome_produto"] . "</h6>" .
                    "</div>" .
                "</div>" .
                "<div class='product-price'><b>R$ " . $produto["valor_produto"] . "</b></div>" .
    
                "<div class='quantity-buttons'>" .
                    "<button class='btn btn-secondary increase' data-target='quantity" . $produto["codigo_carrinho"] . "' data-add='add" . $produto["codigo_carrinho"] . "'><i class='fa fa-plus' aria-hidden='true'></i></button>" .
                    "<input type='text' id='add" . $produto["codigo_carrinho"] . "' value='" . $produto["quantidade"] . "' readonly>" .
                    "<button class='btn btn-secondary decrease' data-target='quantity" . $produto["codigo_carrinho"] . "' data-add='add" . $produto["codigo_carrinho"] . "'><i class='fa fa-minus' aria-hidden='true'></i></button>" .
                "</div>" .
    
                "<form action='../processamento/processamentoExcluirCarrinho.php' method='post'>" .
                    "<input type='hidden' name='cod' value='" . $produto["codigo_carrinho"] . "' readonly>" .
                    "<button type='submit' class='btn btn-danger'><i class='fa fa-trash-o' aria-hidden='true'></i></button>" .
                "</form>" .
            "</div>";
        }
    
        // Modal para adicionar o endereço de entrega
        $prod .=
        "<div id='myModal' class='modal'>" .
            "<div class='modal-content'>" .
                "<span class='close'>&times;</span>" .
                "<section class='conteudo-formulario-cadastro'>" .
                    "<form action='../processamento/processamentoAddEndereco.php' method='POST' enctype='multipart/form-data'>" .
                        "<section class='form-endereco'>" .
                            "<label>Dados do endereço para entrega</label>" .
                            "<input type='hidden' class='form-control' name='inputUsuarioLogado' value='" . $usuarioLogado . "'>" .
                            "<input type='hidden' id='codEndereco' class='form-control' name='inputEndereco' value='" . $codEndereco . "'>" .
    
                            "<div class='mb-3'>" .
                                "<label for='CEP' class='form-label'>CEP</label>" .
                                "<input type='number' class='form-control' name='inputCep' placeholder='CEP' required>" .
                            "</div>" .
    
                            "<div class='mb-3'>" .
                                "<label for='Rua' class='form-label'>Rua</label>" .
                                "<input type='text' class='form-control' name='inputRua' placeholder='Rua' required>" .
                            "</div>" .
    
                            "<div class='mb-3'>" .
                                "<label for='Numero' class='form-label'>Número</label>" .
                                "<input type='number' class='form-control' name='inputNumero' placeholder='Número' required>" .
                            "</div>" .
    
                            "<div class='mb-3'>" .
                                "<label for='Bairro' class='form-label'>Bairro</label>" .
                                "<input type='text' class='form-control' name='inputBairro' placeholder='Bairro' required>" .
                            "</div>" .
    
                            "<div class='mb-3'>" .
                                "<label for='Complemento' class='form-label'>Complemento</label>" .
                                "<input type='text' class='form-control' name='inputComplemento' placeholder='Complemento (opcional)'>" .
                            "</div>" .
    
                            "<button type='submit' class='btn btn-primary'>Confirmar</button>" .
                        "</section>" .
                    "</form>" .
                "</section>" .
            "</div>" .
        "</div>";
    
        return $prod;
    }
    
    public function excluirCarrinho($cod){
        $this->bancoDeDados->excluirCarrinho($cod);
    }

    public function cadastrarProduto($dados) {
        $produto = FactoryProduto::factoryMethod($dados);
        if($produto == null){
            echo "Deu merda!";
        }
        else{
            $this->bancoDeDados->inserirProduto($produto);
        }
    }
    public function cadastrarCliente($cod, $nome, $cpf, $email, $senha){
        $cliente  = new Cliente($cod, $nome, $cpf, $email, $senha);
        $this->bancoDeDados->inserirCliente($cliente);
    }

    public function alterarCliente($cod, $nome, $cpf,  $email, $senha){
        $cliente  = new Cliente($cod, $nome, $cpf, $email, $senha);
        $this->bancoDeDados->alterarCliente($cliente);
    }

    public function excluirCliente($cod){
        $this->bancoDeDados->excluirCliente($cod);
    }
                    
    public function cadastrarEndereco($cod,$inputUsuarioLogado, $inputCep, $inputRua, $inputNumero, $inputBairro, $inputComplemento){
        $endereco  = new Endereco($cod,$inputUsuarioLogado, $inputCep, $inputRua, $inputNumero, $inputBairro, $inputComplemento);
        $this->bancoDeDados->cadastrarEndereco($endereco);
    }

    public function visualizarProdutos(){
        $prod="";
        $listaProdutos = $this->bancoDeDados->retornarProdutos();
        while($produto = mysqli_fetch_assoc($listaProdutos)){
            $prod .=
                "<tr>".
                    "<td>". $produto["cod"] ."</td>".
                    "<td>". $produto["nome"] ."</td>".
                    "<td>". $produto["fabricante"] ."</td>".
                    "<td>". $produto["descricao"] ."</td>".
                    "<td>". $produto["valor"] ."</td>".
                    "<td>". $produto["sexo"] ."</td>".
                    "<td>". $produto["tipo"] ."</td>".

                    "<td>".
                        "<form method='post' action='../processamento/processamentoExcluirProduto.php'>".
                            "<input type='hidden' name='cod' value='". $produto["cod"] ."'>".
                            "<input type='hidden' name='tipo' value='". $produto["tipo"] ."'>".

                            "<button class='btn btn-danger' type='submit' name='excluir_produto'><i class='fa fa-trash'></i></button>". // Botão para excluir
                        "</form>".
                    "</td>".
                    "<td>".

                    "<form method='post' action='../processamento/processamentoAlterarProduto.php'>".
                        "<input type='hidden' name='cod' value='". $produto["cod"] ."'>".
                        "<input type='hidden' name='tipo' value='". $produto["tipo"] ."'>".
                        
                    "</form>".

                    "</td>".
                "</tr>".
                "</tbody>";
        }
        return $prod;
    }
    public function visualizarProdutosModal(){
        $prod="";
        $listaProdutos = $this->bancoDeDados->retornarProdutosCod(17);
        while($produto = mysqli_fetch_assoc($listaProdutos)){
            $prod .=
            "<section class='conteudo-formulario-cadastro'>\n" .
            "    <form action='../processamento/processamento.php' method='POST' enctype='multipart/form-data'>\n" .
            "        <label>Alterar Produto</label>\n" .
            "        <div class='mb-3'>\n" .
            "            <label for='nome' class='form-label'>Codigo</label>\n" .
            "            <input type='text' class='form-control' name='inputNomeProd' placeholder='Nome' value='". $produto["cod"] ."' readonly>\n" .
            "        </div>\n" .
            "        <div class='mb-3'>\n" .
            "            <label for='nome' class='form-label'>Nome</label>\n" .
            "            <input type='text' class='form-control' name='inputNomeProd' placeholder='Nome' value='". $produto["nome"] ."'>\n" .
            "        </div>\n" .
            "        <div class='mb-3'>\n" .
            "            <label for='fabricante' class='form-label'>Fabricante</label>\n" .
            "            <input type='text' class='form-control' name='inputFabricanteProd' placeholder='Fabricante' value='". $produto["fabricante"] ."'>\n" .
            "        </div>\n" .
            "        <div class='mb-3'>\n" .
            "            <label for='descricao' class='form-label'>Descrição</label>\n" .
            "            <input type='text' class='form-control' name='inputDescricaoProd' placeholder='Descrição' value='". $produto["descricao"] ."'>\n" .
            "        </div>\n" .
            "        <div class='mb-3'>\n" .
            "            <label for='valor' class='form-label'>Valor</label>\n" .
            "            <input type='text' class='form-control' name='inputValorProd' placeholder='Valor' value='". $produto["valor"] ."'>\n" .
            "        </div>\n" .
            "        <div class='mb-3'>\n" .
            "            <label for='formFile' class='form-label'>Imagem</label>\n" .
            "             <img src='". $produto["imagem_path"] ."' alt='Sua Imagem' style='max-width: 100%; height: auto;'>\n" .
            "            <label for='formFile' class='form-label'>Imagem</label>\n" .
            "            <input class='form-control' type='file' id='formFile' name='inputimagemProd' accept='image/jpeg, image/png' required>\n" .
            "        </div>\n" .
            "        <button type='submit' class='btn btn-primary'>Cadastrar</button>\n" .
            "    </form>\n" .
            "</section>\n";
        }
        return $prod;
    }
    public function visualizarProdutosGrid(){
        $prod = "";
        $codCliente = SessionManager::get("cod");
        $listaProdutos = $this->bancoDeDados->retornarProdutos();
        
        // Adicionando o estilo CSS embutido no código PHP
        $prod .= "<style>
            .product-card {
                background-color: #fff;
                border-radius: 10px;
                padding: 20px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                text-align: center;
                margin-bottom: 20px;
            }
            
            .product-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            }
    
            .product-image {
                width: 100%;
                height: auto;
                border-radius: 8px;
                object-fit: cover;
                margin-bottom: 15px;
            }
    
            .product-name {
                font-size: 1.2rem;
                font-weight: bold;
                color: #333;
                margin-bottom: 10px;
            }
    
            .product-description {
                font-size: 1rem;
                color: #666;
                margin-bottom: 15px;
            }
    
            .product-price {
                font-size: 1.2rem;
                font-weight: bold;
                color: #ff8c00;
                margin-bottom: 20px;
            }
    
            .btn-add-to-cart {
                background-color: #ffc107;
                color: #fff;
                font-size: 1rem;
                font-weight: bold;
                border: none;
                padding: 10px 20px;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }
    
            .btn-add-to-cart:hover {
                background-color: #e0a800;
            }
    
            @media (max-width: 768px) {
                .product-card {
                    margin-bottom: 30px;
                }
    
                .product-name {
                    font-size: 1rem;
                }
    
                .product-price {
                    font-size: 1rem;
                }
    
                .btn-add-to-cart {
                    font-size: 0.9rem;
                    padding: 8px 15px;
                }
            }
        </style>";
    
        // Construindo os cards dos produtos
        while($produto = mysqli_fetch_assoc($listaProdutos)){
            $prod .=
            "<div class='col-lg-4 col-md-6' id='". $produto["tipo"] . "'>".
                "<div class='product-card'>".
                    "<img src='". $produto["imagem_path"] ."' alt='Product Image' class='product-image'>".
                    "<div class='product-name'>".$produto["nome"]."</div>".
                    "<div class='product-description'>". $produto["descricao"] ."</div>".
                    "<div class='product-price'>R$". $produto["valor"] ."</div>".
                    
                    "<form action='../processamento/processamentoVendas.php' method='post'>".
                        "<input type='hidden' name='produto_cod' value='". $produto["cod"] ."'>".
                        "<input type='hidden' name='cliente_cod' value='". $codCliente ."'>".
                        "<input type='hidden' name='valor_total' value='". $produto["valor"] ."'>".
                        "<input type='hidden' name='quantidade' value='1'>".
                        "<button type='submit' class='btn btn-warning btn-add-to-cart'>Adicionar ao Carrinho <i class='fa fa-shopping-cart'></i></button>".
                    "</form>".
                "</div>".
            "</div>";
        }
    
        return $prod;
    }
    


    public function visualizarClientes(){
        $cli="";
        $listaClientes = $this->bancoDeDados->retornarClientes();
        while($cliente = mysqli_fetch_assoc($listaClientes)){
            $cli .=
                "<tr>".
                    "<td>". $cliente["cod"] ."</td>".
                    "<td>". $cliente["cpf"] ."</td>".
                    "<td>".$cliente['nome']."</td>".
                    "<td>".$cliente['email']."</td>".



                    "<td>".
                        "<form method='post' action='../processamento/processamentoExcluirCliente.php'>".
                            "<input type='hidden' name='cod' value='". $cliente["cod"] ."'>".

                            "<button class='btn btn-danger' type='submit' name='excluir_produto'><i class='fa fa-trash'></i></button>". // Botão para excluir
                        "</form>".
                    "</td>".
                "</tr>".
                "</tbody>";
        }

        return $cli ;


    }
    
    public function visualizarClienteLogado(){
        $cli = "";
        $usuarioLogado = SessionManager::get("cod");
        $listaClientes = $this->bancoDeDados->retornarClienteLogado($usuarioLogado);
        while($cliente = mysqli_fetch_assoc($listaClientes)){
            $cli .= 

            "<input id='input-log' type='hidden' class='form-control mb-4' Value='".$cliente['cod']."' placeholder='Nome' name='inputCod' readonly>" .

            "<div class='form-group'>" .
                "<input id='input-log' type='text' class='form-control mb-4' Value='".$cliente['nome']."' placeholder='Nome' name='inputNome' required>" .
            "</div>" .

            "<div class='form-group'>" .
            "<input id='input-log' type='text' class='form-control mb-4' Value='".$cliente['cpf']."'placeholder='CPF' name='inputCPF' maxlength='11' required>" .
            "</div>" .
            "<div class='form-group'>".
                "<input id='input-log' type='email' class='form-control mb-4'  Value='".$cliente['email']."' placeholder='Email' name='inputEmail' required>" .
            "</div>".

            "<div class='form-group'>" .
                "<input id='input-log' type='text' class='form-control mb-4'  Value='".$cliente['senha']."' placeholder='Senha' name='inputSenha' required>" .
            "</div>"

            ;
        }
        return $cli;
    }

    public function excluirProduto($cod,$tipo){
        $this->bancoDeDados->excluirProdutos($cod,$tipo);
    }

    public function iniciarVenda($cliente_cod, $valor_total, $data_venda) {
        $usuarioLogado = SessionManager::get("cod");
        $venda  = new Venda($cliente_cod, $valor_total, $data_venda);
        $listaProdutosCarrinho = $this->bancoDeDados->retornarProdutosCarrinho($usuarioLogado);
    
        if ($this->bancoDeDados->iniciarVenda($venda, $listaProdutosCarrinho)) {
            // Corrigido o uso do set
            SessionManager::set("venda_efetuada", true);
        } else {
            // Corrigido o uso do set
            SessionManager::set("venda_efetuada", false);
        }
    }
    

    public function exibirRelatorioVendas() {
        $relatorio = "";
        $listaVendas = $this->bancoDeDados->retornarRelatorioVendas();
        $totalVendas = 0;
        $totalValor = 0;
    
        while ($venda = mysqli_fetch_assoc($listaVendas)) {
            $totalVendas++;
            $totalValor += $venda["valor_total"];
            $dataVenda = date("d/m/Y", strtotime($venda["data_venda"]));
    
            $detalhesVenda = "<ul>";
            $produtos = explode(", ", $venda["produtos"]);
            $quantidades = explode(", ", $venda["quantidades"]);
            $valoresTotais = explode(", ", $venda["valores_totais"]);
            
            for ($i = 0; $i < count($produtos); $i++) {
                $detalhesVenda .= "<li>{$produtos[$i]} - Quantidade: {$quantidades[$i]} - Valor: R$ ". number_format($valoresTotais[$i], 2, ',', '.') ."</li>";
            }
            $detalhesVenda .= "</ul>";
    
            $relatorio .=
                "<tr>".
                    "<td>". $venda["venda_cod"] ."</td>".
                    "<td>". $venda["cliente_nome"] . "</td>".
                    "<td>R$ ". number_format($venda["valor_total"], 2, ',', '.') ."</td>".
                    "<td>". $dataVenda ."</td>".
                    "<td>". $venda["rua"] . ", " . $venda["numero"] . ", " . $venda["bairro"] . ", " . $venda["cep"] ."</td>".
                    "<td><button class='btn btn-info' type='button' data-toggle='collapse' data-target='#detalhes-".$venda["venda_cod"]."'>Ver Detalhes</button></td>".
                "</tr>".
                "<tr class='collapse' id='detalhes-".$venda["venda_cod"]."'>".
                    "<td colspan='6'>".$detalhesVenda."</td>".
                "</tr>";
        }
    
        $totalizadores = "<tr><td colspan='2'><strong>Total de Vendas: </strong>{$totalVendas}</td><td colspan='4'><strong>Valor Total: </strong>R$ ". number_format($totalValor, 2, ',', '.') ."</td></tr>";
    
        return $totalizadores . $relatorio;
    }

    public function botoesBaixarRelatorio(){
        $botoes = "";
    
        $botoes .=
            "<div class='d-flex justify-content-center align-items-center'>".
                    "<form method='post' action='../processamento/processamentoBaixarJson.php'>".
                        "<input type='hidden' name='acao' value='baixarCsv'>".
                        "<button type='submit' id='downloadCsv' class='btn btn-primary mx-2'>Ver CSV</button>".
                    "</form>".
    
                    "<form method='post' action='../processamento/processamentoBaixarJson.php'>".
                        "<input type='hidden' name='acao' value='baixarJson'>".
                        "<button type='submit' id='downloadJson' class='btn btn-secondary mx-2'>Ver JSON</button>".
                    "</form>".
            "</div>";
    
        return $botoes;
    }

    public function gerarRelatoioJson(){
        $jsonData = "";

        if ($this->bancoDeDados->gerarJsonRelatorioVendas()) {
            echo "Relatorio Gerado com sucesso!";
            
        } else {
            echo "Falha ao gerar relatorio";
        }

    }

    public function gerarCsvRelatorioVendas() {
        $jsonData = $this->bancoDeDados->gerarJsonRelatorioVendas();
        $adapter = new JsonToCsvAdapter($jsonData);    
        try {
            $adapter->saveCsvToFile();
            return 'Arquivo CSV gerado/atualizado com sucesso.';
        } catch (Exception $e) {
            return 'Erro: ' . $e->getMessage();
        }
    }

    public function exibirQuantidadeCarrinho(){
        $input = "";
        $usuarioLogado =  SessionManager::get("cod");
        $quantidade = $this->bancoDeDados->retornarQuantidadeCarrinho($usuarioLogado);
        $quantidade = mysqli_fetch_assoc($quantidade);

        $input .=
                "<form id='quantidadeForm' method='post' action=''>".
                    "<input type='hidden' name='quantidadeCarrinhoBanco' value='" . $quantidade["total_produtos"] ."'>".
                "</form>";

    return $input;

    }
    
}

?>