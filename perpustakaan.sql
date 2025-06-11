-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2025 at 09:37 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `ID_BUKU` int(11) NOT NULL,
  `ID_KATEGORI` int(11) DEFAULT NULL,
  `NAMA_BUKU` varchar(30) DEFAULT NULL,
  `PENGARANG` varchar(30) DEFAULT NULL,
  `GENRE` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`ID_BUKU`, `ID_KATEGORI`, `NAMA_BUKU`, `PENGARANG`, `GENRE`) VALUES
(2, 3, 'H.S.K.T.', 'Lee Hi (Feat. Wonstein)', 'Pop');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `ID_KATEGORI` int(11) NOT NULL,
  `NAMA_KATEGORI` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`ID_KATEGORI`, `NAMA_KATEGORI`) VALUES
(3, 'Non Fiksi');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `ID_PEMINJAMAN` int(11) NOT NULL,
  `ID_BUKU` int(11) NOT NULL,
  `ID_SISWA` int(11) NOT NULL,
  `TANGGAL_PEMINJAMAN` datetime DEFAULT NULL,
  `TANGGAL_PENGEMBALIAN` datetime DEFAULT NULL,
  `STATUS` enum('DIPINJAM','DIKEMBALIKAN') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `ID_SISWA` int(11) NOT NULL,
  `NAMA_SISWA` varchar(30) DEFAULT NULL,
  `KELAS_SISWA` varchar(30) DEFAULT NULL,
  `JURUSAN` varchar(30) DEFAULT NULL,
  `EMAIL` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`ID_SISWA`, `NAMA_SISWA`, `KELAS_SISWA`, `JURUSAN`, `EMAIL`) VALUES
(2, 'Jay Park', 'X', 'Seni dan Vokal', 'jaypark@kaist.ac.kr'),
(3, 'Ardi', 'V', 'Teknik Informatika', 'ardi@itats.ac.id');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`ID_BUKU`),
  ADD KEY `FK_MEMPUNYAI` (`ID_KATEGORI`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`ID_KATEGORI`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`ID_PEMINJAMAN`),
  ADD KEY `FK_MELAKUKAN` (`ID_SISWA`),
  ADD KEY `FK_MEMILIKI` (`ID_BUKU`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`ID_SISWA`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `ID_BUKU` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `ID_KATEGORI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `ID_PEMINJAMAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `ID_SISWA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `FK_MEMPUNYAI` FOREIGN KEY (`ID_KATEGORI`) REFERENCES `kategori` (`ID_KATEGORI`);

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `FK_MELAKUKAN` FOREIGN KEY (`ID_SISWA`) REFERENCES `siswa` (`ID_SISWA`),
  ADD CONSTRAINT `FK_MEMILIKI` FOREIGN KEY (`ID_BUKU`) REFERENCES `buku` (`ID_BUKU`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
