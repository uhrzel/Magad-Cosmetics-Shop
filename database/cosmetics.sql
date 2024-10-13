-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:8111
-- Generation Time: Oct 13, 2024 at 05:16 PM
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
-- Database: `cosmetics`
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
(35, 2, 'Magad Soap', 'soap description', 'uploads/brands/35.jpeg?v=1728829838', 1, 0, '2024-10-13 22:30:38'),
(36, 2, 'Magad Feminine Wash', 'Magad Feminine Wash Description', 'uploads/brands/36.jpeg?v=1728830654', 1, 0, '2024-10-13 22:44:14'),
(37, 2, 'Magad Personal Care', 'Magad Personal Care Description', 'uploads/brands/37.jpeg?v=1728830998', 1, 0, '2024-10-13 22:49:58'),
(38, 2, 'Magad Whitening', 'Magad Whitening Description', 'uploads/brands/38.jpeg?v=1728831089', 1, 0, '2024-10-13 22:51:29'),
(39, 2, 'Magad Skincare', 'Magad Skincare Description', 'uploads/brands/39.jpeg?v=1728831372', 1, 0, '2024-10-13 22:56:12');

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
(25, 2, 'Bath and Body Care', 'Bath and Body Care Description', 1, 0, '2024-10-13 22:27:14'),
(26, 2, 'Feminine Care', 'Feminine Care', 1, 0, '2024-10-13 22:42:33'),
(27, 2, 'Skin Care', 'Skin Care Description', 1, 0, '2024-10-13 22:47:02'),
(28, 2, 'Personal Care', 'Personal Care Description', 1, 0, '2024-10-13 22:48:03'),
(29, 2, 'Whitening', 'Whitening Description', 1, 0, '2024-10-13 22:51:07');

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
(5, 'test', 'test', 'Male', '09154138624', 'test@gmail.com', '202cb962ac59075b964b07152d234b70', 'sekret', 1, 0, '2024-09-18 15:54:44');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(30) NOT NULL,
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

INSERT INTO `inventory` (`id`, `variant`, `product_id`, `quantity`, `price`, `date_created`, `date_updated`) VALUES
(24, 'Lotion', 37, 10, 70, '2024-10-07 20:37:27', NULL),
(25, 'Maroon', 38, 10, 110, '2024-10-07 20:42:43', NULL),
(26, '5', 39, 10, 120, '2024-10-13 20:52:06', NULL),
(27, 'Tawas', 46, 251, 50, '2024-10-13 23:05:37', NULL),
(28, 'Pink', 43, 40, 80, '2024-10-13 23:06:47', NULL),
(29, 'Guava', 42, 2, 20, '2024-10-13 23:07:25', NULL),
(30, 'White Lotion ', 44, 69, 80, '2024-10-13 23:08:04', NULL),
(31, 'Sunflower', 45, 42, 70, '2024-10-13 23:08:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date_sent` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `message`, `date_sent`) VALUES
(33, 2, 's', '2024-10-11 19:14:47'),
(34, 2, 'hiiiiiiiiiii', '2024-10-11 19:16:08'),
(35, 3, 'ok', '2024-10-11 19:17:38'),
(36, 3, 's', '2024-10-11 19:22:44'),
(37, 2, 'sa', '2024-10-11 19:27:56'),
(42, 5, 'hi too', '2024-10-11 22:10:50'),
(43, 5, 'eyo', '2024-10-11 22:17:14'),
(44, 5, 'eyy', '2024-10-11 22:41:58'),
(45, 5, 'hi', '2024-10-11 22:55:45'),
(46, 5, 'oy', '2024-10-11 22:57:54');

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
  `tiktok_link` varchar(255) NOT NULL,
  `shopee_link` varchar(255) NOT NULL,
  `lazada_link` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `brand_id`, `category_id`, `name`, `specs`, `tiktok_link`, `shopee_link`, `lazada_link`, `status`, `delete_flag`, `date_created`, `user_id`) VALUES
(42, 35, 25, 'GUAVA SOAP Antibacterial/Antimicrobial70g', '&lt;h2 class=&quot;WjNdTR&quot; style=&quot;background: rgba(0, 0, 0, 0.02); color: rgba(0, 0, 0, 0.87); font-size: 1.125rem; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0.875rem; text-transform: capitalize; font-family: Roboto, &amp;quot;Helvetica Neue&amp;quot;, Helvetica, Arial, 文泉驛正黑, &amp;quot;WenQuanYi Zen Hei&amp;quot;, &amp;quot;Hiragino Sans GB&amp;quot;, &amp;quot;儷黑 Pro&amp;quot;, &amp;quot;LiHei Pro&amp;quot;, &amp;quot;Heiti TC&amp;quot;, 微軟正黑體, &amp;quot;Microsoft JhengHei UI&amp;quot;, &amp;quot;Microsoft JhengHei&amp;quot;, sans-serif;&quot;&gt;Product Description&lt;/h2&gt;&lt;div class=&quot;Gf4Ro0&quot; style=&quot;margin: 1.875rem 0.9375rem 0.9375rem; color: rgba(0, 0, 0, 0.8); font-family: Roboto, &amp;quot;Helvetica Neue&amp;quot;, Helvetica, Arial, 文泉驛正黑, &amp;quot;WenQuanYi Zen Hei&amp;quot;, &amp;quot;Hiragino Sans GB&amp;quot;, &amp;quot;儷黑 Pro&amp;quot;, &amp;quot;LiHei Pro&amp;quot;, &amp;quot;Heiti TC&amp;quot;, 微軟正黑體, &amp;quot;Microsoft JhengHei UI&amp;quot;, &amp;quot;Microsoft JhengHei&amp;quot;, sans-serif;&quot;&gt;&lt;div class=&quot;e8lZp3&quot; style=&quot;font-size: 0.875rem; line-height: 1.7; overflow: hidden; text-overflow: ellipsis; white-space-collapse: preserve;&quot;&gt;&lt;p class=&quot;QN2lPu&quot; style=&quot;margin-right: 0px; margin-bottom: 0px; margin-left: 0px;&quot;&gt;GUAVA SOAP ✨\r\n\r\nIt is traditionally well known for its natural skin healing properties\r\nHeals skin bruises, cuts, and minor skin irritations\r\nWondering how it will help our skin\r\nGuava has been hailed as one of the super fruits because of its numerous health-promoting qualities\r\nIt is extraordinarily rich in vitamin C and also contains carotene and antioxidants that are beneficial for skin health.\r\n\r\n🔷 Contain anti-oxidants that detoxifies and keeps your skin glowing and free wrinkles\r\n🔷 Treat skin discoloration, such as dark circles, spider veins, rosacea and acne irritation\r\n🔷 Effective in removing blackheads that get formed near our nose, chin, and other areas\r\n🔷 Anti-allergic in nature and is very effective in providing relief and reduce itching\r\n🔷 Beneficial for improving the complexion of our skin and for making it beautiful and radiant again.\r\nIf you&rsquo;re looking for a natural and cleanser soap, check out our natural Guava soap in our resellers and distributors near your area.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;', 'https://vt.tiktok.com/ZS2wxSn3Q/', 'https://shopee.ph/GUAVA-SOAP-Antibacterial-Antimicrobial70g-i.922036405.22812460917?xptdk=aa895e8c-352a-468e-b18f-bc8b0d7c27d8', '', 1, 0, '2024-10-13 22:39:51', 2),
(43, 36, 26, 'Feminine Wash', '&lt;h2 class=&quot;WjNdTR&quot; style=&quot;background: rgba(0, 0, 0, 0.02); color: rgba(0, 0, 0, 0.87); font-size: 1.125rem; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0.875rem; text-transform: capitalize; font-family: Roboto, &amp;quot;Helvetica Neue&amp;quot;, Helvetica, Arial, 文泉驛正黑, &amp;quot;WenQuanYi Zen Hei&amp;quot;, &amp;quot;Hiragino Sans GB&amp;quot;, &amp;quot;儷黑 Pro&amp;quot;, &amp;quot;LiHei Pro&amp;quot;, &amp;quot;Heiti TC&amp;quot;, 微軟正黑體, &amp;quot;Microsoft JhengHei UI&amp;quot;, &amp;quot;Microsoft JhengHei&amp;quot;, sans-serif;&quot;&gt;Product Description&lt;/h2&gt;&lt;div class=&quot;Gf4Ro0&quot; style=&quot;margin: 1.875rem 0.9375rem 0.9375rem; color: rgba(0, 0, 0, 0.8); font-family: Roboto, &amp;quot;Helvetica Neue&amp;quot;, Helvetica, Arial, 文泉驛正黑, &amp;quot;WenQuanYi Zen Hei&amp;quot;, &amp;quot;Hiragino Sans GB&amp;quot;, &amp;quot;儷黑 Pro&amp;quot;, &amp;quot;LiHei Pro&amp;quot;, &amp;quot;Heiti TC&amp;quot;, 微軟正黑體, &amp;quot;Microsoft JhengHei UI&amp;quot;, &amp;quot;Microsoft JhengHei&amp;quot;, sans-serif;&quot;&gt;&lt;div class=&quot;e8lZp3&quot; style=&quot;font-size: 0.875rem; line-height: 1.7; overflow: hidden; text-overflow: ellipsis; white-space-collapse: preserve;&quot;&gt;&lt;p class=&quot;QN2lPu&quot; style=&quot;margin-right: 0px; margin-bottom: 0px; margin-left: 0px;&quot;&gt;You can now try our feminine wash\r\nBe the CEO of your Brand\r\n✔️ Low Order Quantity\r\n✔️ Quality Products\r\n✔️ FDA Processing\r\n✔️ Packaging Design\r\n\r\nFeminine wash BENEFITS:\r\n&bull;	Feel Fresh &amp;amp; Clean all day.\r\n&bull;	All natural with Guava Extract.\r\n&bull;	Cooling Effect\r\n&bull;	Protects you from odor, itch and irritation\r\n\r\n✔️INQUIRE NOW!!&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;', 'https://vt.tiktok.com/ZS2w9b4dL/', 'https://shopee.ph/Feminine-Wash-Open-for-Rebranding-i.922036405.18171007570?sp_atk=8288d88b-4840-4b60-b8dd-c066184443f1&xptdk=8288d88b-4840-4b60-b8dd-c066184443f1', '', 1, 0, '2024-10-13 22:46:17', 2),
(44, 38, 29, 'Insta white Lotion SPF 50', '&lt;h2 class=&quot;WjNdTR&quot; style=&quot;background: rgba(0, 0, 0, 0.02); color: rgba(0, 0, 0, 0.87); font-size: 1.125rem; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0.875rem; text-transform: capitalize; font-family: Roboto, &amp;quot;Helvetica Neue&amp;quot;, Helvetica, Arial, 文泉驛正黑, &amp;quot;WenQuanYi Zen Hei&amp;quot;, &amp;quot;Hiragino Sans GB&amp;quot;, &amp;quot;儷黑 Pro&amp;quot;, &amp;quot;LiHei Pro&amp;quot;, &amp;quot;Heiti TC&amp;quot;, 微軟正黑體, &amp;quot;Microsoft JhengHei UI&amp;quot;, &amp;quot;Microsoft JhengHei&amp;quot;, sans-serif;&quot;&gt;Product Description&lt;/h2&gt;&lt;div class=&quot;Gf4Ro0&quot; style=&quot;margin: 1.875rem 0.9375rem 0.9375rem; color: rgba(0, 0, 0, 0.8); font-family: Roboto, &amp;quot;Helvetica Neue&amp;quot;, Helvetica, Arial, 文泉驛正黑, &amp;quot;WenQuanYi Zen Hei&amp;quot;, &amp;quot;Hiragino Sans GB&amp;quot;, &amp;quot;儷黑 Pro&amp;quot;, &amp;quot;LiHei Pro&amp;quot;, &amp;quot;Heiti TC&amp;quot;, 微軟正黑體, &amp;quot;Microsoft JhengHei UI&amp;quot;, &amp;quot;Microsoft JhengHei&amp;quot;, sans-serif;&quot;&gt;&lt;div class=&quot;e8lZp3&quot; style=&quot;font-size: 0.875rem; line-height: 1.7; overflow: hidden; text-overflow: ellipsis; white-space-collapse: preserve;&quot;&gt;&lt;p class=&quot;QN2lPu&quot; style=&quot;margin-right: 0px; margin-bottom: 0px; margin-left: 0px;&quot;&gt;Customize your own skincare brand with us today, with your own formula, and own brand with an FDA Licensed Manufacturer. \r\nBe the CEO of your own Brand!\r\nWe can help you on your all inquiries\r\nStart your own skincare line with us. We offer FDA assistance so you can sell your products with confidence. \r\n\r\nWhitening Body Lotion SPF 50\r\n-Solution to moisture and protect your skin from sun&#039;s harmful rays.\r\n-Lotion is non greasy and fast absorbing for a clean feel.\r\n-Premium Actives.\r\n-Instawhite Effect\r\n-Effective within 7 days\r\n\r\n*Low Order Quantity\r\n*Quality Products\r\n* FDA Processing\r\n* Packaging Design\r\nINQUIRE NOW!!&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;', 'https://vt.tiktok.com/ZS2wxjN2n/', 'https://shopee.ph/Insta-white-Lotion-SPF-50-i.922036405.18971386620?sp_atk=a9455f78-2059-4ca1-b90d-c5efa1bf63cf&xptdk=a9455f78-2059-4ca1-b90d-c5efa1bf63cf', '', 1, 0, '2024-10-13 22:54:24', 2),
(45, 39, 27, 'SUNFLOWER OIL 100%60ml', '&lt;h2 class=&quot;WjNdTR&quot; style=&quot;background: rgba(0, 0, 0, 0.02); color: rgba(0, 0, 0, 0.87); font-size: 1.125rem; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0.875rem; text-transform: capitalize; font-family: Roboto, &amp;quot;Helvetica Neue&amp;quot;, Helvetica, Arial, 文泉驛正黑, &amp;quot;WenQuanYi Zen Hei&amp;quot;, &amp;quot;Hiragino Sans GB&amp;quot;, &amp;quot;儷黑 Pro&amp;quot;, &amp;quot;LiHei Pro&amp;quot;, &amp;quot;Heiti TC&amp;quot;, 微軟正黑體, &amp;quot;Microsoft JhengHei UI&amp;quot;, &amp;quot;Microsoft JhengHei&amp;quot;, sans-serif;&quot;&gt;Product Description&lt;/h2&gt;&lt;div class=&quot;Gf4Ro0&quot; style=&quot;margin: 1.875rem 0.9375rem 0.9375rem; color: rgba(0, 0, 0, 0.8); font-family: Roboto, &amp;quot;Helvetica Neue&amp;quot;, Helvetica, Arial, 文泉驛正黑, &amp;quot;WenQuanYi Zen Hei&amp;quot;, &amp;quot;Hiragino Sans GB&amp;quot;, &amp;quot;儷黑 Pro&amp;quot;, &amp;quot;LiHei Pro&amp;quot;, &amp;quot;Heiti TC&amp;quot;, 微軟正黑體, &amp;quot;Microsoft JhengHei UI&amp;quot;, &amp;quot;Microsoft JhengHei&amp;quot;, sans-serif;&quot;&gt;&lt;div class=&quot;e8lZp3&quot; style=&quot;font-size: 0.875rem; line-height: 1.7; overflow: hidden; text-overflow: ellipsis; white-space-collapse: preserve;&quot;&gt;&lt;p class=&quot;QN2lPu&quot; style=&quot;margin-right: 0px; margin-bottom: 0px; margin-left: 0px;&quot;&gt;Sunflower oil is It&#039;s packed with essential fatty acids and vitamin E, so it feels moisturizing on the skin. It&#039;s perfect for dry areas because it&#039;s lightweight but it doesn&#039;t absorb too quickly.\r\nWhen it comes to skincare today, sunflower seed oil is a great source of vitamin E, rich in nutrients and antioxidants, and is effective for combatting skincare issues like acne, inflammation, general redness and irritation of the skin. Sunflower oil has emollient properties that help the skin retain its moisture.\r\n*for rebranding\r\n*Low Order Quantity\r\n*Quality Products\r\n* FDA Processing\r\n* Packaging Design&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;', 'https://vt.tiktok.com/ZS2wxNKoV/', 'https://shopee.ph/SUNFLOWER-OIL-100-60ml-i.922036405.19671447072?sp_atk=ec9e0dd7-425f-4ea1-b354-ab9c23c26952&xptdk=ec9e0dd7-425f-4ea1-b354-ab9c23c26952', '', 1, 0, '2024-10-13 22:58:08', 2),
(46, 37, 28, 'B1T3 for 50.00 Tawas Niacinamide with baking Soda 70g', '&lt;h2 class=&quot;WjNdTR&quot; style=&quot;background: rgba(0, 0, 0, 0.02); color: rgba(0, 0, 0, 0.87); font-size: 1.125rem; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0.875rem; text-transform: capitalize; font-family: Roboto, &amp;quot;Helvetica Neue&amp;quot;, Helvetica, Arial, 文泉驛正黑, &amp;quot;WenQuanYi Zen Hei&amp;quot;, &amp;quot;Hiragino Sans GB&amp;quot;, &amp;quot;儷黑 Pro&amp;quot;, &amp;quot;LiHei Pro&amp;quot;, &amp;quot;Heiti TC&amp;quot;, 微軟正黑體, &amp;quot;Microsoft JhengHei UI&amp;quot;, &amp;quot;Microsoft JhengHei&amp;quot;, sans-serif;&quot;&gt;Product Description&lt;/h2&gt;&lt;div class=&quot;Gf4Ro0&quot; style=&quot;margin: 1.875rem 0.9375rem 0.9375rem; color: rgba(0, 0, 0, 0.8); font-family: Roboto, &amp;quot;Helvetica Neue&amp;quot;, Helvetica, Arial, 文泉驛正黑, &amp;quot;WenQuanYi Zen Hei&amp;quot;, &amp;quot;Hiragino Sans GB&amp;quot;, &amp;quot;儷黑 Pro&amp;quot;, &amp;quot;LiHei Pro&amp;quot;, &amp;quot;Heiti TC&amp;quot;, 微軟正黑體, &amp;quot;Microsoft JhengHei UI&amp;quot;, &amp;quot;Microsoft JhengHei&amp;quot;, sans-serif;&quot;&gt;&lt;div class=&quot;e8lZp3&quot; style=&quot;font-size: 0.875rem; line-height: 1.7; overflow: hidden; text-overflow: ellipsis; white-space-collapse: preserve;&quot;&gt;&lt;p class=&quot;QN2lPu&quot; style=&quot;margin-right: 0px; margin-bottom: 0px; margin-left: 0px;&quot;&gt;Tawas Soap Niacinamide with baking soda is enriched with Tawas and Coconut Oil that help control excessive body sweat and help fight odor causing bacteria. FACTS: Contains tawas crystals, which acts as an antiseptic and eliminates bacteria; has natural bleaching properties to help whiten the skin, remove freckles and blemishes, and heal sun damage\r\n\r\nPERFECT FOR: Oily skin; skin that&rsquo;s regularly exposed to heat and pollution; people who sweat a lot\r\n\r\nLather on wet skin. Leave on for one minute on your face and three minutes on your body. Rinse well.\r\n\r\nDirections\r\n\r\n1. Gently massage on wet body.\r\n\r\n2. Rinse thoroughly.\r\n\r\n3. Use daily as a regular body soap.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;', 'https://vt.tiktok.com/ZS2wxDCpP/', 'https://shopee.ph/B1T3-for-50.00-Tawas-Niacinamide-with-baking-Soda-70g-i.922036405.27806311355?sp_atk=da23d40c-604e-4cec-9a83-9f341c1fc7ec&xptdk=da23d40c-604e-4cec-9a83-9f341c1fc7ec', '', 1, 0, '2024-10-13 23:02:24', 2);

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `reply_message` varchar(255) NOT NULL,
  `date_sent` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`id`, `sender_id`, `reply_message`, `date_sent`) VALUES
(19, 2, 'was', '2024-10-11 22:06:30'),
(24, 5, 'sa', '2024-10-11 22:16:10'),
(25, 5, 'yooo', '2024-10-11 22:17:29'),
(26, 3, 'babe', '2024-10-11 22:18:09'),
(27, 5, 'sa', '2024-10-11 22:29:10'),
(28, 5, 'yo', '2024-10-11 22:40:24'),
(29, 3, 'oh', '2024-10-11 22:43:35'),
(30, 2, 'ey', '2024-10-11 22:44:26'),
(31, 3, 'ugh', '2024-10-11 22:44:45'),
(32, 5, 'ugh', '2024-10-11 22:44:55'),
(33, 2, 'ugh', '2024-10-11 22:44:58'),
(34, 5, 'ugh', '2024-10-11 22:58:35');

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
(1, 'name', 'Magad Cosmetics Shop'),
(6, 'short_name', 'Magad Cosmetics Shop'),
(11, 'logo', 'uploads/logo-1728303833.png'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover-1728303988.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `email_address` varchar(250) DEFAULT NULL,
  `mobile_number` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`, `email_address`, `mobile_number`) VALUES
(1, 'Admin', 'Admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'uploads/avatars/1.png?v=1645064505', NULL, 1, '2021-01-20 14:02:37', '2024-10-07 20:19:20', NULL, NULL),
(2, 'John', 'Doe', 'superadmin1', '2c7b0576873ffcbb4ca61c5a225b94e7', 'uploads/avatars/2.png?v=1726475276', NULL, 2, '2021-01-20 14:02:37', '2024-10-13 23:15:33', 'kablon@gmail.com', '09090937257'),
(3, 'Marie', 'Tan', 'superadmin2', '2a43bf7ab34cd6bf5401343115eaf325', 'uploads/avatars/3.png?v=1726475208', NULL, 2, '2024-09-16 16:26:29', '2024-10-13 23:15:44', NULL, NULL),
(62, 'Staff', 'Staff', 'staff', '1253208465b1efa876f982d8a9e73eef', 'uploads/avatars/62.png?v=1728305143', NULL, 3, '2024-10-07 19:29:34', '2024-10-07 20:49:05', 'arzeljrz17@gmail.com', '09154138624'),
(63, 'staff2', 'staff2', 'staff2', '202cb962ac59075b964b07152d234b70', NULL, NULL, 3, '2024-10-10 21:50:58', '2024-10-13 20:27:21', 'staff@gmail.com', '12');

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
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`,`category_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `replies_ibfk_2` (`sender_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `client_id` (`clients_id`);

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
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

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
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

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
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `sender_id` FOREIGN KEY (`sender_id`) REFERENCES `clients` (`id`);

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
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `replies`
--
ALTER TABLE `replies`
  ADD CONSTRAINT `replies_ibfk_2` FOREIGN KEY (`sender_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `client_id` FOREIGN KEY (`clients_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
