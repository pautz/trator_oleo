-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 03/04/2025 às 20:36
-- Versão do servidor: 10.11.10-MariaDB-log
-- Versão do PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `u839226731_meutrator`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadastro_produto`
--

CREATE TABLE `cadastro_produto` (
  `nome` text NOT NULL,
  `valor` text NOT NULL,
  `quantidade` text NOT NULL,
  `total` text NOT NULL,
  `id` int(11) NOT NULL,
  `imagem` text NOT NULL,
  `url_buy` text NOT NULL,
  `categoria` text NOT NULL,
  `idtrator` text NOT NULL,
  `eq_user` text NOT NULL,
  `leilao` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `cadastro_produto`
--

INSERT INTO `cadastro_produto` (`nome`, `valor`, `quantidade`, `total`, `id`, `imagem`, `url_buy`, `categoria`, `idtrator`, `eq_user`, `leilao`) VALUES
('Trator Valtra BM125', '182000', '0', '', 86, '', 'https://api.whatsapp.com/send?phone=5555996479747', 'tratores', '04154652060', 'pofft', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `imagens_produto`
--

CREATE TABLE `imagens_produto` (
  `id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `imagem` varchar(500) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `data_upload` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `imagens_produto`
--

INSERT INTO `imagens_produto` (`id`, `produto_id`, `imagem`, `descricao`, `data_upload`) VALUES
(11, 86, 'https://carlitoslocacoes.com/site3/cadastro_produto/up/tratorbutton.png', NULL, '2025-04-03 12:59:48');

-- --------------------------------------------------------

--
-- Estrutura para tabela `oil_levels`
--

CREATE TABLE `oil_levels` (
  `id` int(11) NOT NULL,
  `boat_id` varchar(255) DEFAULT NULL,
  `oil_level` decimal(10,2) DEFAULT NULL,
  `next_change` date DEFAULT NULL,
  `registration_date` timestamp NULL DEFAULT current_timestamp(),
  `next_change_value` decimal(10,2) DEFAULT NULL,
  `whatsapp_number` varchar(15) NOT NULL,
  `cv` varchar(255) DEFAULT NULL,
  `eq_user` text NOT NULL,
  `payment_status` enum('Pago','Não Pago') DEFAULT 'Não Pago',
  `paymentstatus` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `oil_levels`
--

INSERT INTO `oil_levels` (`id`, `boat_id`, `oil_level`, `next_change`, `registration_date`, `next_change_value`, `whatsapp_number`, `cv`, `eq_user`, `payment_status`, `paymentstatus`) VALUES
(29, '321', 500.00, '2025-02-13', '2025-03-26 12:28:38', 6000.00, '+55559964749747', '201722025', '', 'Não Pago', ''),
(30, '321', 4000.00, '2025-03-29', '2025-03-26 12:31:13', 6000.00, '+5555996479747', '201722026', '', 'Não Pago', ''),
(74, '201722087', 70.00, '2025-03-29', '2025-03-29 22:43:42', 70.00, '+55996479747', '04154652060', 'admin', 'Não Pago', 'Pago'),
(78, '201722085', 70.00, '2025-04-29', '2025-03-30 12:35:42', 70.00, '+55996129682', '04154652060', 'admin', 'Não Pago', 'Pago'),
(81, '201722202', 20000.00, '2025-05-01', '2025-04-01 15:03:59', 22000.00, '+55996479747', '201721424', 'admin', 'Não Pago', 'Pago'),
(82, '201722203', 20000.00, '2025-04-01', '2025-04-01 15:18:16', 22000.00, '+5555996129682', '201721424', 'admin', 'Não Pago', 'Pago'),
(83, '201722204', 500.00, '2025-04-12', '2025-04-01 15:37:37', 600.00, '55', '201721424', 'admin', 'Não Pago', 'Não Pago'),
(89, '201722213', 188000.00, '2025-05-01', '2025-04-01 20:40:01', 188000.00, '+55996129682', '201721424', 'pofft', 'Não Pago', 'Pago');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pagamentos`
--

CREATE TABLE `pagamentos` (
  `id` int(11) NOT NULL,
  `resposta_id` int(11) NOT NULL,
  `status_pagamento` varchar(50) NOT NULL,
  `data_pagamento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `produto_id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `url_buy` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`produto_id`, `nome`, `valor`, `quantidade`, `url_buy`) VALUES
(1, '1', 1.00, 1, 'https://instagram.com/marianegartner');

-- --------------------------------------------------------

--
-- Estrutura para tabela `radioterapia_cobalto_nic`
--

CREATE TABLE `radioterapia_cobalto_nic` (
  `id` int(11) NOT NULL,
  `eletrons` int(11) NOT NULL,
  `protons` int(11) NOT NULL,
  `neutrons` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `radioterapia_cobalto_nic`
--

INSERT INTO `radioterapia_cobalto_nic` (`id`, `eletrons`, `protons`, `neutrons`) VALUES
(1, 60, 60, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `registrointerno`
--

CREATE TABLE `registrointerno` (
  `id` int(11) NOT NULL,
  `tabela_editada` varchar(255) DEFAULT NULL,
  `id_registro_editado` int(11) DEFAULT NULL,
  `coluna_editada` varchar(255) DEFAULT NULL,
  `valor_antigo` varchar(255) DEFAULT NULL,
  `valor_novo` varchar(255) DEFAULT NULL,
  `usuario_que_editou` varchar(255) DEFAULT NULL,
  `data_hora_edicao` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `registrointerno`
--

INSERT INTO `registrointerno` (`id`, `tabela_editada`, `id_registro_editado`, `coluna_editada`, `valor_antigo`, `valor_novo`, `usuario_que_editou`, `data_hora_edicao`) VALUES
(1, 'oil_levels', 201722212, 'next_change_value', '128400.00', '129000.00', 'pofft', '2025-04-01 19:37:02');

-- --------------------------------------------------------

--
-- Estrutura para tabela `registrointerno2`
--

CREATE TABLE `registrointerno2` (
  `id` int(11) NOT NULL,
  `tabela_editada` varchar(255) NOT NULL,
  `id_registro_editado` int(11) NOT NULL,
  `coluna_editada` varchar(255) NOT NULL,
  `valor_antigo` varchar(255) NOT NULL,
  `valor_novo` varchar(255) NOT NULL,
  `usuario_que_editou` varchar(255) NOT NULL,
  `data_hora_edicao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `respostas`
--

CREATE TABLE `respostas` (
  `tipo` varchar(255) DEFAULT NULL,
  `modelo` text NOT NULL,
  `cv` varchar(20) NOT NULL,
  `ano` int(11) NOT NULL,
  `placa` text NOT NULL,
  `estado` text NOT NULL,
  `cidade` text NOT NULL,
  `eq_user` text NOT NULL,
  `telefone` char(20) NOT NULL,
  `id` int(11) NOT NULL,
  `fotos1` text NOT NULL,
  `link` text NOT NULL,
  `preco_total` text NOT NULL,
  `tyus` text NOT NULL,
  `linkiframe` text NOT NULL,
  `linkGIT` text NOT NULL,
  `qrcodelink` text NOT NULL,
  `novo_creditos` text NOT NULL,
  `ultimo_desconto` text NOT NULL,
  `creditos` text NOT NULL,
  `longitude` text NOT NULL,
  `latitude` text NOT NULL,
  `url_buy` text NOT NULL,
  `data` text NOT NULL,
  `locationStatus` text NOT NULL,
  `youtubelink` text NOT NULL,
  `qrcode` text NOT NULL,
  `status_pagamento` enum('Pago','Não Pago') DEFAULT 'Não Pago',
  `data_pagamento` date NOT NULL,
  `nova_data_pagamento` date DEFAULT NULL,
  `novo_status_pagamento` varchar(50) DEFAULT NULL,
  `quantidade` text NOT NULL,
  `descricao` text DEFAULT NULL,
  `oil_level` decimal(10,2) DEFAULT NULL,
  `nome_recebedor` varchar(255) NOT NULL,
  `cidade_recebedor` varchar(255) NOT NULL,
  `caixa` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `respostas`
--

INSERT INTO `respostas` (`tipo`, `modelo`, `cv`, `ano`, `placa`, `estado`, `cidade`, `eq_user`, `telefone`, `id`, `fotos1`, `link`, `preco_total`, `tyus`, `linkiframe`, `linkGIT`, `qrcodelink`, `novo_creditos`, `ultimo_desconto`, `creditos`, `longitude`, `latitude`, `url_buy`, `data`, `locationStatus`, `youtubelink`, `qrcode`, `status_pagamento`, `data_pagamento`, `nova_data_pagamento`, `novo_status_pagamento`, `quantidade`, `descricao`, `oil_level`, `nome_recebedor`, `cidade_recebedor`, `caixa`) VALUES
('1', '', '', 0, '', '', '', '', '', 201722092, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Não Pago', '0000-00-00', NULL, NULL, '1', '5', NULL, '', '', ''),
('teste1', '', '', 0, '', '', '', '', '', 201722093, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Não Pago', '0000-00-00', NULL, NULL, '1', '124', NULL, '', '', ''),
('tse', '', '', 0, '', '', '', '', '', 201722094, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Não Pago', '0000-00-00', NULL, NULL, '1', '2131', NULL, '', '', ''),
('teste1', '', '', 0, '', '', '', '', '', 201722096, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Não Pago', '0000-00-00', NULL, NULL, '2', '124', NULL, '', '', ''),
('teste1', '', '', 0, '', '', '', '', '', 201722097, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Não Pago', '0000-00-00', NULL, NULL, '2', '124', NULL, '', '', ''),
('teste1', '', '', 0, '', '', '', '', '', 201722098, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Não Pago', '0000-00-00', NULL, NULL, '5', '124', NULL, '', '', ''),
('37423742', '', '', 0, '', '', '', '', '', 201722109, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Não Pago', '0000-00-00', NULL, NULL, '1', '11', NULL, '', '', '1'),
('37423742', '', '', 0, '', '', '', '', '', 201722110, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Não Pago', '0000-00-00', NULL, NULL, '2', '11', NULL, '', '', '1'),
('37423742', '', '04154652060', 0, '', '', '', 'admin', '', 201722116, '', '', '', '', '', '', '', '', '2025-04-01', '-1', '', '', '', '', '', '', 'https://carlitoslocacoes.com/binanceiota.jpg', 'Não Pago', '0000-00-00', NULL, NULL, '', '5', NULL, 'Carlito Veeck Pautz Junior', 'Panambi', ''),
('37423742', '', '04154652060', 0, '', '', '', 'admin', '', 201722117, '', '', '', '', '', '', '', '', '2025-04-01', '-1', '', '', '', '', '', '', 'https://carlitoslocacoes.com/binanceiota.jpg', 'Não Pago', '0000-00-00', NULL, NULL, '', '5', NULL, 'Carlito Veeck Pautz Junior', 'Panambi', ''),
('37423742', '', '04154652060', 0, '', '', '', 'admin', '', 201722118, '', '', '', '', '', '', '', '', '2025-04-01', '-1', '', '', '', '', '', '', 'https://carlitoslocacoes.com/binanceiota.jpg', 'Não Pago', '0000-00-00', NULL, NULL, '', '5', NULL, 'Carlito Veeck Pautz Junior', 'Panambi', ''),
('37423742', '', '04154652060', 0, '', '', '', 'admin', '', 201722119, '', '', '', '', '', '', '', '', '2025-04-01', '-1', '', '', '', '', '', '', 'https://carlitoslocacoes.com/binanceiota.jpg', 'Não Pago', '0000-00-00', NULL, NULL, '', '5', NULL, 'Carlito Veeck Pautz Junior', 'Panambi', ''),
('37423742', '', '04154652060', 0, '', '', '', 'admin', '', 201722120, '', '', '', '', '', '', '', '', '2025-04-01', '-1', '', '', '', '', '', '', 'https://carlitoslocacoes.com/binanceiota.jpg', 'Não Pago', '0000-00-00', NULL, NULL, '', '5', NULL, 'Carlito Veeck Pautz Junior', 'Panambi', ''),
('37423742', '', '04154652060', 0, '', '', '', 'admin', '', 201722122, '', '', '', '', '', '', '', '', '2025-04-01', '-1', '', '', '', '', '', '', '', 'Não Pago', '0000-00-00', NULL, NULL, '3', '5', NULL, '', '', '1'),
('37413741', '', '04154652060', 0, '', '', '', 'pofft', '', 201722163, '', '', '', '', '', '', '', '', '2025-04-03', '-1', '', '', '', '', '', '', '', 'Não Pago', '0000-00-00', NULL, NULL, '1', '11', NULL, '', '', '0'),
('56465466', '', '12', 0, '', '', '', 'pofft', '', 201722165, '', '', '', '', '', '', '', '', '2025-04-03', '-1', '', '', '', '', '', '', '', 'Não Pago', '0000-00-00', NULL, NULL, '1', '56', NULL, '', '', '0'),
('56465466', '', '12', 0, '', '', '', 'pofft', '', 201722166, '', '', '', '', '', '', '', '', '2025-04-03', '-1', '', '', '', '', '', '', '', 'Não Pago', '0000-00-00', NULL, NULL, '1', '56', NULL, '', '', '0'),
('56465466', '', '12', 0, '', '', '', 'pofft', '', 201722167, '', '', '', '', '', '', '', '', '2025-04-03', '-1', '', '', '', '', '', '', '', 'Não Pago', '0000-00-00', NULL, NULL, '1', '56', NULL, '', '', '0'),
('56465466', '', '12', 0, '', '', '', 'pofft', '', 201722168, '', '', '', '', '', '', '', '', '2025-04-03', '-1', '', '', '', '', '', '', '', 'Não Pago', '0000-00-00', NULL, NULL, '1', '56', NULL, 'Amendoim', '', '0'),
('56465466', '', '12', 0, '', '', '', 'pofft', '', 201722169, '', '', '', '', '', '', '', '', '2025-04-03', '-1', '', '', '', '', '', '', '', 'Não Pago', '0000-00-00', NULL, NULL, '1', '56', NULL, 'Amendoim', '', '0'),
('56465466', '', '12', 0, '', '', '', 'pofft', '', 201722170, '', '', '', '', '', '', '', '', '2025-04-03', '-1', '', '', '', '', '', '', '', 'Não Pago', '0000-00-00', NULL, NULL, '6', '56', NULL, 'Amendoim', '', '0'),
('56465466', '', '12', 0, '', '', '', 'pofft', '', 201722171, '', '', '', '', '', '', '', '', '2025-04-03', '-1', '', '', '', '', '', '', '', 'Não Pago', '0000-00-00', NULL, NULL, '5', '56', NULL, 'Amendoim', '', '0'),
('56465466', '', '12', 0, '', '', '', 'pofft', '', 201722172, '', '', '', '', '', '', '', '', '2025-04-03', '-1', '', '', '', '', '', '', '', 'Não Pago', '0000-00-00', NULL, NULL, '1', '56', NULL, 'Amendoim', '', '0'),
('231323', '', '04154652060', 0, '', '', '', 'pofft', '', 201722174, '', '', '', '', '', '', '', '', '2025-04-03', '-1', '', '', '', '', '', '', '', 'Não Pago', '0000-00-00', NULL, NULL, '1', '15', NULL, 'Colgate', '', '0'),
('37413741', '', '04154652060', 0, '', '', '', 'pofft', '', 201722176, '', '', '', '', '', '', '', '', '2025-04-03', '-1', '', '', '', '', '', '', '', 'Não Pago', '0000-00-00', NULL, NULL, '1', '11', NULL, '', '', '0'),
('37413741', '', '04154652060', 0, '', '', '', 'pofft', '', 201722178, '', '', '', '', '', '', '', '', '2025-04-03', '-1', '', '', '', '', '', '', '', 'Não Pago', '0000-00-00', NULL, NULL, '1', '11', NULL, '', '', '0'),
('1245', '', '1', 0, '', '', '', 'pofft', '', 201722193, '', '', '', '', '', '', '', '', '2025-04-03', '-1', '', '', '', '', '', '', '', 'Não Pago', '0000-00-00', NULL, NULL, '2', '0', NULL, '0', '', '0'),
('37423742', '', '04154652060', 0, '', '', '', 'pofft', '', 201722197, '', '', '', '', '', '', '', '', '2025-04-03', '-1', '', '', '', '', '', '', 'https://carlitoslocacoes.com/binanceiota.jpg', 'Não Pago', '0000-00-00', NULL, NULL, '', '0', NULL, '0', '0', ''),
('565654', '', '04154652060', 0, '', '', '', 'pofft', '', 201722199, '', '', '', '', '', '', '', '', '2025-04-03', '-1', '', '', '', '', '', '', '0', 'Não Pago', '0000-00-00', NULL, NULL, '', '5', NULL, '0', '0', ''),
(NULL, '', '201721424', 0, '', '', '', 'admin', '', 201722207, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 'Não Pago', '0000-00-00', NULL, NULL, '', '0', NULL, '0', '0', ''),
(NULL, '', '04154652060', 0, '', '', '', 'admin', '', 201722208, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 'Não Pago', '0000-00-00', NULL, NULL, '', '0', NULL, '0', '0', ''),
(NULL, '', '040896', 0, '', '', '', 'pofft', '', 201722215, '', '', '', '', '', '', '', '', '2025-04-03', '-1', '', '', '', '', '', '', '0', 'Não Pago', '0000-00-00', NULL, NULL, '', '0', NULL, '0', '0', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `respostas2`
--

CREATE TABLE `respostas2` (
  `tipo` char(140) NOT NULL,
  `modelo` text NOT NULL,
  `cv` varchar(20) NOT NULL,
  `ano` int(11) NOT NULL,
  `placa` text NOT NULL,
  `estado` text NOT NULL,
  `cidade` text NOT NULL,
  `eq_user` text NOT NULL,
  `telefone` char(20) NOT NULL,
  `id` int(11) NOT NULL,
  `fotos1` text NOT NULL,
  `link` text NOT NULL,
  `preco_total` text NOT NULL,
  `tyus` text NOT NULL,
  `linkiframe` text NOT NULL,
  `linkGIT` text NOT NULL,
  `qrcodelink` text NOT NULL,
  `novo_creditos` text NOT NULL,
  `ultimo_desconto` text NOT NULL,
  `creditos` text NOT NULL,
  `longitude` text NOT NULL,
  `latitude` text NOT NULL,
  `url_buy` text NOT NULL,
  `data` text NOT NULL,
  `locationStatus` text NOT NULL,
  `youtubelink` text NOT NULL,
  `qrcode` text NOT NULL,
  `status_pagamento` enum('Pago','Não Pago') DEFAULT 'Não Pago',
  `data_pagamento` date NOT NULL,
  `nova_data_pagamento` date DEFAULT NULL,
  `novo_status_pagamento` varchar(50) DEFAULT NULL,
  `caixa` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `respostas2`
--

INSERT INTO `respostas2` (`tipo`, `modelo`, `cv`, `ano`, `placa`, `estado`, `cidade`, `eq_user`, `telefone`, `id`, `fotos1`, `link`, `preco_total`, `tyus`, `linkiframe`, `linkGIT`, `qrcodelink`, `novo_creditos`, `ultimo_desconto`, `creditos`, `longitude`, `latitude`, `url_buy`, `data`, `locationStatus`, `youtubelink`, `qrcode`, `status_pagamento`, `data_pagamento`, `nova_data_pagamento`, `novo_status_pagamento`, `caixa`) VALUES
('teste', '', '321', 0, '', '', '', '', '', 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Não Pago', '0000-00-00', NULL, NULL, ''),
('Carlito Veeck Pautz Júnior', '', '04154652060', 0, '', '', '', '', '', 2, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Não Pago', '0000-00-00', NULL, NULL, ''),
('teste', '', '04154652060', 0, '', '', '', '', '', 3, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Não Pago', '0000-00-00', NULL, NULL, ''),
('Blá blá blá', '', '201721424', 0, '', '', '', '', '', 4, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Não Pago', '0000-00-00', NULL, NULL, ''),
('Carlito, Primavera do Leste, MT, Brasil, +5555996479747', '', '201721421', 0, '', '', '', '', '', 5, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Não Pago', '0000-00-00', NULL, NULL, ''),
('Alo', '', 'Opa', 0, '', '', '', '', '', 6, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Não Pago', '0000-00-00', NULL, NULL, ''),
('Primavera do Leste, Mato grosso, Brasil.', '', 'carlito', 0, '', '', '', '', '', 7, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Não Pago', '0000-00-00', NULL, NULL, ''),
('Laboratório de Software', '', '040896', 0, '', '', '', '', '', 8, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Não Pago', '0000-00-00', NULL, NULL, ''),
('teste oil', '', '201721424', 0, '', '', '', '', '', 9, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Não Pago', '0000-00-00', NULL, NULL, ''),
('Trator BM125', '', '3535', 0, '', '', '', '', '', 10, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Não Pago', '0000-00-00', NULL, NULL, ''),
('trator', '', '3366', 0, '', '', '', '', '', 11, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Não Pago', '0000-00-00', NULL, NULL, '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `respostas3`
--

CREATE TABLE `respostas3` (
  `tipo` char(140) NOT NULL,
  `modelo` text NOT NULL,
  `cv` varchar(20) NOT NULL,
  `ano` int(11) NOT NULL,
  `placa` text NOT NULL,
  `estado` text NOT NULL,
  `cidade` text NOT NULL,
  `eq_user` text NOT NULL,
  `telefone` char(20) NOT NULL,
  `id` int(11) NOT NULL,
  `fotos1` text NOT NULL,
  `link` text NOT NULL,
  `preco_total` text NOT NULL,
  `tyus` text NOT NULL,
  `linkiframe` text NOT NULL,
  `linkGIT` text NOT NULL,
  `qrcodelink` text NOT NULL,
  `novo_creditos` text NOT NULL,
  `ultimo_desconto` text NOT NULL,
  `creditos` text NOT NULL,
  `longitude` text NOT NULL,
  `latitude` text NOT NULL,
  `url_buy` text NOT NULL,
  `data` text NOT NULL,
  `locationStatus` text NOT NULL,
  `youtubelink` text NOT NULL,
  `qrcode` text NOT NULL,
  `status_pagamento` enum('Pago','Não Pago') DEFAULT 'Não Pago',
  `data_pagamento` date NOT NULL,
  `nova_data_pagamento` date DEFAULT NULL,
  `novo_status_pagamento` varchar(50) DEFAULT NULL,
  `caixa` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `trator_oleo`
--

CREATE TABLE `trator_oleo` (
  `id` int(11) NOT NULL,
  `boat_id` varchar(255) NOT NULL,
  `cv` varchar(255) NOT NULL,
  `oil_level` varchar(255) NOT NULL,
  `next_change` varchar(255) NOT NULL,
  `next_change_value` varchar(255) NOT NULL,
  `whatsapp_number` varchar(15) NOT NULL,
  `eq_user` varchar(255) NOT NULL,
  `paymentstatus` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `trator_oleo`
--

INSERT INTO `trator_oleo` (`id`, `boat_id`, `cv`, `oil_level`, `next_change`, `next_change_value`, `whatsapp_number`, `eq_user`, `paymentstatus`) VALUES
(1, '4', '201721424', '500', '2025-05-03', '600', '+55996479747', 'pofft', 'Pago');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(3, 'carlitopautz', '$2y$10$ABRy8vsyF6yYJQN4Tl7UueE.aMPSjdbOcOEm.FQuN.RSLkmtHavom'),
(6, 'CARLITO PAUTZ', '$2y$10$U71ZMhUivYobabaZ4TewX.4oKfuo6xLFO8MlF1iiEYLi7eeNzXMSG'),
(7, 'pcar', '$2y$10$8qIT1PUv/uAqZG1rQLoYU.Q5tMUnVYQWiRWUedbtuhMEGV7oVXob.'),
(8, 'elanadara', '$2y$10$zJfYnNkulsFXZuTK3eVxBe5S8oNmOr11UwE4Rfy6ZziKGUnhPBYwm'),
(9, 'carlitoslocacoes', '$2y$10$ABRy8vsyF6yYJQN4Tl7UueE.aMPSjdbOcOEm.FQuN.RSLkmtHavom'),
(10, '201721424', '$2y$10$Gpgjdx10tD28gvqSaeu9hOxF3RFlocy8e7co3aPNb2OAlXQJiEebm'),
(11, 'tibia', '$2y$10$vgLWHG5AvzKK2ltSICeAeOy9s.sc4JUfRfHdyiKWsS/yAgewRtrfy'),
(12, 'pofft', '$2y$10$9S3.qjRne9KF7QWWoW1BWOp78OjXkwz1lahEvZf.aws.DVAL.FbE.'),
(13, 'carl', '$2y$10$EJLQJ4icWzNaGYlCTDdnAeVCVlr8w09lyvMkMVshj5ags2RkJfuWW'),
(14, 'Tst', '$2y$10$OfVP.jtDW1gjPsX9pTK6XeU4vSt.3hvrMiCsWPh/B.ZJkslv0O3hO'),
(15, 'Bom', '$2y$10$EJLQJ4icWzNaGYlCTDdnAeVCVlr8w09lyvMkMVshj5ags2RkJfuWW'),
(16, 'anfyienaklea@yahoo.com', '$2y$10$VxW52b9K9Z/BdTob4OZuv.mEdWaTUT/2g/xKFAzfGQh8SVOKDFad2'),
(17, 'Selena', '$2y$10$4MMb9hImQGjGkBtnkJjSueAjjxofvnHhrSlleYq0ExBeNR1Xv343e'),
(18, 'iota', '$2y$10$HSJP47xZ2qz53bqVCP9Rlun/U0LSwZwvP6RDSUYXlSt7q2fSTGLbO'),
(19, 'logar', '$2y$10$J4TZyiBivWr4oA76aI88Pu.6aswkKYbe2Xju.I50eblpRg7P2qL4m'),
(20, 'ehirojek657@gmail.com', '$2y$10$cQaedHPXnxK8VFUF0.5Q7.8OP7XP/dLCFBBKicGuRlKp36vmGlzFS'),
(21, 'gsiguerdox81@gmail.com', '$2y$10$uReP9V1h5S8k.BAiYpuTbe/X7c0UcJIUZ5J60x2DO1oHpr3Zh4ZrG'),
(22, 'cranerovana6@gmail.com', '$2y$10$31dFRSLiSoenupd4QyHbcO4Qxc2U5WqwSzWgVfffcRZFce3l7HP/e'),
(23, 'admin', '$2y$10$rsb6AR0W49uHlLAyHQWw1.4/Ttdedv6oD22RMvCbbDIqVaHG7m8Se'),
(24, 'murphy_becky815328@yahoo.com', '$2y$10$Le89cBl2RUP7dD/0M921Qu6117lOheEWcq2PLPM6KZH80.rEEM68S'),
(25, 'txt', '$2y$10$7wnQwCgHMI6aPepJ93w.V.1n9FlGE1R/ZfdJSBlke25qRl9DqFgb2');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cadastro_produto`
--
ALTER TABLE `cadastro_produto`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `imagens_produto`
--
ALTER TABLE `imagens_produto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- Índices de tabela `oil_levels`
--
ALTER TABLE `oil_levels`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resposta_id` (`resposta_id`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`produto_id`);

--
-- Índices de tabela `radioterapia_cobalto_nic`
--
ALTER TABLE `radioterapia_cobalto_nic`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `registrointerno`
--
ALTER TABLE `registrointerno`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `registrointerno2`
--
ALTER TABLE `registrointerno2`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `respostas`
--
ALTER TABLE `respostas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `respostas2`
--
ALTER TABLE `respostas2`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `respostas3`
--
ALTER TABLE `respostas3`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `trator_oleo`
--
ALTER TABLE `trator_oleo`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cadastro_produto`
--
ALTER TABLE `cadastro_produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT de tabela `imagens_produto`
--
ALTER TABLE `imagens_produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `oil_levels`
--
ALTER TABLE `oil_levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT de tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `produto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `radioterapia_cobalto_nic`
--
ALTER TABLE `radioterapia_cobalto_nic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `registrointerno`
--
ALTER TABLE `registrointerno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `registrointerno2`
--
ALTER TABLE `registrointerno2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `respostas`
--
ALTER TABLE `respostas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201722216;

--
-- AUTO_INCREMENT de tabela `respostas2`
--
ALTER TABLE `respostas2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `respostas3`
--
ALTER TABLE `respostas3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `trator_oleo`
--
ALTER TABLE `trator_oleo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `imagens_produto`
--
ALTER TABLE `imagens_produto`
  ADD CONSTRAINT `imagens_produto_ibfk_1` FOREIGN KEY (`produto_id`) REFERENCES `cadastro_produto` (`id`);

--
-- Restrições para tabelas `pagamentos`
--
ALTER TABLE `pagamentos`
  ADD CONSTRAINT `pagamentos_ibfk_1` FOREIGN KEY (`resposta_id`) REFERENCES `respostas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
