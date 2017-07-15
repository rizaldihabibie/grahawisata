-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2017 at 05:18 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grahawisata`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_reservasi`
--

CREATE TABLE `detail_reservasi` (
  `id_detail_rsv` int(11) NOT NULL,
  `id_pesanan` varchar(12) NOT NULL,
  `id_kamar` varchar(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_reservasi`
--

INSERT INTO `detail_reservasi` (`id_detail_rsv`, `id_pesanan`, `id_kamar`, `tanggal`, `deleted_at`) VALUES
(60, 'order_000003', 'kamar_00008', '2017-03-28 14:00:00', NULL),
(61, 'order_000003', 'kamar_00008', '2017-03-29 00:00:00', NULL),
(62, 'order_000003', 'kamar_00008', '2017-03-30 00:00:00', NULL),
(63, 'order_000003', 'kamar_00008', '2017-03-31 12:00:00', NULL),
(64, 'order_000003', 'kamar_00009', '2017-03-28 14:00:00', NULL),
(65, 'order_000003', 'kamar_00009', '2017-03-29 00:00:00', NULL),
(66, 'order_000003', 'kamar_00009', '2017-03-30 00:00:00', NULL),
(67, 'order_000003', 'kamar_00009', '2017-03-31 12:00:00', NULL),
(68, 'order_000003', 'kamar_00010', '2017-03-28 14:00:00', NULL),
(69, 'order_000003', 'kamar_00010', '2017-03-29 00:00:00', NULL),
(70, 'order_000003', 'kamar_00010', '2017-03-30 00:00:00', NULL),
(71, 'order_000003', 'kamar_00010', '2017-03-31 12:00:00', NULL),
(84, 'order_000004', 'kamar_00004', '2017-03-29 14:00:00', NULL),
(85, 'order_000004', 'kamar_00004', '2017-03-30 12:00:00', NULL),
(86, 'order_000005', 'kamar_00001', '2017-03-29 14:00:00', NULL),
(87, 'order_000005', 'kamar_00001', '2017-03-30 12:00:00', NULL),
(88, 'order_000005', 'kamar_00002', '2017-03-29 14:00:00', NULL),
(89, 'order_000005', 'kamar_00002', '2017-03-30 12:00:00', NULL),
(90, 'order_000006', 'kamar_00003', '2017-03-29 14:00:00', NULL),
(91, 'order_000006', 'kamar_00003', '2017-03-30 12:00:00', NULL),
(92, 'order_000007', 'kamar_00008', '2017-04-13 14:00:00', NULL),
(93, 'order_000007', 'kamar_00008', '2017-04-14 12:00:00', NULL),
(94, 'order_000007', 'kamar_00009', '2017-04-13 14:00:00', NULL),
(95, 'order_000007', 'kamar_00009', '2017-04-14 12:00:00', NULL),
(96, 'order_000008', 'kamar_00008', '2017-05-21 14:00:00', NULL),
(97, 'order_000008', 'kamar_00008', '2017-05-22 12:00:00', NULL),
(98, 'order_000008', 'kamar_00009', '2017-05-21 14:00:00', NULL),
(99, 'order_000008', 'kamar_00009', '2017-05-22 12:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id_fasilitas` varchar(14) NOT NULL,
  `nama_fasilitas` varchar(150) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fasilitas`
--

INSERT INTO `fasilitas` (`id_fasilitas`, `nama_fasilitas`, `deleted_at`) VALUES
('fasilitas_0001', '24 desk', NULL),
('fasilitas_0002', 'ac', NULL),
('fasilitas_0003', 'parking', NULL),
('fasilitas_0004', 'tv', NULL),
('fasilitas_0005', 'wifi', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `id_kamar` varchar(11) NOT NULL,
  `id_kelas` varchar(10) NOT NULL,
  `no_kamar` int(8) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id_kamar`, `id_kelas`, `no_kamar`, `deleted_at`) VALUES
('kamar_00001', 'kelas_0001', 1, NULL),
('kamar_00002', 'kelas_0001', 2, NULL),
('kamar_00003', 'kelas_0001', 3, NULL),
('kamar_00004', 'kelas_0002', 1, NULL),
('kamar_00005', 'kelas_0002', 7, NULL),
('kamar_00008', 'kelas_0003', 1, NULL),
('kamar_00009', 'kelas_0003', 2, NULL),
('kamar_00010', 'kelas_0003', 3, NULL),
('kamar_00011', 'kelas_0001', 4, NULL),
('kamar_00012', 'kelas_0001', 5, NULL),
('kamar_00013', 'kelas_0001', 6, NULL),
('kamar_00014', 'kelas_0001', 7, NULL),
('kamar_00015', 'kelas_0002', 8, NULL),
('kamar_00016', 'kelas_0002', 9, NULL),
('kamar_00017', 'kelas_0002', 10, NULL),
('kamar_00018', 'kelas_0003', 4, NULL),
('kamar_00019', 'kelas_0003', 5, NULL),
('kamar_00020', 'kelas_0003', 6, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kelas_kamar`
--

CREATE TABLE `kelas_kamar` (
  `id_kelas` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` varchar(300) DEFAULT NULL,
  `harga` bigint(15) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas_kamar`
--

INSERT INTO `kelas_kamar` (`id_kelas`, `nama`, `deskripsi`, `harga`, `deleted_at`) VALUES
('kelas_0001', 'adelia', NULL, 240000, NULL),
('kelas_0002', 'anggrek', NULL, 325000, NULL),
('kelas_0003', 'Merbabu', NULL, 350000, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(13, '2014_10_12_000000_create_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id_pesanan` varchar(12) NOT NULL,
  `id_pengunjung` varchar(32) NOT NULL,
  `day_start` datetime NOT NULL,
  `day_end` datetime NOT NULL,
  `checkin` datetime DEFAULT NULL,
  `checkout` datetime DEFAULT NULL,
  `kode_promo` varchar(10) DEFAULT NULL,
  `jumlah_hari` int(2) NOT NULL,
  `jumlah_tamu` int(2) NOT NULL,
  `total_harga` bigint(15) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id_pesanan`, `id_pengunjung`, `day_start`, `day_end`, `checkin`, `checkout`, `kode_promo`, `jumlah_hari`, `jumlah_tamu`, `total_harga`, `deleted_at`) VALUES
('order_000001', '3374151405920002', '2017-03-05 14:00:00', '2017-03-12 12:00:00', NULL, NULL, NULL, 7, 2, 240000, NULL),
('order_000002', '3374151405920002', '2017-03-05 14:00:00', '2017-03-12 12:00:00', NULL, NULL, NULL, 7, 2, 240000, NULL),
('order_000003', '154232487412', '2017-03-28 00:00:00', '2017-03-31 00:00:00', NULL, NULL, NULL, 3, 3, 3150000, NULL),
('order_000004', '2354235235', '2017-03-29 00:00:00', '2017-03-30 00:00:00', NULL, NULL, NULL, 1, 1, 325000, NULL),
('order_000005', '242154214215', '2017-03-29 00:00:00', '2017-03-30 00:00:00', NULL, NULL, NULL, 1, 2, 480000, NULL),
('order_000006', '12132154164', '2017-03-29 00:00:00', '2017-03-30 00:00:00', NULL, NULL, NULL, 1, 1, 215000, NULL),
('order_000007', '33741589562', '2017-04-13 00:00:00', '2017-04-14 00:00:00', NULL, NULL, NULL, 1, 2, 700000, NULL),
('order_000008', '317105310592', '2017-05-21 00:00:00', '2017-05-22 00:00:00', NULL, NULL, NULL, 1, 1, 700000, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL DEFAULT '5',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telepon` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'profile_default.jpg',
  `pertanyaan_pemulih` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jawaban_pemulih` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `setting` int(5) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `activated` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  `is_delete` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `username`, `name`, `email`, `role`, `password`, `alamat`, `telepon`, `foto`, `pertanyaan_pemulih`, `jawaban_pemulih`, `setting`, `remember_token`, `created_at`, `updated_at`, `activated`, `is_delete`) VALUES
(1, 'admin', 'admin', 'mangga.raka@yahoo.co.id', 1, '$2y$10$2UVUtWtgY3ODIUaONS0Ue.U5svApcphbrAwmK3XLO3rrseFMnFrie', '', '', 'profile_pic_1.jpeg', '', '', 1, 'uep94BXMOKpDT74Of9pqv3hiDMTihOB8jzRq1AEG919Pj3CsAFWSYNdh0x4n', NULL, '2017-05-31 11:57:06', 'yes', 'no'),
(2, 'aulas', 'aulas', 'aulioromadho07@gmail.com', 3, '$2y$10$T6meUy/AqgqQjDqFxBY9GuUEcVxRtAq8IHez2SlNU7n4xs1SOrbLu', NULL, '085641305000', 'profile_default.jpg', NULL, NULL, 2, '3jFZGj3G1UUMbImY8mDvWAHh8lHYRd9EBdSxggiPUbIfhjXMW12LL0l1tVHN', '2017-05-09 05:42:26', '2017-05-10 17:11:20', 'yes', 'no'),
(3, 'darmin', 'darmin', 'darmin@gmail.com', 4, '$2y$10$liFaP.uL0K1MRo9FsVd0nO/eCc2kDJ04WWBCKC5BbxivHeUZr5shG', NULL, '0314641013', 'profile_default.jpg', NULL, NULL, 3, NULL, '2017-05-10 18:26:53', '2017-05-21 07:14:03', 'yes', 'no'),
(4, 'endah', 'endah', 'endah@gmail.com', 3, '$2y$10$/5J7gaeGmnpdjVZIlaf3z.qn7zkwaRwwIZTYxr8PBp0unZL6RCZL.', NULL, '032136456', 'profile_default.jpg', NULL, NULL, 4, NULL, '2017-05-10 18:27:37', '2017-05-10 18:27:37', 'yes', 'no'),
(5, 'azad riman', 'azadi asva', 'asdasd@gmail.com', 2, '$2y$10$aANpe78eFLMUWiwVlgJ8BOLj2KAJlr7qg/IqCfK7GEehqm8IpZzIW', NULL, '0856215132131', 'profile_default.jpg', NULL, NULL, 5, NULL, '2017-05-21 07:18:33', '2017-05-21 07:18:33', 'yes', 'no'),
(6, 'sadasfasfasf', 'sazam', 'sazam@gmail.com', 1, '$2y$10$HcXLjlNa2nRAk8j050iE4.k/kVKwTe3V8yM3U.R8zTHmFFWEvIaoi', NULL, '0856121212321', 'profile_default.jpg', NULL, NULL, 9, NULL, '2017-05-24 01:04:09', '2017-05-24 01:04:09', 'yes', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `pengunjung`
--

CREATE TABLE `pengunjung` (
  `id_pengunjung` varchar(32) NOT NULL,
  `nama` text NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengunjung`
--

INSERT INTO `pengunjung` (`id_pengunjung`, `nama`, `telepon`, `alamat`, `deleted_at`) VALUES
('12132154164', 'adelia', '02445465498', 'sfasfafsasfafs', NULL),
('154232487412', 'aulio', '08156423325', 'asfasfasfafsgas', NULL),
('2354235235', 'Dony', '0813213213', 'asfafsasfasf', NULL),
('242154214215', 'ajeng', '08131321319', 'asfasagsasgags', NULL),
('317105310592', 'suud', '08129581551', 'jakarta', NULL),
('3374151405920002', 'manggala raka perkasa', '085641305000', 'Jl. Watuwila 1 Blok EIII no 14', NULL),
('3374151405920005', 'Dwen', '05622156651', 'Jl Bangka', NULL),
('3374151405920009', 'Rosalita AP', '085641173050', 'Jl. Nongko Sawit', NULL),
('3374151405920124', 'Ferjaki', '0816310321', 'Jl Boom', NULL),
('3374151405921234', 'Don Juan', '092365735132', 'Jl Elpistoro', NULL),
('33741589562', 'Angga', '0812562320', 'Jl. Hasanudi 43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

CREATE TABLE `promo` (
  `kode_promo` varchar(25) NOT NULL,
  `promo_setting` enum('by_percent','by_money') NOT NULL,
  `promo_value` varchar(300) NOT NULL,
  `discount_max` bigint(15) NOT NULL,
  `price_min` bigint(15) NOT NULL,
  `keterangan` varchar(300) DEFAULT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promo`
--

INSERT INTO `promo` (`kode_promo`, `promo_setting`, `promo_value`, `discount_max`, `price_min`, `keterangan`, `start`, `end`, `deleted_at`) VALUES
('DiskonHore10', 'by_money', '25000', 25000, 100000, 'tidak ada', '2017-03-29', '2017-03-31', NULL),
('Lebaran15', 'by_money', '125000', 125000, 1000000, NULL, '2017-02-09', '2017-03-30', NULL),
('MudikLebaran2017', 'by_percent', '20', 150000, 1000000, NULL, '2017-03-01', '2017-03-31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `relasi_fasilitas`
--

CREATE TABLE `relasi_fasilitas` (
  `id_relasi_fasilitas` int(17) NOT NULL,
  `id_kelas` varchar(10) NOT NULL,
  `id_fasilitas` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `relasi_fasilitas`
--

INSERT INTO `relasi_fasilitas` (`id_relasi_fasilitas`, `id_kelas`, `id_fasilitas`) VALUES
(4, 'kelas_0002', 'fasilitas_0002'),
(5, 'kelas_0002', 'fasilitas_0003'),
(6, 'kelas_0002', 'fasilitas_0004'),
(7, 'kelas_0002', 'fasilitas_0005'),
(11, 'kelas_0003', 'fasilitas_0001'),
(12, 'kelas_0003', 'fasilitas_0002'),
(13, 'kelas_0003', 'fasilitas_0003'),
(14, 'kelas_0003', 'fasilitas_0004'),
(15, 'kelas_0003', 'fasilitas_0005'),
(24, 'kelas_0001', 'fasilitas_0005'),
(26, 'kelas_0001', 'fasilitas_0004'),
(31, 'kelas_0001', 'fasilitas_0003');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id_role` int(11) NOT NULL,
  `privilege` enum('admin','manajer','receptionist','staff','user-default') NOT NULL,
  `deskripsi` varchar(200) DEFAULT NULL,
  `gaji` bigint(20) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id_role`, `privilege`, `deskripsi`, `gaji`, `deleted_at`) VALUES
(1, 'admin', NULL, 0, NULL),
(2, 'manajer', NULL, 2500000, NULL),
(3, 'receptionist', NULL, 1500000, NULL),
(4, 'staff', NULL, 1000000, NULL),
(5, 'user-default', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id_setting` int(11) NOT NULL,
  `app_theme` varchar(100) NOT NULL DEFAULT 'theme-default.css',
  `app_layout` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id_setting`, `app_theme`, `app_layout`) VALUES
(1, 'theme-default.css', 'page-container-boxed'),
(2, 'theme-default.css', NULL),
(3, 'theme-default.css', NULL),
(4, 'theme-default.css', NULL),
(5, 'theme-default.css', NULL),
(9, 'theme-default.css', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `privilege` enum('admin','owner','manajer','receptionist','default') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `privilege`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'manggala', 'manggalaraka@gmail.com', '$2y$10$/rUWYizldM7SNxYQ1wSyje9PPDHpw960aqds3cMq5jKbXaNzD1NE2', 'admin', 'o1KSBSOMdQkEcX8MH5hfmHALfMTogUMjw7FiRTna22zmynUBp3oSJiQO1Zec', '2017-01-31 10:24:38', '2017-01-31 10:24:38'),
(3, 'suut', 'suut@gmail.com', '$2y$10$qHBugeJ2/3LmlF1xEtpxXeGtREP4JMymfm.ZEibu0mKl4kIUCvvdS', 'admin', 'l9JGjlqjTGTenyLdQYktgMOwMNU18Whnz4AHnbfq4zpFslDJ4S33tFit7As8', '2017-01-31 21:51:03', '2017-01-31 21:51:03'),
(4, 'babalo', 'babalo@gmail.com', '$2y$10$ONJqNvpzekguQRm6dXS/4ekMakutbTz8FUljpGELGL0aQoCmrAcj6', 'admin', 'XAN1rwKsDGMYKShbx7NGXblfb8BqbI9YHNDn98VEXhyvxutxNyoaHsDBLpdS', '2017-01-31 22:07:13', '2017-01-31 22:07:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_reservasi`
--
ALTER TABLE `detail_reservasi`
  ADD PRIMARY KEY (`id_detail_rsv`);

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id_fasilitas`),
  ADD UNIQUE KEY `nama_fasilitas` (`nama_fasilitas`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id_kamar`);

--
-- Indexes for table `kelas_kamar`
--
ALTER TABLE `kelas_kamar`
  ADD PRIMARY KEY (`id_kelas`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pengguna_name_unique` (`name`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `pengunjung`
--
ALTER TABLE `pengunjung`
  ADD PRIMARY KEY (`id_pengunjung`);

--
-- Indexes for table `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`kode_promo`);

--
-- Indexes for table `relasi_fasilitas`
--
ALTER TABLE `relasi_fasilitas`
  ADD PRIMARY KEY (`id_relasi_fasilitas`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_reservasi`
--
ALTER TABLE `detail_reservasi`
  MODIFY `id_detail_rsv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `relasi_fasilitas`
--
ALTER TABLE `relasi_fasilitas`
  MODIFY `id_relasi_fasilitas` int(17) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
