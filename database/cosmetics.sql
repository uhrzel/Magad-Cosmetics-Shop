-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:8111
-- Generation Time: Oct 03, 2024 at 04:59 PM
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
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(30) NOT NULL,
  `user_id_brand` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` text DEFAULT NULL,
  `image_path` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `user_id_brand`, `name`, `description`, `image_path`, `status`, `delete_flag`, `date_created`) VALUES
(23, 2, 'Farm Harvest Vegetables', 'Fresh harvest from the from vegtables', 'uploads/brands/23.jpg?v=1725941647', 1, 1, '2024-05-20 18:59:03'),
(25, 3, 'Farm Harvest Fruits', 'Fresh from the farm fruits', 'uploads/brands/25.jpg?v=1726469390', 1, 1, '2024-09-16 14:49:50'),
(28, 2, 'newdata', 'description', 'uploads/brands/28.PNG?v=1726637500', 1, 1, '2024-09-18 13:31:40'),
(29, 2, 'vegetables', 'vegetables description', 'uploads/brands/29.jpg?v=1726638389', 1, 0, '2024-09-18 13:46:29'),
(30, 3, 'fruits', 'fruits description', 'uploads/brands/30.jpeg?v=1726639663', 1, 0, '2024-09-18 14:07:43');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(30) NOT NULL,
  `client_id` int(30) NOT NULL,
  `inventory_id` int(30) NOT NULL,
  `price` double NOT NULL,
  `quantity` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `client_id`, `inventory_id`, `price`, `quantity`, `date_created`) VALUES
(58, 5, 21, 10, 2, '2024-09-20 01:39:51'),
(60, 3, 22, 20, 1, '2024-09-20 01:59:44');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(30) NOT NULL,
  `user_id_categories` int(11) NOT NULL,
  `category` varchar(250) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `user_id_categories`, `category`, `description`, `status`, `delete_flag`, `date_created`) VALUES
(1, 2, 'Melon Fruits', 'Melons are refreshing, juicy fruits known for their high water content and sweet flavors. Popular varieties include watermelons, cantaloupes, and honeydew. ', 1, 1, '2022-02-17 11:27:11'),
(12, 2, 'Root Vegetables', 'Root vegetables are nutrient-dense plants that grow underground, absorbing essential minerals and vitamins from the soil.', 1, 1, '2024-05-20 18:55:57'),
(15, 2, 'Leafy Vegetables', 'Leafy vegetables are nutrient-rich greens that are essential to a healthy diet. They are packed with vitamins, minerals, and antioxidants, supporting overall wellness. ', 1, 1, '2024-09-16 14:43:37'),
(16, 2, 'Tropical Fruits', 'Tropical fruits are grown in warm, humid climates and are known for their vibrant flavors, juicy textures, and exotic appeal. Common tropical fruits include mangoes, pineapples, bananas, papayas, and coconuts. ', 1, 1, '2024-09-16 14:51:06'),
(17, 3, 'test vegetabels', 'test description', 1, 1, '2024-09-18 13:37:35'),
(18, 3, 'test vegetable', '', 1, 1, '2024-09-18 13:38:32'),
(19, 2, 'Root Vegetable', 'root vegetables description', 1, 0, '2024-09-18 13:47:31'),
(20, 3, 'Melon Fruit', 'melon description', 1, 0, '2024-09-18 14:08:18');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(30) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` text NOT NULL,
  `default_delivery_address` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `firstname`, `lastname`, `gender`, `contact`, `email`, `password`, `default_delivery_address`, `status`, `delete_flag`, `date_created`) VALUES
(2, 'Samantha Jane', 'Miller', 'Female', '09123456789', 'sam23@sample.com', '91ec1f9324753048c0096d036a694f86', 'Sample Address', 1, 0, '2022-02-17 14:24:00'),
(3, 'Arzel John', 'Zolina', 'Male', '09090937257', 'arzeljrz17@gmail.com', '91ec1f9324753048c0096d036a694f86', 'PMCO Village', 1, 0, '2024-05-17 11:22:55'),
(4, 'Reynald', 'Agustin', 'Male', '09090937257', 'ajmixrhyme@gmail.com', '91ec1f9324753048c0096d036a694f86', 'Davao City Diversion Rd', 1, 0, '2024-09-14 15:57:32'),
(5, 'test', 'test', 'Male', '09154138624', 'test@gmail.com', '202cb962ac59075b964b07152d234b70', 'sekret', 1, 0, '2024-09-18 15:54:44'),
(9, 'Reynald', 'Agustin', 'Male', '02919281972187', 'cypheruhrzel@gmail.com', '202cb962ac59075b964b07152d234b70', 'Davao City Diversion Rd', 1, 0, '2024-09-26 15:22:35');

-- --------------------------------------------------------

--
-- Table structure for table `crops`
--

CREATE TABLE `crops` (
  `id` int(11) NOT NULL,
  `user_id_crops` int(11) NOT NULL,
  `crops_name` varchar(255) NOT NULL,
  `crops_description` varchar(255) NOT NULL,
  `crops_location` varchar(255) NOT NULL,
  `delete_flag` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crops`
--

INSERT INTO `crops` (`id`, `user_id_crops`, `crops_name`, `crops_description`, `crops_location`, `delete_flag`) VALUES
(1, 1, 'test cropsahkshjgajhfsjhgdahgfsd', 'fsgfdagfdshgadgsafcrops description', 'farm 2', 1),
(2, 1, 'Ampalaya(Galaxy F1)', 'description', 'location 1', 0),
(3, 1, 'Sweet Pepper(Emperor F1)', 'description', 'location 3', 0),
(4, 1, 'Hot Pepper(Vulcan F1)', 'description', '\r\nlocation 2', 0),
(5, 1, 'Eggplant(Calixto F1)', 'description', 'location 4', 0),
(6, 1, 'String Beans(Makisig F1)', 'description', 'location 5', 0),
(7, 1, 'Hot Pepper(Lava F1)', 'description', 'location 6\r\n', 0),
(8, 1, 'Sweet Corn(Sweet Supreme)', 'description ', 'location 7', 0);

-- --------------------------------------------------------

--
-- Table structure for table `inorganic_fertilizers`
--

CREATE TABLE `inorganic_fertilizers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `crops_applied` varchar(255) NOT NULL,
  `frequency` varchar(255) NOT NULL,
  `expiry_date` date NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inorganic_fertilizers`
--

INSERT INTO `inorganic_fertilizers` (`id`, `user_id`, `type`, `brand`, `supplier`, `crops_applied`, `frequency`, `expiry_date`, `delete_flag`) VALUES
(1, 2, 'Single Fertilizers-Duofos', 'Sagrez', 'D\'Farmers', 'All Crops', 'First Dose up to fruiting stage', '2024-09-21', 1),
(2, 3, 'Completed Fertilizers-Unik 16', 'Yara', 'D\'Farmers', 'All Crops', 'First Dose up to fruiting', '2024-09-19', 0),
(3, 3, 'Vermicast', 'we', 'D\'Farmers', 'All Crops', 'First Dose up to fruiting', '2024-08-02', 1),
(4, 58, '1', 'we', '1', '1', '1', '2024-10-12', 0),
(5, 58, '23', 'we', '22', '22', '2', '2024-10-04', 0),
(7, 58, '1', '1', '1', 'all crops 100 ml', '1', '2024-10-25', 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(30) NOT NULL,
  `user_id_inventory` int(11) NOT NULL,
  `variant` text NOT NULL,
  `product_id` int(30) NOT NULL,
  `quantity` double NOT NULL,
  `price` float NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `user_id_inventory`, `variant`, `product_id`, `quantity`, `price`, `date_created`, `date_updated`) VALUES
(20, 3, 'class a', 35, 10, 50, '2024-09-18 14:09:35', NULL),
(21, 2, 'class a', 34, 10, 10, '2024-09-18 14:10:21', NULL),
(22, 3, 'native', 36, 5, 20, '2024-09-20 01:50:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(30) NOT NULL,
  `product_id` int(30) NOT NULL,
  `ref_code` varchar(100) NOT NULL,
  `client_id` int(30) NOT NULL,
  `delivery_address` text NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `order_type` tinyint(1) NOT NULL COMMENT '1= pickup,2= deliver',
  `amount` double NOT NULL,
  `status` tinyint(2) NOT NULL COMMENT '0 = pending,\\r\\n1= Packed,\\r\\n2 = Out for Delivery,\\r\\n3=Delivered,\\r\\n4=cancelled',
  `paid` tinyint(1) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product_id`, `ref_code`, `client_id`, `delivery_address`, `payment_method`, `order_type`, `amount`, `status`, `paid`, `date_created`, `date_updated`) VALUES
(60, 34, '20240900001', 4, 'Davao City Diversion Rd', 'Online Payment', 0, 10, 0, 1, '2024-09-18 16:14:17', '2024-09-20 00:39:55'),
(61, 35, '20240900002', 2, 'Sample Address', 'cod', 0, 50, 3, 0, '2024-09-18 16:24:42', '2024-09-20 00:39:59'),
(63, 35, '20240900004', 2, 'Sample Address', 'cod', 0, 50, 0, 1, '2024-09-18 16:25:19', '2024-09-20 00:40:03'),
(64, 35, '20240900005', 5, 'sekret', 'cod', 0, 50, 3, 1, '2024-09-20 00:43:19', '2024-09-20 00:45:07');

-- --------------------------------------------------------

--
-- Table structure for table `order_list`
--

CREATE TABLE `order_list` (
  `id` int(30) NOT NULL,
  `order_id` int(30) NOT NULL,
  `inventory_id` int(30) NOT NULL,
  `quantity` int(30) NOT NULL,
  `price` double NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_list`
--

INSERT INTO `order_list` (`id`, `order_id`, `inventory_id`, `quantity`, `price`, `total`) VALUES
(59, 60, 21, 1, 10, 10),
(60, 61, 20, 1, 50, 50),
(61, 63, 20, 1, 50, 50),
(62, 64, 20, 1, 50, 50);

-- --------------------------------------------------------

--
-- Table structure for table `organic_fertilizers`
--

CREATE TABLE `organic_fertilizers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `crops_applied` varchar(255) NOT NULL,
  `frequency` varchar(255) NOT NULL,
  `expiry_date` date NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organic_fertilizers`
--

INSERT INTO `organic_fertilizers` (`id`, `user_id`, `type`, `brand`, `supplier`, `crops_applied`, `frequency`, `expiry_date`, `delete_flag`) VALUES
(1, 2, 'Bio-organic ', 'Kael', 'LGU Baybay', 'All Crops', 'for soil media (Seed germination)', '2024-09-18', 0),
(2, 3, 'Vermicast', '-', 'Own produced', 'All Crops', 'for soil media (Seed germination)', '2024-10-05', 0),
(3, 3, 'ow', '12s', 'D\'Farmers', 'All Crops', 'First Dose up to fruiting ', '2024-10-05', 1),
(4, 2, 'k', 'k', 'k', 'k', 'k', '2024-10-01', 1),
(5, 58, '121', 'we', 'we', 'we', 'we', '2024-10-24', 0),
(6, 58, 'we', 'we', 'we', 'we', 'we', '2024-10-21', 0),
(7, 58, 'sa', 'sa', 'sa', 'all crops 108 ml', '1', '2024-10-11', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pesticides`
--

CREATE TABLE `pesticides` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `active_ingredient` varchar(255) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `crops_applied` varchar(255) NOT NULL,
  `target_pest` varchar(255) NOT NULL,
  `frequency` varchar(255) NOT NULL,
  `expiry_date` date NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesticides`
--

INSERT INTO `pesticides` (`id`, `user_id`, `type`, `active_ingredient`, `brand_name`, `supplier`, `crops_applied`, `target_pest`, `frequency`, `expiry_date`, `delete_flag`) VALUES
(1, 2, 'Fungicide-Ortiva top', 'Azoxystrobin/Difenoconazde', 'Syngenta', 'D\'Farmers', 'Corn, Tomato', 'Leaf blight, Late blight', 'As the need arises', '2023-09-14', 0),
(2, 3, 'test data', 'test ingredient', 'test brand', 'tes supplier', 'test crops applied', 'test target pest', 'test frequency ', '2024-10-05', 0),
(3, 3, '2', '21', '21sssssssssssssssssss', '1', '1', '1', '1', '2024-09-13', 1),
(4, 2, '3232', '3232', '3232', '3232', '3232', '2121', '2121', '2024-09-27', 1),
(5, 58, '121', '1', '1', '1', 'all crops 100 liters', '1', '1', '2024-10-15', 0),
(6, 58, '21', '2121', '1', '2121', 'all crops 100 ml', '21', '21', '2024-10-24', 0);

-- --------------------------------------------------------

--
-- Table structure for table `production_harvesting`
--

CREATE TABLE `production_harvesting` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `crops` varchar(255) NOT NULL,
  `crop_cycle` varchar(255) NOT NULL,
  `date_planted` date NOT NULL,
  `date_harvest` date NOT NULL,
  `hectarage` varchar(255) NOT NULL,
  `harvest_kg` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `plat` varchar(255) NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `production_harvesting`
--

INSERT INTO `production_harvesting` (`id`, `user_id`, `crops`, `crop_cycle`, `date_planted`, `date_harvest`, `hectarage`, `harvest_kg`, `location`, `plat`, `delete_flag`) VALUES
(22, 3, 'Sweet Corn(Sweet Supreme)', '4 months', '2024-09-28', '2025-01-26', '2', '2', '2', '', 0),
(23, 2, 'Hot Pepper(Lava F1)', '1 month, 12 days', '2024-10-04', '2024-11-07', '1', '1', 'loc 2', '', 0),
(24, 2, 'Hot Pepper(Lava F1)', '1 month, 12 days', '2024-10-26', '2024-11-28', '21', '', 'loc 1', '', 0),
(26, 58, 'Ampalaya(Galaxy F1)', '1 month, 12 days', '2024-10-29', '2024-11-15', '12', '12', 'location 1', 'plat 1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(30) NOT NULL,
  `brand_id` int(30) NOT NULL,
  `category_id` int(30) NOT NULL,
  `name` varchar(250) NOT NULL,
  `specs` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `brand_id`, `category_id`, `name`, `specs`, `status`, `delete_flag`, `date_created`, `user_id`) VALUES
(34, 29, 19, 'Potatoe', '', 1, 0, '2024-09-18 14:06:11', 2),
(35, 30, 20, 'Watermelon', '&lt;p&gt;melon fruit&lt;/p&gt;', 1, 0, '2024-09-18 14:09:14', 3),
(36, 30, 20, 'passion fruit', '', 1, 0, '2024-09-20 01:49:37', 3);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(30) NOT NULL,
  `order_id` int(30) NOT NULL,
  `clients_id` int(11) NOT NULL,
  `total_amount` double NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `order_id`, `clients_id`, `total_amount`, `date_created`) VALUES
(32, 60, 5, 10, '2024-09-18 16:14:17'),
(34, 63, 5, 50, '2024-09-18 16:25:19'),
(35, 64, 5, 50, '2024-09-20 00:43:19');

-- --------------------------------------------------------

--
-- Table structure for table `sanitizers`
--

CREATE TABLE `sanitizers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sanitizer_name` varchar(255) NOT NULL,
  `active_ingredient` varchar(255) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `intended_use` varchar(255) NOT NULL,
  `frequency` varchar(255) NOT NULL,
  `expiry_date` date NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sanitizers`
--

INSERT INTO `sanitizers` (`id`, `user_id`, `sanitizer_name`, `active_ingredient`, `brand_name`, `intended_use`, `frequency`, `expiry_date`, `delete_flag`) VALUES
(4, 2, 'Power Detergent', '-', 'Ariel', 'Cleaning', 'As the need arises', '2024-09-24', 0),
(5, 3, 'Bleach', 'Chloring', 'Zonrox', 'Disinfectant', 'As the need arises', '2024-09-19', 0),
(6, 3, '1', '1', '1', '1', '1', '2024-09-13', 1),
(7, 2, '2', '2222222222', '2', '2', '2', '2024-10-04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Agri Farm'),
(6, 'short_name', 'Agri Farm'),
(11, 'logo', 'uploads/logo-1725941904.jpeg'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover-1725941904.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `type_application` varchar(250) NOT NULL,
  `farm_name` varchar(250) NOT NULL,
  `hectarage_farm_size` varchar(250) NOT NULL,
  `street` varchar(250) NOT NULL,
  `barangay` varchar(250) NOT NULL,
  `city` varchar(250) NOT NULL,
  `province` varchar(250) NOT NULL,
  `hectarage_farm_size2` varchar(255) NOT NULL,
  `street2` varchar(255) NOT NULL,
  `barangay2` varchar(255) NOT NULL,
  `city2` varchar(255) NOT NULL,
  `province2` varchar(255) NOT NULL,
  `hectarage_farm_size3` varchar(255) NOT NULL,
  `street3` varchar(255) NOT NULL,
  `barangay3` varchar(255) NOT NULL,
  `city3` varchar(255) NOT NULL,
  `province3` varchar(255) NOT NULL,
  `crop` varchar(250) NOT NULL,
  `variety` varchar(250) NOT NULL,
  `hectarage_crop` varchar(250) NOT NULL,
  `harvest` varchar(250) NOT NULL,
  `purpose` varchar(250) NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `required_documents` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`required_documents`)),
  `additional_documents` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`additional_documents`)),
  `email_address` varchar(250) DEFAULT NULL,
  `mobile_number` varchar(250) DEFAULT NULL,
  `farms` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`farms`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `type_application`, `farm_name`, `hectarage_farm_size`, `street`, `barangay`, `city`, `province`, `hectarage_farm_size2`, `street2`, `barangay2`, `city2`, `province2`, `hectarage_farm_size3`, `street3`, `barangay3`, `city3`, `province3`, `crop`, `variety`, `hectarage_crop`, `harvest`, `purpose`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`, `required_documents`, `additional_documents`, `email_address`, `mobile_number`, `farms`) VALUES
(1, 'Admin', 'Admin1', 'admin', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '21232f297a57a5a743894a0e4a801fc3', 'uploads/avatars/1.png?v=1645064505', NULL, 1, '2021-01-20 14:02:37', '2024-09-16 16:12:48', NULL, NULL, NULL, NULL, NULL),
(2, 'Farmer', 'farmer', 'farmer', '[\"New\"]', 'Kablon farm', '1.5 hectarage', 'test street', 'Kablon', 'Tupi', 'South Cotabato', '', '', '', '', '', '', '', '', '', '', 'highbreed', 'test variety', '20.5 hectarage', 'day 20', 'to income', '97f974881b3726d9a77014b5f3b4d795', 'uploads/avatars/2.png?v=1726475276', NULL, 2, '2021-01-20 14:02:37', '2024-09-27 14:17:08', '[\"Farm layout\",\"Field operation Procedures\",\"Production and Harvesting Records\",\"List of Farm inputs (Annex B)\",\"Certificate of Nutrient Soil Analysis\",\"Certificate of training on GAP conducted by ATI, BPI, LGU, DA RFO, SUCs or by ATI accredited service providers\",\"Certification of Registration and other permits e.g. RSBSA, SEC, DTI, CDA (as applicable)\"]', '[\"Quality Management System/Internal Control System\",\"Procedure for accreditation of farmers/growers\",\"Manual of Procedure for outgrowership scheme\"]', 'kablon@gmail.com', '09090937257', NULL),
(3, 'arzel', 'zolina', 'farmer 2', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '202cb962ac59075b964b07152d234b70', 'uploads/avatars/3.png?v=1726475208', NULL, 2, '2024-09-16 16:26:29', '2024-09-16 16:27:35', NULL, NULL, NULL, NULL, NULL),
(7, 'test', 'ati', 'ati', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '202cb962ac59075b964b07152d234b70', 'uploads/avatars/7.png?v=1726816821', NULL, 3, '2024-09-20 15:12:17', '2024-09-20 15:20:21', NULL, NULL, NULL, NULL, NULL),
(8, 'test ', 'bpi', 'bpi', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '202cb962ac59075b964b07152d234b70', 'uploads/avatars/8.png?v=1726817439', NULL, 4, '2024-09-20 15:27:33', '2024-09-20 15:30:39', NULL, NULL, NULL, NULL, NULL),
(56, 'Reynald', 'Agustin', 'sa', '', 'sa', '', 'Davao City Diversion Rd', '', 'Davao City', 'DAVAO DEL SUR', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'd41d8cd98f00b204e9800998ecf8427e', NULL, NULL, 2, '2024-09-27 14:06:01', NULL, '[\"Certification of Registration and other permits e.g. RSBSA, SEC, DTI,CDA(as applicable)\"]', '[\"Quality Management System\\/Internal Control System\"]', 'Arzeljrz17@gmail.com', '', NULL),
(58, 'a', 'a', 'a', '[\"New\"]', 'Kablon farm', 'hectarage 1', 'street 1', 'barangay 1', 'city 1', 'province 1', 'hectarage 2', 'street 2', 'barangay 2', 'city 2', 'province 2', 'hectarage 3', 'street 3', 'barangay 3', 'city 3', 'province 3', '', '', '', '', '', '202cb962ac59075b964b07152d234b70', NULL, NULL, 2, '2024-10-03 14:54:29', '2024-10-03 15:01:41', '[\"Farm or organization profile\",\"Farm map\",\"Farm layout\"]', '[\"Quality Management System/Internal Control System\"]', 'ajmixrhyme@gmail.com', '123', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_brand` (`user_id_brand`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventory_id` (`inventory_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_categories` (`user_id_categories`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crops`
--
ALTER TABLE `crops`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_crops` (`user_id_crops`);

--
-- Indexes for table `inorganic_fertilizers`
--
ALTER TABLE `inorganic_fertilizers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inu_id` (`user_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id_inventory` (`user_id_inventory`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventory_id` (`inventory_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `organic_fertilizers`
--
ALTER TABLE `organic_fertilizers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ouid` (`user_id`);

--
-- Indexes for table `pesticides`
--
ALTER TABLE `pesticides`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`user_id`);

--
-- Indexes for table `production_harvesting`
--
ALTER TABLE `production_harvesting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `u_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`,`category_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `client_id` (`clients_id`);

--
-- Indexes for table `sanitizers`
--
ALTER TABLE `sanitizers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sid` (`user_id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `crops`
--
ALTER TABLE `crops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `inorganic_fertilizers`
--
ALTER TABLE `inorganic_fertilizers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `order_list`
--
ALTER TABLE `order_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `organic_fertilizers`
--
ALTER TABLE `organic_fertilizers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pesticides`
--
ALTER TABLE `pesticides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `production_harvesting`
--
ALTER TABLE `production_harvesting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `sanitizers`
--
ALTER TABLE `sanitizers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `brands`
--
ALTER TABLE `brands`
  ADD CONSTRAINT `user_id_brand` FOREIGN KEY (`user_id_brand`) REFERENCES `users` (`id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`inventory_id`) REFERENCES `inventory` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `user_id_categories` FOREIGN KEY (`user_id_categories`) REFERENCES `users` (`id`);

--
-- Constraints for table `crops`
--
ALTER TABLE `crops`
  ADD CONSTRAINT `user_id_crops` FOREIGN KEY (`user_id_crops`) REFERENCES `users` (`id`);

--
-- Constraints for table `inorganic_fertilizers`
--
ALTER TABLE `inorganic_fertilizers`
  ADD CONSTRAINT `inu_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `user_id_inventory` FOREIGN KEY (`user_id_inventory`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_list`
--
ALTER TABLE `order_list`
  ADD CONSTRAINT `order_list_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_list_ibfk_2` FOREIGN KEY (`inventory_id`) REFERENCES `inventory` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `organic_fertilizers`
--
ALTER TABLE `organic_fertilizers`
  ADD CONSTRAINT `ouid` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `pesticides`
--
ALTER TABLE `pesticides`
  ADD CONSTRAINT `pid` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `production_harvesting`
--
ALTER TABLE `production_harvesting`
  ADD CONSTRAINT `u_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `client_id` FOREIGN KEY (`clients_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sanitizers`
--
ALTER TABLE `sanitizers`
  ADD CONSTRAINT `sid` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
