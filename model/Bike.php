<?php
require_once "Produto.php";

class Bike extends Produto {
    private $quadro;


    // Construtor
    public function __construct($nome, $fabricante, $descricao, $valor, $imagem, $sexo, $tipo, $tamanho, $material, $quadro) {
        parent::__construct($nome, $fabricante, $descricao, $valor, $imagem, $sexo, $tipo, $tamanho, $material,);
        $this->quadro = $quadro;
    }

    // Métodos getters e setters para os atributos específicos
    public function getQuadro() {
        return $this->quadro;
    }

    public function setQuadro($quadro) {
        $this->quadro = $quadro;
    }

}