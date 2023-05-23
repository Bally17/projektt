-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: St 24.Máj 2023, 01:16
-- Verzia serveru: 10.4.28-MariaDB
-- Verzia PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `hraci`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `hraci`
--

CREATE TABLE `hraci` (
  `id` int(11) NOT NULL,
  `meno` varchar(15) NOT NULL,
  `priezvisko` varchar(20) NOT NULL,
  `odohrane_zapasy` int(11) NOT NULL,
  `pocet_golov` int(11) NOT NULL,
  `pocet_asistencii` int(11) NOT NULL,
  `rocnik` int(11) NOT NULL,
  `pozicia` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `hraci`
--

INSERT INTO `hraci` (`id`, `meno`, `priezvisko`, `odohrane_zapasy`, `pocet_golov`, `pocet_asistencii`, `rocnik`, `pozicia`) VALUES
(1, 'Martin', 'Ballay', 12, 32, 21, 2002, '3');

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `hraci`
--
ALTER TABLE `hraci`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `hraci`
--
ALTER TABLE `hraci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
