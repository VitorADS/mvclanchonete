-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30-Mar-2022 às 01:30
-- Versão do servidor: 8.0.28
-- versão do PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `lanchonete_mvc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `comidas`
--

CREATE TABLE `comidas` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `comidas`
--

INSERT INTO `comidas` (`id`, `name`, `price`) VALUES
(2, 'Agua S/ Gas', 2.99),
(3, 'Pepsi 350ml', 4.99),
(4, 'Risolis de Carne', 3.5),
(5, 'Risolis de Queijo', 4.5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int NOT NULL,
  `nomeCliente` varchar(100) NOT NULL,
  `numeroPedido` int NOT NULL,
  `statusPedido` varchar(50) NOT NULL,
  `data` datetime NOT NULL,
  `total` float DEFAULT NULL,
  `user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `nomeCliente`, `numeroPedido`, `statusPedido`, `data`, `total`, `user`) VALUES
(1, 'Teste', 5992, 'Enviado', '2022-03-29 20:18:57', 18.95, 1),
(2, 'Outro Teste', 4509, 'Novo', '2022-03-29 20:21:08', 8.97, 1),
(3, 'Teste', 6466, 'Novo', '2022-03-29 20:30:23', 5.98, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos_comida`
--

CREATE TABLE `pedidos_comida` (
  `id` int NOT NULL,
  `idPedido` int NOT NULL,
  `idComida` int NOT NULL,
  `quantidade` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `pedidos_comida`
--

INSERT INTO `pedidos_comida` (`id`, `idPedido`, `idComida`, `quantidade`) VALUES
(1, 5992, 2, 3),
(2, 5992, 3, 2),
(3, 4509, 2, 3),
(4, 6466, 2, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(350) NOT NULL,
  `token` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `firstLogin` tinyint(1) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `token`, `firstLogin`, `admin`) VALUES
(1, 'Vitor', '$2y$10$x8nuSVJ6dr6OdWQUZNkejeGYo9DB64Xm.3NbPyar9p/luOBuUkDuW', 'b09b7ac3df17cc7285f1689528589f6e', 0, 1),
(2, 'Pedro', '$2y$10$JjRYUTka6T3kmekJlca2TOdm5VOXyJvTEys8czNoRGGdhfljDjKJ2', '45d0c0a1a7ef8112b8ae09425af0def5', 0, 1),
(3, 'Lucas', '$2y$10$ALzRtj.BhElEYcenr3nVsuFRfcExWrbLl1cSegYNj1T.85C4r1i5.', '333744cb0118c9bda67b87bd80a84fe7', 0, 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `comidas`
--
ALTER TABLE `comidas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pedidos_comida`
--
ALTER TABLE `pedidos_comida`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `comidas`
--
ALTER TABLE `comidas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `pedidos_comida`
--
ALTER TABLE `pedidos_comida`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
