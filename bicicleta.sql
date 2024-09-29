-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28/09/2024 às 22:45
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bicicleta`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `bike`
--

CREATE TABLE `bike` (
  `cod_bike` int(11) NOT NULL,
  `produto_cod` int(11) NOT NULL,
  `quadro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `cod` int(11) NOT NULL,
  `cliente_cod` int(11) NOT NULL,
  `produto_cod` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

CREATE TABLE `cliente` (
  `cod` int(11) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `sobrenome` varchar(60) NOT NULL,
  `dataNascimento` date NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `endereco`
--

CREATE TABLE `endereco` (
  `cod` int(11) NOT NULL,
  `cod_cliente` int(11) NOT NULL,
  `cep` int(10) NOT NULL,
  `rua` varchar(100) NOT NULL,
  `numero` int(11) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `complemento` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `cod` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(140) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `itensvenda`
--

CREATE TABLE `itensvenda` (
  `cod` int(11) NOT NULL,
  `codVenda` int(11) DEFAULT NULL,
  `codProduto` int(11) DEFAULT NULL,
  `qtd` int(11) DEFAULT NULL,
  `valorUnitario` decimal(10,2) DEFAULT NULL,
  `valorTotal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `oculos`
--

CREATE TABLE `oculos` (
  `cod_oculos` int(11) NOT NULL,
  `produto_cod` int(11) NOT NULL,
  `cor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `nome` varchar(100) NOT NULL,
  `fabricante` varchar(50) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `valor` int(11) NOT NULL,
  `cod` int(11) NOT NULL,
  `imagem_path` varchar(255) DEFAULT NULL,
  `sexo` varchar(40) DEFAULT NULL,
  `tipo` varchar(50) NOT NULL,
  `tamanho` varchar(100) NOT NULL,
  `material` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `sapatilha`
--

CREATE TABLE `sapatilha` (
  `cod_sapatilha` int(11) NOT NULL,
  `produto_cod` int(11) NOT NULL,
  `marca` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas`
--

CREATE TABLE `vendas` (
  `cod` int(11) NOT NULL,
  `cliente_cod` int(11) NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `data_venda` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `bike`
--
ALTER TABLE `bike`
  ADD PRIMARY KEY (`cod_bike`),
  ADD KEY `fk_produto_bike` (`produto_cod`);

--
-- Índices de tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `cliente_cod` (`cliente_cod`),
  ADD KEY `produto_cod` (`produto_cod`);

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cod`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Índices de tabela `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `fk_cod_cliente` (`cod_cliente`);

--
-- Índices de tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`cod`);

--
-- Índices de tabela `itensvenda`
--
ALTER TABLE `itensvenda`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `codVenda` (`codVenda`),
  ADD KEY `codProduto` (`codProduto`);

--
-- Índices de tabela `oculos`
--
ALTER TABLE `oculos`
  ADD PRIMARY KEY (`cod_oculos`),
  ADD KEY `fk_produto_oculos` (`produto_cod`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`cod`);

--
-- Índices de tabela `sapatilha`
--
ALTER TABLE `sapatilha`
  ADD PRIMARY KEY (`cod_sapatilha`),
  ADD KEY `fk_produto_sapatilha` (`produto_cod`);

--
-- Índices de tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `cliente_cod` (`cliente_cod`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `bike`
--
ALTER TABLE `bike`
  MODIFY `cod_bike` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `itensvenda`
--
ALTER TABLE `itensvenda`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `oculos`
--
ALTER TABLE `oculos`
  MODIFY `cod_oculos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de tabela `sapatilha`
--
ALTER TABLE `sapatilha`
  MODIFY `cod_sapatilha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `bike`
--
ALTER TABLE `bike`
  ADD CONSTRAINT `fk_produto_bike` FOREIGN KEY (`produto_cod`) REFERENCES `produto` (`cod`);

--
-- Restrições para tabelas `carrinho`
--
ALTER TABLE `carrinho`
  ADD CONSTRAINT `carrinho_ibfk_1` FOREIGN KEY (`cliente_cod`) REFERENCES `cliente` (`cod`),
  ADD CONSTRAINT `carrinho_ibfk_2` FOREIGN KEY (`produto_cod`) REFERENCES `produto` (`cod`);

--
-- Restrições para tabelas `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `fk_cod_cliente` FOREIGN KEY (`cod_cliente`) REFERENCES `cliente` (`cod`);

--
-- Restrições para tabelas `itensvenda`
--
ALTER TABLE `itensvenda`
  ADD CONSTRAINT `itensvenda_ibfk_1` FOREIGN KEY (`codVenda`) REFERENCES `vendas` (`cod`),
  ADD CONSTRAINT `itensvenda_ibfk_2` FOREIGN KEY (`codProduto`) REFERENCES `produto` (`cod`);

--
-- Restrições para tabelas `oculos`
--
ALTER TABLE `oculos`
  ADD CONSTRAINT `fk_produto_oculos` FOREIGN KEY (`produto_cod`) REFERENCES `produto` (`cod`);

--
-- Restrições para tabelas `sapatilha`
--
ALTER TABLE `sapatilha`
  ADD CONSTRAINT `fk_produto_sapatilha` FOREIGN KEY (`produto_cod`) REFERENCES `produto` (`cod`);

--
-- Restrições para tabelas `vendas`
--
ALTER TABLE `vendas`
  ADD CONSTRAINT `vendas_ibfk_1` FOREIGN KEY (`cliente_cod`) REFERENCES `cliente` (`cod`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
