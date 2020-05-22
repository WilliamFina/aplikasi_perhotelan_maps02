-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 22, 2020 at 06:38 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ca_hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `id_hotel` int(11) NOT NULL,
  `nama_hotel` varchar(50) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `username_hotel` varchar(50) NOT NULL,
  `password_hotel` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `jumlah_kamar` int(11) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `tentang` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`id_hotel`, `nama_hotel`, `latitude`, `longitude`, `no_telepon`, `username_hotel`, `password_hotel`, `alamat`, `jumlah_kamar`, `foto`, `tentang`) VALUES
(2, 'Hotel bola', '-10.18407289857238', '123.58665099509275', '1222', 'b123', 'b123', 'Jln. Amanuban Oebufu', 3, 'c1.jpg', 'saaaaaaaaaaaa asmmmmmmmmmsa sadmasds asmmmmmmmmmmd sad sadsammmmmmmmmmmdas,dsaaaaaaa, sandddddddddddddddd nama ssaya willima sukarya fina');

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `id_kamar` int(11) NOT NULL,
  `id_hotel` int(11) NOT NULL,
  `id_tipe_kamar` int(11) NOT NULL,
  `no_kamar` int(11) NOT NULL,
  `status_kamar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id_kamar`, `id_hotel`, `id_tipe_kamar`, `no_kamar`, `status_kamar`) VALUES
(8, 2, 2, 1, 0),
(9, 2, 2, 2, 0),
(10, 2, 3, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id_login` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_login`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$7DPhdihT8dYfCPmUCefSPuCB..Jxx8tgIL.acYOS6m53ad5VzmzYO');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesan` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `nama_pemesan` varchar(50) NOT NULL,
  `no_pemesan` varchar(15) NOT NULL,
  `alamat_pemesan` text NOT NULL,
  `status_pemesan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesan`, `id_kamar`, `check_in`, `check_out`, `nama_pemesan`, `no_pemesan`, `alamat_pemesan`, `status_pemesan`) VALUES
(21, 9, '2020-05-19', '2020-05-27', 'william fina', '082144855486', 'RT13/RW 03 Oebufu', 0),
(22, 10, '2020-05-20', '2020-05-27', 'markus sa', '08222', 'saaaaaaaa', 0),
(23, 8, '2020-05-19', '2020-05-23', 'oma fina', '085237448286', 'oebufu', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_selesai`
--

CREATE TABLE `pemesanan_selesai` (
  `id_pemesanan_selesai` int(11) NOT NULL,
  `nama_pemesan` varchar(50) NOT NULL,
  `no_pemesan` varchar(50) NOT NULL,
  `alamat_pemesan` text NOT NULL,
  `id_hotel` int(11) NOT NULL,
  `no_kamar` int(11) NOT NULL,
  `tipe_kamar` varchar(50) NOT NULL,
  `harga_kamar` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `bayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemesanan_selesai`
--

INSERT INTO `pemesanan_selesai` (`id_pemesanan_selesai`, `nama_pemesan`, `no_pemesan`, `alamat_pemesan`, `id_hotel`, `no_kamar`, `tipe_kamar`, `harga_kamar`, `check_in`, `check_out`, `bayar`) VALUES
(1, 'sss', '122', 'wwwwwww', 2, 3, 'bbbbbbb', 4423, '2020-05-20', '2020-05-20', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tipe_kamar`
--

CREATE TABLE `tipe_kamar` (
  `id_tipe_kamar` int(11) NOT NULL,
  `tipe_kamar` varchar(50) NOT NULL,
  `harga_kamar` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `foto_kamar` varchar(50) NOT NULL,
  `id_hotel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tipe_kamar`
--

INSERT INTO `tipe_kamar` (`id_tipe_kamar`, `tipe_kamar`, `harga_kamar`, `keterangan`, `foto_kamar`, `id_hotel`) VALUES
(2, 'aaaaaaaaaaaaa', 1212, 'aaaaasdsad', 'a.JPG', 2),
(3, 'bbbbbbb', 4423, 'saasa', 'mountain-23560453.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `wisata`
--

CREATE TABLE `wisata` (
  `id_wisata` int(11) NOT NULL,
  `nama_wisata` varchar(50) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wisata`
--

INSERT INTO `wisata` (`id_wisata`, `nama_wisata`, `latitude`, `longitude`, `alamat`, `foto`) VALUES
(1, 'pantai manikin', '-10.171738812548142', '123.59137168295896', 'sasas', 'mountain-23560451.jpg'),
(2, 'asxas', '-10.171485367427305', '123.63385787375486', 'sdsadas', 'mountain-23560452.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`id_hotel`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id_kamar`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesan`);

--
-- Indexes for table `pemesanan_selesai`
--
ALTER TABLE `pemesanan_selesai`
  ADD PRIMARY KEY (`id_pemesanan_selesai`);

--
-- Indexes for table `tipe_kamar`
--
ALTER TABLE `tipe_kamar`
  ADD PRIMARY KEY (`id_tipe_kamar`);

--
-- Indexes for table `wisata`
--
ALTER TABLE `wisata`
  ADD PRIMARY KEY (`id_wisata`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `id_hotel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `pemesanan_selesai`
--
ALTER TABLE `pemesanan_selesai`
  MODIFY `id_pemesanan_selesai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tipe_kamar`
--
ALTER TABLE `tipe_kamar`
  MODIFY `id_tipe_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wisata`
--
ALTER TABLE `wisata`
  MODIFY `id_wisata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
