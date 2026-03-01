-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 17 Feb 2026 pada 00.58
-- Versi server: 8.0.30
-- Versi PHP: 8.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundry`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `add_jenis_cucian`
--

CREATE TABLE `add_jenis_cucian` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nama jenis cucian, misal: reguler, express',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `add_jenis_cucian`
--

INSERT INTO `add_jenis_cucian` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Express', '2026-02-04 04:34:43', '2026-02-04 04:18:36'),
(2, 'Reguler', '2026-02-04 04:36:22', '2026-02-04 04:36:22'),
(3, 'Cuci_Kering', '2026-02-04 04:36:22', '2026-02-04 04:36:22'),
(4, 'Setrika Saja', '2026-02-04 04:36:22', '2026-02-04 04:36:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `jenis_cucians`
--

CREATE TABLE `jenis_cucians` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jenis_cucians`
--

INSERT INTO `jenis_cucians` (`id`, `nama_jenis`, `created_at`, `updated_at`) VALUES
(1, 'Reguler', '2026-02-04 07:24:37', '2026-02-04 07:24:37'),
(2, 'Express', '2026-02-04 07:24:37', '2026-02-04 07:24:37'),
(3, 'Cuci Kering', '2026-02-04 07:24:37', '2026-02-04 07:24:37'),
(4, 'Setrika', '2026-02-04 07:24:37', '2026-02-04 07:24:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `layanans`
--

CREATE TABLE `layanans` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_layanan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_layanan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `jenis_cucian` enum('reguler','kering','setrika','cuci_setrika','express') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga` int UNSIGNED NOT NULL,
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `layanans`
--

INSERT INTO `layanans` (`id`, `nama_layanan`, `jenis_layanan`, `deskripsi`, `jenis_cucian`, `harga`, `status`, `created_at`, `updated_at`) VALUES
(1, 'baju bayi', 'baju', NULL, 'express', 12000, 'aktif', '2026-02-03 21:19:10', '2026-02-04 19:43:06'),
(3, 'seragam sekolah', 'seragam', 'rfgygdhbwjd', 'cuci_setrika', 7000, 'aktif', '2026-02-04 19:37:22', '2026-02-04 19:37:22'),
(4, 'karpet', 'karpet', 'kjgwfsj', 'express', 25000, 'aktif', '2026-02-04 19:55:12', '2026-02-04 19:55:12'),
(5, 'sepatu', 'sepatu', 'jfeh', 'reguler', 6000, 'aktif', '2026-02-04 19:55:33', '2026-02-04 19:55:33'),
(6, 'selimut', 'selimut', 'hhgs', 'cuci_setrika', 20000, 'aktif', '2026-02-04 19:55:56', '2026-02-04 19:55:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_13_125711_create_layanans_table', 1),
(5, '2026_01_13_141542_create_pesanans_table', 1),
(6, '2026_01_13_142841_create_pesanan_details_table', 1),
(7, '2026_01_14_163822_add_email_to_users_table', 1),
(8, '2026_01_14_999999_create_sessions_table', 1),
(9, '2026_01_15_133523_remove_username_from_users_table', 1),
(10, '2026_01_18_101703_add_tanggal_to_pesanans_table', 1),
(11, '2026_01_18_104747_add_pembayaran_to_pesanans_table', 1),
(12, '2026_01_18_124209_add_no_struk_to_pesanans_table', 1),
(13, '2026_01_19_034204_create_transaksis_table', 1),
(14, '2026_01_19_045445_create_detail_transaksis_table', 1),
(15, '2026_01_20_073002_add_jenis_layanan_to_layanans_table', 1),
(16, '2026_01_20_073801_add_layanan_fields_to_layanans_table', 1),
(17, '2026_01_20_095834_create_jenis_cucians_table', 1),
(18, '2026_01_20_101056_create_add_jenis_cucian_table', 1),
(19, '2026_02_04_051035_add_subtotal_to_transaksi_details_table', 2),
(20, '2026_02_04_052337_modify_keterangan_nullable_on_transaksi_details_table', 3),
(21, '2026_02_09_023514_create_pembayarans_table', 4),
(22, '2026_02_09_024734_create_pembayaran_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayarans`
--

CREATE TABLE `pembayarans` (
  `id` bigint UNSIGNED NOT NULL,
  `transaksi_id` bigint UNSIGNED NOT NULL,
  `metode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanans`
--

CREATE TABLE `pesanans` (
  `id` bigint UNSIGNED NOT NULL,
  `no_struk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal` date NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `layanan_id` bigint UNSIGNED NOT NULL,
  `jenis_cucian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `berat` int NOT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `estimasi_selesai` date DEFAULT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `total` int NOT NULL,
  `status` enum('proses','selesai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'proses',
  `metode_pembayaran` enum('cash','qris') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_pembayaran` enum('belum_bayar','sudah_bayar') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum_bayar',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan_details`
--

CREATE TABLE `pesanan_details` (
  `id` bigint UNSIGNED NOT NULL,
  `pesanan_id` bigint UNSIGNED NOT NULL,
  `qty` int NOT NULL,
  `subtotal` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksis`
--

CREATE TABLE `transaksis` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_id` bigint UNSIGNED NOT NULL,
  `tanggal_masuk` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total` int NOT NULL DEFAULT '0',
  `bayar` int NOT NULL DEFAULT '0',
  `kembalian` int NOT NULL DEFAULT '0',
  `status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksis`
--

INSERT INTO `transaksis` (`id`, `kode_transaksi`, `user_id`, `tanggal_masuk`, `total`, `bayar`, `kembalian`, `status`, `created_at`, `updated_at`) VALUES
(15, 'TRX-RV7W6Q', 4, '2026-02-09 08:04:41', 524000, 0, 0, 'lunas', '2026-02-08 18:04:41', '2026-02-08 18:06:15'),
(16, 'TRX-P2U23G', 4, '2026-02-09 08:05:12', 490000, 0, 0, 'lunas', '2026-02-08 18:05:12', '2026-02-08 18:06:12'),
(17, 'TRX-HCCWJ2', 2, '2026-02-09 08:34:55', 815000, 0, 0, 'lunas', '2026-02-08 18:34:55', '2026-02-08 18:36:24'),
(18, 'TRX-AF0K2T', 2, '2026-02-09 08:35:15', 312000, 0, 0, 'lunas', '2026-02-08 18:35:15', '2026-02-08 18:36:31'),
(19, 'TRX-WP6L4G', 2, '2026-02-09 08:35:40', 186000, 0, 0, 'lunas', '2026-02-08 18:35:40', '2026-02-08 18:36:27'),
(20, 'TRX-XWKWH2', 4, '2026-02-09 13:05:12', 464000, 0, 0, 'lunas', '2026-02-08 23:05:12', '2026-02-08 23:05:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_details`
--

CREATE TABLE `transaksi_details` (
  `id` bigint UNSIGNED NOT NULL,
  `id_transaksi` bigint UNSIGNED NOT NULL,
  `layanan_id` bigint UNSIGNED NOT NULL,
  `jenis_cucian_id` bigint UNSIGNED NOT NULL DEFAULT '1',
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` int NOT NULL DEFAULT '1',
  `harga` bigint NOT NULL DEFAULT '0',
  `subtotal` bigint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksi_details`
--

INSERT INTO `transaksi_details` (`id`, `id_transaksi`, `layanan_id`, `jenis_cucian_id`, `keterangan`, `qty`, `harga`, `subtotal`, `created_at`, `updated_at`) VALUES
(16, 15, 3, 3, NULL, 9, 7000, 63000, '2026-02-08 18:04:41', '2026-02-08 18:04:41'),
(17, 15, 4, 2, NULL, 7, 25000, 175000, '2026-02-08 18:04:41', '2026-02-08 18:04:41'),
(18, 15, 5, 1, NULL, 3, 6000, 18000, '2026-02-08 18:04:41', '2026-02-08 18:04:41'),
(19, 15, 6, 3, NULL, 8, 20000, 160000, '2026-02-08 18:04:41', '2026-02-08 18:04:41'),
(20, 15, 1, 3, NULL, 9, 12000, 108000, '2026-02-08 18:04:41', '2026-02-08 18:04:41'),
(21, 16, 4, 2, NULL, 10, 25000, 250000, '2026-02-08 18:05:12', '2026-02-08 18:05:12'),
(22, 16, 6, 1, NULL, 12, 20000, 240000, '2026-02-08 18:05:12', '2026-02-08 18:05:12'),
(23, 17, 6, 2, NULL, 12, 20000, 240000, '2026-02-08 18:34:55', '2026-02-08 18:34:55'),
(24, 17, 4, 3, NULL, 23, 25000, 575000, '2026-02-08 18:34:55', '2026-02-08 18:34:55'),
(25, 18, 1, 2, NULL, 26, 12000, 312000, '2026-02-08 18:35:15', '2026-02-08 18:35:15'),
(26, 19, 3, 2, NULL, 12, 7000, 84000, '2026-02-08 18:35:40', '2026-02-08 18:35:40'),
(27, 19, 5, 1, NULL, 17, 6000, 102000, '2026-02-08 18:35:40', '2026-02-08 18:35:40'),
(28, 20, 1, 3, NULL, 17, 12000, 204000, '2026-02-08 23:05:12', '2026-02-08 23:05:12'),
(29, 20, 6, 2, NULL, 13, 20000, 260000, '2026-02-08 23:05:12', '2026-02-08 23:05:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `no_hp` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','customer') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `password`, `name`, `email`, `alamat`, `no_hp`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '$2y$12$UmK2VXckhqfyDrSp2ypWz.E/sLuypBn8YzPPC5vVjJbD0bWcm4opm', 'Admin Laundry', 'admin@gmail.com', 'Jl. Kebersihan No.1', '081234567890', 'admin', 'f4LjQ19bs5Q6mb0k6X2JeFfJDxaTl88cxlaOMEUEqpMggTbhBM43VDs3jwrP', '2026-02-03 21:16:51', '2026-02-03 21:16:51'),
(2, '$2y$12$zQ3jP024BJCroK8CWuqhKuJw8mIzE1PlYLcTea.xgoUTaWVsF0REm', 'Sofi Arindah', 'sofi@gmail.com', 'Jl. Kebersihan No.1', '081234567890', 'customer', 'VtsofQ05s556QiC8xXuHraQHbX9ra1avwi0Z3sKzZt9THT8XgGX7j7liG6oQ', '2026-02-03 21:16:51', '2026-02-03 21:16:51'),
(4, '$2y$12$KwFmdMH16blqZbgmaZcz5.ilSWjyk.4EhpSUB.ydGxiKNxkLI1qtu', 'Hikmatus Afifaisella', 'hikmatus@gmail.com', NULL, NULL, 'customer', NULL, '2026-02-08 18:03:25', '2026-02-08 18:03:25');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `add_jenis_cucian`
--
ALTER TABLE `add_jenis_cucian`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `add_jenis_cucian_nama_unique` (`nama`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jenis_cucians`
--
ALTER TABLE `jenis_cucians`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jenis_cucians_nama_jenis_unique` (`nama_jenis`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `layanans`
--
ALTER TABLE `layanans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembayarans_transaksi_id_foreign` (`transaksi_id`);

--
-- Indeks untuk tabel `pesanans`
--
ALTER TABLE `pesanans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pesanans_user_id_foreign` (`user_id`),
  ADD KEY `pesanans_layanan_id_foreign` (`layanan_id`);

--
-- Indeks untuk tabel `pesanan_details`
--
ALTER TABLE `pesanan_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pesanan_details_pesanan_id_foreign` (`pesanan_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `transaksis`
--
ALTER TABLE `transaksis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transaksis_kode_transaksi_unique` (`kode_transaksi`),
  ADD KEY `transaksis_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `transaksi_details`
--
ALTER TABLE `transaksi_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_details_id_transaksi_foreign` (`id_transaksi`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `add_jenis_cucian`
--
ALTER TABLE `add_jenis_cucian`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jenis_cucians`
--
ALTER TABLE `jenis_cucians`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `layanans`
--
ALTER TABLE `layanans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `pembayarans`
--
ALTER TABLE `pembayarans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pesanans`
--
ALTER TABLE `pesanans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pesanan_details`
--
ALTER TABLE `pesanan_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksis`
--
ALTER TABLE `transaksis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `transaksi_details`
--
ALTER TABLE `transaksi_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD CONSTRAINT `pembayarans_transaksi_id_foreign` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksis` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pesanans`
--
ALTER TABLE `pesanans`
  ADD CONSTRAINT `pesanans_layanan_id_foreign` FOREIGN KEY (`layanan_id`) REFERENCES `layanans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pesanans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pesanan_details`
--
ALTER TABLE `pesanan_details`
  ADD CONSTRAINT `pesanan_details_pesanan_id_foreign` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanans` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksis`
--
ALTER TABLE `transaksis`
  ADD CONSTRAINT `transaksis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi_details`
--
ALTER TABLE `transaksi_details`
  ADD CONSTRAINT `transaksi_details_id_transaksi_foreign` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksis` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
