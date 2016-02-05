-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1build0.15.04.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 04/02/2016 às 15:28
-- Versão do servidor: 5.6.27-0ubuntu0.15.04.1
-- Versão do PHP: 5.6.4-4ubuntu6.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
`usuario_id` int(10) unsigned NOT NULL,
  `usuario_login` varchar(100) NOT NULL,
  `usuario_senha` varchar(255) NOT NULL,
  `usuario_email` varchar(150) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `usuario_login`, `usuario_senha`, `usuario_email`) VALUES
(1, 'admin', '$2y$10$xOfBV7ekclNWfDONuSRgW.lKof7c3yZCxkBM.f1PFzf6MITRATJyy', 'alan_freire@msn.com');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`usuario_id`), ADD UNIQUE KEY `usuario_id_UNIQUE` (`usuario_id`), ADD UNIQUE KEY `usuario_login_UNIQUE` (`usuario_login`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
MODIFY `usuario_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
