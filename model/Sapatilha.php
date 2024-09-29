<?php
require_once "Produto.php";

class Sapatilha extends Produto {
    private $marca;


    // Construtor
    public function __construct($nome, $fabricante, $descricao, $valor, $imagem, $sexo, $tipo, $tamanho, $material, $marca) {
        parent::__construct($nome, $fabricante, $descricao, $valor, $imagem, $sexo, $tipo, $tamanho, $material,);
        $this->marca = $marca;
    }

    // Métodos getters e setters para os atributos específicos
    public function getMarca() {
        return $this->marca;
    }

    public function setMarca($marca) {
        $this->marca = $marca;
    }

}