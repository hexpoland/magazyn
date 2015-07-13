-- phpMyAdmin SQL Dump
-- version 4.4.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas generowania: 09 Cze 2015, 15:16
-- Wersja serwera: 5.6.24
-- Wersja PHP: 5.5.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `logowanie`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL,
  `user` text NOT NULL,
  `message` text NOT NULL,
  `Data` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `czesci`
--

CREATE TABLE IF NOT EXISTS `czesci` (
  `ID` int(11) NOT NULL,
  `Numer` text NOT NULL,
  `Nazwa` text NOT NULL,
  `Opis` text NOT NULL,
  `Nowy` tinyint(1) DEFAULT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `czesci`
--

INSERT INTO `czesci` (`ID`, `Numer`, `Nazwa`, `Opis`, `Nowy`, `email`) VALUES
(7, '40.00.202P', 'Plyta scc', 'plyta do scc ', 1, 'hex@hex.pl'),
(8, '40.00.202P', 'Plyta psc', 'plyta do scc ', NULL, 'hex@hex.pl'),
(9, ' 34.00.203', 'generator pary cpc 101g', 'generator pary do cpc 101 gazowy', NULL, 'hex@hex.pl'),
(15, '44.00.202P', 'PÅ‚yta scc', 'plyta do scc 2000zÅ‚', 1, 'hex@hex.pl'),
(26, '67.04.345', 'Drzwi SCC101', '', 1, 'hex@hex.pl'),
(27, '40.00.345', 'plyta io', 'do scc', 1, 'wolaqu@poczta.onet.pl'),
(28, '50.00.606', 'drzwi', 'scc 101', 1, 'wolaqu@poczta.onet.pl');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `haslo` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `email`, `haslo`) VALUES
(2, 'wolaqu@poczta.onet.pl', 'd8578edf8458ce06fbc5bb76a58c5ca4'),
(3, 'wolaqu@poczta.onet.pl', '4df41ac1636956fb60ee4e0e1bac3558'),
(4, 'wolaqu@poczta.onet.pl', '4df41ac1636956fb60ee4e0e1bac3558'),
(5, 'wolaqu@poczta.onet.pl', '4df41ac1636956fb60ee4e0e1bac3558'),
(6, 'wolaqu@poczta.onet.pl', '4df41ac1636956fb60ee4e0e1bac3558'),
(7, 'wolaqu@poczta.onet.pl', '4df41ac1636956fb60ee4e0e1bac3558'),
(8, 'hex@hex.pl', '76419c58730d9f35de7ac538c2fd6737'),
(9, '', 'd41d8cd98f00b204e9800998ecf8427e'),
(10, '', 'd41d8cd98f00b204e9800998ecf8427e'),
(11, '', 'd41d8cd98f00b204e9800998ecf8427e'),
(12, '', 'd41d8cd98f00b204e9800998ecf8427e'),
(13, '', 'd41d8cd98f00b204e9800998ecf8427e'),
(14, 'a', 'd41d8cd98f00b204e9800998ecf8427e'),
(15, '', 'd41d8cd98f00b204e9800998ecf8427e'),
(16, 'artur@wolakowski.pl', '76419c58730d9f35de7ac538c2fd6737'),
(17, 'a', 'd41d8cd98f00b204e9800998ecf8427e'),
(18, 's', 'd41d8cd98f00b204e9800998ecf8427e');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `czesci`
--
ALTER TABLE `czesci`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT dla tabeli `czesci`
--
ALTER TABLE `czesci`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
