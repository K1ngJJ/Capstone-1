-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 31, 2024 at 05:13 PM
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
(26, 46, 3, 38, 1, 1),
(27, 46, 5, 41, 1, 1),
(28, 46, 5, 41, 2, 1),
(29, 46, 4, 42, 1, 1),
(30, 46, 3, 44, 1, 1),
(33, 94, 4, NULL, 1, 0),
(35, 46, 23, 45, 1, 1),
(36, 94, 3, NULL, 1, 0),
(37, 94, 27, NULL, 1, 0),
(38, 46, 27, 46, 2, 1),
(39, 106, 3, 47, 1, 0),
(40, 106, 3, 48, 1, 0),
(43, 106, 5, 49, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `catering_options`
--

CREATE TABLE `catering_options` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `catering_options`
--

INSERT INTO `catering_options` (`id`, `name`, `description`, `image`, `created_at`, `updated_at`) VALUES
(35, 'Complete Catering', '(for all-inclusive packages)', 'public/cateringoptions/sbmWkGJakKZ4E1y0BH6s9NyrOnkSttHUGJ3zlwzM.jpg', '2024-08-29 22:02:19', '2024-08-29 22:25:12'),
(36, 'Service-Only Catering', '(for services without food)', 'public/cateringoptions/3ku9Q4PFAt80d4EJE4g94OBEvwaAFomO8Xe4d10P.jpg', '2024-08-29 22:25:57', '2024-08-29 22:25:57'),
(37, 'Equipment Rental', '(for renting catering equipment)', 'public/cateringoptions/vZv9RLn0znyEbwl0J6JHpQmWhx4OSLJQYFs04UZk.jpg', '2024-08-29 22:26:26', '2024-08-29 22:26:26');

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
('05a8284a-fe5b-4908-b302-a93af2c8fa8a', 1, 2, 'pre punta kana dito', NULL, 1, '2024-05-12 20:02:19', '2024-05-12 20:02:46'),
('10f9a00f-fa58-4764-83fd-7c7de8f874e9', 1, 46, 'QWDSQWDQWD', NULL, 1, '2024-05-14 00:48:43', '2024-05-14 00:48:44'),
('1bad8952-2081-46e7-ab47-d55d31a421ad', 1, 46, '123', NULL, 1, '2024-05-12 20:12:43', '2024-05-12 20:13:05'),
('214691bc-46d9-4160-af0a-f70b067106fa', 1, 46, 'djdjkdjawbdhkwaDHWQDKU', NULL, 1, '2024-05-14 00:48:24', '2024-05-14 00:48:30'),
('31a41af5-8082-4122-8fc4-5486de8bcc4e', 1, 1, 'hi', NULL, 1, '2024-04-11 23:04:44', '2024-04-11 23:04:54'),
('3cfbcd1f-8ef7-4349-8401-4ba1c49812ac', 106, 2, 'dd', NULL, 0, '2024-05-22 23:49:24', '2024-05-22 23:49:24'),
('3eeb11b4-675e-4384-9944-252596c11d70', 1, 46, '🐱', NULL, 1, '2024-05-14 00:49:24', '2024-05-14 00:49:26'),
('400d17df-ab1c-448a-b674-8314fddc5918', 1, 46, 'AHDAHDVJA', NULL, 1, '2024-05-15 21:47:47', '2024-05-15 21:47:47'),
('69d9d7e4-959b-4166-badc-adfebef8bf86', 1, 93, 'wqhdwqhdqlkd', NULL, 1, '2024-05-14 22:27:30', '2024-05-14 22:28:03'),
('84d777e1-abec-48df-a445-62368214b48a', 46, 1, '', '{\"new_name\":\"8ef70c62-3a41-4672-b857-6fdd1a7e98f9.jpg\",\"old_name\":\"561124.jpg\"}', 1, '2024-05-14 00:51:16', '2024-05-14 22:26:35'),
('8eb320c8-313e-43f5-bfa4-5aad51ef31d1', 93, 1, 'dwldjoqwdjk', NULL, 1, '2024-05-14 22:28:49', '2024-05-14 22:28:50'),
('af05ee48-a0b7-4f50-8846-17f3d0026f53', 1, 46, '', '{\"new_name\":\"f435239a-9e20-41a0-89f8-9c1981db9cf5.jpg\",\"old_name\":\"17947.jpg\"}', 1, '2024-05-14 00:50:10', '2024-05-14 00:51:04'),
('b13caedc-2d44-4a7a-bac8-e685355a6791', 46, 1, 'DWDQWDJWVDHWVEJHD', NULL, 1, '2024-05-14 00:48:36', '2024-05-14 00:48:36'),
('b3e96175-6f35-4b08-aac7-9d30e2e68e6b', 1, 46, '🥰😙😙😊', NULL, 1, '2024-05-15 21:46:53', '2024-05-15 21:47:18'),
('c58541d8-4778-4674-bc8a-88dfaa724c1c', 1, 93, 'awkjdwakdhawih🤗', NULL, 1, '2024-05-14 22:28:25', '2024-05-14 22:28:26'),
('ca584f6a-5db5-437e-a4fc-efdc1c91e571', 46, 1, '', '{\"new_name\":\"f487a583-87fd-409e-b91a-0270e707ad6c.jpg\",\"old_name\":\"7314.jpg\"}', 1, '2024-05-14 00:49:37', '2024-05-14 00:49:38'),
('d02fd51b-66a3-48d0-895f-f3bdb44941b6', 1, 93, '', '{\"new_name\":\"bc6cee98-6d5b-4121-902b-6282c0e29388.jpg\",\"old_name\":\"436859018_391315340545971_5221176735793842929_n.jpg\"}', 1, '2024-05-14 22:28:39', '2024-05-14 22:28:40'),
('fb0022f7-f59e-47e2-b524-f018f074b725', 46, 1, 'DWQDWFRGFEFERFREF', NULL, 1, '2024-05-14 00:48:55', '2024-05-14 00:48:57'),
('fc3f8359-0ea6-465c-85ed-d41768c0800b', 1, 46, '😝', NULL, 1, '2024-05-14 00:49:06', '2024-05-14 00:49:08');

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

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `created_at`, `updated_at`, `discountCode`, `percentage`, `minSpend`, `cap`, `startDate`, `endDate`, `description`) VALUES
(1, '2024-05-12 20:11:58', '2024-05-21 21:53:25', '123', 10, '100.00', '200.00', '2024-05-22', '2024-05-23', 'hgfasdhjkasdkhiuh');

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
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `category` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `image`, `category`, `created_at`, `updated_at`) VALUES
(15, '1715272929-.jpg', 'Wedding', '2024-05-09 07:17:08', '2024-05-09 08:42:09'),
(17, '1715361551-436859018_391315340545971_5221176735793842929_n.jpg', 'Birthday', '2024-05-10 09:19:11', '2024-05-10 09:19:11');

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
(4, 'Knife', '10.00', 1, 'Available', NULL, NULL),
(5, 'Table Cloth', '10.00', 100, 'Available', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_reservation`
--

CREATE TABLE `inventory_reservation` (
  `id` bigint UNSIGNED NOT NULL,
  `inventory_id` bigint UNSIGNED NOT NULL,
  `reservation_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(13, '2024_05_04_095105_create_payments_table', 4),
(14, '2014_10_12_200000_add_two_factor_columns_to_users_table', 5),
(15, '2024_04_15_144152_create_ratings_table', 5),
(16, '2024_05_06_114714_create_sessions_table', 5),
(17, '2024_05_22_135053_create_notifications_table', 6),
(18, '2024_05_22_135602_create_notifications_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint NOT NULL,
  `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(48, 106, '2024-05-22 18:22:10', '2024-05-22 19:34:03', '2024-05-24 02:22:00', 1, 'Dine-In'),
(49, 106, '2024-06-05 06:00:05', '2024-06-05 06:00:05', '2024-06-07 13:59:00', 0, 'Take-Out');

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
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Available',
  `price` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `user_id`, `name`, `description`, `image`, `guest_number`, `status`, `price`, `created_at`, `updated_at`) VALUES
(28, NULL, 'Menu A', 'This Package includes Chicken Wings (Spicy/Honey Glazed), Mixed Vegetables with Tofu, Pork Menudo, Beef Caldereta, Creamy Gelatin, Cucumber Juice, Rice and an inclusion of either Pancit Bihon/Spaghetti/Sotanghon.', 'public/packages/uL1c4GkpeQ9OCdvh7k8KtSx0WzMOiw36vDfcyPmU.jpg', 100, 'available', 3599, '2024-02-20 21:33:40', '2024-05-24 20:57:35'),
(29, NULL, 'Menu B', 'This Package includes Fried Chicken, Pork Afritada, Fish Fillet (Sweet and Sour), Beef w/ vegetables, Leche Flan, House Blended Ice Tea, Rice and an inclusion of either Pancit Bihon/Spaghetti/Sotanghon.', 'public/packages/Ass6Dm9YnNdyBCbgTUxnQkGPOwzjVUOFqNHyqHxb.jpg', 100, 'available', 1500, '2024-02-20 21:42:25', '2024-04-13 21:43:13'),
(30, NULL, 'Menu C', 'This Package includes Chicken Ala Orange, Pork Caldereta, Brasied Beef w/ Coffee Beans, Chopseuy, Buko Pandan, Soda, Rice and an inclusion of either Pancit Bihon/Spaghetti/Sotanghon.', 'public/packages/3Yqs5WVZdyWbLTjfnvxzYZ6Sx2mLAWwEGJVlw6XO.jpg', 100, 'available', 1399, '2024-02-20 21:44:31', '2024-04-13 21:42:56'),
(31, NULL, 'Menu D', 'This Package includes Chicken Cordon Bleu, Pork Asado, Beef w/ Broccoli, Lumpiang Hubad, Mango Tapioca, Cucumber Juice, Rice and an inclusion of either Pancit Bihon/Spaghetti/Sotanghon.', 'public/packages/E9Hp5m8J37DIxGOM2Ycgaq4FkbzA7qBcBTL5twMB.jpg', 100, 'available', 1299, '2024-02-21 05:54:17', '2024-05-20 04:49:08');

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
  `reservation_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `payment_id`, `payer_id`, `payer_email`, `amount`, `currency`, `payment_status`, `reservation_id`, `created_at`, `updated_at`) VALUES
(28, 'PAYID-MZI5NJQ55J997927X152974B', 'R8HYARYLLR8FQ', 'Customer@personal.account.com', 400.00, 'PHP', 'approved', 154, '2024-05-25 04:16:51', '2024-05-25 04:16:51'),
(29, 'PAYID-MZN7LKI362151836B911704B', 'R8HYARYLLR8FQ', 'Customer@personal.account.com', 1000.00, 'PHP', 'approved', 160, '2024-06-01 20:31:55', '2024-06-01 20:31:55'),
(30, 'PAYID-MZN7MNQ0VE907440V512863M', 'R8HYARYLLR8FQ', 'Customer@personal.account.com', 100.00, 'PHP', 'approved', 161, '2024-06-01 20:34:08', '2024-06-01 20:34:08'),
(31, 'PAYID-M3HSGQA50A824991H352671T', 'R8HYARYLLR8FQ', 'Customer@personal.account.com', 123.00, 'PHP', 'approved', 165, '2024-08-28 05:17:04', '2024-08-28 05:17:04'),
(32, 'PAYID-M3HSG5A71G70898W0472031C', 'R8HYARYLLR8FQ', 'Customer@personal.account.com', 1234.00, 'PHP', 'approved', 165, '2024-08-28 05:17:48', '2024-08-28 05:17:48'),
(33, 'PAYID-M3HSNGY9XK8007343178850M', 'R8HYARYLLR8FQ', 'Customer@personal.account.com', 1132.00, 'PHP', 'approved', 164, '2024-08-28 05:31:16', '2024-08-28 05:31:16');

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
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` bigint NOT NULL,
  `service_rating` double NOT NULL,
  `package_rating` double NOT NULL,
  `service_id` bigint NOT NULL,
  `package_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `reserv_id` int NOT NULL,
  `comment` varchar(255) NOT NULL,
  `rated` int NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `service_rating`, `package_rating`, `service_id`, `package_id`, `user_id`, `reserv_id`, `comment`, `rated`, `created_at`, `updated_at`) VALUES
(58, 3, 3, 28, 28, 106, 162, 'qwertyu', 1, '2024-08-28 19:36:23', '2024-08-28 19:36:23');

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
  `cateringoption_id` bigint UNSIGNED NOT NULL,
  `package_id` bigint NOT NULL DEFAULT '1',
  `inventory_supplies` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `payment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Not Paid',
  `res_date` datetime NOT NULL,
  `guest_number` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'customer',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `first_name`, `last_name`, `email`, `tel_number`, `service_id`, `cateringoption_id`, `package_id`, `inventory_supplies`, `status`, `payment_status`, `res_date`, `guest_number`, `created_at`, `updated_at`, `user_id`, `role`, `deleted_at`) VALUES
(169, 'King', 'Pacheco', 'pachecoking38@gmail.com', '09948862312', 1, 1, 1, '', 'Pending', 'Pay in Restaurant', '2024-08-30 09:04:00', 100, '2024-08-29 15:04:41', '2024-08-29 15:04:41', 106, 'customer', NULL),
(176, 'King', 'Pacheco', 'pachecoking38@gmail.com', '09948862312', 29, 37, 30, '', 'Pending', 'Down Payment', '2024-09-01 09:08:00', 100, '2024-08-31 09:09:15', '2024-08-31 09:09:15', 106, 'customer', NULL);

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
(1, 48, NULL, '10.60', '2024-05-22 18:22:21', '2024-05-22 18:22:21'),
(18, 49, NULL, '530.00', '2024-06-05 06:00:32', '2024-06-05 06:00:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `messenger_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `status`, `active_status`, `avatar`, `dark_mode`, `messenger_color`, `mobile_number`) VALUES
(1, 'Admin', 'admin', 'gigcafe026@gmail.com', '2024-04-04 01:54:39', '$2y$10$3DsTsm3xbZ1VlI1r1lsjqOIlvWcVcuI/JdAgaeyYgZXjD8frjB4RC', 'ExnuvwNIpGDHXSpGQJUIcgZIBvZ5tr22cc58cO4JIOkjiXa1Dw9uxB4Uj6OU', '2024-02-09 01:55:19', '2024-05-15 21:47:19', 'admin', 1, 1, 'avatar.png', 0, '#ff2522', ''),
(2, 'Staff', 'Staff', 'squadquinx8@gmail.com', '2024-04-04 01:57:02', '$2y$10$XX.Tow31ysr6yAfAJXLdT.QUnfvg5455pHGVYI.WZwC/nfiK73vLC', 'ub7LPYBtEHgVgKHPN4z7pkOx3IydNhVjs7MUydaQfBKFiRk4H8SheS0tbfej', '2024-02-09 02:00:05', '2024-05-12 20:03:40', 'kitchenStaff', 1, 0, 'avatar.png', 1, '#3F51B5', ''),
(104, 'King JayJay Pacheco', 'QQ', 'pachecokingjj@gmail.com', '2024-05-22 15:45:17', '$2y$10$8N6jNtjkHFtB7yBRJJq7dei6E87VfL3Dfhsx7mgSLsStHld/ZDJxa', 'n8Q2WcAfzUpW2AMEPQ1aGsiUxdRB9sUQVIVmmYNXxcWX1B7sIxeZJPtjG2yi', '2024-05-22 15:44:31', '2024-05-22 15:45:17', 'customer', 1, 0, 'avatar.png', 0, NULL, 'QQ'),
(106, 'King JayJay Pacheco', 'JayJay', 'pachecoking38@gmail.com', '2024-05-22 18:20:18', '$2y$10$unInCzmvl50Yf6vT4ciMpuvBY2fsNt9Up31aCB.PNLuKDMvfhqBKK', NULL, '2024-05-22 17:37:07', '2024-08-30 04:30:05', 'customer', 1, 0, 'avatar.png', 1, NULL, '09451997276');

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
-- Indexes for table `catering_options`
--
ALTER TABLE `catering_options`
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
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_reservation`
--
ALTER TABLE `inventory_reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_inventory_reservation_reservation_id` (`reservation_id`);

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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

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
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservations_user_id_foreign` (`user_id`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `catering_options`
--
ALTER TABLE `catering_options`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `inventory_reservation`
--
ALTER TABLE `inventory_reservation`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventory_reservation`
--
ALTER TABLE `inventory_reservation`
  ADD CONSTRAINT `fk_inventory_reservation_reservation_id` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
