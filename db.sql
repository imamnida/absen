
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `absensi` (
  `id_absensi` int(11) NOT NULL,
  `id_devices` int(11) DEFAULT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `keterangan` varchar(20) NOT NULL,
  `foto` mediumtext NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `absensi` (`id_absensi`, `id_devices`, `id_siswa`, `keterangan`, `foto`, `created_at`) VALUES
(1, 1, 1190, 'masuk', '', 1722061231),
(2, 1, 1190, 'keluar', '', 1722061235),
(3, 3, 587, 'izin', '', 1722335009),
(4, 3, 589, 'sakit', '', 1722335017),


CREATE TABLE `devices` (
  `id_devices` int(11) NOT NULL,
  `nama_devices` varchar(100) NOT NULL,
  `mode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `devices` (`id_devices`, `nama_devices`, `mode`) VALUES
(1, 'Barcode', 'SCAN'),
(3, 'ADMIN', 'SCAN'),
(4, 'MESIN 1', 'SCAN'),
(5, 'MESIN 2', 'SCAN');



CREATE TABLE `histori` (
  `id_histori` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_devices` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `waktu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `histori` (`id_histori`, `id_siswa`, `id_devices`, `keterangan`, `waktu`) VALUES
(1, 1151, 2, 'masuk', 1718113116),
(2, 1150, 2, 'masuk', 1718113119),
(3, 1152, 2, 'masuk', 1718113123),



CREATE TABLE `kampus` (
  `id` int(11) NOT NULL,
  `kampus` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `kampus` (`id`, `kampus`) VALUES
(1, 'Kampus 1');


CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `kelas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `kelas` (`id`, `kelas`) VALUES
(37, '7.1'),
(38, '7.2'),
(39, '7.3'),
(40, '7.4'),


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
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `id_devices` int(11) NOT NULL,
  `nis` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uid` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `id_kampus` int(11) DEFAULT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telp` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ttl` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nisn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `id_devices`, `nis`, `uid`, `id_kelas`, `id_kampus`, `nama`, `telp`, `gender`, `alamat`, `foto`, `ttl`, `nisn`, `nik`) VALUES
(19, 2, 'NULL', 'e4-fa-ea-74', 41, 0, 'PUTRI NABILA', 'NULL', 'NULL', 'Desa Nagarakembang, Kec. Cingambul, Kab. Majalengka', 'Putri Nabila_1723631156.png', 'Majalengka, 25 Februari 2012', '121285082', '3210236502120001'),
(21, 2, 'NULL', '84-d6-b0-74', 41, 0, 'NAILA NURAENI', 'NULL', 'NULL', 'Desa nagarakembang kec.Cngambul kab.majalengka', '221.jpg', 'Majalengka,11 july 2011', '114514604', '3210235107110001'),
(22, 2, 'NULL', '54-ae-df-74', 41, 0, 'SINTI SINTIAWATI', 'NULL', 'NULL', 'Desa Sedaraja, kec. cingambul, kab. majalengka', '21.jpg', 'majalengka, 01 November 2011', '112500253', '3210234111110001'),
(24, 2, 'NULL', '34-87-e9-74', 41, 0, 'DERA RAUDATU RAHMAH', 'NULL', 'NULL', 'Desa Rawa, Kec. Cingambul, Kab. Majalengka', '25.jpg', 'Majalengka, 11 juni 2012', '128980349', '3210325106120001'),

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
  `keterangan` varchar(20) NOT NULL,
  `day` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `waktu_operasional`
--

INSERT INTO `waktu_operasional` (`id_waktu_operasional`, `waktu_operasional`, `keterangan`, `day`) VALUES
(1, '06:00-07:15', 'masuk', 'Monday'),
(2, '13:20-16:00', 'keluar', 'Monday'),
(3, '06:00-07:15', 'masuk', 'Tuesday'),
(4, '14:00-16:00', 'keluar', 'Tuesday'),
(5, '06:00-07:15', 'masuk', 'Wednesday'),
(6, '14:00-16:00', 'keluar', 'Wednesday'),
(7, '06:00-07:15', 'masuk', 'Thursday'),
(8, '14:00-16:00', 'keluar', 'Thursday'),
(9, '06:00-07:15', 'masuk', 'Friday'),
(10, '12:00-16:00', 'keluar', 'Friday'),
(11, '06:00-07:15', 'masuk', 'Saturday'),
(12, '13:00-16:00', 'keluar', 'Saturday'),
(13, '00:00-23:59', 'libur', 'Sunday');

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
(1, '', 'Asep Idris Saepudin, S.Ag.', '$2a$08$3WyRJUHBqEG.sQ4yYTLxqOAXyqApz5/4AMZ73kauVsah1QfyKe7yC', '196705091999031001', 8, 'logo.png'),
(2, '', 'Yeni Oktavia, S.Pd.', '$2a$08$3WyRJUHBqEG.sQ4yYTLxqOAXyqApz5/4AMZ73kauVsah1QfyKe7yC', '197810272007102001', 8, 'logo.png'),

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
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `waktu_operasional`
--
ALTER TABLE `waktu_operasional`
  ADD PRIMARY KEY (`id_waktu_operasional`);

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
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4605;

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `id_devices` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `histori`
--
ALTER TABLE `histori`
  MODIFY `id_histori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4800;

--
-- AUTO_INCREMENT for table `kampus`
--
ALTER TABLE `kampus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=499;

--
-- AUTO_INCREMENT for table `waktu_operasional`
--
ALTER TABLE `waktu_operasional`
  MODIFY `id_waktu_operasional` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `walikelas`
--
ALTER TABLE `walikelas`
  MODIFY `id_walikelas` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
