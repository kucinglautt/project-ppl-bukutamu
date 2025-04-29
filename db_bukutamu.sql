-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2025 at 07:28 PM
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
-- Database: `db_bukutamu`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `detail` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `username`, `action`, `detail`, `ip_address`, `user_agent`, `created_at`) VALUES
(1, 1, 'admin', 'Login', 'Login berhasil', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-30 00:02:49'),
(2, 1, 'admin', 'Login', 'Login berhasil', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-30 00:09:59'),
(3, 1, 'admin', 'Login', 'Login berhasil', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-30 00:22:42'),
(4, 1, 'admin', 'Login', 'Login Gagal, Password Salah', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-30 00:22:54'),
(5, 1, 'admin', 'Login', 'Login Gagal, Username Salah', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-30 00:22:58'),
(6, 1, 'admin', 'Login', 'Login berhasil', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-30 00:23:00'),
(7, 1, 'admin', 'View', 'Berhasil Melihat Statistik', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-30 00:26:36'),
(8, 1, 'admin', 'View', 'Berhasil Melihat Statistik', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-30 00:26:40'),
(9, 1, 'admin', 'View', 'Berhasil Melihat Statistik', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-30 00:26:47'),
(10, 1, 'admin', 'View', 'Berhasil Melihat Statistik', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-30 00:27:14'),
(11, 1, 'admin', 'Login', 'Login berhasil', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-30 00:30:20'),
(12, 1, 'admin', 'View', 'Berhasil Melihat Statistik', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-30 00:30:42'),
(13, 1, 'admin', 'View', 'Berhasil Melihat Statistik', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-30 00:30:58'),
(14, 1, 'admin', 'View', 'Berhasil Melihat Statistik', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-30 00:31:32'),
(15, 1, 'admin', 'Export PDF Riwayat Tamu', 'Admin Mengekspor Riwayat Tamu ke PDF.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-30 01:00:55'),
(16, 1, 'admin', 'Login', 'Login berhasil', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-30 01:01:32'),
(17, 2, 'petugas', 'Login', 'Login berhasil', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-30 01:02:59'),
(18, 1, 'admin', 'Login', 'Login berhasil', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-30 01:03:09'),
(19, 1, 'admin', 'Login', 'Login berhasil', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-30 01:05:30'),
(20, 2, 'petugas', 'Login', 'Login berhasil', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-30 01:06:00'),
(21, 2, 'petugas', 'Logout', 'Logout berhasil', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-30 01:07:58'),
(22, 1, 'admin', 'Login', 'Login berhasil', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-30 01:08:02'),
(23, 1, 'admin', 'View', 'Admin Berhasil Melihat Statistik', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-30 01:08:49'),
(24, 1, 'admin', 'Ganti Password', 'Ganti Password Berhasil', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-30 01:09:28'),
(25, 1, 'admin', 'Ganti Password', 'Ganti Password Berhasil', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-30 01:09:52'),
(26, 1, 'admin', 'Login', 'Login berhasil', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-30 01:10:03'),
(27, 1, 'admin', 'Logout', 'Logout berhasil', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-30 01:11:17');

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `institution` varchar(100) DEFAULT NULL,
  `purpose` text DEFAULT NULL,
  `phone_number` varchar(12) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`id`, `name`, `institution`, `purpose`, `phone_number`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'john doe', 'sma 10 jakarta', 'konsultasi', '089999999999', '2025-04-27 01:29:25', NULL, NULL),
(2, 'fulan', 'sd 8 jakarta', 'konsultasi', '085200000000', '2025-04-27 11:12:28', NULL, NULL),
(3, 'aaaaaaaaa', 'sssssssssssss', 'dddddddddd', '111111111111', '2025-04-27 11:18:31', NULL, NULL),
(4, 'john valorant', 'riot dev', 'bug fixing', '', '2025-04-28 07:21:58', NULL, NULL),
(5, 'aaaaaaaaaa', 'aaaaaaaaaaa', 'aaaaaaaaaaa', '', '2025-04-28 07:44:45', NULL, NULL),
(6, 'bbbbbbbbbbbb', 'bbbbbbbbbbb', 'bbbbbbbbbbb', '', '2025-04-28 07:45:32', NULL, NULL),
(7, 'wwwwwwww', 'wwwwwwwww', 'wwwwwwwwwwww', '', '2025-04-28 07:52:14', NULL, NULL),
(8, 'qqqqqqq', 'qqqqqqq', 'qqqqqqqqqqqq', '', '2025-04-29 07:52:24', NULL, NULL),
(9, 'john val', 'riot dev', 'agent design', '085200000000', '2025-04-28 09:00:12', '2025-04-28 09:00:12', NULL),
(10, 'john pork', 'goon academy', 'goon', '085233121234', '2025-04-29 09:39:49', '2025-04-29 09:39:49', NULL),
(11, 'aaaaaa', 'aaaaaaaaaa', 'aaaaaaaaaaaaaa', '', '2025-04-29 09:40:21', '2025-04-29 09:40:21', NULL),
(12, 'aaaaaaaaaaa', 'aaaaaaaaaaaa', 'aaaaaaaaaaa', '', '2025-04-29 09:45:52', '2025-04-29 09:45:52', NULL),
(13, 'aaaaaaaaaaa', 'aaaaaaaaaaaa', 'aaaaaaaaaaa', '', '2025-04-29 09:46:33', '2025-04-29 09:46:33', NULL),
(14, 'aaassssssssssssss', 'ssssssssssss', 'sssssssssssssssssss', '', '2025-04-28 09:46:42', '2025-04-28 09:46:42', NULL),
(15, 'wwwwwwwwwwwwwwww', 'wwwwwwwwwwwwwww', 'wwwwwwwwwwwwwwwww', '111111111', '2025-04-28 09:47:07', '2025-04-28 09:47:07', NULL),
(16, 'rrrrrrrrrr', 'rrrrrrrrr', 'rrrrrrrrrrrrr', '', '2025-04-28 09:51:52', '2025-04-28 09:51:52', NULL),
(17, 'ttttttttttt', 'ttttttttttttttt', 'ttttttttttttttt', '', '2025-04-28 09:57:55', '2025-04-28 09:57:55', NULL),
(18, 'aaaaaaaaaa', 'aassssssssss', 'ssssssddddddddd', '', '2025-05-04 10:43:04', '0000-00-00 00:00:00', NULL),
(19, 'aaaaaaaa', 'aaaaaaaa', 'aaaaaaaaaaaaaa', '', '2025-04-28 23:46:29', '2025-04-28 23:46:29', NULL),
(20, 'qqqqqq', 'qqqqqqqqq', 'qqqqqqqqqqqq', '', '2025-04-29 10:57:21', '2025-04-29 10:57:21', NULL),
(21, 'llllllll', 'lllllllll', 'llllllllll', '', '2025-04-29 10:58:10', '2025-04-29 10:58:10', NULL),
(22, 'rrrrrr', 'rrrrrrrrrrrrrr', 'rrrrrr', '', '2025-04-29 07:11:18', '2025-04-29 07:11:18', NULL),
(23, 'john lenon', 'the beatles', 'sings', '085233121233', '2025-04-29 07:29:31', '2025-04-29 07:29:31', NULL),
(24, 'john balatro', 'balatro dev', 'bug fixing', '085233121233', '2025-04-29 07:45:20', '2025-04-29 07:45:20', NULL),
(25, 'john john', 'sma 10 kendari', 'konsultasi', '', '2025-04-29 08:08:29', '2025-04-29 08:08:29', NULL),
(26, 'qqqqqqqqqa', 'aaaaaaaaaaaaaa', 'qqaaaaaaaaaa', '', '2025-04-29 08:45:19', '2025-04-29 08:45:19', NULL),
(27, 'qqqqqqwee', 'eeeeeeeeee', 'eeeeeeeeeeeeee', '', '2025-04-29 10:53:30', '2025-04-29 10:53:30', NULL),
(28, 'sddddddddddddddddddd', 'sdddddddddddddd', 'ddddddddddddsssss', '', '2025-03-29 21:10:06', '2025-03-29 21:10:06', NULL),
(29, 'ffffffffff', 'fffffffffffffff', 'fffffffffffffffffffffffffffff', '', '2025-04-29 21:11:20', '2025-04-29 21:11:20', NULL),
(30, 'ffffffff', 'ffffffffff', 'ffffffffffff', '', '2025-04-29 21:11:31', '2025-04-29 21:11:31', NULL),
(31, 'ggggg', 'ggggggggggg', 'ggggggggggg', '', '2025-04-29 21:12:17', '2025-04-29 21:12:17', NULL),
(32, 'asssssssss', 'sssssdddddddd', 'sddddddddx', '', '2025-04-29 21:26:23', '2025-04-29 21:26:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','petugas') NOT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `is_deleted`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', '$2y$10$coOlAGNoih.4A51c6608x.jeNgdIG3AgwJo3EvB37oaCKetPMx8JK', 'admin', 0, '2025-04-27 09:53:47', '2025-04-30 01:09:52', NULL),
(2, 'petugas', '$2y$10$PS7NHmO0fw.4TmpLmOA7wuesVlEuRgUI1PXWZ0eF0gv3YU9K/GbGS', 'petugas', 0, '2025-04-28 05:17:11', '2025-04-28 23:37:34', NULL),
(3, 'admin2', '$2y$10$j5FGNJi47HPTbRdYOR2EuOIYB56gLHbn7f5uwJxJ/JWx8GkA3o3n2', 'admin', 0, '2025-04-28 06:34:18', NULL, NULL),
(4, 'resepsionis', '$2y$10$1FEaWYld63OOeFibXIFv1uBMUmJ9Tah5RKccO2T4oS84sRC1fBVEy', 'petugas', 0, '2025-04-28 06:34:52', NULL, NULL),
(5, 'resepsionis2', '$2y$10$mZ3lyJw.lqO4lXaf6zVLdevrzb1.QvO/YfoZuHDPtyssNj6E5jIv2', 'petugas', 0, '2025-04-28 06:36:51', '2025-04-28 07:20:25', NULL),
(6, 'madz', '$2y$10$QM6/2edxWuAwXP6S7Uy8s.4sPHwfaUKP3NdXLJFMJadavtmgTOQ1G', 'petugas', 0, '2025-04-29 00:06:47', '2025-04-29 21:26:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE `visits` (
  `id` int(11) NOT NULL,
  `guest_id` int(11) NOT NULL,
  `check_in` datetime DEFAULT current_timestamp(),
  `check_out` datetime DEFAULT NULL,
  `status` enum('hadir','selesai','batal') NOT NULL DEFAULT 'hadir',
  `handled_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visits`
--

INSERT INTO `visits` (`id`, `guest_id`, `check_in`, `check_out`, `status`, `handled_by`) VALUES
(1, 20, '2025-04-29 06:57:21', '2025-04-29 07:29:56', 'selesai', 2),
(2, 21, '2025-04-29 06:58:10', '2025-04-29 07:15:55', 'selesai', NULL),
(3, 22, '2025-04-29 07:11:18', '2025-04-29 07:14:47', 'selesai', 2),
(4, 23, '2025-04-29 07:29:31', '2025-04-29 08:01:03', 'batal', 2),
(5, 24, '2025-04-29 07:45:20', '2025-04-29 07:54:19', 'selesai', 2),
(6, 25, '2025-04-29 08:08:29', '2025-04-29 08:43:18', 'batal', 2),
(7, 26, '2025-04-29 08:45:19', '2025-04-29 08:45:29', 'selesai', 2),
(8, 27, '2025-04-29 10:53:30', NULL, 'hadir', NULL),
(9, 28, '2025-04-29 21:10:06', NULL, 'hadir', 2),
(10, 29, '2025-04-29 21:11:20', NULL, 'hadir', 2),
(11, 30, '2025-04-29 21:11:31', NULL, 'hadir', 2),
(12, 31, '2025-04-29 21:12:17', NULL, 'hadir', NULL),
(13, 32, '2025-04-29 21:26:23', NULL, 'hadir', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_guest_id` (`guest_id`),
  ADD KEY `fk_handled_by` (`handled_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `visits`
--
ALTER TABLE `visits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `visits`
--
ALTER TABLE `visits`
  ADD CONSTRAINT `fk_guest_id` FOREIGN KEY (`guest_id`) REFERENCES `guests` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_handled_by` FOREIGN KEY (`handled_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
