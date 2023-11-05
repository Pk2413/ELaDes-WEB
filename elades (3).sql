-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2023 at 12:14 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elades`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun_admin`
--

CREATE TABLE `akun_admin` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `kode_otp` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akun_admin`
--

INSERT INTO `akun_admin` (`username`, `password`, `email`, `kode_otp`) VALUES
('admin', 'admin', 'ananda.aa70@gmail.com', 660454);

-- --------------------------------------------------------

--
-- Table structure for table `akun_user`
--

CREATE TABLE `akun_user` (
  `username` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `kode_otp` int(11) NOT NULL,
  `created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akun_user`
--

INSERT INTO `akun_user` (`username`, `password`, `email`, `nama`, `kode_otp`, `created`) VALUES
('coba', 'aaaa', 'email', 'coba', 184676, '2023-10-26'),
('coba1', 'bf0c95ff56e3b2598456cd455a8684', 'ananda.AA70@gmail.com', 'coba', 423509, '2023-11-01'),
('user', 'user', 'user@email.com', 'Prayoga kusdiana ikhsani ', 793119, '2023-10-26');

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(10) DEFAULT 'Proses'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`id`, `tanggal`, `status`) VALUES
(27, '2023-10-29', 'Selesai'),
(28, '2023-11-01', 'Proses'),
(29, '2023-11-01', 'Proses'),
(30, '2023-11-01', 'Selesai'),
(31, '2023-11-01', 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_surat`
--

CREATE TABLE `pengajuan_surat` (
  `id` int(11) NOT NULL,
  `kode_surat` varchar(100) NOT NULL,
  `nik` int(20) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `nama` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `no_pengajuan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengajuan_surat`
--

INSERT INTO `pengajuan_surat` (`id`, `kode_surat`, `nik`, `tanggal`, `nama`, `username`, `no_pengajuan`) VALUES
(27, 'skck', 2147483647, '2023-10-29', 'Prayoga kusdiana ikhsani ', 'user', 28),
(28, 'skck', 0, '2023-11-01', '', 'user', 29),
(29, 'skck', 0, '2023-11-01', '', 'user', 30),
(30, 'skck', 123456, '2023-11-01', 'coba 1', 'user', 31),
(31, 'skck', 123456789, '2023-11-01', 'papapapaoapaoaoaoaoaooaoaaooaoaoaoala', 'user', 32);

--
-- Triggers `pengajuan_surat`
--
DELIMITER $$
CREATE TRIGGER `DEL_pengajuan_to_suratMasuk` AFTER DELETE ON `pengajuan_surat` FOR EACH ROW DELETE from surat_masuk 
where id = old.id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `DEL_to_Laporan` AFTER DELETE ON `pengajuan_surat` FOR EACH ROW DELETE FROM laporan where `id` =  old.id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `pengajuan_to_suratMasuk` AFTER INSERT ON `pengajuan_surat` FOR EACH ROW INSERT INTO surat_masuk(id,kode_surat) 
VALUES (new.id, new.kode_surat)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `to_laporan` AFTER INSERT ON `pengajuan_surat` FOR EACH ROW INSERT INTO laporan(`id`) VALUES (new.id)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `skck`
--

CREATE TABLE `skck` (
  `no_pengajuan` int(11) NOT NULL,
  `kode_surat` varchar(100) NOT NULL DEFAULT 'skck',
  `nama` varchar(100) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `tempat_tgl_lahir` varchar(100) NOT NULL,
  `kebangsaan` varchar(100) NOT NULL,
  `agama` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `status_perkawinan` varchar(100) NOT NULL,
  `pekerjaan` varchar(100) NOT NULL,
  `tempat_tinggal` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skck`
--

INSERT INTO `skck` (`no_pengajuan`, `kode_surat`, `nama`, `nik`, `tempat_tgl_lahir`, `kebangsaan`, `agama`, `jenis_kelamin`, `status_perkawinan`, `pekerjaan`, `tempat_tinggal`, `username`) VALUES
(25, 'skck', 'cona', '1923884', 'Nganjuk, 01 Oktober 2023', 'islma', 'amalak', 'Laki-Laki', 'kwjaj', 'ajaj', 'kaak', 'user'),
(26, 'skck', '2', '2', '2, ', '2', '2', '', '2', '2', '2', 'user'),
(27, 'skck', '2', '2', '2, ', '2', '2', '', '2', '2', '2', 'user'),
(28, 'skck', 'Prayoga kusdiana ikhsani ', '081357743268', 'Nganjuk , 01 Oktober 2023', 'WNI', 'islam', 'Laki-Laki', 'Belum Kawin', 'Mahasiswa ', 'Nganjuk', 'user'),
(29, 'skck', '', '', ', ', '', '', '', '', '', '', 'user'),
(30, 'skck', '', '', ', ', '', '', '', '', '', '', 'user'),
(31, 'skck', 'coba 1', '123456', 'nganjk, 05 November 2023', 'haia', 'akaka', 'Perempuan', 'auaia', 'uauaj', 'jajaj', 'user'),
(32, 'skck', 'papapapaoapaoaoaoaoaooaoaaooaoaoaoala', '123456789', 'nganjuk, 23 November 2023', 'nakaj', 'nakaj', 'Laki-Laki', 'ajajsjsh', 'ajaksja', 'ajajah', 'user');

--
-- Triggers `skck`
--
DELIMITER $$
CREATE TRIGGER `skck_to_pengajuanSurat` AFTER INSERT ON `skck` FOR EACH ROW INSERT INTO pengajuan_surat(kode_surat,nik, nama,no_pengajuan,username)
VALUES(new.kode_surat,new.nik,new.nama,new.no_pengajuan
       ,new.username)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `surat`
--

CREATE TABLE `surat` (
  `kode_surat` varchar(100) NOT NULL,
  `Keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat`
--

INSERT INTO `surat` (`kode_surat`, `Keterangan`) VALUES
('coba', 'coba'),
('skck', 'SURAT KETERANGAN ADAT ISTIADAT'),
('surat_ijin', 'SURAT KETERANGAN  IJIN TIDAK MASUK KERJA');

-- --------------------------------------------------------

--
-- Table structure for table `surat_ijin`
--

CREATE TABLE `surat_ijin` (
  `username` varchar(20) NOT NULL,
  `no_pengajuan` int(11) NOT NULL,
  `kode_surat` varchar(100) NOT NULL DEFAULT 'surat_ijin',
  `Nama` varchar(100) NOT NULL,
  `NIK` varchar(30) NOT NULL,
  `Jenis_kelamin` varchar(20) NOT NULL,
  `Tempat_tanggal_lahir` varchar(30) NOT NULL,
  `Kewarganegaraan` varchar(50) NOT NULL,
  `Agama` varchar(20) NOT NULL,
  `Pekerjaan` varchar(40) NOT NULL,
  `Alamat` varchar(100) NOT NULL,
  `Tempat_Kerja` varchar(100) NOT NULL,
  `Bagian` varchar(100) NOT NULL,
  `Tanggal` date NOT NULL,
  `Alasan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_ijin`
--

INSERT INTO `surat_ijin` (`username`, `no_pengajuan`, `kode_surat`, `Nama`, `NIK`, `Jenis_kelamin`, `Tempat_tanggal_lahir`, `Kewarganegaraan`, `Agama`, `Pekerjaan`, `Alamat`, `Tempat_Kerja`, `Bagian`, `Tanggal`, `Alasan`) VALUES
('user', 3, 'surat_ijin', '[value-4]', '[value-5]', '[value-6]', '[value-7]', '[value-8]', '[value-9]', '[value-10]', '[value-11]', '[value-12]', '[value-13]', '0000-00-00', '[value-15]'),
('user', 4, 'surat_ijin', '[value-3]', '[value-5]', '[value-6]', '[value-7]', '[value-8]', '[value-9]', '[value-10]', '[value-11]', '[value-12]', '[value-13]', '0000-00-00', '[value-15]');

--
-- Triggers `surat_ijin`
--
DELIMITER $$
CREATE TRIGGER `ijin_to_suratmasuk` AFTER INSERT ON `surat_ijin` FOR EACH ROW INSERT INTO pengajuan_surat(kode_surat,nik, nama,no_pengajuan,username)
VALUES(new.kode_surat,new.nik,new.nama,new.no_pengajuan
       ,new.username)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `id` int(11) NOT NULL,
  `kode_surat` varchar(100) NOT NULL,
  `tangal` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_masuk`
--

INSERT INTO `surat_masuk` (`id`, `kode_surat`, `tangal`) VALUES
(27, 'skck', '2023-10-29'),
(28, 'skck', '2023-11-01'),
(29, 'skck', '2023-11-01'),
(30, 'skck', '2023-11-01'),
(31, 'skck', '2023-11-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun_admin`
--
ALTER TABLE `akun_admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `akun_user`
--
ALTER TABLE `akun_user`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD UNIQUE KEY `id` (`id`) USING BTREE;

--
-- Indexes for table `pengajuan_surat`
--
ALTER TABLE `pengajuan_surat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_surat` (`kode_surat`,`nik`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `skck`
--
ALTER TABLE `skck`
  ADD PRIMARY KEY (`no_pengajuan`),
  ADD KEY `kode_surat` (`kode_surat`,`nik`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`kode_surat`) USING BTREE;

--
-- Indexes for table `surat_ijin`
--
ALTER TABLE `surat_ijin`
  ADD PRIMARY KEY (`no_pengajuan`),
  ADD KEY `username` (`username`),
  ADD KEY `kode_surat` (`kode_surat`);

--
-- Indexes for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `kd_surat` (`kode_surat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pengajuan_surat`
--
ALTER TABLE `pengajuan_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `skck`
--
ALTER TABLE `skck`
  MODIFY `no_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `surat_ijin`
--
ALTER TABLE `surat_ijin`
  MODIFY `no_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `laporan_ibfk_1` FOREIGN KEY (`id`) REFERENCES `pengajuan_surat` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengajuan_surat`
--
ALTER TABLE `pengajuan_surat`
  ADD CONSTRAINT `pengajuan_surat_ibfk_1` FOREIGN KEY (`kode_surat`) REFERENCES `surat` (`kode_surat`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pengajuan_surat_ibfk_2` FOREIGN KEY (`username`) REFERENCES `akun_user` (`username`) ON DELETE NO ACTION;

--
-- Constraints for table `skck`
--
ALTER TABLE `skck`
  ADD CONSTRAINT `skck_ibfk_1` FOREIGN KEY (`kode_surat`) REFERENCES `surat` (`kode_surat`),
  ADD CONSTRAINT `skck_ibfk_2` FOREIGN KEY (`username`) REFERENCES `akun_user` (`username`);

--
-- Constraints for table `surat_ijin`
--
ALTER TABLE `surat_ijin`
  ADD CONSTRAINT `surat_ijin_ibfk_1` FOREIGN KEY (`kode_surat`) REFERENCES `surat` (`kode_surat`),
  ADD CONSTRAINT `surat_ijin_ibfk_2` FOREIGN KEY (`username`) REFERENCES `akun_user` (`username`);

--
-- Constraints for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD CONSTRAINT `surat_masuk_ibfk_1` FOREIGN KEY (`id`) REFERENCES `pengajuan_surat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
