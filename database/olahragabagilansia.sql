-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2026 at 04:03 PM
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
-- Database: `olahragabagilansia`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_alternatif` varchar(10) NOT NULL,
  `nama_alternatif` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id`, `kode_alternatif`, `nama_alternatif`, `created_at`, `updated_at`) VALUES
(1, 'A1', 'Jalan Kaki', NULL, NULL),
(2, 'A2', 'Senam Lansia', NULL, NULL),
(3, 'A3', 'Yoga Ringan', NULL, NULL),
(4, 'A4', 'Bersepeda Pelan', NULL, NULL),
(5, 'A5', 'Tai Chi', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hasil_saw`
--

CREATE TABLE `hasil_saw` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `penyakit_id` bigint(20) UNSIGNED NOT NULL,
  `alternatif_id` bigint(20) UNSIGNED NOT NULL,
  `nilai_vi` double NOT NULL,
  `ranking` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_kriteria` varchar(10) NOT NULL,
  `nama_kriteria` varchar(255) NOT NULL,
  `jenis` enum('benefit','cost') NOT NULL,
  `bobot` double NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id`, `kode_kriteria`, `nama_kriteria`, `jenis`, `bobot`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'C1', 'Usia', 'benefit', 0.15, 'Kesesuaian olahraga dengan umur lansia', NULL, NULL),
(2, 'C2', 'Kondisi Kesehatan', 'cost', 0.3, 'Tingkat kesesuaian dengan kondisi medis lansia', NULL, NULL),
(3, 'C3', 'Tujuan Olahraga', 'benefit', 0.15, 'Kecocokan terhadap tujuan olahraga', NULL, NULL),
(4, 'C4', 'Risiko Cedera', 'cost', 0.25, 'Semakin tinggi risiko, semakin rendah nilai', NULL, NULL),
(5, 'C5', 'Biaya', 'cost', 0.15, 'Keterjangkauan biaya atau peralatan', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '001_create_users_table', 1),
(2, '002_create_cache_table', 1),
(3, '003_create_jobs_table', 1),
(4, '004_create_kriteria_table', 1),
(5, '005_create_alternatif_table', 1),
(6, '006_create_penyakit_table', 1),
(7, '007_create_hasil_saw_table', 1),
(8, '008_create_panduan_olahraga_table', 1),
(9, '009_create_sub_kriteria_table', 1),
(10, '010_create_nilai_penyakit_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_penyakit`
--

CREATE TABLE `nilai_penyakit` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `penyakit_id` bigint(20) UNSIGNED NOT NULL,
  `alternatif_id` bigint(20) UNSIGNED NOT NULL,
  `nilai_C2` double NOT NULL,
  `nilai_C4` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nilai_penyakit`
--

INSERT INTO `nilai_penyakit` (`id`, `penyakit_id`, `alternatif_id`, `nilai_C2`, `nilai_C4`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, NULL, '2026-05-19 10:16:01'),
(2, 1, 2, 1, 2, NULL, '2026-05-19 10:15:56'),
(3, 1, 3, 1, 1, NULL, '2026-05-19 10:16:10'),
(4, 1, 4, 2, 2, NULL, '2026-05-19 10:16:23'),
(6, 2, 1, 1, 1, NULL, '2026-05-19 08:38:18'),
(7, 2, 2, 2, 2, NULL, '2026-05-19 08:41:12'),
(8, 2, 3, 1, 1, NULL, '2026-05-19 08:38:39'),
(9, 2, 4, 2, 2, NULL, '2026-05-19 08:38:53'),
(10, 2, 5, 1, 1, NULL, '2026-05-19 08:39:00'),
(11, 1, 5, 1, 1, '2026-05-19 08:30:32', '2026-05-19 10:16:30'),
(12, 3, 1, 1, 2, '2026-05-19 08:42:14', '2026-05-19 08:42:14'),
(13, 3, 2, 2, 2, '2026-05-19 08:42:22', '2026-05-19 08:42:22'),
(14, 3, 3, 1, 1, '2026-05-19 08:46:53', '2026-05-19 08:46:53'),
(15, 3, 4, 2, 3, '2026-05-19 08:47:04', '2026-05-19 08:47:04'),
(16, 3, 5, 1, 1, '2026-05-19 08:47:13', '2026-05-19 08:47:13'),
(17, 4, 1, 2, 2, '2026-05-19 08:47:31', '2026-05-19 08:47:31'),
(18, 4, 2, 3, 3, '2026-05-19 08:47:37', '2026-05-19 08:47:37'),
(19, 4, 3, 2, 2, '2026-05-19 08:47:44', '2026-05-19 08:47:44'),
(20, 4, 4, 3, 3, '2026-05-19 08:47:59', '2026-05-19 08:47:59'),
(21, 4, 5, 2, 2, '2026-05-19 08:48:04', '2026-05-19 08:48:04'),
(22, 5, 1, 2, 2, '2026-05-19 08:48:27', '2026-05-19 08:48:27'),
(23, 5, 2, 2, 2, '2026-05-19 08:48:32', '2026-05-19 08:48:32'),
(24, 5, 3, 2, 1, '2026-05-19 08:48:42', '2026-05-19 08:48:42'),
(25, 5, 4, 2, 2, '2026-05-19 08:48:52', '2026-05-19 08:48:52'),
(26, 5, 5, 1, 1, '2026-05-19 08:48:58', '2026-05-19 08:48:58');

-- --------------------------------------------------------

--
-- Table structure for table `panduan_olahraga`
--

CREATE TABLE `panduan_olahraga` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `alternatif_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi_singkat` text NOT NULL,
  `deskripsi_umum` text NOT NULL,
  `manfaat` text NOT NULL,
  `durasi_ideal` varchar(255) NOT NULL,
  `batasan_medis` text NOT NULL,
  `peringatan` text NOT NULL,
  `tata_cara` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `panduan_olahraga`
--

INSERT INTO `panduan_olahraga` (`id`, `alternatif_id`, `nama`, `deskripsi_singkat`, `deskripsi_umum`, `manfaat`, `durasi_ideal`, `batasan_medis`, `peringatan`, `tata_cara`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 1, 'Jalan Kaki', 'Olahraga sederhana namun efektif untuk menjaga kesehatan dan kebugaran lansia.', 'Aktivitas ringan yang dapat dilakukan kapan saja dan di mana saja.', 'Meningkatkan sirkulasi darah\r\nMemperkuat kesehatan jantung\r\nMenjaga kekuatan tulang\r\nMembantu mengendalikan berat badan\r\nMeningkatkan mood dan mengurangi stress', '20–30 menit per hari, 5x seminggu.', 'Hindari jalan menanjak bagi penderita jantung atau Osteoartritis lutut parah.', 'Gunakan alas kaki yang nyaman dan empuk. Istirahat bila terasa nyeri pada sendi.', '1. Gunakan sepatu yang nyaman dan mendukung kaki\r\n2. Mulai dengan pemanasan ringan 5-10 menit\r\n3. Jalan dengan tempo sedang dan tetap\r\n4. Pertahankan postur tubuh yang tegak\r\n5. Ayunkan lengan secara natural\r\n6. Ambil napas secara teratur\r\n7. Akhiri dengan pendinginan 5-10 menit', 'olahraga/asHH77S0oSJ1t3E5vWjejB72gchGQO1TPUQJISYS.png', NULL, '2026-05-19 08:16:25'),
(2, 2, 'Senam Lansia', 'Gerakan-gerakan yang dirancang khusus untuk meningkatkan kebugaran lansia.', 'Serangkaian gerakan ringan yang dirancang khusus untuk seluruh tubuh lansia.', 'Menjaga fleksibilitas sendi\r\nMeningkatkan koordinasi tubuh\r\nMemperkuat otot\r\nMembantu keseimbangan\r\nMeningkatkan mood', '3–4x seminggu, @ 30 menit.', 'Aman untuk sebagian besar kondisi bila dilakukan perlahan dan sesuai kemampuan.', 'Hindari gerakan menghentak, jongkok penuh, atau melompat.', '1. Mulai dengan pemanasan ringan\r\n2. Lakukan gerakan secara perlahan dan terkontrol\r\n3. Fokus pada pernapasan\r\n4. Ikuti instruksi gerakan dengan benar\r\n5. Jangan memaksakan gerakan yang sulit\r\n6. Istirahat bila merasa lelah\r\n7. Akhiri dengan pendinginan', 'olahraga/DGUFHaLFOTysJ6fqBYb5NWUUGWwlUWGCmeOiVR58.png', NULL, '2026-05-19 08:49:46'),
(3, 3, 'Yoga Ringan', 'Kombinasi gerakan lembut dan teknik pernapasan untuk ketenangan jiwa dan raga.', 'Latihan pernapasan, peregangan lembut, dan relaksasi untuk menenangkan pikiran.', 'Mengurangi stres dan kecemasan\r\nMeningkatkan fleksibilitas\r\nMemperbaiki postur tubuh\r\nMeningkatkan konsentrasi\r\nMenjaga keseimbangan', '20–40 menit, 2-3x seminggu.', 'Sangat baik untuk Hipertensi & Diabetes karena efek relaksasinya.', 'Hindari posisi terbalik (inversi) bila memiliki tekanan darah tinggi atau glaukoma.', '1. Siapkan matras yoga\r\n2. Mulai dengan posisi duduk dan pernapasan dalam\r\n3. Lakukan peregangan ringan\r\n4. Ikuti gerakan dasar yoga secara perlahan\r\n5. Fokus pada pernapasan dan pose\r\n6. Pertahankan setiap pose sesuai kemampuan\r\n7. Akhiri dengan relaksasi', 'olahraga/1lBbjVnzc30F6j2Sia2JWnDc5GVVNEqljGcwefTN.png', NULL, '2026-05-19 08:50:04'),
(4, 4, 'Bersepeda Pelan', 'Olahraga kardio yang aman untuk sendi dan menyenangkan untuk dilakukan.', 'Latihan kardiovaskular ringan (low-impact). Bisa menggunakan sepeda statis.', 'Meningkatkan kesehatan jantung\r\nMemperkuat otot kaki\r\nMelatih keseimbangan\r\nMengurangi stress pada sendi\r\nMembakar kalori', '15–25 menit, 3x seminggu.', 'Tidak disarankan untuk penderita Osteoartritis lutut yang sedang meradang parah.', 'Pastikan posisi duduk stabil dan sadel tidak terlalu tinggi untuk menghindari cedera.', '1. Sesuaikan tinggi sadel dengan postur tubuh\r\n2. Mulai dengan pemanasan ringan\r\n3. Kayuh sepeda dengan tempo stabil\r\n4. Pertahankan postur yang nyaman\r\n5. Jaga pernapasan tetap teratur\r\n6. Tingkatkan kecepatan secara bertahap\r\n7. Akhiri dengan pendinginan', 'olahraga/g32uU0rWL70vDIQUFGqlErRVCtYFPapR55X6qVqL.png', NULL, '2026-05-19 08:50:19'),
(5, 5, 'Tai Chi', 'Seni gerak tradisional yang memadukan kelenturan dan keseimbangan.', 'Seni bela diri Tiongkok kuno yang fokus pada gerakan lambat, pernapasan, dan fokus mental.', 'Meningkatkan keseimbangan\r\nMengurangi risiko jatuh\r\nMemperkuat otot inti\r\nMeningkatkan konsentrasi\r\nMeredakan stress', '30–45 menit, 2-3x seminggu.', 'Aman untuk hampir semua kondisi, termasuk penderita radang sendi.', 'Lakukan di tempat yang datar dan tidak licin untuk menghindari terpeleset.', '1. Pilih area yang tenang dan datar\r\n2. Mulai dengan pemanasan ringan\r\n3. Fokus pada pernapasan dalam\r\n4. Ikuti gerakan dengan perlahan\r\n5. Pertahankan keseimbangan\r\n6. Lakukan gerakan mengalir\r\n7. Akhiri dengan meditasi ringan', 'olahraga/rIZQNkOaIZtEMlw8To7w32f1cWflU1ZVWAx4wFH1.png', NULL, '2026-05-19 08:50:35');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penyakit`
--

CREATE TABLE `penyakit` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_penyakit` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `larangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penyakit`
--

INSERT INTO `penyakit` (`id`, `nama_penyakit`, `deskripsi`, `larangan`, `created_at`, `updated_at`) VALUES
(1, 'Sehat', 'Kondisi fisik normal tanpa keluhan penyakit kronis.', 'Tidak ada larangan khusus, namun tetap perhatikan kemampuan tubuh.', NULL, '2026-05-19 08:22:47'),
(2, 'Hipertensi', 'Tekanan darah tinggi.', 'Hindari olahraga intensitas tinggi, menahan napas, dan posisi kepala di bawah jantung (inversi).', NULL, NULL),
(3, 'Diabetes Mellitus', 'Kadar gula darah tinggi.', 'Periksa gula darah sebelum/sesudah olahraga. Hindari olahraga jika gula darah terlalu tinggi/rendah. Selalu bawa permen/sumber gula cepat.', NULL, NULL),
(4, 'Penyakit Jantung', 'Gangguan pada fungsi jantung.', 'DILARANG berolahraga berat. Hindari aktivitas yang memicu nyeri dada atau sesak napas. Selalu dalam pengawasan.', NULL, NULL),
(5, 'Osteoartritis', 'Radang sendi, terutama pada lutut atau panggul.', 'Hindari olahraga high-impact seperti melompat atau lari. Jangan membebani sendi yang sakit.', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('pAke9bthvKUhb9uiPjgqNJZ1OHa8DIJay3eAKuym', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTmVsUDk0YmNDVVJxWnhFTU9lMG1KS1hQQ1l3WTlMZzRHTUpDS2pWRSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC90ZW50YW5nLXNhdyI7czo1OiJyb3V0ZSI7czoxMToidGVudGFuZy1zYXciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1783173752),
('XfaJHCKwXjstoX9cTMhHJ7OSQNsaxfJBrbj6SrtV', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiblpZZTNWUHFqSkJYYTlFbk4za3l2bWI2cUYycDZUeGJ0OUd4aGdDSSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9wYW5kdWFuLW9sYWhyYWdhIjtzOjU6InJvdXRlIjtzOjIyOiJwYW5kdWFuLW9sYWhyYWdhLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3ODE2Nzc3MzU7fX0=', 1781679850);

-- --------------------------------------------------------

--
-- Table structure for table `sub_kriteria`
--

CREATE TABLE `sub_kriteria` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kriteria_id` bigint(20) UNSIGNED NOT NULL,
  `pilihan` varchar(255) NOT NULL,
  `nilai` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_kriteria`
--

INSERT INTO `sub_kriteria` (`id`, `kriteria_id`, `pilihan`, `nilai`, `created_at`, `updated_at`) VALUES
(1, 1, '60 - 64 Tahun', 4, NULL, '2026-05-19 08:03:57'),
(2, 1, '65 - 69 Tahun', 3, NULL, '2026-05-19 08:03:51'),
(3, 1, '70 - 74 Tahun', 2, NULL, '2026-05-19 08:03:44'),
(4, 1, '>= 75 Tahun', 1, NULL, '2026-05-19 08:03:30'),
(5, 3, 'Menjaga Keseimbangan & Relaksasi', 1, NULL, '2026-05-19 08:05:29'),
(6, 3, 'Memperkuat Otot & Kebugaran', 2, NULL, '2026-05-19 08:05:34'),
(7, 3, 'Menjaga Fleksibilitas', 3, NULL, '2026-05-19 08:04:26'),
(8, 3, 'Kardio Ringan', 4, NULL, '2026-05-19 08:05:42'),
(9, 3, 'Kardio Sedang', 5, NULL, '2026-05-19 08:05:50'),
(10, 5, 'Gratis / Tanpa Biaya', 1, NULL, NULL),
(11, 5, 'Murah (Membutuhkan alat sederhana)', 2, NULL, NULL),
(12, 5, 'Sedang (Membutuhkan tempat khusus/sepatu)', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Sistem', 'admin@gmail.com', NULL, '$2y$12$e684NWDewY5htB/CdE4Z8OHYA0ZkvtYK8CEE3SIj5l1JuWw19YZTa', NULL, '2025-11-21 00:01:34', '2026-05-19 03:51:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hasil_saw`
--
ALTER TABLE `hasil_saw`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hasil_saw_penyakit_id_foreign` (`penyakit_id`),
  ADD KEY `hasil_saw_alternatif_id_foreign` (`alternatif_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_penyakit`
--
ALTER TABLE `nilai_penyakit`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nilai_penyakit_penyakit_id_alternatif_id_unique` (`penyakit_id`,`alternatif_id`),
  ADD KEY `nilai_penyakit_alternatif_id_foreign` (`alternatif_id`);

--
-- Indexes for table `panduan_olahraga`
--
ALTER TABLE `panduan_olahraga`
  ADD PRIMARY KEY (`id`),
  ADD KEY `panduan_olahraga_alternatif_id_foreign` (`alternatif_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_kriteria_kriteria_id_foreign` (`kriteria_id`);

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
-- AUTO_INCREMENT for table `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hasil_saw`
--
ALTER TABLE `hasil_saw`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `nilai_penyakit`
--
ALTER TABLE `nilai_penyakit`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `panduan_olahraga`
--
ALTER TABLE `panduan_olahraga`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `penyakit`
--
ALTER TABLE `penyakit`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hasil_saw`
--
ALTER TABLE `hasil_saw`
  ADD CONSTRAINT `hasil_saw_alternatif_id_foreign` FOREIGN KEY (`alternatif_id`) REFERENCES `alternatif` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hasil_saw_penyakit_id_foreign` FOREIGN KEY (`penyakit_id`) REFERENCES `penyakit` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `nilai_penyakit`
--
ALTER TABLE `nilai_penyakit`
  ADD CONSTRAINT `nilai_penyakit_alternatif_id_foreign` FOREIGN KEY (`alternatif_id`) REFERENCES `alternatif` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_penyakit_penyakit_id_foreign` FOREIGN KEY (`penyakit_id`) REFERENCES `penyakit` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `panduan_olahraga`
--
ALTER TABLE `panduan_olahraga`
  ADD CONSTRAINT `panduan_olahraga_alternatif_id_foreign` FOREIGN KEY (`alternatif_id`) REFERENCES `alternatif` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD CONSTRAINT `sub_kriteria_kriteria_id_foreign` FOREIGN KEY (`kriteria_id`) REFERENCES `kriteria` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
