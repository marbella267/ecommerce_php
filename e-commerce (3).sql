-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2024 at 01:59 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `created_at`, `updated_on`) VALUES
(1, 'mai', '1234', '2024-01-06 16:03:48', '2024-01-06 16:03:48'),
(2, 'zlomich', '12345', '2024-01-15 20:46:42', '2024-01-15 20:46:42'),
(3, 'mariam', '2222', '2024-01-20 12:08:49', '2024-01-20 12:08:49'),
(4, 'kero', '5555', '2024-01-20 12:09:04', '2024-01-20 12:09:04'),
(5, 'abdelrhman', '6666', '2024-01-20 12:09:45', '2024-01-20 12:09:45'),
(6, 'abdelaliem', '4444', '2024-01-20 12:10:06', '2024-01-20 12:10:06');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `created_at`, `updated_on`) VALUES
(58, 'Tables', '2024-01-16 17:51:21', '2024-01-16 17:51:21');

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_quantity` int(11) NOT NULL,
  `totalprice` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'processing ',
  `time` date NOT NULL DEFAULT '2024-01-21',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `user_id`, `product_id`, `quantity`, `price`, `status`, `time`, `created_at`, `updated_on`) VALUES
(41, 19, 63, 4, 11580, 'completed', '2024-01-23', '2024-01-16 23:51:59', '2024-01-16 23:51:59'),
(42, 19, 64, 3, 5085, 'completed', '2024-01-23', '2024-01-16 23:51:59', '2024-01-16 23:51:59'),
(43, 19, 65, 3, 29985, 'processing ', '2024-01-21', '2024-01-16 23:52:52', '2024-01-16 23:52:52'),
(44, 19, 66, 5, 59975, 'canceled', '2024-01-21', '2024-01-17 09:45:01', '2024-01-17 09:45:01'),
(45, 19, 64, 3, 5085, 'canceled', '2024-01-22', '2024-01-17 09:46:19', '2024-01-17 09:46:19'),
(46, 19, 65, 5, 49975, 'processing ', '2024-01-21', '2024-01-17 09:47:11', '2024-01-17 09:47:11'),
(47, 20, 63, 2, 5790, 'processing ', '2024-01-21', '2024-01-17 10:13:15', '2024-01-17 10:13:15'),
(48, 20, 64, 1, 1695, 'processing ', '2024-01-21', '2024-01-17 10:13:15', '2024-01-17 10:13:15'),
(49, 20, 63, 1, 2895, 'processing ', '2024-01-21', '2024-01-17 10:15:49', '2024-01-17 10:15:49'),
(50, 20, 63, 1, 2895, 'processing ', '2024-01-21', '2024-01-17 10:16:35', '2024-01-17 10:16:35'),
(51, 20, 64, 1, 1695, 'processing ', '2024-01-21', '2024-01-17 10:16:35', '2024-01-17 10:16:35'),
(52, 20, 64, 4, 6780, 'canceled', '2024-01-21', '2024-01-17 11:07:57', '2024-01-17 11:07:57'),
(53, 20, 64, 4, 6780, 'completed', '2024-01-22', '2024-01-17 11:10:36', '2024-01-17 11:10:36'),
(54, 20, 65, 9, 89955, 'completed', '2024-01-22', '2024-01-17 11:10:36', '2024-01-17 11:10:36'),
(55, 20, 65, 3, 29985, 'completed', '2024-03-01', '2024-01-18 19:34:36', '2024-01-18 19:34:36'),
(56, 20, 63, 6, 1734, 'processing ', '2024-01-21', '2024-01-18 20:44:06', '2024-01-18 20:44:06'),
(57, 20, 64, 1, 1695, 'processing ', '2024-01-21', '2024-01-18 20:44:06', '2024-01-18 20:44:06'),
(58, 20, 65, 1, 9995, 'processing ', '2024-01-21', '2024-01-18 20:44:06', '2024-01-18 20:44:06'),
(59, 20, 63, 3, 867, 'processing ', '2024-01-22', '2024-01-19 16:11:30', '2024-01-19 16:11:30'),
(60, 20, 64, 1, 1695, 'processing ', '2024-01-22', '2024-01-19 16:11:30', '2024-01-19 16:11:30'),
(61, 20, 66, 1, 11995, 'processing ', '2024-01-23', '2024-01-20 12:22:03', '2024-01-20 12:22:03'),
(62, 19, 63, 2, 578, 'processing ', '2024-01-24', '2024-01-21 08:46:49', '2024-01-21 08:46:49'),
(63, 19, 64, 1, 1695, 'processing ', '2024-01-24', '2024-01-21 08:46:49', '2024-01-21 08:46:49'),
(64, 19, 65, 3, 29985, 'processing ', '2024-01-24', '2024-01-21 08:46:49', '2024-01-21 08:46:49'),
(65, 19, 66, 2, 23990, 'processing ', '2024-01-24', '2024-01-21 08:46:49', '2024-01-21 08:46:49'),
(66, 20, 64, 1, 1695, 'processing ', '2024-01-24', '2024-01-21 16:20:46', '2024-01-21 16:20:46'),
(67, 20, 65, 3, 29985, 'processing ', '2024-01-24', '2024-01-21 16:20:46', '2024-01-21 16:20:46'),
(68, 20, 66, 1, 11995, 'processing ', '2024-01-24', '2024-01-21 16:20:46', '2024-01-21 16:20:46'),
(69, 20, 64, 86, 145770, 'canceled', '2024-01-25', '2024-01-22 05:20:19', '2024-01-22 05:20:19'),
(70, 20, 65, 63, 629685, 'canceled', '2024-01-25', '2024-01-22 05:22:48', '2024-01-22 05:22:48'),
(71, 20, 64, 86, 145770, 'canceled', '2024-01-25', '2024-01-22 05:28:19', '2024-01-22 05:28:19');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `product_img` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `brief` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'available',
  `category_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `price`, `product_img`, `quantity`, `description`, `brief`, `status`, `category_id`, `created_at`, `updated_on`) VALUES
(63, 'new product', 289, 'https://www.ikea.com/eg/en/images/products/ragrund-bench-bamboo__1195964_pe902668_s5.jpg?f=xl', 73, 'hit Our RÅGRUND bathroom furniture adds warmth to your bathroom and will outlast splashes and showering teens. The natural bamboo material is durable and works perfectly in humid spaces like bathrooms.', 'test Bamboo is a natural, hardwearing material that gives a warm expression 78x37 cm', 'available', 58, '2024-01-16 17:53:02', '2024-01-16 17:53:02'),
(64, 'second', 1695, 'https://www.ikea.com/eg/en/images/products/lack-coffee-table-black-brown__57540_pe163122_s5.jpg?f=xl', 86, 'LACK table in black-brown is easy to match with other furnishings. The honeycomb structured paper filling construction adds strength to the table while keeping it lightweight so it´s easy to move around.', 'Separate shelf for magazines, etc. helps you keep your things organised and the table top clear.', 'available', 58, '2024-01-16 18:04:53', '2024-01-16 18:04:53'),
(65, 'hi', 9995, 'https://www.ikea.com/eg/en/images/products/listerby-coffee-table-dark-brown-beech-veneer__1170197_pe892712_s5.jpg?f=xl', 63, 'The neat and airy design makes LISTERBY coffee table easy to place and match with other furniture. The ribbed shelf gives an airy impression and is perfect for magazines, remote controls and other things that you want close at hand. Beech is a natural har', 'This robust table with generous dimensions lasts a long time since lacquer protects the hardwearing beech and preserves the natural wood feel. Sturdy and with a genuine character – year after year.', 'available', 58, '2024-01-16 18:12:53', '2024-01-16 18:12:53'),
(66, 'hi', 11995, 'https://www.ikea.com/eg/en/images/products/idanaes-coffee-table-dark-brown-stained__1161082_pe889290_s5.jpg?f=xl', 6, 'The glass table top is easy to keep clean and adds lightness to your space.  Under the table top you have an open display area, which you can design with personal decorations. Two closed drawers help to keep the area tidier.  Create a coordinated expressi', 'This coffee table with a glass top and a wooden frame adds elegance to your home. It also has two drawers to store your secrets.', 'available', 58, '2024-01-16 19:10:59', '2024-01-16 19:10:59');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `sessionid` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `password`, `email`, `phone`, `address`, `img`, `sessionid`, `created_at`, `updated_on`) VALUES
(19, 'abdelaliem', '01551157155@It', 'abdelaliieem@gmail.com', 1551157155, '22 street ahmed helmy', '', '4jd5m7uhp9hp7mp8c2h2cvsh7f', '2023-12-22 02:39:34', '2023-12-22 02:39:34'),
(20, 'Mai_gam013', 'Hava@gam126', 'gmai08333@gmail.com', 1278344590, 'dd', '', 'dh56vrotv35e1gb872im05fvup', '2024-01-12 12:23:02', '2024-01-12 12:23:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD UNIQUE KEY `product_id` (`product_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
