-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Lug 21, 2024 alle 00:28
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinicprive`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `amministratore`
--

CREATE TABLE `amministratore` (
  `idAmministratore` varchar(6) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `cognome` varchar(20) NOT NULL,
  `CF` varchar(16) DEFAULT NULL,
  `dataNascita` date NOT NULL,
  `luogoNascita` varchar(20) NOT NULL,
  `recapitoTelefonico` bigint(1) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `amministratore`
--

INSERT INTO `amministratore` (`idAmministratore`, `nome`, `cognome`, `CF`, `dataNascita`, `luogoNascita`, `recapitoTelefonico`, `email`, `password`) VALUES
('A001', 'Matilde', 'Dantino', 'DNTMLD01D67H294L', '2001-04-27', 'Rimini', 2147483647, 'matildedantino@gmail.com', 'macchia01'),
('A002', 'Gaia', 'Mazzoni', 'MZZGAI02D49A944U', '2002-04-09', 'Bologna', 2147483647, 'gaiamazzoni2002@gmail.com', 'frisk02'),
('A003', 'Sebastian', 'Seijas', 'SJSBST02L26Z614X', '2002-07-26', 'Venezuela', 2147483647, 'seba.seba2@studio.unibo.it', 'Bea02');

-- --------------------------------------------------------

--
-- Struttura della tabella `assistente`
--

CREATE TABLE `assistente` (
  `idPrestazione` int(6) NOT NULL,
  `nBadge` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `assistente`
--

INSERT INTO `assistente` (`idPrestazione`, `nBadge`) VALUES
(2, 'O001'),
(2, 'O002'),
(4, 'O003'),
(4, 'O004'),
(7, 'O005'),
(7, 'O006'),
(9, 'O007'),
(9, 'O008'),
(12, 'O009'),
(12, 'O010'),
(14, 'O011'),
(14, 'O012'),
(17, 'O013'),
(17, 'O014'),
(19, 'O015'),
(19, 'O016'),
(22, 'O017'),
(22, 'O018'),
(24, 'O019'),
(24, 'O020'),
(27, 'O021'),
(27, 'O022'),
(29, 'O023'),
(29, 'O024'),
(32, 'O001'),
(32, 'O025'),
(34, 'O002'),
(34, 'O003'),
(37, 'O004'),
(37, 'O005'),
(39, 'O006'),
(39, 'O007'),
(42, 'O008'),
(42, 'O009'),
(44, 'O010'),
(44, 'O011'),
(47, 'O012'),
(47, 'O013'),
(49, 'O014'),
(49, 'O015'),
(52, 'O016'),
(52, 'O017'),
(54, 'O018'),
(54, 'O019'),
(57, 'O020'),
(57, 'O021'),
(59, 'O022'),
(59, 'O023'),
(62, 'O024'),
(62, 'O025'),
(64, 'O001'),
(64, 'O002'),
(67, 'O003'),
(67, 'O004'),
(69, 'O005'),
(69, 'O006'),
(72, 'O007'),
(72, 'O008'),
(74, 'O009'),
(74, 'O010'),
(77, 'O011'),
(77, 'O012'),
(79, 'O013'),
(79, 'O014'),
(82, 'O015'),
(82, 'O016'),
(84, 'O017'),
(84, 'O018'),
(87, 'O019'),
(87, 'O020'),
(89, 'O021'),
(89, 'O022'),
(92, 'O023'),
(92, 'O024'),
(94, 'O001'),
(94, 'O025'),
(97, 'O002'),
(97, 'O003'),
(99, 'O004'),
(99, 'O005'),
(102, 'O001'),
(102, 'O002'),
(103, 'O003'),
(103, 'O004'),
(104, 'O005'),
(104, 'O006'),
(105, 'O007'),
(105, 'O008'),
(106, 'O009'),
(106, 'O010'),
(107, 'O011'),
(107, 'O012'),
(108, 'O013'),
(108, 'O014'),
(109, 'O015'),
(109, 'O016'),
(110, 'O017'),
(110, 'O018'),
(111, 'O019'),
(111, 'O020'),
(112, 'O021'),
(112, 'O022'),
(113, 'O023'),
(113, 'O024'),
(114, 'O001'),
(114, 'O025'),
(115, 'O002'),
(115, 'O003'),
(116, 'O004'),
(116, 'O005'),
(117, 'O006'),
(117, 'O007'),
(118, 'O010'),
(118, 'O011'),
(119, 'O012'),
(119, 'O013'),
(120, 'O014'),
(120, 'O015'),
(121, 'O016'),
(121, 'O017'),
(122, 'O018'),
(122, 'O019'),
(123, 'O020'),
(123, 'O021'),
(124, 'O022'),
(124, 'O023'),
(125, 'O024'),
(125, 'O025'),
(126, 'O001'),
(126, 'O002'),
(127, 'O003'),
(127, 'O004'),
(128, 'O005'),
(128, 'O006'),
(129, 'O007'),
(129, 'O008'),
(130, 'O009'),
(130, 'O010'),
(131, 'O011'),
(131, 'O012'),
(132, 'O013'),
(132, 'O014'),
(133, 'O015'),
(133, 'O016'),
(134, 'O017'),
(134, 'O018'),
(135, 'O019'),
(135, 'O020'),
(136, 'O021'),
(136, 'O022'),
(137, 'O023'),
(137, 'O024'),
(138, 'O001'),
(138, 'O025'),
(139, 'O002'),
(139, 'O003'),
(140, 'O004'),
(140, 'O005'),
(141, 'O006'),
(141, 'O007'),
(142, 'O008'),
(142, 'O009'),
(143, 'O010'),
(143, 'O011'),
(144, 'O012'),
(144, 'O013'),
(145, 'O014'),
(145, 'O015'),
(146, 'O016'),
(146, 'O017'),
(147, 'O018'),
(147, 'O019'),
(148, 'O020'),
(148, 'O021'),
(149, 'O022'),
(149, 'O023'),
(150, 'O024'),
(150, 'O025'),
(151, 'O001'),
(151, 'O002'),
(152, 'O003'),
(152, 'O004'),
(153, 'O005'),
(153, 'O006'),
(154, 'O007'),
(154, 'O008'),
(155, 'O009'),
(155, 'O010'),
(156, 'O011'),
(156, 'O012'),
(157, 'O013'),
(157, 'O014'),
(158, 'O015'),
(158, 'O016'),
(159, 'O017'),
(159, 'O018'),
(160, 'O019'),
(160, 'O020'),
(161, 'O021'),
(161, 'O022'),
(162, 'O023'),
(162, 'O024'),
(163, 'O001'),
(163, 'O025'),
(164, 'O002'),
(164, 'O003'),
(165, 'O004'),
(165, 'O005'),
(166, 'O006'),
(166, 'O007'),
(167, 'O008'),
(167, 'O009'),
(168, 'O010'),
(168, 'O011'),
(169, 'O012'),
(169, 'O013'),
(170, 'O014'),
(170, 'O015'),
(171, 'O016'),
(171, 'O017'),
(172, 'O018'),
(172, 'O019'),
(173, 'O020'),
(173, 'O021'),
(174, 'O022'),
(174, 'O023'),
(175, 'O024'),
(175, 'O025'),
(176, 'O001'),
(176, 'O002'),
(177, 'O003'),
(177, 'O004'),
(178, 'O005'),
(178, 'O006'),
(179, 'O007'),
(179, 'O008'),
(180, 'O009'),
(180, 'O010'),
(181, 'O011'),
(181, 'O012'),
(182, 'O013'),
(182, 'O014'),
(183, 'O015'),
(183, 'O016'),
(184, 'O017'),
(184, 'O018'),
(185, 'O019'),
(185, 'O020'),
(186, 'O021'),
(186, 'O022'),
(187, 'O023'),
(187, 'O024'),
(188, 'O001'),
(188, 'O025'),
(189, 'O002'),
(189, 'O003'),
(190, 'O004'),
(190, 'O005'),
(191, 'O006'),
(191, 'O007'),
(192, 'O008'),
(192, 'O009'),
(193, 'O010'),
(193, 'O011'),
(194, 'O012'),
(194, 'O013'),
(195, 'O014'),
(195, 'O015'),
(196, 'O016'),
(196, 'O017'),
(197, 'O018'),
(197, 'O019'),
(198, 'O020'),
(198, 'O021'),
(199, 'O022'),
(199, 'O023'),
(200, 'O024'),
(200, 'O025'),
(204, 'O006'),
(204, 'O011');

-- --------------------------------------------------------

--
-- Struttura della tabella `diagnosi`
--

CREATE TABLE `diagnosi` (
  `idPaziente` int(6) NOT NULL,
  `idPatologia` int(6) NOT NULL,
  `descrizione` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `diagnosi`
--

INSERT INTO `diagnosi` (`idPaziente`, `idPatologia`, `descrizione`) VALUES
(1, 1, 'Descrizione della diagnosi per paziente 1 con patologia 1'),
(2, 2, 'Descrizione della diagnosi per paziente 2 con patologia 2'),
(2, 6, ''),
(3, 3, 'Descrizione della diagnosi per paziente 3 con patologia 3'),
(4, 4, 'Descrizione della diagnosi per paziente 4 con patologia 4'),
(5, 5, 'Descrizione della diagnosi per paziente 5 con patologia 5'),
(6, 6, 'Descrizione della diagnosi per paziente 6 con patologia 6'),
(7, 7, 'Descrizione della diagnosi per paziente 7 con patologia 7'),
(8, 8, 'Descrizione della diagnosi per paziente 8 con patologia 8'),
(9, 9, 'Descrizione della diagnosi per paziente 9 con patologia 9'),
(10, 10, 'Descrizione della diagnosi per paziente 10 con patologia 10'),
(11, 11, 'Descrizione della diagnosi per paziente 11 con patologia 11'),
(12, 12, 'Descrizione della diagnosi per paziente 12 con patologia 12'),
(13, 13, 'Descrizione della diagnosi per paziente 13 con patologia 13'),
(14, 14, 'Descrizione della diagnosi per paziente 14 con patologia 14'),
(15, 15, 'Descrizione della diagnosi per paziente 15 con patologia 15'),
(16, 16, 'Descrizione della diagnosi per paziente 16 con patologia 16'),
(17, 17, 'Descrizione della diagnosi per paziente 17 con patologia 17'),
(18, 18, 'Descrizione della diagnosi per paziente 18 con patologia 18'),
(19, 19, 'Descrizione della diagnosi per paziente 19 con patologia 19'),
(20, 20, 'Descrizione della diagnosi per paziente 20 con patologia 20'),
(21, 1, 'Descrizione della diagnosi per paziente 21 con patologia 1'),
(22, 2, 'Descrizione della diagnosi per paziente 22 con patologia 2'),
(23, 3, 'Descrizione della diagnosi per paziente 23 con patologia 3'),
(24, 4, 'Descrizione della diagnosi per paziente 24 con patologia 4'),
(25, 5, 'Descrizione della diagnosi per paziente 25 con patologia 5'),
(26, 6, 'Descrizione della diagnosi per paziente 26 con patologia 6'),
(27, 7, 'Descrizione della diagnosi per paziente 27 con patologia 7'),
(28, 8, 'Descrizione della diagnosi per paziente 28 con patologia 8'),
(29, 9, 'Descrizione della diagnosi per paziente 29 con patologia 9'),
(30, 10, 'Descrizione della diagnosi per paziente 30 con patologia 10'),
(31, 11, 'Descrizione della diagnosi per paziente 31 con patologia 11'),
(32, 12, 'Descrizione della diagnosi per paziente 32 con patologia 12'),
(33, 13, 'Descrizione della diagnosi per paziente 33 con patologia 13'),
(34, 14, 'Descrizione della diagnosi per paziente 34 con patologia 14'),
(35, 15, 'Descrizione della diagnosi per paziente 35 con patologia 15'),
(36, 16, 'Descrizione della diagnosi per paziente 36 con patologia 16'),
(37, 17, 'Descrizione della diagnosi per paziente 37 con patologia 17'),
(38, 18, 'Descrizione della diagnosi per paziente 38 con patologia 18'),
(39, 19, 'Descrizione della diagnosi per paziente 39 con patologia 19'),
(40, 20, 'Descrizione della diagnosi per paziente 40 con patologia 20'),
(41, 1, 'Descrizione della diagnosi per paziente 41 con patologia 1'),
(42, 2, 'Descrizione della diagnosi per paziente 42 con patologia 2'),
(43, 3, 'Descrizione della diagnosi per paziente 43 con patologia 3'),
(44, 4, 'Descrizione della diagnosi per paziente 44 con patologia 4'),
(45, 5, 'Descrizione della diagnosi per paziente 45 con patologia 5'),
(46, 6, 'Descrizione della diagnosi per paziente 46 con patologia 6'),
(47, 7, 'Descrizione della diagnosi per paziente 47 con patologia 7'),
(48, 8, 'Descrizione della diagnosi per paziente 48 con patologia 8'),
(49, 9, 'Descrizione della diagnosi per paziente 49 con patologia 9'),
(50, 10, 'Descrizione della diagnosi per paziente 50 con patologia 10');

-- --------------------------------------------------------

--
-- Struttura della tabella `farmaco`
--

CREATE TABLE `farmaco` (
  `nome` varchar(255) NOT NULL,
  `dose` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `farmaco`
--

INSERT INTO `farmaco` (`nome`, `dose`) VALUES
('Aciclovir', '400mg'),
('Alprazolam', '0.5mg'),
('Amlodipina', '5mg'),
('Amoxicillina', '875mg'),
('Aspirina', '100mg'),
('Atorvastatina', '40mg'),
('Azitromicina', '500mg'),
('Bisoprololo', '5mg'),
('Cetirizina', '10mg'),
('Ciprofloxacina', '500mg'),
('Citalopram', '20mg'),
('Clindamicina', '300mg'),
('Desloratadina', '5mg'),
('Diazepam', '5mg'),
('Diosmina', '500mg'),
('Domperidone', '10mg'),
('Doxiciclina', '100mg'),
('Duloxetina', '30mg'),
('Escitalopram', '10mg'),
('Escopolamina', '10mg'),
('Fexofenadina', '180mg'),
('Finasteride', '1mg'),
('Fluconazolo', '150mg'),
('Fluoxetina', '20mg'),
('Furosemide', '40mg'),
('Gabapentin', '300mg'),
('Ibuprofene', '400mg'),
('Levotiroxina', '50mcg'),
('Loperamide', '2mg'),
('Loratadina', '10mg'),
('Losartan', '50mg'),
('Metformina', '850mg'),
('Metoclopramide', '10mg'),
('Metoprololo', '50mg'),
('Metronidazolo', '500mg'),
('Montelukast', '10mg'),
('Omeprazolo', '20mg'),
('Ondansetron', '4mg'),
('Pantoprazolo', '40mg'),
('Paracetamolo', '500mg'),
('Prednisone', '5mg'),
('Ramipril', '10mg'),
('Ranitidina', '150mg'),
('Sertralina', '50mg'),
('Sildenafil', '50mg'),
('Simvastatina', '20mg'),
('Tadalafil', '20mg'),
('Tramadolo', '50mg'),
('Venlafaxina', '75mg'),
('Warfarin', '5mg');

-- --------------------------------------------------------

--
-- Struttura della tabella `fattura`
--

CREATE TABLE `fattura` (
  `idPrestazione` int(6) NOT NULL,
  `numeroFattura` int(6) NOT NULL,
  `totale` decimal(8,0) NOT NULL,
  `dataEmissione` date NOT NULL,
  `dataPagamento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `fattura`
--

INSERT INTO `fattura` (`idPrestazione`, `numeroFattura`, `totale`, `dataEmissione`, `dataPagamento`) VALUES
(1, 1, 800, '2024-06-20', '2024-07-02'),
(2, 2, 5000, '2024-06-25', NULL),
(3, 3, 150, '2024-06-15', '2024-07-03'),
(4, 4, 7500, '2024-06-28', '2024-08-01'),
(5, 5, 80, '2024-07-01', NULL),
(6, 6, 100, '2024-06-30', '2024-07-04'),
(7, 7, 6000, '2024-06-20', NULL),
(8, 8, 90, '2024-06-15', '2024-07-05'),
(9, 9, 4500, '2024-07-03', '2024-07-07'),
(10, 10, 130, '2024-07-05', NULL),
(11, 11, 3000, '2024-06-18', '2024-07-06'),
(12, 12, 110, '2024-06-27', '2024-07-08'),
(13, 13, 4000, '2024-06-22', '2024-07-09'),
(14, 14, 100, '2024-07-02', '2024-07-10'),
(15, 15, 3800, '2024-06-16', NULL),
(16, 16, 120, '2024-06-21', '2024-07-11'),
(17, 17, 4200, '2024-06-19', NULL),
(18, 18, 110, '2024-06-23', '2024-07-12'),
(19, 19, 5500, '2024-07-04', '2024-07-13'),
(20, 20, 140, '2024-07-07', NULL),
(21, 21, 3200, '2024-06-26', '2024-07-14'),
(22, 22, 100, '2024-06-29', '2024-07-15'),
(23, 23, 5800, '2024-07-06', NULL),
(24, 24, 150, '2024-06-17', '2024-07-16'),
(25, 25, 5200, '2024-07-03', NULL),
(26, 26, 80, '2024-06-24', '2024-07-17'),
(27, 27, 3600, '2024-07-02', '2024-07-18'),
(28, 28, 150, '2024-06-15', NULL),
(29, 29, 3900, '2024-07-05', '2024-07-19'),
(30, 30, 120, '2024-07-04', NULL),
(31, 31, 800, '2024-06-20', '2024-07-20'),
(32, 32, 5000, '2024-06-25', NULL),
(33, 33, 150, '2024-06-15', '2024-07-21'),
(34, 34, 7500, '2024-06-28', '2024-08-01'),
(35, 35, 80, '2024-07-01', NULL),
(36, 36, 100, '2024-06-30', '2024-07-22'),
(37, 37, 6000, '2024-06-20', NULL),
(38, 38, 90, '2024-06-15', '2024-07-23'),
(39, 39, 4500, '2024-07-03', '2024-07-24'),
(40, 40, 130, '2024-07-05', NULL),
(41, 41, 3000, '2024-06-18', '2024-07-25'),
(42, 42, 110, '2024-06-27', '2024-07-26'),
(43, 43, 4000, '2024-06-22', '2024-07-27'),
(44, 44, 100, '2024-07-02', '2024-07-28'),
(45, 45, 3800, '2024-06-16', NULL),
(46, 46, 120, '2024-06-21', '2024-07-29'),
(47, 47, 4200, '2024-06-19', NULL),
(48, 48, 110, '2024-06-23', '2024-07-30'),
(49, 49, 5500, '2024-07-04', '2024-07-31'),
(50, 50, 140, '2024-07-07', NULL),
(51, 51, 3200, '2024-06-26', '2024-08-01'),
(52, 52, 100, '2024-06-29', '2024-08-02'),
(53, 53, 5800, '2024-07-06', NULL),
(54, 54, 150, '2024-06-17', '2024-08-03'),
(55, 55, 5200, '2024-07-03', NULL),
(56, 56, 80, '2024-06-24', '2024-08-04'),
(57, 57, 3600, '2024-07-02', '2024-08-05'),
(58, 58, 150, '2024-06-15', NULL),
(59, 59, 3900, '2024-07-05', '2024-08-06'),
(60, 60, 120, '2024-07-04', NULL),
(61, 61, 800, '2024-06-20', '2024-08-07'),
(62, 62, 5000, '2024-06-25', NULL),
(63, 63, 150, '2024-06-15', '2024-08-08'),
(64, 64, 7500, '2024-06-28', '2024-08-09'),
(65, 65, 80, '2024-07-01', NULL),
(66, 66, 100, '2024-06-30', '2024-08-10'),
(67, 67, 6000, '2024-06-20', NULL),
(68, 68, 90, '2024-06-15', '2024-08-11'),
(69, 69, 4500, '2024-07-03', '2024-08-12'),
(70, 70, 130, '2024-07-05', NULL),
(71, 71, 3000, '2024-06-18', '2024-08-13'),
(72, 72, 110, '2024-06-27', '2024-08-14'),
(73, 73, 4000, '2024-06-22', '2024-08-15'),
(74, 74, 100, '2024-07-02', '2024-08-16'),
(75, 75, 3800, '2024-06-16', NULL),
(76, 76, 120, '2024-06-21', '2024-08-17'),
(77, 77, 4200, '2024-06-19', NULL),
(78, 78, 110, '2024-06-23', '2024-08-18'),
(79, 79, 5500, '2024-07-04', '2024-08-19'),
(80, 80, 140, '2024-07-07', NULL),
(81, 81, 3200, '2024-06-26', '2024-08-20'),
(82, 82, 100, '2024-06-29', '2024-08-21'),
(83, 83, 5800, '2024-07-06', NULL),
(84, 84, 150, '2024-06-17', '2024-08-22'),
(85, 85, 5200, '2024-07-03', NULL),
(86, 86, 80, '2024-06-24', '2024-08-23'),
(87, 87, 3600, '2024-07-02', '2024-08-24'),
(88, 88, 150, '2024-06-15', NULL),
(89, 89, 3900, '2024-07-05', '2024-08-25'),
(90, 90, 120, '2024-07-04', NULL),
(91, 91, 800, '2024-06-20', '2024-08-26'),
(92, 92, 5000, '2024-06-25', NULL),
(93, 93, 150, '2024-06-15', '2024-08-27'),
(94, 94, 7500, '2024-06-28', '2024-08-28'),
(95, 95, 80, '2024-07-01', NULL),
(96, 96, 100, '2024-06-30', '2024-08-29'),
(97, 97, 6000, '2024-06-20', NULL),
(98, 98, 90, '2024-06-15', '2024-08-30'),
(99, 99, 4500, '2024-07-03', '2024-08-31'),
(100, 100, 130, '2024-07-05', NULL),
(102, 101, 110, '2024-07-11', '2024-07-11'),
(103, 103, 800, '2024-02-15', '2024-07-19'),
(104, 104, 150, '2024-03-01', '2024-03-15'),
(105, 105, 7500, '2024-04-10', '2024-04-22'),
(106, 106, 100, '2024-05-01', '2024-05-06'),
(107, 107, 800, '2024-06-10', NULL),
(108, 108, 6000, '2024-09-01', '2024-09-10'),
(109, 109, 80, '2024-10-01', '2024-10-14'),
(110, 110, 800, '2024-11-10', NULL),
(111, 111, 4500, '2024-12-01', '2024-12-10'),
(112, 112, 120, '2024-01-10', NULL),
(113, 113, 800, '2024-02-15', '2024-02-27'),
(114, 114, 3500, '2024-03-01', '2024-03-08'),
(115, 115, 90, '2024-04-01', '2024-04-10'),
(116, 116, 800, '2024-05-10', NULL),
(117, 117, 6500, '2024-06-01', '2024-06-15'),
(118, 118, 130, '2024-09-01', '2024-09-18'),
(119, 119, 800, '2024-10-01', NULL),
(120, 120, 3000, '2024-11-01', '2024-11-10'),
(121, 121, 110, '2024-12-01', '2024-12-13'),
(122, 122, 800, '2024-01-01', NULL),
(123, 123, 4000, '2024-02-01', '2024-02-14'),
(124, 124, 140, '2024-03-01', '2024-03-22'),
(125, 125, 800, '2024-04-01', NULL),
(126, 126, 3800, '2024-05-01', '2024-05-12'),
(127, 127, 150, '2024-06-01', '2024-06-20'),
(128, 128, 800, '2024-09-01', NULL),
(129, 129, 4200, '2024-10-01', '2024-10-10'),
(130, 130, 100, '2024-11-01', '2024-11-14'),
(131, 131, 800, '2024-12-01', NULL),
(132, 132, 5500, '2024-01-01', '2024-01-10'),
(133, 133, 80, '2024-02-01', '2024-02-18'),
(134, 134, 800, '2024-03-01', NULL),
(135, 135, 3200, '2024-04-01', '2024-04-04'),
(136, 136, 150, '2024-05-01', '2024-05-11'),
(137, 137, 800, '2024-06-01', NULL),
(138, 138, 5800, '2024-09-01', '2024-09-08'),
(139, 139, 80, '2024-10-01', '2024-10-13'),
(140, 140, 800, '2024-11-01', NULL),
(141, 141, 5200, '2024-12-01', '2024-12-03'),
(142, 142, 120, '2024-01-01', '2024-01-18'),
(143, 143, 800, '2024-02-01', NULL),
(144, 144, 3600, '2024-03-01', '2024-03-06'),
(145, 145, 90, '2024-04-01', '2024-04-15'),
(146, 146, 800, '2024-05-01', NULL),
(147, 147, 3900, '2024-06-01', '2024-06-17'),
(148, 148, 140, '2024-09-01', '2024-09-17'),
(149, 149, 800, '2024-10-01', NULL),
(150, 150, 5000, '2024-11-01', '2024-11-04'),
(151, 151, 150, '2024-12-01', '2024-12-12'),
(152, 152, 800, '2024-01-01', '2024-07-20'),
(153, 153, 7500, '2024-02-01', '2024-02-13'),
(154, 154, 100, '2024-03-01', '2024-03-21'),
(155, 155, 800, '2024-04-01', NULL),
(156, 156, 6000, '2024-05-01', '2024-05-11'),
(157, 157, 130, '2024-06-01', '2024-06-19'),
(158, 158, 800, '2024-09-01', NULL),
(159, 159, 4500, '2024-10-01', '2024-10-05'),
(160, 160, 150, '2024-11-01', '2024-11-13'),
(161, 161, 800, '2024-12-01', NULL),
(162, 162, 3500, '2024-01-01', '2024-01-09'),
(163, 163, 100, '2024-02-01', '2024-02-17'),
(164, 164, 800, '2024-03-01', NULL),
(165, 165, 6500, '2024-04-01', '2024-04-03'),
(166, 166, 140, '2024-05-01', '2024-05-09'),
(167, 167, 800, '2024-06-01', NULL),
(168, 168, 3000, '2024-09-01', '2024-09-07'),
(169, 169, 90, '2024-10-01', '2024-10-12'),
(170, 170, 800, '2024-11-01', NULL),
(171, 171, 4000, '2024-12-01', '2024-12-02'),
(172, 172, 150, '2024-01-01', '2024-01-17'),
(173, 173, 800, '2024-02-01', NULL),
(174, 174, 3800, '2024-03-01', '2024-03-06'),
(175, 175, 120, '2024-04-01', '2024-04-14'),
(176, 176, 800, '2024-05-01', NULL),
(177, 177, 4200, '2024-06-01', '2024-06-16'),
(178, 178, 150, '2024-09-01', '2024-09-16'),
(179, 179, 800, '2024-10-01', NULL),
(180, 180, 5500, '2024-11-01', '2024-11-03'),
(181, 181, 80, '2024-12-01', '2024-12-11'),
(182, 182, 800, '2024-01-01', NULL),
(183, 183, 3200, '2024-02-01', '2024-02-13'),
(184, 184, 150, '2024-03-01', '2024-03-20'),
(185, 185, 800, '2024-04-01', NULL),
(186, 186, 5800, '2024-05-01', '2024-05-10'),
(187, 187, 100, '2024-06-01', '2024-06-18'),
(188, 188, 800, '2024-09-01', NULL),
(189, 189, 5200, '2024-10-01', '2024-10-04'),
(190, 190, 150, '2024-11-01', '2024-11-12'),
(191, 191, 800, '2024-12-01', NULL),
(192, 192, 3600, '2024-01-01', '2024-01-08'),
(193, 193, 120, '2024-02-01', '2024-02-16'),
(194, 194, 800, '2024-03-01', NULL),
(195, 195, 3900, '2024-04-01', '2024-04-02'),
(196, 196, 150, '2024-05-01', '2024-05-09'),
(197, 197, 800, '2024-06-01', NULL),
(198, 198, 5000, '2024-09-01', '2024-09-06'),
(199, 199, 100, '2024-10-01', '2024-10-11'),
(200, 200, 800, '2024-11-01', NULL),
(201, 201, 7500, '2024-12-01', '2024-12-01'),
(203, 202, 140, '2024-07-14', '2024-07-14'),
(204, 203, 3500, '2024-07-16', '2024-07-16');

-- --------------------------------------------------------

--
-- Struttura della tabella `fornitore`
--

CREATE TABLE `fornitore` (
  `idFornitore` int(6) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `recapitoTelefonico` bigint(1) NOT NULL,
  `email` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `fornitore`
--

INSERT INTO `fornitore` (`idFornitore`, `nome`, `recapitoTelefonico`, `email`) VALUES
(1, 'Fornitore A', 2111111111, 'fornitoreA@example.com'),
(2, 'Fornitore B', 2111112222, 'fornitoreB@example.com'),
(3, 'Fornitore C', 2111113333, 'fornitoreC@example.com'),
(4, 'Fornitore D', 2111114444, 'fornitoreD@example.com'),
(5, 'Fornitore E', 2111115555, 'fornitoreE@example.com'),
(6, 'Fornitore F', 2111116666, 'fornitoreF@example.com'),
(7, 'Fornitore G', 2111117777, 'fornitoreG@example.com'),
(8, 'Fornitore H', 2111118888, 'fornitoreH@example.com'),
(9, 'Fornitore I', 2111119999, 'fornitoreI@example.com'),
(10, 'Fornitore J', 2111110000, 'fornitoreJ@example.com'),
(11, 'Fornitore K', 2147483647, 'fornitoreK@example.com');

-- --------------------------------------------------------

--
-- Struttura della tabella `indirizzo`
--

CREATE TABLE `indirizzo` (
  `id` int(6) NOT NULL,
  `città` varchar(20) NOT NULL,
  `via` varchar(30) NOT NULL,
  `numeroCivico` int(5) NOT NULL,
  `CAP` int(5) NOT NULL,
  `provincia` varchar(2) NOT NULL,
  `nazione` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `indirizzo`
--

INSERT INTO `indirizzo` (`id`, `città`, `via`, `numeroCivico`, `CAP`, `provincia`, `nazione`) VALUES
(1, 'Roma', 'Via Roma', 1, 100, 'RM', 'Italia'),
(2, 'Milano', 'Corso Milano', 2, 20100, 'MI', 'Italia'),
(3, 'Napoli', 'Piazza Napoli', 3, 80100, 'NA', 'Italia'),
(4, 'Torino', 'Via Torino', 4, 10100, 'TO', 'Italia'),
(5, 'Palermo', 'Viale Palermo', 5, 90100, 'PA', 'Italia'),
(6, 'Firenze', 'Lungarno Firenze', 6, 50100, 'FI', 'Italia'),
(7, 'Bologna', 'Via Bologna', 7, 40100, 'BO', 'Italia'),
(8, 'Genova', 'Via Genova', 8, 16100, 'GE', 'Italia'),
(9, 'Verona', 'Via Verona', 9, 37100, 'VR', 'Italia'),
(10, 'Trieste', 'Piazza Trieste', 10, 34100, 'TS', 'Italia'),
(11, 'Perugia', 'Via Perugia', 11, 6100, 'PG', 'Italia'),
(12, 'Parma', 'Via Parma', 12, 43100, 'PR', 'Italia'),
(13, 'Modena', 'Via Modena', 13, 41100, 'MO', 'Italia'),
(14, 'Reggio Calabria', 'Corso Reggio Calabria', 14, 89100, 'RC', 'Italia'),
(15, 'Livorno', 'Via Livorno', 15, 57100, 'LI', 'Italia'),
(16, 'Pisa', 'Piazza Pisa', 16, 56100, 'PI', 'Italia'),
(17, 'Arezzo', 'Via Arezzo', 17, 52100, 'AR', 'Italia'),
(18, 'Catania', 'Via Catania', 18, 95100, 'CT', 'Italia'),
(19, 'Messina', 'Corso Messina', 19, 98100, 'ME', 'Italia'),
(20, 'Cagliari', 'Via Cagliari', 20, 9100, 'CA', 'Italia'),
(21, 'Ravenna', 'Via Ravenna', 21, 48100, 'RA', 'Italia'),
(22, 'Ferrara', 'Via Ferrara', 22, 44100, 'FE', 'Italia'),
(23, 'Forlì', 'Via Forlì', 23, 47100, 'FC', 'Italia'),
(24, 'Trento', 'Via Trento', 24, 38100, 'TN', 'Italia'),
(25, 'Bolzano', 'Via Bolzano', 25, 39100, 'BZ', 'Italia'),
(26, 'La Spezia', 'Via La Spezia', 26, 19100, 'SP', 'Italia'),
(27, 'Pescara', 'Via Pescara', 27, 65100, 'PE', 'Italia'),
(28, 'Ancona', 'Via Ancona', 28, 60100, 'AN', 'Italia'),
(29, 'Bari', 'Via Bari', 29, 70100, 'BA', 'Italia'),
(30, 'Taranto', 'Via Taranto', 30, 74100, 'TA', 'Italia'),
(31, 'Brindisi', 'Via Brindisi', 31, 72100, 'BR', 'Italia'),
(32, 'Lecce', 'Via Lecce', 32, 73100, 'LE', 'Italia'),
(33, 'Potenza', 'Via Potenza', 33, 85100, 'PZ', 'Italia'),
(34, 'Matera', 'Via Matera', 34, 75100, 'MT', 'Italia'),
(35, 'Foggia', 'Via Foggia', 35, 71100, 'FG', 'Italia'),
(36, 'Campobasso', 'Via Campobasso', 36, 86100, 'CB', 'Italia'),
(37, 'Isernia', 'Via Isernia', 37, 86170, 'IS', 'Italia'),
(38, 'Viterbo', 'Via Roma', 51, 1100, 'VT', 'Italia'),
(39, 'Siena', 'Piazza del Campo', 52, 53100, 'SI', 'Italia'),
(40, 'Venezia', 'Via Venezia', 40, 30100, 'VE', 'Italia'),
(41, 'Padova', 'Via Padova', 41, 35100, 'PD', 'Italia'),
(42, 'Vicenza', 'Via Vicenza', 42, 36100, 'VI', 'Italia'),
(43, 'Treviso', 'Via Treviso', 43, 31100, 'TV', 'Italia'),
(44, 'Belluno', 'Via Belluno', 44, 32100, 'BL', 'Italia'),
(45, 'Rovigo', 'Via Rovigo', 45, 45100, 'RO', 'Italia'),
(46, 'Varese', 'Via Varese', 46, 21100, 'VA', 'Italia'),
(47, 'Como', 'Via Como', 47, 22100, 'CO', 'Italia'),
(48, 'Lecco', 'Via Lecco', 48, 23900, 'LC', 'Italia'),
(49, 'Monza', 'Via Monza', 49, 20900, 'MB', 'Italia'),
(50, 'Bergamo', 'Via Bergamo', 50, 24100, 'BG', 'Italia'),
(51, 'Poggio Torriana', 'Padellina', 264, 47824, 'RN', 'Italia');

-- --------------------------------------------------------

--
-- Struttura della tabella `listino`
--

CREATE TABLE `listino` (
  `codicePrestazione` varchar(6) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `costo` decimal(8,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `listino`
--

INSERT INTO `listino` (`codicePrestazione`, `nome`, `costo`) VALUES
('I001', 'Rinoplastica', 5000),
('I002', 'Lifting facciale', 7500),
('I003', 'Mastoplastica additiva', 6000),
('I004', 'Liposuzione', 4500),
('I005', 'Blefaroplastica', 3500),
('I006', 'Addominoplastica', 6500),
('I007', 'Otoplastica', 3000),
('I008', 'Lifting braccia', 4000),
('I009', 'Mentoplastica', 3800),
('I010', 'Ginecomastia', 4200),
('I011', 'Lifting cosce', 5500),
('I012', 'Lipofilling', 3200),
('I013', 'Lifting glutei', 5800),
('I014', 'Mastopessi', 5200),
('I015', 'Aumento zigomi', 3600),
('I016', 'Labioplastica', 3900),
('R001', 'Ricovero post-operatorio', 800),
('V001', 'Visita specialistica chirurgia plastica', 150),
('V002', 'Consulenza pre-operatoria', 100),
('V003', 'Controllo post-operatorio', 80),
('V004', 'Visita di follow-up', 120),
('V005', 'Consulenza revisione cicatrici', 90),
('V006', 'Valutazione pre-anestesiologica', 130),
('V007', 'Consulenza per trattamenti non chirurgici', 110),
('V008', 'Visita di controllo per complicazioni', 140);

-- --------------------------------------------------------

--
-- Struttura della tabella `materiale`
--

CREATE TABLE `materiale` (
  `idMateriale` int(6) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `quantita` int(5) NOT NULL,
  `prezzo` decimal(6,0) NOT NULL,
  `numero_ordini` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `materiale`
--

INSERT INTO `materiale` (`idMateriale`, `nome`, `quantita`, `prezzo`, `numero_ordini`) VALUES
(1, 'Guanti chirurgici', 700, 2, 0),
(2, 'Mascherine chirurgiche', 300, 1, 1),
(3, 'Siringhe sterili', 100, 1, 2),
(4, 'Suture', 250, 3, 3),
(5, 'Disinfettante', 100, 5, 3),
(6, 'Pinze chirurgiche', 50, 10, 1),
(7, 'Forbici chirurgiche', 60, 12, 0),
(8, 'Bisturi', 100, 8, 0),
(9, 'Sacco di ghiaccio', 158, 2, 1),
(10, 'Elettrodi ECG', 212, 1, 1),
(11, 'Fiale di adrenalina', 37, 15, 2),
(12, 'Bende elastiche', 100, 3, 1),
(13, 'Cateteri', 80, 4, 2),
(14, 'Drenaggi chirurgici', 60, 6, 1),
(15, 'Tamponi sterili', 500, 1, 1),
(16, 'Copriscarpe', 200, 1, 0),
(17, 'Cuffie chirurgiche', 300, 1, 1),
(18, 'Soluzione fisiologica', 150, 7, 2),
(19, 'Cerotti', 500, 1, 3),
(20, 'Tubi endotracheali', 50, 10, 2),
(21, 'Supporti per braccio', 30, 20, 1),
(22, 'Protesi mammaria', 10, 250, 0),
(23, 'Impianti facciali', 20, 200, 0),
(24, 'Garze per ustioni', 150, 5, 0),
(25, 'Punti metallici', 200, 2, 0),
(26, 'Kit di sutura', 50, 10, 0),
(27, 'Anestetici', 100, 20, 0),
(28, 'Fasce elastiche', 100, 4, 0),
(29, 'Spray disinfettante', 150, 3, 0),
(30, 'Agrafi', 200, 1, 0),
(31, 'Maschere ossigeno', 50, 10, 0),
(32, 'Pinze emostatiche', 70, 12, 0),
(33, 'Dispositivi di drenaggio', 40, 15, 0),
(34, 'Plastica per ustioni', 20, 25, 0),
(35, 'Impianti auricolari', 15, 300, 0),
(36, 'Disinfettante mani', 200, 1, 0),
(37, 'Contenitori di rifiuti', 30, 5, 0),
(38, 'Rasoi chirurgici', 100, 3, 0),
(39, 'Spray analgesico', 120, 4, 0),
(40, 'Piastrine ECG', 250, 1, 0),
(41, 'Elettrobisturi', 20, 150, 0),
(42, 'Cannule', 150, 8, 0),
(43, 'Soluzione iodo-povidone', 100, 10, 0),
(44, 'Fasciature', 200, 2, 0),
(45, 'Kit di emergenza', 20, 50, 0),
(46, 'Aghi per biopsia', 50, 12, 0),
(47, 'Protesi nasali', 10, 400, 0),
(48, 'Spray cicatrizzante', 100, 5, 0),
(49, 'Ghiaccio istantaneo', 150, 3, 0),
(50, 'Pinze emostatiche', 130, 25, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `medico`
--

CREATE TABLE `medico` (
  `nBadge` varchar(6) NOT NULL,
  `tipologia` varchar(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `cognome` varchar(20) NOT NULL,
  `CF` varchar(16) DEFAULT NULL,
  `emailAziendale` varchar(300) NOT NULL,
  `dataNascita` date NOT NULL,
  `luogoNascita` varchar(20) NOT NULL,
  `recapitoTelefonico` bigint(1) NOT NULL,
  `password` varchar(255) NOT NULL,
  `inizioRapporto` date NOT NULL,
  `fineRapporto` date DEFAULT NULL,
  `idAmministratore` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `medico`
--

INSERT INTO `medico` (`nBadge`, `tipologia`, `nome`, `cognome`, `CF`, `emailAziendale`, `dataNascita`, `luogoNascita`, `recapitoTelefonico`, `password`, `inizioRapporto`, `fineRapporto`, `idAmministratore`) VALUES
('M001', 'primario', 'Antonio', 'Bianchi', 'BNCNTN70A01H501R', 'antonio.bianchi@clinica.it', '1970-01-01', 'Roma', 331234567, 'pw_Antonio123!', '2015-06-01', NULL, 'A001'),
('M002', 'chirurgo', 'Maria', 'Rossi', 'RSSMRA75B41F205S', 'maria.rossi@clinica.it', '1975-02-01', 'Milano', 339876543, 'pw_Maria456@', '2018-03-15', NULL, 'A002'),
('M003', 'anestesista', 'Luigi', 'Verdi', 'VRDLGU80C01L219T', 'luigi.verdi@clinica.it', '1980-03-01', 'Torino', 351234567, 'pw_Luigi789#', '2019-01-10', NULL, 'A003'),
('M004', 'chirurgo', 'Giulia', 'Neri', 'NRJGLI82D41D612U', 'giulia.neri@clinica.it', '1982-04-01', 'Firenze', 387654321, 'pw_Giulia321!', '2020-09-01', NULL, 'A001'),
('M005', 'anestesista', 'Marco', 'Gialli', 'GLLMRC85E01G702V', 'marco.gialli@clinica.it', '1985-05-01', 'Pisa', 391234567, 'pw_Marco654@', '2021-02-15', NULL, 'A002'),
('M006', 'chirurgo', 'Francesca', 'Blu', 'BLUFNC78F41A944W', 'francesca.blu@clinica.it', '1978-06-01', 'Bologna', 355678901, 'pw_Francesca987#', '2017-07-01', NULL, 'A003'),
('M007', 'anestesista', 'Andrea', 'Rosa', 'RSANDR88G01E506X', 'andrea.rosa@clinica.it', '1988-07-01', 'Lecce', 381234567, 'pw_Andrea135!', '2022-01-10', NULL, 'A001'),
('M008', 'chirurgo', 'Paola', 'Viola', 'VLAPLA76H41C351Y', 'paola.viola@clinica.it', '1976-08-01', 'Catania', 397654321, 'pw_Paola246@', '2019-11-15', NULL, 'A002'),
('M009', 'anestesista', 'Roberto', 'Arancio', 'RNCRRT83I01D086Z', 'roberto.arancio@clinica.it', '1983-09-01', 'Palermo', 351234567, 'pw_Roberto789#', '2020-06-01', NULL, 'A003'),
('M010', 'chirurgo', 'Elena', 'Marrone', 'MRRLNE79L41F839A', 'elena.marrone@clinica.it', '1979-10-01', 'Napoli', 389876543, 'pw_Elena321!', '2018-04-01', '2024-12-31', 'A001'),
('M011', 'anestesista', 'Davide', 'Celeste', 'CLSDVD86M01A952B', 'davide.celeste@clinica.it', '1986-11-01', 'Venezia', 331234567, 'pw_Davide654@', '2021-08-15', NULL, 'A002'),
('M012', 'chirurgo', 'Sara', 'Azzurro', 'ZZRSRA81N41B157C', 'sara.azzurro@clinica.it', '1981-12-01', 'Brescia', 357654321, 'pw_Sara987#', '2020-03-01', NULL, 'A003'),
('M013', 'anestesista', 'Luca', 'Verde', 'VRDLCU84A01D969D', 'luca.verde@clinica.it', '1984-01-01', 'Genova', 391234567, 'pw_Luca135!', '2019-02-01', NULL, 'A001'),
('M014', 'chirurgo', 'Valentina', 'Grigio', 'GRGVNT89B41E815E', 'valentina.grigio@clinica.it', '1989-02-01', 'Trieste', 385678901, 'pw_Valentina246@', '2022-05-15', NULL, 'A002'),
('M015', 'anestesista', 'Simone', 'Indaco', 'NDCSMN77C01C933F', 'simone.indaco@clinica.it', '1977-03-01', 'Cuneo', 351234567, 'pw_Simone789#', '2018-10-01', NULL, 'A003');

-- --------------------------------------------------------

--
-- Struttura della tabella `operatore`
--

CREATE TABLE `operatore` (
  `nBadge` varchar(6) NOT NULL,
  `tipologia` varchar(10) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `cognome` varchar(20) NOT NULL,
  `CF` varchar(16) DEFAULT NULL,
  `emailAziendale` varchar(300) NOT NULL,
  `dataNascita` date NOT NULL,
  `luogoNascita` varchar(20) NOT NULL,
  `recapitoTelefonico` bigint(1) NOT NULL,
  `password` varchar(20) NOT NULL,
  `inizioRapporto` date NOT NULL,
  `fineRapporto` date DEFAULT NULL,
  `idAmministratore` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `operatore`
--

INSERT INTO `operatore` (`nBadge`, `tipologia`, `nome`, `cognome`, `CF`, `emailAziendale`, `dataNascita`, `luogoNascita`, `recapitoTelefonico`, `password`, `inizioRapporto`, `fineRapporto`, `idAmministratore`) VALUES
('O001', 'caposala', 'Laura', 'Moretti', 'MRTLRA75E41H501S', 'laura.moretti@clinica.it', '1975-05-01', 'Roma', 331234567, 'pw_Laura123!', '2019-06-01', NULL, 'A001'),
('O002', 'infermiere', 'Marco', 'Rossi', 'RSSMRC80A01F205X', 'marco.rossi@clinica.it', '1980-01-01', 'Milano', 339876543, 'pw_Marco456@', '2020-03-15', NULL, 'A002'),
('O003', 'OSS', 'Giulia', 'Bianchi', 'BNCGLI88M41L219P', 'giulia.bianchi@clinica.it', '1988-08-01', 'Torino', 351234567, 'pw_Giulia789#', '2021-01-10', NULL, 'A003'),
('O004', 'infermiere', 'Luca', 'Verdi', 'VRDLCU82H05D612S', 'luca.verdi@clinica.it', '1982-06-05', 'Firenze', 387654321, 'pw_Luca321!', '2020-09-01', NULL, 'A001'),
('O005', 'OSS', 'Francesca', 'Neri', 'NREFNC90S41G702N', 'francesca.neri@clinica.it', '1990-11-01', 'Pisa', 391234567, 'pw_Francesca654@', '2022-02-15', NULL, 'A002'),
('O006', 'infermiere', 'Alessandro', 'Gialli', 'GLLLSN85D03A944Y', 'alessandro.gialli@clinica.it', '1985-04-03', 'Bologna', 355678901, 'pw_Alessandro987#', '2021-07-01', NULL, 'A003'),
('O007', 'OSS', 'Valentina', 'Rosa', 'RSAVNT92M44E506O', 'valentina.rosa@clinica.it', '1992-08-04', 'Lecce', 381234567, 'pw_Valentina135!', '2023-01-10', NULL, 'A001'),
('O008', 'infermiere', 'Simone', 'Viola', 'VLISMN78B01C351Q', 'simone.viola@clinica.it', '1978-02-01', 'Catania', 397654321, 'pw_Simone246@', '2020-11-15', NULL, 'A002'),
('O009', 'OSS', 'Elisa', 'Blu', 'BLULSE95T41D086R', 'elisa.blu@clinica.it', '1995-12-01', 'Palermo', 351234567, 'pw_Elisa789#', '2022-06-01', NULL, 'A003'),
('O010', 'infermiere', 'Davide', 'Arancio', 'RNCDVD83C03F839W', 'davide.arancio@clinica.it', '1983-03-03', 'Napoli', 389876543, 'pw_Davide321!', '2021-04-01', '2024-03-31', 'A001'),
('O011', 'infermiere', 'Chiara', 'Griggio', 'GRGCHR89L41A952T', 'chiara.griggio@clinica.it', '1989-07-01', 'Venezia', 331234567, 'pw_Chiara654@', '2020-08-15', NULL, 'A002'),
('O012', 'OSS', 'Fabio', 'Marrone', 'MRRFBA91E05B157U', 'fabio.marrone@clinica.it', '1991-05-05', 'Brescia', 357654321, 'pw_Fabio987#', '2022-03-01', NULL, 'A003'),
('O013', 'infermiere', 'Sara', 'Azzurro', 'ZZRSRA86H44D969V', 'sara.azzurro@clinica.it', '1986-06-04', 'Genova', 391234567, 'pw_Sara135!', '2021-02-01', NULL, 'A001'),
('O014', 'OSS', 'Roberto', 'Verde', 'VRDRRT93M03E815X', 'roberto.verde@clinica.it', '1993-08-03', 'Trieste', 385678901, 'pw_Roberto246@', '2023-05-15', NULL, 'A002'),
('O015', 'infermiere', 'Elena', 'Indaco', 'NDCLNE81A41C933Y', 'elena.indaco@clinica.it', '1981-01-01', 'Cuneo', 351234567, 'pw_Elena789#', '2020-10-01', NULL, 'A003'),
('O016', 'OSS', 'Andrea', 'Celeste', 'CLSNDR94D03L781Z', 'andrea.celeste@clinica.it', '1994-04-03', 'Verona', 397654321, 'pw_Andrea321!', '2022-09-01', NULL, 'A001'),
('O017', 'infermiere', 'Martina', 'Lilla', 'LLLMTN87S41D612W', 'martina.lilla@clinica.it', '1987-11-01', 'Firenze', 381234567, 'pw_Martina654@', '2021-06-15', NULL, 'A002'),
('O018', 'OSS', 'Stefano', 'Ocra', 'CROSFN96B03G702Q', 'stefano.ocra@clinica.it', '1996-02-03', 'Pisa', 355678901, 'pw_Stefano987#', '2023-03-01', NULL, 'A003'),
('O019', 'infermiere', 'Silvia', 'Magenta', 'MGNSLV84H44A944R', 'silvia.magenta@clinica.it', '1984-06-04', 'Bologna', 391234567, 'pw_Silvia135!', '2020-12-01', '2024-06-30', 'A001'),
('O020', 'OSS', 'Matteo', 'Turchese', 'TRCMTT92L03E506S', 'matteo.turchese@clinica.it', '1992-07-03', 'Lecce', 387654321, 'pw_Matteo246@', '2022-08-15', NULL, 'A002'),
('O021', 'infermiere', 'Claudia', 'Corallo', 'CRLCLD88D41C351T', 'claudia.corallo@clinica.it', '1988-04-01', 'Catania', 351234567, 'pw_Claudia789#', '2021-05-01', NULL, 'A003'),
('O022', 'OSS', 'Riccardo', 'Ambra', 'MBRRCR95M03D086U', 'riccardo.ambra@clinica.it', '1995-08-03', 'Palermo', 399876543, 'pw_Riccardo321!', '2023-02-15', NULL, 'A001'),
('O023', 'infermiere', 'Federica', 'Smeraldo', 'SMRFRC83B41F839V', 'federica.smeraldo@clinica.it', '1983-02-01', 'Napoli', 381234567, 'pw_Federica654@', '2020-07-01', NULL, 'A002'),
('O024', 'OSS', 'Paolo', 'Rame', 'RMEPLA91T03A952W', 'paolo.rame@clinica.it', '1991-12-03', 'Venezia', 355678901, 'pw_Paolo987#', '2022-11-01', NULL, 'A003'),
('O025', 'infermiere', 'Alessia', 'Oro', 'ROLSA89E44B157X', 'alessia.oro@clinica.it', '1989-05-04', 'Brescia', 397654321, 'pw_Alessia135!', '2021-03-15', NULL, 'A001'),
('O026', 'OSS', 'Daniele', 'Argento', 'RGNDNL94H03D969Y', 'daniele.argento@clinica.it', '1994-06-03', 'Genova', 331234567, 'pw_Daniele246@', '2023-07-01', NULL, 'A002'),
('O027', 'infermiere', 'Cristina', 'Bronzo', 'BRNCST86L41E815Z', 'cristina.bronzo@clinica.it', '1986-07-01', 'Trieste', 389876543, 'pw_Cristina789#', '2020-05-15', NULL, 'A003'),
('O028', 'OSS', 'Emanuele', 'Perla', 'PRLMNL97D03C933Q', 'emanuele.perla@clinica.it', '1997-04-03', 'Cuneo', 351234567, 'pw_Emanuele321!', '2023-09-01', NULL, 'A001'),
('O029', 'infermiere', 'Beatrice', 'Zaffiro', 'ZFFBRC85M41L781R', 'beatrice.zaffiro@clinica.it', '1985-08-01', 'Verona', 387654321, 'pw_Beatrice654@', '2021-08-15', NULL, 'A002'),
('O030', 'OSS', 'Nicola', 'Rubino', 'RBNNCL93B03D612S', 'nicola.rubino@clinica.it', '1993-02-03', 'Firenze', 391234567, 'pw_Nicola987#', '2022-12-01', NULL, 'A003');

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine`
--

CREATE TABLE `ordine` (
  `idOrdine` int(5) NOT NULL,
  `idFornitore` int(6) NOT NULL,
  `dataOrdine` date NOT NULL,
  `dataConsegna` date DEFAULT NULL,
  `nBadge` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `ordine`
--

INSERT INTO `ordine` (`idOrdine`, `idFornitore`, `dataOrdine`, `dataConsegna`, `nBadge`) VALUES
(1, 1, '2024-07-01', '2024-07-05', 'R001'),
(2, 2, '2024-07-03', NULL, 'R002'),
(3, 3, '2024-07-05', '2024-07-10', 'R003'),
(4, 4, '2024-07-07', '2024-07-12', 'R004'),
(5, 5, '2024-07-09', NULL, 'R001'),
(6, 6, '2024-07-11', '2024-07-15', 'R002'),
(7, 7, '2024-07-13', NULL, 'R003'),
(8, 8, '2024-07-15', '2024-07-20', 'R004'),
(9, 9, '2024-07-17', '2024-07-22', 'R001'),
(10, 10, '2024-07-19', NULL, 'R002'),
(11, 1, '2024-07-21', '2024-07-25', 'R003'),
(12, 2, '2024-07-23', '2024-07-20', 'R004'),
(13, 3, '2024-07-25', '2024-07-29', 'R001'),
(14, 4, '2024-07-27', '2024-07-31', 'R002'),
(15, 5, '2024-07-29', NULL, 'R003'),
(16, 6, '2024-07-02', '2024-07-06', 'R004'),
(17, 7, '2024-07-04', '2024-07-08', 'R001'),
(18, 8, '2024-07-06', NULL, 'R002'),
(19, 9, '2024-07-08', '2024-07-13', 'R003'),
(20, 10, '2024-07-10', '2024-07-15', 'R004'),
(21, 1, '2024-07-12', NULL, 'R001'),
(22, 2, '2024-07-14', '2024-07-19', 'R002'),
(23, 3, '2024-07-16', NULL, 'R003'),
(24, 4, '2024-07-18', '2024-07-23', 'R004'),
(25, 5, '2024-07-20', '2024-07-25', 'R001'),
(26, 5, '2024-07-20', NULL, 'R001');

-- --------------------------------------------------------

--
-- Struttura della tabella `patologia`
--

CREATE TABLE `patologia` (
  `idPatologia` int(6) NOT NULL,
  `nomePatologia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `patologia`
--

INSERT INTO `patologia` (`idPatologia`, `nomePatologia`) VALUES
(1, 'Ipertensione'),
(2, 'Diabete mellito tipo 2'),
(3, 'Colelitiasi'),
(4, 'Artrite reumatoide'),
(5, 'Asma bronchiale'),
(6, 'Spondilite anchilosante'),
(7, 'Fibromialgia'),
(8, 'Epilessia'),
(9, 'Depressione maggiore'),
(10, 'Malattia di Crohn'),
(11, 'Colecistite acuta'),
(12, 'Osteoporosi'),
(13, 'Aritmia cardiaca'),
(14, 'Gastrite cronica'),
(15, 'Malattia di Parkinson'),
(16, 'Sclerosi multipla'),
(17, 'Lombalgia'),
(18, 'Trombosi venosa profonda'),
(19, 'Psoriasi'),
(20, 'Endometriosi');

-- --------------------------------------------------------

--
-- Struttura della tabella `paziente`
--

CREATE TABLE `paziente` (
  `idPaziente` int(6) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `cognome` varchar(20) NOT NULL,
  `CF` varchar(16) DEFAULT NULL,
  `email` varchar(300) NOT NULL,
  `dataNascita` date NOT NULL,
  `luogoNascita` varchar(20) NOT NULL,
  `recapitoTelefonico` bigint(1) NOT NULL,
  `note` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `paziente`
--

INSERT INTO `paziente` (`idPaziente`, `nome`, `cognome`, `CF`, `email`, `dataNascita`, `luogoNascita`, `recapitoTelefonico`, `note`) VALUES
(1, 'Mario', 'Rossi', 'RSSMRA80A01H501Z', 'mario.rossi@gmail.com', '1980-01-01', 'Roma', 2147483647, ''),
(2, 'Luigi', 'Verdi', 'VRDLGU81B01H501Z', 'luigi.verdi@example.com', '1981-02-01', 'Milano', 2147483647, 'Nessuna nota'),
(3, 'Giovanni', 'Bianchi', 'BNCGVN82C01H501Z', 'giovanni.bianchi@example.com', '1982-03-01', 'Napoli', 2147483647, 'Nessuna nota'),
(4, 'Francesca', 'Neri', 'NRIFNC83D01H501Z', 'francesca.neri@example.com', '1983-04-01', 'Torino', 2147483647, 'Nessuna nota'),
(5, 'Alessandra', 'Russo', 'RSSLSN84E01H501Z', 'alessandra.russo@example.com', '1984-05-01', 'Palermo', 2147483647, 'Nessuna nota'),
(6, 'Paolo', 'Gialli', 'GLIPLO85F01H501Z', 'paolo.gialli@example.com', '1985-06-01', 'Firenze', 2147483647, 'Nessuna nota'),
(7, 'Chiara', 'Marrone', 'MRRCHR86G01H501Z', 'chiara.marrone@example.com', '1986-07-01', 'Bologna', 2147483647, 'Nessuna nota'),
(8, 'Stefano', 'Rossi', 'RSSSTF87H01H501Z', 'stefano.rossi@example.com', '1987-08-01', 'Genova', 2147483647, 'Nessuna nota'),
(9, 'Valentina', 'Verdi', 'VRDVLT88I01H501Z', 'valentina.verdi@example.com', '1988-09-01', 'Verona', 2147483647, 'Nessuna nota'),
(10, 'Giorgio', 'Bianchi', 'BNCGRG89L01H501Z', 'giorgio.bianchi@example.com', '1989-10-01', 'Trieste', 2147483647, 'Nessuna nota'),
(11, 'Simona', 'Neri', 'NRISMN90A01H501Z', 'simona.neri@example.com', '1990-11-01', 'Perugia', 2147483647, 'Nessuna nota'),
(12, 'Davide', 'Russo', 'RSSDVD91B01H501Z', 'davide.russo@example.com', '1991-12-01', 'Parma', 2147483647, 'Nessuna nota'),
(13, 'Federica', 'Gialli', 'GLIFDC92C01H501Z', 'federica.gialli@example.com', '1992-01-01', 'Modena', 2147483647, 'Nessuna nota'),
(14, 'Marco', 'Marrone', 'MRRMRC93D01H501Z', 'marco.marrone@example.com', '1993-02-01', 'Reggio Calabria', 2147483647, 'Nessuna nota'),
(15, 'Laura', 'Rossi', 'RSSLRA94E01H501Z', 'laura.rossi@example.com', '1994-03-01', 'Livorno', 2147483647, 'Nessuna nota'),
(16, 'Antonio', 'Verdi', 'VRDANT95F01H501Z', 'antonio.verdi@example.com', '1995-04-01', 'Pisa', 2147483647, 'Nessuna nota'),
(17, 'Martina', 'Bianchi', 'BNCMTN96G01H501Z', 'martina.bianchi@example.com', '1996-05-01', 'Arezzo', 2147483647, 'Nessuna nota'),
(18, 'Luca', 'Neri', 'NRILCA97H01H501Z', 'luca.neri@example.com', '1997-06-01', 'Catania', 2147483647, 'Nessuna nota'),
(19, 'Elena', 'Russo', 'RSSLNE98I01H501Z', 'elena.russo@example.com', '1998-07-01', 'Messina', 2147483647, 'Nessuna nota'),
(20, 'Roberto', 'Gialli', 'GLIRBT99L01H501Z', 'roberto.gialli@example.com', '1999-08-01', 'Cagliari', 2147483647, 'Nessuna nota'),
(21, 'Sara', 'Marrone', 'MRRSRA00A01H501Z', 'sara.marrone@example.com', '2000-09-01', 'Ravenna', 2147483647, 'Nessuna nota'),
(22, 'Riccardo', 'Rossi', 'RSSRCR01B01H501Z', 'riccardo.rossi@example.com', '2001-10-01', 'Ferrara', 2147483647, 'Nessuna nota'),
(23, 'Silvia', 'Verdi', 'VRDSLV02C01H501Z', 'silvia.verdi@example.com', '2002-11-01', 'Forlì', 2147483647, 'Nessuna nota'),
(24, 'Massimo', 'Bianchi', 'BNCMSS03D01H501Z', 'massimo.bianchi@example.com', '2003-12-01', 'Trento', 2147483647, 'Nessuna nota'),
(25, 'Giorgia', 'Neri', 'NRIGRG04E01H501Z', 'giorgia.neri@example.com', '2004-01-01', 'Bolzano', 2147483647, 'Nessuna nota'),
(26, 'Tommaso', 'Russo', 'RSSTMS05F01H501Z', 'tommaso.russo@example.com', '2005-02-01', 'La Spezia', 2147483647, 'Nessuna nota'),
(27, 'Nicole', 'Gialli', 'GLINCL06G01H501Z', 'nicole.gialli@example.com', '2006-03-01', 'Pescara', 2147483647, 'Nessuna nota'),
(28, 'Matteo', 'Marrone', 'MRRMTT07H01H501Z', 'matteo.marrone@example.com', '2007-04-01', 'Ancona', 2147483647, 'Nessuna nota'),
(29, 'Alessio', 'Rossi', 'RSSALS08I01H501Z', 'alessio.rossi@example.com', '2008-05-01', 'Bari', 2147483647, 'Nessuna nota'),
(30, 'Anna', 'Verdi', 'VRDANN09L01H501Z', 'anna.verdi@example.com', '2009-06-01', 'Taranto', 2147483647, 'Nessuna nota'),
(31, 'Leonardo', 'Bianchi', 'BNCLRD10A01H501Z', 'leonardo.bianchi@example.com', '2010-07-01', 'Brindisi', 2147483647, 'Nessuna nota'),
(32, 'Maria', 'Neri', 'NRIMRA11B01H501Z', 'maria.neri@example.com', '2011-08-01', 'Lecce', 2147483647, 'Nessuna nota'),
(33, 'Edoardo', 'Russo', 'RSSEDO12C01H501Z', 'edoardo.russo@example.com', '2012-09-01', 'Potenza', 2147483647, 'Nessuna nota'),
(34, 'Ilaria', 'Gialli', 'GLIILA13D01H501Z', 'ilaria.gialli@example.com', '2013-10-01', 'Matera', 2147483647, 'Nessuna nota'),
(35, 'Pietro', 'Marrone', 'MRRPTR14E01H501Z', 'pietro.marrone@example.com', '2014-11-01', 'Foggia', 2147483647, 'Nessuna nota'),
(36, 'Beatrice', 'Rossi', 'RSSBTR15F01H501Z', 'beatrice.rossi@example.com', '2015-12-01', 'Campobasso', 2147483647, 'Nessuna nota'),
(37, 'Giuseppe', 'Verdi', 'VRDGSP16G01H501Z', 'giuseppe.verdi@example.com', '2016-01-01', 'Isernia', 2147483647, 'Nessuna nota'),
(38, 'Anna', 'Mazzoni', 'MZZANN07D98H296L', 'annuz@gmail.com', '2011-07-23', 'Bologna', 333444333, NULL),
(39, 'Claudio', 'Neri', 'NRICLD18I01H501Z', 'claudio.neri@example.com', '2018-03-01', 'Pescara', 2147483647, 'Nessuna nota'),
(40, 'Serena', 'Russo', 'RSSSRN19L01H501Z', 'serena.russo@example.com', '2019-04-01', 'Teramo', 2147483647, 'Nessuna nota'),
(41, 'Fabio', 'Gialli', 'GLIFBO20A01H501Z', 'fabio.gialli@example.com', '2020-05-01', 'Venezia', 2147483647, 'Nessuna nota'),
(42, 'Veronica', 'Marrone', 'MRRVRC21B01H501Z', 'veronica.marrone@example.com', '2021-06-01', 'Padova', 2147483647, 'Nessuna nota'),
(43, 'Cristiano', 'Rossi', 'RSSCRT22C01H501Z', 'cristiano.rossi@example.com', '2022-07-01', 'Vicenza', 2147483647, 'Nessuna nota'),
(44, 'Elisabetta', 'Verdi', 'VRDELB23D01H501Z', 'elisabetta.verdi@example.com', '2023-08-01', 'Treviso', 2147483647, 'Nessuna nota'),
(45, 'Daniele', 'Bianchi', 'BNCDNL24E01H501Z', 'daniele.bianchi@example.com', '2024-09-01', 'Belluno', 2147483647, 'Nessuna nota'),
(46, 'Alberta', 'Neri', 'NRIALB25F01H501Z', 'alberta.neri@example.com', '2025-10-01', 'Rovigo', 2147483647, 'Nessuna nota'),
(47, 'Renato', 'Russo', 'RSSRNT26G01H501Z', 'renato.russo@example.com', '2026-11-01', 'Varese', 2147483647, 'Nessuna nota'),
(48, 'Alice', 'Gialli', 'GLIACE27H01H501Z', 'alice.gialli@example.com', '2027-12-01', 'Como', 2147483647, 'Nessuna nota'),
(49, 'Raffaele', 'Marrone', 'MRRRFL28I01H501Z', 'raffaele.marrone@example.com', '2028-01-01', 'Lecco', 2147483647, 'Nessuna nota'),
(50, 'Caterina', 'Rossi', 'RSSCTR29L01H501Z', 'caterina.rossi@example.com', '2029-02-01', 'Monza', 2147483647, 'Nessuna nota'),
(51, 'Matilde', 'D\'Antino', 'DNTMLD01D04H294L', 'matildedantino@gmail.com', '2001-04-27', 'Rimini', 3381662201, '');

-- --------------------------------------------------------

--
-- Struttura della tabella `prescrizione`
--

CREATE TABLE `prescrizione` (
  `idTerapia` int(11) NOT NULL,
  `nomeFarmaco` varchar(255) NOT NULL,
  `dose` varchar(30) NOT NULL,
  `descrizione` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `prescrizione`
--

INSERT INTO `prescrizione` (`idTerapia`, `nomeFarmaco`, `dose`, `descrizione`) VALUES
(1, 'Ciprofloxacina', '500mg', 'Assumere 2 volta al giorno dopo i pasti'),
(2, 'Sildenafil', '50mg', 'Assumere 1 volta al giorno dopo i pasti'),
(3, 'Citalopram', '20mg', 'Assumere 2 volta al giorno dopo i pasti'),
(3, 'Duloxetina', '30mg', 'Assumere 1 volta al giorno dopo i pasti'),
(3, 'Metoprololo', '50mg', 'Assumere 2 volta al giorno dopo i pasti'),
(4, 'Prednisone', '5mg', 'Assumere 2 volta al giorno prima dei pasti'),
(4, 'Ramipril', '10mg', 'Assumere 1 volta al giorno dopo i pasti'),
(4, 'Warfarin', '5mg', 'Assumere 3 volta al giorno dopo i pasti'),
(6, 'Furosemide', '40mg', 'Assumere 1 volta al giorno dopo i pasti'),
(7, 'Diazepam', '5mg', 'Assumere 1 volta al giorno dopo i pasti'),
(7, 'Metoprololo', '50mg', 'Assumere 3 volta al giorno prima dei pasti'),
(8, 'Aciclovir', '400mg', 'Assumere 3 volta al giorno prima dei pasti'),
(8, 'Escopolamina', '10mg', 'Assumere 2 volta al giorno dopo i pasti'),
(8, 'Omeprazolo', '20mg', 'Assumere 1 volta al giorno dopo i pasti'),
(8, 'Ondansetron', '4mg', 'Assumere 3 volta al giorno dopo i pasti'),
(9, 'Loperamide', '2mg', 'Assumere 3 volta al giorno prima dei pasti'),
(9, 'Tramadolo', '50mg', 'Assumere 2 volta al giorno dopo i pasti'),
(10, 'Clindamicina', '300mg', 'Assumere 1 volta al giorno dopo i pasti'),
(10, 'Diazepam', '5mg', 'Assumere 2 volta al giorno dopo i pasti'),
(11, 'Amoxicillina', '875mg', 'Assumere 3 volta al giorno dopo i pasti'),
(11, 'Ramipril', '10mg', 'Assumere 2 volta al giorno dopo i pasti'),
(11, 'Venlafaxina', '75mg', 'Assumere 3 volta al giorno prima dei pasti'),
(13, 'Amoxicillina', '875mg', 'Assumere 3 volta al giorno dopo i pasti'),
(13, 'Simvastatina', '20mg', 'Assumere 2 volta al giorno prima dei pasti'),
(14, 'Amoxicillina', '875mg', 'Assumere 2 volta al giorno prima dei pasti'),
(14, 'Duloxetina', '30mg', 'Assumere 1 volta al giorno prima dei pasti'),
(14, 'Escopolamina', '10mg', 'Assumere 1 volta al giorno dopo i pasti'),
(14, 'Levotiroxina', '50mcg', 'Assumere 1 volta al giorno prima dei pasti'),
(14, 'Metoprololo', '50mg', 'Assumere 1 volta al giorno prima dei pasti'),
(14, 'Sildenafil', '50mg', 'Assumere 3 volta al giorno prima dei pasti'),
(15, 'Amlodipina', '5mg', 'Assumere 2 volta al giorno prima dei pasti'),
(15, 'Doxiciclina', '100mg', 'Assumere 2 volta al giorno prima dei pasti'),
(17, 'Clindamicina', '300mg', 'Assumere 1 volta al giorno dopo i pasti'),
(17, 'Ibuprofene', '400mg', 'Assumere 3 volta al giorno dopo i pasti'),
(18, 'Aciclovir', '400mg', 'Assumere 1 volta al giorno prima dei pasti'),
(18, 'Alprazolam', '0.5mg', 'Assumere 2 volta al giorno prima dei pasti'),
(18, 'Furosemide', '40mg', 'Assumere 1 volta al giorno dopo i pasti'),
(18, 'Ibuprofene', '400mg', 'Assumere 2 volta al giorno prima dei pasti'),
(19, 'Aciclovir', '400mg', 'Assumere 1 volta al giorno prima dei pasti'),
(19, 'Domperidone', '10mg', 'Assumere 1 volta al giorno dopo i pasti'),
(19, 'Fexofenadina', '180mg', 'Assumere 1 volta al giorno prima dei pasti'),
(19, 'Ranitidina', '150mg', 'Assumere 3 volta al giorno dopo i pasti'),
(20, 'Aciclovir', '400mg', 'Assumere 2 volta al giorno dopo i pasti'),
(20, 'Atorvastatina', '40mg', 'Assumere 1 volta al giorno prima dei pasti'),
(20, 'Metronidazolo', '500mg', 'Assumere 1 volta al giorno prima dei pasti'),
(20, 'Tadalafil', '20mg', 'Assumere 1 volta al giorno dopo i pasti'),
(20, 'Warfarin', '5mg', 'Assumere 2 volta al giorno prima dei pasti'),
(21, 'Diazepam', '5mg', 'Assumere 3 volta al giorno dopo i pasti'),
(21, 'Duloxetina', '30mg', 'Assumere 1 volta al giorno prima dei pasti'),
(21, 'Finasteride', '1mg', 'Assumere 1 volta al giorno prima dei pasti'),
(21, 'Fluoxetina', '20mg', 'Assumere 3 volta al giorno prima dei pasti'),
(21, 'Venlafaxina', '75mg', 'Assumere 2 volta al giorno dopo i pasti'),
(23, 'Prednisone', '5mg', 'Assumere 1 volta al giorno prima dei pasti'),
(23, 'Ramipril', '10mg', 'Assumere 1 volta al giorno prima dei pasti'),
(24, 'Diazepam', '5mg', 'Assumere 2 volta al giorno prima dei pasti'),
(25, 'Ciprofloxacina', '500mg', 'Assumere 2 volta al giorno prima dei pasti'),
(25, 'Ondansetron', '4mg', 'Assumere 1 volta al giorno prima dei pasti'),
(25, 'Paracetamolo', '500mg', 'Assumere 2 volta al giorno prima dei pasti'),
(25, 'Ramipril', '10mg', 'Assumere 2 volta al giorno dopo i pasti'),
(26, 'Amlodipina', '5mg', 'Assumere 1 volta al giorno prima dei pasti'),
(28, 'Bisoprololo', '5mg', 'Assumere 2 volta al giorno prima dei pasti'),
(28, 'Losartan', '50mg', 'Assumere 3 volta al giorno prima dei pasti'),
(28, 'Metronidazolo', '500mg', 'Assumere 1 volta al giorno prima dei pasti'),
(29, 'Diosmina', '500mg', 'Assumere 3 volta al giorno prima dei pasti'),
(29, 'Duloxetina', '30mg', 'Assumere 2 volta al giorno dopo i pasti'),
(29, 'Tadalafil', '20mg', 'Assumere 1 volta al giorno prima dei pasti'),
(31, 'Doxiciclina', '100mg', 'Assumere 1 volta al giorno prima dei pasti'),
(32, 'Fexofenadina', '180mg', 'Assumere 3 volta al giorno prima dei pasti'),
(32, 'Fluconazolo', '150mg', 'Assumere 1 volta al giorno prima dei pasti'),
(32, 'Metformina', '850mg', 'Assumere 1 volta al giorno dopo i pasti'),
(33, 'Escitalopram', '10mg', 'Assumere 2 volta al giorno dopo i pasti'),
(33, 'Simvastatina', '20mg', 'Assumere 3 volta al giorno dopo i pasti'),
(37, 'Amlodipina', '5mg', 'Assumere 2 volta al giorno dopo i pasti'),
(37, 'Clindamicina', '300mg', 'Assumere 2 volta al giorno prima dei pasti'),
(37, 'Loratadina', '10mg', 'Assumere 3 volta al giorno dopo i pasti'),
(38, 'Ramipril', '10mg', 'Assumere 1 volta al giorno prima dei pasti'),
(39, 'Diosmina', '500mg', 'Assumere 2 volta al giorno prima dei pasti'),
(39, 'Ondansetron', '4mg', 'Assumere 1 volta al giorno prima dei pasti'),
(39, 'Sildenafil', '50mg', 'Assumere 1 volta al giorno prima dei pasti'),
(40, 'Clindamicina', '300mg', 'Assumere 3 volta al giorno dopo i pasti'),
(40, 'Ramipril', '10mg', 'Assumere 3 volta al giorno prima dei pasti'),
(41, 'Metoprololo', '50mg', 'Assumere 3 volta al giorno dopo i pasti'),
(41, 'Pantoprazolo', '40mg', 'Assumere 1 volta al giorno prima dei pasti'),
(42, 'Finasteride', '1mg', 'Assumere 2 volta al giorno prima dei pasti'),
(43, 'Alprazolam', '0.5mg', 'Assumere 1 volta al giorno prima dei pasti'),
(43, 'Amoxicillina', '875mg', 'Assumere 1 volta al giorno dopo i pasti'),
(43, 'Clindamicina', '300mg', 'Assumere 3 volta al giorno dopo i pasti'),
(43, 'Simvastatina', '20mg', 'Assumere 3 volta al giorno prima dei pasti'),
(44, 'Cetirizina', '10mg', 'Assumere 2 volta al giorno prima dei pasti'),
(44, 'Metronidazolo', '500mg', 'Assumere 2 volta al giorno prima dei pasti'),
(44, 'Ranitidina', '150mg', 'Assumere 1 volta al giorno prima dei pasti'),
(46, 'Alprazolam', '0.5mg', 'Assumere 1 volta al giorno prima dei pasti'),
(47, 'Escopolamina', '10mg', 'Assumere 2 volta al giorno prima dei pasti'),
(47, 'Sertralina', '50mg', 'Assumere 2 volta al giorno prima dei pasti'),
(48, 'Desloratadina', '5mg', 'Assumere 1 volta al giorno prima dei pasti'),
(48, 'Diosmina', '500mg', 'Assumere 2 volta al giorno dopo i pasti'),
(49, 'Desloratadina', '5mg', 'Assumere 2 volta al giorno dopo i pasti'),
(49, 'Paracetamolo', '500mg', 'Assumere 3 volta al giorno dopo i pasti'),
(50, 'Escopolamina', '10mg', 'Assumere 1 volta al giorno prima dei pasti'),
(50, 'Metformina', '850mg', 'Assumere 1 volta al giorno dopo i pasti'),
(52, 'Bisoprololo', '5mg', '3 volte/die min ogni 6 ore a stomaco pieno'),
(53, 'Atorvastatina', '40mg', '4 volte al giorno');

-- --------------------------------------------------------

--
-- Struttura della tabella `prestazione`
--

CREATE TABLE `prestazione` (
  `idPaziente` int(6) NOT NULL,
  `idPrestazione` int(6) NOT NULL,
  `dataInizio` date NOT NULL,
  `dataFine` date DEFAULT NULL,
  `codicePrestazione` varchar(6) NOT NULL,
  `ora` time(1) NOT NULL,
  `sala` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `prestazione`
--

INSERT INTO `prestazione` (`idPaziente`, `idPrestazione`, `dataInizio`, `dataFine`, `codicePrestazione`, `ora`, `sala`) VALUES
(1, 1, '2024-07-01', '2024-07-05', 'R001', '08:00:00.0', 104),
(2, 2, '2024-07-02', NULL, 'I001', '09:00:00.0', 101),
(3, 3, '2024-07-03', NULL, 'V001', '10:00:00.0', 103),
(4, 4, '2024-07-04', NULL, 'I002', '11:00:00.0', 102),
(5, 5, '2024-07-05', NULL, 'V002', '12:00:00.0', 106),
(6, 6, '2024-07-06', '2024-07-10', 'R001', '13:00:00.0', 104),
(7, 7, '2024-07-07', NULL, 'I003', '14:00:00.0', 101),
(8, 8, '2024-07-08', NULL, 'V003', '15:00:00.0', 110),
(9, 9, '2024-07-09', NULL, 'I004', '16:00:00.0', 108),
(10, 10, '2024-07-10', NULL, 'V004', '17:00:00.0', 113),
(11, 11, '2024-07-11', '2024-07-15', 'R001', '08:00:00.0', 105),
(12, 12, '2024-07-12', NULL, 'I005', '09:00:00.0', 102),
(13, 13, '2024-07-13', NULL, 'V005', '10:00:00.0', 103),
(14, 14, '2024-07-14', NULL, 'I006', '11:00:00.0', 108),
(15, 15, '2024-07-15', NULL, 'V006', '12:00:00.0', 106),
(16, 16, '2024-07-16', '2024-07-20', 'R001', '13:00:00.0', 104),
(17, 17, '2024-07-17', NULL, 'I007', '14:00:00.0', 101),
(18, 18, '2024-07-18', NULL, 'V007', '15:00:00.0', 110),
(19, 19, '2024-07-19', NULL, 'I008', '16:00:00.0', 108),
(20, 20, '2024-07-20', NULL, 'V008', '17:00:00.0', 113),
(21, 21, '2024-07-21', '2024-07-25', 'R001', '08:00:00.0', 107),
(22, 22, '2024-07-22', NULL, 'I009', '09:00:00.0', 101),
(23, 23, '2024-07-23', NULL, 'V001', '10:00:00.0', 106),
(24, 24, '2024-07-24', NULL, 'I010', '11:00:00.0', 108),
(25, 25, '2024-07-25', NULL, 'V002', '12:00:00.0', 110),
(26, 26, '2024-07-26', '2024-07-30', 'R001', '13:00:00.0', 104),
(27, 27, '2024-07-27', NULL, 'I011', '14:00:00.0', 102),
(28, 28, '2024-07-28', NULL, 'V003', '15:00:00.0', 103),
(29, 29, '2024-07-29', NULL, 'I012', '16:00:00.0', 108),
(30, 30, '2024-07-30', NULL, 'V004', '17:00:00.0', 113),
(31, 31, '2024-07-31', '2024-08-04', 'R001', '08:00:00.0', 105),
(32, 32, '2024-08-01', NULL, 'I013', '09:00:00.0', 101),
(33, 33, '2024-08-02', NULL, 'V005', '10:00:00.0', 110),
(34, 34, '2024-08-03', NULL, 'I014', '11:00:00.0', 108),
(35, 35, '2024-08-04', NULL, 'V006', '12:00:00.0', 106),
(36, 36, '2024-08-05', '2024-08-09', 'R001', '13:00:00.0', 104),
(37, 37, '2024-08-06', NULL, 'I015', '14:00:00.0', 102),
(38, 38, '2024-08-07', NULL, 'V007', '15:00:00.0', 103),
(39, 39, '2024-08-08', NULL, 'I016', '16:00:00.0', 108),
(40, 40, '2024-08-09', NULL, 'V008', '17:00:00.0', 113),
(41, 41, '2024-08-10', '2024-08-14', 'R001', '08:00:00.0', 111),
(42, 42, '2024-08-11', NULL, 'I001', '09:00:00.0', 101),
(43, 43, '2024-08-12', NULL, 'V001', '10:00:00.0', 106),
(44, 44, '2024-08-13', NULL, 'I002', '11:00:00.0', 108),
(45, 45, '2024-08-14', NULL, 'V002', '12:00:00.0', 110),
(46, 46, '2024-08-15', '2024-08-19', 'R001', '13:00:00.0', 104),
(47, 47, '2024-08-16', NULL, 'I003', '14:00:00.0', 102),
(48, 48, '2024-08-17', NULL, 'V003', '15:00:00.0', 103),
(49, 49, '2024-08-18', NULL, 'I004', '16:00:00.0', 108),
(50, 50, '2024-08-19', NULL, 'V004', '17:00:00.0', 113),
(1, 51, '2024-07-21', '2024-07-24', 'R001', '06:00:00.0', 107),
(2, 52, '2024-08-21', NULL, 'I005', '09:00:00.0', 101),
(3, 53, '2024-08-22', NULL, 'V005', '10:00:00.0', 110),
(4, 54, '2024-08-23', NULL, 'I006', '11:00:00.0', 108),
(5, 55, '2024-08-24', NULL, 'V006', '12:00:00.0', 106),
(6, 56, '2024-08-25', '2024-08-29', 'R001', '13:00:00.0', 104),
(7, 57, '2024-08-26', NULL, 'I007', '14:00:00.0', 101),
(8, 58, '2024-08-27', NULL, 'V007', '15:00:00.0', 103),
(9, 59, '2024-08-28', NULL, 'I008', '16:00:00.0', 108),
(10, 60, '2024-08-29', NULL, 'V008', '17:00:00.0', 113),
(11, 61, '2024-08-30', '2024-09-03', 'R001', '08:00:00.0', 105),
(12, 62, '2024-08-31', NULL, 'I009', '09:00:00.0', 102),
(13, 63, '2024-09-01', NULL, 'V001', '10:00:00.0', 110),
(14, 64, '2024-09-02', NULL, 'I010', '11:00:00.0', 108),
(15, 65, '2024-09-03', NULL, 'V002', '12:00:00.0', 106),
(16, 66, '2024-09-04', '2024-09-08', 'R001', '13:00:00.0', 104),
(17, 67, '2024-09-05', NULL, 'I011', '14:00:00.0', 101),
(18, 68, '2024-09-06', NULL, 'V003', '15:00:00.0', 103),
(19, 69, '2024-09-07', NULL, 'I012', '16:00:00.0', 108),
(20, 70, '2024-09-08', NULL, 'V004', '17:00:00.0', 113),
(21, 71, '2024-09-09', '2024-09-13', 'R001', '08:00:00.0', 111),
(22, 72, '2024-09-10', NULL, 'I013', '09:00:00.0', 102),
(23, 73, '2024-09-11', NULL, 'V005', '10:00:00.0', 106),
(24, 74, '2024-09-12', NULL, 'I014', '11:00:00.0', 108),
(25, 75, '2024-09-13', NULL, 'V006', '12:00:00.0', 110),
(26, 76, '2024-09-14', '2024-09-18', 'R001', '13:00:00.0', 104),
(27, 77, '2024-09-15', NULL, 'I015', '14:00:00.0', 101),
(28, 78, '2024-09-16', NULL, 'V007', '15:00:00.0', 103),
(29, 79, '2024-09-17', NULL, 'I016', '16:00:00.0', 108),
(30, 80, '2024-09-18', NULL, 'V008', '17:00:00.0', 113),
(31, 81, '2024-09-19', '2024-09-23', 'R001', '08:00:00.0', 105),
(32, 82, '2024-09-20', NULL, 'I001', '09:00:00.0', 101),
(33, 83, '2024-09-21', NULL, 'V001', '10:00:00.0', 110),
(34, 84, '2024-09-22', NULL, 'I002', '11:00:00.0', 108),
(35, 85, '2024-09-23', NULL, 'V002', '12:00:00.0', 106),
(36, 86, '2024-09-24', '2024-09-28', 'R001', '13:00:00.0', 104),
(37, 87, '2024-09-25', NULL, 'I003', '14:00:00.0', 102),
(38, 88, '2024-09-26', NULL, 'V003', '15:00:00.0', 103),
(39, 89, '2024-09-27', NULL, 'I004', '16:00:00.0', 108),
(40, 90, '2024-09-28', NULL, 'V004', '17:00:00.0', 113),
(41, 91, '2024-09-29', '2024-10-03', 'R001', '08:00:00.0', 111),
(42, 92, '2024-09-30', NULL, 'I005', '09:00:00.0', 101),
(43, 93, '2024-10-01', NULL, 'V005', '10:00:00.0', 110),
(44, 94, '2024-10-02', NULL, 'I006', '11:00:00.0', 108),
(45, 95, '2024-10-03', NULL, 'V006', '12:00:00.0', 106),
(46, 96, '2024-10-04', '2024-10-08', 'R001', '13:00:00.0', 104),
(47, 97, '2024-10-05', NULL, 'I007', '14:00:00.0', 101),
(48, 98, '2024-10-06', NULL, 'V007', '15:00:00.0', 103),
(49, 99, '2024-10-07', NULL, 'I008', '16:00:00.0', 108),
(50, 100, '2024-10-08', NULL, 'V008', '17:00:00.0', 113),
(7, 101, '0000-00-00', NULL, 'V007', '00:00:15.0', 110),
(7, 102, '2024-07-24', NULL, 'V007', '15:00:00.0', 110),
(2, 103, '2024-02-20', '2024-02-25', 'R001', '11:00:00.0', 104),
(3, 104, '2024-03-10', NULL, 'V001', '12:00:00.0', 103),
(4, 105, '2024-04-22', NULL, 'I002', '13:00:00.0', 101),
(5, 106, '2024-05-05', NULL, 'V002', '09:00:00.0', 103),
(6, 107, '2024-06-17', '2024-06-20', 'R001', '14:00:00.0', 104),
(7, 108, '2024-09-09', NULL, 'I003', '15:00:00.0', 102),
(8, 109, '2024-10-14', NULL, 'V003', '16:00:00.0', 103),
(9, 110, '2024-11-21', '2024-11-26', 'R001', '17:00:00.0', 104),
(10, 111, '2024-12-04', NULL, 'I004', '10:00:00.0', 101),
(11, 112, '2024-01-19', NULL, 'V004', '11:00:00.0', 106),
(12, 113, '2024-02-27', '2024-02-28', 'R001', '12:00:00.0', 105),
(13, 114, '2024-03-08', NULL, 'I005', '13:00:00.0', 102),
(14, 115, '2024-04-16', NULL, 'V005', '14:00:00.0', 110),
(15, 116, '2024-05-23', '2024-05-28', 'R001', '15:00:00.0', 107),
(16, 117, '2024-06-30', NULL, 'I006', '16:00:00.0', 101),
(17, 118, '2024-09-18', NULL, 'V006', '17:00:00.0', 113),
(18, 119, '2024-10-25', '2024-10-30', 'R001', '10:00:00.0', 112),
(19, 120, '2024-11-05', NULL, 'I007', '11:00:00.0', 108),
(20, 121, '2024-12-13', NULL, 'V007', '12:00:00.0', 106),
(21, 122, '2024-01-07', '2024-01-12', 'R001', '13:00:00.0', 109),
(22, 123, '2024-02-15', NULL, 'I008', '14:00:00.0', 101),
(23, 124, '2024-03-22', NULL, 'V008', '15:00:00.0', 110),
(24, 125, '2024-04-29', '2024-05-04', 'R001', '16:00:00.0', 111),
(25, 126, '2024-05-12', NULL, 'I009', '17:00:00.0', 102),
(26, 127, '2024-06-20', NULL, 'V001', '10:00:00.0', 103),
(27, 128, '2024-09-29', '2024-10-04', 'R001', '11:00:00.0', 104),
(28, 129, '2024-10-06', NULL, 'I010', '12:00:00.0', 101),
(29, 130, '2024-11-14', NULL, 'V002', '13:00:00.0', 106),
(30, 131, '2024-12-21', '2024-12-26', 'R001', '14:00:00.0', 105),
(31, 132, '2024-01-10', NULL, 'I011', '15:00:00.0', 102),
(32, 133, '2024-02-18', NULL, 'V003', '16:00:00.0', 110),
(33, 134, '2024-03-25', '2024-03-30', 'R001', '17:00:00.0', 107),
(34, 135, '2024-04-04', NULL, 'I012', '10:00:00.0', 101),
(35, 136, '2024-05-11', NULL, 'V004', '11:00:00.0', 113),
(36, 137, '2024-06-18', '2024-06-23', 'R001', '12:00:00.0', 112),
(37, 138, '2024-09-08', NULL, 'I013', '13:00:00.0', 108),
(38, 139, '2024-10-13', NULL, 'V005', '14:00:00.0', 106),
(39, 140, '2024-11-20', '2024-11-25', 'R001', '15:00:00.0', 109),
(40, 141, '2024-12-03', NULL, 'I014', '16:00:00.0', 101),
(41, 142, '2024-01-18', NULL, 'V006', '17:00:00.0', 110),
(42, 143, '2024-02-26', '2024-03-02', 'R001', '10:00:00.0', 111),
(43, 144, '2024-03-07', NULL, 'I015', '11:00:00.0', 102),
(44, 145, '2024-04-15', NULL, 'V007', '12:00:00.0', 103),
(45, 146, '2024-05-22', '2024-05-27', 'R001', '13:00:00.0', 104),
(46, 147, '2024-06-29', NULL, 'I016', '14:00:00.0', 101),
(47, 148, '2024-09-17', NULL, 'V008', '15:00:00.0', 106),
(48, 149, '2024-10-24', '2024-10-29', 'R001', '16:00:00.0', 105),
(49, 150, '2024-11-04', NULL, 'I001', '17:00:00.0', 102),
(50, 151, '2024-12-12', NULL, 'V001', '10:00:00.0', 110),
(1, 152, '2024-01-06', '2024-01-11', 'R001', '11:00:00.0', 107),
(2, 153, '2024-02-14', NULL, 'I002', '12:00:00.0', 101),
(3, 154, '2024-03-21', NULL, 'V002', '13:00:00.0', 113),
(4, 155, '2024-04-28', '2024-05-03', 'R001', '14:00:00.0', 112),
(5, 156, '2024-05-11', NULL, 'I003', '15:00:00.0', 108),
(6, 157, '2024-06-19', NULL, 'V003', '16:00:00.0', 106),
(7, 158, '2024-09-28', '2024-10-03', 'R001', '17:00:00.0', 109),
(8, 159, '2024-10-05', NULL, 'I004', '10:00:00.0', 101),
(9, 160, '2024-11-13', NULL, 'V004', '11:00:00.0', 110),
(10, 161, '2024-12-20', '2024-12-25', 'R001', '12:00:00.0', 111),
(11, 162, '2024-01-09', NULL, 'I005', '13:00:00.0', 102),
(12, 163, '2024-02-17', NULL, 'V005', '14:00:00.0', 103),
(13, 164, '2024-03-24', '2024-03-29', 'R001', '15:00:00.0', 104),
(14, 165, '2024-04-03', NULL, 'I006', '16:00:00.0', 101),
(15, 166, '2024-05-10', NULL, 'V006', '17:00:00.0', 106),
(16, 167, '2024-06-17', '2024-06-22', 'R001', '10:00:00.0', 105),
(17, 168, '2024-09-07', NULL, 'I007', '11:00:00.0', 102),
(18, 169, '2024-10-12', NULL, 'V007', '12:00:00.0', 110),
(19, 170, '2024-11-19', '2024-11-24', 'R001', '13:00:00.0', 107),
(20, 171, '2024-12-02', NULL, 'I008', '14:00:00.0', 101),
(21, 172, '2024-01-17', NULL, 'V008', '15:00:00.0', 113),
(22, 173, '2024-02-25', '2024-03-01', 'R001', '16:00:00.0', 112),
(23, 174, '2024-03-06', NULL, 'I009', '17:00:00.0', 108),
(24, 175, '2024-04-14', NULL, 'V001', '10:00:00.0', 106),
(25, 176, '2024-05-21', '2024-05-26', 'R001', '11:00:00.0', 109),
(26, 177, '2024-06-28', NULL, 'I010', '12:00:00.0', 101),
(27, 178, '2024-09-16', NULL, 'V002', '13:00:00.0', 110),
(28, 179, '2024-10-23', '2024-10-28', 'R001', '14:00:00.0', 111),
(29, 180, '2024-11-03', NULL, 'I011', '15:00:00.0', 102),
(30, 181, '2024-12-11', NULL, 'V003', '16:00:00.0', 103),
(31, 182, '2024-01-05', '2024-01-10', 'R001', '17:00:00.0', 104),
(32, 183, '2024-02-13', NULL, 'I012', '10:00:00.0', 101),
(33, 184, '2024-03-20', NULL, 'V004', '11:00:00.0', 106),
(34, 185, '2024-04-27', '2024-05-02', 'R001', '12:00:00.0', 105),
(35, 186, '2024-05-10', NULL, 'I013', '13:00:00.0', 102),
(36, 187, '2024-06-18', NULL, 'V005', '14:00:00.0', 110),
(37, 188, '2024-09-27', '2024-10-02', 'R001', '15:00:00.0', 107),
(38, 189, '2024-10-04', NULL, 'I014', '16:00:00.0', 101),
(39, 190, '2024-11-12', NULL, 'V006', '17:00:00.0', 113),
(40, 191, '2024-12-19', '2024-12-24', 'R001', '10:00:00.0', 112),
(41, 192, '2024-01-08', NULL, 'I015', '11:00:00.0', 108),
(42, 193, '2024-02-16', NULL, 'V007', '12:00:00.0', 106),
(43, 194, '2024-03-23', '2024-03-28', 'R001', '13:00:00.0', 109),
(44, 195, '2024-04-02', NULL, 'I016', '14:00:00.0', 101),
(45, 196, '2024-05-09', NULL, 'V008', '15:00:00.0', 110),
(46, 197, '2024-06-16', '2024-06-21', 'R001', '16:00:00.0', 111),
(47, 198, '2024-09-06', NULL, 'I001', '17:00:00.0', 102),
(48, 199, '2024-10-11', NULL, 'V001', '10:00:00.0', 103),
(49, 200, '2024-11-18', '2024-11-23', 'R001', '11:00:00.0', 104),
(50, 201, '2024-12-01', NULL, 'I002', '12:00:00.0', 101),
(7, 202, '2024-07-16', NULL, 'V006', '10:00:00.0', 106),
(6, 203, '2024-07-22', NULL, 'V008', '10:00:00.0', 106),
(4, 204, '2024-07-18', NULL, 'I005', '17:00:00.0', 108);

-- --------------------------------------------------------

--
-- Struttura della tabella `receptionist`
--

CREATE TABLE `receptionist` (
  `nBadge` varchar(6) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `cognome` varchar(20) NOT NULL,
  `CF` varchar(16) DEFAULT NULL,
  `emailAziendale` varchar(300) NOT NULL,
  `dataNascita` date NOT NULL,
  `luogoNascita` varchar(20) NOT NULL,
  `recapitoTelefonico` bigint(1) NOT NULL,
  `password` varchar(20) NOT NULL,
  `inizioRapporto` date NOT NULL,
  `fineRapporto` date DEFAULT NULL,
  `idAmministratore` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `receptionist`
--

INSERT INTO `receptionist` (`nBadge`, `nome`, `cognome`, `CF`, `emailAziendale`, `dataNascita`, `luogoNascita`, `recapitoTelefonico`, `password`, `inizioRapporto`, `fineRapporto`, `idAmministratore`) VALUES
('R001', 'Maria', 'Rossi', 'RSSMRA90A01H501Z', 'maria.rossi@clinica.it', '1990-01-01', 'Roma', 2147483647, 'p@ssw0rd1', '2020-03-15', NULL, 'A001'),
('R002', 'Luca', 'Bianchi', NULL, 'luca.bianchi@clinica.it', '1988-07-22', 'Milano', 2147483647, 'securePass2', '2021-09-01', NULL, 'A002'),
('R003', 'Giulia', 'Verdi', 'VRDGLI95B02L219X', 'giulia.verdi@clinica.it', '1995-02-02', 'Torino', 2147483647, 'strongPwd3!', '2019-11-30', '2024-06-30', 'A001'),
('R004', 'Marco', 'Neri', NULL, 'marco.neri@clinica.it', '1992-12-10', 'Napoli', 2147483647, 'safePassword4', '2022-05-01', NULL, 'A003'),
('R005', 'Mario', 'Rossi', 'RSSMRA80A01H501Z', 'mario.rossi@clinicprive.com', '1980-01-01', 'Roma', 3912345678, 'securepassword', '2024-07-01', NULL, 'A001');

-- --------------------------------------------------------

--
-- Struttura della tabella `responsabile`
--

CREATE TABLE `responsabile` (
  `idPrestazione` int(6) NOT NULL,
  `nBadge` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `responsabile`
--

INSERT INTO `responsabile` (`idPrestazione`, `nBadge`) VALUES
(2, 'M001'),
(2, 'M003'),
(4, 'M002'),
(4, 'M005'),
(7, 'M003'),
(7, 'M007'),
(9, 'M004'),
(9, 'M009'),
(12, 'M005'),
(12, 'M011'),
(14, 'M006'),
(14, 'M013'),
(17, 'M007'),
(17, 'M015'),
(19, 'M003'),
(19, 'M008'),
(22, 'M005'),
(22, 'M009'),
(24, 'M007'),
(24, 'M010'),
(27, 'M009'),
(27, 'M011'),
(29, 'M011'),
(29, 'M012'),
(32, 'M011'),
(32, 'M013'),
(34, 'M014'),
(34, 'M015'),
(37, 'M003'),
(37, 'M015'),
(39, 'M001'),
(39, 'M005'),
(42, 'M002'),
(42, 'M007'),
(44, 'M003'),
(44, 'M009'),
(47, 'M004'),
(47, 'M011'),
(49, 'M005'),
(49, 'M013'),
(52, 'M006'),
(52, 'M015'),
(54, 'M003'),
(54, 'M007'),
(57, 'M005'),
(57, 'M008'),
(59, 'M007'),
(59, 'M009'),
(62, 'M009'),
(62, 'M010'),
(64, 'M010'),
(64, 'M011'),
(67, 'M012'),
(67, 'M013'),
(69, 'M013'),
(69, 'M015'),
(72, 'M003'),
(72, 'M014'),
(74, 'M005'),
(74, 'M015'),
(77, 'M001'),
(77, 'M007'),
(79, 'M002'),
(79, 'M009'),
(82, 'M003'),
(82, 'M011'),
(84, 'M004'),
(84, 'M013'),
(87, 'M005'),
(87, 'M015'),
(89, 'M003'),
(89, 'M006'),
(92, 'M005'),
(92, 'M007'),
(94, 'M007'),
(94, 'M008'),
(97, 'M006'),
(97, 'M009'),
(99, 'M010'),
(99, 'M011'),
(102, 'M001'),
(102, 'M002'),
(103, 'M003'),
(103, 'M004'),
(104, 'M005'),
(104, 'M006'),
(105, 'M007'),
(105, 'M008'),
(106, 'M009'),
(106, 'M010'),
(107, 'M011'),
(107, 'M012'),
(108, 'M013'),
(108, 'M014'),
(109, 'M001'),
(109, 'M015'),
(110, 'M002'),
(110, 'M003'),
(111, 'M004'),
(111, 'M005'),
(112, 'M006'),
(112, 'M007'),
(113, 'M008'),
(113, 'M009'),
(114, 'M010'),
(114, 'M011'),
(115, 'M012'),
(115, 'M013'),
(116, 'M014'),
(116, 'M015'),
(117, 'M001'),
(117, 'M002'),
(118, 'M005'),
(118, 'M006'),
(119, 'M007'),
(119, 'M008'),
(120, 'M009'),
(120, 'M010'),
(121, 'M011'),
(121, 'M012'),
(122, 'M013'),
(122, 'M014'),
(123, 'M001'),
(123, 'M015'),
(124, 'M002'),
(124, 'M003'),
(125, 'M004'),
(125, 'M005'),
(126, 'M006'),
(126, 'M007'),
(127, 'M008'),
(127, 'M009'),
(128, 'M010'),
(128, 'M011'),
(129, 'M012'),
(129, 'M013'),
(130, 'M014'),
(130, 'M015'),
(131, 'M001'),
(131, 'M002'),
(132, 'M003'),
(132, 'M004'),
(133, 'M005'),
(133, 'M006'),
(134, 'M007'),
(134, 'M008'),
(135, 'M009'),
(135, 'M010'),
(136, 'M011'),
(136, 'M012'),
(137, 'M013'),
(137, 'M014'),
(138, 'M001'),
(138, 'M015'),
(139, 'M002'),
(139, 'M003'),
(140, 'M004'),
(140, 'M005'),
(141, 'M006'),
(141, 'M007'),
(142, 'M008'),
(142, 'M009'),
(143, 'M010'),
(143, 'M011'),
(144, 'M012'),
(144, 'M013'),
(145, 'M014'),
(145, 'M015'),
(146, 'M001'),
(146, 'M002'),
(147, 'M003'),
(147, 'M004'),
(148, 'M005'),
(148, 'M006'),
(149, 'M007'),
(149, 'M008'),
(150, 'M009'),
(150, 'M010'),
(151, 'M011'),
(151, 'M012'),
(152, 'M003'),
(152, 'M004'),
(153, 'M005'),
(153, 'M006'),
(154, 'M007'),
(154, 'M008'),
(155, 'M009'),
(155, 'M010'),
(156, 'M011'),
(156, 'M012'),
(157, 'M013'),
(157, 'M014'),
(158, 'M001'),
(158, 'M015'),
(159, 'M002'),
(159, 'M003'),
(160, 'M004'),
(160, 'M005'),
(161, 'M006'),
(161, 'M007'),
(162, 'M008'),
(162, 'M009'),
(163, 'M010'),
(163, 'M011'),
(164, 'M012'),
(164, 'M013'),
(165, 'M014'),
(165, 'M015'),
(166, 'M001'),
(166, 'M002'),
(167, 'M003'),
(167, 'M004'),
(168, 'M005'),
(168, 'M006'),
(169, 'M007'),
(169, 'M008'),
(170, 'M009'),
(170, 'M010'),
(171, 'M011'),
(171, 'M012'),
(172, 'M013'),
(172, 'M014'),
(173, 'M001'),
(173, 'M015'),
(174, 'M002'),
(174, 'M003'),
(175, 'M004'),
(175, 'M005'),
(176, 'M006'),
(176, 'M007'),
(177, 'M008'),
(177, 'M009'),
(178, 'M010'),
(178, 'M011'),
(179, 'M012'),
(179, 'M013'),
(180, 'M014'),
(180, 'M015'),
(181, 'M001'),
(181, 'M002'),
(182, 'M003'),
(182, 'M004'),
(183, 'M005'),
(183, 'M006'),
(184, 'M007'),
(184, 'M008'),
(185, 'M009'),
(185, 'M010'),
(186, 'M011'),
(186, 'M012'),
(187, 'M013'),
(187, 'M014'),
(188, 'M001'),
(188, 'M015'),
(189, 'M002'),
(189, 'M003'),
(190, 'M004'),
(190, 'M005'),
(191, 'M006'),
(191, 'M007'),
(192, 'M008'),
(192, 'M009'),
(193, 'M010'),
(193, 'M011'),
(194, 'M012'),
(194, 'M013'),
(195, 'M014'),
(195, 'M015'),
(196, 'M001'),
(196, 'M002'),
(197, 'M003'),
(197, 'M004'),
(198, 'M005'),
(198, 'M006'),
(199, 'M007'),
(199, 'M008'),
(200, 'M009'),
(200, 'M010'),
(204, 'M005'),
(204, 'M008');

-- --------------------------------------------------------

--
-- Struttura della tabella `rifornimento`
--

CREATE TABLE `rifornimento` (
  `idOrdine` int(5) NOT NULL,
  `idMateriale` int(6) NOT NULL,
  `quantita` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `rifornimento`
--

INSERT INTO `rifornimento` (`idOrdine`, `idMateriale`, `quantita`) VALUES
(1, 1, 10),
(1, 2, 5),
(1, 3, 15),
(2, 4, 8),
(2, 5, 12),
(2, 6, 7),
(3, 7, 10),
(3, 8, 5),
(3, 9, 15),
(4, 10, 8),
(4, 11, 12),
(4, 12, 7),
(5, 13, 10),
(5, 14, 5),
(5, 15, 15),
(6, 16, 8),
(6, 17, 12),
(6, 18, 7),
(7, 19, 10),
(7, 20, 5),
(7, 21, 15),
(8, 22, 8),
(8, 23, 12),
(8, 24, 7),
(9, 1, 5),
(9, 2, 15),
(9, 25, 10),
(10, 3, 8),
(10, 4, 12),
(10, 5, 7),
(11, 6, 10),
(11, 7, 5),
(11, 8, 15),
(12, 9, 8),
(12, 10, 12),
(12, 11, 7),
(13, 12, 10),
(13, 13, 5),
(13, 14, 15),
(14, 15, 8),
(14, 16, 12),
(14, 17, 7),
(15, 18, 10),
(15, 19, 5),
(15, 20, 15),
(16, 21, 8),
(16, 22, 12),
(16, 23, 7),
(17, 1, 15),
(17, 24, 10),
(17, 25, 5),
(18, 2, 8),
(18, 3, 12),
(18, 4, 7),
(19, 5, 10),
(19, 6, 5),
(19, 7, 15),
(20, 8, 8),
(20, 9, 12),
(20, 10, 7),
(21, 11, 10),
(21, 12, 5),
(21, 13, 15),
(22, 14, 8),
(22, 15, 12),
(22, 16, 7),
(23, 17, 10),
(23, 18, 5),
(23, 19, 15),
(24, 20, 8),
(24, 21, 12),
(24, 22, 7),
(25, 23, 10),
(25, 24, 5),
(25, 25, 15),
(26, 5, 30),
(26, 9, 5),
(26, 10, 100),
(26, 11, 50),
(26, 50, 200);

-- --------------------------------------------------------

--
-- Struttura della tabella `sala`
--

CREATE TABLE `sala` (
  `numero` int(3) NOT NULL,
  `tipo` varchar(15) NOT NULL,
  `postiLetto` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `sala`
--

INSERT INTO `sala` (`numero`, `tipo`, `postiLetto`) VALUES
(101, 'chirurgica', NULL),
(102, 'chirurgica', NULL),
(103, 'ambulatorio', NULL),
(104, 'stanza', 2),
(105, 'stanza', 1),
(106, 'ambulatorio', NULL),
(107, 'stanza', 3),
(108, 'chirurgica', NULL),
(109, 'stanza', 2),
(110, 'ambulatorio', NULL),
(111, 'stanza', 1),
(112, 'stanza', 3),
(113, 'ambulatorio', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `terapia`
--

CREATE TABLE `terapia` (
  `idTerapia` int(11) NOT NULL,
  `idPaziente` int(6) NOT NULL,
  `dataScadenza` date NOT NULL,
  `idMedico` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `terapia`
--

INSERT INTO `terapia` (`idTerapia`, `idPaziente`, `dataScadenza`, `idMedico`) VALUES
(1, 1, '2024-07-10', 'M001'),
(2, 2, '2024-07-11', 'M002'),
(3, 3, '2024-07-12', 'M003'),
(4, 4, '2024-07-13', 'M004'),
(5, 5, '2024-07-14', 'M005'),
(6, 6, '2024-07-15', 'M006'),
(7, 7, '2024-07-16', 'M007'),
(8, 8, '2024-07-17', 'M008'),
(9, 9, '2024-07-18', 'M009'),
(10, 10, '2024-07-19', 'M010'),
(11, 11, '2024-07-20', 'M011'),
(12, 12, '2024-07-21', 'M012'),
(13, 13, '2024-07-22', 'M013'),
(14, 14, '2024-07-23', 'M014'),
(15, 15, '2024-07-24', 'M015'),
(16, 1, '2024-07-25', 'M002'),
(17, 2, '2024-07-26', 'M003'),
(18, 3, '2024-07-27', 'M004'),
(19, 4, '2024-07-28', 'M005'),
(20, 5, '2024-07-29', 'M006'),
(21, 6, '2024-07-30', 'M007'),
(22, 7, '2024-07-31', 'M008'),
(23, 8, '2024-08-01', 'M009'),
(24, 9, '2024-08-02', 'M010'),
(25, 10, '2024-08-03', 'M011'),
(26, 11, '2024-08-04', 'M012'),
(27, 12, '2024-08-05', 'M013'),
(28, 13, '2024-08-06', 'M014'),
(29, 14, '2024-08-07', 'M015'),
(30, 15, '2024-08-08', 'M001'),
(31, 16, '2024-08-09', 'M002'),
(32, 17, '2024-08-10', 'M003'),
(33, 18, '2024-08-11', 'M004'),
(34, 19, '2024-08-12', 'M005'),
(35, 20, '2024-08-13', 'M006'),
(36, 21, '2024-08-14', 'M007'),
(37, 22, '2024-08-15', 'M008'),
(38, 23, '2024-08-16', 'M009'),
(39, 24, '2024-08-17', 'M010'),
(40, 25, '2024-08-18', 'M011'),
(41, 26, '2024-08-19', 'M012'),
(42, 27, '2024-08-20', 'M013'),
(43, 28, '2024-08-21', 'M014'),
(44, 29, '2024-08-22', 'M015'),
(45, 30, '2024-08-23', 'M001'),
(46, 31, '2024-08-24', 'M002'),
(47, 32, '2024-08-25', 'M003'),
(48, 33, '2024-08-26', 'M004'),
(49, 34, '2024-08-27', 'M005'),
(50, 35, '2024-08-28', 'M006'),
(51, 2, '2024-07-26', 'M001'),
(52, 2, '2024-07-26', 'M001'),
(53, 2, '2025-05-22', 'M001');

-- --------------------------------------------------------

--
-- Struttura della tabella `turnomedico`
--

CREATE TABLE `turnomedico` (
  `nBadge` varchar(6) NOT NULL,
  `data` date NOT NULL,
  `tipoTurno` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `turnomedico`
--

INSERT INTO `turnomedico` (`nBadge`, `data`, `tipoTurno`) VALUES
('M001', '2024-07-01', 'M'),
('M001', '2024-07-03', 'P'),
('M001', '2024-07-06', 'M'),
('M001', '2024-07-09', 'N'),
('M001', '2024-07-12', 'P'),
('M001', '2024-07-15', 'M'),
('M001', '2024-07-17', 'P'),
('M001', '2024-07-20', 'M'),
('M001', '2024-07-23', 'N'),
('M001', '2024-07-26', 'P'),
('M001', '2024-07-27', 'M'),
('M001', '2024-07-29', 'M'),
('M001', '2024-07-31', 'P'),
('M002', '2024-07-01', 'P'),
('M002', '2024-07-04', 'M'),
('M002', '2024-07-06', 'P'),
('M002', '2024-07-09', 'M'),
('M002', '2024-07-12', 'N'),
('M002', '2024-07-15', 'P'),
('M002', '2024-07-18', 'M'),
('M002', '2024-07-20', 'P'),
('M002', '2024-07-23', 'M'),
('M002', '2024-07-26', 'N'),
('M002', '2024-07-27', 'M'),
('M002', '2024-07-29', 'P'),
('M003', '2024-07-01', 'N'),
('M003', '2024-07-04', 'P'),
('M003', '2024-07-07', 'M'),
('M003', '2024-07-09', 'P'),
('M003', '2024-07-12', 'M'),
('M003', '2024-07-15', 'N'),
('M003', '2024-07-18', 'P'),
('M003', '2024-07-21', 'M'),
('M003', '2024-07-23', 'P'),
('M003', '2024-07-26', 'M'),
('M003', '2024-07-29', 'N'),
('M004', '2024-07-01', 'M'),
('M004', '2024-07-04', 'N'),
('M004', '2024-07-07', 'P'),
('M004', '2024-07-10', 'M'),
('M004', '2024-07-12', 'P'),
('M004', '2024-07-15', 'M'),
('M004', '2024-07-18', 'N'),
('M004', '2024-07-21', 'P'),
('M004', '2024-07-24', 'M'),
('M004', '2024-07-26', 'P'),
('M004', '2024-07-29', 'M'),
('M005', '2024-07-01', 'P'),
('M005', '2024-07-04', 'M'),
('M005', '2024-07-07', 'N'),
('M005', '2024-07-10', 'P'),
('M005', '2024-07-13', 'M'),
('M005', '2024-07-15', 'P'),
('M005', '2024-07-18', 'M'),
('M005', '2024-07-21', 'N'),
('M005', '2024-07-24', 'P'),
('M005', '2024-07-27', 'M'),
('M005', '2024-07-29', 'P'),
('M006', '2024-07-02', 'M'),
('M006', '2024-07-04', 'P'),
('M006', '2024-07-07', 'M'),
('M006', '2024-07-10', 'N'),
('M006', '2024-07-13', 'P'),
('M006', '2024-07-16', 'M'),
('M006', '2024-07-18', 'P'),
('M006', '2024-07-21', 'M'),
('M006', '2024-07-24', 'N'),
('M006', '2024-07-27', 'P'),
('M006', '2024-07-30', 'M'),
('M007', '2024-07-02', 'P'),
('M007', '2024-07-05', 'M'),
('M007', '2024-07-07', 'P'),
('M007', '2024-07-10', 'M'),
('M007', '2024-07-13', 'N'),
('M007', '2024-07-16', 'P'),
('M007', '2024-07-19', 'M'),
('M007', '2024-07-21', 'P'),
('M007', '2024-07-24', 'M'),
('M007', '2024-07-27', 'N'),
('M007', '2024-07-30', 'P'),
('M008', '2024-07-02', 'N'),
('M008', '2024-07-05', 'P'),
('M008', '2024-07-08', 'M'),
('M008', '2024-07-10', 'P'),
('M008', '2024-07-13', 'M'),
('M008', '2024-07-16', 'N'),
('M008', '2024-07-19', 'P'),
('M008', '2024-07-22', 'M'),
('M008', '2024-07-24', 'P'),
('M008', '2024-07-27', 'M'),
('M008', '2024-07-30', 'N'),
('M009', '2024-07-02', 'M'),
('M009', '2024-07-05', 'N'),
('M009', '2024-07-08', 'P'),
('M009', '2024-07-11', 'M'),
('M009', '2024-07-13', 'P'),
('M009', '2024-07-16', 'M'),
('M009', '2024-07-19', 'N'),
('M009', '2024-07-22', 'P'),
('M009', '2024-07-25', 'M'),
('M009', '2024-07-27', 'P'),
('M009', '2024-07-30', 'M'),
('M011', '2024-07-02', 'P'),
('M011', '2024-07-05', 'M'),
('M011', '2024-07-08', 'N'),
('M011', '2024-07-11', 'P'),
('M011', '2024-07-14', 'M'),
('M011', '2024-07-16', 'P'),
('M011', '2024-07-19', 'M'),
('M011', '2024-07-22', 'N'),
('M011', '2024-07-25', 'P'),
('M011', '2024-07-28', 'M'),
('M011', '2024-07-30', 'P'),
('M012', '2024-07-03', 'M'),
('M012', '2024-07-05', 'P'),
('M012', '2024-07-08', 'M'),
('M012', '2024-07-11', 'N'),
('M012', '2024-07-14', 'P'),
('M012', '2024-07-17', 'M'),
('M012', '2024-07-19', 'P'),
('M012', '2024-07-22', 'M'),
('M012', '2024-07-25', 'N'),
('M012', '2024-07-28', 'P'),
('M012', '2024-07-31', 'M'),
('M013', '2024-07-03', 'P'),
('M013', '2024-07-06', 'M'),
('M013', '2024-07-08', 'P'),
('M013', '2024-07-11', 'M'),
('M013', '2024-07-14', 'N'),
('M013', '2024-07-17', 'P'),
('M013', '2024-07-20', 'M'),
('M013', '2024-07-22', 'P'),
('M013', '2024-07-25', 'M'),
('M013', '2024-07-28', 'N'),
('M013', '2024-07-31', 'P'),
('M014', '2024-07-03', 'N'),
('M014', '2024-07-06', 'P'),
('M014', '2024-07-09', 'M'),
('M014', '2024-07-11', 'P'),
('M014', '2024-07-14', 'M'),
('M014', '2024-07-17', 'N'),
('M014', '2024-07-20', 'P'),
('M014', '2024-07-23', 'M'),
('M014', '2024-07-25', 'P'),
('M014', '2024-07-28', 'M'),
('M014', '2024-07-31', 'N'),
('M015', '2024-07-03', 'M'),
('M015', '2024-07-06', 'N'),
('M015', '2024-07-09', 'P'),
('M015', '2024-07-12', 'M'),
('M015', '2024-07-14', 'P'),
('M015', '2024-07-17', 'M'),
('M015', '2024-07-20', 'N'),
('M015', '2024-07-23', 'P'),
('M015', '2024-07-26', 'M'),
('M015', '2024-07-28', 'P'),
('M015', '2024-07-31', 'M');

-- --------------------------------------------------------

--
-- Struttura della tabella `turnooperatore`
--

CREATE TABLE `turnooperatore` (
  `nBadge` varchar(6) NOT NULL,
  `data` date NOT NULL,
  `tipoTurno` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `turnooperatore`
--

INSERT INTO `turnooperatore` (`nBadge`, `data`, `tipoTurno`) VALUES
('O001', '2024-07-01', 'M'),
('O001', '2024-07-04', 'N'),
('O001', '2024-07-08', 'P'),
('O001', '2024-07-12', 'M'),
('O001', '2024-07-20', 'M'),
('O001', '2024-07-23', 'P'),
('O001', '2024-07-26', 'P'),
('O002', '2024-07-01', 'M'),
('O002', '2024-07-04', 'N'),
('O002', '2024-07-08', 'P'),
('O002', '2024-07-12', 'P'),
('O002', '2024-07-20', 'M'),
('O002', '2024-07-23', 'P'),
('O002', '2024-07-26', 'P'),
('O003', '2024-07-01', 'M'),
('O003', '2024-07-05', 'M'),
('O003', '2024-07-08', 'N'),
('O003', '2024-07-12', 'P'),
('O003', '2024-07-20', 'M'),
('O003', '2024-07-23', 'N'),
('O003', '2024-07-26', 'P'),
('O004', '2024-07-01', 'P'),
('O004', '2024-07-05', 'M'),
('O004', '2024-07-08', 'N'),
('O004', '2024-07-12', 'P'),
('O004', '2024-07-20', 'P'),
('O004', '2024-07-23', 'N'),
('O004', '2024-07-26', 'N'),
('O005', '2024-07-01', 'P'),
('O005', '2024-07-05', 'M'),
('O005', '2024-07-09', 'M'),
('O005', '2024-07-12', 'N'),
('O005', '2024-07-20', 'P'),
('O005', '2024-07-24', 'M'),
('O005', '2024-07-26', 'N'),
('O006', '2024-07-01', 'P'),
('O006', '2024-07-05', 'P'),
('O006', '2024-07-09', 'M'),
('O006', '2024-07-12', 'N'),
('O006', '2024-07-20', 'P'),
('O006', '2024-07-24', 'M'),
('O006', '2024-07-27', 'M'),
('O007', '2024-07-01', 'N'),
('O007', '2024-07-05', 'P'),
('O007', '2024-07-09', 'M'),
('O007', '2024-07-13', 'M'),
('O007', '2024-07-20', 'N'),
('O007', '2024-07-24', 'M'),
('O007', '2024-07-27', 'M'),
('O008', '2024-07-01', 'N'),
('O008', '2024-07-05', 'P'),
('O008', '2024-07-09', 'P'),
('O008', '2024-07-13', 'M'),
('O008', '2024-07-20', 'N'),
('O008', '2024-07-24', 'M'),
('O008', '2024-07-27', 'M'),
('O009', '2024-07-02', 'M'),
('O009', '2024-07-05', 'N'),
('O009', '2024-07-09', 'P'),
('O009', '2024-07-13', 'M'),
('O009', '2024-07-21', 'M'),
('O009', '2024-07-24', 'M'),
('O009', '2024-07-27', 'P'),
('O010', '2024-07-02', 'M'),
('O010', '2024-07-05', 'N'),
('O010', '2024-07-09', 'P'),
('O010', '2024-07-13', 'P'),
('O010', '2024-07-21', 'M'),
('O010', '2024-07-24', 'P'),
('O010', '2024-07-27', 'P'),
('O011', '2024-07-02', 'M'),
('O011', '2024-07-06', 'M'),
('O011', '2024-07-09', 'N'),
('O011', '2024-07-13', 'P'),
('O011', '2024-07-21', 'M'),
('O011', '2024-07-24', 'P'),
('O011', '2024-07-27', 'P'),
('O012', '2024-07-02', 'P'),
('O012', '2024-07-06', 'M'),
('O012', '2024-07-09', 'N'),
('O012', '2024-07-13', 'P'),
('O012', '2024-07-21', 'P'),
('O012', '2024-07-24', 'P'),
('O012', '2024-07-27', 'N'),
('O013', '2024-07-02', 'P'),
('O013', '2024-07-06', 'M'),
('O013', '2024-07-10', 'M'),
('O013', '2024-07-13', 'N'),
('O013', '2024-07-21', 'P'),
('O013', '2024-07-24', 'P'),
('O013', '2024-07-27', 'N'),
('O014', '2024-07-02', 'P'),
('O014', '2024-07-06', 'P'),
('O014', '2024-07-10', 'M'),
('O014', '2024-07-13', 'N'),
('O014', '2024-07-21', 'P'),
('O014', '2024-07-24', 'P'),
('O014', '2024-07-28', 'M'),
('O015', '2024-07-02', 'N'),
('O015', '2024-07-06', 'P'),
('O015', '2024-07-10', 'M'),
('O015', '2024-07-14', 'M'),
('O015', '2024-07-21', 'N'),
('O015', '2024-07-24', 'N'),
('O015', '2024-07-28', 'M'),
('O016', '2024-07-02', 'N'),
('O016', '2024-07-06', 'P'),
('O016', '2024-07-10', 'P'),
('O016', '2024-07-14', 'M'),
('O016', '2024-07-21', 'N'),
('O016', '2024-07-24', 'N'),
('O016', '2024-07-28', 'M'),
('O017', '2024-07-03', 'M'),
('O017', '2024-07-06', 'N'),
('O017', '2024-07-10', 'P'),
('O017', '2024-07-14', 'M'),
('O017', '2024-07-22', 'M'),
('O017', '2024-07-24', 'N'),
('O017', '2024-07-28', 'P'),
('O018', '2024-07-03', 'M'),
('O018', '2024-07-06', 'N'),
('O018', '2024-07-10', 'P'),
('O018', '2024-07-14', 'P'),
('O018', '2024-07-22', 'M'),
('O018', '2024-07-25', 'M'),
('O018', '2024-07-28', 'P'),
('O019', '2024-07-03', 'M'),
('O019', '2024-07-07', 'M'),
('O019', '2024-07-10', 'N'),
('O019', '2024-07-14', 'P'),
('O019', '2024-07-22', 'M'),
('O019', '2024-07-25', 'M'),
('O019', '2024-07-28', 'P'),
('O020', '2024-07-03', 'P'),
('O020', '2024-07-07', 'M'),
('O020', '2024-07-10', 'N'),
('O020', '2024-07-14', 'P'),
('O020', '2024-07-22', 'P'),
('O020', '2024-07-25', 'M'),
('O020', '2024-07-28', 'N'),
('O021', '2024-07-03', 'P'),
('O021', '2024-07-07', 'M'),
('O021', '2024-07-11', 'M'),
('O021', '2024-07-14', 'N'),
('O021', '2024-07-22', 'P'),
('O021', '2024-07-25', 'M'),
('O021', '2024-07-28', 'N'),
('O022', '2024-07-03', 'P'),
('O022', '2024-07-07', 'P'),
('O022', '2024-07-11', 'M'),
('O022', '2024-07-14', 'N'),
('O022', '2024-07-22', 'P'),
('O022', '2024-07-25', 'P'),
('O023', '2024-07-03', 'N'),
('O023', '2024-07-07', 'P'),
('O023', '2024-07-11', 'M'),
('O023', '2024-07-15', 'M'),
('O023', '2024-07-22', 'N'),
('O023', '2024-07-25', 'P'),
('O024', '2024-07-03', 'N'),
('O024', '2024-07-07', 'P'),
('O024', '2024-07-11', 'P'),
('O024', '2024-07-15', 'M'),
('O024', '2024-07-22', 'N'),
('O024', '2024-07-25', 'P'),
('O025', '2024-07-04', 'M'),
('O025', '2024-07-07', 'N'),
('O025', '2024-07-11', 'P'),
('O025', '2024-07-15', 'M'),
('O025', '2024-07-23', 'M'),
('O025', '2024-07-25', 'P'),
('O026', '2024-07-04', 'M'),
('O026', '2024-07-07', 'N'),
('O026', '2024-07-11', 'P'),
('O026', '2024-07-15', 'P'),
('O026', '2024-07-23', 'M'),
('O026', '2024-07-25', 'N'),
('O027', '2024-07-04', 'M'),
('O027', '2024-07-08', 'M'),
('O027', '2024-07-11', 'N'),
('O027', '2024-07-15', 'P'),
('O027', '2024-07-23', 'M'),
('O027', '2024-07-25', 'N'),
('O028', '2024-07-04', 'P'),
('O028', '2024-07-08', 'M'),
('O028', '2024-07-11', 'N'),
('O028', '2024-07-15', 'P'),
('O028', '2024-07-23', 'M'),
('O028', '2024-07-26', 'M'),
('O029', '2024-07-04', 'P'),
('O029', '2024-07-08', 'M'),
('O029', '2024-07-12', 'M'),
('O029', '2024-07-15', 'N'),
('O029', '2024-07-23', 'P'),
('O029', '2024-07-26', 'M'),
('O030', '2024-07-04', 'P'),
('O030', '2024-07-08', 'P'),
('O030', '2024-07-12', 'M'),
('O030', '2024-07-15', 'N'),
('O030', '2024-07-23', 'P'),
('O030', '2024-07-26', 'M');

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `vista_appuntamenti`
-- (Vedi sotto per la vista effettiva)
--
CREATE TABLE `vista_appuntamenti` (
`idPrestazione` int(6)
,`idPaziente` int(6)
,`dataInizio` date
,`dataFine` date
,`ora` time(1)
,`nome` varchar(50)
,`nome_paziente` varchar(20)
,`cognome_paziente` varchar(20)
,`CF` varchar(16)
,`medici_coinvolti` mediumtext
,`operatori_coinvolti` mediumtext
,`numeroSala` int(3)
);

-- --------------------------------------------------------

--
-- Struttura per vista `vista_appuntamenti`
--
DROP TABLE IF EXISTS `vista_appuntamenti`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_appuntamenti`  AS SELECT DISTINCT `p`.`idPrestazione` AS `idPrestazione`, `p`.`idPaziente` AS `idPaziente`, `p`.`dataInizio` AS `dataInizio`, `p`.`dataFine` AS `dataFine`, `p`.`ora` AS `ora`, `l`.`nome` AS `nome`, `paz`.`nome` AS `nome_paziente`, `paz`.`cognome` AS `cognome_paziente`, `paz`.`CF` AS `CF`, `medici`.`medici_coinvolti` AS `medici_coinvolti`, `operatori`.`operatori_coinvolti` AS `operatori_coinvolti`, `p`.`sala` AS `numeroSala` FROM ((((((`prestazione` `p` join `paziente` `paz` on(`p`.`idPaziente` = `paz`.`idPaziente`)) left join `responsabile` `r` on(`p`.`idPrestazione` = `r`.`idPrestazione`)) left join `assistente` `a` on(`p`.`idPrestazione` = `a`.`idPrestazione`)) left join `listino` `l` on(`p`.`codicePrestazione` = `l`.`codicePrestazione`)) left join (select `r`.`idPrestazione` AS `idPrestazione`,group_concat(distinct concat(`m`.`nome`,' ',`m`.`cognome`) separator ', ') AS `medici_coinvolti` from (`medico` `m` join `responsabile` `r` on(`m`.`nBadge` = `r`.`nBadge`)) group by `r`.`idPrestazione`) `medici` on(`p`.`idPrestazione` = `medici`.`idPrestazione`)) left join (select `a`.`idPrestazione` AS `idPrestazione`,group_concat(distinct concat(`o`.`nome`,' ',`o`.`cognome`) separator ', ') AS `operatori_coinvolti` from (`operatore` `o` join `assistente` `a` on(`o`.`nBadge` = `a`.`nBadge`)) group by `a`.`idPrestazione`) `operatori` on(`p`.`idPrestazione` = `operatori`.`idPrestazione`)) ;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `amministratore`
--
ALTER TABLE `amministratore`
  ADD PRIMARY KEY (`idAmministratore`);

--
-- Indici per le tabelle `assistente`
--
ALTER TABLE `assistente`
  ADD PRIMARY KEY (`idPrestazione`,`nBadge`),
  ADD KEY `REF_ASS_OPERATORE` (`nBadge`);

--
-- Indici per le tabelle `diagnosi`
--
ALTER TABLE `diagnosi`
  ADD PRIMARY KEY (`idPaziente`,`idPatologia`),
  ADD KEY `REF_PATG_DIAGN` (`idPatologia`);

--
-- Indici per le tabelle `farmaco`
--
ALTER TABLE `farmaco`
  ADD PRIMARY KEY (`nome`,`dose`);

--
-- Indici per le tabelle `fattura`
--
ALTER TABLE `fattura`
  ADD PRIMARY KEY (`numeroFattura`),
  ADD UNIQUE KEY `idPrestazione_unico` (`idPrestazione`);

--
-- Indici per le tabelle `fornitore`
--
ALTER TABLE `fornitore`
  ADD PRIMARY KEY (`idFornitore`);

--
-- Indici per le tabelle `indirizzo`
--
ALTER TABLE `indirizzo`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `listino`
--
ALTER TABLE `listino`
  ADD PRIMARY KEY (`codicePrestazione`);

--
-- Indici per le tabelle `materiale`
--
ALTER TABLE `materiale`
  ADD PRIMARY KEY (`idMateriale`);

--
-- Indici per le tabelle `medico`
--
ALTER TABLE `medico`
  ADD PRIMARY KEY (`nBadge`),
  ADD KEY `REF_MED_AMM` (`idAmministratore`);

--
-- Indici per le tabelle `operatore`
--
ALTER TABLE `operatore`
  ADD PRIMARY KEY (`nBadge`),
  ADD KEY `REF_OPE_AMM` (`idAmministratore`);

--
-- Indici per le tabelle `ordine`
--
ALTER TABLE `ordine`
  ADD PRIMARY KEY (`idOrdine`),
  ADD KEY `REF_ORDINE_FORN` (`idFornitore`),
  ADD KEY `REF_ORD_REC` (`nBadge`);

--
-- Indici per le tabelle `patologia`
--
ALTER TABLE `patologia`
  ADD PRIMARY KEY (`idPatologia`);

--
-- Indici per le tabelle `paziente`
--
ALTER TABLE `paziente`
  ADD PRIMARY KEY (`idPaziente`);

--
-- Indici per le tabelle `prescrizione`
--
ALTER TABLE `prescrizione`
  ADD PRIMARY KEY (`idTerapia`,`nomeFarmaco`,`dose`),
  ADD KEY `REF_PRESC_FARMACO` (`nomeFarmaco`,`dose`);

--
-- Indici per le tabelle `prestazione`
--
ALTER TABLE `prestazione`
  ADD PRIMARY KEY (`idPrestazione`),
  ADD KEY `REF_APP_PAZIENTE` (`idPaziente`),
  ADD KEY `REF_APP_PREST` (`codicePrestazione`),
  ADD KEY `REF_PRESC_SALA` (`sala`);

--
-- Indici per le tabelle `receptionist`
--
ALTER TABLE `receptionist`
  ADD PRIMARY KEY (`nBadge`),
  ADD KEY `REF_REC_AMM` (`idAmministratore`);

--
-- Indici per le tabelle `responsabile`
--
ALTER TABLE `responsabile`
  ADD PRIMARY KEY (`idPrestazione`,`nBadge`),
  ADD KEY `REF_RESP_MEDICO` (`nBadge`);

--
-- Indici per le tabelle `rifornimento`
--
ALTER TABLE `rifornimento`
  ADD PRIMARY KEY (`idOrdine`,`idMateriale`),
  ADD KEY `REF_ORDINE_MAT` (`idMateriale`);

--
-- Indici per le tabelle `sala`
--
ALTER TABLE `sala`
  ADD PRIMARY KEY (`numero`);

--
-- Indici per le tabelle `terapia`
--
ALTER TABLE `terapia`
  ADD PRIMARY KEY (`idTerapia`),
  ADD KEY `REF_TER_PAZIENTE` (`idPaziente`),
  ADD KEY `REF_TER_MED` (`idMedico`);

--
-- Indici per le tabelle `turnomedico`
--
ALTER TABLE `turnomedico`
  ADD PRIMARY KEY (`nBadge`,`data`);

--
-- Indici per le tabelle `turnooperatore`
--
ALTER TABLE `turnooperatore`
  ADD PRIMARY KEY (`nBadge`,`data`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `materiale`
--
ALTER TABLE `materiale`
  MODIFY `idMateriale` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT per la tabella `ordine`
--
ALTER TABLE `ordine`
  MODIFY `idOrdine` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT per la tabella `terapia`
--
ALTER TABLE `terapia`
  MODIFY `idTerapia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `assistente`
--
ALTER TABLE `assistente`
  ADD CONSTRAINT `REF_ASS_APP` FOREIGN KEY (`idPrestazione`) REFERENCES `prestazione` (`idPrestazione`),
  ADD CONSTRAINT `REF_ASS_OPERATORE` FOREIGN KEY (`nBadge`) REFERENCES `operatore` (`nBadge`);

--
-- Limiti per la tabella `diagnosi`
--
ALTER TABLE `diagnosi`
  ADD CONSTRAINT `REF_PATG_DIAGN` FOREIGN KEY (`idPatologia`) REFERENCES `patologia` (`idPatologia`),
  ADD CONSTRAINT `REF_PAZT_DIAGN` FOREIGN KEY (`idPaziente`) REFERENCES `paziente` (`idPaziente`);

--
-- Limiti per la tabella `fattura`
--
ALTER TABLE `fattura`
  ADD CONSTRAINT `REF_FATT_APP` FOREIGN KEY (`idPrestazione`) REFERENCES `prestazione` (`idPrestazione`) ON DELETE CASCADE;

--
-- Limiti per la tabella `indirizzo`
--
ALTER TABLE `indirizzo`
  ADD CONSTRAINT `REF_IND_PAZ` FOREIGN KEY (`id`) REFERENCES `paziente` (`idPaziente`);

--
-- Limiti per la tabella `medico`
--
ALTER TABLE `medico`
  ADD CONSTRAINT `REF_MED_AMM` FOREIGN KEY (`idAmministratore`) REFERENCES `amministratore` (`idAmministratore`);

--
-- Limiti per la tabella `operatore`
--
ALTER TABLE `operatore`
  ADD CONSTRAINT `REF_OPE_AMM` FOREIGN KEY (`idAmministratore`) REFERENCES `amministratore` (`idAmministratore`);

--
-- Limiti per la tabella `ordine`
--
ALTER TABLE `ordine`
  ADD CONSTRAINT `REF_ORD_FORN` FOREIGN KEY (`idFornitore`) REFERENCES `fornitore` (`idFornitore`),
  ADD CONSTRAINT `REF_ORD_REC` FOREIGN KEY (`nBadge`) REFERENCES `receptionist` (`nBadge`);

--
-- Limiti per la tabella `prescrizione`
--
ALTER TABLE `prescrizione`
  ADD CONSTRAINT `REF_PRESC_FARMACO` FOREIGN KEY (`nomeFarmaco`,`dose`) REFERENCES `farmaco` (`nome`, `dose`),
  ADD CONSTRAINT `REF_PRESC_TERAPIA` FOREIGN KEY (`idTerapia`) REFERENCES `terapia` (`idTerapia`);

--
-- Limiti per la tabella `prestazione`
--
ALTER TABLE `prestazione`
  ADD CONSTRAINT `REF_APP_PAZIENTE` FOREIGN KEY (`idPaziente`) REFERENCES `paziente` (`idPaziente`),
  ADD CONSTRAINT `REF_APP_PREST` FOREIGN KEY (`codicePrestazione`) REFERENCES `listino` (`codicePrestazione`),
  ADD CONSTRAINT `REF_PRESC_SALA` FOREIGN KEY (`sala`) REFERENCES `sala` (`numero`);

--
-- Limiti per la tabella `receptionist`
--
ALTER TABLE `receptionist`
  ADD CONSTRAINT `REF_REC_AMM` FOREIGN KEY (`idAmministratore`) REFERENCES `amministratore` (`idAmministratore`);

--
-- Limiti per la tabella `responsabile`
--
ALTER TABLE `responsabile`
  ADD CONSTRAINT `REF_RESP_APP` FOREIGN KEY (`idPrestazione`) REFERENCES `prestazione` (`idPrestazione`),
  ADD CONSTRAINT `REF_RESP_MEDICO` FOREIGN KEY (`nBadge`) REFERENCES `medico` (`nBadge`);

--
-- Limiti per la tabella `rifornimento`
--
ALTER TABLE `rifornimento`
  ADD CONSTRAINT `REF_ORDINE_MAT` FOREIGN KEY (`idMateriale`) REFERENCES `materiale` (`idMateriale`),
  ADD CONSTRAINT `REF_ORD_ID` FOREIGN KEY (`idOrdine`) REFERENCES `ordine` (`idOrdine`);

--
-- Limiti per la tabella `terapia`
--
ALTER TABLE `terapia`
  ADD CONSTRAINT `REF_TER_MED` FOREIGN KEY (`idMedico`) REFERENCES `medico` (`nBadge`),
  ADD CONSTRAINT `REF_TER_PAZIENTE` FOREIGN KEY (`idPaziente`) REFERENCES `paziente` (`idPaziente`);

--
-- Limiti per la tabella `turnomedico`
--
ALTER TABLE `turnomedico`
  ADD CONSTRAINT `REF_TMED_MED` FOREIGN KEY (`nBadge`) REFERENCES `medico` (`nBadge`);

--
-- Limiti per la tabella `turnooperatore`
--
ALTER TABLE `turnooperatore`
  ADD CONSTRAINT `REF_TOP_OP` FOREIGN KEY (`nBadge`) REFERENCES `operatore` (`nBadge`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
