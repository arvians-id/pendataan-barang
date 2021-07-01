-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2021 at 09:34 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_pendataan`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_barang`
--

CREATE TABLE `data_barang` (
  `id_brg` bigint(20) UNSIGNED NOT NULL,
  `kode_brg` varchar(20) NOT NULL,
  `nama` varchar(126) NOT NULL,
  `jenis` enum('makanan','minuman') NOT NULL,
  `id_satuan` bigint(20) UNSIGNED DEFAULT NULL,
  `total_stok` int(100) NOT NULL,
  `keterangan` varchar(256) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_barang`
--

INSERT INTO `data_barang` (`id_brg`, `kode_brg`, `nama`, `jenis`, `id_satuan`, `total_stok`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'BRG-20210702001', 'Tanggo', 'minuman', 5, 0, '', '2021-07-02 01:43:31', '2021-07-02 01:51:59');

-- --------------------------------------------------------

--
-- Table structure for table `data_barang_keluar`
--

CREATE TABLE `data_barang_keluar` (
  `id_brg_klr` bigint(20) UNSIGNED NOT NULL,
  `kode_brg_klr` varchar(20) NOT NULL,
  `kode_brg_msk` varchar(20) NOT NULL,
  `kode_brg` varchar(20) NOT NULL,
  `jml_keluar` bigint(100) NOT NULL,
  `tgl_keluar` datetime NOT NULL,
  `keterangan` varchar(256) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `data_barang_masuk`
--

CREATE TABLE `data_barang_masuk` (
  `id_brg_msk` bigint(20) UNSIGNED NOT NULL,
  `kode_brg_msk` varchar(20) NOT NULL,
  `kode_brg` varchar(20) NOT NULL,
  `kode_supp` varchar(20) NOT NULL,
  `jml_masuk` bigint(100) NOT NULL,
  `tgl_masuk` datetime NOT NULL,
  `keterangan` varchar(256) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `data_satuan`
--

CREATE TABLE `data_satuan` (
  `id_satuan` bigint(20) UNSIGNED NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_satuan`
--

INSERT INTO `data_satuan` (`id_satuan`, `satuan`, `created_at`, `updated_at`) VALUES
(4, 'unit', '2021-07-02 12:03:00', '2021-07-02 12:03:05'),
(5, 'kilo', '2021-07-02 12:04:07', '2021-07-02 12:04:16');

-- --------------------------------------------------------

--
-- Table structure for table `data_supplier`
--

CREATE TABLE `data_supplier` (
  `id_supp` bigint(20) UNSIGNED NOT NULL,
  `kode_supp` varchar(35) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `no_hp` varchar(20) NOT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_supplier`
--

INSERT INTO `data_supplier` (`id_supp`, `kode_supp`, `nama`, `email`, `no_hp`, `alamat`, `keterangan`, `created_at`, `updated_at`) VALUES
(2, 'SUPP-20210702001', 'widdy arfiansyah', 'widdyarfiansyah00@gmail.com', '082299921720', '', '', '2021-07-02 01:11:08', '2021-07-02 01:11:37');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(25) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `email` varchar(25) DEFAULT NULL,
  `no_hp` varchar(25) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `nama`, `username`, `password`, `email`, `no_hp`, `created_at`, `updated_at`) VALUES
(1, NULL, 'admin', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, '2021-07-01 17:14:27', '2021-07-01 17:14:27'),
(2, '', 'arfiiyd', 'd8578edf8458ce06fbc5bb76a58c5ca4', '', '', '2021-07-02 02:28:29', '2021-07-02 02:28:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_barang`
--
ALTER TABLE `data_barang`
  ADD PRIMARY KEY (`id_brg`),
  ADD UNIQUE KEY `kode_brg` (`kode_brg`),
  ADD KEY `id_satuan` (`id_satuan`);

--
-- Indexes for table `data_barang_keluar`
--
ALTER TABLE `data_barang_keluar`
  ADD PRIMARY KEY (`id_brg_klr`),
  ADD UNIQUE KEY `kode_brg_msk` (`kode_brg_msk`),
  ADD KEY `kode_brg` (`kode_brg`);

--
-- Indexes for table `data_barang_masuk`
--
ALTER TABLE `data_barang_masuk`
  ADD PRIMARY KEY (`id_brg_msk`),
  ADD UNIQUE KEY `kode_brg_msk` (`kode_brg_msk`),
  ADD UNIQUE KEY `kode_brg` (`kode_brg`),
  ADD KEY `data_barang_masuk_ibfk_4` (`kode_supp`);

--
-- Indexes for table `data_satuan`
--
ALTER TABLE `data_satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `data_supplier`
--
ALTER TABLE `data_supplier`
  ADD PRIMARY KEY (`id_supp`),
  ADD UNIQUE KEY `kode_supp` (`kode_supp`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_barang`
--
ALTER TABLE `data_barang`
  MODIFY `id_brg` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `data_barang_keluar`
--
ALTER TABLE `data_barang_keluar`
  MODIFY `id_brg_klr` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_barang_masuk`
--
ALTER TABLE `data_barang_masuk`
  MODIFY `id_brg_msk` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_satuan`
--
ALTER TABLE `data_satuan`
  MODIFY `id_satuan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `data_supplier`
--
ALTER TABLE `data_supplier`
  MODIFY `id_supp` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_barang`
--
ALTER TABLE `data_barang`
  ADD CONSTRAINT `data_barang_ibfk_1` FOREIGN KEY (`id_satuan`) REFERENCES `data_satuan` (`id_satuan`) ON UPDATE CASCADE;

--
-- Constraints for table `data_barang_keluar`
--
ALTER TABLE `data_barang_keluar`
  ADD CONSTRAINT `data_barang_keluar_ibfk_1` FOREIGN KEY (`kode_brg`) REFERENCES `data_barang` (`kode_brg`) ON UPDATE CASCADE,
  ADD CONSTRAINT `data_barang_keluar_ibfk_2` FOREIGN KEY (`kode_brg_msk`) REFERENCES `data_barang_masuk` (`kode_brg_msk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_barang_masuk`
--
ALTER TABLE `data_barang_masuk`
  ADD CONSTRAINT `data_barang_masuk_ibfk_3` FOREIGN KEY (`kode_brg`) REFERENCES `data_barang` (`kode_brg`) ON UPDATE CASCADE,
  ADD CONSTRAINT `data_barang_masuk_ibfk_4` FOREIGN KEY (`kode_supp`) REFERENCES `data_supplier` (`kode_supp`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
