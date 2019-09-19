-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 18, 2019 at 04:19 PM
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
-- Table structure for table `klientas`
--

CREATE TABLE `klientas` (
  `id` int(11) NOT NULL,
  `klientas` varchar(255) NOT NULL,
  `laikas` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `laukimo_laikas`
--

CREATE TABLE `laukimo_laikas` (
  `id` int(11) NOT NULL,
  `klientas` varchar(255) NOT NULL,
  `laukimas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `priimti`
--

CREATE TABLE `priimti` (
  `id` int(11) NOT NULL,
  `kid` int(11) NOT NULL,
  `klientas` varchar(255) NOT NULL,
  `aptarnavo` varchar(255) NOT NULL,
  `kada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `reg` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `specialistai`
--

CREATE TABLE `specialistai` (
  `id` int(11) NOT NULL,
  `vardas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `specialistai`
--

INSERT INTO `specialistai` (`id`, `vardas`) VALUES
(1, 'demo');

-- --------------------------------------------------------

--
-- Table structure for table `statistika`
--

CREATE TABLE `statistika` (
  `id` int(11) NOT NULL,
  `aptarnavo` varchar(255) NOT NULL,
  `klientas` varchar(255) NOT NULL,
  `registracija` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `laukimas` int(11) NOT NULL,
  `aptarnavimas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vidurkis`
--

CREATE TABLE `vidurkis` (
  `id` int(11) NOT NULL,
  `vidurkis` int(11) NOT NULL,
  `laukimas` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vidurkis`
--

INSERT INTO `vidurkis` (`id`, `vidurkis`, `laukimas`) VALUES
(1, 90, 1568786242);

-- --------------------------------------------------------

--
-- Table structure for table `vp`
--

CREATE TABLE `vp` (
  `id` int(11) NOT NULL,
  `klientas` varchar(255) NOT NULL,
  `kodas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `klientas`
--
ALTER TABLE `klientas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laukimo_laikas`
--
ALTER TABLE `laukimo_laikas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `priimti`
--
ALTER TABLE `priimti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specialistai`
--
ALTER TABLE `specialistai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statistika`
--
ALTER TABLE `statistika`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vidurkis`
--
ALTER TABLE `vidurkis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vp`
--
ALTER TABLE `vp`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `klientas`
--
ALTER TABLE `klientas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `laukimo_laikas`
--
ALTER TABLE `laukimo_laikas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `priimti`
--
ALTER TABLE `priimti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `specialistai`
--
ALTER TABLE `specialistai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `statistika`
--
ALTER TABLE `statistika`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `vidurkis`
--
ALTER TABLE `vidurkis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vp`
--
ALTER TABLE `vp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
