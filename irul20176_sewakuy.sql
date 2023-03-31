-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 31, 2023 at 10:15 AM
-- Server version: 10.5.16-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `irul20176_sewakuy`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id_booking` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `tanggal_booking` date NOT NULL,
  `harga` int(100) NOT NULL,
  `validasi` enum('sudah','belum') NOT NULL,
  `bayar` enum('lunas','belum') NOT NULL,
  `aktif` enum('true','false') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id_booking`, `id_kamar`, `username`, `tanggal_booking`, `harga`, `validasi`, `bayar`, `aktif`) VALUES
(31, 16, 'cika', '2022-11-04', 600000, 'sudah', 'lunas', 'true'),
(33, 4, 'cika', '2022-10-31', 300000, 'sudah', 'lunas', 'true'),
(39, 17, 'yayan', '2022-11-20', 400000, 'sudah', 'lunas', 'true'),
(42, 18, 'thoriq', '2022-12-01', 400000, 'belum', 'lunas', 'true'),
(44, 15, 'cika', '2022-12-02', 600000, 'sudah', 'lunas', 'false'),
(45, 15, 'rulrul', '2022-12-02', 600000, 'sudah', 'lunas', 'false'),
(46, 15, 'rulrul', '2022-12-02', 600000, 'sudah', 'lunas', 'false'),
(47, 23, 'rulrul', '2022-12-05', 600000, 'sudah', 'lunas', 'false'),
(48, 23, 'cika', '2022-12-05', 600000, 'sudah', 'lunas', 'false'),
(49, 23, 'yayan', '2022-12-05', 600000, 'sudah', 'lunas', 'false'),
(50, 23, 'yayan', '2022-12-05', 600000, 'sudah', 'lunas', 'false'),
(51, 23, 'cika', '2022-12-05', 600000, 'sudah', 'lunas', 'false'),
(52, 23, 'cika', '2022-12-02', 600000, 'sudah', 'lunas', 'false'),
(53, 15, 'yayan', '2022-11-29', 600000, 'belum', 'lunas', 'true'),
(54, 15, 'yayan', '2022-12-06', 600000, 'belum', 'lunas', 'true'),
(55, 16, 'cika', '2022-12-07', 600000, 'sudah', 'belum', 'true');

--
-- Triggers `booking`
--
DELIMITER $$
CREATE TRIGGER `bi_booking` BEFORE INSERT ON `booking` FOR EACH ROW SET new.harga=(SELECT kamar.harga FROM kamar WHERE kamar.id_kamar=new.id_kamar)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id_fasilitas` int(11) NOT NULL,
  `fasilitas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fasilitas`
--

INSERT INTO `fasilitas` (`id_fasilitas`, `fasilitas`) VALUES
(1, 'kasur'),
(2, 'AC'),
(3, 'WIFI'),
(4, 'kamar mandi dalam'),
(5, 'kloset duduk'),
(6, 'Lemari'),
(7, 'kipas'),
(8, 'kamar mandi luar');

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas_kamar`
--

CREATE TABLE `fasilitas_kamar` (
  `id_fasilitas` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fasilitas_kamar`
--

INSERT INTO `fasilitas_kamar` (`id_fasilitas`, `id_kamar`) VALUES
(1, 4),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(2, 14),
(2, 22),
(3, 4),
(3, 15),
(3, 16),
(3, 17),
(3, 18),
(3, 20),
(3, 22),
(3, 23),
(3, 24),
(3, 25),
(3, 26),
(3, 27),
(3, 28),
(3, 29),
(3, 30),
(3, 31),
(3, 32),
(3, 33),
(4, 4),
(4, 15),
(4, 16),
(4, 19),
(4, 20),
(4, 22),
(6, 19),
(6, 20),
(6, 21),
(6, 22),
(6, 23),
(6, 25),
(6, 26),
(6, 27),
(6, 28),
(6, 29),
(6, 30),
(6, 31),
(6, 32),
(6, 33),
(7, 19),
(8, 21),
(8, 23),
(8, 24),
(8, 25),
(8, 26),
(8, 27),
(8, 28),
(8, 30),
(8, 31),
(8, 32),
(8, 33);

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `id_kamar` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `nama_kamar` varchar(100) NOT NULL,
  `harga` decimal(20,0) NOT NULL,
  `jarak_utm` int(11) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `aturan` varchar(1000) NOT NULL,
  `gambar_kamar` varchar(100) NOT NULL,
  `kategori` enum('putra','putri') NOT NULL,
  `status` enum('tersedia','tidak tersedia') NOT NULL,
  `link` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id_kamar`, `username`, `nama_kamar`, `harga`, `jarak_utm`, `alamat`, `aturan`, `gambar_kamar`, `kategori`, `status`, `link`) VALUES
(4, 'irul', 'Pudak A', 300000, 500, 'Jl. Raya telang', 'tidak boleh bawa miras', 'koslaki.jpg', 'putra', 'tidak tersedia', ''),
(14, 'abahamim', 'Alfazza A', 400000, 200, 'Jl. Telang indah Gang 1 No C.07 Telang, Kamal, KAB. BANGKALAN, KAMAL, JAWA TIMUR, ID, 69162', 'Gerbang ditutup jam 11 malam', '635e7cd461d82.jpeg', 'putri', 'tidak tersedia', ''),
(15, 'abahamim', 'Alfazza B', 600000, 200, 'Jl. Telang indah Gang 1 No C.07 Telang, Kamal, KAB. BANGKALAN, KAMAL, JAWA TIMUR, ID, 69162', 'Gerbang ditutup jam 11 malam', '635e7d07bed4a.jpeg', 'putri', 'tersedia', ''),
(16, 'abahamim', 'Alfazza C', 600000, 200, 'Jl. Telang indah Gang 1 No C.07 Telang, Kamal, KAB. BANGKALAN, KAMAL, JAWA TIMUR, ID, 69162', 'Gerbang ditutup jam 11 malam', '635e7d7b5b0fe.jpeg', 'putri', 'tidak tersedia', ''),
(17, 'irul', 'Pudak B', 400000, 500, ' Jl. Raya telang', 'tidak boleh bawa miras', '635fd32242359.jpg', 'putra', 'tidak tersedia', ''),
(18, 'irul', 'Pudak C', 400000, 500, ' Jl. Raya telang', 'tidak boleh membawa pasangan', '635fd3661601d.jpg', 'putra', 'tersedia', ''),
(19, 'irul', 'Pudak D', 500000, 500, 'Jl. Raya telang', 'tidak boleh bawa miras', '635fd3ec5eb58.jpg', 'putra', 'tersedia', ''),
(20, 'abahamim', 'Alfazza D', 450000, 200, 'Jl. Telang indah Gang 1 No C.07 Telang, Kamal, KAB. BANGKALAN, KAMAL, JAWA TIMUR, ID, 69162', 'tidak boleh membawa pasangan', '635fd75b412ec.jpg', 'putri', 'tidak tersedia', ''),
(21, 'Hannn', 'Kos barokah', 400000, 600, '  Jalan telang indah gang 6 ', 'Tidak boleh membawa minuman keras dan pasangan', 'WhatsApp Image 2022-11-03 at 06.53.03.jpeg', 'putra', 'tersedia', ''),
(22, 'irul', 'Permata VIP', 1000000, 200, ' jalan mawar', 'tidak boleh membawa pasangan', '637476d8c79cf.jpeg', 'putra', 'tersedia', 'https://i.ibb.co/2kmBLnF/360.jpg'),
(23, 'abahamim', 'Alfazza E', 600000, 300, '   Jl. Telang indah Gang 1 No C.07 Telang, Kamal, KAB. BANGKALAN, KAMAL, JAWA TIMUR, ID, 69162', 'tidak boleh membawa pasangan', 'WhatsApp Image 2022-11-22 at 05.48.01.jpeg', 'putri', 'tersedia', 'https://i.ibb.co/0225FdP/Whats-App-Image-2022-11-20-at-14-07-32.jpg'),
(24, 'abahamim', 'Alfazza F', 500000, 300, '  Jl. Telang indah Gang 1 No C.07 Telang, Kamal, KAB. BANGKALAN, KAMAL, JAWA TIMUR, ID, 69162', 'tidak boleh membawa pasangan', '638359b20ffe9.jpeg', 'putri', 'tersedia', 'https://i.ibb.co/3WKMbH0/Whats-App-Image-2022-11-26-at-19-41-31.jpg'),
(25, 'abahamim', 'Alfazza G', 500000, 300, ' Jl. Telang indah Gang 1 No C.07 Telang, Kamal, KAB. BANGKALAN, KAMAL, JAWA TIMUR, ID, 69162', 'tidak boleh membawa pasangan', '63835a5684ca2.jpeg', 'putri', 'tersedia', 'https://i.ibb.co/Q9t9mkY/Whats-App-Image-2022-11-25-at-14-18-26.jpg'),
(26, 'irul', 'Pudak E', 500000, 500, 'Jl. Raya telang', 'Gerbang ditutup jam 11 malam', '63844f7d0423e.jpeg', 'putra', 'tersedia', 'https://i.ibb.co/sPP1GzR/Whats-App-Image-2022-11-20-at-14-07-32.jpg'),
(27, 'irul', 'Pudak F', 500000, 500, 'Jl. Raya telang', 'Gerbang ditutup jam 11 malam', '638450ca72b00.jpeg', 'putra', 'tersedia', 'https://i.ibb.co/3WKMbH0/Whats-App-Image-2022-11-26-at-19-41-31.jpg'),
(28, 'irul', 'Pudak G', 500000, 500, 'Jl. Raya telang', 'Gerbang ditutup jam 11 malam', '63845125703cd.jpeg', 'putra', 'tersedia', 'https://i.ibb.co/Q9t9mkY/Whats-App-Image-2022-11-25-at-14-18-26.jpg'),
(29, 'irul', 'Pudak G', 500000, 500, 'Jl. Raya telang', 'Gerbang ditutup jam 11 malam', '638452e81771d.jpg', 'putra', 'tersedia', ''),
(30, 'irul', 'Pudak H', 500000, 500, 'Jl. Raya telang', 'Gerbang ditutup jam 11 malam', '638453411b589.jpg', 'putra', 'tersedia', ''),
(31, 'abahamim', 'Alfazza I', 450000, 300, ' Jl. Telang indah Gang 1 No C.07 Telang, Kamal, KAB. BANGKALAN, KAMAL, JAWA TIMUR, ID, 69162', 'tidak boleh membawa pasangan', '63845844297e9.jpg', 'putri', 'tersedia', ''),
(32, 'abahamim', 'Alfazza H', 450000, 300, 'Jl. Telang indah Gang 1 No C.07 Telang, Kamal, KAB. BANGKALAN, KAMAL, JAWA TIMUR, ID, 69162', 'tidak boleh membawa pasangan', '6384586439afe.jpg', 'putri', 'tersedia', ''),
(33, 'abahamim', 'Alfazza J', 450000, 300, ' Jl. Telang indah Gang 1 No C.07 Telang, Kamal, KAB. BANGKALAN, KAMAL, JAWA TIMUR, ID, 69162', 'tidak boleh membawa pasangan', '638458e4aa486.jpg', 'putri', 'tersedia', ''),
(40, 'abahamim', 'Aster', 400000, 100, ' dimana saja', 'Tidak ada aturan', '6390c1d400760.jpg', 'putra', 'tersedia', 'https://i.ibb.co/2WbdDvV/kamar360.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id_log` int(11) NOT NULL,
  `username` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aktif` enum('login','logout') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id_log`, `username`, `waktu`, `aktif`) VALUES
(13, 'thoriq', '2022-11-28 14:28:20', 'logout'),
(14, 'admin1', '2022-11-28 14:28:37', 'login'),
(15, 'admin1', '2022-11-28 14:33:11', 'logout'),
(16, 'admin1', '2022-11-28 14:33:23', 'login'),
(17, 'admin1', '2022-11-28 14:34:40', 'logout'),
(18, 'thoriq', '2022-11-28 14:34:50', 'login'),
(19, 'thoriq', '2022-11-28 14:34:53', 'logout'),
(20, 'admin1', '2022-11-28 14:35:00', 'logout'),
(21, 'thoriq', '2022-11-28 14:35:08', 'login'),
(22, 'irul', '2022-11-28 14:35:12', 'login'),
(23, 'thoriq', '2022-11-28 14:35:16', 'logout'),
(24, 'irul', '2022-11-28 14:35:19', 'logout'),
(25, 'admin1', '2022-11-28 14:35:27', 'login'),
(26, 'abahamim', '2022-11-28 14:35:31', 'login'),
(27, 'abahamim', '2022-11-28 14:35:34', 'logout'),
(28, 'admin1', '2022-11-28 14:35:57', 'login'),
(29, 'admin1', '2022-11-28 14:39:12', 'logout'),
(30, 'thoriq', '2022-11-28 14:39:19', 'login'),
(31, 'thoriq', '2022-11-28 14:39:21', 'logout'),
(32, 'admin1', '2022-11-28 14:39:23', 'logout'),
(33, 'admin1', '2022-11-28 14:39:26', 'login'),
(34, 'irul', '2022-11-28 14:39:30', 'login'),
(35, 'irul', '2022-11-28 14:39:33', 'logout'),
(36, 'yayan', '2022-11-28 14:39:38', 'login'),
(37, 'yayan', '2022-11-28 14:39:38', 'login'),
(38, 'yayan', '2022-11-28 14:39:39', 'login'),
(39, 'yayan', '2022-11-28 14:39:45', 'logout'),
(40, 'admin1', '2022-11-28 14:39:57', 'login'),
(41, 'admin1', '2022-11-28 14:41:29', 'logout'),
(42, 'irul', '2022-11-28 14:41:53', 'login'),
(43, 'irul', '2022-11-28 14:41:55', 'logout'),
(44, 'abahamim', '2022-11-28 14:42:17', 'login'),
(45, 'abahamim', '2022-11-28 14:42:19', 'logout'),
(46, 'yayan', '2022-11-28 14:50:10', 'login'),
(47, 'yayan', '2022-11-28 14:50:19', 'logout'),
(48, 'admin1', '2022-11-28 14:55:09', 'logout'),
(49, 'admin1', '2022-11-28 21:59:34', 'logout'),
(50, 'zaki', '2022-11-28 21:59:41', 'login'),
(51, 'admin1', '2022-11-28 21:59:43', 'login'),
(52, 'admin1', '2022-11-28 22:01:33', 'logout'),
(53, 'thoriq', '2022-11-28 22:01:40', 'login'),
(54, 'thoriq', '2022-11-28 22:04:23', 'logout'),
(55, 'zaki', '2022-11-28 22:15:49', 'logout'),
(56, 'admin1', '2022-11-28 22:15:56', 'login'),
(57, 'abahamim', '2022-11-28 23:02:07', 'logout'),
(58, 'irul', '2022-11-28 23:02:16', 'login'),
(59, 'irul', '2022-11-28 23:02:51', 'logout'),
(60, 'admin1', '2022-11-29 09:09:51', 'login'),
(61, 'admin1', '2022-11-29 09:38:18', 'logout'),
(62, 'jk', '2022-11-29 09:41:17', 'login'),
(63, 'jk', '2022-11-29 09:41:30', 'logout'),
(64, 'jk', '2022-11-29 09:41:34', 'login'),
(65, 'jk', '2022-11-29 09:43:25', 'logout'),
(66, 'yayan', '2022-11-29 09:43:32', 'login'),
(67, 'yayan', '2022-11-29 09:44:55', 'logout'),
(68, 'cika', '2022-11-29 09:48:08', 'login'),
(69, 'cika', '2022-11-29 11:13:38', 'logout'),
(70, 'jk', '2022-11-29 11:14:04', 'login'),
(71, 'jk', '2022-11-29 11:22:06', 'logout'),
(72, 'jk', '2022-11-29 11:53:55', 'login'),
(73, 'jk', '2022-11-29 11:54:03', 'logout'),
(74, 'irullah', '2022-11-29 12:01:00', 'login'),
(75, 'irullah', '2022-11-29 12:01:49', 'logout'),
(76, 'abahamim', '2022-11-29 12:19:00', 'login'),
(77, 'abahamim', '2022-11-29 14:11:48', 'logout'),
(78, 'yayan', '2022-11-29 14:11:54', 'login'),
(79, 'yayan', '2022-11-29 14:24:51', 'logout'),
(80, 'abahamim', '2022-11-29 14:24:57', 'login'),
(81, 'abahamim', '2022-11-29 14:25:07', 'logout'),
(82, 'cika', '2022-11-29 14:25:20', 'login'),
(83, 'cika', '2022-11-29 14:39:55', 'logout'),
(84, 'abahamim', '2022-11-29 14:40:00', 'login'),
(85, 'abahamim', '2022-11-29 14:47:27', 'logout'),
(86, 'rulrul', '2022-11-29 14:49:15', 'login'),
(87, 'rulrul', '2022-11-29 14:49:51', 'logout'),
(88, 'abahamim', '2022-11-29 14:49:58', 'login'),
(89, 'abahamim', '2022-11-29 14:54:36', 'logout'),
(90, 'rulrul', '2022-11-29 14:54:43', 'login'),
(91, 'rulrul', '2022-11-29 14:55:30', 'logout'),
(92, 'abahamim', '2022-11-29 14:55:38', 'login'),
(93, 'abahamim', '2022-11-29 15:01:14', 'logout'),
(94, 'cika', '2022-11-29 15:01:22', 'login'),
(95, 'cika', '2022-11-29 15:01:54', 'logout'),
(96, 'abahamim', '2022-11-29 15:01:59', 'login'),
(97, 'abahamim', '2022-11-29 15:03:05', 'logout'),
(98, 'yayan', '2022-11-29 15:03:12', 'login'),
(99, 'yayan', '2022-11-29 15:03:37', 'logout'),
(100, 'abahamim', '2022-11-29 15:05:17', 'login'),
(101, 'abahamim', '2022-11-29 15:05:39', 'logout'),
(102, 'jk', '2022-11-29 15:05:48', 'login'),
(103, 'jk', '2022-11-29 15:05:51', 'logout'),
(104, 'cika', '2022-11-29 15:06:09', 'login'),
(105, 'cika', '2022-11-29 15:06:31', 'logout'),
(106, 'abahamim', '2022-11-29 15:06:38', 'login'),
(107, 'abahamim', '2022-11-29 15:27:55', 'logout'),
(108, 'cika', '2022-11-29 15:28:01', 'login'),
(109, 'cika', '2022-11-29 15:28:05', 'logout'),
(110, 'abahamim', '2022-11-29 15:28:10', 'login'),
(111, 'abahamim', '2022-11-29 15:28:37', 'logout'),
(112, 'cika', '2022-11-29 15:28:43', 'login'),
(113, 'cika', '2022-11-29 15:51:05', 'logout'),
(114, 'abahamim', '2022-11-29 15:51:10', 'login'),
(115, 'abahamim', '2022-11-29 15:51:15', 'logout'),
(116, 'abahamim', '2022-11-29 15:51:22', 'login'),
(117, 'abahamim', '2022-11-29 15:51:27', 'logout'),
(118, 'abahamim', '2022-11-29 15:51:31', 'login'),
(119, 'abahamim', '2022-11-29 15:51:46', 'logout'),
(120, 'cika', '2022-11-29 15:51:51', 'login'),
(121, 'cika', '2022-11-29 15:52:17', 'logout'),
(122, 'abahamim', '2022-11-29 15:52:27', 'login'),
(123, 'yayan', '2022-11-29 21:18:50', 'login'),
(124, 'yayan', '2022-11-29 21:27:21', 'logout'),
(125, 'yayan', '2022-11-29 21:30:27', 'login'),
(126, 'abahamim', '2022-11-29 21:41:03', 'login'),
(127, 'abahamim', '2022-11-29 23:00:15', 'logout'),
(128, 'yayan', '2022-11-29 23:00:32', 'login'),
(129, 'yayan', '2022-11-29 23:03:09', 'logout'),
(130, 'abahamim', '2022-11-29 23:03:16', 'login'),
(131, 'abahamim', '2022-11-29 23:03:48', 'logout'),
(132, 'yayan', '2022-11-29 23:04:06', 'login'),
(133, 'yayan', '2022-11-29 23:04:42', 'logout'),
(134, 'abahamim', '2022-11-29 23:04:47', 'login'),
(135, 'abahamim', '2022-11-29 23:05:02', 'logout'),
(136, 'yayan', '2022-11-29 23:05:08', 'login'),
(137, 'yayan', '2022-11-30 09:17:23', 'login'),
(138, 'yayan', '2022-11-30 09:21:37', 'logout'),
(139, 'irul', '2022-11-30 09:22:02', 'login'),
(140, 'irul', '2022-11-30 09:22:13', 'logout'),
(141, 'abahamim', '2022-11-30 09:22:18', 'login'),
(142, 'abahamim', '2022-11-30 09:23:27', 'logout'),
(143, 'yayan', '2022-11-30 09:23:32', 'login'),
(144, 'admin1', '2022-12-07 21:01:43', 'login'),
(145, 'admin1', '2022-12-07 21:03:00', 'logout'),
(146, 'yayan', '2022-12-07 21:23:43', 'login'),
(147, 'yayan', '2022-12-07 21:37:29', 'logout'),
(148, 'abahamim', '2022-12-07 21:37:36', 'login'),
(149, 'abahamim', '2022-12-07 22:13:14', 'login'),
(150, 'abahamim', '2022-12-08 05:44:22', 'logout'),
(151, 'abahamim', '2022-12-08 06:04:11', 'login'),
(152, 'yayan', '2022-12-08 07:27:23', 'login'),
(153, 'yayan', '2022-12-08 07:27:42', 'logout'),
(154, 'irul', '2022-12-08 07:27:58', 'login'),
(155, 'irul', '2022-12-08 07:51:47', 'logout'),
(156, 'abahamim', '2022-12-08 08:47:07', 'login'),
(157, 'abahamim', '2022-12-08 09:13:50', 'logout'),
(158, 'yayan', '2022-12-08 09:14:01', 'login'),
(159, 'yayan', '2022-12-08 09:14:40', 'logout'),
(160, 'abahamim', '2022-12-08 09:14:48', 'login'),
(161, 'abahamim', '2022-12-08 09:16:33', 'logout'),
(162, 'admin1', '2022-12-08 09:16:42', 'login'),
(163, 'admin1', '2022-12-08 09:17:07', 'login'),
(164, 'admin1', '2022-12-08 09:17:47', 'logout'),
(165, 'yayan', '2022-12-08 09:18:13', 'login'),
(166, 'yayan', '2022-12-08 09:19:03', 'logout'),
(167, 'abahamim', '2022-12-08 09:19:31', 'login'),
(168, 'abahamim', '2022-12-08 09:25:22', 'logout'),
(169, 'yayan', '2022-12-08 09:26:54', 'login'),
(170, 'yayan', '2022-12-08 09:29:56', 'logout'),
(171, 'yayan', '2022-12-08 09:30:03', 'login'),
(172, 'yayan', '2022-12-08 09:34:18', 'logout'),
(173, 'admin1', '2022-12-08 09:43:30', 'login'),
(174, 'admin1', '2022-12-08 09:49:27', 'logout'),
(175, 'abahamim', '2022-12-08 09:49:33', 'login'),
(176, 'admin1', '2022-12-08 09:50:20', 'logout'),
(177, '', '2022-12-08 09:50:21', 'logout'),
(178, 'zaki', '2022-12-08 09:50:34', 'login'),
(179, 'zaki', '2022-12-08 09:50:44', 'logout'),
(180, 'yayan', '2022-12-08 09:50:48', 'login'),
(181, 'yayan', '2022-12-08 10:33:45', 'logout'),
(182, 'abahamim', '2022-12-08 10:33:52', 'login'),
(183, 'abahamim', '2022-12-08 10:34:36', 'logout'),
(184, 'abahamim', '2022-12-08 10:34:52', 'login'),
(185, 'sandi', '2022-12-09 09:14:19', 'login'),
(186, 'sandi', '2022-12-09 09:14:25', 'logout'),
(187, 'admin1', '2022-12-09 09:15:55', 'login'),
(188, 'admin1', '2022-12-09 09:16:07', 'logout'),
(189, 'safa', '2022-12-09 09:16:13', 'login'),
(190, 'safa', '2022-12-09 09:16:27', 'logout'),
(191, 'irul', '2022-12-09 09:16:32', 'login'),
(192, 'abahamim', '2022-12-09 09:38:46', 'login'),
(193, 'yayan', '2022-12-09 09:46:25', 'login'),
(194, 'irul', '2023-03-13 13:02:18', 'login'),
(195, 'irul', '2023-03-13 13:03:34', 'logout'),
(196, 'yayan', '2023-03-13 13:03:40', 'login'),
(197, 'yayan', '2023-03-13 13:04:23', 'logout'),
(198, 'irul', '2023-03-13 13:13:31', 'login');

--
-- Triggers `log`
--
DELIMITER $$
CREATE TRIGGER `bi_log` BEFORE INSERT ON `log` FOR EACH ROW SET new.waktu = ADDTIME(now(), "7:00:00")
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id_rating` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `tanggal_rate` date NOT NULL,
  `rate` float NOT NULL,
  `ulasan` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id_rating`, `id_kamar`, `username`, `tanggal_rate`, `rate`, `ulasan`) VALUES
(24, 16, 'cika', '2022-10-30', 4.5, 'kamar nya tidak bocor dan aman'),
(25, 14, 'yayan', '2022-10-30', 4.6, '<p color: green;> Kamar bagus</p>'),
(26, 16, 'cika', '2022-10-30', 4.4, '<h3 color: red> kamar bersih</h3>'),
(27, 16, 'cika', '2022-10-30', 0, '<h1 color:red;>Kamar nyaman </h1>'),
(28, 4, 'cika', '2022-10-30', 0, '<h1 color:red>Kamarnya keren</h1>'),
(29, 4, 'cika', '2022-10-30', 3.3, '<h1 color:red>Kamarnya rapii</h1>'),
(30, 4, 'cika', '2022-10-30', 3.5, '<h1 color:red>Kamar bagus banget</h1>'),
(31, 20, 'yayan', '2022-11-01', 4.2, 'Kamar bagus'),
(32, 21, 'yayan', '2022-11-08', 3.7, 'Kamar bagus'),
(33, 21, 'yayan', '2022-11-08', 4.2, 'Kamar keren'),
(34, 15, 'yayan', '2022-11-29', 4.8, '<h1>NNNNN</h1>'),
(35, 23, 'yayan', '2022-11-29', 4.9, '<h1>bagus</h1>'),
(36, 23, 'yayan', '2022-11-29', 4.6, 'bagus sekali 2'),
(37, 17, 'yayan', '2022-11-29', 0, 'mantap'),
(38, 17, 'yayan', '2022-11-29', 4.5, '<a href=\"https://www.w3schools.com\">mantap</a>');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jk` enum('pria','wanita') NOT NULL,
  `alamat_kos` varchar(250) NOT NULL DEFAULT '-',
  `email` varchar(100) NOT NULL,
  `nomor_hp` varchar(20) NOT NULL,
  `foto_profil` varchar(100) NOT NULL,
  `berkas` varchar(100) NOT NULL DEFAULT '-',
  `level` enum('pemilik','penghuni','admin') NOT NULL,
  `verif` enum('sudah','belum') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `nama`, `jk`, `alamat_kos`, `email`, `nomor_hp`, `foto_profil`, `berkas`, `level`, `verif`) VALUES
('abahamim', '698d51a19d8a121ce581499d7b701668', 'Aba Hamim', 'pria', 'Jl. Telang indah Gang 1 No C.07 Telang, Kamal, KAB. BANGKALAN, KAMAL, JAWA TIMUR, ID, 69162', 'abahamin047@gmail.com', '081330955933', 'aba.jpg', 'berkas.pdf', 'pemilik', 'sudah'),
('admin1', 'd93ed5b6db83be78efb0d05ae420158e', 'ADMIN', 'pria', '-', '-', '000', '-', '', 'admin', 'sudah'),
('amina', '698d51a19d8a121ce581499d7b701668', 'hj amina', 'wanita', 'Jl. Telang indah Gang 1 No C.07 Telang, Kamal, KAB. BANGKALAN, KAMAL, JAWA TIMUR, ID, 69162', 'amina1970@gmail.com', '', 'default.jpg', 'T-23.pdf', 'pemilik', 'sudah'),
('andi', '202cb962ac59075b964b07152d234b70', 'Aster', 'pria', '', 'atr@gmail.com', '', 'default.jpg', '-', 'penghuni', 'sudah'),
('andri', '202cb962ac59075b964b07152d234b70', 'andri', 'pria', '', 'fajarandrianto56@gmail.com', '', 'default.jpg', '-', 'penghuni', 'sudah'),
('bang', '202cb962ac59075b964b07152d234b70', 'bismillah', 'pria', '', 'go123@gmail.com', '', 'default.jpg', '-', 'penghuni', 'sudah'),
('cika', '202cb962ac59075b964b07152d234b70', 'cika', 'wanita', '-', 'cika@gmail.com', '', 'default.jpg', '', 'penghuni', 'sudah'),
('cobbss', '202cb962ac59075b964b07152d234b70', 'Mencoba', 'pria', 'Jalan di dunia', 'cobss@gmail.com', '', 'default.jpg', '1737-4622-3-PB.pdf', 'pemilik', 'sudah'),
('dani', '81dc9bdb52d04dc20036dbd8313ed055', 'indra', 'pria', '', 'fajarandrianto6@gmail.com', '', 'default.jpg', '-', 'penghuni', 'sudah'),
('fajar', '202cb962ac59075b964b07152d234b70', 'fajar andrianto', 'pria', 'Socah Bangkalan', 'fajarandrianto56@gmail.com', '085732526157', 'logo babussalam.png', 'Jadwal Solat November.pdf', 'pemilik', 'sudah'),
('gara', '202cb962ac59075b964b07152d234b70', 'garaaaa', 'pria', '', 'narto@gmail.com', '', 'default.jpg', '-', 'penghuni', 'sudah'),
('Han', '202cb962ac59075b964b07152d234b70', 'Raihan', 'pria', '', 'coba@gmail.com', '', 'default.jpg', '', 'penghuni', 'sudah'),
('Hannn', '202cb962ac59075b964b07152d234b70', 'Akhmad Raihan', 'pria', 'Jalan telang indah gang 6', 'isiansembarang@gmail.com', '0899999999', 'AKMDRHAN-removebg-preview(1).png', 'tespdf.pdf', 'pemilik', 'sudah'),
('hayati12', 'c7c8b68142e2d65710d16c87dcfe02ef', 'hayati', 'wanita', '', 'hayati12@gmail.co', '', 'default.jpg', '-', 'penghuni', 'sudah'),
('irul', '202cb962ac59075b964b07152d234b70', 'H. Irul  Sholeh', 'pria', '-', 'sholeh@gmail.com', '082337470663', 'sholeh.jpg', '', 'pemilik', 'sudah'),
('irullah', 'c4ca4238a0b923820dcc509a6f75849b', 'Ngab Irul', 'pria', '', 'okeoke018@gmail.com', '', 'default.jpg', '-', 'penghuni', 'sudah'),
('jk', 'c4ca4238a0b923820dcc509a6f75849b', 'Qar', 'pria', 'asd', 'Qar@gmail.com', '', 'default.jpg', '-', 'pemilik', 'sudah'),
('jn cena', '202cb962ac59075b964b07152d234b70', 'Joncena', 'pria', 'Ring Tinju', 'wwe@gmail.com', '', 'default.jpg', 'software-requirement-document-template-1.pdf', 'pemilik', 'belum'),
('lesti', '202cb962ac59075b964b07152d234b70', 'lestias', 'pria', '', 'lt@gmail.com', '', 'default.jpg', '-', 'penghuni', 'sudah'),
('naufal', '4297f44b13955235245b2497399d7a93', 'naufal', 'pria', 'jl mayjend sungkono', 'naufal@gmail.com', '', 'default.jpg', '', 'pemilik', 'sudah'),
('Qarr22', '202cb962ac59075b964b07152d234b70', 'Qar', 'pria', 'Jl Pemuda no 99', 'Qar22@gmail.com', '', 'default.jpg', '235-689-2-PB.pdf', 'pemilik', 'belum'),
('rono', '698d51a19d8a121ce581499d7b701668', 'rono', 'pria', 'jl mayjend sungkono', 'yayanmnh8@gmail.com', '', 'default.jpg', '644-Article Text-2278-1-10-20171125.pdf', 'pemilik', 'sudah'),
('rulrul', '202cb962ac59075b964b07152d234b70', 'nurul', 'wanita', '', 'lurun@gmail.com', '', 'default.jpg', '-', 'penghuni', 'sudah'),
('ryu', '202cb962ac59075b964b07152d234b70', 'ryu', 'pria', '-', 'ryu@mail.com', '087', 'qqwe.jpg', '', 'penghuni', 'sudah'),
('safa', '202cb962ac59075b964b07152d234b70', 'safa', 'pria', 'telang', 'safa@gmail.com', '', 'default.jpg', 'PROPOSAL MUSRAN IPM BULUH.pdf', 'pemilik', 'sudah'),
('sandi', '202cb962ac59075b964b07152d234b70', 'fajar', 'pria', '', 'andri123@gmail.com', '', 'default.jpg', '-', 'penghuni', 'sudah'),
('sora', '310dcbbf4cce62f762a2aaa148d556bd', 'sora', 'pria', 'Jl. Telang indah Gang 1 No C.07 Telang, Kamal, KAB. BANGKALAN, KAMAL, JAWA TIMUR, ID, 69162', 'yayanmnh28@gmail.com', '', 'default.jpg', '1368-2332-1-SM.pdf', 'pemilik', 'sudah'),
('thoriq', '2cfd4560539f887a5e420412b370b361', 'Muhammad Fathuthoriq', 'pria', '-', 'thoriq771@gmail.com', '084565345423', '635fb1636a924.JPG', '', 'penghuni', 'sudah'),
('tr1', 'c20ad4d76fe97759aa27a0c99bff6710', 'asd12', 'pria', '', 'ayam@gmail.com', '', 'default.jpg', '-', 'penghuni', 'sudah'),
('try', '3c59dc048e8850243be8079a5c74d079', 'trying', 'pria', 'jalan.kh.hasyim Ashari IV/11', 'try123@gmail.com', '', 'default.jpg', 'etrof uas.pdf', 'pemilik', 'belum'),
('yayan', '202cb962ac59075b964b07152d234b70', 'M. Nur Hidayat ', 'pria', '-', 'mnurhidayat@gmail.com', '082332311187', 'WhatsApp Image 2022-11-16 at 08.57.49.jpeg', '', 'penghuni', 'sudah'),
('zaki', '202cb962ac59075b964b07152d234b70', 'Naufal abdullah rasyiq zaki', 'pria', '', 'naufalabdullah27@gmail.com', '', 'default.jpg', '-', 'penghuni', 'sudah');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id_booking`),
  ADD KEY `id_kamar` (`id_kamar`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id_fasilitas`);

--
-- Indexes for table `fasilitas_kamar`
--
ALTER TABLE `fasilitas_kamar`
  ADD PRIMARY KEY (`id_fasilitas`,`id_kamar`),
  ADD KEY `fk_kamarfasilitas` (`id_kamar`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id_kamar`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id_rating`),
  ADD KEY `id_kamar` (`id_kamar`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id_fasilitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id_rating` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `fk_kamarbooking` FOREIGN KEY (`id_kamar`) REFERENCES `kamar` (`id_kamar`),
  ADD CONSTRAINT `fk_userbooking` FOREIGN KEY (`username`) REFERENCES `user` (`username`);

--
-- Constraints for table `fasilitas_kamar`
--
ALTER TABLE `fasilitas_kamar`
  ADD CONSTRAINT `fk_fasilitas` FOREIGN KEY (`id_fasilitas`) REFERENCES `fasilitas` (`id_fasilitas`),
  ADD CONSTRAINT `fk_kamarfasilitas` FOREIGN KEY (`id_kamar`) REFERENCES `kamar` (`id_kamar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kamar`
--
ALTER TABLE `kamar`
  ADD CONSTRAINT `fk_kepemilikan` FOREIGN KEY (`username`) REFERENCES `user` (`username`);

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `fk_kamarrating` FOREIGN KEY (`id_kamar`) REFERENCES `kamar` (`id_kamar`),
  ADD CONSTRAINT `fk_userrating` FOREIGN KEY (`username`) REFERENCES `user` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
