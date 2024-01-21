-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 19, 2024 at 03:29 PM
-- Server version: 8.0.35-0ubuntu0.22.04.1
-- PHP Version: 8.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` int NOT NULL,
  `id_devices` int NOT NULL,
  `id_rfid` int NOT NULL,
  `keterangan` varchar(20) NOT NULL,
  `foto` mediumtext NOT NULL,
  `created_at` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id_absensi`, `id_devices`, `id_rfid`, `keterangan`, `foto`, `created_at`) VALUES
(1, 2, 8, 'masuk', '', 1705067154),
(2, 2, 21, 'masuk', '', 1704381135),
(3, 2, 22, 'masuk', '', 1704381148),
(4, 2, 20, 'masuk', '', 1704381154),
(5, 2, 19, 'masuk', '', 1704381158),
(6, 2, 11, 'masuk', '', 1704381173),
(7, 2, 16, 'masuk', '', 1704381178),
(8, 2, 9, 'masuk', '', 1704381181),
(9, 2, 10, 'masuk', '', 1704381186),
(10, 2, 7, 'masuk', '', 1704381190),
(11, 2, 5, 'masuk', '', 1704381193),
(12, 2, 13, 'masuk', '', 1704381197),
(13, 2, 6, 'masuk', '', 1704381200),
(14, 2, 4, 'masuk', '', 1704381203),
(15, 2, 1, 'masuk', '', 1704381206),
(16, 2, 2, 'masuk', '', 1704381209),
(17, 2, 3, 'masuk', '', 1704381213),
(18, 2, 24, 'masuk', '', 1704381216),
(19, 2, 26, 'masuk', '', 1704381219),
(20, 2, 12, 'masuk', '', 1704381223),
(21, 2, 14, 'masuk', '', 1704381226),
(22, 2, 15, 'masuk', '', 1704381230),
(23, 2, 17, 'masuk', '', 1704381252),
(24, 2, 2, 'masuk', '', 1704417649),
(25, 2, 15, 'masuk', '', 1704417660),
(26, 2, 18, 'masuk', '', 1704417680),
(27, 2, 1, 'masuk', '', 1704417897),
(28, 2, 4, 'masuk', '', 1704418229),
(29, 2, 5, 'masuk', '', 1704418354),
(30, 2, 7, 'masuk', '', 1704418359),
(31, 2, 10, 'masuk', '', 1704418372),
(32, 2, 19, 'masuk', '', 1704418383),
(33, 2, 20, 'masuk', '', 1704418387),
(34, 2, 22, 'masuk', '', 1704418391),
(35, 2, 21, 'masuk', '', 1704418394),
(36, 2, 8, 'masuk', '', 1704418401),
(37, 2, 14, 'masuk', '', 1704418409),
(38, 2, 12, 'masuk', '', 1704418413),
(39, 2, 26, 'masuk', '', 1704418419),
(40, 2, 24, 'masuk', '', 1704418424),
(41, 2, 3, 'masuk', '', 1704418428),
(42, 2, 6, 'masuk', '', 1704418433),
(43, 2, 13, 'masuk', '', 1704418440),
(44, 2, 9, 'masuk', '', 1704418445),
(45, 2, 16, 'masuk', '', 1704418450),
(46, 2, 11, 'masuk', '', 1704418455),
(47, 2, 17, 'masuk', '', 1704418481),
(48, 2, 7, 'keluar', '', 1704424828),
(49, 2, 10, 'keluar', '', 1704424837),
(50, 2, 1, 'keluar', '', 1704424841),
(51, 2, 19, 'keluar', '', 1704424848),
(52, 2, 20, 'keluar', '', 1704424853),
(53, 2, 22, 'keluar', '', 1704424858),
(54, 2, 21, 'keluar', '', 1704424862),
(55, 2, 8, 'keluar', '', 1704424868),
(56, 2, 4, 'keluar', '', 1704424874),
(57, 2, 14, 'keluar', '', 1704424879),
(58, 2, 12, 'keluar', '', 1704424884),
(59, 2, 26, 'keluar', '', 1704424890),
(60, 2, 24, 'keluar', '', 1704424895),
(61, 2, 3, 'keluar', '', 1704424900),
(62, 2, 6, 'keluar', '', 1704424906),
(63, 2, 13, 'keluar', '', 1704424911),
(64, 2, 9, 'keluar', '', 1704424915),
(65, 2, 16, 'keluar', '', 1704424921),
(66, 2, 11, 'keluar', '', 1704424926),
(67, 2, 18, 'keluar', '', 1704424931),
(68, 2, 15, 'keluar', '', 1704424936),
(69, 2, 17, 'keluar', '', 1704424947),
(70, 2, 2, 'keluar', '', 1704424954),
(71, 2, 5, 'keluar', '', 1705067567),
(72, 2, 5, 'masuk', '', 1704536331),
(73, 2, 2, 'masuk', '', 1704536342),
(74, 2, 17, 'masuk', '', 1704536347),
(75, 2, 15, 'masuk', '', 1704536383),
(76, 2, 18, 'masuk', '', 1704536389),
(77, 2, 11, 'masuk', '', 1704536396),
(78, 2, 16, 'masuk', '', 1704536403),
(79, 2, 9, 'masuk', '', 1704536408),
(80, 2, 13, 'masuk', '', 1704536414),
(81, 2, 6, 'masuk', '', 1704536421),
(82, 2, 3, 'masuk', '', 1704536427),
(83, 2, 24, 'masuk', '', 1704536433),
(84, 2, 26, 'masuk', '', 1704536439),
(85, 2, 12, 'masuk', '', 1704536446),
(86, 2, 14, 'masuk', '', 1704536452),
(87, 2, 4, 'masuk', '', 1704536457),
(88, 2, 8, 'masuk', '', 1704536463),
(89, 2, 21, 'masuk', '', 1704536471),
(90, 2, 22, 'masuk', '', 1704536477),
(91, 2, 20, 'masuk', '', 1704536486),
(92, 2, 19, 'masuk', '', 1704536492),
(93, 2, 1, 'masuk', '', 1704536500),
(94, 2, 10, 'masuk', '', 1704536507),
(95, 2, 7, 'masuk', '', 1704536515),
(96, 2, 17, 'keluar', '', 1704543420),
(97, 2, 15, 'keluar', '', 1704543425),
(98, 2, 18, 'keluar', '', 1704543431),
(99, 2, 11, 'keluar', '', 1704543436),
(100, 2, 16, 'keluar', '', 1704543444),
(101, 2, 9, 'keluar', '', 1704543449),
(102, 2, 13, 'keluar', '', 1704543454),
(103, 2, 6, 'keluar', '', 1704543460),
(104, 2, 3, 'keluar', '', 1704543467),
(105, 2, 24, 'keluar', '', 1704543472),
(106, 2, 26, 'keluar', '', 1704543477),
(107, 2, 12, 'keluar', '', 1704543482),
(108, 2, 14, 'keluar', '', 1704543487),
(109, 2, 4, 'keluar', '', 1704543492),
(110, 2, 8, 'keluar', '', 1704543497),
(111, 2, 21, 'keluar', '', 1704543502),
(112, 2, 22, 'keluar', '', 1704543506),
(113, 2, 20, 'keluar', '', 1704543510),
(114, 2, 19, 'keluar', '', 1704543515),
(115, 2, 1, 'keluar', '', 1704543519),
(116, 2, 10, 'keluar', '', 1704543524),
(117, 2, 7, 'keluar', '', 1704543528),
(118, 2, 5, 'keluar', '', 1704543534),
(119, 2, 2, 'keluar', '', 1704543539);

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id_devices` int NOT NULL,
  `nama_devices` varchar(100) NOT NULL,
  `mode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id_devices`, `nama_devices`, `mode`) VALUES
(1, 'Absensi xyz', 'SCAN'),
(2, 'imam', 'SCAN');

-- --------------------------------------------------------

--
-- Table structure for table `histori`
--

CREATE TABLE `histori` (
  `id_histori` int NOT NULL,
  `id_rfid` int NOT NULL,
  `id_devices` int NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `waktu` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `histori`
--

INSERT INTO `histori` (`id_histori`, `id_rfid`, `id_devices`, `keterangan`, `waktu`) VALUES
(1, 8, 2, 'masuk', 1704381121),
(2, 4, 2, 'masuk', 1704418229),
(3, 5, 2, 'masuk', 1704418354),
(4, 7, 2, 'masuk', 1704418359),
(5, 10, 2, 'masuk', 1704418372),
(6, 19, 2, 'masuk', 1704418383),
(7, 20, 2, 'masuk', 1704418387),
(8, 22, 2, 'masuk', 1704418391),
(9, 21, 2, 'masuk', 1704418394),
(10, 8, 2, 'masuk', 1704418401),
(11, 14, 2, 'masuk', 1704418409),
(12, 12, 2, 'masuk', 1704418413),
(13, 26, 2, 'masuk', 1704418419),
(14, 24, 2, 'masuk', 1704418424),
(15, 3, 2, 'masuk', 1704418428),
(16, 6, 2, 'masuk', 1704418433),
(17, 13, 2, 'masuk', 1704418440),
(18, 9, 2, 'masuk', 1704418445),
(19, 16, 2, 'masuk', 1704418450),
(20, 11, 2, 'masuk', 1704418455),
(21, 17, 2, 'masuk', 1704418481),
(22, 7, 2, 'keluar', 1704424828),
(23, 10, 2, 'keluar', 1704424837),
(24, 1, 2, 'keluar', 1704424841),
(25, 19, 2, 'keluar', 1704424848),
(26, 20, 2, 'keluar', 1704424853),
(27, 22, 2, 'keluar', 1704424858),
(28, 21, 2, 'keluar', 1704424862),
(29, 8, 2, 'keluar', 1704424868),
(30, 4, 2, 'keluar', 1704424874),
(31, 14, 2, 'keluar', 1704424879),
(32, 12, 2, 'keluar', 1704424884),
(33, 26, 2, 'keluar', 1704424890),
(34, 24, 2, 'keluar', 1704424895),
(35, 3, 2, 'keluar', 1704424900),
(36, 6, 2, 'keluar', 1704424906),
(37, 13, 2, 'keluar', 1704424911),
(38, 9, 2, 'keluar', 1704424915),
(39, 16, 2, 'keluar', 1704424921),
(40, 11, 2, 'keluar', 1704424926),
(41, 18, 2, 'keluar', 1704424931),
(42, 15, 2, 'keluar', 1704424936),
(43, 17, 2, 'keluar', 1704424947),
(44, 2, 2, 'keluar', 1704424954),
(45, 5, 2, 'keluar', 1704424961),
(46, 5, 2, 'masuk', 1704536331),
(47, 2, 2, 'masuk', 1704536342),
(48, 17, 2, 'masuk', 1704536347),
(49, 15, 2, 'masuk', 1704536383),
(50, 18, 2, 'masuk', 1704536389),
(51, 11, 2, 'masuk', 1704536396),
(52, 16, 2, 'masuk', 1704536403),
(53, 9, 2, 'masuk', 1704536408),
(54, 13, 2, 'masuk', 1704536414),
(55, 6, 2, 'masuk', 1704536421),
(56, 3, 2, 'masuk', 1704536427),
(57, 24, 2, 'masuk', 1704536433),
(58, 26, 2, 'masuk', 1704536439),
(59, 12, 2, 'masuk', 1704536446),
(60, 14, 2, 'masuk', 1704536452),
(61, 4, 2, 'masuk', 1704536457),
(62, 8, 2, 'masuk', 1704536463),
(63, 21, 2, 'masuk', 1704536471),
(64, 22, 2, 'masuk', 1704536477),
(65, 20, 2, 'masuk', 1704536486),
(66, 19, 2, 'masuk', 1704536492),
(67, 1, 2, 'masuk', 1704536500),
(68, 10, 2, 'masuk', 1704536507),
(69, 7, 2, 'masuk', 1704536515),
(70, 17, 2, 'keluar', 1704543420),
(71, 15, 2, 'keluar', 1704543425),
(72, 18, 2, 'keluar', 1704543431),
(73, 11, 2, 'keluar', 1704543436),
(74, 16, 2, 'keluar', 1704543444),
(75, 9, 2, 'keluar', 1704543449),
(76, 13, 2, 'keluar', 1704543454),
(77, 6, 2, 'keluar', 1704543460),
(78, 3, 2, 'keluar', 1704543467),
(79, 24, 2, 'keluar', 1704543472),
(80, 26, 2, 'keluar', 1704543477),
(81, 12, 2, 'keluar', 1704543482),
(82, 14, 2, 'keluar', 1704543487),
(83, 4, 2, 'keluar', 1704543492),
(84, 8, 2, 'keluar', 1704543497),
(85, 21, 2, 'keluar', 1704543502),
(86, 22, 2, 'keluar', 1704543506),
(87, 20, 2, 'keluar', 1704543510),
(88, 19, 2, 'keluar', 1704543515),
(89, 1, 2, 'keluar', 1704543519),
(90, 10, 2, 'keluar', 1704543524),
(91, 7, 2, 'keluar', 1704543528),
(92, 5, 2, 'keluar', 1704543534),
(93, 2, 2, 'keluar', 1704543539);

-- --------------------------------------------------------

--
-- Table structure for table `kampus`
--

CREATE TABLE `kampus` (
  `id` int NOT NULL,
  `kampus` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kampus`
--

INSERT INTO `kampus` (`id`, `kampus`) VALUES
(1, 'Kampus 1'),
(3, 'Kampus 2 ');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int NOT NULL,
  `kelas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `kelas`) VALUES
(1, '11 TKJ 1');

-- --------------------------------------------------------

--
-- Table structure for table `rfid`
--

CREATE TABLE `rfid` (
  `id_rfid` int NOT NULL,
  `id_devices` int NOT NULL,
  `nis` varchar(50) DEFAULT NULL,
  `uid` varchar(20) NOT NULL,
  `id_kelas` int DEFAULT NULL,
  `id_kampus` int DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rfid`
--

INSERT INTO `rfid` (`id_rfid`, `id_devices`, `nis`, `uid`, `id_kelas`, `id_kampus`, `nama`, `telp`, `gender`, `jabatan`, `alamat`, `foto`) VALUES
(1, 2, '21221007', 'a3-9b-5-fe-c3', 1, 1, 'AGNIA PADILAH', '697696978', 'p', 'siswa', 'indonesia', 'https://drive.google.com/uc?export=view&id=1PkUs48tuQOfvoy1qNWtQUJmELMpKSX9o'),
(2, 2, '21221008', '53-a1-18-fe-14', 1, 1, 'CITRA MULYANI', '697696978', 'p', 'siswa', 'indonesia', 'https://drive.google.com/uc?export=view&id=1TU5CrvOBNEfAb2munvPOuAMM4UADj4cW'),
(3, 2, '21221009', '73-fd-17-fe-67', 1, 1, 'DHEA RAISYA AULLIA', '697696978', 'p', 'siswa', 'indonesia', 'https://drive.google.com/uc?export=view&id=1E_pSgVIntvfUF-9eeKIiMr_qxX4y4W89'),
(4, 2, '21221010', 'c3-c0-25-fe-d8', 1, 1, 'DITA ANANDA', '697696978', 'p', 'siswa', 'indonesia', 'https://drive.google.com/uc?export=view&id=1Rh4X9a1BY1PjK-8uDlAFOi-nGxjzNP4F'),
(5, 2, '21221011', '43-30-a-fe-87', 1, 1, 'EMELYA ANWAR', '697696978', 'p', 'siswa', 'indonesia', 'https://drive.google.com/uc?export=view&id=1cX8JUgAVHbafo6Aj61OmgV-uJbe0AODD'),
(6, 2, '21221012', 'e3-fa-b-fe-ec', 1, 1, 'EPA LESTIYANI', '697696978', 'p', 'siswa', 'indonesia', 'https://drive.google.com/uc?export=view&id=1xzQUYVzM4N_GTtOY42mwNF5rBzGBFtV5'),
(7, 2, '21221013', '83-e-d-fe-7e', 1, 1, 'FERA PETIKASARI', '697696978', 'p', 'siswa', 'indonesia', 'https://drive.google.com/uc?export=view&id=1fT5jSy25ybwZMQS0V2SDhkC9q0dpkWHZ'),
(8, 2, '21221014', '83-8-1a-fe-6f', 1, 1, 'FIRNAWANTI AMALIA', '697696978', 'p', 'siswa', 'indonesia', 'https://drive.google.com/uc?export=view&id=16uKunYTylXF-ZwGStOWqkYJmiQyH6_rv'),
(9, 2, '21221015', 'e3-a9-11-fe-a5', 1, 1, 'GEA AULIA PUTRI', '697696978', 'p', 'siswa', 'indonesia', 'https://drive.google.com/uc?export=view&id=12DZVRpf0kwSBNIbOZuiy4_3feg6bLFl9'),
(10, 2, '21221016', 'd3-6d-c-fe-4c', 1, 1, 'HANI NURFITRI RAHMADANI', '697696978', 'p', 'siswa', 'indonesia', 'https://drive.google.com/uc?export=view&id=1ovbjHCLSon5_eFrrwHDD_qpiWI9Y3je_'),
(11, 2, '21221017', '63-8a-8-fe-1f', 1, 1, 'IDA NURMALASARI', '697696978', 'p', 'siswa', 'indonesia', 'https://drive.google.com/uc?export=view&id=1dqN4-82ijdx9R5U3EBJJsMpc2CKlIKGX'),
(12, 2, '21221018', '83-6-6-fe-7d', 1, 1, 'IQNA NALUL MUNA AZHAR NURHALIZ', '697696978', 'p', 'siswa', 'indonesia', 'https://drive.google.com/uc?export=view&id=1fadhv_CIMCwU6m3q8C4BtcFnRzGoqZHn'),
(13, 2, '21221019', 'd3-99-12-fe-a6', 1, 1, 'NADA AULIA PUTRI GUNAWAN', '697696978', 'p', 'siswa', 'indonesia', 'https://drive.google.com/uc?export=view&id=1IJtWxOhtd6BX8P6bzSB9Ml5VulIR198R'),
(14, 2, '21221020', 'f3-2b-19-fe-3f', 1, 1, 'NIDA NURUL FALAAH', '697696978', 'p', 'siswa', 'indonesia', 'https://drive.google.com/uc?export=view&id=1uTI4eSfnxm0I_vXUPqo2M_Xk4chc_PPw'),
(15, 2, '21221021', '13-89-25-fe-41', 1, 1, 'NINING RATNANINGSIH', '697696978', 'p', 'siswa', 'indonesia', 'https://drive.google.com/uc?export=view&id=1VR-siXWG26VvcBMBzjfowyq46uF72N3B'),
(16, 2, '21221022', '53-16-1a-fe-a1', 1, 1, 'NITA KURNIA HAYATI', '697696978', 'p', 'siswa', 'indonesia', 'https://drive.google.com/uc?export=view&id=1PPnWDbDJc4tA807GPZrDitcqXe4DA0v5'),
(17, 2, '21221023', '53-52-b-fe-f4', 1, 1, 'NURAILA AMBARWATI', '697696978', 'p', 'siswa', 'indonesia', 'https://drive.google.com/uc?export=view&id=1eZnRWX7nuSnBVnw7Kb2NQVw5ZGa8ZAD3'),
(18, 2, '21221024', '83-10-1b-fe-76', 1, 1, 'RATNASARI SOPIYANTI', '697696978', 'p', 'siswa', 'indonesia', 'https://drive.google.com/uc?export=view&id=1YTIZiux6dyWdGQX8uymINGJpnyhfyWUW'),
(19, 2, '21221025', 'd3-fc-19-fe-c8', 1, 1, 'RENI SELVI RIFTINA', '+62697696978', 'p', 'siswa', 'indonesia', 'https://drive.google.com/uc?export=view&id=1PDMsrC5xk9iIvOknJHh1-5siY0EkOf3o'),
(20, 2, '21221026', '43-a6-1b-fe-0', 1, 1, 'RENISA INDINAILA', '697696978', 'p', 'siswa', 'indonesia', 'https://drive.google.com/uc?export=view&id=1KrI-Zbh7bf6LZHpRUKixXFbU8YuAFtLF'),
(21, 2, '21221027', 'a0-cd-f4-73-ea', 1, 1, 'RENITA SEPTIANA', '697696978', 'p', 'siswa', 'indonesia', 'https://drive.google.com/uc?export=view&id=13xVLAGIJPMGCWRW-VoMyyo2lp66kQHjQ'),
(22, 2, '000090909090', '0-75-f5-73-f3', 1, 1, 'RESVIANI CLAUDIA', '697696978', 'p', 'siswa', 'indonesia', 'https://drive.google.com/uc?export=view&id=1tITiKHK3mkuzf16b7pSUIoGNgCFHLmoB'),
(23, 2, '21221029', 'b0-cd-f4-73-fa', 1, 1, 'REVA AULIA', '697696978', 'p', 'siswa', 'indonesia', 'https://drive.google.com/uc?export=view&id=1ANNkm0Fm2alOxeEG1I2U7FLVuGCySA9E'),
(24, 2, '21221030', 'd0-ee-f8-73-b5', 1, 1, 'SILVI OKTAVIA', '697696978', 'p', 'siswa', 'indonesia', 'https://drive.google.com/uc?export=view&id=1v_nAaL_AGBsyN0P13PClImuPox3c3-8h'),
(25, 2, '21221031', 'b0-cd-f4-73-fa', 1, 1, 'SILVI OKTAVIA', '697696978', 'p', 'siswa', 'indonesia', 'https://drive.google.com/uc?export=view&id=1_-_J4x7dIlcBxqRiR_DBYFeQg819gpRp'),
(26, 2, NULL, 'b0-cd-f4-73-fa', 1, 1, '00000000', '697696978', 'p', 'siswa', 'indonesia', 'https://drive.google.com/uc?export=view&id=1_-_J4x7dIlcBxqRiR_DBYFeQg819gpRp');

-- --------------------------------------------------------

--
-- Table structure for table `secret_key`
--

CREATE TABLE `secret_key` (
  `id_key` int NOT NULL,
  `key` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `secret_key`
--

INSERT INTO `secret_key` (`id_key`, `key`) VALUES
(1, 'asdkjWEQEDasd12ksnd');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `email`, `username`, `password`, `avatar`) VALUES

(1, 'Admin', 'admin@email.com', 'admin', '$2a$08$3WyRJUHBqEG.sQ4yYTLxqOAXyqApz5/4AMZ73kauVsah1QfyKe7yC', 'logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `waktu_operasional`
--

CREATE TABLE `waktu_operasional` (
  `id_waktu_operasional` int NOT NULL,
  `waktu_operasional` varchar(20) NOT NULL,
  `keterangan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `waktu_operasional`
--

INSERT INTO `waktu_operasional` (`id_waktu_operasional`, `waktu_operasional`, `keterangan`) VALUES
(1, '19:19-20:01', 'masuk'),
(2, '21:00-22:00', 'keluar');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id_devices`);

--
-- Indexes for table `histori`
--
ALTER TABLE `histori`
  ADD PRIMARY KEY (`id_histori`);

--
-- Indexes for table `kampus`
--
ALTER TABLE `kampus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rfid`
--
ALTER TABLE `rfid`
  ADD PRIMARY KEY (`id_rfid`),
  ADD KEY `id_kampus` (`id_kampus`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `histori`
--
ALTER TABLE `histori`
  MODIFY `id_histori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `kampus`
--
ALTER TABLE `kampus`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rfid`
--
ALTER TABLE `rfid`
  MODIFY `id_rfid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
