-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 29, 2026 at 05:24 PM
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
  `nomor` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_image` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangs`
--

INSERT INTO `barangs` (`id`, `nomor`, `name`, `category`, `link_image`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'inventaris', 'elektronik', 'https://drive.google.com/drive/folders/1G4Ccn_4DlvVnqWhdQge5jpGfeyH6picw', 'ew', '2026-08-24 00:37:16', '2026-08-24 00:37:16'),
(2, 2, 'andra', 'orang', 'https://www.citilink.co.id/id/menu-pre-book-meals', 'wew', '2026-08-24 00:37:16', '2026-08-24 00:37:16'),
(3, 3, 'botol minuman', 'kemasan', 'https://www.google.com/search?q', 'oke', '2026-08-24 00:37:16', '2026-08-24 00:37:16'),
(4, 4, 'leskuker', 'elektronik', 'https://www.citilink.co.id/id/menu-pre-book-meals', 'jj', '2026-08-24 00:37:16', '2026-08-24 00:37:16'),
(5, 5, 'galon', 'air minum', NULL, NULL, '2026-08-24 00:37:16', '2026-08-24 00:37:16'),
(7, 6, 'proyektor', 'elektronik', 'http://10.123.2.195:8000/items/input', 'kami pergi', '2026-08-25 21:26:28', '2026-08-25 21:26:28'),
(8, 7, 'angsa', 'angsa', 'http://10.123.2.195:8000/items/input', 'kyu', '2026-08-25 21:54:03', '2026-08-25 21:54:03'),
(9, 8, 'kunci', 'orang', 'https://www.tokopedia.com/', 'csds', '2026-08-25 21:54:19', '2026-08-25 21:54:19'),
(10, 9, 'alya', 'air minum', 'https://www.tokopedia.com/', 's', '2026-08-25 22:46:09', '2026-08-25 22:46:09'),
(11, 10, 'kue', 'sabek', 'http://10.123.2.195:8000/items/input', 'kenyang', '2026-08-25 23:05:04', '2026-08-25 23:05:04'),
(12, 11, 'alya', 'elektronik', 'https://www.tokopedia.com/', 'xsa', '2026-08-25 23:34:33', '2026-08-25 23:34:33'),
(13, 12, 'alya', 'kemasan', 'https://www.youtube.com/', 'sada', '2026-08-25 23:34:56', '2026-08-25 23:34:56'),
(14, 13, 'proyektor', 'sabek', NULL, 'angka', '2026-08-25 23:37:55', '2026-08-25 23:37:55'),
(15, 14, 'leptop', 'elektronik', NULL, 'shdg', '2026-08-25 23:46:00', '2026-08-25 23:46:00');

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
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint UNSIGNED NOT NULL,
  `nomor` int UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_image` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('masuk','keluar') COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `nomor`, `name`, `category`, `link_image`, `type`, `stock`, `description`, `created_at`, `updated_at`) VALUES
(35, 1, 'inventaris', 'elektronik', 'https://drive.google.com/drive/folders/1G4Ccn_4DlvVnqWhdQge5jpGfeyH6picw', 'masuk', 10, 'ew', '2026-08-20 00:07:01', '2026-08-20 00:07:01'),
(36, 2, 'andra', 'orang', 'https://www.citilink.co.id/id/menu-pre-book-meals', 'masuk', 100, 'wew', '2026-08-20 21:39:29', '2026-08-20 21:39:29'),
(37, 2, 'andra', 'orang', 'https://www.citilink.co.id/id/menu-pre-book-meals', 'masuk', 1, 'wew', '2026-08-22 04:50:50', '2026-08-22 04:50:50'),
(38, 1, 'inventaris', 'elektronik', 'https://drive.google.com/drive/folders/1G4Ccn_4DlvVnqWhdQge5jpGfeyH6picw', 'keluar', 1, 'ew', '2026-08-22 04:56:43', '2026-08-22 04:56:43'),
(39, 1, 'inventaris', 'elektronik', 'https://drive.google.com/drive/folders/1G4Ccn_4DlvVnqWhdQge5jpGfeyH6picw', 'keluar', 1, 'ew', '2026-08-22 04:56:53', '2026-08-22 04:56:53'),
(40, 2, 'andra', 'orang', 'https://www.citilink.co.id/id/menu-pre-book-meals', 'keluar', 1, 'wew', '2026-08-22 04:57:55', '2026-08-22 04:57:55'),
(66, 7, 'angsa', 'angsa', 'http://10.123.2.195:8000/items/input', 'keluar', 6, 'kyu', '2026-08-25 23:27:58', '2026-08-25 23:27:58'),
(67, 7, 'angsa', 'angsa', 'http://10.123.2.195:8000/items/input', 'masuk', 1, 'kyu', '2026-08-25 23:34:42', '2026-08-25 23:34:42'),
(68, 7, 'angsa', 'angsa', 'http://10.123.2.195:8000/items/input', 'keluar', 1, 'kyu', '2026-08-25 23:35:07', '2026-08-25 23:35:07'),
(69, 6, 'proyektor', 'elektronik', 'http://10.123.2.195:8000/items/input', 'keluar', 1, 'kami pergi', '2026-08-25 23:38:32', '2026-08-25 23:38:32'),
(70, 13, 'proyektor', 'sabek', NULL, 'keluar', 1, 'angka', '2026-08-25 23:43:49', '2026-08-25 23:43:49'),
(72, 5, 'galon', 'air minum', NULL, 'masuk', 100, NULL, '2026-08-26 00:11:17', '2026-08-26 00:11:17'),
(73, 5, 'galon', 'air minum', NULL, 'masuk', 1, NULL, '2026-08-26 00:32:45', '2026-08-26 00:32:45'),
(74, 5, 'galon', 'air minum', NULL, 'keluar', 30, NULL, '2026-08-26 18:18:43', '2026-08-26 18:18:43'),
(75, 2, 'andra', 'orang', 'https://www.citilink.co.id/id/menu-pre-book-meals', 'masuk', 1, 'wew', '2026-08-28 21:26:29', '2026-08-28 21:26:29'),
(76, 5, 'galon', 'air minum', NULL, 'keluar', 1, NULL, '2026-08-28 21:34:30', '2026-08-28 21:34:30'),
(77, 11, 'alya', 'elektronik', 'https://www.tokopedia.com/', 'masuk', 1, 'xsa', '2026-08-28 21:34:56', '2026-08-28 21:34:56');

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
(9, '2026_08_27_000000_create_settings_table', 4);

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
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'warna_primary', '#e0c306', '2026-08-26 22:19:04', '2026-08-26 22:19:04'),
(2, 'mode_default', 'pro', '2026-08-26 22:19:04', '2026-08-28 22:17:49'),
(3, 'sidebar_logo', NULL, '2026-08-26 22:19:04', '2026-08-26 22:19:04'),
(4, 'sidebar_title', 'Inventaris', '2026-08-26 22:19:04', '2026-08-26 22:19:04'),
(5, 'sidebar_subtitle', 'Manajemen Baranhh', '2026-08-26 22:19:04', '2026-08-26 22:19:04'),
(6, 'language', 'id', '2026-08-28 09:50:14', '2026-08-28 20:39:47'),
(7, 'font_size', 'large', '2026-08-28 09:50:14', '2026-08-28 19:32:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `barangs_name_category_unique` (`name`,`category`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
