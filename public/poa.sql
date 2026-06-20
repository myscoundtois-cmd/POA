-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 20, 2026 at 10:34 AM
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
(1, 'Toto Iswanto', '12739817389123', 'Laki-laki', 'jl. yuk', '2009-02-28', '', '1779977472_e482bb68cc075bd1e41e.png', 'itoto1937@', 1),
(2, 'Ivana Mayada', '238293840234', 'Laki-laki', 'jl. bro', '2009-02-28', '8B', '1779791740_6fa1a5e1c10fc6c9fd8e.jpg', 'ivana@ngan', 2),
(3, 'Anindia Fayza J', '2398402938432', 'Laki-laki', 'JL.DLU', '2009-02-28', '8B', '1779792158_1d2f1056fdc53a592a89.jpeg', 'anin@gmail', 3),
(4, 'Inul Santika', '2398402938432', 'Laki-laki', 'jl. yuk', '2009-02-28', '', '1779792450_86ab19b4d41222bba16b.jpg', 'inulS@gmai', 4);

-- --------------------------------------------------------

--
-- Table structure for table `jawabansiswa`
--

CREATE TABLE `jawabansiswa` (
  `id_jawaban` int NOT NULL,
  `id_mapel` int NOT NULL,
  `pertemuan` varchar(100) NOT NULL,
  `id_user` int NOT NULL,
  `nama_siswa` varchar(10) NOT NULL,
  `jawaban` text NOT NULL,
  `nilai` int NOT NULL,
  `create_at` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jawabansiswa`
--

INSERT INTO `jawabansiswa` (`id_jawaban`, `id_mapel`, `pertemuan`, `id_user`, `nama_siswa`, `jawaban`, `nilai`, `create_at`) VALUES
(1, 1, '1', 1, 'Toto Iswan', '1.[sdsada],2.[asdasd],3.[asdasd]', 33, 2026),
(2, 1, '1', 3, 'Anindia Fa', '1.[asdasd],2.[asdasd],3.[3434]', 67, 2026);

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
(1, 'B. Indonesia', 'IX', 'Ivana Mayada', '2026-06-03 23:53:09'),
(2, 'Matematika', 'VIII', 'Ivana Mayada', '2026-06-04 00:31:09');

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
(1, 1, 'B. Indonesia', 'Ivana Mayada', '20260603/1780530812_364a4659095303bcf9b7.pdf', 'IX', '1', '2026-06-03 23:53:32'),
(2, 1, 'B. Indonesia', 'Ivana Mayada', '20260603/1780531018_d48eec56cea9f373d535.pdf', 'IX', '2', '2026-06-03 23:56:58'),
(3, 2, 'Matematika', 'Ivana Mayada', '20260604/1780533084_4554000b60c8f1440e04.pdf', 'VIII', '1', '2026-06-04 00:31:24'),
(4, 2, 'Matematika', 'Ivana Mayada', '20260617/1781721647_fdf585665bf0631070b5.pdf', 'VIII', '2', '2026-06-17 18:40:47');

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE `soal` (
  `id_soal` int NOT NULL,
  `id_mapel` int DEFAULT NULL,
  `pertemuan` int NOT NULL,
  `pertanyaan` text,
  `opsi_a` text,
  `opsi_b` text,
  `opsi_c` text,
  `opsi_d` text,
  `kunci` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id_soal`, `id_mapel`, `pertemuan`, `pertanyaan`, `opsi_a`, `opsi_b`, `opsi_c`, `opsi_d`, `kunci`, `gambar`) VALUES
(1, 1, 1, 'asadasda', NULL, NULL, NULL, NULL, NULL, '1781723715_911779ee84a7e49a1059.jpg'),
(2, 1, 1, 'asdasd', NULL, NULL, NULL, NULL, NULL, ''),
(3, 1, 1, 'asdasdas', NULL, NULL, NULL, NULL, NULL, '1781723715_d99491bc29b486050adc.png');

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
(1, 1, 'Sejarah Indonesia', 1, 'esai', 34);

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
-- Indexes for table `jawabansiswa`
--
ALTER TABLE `jawabansiswa`
  ADD PRIMARY KEY (`id_jawaban`);

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
-- AUTO_INCREMENT for table `jawabansiswa`
--
ALTER TABLE `jawabansiswa`
  MODIFY `id_jawaban` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id_mapel` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id_materi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `id_soal` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tugasuji`
--
ALTER TABLE `tugasuji`
  MODIFY `id_tugas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
