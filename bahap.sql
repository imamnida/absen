-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 05, 2024 at 05:12 PM
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
-- Database: `haha`
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
(18, '12 AKL 2'),
(19, '12 AKL 3'),
(20, '12 AKL 4'),
(26, '12 OTO TKR 1'),
(27, '12 OTO TKR 2'),
(28, '12 OTO TKR 3'),
(29, '12 OTO TKR 4'),
(30, '12 PPLG 1'),
(31, '12 PPLG 2'),
(32, '12 TJKT 1'),
(33, '12 TJKT 2'),
(34, '12 TJKT 3'),
(35, '12 TJKT 4'),
(36, 'KELAS PERCOBAAN');

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
(1, 2, 'ANGGA RIANA 22233297', 'b3-ad-bd-07', 36, 1, 'ANGGA RIANA', '85863922665', 'L', 'SISWA', 'Blok Pendetan Rt 06/Rw 05 Ds.Sangiang Kec.Banjaran Kab.Majalengka', 'https://drive.google.com/thumbnail?id=1aoKQVy-tMEA0eAD9wzxxvFQAd4HC0wsZ', 'https://drive.google.com/thumbnail?id=1TLsdlJ44QYHogNHbpEctSW65RlZbyTl8', 'https://drive.google.com/thumbnail?id=1tLLLkCXvKsqut4x-2WR6kzKszqnKAC5Y', 'Tidak Ada', '85863922665'),
(2, 2, 'ARIS SUPRIANTO 22233298', '53-2e-d8-07', 36, 1, 'ARIS SUPRIANTO', '81214786646', 'L', 'SISWA', 'Banjaran Hilir  Rt2/Rw4 Desa Banjaran  Kecamatan Banjaran  Kabupaten Majalengka', 'https://drive.google.com/thumbnail?id=1L3JtgYHbF8sV4yvPkbFy19ZC0IW70Pax', 'https://drive.google.com/thumbnail?id=1vGPyn4QDxJ_u14zaHxzNvHe6xdx1HT8z', 'https://drive.google.com/thumbnail?id=1EtM1NZf4q8s5SDVCFsbS26qQRqF02JWP', 'Tidak Ada', '89563700000000000'),
(3, 2, 'AURA SALSABILAH RIDWAN 22233299', '83-10-1b-fe', 36, 1, 'AURA SALSABILAH RIDWAN', '85878034103', 'P', 'SISWA', 'Blok.Saptu Rt/Rw 002/005  Desa Sindang  Kecamatan Cikijing  Kabupaten Majalengka', 'https://drive.google.com/thumbnail?id=1Fssq7Bb3s7mbd40k4p-YiHboCoTQO52Y', 'https://drive.google.com/thumbnail?id=1bB8NjbxJJsPC1uOyrpgBIiTGQkJg-xD-', 'https://drive.google.com/thumbnail?id=1OpgCr9RqRyxrvWYo0Flmd5niNpzzW_Kd', 'Maagh Atau Asam Lambung', '85809050118'),
(4, 2, 'DEA PUSPITA 22233300', '03-c6-da-07', 36, 1, 'DEA PUSPITA', '83848917963', 'P', 'SISWA', 'Sukamulya Lapang 01/01 Banjaransari Cikijing Majalengka', 'https://drive.google.com/thumbnail?id=1UZ2aSnxHqPzILQ2KSMkEltzkaSl1VBdH', 'https://drive.google.com/thumbnail?id=1igDiw9U7OJbZkATsHiXAiGOskmdQxToR', 'https://drive.google.com/thumbnail?id=1GbPsxVB77uEL9yDAjpcr0QWMGCfRIn1x', 'Tipes', '81546905358'),
(5, 2, '22233301', '53-16-d4-07', 36, 1, 'DIKI RAMADANI', '85723306426', 'L', 'SISWA', 'Blok Sukanagara Rt 001/002  Desa Silihwangi  Kec.Bantarujeg  Kab.Majalengka', 'https://drive.google.com/thumbnail?id=15ryXH40R4yk4YbpFiG0Xy93bexNnSlFM', 'https://drive.google.com/thumbnail?id=1hMS-F3F_W0vtVlS4_qvENn34tuQYC0Ar', 'https://drive.google.com/thumbnail?id=1O_FfrQLC8MDF5oqWjQc9utxbwr1BqT2M', 'Tidak Ada', '81546979316'),
(6, 2, 'DIYA AULIYA SHIDIQ 22233302', '93-9e-d6-07', 36, 1, 'DIYA AULIYA SHIDIQ', '85624616543', 'P', 'SISWA', 'Blok.Parentah Rt/011 Rw/003 Desa.Sukasari Kec.Cikijing Kab.Majalengka', 'https://drive.google.com/thumbnail?id=1sb5c2oC2Lt5iINB2MThgK0ODyAclRfaG', 'https://drive.google.com/thumbnail?id=1qsym4qVA2evr4KAFEzvDLT7SJm6uKwHh', 'https://drive.google.com/thumbnail?id=10BEm8ARDLHW23S2lqinabt4dbJHAu2rZ', 'Tidak Ada', '85722312592'),
(7, 2, '22233303', '93-21-32-0d', 36, 1, 'FACHRI AFRIANSYAH', '85879041042', 'L', 'SISWA', 'Blok.Sukaresmi Rt02/Rw01', 'https://drive.google.com/thumbnail?id=1cF9GHOurI1G-AafylyguXOFrPvC7sq4x', 'https://drive.google.com/thumbnail?id=1DuzUV4z9LVVVKMckXRpRU_GNoO7H80GX', 'https://drive.google.com/thumbnail?id=1-pvE3dAuvNbJPhxO0lipNvGGbCauUOaJ', 'Tidak Ada', '85872564424');

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
  `no` int(3) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nuptk` varchar(255) NOT NULL,
  `kelas` int(3) NOT NULL,
  `avatar` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `walikelas`
--

INSERT INTO `walikelas` (`no`, `nama`, `password`, `nuptk`, `kelas`, `avatar`) VALUES
(1, 'HAMALIKA', '$2y$10$hx4jHoGPsupyIHZLFOZFfuffKjZ3ztO37iGfP5BfRuqkP/n9mrTrW', '123456789', 12, 'logo.png');

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
  ADD PRIMARY KEY (`no`);

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
  MODIFY `id_histori` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id_rfid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `walikelas`
--
ALTER TABLE `walikelas`
  MODIFY `no` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
