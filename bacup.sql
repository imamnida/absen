-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 15, 2024 at 08:00 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bacup`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` int(11) NOT NULL,
  `id_devices` int(11) DEFAULT NULL,
  `id_rfid` int(11) DEFAULT NULL,
  `keterangan` varchar(20) NOT NULL,
  `foto` mediumtext NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id_absensi`, `id_devices`, `id_rfid`, `keterangan`, `foto`, `created_at`) VALUES
(1, 1, 1053, 'sakit', '', 1720191379);

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id_devices` int(11) NOT NULL,
  `nama_devices` varchar(100) NOT NULL,
  `mode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id_devices`, `nama_devices`, `mode`) VALUES
(1, 'Barcode', 'SCAN'),
(2, 'RFID READER', 'SCAN');

-- --------------------------------------------------------

--
-- Table structure for table `histori`
--

CREATE TABLE `histori` (
  `id_histori` int(11) NOT NULL,
  `id_rfid` int(11) NOT NULL,
  `id_devices` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `waktu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `histori`
--

INSERT INTO `histori` (`id_histori`, `id_rfid`, `id_devices`, `keterangan`, `waktu`) VALUES
(1, 1151, 2, 'masuk', 1718113116),
(2, 1150, 2, 'masuk', 1718113119),
(3, 1152, 2, 'masuk', 1718113123),
(4, 1192, 2, 'masuk', 1718113126),
(
-- --------------------------------------------------------

--
-- Table structure for table `kampus`
--

CREATE TABLE `kampus` (
  `id` int(11) NOT NULL,
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
  `id` int(11) NOT NULL,
  `kelas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `kelas`) VALUES
(1, '11 AK 1'),
(2, '11 AK 2'),
(3, '11 AK 3'),
(4, '11 BR 1'),
(5, '11 BR 2'),
(6, '11 OTOKR 1'),
(7, '11 OTOKR 2'),
(8, '11 OTOKR 3'),


-- --------------------------------------------------------

--
-- Table structure for table `rfid`
--

CREATE TABLE `rfid` (
  `id_rfid` int(11) NOT NULL,
  `id_devices` int(11) NOT NULL,
  `nis` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uid` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `id_kampus` int(11) DEFAULT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telp` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kaka` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rumah` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penyakit` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomerortu` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rfid`
--

INSERT INTO `rfid` (`id_rfid`, `id_devices`, `nis`, `uid`, `id_kelas`, `id_kampus`, `nama`, `telp`, `gender`, `jabatan`, `alamat`, `foto`, `kaka`, `rumah`, `penyakit`, `nomerortu`) VALUES
(1, 2, '23245419', '23245419', 1, 1, 'ZACHRA AULIA AZHAR', '', '', 'SISWA', 'indonesia', '', '', '', '', ''),
(2, 2, '23245418', '23245418', 1, 1, 'WULAN PURNAMASARI', '', '', 'SISWA', 'indonesia', '', '', '', '', ''),
(3, 2, '23245417', '23245417', 1, 1, 'SUCI RAHMADAN', '', '', 'SISWA', 'indonesia', '', '', '', '', ''),
(4, 2, '23245416', '23245416', 1, 1, 'SRI MULYANI', '', '', 'SISWA', 'indonesia', '', '', '', '', ''),
(5, 2, '23245415', '23245415', 1, 1, 'SITI ALVIANI', '', '', 'SISWA', 'indonesia', '', '', '', '', ''),
(6, 2, '23245414', '23245414', 1, 1, 'SINTA KIRANI', '', '', 'SISWA', 'indonesia', '', '', '', '', ''),
(7, 2, '23245413', '23245413', 1, 1, 'SHERLY SRI JUNIAWATI', '', '', 'SISWA', 'indonesia', '', '', '', '', ''),

-- --------------------------------------------------------

--
-- Table structure for table `secret_key`
--

CREATE TABLE `secret_key` (
  `id_key` int(11) NOT NULL,
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
  `id_user` int(11) NOT NULL,
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
  `id_waktu_operasional` int(11) NOT NULL,
  `waktu_operasional` varchar(20) NOT NULL,
  `keterangan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `waktu_operasional`
--

INSERT INTO `waktu_operasional` (`id_waktu_operasional`, `waktu_operasional`, `keterangan`) VALUES
(1, '20:00-21:00', 'masuk'),
(2, '22:00-23:00', 'keluar');

-- --------------------------------------------------------

--
-- Table structure for table `walikelas`
--

CREATE TABLE `walikelas` (
  `id_walikelas` int(3) NOT NULL,
  `no` text NOT NULL,
  `nama` varchar(225) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nuptk` varchar(255) NOT NULL,
  `kelas` int(3) NOT NULL,
  `avatar` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `walikelas`
--

INSERT INTO `walikelas` (`id_walikelas`, `no`, `nama`, `password`, `nuptk`, `kelas`, `avatar`) VALUES
(1, '', 'HAMALIKA', '$2y$10$hx4jHoGPsupyIHZLFOZFfuffKjZ3ztO37iGfP5BfRuqkP/n9mrTrW', '123456789', 12, 'logo.png');

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
  ADD PRIMARY KEY (`id_rfid`);

--
-- Indexes for table `walikelas`
--
ALTER TABLE `walikelas`
  ADD PRIMARY KEY (`id_walikelas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `histori`
--
ALTER TABLE `histori`
  MODIFY `id_histori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=265;

--
-- AUTO_INCREMENT for table `kampus`
--
ALTER TABLE `kampus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `rfid`
--
ALTER TABLE `rfid`
  MODIFY `id_rfid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1194;

--
-- AUTO_INCREMENT for table `walikelas`
--
ALTER TABLE `walikelas`
  MODIFY `id_walikelas` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
