-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2023 at 08:20 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test2`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status_id` int(10) UNSIGNED NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `status_id`, `created_at`) VALUES
(1, 4, 2, '2023-08-12'),
(2, 4, 2, '2023-08-11'),
(3, 4, 2, '2023-08-11'),
(4, 4, 2, '2023-08-10');

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `amount` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`order_id`, `product_id`, `amount`) VALUES
(1, 1, 2),
(1, 3, 1),
(2, 3, 2),
(3, 3, 2),
(4, 1, 2),
(4, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(200) NOT NULL,
  `creator` varchar(100) NOT NULL,
  `Size` varchar(100) NOT NULL,
  `Material` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `rating` decimal(2,1) NOT NULL,
  `ratingCount` int(11) NOT NULL,
  `location` varchar(100) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `Discount` int(11) NOT NULL,
  `previousPrice` decimal(12,2) NOT NULL,
  `photo` varchar(300) DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `creator`, `Size`, `Material`, `description`, `rating`, `ratingCount`, `location`, `price`, `Discount`, `previousPrice`, `photo`, `parent_id`) VALUES
(1, 'Apple Watch', 'Apple', '120*150', 'استیل', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima alias aperiam cumque nobis ad natus, aut voluptas necessitatibus? Molestias laudantium illo, beatae in numquam minima repellat? Magnam beatae animi nisi.', 4.8, 87, 'Apple Sports | Jaksel', 85.00, 10, 90.00, NULL, NULL),
(2, 'Samsung Watch', 'Samsung', '200*150', 'شیشه', 'Lorem', 4.8, 87, 'Apple Sports | Jaksel', 85.00, 10, 90.00, NULL, NULL),
(3, 'Samsung TV', 'Samsung', '200*150', 'شیشه', 'Lorem', 4.8, 87, 'Apple Sports | Jaksel', 85.00, 10, 90.00, NULL, NULL),
(5, 'Hello', 'asdg', 'asdsad', 'asfdf', 'asdasfdf', 1.0, 123, 'asddg', 123.00, 5, 2311.00, NULL, 1),
(6, 'Hello', 'asdg', 'asdsad', 'asfdf', 'asdasfdf', 1.0, 1, 'asddg', 12.00, 12, 32.00, NULL, 1),
(7, 'Hello', 'asdg', 'asdsad', 'asfdf', 'asdasfdf', 1.0, 1, 'asddg', 12.00, 12, 32.00, NULL, 1),
(8, 'Hello', 'asdg', 'asdsad', 'asfdf', 'asdasfdf', 1.0, 1, 'asddg', 12.00, 12, 32.00, NULL, 1),
(9, 'Hello', 'asdg', 'asdsad', 'asfdf', 'asdasfdf', 1.0, 1, 'asddg', 12.00, 12, 123.00, NULL, 1),
(10, 'Hello', 'asdg', 'asdsad', 'asfdf', 'asdasfdf', 1.0, 1, 'asddg', 12.00, 12, 123.00, NULL, 1),
(11, 'Hello', 'asdg', 'asdsad', 'asfdf', 'asdasfdf', 1.0, 1, 'asddg', 12.00, 1, 123.00, NULL, 1),
(12, 'Hello', 'asdg', 'asdsad', 'asfdf', 'asdasfdf', 1.0, 1, 'asddg', 12.00, 1, 123.00, NULL, 1),
(13, 'Hello', 'asdg', 'asdsad', 'asfdf', 'asdasfdf', 1.0, 1, 'asddg', 12.00, 1, 123.00, NULL, 1),
(14, 'Hello', 'asdg', 'asdsad', 'asfdf', 'asdasfdf', 1.0, 1, 'asddg', 12.00, 1, 123.00, 'uploads/download.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'waiting for payment'),
(2, 'Payment Success'),
(3, 'Payment Failed'),
(4, 'Order Finished');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `password` varchar(300) NOT NULL,
  `email` varchar(100) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `password`, `email`, `is_admin`) VALUES
(4, '$2y$10$cWr9XTyY67dWOONOyrIrH.2sxIonEh9hhlWlmn/tH1EcSwWKCjpqC', 'm.khoshdel81@gmail.com', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `User` (`user_id`),
  ADD KEY `Status` (`status_id`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD KEY `Order` (`order_id`),
  ADD KEY `Product` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Parent` (`parent_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `Status` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `User` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `Order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `Parent` FOREIGN KEY (`parent_id`) REFERENCES `products` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
