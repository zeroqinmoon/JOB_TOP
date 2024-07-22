-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 18-Jan-2019 às 20:47
-- Versão do servidor: 10.1.37-MariaDB
-- versão do PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agenda`
--
create Database agenda;
use agenda;
-- --------------------------------------------------------

--
-- Estrutura da tabela `contato`
--

CREATE TABLE `contato` (
  `id` int(11) NOT NULL,
  `nome` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `objetivo` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `contato`
--

INSERT INTO `contato` (`id`, `nome`, `email`, `objetivo`) VALUES
(1, 'Beatriz Souzones', 'beresouzones@gmail.com', 'curriculo'),
(2, 'Murilo Caphiro', 'alenda123sacap@gmail.com', 'Ofertar Vaga'),
(3, 'Alucard Nospheratus', 'draculanospher3402@gmail.com', 'Curriculo'),
(4, 'Miya Gremory', 'duquesagremory@gmail.com', 'Ofertar Vaga');

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin`
--

CREATE TABLE `admins` (
  `nome` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `admin`
--

INSERT INTO `admins` (`nome`, `email`,`senha`) VALUES
('Zero', 'nineyota1@gmail.com', '123456789'),
('Debora', 'debora123git@gmail.com', '123456789'),
('Rodrigo', 'tester123@gmail.com', '123456789');
-- ----------------------------------------------------
--
Create table `usuarios` (
ID Int UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
nome Varchar(30),
email Varchar(30),
senha Varchar(40),
Primary Key (ID)) ENGINE = MyISAM;

-- Indexes for dumped tables
--

--
-- Indexes for table `contato`
--
ALTER TABLE `contato`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contato`
--
ALTER TABLE `contato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
