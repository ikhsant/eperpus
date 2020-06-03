-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2020 at 02:09 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eperpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `kategori` int(11) NOT NULL,
  `pengarang` int(11) NOT NULL,
  `tahun` varchar(255) NOT NULL,
  `edisi` varchar(255) NOT NULL,
  `sinopsis` text NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `rak` int(11) NOT NULL,
  `cover` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul`, `kategori`, `pengarang`, `tahun`, `edisi`, `sinopsis`, `penerbit`, `status`, `label`, `rak`, `cover`) VALUES
(1, 'Happy Parenting : Without Spanking Or', 1, 2, '2020', '1', 'https://ieeexplore.ieee.org/abstract/document/8311741', 'Surya Kencana', '', '', 1, 'ylb5pw07wpw4wc88cs.jpg'),
(2, 'Segala-galanya Ambyar', 2, 2, '2020', '1', 'Apakah kamu merasa kecewa dengan hidupmu? Apakah kamu merasa cemas secara terus-menerus? Apakah kamu merasa bahwa dunia di sekelilingmu buruk dan jahat?\nYa, dunia ini memang kacau, dunia ini memang ambyar, tapi itu karena Anda tidak sadar bahwa harapan Anda terlalu disilaukan oleh keinginan-keinginan Anda sendiri yang tidak masuk akal.\n\nJadi, lepaskanlah harapan - harapan itu, jika Anda ingin waras!\n#AmbyarkanHarapan untuk hidup yang lebih tenang.', '', '', '', 1, 'rxw16nmbw3k4w8884.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `keterangan_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `keterangan_kategori`) VALUES
(1, 'Fiksi', ''),
(2, 'Hiburan', '');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `tamu` int(11) NOT NULL,
  `buku` int(11) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `lama_pinjaman` int(11) NOT NULL,
  `denda` int(11) DEFAULT NULL,
  `keterangan_peminjaman` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `tamu`, `buku`, `tanggal_pinjam`, `tanggal_kembali`, `lama_pinjaman`, `denda`, `keterangan_peminjaman`) VALUES
(3, 4, 1, '2020-06-03', '2020-06-04', 2, 100000, 'Keperluan Skripsi'),
(4, 5, 1, '2020-06-04', NULL, 3, NULL, 'fasfasf');

-- --------------------------------------------------------

--
-- Table structure for table `pengarang`
--

CREATE TABLE `pengarang` (
  `id_pengarang` int(11) NOT NULL,
  `nama_pengarang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengarang`
--

INSERT INTO `pengarang` (`id_pengarang`, `nama_pengarang`) VALUES
(2, 'Agus Darmawan');

-- --------------------------------------------------------

--
-- Table structure for table `rak`
--

CREATE TABLE `rak` (
  `id_rak` int(11) NOT NULL,
  `nama_rak` varchar(255) NOT NULL,
  `lokasi_rak` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rak`
--

INSERT INTO `rak` (`id_rak`, `nama_rak`, `lokasi_rak`) VALUES
(1, 'RAK 1', 'Di rak 1');

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
(0, 'E-PERPUS', 'book-flat-icon-png-6.png', 'Jl Raya Ciboalang No 21', '@2019', 'brown');

-- --------------------------------------------------------

--
-- Table structure for table `tamu`
--

CREATE TABLE `tamu` (
  `id_tamu` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `tanggal_kunjungan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tamu`
--

INSERT INTO `tamu` (`id_tamu`, `nama`, `kelas`, `tanggal_kunjungan`) VALUES
(4, 'YULIANI PUTRI', 'ts19a', '2020-06-03 13:09:19'),
(5, 'ADE ABDULLAH', 'ts19a', '2020-06-03 13:59:15');

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
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`);

--
-- Indexes for table `pengarang`
--
ALTER TABLE `pengarang`
  ADD PRIMARY KEY (`id_pengarang`);

--
-- Indexes for table `rak`
--
ALTER TABLE `rak`
  ADD PRIMARY KEY (`id_rak`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tamu`
--
ALTER TABLE `tamu`
  ADD PRIMARY KEY (`id_tamu`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengarang`
--
ALTER TABLE `pengarang`
  MODIFY `id_pengarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rak`
--
ALTER TABLE `rak`
  MODIFY `id_rak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tamu`
--
ALTER TABLE `tamu`
  MODIFY `id_tamu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
