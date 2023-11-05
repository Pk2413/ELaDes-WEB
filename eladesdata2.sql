SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


INSERT INTO `akun_admin` (`username`, `password`, `email`, `kode_otp`) VALUES
('admin', 'admin', 'ananda.aa70@gmail.com', 660454);

INSERT INTO `akun_user` (`username`, `password`, `email`, `nama`, `kode_otp`, `created`) VALUES
('coba', 'aaaa', 'email', 'coba', 184676, '2023-10-26 00:00:00'),
('coba1', 'bf0c95ff56e3b2598456cd455a8684', 'ananda.AA70@gmail.com', 'coba', 423509, '2023-11-01 00:00:00'),
('user', 'user', 'user@email.com', 'Prayoga kusdiana ikhsani ', 793119, '2023-10-26 00:00:00');

INSERT INTO `laporan` (`id`, `tanggal`, `status`) VALUES
(27, '2023-10-29', 'Selesai'),
(28, '2023-11-01', 'Proses'),
(29, '2023-11-01', 'Proses'),
(30, '2023-11-01', 'Selesai'),
(31, '2023-11-01', 'Selesai');

INSERT INTO `pengajuan_surat` (`id`, `kode_surat`, `nik`, `tanggal`, `nama`, `username`, `no_pengajuan`) VALUES
(27, 'skck', 2147483647, '2023-10-29', 'Prayoga kusdiana ikhsani ', 'user', 28),
(28, 'skck', 0, '2023-11-01', '', 'user', 29),
(29, 'skck', 0, '2023-11-01', '', 'user', 30),
(30, 'skck', 123456, '2023-11-01', 'coba 1', 'user', 31),
(31, 'skck', 123456789, '2023-11-01', 'papapapaoapaoaoaoaoaooaoaaooaoaoaoala', 'user', 32);

INSERT INTO `skck` (`no_pengajuan`, `kode_surat`, `nama`, `nik`, `tempat_tgl_lahir`, `kebangsaan`, `agama`, `jenis_kelamin`, `status_perkawinan`, `pekerjaan`, `tempat_tinggal`, `username`) VALUES
(25, 'skck', 'cona', '1923884', 'Nganjuk, 01 Oktober 2023', 'islma', 'amalak', 'Laki-Laki', 'kwjaj', 'ajaj', 'kaak', 'user'),
(26, 'skck', '2', '2', '2, ', '2', '2', '', '2', '2', '2', 'user'),
(27, 'skck', '2', '2', '2, ', '2', '2', '', '2', '2', '2', 'user'),
(28, 'skck', 'Prayoga kusdiana ikhsani ', '081357743268', 'Nganjuk , 01 Oktober 2023', 'WNI', 'islam', 'Laki-Laki', 'Belum Kawin', 'Mahasiswa ', 'Nganjuk', 'user'),
(29, 'skck', '', '', ', ', '', '', '', '', '', '', 'user'),
(30, 'skck', '', '', ', ', '', '', '', '', '', '', 'user'),
(31, 'skck', 'coba 1', '123456', 'nganjk, 05 November 2023', 'haia', 'akaka', 'Perempuan', 'auaia', 'uauaj', 'jajaj', 'user'),
(32, 'skck', 'papapapaoapaoaoaoaoaooaoaaooaoaoaoala', '123456789', 'nganjuk, 23 November 2023', 'nakaj', 'nakaj', 'Laki-Laki', 'ajajsjsh', 'ajaksja', 'ajajah', 'user');

INSERT INTO `surat` (`kode_surat`, `Keterangan`) VALUES
('coba', 'coba'),
('skck', 'SURAT KETERANGAN ADAT ISTIADAT'),
('surat_ijin', 'SURAT KETERANGAN  IJIN TIDAK MASUK KERJA');

INSERT INTO `surat_ijin` (`username`, `no_pengajuan`, `kode_surat`, `Nama`, `NIK`, `Jenis_kelamin`, `Tempat_tanggal_lahir`, `Kewarganegaraan`, `Agama`, `Pekerjaan`, `Alamat`, `Tempat_Kerja`, `Bagian`, `Tanggal`, `Alasan`) VALUES
('user', 3, 'surat_ijin', '[value-4]', '[value-5]', '[value-6]', '[value-7]', '[value-8]', '[value-9]', '[value-10]', '[value-11]', '[value-12]', '[value-13]', '0000-00-00', '[value-15]'),
('user', 4, 'surat_ijin', '[value-3]', '[value-5]', '[value-6]', '[value-7]', '[value-8]', '[value-9]', '[value-10]', '[value-11]', '[value-12]', '[value-13]', '0000-00-00', '[value-15]');

INSERT INTO `surat_masuk` (`id`, `kode_surat`, `tangal`) VALUES
(27, 'skck', '2023-10-29'),
(28, 'skck', '2023-11-01'),
(29, 'skck', '2023-11-01'),
(30, 'skck', '2023-11-01'),
(31, 'skck', '2023-11-01');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
