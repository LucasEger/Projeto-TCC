-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 09/11/2024 às 16:36
-- Versão do servidor: 8.3.0
-- Versão do PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projeto_tcc`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `baixa`
--

DROP TABLE IF EXISTS `baixa`;
CREATE TABLE IF NOT EXISTS `baixa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int DEFAULT NULL,
  `id_produto` int DEFAULT NULL,
  `data_hora` datetime DEFAULT NULL,
  `quantidade` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_produto` (`id_produto`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `baixa`
--

INSERT INTO `baixa` (`id`, `id_usuario`, `id_produto`, `data_hora`, `quantidade`) VALUES
(15, 51, 97, '2024-11-08 15:13:36', 2),
(16, 61, 59, '2024-11-08 16:12:40', 10),
(17, 51, 91, '2024-11-08 16:12:52', 5),
(18, 51, 96, '2024-11-08 16:13:01', 12),
(19, 64, 101, '2024-11-08 16:13:12', 2),
(20, 63, 107, '2024-11-08 16:13:29', 24),
(21, 63, 90, '2024-11-08 16:13:43', 7),
(22, 51, 58, '2024-11-09 13:33:42', 10);

-- --------------------------------------------------------

--
-- Estrutura para tabela `login2`
--

DROP TABLE IF EXISTS `login2`;
CREATE TABLE IF NOT EXISTS `login2` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `login2`
--

INSERT INTO `login2` (`id`, `nome`, `email`, `senha`) VALUES
(51, 'Lucas Eger', 'lucas.eger@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(56, 'Rafael Gomes da Silva', 'rafael.gomes@email.com', 'c81e728d9d4c2f636f067f89cc14862c'),
(61, 'Ana Clara Silva', 'anaclara.silva@email.com', 'eccbc87e4b5ce2fe28308fd9f2a7baf3'),
(62, 'Pedro Henrique ', 'pedro.h.lima@email.com', 'a87ff679a2f3e71d9181a67b7542122c'),
(63, 'Larissa Costa', 'larissa.costa@email.com', 'e4da3b7fbbce2345d7772b0674a318d5'),
(64, 'Gustavo Almeida', 'gustavo.almeida@email.com', 'e8d95a51f3af4a3b134bf6bb680a213a');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `validade` date NOT NULL,
  `quantidade` int NOT NULL,
  `peso` decimal(10,3) NOT NULL,
  `preco_venda` decimal(10,2) DEFAULT NULL,
  `custo` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `validade`, `quantidade`, `peso`, `preco_venda`, `custo`) VALUES
(55, 'Creme de Leite', '2025-08-10', 100, 0.200, 5.00, 4.00),
(56, 'Queijo Mussarela', '2025-06-30', 140, 0.500, 5.00, 4.00),
(57, 'Sardinha em Lata', '2027-09-15', 119, 0.300, 5.00, 4.00),
(58, 'Cenoura', '2025-06-28', 45, 0.400, 5.00, 4.00),
(59, 'Batata Inglesa', '2025-08-31', 85, 0.500, 5.00, 4.00),
(90, 'Arroz', '2024-11-22', 144, 5.000, 4.12, 3.80),
(91, 'Feijão', '2024-12-01', 115, 2.500, 3.80, 3.50),
(92, 'Açúcar', '2024-11-30', 200, 3.200, 2.50, 2.00),
(93, 'Macarrão', '2025-01-15', 175, 1.800, 3.00, 2.70),
(94, 'Óleo', '2024-11-18', 80, 0.900, 5.50, 4.50),
(95, 'Café', '2024-11-20', 50, 0.500, 6.00, 5.50),
(96, 'Farinha', '2024-12-05', 88, 2.000, 2.80, 2.40),
(97, 'Sal', '2025-02-10', 298, 1.500, 1.20, 1.00),
(98, 'Macarrão Instantâneo', '2024-11-12', 150, 0.250, 2.00, 1.80),
(99, 'Leite', '2024-11-28', 100, 1.000, 3.50, 2.90),
(100, 'Queijo', '2024-11-25', 60, 0.700, 7.00, 6.00),
(101, 'Presunto', '2024-12-05', 38, 0.800, 5.50, 4.80),
(102, 'Peixe Congelado', '2025-01-10', 30, 1.000, 15.00, 12.50),
(103, 'Frango', '2024-12-01', 85, 1.200, 10.00, 8.50),
(104, 'Bacon', '2024-12-10', 70, 1.500, 18.00, 15.00),
(105, 'Carne Moída', '2024-12-20', 120, 2.000, 20.00, 16.00),
(106, 'Feijão', '2025-01-15', 100, 2.300, 12.50, 10.50),
(107, 'Morango', '2024-11-30', 16, 0.800, 4.00, 3.30),
(108, 'Vegetal', '2024-11-29', 55, 0.600, 3.50, 3.00),
(109, 'Maçã', '2024-12-01', 90, 0.500, 5.00, 4.50),
(110, 'Leite integral', '2024-11-30', 35, 1.000, 9.80, 8.00),
(111, 'Trigo', '2024-11-15', 10, 1.000, 8.50, 7.00);

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `baixa`
--
ALTER TABLE `baixa`
  ADD CONSTRAINT `baixa_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `login2` (`id`),
  ADD CONSTRAINT `baixa_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
