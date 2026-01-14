-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2026 at 01:51 AM
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
-- Database: `chefify`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_point_gifts`
--

CREATE TABLE `admin_point_gifts` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_point_gifts`
--

INSERT INTO `admin_point_gifts` (`id`, `admin_id`, `user_id`, `amount`, `created_at`) VALUES
(1, 1, 3, 100, '2026-01-13 22:48:59'),
(2, 1, 3, 100, '2026-01-13 22:49:02'),
(3, 1, 3, 500, '2026-01-13 22:49:41'),
(4, 1, 3, 100, '2026-01-13 22:49:54'),
(5, 1, 3, 100, '2026-01-13 22:56:44'),
(6, 3, 2, 500, '2026-01-13 23:05:03');

-- --------------------------------------------------------

--
-- Table structure for table `badges`
--

CREATE TABLE `badges` (
  `badge_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `icon` varchar(10) NOT NULL,
  `requirement_type` enum('points','orders','level') NOT NULL,
  `requirement_value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `badges`
--

INSERT INTO `badges` (`badge_id`, `name`, `description`, `icon`, `requirement_type`, `requirement_value`) VALUES
(1, 'First Order', 'Placed your first order', '🍽️', 'points', 1),
(2, 'Food Lover', 'Earned 200 points', '❤️', 'points', 200),
(3, 'Chef Explorer', 'Earned 400 points', '👨‍🍳', 'points', 400),
(4, 'Master Taster', 'Earned 800 points', '🏆', 'points', 800);

-- --------------------------------------------------------

--
-- Table structure for table `challenges`
--

CREATE TABLE `challenges` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `target` int(11) NOT NULL DEFAULT 0,
  `reward_points` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `challenges`
--

INSERT INTO `challenges` (`id`, `name`, `description`, `target`, `reward_points`, `created_at`) VALUES
(1, 'Order Master', 'Complete 5 orders this month', 5, 100, '2026-01-13 20:49:56'),
(2, 'Point Collector', 'Earn 500 total points', 500, 50, '2026-01-13 20:49:56'),
(3, 'Game Champion', 'Play 3 mini-games', 3, 10, '2026-01-13 20:49:56');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `comment` text NOT NULL,
  `points_awarded` int(11) DEFAULT 5,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `user_id`, `name`, `email`, `rating`, `comment`, `points_awarded`, `created_at`) VALUES
(1, 2, 'amalin hashim', 'fnzzula@gmail.com', 5, 'BNBNB', 5, '2026-01-13 21:19:07'),
(2, 4, 'tajudin irham', 'dindin@gmail.com', 5, 'wow amazing sedap dooh', 5, '2026-01-13 23:51:51'),
(3, 2, 'amalin hashim', 'amalin@gmail.com', 2, 'sedappppp', 5, '2026-01-14 00:22:59');

-- --------------------------------------------------------

--
-- Table structure for table `game_history`
--

CREATE TABLE `game_history` (
  `game_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `game_type` varchar(50) NOT NULL,
  `score` int(11) NOT NULL,
  `reward_won` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `game_history`
--

INSERT INTO `game_history` (`game_id`, `user_id`, `game_type`, `score`, `reward_won`, `created_at`) VALUES
(1, 3, 'Memory Game', 18, '50', '2026-01-13 21:32:53'),
(2, 3, 'Memory Game', 10, '50', '2026-01-13 21:33:52'),
(3, 2, 'Memory Game', 16, '50', '2026-01-13 21:47:34'),
(4, 4, 'Memory Game', 14, '50', '2026-01-13 23:47:59'),
(5, 2, 'Memory Game', 19, '50', '2026-01-14 00:21:32');

-- --------------------------------------------------------

--
-- Table structure for table `leaderboard`
--

CREATE TABLE `leaderboard` (
  `cache_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `level` varchar(50) NOT NULL,
  `badges_count` int(11) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `item_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` enum('western','local','dessert','drinks','snacks') NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `promo_price` decimal(10,2) DEFAULT NULL,
  `promo_end_date` date DEFAULT NULL,
  `image_path` varchar(255) NOT NULL,
  `is_available` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`item_id`, `name`, `category`, `description`, `price`, `promo_price`, `promo_end_date`, `image_path`, `is_available`, `created_at`) VALUES
(1, 'Grilled Chicken Chop', 'western', 'Juicy grilled chicken thigh with black pepper sauce and fries.', 18.90, NULL, NULL, 'img/grilledchicken.jpg', 1, '2026-01-13 20:49:56'),
(2, 'Fish & Chips', 'western', 'Crispy battered dory fillet served with tartar sauce.', 21.00, NULL, NULL, 'img/fishandchips.jpg', 1, '2026-01-13 20:49:56'),
(3, 'Spaghetti Carbonara', 'western', 'Creamy carbonara with beef bacon and parmesan cheese.', 19.50, NULL, NULL, 'img/pasta.jpg', 1, '2026-01-13 20:49:56'),
(4, 'Spaghetti Bolognese', 'western', 'Slow-cooked beef sauce with herbs and tomato.', 18.50, NULL, NULL, 'img/bolognese.jpg', 1, '2026-01-13 20:49:56'),
(5, 'Seafood Aglio Olio', 'western', 'Spaghetti tossed with shrimp, mussels and garlic oil.', 24.00, NULL, NULL, 'img/seafood.jpg', 1, '2026-01-13 20:49:56'),
(6, 'Chicken Lasagna', 'western', 'Layered pasta with creamy cheese and minced chicken.', 20.00, NULL, NULL, 'img/lasagna.jpg', 1, '2026-01-13 20:49:56'),
(7, 'Beef Burger', 'western', 'Juicy beef patty with cheese, caramelised onions and brioche bun.', 22.50, 22.50, NULL, 'img/beefburger.jpg', 1, '2026-01-13 20:49:56'),
(8, 'Avocado Toast', 'western', 'Sourdough bread with smashed avocado and poached egg.', 19.50, NULL, NULL, 'img/avocadotoast.jpg', 1, '2026-01-13 20:49:56'),
(9, 'Nasi Lemak Ayam Crispy', 'local', 'Fragrant coconut rice with crispy chicken, sambal and egg.', 15.90, NULL, NULL, 'img/nasilemak.jpg', 1, '2026-01-13 20:49:56'),
(10, 'Nasi Goreng Kampung', 'local', 'Traditional fried rice with anchovies and vegetables.', 13.90, NULL, NULL, 'img/nasigoreng.jpg', 1, '2026-01-13 20:49:56'),
(11, 'Mee Goreng Mamak', 'local', 'Spicy stir-fried noodles with egg and tofu.', 13.50, NULL, NULL, 'img/meegoreng.jpg', 1, '2026-01-13 20:49:56'),
(12, 'Chicken Rendang Rice', 'local', 'Slow-cooked chicken in rich coconut gravy.', 17.90, 17.90, NULL, 'img/rendang.jpg', 1, '2026-01-13 20:49:56'),
(13, 'Laksa Lemak', 'local', 'Creamy coconut noodle soup with fish cake.', 16.50, NULL, NULL, 'img/laksa.jpg', 1, '2026-01-13 20:49:56'),
(14, 'Chocolate Lava Cake', 'dessert', 'Warm chocolate cake with molten centre.', 12.50, NULL, NULL, 'img/lava.jpg', 1, '2026-01-13 20:49:56'),
(15, 'Classic Cheesecake', 'dessert', 'Creamy baked cheesecake with biscuit base.', 13.50, NULL, NULL, 'img/classiccheesecake.jpg', 1, '2026-01-13 20:49:56'),
(16, 'Classic Tiramisu', 'dessert', 'Coffee-soaked ladyfingers with mascarpone cream.', 14.00, NULL, NULL, 'img/tiramisu.jpg', 1, '2026-01-13 20:49:56'),
(17, 'Matcha Tiramisu', 'dessert', 'Japanese matcha twist on classic tiramisu.', 14.50, NULL, NULL, 'img/matchatiramisu.jpg', 1, '2026-01-13 20:49:56'),
(18, 'Brownies with Ice Cream', 'dessert', 'Rich chocolate brownies served warm.', 11.90, NULL, NULL, 'img/browniesice.jpg', 1, '2026-01-13 20:49:56'),
(19, 'Red Velvet Cake', 'dessert', 'Soft red velvet sponge with cream cheese frosting.', 11.00, NULL, NULL, 'img/redvelvet.jpg', 1, '2026-01-13 20:49:56'),
(20, 'Crème Brûlée', 'dessert', 'Vanilla custard with caramelised sugar top.', 13.00, NULL, NULL, 'img/cremebrulee.jpg', 1, '2026-01-13 20:49:56'),
(21, 'Hot Latte', 'drinks', 'Smooth espresso with steamed milk.', 8.00, NULL, NULL, 'img/latte.jpg', 1, '2026-01-13 20:49:56'),
(22, 'Cappuccino', 'drinks', 'Espresso with milk foam.', 8.50, NULL, NULL, 'img/cappuccino.jpg', 1, '2026-01-13 20:49:56'),
(23, 'Iced Latte', 'drinks', 'Chilled espresso with fresh milk.', 9.00, NULL, NULL, 'img/icedlatte.jpg', 1, '2026-01-13 20:49:56'),
(24, 'Matcha Latte', 'drinks', 'Earthy matcha blended with creamy milk.', 9.00, NULL, NULL, 'img/matcha.jpg', 1, '2026-01-13 20:49:56'),
(25, 'Iced Mocha', 'drinks', 'Chocolate espresso drink served cold.', 9.50, NULL, NULL, 'img/mocha.jpg', 1, '2026-01-13 20:49:56'),
(26, 'Lemon Iced Tea', 'drinks', 'Refreshing lemon tea with mint.', 6.50, NULL, NULL, 'img/lemon.jpg', 1, '2026-01-13 20:49:56'),
(27, 'Peach Tea', 'drinks', 'Sweet peach-infused iced tea.', 7.00, NULL, NULL, 'img/peachtea.jpg', 1, '2026-01-13 20:49:56'),
(28, 'Strawberry Frappe', 'drinks', 'Blended strawberry drink with ice.', 8.50, NULL, NULL, 'img/strawberryfrappe.jpg', 1, '2026-01-13 20:49:56'),
(29, 'French Fries', 'snacks', 'Golden crispy fries.', 6.90, NULL, NULL, 'img/frenchfries.jpg', 1, '2026-01-13 20:49:56'),
(30, 'Cheesy Fries', 'snacks', 'Fries topped with melted cheese sauce.', 8.50, NULL, NULL, 'img/cheesyfries.jpg', 1, '2026-01-13 20:49:56'),
(31, 'Chicken Nuggets', 'snacks', 'Crunchy bite-sized chicken nuggets.', 8.50, NULL, NULL, 'img/nuggets.jpg', 1, '2026-01-13 20:49:56'),
(32, 'Onion Rings', 'snacks', 'Crispy battered onion rings.', 7.50, NULL, NULL, 'img/onionrings.jpg', 1, '2026-01-13 20:49:56'),
(33, 'Nachos with Cheese', 'snacks', 'Corn chips served with cheese and salsa.', 9.90, NULL, NULL, 'img/nachos.jpg', 1, '2026-01-13 20:49:56');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_method` enum('Cash','Card','E-Wallet') NOT NULL,
  `order_status` enum('pending','completed','cancelled') DEFAULT 'pending',
  `points_earned` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `total_amount`, `payment_method`, `order_status`, `points_earned`, `created_at`) VALUES
(1, 2, 22.26, 'Card', 'cancelled', 0, '2026-01-13 20:51:57'),
(2, 3, 72.08, 'Card', 'cancelled', 0, '2026-01-13 21:26:36'),
(3, 2, 86.39, 'Card', 'completed', 0, '2026-01-13 21:40:57'),
(4, 2, 63.07, 'Card', 'completed', 0, '2026-01-13 21:41:29'),
(5, 2, 14.73, 'Card', 'completed', 0, '2026-01-13 21:46:34'),
(6, 4, 42.93, 'Card', 'completed', 0, '2026-01-13 23:47:17'),
(7, 2, 65.19, 'Card', 'cancelled', 0, '2026-01-14 00:16:49'),
(8, 5, 22.26, 'Card', 'completed', 0, '2026-01-14 00:18:09');

-- --------------------------------------------------------

--
-- Table structure for table `order_cancellations`
--

CREATE TABLE `order_cancellations` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_cancellations`
--

INSERT INTO `order_cancellations` (`id`, `order_id`, `admin_id`, `reason`, `created_at`) VALUES
(1, 2, 1, 'Out of stock', '2026-01-13 23:07:46'),
(2, 2, 1, 'Out of stock', '2026-01-13 23:08:16'),
(3, 1, 1, 'Delivery issue', '2026-01-13 23:10:27'),
(4, 7, 1, 'Payment failed', '2026-01-14 00:25:40');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price_at_purchase` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `item_id`, `quantity`, `price_at_purchase`) VALUES
(1, 1, 2, 1, 21.00),
(2, 2, 5, 2, 24.00),
(3, 2, 6, 1, 20.00),
(4, 3, 2, 1, 21.00),
(5, 3, 8, 1, 19.50),
(6, 3, 7, 1, 22.50),
(7, 3, 4, 1, 18.50),
(8, 4, 15, 1, 13.50),
(9, 4, 14, 1, 12.50),
(10, 4, 13, 1, 16.50),
(11, 4, 30, 1, 8.50),
(12, 4, 22, 1, 8.50),
(13, 5, 10, 1, 13.90),
(14, 6, 2, 1, 21.00),
(15, 6, 3, 1, 19.50),
(16, 7, 2, 2, 21.00),
(17, 7, 3, 1, 19.50),
(18, 8, 2, 1, 21.00);

-- --------------------------------------------------------

--
-- Table structure for table `reward_points`
--

CREATE TABLE `reward_points` (
  `points_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `points` int(11) DEFAULT 0,
  `total_points_earned` int(11) DEFAULT 0,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reward_points`
--

INSERT INTO `reward_points` (`points_id`, `user_id`, `points`, `total_points_earned`, `last_updated`) VALUES
(1, 2, 50, 860, '2026-01-14 00:22:59'),
(4, 3, 1072, 1072, '2026-01-13 22:56:44'),
(12, 4, 67, 97, '2026-01-13 23:51:51'),
(17, 5, 22, 22, '2026-01-14 00:18:09'),
(21, 6, 0, 0, '2026-01-14 00:27:45');

-- --------------------------------------------------------

--
-- Table structure for table `spin_history`
--

CREATE TABLE `spin_history` (
  `spin_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reward_won` varchar(100) NOT NULL,
  `points_spent` int(11) DEFAULT 30,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `spin_history`
--

INSERT INTO `spin_history` (`spin_id`, `user_id`, `reward_won`, `points_spent`, `created_at`) VALUES
(1, 2, 'Free Cookies', 30, '2026-01-13 21:42:26'),
(2, 2, 'Free Tiramisu', 30, '2026-01-13 21:42:35'),
(3, 2, 'Free Cookies', 30, '2026-01-13 21:42:44'),
(4, 2, 'Free Voucher 20%', 30, '2026-01-13 21:42:52'),
(5, 2, 'Free Voucher 50%', 30, '2026-01-13 21:43:01'),
(6, 2, 'Free Cookies', 30, '2026-01-13 21:48:23'),
(7, 4, 'Free Tiramisu', 30, '2026-01-13 23:48:19'),
(8, 2, 'Free Voucher 20%', 30, '2026-01-14 00:21:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('customer','admin') DEFAULT 'customer',
  `account_status` enum('active','suspended') DEFAULT 'active',
  `avatar` varchar(255) DEFAULT 'img/avatar1.jpg',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_login` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullname`, `username`, `email`, `phone`, `password`, `role`, `account_status`, `avatar`, `created_at`, `last_login`) VALUES
(1, 'System Admin', 'admin', 'admin@chefify.com', '0123456789', '$2y$10$np6SJYbf5CwoRA40.CCsPOBTTI5hCfCCoPzjkI45NhL5cUCHhWyhG', 'admin', 'active', 'img/avatar4.jpg', '2026-01-13 20:49:56', '2026-01-14 00:24:17'),
(2, 'amalin hashim', 'halin', 'fnzzula@gmail.com', '0182505922', '$2y$10$CXUVR7tMJ0.yMtUWYKhlC.JdCrxs/X/qmbvsik3JHnWd2X8wbWjkG', 'customer', 'active', 'img/avatar3.jpg', '2026-01-13 20:51:13', '2026-01-14 00:19:37'),
(3, 'ejen ali', 'ali', 'ali@gmail.com', '23452244', '$2y$10$WEON9kifBfuklPix2GCIvuZUwam6/BmSYP/nuXj8g7Lh7rGI1NxaW', 'admin', 'active', 'img/avatar2.jpg', '2026-01-13 21:25:58', '2026-01-13 23:57:57'),
(4, 'tajudin irham', 'taujdin', 'dindin@gmail.com', '0182505876', '$2y$10$i/Db9CdaWbZS8eOFUwBG9O0spR/BLUALiwM3QVf2U1Kc1vp5rc4OC', 'admin', 'active', 'img/avatar2.jpg', '2026-01-13 23:46:49', '2026-01-14 00:26:35'),
(5, 'aina jenab', 'jenab', 'aina@gmail.com', '0182505455', '$2y$10$jgdTKjZ0SpoSBdmMkZdgAeREq6ZFRatYX6Uim5Vc1UQqfhaQkW7zm', 'customer', 'active', 'img/avatar1.jpg', '2026-01-14 00:17:45', '2026-01-14 00:17:50'),
(6, 'aliffah', 'aliffah', 'aliffah@gmail.com', '0199904573', '$2y$10$ma4I/UOoFZu5Q30C3pk/R.RnNauDdeb9755Cl2pAuZPqwU0n1aAiu', 'customer', 'active', 'img/avatar1.jpg', '2026-01-14 00:27:45', '2026-01-14 00:27:51');

-- --------------------------------------------------------

--
-- Table structure for table `user_challenges`
--

CREATE TABLE `user_challenges` (
  `user_id` int(11) NOT NULL,
  `challenge_id` int(11) NOT NULL,
  `progress` int(11) NOT NULL DEFAULT 0,
  `completed_at` datetime DEFAULT NULL,
  `claimed` tinyint(1) NOT NULL DEFAULT 0,
  `claimed_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_challenges`
--

INSERT INTO `user_challenges` (`user_id`, `challenge_id`, `progress`, `completed_at`, `claimed`, `claimed_at`) VALUES
(2, 1, 5, '2026-01-14 01:19:57', 0, NULL),
(2, 2, 625, '2026-01-14 01:19:57', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_progress`
--

CREATE TABLE `user_progress` (
  `progress_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `current_level` int(11) DEFAULT 1,
  `total_orders` int(11) DEFAULT 0,
  `total_spent` decimal(10,2) DEFAULT 0.00,
  `badges_earned` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`badges_earned`)),
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_progress`
--

INSERT INTO `user_progress` (`progress_id`, `user_id`, `current_level`, `total_orders`, `total_spent`, `badges_earned`, `last_updated`) VALUES
(1, 2, 1, 5, 251.64, NULL, '2026-01-14 00:16:49'),
(3, 3, 1, 1, 72.08, NULL, '2026-01-13 21:26:36'),
(8, 4, 1, 1, 42.93, NULL, '2026-01-13 23:47:17'),
(11, 5, 1, 1, 22.26, NULL, '2026-01-14 00:18:09'),
(13, 6, 1, 0, 0.00, NULL, '2026-01-14 00:27:45');

-- --------------------------------------------------------

--
-- Table structure for table `user_vouchers`
--

CREATE TABLE `user_vouchers` (
  `voucher_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `discount_type` enum('percentage','fixed') DEFAULT 'percentage',
  `discount_value` decimal(10,2) NOT NULL,
  `status` enum('active','used','expired') DEFAULT 'active',
  `expiry_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_vouchers`
--

INSERT INTO `user_vouchers` (`voucher_id`, `user_id`, `code`, `discount_type`, `discount_value`, `status`, `expiry_date`, `created_at`) VALUES
(1, 3, 'GAMEE81C91', 'percentage', 10.00, 'active', '2026-01-21', '2026-01-13 21:32:53'),
(2, 3, 'GAME5D8781', 'percentage', 20.00, 'active', '2026-01-21', '2026-01-13 21:33:52'),
(3, 2, 'SPIN13D973', 'percentage', 20.00, 'active', '2026-01-21', '2026-01-13 21:42:52'),
(4, 2, 'SPIN7BDA25', 'percentage', 50.00, 'active', '2026-01-21', '2026-01-13 21:43:01'),
(5, 2, 'GAME27BED9', 'percentage', 10.00, 'active', '2026-01-21', '2026-01-13 21:47:34'),
(6, 4, 'GAME6AB6EC', 'percentage', 15.00, 'active', '2026-01-21', '2026-01-13 23:47:59'),
(7, 2, 'REWARD1-C78588', 'fixed', 5.00, 'active', NULL, '2026-01-14 00:20:21'),
(8, 2, 'REWARD2-B1EEC3', 'fixed', 10.00, 'active', NULL, '2026-01-14 00:20:24'),
(9, 2, 'REWARD3-BC9EDD', 'fixed', 15.00, 'active', NULL, '2026-01-14 00:20:27'),
(10, 2, 'REWARD2-D4B852', 'fixed', 10.00, 'active', NULL, '2026-01-14 00:20:29'),
(11, 2, 'REWARD3-3F0AE3', 'fixed', 15.00, 'active', NULL, '2026-01-14 00:20:32'),
(12, 2, 'REWARD1-66E782', 'fixed', 5.00, 'active', NULL, '2026-01-14 00:20:35'),
(13, 2, 'GAMEC5DD3D', 'percentage', 10.00, 'active', '2026-01-21', '2026-01-14 00:21:32'),
(14, 2, 'SPINBCABC0', 'percentage', 20.00, 'active', '2026-01-21', '2026-01-14 00:21:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_point_gifts`
--
ALTER TABLE `admin_point_gifts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `badges`
--
ALTER TABLE `badges`
  ADD PRIMARY KEY (`badge_id`);

--
-- Indexes for table `challenges`
--
ALTER TABLE `challenges`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_challenge_name` (`name`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `game_history`
--
ALTER TABLE `game_history`
  ADD PRIMARY KEY (`game_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `leaderboard`
--
ALTER TABLE `leaderboard`
  ADD PRIMARY KEY (`cache_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_cancellations`
--
ALTER TABLE `order_cancellations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `reward_points`
--
ALTER TABLE `reward_points`
  ADD PRIMARY KEY (`points_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `spin_history`
--
ALTER TABLE `spin_history`
  ADD PRIMARY KEY (`spin_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_challenges`
--
ALTER TABLE `user_challenges`
  ADD PRIMARY KEY (`user_id`,`challenge_id`),
  ADD KEY `challenge_id` (`challenge_id`);

--
-- Indexes for table `user_progress`
--
ALTER TABLE `user_progress`
  ADD PRIMARY KEY (`progress_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `user_vouchers`
--
ALTER TABLE `user_vouchers`
  ADD PRIMARY KEY (`voucher_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_point_gifts`
--
ALTER TABLE `admin_point_gifts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `badges`
--
ALTER TABLE `badges`
  MODIFY `badge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `challenges`
--
ALTER TABLE `challenges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `game_history`
--
ALTER TABLE `game_history`
  MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `leaderboard`
--
ALTER TABLE `leaderboard`
  MODIFY `cache_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_cancellations`
--
ALTER TABLE `order_cancellations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `reward_points`
--
ALTER TABLE `reward_points`
  MODIFY `points_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `spin_history`
--
ALTER TABLE `spin_history`
  MODIFY `spin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_progress`
--
ALTER TABLE `user_progress`
  MODIFY `progress_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_vouchers`
--
ALTER TABLE `user_vouchers`
  MODIFY `voucher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `game_history`
--
ALTER TABLE `game_history`
  ADD CONSTRAINT `game_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `leaderboard`
--
ALTER TABLE `leaderboard`
  ADD CONSTRAINT `leaderboard_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `menu_items` (`item_id`) ON DELETE SET NULL;

--
-- Constraints for table `reward_points`
--
ALTER TABLE `reward_points`
  ADD CONSTRAINT `reward_points_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `spin_history`
--
ALTER TABLE `spin_history`
  ADD CONSTRAINT `spin_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_challenges`
--
ALTER TABLE `user_challenges`
  ADD CONSTRAINT `user_challenges_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_challenges_ibfk_2` FOREIGN KEY (`challenge_id`) REFERENCES `challenges` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_progress`
--
ALTER TABLE `user_progress`
  ADD CONSTRAINT `user_progress_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_vouchers`
--
ALTER TABLE `user_vouchers`
  ADD CONSTRAINT `user_vouchers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
