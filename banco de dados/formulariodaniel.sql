-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28-Maio-2025 às 22:47
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `formulariodaniel`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `formulariodaniel`
--

CREATE TABLE `formulariodaniel` (
  `id` int(11) NOT NULL,
  `Nome` varchar(45) NOT NULL,
  `sobrenome` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `senha` varchar(200) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `endereco` varchar(200) NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_expira` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `formulariodaniel`
--

INSERT INTO `formulariodaniel` (`id`, `Nome`, `sobrenome`, `email`, `senha`, `telefone`, `endereco`, `reset_token`, `reset_expira`) VALUES
(15, 'Daniel', ' Ferreira Ramalho', 'danikferreira69@gmail.com', '$2y$10$vF7jz17mRRXM44FjYjVqEOisIbQLSwYhTMcGet.bY2b.rSmPbuTY6', '2147483647', 'fsf', 'b63dd7eaa0f5a898a17e9bc5f8ff82f6', '2025-05-28 17:35:46'),
(16, 'Ewerton', 'santos', 'ewertonoliveiramartins@hotmail.com', '$2y$10$zN2dXk/T1rpmf5VGlv1rfebJII8xqWc.JLeUDX1/VqNXjBv7aHauq', '2147483647', 'rua santos', NULL, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `formulariodaniel`
--
ALTER TABLE `formulariodaniel`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `formulariodaniel`
--
ALTER TABLE `formulariodaniel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
