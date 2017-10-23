-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 11, 2017 at 08:29 
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vpay_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_bank_user`
--

CREATE TABLE `tb_bank_user` (
  `id_user` int(11) NOT NULL,
  `nama_bank` varchar(20) NOT NULL,
  `no_rekening` varchar(30) NOT NULL,
  `atas_nama` varchar(30) NOT NULL,
  `cabang` varchar(50) NOT NULL,
  `disabled` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_bank_user`
--

INSERT INTO `tb_bank_user` (`id_user`, `nama_bank`, `no_rekening`, `atas_nama`, `cabang`, `disabled`) VALUES
(1, 'BCA', '1234567890', 'Kristiawan Adi', 'BCA Sudirman Yogyakarta', 0),
(4, 'BRI', '123456789012345', 'Rino Ridlo Julianto', 'BRI Pusat Pacitan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_voucher`
--

CREATE TABLE `tb_kategori_voucher` (
  `id_kategori` char(4) NOT NULL,
  `nama_kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kategori_voucher`
--

INSERT INTO `tb_kategori_voucher` (`id_kategori`, `nama_kategori`) VALUES
('amzd', 'Amizade'),
('olsp', 'Online Shop'),
('rchi', 'Richie'),
('test', 'Kategori Tes Gan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_req_topup`
--

CREATE TABLE `tb_req_topup` (
  `id_topup` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `pengirim` varchar(30) NOT NULL,
  `jumlah_topup` bigint(20) NOT NULL,
  `rek_tujuan` varchar(20) NOT NULL,
  `bukti` text NOT NULL,
  `status` enum('pending','confirmed','refused') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_req_topup`
--

INSERT INTO `tb_req_topup` (`id_topup`, `id_user`, `pengirim`, `jumlah_topup`, `rek_tujuan`, `bukti`, `status`) VALUES
(1, 4, 'Rino Ridlo Julianto', 14000000, 'bca', 'flowchart_happy.jpg', 'pending'),
(2, 4, 'Rino Ridlo Julianto', 4000000, 'mandiri', 'photo_2017-04-01_15-05-00.jpg', 'confirmed'),
(3, 4, 'Rino Ridlo Julianto', 15000, 'bni', 'Desktop-download-abstract-minimalist-wallpaper-HD.png', 'refused'),
(4, 4, 'Rino Ridlo Julianto', 80000000, 'mandiri', '16804382_1405831446123257_7862860636941389787_o.jpg', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `tb_req_wd`
--

CREATE TABLE `tb_req_wd` (
  `id_wd` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jumlah_wd` bigint(20) NOT NULL,
  `status` enum('pending','confirmed','refused') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_req_wd`
--

INSERT INTO `tb_req_wd` (`id_wd`, `id_user`, `jumlah_wd`, `status`) VALUES
(1, 1, 1000000, 'refused'),
(2, 4, 400000, 'confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `no_hp` varchar(13) DEFAULT NULL,
  `deposit` bigint(13) DEFAULT NULL,
  `level` enum('member','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `nama`, `email`, `no_hp`, `deposit`, `level`) VALUES
(1, 'coba', '7c222fb2927d828af22f592134e8932480637c0d', 'Kristiawan Adi', 'lutvie72@gmail.com', '087636382', 15740000, 'member'),
(2, 'jajal', '2f619ec0ca2afc1cbfc18835c3365037e018ea4d', 'Yudha', 'yudhahumu@gmail.com', '081351723', 20000, 'member'),
(4, 'zurin', 'e428f9c6e4881b76046a25880c63fd50481c9a6b', 'Rino Ridlo Julianto', 'rinoridlojulianto@gmail.com', '087739211471', 3595000, 'member'),
(5, 'admin', 'f865b53623b121fd34ee5426c792e5c33af8c227', 'Admin Vpay', 'admin@vpay.com', NULL, NULL, 'admin'),
(6, 'istimewa', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'Bahtiyar Istimewa', 'istimewa@mail.com', '089762552123', 0, 'member'),
(8, 'awesome', 'd68c19a0a345b7eab78d5e11e991c026ec60db63', 'Bahtiyar Istimewa 2', 'istimewa@mail.com', '089762552123', 0, 'member');

-- --------------------------------------------------------

--
-- Table structure for table `tb_voucher`
--

CREATE TABLE `tb_voucher` (
  `kode_voucher` varchar(16) NOT NULL,
  `nominal` int(13) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_kategori` char(4) NOT NULL,
  `status` enum('valid','invalid') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_voucher`
--

INSERT INTO `tb_voucher` (`kode_voucher`, `nominal`, `id_user`, `id_kategori`, `status`) VALUES
('82JODMHp5l9TVumS', 900000, NULL, 'amzd', 'valid'),
('agTIqWDLMUXd2Ebm', 120000, NULL, 'olsp', 'valid'),
('awd982awd0218120', 1000, 4, 'rchi', 'invalid'),
('awd982awd0218124', 20000, NULL, 'olsp', 'valid'),
('h6uwagdha875gawd', 100000, 1, 'amzd', 'valid'),
('hawd729j40ls02ke', 5000, 1, 'amzd', 'valid'),
('hgh98712gh734hyd', 10000, 4, 'rchi', 'invalid'),
('JBEb32V0OjN9ymFG', 14000, NULL, 'rchi', 'valid'),
('M3RIAnSBwW2KN8Hl', 150000, 1, 'amzd', 'invalid'),
('yawgd834jowpo012', 50000, 4, 'olsp', 'valid');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_bank_user`
--
ALTER TABLE `tb_bank_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tb_kategori_voucher`
--
ALTER TABLE `tb_kategori_voucher`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tb_req_topup`
--
ALTER TABLE `tb_req_topup`
  ADD PRIMARY KEY (`id_topup`);

--
-- Indexes for table `tb_req_wd`
--
ALTER TABLE `tb_req_wd`
  ADD PRIMARY KEY (`id_wd`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tb_voucher`
--
ALTER TABLE `tb_voucher`
  ADD PRIMARY KEY (`kode_voucher`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_req_topup`
--
ALTER TABLE `tb_req_topup`
  MODIFY `id_topup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_req_wd`
--
ALTER TABLE `tb_req_wd`
  MODIFY `id_wd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
