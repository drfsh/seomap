-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 16, 2023 at 11:05 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `seomap`
--

-- --------------------------------------------------------

--
-- Table structure for table `accesses`
--

CREATE TABLE `accesses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `web_username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `web_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `host_username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `host_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `entries`
--

CREATE TABLE `entries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `entries`
--

INSERT INTO `entries` (`id`, `user_id`, `code`, `created_at`, `updated_at`) VALUES
(1, 1, '3749', '2023-01-13 14:13:38', '2023-01-13 14:13:38');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pay_num` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `amount` int(11) NOT NULL,
  `info` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `pay_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `text` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `ticket_id`, `user_id`, `text`, `file`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد\r\n\r\n', NULL, '2023-01-15 04:46:48', '2023-01-15 04:46:48'),
(2, 1, 2, 'selectFileselectFile', NULL, '2023-01-15 09:12:36', '2023-01-15 09:12:36'),
(3, 1, 1, 'asdasdsadsad', NULL, '2023-01-15 09:29:56', '2023-01-15 09:29:56'),
(4, 1, 1, 'dfsdfxsdsdsdsd', NULL, '2023-01-15 09:31:37', '2023-01-15 09:31:37'),
(5, 1, 1, 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.', NULL, '2023-01-15 09:34:24', '2023-01-15 09:34:24'),
(6, 1, 1, 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.', '/upload/png/1673775322_1_images.png', '2023-01-15 09:35:22', '2023-01-15 09:35:22');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_01_06_085339_create_entries_table', 1),
(6, '2023_01_09_155822_create_services_table', 1),
(7, '2023_01_09_156729_create_plans_table', 1),
(8, '2023_01_09_163108_create_projects_table', 1),
(9, '2023_01_09_174156_create_types_table', 1),
(10, '2023_01_09_184156_create_accesses_table', 1),
(11, '2023_01_09_184936_create_platforms_table', 1),
(12, '2023_01_09_191516_create_project_new_attrs_table', 1),
(13, '2023_01_10_060221_create_invoices_table', 1),
(14, '2023_01_10_063350_create_attributes_table', 1),
(15, '2023_01_10_064250_create_notifications_table', 1),
(16, '2023_01_10_064929_create_tickets_table', 1),
(17, '2023_01_10_071838_create_messages_table', 1),
(18, '2023_01_13_180255_create_permissions_table', 2),
(20, '2023_01_15_060322_create_seens_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `see` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `icon`, `title`, `body`, `see`, `created_at`, `updated_at`) VALUES
(1, 1, 'telegram', 'ویرایش اعلان', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.', 0, '2023-01-14 14:35:50', '2023-01-15 02:02:49');

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `user_id`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', '2023-01-13 18:14:56', '2023-01-13 18:14:56');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fee` int(11) NOT NULL DEFAULT 0,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `service_id`, `name`, `fee`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'پلن پایه', 3000, 'text', '2023-01-16 08:43:19', '2023-01-16 08:43:19'),
(2, 1, 'پلن حرفه ای', 3000, 'text', '2023-01-16 08:43:19', '2023-01-16 08:43:19'),
(3, 1, 'پلن VIP', 3000, 'text', '2023-01-16 08:43:19', '2023-01-16 08:43:19'),
(4, 1, 'پلن ELITE', 3000, 'text', '2023-01-16 08:43:19', '2023-01-16 08:43:19');

-- --------------------------------------------------------

--
-- Table structure for table `platforms`
--

CREATE TABLE `platforms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fee` int(11) NOT NULL DEFAULT 0,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `platforms`
--

INSERT INTO `platforms` (`id`, `service_id`, `name`, `fee`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'طراحی با وردپرس', 500, NULL, '2023-01-12 11:47:04', '2023-01-12 11:47:04'),
(2, 1, 'طراحی اختصاصی با وردپرس', 700, NULL, '2023-01-12 11:47:04', '2023-01-12 11:47:04'),
(3, 1, 'Php - Laravel - vue', 800, NULL, '2023-01-12 11:47:04', '2023-01-12 11:47:04'),
(4, 1, 'Php - Laravel - vue - singlePage', 1000, NULL, '2023-01-12 11:47:04', '2023-01-12 11:47:04'),
(5, 1, 'Php - Laravel - jquery', 600, NULL, '2023-01-12 11:47:04', '2023-01-12 11:47:04'),
(6, 1, 'nodejs - express - vue', 1300, NULL, '2023-01-12 11:47:04', '2023-01-12 11:47:04'),
(7, 1, 'nodejs - express - jquery', 800, NULL, '2023-01-12 11:47:04', '2023-01-12 11:47:04');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED DEFAULT NULL,
  `plan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `days` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `description` varchar(5000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fee` int(11) NOT NULL DEFAULT 0,
  `finished_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `user_id`, `service_id`, `plan_id`, `days`, `status`, `description`, `fee`, `finished_at`, `created_at`, `updated_at`) VALUES
(1, 'test one', 1, 1, 3, 10, 0, 'Illuminate\\Pagination\\LengthAwarePaginator {#1335 ▼ // app/Http/Controllers/Admin/HomeController.php:13\r\n  #items: Illuminate\\Database\\Eloquent\\Collection {#1329 ▶}\r\n  #perPage: 2\r\n  #currentPage: 1\r\n  #path: \"http://localhost:8000/admin\"\r\n  #query: []\r\n  #fragment: null\r\n  #pageName: \"page\"\r\n  +onEachSide: 3\r\n  #options: array:2 [▶]\r\n  #total: 0\r\n  #lastPage: 1', 5000, '2023-01-13 18:24:08', '2023-01-13 18:24:08', '2023-01-13 18:24:08');

-- --------------------------------------------------------

--
-- Table structure for table `project_new_attrs`
--

CREATE TABLE `project_new_attrs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `platform_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_new_attrs`
--

INSERT INTO `project_new_attrs` (`id`, `project_id`, `name`, `mobile`, `type_id`, `platform_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'lind', '09164324749', 3, 4, '2023-01-15 16:55:13', '2023-01-15 16:55:13');

-- --------------------------------------------------------

--
-- Table structure for table `seens`
--

CREATE TABLE `seens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `for` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `for_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seens`
--

INSERT INTO `seens` (`id`, `user_id`, `for`, `for_id`, `created_at`, `updated_at`) VALUES
(4, 1, 'notif', 1, '2023-01-15 02:48:31', '2023-01-15 02:48:31');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enable` tinyint(1) NOT NULL DEFAULT 1,
  `form` int(11) NOT NULL DEFAULT 0,
  `sort` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `slug`, `image`, `description`, `enable`, `form`, `sort`, `created_at`, `updated_at`) VALUES
(1, 'سفارش طراحی سایت', 'web-new', '/images/icons/Website-design-order.svg', 'طراحی و راه اندازی انواع سایت\r\n\r\n', 1, 0, 10, '2023-01-10 18:14:04', '2023-01-10 18:14:04'),
(2, 'توسعه وب سایت\r\n\r\n', 'web-up', '/images/icons/developing.svg', 'خدمات تغییرات ، توسعه و برنامه نویسی\r\n', 1, 2, 9, '2023-01-10 19:29:10', '2023-01-10 19:29:10'),
(3, 'رفع هک سایت', 'web-hack', '/images/icons/Fix-site-hacking.svg', 'خدمات بررسی و رفع مشکلات امنیتی سایت\r\n', 1, 2, 8, '2023-01-10 19:29:10', '2023-01-10 19:29:10'),
(4, 'مشکلات فنی\r\n\r\n', 'web-anform', '/images/icons/technical-issues.svg', 'خدمات رفع خطا و مشکلات فنی سایت\r\n', 1, 2, 7, '2023-01-10 19:29:10', '2023-01-10 19:29:10'),
(5, 'خدمات پشتیبانی\r\n\r\n', 'web-support', '/images/icons/support.svg', 'خدمات پشتیبانی و نگهداری سایت\r\n', 1, 3, 6, '2023-01-10 19:29:10', '2023-01-10 19:29:10'),
(6, 'test', 'test', '/images/icons/add-square.svg', 'fff', 1, 0, 0, '2023-01-14 12:30:20', '2023-01-14 12:37:13');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `starter_id` int(11) NOT NULL,
  `project_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dep` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `new` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `user_id`, `starter_id`, `project_id`, `title`, `dep`, `status`, `new`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'tst 5448 sdfd', '0', 1, 0, '2023-01-15 04:46:48', '2023-01-15 16:19:27');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fee` int(11) NOT NULL DEFAULT 0,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `service_id`, `name`, `fee`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'شخصی', 500, NULL, '2023-01-12 14:29:08', '2023-01-12 14:29:08'),
(2, 1, 'شرکتی', 500, NULL, '2023-01-12 14:29:08', '2023-01-12 14:29:08'),
(3, 1, 'فروشگاهی', 500, NULL, '2023-01-12 14:29:08', '2023-01-12 14:29:08'),
(4, 1, 'سایر...', 500, NULL, '2023-01-12 14:29:08', '2023-01-12 14:29:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `profile`, `email_verified_at`, `password`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'مهدی درفشیده', NULL, '9164324749', '/upload/png/1673683711_1_images.png', NULL, '$2y$10$v7U8MkaGJKdIcEtc76vw1OHRoObrwRsUJAmuzi1pQJaOcX62E1knK', 'h6xX8CGUiWFU4kxm2V3QwdC1p1F6BZslILA6KEltmmgloACJVNbcc1pTJs4w', NULL, '2023-01-13 14:13:38', '2023-01-14 04:38:31'),
(2, 'mahdi dera 65', NULL, '9164324748', NULL, NULL, '$2y$10$v7U8MkaGJKdIcEtc76vw1OHRoObrwRsUJAmuzi1pQJaOcX62E1knK', 'h6xX8CGUiWFU4kxm2V3QwdC1p1F6BZslILA6KEltmmgloACJVNbcc1pTJs4w', NULL, '2023-01-13 14:13:38', '2023-01-13 14:13:38'),
(3, 'mahdi dera 65', NULL, '9164324747', NULL, NULL, '$2y$10$v7U8MkaGJKdIcEtc76vw1OHRoObrwRsUJAmuzi1pQJaOcX62E1knK', 'h6xX8CGUiWFU4kxm2V3QwdC1p1F6BZslILA6KEltmmgloACJVNbcc1pTJs4w', NULL, '2023-01-13 14:13:38', '2023-01-13 14:13:38'),
(4, 'mahdi dera 65', NULL, '9164324746', NULL, NULL, '$2y$10$v7U8MkaGJKdIcEtc76vw1OHRoObrwRsUJAmuzi1pQJaOcX62E1knK', 'h6xX8CGUiWFU4kxm2V3QwdC1p1F6BZslILA6KEltmmgloACJVNbcc1pTJs4w', NULL, '2023-01-13 14:13:38', '2023-01-13 14:13:38'),
(7, 'mahdi dera 65', NULL, '9164324711', NULL, NULL, '$2y$10$v7U8MkaGJKdIcEtc76vw1OHRoObrwRsUJAmuzi1pQJaOcX62E1knK', 'h6xX8CGUiWFU4kxm2V3QwdC1p1F6BZslILA6KEltmmgloACJVNbcc1pTJs4w', NULL, '2023-01-13 14:13:38', '2023-01-13 14:13:38'),
(8, 'mahdi dera 65', NULL, '9164324712', NULL, NULL, '$2y$10$v7U8MkaGJKdIcEtc76vw1OHRoObrwRsUJAmuzi1pQJaOcX62E1knK', 'h6xX8CGUiWFU4kxm2V3QwdC1p1F6BZslILA6KEltmmgloACJVNbcc1pTJs4w', NULL, '2023-01-13 14:13:38', '2023-01-13 14:13:38'),
(9, 'mahdi dera 65', NULL, '9164324713', NULL, NULL, '$2y$10$v7U8MkaGJKdIcEtc76vw1OHRoObrwRsUJAmuzi1pQJaOcX62E1knK', 'h6xX8CGUiWFU4kxm2V3QwdC1p1F6BZslILA6KEltmmgloACJVNbcc1pTJs4w', NULL, '2023-01-13 14:13:38', '2023-01-13 14:13:38'),
(10, 'mahdi dera 65', NULL, '9164324714', NULL, NULL, '$2y$10$v7U8MkaGJKdIcEtc76vw1OHRoObrwRsUJAmuzi1pQJaOcX62E1knK', 'h6xX8CGUiWFU4kxm2V3QwdC1p1F6BZslILA6KEltmmgloACJVNbcc1pTJs4w', NULL, '2023-01-13 14:13:38', '2023-01-13 14:13:38'),
(11, 'mahdi dera 65', NULL, '9164324715', NULL, NULL, '$2y$10$v7U8MkaGJKdIcEtc76vw1OHRoObrwRsUJAmuzi1pQJaOcX62E1knK', 'h6xX8CGUiWFU4kxm2V3QwdC1p1F6BZslILA6KEltmmgloACJVNbcc1pTJs4w', NULL, '2023-01-13 14:13:38', '2023-01-13 14:13:38'),
(12, 'mahdi dera 65', NULL, '9164324716', NULL, NULL, '$2y$10$v7U8MkaGJKdIcEtc76vw1OHRoObrwRsUJAmuzi1pQJaOcX62E1knK', 'h6xX8CGUiWFU4kxm2V3QwdC1p1F6BZslILA6KEltmmgloACJVNbcc1pTJs4w', '2023-01-14 04:50:02', '2023-01-13 14:13:38', '2023-01-14 04:50:02'),
(13, '5214', NULL, '9164324701', NULL, NULL, '$2y$10$v7U8MkaGJKdIcEtc76vw1OHRoObrwRsUJAmuzi1pQJaOcX62E1knK', 'h6xX8CGUiWFU4kxm2V3QwdC1p1F6BZslILA6KEltmmgloACJVNbcc1pTJs4w', '2023-01-14 04:50:00', '2023-01-13 14:13:38', '2023-01-14 04:50:00'),
(14, 'kazemi', NULL, '9164324702', NULL, NULL, '$2y$10$v7U8MkaGJKdIcEtc76vw1OHRoObrwRsUJAmuzi1pQJaOcX62E1knK', 'h6xX8CGUiWFU4kxm2V3QwdC1p1F6BZslILA6KEltmmgloACJVNbcc1pTJs4w', '2023-01-15 02:49:46', '2023-01-13 14:13:38', '2023-01-15 02:49:46'),
(15, 'مهدی درفشیده 22', NULL, '9163258741', NULL, NULL, '$2y$10$6yu4I.ccAyBKYujSbHHxtOSyRXCNTBcOnUZnQNtloybSEtbWss9EK', NULL, '2023-01-14 04:49:57', '2023-01-14 04:25:49', '2023-01-14 04:49:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accesses`
--
ALTER TABLE `accesses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accesses_project_id_foreign` (`project_id`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attributes_project_id_foreign` (`project_id`);

--
-- Indexes for table `entries`
--
ALTER TABLE `entries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_project_id_foreign` (`project_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_ticket_id_foreign` (`ticket_id`),
  ADD KEY `messages_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_user_id_foreign` (`user_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plans_service_id_foreign` (`service_id`);

--
-- Indexes for table `platforms`
--
ALTER TABLE `platforms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `platforms_service_id_foreign` (`service_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_user_id_foreign` (`user_id`),
  ADD KEY `projects_service_id_foreign` (`service_id`),
  ADD KEY `projects_plan_id_foreign` (`plan_id`);

--
-- Indexes for table `project_new_attrs`
--
ALTER TABLE `project_new_attrs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_new_attrs_project_id_foreign` (`project_id`),
  ADD KEY `project_new_attrs_type_id_foreign` (`type_id`),
  ADD KEY `project_new_attrs_platform_id_foreign` (`platform_id`);

--
-- Indexes for table `seens`
--
ALTER TABLE `seens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seens_user_id_foreign` (`user_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tickets_user_id_foreign` (`user_id`),
  ADD KEY `tickets_project_id_foreign` (`project_id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `types_service_id_foreign` (`service_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_mobile_unique` (`mobile`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accesses`
--
ALTER TABLE `accesses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `entries`
--
ALTER TABLE `entries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `platforms`
--
ALTER TABLE `platforms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `project_new_attrs`
--
ALTER TABLE `project_new_attrs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `seens`
--
ALTER TABLE `seens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accesses`
--
ALTER TABLE `accesses`
  ADD CONSTRAINT `accesses_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attributes`
--
ALTER TABLE `attributes`
  ADD CONSTRAINT `attributes_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `plans`
--
ALTER TABLE `plans`
  ADD CONSTRAINT `plans_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `platforms`
--
ALTER TABLE `platforms`
  ADD CONSTRAINT `platforms_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `projects_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `projects_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_new_attrs`
--
ALTER TABLE `project_new_attrs`
  ADD CONSTRAINT `project_new_attrs_platform_id_foreign` FOREIGN KEY (`platform_id`) REFERENCES `platforms` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `project_new_attrs_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_new_attrs_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `seens`
--
ALTER TABLE `seens`
  ADD CONSTRAINT `seens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tickets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `types`
--
ALTER TABLE `types`
  ADD CONSTRAINT `types_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
