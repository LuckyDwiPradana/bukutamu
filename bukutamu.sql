-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2023 at 08:45 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bukutamu`
--

-- --------------------------------------------------------

--
-- Table structure for table `ttamu`
--

CREATE TABLE `ttamu` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `instansi` varchar(255) NOT NULL,
  `kontak` varchar(20) NOT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ttamu`
--

INSERT INTO `ttamu` (`id`, `nama`, `alamat`, `instansi`, `kontak`, `tanggal`) VALUES
(212, 'aa', 'ccc', 'fff', '3333', '2023-12-06'),
(214, 'bbbb', 'cccc', 'aaaa', '11111', '2023-12-21'),
(215, 'hhooooooooo', 'yyyyyyyy', 'tttttt', '7777777777', '2023-12-21'),
(220, 'a', 'aaa', 'aaa', '1111', '2023-11-01'),
(221, 'aaaa', 'bbbcc', 's', '655565', '2023-12-25'),
(227, 'aaaab', 'aaaaq', 'aaa', '111', '2023-12-26'),
(228, 'eee', 'rrr', 'dddddd', '23344', '2023-12-26'),
(229, 'aaaa', 'wwww', 'www', '1111', '2023-12-26'),
(230, 'aaaa', 'sssssrfeeeeeee', 'eeeeee', '111111', '2023-12-27'),
(231, 'abcdcc', 'sini', 'sana', '0081', '2023-12-27'),
(232, 'aa', 'vv', 'aa', 'ttt', '2023-12-28'),
(233, 'andini', 'pandan', 'sma', '081232222333', '2023-12-29');

-- --------------------------------------------------------

--
-- Table structure for table `tuser`
--

CREATE TABLE `tuser` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tuser`
--

INSERT INTO `tuser` (`id_user`, `username`, `password_hash`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70'),
(3, 'admin1', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tusers`
--

CREATE TABLE `tusers` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tusers`
--

INSERT INTO `tusers` (`id_user`, `username`, `password`) VALUES
(1, 'a', 'a'),
(2, 'admin', 'Admin123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ttamu`
--
ALTER TABLE `ttamu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tuser`
--
ALTER TABLE `tuser`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tusers`
--
ALTER TABLE `tusers`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ttamu`
--
ALTER TABLE `ttamu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=234;

--
-- AUTO_INCREMENT for table `tuser`
--
ALTER TABLE `tuser`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tusers`
--
ALTER TABLE `tusers`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
