-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 04, 2024 at 11:31 AM
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
-- Database: `gigdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `bans`
--

CREATE TABLE `bans` (
  `id` int UNSIGNED NOT NULL,
  `bannable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bannable_id` bigint UNSIGNED NOT NULL,
  `created_by_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `expired_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `menu_id` int DEFAULT NULL,
  `order_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `fulfilled` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `user_id`, `menu_id`, `order_id`, `quantity`, `fulfilled`) VALUES
(1, 5, 4, 13, 1, 1),
(2, 5, 3, 14, 1, 1),
(3, 5, 4, 14, 2, 1),
(4, 5, 5, 14, 1, 1),
(5, 5, 3, 16, 1, 1),
(6, 5, 4, 16, 1, 1),
(7, 5, 3, 16, 1, 1),
(8, 5, 4, 16, 1, 1),
(9, 5, 4, 16, 1, 1),
(10, 5, 4, 16, 1, 1),
(11, 5, 4, 16, 1, 1),
(12, 5, 4, 16, 1, 1),
(13, 5, 4, 16, 1, 0),
(14, 5, 4, 16, 1, 1),
(15, 5, 3, 19, 1, 1),
(16, 5, 17, 19, 1, 1),
(17, 5, 4, 19, 1, 1),
(18, 5, 3, 22, 1, 1),
(19, 5, 27, 22, 1, 1),
(20, 9, 4, 23, 1, 1),
(22, 46, 3, 24, 1, 1),
(23, 46, 17, 24, 1, 1),
(24, 46, 5, 25, 1, 0),
(25, 46, 4, 36, 1, 0),
(26, 46, 3, 38, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ch_favorites`
--

CREATE TABLE `ch_favorites` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint NOT NULL,
  `favorite_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ch_favorites`
--

INSERT INTO `ch_favorites` (`id`, `user_id`, `favorite_id`, `created_at`, `updated_at`) VALUES
('2621a836-680f-45b3-8726-9d2ba3165337', 2, 46, '2024-04-14 21:36:49', '2024-04-14 21:36:49'),
('77990670-cb07-4efe-978e-70823ef110c9', 1, 2, '2024-04-11 23:04:05', '2024-04-11 23:04:05'),
('ac72cd2a-0ec2-411c-885a-5e58aff3e6c1', 2, 1, '2024-04-11 23:06:19', '2024-04-11 23:06:19'),
('ceb5d7b3-c654-42fc-83a2-f4c29b58a82e', 46, 2, '2024-04-14 19:58:26', '2024-04-14 19:58:26');

-- --------------------------------------------------------

--
-- Table structure for table `ch_messages`
--

CREATE TABLE `ch_messages` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_id` bigint NOT NULL,
  `to_id` bigint NOT NULL,
  `body` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ch_messages`
--

INSERT INTO `ch_messages` (`id`, `from_id`, `to_id`, `body`, `attachment`, `seen`, `created_at`, `updated_at`) VALUES
('31a41af5-8082-4122-8fc4-5486de8bcc4e', 1, 1, 'hi', NULL, 1, '2024-04-11 23:04:44', '2024-04-11 23:04:54');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `discountCode` varchar(255) DEFAULT NULL,
  `percentage` smallint DEFAULT NULL,
  `minSpend` decimal(6,2) DEFAULT NULL,
  `cap` decimal(5,2) DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` bigint NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int NOT NULL DEFAULT '0',
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `name`, `price`, `quantity`, `status`, `created_at`, `updated_at`) VALUES
(4, 'Knife', '10.00', 40, 'Unavailable', NULL, NULL),
(5, 'Table Cloth', '10.00', 100, 'Available', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'undefined',
  `estCost` decimal(6,2) DEFAULT '0.00',
  `allergic` int DEFAULT '0',
  `vegetarian` int DEFAULT '0',
  `vegan` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `description`, `price`, `image`, `size`, `type`, `estCost`, `allergic`, `vegetarian`, `vegan`) VALUES
(3, 'Rice', '1 cup of rice per person.', '10.00', '1708520182-Rice.jpg', '1-2', 'Etc.', '10.00', 0, 0, 0),
(4, 'Honey Glazed Chicken Wings', 'Price is per container.', '500.00', '1708518018-Honey Glazed Chicken Wings.jpg', '>5', 'Snacks', '500.00', 0, 0, 0),
(5, 'Fried Chicken', 'Price is per container.', '500.00', '1708517529-Fried Chicken.jpg', '>5', 'Snacks', '500.00', 0, 0, 0),
(6, 'Chicken Cordon Bleu', 'Price is per container.', '500.00', '1708517931-Chicken Cordon Bleu.jpg', '>5', 'Etc.', '500.00', 0, 0, 0),
(7, 'Chicken Ala Orange', 'Price is per container.', '500.00', '1708518108-Chicken Ala Orange.jpg', '>5', 'Snacks', '500.00', 0, 0, 0),
(8, 'Sweet and Sour Fish Fillet', 'Price is per container.', '500.00', '1708518320-Sweet and Sour Fish Fillet.jpg', '>5', 'Etc.', '500.00', 0, 0, 0),
(9, 'Mixed Vegetables with Tofu', 'Price is per container.', '500.00', '1708518644-Mixed Vegetables with Tofu.jpg', '>5', 'Etc.', '500.00', 0, 1, 0),
(10, 'Pork Menudo', 'Price per container.', '500.00', '1708518604-Pork Menudo.jpg', '>5', 'Etc.', '500.00', 0, 0, 0),
(11, 'Pancit Bihon', 'Per bilao/container.', '500.00', '1708518975-Pancit Bihon.jpg', '>5', 'Etc.', '500.00', 0, 0, 0),
(12, 'Beef with Vegetables', 'Price is per container.', '500.00', '1708519740-Beef with Vegetables.jpg', '>5', 'Etc.', '500.00', 0, 0, 0),
(13, 'Pork Caldereta', 'Price is per container.', '500.00', '1708519876-Pork Caldereta.jpg', '>5', 'Etc.', '500.00', 0, 0, 0),
(14, 'Beef Caldereta', 'Price is per container.', '500.00', '1708520397-Beef Caldereta.jpg', '>5', 'Etc.', '500.00', 0, 0, 0),
(15, 'Pork Afritada', 'Price is per container.', '500.00', '1708520680-Pork Afritada.jpg', '>5', 'Etc.', '500.00', 0, 0, 0),
(16, 'Cucumber Juice', 'Price is per glass.', '50.00', '1708521058-Cucumber Juice.jpg', '1-2', 'Fruit Tea', '50.00', 0, 0, 0),
(17, 'House Blend Ice Tea', 'Price is per glass.', '50.00', '1708521251-House Blend Ice Tea.jpg', '1-2', 'Fruit Tea', '50.00', 0, 0, 0),
(18, 'Carbonara with Toast Bread', 'Serving size is plate per person.', '89.00', '1708523903-Carbonara with Toast Bread.jpg', '1-2', 'Pasta', '89.00', 0, 0, 0),
(19, 'Spaghetti with Toast Bread', 'Serving size is plate per person.', '75.00', '1708523958-Spaghetti with Toast Bread.jpg', '1-2', 'Pasta', '75.00', 0, 0, 0),
(20, 'Strawberry Milk Tea', 'Small/16 oz per serving.', '70.00', '1708524293-Strawberry Milk Tea.jpg', '1-2', 'Milk Tea', '70.00', 0, 0, 0),
(21, 'Matcha Milk Tea', 'Small/16 oz per serving.', '70.00', '1708524841-Matcha Milk Tea.jpg', '1-2', 'Milk Tea', '70.00', 0, 0, 0),
(22, 'Chocolate Milk Tea', 'Small/16 oz per serving.', '70.00', '1708525251-Lychee Milk Tea.jpg', '1-2', 'Milk Tea', '70.00', 0, 0, 0),
(23, 'Dark Chocolate Milk Tea', 'Small/16 oz per serving.', '70.00', '1708525343-Dark Chocolate Milk Tea.jpg', '1-2', 'Milk Tea', '70.00', 0, 0, 0),
(24, 'Taro Milk Tea', 'Small/16 oz per serving.', '70.00', '1708525771-Taro Milk Tea.jpg', '1-2', 'Milk Tea', '70.00', 0, 0, 0),
(25, 'Red Velvet', 'Small/16 oz per serving.', '70.00', '1708525704-Red Velvet.jpg', '1-2', 'Milk Tea', '70.00', 0, 0, 0),
(26, 'Mango Milk Tea', 'Small/16 oz per serving.', '70.00', '1708525952-Mango Milk Tea.jpg', '1-2', 'Milk Tea', '70.00', 0, 0, 0),
(27, 'Dasilog', 'Serving size good for 1 person.', '75.00', '1708526456-Longsilog.jpg', '1-2', 'Silog', '75.00', 0, 0, 0),
(28, 'Sisigsilog', 'Serving size good for 1 person.', '75.00', '1708527058-Sisigsilog.jpg', '1-2', 'Silog', '75.00', 0, 0, 0),
(29, 'Loaded Cheesy Fries', 'Small Serving size.', '59.00', '1708527392-Loaded Cheesy Fries.jpg', '1-2', 'Snacks', '115.00', 0, 0, 0),
(30, 'Loaded Nachos', 'Small Serving size.', '59.00', '1708527566-Loaded Nachos.jpg', '1-2', 'Snacks', '59.00', 0, 0, 0),
(31, 'Classic Burger', 'SIngle beef burger.', '79.00', '1708527923-Classic Burger.jpg', '1-2', 'Burger', '79.00', 0, 0, 0),
(32, 'Burger Overload', 'Burger beef patty with cheese and dressing.', '149.00', '1708527986-Burger Overload.jpg', '1-2', 'Burger', '149.00', 0, 0, 0),
(33, 'Cheesy Beef Burger', 'Burger beef patty with cheese.', '119.00', '1708528143-Cheesy Beef Burger.jpg', '1-2', 'Burger', '119.00', 0, 0, 0),
(34, 'French Fries', 'Small Serving of Classic French Fries with cheese/salt seasoning.', '29.00', '1708528315-French Fries.jpg', '1-2', 'Snacks', '29.00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint UNSIGNED NOT NULL,
  `message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_id` bigint UNSIGNED NOT NULL,
  `receiver` bigint UNSIGNED NOT NULL,
  `is_seen` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `file` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `message`, `user_id`, `receiver`, `is_seen`, `created_at`, `updated_at`, `file`, `file_name`) VALUES
(1, 'Rerum et quam qui labore dolore rem aliquam.', 3, 14, 0, '2024-04-03 06:28:47', '2024-04-03 06:28:47', NULL, NULL),
(2, 'Sint minus molestias eaque.', 8, 14, 0, '2024-04-03 06:28:47', '2024-04-03 06:28:47', NULL, NULL),
(3, 'Qui explicabo recusandae iusto ea.', 11, 14, 0, '2024-04-03 06:28:47', '2024-04-03 06:28:47', NULL, NULL),
(4, 'Blanditiis consequatur qui delectus voluptatem et modi.', 2, 14, 0, '2024-04-03 06:28:47', '2024-04-03 06:28:47', NULL, NULL),
(5, 'Hic ex amet minima similique ut.', 5, 14, 0, '2024-04-03 06:28:47', '2024-04-03 06:28:47', NULL, NULL),
(6, 'Unde nisi numquam saepe deserunt laudantium consectetur.', 3, 14, 0, '2024-04-03 06:28:47', '2024-04-03 06:28:47', NULL, NULL),
(7, 'Aut et enim dolore quo.', 7, 14, 0, '2024-04-03 06:28:47', '2024-04-03 06:28:47', NULL, NULL),
(8, 'Atque odit quas et inventore in maiores.', 13, 14, 1, '2024-04-03 06:28:47', '2024-04-03 06:30:50', NULL, NULL),
(9, 'Unde molestiae error saepe incidunt quia.', 3, 14, 0, '2024-04-03 06:28:47', '2024-04-03 06:28:47', NULL, NULL),
(10, 'Fugiat nostrum et non omnis animi.', 8, 14, 0, '2024-04-03 06:28:47', '2024-04-03 06:28:47', NULL, NULL),
(11, 'Mollitia qui voluptatem velit corrupti aspernatur quo quia.', 6, 14, 0, '2024-04-03 06:28:47', '2024-04-03 06:28:47', NULL, NULL),
(12, 'Non minima delectus eos ut quis ipsam.', 9, 14, 0, '2024-04-03 06:28:47', '2024-04-03 06:28:47', NULL, NULL),
(13, 'sca', 1, 14, 1, '2024-04-03 06:29:47', '2024-04-03 06:31:04', NULL, NULL),
(14, 'saswqs', 14, 1, 0, '2024-04-03 06:30:54', '2024-04-03 06:30:54', NULL, NULL),
(15, '', 1, 14, 0, '2024-04-03 06:31:56', '2024-04-03 06:31:56', 'http://127.0.0.1:8000/storage/files/fpWMpt9C1MBDAKEZWaFgZR4quAgLxcOWdMq6mj5Z.jpg', '7373.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_02_19_093623_create_menus_table', 1),
(6, '2024_04_03_999999_add_active_status_to_users', 2),
(7, '2024_04_03_999999_add_avatar_to_users', 2),
(8, '2024_04_03_999999_add_dark_mode_to_users', 2),
(9, '2024_04_03_999999_add_messenger_color_to_users', 2),
(10, '2024_04_03_999999_create_chatify_favorites_table', 2),
(11, '2024_04_03_999999_create_chatify_messages_table', 2),
(12, '2017_03_04_000000_create_bans_table', 3),
(13, '2024_05_04_095105_create_payments_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dateTime` timestamp NULL DEFAULT NULL,
  `completed` tinyint(1) DEFAULT '0',
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `created_at`, `updated_at`, `dateTime`, `completed`, `type`) VALUES
(1, 3, '2024-02-09 02:24:36', '2024-02-09 02:24:36', '2024-02-09 10:24:00', 0, 'dineIn'),
(2, 3, '2024-02-09 02:36:51', '2024-02-09 02:36:51', '2024-02-09 10:36:00', 0, 'takeAway'),
(4, 3, '2024-02-09 21:35:23', '2024-02-09 21:35:23', '2024-02-10 05:35:00', 0, 'dineIn'),
(6, 5, '2024-02-11 01:40:39', '2024-02-11 01:40:39', '2024-02-11 09:40:00', 0, 'dineIn'),
(7, 5, '2024-02-11 06:30:47', '2024-02-11 06:30:47', '2024-02-11 14:30:00', 0, 'dineIn'),
(9, 5, '2024-02-21 05:18:02', '2024-02-21 05:18:02', '2024-02-21 13:17:00', 0, 'takeAway'),
(10, 7, '2024-04-01 19:12:34', '2024-04-01 19:12:34', '2024-04-03 03:12:00', 0, 'takeAway'),
(11, 5, '2024-04-02 14:55:34', '2024-04-02 14:55:34', '2024-04-03 22:55:00', 0, 'takeAway'),
(12, 5, '2024-04-02 14:55:34', '2024-04-02 14:55:34', '2024-04-03 22:55:00', 0, 'takeAway'),
(13, 5, '2024-04-02 15:42:06', '2024-04-02 15:42:46', '2024-04-10 23:41:00', 1, 'takeAway'),
(14, 5, '2024-04-02 15:46:42', '2024-04-02 15:47:54', '2024-04-03 23:46:00', 1, 'takeAway'),
(16, 5, '2024-04-02 21:39:34', '2024-04-02 21:44:18', '2024-04-04 05:39:00', 1, 'takeAway'),
(19, 5, '2024-04-02 22:04:43', '2024-04-02 22:47:06', '2024-04-04 06:04:00', 1, 'takeAway'),
(22, 5, '2024-04-02 22:37:47', '2024-04-02 22:46:51', '2024-04-04 06:37:00', 1, 'takeAway'),
(23, 9, '2024-04-02 22:46:02', '2024-04-02 22:46:45', '2024-04-04 06:45:00', 1, 'takeAway'),
(24, 46, '2024-04-07 20:38:31', '2024-05-03 18:48:46', '2024-04-09 05:38:00', 1, 'takeAway'),
(25, 46, '2024-05-04 01:39:02', '2024-05-04 01:39:02', '2024-05-05 09:38:00', 0, 'takeAway'),
(26, 46, '2024-05-04 02:29:34', '2024-05-04 02:29:34', '2024-05-14 10:29:00', 0, 'dineIn'),
(27, 46, '2024-05-04 02:34:54', '2024-05-04 02:34:54', '2024-05-06 10:34:00', 0, 'dineIn'),
(28, 46, '2024-05-04 02:35:26', '2024-05-04 02:35:26', '2024-05-06 10:34:00', 0, 'takeAway'),
(29, 46, '2024-05-04 02:37:02', '2024-05-04 02:37:02', '2024-05-06 10:34:00', 0, 'takeAway'),
(30, 46, '2024-05-04 02:37:25', '2024-05-04 02:37:25', '2024-05-05 10:37:00', 0, 'takeAway'),
(31, 46, '2024-05-04 02:48:29', '2024-05-04 02:48:29', '2024-05-05 10:48:00', 0, 'takeAway'),
(32, 46, '2024-05-04 02:48:29', '2024-05-04 02:48:29', '2024-05-05 10:48:00', 0, 'takeAway'),
(36, 46, '2024-05-04 03:21:54', '2024-05-04 03:21:54', '2024-05-05 11:21:00', 0, 'takeAway'),
(38, 46, '2024-05-04 03:24:04', '2024-05-04 03:24:04', '2024-05-14 11:24:00', 0, 'takeAway');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guest_number` int NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'avaliable',
  `price` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `user_id`, `name`, `description`, `image`, `guest_number`, `status`, `price`, `created_at`, `updated_at`) VALUES
(28, NULL, 'Menu A', 'This Package includes Chicken Wings (Spicy/Honey Glazed), Mixed Vegetables with Tofu, Pork Menudo, Beef Caldereta, Creamy Gelatin, Cucumber Juice, Rice and an inclusion of either Pancit Bihon/Spaghetti/Sotanghon.', 'public/packages/uL1c4GkpeQ9OCdvh7k8KtSx0WzMOiw36vDfcyPmU.jpg', 100, 'available', 3599, '2024-02-20 21:33:40', '2024-04-13 21:43:26'),
(29, NULL, 'Menu B', 'This Package includes Fried Chicken, Pork Afritada, Fish Fillet (Sweet and Sour), Beef w/ vegetables, Leche Flan, House Blended Ice Tea, Rice and an inclusion of either Pancit Bihon/Spaghetti/Sotanghon.', 'public/packages/Ass6Dm9YnNdyBCbgTUxnQkGPOwzjVUOFqNHyqHxb.jpg', 100, 'available', 1500, '2024-02-20 21:42:25', '2024-04-13 21:43:13'),
(30, NULL, 'Menu C', 'This Package includes Chicken Ala Orange, Pork Caldereta, Brasied Beef w/ Coffee Beans, Chopseuy, Buko Pandan, Soda, Rice and an inclusion of either Pancit Bihon/Spaghetti/Sotanghon.', 'public/packages/3Yqs5WVZdyWbLTjfnvxzYZ6Sx2mLAWwEGJVlw6XO.jpg', 100, 'available', 1399, '2024-02-20 21:44:31', '2024-04-13 21:42:56'),
(31, NULL, 'Menu D', 'This Package includes Chicken Cordon Bleu, Pork Asado, Beef w/ Broccoli, Lumpiang Hubad, Mango Tapioca, Cucumber Juice, Rice and an inclusion of either Pancit Bihon/Spaghetti/Sotanghon.', 'public/packages/E9Hp5m8J37DIxGOM2Ycgaq4FkbzA7qBcBTL5twMB.jpg', 100, 'available', 1299, '2024-02-21 05:54:17', '2024-04-13 21:34:08');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('customer@gmail.com', '$2y$10$jCrl9UOxCDaD0E7LP4mMhODQfjagMS3AqN3iJmD6qpKPYumNkLb76', '2024-02-11 16:49:04'),
('pachecoking38@gmail.com', '$2y$10$ZQlOIlMAW5ognOuk2wFOruX00FQuqcHYscCQv3gX.08zNqwXn8ZTu', '2024-04-02 07:02:19'),
('squadquinx8@gmail.com', '$2y$10$w2gaAGrT1CcsMRM9Yx1qyOiDtJSc37UiReshYs/.dPqUHcXVRBtPO', '2024-04-04 16:18:57');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint UNSIGNED NOT NULL,
  `payment_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payer_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payer_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(10,2) NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `payment_id`, `payer_id`, `payer_email`, `amount`, `currency`, `payment_status`, `created_at`, `updated_at`) VALUES
(2, 'PAYID-MY3BWGI8CJ34475471419604', 'R8HYARYLLR8FQ', 'Customer@personal.account.com', 120.00, 'PHP', 'approved', '2024-05-04 03:25:36', '2024-05-04 03:25:36');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` bigint UNSIGNED NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `tel_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` bigint NOT NULL DEFAULT '1',
  `package_id` bigint NOT NULL DEFAULT '1',
  `inventory_supplies` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Not fulfilled',
  `res_date` datetime NOT NULL,
  `guest_number` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `first_name`, `last_name`, `email`, `tel_number`, `service_id`, `package_id`, `inventory_supplies`, `status`, `res_date`, `guest_number`, `created_at`, `updated_at`, `user_id`) VALUES
(63, 'King', 'Pacheco', 'pachecoking38@gmail.com', '09948862312', 28, 28, 'Bring Own Supplies', 'Not fulfilled', '2024-04-21 15:25:00', 44, '2024-04-19 23:26:01', '2024-04-19 23:26:01', NULL),
(66, 'King', 'Pacheco', 'jermey13@example.net', '09948862312', 29, 28, 'Bring Own Supplies', 'Not fulfilled', '2024-04-21 16:23:00', 44, '2024-04-20 00:23:22', '2024-04-20 00:23:22', NULL),
(68, 'King', 'Pacheco', 'pachecoking38@gmail.com', '09948862312', 29, 31, 'Knife (8), Table Cloth (23)', 'Not fulfilled', '2024-05-05 16:18:00', 44, '2024-05-04 00:19:16', '2024-05-04 00:19:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `image`, `created_at`, `updated_at`) VALUES
(28, 'Wedding', 'Wedding Service', 'public/services/tWcSIyhYYy6Cjn52a532GNu8SPxJhWufRYYOA2a8.jpg', '2024-02-20 22:16:09', '2024-02-20 22:16:09'),
(29, 'Birthday', 'Birthday Service', 'public/services/Wy2g3q9SqWKoVPJzw0YTYtXxZaOkYQp1s2Ij8EBR.jpg', '2024-02-20 22:18:02', '2024-02-20 22:18:02');

-- --------------------------------------------------------

--
-- Table structure for table `service_group`
--

CREATE TABLE `service_group` (
  `service_id` bigint UNSIGNED NOT NULL,
  `package_id` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_group`
--

INSERT INTO `service_group` (`service_id`, `package_id`) VALUES
(29, 31),
(29, 30),
(29, 29),
(29, 28);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int NOT NULL,
  `order_id` int DEFAULT NULL,
  `discount_id` int DEFAULT NULL,
  `final_amount` decimal(6,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `order_id`, `discount_id`, `final_amount`, `created_at`, `updated_at`) VALUES
(1, 12, NULL, '1611.20', '2024-04-02 15:05:37', '2024-04-02 15:05:37'),
(2, 13, NULL, '530.00', '2024-04-02 15:42:26', '2024-04-02 15:42:26'),
(3, 14, NULL, '1600.60', '2024-04-02 15:46:55', '2024-04-02 15:46:55'),
(4, 16, NULL, '4261.20', '2024-04-02 21:42:31', '2024-04-02 21:42:31'),
(5, 19, NULL, '593.60', '2024-04-02 22:06:00', '2024-04-02 22:06:00'),
(6, 22, NULL, '90.10', '2024-04-02 22:43:45', '2024-04-02 22:43:45'),
(7, 23, NULL, '530.00', '2024-04-02 22:46:23', '2024-04-02 22:46:23'),
(8, 24, NULL, '63.60', '2024-04-07 20:39:16', '2024-04-07 20:39:16'),
(9, 25, NULL, '530.00', '2024-05-04 01:40:53', '2024-05-04 01:40:53'),
(10, 36, NULL, '530.00', '2024-05-04 03:22:26', '2024-05-04 03:22:26'),
(11, 38, NULL, '10.60', '2024-05-04 03:24:33', '2024-05-04 03:24:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contactnum` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `status` int NOT NULL DEFAULT '1',
  `active_status` tinyint(1) NOT NULL DEFAULT '0',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'avatar.png',
  `dark_mode` tinyint(1) NOT NULL DEFAULT '0',
  `messenger_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `contactnum`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `status`, `active_status`, `avatar`, `dark_mode`, `messenger_color`) VALUES
(1, 'Admin', 'admin', 'gigcafe026@gmail.com', '09948862312', '2024-04-04 01:54:39', '$2y$10$3DsTsm3xbZ1VlI1r1lsjqOIlvWcVcuI/JdAgaeyYgZXjD8frjB4RC', 'kSFEelCCPKhfANl8CIm5v6cj3fKPsjgydFIBT0EhoSnpBQbVmuiPV8BwIPA8', '2024-02-09 01:55:19', '2024-04-13 02:12:53', 'admin', 0, 1, 'avatar.png', 0, '#ff2522'),
(2, 'Staff', 'Staff', 'squadquinx8@gmail.com', '09151997276', '2024-04-04 01:57:02', '$2y$10$XX.Tow31ysr6yAfAJXLdT.QUnfvg5455pHGVYI.WZwC/nfiK73vLC', 'eULyCBFZOkVqUHPPrJHW2QROSOVnUl6ayLI0VpGHohl0jaDEnUHdT3mIoSFE', '2024-02-09 02:00:05', '2024-04-13 02:13:15', 'kitchenStaff', 0, 0, 'avatar.png', 0, '#ff2522'),
(46, 'JayJay Pacheco', 'JayJay', 'pachecoking38@gmail.com', '9451997276', '2024-04-07 20:32:28', '$2y$10$7zYYbdCB.9H2DfsejrMgb.rfGODhE9NkctO6cRFsKb8Ya8GILlyLa', 'WtG9OlcDkvBCo3y5wR81ZMBMMuELh96gNGeAGSp4amikHAGeBaqk7tgF8B7O', '2024-04-07 20:32:03', '2024-04-12 23:28:10', 'customer', 0, 0, 'avatar.png', 0, NULL),
(54, 'Jackson Gleichner', 'iferry', 'jermey13@example.net', '(657) 397-4245', '2024-04-13 01:32:04', '$2y$10$7zYYbdCB.9H2DfsejrMgb.rfGODhE9NkctO6cRFsKb8Ya8GILlyLa', 'Tj3pZ6J3tPM2W2vUK3CiLW9eF6335qPd6uNKSJjBNgpw51ScNLaZPdcohIMN', '2024-04-13 01:32:04', '2024-04-13 01:39:48', 'customer', 1, 0, 'avatar.png', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bans`
--
ALTER TABLE `bans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bans_bannable_type_bannable_id_index` (`bannable_type`,`bannable_id`),
  ADD KEY `bans_created_by_type_created_by_id_index` (`created_by_type`,`created_by_id`),
  ADD KEY `bans_expired_at_index` (`expired_at`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ch_favorites`
--
ALTER TABLE `ch_favorites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ch_messages`
--
ALTER TABLE `ch_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_user_id_foreign` (`user_id`),
  ADD KEY `messages_receiver_foreign` (`receiver`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_group`
--
ALTER TABLE `service_group`
  ADD KEY `service_group_package_id_foreign` (`package_id`),
  ADD KEY `service_group_service_id_foreign` (`service_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `discount_id` (`discount_id`);

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
-- AUTO_INCREMENT for table `bans`
--
ALTER TABLE `bans`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`discount_id`) REFERENCES `discounts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
