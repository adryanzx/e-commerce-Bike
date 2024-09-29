<?php

require_once "Bike.php";
require_once "Oculos.php";
require_once "Sapatilha.php";


class FactoryProduto {

    static function factoryMethod($dados) {
        switch ($dados['tipo']) {
            case 'BIKE':
                return new Bike($dados['nome'], $dados['fabricante'], $dados['descricao'], $dados['valor'], $dados['imagem_destino'], $dados['sexo'], $dados['tipo'], $dados['tamanho'], $dados['material'], $dados['quadro']);
                break;
            case 'SAPATILHA':
                return new Sapatilha($dados['nome'], $dados['fabricante'], $dados['descricao'], $dados['valor'], $dados['imagem_destino'], $dados['sexo'], $dados['tipo'], $dados['tamanho'], $dados['material'], $dados['marca']);
                break;
            case 'OCULOS':
                return new Oculos($dados['nome'], $dados['fabricante'], $dados['descricao'], $dados['valor'], $dados['imagem_destino'], $dados['sexo'], $dados['tipo'], $dados['tamanho'], $dados['material'], $dados['cor']);
                break;
            default:
                return null;
        }
    }
}


?>