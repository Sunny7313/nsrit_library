-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2022 at 07:32 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpusweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_sekolah`
--

CREATE TABLE `data_sekolah` (
  `id` int(10) NOT NULL,
  `nama_sekolah` varchar(255) NOT NULL,
  `npsn` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `akreditasi` varchar(255) NOT NULL,
  `bentuk_pendidikan` varchar(255) NOT NULL,
  `status_pemilik` varchar(255) NOT NULL,
  `sk_sekolah` varchar(255) NOT NULL,
  `tgl_sk` varchar(255) NOT NULL,
  `sk_izin` varchar(255) NOT NULL,
  `tgl_izin` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_sekolah`
--

INSERT INTO `data_sekolah` (`id`, `nama_sekolah`, `npsn`, `status`, `akreditasi`, `bentuk_pendidikan`, `status_pemilik`, `sk_sekolah`, `tgl_sk`, `sk_izin`, `tgl_izin`, `logo`) VALUES
(1, 'SMK Fatahillah Cileungsi', '20258413', 'Swasta', 'Ter Akreditasi A', 'Sekolah Menengah Kejuruan', 'Yayasan', '60/YF.01/SK/VI/2006', '6/16/2006', '421/59-Disdik', '1/13/2010', 'fatahillah.png');

-- --------------------------------------------------------

--
-- Table structure for table `list_buku`
--

CREATE TABLE `list_buku` (
  `id_buku` int(16) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `pengarang` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `thn_terbit` varchar(255) NOT NULL,
  `indeks` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `stok` int(16) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `list_buku`
--

INSERT INTO `list_buku` (`id_buku`, `judul`, `pengarang`, `penerbit`, `thn_terbit`, `indeks`, `lokasi`, `stok`, `foto`) VALUES
(1, 'Talent Is Never Enough', 'John C. Maxwell', 'CV Rameda Wijaya', '2016-02-10', '6HF83JGFW', 'B4-3', 15, 'talentnever.jpg'),
(2, 'Ngoding Javascript ', 'Andre Pratama', 'CV Rameda Wijaya', '2014-06-10', '3FER456', 'B1-1', 25, 'jsbook.jpg'),
(3, 'Bahasa Indonesia', 'Muryani J. Semita', 'Gramedia Indonesia', '2013-06-13', 'KJ48T84T', 'B1-2', 40, 'bhsindo.jpg'),
(4, 'Dongeng Anak', 'Andre Pratama', 'CV Rameda Wijaya', '2011-10-04', '8FH3OF35', 'B3-2', 19, 'dongeng.jpg'),
(5, 'Fisika', 'Wawan Purnama', 'Gramedia Indonesia', '2016-06-03', 'ADJSGF46E5', 'B1-3', 40, 'fisika.jpg'),
(6, 'Kamus Bahasa Jepang-Indonesia', 'Najwa Kirana', 'CV Rameda Wijaya', '2017-07-05', 'NSF46IGBN7', 'B4-3', 15, 'kamusjepang.jpg'),
(7, 'Kamus Jerman-Indonesia', 'Travin Masyandi', 'Gramedia Indonesia', '2019-02-15', 'ADJSGF46E5', 'B3-2', 20, 'kamusjerman.jpg'),
(8, 'Basis Data', 'Darsono', 'Gramedia Indonesia', '2018-06-03', '3FER456', 'B2-2', 25, 'bssdata.png'),
(9, 'Matematika', 'Nanang Priatna', 'Gramedia Indonesia', '2016-02-11', 'UYYRI2423', 'B3-2', 100, 'matematika.jpg'),
(10, 'Kerja Kerja Kaya', 'Andre Pratama', 'CV Rameda WijayA', '2016-02-17', '845JGOES', 'B3-1', 20, 'kerjakaya.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `list_member`
--

CREATE TABLE `list_member` (
  `id_member` int(16) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nis` int(16) NOT NULL,
  `jenis_kelamin` varchar(36) NOT NULL,
  `tmpt_lahir` varchar(64) NOT NULL,
  `tgl_lahir` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kelas` varchar(128) NOT NULL,
  `nama_jurusan` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `list_member`
--

INSERT INTO `list_member` (`id_member`, `nama`, `nis`, `jenis_kelamin`, `tmpt_lahir`, `tgl_lahir`, `alamat`, `kelas`, `nama_jurusan`) VALUES
(1, 'Muhammad Faqih', 312456, 'Laki_Laki', 'Bekasi', '05/03/2004', 'Grand Nusa Indah', 'XI', 'Rekayasa Perangkat Lunak'),
(2, 'Handito Satrio', 312456, 'Laki_Laki', 'Jakarta', '01/08/2004', 'Perum Paspampres', 'XI', 'Teknik Komputer dan Jaringan'),
(3, 'Ajeung Suci', 312456, 'Perempuan', 'Jakarta', '07/05/2004', 'Desa Dayeuh', 'XI', 'Otomatisasi Tata Kelola Perkantoran'),
(4, 'Muhammad Udin Mansur', 312456, 'Laki_Laki', 'Bogor', '11/09/2003', 'Citra Indah City', 'XI', 'Rekayasa Perangkat Lunak'),
(5, 'Indah Rahmadewi', 312456, 'Perempuan', 'Bandung', '09/06/2004', 'Jonggolan', 'XII', 'Otomatisasi Tata Kelola Perkantoran'),
(6, 'Jamaludin Akbar', 312456, 'Laki_Laki', 'Bandung', '06/02/2002', 'Desa Dayueh', 'XII', 'Teknik Komputer dan Jaringan'),
(7, 'Aksya Anandito', 312456, 'Laki_Laki', 'Jakarta', '05/04/2004', 'Citra Indah City', 'XI', 'Rekayasa Perangkat Lunak'),
(8, 'Rizky Hilmiawan', 312456, 'Laki_Laki', 'Solo', '09/10/2003', 'Duta Cileungsi  Kidul', 'XI', 'Rekayasa Perangkat Lunak'),
(9, 'Muhamad Akmal', 312456, 'Laki_Laki', 'Jakarta', '10/12/2003', 'Permata Puri Harmoni', 'XI', 'Teknik Komputer dan Jaringan'),
(10, 'Gigin Permana', 312456, 'Laki_Laki', 'Solo', '08/15/2004', 'Permata Puri Harmoni', 'XI', 'Rekayasa Perangkat Lunak'),
(11, 'Muhammad Samsiar', 312456, 'Laki_Laki', 'Bandung', '05/12/2004', 'Jalan Tunggeulis', 'XI', 'Rekayasa Perangkat Lunak'),
(12, 'Siti Ubaidah', 312456, 'Perempuan', 'Bogor', '12/24/2003', 'Duta Cileungsi  Kidul', 'XII', 'Otomatisasi Tata Kelola Perkantoran');

-- --------------------------------------------------------

--
-- Table structure for table `list_pinjam`
--

CREATE TABLE `list_pinjam` (
  `id_pinjam` int(16) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tgl_pinjam` varchar(255) NOT NULL,
  `tgl_kembali` varchar(255) NOT NULL,
  `jumlah` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `list_pinjam`
--

INSERT INTO `list_pinjam` (`id_pinjam`, `judul`, `nama`, `tgl_pinjam`, `tgl_kembali`, `jumlah`) VALUES
(4, 'Dongeng Anak', 'Ajeung Suci', '2022-07-01', '2022-07-08', 1);

--
-- Triggers `list_pinjam`
--
DELIMITER $$
CREATE TRIGGER `balikBuku` AFTER DELETE ON `list_pinjam` FOR EACH ROW BEGIN

   UPDATE list_buku SET stok = stok + 1

   WHERE judul=OLD.judul;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `kurangiStok` AFTER INSERT ON `list_pinjam` FOR EACH ROW BEGIN

   UPDATE list_buku SET stok = stok - 1

   WHERE judul=NEW.judul;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `nama` varchar(64) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telepon` varchar(64) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `level` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`nama`, `username`, `password`, `email`, `telepon`, `foto`, `level`) VALUES
('Akhmad Ridlo', 'akhmad', 'c85b5738485dae80d7d85efe9b3f2efc', 'akhmadd432@gmail.com', '+6282122941060', 'muka.jpg', 'Admin'),
('Renita Aprilia', 'renita', '2a17731826edd7111390deae84b4c604', '', '', 'renita.png', 'Pengawas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_sekolah`
--
ALTER TABLE `data_sekolah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list_buku`
--
ALTER TABLE `list_buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `judul` (`judul`);

--
-- Indexes for table `list_member`
--
ALTER TABLE `list_member`
  ADD PRIMARY KEY (`id_member`),
  ADD KEY `nama` (`nama`);

--
-- Indexes for table `list_pinjam`
--
ALTER TABLE `list_pinjam`
  ADD PRIMARY KEY (`id_pinjam`),
  ADD KEY `judul` (`judul`),
  ADD KEY `nama` (`nama`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_sekolah`
--
ALTER TABLE `data_sekolah`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `list_buku`
--
ALTER TABLE `list_buku`
  MODIFY `id_buku` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `list_member`
--
ALTER TABLE `list_member`
  MODIFY `id_member` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `list_pinjam`
--
ALTER TABLE `list_pinjam`
  MODIFY `id_pinjam` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
