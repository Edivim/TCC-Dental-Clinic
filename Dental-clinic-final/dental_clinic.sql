-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27/11/2024 às 15:45
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `dental_clinic`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `agendamentos`
--

CREATE TABLE `agendamentos` (
  `id` int(11) NOT NULL,
  `paciente_id` int(11) NOT NULL,
  `dentista_id` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `status` varchar(20) DEFAULT 'ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `agendamentos`
--

INSERT INTO `agendamentos` (`id`, `paciente_id`, `dentista_id`, `data`, `hora`, `status`) VALUES
(14, 7, 2, '2024-11-14', '11:00:00', 'finalizado'),
(16, 9, 1, '2024-11-20', '20:45:00', 'finalizado'),
(17, 11, 2, '2024-11-27', '15:00:00', 'finalizado'),
(19, 8, 1, '2024-11-21', '10:30:00', 'finalizado'),
(21, 7, 1, '2024-11-21', '09:00:00', 'finalizado'),
(22, 9, 1, '2024-11-21', '12:00:00', 'finalizado'),
(23, 7, 2, '2024-11-22', '15:00:00', 'finalizado'),
(24, 7, 1, '2024-11-22', '10:20:00', 'finalizado'),
(25, 7, 1, '2024-11-29', '10:00:00', 'finalizado'),
(26, 9, 2, '2024-11-29', '10:30:00', 'finalizado'),
(29, 13, 1, '2024-11-21', '20:50:00', 'finalizado'),
(30, 11, 1, '2024-11-21', '21:00:00', 'finalizado'),
(31, 15, 1, '2024-11-22', '15:00:00', 'finalizado'),
(35, 9, 2, '2024-11-22', '10:30:00', 'finalizado'),
(37, 15, 2, '2024-11-22', '14:30:00', 'finalizado'),
(38, 7, 1, '2024-11-22', '14:30:00', 'finalizado'),
(39, 9, 2, '2024-11-22', '13:30:00', 'finalizado'),
(42, 15, 1, '2024-11-22', '15:30:00', 'finalizado'),
(44, 16, 2, '2024-11-22', '15:30:00', 'finalizado'),
(46, 9, 2, '2024-11-23', '14:30:00', 'ativo'),
(52, 17, 1, '2024-11-28', '13:30:00', 'finalizado'),
(53, 18, 4, '2024-11-07', '08:30:00', 'finalizado'),
(54, 7, 1, '2024-11-23', '14:30:00', 'ativo'),
(55, 20, 5, '2024-11-26', '16:00:00', 'finalizado'),
(56, 21, 6, '2024-11-30', '16:00:00', 'ativo'),
(57, 22, 7, '2024-11-26', '14:00:00', 'finalizado');

-- --------------------------------------------------------

--
-- Estrutura para tabela `atendimentos`
--

CREATE TABLE `atendimentos` (
  `id` int(11) NOT NULL,
  `agendamento_id` int(11) NOT NULL,
  `procedimentos` text NOT NULL,
  `prescricoes` text NOT NULL,
  `recomendacoes` text NOT NULL,
  `data_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `atendimentos`
--

INSERT INTO `atendimentos` (`id`, `agendamento_id`, `procedimentos`, `prescricoes`, `recomendacoes`, `data_registro`) VALUES
(1, 23, 'Extração dente Ciso', 'Dipirona a cada 8 horas', 'Retornar em 30 dias', '2024-11-20 13:30:26'),
(11, 30, 'Obturação dente ', 'Tomar Dipirona a cada 8h', 'Escovar os dentes', '2024-11-21 11:51:15'),
(12, 31, 'Limpeza', 'Diclofenaco a cada 8 Horas', 'Escovar os dentes', '2024-11-21 11:59:51'),
(14, 37, 'feito extração de um dente', 'Dipirona a cada 8 horas', 'Retornar em 10 dias', '2024-11-22 16:49:48'),
(15, 38, 'teste 01', 'teste 01', 'teste 01', '2024-11-22 23:56:57'),
(16, 42, 'teste 02', 'teste 02', 'teste 02', '2024-11-22 23:57:15'),
(17, 39, 'teste 03', 'teste 03', 'teste 03', '2024-11-22 23:57:36'),
(18, 44, 'teste 04', 'teste 04', 'teste 04', '2024-11-22 23:58:05'),
(19, 52, 'Reitada de siso ', 'Ibuprofeno', 'Descanso', '2024-11-25 13:48:16'),
(20, 53, 'Extração do elemento 46- odontosecção. ', 'Amoxicilina 1comp a cada 8h/8h durante 7 dias; Enxague com clorexidina; ', 'Evitar fumar; beber de canudo. Dieta liquida/pastosa. Retorno após 7 dias para retirada dos pontos. ', '2024-11-25 18:41:17'),
(21, 55, 'endodontia do 26', 'Nimesulida.\r\nDipirona ', 'retornar dia 30', '2024-11-26 17:07:17'),
(22, 57, 'Exodontia elemento 36', 'azitromicina 500mg\r\nibuprofeno 600mg\r\ndipirona 500 mg', 'repouso', '2024-11-26 18:06:36');

-- --------------------------------------------------------

--
-- Estrutura para tabela `consultas`
--

CREATE TABLE `consultas` (
  `id` int(11) NOT NULL,
  `paciente_id` int(11) NOT NULL,
  `dentista_id` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `status` varchar(20) DEFAULT 'pendente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `dentistas`
--

CREATE TABLE `dentistas` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `idade` int(11) NOT NULL,
  `sexo` enum('masculino','feminino','outro') NOT NULL,
  `especialidade` varchar(100) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `dentistas`
--

INSERT INTO `dentistas` (`id`, `nome`, `idade`, `sexo`, `especialidade`, `endereco`, `telefone`, `email`) VALUES
(1, 'Ana Flavia', 18, 'feminino', 'Dentista', 'Rua alfredo lopes de oliveira', '47991145629', 'simonesmenticoviski@hotmail.com'),
(2, 'Leonardo Smenticovski Ayres', 4, 'masculino', 'Dentista', 'Rua Alfredo Lopes de Oliveira 1030', '4791145629', 'deltaeletroinfo@gmail.com'),
(4, 'Karen Furtado de Souza', 20, 'feminino', 'Bucomaxilofacial; endodontista', 'Monte Castelo', '47992057613', 'karenfdesouza2004@gmail.com'),
(5, 'Alexandre Smenticovski Pimentel', 24, 'masculino', 'endodontista; implantodontista ', 'bento gonçalves ', '47992901862', 'alexandre.pimentel16@yahoo.com'),
(6, 'Estefani Gasparetto', 24, 'feminino', 'Protese e Harmonização Orofacial', 'rua bento gonçalves 943 centro', '47991403657', 'estefanigasparetto@gmail.com'),
(7, 'CAROLINA APARECIDA KUBIAK', 24, 'feminino', 'dentistica', 'TEODORO MANGUEROSKI', '49991535082', 'carolinaaparecidakubiak@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `idade` int(11) NOT NULL,
  `sexo` enum('masculino','feminino','outro') NOT NULL,
  `historico_medico` text NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `pacientes`
--

INSERT INTO `pacientes` (`id`, `nome`, `idade`, `sexo`, `historico_medico`, `endereco`, `telefone`, `email`) VALUES
(7, 'Simone Smenticovski', 36, 'feminino', 'Dentes com caries, tortos, e amarelados.', 'Rua Carlos Alberto Meister', '47992329637', 'simonesmenticoviski@hotmail.com'),
(8, 'EDIVIM ARMANDO AYRES', 36, 'masculino', 'Nenhum', 'Rua Alfredo Lopes de Oliveira 1030', '(47) 99114-5629', 'deltaeletroinfo@gmail.com'),
(9, 'Gabriel Ribeiro', 25, 'masculino', 'Primeira Consulta', 'Rua Mathias Nossol', '4747474747', 'gabriel@hotmail.com'),
(11, 'Josinei Antonio Tissi', 56, 'masculino', 'Primeira COnsulta', 'Rua XV de Novembro', '47474747', 'neitissi@gmail.com'),
(13, 'Ana Flavia Pechibilski', 18, 'feminino', 'dentes tortos', 'Rua alfredo lopes de oliveira', '47991415684', 'anaflaviapchibilski@gmail.com'),
(15, 'Nilson Ayres', 60, 'masculino', 'Dentadura superior', 'Estrada Geral Lajeadinho', '47991919191', 'nilson@gmail.com'),
(16, 'Jacson Ayres', 24, 'masculino', 'Dentes Podres', 'Estrada Geral Lajeadinho', '4791919191', 'jacson@gmail.com'),
(17, 'Anna Julia J Tibes ', 20, 'feminino', 'Primeira consulta ', 'Duque de Caxias ', '47 999802084', 'annaju.jtibes@gmail.com'),
(18, 'Juliana Medeiros de Lima', 36, 'feminino', 'Uso de medicamentos: hidrocloritiazida para controlar a pressão arterial.\r\nDor na artriculação temporomandibular ', 'Rua dionisio Ribeiro da Silva', '47 92671148', 'julianamedeirosdelima1@gmail.com'),
(20, 'Gustavo Smenticovski Pimentel', 32, 'masculino', 'saudavel', 'bento gonçalves ', '4799901862', 'alexandre.pimentel16@yahoo.com'),
(21, 'janio jose seccon', 63, 'masculino', 'diabetico', 'rua bento gonçalves 943', '47991403657', 'estefanigasparetto@gmail.com'),
(22, 'HELENICE RIBEIRO DA ANHAIA KUBIAK', 53, 'feminino', 'nada', 'TEODORO MANGUEROSKI', '49991535082', 'carolinaaparecidakubiak@gmail.com');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paciente_id` (`paciente_id`),
  ADD KEY `dentista_id` (`dentista_id`);

--
-- Índices de tabela `atendimentos`
--
ALTER TABLE `atendimentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agendamento_id` (`agendamento_id`);

--
-- Índices de tabela `consultas`
--
ALTER TABLE `consultas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paciente_id` (`paciente_id`),
  ADD KEY `dentista_id` (`dentista_id`);

--
-- Índices de tabela `dentistas`
--
ALTER TABLE `dentistas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de tabela `atendimentos`
--
ALTER TABLE `atendimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `consultas`
--
ALTER TABLE `consultas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `dentistas`
--
ALTER TABLE `dentistas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD CONSTRAINT `agendamentos_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`),
  ADD CONSTRAINT `agendamentos_ibfk_2` FOREIGN KEY (`dentista_id`) REFERENCES `dentistas` (`id`);

--
-- Restrições para tabelas `atendimentos`
--
ALTER TABLE `atendimentos`
  ADD CONSTRAINT `atendimentos_ibfk_1` FOREIGN KEY (`agendamento_id`) REFERENCES `agendamentos` (`id`);

--
-- Restrições para tabelas `consultas`
--
ALTER TABLE `consultas`
  ADD CONSTRAINT `consultas_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`),
  ADD CONSTRAINT `consultas_ibfk_2` FOREIGN KEY (`dentista_id`) REFERENCES `dentistas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
