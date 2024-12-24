-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2023 at 03:01 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hp`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_hp`
--

CREATE TABLE `data_hp` (
  `id_hp` int(4) NOT NULL,
  `nama_hp` varchar(256) COLLATE utf8_bin NOT NULL,
  `harga_hp` varchar(64) COLLATE utf8_bin NOT NULL,
  `ram_hp` varchar(64) COLLATE utf8_bin NOT NULL,
  `memori_hp` varchar(64) COLLATE utf8_bin NOT NULL,
  `kamera_hp` varchar(64) COLLATE utf8_bin NOT NULL,
  `baterai_hp` varchar(64) COLLATE utf8_bin NOT NULL,
  `processor_hp` varchar(64) COLLATE utf8_bin NOT NULL,
  `jaringan_hp` varchar(64) COLLATE utf8_bin NOT NULL,
  `harga_angka` varchar(64) COLLATE utf8_bin NOT NULL,
  `ram_angka` varchar(64) COLLATE utf8_bin NOT NULL,
  `memori_angka` varchar(64) COLLATE utf8_bin NOT NULL,
  `kamera_angka` varchar(64) COLLATE utf8_bin NOT NULL,
  `baterai_angka` varchar(64) COLLATE utf8_bin NOT NULL,
  `processor_angka` varchar(64) COLLATE utf8_bin NOT NULL,
  `jaringan_angka` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `data_hp`
--

INSERT INTO `data_hp` (`id_hp`, `nama_hp`, `harga_hp`, `ram_hp`, `memori_hp`, `kamera_hp`, `baterai_hp`, `processor_hp`, `jaringan_hp`, `harga_angka`, `ram_angka`, `memori_angka`, `kamera_angka`, `baterai_angka`, `processor_angka`, `jaringan_angka`) VALUES
(1, 'Iphone 15 Pro Max', '24999000', '8', '256', '48', '4441', 'Apple 17 Pro', '5G', '1', '5', '3', '5', '5', '5', ''),
(2, 'Samsung Galaxy S23 Ultra', '20999000', '12', '512', '200', '5000', 'Snapdragon 8 Gen 2', '5G', '2', '7', '6', '7', '7', '7', '7'),
(3, 'Xiaomi 13 Pro', '14999000', '12', '512', '50', '4820', 'Snapdragon 8 Gen 2', '5G', '3', '7', '6', '6', '6', '7', '7'),
(4, 'Infinix Zero Ultra', '6600000', '8', '256', '200', '4500', 'MediaTek Dimensity 920', '5G', '5', '5', '5', '7', '6', '6', '7'),
(5, 'Vivo X90 Pro', '18999000', '12', '512', '50', '4870', 'Dimensity 9200', '5G', '3', '7', '6', '6', '6', '7', '7'),
(6, 'Oppo Find X6 Pro', '19999000', '16', '512', '50', '5000', 'Snapdragon 8 Gen 2', '5G', '2', '7', '6', '6', '7', '7', '7'),
(7, 'Iphone 14 Pro Max', '21999000', '6', '128', '48', '4323', 'Apple 16 Bionic', '5G', '2', '4', '4', '5', '5', '6', '7'),
(8, 'Samsung Galaxy A54', '5999000', '8', '256', '50', '5000', 'Exynos 1380', '5G', '5', '5', '5', '6', '7', '5', '7'),
(9, 'Xiaomi Redmi Note 12 Pro', '4499000', '8', '128', '50', '5000', 'Dimensity 1080', '5G', '6', '5', '4', '6', '7', '6', '7'),
(10, 'Infinix Note 30 Pro', '2999000', '8', '128', '108', '5000', 'Helio G99', '4G', '7', '5', '4', '7', '7', '5', '6'),
(11, 'Vivo Y78 5G', '3499000', '8', '128', '50', '5000', 'Dimensity 6020', '5G', '6', '5', '4', '6', '7', '5', '7'),
(12, 'Oppo Reno 8T 5G', '6499000', '8', '256', '108', '4800', 'Snapdragon 695', '5G', '5', '5', '5', '7', '6', '5', '7'),
(13, 'Iphone SE 2023', '7999000', '4', '128', '12', '2018', 'Apple A15 Bionic', '5G', '5', '4', '4', '4', '3', '6', '7'),
(14, 'Samsung Galaxy Z Fold 5', '24999000', '12', '512', '50', '4400', 'Snapdragon 8 Gen 2', '5G', '1', '7', '6', '6', '5', '7', '7'),
(15, 'Xiaomi Black Shark 5 Pro', '12999000', '16', '512', '64', '4650', 'Snapdragon 8 Gen 1', '5G', '3', '7', '6', '5', '6', '6', '7'),
(16, 'Infinix Zero 5G 2023', '3399000', '8', '256', '50', '5000', 'Dimensity 920', '5G', '6', '5', '5', '6', '7', '6', '7'),
(17, 'Vivo V27 Pro', '7999000', '12', '256', '50', '4600', 'Dimensity 8200', '5G', '5', '7', '5', '6', '6', '6', '7'),
(18, 'Oppo Reno 10 Pro+', '10999000', '12', '256', '64', '4700', 'Snapdragon 8+ Gen 1', '5G', '3', '7', '5', '5', '6', '6', '7'),
(19, 'Iphone 13 Mini', '11999000', '4', '128', '12', '2438', 'Apple A15 Bionic', '5G', '3', '4', '4', '4', '2', '6', '7'),
(20, 'Samsung Galaxy A14 5G', '2999000', '6', '128', '50', '5000', 'Exynos 850', '5G', '7', '4', '4', '6', '7', '5', '7'),
(21, 'Xiaomi Poco X5 Pro', '4499000', '8', '256', '108', '5000', 'Snapdragon 778G', '5G', '6', '5', '5', '7', '7', '5', '7'),
(22, 'Infinix Hot 30i', '1999000', '4', '128', '50', '5000', 'Helio G37', '4G', '7', '4', '4', '6', '7', '3', '6'),
(23, 'Vivo T2x 5G', '3499000', '8', '128', '50', '5000', 'Dimensity 6020', '5G', '6', '5', '4', '6', '7', '5', '7'),
(24, 'Oppo A58 5G', '2999000', '6', '128', '50', '5000', 'Dimensity 6020', '5G', '7', '4', '4', '6', '7', '5', '7'),
(25, 'Iphone XR', '8999000', '3', '64', '12', '2942', 'Apple A12 Bionic', '4G', '4', '3', '3', '4', '3', '4', '6'),
(26, 'Samsung Galaxy S20 FE', '6999000', '6', '128', '12', '4500', 'Snapdragon 865', '5G', '5', '4', '4', '4', '6', '5', '7'),
(27, 'Xiaomi Redmi 12C', '1599000', '3', '64', '50', '5000', 'Helio G85', '4G', '7', '3', '3', '6', '7', '4', '6'),
(28, 'Infinix Note 11 Pro', '2699000', '8', '128', '64', '5000', 'Helio G96', '4G', '6', '5', '4', '5', '7', '4', '6'),
(29, 'Vivo Y16', '1499000', '3', '64', '13', '5000', 'Helio P35', '4G', '7', '3', '3', '4', '7', '3', '6'),
(30, 'Oppo A76', '2499000', '6', '128', '13', '5000', 'Snapdragon 680', '4G', '6', '4', '4', '4', '7', '4', '6'),
(31, 'Iphone 11', '7999000', '4', '128', '12', '3110', 'Apple A13 Bionic', '4G', '5', '4', '4', '4', '4', '5', '6'),
(32, 'Samsung Galaxy M12', '1899000', '4', '64', '48', '6000', 'Exynos 850', '4G', '7', '4', '3', '5', '7', '3', '6'),
(33, 'Xiaomi Redmi 10', '2299000', '4', '64', '50', '5000', 'Helio G88', '4G', '6', '4', '3', '6', '7', '4', '6'),
(34, 'Infinix Smart 7', '1199000', '3', '64', '13', '5000', 'Unisoc SC9863A', '4G', '7', '3', '3', '4', '7', '2', '6'),
(35, 'Vivo Y35', '3499000', '8', '128', '50', '5000', 'Snapdragon 680', '4G', '6', '5', '4', '6', '7', '4', '6'),
(36, 'Oppo A96', '3199000', '8', '128', '50', '5000', 'Snapdragon 680', '4G', '6', '5', '4', '6', '7', '4', '6'),
(37, 'Iphone 8 Plus', '6499000', '3', '64', '12', '2691', 'Apple A11 Bionic', '4G', '5', '3', '3', '4', '2', '4', '6'),
(38, 'Samsung Galaxy A04', '1499000', '4', '64', '50', '5000', 'Helio P35', '4G', '7', '4', '3', '6', '7', '3', '6'),
(39, 'Xiaomi Redmi Note 11', '2999000', '6', '128', '50', '5000', 'Snapdragon 680', '4G', '6', '4', '4', '6', '7', '4', '6'),
(40, 'Infinix Note 30', '2699000', '8', '128', '108', '5000', 'Helio G99', '4G', '6', '5', '4', '7', '7', '4', '6'),
(41, 'Vivo V25', '7499000', '8', '256', '64', '4500', 'Dimensity 900', '5G', '5', '5', '5', '5', '6', '5', '7'),
(42, 'Oppo Reno 7', '7499000', '8', '256', '64', '4500', 'Snapdragon 778G', '5G', '5', '5', '5', '5', '6', '5', '7'),
(43, 'Iphone 12', '10999000', '4', '128', '12', '2815', 'Apple A14 Bionic', '5G', '3', '4', '4', '4', '3', '6', '7'),
(44, 'Samsung Galaxy A33 5G', '4999000', '6', '128', '48', '5000', 'Exynos 1280', '5G', '6', '4', '4', '5', '7', '5', '7'),
(45, 'Xiaomi 12T', '6999000', '8', '256', '108', '5000', 'Dimensity 8100', '5G', '5', '5', '5', '7', '7', '5', '7'),
(46, 'Infinix Zero Ultra', '6599000', '8', '256', '200', '4500', 'Dimensity 920', '5G', '5', '5', '5', '7', '6', '6', '7'),
(47, 'Vivo Y56', '3499000', '8', '128', '50', '5000', 'Dimensity 6020', '5G', '6', '5', '4', '6', '7', '5', '7'),
(48, 'Oppo Reno 8T', '4999000', '8', '256', '108', '5000', 'Helio G99', '4G', '6', '5', '5', '7', '7', '4', '6'),
(49, 'Iphone 7 Plus', '5499000', '3', '32', '12', '2900', 'Apple A10 Fusion', '4G', '5', '3', '2', '4', '2', '3', '6'),
(50, 'Samsung Galaxy S23 Ultra', '24999000', '12', '512', '200', '5000', 'Snapdragon 8 Gen 2', '5G', '1', '7', '6', '7', '7', '7', '7');


--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_hp`
--
ALTER TABLE `data_hp`
  ADD PRIMARY KEY (`id_hp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_hp`
--
ALTER TABLE `data_hp`
  MODIFY `id_hp` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
