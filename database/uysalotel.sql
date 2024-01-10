-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2024 at 09:14 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uysalotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `id` int(11) NOT NULL,
  `ad` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefon` varchar(20) DEFAULT NULL,
  `adres` text DEFAULT NULL,
  `zip_kodu` varchar(10) DEFAULT NULL,
  `dogum_gunu` date DEFAULT NULL,
  `sifre` varchar(255) DEFAULT NULL,
  `resim_konum` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kullanicilar`
--

INSERT INTO `kullanicilar` (`id`, `ad`, `email`, `telefon`, `adres`, `zip_kodu`, `dogum_gunu`, `sifre`, `resim_konum`) VALUES
(5, 'Ali', 'ali@icloud.com', '05353149823', 'Güzeltepe, Baraj Yolu Cd Eyüpsultan/İstanbul', '37150', '0000-00-00', '1q2w3e4r', 'Neoneon.png'),
(6, 'Ali', 'ali@icloud.com', '05353149823', 'Güzeltepe, Baraj Yolu Cd Eyüpsultan/İstanbul', '37150', '0000-00-00', '1q2w3e4r', 'Neoneon.png'),
(7, 'Mete', 'adi@gmail.com', '05353147542', 'Güzeltepe, Baraj Yolu Cd Eyüpsultan/İstanbul', '34060', '2024-01-09', '1q2w3e4r5t', 'DALL·E 2024-01-06 00.34.24 - two neon letter z.png'),
(8, 'Mete', 'adi@gmail.com', '05353147542', 'sdasdasfdfadfasd sdasdas ', '34060', '2024-01-15', '1q2w3e4r', '_a21871a1-cc0c-46a9-a2a3-cc990ca82b35.jpg'),
(9, 'Mete', 'adi@gmail.com', '05353147542', 'sdasdasdasdasdas', '34060', '2024-01-10', '1q2w3e4r', ''),
(10, 'Ömer', 'omr@gmail.com', '05352267287', 'Güzeltepe, Baraj Yolu Cd Eyüpsultan/İstanbul', '34060', '2024-01-10', '1q2w3e4r5t', '_Hello World - Many Programming Languages (dark)_ Essential T-Shirt for Sale by kiprobinson.jpg'),
(11, 'Ömr', 'oemr@gmail.com', '05352267287', 'sdasdasdasdasdasd', '34060', '2024-01-25', '1q2w3e4r5t', 'Free  Hotels, Doorway, Red Background Images, Atmospheric Hotel Entrance On The Red Carpet Golden Background Material Photo Background PNG and Vectors.jpg'),
(12, 'admin', '-@admin.com', '0000000', '-', '00000', '1453-06-15', 'admin', 'Story.png');

-- --------------------------------------------------------

--
-- Table structure for table `odalar`
--

CREATE TABLE `odalar` (
  `oda_id` int(11) NOT NULL,
  `oda_adi` varchar(100) NOT NULL,
  `oda_tipi` varchar(50) NOT NULL,
  `oda_aciklamasi` text DEFAULT NULL,
  `oda_fiyat` decimal(10,2) NOT NULL,
  `oda_kapasitesi` int(11) NOT NULL,
  `mevcutluk` tinyint(1) NOT NULL DEFAULT 1,
  `oda_resim` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `odalar`
--

INSERT INTO `odalar` (`oda_id`, `oda_adi`, `oda_tipi`, `oda_aciklamasi`, `oda_fiyat`, `oda_kapasitesi`, `mevcutluk`, `oda_resim`) VALUES
(1, 'Lüks Oda 3', 'Tek Kişilik', 'Tek kişilik süit.', 100.00, 1, 1, '659ebbda7b3b9_premier.png'),
(2, 'Lüx Oda 2', 'İki Kişilik', 'İki kişilik lüx oda.', 100.00, 2, 1, 'deluxroom.png'),
(3, 'Delüx Oda', 'Üç Kişilik', 'Üç kişilik lüx suit.', 100.00, 3, 1, 'luxury.png'),
(8, 'Ultra Premium Oda', '3 Kişilik', 'Premiumun yanında havuz ve yemek dahil.', 300.00, 3, 1, 'premier.png');

-- --------------------------------------------------------

--
-- Table structure for table `rezervasyonlar`
--

CREATE TABLE `rezervasyonlar` (
  `rezervasyon_id` int(11) NOT NULL,
  `oda_id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `baslangic_tarihi` date NOT NULL,
  `bitis_tarihi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rezervasyonlar`
--

INSERT INTO `rezervasyonlar` (`rezervasyon_id`, `oda_id`, `kullanici_id`, `baslangic_tarihi`, `bitis_tarihi`) VALUES
(2, 1, 7, '2024-01-10', '2024-01-15'),
(4, 2, 7, '2024-01-10', '2024-01-15'),
(9, 3, 9, '2024-01-23', '2024-01-18'),
(10, 2, 7, '2024-01-12', '2024-01-17'),
(11, 1, 5, '2024-01-18', '2024-01-17'),
(12, 2, 8, '2024-01-11', '2024-01-18'),
(13, 2, 10, '2024-01-11', '2024-01-18'),
(14, 2, 10, '2024-01-11', '2024-01-17'),
(17, 2, 10, '2024-01-11', '2024-01-17'),
(18, 1, 7, '2024-01-11', '2024-01-18'),
(19, 3, 7, '2024-01-12', '2024-01-16'),
(20, 8, 7, '2024-01-12', '2024-01-17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `odalar`
--
ALTER TABLE `odalar`
  ADD PRIMARY KEY (`oda_id`);

--
-- Indexes for table `rezervasyonlar`
--
ALTER TABLE `rezervasyonlar`
  ADD PRIMARY KEY (`rezervasyon_id`),
  ADD KEY `oda_id` (`oda_id`),
  ADD KEY `kullanici_id` (`kullanici_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `odalar`
--
ALTER TABLE `odalar`
  MODIFY `oda_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rezervasyonlar`
--
ALTER TABLE `rezervasyonlar`
  MODIFY `rezervasyon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rezervasyonlar`
--
ALTER TABLE `rezervasyonlar`
  ADD CONSTRAINT `rezervasyonlar_ibfk_1` FOREIGN KEY (`oda_id`) REFERENCES `odalar` (`oda_id`),
  ADD CONSTRAINT `rezervasyonlar_ibfk_2` FOREIGN KEY (`kullanici_id`) REFERENCES `kullanicilar` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
