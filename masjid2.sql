-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2024 at 07:16 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `masjid2`
--

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE `agenda` (
  `kode_agenda` int(4) NOT NULL,
  `Waktu_Agenda` time DEFAULT NULL,
  `tanggal_agenda` date DEFAULT NULL,
  `nama_agenda` varchar(50) NOT NULL,
  `tempat_agenda` varchar(50) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `id_petugas` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agenda`
--

INSERT INTO `agenda` (`kode_agenda`, `Waktu_Agenda`, `tanggal_agenda`, `nama_agenda`, `tempat_agenda`, `keterangan`, `id_petugas`) VALUES
(201, '18:00:00', '2024-06-01', 'Pengajian', 'Masjid', NULL, 1061),
(202, '10:00:00', '2024-06-02', 'Bantuan Sosial', 'Lapangan Masjid', NULL, 1061),
(203, '10:00:00', '2024-06-03', 'Kajian Tafsir Al Quran', 'Masjid', NULL, 1061),
(204, '19:30:00', '2024-06-04', 'Tablig Akbar', 'Lapangan Masjid', NULL, 1061),
(205, '03:30:00', '2024-06-05', 'Subuh Akbar', 'Masjid', NULL, 1061),
(206, '08:00:00', '2024-06-06', 'Santunan Yatim Piatu', 'Lapangan Masjid', NULL, 1061),
(207, '09:00:00', '2024-06-07', 'Penerimaan Zakat', 'Masjid', NULL, 1061),
(208, '16:00:00', '2024-06-08', 'Pembagian Zakat', 'Lapangan Masjid', NULL, 1061),
(209, '13:00:00', '2024-06-09', 'Pesantren Kilat', 'Koridor Masjid', NULL, 1061),
(210, '18:30:00', '2024-06-10', 'Kultum Tafsir Al Quran', 'Masjid', NULL, 1061),
(211, '14:08:00', '2024-06-01', 'ngaji', 'mesjid', 'ngaji bareng', 1061),
(212, '14:08:00', '2024-06-01', 'ngaji', 'mesjid', 'ngaji bareng', 1061),
(213, '13:00:00', '2024-06-05', 'ass', 'de', 'jja', 0);

-- --------------------------------------------------------

--
-- Table structure for table `donatur`
--

CREATE TABLE `donatur` (
  `id_donatur` int(5) NOT NULL,
  `nama_donatur` varchar(50) NOT NULL,
  `alamat_donatur` varchar(100) NOT NULL,
  `jumlah_donasi` int(20) NOT NULL,
  `tanggal_donasi` date DEFAULT NULL,
  `no_hp_donatur` varchar(13) NOT NULL,
  `jenis_kelamin` enum('Perempuan','Laki-Laki') DEFAULT NULL,
  `id_petugas` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donatur`
--

INSERT INTO `donatur` (`id_donatur`, `nama_donatur`, `alamat_donatur`, `jumlah_donasi`, `tanggal_donasi`, `no_hp_donatur`, `jenis_kelamin`, `id_petugas`) VALUES
(1020, 'Asep dimas', 'Jakarta', 120000, '2024-06-01', '0896765845', 'Laki-Laki', 1061);

--
-- Triggers `donatur`
--
DELIMITER $$
CREATE TRIGGER `Sebelum_data_update` BEFORE UPDATE ON `donatur` FOR EACH ROW begin
insert into jumlah_donasi
set id_donatur = OLD.id_donatur,
data_baru=new.jumlah_donasi,
data_lama=old.jumlah_donasi,
waktu_perubahan = NOW();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pemasukan`
--

CREATE TABLE `pemasukan` (
  `kode_pemasukan` int(4) NOT NULL,
  `jumlah_pemasukan` int(10) NOT NULL,
  `tanggal_pemasukan` date DEFAULT NULL,
  `waktu_pemasukan` time DEFAULT NULL,
  `ket_pemasukan` text DEFAULT NULL,
  `id_petugas` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemasukan`
--

INSERT INTO `pemasukan` (`kode_pemasukan`, `jumlah_pemasukan`, `tanggal_pemasukan`, `waktu_pemasukan`, `ket_pemasukan`, `id_petugas`) VALUES
(34, 100000, '2024-05-03', '15:05:00', NULL, 1061),
(35, 250000, '2024-05-04', '16:07:00', NULL, 1061),
(36, 135000, '2024-05-05', '21:20:00', NULL, 1061),
(37, 125000, '2024-05-06', '18:30:00', NULL, 1061),
(38, 115000, '2024-05-07', '13:50:00', NULL, 1061),
(39, 140000, '2024-05-08', '11:44:00', NULL, 1061),
(40, 130000, '2024-05-09', '10:30:00', NULL, 1061),
(41, 150000, '2024-05-10', '14:00:00', NULL, 1061),
(42, 200000, '2024-05-11', '15:23:00', NULL, 1061);

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `kode_pengeluaran` int(5) NOT NULL,
  `no_kwitansi` char(4) DEFAULT NULL,
  `jumlah_pengeluaran` int(10) NOT NULL,
  `nama_pengeluaran` varchar(30) NOT NULL,
  `tanggal_pengeluaran` date DEFAULT NULL,
  `waktu_pengeluaran` time DEFAULT NULL,
  `id_petugas` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`kode_pengeluaran`, `no_kwitansi`, `jumlah_pengeluaran`, `nama_pengeluaran`, `tanggal_pengeluaran`, `waktu_pengeluaran`, `id_petugas`) VALUES
(1324, '101', 200000, 'Pembelian cat', '2024-06-03', '00:00:08', 1061),
(1325, '102', 600000, 'pembelian mic', '2024-06-04', '00:00:09', 1061),
(1326, '103', 90000, 'pembelian semen', '2024-06-05', '00:00:11', 1061),
(1327, '104', 30000, 'pembelian jam', '2024-06-06', '00:00:14', 1061),
(1328, '105', 1000000, 'Pembelian Batu Bata', '2024-06-07', '08:11:00', 1061),
(1329, '106', 1000000, 'pembelian kipas angin', '2024-06-08', '00:00:08', 1061),
(1330, '107', 265000, 'pembayaran listrik', '2024-06-09', '00:00:08', 1061),
(1331, '108', 420000, 'pembelian speaker', '2024-06-10', '00:00:14', 1061),
(1332, '109', 2000000, 'pembagian bansoskk', '2024-06-11', '00:00:11', 1061);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `Id_Petugas` int(5) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `Nama_Petugas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`Id_Petugas`, `alamat`, `no_hp`, `Nama_Petugas`) VALUES
(1061, 'Jl. Gagaklumayung Kp.Sukaregang Garut ', '089637085224', 'Moch Nazham Ismul Azham '),
(1062, 'Kp. Jayaraga, Desa Jayaraga, RT/RW.03/02, Kec. Tarogong Kidul, Kab. Garut 44151', '085643394445', 'Rina Rismawati '),
(1063, 'Kp. Cibodas Kaum RT/RW 01/01 Ds. Banjarsari Kec. Bayongbong Kab. Garut 44162', '0895340734840', 'Abdullah Alghifari ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`kode_agenda`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- Indexes for table `donatur`
--
ALTER TABLE `donatur`
  ADD PRIMARY KEY (`id_donatur`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- Indexes for table `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD PRIMARY KEY (`kode_pemasukan`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`kode_pengeluaran`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`Id_Petugas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `kode_agenda` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT for table `donatur`
--
ALTER TABLE `donatur`
  MODIFY `id_donatur` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1022;

--
-- AUTO_INCREMENT for table `pemasukan`
--
ALTER TABLE `pemasukan`
  MODIFY `kode_pemasukan` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `kode_pengeluaran` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1333;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `donatur`
--
ALTER TABLE `donatur`
  ADD CONSTRAINT `donatur_ibfk_1` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`Id_Petugas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD CONSTRAINT `pemasukan_ibfk_1` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`Id_Petugas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD CONSTRAINT `pengeluaran_ibfk_1` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`Id_Petugas`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
