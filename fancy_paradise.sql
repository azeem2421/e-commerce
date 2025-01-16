-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2025 at 01:17 PM
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
-- Database: `fancy_paradise`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_adminlogin`
--

CREATE TABLE `tbl_adminlogin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` text NOT NULL,
  `adminuser_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_adminlogin`
--

INSERT INTO `tbl_adminlogin` (`admin_id`, `username`, `password`, `status`, `adminuser_id`) VALUES
(1, 'azeem00421@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'Active', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_adminuser`
--

CREATE TABLE `tbl_adminuser` (
  `adminuser_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `nic_number` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `tel_number` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `gender` varchar(20) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_adminuser`
--

INSERT INTO `tbl_adminuser` (`adminuser_id`, `title`, `firstname`, `lastname`, `nic_number`, `dob`, `tel_number`, `email`, `address`, `gender`, `role_id`, `created_date_time`, `created_by`) VALUES
(1, 'Mr.', 'Aseem', 'Mohamed', '200011201273', '2000-04-21', '0754868604', 'azeem00421@gmail.com', '15/8, malwatta road, dehiwala', 'Male', 1, '2024-12-27 01:30:12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cart_id` int(10) NOT NULL,
  `session_id` text NOT NULL,
  `product_id` int(11) NOT NULL,
  `cart_qty` int(11) NOT NULL,
  `cart_product_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cart_id`, `session_id`, `product_id`, `cart_qty`, `cart_product_price`) VALUES
(180, '1688474890_::1', 70, 1, 350);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `category_title` varchar(100) NOT NULL,
  `category_imgname` varchar(255) NOT NULL,
  `category_featured` varchar(10) NOT NULL,
  `category_active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_title`, `category_imgname`, `category_featured`, `category_active`) VALUES
(60, 'HAIR CARE', 'indulekha.jpg', 'Yes', 'Yes'),
(61, 'FACE CARE', 'keune.webp', 'Yes', 'Yes'),
(63, 'SKIN CARE', 'body shop.jpg', 'No', 'No'),
(68, 'HAIR COLOUR', 'abha.jpg', 'No', 'Yes'),
(69, 'PERFUME', 'dove body spray.jpg', 'No', 'Yes'),
(70, 'MAKE UP', 'ccuk.jpg', 'No', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_city`
--

CREATE TABLE `tbl_city` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(200) NOT NULL,
  `city_amount` double(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_city`
--

INSERT INTO `tbl_city` (`city_id`, `city_name`, `city_amount`) VALUES
(1, 'Dehiwala', 100),
(2, 'Wellawatta', 150),
(3, 'Mount Lavinia', 150),
(4, 'Kohuwala', 200),
(5, 'Boralesgamuwa', 200);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cuslogin`
--

CREATE TABLE `tbl_cuslogin` (
  `user_id` int(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_cuslogin`
--

INSERT INTO `tbl_cuslogin` (`user_id`, `email`, `password`, `customer_id`) VALUES
(1, 'azeem00421@gmail.com', '123', 25);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `customer_id` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `telephone_no` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `added_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`customer_id`, `title`, `first_name`, `last_name`, `address`, `telephone_no`, `email`, `status`, `added_datetime`) VALUES
(25, 'Mr.', 'Aseem', 'Mohamed', '15/8, Malwatta Road, Dehiwala', '0703584413', 'azeem00421@gmail.com', 'Active', '2024-12-27 18:06:01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_messages`
--

CREATE TABLE `tbl_messages` (
  `message_id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` int(11) NOT NULL,
  `message` varchar(200) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL,
  `message_status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_messages`
--

INSERT INTO `tbl_messages` (`message_id`, `name`, `email`, `phone`, `message`, `date`, `time`, `message_status`) VALUES
(48, 'Aseem Mohamed', 'azeem00421@gmail.com', 754868604, '', '2024-12-27', '19:15:09', 'Replied'),
(49, 'Aseem', 'azeem200421@gmail.com', 754868604, '', '2024-12-27', '01:50:05', 'Pending'),
(50, 'gihan', 'gma@gmail.com', 703584413, '', '2024-12-27', '02:01:06', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_module`
--

CREATE TABLE `tbl_module` (
  `module_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_module`
--

INSERT INTO `tbl_module` (`module_id`, `name`, `image`) VALUES
(1, 'category', 'category.png'),
(2, 'products', 'products.png'),
(3, 'orders', 'orders.png'),
(4, 'messages', 'messages.png'),
(5, 'reports', 'reports.png'),
(6, 'payment', 'payment.png'),
(7, 'users', 'users.png'),
(8, 'settings', 'settings.png'),
(9, 'tracking', 'tracking.png'),
(10, 'backup', 'backup.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_module_role`
--

CREATE TABLE `tbl_module_role` (
  `module_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_module_role`
--

INSERT INTO `tbl_module_role` (`module_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(3, 3),
(4, 1),
(4, 2),
(5, 1),
(5, 2),
(6, 1),
(6, 2),
(7, 1),
(8, 1),
(9, 1),
(9, 2),
(10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `session_id` text NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_type` varchar(200) NOT NULL,
  `order_pay_type` varchar(200) NOT NULL,
  `order_total` double(10,2) NOT NULL,
  `order_datetime` datetime NOT NULL,
  `order_status` varchar(50) NOT NULL,
  `performed_by` int(11) DEFAULT NULL,
  `delivery_address` text NOT NULL,
  `city_id` int(11) NOT NULL,
  `city_payment` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `session_id`, `customer_id`, `order_type`, `order_pay_type`, `order_total`, `order_datetime`, `order_status`, `performed_by`, `delivery_address`, `city_id`, `city_payment`) VALUES
(90, '1688406405_::1', 25, 'Online', 'Cash', 1489.00, '2023-07-03 23:17:03', 'Rejected', NULL, '181, Galle Road,', 3, 150),
(91, '1688406405_::1', 25, 'Online', 'Cash', 818.00, '2023-07-03 23:53:46', 'Rejected', NULL, '181, Galle Road,', 4, 200),
(92, '1688406405_::1', 25, 'Online', 'Cash', 510.50, '2023-07-04 00:56:04', 'Delivered', NULL, '181, Galle Road,', 2, 150),
(93, '1688406405_::1', 25, 'Online', 'Cash', 2313.00, '2023-07-04 02:45:17', 'Delivered', NULL, '181, Galle Road,', 2, 150),
(94, '1688406405_::1', 25, 'Online', 'Cash', 9523.00, '2023-07-04 02:46:15', 'Pending', NULL, '181, Galle Road,', 2, 150),
(95, '1688474890_::1', 25, 'Online', 'Cash', 510.50, '2023-07-04 18:18:22', 'Pending', NULL, '181, Galle Road,', 2, 150),
(96, '1688474890_::1', 25, 'Online', 'Cash', 357.50, '2023-07-04 19:19:34', 'Pending', NULL, '181, Galle Road,', 1, 100),
(97, '1688655779_::1', 26, 'Online', 'Cash', 1799.50, '2023-07-07 01:57:00', 'Pending', NULL, 'Qui minima rerum ali', 1, 100),
(98, '1688655779_::1', 25, 'Online', 'Cash', 718.00, '2023-07-07 02:13:16', 'Pending', NULL, '181 galle road dehiwala', 1, 100);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orderdetails`
--

CREATE TABLE `tbl_orderdetails` (
  `orderdetail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_quantity` int(11) NOT NULL,
  `order_prd_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_orderdetails`
--

INSERT INTO `tbl_orderdetails` (`orderdetail_id`, `order_id`, `product_id`, `order_quantity`, `order_prd_price`) VALUES
(137, 90, 67, 1, 250),
(138, 90, 70, 3, 350),
(139, 91, 70, 1, 350),
(140, 91, 67, 1, 250),
(141, 92, 70, 1, 350),
(142, 93, 70, 1, 350),
(143, 93, 67, 7, 250),
(144, 94, 70, 16, 350),
(145, 94, 67, 14, 250),
(146, 95, 70, 1, 350),
(147, 96, 67, 1, 250),
(148, 97, 70, 1, 350),
(149, 97, 73, 1, 800),
(150, 97, 72, 1, 500),
(151, 98, 67, 1, 250),
(152, 98, 70, 1, 350);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orderstatus`
--

CREATE TABLE `tbl_orderstatus` (
  `orderstatus_id` int(11) NOT NULL,
  `orderstatus_name` varchar(50) NOT NULL,
  `orderstatus_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_orderstatus`
--

INSERT INTO `tbl_orderstatus` (`orderstatus_id`, `orderstatus_name`, `orderstatus_desc`) VALUES
(1, 'Pending', 'Order is pending'),
(2, 'Processing', 'Order is processing'),
(3, 'Ready', 'Order is ready for Shipping'),
(4, 'Dispatched', 'Order is on the way'),
(5, 'Delivered', 'Order Delivered Successfully'),
(6, 'Rejected', 'Order was Rejected');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ordertracking`
--

CREATE TABLE `tbl_ordertracking` (
  `ordertracking_id` int(11) NOT NULL,
  `ordertracking_order_id` int(11) NOT NULL,
  `ordertracking_orderstatus_id` int(11) NOT NULL,
  `ordertracking_comment` text NOT NULL,
  `ordertracking_datetime` datetime NOT NULL,
  `ordertracking_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_ordertracking`
--

INSERT INTO `tbl_ordertracking` (`ordertracking_id`, `ordertracking_order_id`, `ordertracking_orderstatus_id`, `ordertracking_comment`, `ordertracking_datetime`, `ordertracking_user_id`) VALUES
(23, 90, 1, '', '2024-12-27 19:47:03', 0),
(24, 90, 6, '', '2024-12-27 19:48:29', 1),
(25, 91, 1, '', '2024-12-27 20:23:46', 0),
(26, 91, 6, '', '2024-12-27 21:20:44', 1),
(27, 92, 1, '', '2024-12-27 21:26:04', 0),
(28, 93, 1, '', '2024-12-27 23:15:17', 0),
(29, 94, 1, '', '2024-12-27 23:16:15', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `reference_no` text NOT NULL,
  `payment_type` varchar(200) NOT NULL,
  `payment_total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`payment_id`, `order_id`, `reference_no`, `payment_type`, `payment_total`) VALUES
(91, 90, '902520230703', 'Cash', 1489),
(92, 91, '912520230703', 'Cash', 818),
(93, 92, '922520230703', 'Cash', 510.5),
(94, 93, '932520230703', 'Cash', 2313),
(95, 94, '942520230703', 'Cash', 9523),
(96, 95, '952520230704', 'Cash', 510.5),
(97, 96, '962520230704', 'Cash', 357.5),
(98, 97, '972620230706', 'Cash', 1799.5),
(99, 98, '982520230706', 'Cash', 718);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_title` varchar(100) NOT NULL,
  `product_description` text NOT NULL,
  `product_price` double NOT NULL,
  `product_imgname` varchar(255) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `product_active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`product_id`, `product_title`, `product_description`, `product_price`, `product_imgname`, `product_quantity`, `category_id`, `product_active`) VALUES
(67, 'AROMA', 'face care', 250, 'Aroma.webp', 50, 61, 'Yes'),
(70, 'ARGAN', 'good hair product', 350, 'argan.jpg', 25, 60, 'Yes'),
(72, 'JOVES MASSAGE', 'face care', 500, 'Jovees massage.jpg', 30, 61, 'Yes'),
(73, 'JOVES', 'face care', 800, 'Jovees.jpg', 15, 61, 'Yes'),
(74, 'DOVE BODY SPRAY', 'perfume', 1050, 'dove body spray.jpg', 23, 69, 'Yes'),
(75, 'DAX', 'hair care', 750, 'dax.jpg', 14, 60, 'Yes'),
(77, 'DERMA', 'make up', 900, 'derma.jpg', 12, 70, 'Yes'),
(78, 'CCUK', 'make up', 650, 'ccuk.jpg', 15, 70, 'Yes'),
(79, 'HUDA', 'make up', 850, 'huda.jpg', 0, 70, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE `tbl_role` (
  `role_id` int(10) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `role_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`role_id`, `role_name`, `role_status`) VALUES
(1, 'Super Admin', 'Active'),
(2, 'Admin', 'Active'),
(3, 'Delivery Driver', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_userlog`
--

CREATE TABLE `tbl_userlog` (
  `user_log_id` int(11) NOT NULL,
  `login_datetime` datetime NOT NULL,
  `logout_datetime` datetime NOT NULL,
  `login_ip` text NOT NULL,
  `login_status` varchar(50) NOT NULL,
  `adminuser_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_userlog`
--

INSERT INTO `tbl_userlog` (`user_log_id`, `login_datetime`, `logout_datetime`, `login_ip`, `login_status`, `adminuser_id`) VALUES
(77, '2024-12-27 16:33:51', '2024-12-27 20:14:50', '::1', 'Logged Out', 1),
(78, '2024-12-27 17:47:49', '2024-12-27 20:14:50', '::1', 'Logged Out', 1),
(79, '2024-12-27 17:49:17', '2024-12-27 20:14:50', '::1', 'Logged Out', 1),
(80, '2024-12-27 18:25:44', '2024-12-27 20:14:50', '::1', 'Logged Out', 1),
(81, '2024-12-27 20:14:53', '2024-12-27 21:07:02', '::1', 'Logged Out', 1),
(82, '2024-12-27 21:07:04', '2024-12-27 21:08:37', '::1', 'Logged Out', 1),
(83, '2024-12-27 21:08:40', '2024-12-27 21:11:52', '::1', 'Logged Out', 1),
(84, '2024-12-27 21:11:55', '2024-12-27 21:12:07', '::1', 'Logged Out', 1),
(85, '2024-12-27 21:12:15', '2024-12-27 21:14:13', '::1', 'Logged Out', 1),
(86, '2024-12-27 21:14:15', '2024-12-27 21:18:07', '::1', 'Logged Out', 1),
(87, '2024-12-27 21:18:09', '2024-12-27 21:30:41', '::1', 'Logged Out', 1),
(88, '2024-12-27 21:22:33', '2024-12-27 21:30:41', '::1', 'Logged Out', 1),
(89, '2024-12-27 21:23:46', '2024-12-27 21:30:41', '::1', 'Logged Out', 1),
(90, '2024-12-27 21:30:44', '2024-12-27 21:38:20', '::1', 'Logged Out', 1),
(91, '2024-12-27 21:38:23', '2024-12-27 21:39:19', '::1', 'Logged Out', 1),
(92, '2024-12-27 21:39:45', '2024-12-27 21:40:05', '::1', 'Logged Out', 1),
(93, '2024-12-27 21:40:07', '2024-12-27 21:54:56', '::1', 'Logged Out', 1),
(94, '2024-12-27 21:54:58', '2024-12-27 21:56:33', '::1', 'Logged Out', 1),
(95, '2024-12-27 21:56:52', '2024-12-27 22:35:05', '::1', 'Logged Out', 1),
(96, '2024-12-27 22:35:08', '2024-12-27 22:54:03', '::1', 'Logged Out', 1),
(97, '2024-12-27 22:54:06', '2024-12-27 22:56:13', '::1', 'Logged Out', 1),
(98, '2024-12-27 22:56:15', '2024-12-27 00:16:49', '::1', 'Logged Out', 1),
(100, '2023-07-06 00:24:34', '2023-07-06 00:25:30', '::1', 'Logged Out', 1),
(101, '2023-07-06 00:25:33', '2023-07-06 00:25:59', '::1', 'Logged Out', 1),
(102, '2023-07-06 15:30:28', '0000-00-00 00:00:00', '::1', 'Logged In', 1),
(103, '2023-07-06 15:41:20', '0000-00-00 00:00:00', '::1', 'Logged In', 1),
(104, '2023-07-06 15:59:27', '0000-00-00 00:00:00', '::1', 'Logged In', 1),
(105, '2023-07-06 16:00:01', '0000-00-00 00:00:00', '::1', 'Logged In', 1),
(106, '2023-07-06 17:24:05', '0000-00-00 00:00:00', '::1', 'Logged In', 1),
(107, '2023-07-07 01:30:50', '0000-00-00 00:00:00', '::1', 'Logged In', 1),
(108, '2023-07-07 04:48:07', '0000-00-00 00:00:00', '::1', 'Logged In', 1),
(109, '2023-07-07 07:37:20', '0000-00-00 00:00:00', '::1', 'Logged In', 1),
(110, '2023-07-07 19:27:05', '0000-00-00 00:00:00', '::1', 'Logged In', 1),
(111, '2025-01-04 17:00:43', '0000-00-00 00:00:00', '::1', 'Logged In', 1),
(112, '2025-01-04 17:32:34', '0000-00-00 00:00:00', '::1', 'Logged In', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_adminlogin`
--
ALTER TABLE `tbl_adminlogin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_adminuser`
--
ALTER TABLE `tbl_adminuser`
  ADD PRIMARY KEY (`adminuser_id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_city`
--
ALTER TABLE `tbl_city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `tbl_cuslogin`
--
ALTER TABLE `tbl_cuslogin`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `tbl_messages`
--
ALTER TABLE `tbl_messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `tbl_module`
--
ALTER TABLE `tbl_module`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `tbl_module_role`
--
ALTER TABLE `tbl_module_role`
  ADD PRIMARY KEY (`module_id`,`role_id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tbl_orderdetails`
--
ALTER TABLE `tbl_orderdetails`
  ADD PRIMARY KEY (`orderdetail_id`);

--
-- Indexes for table `tbl_orderstatus`
--
ALTER TABLE `tbl_orderstatus`
  ADD PRIMARY KEY (`orderstatus_id`);

--
-- Indexes for table `tbl_ordertracking`
--
ALTER TABLE `tbl_ordertracking`
  ADD PRIMARY KEY (`ordertracking_id`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tbl_userlog`
--
ALTER TABLE `tbl_userlog`
  ADD PRIMARY KEY (`user_log_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_adminlogin`
--
ALTER TABLE `tbl_adminlogin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_adminuser`
--
ALTER TABLE `tbl_adminuser`
  MODIFY `adminuser_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cart_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `tbl_city`
--
ALTER TABLE `tbl_city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_cuslogin`
--
ALTER TABLE `tbl_cuslogin`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_messages`
--
ALTER TABLE `tbl_messages`
  MODIFY `message_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tbl_module`
--
ALTER TABLE `tbl_module`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `tbl_orderdetails`
--
ALTER TABLE `tbl_orderdetails`
  MODIFY `orderdetail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `tbl_orderstatus`
--
ALTER TABLE `tbl_orderstatus`
  MODIFY `orderstatus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_ordertracking`
--
ALTER TABLE `tbl_ordertracking`
  MODIFY `ordertracking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `role_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_userlog`
--
ALTER TABLE `tbl_userlog`
  MODIFY `user_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD CONSTRAINT `tbl_products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `tbl_category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
