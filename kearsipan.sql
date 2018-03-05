-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2018 at 05:00 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kearsipan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_disposisi`
--

CREATE TABLE `tbl_disposisi` (
  `kd_disposisi` varchar(10) NOT NULL,
  `tanggal_disposisi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dibalas_kepada` varchar(35) NOT NULL,
  `deskripsi` text NOT NULL,
  `notifikasi` varchar(35) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'belum' COMMENT 'dibaca/belum',
  `kd_surat` varchar(10) NOT NULL,
  `kd_user` varchar(10) NOT NULL,
  `kd_disposisi_terusan` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_disposisi`
--

INSERT INTO `tbl_disposisi` (`kd_disposisi`, `tanggal_disposisi`, `dibalas_kepada`, `deskripsi`, `notifikasi`, `status`, `kd_surat`, `kd_user`, `kd_disposisi_terusan`) VALUES
('D0001', '2018-01-25 09:25:27', 'KD0002', 'PT. Zamasco Mitra Solusindo mengajak kementerian kesehatan RI untuk mengadakan kerja sama di bidang IT untuk meningkatkan pelayanan kesehatan di indonesia', 'Ada surat ajakan kerja sama dari PT', 'belum', 'S0001', 'KDU0001', 'D0003'),
('D0002', '2018-02-07 12:38:07', 'KD0003', 'PT. Zamasco Mitra Solusindo mengajak kementerian kesehatan RI untuk mengadakan kerja sama di bidang IT untuk meningkatkan pelayanan kesehatan di indonesia', 'Ada surat ajakan kerja sama dari PT', 'dibaca', 'S0001', 'KDU0001', ''),
('D0003', '2018-02-22 01:25:10', 'KD0003', 'PT. Zamasco Mitra Solusindo mengajak kementerian kesehatan RI untuk mengadakan kerja sama di bidang IT untuk meningkatkan pelayanan kesehatan di indonesia', 'Ada surat ajakan kerja sama dari PT', 'dibaca', 'S0001', 'KD0002', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_surat`
--

CREATE TABLE `tbl_surat` (
  `kd_surat` varchar(10) NOT NULL,
  `waktu_datang` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `no_surat` varchar(35) NOT NULL,
  `tanggal_surat` date NOT NULL,
  `dari` varchar(35) NOT NULL,
  `kepada` varchar(35) NOT NULL,
  `subjek_surat` varchar(35) NOT NULL,
  `deskripsi` text NOT NULL,
  `status_surat` varchar(35) NOT NULL COMMENT 'Masuk / Keluar',
  `file_surat` varchar(200) NOT NULL,
  `kd_tipe_surat` varchar(10) NOT NULL,
  `kd_user` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_surat`
--

INSERT INTO `tbl_surat` (`kd_surat`, `waktu_datang`, `no_surat`, `tanggal_surat`, `dari`, `kepada`, `subjek_surat`, `deskripsi`, `status_surat`, `file_surat`, `kd_tipe_surat`, `kd_user`) VALUES
('S0001', '2018-02-22 01:24:22', '453628', '2018-02-22', 'Bagian Kesiswaan', 'Kepala Sekolah', 'Data Guru', 'Berikut adalah data para guru SMKN 6 Kota Bekasi', 'masuk', 'DUMMY DATA GURU.xls', 'RSH', 'KD0001'),
('S0003', '2018-02-22 01:08:46', 'S0003', '2018-02-21', 'OSIS', 'Kepala Sekolah', 'Surat Permohonan', 'Ada surat permohonan dari Organisasi Siswa Intra Sekolah', 'keluar', 'Contoh Surat dinas osis.png', 'PNT', 'KD0002'),
('S0004', '2018-02-22 01:22:32', 'S0003', '2018-02-20', 'OSIS', 'Kepala Sekolah', 'Surat Permohonan', 'Berikut adalah surat permohonan dari organisasi osis', 'masuk', 'Contoh Surat dinas osis.png', 'PNT', 'KD0002'),
('S0005', '2018-02-22 01:22:32', 'S0003', '2018-02-20', 'OSIS', 'Kepala Sekolah', 'Surat Permohonan', 'Berikut adalah surat permohonan dari organisasi osis', 'masuk', 'Contoh Surat dinas osis.png', 'PNT', 'KD0002'),
('S0006', '2018-02-22 01:29:36', 'S0004', '2018-02-19', 'Bagian Kurikulum', 'Bagian Kesiswaan', 'Data Absen', 'Berikut adalah lampiran data absen para guru SMKN 6 Kota Bekasi', 'keluar', '1. ABSEN 9 MINGGU 2 T.P 17-18.csv', '', 'KD0002');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tipe_surat`
--

CREATE TABLE `tbl_tipe_surat` (
  `kd_tipe_surat` varchar(10) NOT NULL,
  `tipe` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_tipe_surat`
--

INSERT INTO `tbl_tipe_surat` (`kd_tipe_surat`, `tipe`) VALUES
('PNT', 'Penting'),
('RSH', 'Rahasia'),
('SGP', 'Sangat Penting');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `kd_user` varchar(10) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(35) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `hak_akses` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`kd_user`, `username`, `password`, `nama`, `hak_akses`) VALUES
('KD0001', 'adminpertama', 'adminpertama', 'Admin Pertama', 'admin'),
('KD0002', 'sekretaris123', 'sekretaris123', 'Sekretaris', 'sekretaris'),
('KD0003', 'manager123', 'manager123', 'Manager Pertama', 'manager');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_disposisi`
--
ALTER TABLE `tbl_disposisi`
  ADD PRIMARY KEY (`kd_disposisi`);

--
-- Indexes for table `tbl_surat`
--
ALTER TABLE `tbl_surat`
  ADD PRIMARY KEY (`kd_surat`);

--
-- Indexes for table `tbl_tipe_surat`
--
ALTER TABLE `tbl_tipe_surat`
  ADD PRIMARY KEY (`kd_tipe_surat`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`kd_user`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
