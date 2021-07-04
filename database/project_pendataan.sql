-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2021 at 05:21 PM
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
  `jenis` enum('Makanan','Minuman') NOT NULL,
  `id_satuan` bigint(20) UNSIGNED DEFAULT NULL,
  `total_stok` int(100) NOT NULL,
  `keterangan` varchar(256) DEFAULT NULL,
  `photo` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_barang`
--

INSERT INTO `data_barang` (`id_brg`, `kode_brg`, `nama`, `jenis`, `id_satuan`, `total_stok`, `keterangan`, `photo`, `created_at`, `updated_at`) VALUES
(1, 'BRG-2021001', 'Waffer Roma', 'Makanan', 1, 0, 'Gada', '7.jpg', '2021-07-04 06:51:56', '2021-07-04 07:21:31'),
(2, 'BRG-2021002', 'Ultramilk', 'Minuman', 1, 0, '', 'd4.jpg', '2021-07-04 06:57:05', '2021-07-04 06:59:10'),
(3, 'BRG-2021003', 'Tanggo', 'Makanan', 1, 0, '', 'default.png', '2021-07-04 07:06:52', '2021-07-04 07:06:52');

-- --------------------------------------------------------

--
-- Table structure for table `data_barang_keluar`
--

CREATE TABLE `data_barang_keluar` (
  `id_brg_klr` bigint(20) UNSIGNED NOT NULL,
  `kode_brg_klr` varchar(20) NOT NULL,
  `kode_brg` varchar(20) NOT NULL,
  `kode_cus` varchar(35) NOT NULL,
  `jml_keluar` int(100) NOT NULL,
  `tgl_keluar` date NOT NULL,
  `keterangan` varchar(256) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_barang_keluar`
--

INSERT INTO `data_barang_keluar` (`id_brg_klr`, `kode_brg_klr`, `kode_brg`, `kode_cus`, `jml_keluar`, `tgl_keluar`, `keterangan`, `created_at`, `updated_at`) VALUES
(5, 'TRBK-2021001', 'BRG-2021001', 'CUS-2021001', 5, '2021-07-04', 'Gada', '2021-07-04 07:32:30', '2021-07-04 09:35:45');

-- --------------------------------------------------------

--
-- Table structure for table `data_barang_masuk`
--

CREATE TABLE `data_barang_masuk` (
  `id_brg_msk` bigint(20) UNSIGNED NOT NULL,
  `kode_brg_msk` varchar(20) NOT NULL,
  `kode_brg` varchar(20) NOT NULL,
  `kode_supp` varchar(20) NOT NULL,
  `jml_masuk` int(100) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `keterangan` varchar(256) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_barang_masuk`
--

INSERT INTO `data_barang_masuk` (`id_brg_msk`, `kode_brg_msk`, `kode_brg`, `kode_supp`, `jml_masuk`, `tgl_masuk`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'TRBM-2021001', 'BRG-2021001', 'SUPP-2021001', 5, '2021-07-05', '', '2021-07-04 07:06:22', '2021-07-04 07:06:22');

-- --------------------------------------------------------

--
-- Table structure for table `data_customer`
--

CREATE TABLE `data_customer` (
  `id_cus` bigint(20) UNSIGNED NOT NULL,
  `kode_cus` varchar(35) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `no_hp` varchar(20) NOT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_customer`
--

INSERT INTO `data_customer` (`id_cus`, `kode_cus`, `nama`, `email`, `no_hp`, `alamat`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'CUS-2021001', 'Siti', '', '082299921720', '', '', '2021-07-04 06:51:33', '2021-07-04 06:51:33');

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
(1, 'Unit', '2021-07-04 06:50:58', '2021-07-04 06:50:58');

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
(1, 'SUPP-2021001', 'Jono', 'jono24@gmail.com', '082299921720', '', '', '2021-07-04 06:51:21', '2021-07-04 06:51:21');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '2021-07-01 17:14:27', '2021-07-01 17:14:27'),
(3, 'arfivory', 'e10adc3949ba59abbe56e057f20f883e', '2021-07-04 10:13:36', '2021-07-04 10:13:36');

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
  ADD UNIQUE KEY `kode_brg_klr` (`kode_brg_klr`),
  ADD KEY `kode_brg` (`kode_brg`),
  ADD KEY `kode_cus` (`kode_cus`) USING BTREE;

--
-- Indexes for table `data_barang_masuk`
--
ALTER TABLE `data_barang_masuk`
  ADD PRIMARY KEY (`id_brg_msk`),
  ADD UNIQUE KEY `kode_brg_msk` (`kode_brg_msk`),
  ADD KEY `data_barang_masuk_ibfk_4` (`kode_supp`),
  ADD KEY `kode_brg` (`kode_brg`) USING BTREE;

--
-- Indexes for table `data_customer`
--
ALTER TABLE `data_customer`
  ADD PRIMARY KEY (`id_cus`),
  ADD UNIQUE KEY `kode_cus` (`kode_cus`);

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
  MODIFY `id_brg` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `data_barang_keluar`
--
ALTER TABLE `data_barang_keluar`
  MODIFY `id_brg_klr` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `data_barang_masuk`
--
ALTER TABLE `data_barang_masuk`
  MODIFY `id_brg_msk` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `data_customer`
--
ALTER TABLE `data_customer`
  MODIFY `id_cus` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `data_satuan`
--
ALTER TABLE `data_satuan`
  MODIFY `id_satuan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `data_supplier`
--
ALTER TABLE `data_supplier`
  MODIFY `id_supp` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  ADD CONSTRAINT `data_barang_keluar_ibfk_2` FOREIGN KEY (`kode_cus`) REFERENCES `data_customer` (`kode_cus`);

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
