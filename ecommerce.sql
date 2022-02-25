-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2021 at 05:35 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `email` varchar(70) NOT NULL,
  `password` varchar(70) DEFAULT NULL,
  `fname` varchar(70) DEFAULT NULL,
  `mname` varchar(70) DEFAULT NULL,
  `lname` varchar(70) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`email`, `password`, `fname`, `mname`, `lname`, `dob`, `gender`) VALUES
('admin@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'admin', 'admin', 'admin', '2021-04-19', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `buyer` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `status`, `buyer`) VALUES
(17, 6, 0, 'buyer1@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `email` varchar(70) NOT NULL,
  `password` varchar(70) DEFAULT NULL,
  `member_name` varchar(70) DEFAULT NULL,
  `user_name` varchar(70) DEFAULT NULL,
  `address` varchar(70) DEFAULT NULL,
  `phone_no` varchar(255) DEFAULT NULL,
  `gender` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`email`, `password`, `member_name`, `user_name`, `address`, `phone_no`, `gender`) VALUES
('buyer1@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'buyer1', 'buyer100', 'University of Calgary, Canada ', '8889991111', 'on'),
('seller1@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'seller1', 'seller100', 'University of Calgary, Canada ', '8889991111', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` varchar(20) NOT NULL,
  `order_place_date` datetime NOT NULL DEFAULT current_timestamp(),
  `ship_date` date DEFAULT NULL,
  `order_status` varchar(255) DEFAULT NULL,
  `cart_items` varchar(70) DEFAULT NULL,
  `buyer` varchar(70) DEFAULT NULL,
  `seller` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_place_date`, `ship_date`, `order_status`, `cart_items`, `buyer`, `seller`) VALUES
('607cf9cbb2ea0', '2021-04-18 21:32:27', '2021-04-19', 'shipped', '17', 'buyer1@gmail.com', 'seller1@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `fname` varchar(70) DEFAULT NULL,
  `lname` varchar(70) DEFAULT NULL,
  `phone` varchar(70) DEFAULT NULL,
  `email` varchar(70) DEFAULT NULL,
  `b_address` varchar(70) DEFAULT NULL,
  `s_address` varchar(70) DEFAULT NULL,
  `country` varchar(70) DEFAULT NULL,
  `state` varchar(70) DEFAULT NULL,
  `zip` varchar(70) DEFAULT NULL,
  `order_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `fname`, `lname`, `phone`, `email`, `b_address`, `s_address`, `country`, `state`, `zip`, `order_id`) VALUES
(11, 'Mohammed', 'Rakeeb', '8255611078', 'mohammed.rakeeb@ucalgary.ca', '11136 80 Ave NW', 'University of Calgary, NW Canada', 'Canada', 'Alberta', 'T6G 0R5', '607cf9cbb2ea0');

-- --------------------------------------------------------

--
-- Table structure for table `payment_information`
--

CREATE TABLE `payment_information` (
  `id` int(11) NOT NULL,
  `card_owner` varchar(70) DEFAULT NULL,
  `card_number` varchar(70) DEFAULT NULL,
  `cvv` varchar(70) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `order_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_information`
--

INSERT INTO `payment_information` (`id`, `card_owner`, `card_number`, `cvv`, `expiry_date`, `order_id`) VALUES
(8, 'mohammed', '1234567899554', '889', '2021-04-19', '607cf9cbb2ea0');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_title` varchar(70) DEFAULT NULL,
  `product_description` text DEFAULT NULL,
  `category` varchar(255) NOT NULL,
  `price` float DEFAULT NULL,
  `image_url` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL,
  `seller` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_title`, `product_description`, `category`, `price`, `image_url`, `date_added`, `status`, `seller`) VALUES
(6, 'database book', 'database 471', 'Old Books', 50, '../product_image_urls/607cf93a9c543DatabaseTextbook.jpg', '2021-04-18 21:30:02', 'active', 'seller1@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `product_review`
--

CREATE TABLE `product_review` (
  `id` int(11) NOT NULL,
  `review` varchar(255) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `buyer` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_review`
--

INSERT INTO `product_review` (`id`, `review`, `rating`, `product_id`, `buyer`) VALUES
(2, 'Best book', 4, 6, 'buyer1@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `buyer` (`buyer`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `buyer` (`buyer`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `payment_information`
--
ALTER TABLE `payment_information`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller` (`seller`);

--
-- Indexes for table `product_review`
--
ALTER TABLE `product_review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `buyer` (`buyer`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `payment_information`
--
ALTER TABLE `payment_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_review`
--
ALTER TABLE `product_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`buyer`) REFERENCES `member` (`email`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`buyer`) REFERENCES `member` (`email`) ON DELETE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE;

--
-- Constraints for table `payment_information`
--
ALTER TABLE `payment_information`
  ADD CONSTRAINT `payment_information_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`seller`) REFERENCES `member` (`email`) ON DELETE CASCADE;

--
-- Constraints for table `product_review`
--
ALTER TABLE `product_review`
  ADD CONSTRAINT `product_review_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
