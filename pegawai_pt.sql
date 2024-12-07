-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 30, 2024 at 06:50 PM
-- Server version: 11.4.2-MariaDB-log
-- PHP Version: 8.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pegawai_pt`
--
CREATE DATABASE IF NOT EXISTS `pegawai_pt` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `pegawai_pt`;

-- --------------------------------------------------------

--
-- Table structure for table `acara`
--

DROP TABLE IF EXISTS `acara`;
CREATE TABLE `acara` (
  `id` int(11) NOT NULL,
  `name` varchar(500) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `tanggal_acara` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

DROP TABLE IF EXISTS `auth`;
CREATE TABLE `auth` (
  `id` int(11) NOT NULL,
  `name` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_karyawan`
--

DROP TABLE IF EXISTS `data_karyawan`;
CREATE TABLE `data_karyawan` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `pendidikan_terakhir` varchar(50) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `status` enum('Aktif','Pensiun','Pindah Dinas','PHK') DEFAULT 'Aktif',
  `tanggal_masuk` date DEFAULT NULL,
  `tanggal_keluar` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `keterangan_cuti` text DEFAULT NULL,
  `total_cuti` int(11) DEFAULT 14,
  `sisa_cuti` int(11) DEFAULT 14,
  `tahun_cuti` int(4) DEFAULT year(curdate()),
  `cuti_diambil` int(11) DEFAULT 0,
  `tanggal_mulai_cuti` date NOT NULL,
  `tanggal_cuti_terakhir` date DEFAULT NULL,
  `status_cuti` enum('Sedang Cuti') DEFAULT NULL,
  `foto_profil` varchar(255) DEFAULT NULL,
  `golongan_terakhir` varchar(255) DEFAULT NULL,
  `jabatan_terakhir` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `golongan`
--

DROP TABLE IF EXISTS `golongan`;
CREATE TABLE `golongan` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `histori_cuti`
--

DROP TABLE IF EXISTS `histori_cuti`;
CREATE TABLE `histori_cuti` (
  `id` int(10) UNSIGNED NOT NULL,
  `karyawan_id` int(10) UNSIGNED NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `jumlah_hari` int(11) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `tahun_cuti` int(4) DEFAULT year(curdate()),
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instruksi_pimpinan`
--

DROP TABLE IF EXISTS `instruksi_pimpinan`;
CREATE TABLE `instruksi_pimpinan` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal_acara` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

DROP TABLE IF EXISTS `jabatan`;
CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `name`) VALUES
(4, 'A'),
(5, 'B'),
(6, 'C'),
(7, '-');

-- --------------------------------------------------------

--
-- Table structure for table `nomor_dibatalkan`
--

DROP TABLE IF EXISTS `nomor_dibatalkan`;
CREATE TABLE `nomor_dibatalkan` (
  `id` int(11) NOT NULL,
  `nomor_surat` int(11) NOT NULL,
  `alasan_dibatalkan` text NOT NULL,
  `tanggal_dibatalkan` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nomor_surat`
--

DROP TABLE IF EXISTS `nomor_surat`;
CREATE TABLE `nomor_surat` (
  `id` int(11) NOT NULL,
  `nomor` int(11) NOT NULL,
  `kepada` text NOT NULL,
  `tembusan` text NOT NULL,
  `tahun` int(11) NOT NULL,
  `tanggal_keluar` date DEFAULT NULL,
  `status` enum('dikeluarkan','dibatalkan') NOT NULL,
  `perihal` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `nomor_surat`
--

INSERT INTO `nomor_surat` (`id`, `nomor`, `kepada`, `tembusan`, `tahun`, `tanggal_keluar`, `status`, `perihal`, `created_at`, `updated_at`) VALUES
(14, 1, 'yth', 'as', 2024, '2024-11-20', 'dikeluarkan', 'hh', '2024-11-19 17:08:22', '2024-11-19 17:08:22');

-- --------------------------------------------------------

--
-- Table structure for table `surat`
--

DROP TABLE IF EXISTS `surat`;
CREATE TABLE `surat` (
  `id` int(11) NOT NULL,
  `nomor_surat` int(11) NOT NULL,
  `kepada` varchar(255) NOT NULL,
  `tembusan` text NOT NULL,
  `tahun` year(4) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `status` enum('terbit','dibatalkan') DEFAULT 'terbit',
  `alasan_dibatalkan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `surat`
--

INSERT INTO `surat` (`id`, `nomor_surat`, `kepada`, `tembusan`, `tahun`, `tanggal_keluar`, `perihal`, `status`, `alasan_dibatalkan`, `created_at`, `updated_at`) VALUES
(1, 1, 'asa', 'asa', '2024', '2024-11-02', 'asa', 'terbit', NULL, '2024-11-19 17:15:01', '2024-11-19 17:15:01');

-- --------------------------------------------------------

--
-- Table structure for table `tampilan`
--

DROP TABLE IF EXISTS `tampilan`;
CREATE TABLE `tampilan` (
  `id` int(11) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tampilan`
--

INSERT INTO `tampilan` (`id`, `deskripsi`) VALUES
(14, '<p><i>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque debitis numquam architecto quasi ab facilis ipsa officia id, natus quas amet corrupti quisquam qui, ratione pariatur sapiente perferendis impedit ex!1223</i></p>');

-- --------------------------------------------------------

--
-- Table structure for table `upacara`
--

DROP TABLE IF EXISTS `upacara`;
CREATE TABLE `upacara` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal_acara` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `nip` varchar(150) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','super_admin') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `jenis_kelamin`, `nip`, `username`, `password`, `role`, `created_at`) VALUES
(27, 'Rudi Rusbandi', 'Laki-laki', 'admin', 'Gilang', '$2y$10$KXC5yGlqMm2Ud2B.5APvsebTsfXihU3SJ4RKjHVsozjOofNMjLkcq', 'super_admin', '2024-10-14 17:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acara`
--
ALTER TABLE `acara`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_karyawan`
--
ALTER TABLE `data_karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `golongan`
--
ALTER TABLE `golongan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `histori_cuti`
--
ALTER TABLE `histori_cuti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `karyawan_id` (`karyawan_id`);

--
-- Indexes for table `instruksi_pimpinan`
--
ALTER TABLE `instruksi_pimpinan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nomor_dibatalkan`
--
ALTER TABLE `nomor_dibatalkan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nomor_surat`
--
ALTER TABLE `nomor_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tampilan`
--
ALTER TABLE `tampilan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upacara`
--
ALTER TABLE `upacara`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acara`
--
ALTER TABLE `acara`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `auth`
--
ALTER TABLE `auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_karyawan`
--
ALTER TABLE `data_karyawan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `golongan`
--
ALTER TABLE `golongan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `histori_cuti`
--
ALTER TABLE `histori_cuti`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `instruksi_pimpinan`
--
ALTER TABLE `instruksi_pimpinan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `nomor_dibatalkan`
--
ALTER TABLE `nomor_dibatalkan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nomor_surat`
--
ALTER TABLE `nomor_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `surat`
--
ALTER TABLE `surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tampilan`
--
ALTER TABLE `tampilan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `upacara`
--
ALTER TABLE `upacara`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `histori_cuti`
--
ALTER TABLE `histori_cuti`
  ADD CONSTRAINT `histori_cuti_ibfk_1` FOREIGN KEY (`karyawan_id`) REFERENCES `data_karyawan` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
