-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2024 at 11:50 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ukk_gallery_photo`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `albumId` int(11) NOT NULL,
  `namaAlbum` varchar(255) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `tanggalDibuat` date DEFAULT NULL,
  `userId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`albumId`, `namaAlbum`, `deskripsi`, `tanggalDibuat`, `userId`) VALUES
(1, 'Default', 'Lorem Ipsum Dolot Siamet', '2024-10-30', 2),
(2, 'Pemandangan', 'Lorem', NULL, 1),
(3, 'Artistik', '-', '2024-11-08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `foto`
--

CREATE TABLE `foto` (
  `fotoID` int(11) NOT NULL,
  `judulFoto` varchar(255) DEFAULT NULL,
  `deskripsiFoto` text DEFAULT NULL,
  `tanggalUnggah` date DEFAULT NULL,
  `lokasiFile` varchar(255) DEFAULT NULL,
  `albumId` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `foto`
--

INSERT INTO `foto` (`fotoID`, `judulFoto`, `deskripsiFoto`, `tanggalUnggah`, `lokasiFile`, `albumId`, `userId`) VALUES
(7, 'Pemadangan', 'Lorem Ipsum', '2024-11-04', '525-Rancho_Cucamonga_Tree_6K.png', 1, 3),
(10, 'Bunga', 'Bunga ialah tumbuhan', '2024-11-06', '636-63308407d88be3e9ec588dbf246448df.jpg', 1, 2),
(16, 'Matahari', 'MAntap bngt', '2024-11-06', '589-d650bdf45e73596a80a413297f6deba1.jpg', 1, 2),
(21, 'Pemandangan', 'Sangat indah dengan aliran sungai yang jernih', '2024-11-08', '377-20130d96442b00c5bccffdb250a25c93.jpg', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `komentarfoto`
--

CREATE TABLE `komentarfoto` (
  `KomentarID` int(11) NOT NULL,
  `FotoID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `IsiKomentar` text DEFAULT NULL,
  `TanggalKomentar` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komentarfoto`
--

INSERT INTO `komentarfoto` (`KomentarID`, `FotoID`, `UserID`, `IsiKomentar`, `TanggalKomentar`) VALUES
(5, 10, NULL, 'assalamualaikum', '2024-11-07'),
(8, 16, NULL, 'hohoo', '2024-11-07'),
(9, 7, NULL, 'jyfv', '2024-11-07'),
(10, 10, NULL, 'hi', '2024-11-07'),
(12, 7, NULL, 'haii', '2024-11-07'),
(13, 10, NULL, 'indah nyaa', '2024-11-07');

-- --------------------------------------------------------

--
-- Table structure for table `likefoto`
--

CREATE TABLE `likefoto` (
  `LikeID` int(11) NOT NULL,
  `FotoID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `TanggalLike` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likefoto`
--

INSERT INTO `likefoto` (`LikeID`, `FotoID`, `UserID`, `TanggalLike`) VALUES
(14, 10, NULL, '2024-11-07'),
(15, 10, NULL, '2024-11-07'),
(16, 16, NULL, '2024-11-07'),
(17, 7, NULL, '2024-11-07'),
(18, 7, NULL, '2024-11-07');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `namaLengkap` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `username`, `password`, `email`, `namaLengkap`, `alamat`, `level`, `created_at`) VALUES
(1, 'admin', '25d55ad283aa400af464c76d713c07ad', 'admin@gmail', 'admin', 'Jl. Percobaan No. 65 Cileunyi', 'admin', NULL),
(2, 'mey', 'e10adc3949ba59abbe56e057f20f883e', 'mey@gmail.com', 'Mey', 'Bandung', 'user', NULL),
(3, 'zaqiah', '25d55ad283aa400af464c76d713c07ad', 'zaqiah@gmail.com', 'zaqiah khurul', 'jatinangor', 'user', NULL);

--
-- Triggers `user`
--
DELIMITER $$
CREATE TRIGGER `del_foto` AFTER DELETE ON `user` FOR EACH ROW DELETE FROM foto WHERE userId = OLD.userId
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`albumId`);

--
-- Indexes for table `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`fotoID`);

--
-- Indexes for table `komentarfoto`
--
ALTER TABLE `komentarfoto`
  ADD PRIMARY KEY (`KomentarID`);

--
-- Indexes for table `likefoto`
--
ALTER TABLE `likefoto`
  ADD PRIMARY KEY (`LikeID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `albumId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `fotoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `komentarfoto`
--
ALTER TABLE `komentarfoto`
  MODIFY `KomentarID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `likefoto`
--
ALTER TABLE `likefoto`
  MODIFY `LikeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
