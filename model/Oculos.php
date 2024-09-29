<?php
require_once "Produto.php";

class Oculos extends Produto {
    private $cor;

    // Construtor
    public function __construct($nome, $fabricante, $descricao, $valor, $imagem, $sexo,  $tipo, $tamanho, $material, $cor) {
        parent::__construct($nome, $fabricante, $descricao, $valor, $imagem, $sexo, $tamanho, $material, $tipo);
        $this->cor = $cor;
    }

    // Métodos getters e setters para os atributos específicos
    public function getCor() {
        return $this->cor;
    }

    public function setCor($cor) {
        $this->cor = $cor;
    }

}