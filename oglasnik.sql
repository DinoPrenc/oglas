-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2019 at 11:40 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oglasnik`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategorija`
--

CREATE TABLE `kategorija` (
  `id_kategorija` int(11) NOT NULL,
  `naziv` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kategorija`
--

INSERT INTO `kategorija` (`id_kategorija`, `naziv`) VALUES
(1, 'Mobiteli'),
(2, 'Nekretnine'),
(6, 'PC periferija');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `log_no` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `time` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `user_agent` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `success_login` tinyint(1) NOT NULL,
  `stat` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oglas`
--

CREATE TABLE `oglas` (
  `id_oglas` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `naslov` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `opis` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `cijena` decimal(10,2) NOT NULL,
  `aktivan` tinyint(1) NOT NULL,
  `br_pogleda` int(11) NOT NULL,
  `id_kategorija` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oglas`
--

INSERT INTO `oglas` (`id_oglas`, `id_user`, `naslov`, `opis`, `cijena`, `aktivan`, `br_pogleda`, `id_kategorija`) VALUES
(4, 10, 'tipkovnica', 'Prodajem tipkovnicu razer, blue switches, rgb', '320.00', 1, 23, 6),
(7, 10, 'Luksuzna kuca', 'luks kica uz more', '5000000.00', 1, 19, 2),
(8, 11, 'galaxy s8', 'Prodajem novi galaxy s8.\r\ngarancija 2 godine\r\nzapakiran\r\nsva oprema\r\nhitno!!!', '3000.00', 1, 3, 1),
(9, 11, 'Neaktivan', 'neaktivan oglas', '10.00', 0, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(10) NOT NULL,
  `ime` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `id_zupanija` int(2) NOT NULL,
  `br_tel` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `ime`, `prezime`, `id_zupanija`, `br_tel`, `email`, `password`, `admin`) VALUES
(8, 'ime', 'prezime', 1, '0000', 'email@email.com', '25d55ad283aa400af464c76d713c07ad', 0),
(10, 'admin', 'admin', 1, '0', 'admin@admin', '21232f297a57a5a743894a0e4a801fc3', 1),
(11, 'test', 'test', 1, '11111', 'test@test.com', '202cb962ac59075b964b07152d234b70', 0);

-- --------------------------------------------------------

--
-- Table structure for table `zupanija`
--

CREATE TABLE `zupanija` (
  `id_zupanija` int(11) NOT NULL,
  `naziv` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `zupanija`
--

INSERT INTO `zupanija` (`id_zupanija`, `naziv`) VALUES
(1, 'Grad Zagreb'),
(2, 'Bjelovarsko-bilogorska'),
(3, 'Brodsko-posavska'),
(4, 'Dubrovacko-neretvanska'),
(5, 'Istarska'),
(6, 'Karlovacka'),
(7, 'Koprivnicko-krizevacka'),
(8, 'Krapinsko-zagorska'),
(9, 'Licko-senjska'),
(10, 'Medimurska'),
(11, 'Osjecko-baranjska'),
(12, 'Pozesko-slavonska'),
(13, 'Primorsko-goranska'),
(14, 'Sisacko-moslovacka'),
(15, 'Splitsko-dalmatinska'),
(16, 'Varazdinska'),
(17, 'Viroviticko-podravska'),
(18, 'Vukovarsko-srijemska'),
(19, 'Zadarska'),
(20, 'Zagrebacka'),
(21, 'Sibensko-kninska');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategorija`
--
ALTER TABLE `kategorija`
  ADD PRIMARY KEY (`id_kategorija`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`log_no`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `oglas`
--
ALTER TABLE `oglas`
  ADD PRIMARY KEY (`id_oglas`),
  ADD KEY `id_user` (`id_user`,`id_kategorija`),
  ADD KEY `id_kategorija` (`id_kategorija`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_zupanija` (`id_zupanija`);

--
-- Indexes for table `zupanija`
--
ALTER TABLE `zupanija`
  ADD PRIMARY KEY (`id_zupanija`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategorija`
--
ALTER TABLE `kategorija`
  MODIFY `id_kategorija` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `log_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `oglas`
--
ALTER TABLE `oglas`
  MODIFY `id_oglas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `zupanija`
--
ALTER TABLE `zupanija`
  MODIFY `id_zupanija` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `oglas`
--
ALTER TABLE `oglas`
  ADD CONSTRAINT `oglas_ibfk_1` FOREIGN KEY (`id_kategorija`) REFERENCES `kategorija` (`id_kategorija`),
  ADD CONSTRAINT `oglas_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_zupanija`) REFERENCES `zupanija` (`id_zupanija`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
