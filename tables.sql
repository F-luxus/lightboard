-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2019 m. Rgs 22 d. 00:07
-- Server version: 10.1.41-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rimas_nfq`
--

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `klientas`
--

CREATE TABLE `klientas` (
  `id` int(11) NOT NULL,
  `klientas` varchar(255) COLLATE utf8_lithuanian_ci NOT NULL,
  `registracija` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `kodas` varchar(255) COLLATE utf8_lithuanian_ci NOT NULL,
  `laukimo_laikas` int(20) NOT NULL,
  `aptarnautas` varchar(255) COLLATE utf8_lithuanian_ci NOT NULL DEFAULT '0',
  `priimtas` varchar(255) COLLATE utf8_lithuanian_ci NOT NULL DEFAULT '0',
  `sid` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `specialistai`
--

CREATE TABLE `specialistai` (
  `id` int(11) NOT NULL,
  `vardas` varchar(255) COLLATE utf8_lithuanian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Sukurta duomenų kopija lentelei `specialistai`
--

INSERT INTO `specialistai` (`id`, `vardas`) VALUES
(3, 'demo');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `statistika`
--

CREATE TABLE `statistika` (
  `id` int(11) NOT NULL,
  `aptarnavo` int(11) NOT NULL,
  `klientas` int(11) NOT NULL,
  `registracijos_data` varchar(255) COLLATE utf8_lithuanian_ci NOT NULL,
  `registracijos_laikas` varchar(255) COLLATE utf8_lithuanian_ci NOT NULL,
  `laukimas` int(11) NOT NULL,
  `aptarnavimas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `vidurkis`
--

CREATE TABLE `vidurkis` (
  `id` int(11) NOT NULL,
  `vidurkis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Sukurta duomenų kopija lentelei `vidurkis`
--

INSERT INTO `vidurkis` (`id`, `vidurkis`) VALUES
(1, 163);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `klientas`
--
ALTER TABLE `klientas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sid` (`sid`);

--
-- Indexes for table `specialistai`
--
ALTER TABLE `specialistai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statistika`
--
ALTER TABLE `statistika`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aptarnavo` (`aptarnavo`);

--
-- Indexes for table `vidurkis`
--
ALTER TABLE `vidurkis`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `klientas`
--
ALTER TABLE `klientas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `specialistai`
--
ALTER TABLE `specialistai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `statistika`
--
ALTER TABLE `statistika`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `vidurkis`
--
ALTER TABLE `vidurkis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
