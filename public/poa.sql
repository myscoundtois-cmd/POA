-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 03, 2026 at 05:45 PM
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
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `id_mapel` int NOT NULL,
  `nama_mapel` varchar(30) NOT NULL,
  `kelas` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`id_mapel`, `nama_mapel`, `kelas`, `created_by`, `created_at`) VALUES
(1, 'Bahasa Inggris', 'VIII', 'Ivana Mayada', '2026-06-02 08:01:55'),
(2, 'Bahasa Indonesia', 'VIII', 'Ivana Mayada', '2026-06-02 09:29:04'),
(3, 'Matematika', 'VII', 'Ivana Mayada', '2026-06-02 09:46:13');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id_materi` int NOT NULL,
  `id_mapel` int NOT NULL,
  `nama_mapel` varchar(50) NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `file_mapel` varchar(255) NOT NULL,
  `kelas` varchar(30) NOT NULL,
  `pertemuan` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id_materi`, `id_mapel`, `nama_mapel`, `created_by`, `file_mapel`, `kelas`, `pertemuan`, `created_at`) VALUES
(1, 1, 'Bahasa Inggris', 'Ivana Mayada', '20260602/1780387527_bd3e882604e95d9badab.pdf', 'VIII', '1', '2026-06-02 08:05:27'),
(2, 1, 'Bahasa Inggris', 'Ivana Mayada', '20260602/1780393228_693362be7d388a9b75ad.pdf', 'VIII', '2', '2026-06-02 09:40:28'),
(3, 2, 'Bahasa Indonesia', 'Ivana Mayada', '20260603/1780503997_2e40cb6321a980f98382.pdf', 'VIII', '1', '2026-06-03 16:26:37');

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE `soal` (
  `id_soal` int NOT NULL,
  `id_ujian` int DEFAULT NULL,
  `pertanyaan` text,
  `opsi_a` text,
  `opsi_b` text,
  `opsi_c` text,
  `opsi_d` text,
  `jawaban_benar` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tugasuji`
--

CREATE TABLE `tugasuji` (
  `id_tugas` int NOT NULL,
  `id_mapel` int DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `pertemuan` int DEFAULT NULL,
  `tipe_soal` varchar(20) DEFAULT NULL,
  `durasi` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tugasuji`
--

INSERT INTO `tugasuji` (`id_tugas`, `id_mapel`, `judul`, `pertemuan`, `tipe_soal`, `durasi`) VALUES
(1, 2, 'SURAT IZIN KERAMAYAN', 1, 'pg', 30),
(2, 2, 'Perancangan sistem Judi Online pada Era Ddigital', 1, 'pg', 28),
(3, 1, 'SURAT KETERANGAN TIDAK MAMPU', 1, 'pg', 19),
(4, 2, 'Perancangan sistem Judi Online pada Era Ddigital', 1, 'pg', 2),
(5, 1, 'SURAT IZIN KERAMAYAN', 1, 'pg', 32),
(6, 0, 'SURAT PENGANTAR IZIN KERAMAIAN', 3, 'pg', 23);

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
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id_materi`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id_soal`);

--
-- Indexes for table `tugasuji`
--
ALTER TABLE `tugasuji`
  ADD PRIMARY KEY (`id_tugas`);

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
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id_mapel` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id_materi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `id_soal` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tugasuji`
--
ALTER TABLE `tugasuji`
  MODIFY `id_tugas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
