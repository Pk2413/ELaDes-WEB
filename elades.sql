-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Nov 2023 pada 07.31
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

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
-- Struktur dari tabel `akun_admin`
--

CREATE TABLE `akun_admin` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `kode_otp` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `akun_admin`
--

INSERT INTO `akun_admin` (`username`, `password`, `email`, `kode_otp`) VALUES
('admin', 'admin', 'ananda.aa70@gmail.com', 660454);

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun_user`
--

CREATE TABLE `akun_user` (
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `kode_otp` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `akun_user`
--

INSERT INTO `akun_user` (`username`, `password`, `email`, `nama`, `kode_otp`, `created`) VALUES
('aripin ', 'b41d59fbf6820910aa4d80e3657b9cd7', 'prayoga.kusdiana12@gmail.com', 'aripin', 313739, '2023-11-09 09:43:48'),
('nyoba', '81793dfa61181895c741ecd64f752bf9', 'ikhsaniprayoga@gmail.com', 'nyoba dulu', 847444, '2023-11-08 09:05:41'),
('Rima ', '', 'rimasazkya@gmail.com', 'Rima14', 549783, '2023-11-09 08:59:53'),
('user', 'ee11cbb19052e40b07aac0ca060c23ee', 'ananda.aa70@gmail.com', 'Prayoga kusdiana ikhsani ', 155473, '2023-10-26 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan`
--

CREATE TABLE `laporan` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(10) DEFAULT 'Proses'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `laporan`
--

INSERT INTO `laporan` (`id`, `tanggal`, `status`) VALUES
(27, '2023-10-29', 'Selesai'),
(28, '2023-11-01', 'Selesai'),
(29, '2023-11-01', 'Selesai'),
(30, '2023-11-01', 'Selesai'),
(31, '2023-11-01', 'Proses'),
(37, '2023-11-08', 'Proses'),
(38, '2023-11-08', 'Proses'),
(39, '2023-11-08', 'Proses'),
(42, '2023-11-09', 'Proses'),
(50, '2023-11-09', 'Proses'),
(51, '2023-11-09', 'Proses'),
(53, '2023-11-09', 'Proses'),
(54, '2023-11-09', 'Proses'),
(55, '2023-11-10', 'Proses');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan_surat`
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
-- Dumping data untuk tabel `pengajuan_surat`
--

INSERT INTO `pengajuan_surat` (`id`, `kode_surat`, `nik`, `tanggal`, `nama`, `username`, `no_pengajuan`) VALUES
(27, 'skck', 2147483647, '2023-10-29', 'Prayoga kusdiana ikhsani ', 'user', 28),
(28, 'skck', 0, '2023-11-01', '', 'user', 29),
(29, 'skck', 0, '2023-11-01', '', 'user', 30),
(30, 'skck', 123456, '2023-11-01', 'coba 1', 'user', 31),
(31, 'skck', 123456789, '2023-11-01', 'papapapaoapaoaoaoaoaooaoaaooaoaoaoala', 'user', 32),
(37, 'skck', 0, '2023-11-08', '', 'user', 33),
(38, 'skck', 123456789, '2023-11-08', 'coba', 'user', 34),
(39, 'skck', 2147483647, '2023-11-08', 'wahyu', 'user', 35),
(42, 'surat_ijin', 0, '2023-11-09', '$Nama', 'user', 55),
(50, 'skck', 9434188, '2023-11-09', 'whwuwv2', 'user', 36),
(51, 'surat_ijin', 0, '2023-11-09', '', 'user', 65),
(53, 'surat_ijin', 123456789, '2023-11-09', 'a', 'nyoba', 67),
(54, 'sktm', 0, '2023-11-09', '[value-10]', 'user', 3),
(55, 'sktm', 0, '2023-11-10', 'w lneohw', 'user', 4);

--
-- Trigger `pengajuan_surat`
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
-- Struktur dari tabel `skck`
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
-- Dumping data untuk tabel `skck`
--

INSERT INTO `skck` (`no_pengajuan`, `kode_surat`, `nama`, `nik`, `tempat_tgl_lahir`, `kebangsaan`, `agama`, `jenis_kelamin`, `status_perkawinan`, `pekerjaan`, `tempat_tinggal`, `username`) VALUES
(25, 'skck', 'cona', '1923884', 'Nganjuk, 01 Oktober 2023', 'islma', 'amalak', 'Laki-Laki', 'kwjaj', 'ajaj', 'kaak', 'user'),
(26, 'skck', '2', '2', '2, ', '2', '2', '', '2', '2', '2', 'user'),
(27, 'skck', '2', '2', '2, ', '2', '2', '', '2', '2', '2', 'user'),
(28, 'skck', 'Prayoga kusdiana ikhsani ', '081357743268', 'Nganjuk , 01 Oktober 2023', 'WNI', 'islam', 'Laki-Laki', 'Belum Kawin', 'Mahasiswa ', 'Nganjuk', 'user'),
(29, 'skck', '', '', ', ', '', '', '', '', '', '', 'user'),
(30, 'skck', '', '', ', ', '', '', '', '', '', '', 'user'),
(31, 'skck', 'coba 1', '123456', 'nganjk, 05 November 2023', 'haia', 'akaka', 'Perempuan', 'auaia', 'uauaj', 'jajaj', 'user'),
(32, 'skck', 'papapapaoapaoaoaoaoaooaoaaooaoaoaoala', '123456789', 'nganjuk, 23 November 2023', 'nakaj', 'nakaj', 'Laki-Laki', 'ajajsjsh', 'ajaksja', 'ajajah', 'user'),
(33, 'skck', '', '', 'keisjwi, 21 November 2023', 'jwiw', 'jsiwjw', 'Perempuan', 'iwoakw', 'siwiwiw', 'iwiwiwnwi', 'user'),
(34, 'skck', 'coba', '123456789', 'maduin, 12 November 2023', 'naosu3', 'sisbw ', 'Perempuan', 'jsisbwv', 'sh Ih s', 'sjsjajsb', 'user'),
(35, 'skck', 'wahyu', '0856191979767679', 'Nganjuk, 10 November 2023', 'Indonesia', 'Islam', 'Laki-Laki', 'Belum kawin', 'mahasiswa', 'Nganjuk', 'user'),
(36, 'skck', 'whwuwv2', '9434188', 'wuwgwhw, 13 November 2023', 'wgaih', 'vhjvbj', 'Laki-Laki', 'bbjjbb', 'jbji', 'bjjjb', 'user');

--
-- Trigger `skck`
--
DELIMITER $$
CREATE TRIGGER `skck_to_pengajuanSurat` AFTER INSERT ON `skck` FOR EACH ROW INSERT INTO pengajuan_surat(kode_surat,nik, nama,no_pengajuan,username)
VALUES(new.kode_surat,new.nik,new.nama,new.no_pengajuan
       ,new.username)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sktm`
--

CREATE TABLE `sktm` (
  `no_pengajuan` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `kode_surat` varchar(20) DEFAULT 'sktm',
  `nama_bapak` varchar(50) DEFAULT NULL,
  `tempat_tanggal_lahir_bapak` varchar(50) DEFAULT NULL,
  `pekerjaan_bapak` varchar(50) DEFAULT NULL,
  `alamat_bapak` varchar(100) DEFAULT NULL,
  `nama_ibu` varchar(50) DEFAULT NULL,
  `tempat_tanggal_lahir_ibu` varchar(50) DEFAULT NULL,
  `pekerjaan_ibu` varchar(50) DEFAULT NULL,
  `alamat_ibu` varchar(100) DEFAULT NULL,
  `nama_anak` varchar(50) DEFAULT NULL,
  `tempat_tanggal_lahir_anak` varchar(50) DEFAULT NULL,
  `jenis_kelamin_anak` varchar(10) DEFAULT NULL,
  `alamat_anak` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sktm`
--

INSERT INTO `sktm` (`no_pengajuan`, `username`, `kode_surat`, `nama_bapak`, `tempat_tanggal_lahir_bapak`, `pekerjaan_bapak`, `alamat_bapak`, `nama_ibu`, `tempat_tanggal_lahir_ibu`, `pekerjaan_ibu`, `alamat_ibu`, `nama_anak`, `tempat_tanggal_lahir_anak`, `jenis_kelamin_anak`, `alamat_anak`) VALUES
(1, 'user', NULL, '[value-2]', '[value-3]', '[value-4]', '[value-5]', '[value-6]', '[value-7]', '[value-8]', '[value-9]', '[value-10]', '[value-11]', '[value-12]', '[value-13]'),
(3, 'user', 'sktm', '[value-2]', '[value-3]', '[value-4]', '[value-5]', '[value-6]', '[value-7]', '[value-8]', '[value-9]', '[value-10]', '[value-11]', '[value-12]', '[value-13]'),
(4, 'user', 'sktm', 'guwvuwwuwc', 'sjsjwks, 14 November 2023', 'whisgie', 'enkbwihiw', 'wbiwbbiw', 'sbiwbiw swih9j, 15 November 2023', 'heiheibe', 'eboebi', 'w lneohw', ' eiihiehe, 16 November 2023', 'Laki-Laki', 'ebiehihe');

--
-- Trigger `sktm`
--
DELIMITER $$
CREATE TRIGGER `sktm_to_pengajuan` AFTER INSERT ON `sktm` FOR EACH ROW INSERT INTO pengajuan_surat(kode_surat,nik, nama,no_pengajuan,username)
VALUES(new.kode_surat,new.nama_bapak,new.nama_anak,new.no_pengajuan
       ,new.username)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat`
--

CREATE TABLE `surat` (
  `kode_surat` varchar(100) NOT NULL,
  `Keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `surat`
--

INSERT INTO `surat` (`kode_surat`, `Keterangan`) VALUES
('coba', 'coba'),
('skck', 'SURAT KETERANGAN ADAT ISTIADAT'),
('sktm', 'SURAT KETERANGAN TIDAK MAMPU'),
('surat_ijin', 'SURAT KETERANGAN  IJIN TIDAK MASUK KERJA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_ijin`
--

CREATE TABLE `surat_ijin` (
  `no_pengajuan` int(11) NOT NULL,
  `kode_surat` varchar(100) NOT NULL DEFAULT 'surat_ijin',
  `username` varchar(20) DEFAULT NULL,
  `Nama` varchar(100) NOT NULL,
  `NIK` varchar(30) NOT NULL,
  `Jenis_kelamin` varchar(20) NOT NULL,
  `Tempat_tanggal_lahir` varchar(100) NOT NULL,
  `Kewarganegaraan` varchar(50) NOT NULL,
  `Agama` varchar(20) NOT NULL,
  `Pekerjaan` varchar(70) NOT NULL,
  `Alamat` varchar(100) NOT NULL,
  `Tempat_Kerja` varchar(100) NOT NULL,
  `Bagian` varchar(100) NOT NULL,
  `Tanggal` varchar(50) NOT NULL,
  `Alasan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `surat_ijin`
--

INSERT INTO `surat_ijin` (`no_pengajuan`, `kode_surat`, `username`, `Nama`, `NIK`, `Jenis_kelamin`, `Tempat_tanggal_lahir`, `Kewarganegaraan`, `Agama`, `Pekerjaan`, `Alamat`, `Tempat_Kerja`, `Bagian`, `Tanggal`, `Alasan`) VALUES
(55, 'surat_ijin', 'user', '$Nama', '$NIK', '$Jenis_kelamin', '$Tempat_tanggal_lahir', '$Kewarganegaraan', '$Agama', '$Pekerjaan', '$Alamat', '$Tempat_Kerja', '$Bagian', '0000-00-00', '$Alasan'),
(65, 'surat_ijin', 'user', '', '', 'Laki-Laki', ', ', '', '', '', '', '', '', '', ''),
(66, 'surat_ijin', 'user', '', '', 'Laki-Laki', ', ', '', '', '', '', '', '', '', ''),
(67, 'surat_ijin', 'nyoba', 'a', '123456789', 'laki', '', '', '', '', '', '', '', '', '');

--
-- Trigger `surat_ijin`
--
DELIMITER $$
CREATE TRIGGER `ijin_to_suratmasuk` AFTER INSERT ON `surat_ijin` FOR EACH ROW INSERT INTO pengajuan_surat(kode_surat,nik, nama,no_pengajuan,username)
VALUES(new.kode_surat,new.NIK,new.Nama,new.no_pengajuan
       ,new.username)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `id` int(11) NOT NULL,
  `kode_surat` varchar(100) NOT NULL,
  `tangal` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `surat_masuk`
--

INSERT INTO `surat_masuk` (`id`, `kode_surat`, `tangal`) VALUES
(27, 'skck', '2023-10-29'),
(28, 'skck', '2023-11-01'),
(29, 'skck', '2023-11-01'),
(30, 'skck', '2023-11-01'),
(31, 'skck', '2023-11-01'),
(37, 'skck', '2023-11-08'),
(38, 'skck', '2023-11-08'),
(39, 'skck', '2023-11-08'),
(42, 'surat_ijin', '2023-11-09'),
(50, 'skck', '2023-11-09'),
(51, 'surat_ijin', '2023-11-09'),
(53, 'surat_ijin', '2023-11-09'),
(54, 'sktm', '2023-11-09'),
(55, 'sktm', '2023-11-10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ttd`
--

CREATE TABLE `ttd` (
  `id` varchar(100) NOT NULL,
  `pangkat` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ttd`
--

INSERT INTO `ttd` (`id`, `pangkat`, `nama`) VALUES
('kepaladesa', 'KEPALA DESA PESUDUKUH', 'ROMI YUMIANI'),
('carik', 'SEKETARIS DESA', 'MAULUDIN MACHMUD');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun_admin`
--
ALTER TABLE `akun_admin`
  ADD PRIMARY KEY (`username`);

--
-- Indeks untuk tabel `akun_user`
--
ALTER TABLE `akun_user`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD UNIQUE KEY `id` (`id`) USING BTREE;

--
-- Indeks untuk tabel `pengajuan_surat`
--
ALTER TABLE `pengajuan_surat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_surat` (`kode_surat`,`nik`),
  ADD KEY `username` (`username`);

--
-- Indeks untuk tabel `skck`
--
ALTER TABLE `skck`
  ADD PRIMARY KEY (`no_pengajuan`),
  ADD KEY `kode_surat` (`kode_surat`,`nik`),
  ADD KEY `username` (`username`);

--
-- Indeks untuk tabel `sktm`
--
ALTER TABLE `sktm`
  ADD PRIMARY KEY (`no_pengajuan`),
  ADD KEY `username` (`username`,`kode_surat`),
  ADD KEY `kode_surat` (`kode_surat`);

--
-- Indeks untuk tabel `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`kode_surat`) USING BTREE;

--
-- Indeks untuk tabel `surat_ijin`
--
ALTER TABLE `surat_ijin`
  ADD PRIMARY KEY (`no_pengajuan`),
  ADD KEY `kode_surat` (`kode_surat`),
  ADD KEY `fk_username_surat_ijin` (`username`) USING BTREE;

--
-- Indeks untuk tabel `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `kd_surat` (`kode_surat`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pengajuan_surat`
--
ALTER TABLE `pengajuan_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT untuk tabel `skck`
--
ALTER TABLE `skck`
  MODIFY `no_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `sktm`
--
ALTER TABLE `sktm`
  MODIFY `no_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `surat_ijin`
--
ALTER TABLE `surat_ijin`
  MODIFY `no_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `laporan_ibfk_1` FOREIGN KEY (`id`) REFERENCES `pengajuan_surat` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengajuan_surat`
--
ALTER TABLE `pengajuan_surat`
  ADD CONSTRAINT `pengajuan_surat_ibfk_1` FOREIGN KEY (`kode_surat`) REFERENCES `surat` (`kode_surat`),
  ADD CONSTRAINT `pengajuan_surat_ibfk_2` FOREIGN KEY (`username`) REFERENCES `akun_user` (`username`);

--
-- Ketidakleluasaan untuk tabel `skck`
--
ALTER TABLE `skck`
  ADD CONSTRAINT `skck_ibfk_1` FOREIGN KEY (`kode_surat`) REFERENCES `surat` (`kode_surat`),
  ADD CONSTRAINT `skck_ibfk_2` FOREIGN KEY (`username`) REFERENCES `akun_user` (`username`);

--
-- Ketidakleluasaan untuk tabel `sktm`
--
ALTER TABLE `sktm`
  ADD CONSTRAINT `sktm_ibfk_1` FOREIGN KEY (`username`) REFERENCES `akun_user` (`username`),
  ADD CONSTRAINT `sktm_ibfk_2` FOREIGN KEY (`kode_surat`) REFERENCES `surat` (`kode_surat`);

--
-- Ketidakleluasaan untuk tabel `surat_ijin`
--
ALTER TABLE `surat_ijin`
  ADD CONSTRAINT `surat_ijin_ibfk_1` FOREIGN KEY (`username`) REFERENCES `akun_user` (`username`),
  ADD CONSTRAINT `surat_ijin_ibfk_2` FOREIGN KEY (`kode_surat`) REFERENCES `surat` (`kode_surat`);

--
-- Ketidakleluasaan untuk tabel `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD CONSTRAINT `surat_masuk_ibfk_1` FOREIGN KEY (`id`) REFERENCES `pengajuan_surat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
