-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 04, 2025 at 03:37 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_pencatatan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int NOT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `histori_pembayaran`
--

CREATE TABLE `histori_pembayaran` (
  `id_histori` int NOT NULL,
  `id_pembayaran` int NOT NULL,
  `nis` char(8) NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `jumlah_bayar` decimal(10,2) NOT NULL,
  `jenis_pembayaran` varchar(50) NOT NULL,
  `admin_pencatat` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `waktu_dibuat` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pembayaran`
--

CREATE TABLE `jenis_pembayaran` (
  `id_jenis` int NOT NULL,
  `nama_pembayaran` varchar(50) NOT NULL,
  `nominal` decimal(10,2) NOT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jenis_pembayaran`
--

INSERT INTO `jenis_pembayaran` (`id_jenis`, `nama_pembayaran`, `nominal`, `keterangan`) VALUES
(1, 'Spp syariah', '500000.00', 'Spp bulanan'),
(2, 'Kitab', '25000.00', NULL),
(3, 'Catering', '100000.00', NULL),
(4, 'Nishfusanah', '200000.00', NULL),
(5, 'Akhirusanah', '200000.00', NULL),
(10, 'a', '44.00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int NOT NULL,
  `nama_kelas` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`) VALUES
(1, '10 ');

-- --------------------------------------------------------

--
-- Table structure for table `log_pembayaran`
--

CREATE TABLE `log_pembayaran` (
  `id_log` int NOT NULL,
  `id_pembayaran` int NOT NULL,
  `id_admin` int NOT NULL,
  `tanggal_perubahan` timestamp NOT NULL,
  `keterangan` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1733926136),
('m130524_201442_init', 1733926182),
('m190124_110200_add_verification_token_column_to_user_table', 1733926182);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int NOT NULL,
  `id_tagihan` int NOT NULL,
  `id_tahun_ajaran` int NOT NULL,
  `tanggal_bayar` datetime NOT NULL,
  `jumlah_bayar` decimal(10,2) NOT NULL,
  `metode_pembayaran` enum('transfer','tunai') NOT NULL,
  `bukti_pembayaran` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `status` enum('Validasi','Lunas') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_tagihan`, `id_tahun_ajaran`, `tanggal_bayar`, `jumlah_bayar`, `metode_pembayaran`, `bukti_pembayaran`, `keterangan`, `status`) VALUES
(19, 1, 1, '2025-01-04 13:52:59', '500000.00', 'transfer', 'uploads/6778dacbc9c33.jpg', 'xczc', 'Lunas'),
(20, 15, 1, '2025-01-04 15:25:03', '200000.00', 'transfer', 'uploads/6778f05f66a3d.jpeg', 'lunas', 'Lunas'),
(21, 10, 1, '2025-01-04 21:59:02', '200000.00', 'tunai', 'tunai', 'tunai', 'Lunas');

-- --------------------------------------------------------

--
-- Table structure for table `santri`
--

CREATE TABLE `santri` (
  `nis` char(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_santri` varchar(250) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `id_kelas` int NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `tahun_angkatan` year NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `santri`
--

INSERT INTO `santri` (`nis`, `nama_santri`, `jenis_kelamin`, `tanggal_lahir`, `id_kelas`, `alamat`, `no_hp`, `tahun_angkatan`, `status`) VALUES
('42321001', 'Danita Hayu Syifa', 'Perempuan', '2002-12-12', 1, 'Pagojengan, Bumiayu', '083854671123', 2024, 'Aktif'),
('42321002', 'Sendi Apriansyah', 'Laki-laki', '2003-03-14', 1, 'Paguyangan, Bumiayu', '085609876114', 2024, 'Aktif'),
('42321003', 'Halizha Intan Safitri', 'Perempuan', '2002-05-14', 1, 'Langkap, Bumiayu', '082309178245', 2024, 'Aktif'),
('42321004', 'Robi Perdana', 'Laki-laki', '2000-12-02', 1, 'Ajibarang, Banyumas', '085807445912', 2024, 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tagihan`
--

CREATE TABLE `tagihan` (
  `id_tagihan` int NOT NULL,
  `nis` char(8) NOT NULL,
  `id_jenis` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `id_tahun_ajaran` int NOT NULL,
  `jumlah_tagihan` decimal(10,2) NOT NULL,
  `status_tagihan` enum('Lunas','Validasi','Belum Lunas') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tagihan`
--

INSERT INTO `tagihan` (`id_tagihan`, `nis`, `id_jenis`, `id_tahun_ajaran`, `jumlah_tagihan`, `status_tagihan`, `keterangan`) VALUES
(1, '42321001', '1', 1, '500000.00', 'Lunas', 'w'),
(10, '42321002', '4', 1, '200000.00', 'Lunas', 'ss'),
(12, '42321002', '4', 1, '200000.00', 'Belum Lunas', 'sss'),
(13, '42321002', '3', 1, '100000.00', 'Belum Lunas', 'aa'),
(14, '42321001', '1', 1, '500000.00', 'Belum Lunas', 'www'),
(15, '42321001', '4', 1, '200000.00', 'Lunas', 'adsadas');

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `id_tahun_ajaran` int NOT NULL,
  `tahun_ajaran` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`id_tahun_ajaran`, `tahun_ajaran`) VALUES
(1, '2024/2025');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` smallint NOT NULL DEFAULT '10',
  `role` enum('admin','santri') COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  `verification_token` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `role`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'admin1', '-1imyCCVZvWAxHPFvD3_mydFOYy_7Bua', '0192023a7bbd73250516f069df18b500', NULL, 'admin1@gmail.com', 10, 'admin', 1733926261, 1733926261, 'wdpj09zHReyacKTIXGWFlEchS6UyuaLx_1733926261'),
(2, '42321001', 'a42321001', '437ef692b75649ca863ceec3ac3cef82', '42321001a', '42321001@gmail.com', 10, 'santri', 2, 3, '42321001a');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `histori_pembayaran`
--
ALTER TABLE `histori_pembayaran`
  ADD PRIMARY KEY (`id_histori`);

--
-- Indexes for table `jenis_pembayaran`
--
ALTER TABLE `jenis_pembayaran`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `santri`
--
ALTER TABLE `santri`
  ADD PRIMARY KEY (`nis`);

--
-- Indexes for table `tagihan`
--
ALTER TABLE `tagihan`
  ADD PRIMARY KEY (`id_tagihan`);

--
-- Indexes for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`id_tahun_ajaran`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `histori_pembayaran`
--
ALTER TABLE `histori_pembayaran`
  MODIFY `id_histori` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tagihan`
--
ALTER TABLE `tagihan`
  MODIFY `id_tagihan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
