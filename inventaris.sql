-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 03, 2026 at 03:07 AM
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
-- Database: `inventaris`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangs`
--

CREATE TABLE `barangs` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `satuan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stok` int NOT NULL DEFAULT '0',
  `harga` decimal(15,2) NOT NULL DEFAULT '0.00',
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangs`
--

INSERT INTO `barangs` (`id`, `kode_barang`, `nama_barang`, `kategori`, `satuan`, `stok`, `harga`, `deskripsi`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'BRG-1788036239', 'sapu', 'kayu', NULL, 29915, 0.00, NULL, NULL, '2026-08-29 20:43:59', '2026-09-01 07:42:38'),
(2, 'BRG-1788141675', 'polepen', 'atk', NULL, 1000, 0.00, NULL, 'barang/HNaN6HLoDn0gO6Z0ef8C34iAyBJ7hHyePdaPiBk4.jpg', '2026-08-31 02:01:15', '2026-09-01 06:49:12'),
(3, 'BRG-1788230889', 'pensil', 'kayu', NULL, -100, 0.00, NULL, NULL, '2026-09-01 02:48:09', '2026-09-01 06:10:20'),
(4, 'BRG-1788231879', 'buku', 'atk', NULL, 0, 0.00, NULL, NULL, '2026-09-01 03:04:39', '2026-09-01 03:04:39'),
(5, 'BRG-1788235583', 'Akua', 'minuman', NULL, -195, 0.00, 'ini minuman untuk staff', 'barang/fD0yDv3lG1eTr3aLGSgm0QMtlbWOlDRzt6s1AwZg.jpg', '2026-09-01 04:06:24', '2026-09-01 09:27:19'),
(6, 'BRG-1788246146', 'pot bunga', 'sabtd', NULL, 70, 0.00, NULL, 'barang/l4UKpEFNau4VSlE7CmOaEMGRx6o2VjdKyJXCeQFc.jpg', '2026-09-01 07:02:26', '2026-09-01 08:43:48'),
(7, 'BRG-1788250178', 'surat', 'atk', NULL, 0, 0.00, NULL, NULL, '2026-09-01 08:09:38', '2026-09-01 08:09:38'),
(8, 'BRG-1788250191', 'kue', 'makanan', NULL, 0, 0.00, NULL, NULL, '2026-09-01 08:09:51', '2026-09-01 08:09:51'),
(9, 'BRG-1788250213', 'kipas', 'elektronik', NULL, 0, 0.00, NULL, NULL, '2026-09-01 08:10:13', '2026-09-01 08:10:13'),
(10, 'BRG-1788250230', 'mouse', 'perangkat keras', NULL, 0, 0.00, NULL, NULL, '2026-09-01 08:10:30', '2026-09-01 08:10:30'),
(11, 'BRG-1788250241', 'cpu', 'perangkat keras', NULL, 0, 0.00, NULL, NULL, '2026-09-01 08:10:41', '2026-09-01 08:10:41'),
(12, 'BRG-1788250257', 'pc', 'perangkat keras', NULL, 0, 0.00, NULL, NULL, '2026-09-01 08:10:57', '2026-09-01 08:10:57'),
(13, 'BRG-1788250279', 'rak buku', 'perlengkapan', NULL, 0, 0.00, NULL, NULL, '2026-09-01 08:11:19', '2026-09-01 08:11:19'),
(14, 'BRG-1788250300', 'ban mobil', 'otomotif', NULL, 0, 0.00, NULL, NULL, '2026-09-01 08:11:40', '2026-09-01 08:11:40');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksis`
--

CREATE TABLE `detail_transaksis` (
  `id` bigint UNSIGNED NOT NULL,
  `transaksi_id` bigint UNSIGNED NOT NULL,
  `barang_id` bigint UNSIGNED NOT NULL,
  `jumlah` int NOT NULL,
  `harga_satuan` decimal(15,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_transaksis`
--

INSERT INTO `detail_transaksis` (`id`, `transaksi_id`, `barang_id`, `jumlah`, `harga_satuan`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 12, 0.00, '2026-08-29 20:46:33', '2026-08-29 20:46:33'),
(2, 2, 1, 1, 0.00, '2026-09-01 02:45:19', '2026-09-01 02:45:19'),
(3, 3, 2, 2, 0.00, '2026-09-01 03:11:44', '2026-09-01 03:11:44'),
(4, 4, 2, 1, 0.00, '2026-09-01 04:37:02', '2026-09-01 04:37:02'),
(5, 5, 2, 1, 0.00, '2026-09-01 05:23:34', '2026-09-01 05:23:34'),
(6, 6, 1, 1, 0.00, '2026-09-01 05:48:48', '2026-09-01 05:48:48'),
(7, 7, 1, 100, 0.00, '2026-09-01 05:58:15', '2026-09-01 05:58:15'),
(8, 8, 3, 100, 0.00, '2026-09-01 06:10:20', '2026-09-01 06:10:20'),
(9, 9, 2, 1000, 0.00, '2026-09-01 06:27:23', '2026-09-01 06:27:23'),
(10, 10, 2, 2000, 0.00, '2026-09-01 06:49:12', '2026-09-01 06:49:12'),
(11, 11, 1, 30000, 0.00, '2026-09-01 06:50:51', '2026-09-01 06:50:51'),
(12, 12, 6, 99, 0.00, '2026-09-01 07:26:32', '2026-09-01 07:26:32'),
(13, 13, 1, 1, 0.00, '2026-09-01 07:42:38', '2026-09-01 07:42:38'),
(14, 14, 6, 29, 0.00, '2026-09-01 08:43:48', '2026-09-01 08:43:48'),
(15, 15, 5, 195, 0.00, '2026-09-01 09:27:19', '2026-09-01 09:27:19');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2026_08_19_013238_create_items_table', 1),
(6, '2026_08_19_053324_update_items_table_remove_price_image', 1),
(7, '2026_08_24_071133_add_nomor_to_items_table', 2),
(8, '2026_08_24_083655_create_barangs_table', 3),
(9, '2026_08_27_000000_create_settings_table', 4),
(10, '2026_08_29_174111_create_barangs_table', 5),
(11, '2026_08_29_174112_create_detail_transaksis_table', 5),
(12, '2026_08_29_174112_create_transaksis_table', 5),
(13, '2026_08_29_185741_add_role_to_users_table', 6),
(14, '2026_08_29_193233_add_foto_to_barangs_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksis`
--

CREATE TABLE `transaksis` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `kode_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe` enum('masuk','keluar') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksis`
--

INSERT INTO `transaksis` (`id`, `user_id`, `kode_transaksi`, `tipe`, `tanggal`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 'TRX-1788036393', 'masuk', '2026-08-29', '2', '2026-08-29 20:46:33', '2026-09-01 06:47:51'),
(2, 1, 'TRX-1788230719', 'masuk', '2026-09-01', NULL, '2026-09-01 02:45:19', '2026-09-01 06:47:51'),
(3, 1, 'TRX-1788232304', 'masuk', '2026-09-01', NULL, '2026-09-01 03:11:44', '2026-09-01 06:47:51'),
(4, 1, 'TRX-1788237422', 'keluar', '2026-09-01', NULL, '2026-09-01 04:37:02', '2026-09-01 06:47:51'),
(5, 1, 'TRX-1788240214', 'keluar', '2026-09-01', NULL, '2026-09-01 05:23:34', '2026-09-01 06:47:51'),
(6, 1, 'TRX-1788241728', 'masuk', '2003-02-12', NULL, '2026-09-01 05:48:48', '2026-09-01 06:47:51'),
(7, 1, 'TRX-1788242295', 'keluar', '2013-02-12', NULL, '2026-09-01 05:58:15', '2026-09-01 06:47:51'),
(8, 1, 'TRX-1788243020', 'keluar', '2014-02-12', NULL, '2026-09-01 06:10:20', '2026-09-01 06:47:51'),
(9, 1, 'TRX-1788244043', 'keluar', '2002-12-12', 'oke percobaan', '2026-09-01 06:27:23', '2026-09-01 06:47:51'),
(10, 1, 'TRX-1788245352', 'masuk', '2001-09-01', NULL, '2026-09-01 06:49:12', '2026-09-01 06:49:12'),
(11, 1, 'TRX-1788245451', 'masuk', '2000-09-01', NULL, '2026-09-01 06:50:51', '2026-09-01 06:50:51'),
(12, 1, 'TRX-1788247592', 'masuk', '2026-09-01', NULL, '2026-09-01 07:26:32', '2026-09-01 07:26:32'),
(13, 1, 'TRX-1788248558', 'masuk', '2026-09-01', NULL, '2026-09-01 07:42:38', '2026-09-01 07:42:38'),
(14, 1, 'TRX-1788252228', 'keluar', '2026-09-01', NULL, '2026-09-01 08:43:48', '2026-09-01 08:43:48'),
(15, 1, 'TRX-1788254839', 'keluar', '2026-09-01', NULL, '2026-09-01 09:27:19', '2026-09-01 09:27:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'karyawan',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin BPKP', 'admin@bpkp.go.id', 'admin', NULL, '$2y$12$TCc/D/76IEBdvmH4yjhstefN6VVWKnaqjlqqHiQYYhmrByw1YLtwC', NULL, '2026-08-29 10:58:57', '2026-08-29 10:58:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `barangs_kode_barang_unique` (`kode_barang`);

--
-- Indexes for table `detail_transaksis`
--
ALTER TABLE `detail_transaksis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_transaksis_barang_id_foreign` (`barang_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `transaksis`
--
ALTER TABLE `transaksis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transaksis_kode_transaksi_unique` (`kode_transaksi`),
  ADD KEY `transaksis_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `detail_transaksis`
--
ALTER TABLE `detail_transaksis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksis`
--
ALTER TABLE `transaksis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_transaksis`
--
ALTER TABLE `detail_transaksis`
  ADD CONSTRAINT `detail_transaksis_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barangs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaksis`
--
ALTER TABLE `transaksis`
  ADD CONSTRAINT `transaksis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
