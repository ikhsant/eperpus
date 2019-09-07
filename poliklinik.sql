-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2019 at 06:28 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poliklinik`
--

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(11) NOT NULL,
  `no_rm` varchar(255) NOT NULL,
  `nama_pasien` varchar(255) NOT NULL,
  `ttl` date NOT NULL,
  `umur` int(11) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `nama_kk` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `pembayaran` varchar(255) NOT NULL,
  `poly` varchar(255) NOT NULL,
  `ds` varchar(255) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_dokter` int(11) NOT NULL,
  `diagnosis` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `no_rm`, `nama_pasien`, `ttl`, `umur`, `jenis_kelamin`, `nama_kk`, `alamat`, `pembayaran`, `poly`, `ds`, `tanggal`, `id_dokter`, `diagnosis`) VALUES
(1, '123', 'MUHAMMAD SUSANTO', '1999-04-01', 21, 'L', 'SUMANTO', 'KP. COBOLAGN', 'BPJS', 'UMUM', '', '2019-07-14 02:41:34', 16, 'RADANG TENGOROKAN'),
(2, '123', 'AJENG SITI', '1999-04-01', 21, 'P', 'SUMANTO', 'KP. COBOLAGN', 'BPJS', 'UMUM', '', '2019-07-14 02:41:34', 16, 'BATUK');

-- --------------------------------------------------------

--
-- Table structure for table `resep`
--

CREATE TABLE `resep` (
  `id_resep` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `obat` varchar(255) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resep`
--

INSERT INTO `resep` (`id_resep`, `id_pasien`, `obat`, `keterangan`) VALUES
(2, 1, 'Paracetamol 2MG', '2x Sehari'),
(3, 1, 'Anti Biotik 3MG', '3X sehari'),
(4, 2, 'Paracetamol 2MG', '3x sehari');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `nama_website` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `theme` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `nama_website`, `logo`, `alamat`, `deskripsi`, `theme`) VALUES
(0, 'POLIKLINIK', 'medic.png', 'Jl Raya Ciboalang No 21', '@2019', 'brown');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `telp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `akses_level` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nip`, `nama_user`, `jenis_kelamin`, `telp`, `email`, `username`, `password`, `foto`, `akses_level`, `alamat`) VALUES
(1, '123456', 'Admin Aplikasi', 'L', '085217965569', 'admin@admin.com', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '3aldl50wcj0gccgkk8.jpg', 'admin', ''),
(16, '412341', 'Dokter 1', 'L', '0821565465', 'doker@email.com', 'dokter', '9d2878abdd504d16fe6262f17c80dae5cec34440', '32krnf8yjracos844c.png', 'dokter', ''),
(17, '123456', 'Pegawai 1', 'L', '', 'pegawai@email.com', 'pegawai', 'a431ba54c55ae2cb91be1785398ecd595ca96b7a', '23bb7d1bwntw84wk.jpg', 'pegawai', ''),
(18, '223344', 'Apoteker 1', 'L', '', 'apoteker@email.com', 'apoteker', '8e30c3e6d50e5d7c02e7eaffa5954b04d4a3afaf', '2r6fbotoimwwswc0k8.jpg', 'apoteker', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indexes for table `resep`
--
ALTER TABLE `resep`
  ADD PRIMARY KEY (`id_resep`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `resep`
--
ALTER TABLE `resep`
  MODIFY `id_resep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
