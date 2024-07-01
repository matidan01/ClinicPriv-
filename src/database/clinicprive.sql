-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Lug 01, 2024 alle 13:40
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
  `recapitoTelefonico` int(20) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `appuntamento`
--

CREATE TABLE `appuntamento` (
  `idPaziente` int(6) NOT NULL,
  `idPrestazione` int(6) NOT NULL,
  `dataInizio` date NOT NULL,
  `dataFine` date DEFAULT NULL,
  `codicePrestazione` varchar(6) NOT NULL,
  `ora` time(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `assistente`
--

CREATE TABLE `assistente` (
  `idPrestazione` int(6) NOT NULL,
  `nBadge` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `diagnosi`
--

CREATE TABLE `diagnosi` (
  `idPaziente` int(6) NOT NULL,
  `nBadgeMedico` varchar(6) DEFAULT NULL,
  `idPatologia` int(6) NOT NULL,
  `descrizione` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `farmaco`
--

CREATE TABLE `farmaco` (
  `nome` varchar(255) NOT NULL,
  `dose` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Struttura della tabella `fornitore`
--

CREATE TABLE `fornitore` (
  `idFornitore` int(6) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `recapitoTelefonico` int(20) NOT NULL,
  `email` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Struttura della tabella `listino`
--

CREATE TABLE `listino` (
  `codicePrestazione` varchar(6) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `costo` decimal(8,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `materiale`
--

CREATE TABLE `materiale` (
  `idMateriale` int(6) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `quantita` int(5) NOT NULL,
  `prezzo` decimal(6,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `materialeordinato`
--

CREATE TABLE `materialeordinato` (
  `idOrdine` int(5) NOT NULL,
  `idMateriale` int(6) NOT NULL,
  `quantita` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `medico`
--

CREATE TABLE `medico` (
  `nBadge` varchar(6) NOT NULL,
  `tipologia` varchar(10) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `cognome` varchar(20) NOT NULL,
  `CF` varchar(16) DEFAULT NULL,
  `emailAziendale` varchar(300) NOT NULL,
  `dataNascita` date NOT NULL,
  `luogoNascita` varchar(20) NOT NULL,
  `recapitoTelefonico` int(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `inizioRapporto` date NOT NULL,
  `fineRapporto` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `recapitoTelefonico` int(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `inizioRapporto` date NOT NULL,
  `fineRapporto` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine`
--

CREATE TABLE `ordine` (
  `idOrdine` int(5) NOT NULL,
  `idFornitore` int(6) NOT NULL,
  `dataOrdine` date NOT NULL,
  `dataConsegna` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `ospita`
--

CREATE TABLE `ospita` (
  `numeroSala` int(3) NOT NULL,
  `idPrestazione` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `patologia`
--

CREATE TABLE `patologia` (
  `idPatologia` int(6) NOT NULL,
  `nomePatologia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `recapitoTelefonico` int(20) NOT NULL,
  `note` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `prescrizione`
--

CREATE TABLE `prescrizione` (
  `idTerapia` int(11) NOT NULL,
  `nomeFarmaco` varchar(255) NOT NULL,
  `dose` varchar(30) DEFAULT NULL,
  `idMedico` int(11) DEFAULT NULL,
  `descrizione` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `recapitoTelefonico` int(14) NOT NULL,
  `password` varchar(20) NOT NULL,
  `inizioRapporto` date NOT NULL,
  `fineRapporto` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `responsabile`
--

CREATE TABLE `responsabile` (
  `idPrestazione` int(6) NOT NULL,
  `nBadge` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `sala`
--

CREATE TABLE `sala` (
  `numero` int(3) NOT NULL,
  `tipo` varchar(15) NOT NULL,
  `postiLetto` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `terapia`
--

CREATE TABLE `terapia` (
  `idTerapia` int(11) NOT NULL,
  `idPaziente` int(6) NOT NULL,
  `dataScadenza` date NOT NULL,
  `idMedico` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `turnomedico`
--

CREATE TABLE `turnomedico` (
  `nBadge` varchar(6) NOT NULL,
  `data` date NOT NULL,
  `tipoTurno` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `amministratore`
--
ALTER TABLE `amministratore`
  ADD PRIMARY KEY (`idAmministratore`);

--
-- Indici per le tabelle `appuntamento`
--
ALTER TABLE `appuntamento`
  ADD PRIMARY KEY (`idPrestazione`),
  ADD KEY `REF_APP_PAZIENTE` (`idPaziente`),
  ADD KEY `REF_APP_PREST` (`codicePrestazione`);

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
  ADD KEY `REF_MED_DIAGN` (`nBadgeMedico`),
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
-- Indici per le tabelle `materialeordinato`
--
ALTER TABLE `materialeordinato`
  ADD PRIMARY KEY (`idOrdine`,`idMateriale`),
  ADD KEY `REF_ORDINE_MAT` (`idMateriale`);

--
-- Indici per le tabelle `medico`
--
ALTER TABLE `medico`
  ADD PRIMARY KEY (`nBadge`);

--
-- Indici per le tabelle `operatore`
--
ALTER TABLE `operatore`
  ADD PRIMARY KEY (`nBadge`);

--
-- Indici per le tabelle `ordine`
--
ALTER TABLE `ordine`
  ADD PRIMARY KEY (`idOrdine`),
  ADD KEY `REF_ORDINE_FORN` (`idFornitore`);

--
-- Indici per le tabelle `ospita`
--
ALTER TABLE `ospita`
  ADD PRIMARY KEY (`numeroSala`,`idPrestazione`),
  ADD KEY `REF_OSP_PREST` (`idPrestazione`);

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
  ADD PRIMARY KEY (`idTerapia`,`nomeFarmaco`),
  ADD KEY `REF_PRESC_FARMACO` (`nomeFarmaco`,`dose`);

--
-- Indici per le tabelle `receptionist`
--
ALTER TABLE `receptionist`
  ADD PRIMARY KEY (`nBadge`);

--
-- Indici per le tabelle `responsabile`
--
ALTER TABLE `responsabile`
  ADD PRIMARY KEY (`idPrestazione`,`nBadge`),
  ADD KEY `REF_RESP_MEDICO` (`nBadge`);

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
  MODIFY `idMateriale` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ordine`
--
ALTER TABLE `ordine`
  MODIFY `idOrdine` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `terapia`
--
ALTER TABLE `terapia`
  MODIFY `idTerapia` int(11) NOT NULL AUTO_INCREMENT;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `appuntamento`
--
ALTER TABLE `appuntamento`
  ADD CONSTRAINT `REF_APP_PAZIENTE` FOREIGN KEY (`idPaziente`) REFERENCES `paziente` (`idPaziente`),
  ADD CONSTRAINT `REF_APP_PREST` FOREIGN KEY (`codicePrestazione`) REFERENCES `listino` (`codicePrestazione`);

--
-- Limiti per la tabella `assistente`
--
ALTER TABLE `assistente`
  ADD CONSTRAINT `REF_ASS_APP` FOREIGN KEY (`idPrestazione`) REFERENCES `appuntamento` (`idPrestazione`),
  ADD CONSTRAINT `REF_ASS_OPERATORE` FOREIGN KEY (`nBadge`) REFERENCES `operatore` (`nBadge`);

--
-- Limiti per la tabella `diagnosi`
--
ALTER TABLE `diagnosi`
  ADD CONSTRAINT `REF_MED_DIAGN` FOREIGN KEY (`nBadgeMedico`) REFERENCES `medico` (`nBadge`),
  ADD CONSTRAINT `REF_PATG_DIAGN` FOREIGN KEY (`idPatologia`) REFERENCES `patologia` (`idPatologia`),
  ADD CONSTRAINT `REF_PAZT_DIAGN` FOREIGN KEY (`idPaziente`) REFERENCES `paziente` (`idPaziente`);

--
-- Limiti per la tabella `fattura`
--
ALTER TABLE `fattura`
  ADD CONSTRAINT `REF_FATT_APP` FOREIGN KEY (`idPrestazione`) REFERENCES `appuntamento` (`idPrestazione`);

--
-- Limiti per la tabella `materialeordinato`
--
ALTER TABLE `materialeordinato`
  ADD CONSTRAINT `REF_ORDINE_MAT` FOREIGN KEY (`idMateriale`) REFERENCES `materiale` (`idMateriale`),
  ADD CONSTRAINT `REF_ORD_ID` FOREIGN KEY (`idOrdine`) REFERENCES `ordine` (`idOrdine`);

--
-- Limiti per la tabella `ordine`
--
ALTER TABLE `ordine`
  ADD CONSTRAINT `REF_ORD_FORN` FOREIGN KEY (`idFornitore`) REFERENCES `fornitore` (`idFornitore`);

--
-- Limiti per la tabella `ospita`
--
ALTER TABLE `ospita`
  ADD CONSTRAINT `REF_OSP_PREST` FOREIGN KEY (`idPrestazione`) REFERENCES `appuntamento` (`idPrestazione`),
  ADD CONSTRAINT `REF_OSP_SALA` FOREIGN KEY (`numeroSala`) REFERENCES `sala` (`numero`);

--
-- Limiti per la tabella `prescrizione`
--
ALTER TABLE `prescrizione`
  ADD CONSTRAINT `REF_PRESC_FARMACO` FOREIGN KEY (`nomeFarmaco`,`dose`) REFERENCES `farmaco` (`nome`, `dose`),
  ADD CONSTRAINT `REF_PRESC_TERAPIA` FOREIGN KEY (`idTerapia`) REFERENCES `terapia` (`idTerapia`);

--
-- Limiti per la tabella `responsabile`
--
ALTER TABLE `responsabile`
  ADD CONSTRAINT `REF_RESP_APP` FOREIGN KEY (`idPrestazione`) REFERENCES `appuntamento` (`idPrestazione`),
  ADD CONSTRAINT `REF_RESP_MEDICO` FOREIGN KEY (`nBadge`) REFERENCES `medico` (`nBadge`);

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
