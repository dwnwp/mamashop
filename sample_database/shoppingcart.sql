-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 07, 2024 at 12:53 PM
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
-- Database: `shoppingcart`
--

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `price` decimal(10,0) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`id`, `name`, `name_en`, `quantity`, `price`, `type`) VALUES
(5, 'หมู', 'Pork', 20, 10, 'meat'),
(6, 'ไก่', 'Chicken', 40, 10, 'meat'),
(7, 'เนื้อ', 'Breef', 30, 20, 'meat'),
(8, 'หมึก', 'Squid', 30, 20, 'meat'),
(9, 'กุ้ง', 'Shrimp', 9, 20, 'meat'),
(10, 'กระหล่ำ', 'Cabbage', 30, 5, 'vegetable'),
(11, 'คะน้า', 'Kale', 30, 5, 'vegetable'),
(12, 'แครอท', 'Carrot', 40, 5, 'vegetable'),
(13, 'หัวหอม', 'Onion', 20, 5, 'vegetable'),
(14, 'ไข่ลวก', 'BoiledEgg', 50, 10, 'topping'),
(15, 'ชีส', 'Cheese', 40, 10, 'topping'),
(16, 'เบคอนกรอบ', 'Bacon', 20, 10, 'topping'),
(17, 'ไข่กุ้ง', 'Ebiko', 10, 10, 'topping');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `date_time` varchar(255) NOT NULL,
  `grand_total` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'ไม่สมบูรณ์'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `date_time`, `grand_total`, `status`) VALUES
(100, '2024-04-07 16:27:30', 65, 'เสริฟแล้ว'),
(114, '2024-04-07 17:37:23', 70, 'เสริฟแล้ว'),
(117, '2024-04-07 17:45:01', 220, 'เสริฟแล้ว'),
(118, '2024-04-07 17:46:40', 115, 'เสริฟแล้ว');

-- --------------------------------------------------------

--
-- Table structure for table `orders_detail`
--

CREATE TABLE `orders_detail` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `ingredient_detail` varchar(255) NOT NULL,
  `product_price` decimal(8,2) NOT NULL DEFAULT 0.00,
  `product_quantity` int(11) NOT NULL DEFAULT 0,
  `product_total` decimal(8,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders_detail`
--

INSERT INTO `orders_detail` (`order_id`, `product_id`, `product_name`, `ingredient_detail`, `product_price`, `product_quantity`, `product_total`) VALUES
(100, 18, 'มาม่า รสต้มยำกุ้ง', 'ไก่, เนื้อ, หมึก', 65.00, 1, 65.00),
(114, 17, 'มาม่า รสแกงเขียวหวาน', 'Pork, Chicken', 35.00, 2, 70.00),
(117, 17, 'มาม่า รสแกงเขียวหวาน', 'เนื้อ, หมึก', 55.00, 4, 220.00),
(118, 18, 'มาม่า รสต้มยำกุ้ง', 'ชีส', 115.00, 1, 115.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(8,2) NOT NULL DEFAULT 0.00,
  `profile_image` varchar(255) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `product_name_en` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `price`, `profile_image`, `brand`, `stock`, `product_name_en`) VALUES
(16, 'มาม่า รสหมูสับ ดั้งเดิม', 15.00, 'มาม่า รสหมูสับ.jpg', 'mama', 0, 'Mama Pork Flavour'),
(17, 'มาม่า รสแกงเขียวหวาน', 15.00, 'รสแกงเขียวหวาน.png', 'mama', 40, 'Mama Green Curry'),
(18, 'มาม่า รสต้มยำกุ้ง', 15.00, 'รสต้มยำกุ้ง.png', 'mama', 17, 'Mama Shrimp Tom Yum Flavor'),
(19, 'มาม่า รสกะเพรา', 15.00, 'มาม่า_รสกระเพรา.png', 'mama', 20, 'Mama Basil Stir Fried Flavour'),
(20, 'ไวไว รสหมูสับ', 15.00, 'ไวไว_รสหมูสับ.png', 'waiwai', 23, 'Waiwai Pork Flavour'),
(21, 'ไวไว รสหมูต้มยำ', 15.00, 'ไวไว_รสหมูต้มยำ.png', 'waiwai', 31, 'Waiwai Pork Tom Yum Flavour'),
(22, 'ไวไว รสหอยลายผัดฉ่า', 15.00, 'ไวไว+รสหอยลายผัดฉ่า.png', 'waiwai', 20, 'Waiwai Pad Cha Baby Clam Flavor'),
(23, 'ไวไว รสเป็ดพะโล้', 16.00, 'ไวไว_รสเป็ดพะโล้.png', 'waiwai', 32, 'Waiwai Palo Duck Flavour'),
(24, 'ซัมยัง รสคาโบนาร่า สูตรไก่เผ็ด', 30.00, 'Samyang_รสคาโบนาร่า_สูตรไก่เผ็ด.png', 'samyang', 30, 'Samyang Hot Chicken Ramen Carbonara Flavor'),
(25, 'ซัมยัง รสไก่สูตรเผ็ด', 25.00, 'Samyang_รสไก่สูตรเผ็ด.png', 'samyang', 23, 'Samyang Hot Chicken Flavour'),
(26, 'ซัมยัง รสไก่สูตรเผ็ดสไตล์เกาหลีผสมชีส', 30.00, 'Samyang_รสไก่สูตรเผ็ดสไตล์เกาหลีผสมชีส.png', 'samyang', 40, 'Samyang Hot Chicken & Cheese Flavour'),
(27, 'ซัมยัง รสไก่ สูตรเผ็ดน้อย', 27.00, 'Samyangรสไก่สูตรเผ็ดน้อย.png', 'samyang', 12, 'Samyang Buldak Hot Chicken Light Ramen'),
(28, 'ยำยำ รสหมูสับ', 15.00, 'ยำยำ รสหมูสับ.png', 'yumyum', 14, 'YumYum Minced Pork Flavour'),
(29, 'ยำยำ รสต้มยำกุ้ง', 10.00, 'ยำยำ รสต้มยำกุ้ง.png', 'yumyum', 32, 'YumYum Tomyum Shrimp Flavour'),
(30, 'ยำยำ รสต้มยำทะเลหม้อไฟ', 15.00, 'ยำยำ รสต้มยำทะเลหม้อไฟ.png', 'yumyum', 32, 'YumYum Tomyum Seafood Hotpot'),
(31, 'ยำยำ รสผัดขี้เมา', 15.00, 'ยำยำ รสผัดขี้เมา.png', 'yumyum', 42, 'YumYum Keemao');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD PRIMARY KEY (`order_id`,`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$S9Nu8cfKYM/ZBkddyW4lFeOzXN0Z2nvf.EqBtK.H6F1WMdsnSrKJy');

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
