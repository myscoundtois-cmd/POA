-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 29, 2026 at 10:00 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poa`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_user`
--

CREATE TABLE `data_user` (
  `id_dataUser` int NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nis` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `alamat` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tgl_lahir` varchar(50) NOT NULL,
  `kelas` varchar(25) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `email` varchar(10) NOT NULL,
  `id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `data_user`
--

INSERT INTO `data_user` (`id_dataUser`, `nama`, `nis`, `jenis_kelamin`, `alamat`, `tgl_lahir`, `kelas`, `foto`, `email`, `id_user`) VALUES
(1, 'Toto Iswanto', '12739817389123', 'Laki-laki', 'jl. yuk', '2009-02-28', '11B', '1779977472_e482bb68cc075bd1e41e.png', 'itoto1937@', 1),
(2, 'Ivana Mayada', '', 'Laki-laki', '', '', '', '1779791740_6fa1a5e1c10fc6c9fd8e.jpg', 'ivana@ngan', 2),
(3, 'Anindia Fayza J', '', 'Laki-laki', '', '', '', '1779792158_1d2f1056fdc53a592a89.jpeg', 'anin@gmail', 3),
(4, 'Inul Santika', '', 'Laki-laki', '', '', '', '1779792450_86ab19b4d41222bba16b.jpg', 'inulS@gmai', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `email`, `password`, `password_hash`, `role`) VALUES
(1, 'itoto1937@gmail.com', 'rastaman23', '$2y$12$qld0EICVkPwdTIW1286ThufCB10wCuZB7TB1II6Sr7uXQ1mH28p2.', 'admin'),
(2, 'ivana@ngantuk.com', 'qwer1234', '$2y$12$T7WMmkyp9/IJDCGrmzsNKel/yRrCYx/5XXkdF1EFShPqdPi9rtBke', 'guru'),
(3, 'anin@gmail.com', 'qwer1234', '$2y$12$85jGli90aH6T3Vb/O/mHpeh3.CX.P10GssC72cVqru59HQEfcu1aO', 'murid'),
(4, 'inulS@gmail.com', 'qwer1234', '$2y$12$a6IuEiu4gl2mVdOlhRH4uOq9b8Rk6jSxwBw6yJ2PLe.TTR7.RBCGW', 'wali');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_user`
--
ALTER TABLE `data_user`
  ADD PRIMARY KEY (`id_dataUser`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_user`
--
ALTER TABLE `data_user`
  MODIFY `id_dataUser` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
