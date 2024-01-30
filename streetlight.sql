-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 03, 2022 at 06:31 PM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `streetlight`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_desa`
--

CREATE TABLE `tb_desa` (
  `id_desa` int(11) NOT NULL,
  `kecamatan_id` int(11) NOT NULL,
  `kodeID` varchar(10) NOT NULL,
  `nama_desa` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_desa`
--

INSERT INTO `tb_desa` (`id_desa`, `kecamatan_id`, `kodeID`, `nama_desa`, `created_at`, `updated_at`) VALUES
(16, 1, '01001', 'Bente', '2022-10-01 20:10:11', '2022-10-02 07:11:21'),
(17, 1, '01002', 'Bahomohoni', '2022-09-27 22:09:29', '2022-09-27 22:09:29'),
(19, 1, '01003', 'Ipi', '2022-09-29 21:09:30', '2022-09-29 21:09:30');

-- --------------------------------------------------------

--
-- Table structure for table `tb_idpel`
--

CREATE TABLE `tb_idpel` (
  `id_idpel` int(11) NOT NULL,
  `kodeID` varchar(10) NOT NULL,
  `idpel` varchar(100) NOT NULL,
  `idpelname` varchar(100) NOT NULL,
  `tarif` varchar(100) NOT NULL,
  `daya` varchar(100) NOT NULL,
  `kogol` varchar(100) NOT NULL,
  `id_desa` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_idpel`
--

INSERT INTO `tb_idpel` (`id_idpel`, `kodeID`, `idpel`, `idpelname`, `tarif`, `daya`, `kogol`, `id_desa`, `created_at`, `updated_at`) VALUES
(1, '001', '31211006520545', 'PJU P01 BAHOMOHONI', 'P1', '4500', '1', 17, '2022-09-28 18:22:24', '2022-10-01 21:10:19'),
(2, '002', '3121100652052', 'PJU  PO02 BENTE', 'P3', '4400', '3', 16, '2022-09-28 18:22:27', '2022-10-02 08:19:02'),
(3, '003', '3121100652053', 'PJU PO02 IPI', 'P3', '4400', '3', 19, '2022-09-28 19:35:46', '2022-10-02 08:19:08'),
(4, '004', '3121100652054', 'PJU PO01 IPI', 'P1', '4400', '3', 19, '2022-09-28 19:40:13', '2022-10-02 08:19:11');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kecamatan`
--

CREATE TABLE `tb_kecamatan` (
  `id_kecamatan` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `nama_kecamatan` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kecamatan`
--

INSERT INTO `tb_kecamatan` (`id_kecamatan`, `kode`, `nama_kecamatan`, `created_at`, `updated_at`) VALUES
(1, '01', 'Bungku Tengah', '2022-09-27 03:09:52', '2022-10-01 19:10:40'),
(2, '02', 'Bungku Timur', '2022-09-27 03:09:56', NULL),
(3, '03', 'Bungku Barat', '2022-09-27 03:10:39', NULL),
(4, '04', 'Bungku Selatan', '2022-09-27 03:10:39', NULL),
(5, '05', 'Bungku Pesisir', '2022-09-27 03:11:25', NULL),
(6, '06', 'Bumi Raya', '2022-09-27 03:11:25', NULL),
(7, '07', 'Bahodopi', '2022-09-27 03:12:29', NULL),
(8, '08', 'Witaponda', '2022-09-27 03:12:29', NULL),
(9, '09', 'Menui Kepulauan', '2022-09-27 03:13:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_lampu`
--

CREATE TABLE `tb_lampu` (
  `id_lampu` int(11) NOT NULL,
  `kodeID` varchar(50) NOT NULL,
  `kecamatan_id` int(11) NOT NULL,
  `desa_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `merk_id` int(11) NOT NULL,
  `daya` varchar(50) NOT NULL,
  `idpel_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_lampu`
--

INSERT INTO `tb_lampu` (`id_lampu`, `kodeID`, `kecamatan_id`, `desa_id`, `type_id`, `merk_id`, `daya`, `idpel_id`, `created_at`, `updated_at`) VALUES
(8, '01002001001', 1, 17, 2, 2, '2000', 1, '2022-10-01 18:10:05', NULL),
(9, '01002001002', 1, 17, 2, 4, '1222', 1, '2022-10-01 18:10:06', NULL),
(12, '01003003001', 1, 19, 2, 4, '212122', 3, '2022-10-01 18:10:07', '2022-10-01 22:10:06'),
(13, '01001002001', 1, 16, 2, 2, '1111', 2, '2022-10-01 20:10:15', NULL),
(14, '01002001003', 1, 17, 2, 2, '1111', 1, '2022-10-01 21:10:46', NULL),
(15, '01003003001', 1, 19, 2, 4, '11121', 3, '2022-10-01 21:10:46', '2022-10-01 22:10:06'),
(16, '01001002002', 1, 16, 2, 4, '22', 2, '2022-10-01 21:10:47', NULL),
(17, '01001002003', 1, 16, 3, 4, '222', 2, '2022-10-01 21:10:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_merk`
--

CREATE TABLE `tb_merk` (
  `id_merk` int(11) NOT NULL,
  `merk` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_merk`
--

INSERT INTO `tb_merk` (`id_merk`, `merk`, `created_at`, `updated_at`) VALUES
(2, 'Panasonic', '2022-09-25 10:44:38', '2022-09-25 02:09:44'),
(4, 'Lg', '2022-09-23 01:09:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_tagihan`
--

CREATE TABLE `tb_tagihan` (
  `id` int(11) NOT NULL,
  `jenis` int(11) NOT NULL,
  `bulan` varchar(50) NOT NULL,
  `tahun` varchar(50) NOT NULL,
  `idpanel` int(11) DEFAULT NULL,
  `daya_awal` int(11) DEFAULT NULL,
  `daya_akhir` int(11) DEFAULT NULL,
  `total_daya` int(11) DEFAULT NULL,
  `jam_nyala` int(11) DEFAULT NULL,
  `realisasi_pln` int(20) DEFAULT NULL,
  `tarif_kwh` int(11) DEFAULT NULL,
  `tagihan` int(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_tagihan`
--

INSERT INTO `tb_tagihan` (`id`, `jenis`, `bulan`, `tahun`, `idpanel`, `daya_awal`, `daya_akhir`, `total_daya`, `jam_nyala`, `realisasi_pln`, `tarif_kwh`, `tagihan`, `created_at`, `updated_at`) VALUES
(1, 1, 'September', '2022', 1, NULL, NULL, 4333, 200, 30000000, 1700, 1473220, '2022-10-02 15:33:22', NULL),
(2, 2, 'Februari', '2022', 1, 2000, 4000, NULL, NULL, NULL, 1700, 3400000, '2022-10-02 16:37:54', NULL),
(3, 2, 'Maret', '2022', 3, 200, 400, NULL, NULL, NULL, 1700, 340000, '2022-10-03 17:25:45', NULL),
(4, 1, 'Oktober', '2022', 3, NULL, NULL, 223243, 532, 3000000, 1800, 213777497, '2022-10-03 18:21:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_tarif`
--

CREATE TABLE `tb_tarif` (
  `id_tarif` int(11) NOT NULL,
  `tarif` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_tarif`
--

INSERT INTO `tb_tarif` (`id_tarif`, `tarif`, `created_at`, `updated_at`) VALUES
(2, '1700', '2022-09-25 03:09:27', NULL),
(5, '1800', '2022-10-01 23:10:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_type`
--

CREATE TABLE `tb_type` (
  `id_type` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_type`
--

INSERT INTO `tb_type` (`id_type`, `type`, `created_at`, `updated_at`) VALUES
(2, 'LED', '2022-09-25 02:09:54', NULL),
(3, 'Mercury', '2022-09-25 02:09:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `icon` text COLLATE utf8mb4_unicode_ci,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `level`, `deskripsi`, `icon`, `password`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin', '1', NULL, NULL, '$2a$12$Y8AxmUlBofim1F68PPT5euJRVph1V/hGNdGZBvZOmD5UcaysR6Zsi', NULL, NULL, '2022-09-30 15:55:43', '2022-09-30 16:24:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_desa`
--
ALTER TABLE `tb_desa`
  ADD PRIMARY KEY (`id_desa`),
  ADD KEY `kecamatan_id` (`kecamatan_id`);

--
-- Indexes for table `tb_idpel`
--
ALTER TABLE `tb_idpel`
  ADD PRIMARY KEY (`id_idpel`);

--
-- Indexes for table `tb_kecamatan`
--
ALTER TABLE `tb_kecamatan`
  ADD PRIMARY KEY (`id_kecamatan`);

--
-- Indexes for table `tb_lampu`
--
ALTER TABLE `tb_lampu`
  ADD PRIMARY KEY (`id_lampu`),
  ADD KEY `kecamatan_id` (`kecamatan_id`),
  ADD KEY `desa_id` (`desa_id`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `merek_id` (`merk_id`),
  ADD KEY `idpel_id` (`idpel_id`);

--
-- Indexes for table `tb_merk`
--
ALTER TABLE `tb_merk`
  ADD PRIMARY KEY (`id_merk`);

--
-- Indexes for table `tb_tagihan`
--
ALTER TABLE `tb_tagihan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_tarif`
--
ALTER TABLE `tb_tarif`
  ADD PRIMARY KEY (`id_tarif`);

--
-- Indexes for table `tb_type`
--
ALTER TABLE `tb_type`
  ADD PRIMARY KEY (`id_type`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_desa`
--
ALTER TABLE `tb_desa`
  MODIFY `id_desa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tb_idpel`
--
ALTER TABLE `tb_idpel`
  MODIFY `id_idpel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_kecamatan`
--
ALTER TABLE `tb_kecamatan`
  MODIFY `id_kecamatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_lampu`
--
ALTER TABLE `tb_lampu`
  MODIFY `id_lampu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tb_merk`
--
ALTER TABLE `tb_merk`
  MODIFY `id_merk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_tagihan`
--
ALTER TABLE `tb_tagihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_tarif`
--
ALTER TABLE `tb_tarif`
  MODIFY `id_tarif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_type`
--
ALTER TABLE `tb_type`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_desa`
--
ALTER TABLE `tb_desa`
  ADD CONSTRAINT `tb_desa_ibfk_1` FOREIGN KEY (`kecamatan_id`) REFERENCES `tb_kecamatan` (`id_kecamatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_lampu`
--
ALTER TABLE `tb_lampu`
  ADD CONSTRAINT `tb_lampu_ibfk_1` FOREIGN KEY (`kecamatan_id`) REFERENCES `tb_kecamatan` (`id_kecamatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_lampu_ibfk_2` FOREIGN KEY (`desa_id`) REFERENCES `tb_desa` (`id_desa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_lampu_ibfk_3` FOREIGN KEY (`type_id`) REFERENCES `tb_type` (`id_type`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_lampu_ibfk_4` FOREIGN KEY (`merk_id`) REFERENCES `tb_merk` (`id_merk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_lampu_ibfk_5` FOREIGN KEY (`idpel_id`) REFERENCES `tb_idpel` (`id_idpel`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
