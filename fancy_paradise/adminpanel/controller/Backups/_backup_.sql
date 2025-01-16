

CREATE TABLE `tbl_adminlogin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` text NOT NULL,
  `adminuser_id` int(11) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbl_adminlogin VALUES("1","gmahawewa@gmail.com","e7b426317839ce8ee2b57947dbb820561c17450f","Active","1");



CREATE TABLE `tbl_adminuser` (
  `adminuser_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`adminuser_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbl_adminuser VALUES("1","Mr.","Gihan","Mahawewa","970953809V","1997-04-04","0778412323","gmahawewa@gmail.com","181, galle road, dehiwala.","Male","1","2023-07-07 01:30:12","1");



CREATE TABLE `tbl_cart` (
  `cart_id` int(10) NOT NULL AUTO_INCREMENT,
  `session_id` text NOT NULL,
  `product_id` int(11) NOT NULL,
  `cart_qty` int(11) NOT NULL,
  `cart_product_price` double NOT NULL,
  PRIMARY KEY (`cart_id`)
) ENGINE=InnoDB AUTO_INCREMENT=199 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO tbl_cart VALUES("180","1688474890_::1","70","1","350");



CREATE TABLE `tbl_category` (
  `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_title` varchar(100) NOT NULL,
  `category_imgname` varchar(255) NOT NULL,
  `category_featured` varchar(10) NOT NULL,
  `category_active` varchar(10) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO tbl_category VALUES("60","HAIR CARE","indulekha.jpg","Yes","Yes");
INSERT INTO tbl_category VALUES("61","FACE CARE","keune.webp","Yes","Yes");
INSERT INTO tbl_category VALUES("63","SKIN CARE","body shop.jpg","No","No");
INSERT INTO tbl_category VALUES("68","HAIR COLOUR","abha.jpg","No","Yes");
INSERT INTO tbl_category VALUES("69","PERFUME","dove body spray.jpg","No","Yes");
INSERT INTO tbl_category VALUES("70","MAKE UP","ccuk.jpg","No","Yes");



CREATE TABLE `tbl_city` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(200) NOT NULL,
  `city_amount` double(10,0) NOT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbl_city VALUES("1","Dehiwala","100");
INSERT INTO tbl_city VALUES("2","Wellawatta","150");
INSERT INTO tbl_city VALUES("3","Mount Lavinia","150");
INSERT INTO tbl_city VALUES("4","Kohuwala","200");
INSERT INTO tbl_city VALUES("5","Boralesgamuwa","200");



CREATE TABLE `tbl_cuslogin` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `customer_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO tbl_cuslogin VALUES("1","gmahawewa@gmail.com","123","25");



CREATE TABLE `tbl_customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `telephone_no` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `added_datetime` datetime NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbl_customer VALUES("25","Mr.","Gihan","Mahawewa","181, Galle Road, Dehiwala","0703584413","gmahawewa@gmail.com","Active","2023-07-01 18:06:01");



CREATE TABLE `tbl_messages` (
  `message_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` int(11) NOT NULL,
  `message` varchar(200) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL,
  `message_status` text NOT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO tbl_messages VALUES("47","Mark Patrick","vigyfox@mailinator.com","1","","2023-06-13","22:18:48","Replied");
INSERT INTO tbl_messages VALUES("48","Gihan Rajitha Mahawewa","gmahawewa@gmail.com","703584413","","2023-07-04","19:15:09","Replied");
INSERT INTO tbl_messages VALUES("49","gihan","gmahawewa@gmail.com","703584413","","2023-07-07","01:50:05","Pending");
INSERT INTO tbl_messages VALUES("50","gihan","gmahawewa@gmail.com","703584413","","2023-07-07","02:01:06","Pending");
INSERT INTO tbl_messages VALUES("51","gihan","gmahawewa@gmail.com","703584413","","2023-07-07","02:03:17","Pending");



CREATE TABLE `tbl_module` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `image` text NOT NULL,
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbl_module VALUES("1","category","category.png");
INSERT INTO tbl_module VALUES("2","products","products.png");
INSERT INTO tbl_module VALUES("3","orders","orders.png");
INSERT INTO tbl_module VALUES("4","messages","messages.png");
INSERT INTO tbl_module VALUES("5","reports","reports.png");
INSERT INTO tbl_module VALUES("6","payment","payment.png");
INSERT INTO tbl_module VALUES("7","users","users.png");
INSERT INTO tbl_module VALUES("8","settings","settings.png");
INSERT INTO tbl_module VALUES("9","tracking","tracking.png");
INSERT INTO tbl_module VALUES("10","backup","backup.png");



CREATE TABLE `tbl_module_role` (
  `module_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`module_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbl_module_role VALUES("1","1");
INSERT INTO tbl_module_role VALUES("1","2");
INSERT INTO tbl_module_role VALUES("2","1");
INSERT INTO tbl_module_role VALUES("2","2");
INSERT INTO tbl_module_role VALUES("3","1");
INSERT INTO tbl_module_role VALUES("3","2");
INSERT INTO tbl_module_role VALUES("3","3");
INSERT INTO tbl_module_role VALUES("4","1");
INSERT INTO tbl_module_role VALUES("4","2");
INSERT INTO tbl_module_role VALUES("5","1");
INSERT INTO tbl_module_role VALUES("5","2");
INSERT INTO tbl_module_role VALUES("6","1");
INSERT INTO tbl_module_role VALUES("6","2");
INSERT INTO tbl_module_role VALUES("7","1");
INSERT INTO tbl_module_role VALUES("8","1");
INSERT INTO tbl_module_role VALUES("9","1");
INSERT INTO tbl_module_role VALUES("9","2");
INSERT INTO tbl_module_role VALUES("10","1");



CREATE TABLE `tbl_order` (
  `order_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `city_payment` double NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO tbl_order VALUES("90","1688406405_::1","25","Online","Cash","1489.00","2023-07-03 23:17:03","Rejected","0","181, Galle Road,","3","150");
INSERT INTO tbl_order VALUES("91","1688406405_::1","25","Online","Cash","818.00","2023-07-03 23:53:46","Rejected","0","181, Galle Road,","4","200");
INSERT INTO tbl_order VALUES("92","1688406405_::1","25","Online","Cash","510.50","2023-07-04 00:56:04","Delivered","0","181, Galle Road,","2","150");
INSERT INTO tbl_order VALUES("93","1688406405_::1","25","Online","Cash","2313.00","2023-07-04 02:45:17","Delivered","0","181, Galle Road,","2","150");
INSERT INTO tbl_order VALUES("94","1688406405_::1","25","Online","Cash","9523.00","2023-07-04 02:46:15","Pending","0","181, Galle Road,","2","150");
INSERT INTO tbl_order VALUES("95","1688474890_::1","25","Online","Cash","510.50","2023-07-04 18:18:22","Pending","0","181, Galle Road,","2","150");
INSERT INTO tbl_order VALUES("96","1688474890_::1","25","Online","Cash","357.50","2023-07-04 19:19:34","Pending","0","181, Galle Road,","1","100");
INSERT INTO tbl_order VALUES("97","1688655779_::1","26","Online","Cash","1799.50","2023-07-07 01:57:00","Pending","0","Qui minima rerum ali","1","100");
INSERT INTO tbl_order VALUES("98","1688655779_::1","25","Online","Cash","718.00","2023-07-07 02:13:16","Pending","0","181 galle road dehiwala","1","100");



CREATE TABLE `tbl_orderdetails` (
  `orderdetail_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_quantity` int(11) NOT NULL,
  `order_prd_price` double NOT NULL,
  PRIMARY KEY (`orderdetail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=153 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbl_orderdetails VALUES("137","90","67","1","250");
INSERT INTO tbl_orderdetails VALUES("138","90","70","3","350");
INSERT INTO tbl_orderdetails VALUES("139","91","70","1","350");
INSERT INTO tbl_orderdetails VALUES("140","91","67","1","250");
INSERT INTO tbl_orderdetails VALUES("141","92","70","1","350");
INSERT INTO tbl_orderdetails VALUES("142","93","70","1","350");
INSERT INTO tbl_orderdetails VALUES("143","93","67","7","250");
INSERT INTO tbl_orderdetails VALUES("144","94","70","16","350");
INSERT INTO tbl_orderdetails VALUES("145","94","67","14","250");
INSERT INTO tbl_orderdetails VALUES("146","95","70","1","350");
INSERT INTO tbl_orderdetails VALUES("147","96","67","1","250");
INSERT INTO tbl_orderdetails VALUES("148","97","70","1","350");
INSERT INTO tbl_orderdetails VALUES("149","97","73","1","800");
INSERT INTO tbl_orderdetails VALUES("150","97","72","1","500");
INSERT INTO tbl_orderdetails VALUES("151","98","67","1","250");
INSERT INTO tbl_orderdetails VALUES("152","98","70","1","350");



CREATE TABLE `tbl_orderstatus` (
  `orderstatus_id` int(11) NOT NULL AUTO_INCREMENT,
  `orderstatus_name` varchar(50) NOT NULL,
  `orderstatus_desc` text NOT NULL,
  PRIMARY KEY (`orderstatus_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbl_orderstatus VALUES("1","Pending","Order is pending");
INSERT INTO tbl_orderstatus VALUES("2","Processing","Order is processing");
INSERT INTO tbl_orderstatus VALUES("3","Ready","Order is ready for Shipping");
INSERT INTO tbl_orderstatus VALUES("4","Dispatched","Order is on the way");
INSERT INTO tbl_orderstatus VALUES("5","Delivered","Order Delivered Successfully");
INSERT INTO tbl_orderstatus VALUES("6","Rejected","Order was Rejected");



CREATE TABLE `tbl_ordertracking` (
  `ordertracking_id` int(11) NOT NULL AUTO_INCREMENT,
  `ordertracking_order_id` int(11) NOT NULL,
  `ordertracking_orderstatus_id` int(11) NOT NULL,
  `ordertracking_comment` text NOT NULL,
  `ordertracking_datetime` datetime NOT NULL,
  `ordertracking_user_id` int(11) NOT NULL,
  PRIMARY KEY (`ordertracking_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbl_ordertracking VALUES("23","90","1","","2023-07-03 19:47:03","0");
INSERT INTO tbl_ordertracking VALUES("24","90","6","","2023-07-03 19:48:29","1");
INSERT INTO tbl_ordertracking VALUES("25","91","1","","2023-07-03 20:23:46","0");
INSERT INTO tbl_ordertracking VALUES("26","91","6","","2023-07-03 21:20:44","1");
INSERT INTO tbl_ordertracking VALUES("27","92","1","","2023-07-03 21:26:04","0");
INSERT INTO tbl_ordertracking VALUES("28","93","1","","2023-07-03 23:15:17","0");
INSERT INTO tbl_ordertracking VALUES("29","94","1","","2023-07-03 23:16:15","0");
INSERT INTO tbl_ordertracking VALUES("30","95","1","","2023-07-04 14:48:22","0");
INSERT INTO tbl_ordertracking VALUES("31","96","1","","2023-07-04 15:49:34","0");
INSERT INTO tbl_ordertracking VALUES("32","92","5","","2023-07-04 22:07:11","1");
INSERT INTO tbl_ordertracking VALUES("33","97","1","","2023-07-06 22:27:00","0");
INSERT INTO tbl_ordertracking VALUES("34","98","1","","2023-07-06 22:43:16","0");



CREATE TABLE `tbl_payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `reference_no` text NOT NULL,
  `payment_type` varchar(200) NOT NULL,
  `payment_total` double NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbl_payment VALUES("91","90","902520230703","Cash","1489");
INSERT INTO tbl_payment VALUES("92","91","912520230703","Cash","818");
INSERT INTO tbl_payment VALUES("93","92","922520230703","Cash","510.5");
INSERT INTO tbl_payment VALUES("94","93","932520230703","Cash","2313");
INSERT INTO tbl_payment VALUES("95","94","942520230703","Cash","9523");
INSERT INTO tbl_payment VALUES("96","95","952520230704","Cash","510.5");
INSERT INTO tbl_payment VALUES("97","96","962520230704","Cash","357.5");
INSERT INTO tbl_payment VALUES("98","97","972620230706","Cash","1799.5");
INSERT INTO tbl_payment VALUES("99","98","982520230706","Cash","718");



CREATE TABLE `tbl_products` (
  `product_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_title` varchar(100) NOT NULL,
  `product_description` text NOT NULL,
  `product_price` double NOT NULL,
  `product_imgname` varchar(255) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `product_active` varchar(10) NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `tbl_products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `tbl_category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO tbl_products VALUES("67","AROMA","face care","250","Aroma.webp","50","61","Yes");
INSERT INTO tbl_products VALUES("70","ARGAN","good hair product","350","argan.jpg","25","60","Yes");
INSERT INTO tbl_products VALUES("72","JOVES MASSAGE","face care","500","Jovees massage.jpg","30","61","Yes");
INSERT INTO tbl_products VALUES("73","JOVES","face care","800","Jovees.jpg","15","61","Yes");
INSERT INTO tbl_products VALUES("74","DOVE BODY SPRAY","perfume","1050","dove body spray.jpg","23","69","Yes");
INSERT INTO tbl_products VALUES("75","DAX","hair care","750","dax.jpg","14","60","Yes");
INSERT INTO tbl_products VALUES("77","DERMA","make up","900","derma.jpg","12","70","Yes");
INSERT INTO tbl_products VALUES("78","CCUK","make up","650","ccuk.jpg","15","70","Yes");
INSERT INTO tbl_products VALUES("79","HUDA","make up","850","huda.jpg","0","70","Yes");



CREATE TABLE `tbl_role` (
  `role_id` int(10) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL,
  `role_status` varchar(50) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO tbl_role VALUES("1","Super Admin","Active");
INSERT INTO tbl_role VALUES("2","Admin","Active");
INSERT INTO tbl_role VALUES("3","Delivery Driver","Active");



CREATE TABLE `tbl_userlog` (
  `user_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `login_datetime` datetime NOT NULL,
  `logout_datetime` datetime NOT NULL,
  `login_ip` text NOT NULL,
  `login_status` varchar(50) NOT NULL,
  `adminuser_id` int(11) NOT NULL,
  PRIMARY KEY (`user_log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbl_userlog VALUES("73","2023-07-05 01:01:40","2023-07-05 20:14:50","::1","Logged Out","1");
INSERT INTO tbl_userlog VALUES("74","2023-07-01 10:15:00","2023-07-01 11:30:00","127.0.0.1","Logged In","1");
INSERT INTO tbl_userlog VALUES("77","2023-07-05 16:33:51","2023-07-05 20:14:50","::1","Logged Out","1");
INSERT INTO tbl_userlog VALUES("78","2023-07-05 17:47:49","2023-07-05 20:14:50","::1","Logged Out","1");
INSERT INTO tbl_userlog VALUES("79","2023-07-05 17:49:17","2023-07-05 20:14:50","::1","Logged Out","1");
INSERT INTO tbl_userlog VALUES("80","2023-07-05 18:25:44","2023-07-05 20:14:50","::1","Logged Out","1");
INSERT INTO tbl_userlog VALUES("81","2023-07-05 20:14:53","2023-07-05 21:07:02","::1","Logged Out","1");
INSERT INTO tbl_userlog VALUES("82","2023-07-05 21:07:04","2023-07-05 21:08:37","::1","Logged Out","1");
INSERT INTO tbl_userlog VALUES("83","2023-07-05 21:08:40","2023-07-05 21:11:52","::1","Logged Out","1");
INSERT INTO tbl_userlog VALUES("84","2023-07-05 21:11:55","2023-07-05 21:12:07","::1","Logged Out","1");
INSERT INTO tbl_userlog VALUES("85","2023-07-05 21:12:15","2023-07-05 21:14:13","::1","Logged Out","1");
INSERT INTO tbl_userlog VALUES("86","2023-07-05 21:14:15","2023-07-05 21:18:07","::1","Logged Out","1");
INSERT INTO tbl_userlog VALUES("87","2023-07-05 21:18:09","2023-07-05 21:30:41","::1","Logged Out","1");
INSERT INTO tbl_userlog VALUES("88","2023-07-05 21:22:33","2023-07-05 21:30:41","::1","Logged Out","1");
INSERT INTO tbl_userlog VALUES("89","2023-07-05 21:23:46","2023-07-05 21:30:41","::1","Logged Out","1");
INSERT INTO tbl_userlog VALUES("90","2023-07-05 21:30:44","2023-07-05 21:38:20","::1","Logged Out","1");
INSERT INTO tbl_userlog VALUES("91","2023-07-05 21:38:23","2023-07-05 21:39:19","::1","Logged Out","1");
INSERT INTO tbl_userlog VALUES("92","2023-07-05 21:39:45","2023-07-05 21:40:05","::1","Logged Out","1");
INSERT INTO tbl_userlog VALUES("93","2023-07-05 21:40:07","2023-07-05 21:54:56","::1","Logged Out","1");
INSERT INTO tbl_userlog VALUES("94","2023-07-05 21:54:58","2023-07-05 21:56:33","::1","Logged Out","1");
INSERT INTO tbl_userlog VALUES("95","2023-07-05 21:56:52","2023-07-05 22:35:05","::1","Logged Out","1");
INSERT INTO tbl_userlog VALUES("96","2023-07-05 22:35:08","2023-07-05 22:54:03","::1","Logged Out","1");
INSERT INTO tbl_userlog VALUES("97","2023-07-05 22:54:06","2023-07-05 22:56:13","::1","Logged Out","1");
INSERT INTO tbl_userlog VALUES("98","2023-07-05 22:56:15","2023-07-06 00:16:49","::1","Logged Out","1");
INSERT INTO tbl_userlog VALUES("99","2023-07-06 00:18:09","2023-07-06 00:20:26","::1","Logged Out","1");
INSERT INTO tbl_userlog VALUES("100","2023-07-06 00:24:34","2023-07-06 00:25:30","::1","Logged Out","1");
INSERT INTO tbl_userlog VALUES("101","2023-07-06 00:25:33","2023-07-06 00:25:59","::1","Logged Out","1");
INSERT INTO tbl_userlog VALUES("102","2023-07-06 15:30:28","0000-00-00 00:00:00","::1","Logged In","1");
INSERT INTO tbl_userlog VALUES("103","2023-07-06 15:41:20","0000-00-00 00:00:00","::1","Logged In","1");
INSERT INTO tbl_userlog VALUES("104","2023-07-06 15:59:27","0000-00-00 00:00:00","::1","Logged In","1");
INSERT INTO tbl_userlog VALUES("105","2023-07-06 16:00:01","0000-00-00 00:00:00","::1","Logged In","1");
INSERT INTO tbl_userlog VALUES("106","2023-07-06 17:24:05","0000-00-00 00:00:00","::1","Logged In","1");
INSERT INTO tbl_userlog VALUES("107","2023-07-07 01:30:50","0000-00-00 00:00:00","::1","Logged In","1");
INSERT INTO tbl_userlog VALUES("108","2023-07-07 04:48:07","0000-00-00 00:00:00","::1","Logged In","1");
INSERT INTO tbl_userlog VALUES("109","2023-07-07 07:37:20","0000-00-00 00:00:00","::1","Logged In","1");
INSERT INTO tbl_userlog VALUES("110","2023-07-07 19:27:05","0000-00-00 00:00:00","::1","Logged In","1");
INSERT INTO tbl_userlog VALUES("111","2023-07-08 01:02:30","0000-00-00 00:00:00","::1","Logged In","1");

