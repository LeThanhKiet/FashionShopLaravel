-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2024 at 04:37 PM
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
-- Database: `laravel-shopfashion`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Áo Hoodie'),
(2, 'Áo Sweater'),
(3, 'Áo Oversize T-Shirt'),
(5, 'Áo Thun Wash'),
(6, 'Quần Jean'),
(7, 'Quần Kaki'),
(8, 'Quần Short'),
(9, 'Áo Polo'),
(10, 'Áo Tank Top');

-- --------------------------------------------------------

--
-- Table structure for table `import_bill`
--

CREATE TABLE `import_bill` (
  `id` int(11) NOT NULL,
  `id_staff` int(11) DEFAULT NULL,
  `id_supplier` int(11) DEFAULT NULL,
  `total_money` float DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `import_bill`
--

INSERT INTO `import_bill` (`id`, `id_staff`, `id_supplier`, `total_money`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 700000, '2022-02-21 09:10:38', '2022-02-20 23:54:51'),
(2, 1, 1, 690000, '2022-02-21 09:10:41', '2022-02-20 23:55:39'),
(3, 1, 2, 12500000, '2022-02-21 09:11:26', '2022-02-21 02:02:43'),
(4, 1, 2, 4400000, '2022-02-21 09:10:52', '2022-02-21 02:03:39'),
(5, 2, 1, 6000000, '2022-02-21 09:11:28', '2022-02-21 09:10:59'),
(6, 2, 1, 20000000, '2022-02-21 09:11:30', '2022-02-21 02:09:33'),
(7, 2, 1, 2200000, '2022-06-21 02:13:33', '2022-06-21 02:13:33'),
(8, 2, 1, 2400000, '2022-06-21 19:15:20', '2022-06-21 19:15:20'),
(9, 2, 1, 3750000, '2022-06-21 19:26:41', '2022-06-21 19:26:41'),
(11, 2, 1, 750000, '2022-06-24 17:51:14', '2022-06-24 17:51:14');

-- --------------------------------------------------------

--
-- Table structure for table `import_details`
--

CREATE TABLE `import_details` (
  `id` int(11) NOT NULL,
  `id_import` int(11) DEFAULT NULL,
  `id_model` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `import_details`
--

INSERT INTO `import_details` (`id`, `id_import`, `id_model`, `quantity`, `price`) VALUES
(1, 1, 1, 2, 100000),
(2, 1, 1, 5, 100000),
(3, 2, 1, 2, 120000),
(4, 2, 1, 3, 150000),
(5, 3, 1, 10, 250000),
(6, 3, 2, 10, 250000),
(7, 3, 3, 10, 250000),
(8, 3, 4, 10, 250000),
(9, 3, 5, 10, 250000),
(10, 4, 6, 10, 220000),
(11, 4, 7, 10, 220000),
(12, 5, 8, 15, 200000),
(13, 5, 9, 15, 200000),
(14, 6, 10, 10, 200000),
(15, 6, 11, 10, 200000),
(16, 6, 12, 10, 200000),
(17, 6, 13, 10, 200000),
(18, 6, 14, 10, 200000),
(19, 6, 15, 10, 200000),
(20, 6, 16, 10, 200000),
(21, 6, 17, 10, 200000),
(22, 6, 18, 10, 200000),
(23, 6, 19, 10, 200000),
(24, 7, 8, 5, 220000),
(25, 7, 9, 5, 220000),
(26, 8, 14, 8, 150000),
(27, 8, 15, 8, 150000),
(28, 9, 10, 15, 150000),
(29, 9, 11, 10, 150000),
(31, 11, 22, 5, 150000);

-- --------------------------------------------------------

--
-- Table structure for table `list_of_values`
--

CREATE TABLE `list_of_values` (
  `id_list` int(11) NOT NULL,
  `id_element` int(11) NOT NULL,
  `name_list` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name_element` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `list_of_values`
--

INSERT INTO `list_of_values` (`id_list`, `id_element`, `name_list`, `name_element`, `description`, `create_at`) VALUES
(1, 1, 'Loại đơn hàng', 'Đơn hàng', NULL, '2022-05-14 06:22:46'),
(1, 2, 'Loại đơn hàng', 'Vận đơn', NULL, '2022-05-14 06:22:51'),
(1, 3, 'Loại đơn hàng', 'Hóa đơn', NULL, '2022-05-14 06:22:55'),
(1, 4, 'Loại đơn hàng', 'Đơn hủy', NULL, '2022-05-14 06:23:04'),
(2, 1, 'Loại tài khoản', 'Quản trị viên', NULL, '2022-05-05 14:21:42'),
(2, 2, 'Loại tài khoản', 'Nhân viên', NULL, '2022-05-05 14:21:59'),
(2, 3, 'Loại tài khoản', 'Khách hàng', NULL, '2022-05-05 14:22:30'),
(3, 1, 'Màu sắc', 'Đen', NULL, '2022-05-05 14:22:49'),
(3, 2, 'Màu sắc', 'Trắng', NULL, '2022-05-05 14:22:58'),
(3, 3, 'Màu sắc', 'Vàng', NULL, '2022-05-05 14:23:13'),
(3, 4, 'Màu sắc', 'Xanh', NULL, '2022-05-05 14:23:24'),
(3, 5, 'Màu sắc', 'Hồng', NULL, '2022-05-18 13:20:29'),
(3, 6, 'Màu sắc', 'Đỏ', NULL, '2022-05-18 13:21:50'),
(3, 7, 'Màu sắc', 'Xám', NULL, '2022-05-18 13:41:09'),
(3, 8, 'Màu sắc', 'Be', NULL, '2022-05-24 03:05:33'),
(4, 1, 'Kích thước', 'S', NULL, '2022-05-24 09:28:58'),
(4, 2, 'Kích thước', 'M', NULL, '2022-05-05 14:23:46'),
(4, 3, 'Kích thước', 'L', NULL, '2022-05-05 14:23:56'),
(4, 4, 'Kích thước', 'XL', NULL, '2022-05-05 14:24:06'),
(4, 5, 'Kích thước', 'XXL', NULL, '2022-05-05 14:24:19'),
(4, 6, 'Kích thước', 'XXXL', NULL, '2022-05-24 09:44:51');

-- --------------------------------------------------------

--
-- Stand-in structure for view `month_chart`
-- (See below for the actual view)
--
CREATE TABLE `month_chart` (
`kind` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `id_customer` int(11) DEFAULT NULL,
  `id_saler` int(11) DEFAULT NULL,
  `total_money` float DEFAULT NULL,
  `note` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `kind` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `id_customer`, `id_saler`, `total_money`, `note`, `created_at`, `kind`) VALUES
(1, 5, NULL, 600000, NULL, '2022-02-22 00:04:33', 1),
(2, 6, 2, 1520000, NULL, '2022-02-22 00:15:37', 3),
(3, 8, 2, 700000, NULL, '2022-02-22 00:15:47', 4),
(4, 9, 2, 380000, NULL, '2022-06-22 02:14:07', 3),
(5, 10, 2, 1900000, '', '2022-06-22 02:19:16', 3),
(6, 11, NULL, 1140000, NULL, '2022-06-24 18:15:04', 1),
(7, 12, 2, 760000, NULL, '2022-06-24 22:48:08', 2),
(8, 13, 2, 760000, NULL, '2022-06-25 00:47:49', 3),
(9, 14, NULL, 760000, 'adsad', '2024-04-24 14:36:23', 1),
(10, 15, NULL, 600000, 'haha', '2024-05-02 08:03:32', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders_details`
--

CREATE TABLE `orders_details` (
  `id` int(11) NOT NULL,
  `id_order` int(11) DEFAULT NULL,
  `id_model` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders_details`
--

INSERT INTO `orders_details` (`id`, `id_order`, `id_model`, `quantity`, `price`) VALUES
(1, 1, 18, 1, 300000),
(2, 1, 19, 1, 300000),
(3, 2, 10, 1, 380000),
(4, 2, 11, 3, 380000),
(5, 3, 14, 2, 350000),
(6, 4, 3, 1, 380000),
(7, 5, 6, 3, 380000),
(8, 5, 9, 2, 380000),
(9, 6, 12, 2, 380000),
(10, 6, 13, 1, 380000),
(11, 7, 1, 1, 380000),
(12, 7, 3, 1, 380000),
(13, 8, 1, 1, 380000),
(14, 8, 5, 1, 380000),
(15, 9, 3, 2, 380000),
(16, 10, 19, 2, 300000);

-- --------------------------------------------------------

--
-- Stand-in structure for view `orders_in_month`
-- (See below for the actual view)
--
CREATE TABLE `orders_in_month` (
`number_of_orders` bigint(21)
,`total_money_of_month` double
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `orders_in_year`
-- (See below for the actual view)
--
CREATE TABLE `orders_in_year` (
`number_of_orders` bigint(21)
,`total_money_of_year` double
);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `quantity` int(11) DEFAULT 0,
  `id_category` int(11) NOT NULL,
  `image` varchar(200) DEFAULT '',
  `price` float UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `quantity`, `id_category`, `image`, `price`, `description`) VALUES
(3, 'Áo Hoodie 2024', 55, 1, '/ckfinder/userfiles/images/Slider/slider4.jpg', 200000, '<p><a href=\"https://xtee.vn/hoodie/\" rel=\"noopener noreferrer\" target=\"_blank\">&Aacute;o Hoodie Nam Nữ</a>&nbsp;HX129 l&agrave; h&agrave;ng may mặc đa diện trong thế giới ng&agrave;y nay. Ch&uacute;ng phục vụ nhiều mục đ&iacute;ch, nhiều đối tượng. Từ việc giữ ấm cơ thể trong m&ugrave;a động lạnh, với chất liệu cotton thấm h&uacute;t mồ h&ocirc;i v&agrave; tho&aacute;ng m&aacute;t cũng được sử dụng l&agrave;m &aacute;o kho&aacute;c chống nắng . Cũng l&agrave; trang phục thời trang s&agrave;nh điệu.&nbsp;<a href=\"https://xtee.vn/hoodie/\" rel=\"noopener noreferrer\" target=\"_blank\">&Aacute;o Hoodie Nam Nữ</a>&nbsp;của Navy l&agrave; một chiếc &aacute;o hoodie mềm mại, ấm c&uacute;ng. N&oacute; được l&agrave;m từ chất liệu nỉ cotton c&oacute; pha sợi spandex gi&uacute;p co gi&atilde;n tốt &amp; thoải m&aacute;i cho người mặc. Họa tiết được in bằng c&ocirc;ng nghệ in kỹ thuật số cao cấp sẽ kh&ocirc;ng bị phai m&agrave;u sau khi giặt.</p>'),
(4, 'Áo Hoodie HX058', 17, 1, '/ckfinder/userfiles/images/%C3%81o%20Hoodie/%C3%81o%20Hoodie%20HX058/HX058D.jpg', 380000, '<p><a href=\"https://xtee.vn/hoodie/\" rel=\"noopener noreferrer\" target=\"_blank\">&Aacute;o Hoodie Nam Nữ</a>&nbsp;HX058 l&agrave; h&agrave;ng may mặc đa diện trong thế giới ng&agrave;y nay. Ch&uacute;ng phục vụ nhiều mục đ&iacute;ch, nhiều đối tượng. Từ việc giữ ấm cơ thể trong m&ugrave;a động lạnh, với chất liệu cotton thấm h&uacute;t mồ h&ocirc;i v&agrave; tho&aacute;ng m&aacute;t cũng được sử dụng l&agrave;m &aacute;o kho&aacute;c chống nắng . Cũng l&agrave; trang phục thời trang s&agrave;nh điệu.&nbsp;<a href=\"https://xtee.vn/hoodie/\" rel=\"noopener noreferrer\" target=\"_blank\">&Aacute;o Hoodie Nam Nữ</a>&nbsp;của Navy l&agrave; một chiếc &aacute;o hoodie mềm mại, ấm c&uacute;ng. N&oacute; được l&agrave;m từ chất liệu nỉ cotton c&oacute; pha sợi spandex gi&uacute;p co gi&atilde;n tốt &amp; thoải m&aacute;i cho người mặc. Họa tiết được in bằng c&ocirc;ng nghệ in kỹ thuật số cao cấp sẽ kh&ocirc;ng bị phai m&agrave;u sau khi giặt.</p>'),
(5, 'Áo Hoodie HX065', 38, 1, '/ckfinder/userfiles/images/%C3%81o%20Hoodie/%C3%81o%20Hoodie%20HX065/HX065-800x800.jpg', 380000, '<p><a href=\"https://xtee.vn/hoodie/\" rel=\"noopener noreferrer\" target=\"_blank\">&Aacute;o Hoodie Nam Nữ</a>&nbsp;HX065 l&agrave; h&agrave;ng may mặc đa diện trong thế giới ng&agrave;y nay. Ch&uacute;ng phục vụ nhiều mục đ&iacute;ch, nhiều đối tượng. Từ việc giữ ấm cơ thể trong m&ugrave;a động lạnh, với chất liệu cotton thấm h&uacute;t mồ h&ocirc;i v&agrave; tho&aacute;ng m&aacute;t cũng được sử dụng l&agrave;m &aacute;o kho&aacute;c chống nắng . Cũng l&agrave; trang phục thời trang s&agrave;nh điệu.&nbsp;<a href=\"https://xtee.vn/hoodie/\" rel=\"noopener noreferrer\" target=\"_blank\">&Aacute;o Hoodie Nam Nữ</a>&nbsp;của Navy l&agrave; một chiếc &aacute;o hoodie mềm mại, ấm c&uacute;ng. N&oacute; được l&agrave;m từ chất liệu nỉ cotton c&oacute; pha sợi spandex gi&uacute;p co gi&atilde;n tốt &amp; thoải m&aacute;i cho người mặc. Họa tiết được in bằng c&ocirc;ng nghệ in kỹ thuật số cao cấp sẽ kh&ocirc;ng bị phai m&agrave;u sau khi giặt.</p>'),
(6, 'Áo Hoodie HX076', 41, 1, '/ckfinder/userfiles/images/%C3%81o%20Hoodie/%C3%81o%20Hoodie%20HX076/HX076-A-800x800.jpg', 380000, '<p><a href=\"https://xtee.vn/hoodie/\" rel=\"noopener noreferrer\" target=\"_blank\">&Aacute;o Hoodie Nam Nữ</a>&nbsp;HX076 l&agrave; h&agrave;ng may mặc đa diện trong thế giới ng&agrave;y nay. Ch&uacute;ng phục vụ nhiều mục đ&iacute;ch, nhiều đối tượng. Từ việc giữ ấm cơ thể trong m&ugrave;a động lạnh, với chất liệu cotton thấm h&uacute;t mồ h&ocirc;i v&agrave; tho&aacute;ng m&aacute;t cũng được sử dụng l&agrave;m &aacute;o kho&aacute;c chống nắng . Cũng l&agrave; trang phục thời trang s&agrave;nh điệu.&nbsp;<a href=\"https://xtee.vn/hoodie/\" rel=\"noopener noreferrer\" target=\"_blank\">&Aacute;o Hoodie Nam Nữ</a>&nbsp;của Navy l&agrave; một chiếc &aacute;o hoodie mềm mại, ấm c&uacute;ng. N&oacute; được l&agrave;m từ chất liệu nỉ cotton c&oacute; pha sợi spandex gi&uacute;p co gi&atilde;n tốt &amp; thoải m&aacute;i cho người mặc. Họa tiết được in bằng c&ocirc;ng nghệ in kỹ thuật số cao cấp sẽ kh&ocirc;ng bị phai m&agrave;u sau khi giặt.</p>'),
(7, 'Áo Hoodie HX077', 17, 1, '/ckfinder/userfiles/images/%C3%81o%20Hoodie/%C3%81o%20Hoodie%20HX077/HX077-A-800x800.jpg', 380000, '<p><a href=\"https://xtee.vn/hoodie/\" rel=\"noopener noreferrer\" target=\"_blank\">&Aacute;o Hoodie Nam Nữ</a>&nbsp;HX077 l&agrave; h&agrave;ng may mặc đa diện trong thế giới ng&agrave;y nay. Ch&uacute;ng phục vụ nhiều mục đ&iacute;ch, nhiều đối tượng. Từ việc giữ ấm cơ thể trong m&ugrave;a động lạnh, với chất liệu cotton thấm h&uacute;t mồ h&ocirc;i v&agrave; tho&aacute;ng m&aacute;t cũng được sử dụng l&agrave;m &aacute;o kho&aacute;c chống nắng . Cũng l&agrave; trang phục thời trang s&agrave;nh điệu.&nbsp;<a href=\"https://xtee.vn/hoodie/\" rel=\"noopener noreferrer\" target=\"_blank\">&Aacute;o Hoodie Nam Nữ</a>&nbsp;của Navy l&agrave; một chiếc &aacute;o hoodie mềm mại, ấm c&uacute;ng. N&oacute; được l&agrave;m từ chất liệu nỉ cotton c&oacute; pha sợi spandex gi&uacute;p co gi&atilde;n tốt &amp; thoải m&aacute;i cho người mặc. Họa tiết được in bằng c&ocirc;ng nghệ in kỹ thuật số cao cấp sẽ kh&ocirc;ng bị phai m&agrave;u sau khi giặt.</p>'),
(8, 'Áo Hoodie HX078', 36, 1, '/ckfinder/userfiles/images/%C3%81o%20Hoodie/%C3%81o%20Hoodie%20HX078/HX078-800x800.jpg', 350000, '<p><a href=\"https://xtee.vn/hoodie/\" rel=\"noopener noreferrer\" target=\"_blank\">&Aacute;o Hoodie Nam Nữ</a>&nbsp;HX078 l&agrave; h&agrave;ng may mặc đa diện trong thế giới ng&agrave;y nay. Ch&uacute;ng phục vụ nhiều mục đ&iacute;ch, nhiều đối tượng. Từ việc giữ ấm cơ thể trong m&ugrave;a động lạnh, với chất liệu cotton thấm h&uacute;t mồ h&ocirc;i v&agrave; tho&aacute;ng m&aacute;t cũng được sử dụng l&agrave;m &aacute;o kho&aacute;c chống nắng . Cũng l&agrave; trang phục thời trang s&agrave;nh điệu.&nbsp;<a href=\"https://xtee.vn/hoodie/\" rel=\"noopener noreferrer\" target=\"_blank\">&Aacute;o Hoodie Nam Nữ</a>&nbsp;của Navy l&agrave; một chiếc &aacute;o hoodie mềm mại, ấm c&uacute;ng. N&oacute; được l&agrave;m từ chất liệu nỉ cotton c&oacute; pha sợi spandex gi&uacute;p co gi&atilde;n tốt &amp; thoải m&aacute;i cho người mặc. Họa tiết được in bằng c&ocirc;ng nghệ in kỹ thuật số cao cấp sẽ kh&ocirc;ng bị phai m&agrave;u sau khi giặt.</p>'),
(9, 'Áo Hoodie HX086', 20, 1, '/ckfinder/userfiles/images/%C3%81o%20Hoodie/%C3%81o%20Hoodie%20HX086/HX086-A-800x800.jpg', 350000, '<p><a href=\"https://xtee.vn/hoodie/\" rel=\"noopener noreferrer\" target=\"_blank\">&Aacute;o Hoodie Nam Nữ</a>&nbsp;HX086 l&agrave; h&agrave;ng may mặc đa diện trong thế giới ng&agrave;y nay. Ch&uacute;ng phục vụ nhiều mục đ&iacute;ch, nhiều đối tượng. Từ việc giữ ấm cơ thể trong m&ugrave;a động lạnh, với chất liệu cotton thấm h&uacute;t mồ h&ocirc;i v&agrave; tho&aacute;ng m&aacute;t cũng được sử dụng l&agrave;m &aacute;o kho&aacute;c chống nắng . Cũng l&agrave; trang phục thời trang s&agrave;nh điệu.&nbsp;<a href=\"https://xtee.vn/hoodie/\" rel=\"noopener noreferrer\" target=\"_blank\">&Aacute;o Hoodie Nam Nữ</a>&nbsp;của Navy l&agrave; một chiếc &aacute;o hoodie mềm mại, ấm c&uacute;ng. N&oacute; được l&agrave;m từ chất liệu nỉ cotton c&oacute; pha sợi spandex gi&uacute;p co gi&atilde;n tốt &amp; thoải m&aacute;i cho người mặc. Họa tiết được in bằng c&ocirc;ng nghệ in kỹ thuật số cao cấp sẽ kh&ocirc;ng bị phai m&agrave;u sau khi giặt.</p>'),
(10, 'Áo Hoodie HX129', 18, 1, '/ckfinder/userfiles/images/%C3%81o%20Hoodie/%C3%81o%20Hoodie%20HX129/HX129D.jpg', 300000, '<p><a href=\"https://xtee.vn/hoodie/\" rel=\"noopener noreferrer\" target=\"_blank\">&Aacute;o Hoodie Nam Nữ</a>&nbsp;HX129 l&agrave; h&agrave;ng may mặc đa diện trong thế giới ng&agrave;y nay. Ch&uacute;ng phục vụ nhiều mục đ&iacute;ch, nhiều đối tượng. Từ việc giữ ấm cơ thể trong m&ugrave;a động lạnh, với chất liệu cotton thấm h&uacute;t mồ h&ocirc;i v&agrave; tho&aacute;ng m&aacute;t cũng được sử dụng l&agrave;m &aacute;o kho&aacute;c chống nắng . Cũng l&agrave; trang phục thời trang s&agrave;nh điệu.&nbsp;<a href=\"https://xtee.vn/hoodie/\" rel=\"noopener noreferrer\" target=\"_blank\">&Aacute;o Hoodie Nam Nữ</a>&nbsp;của Navy l&agrave; một chiếc &aacute;o hoodie mềm mại, ấm c&uacute;ng. N&oacute; được l&agrave;m từ chất liệu nỉ cotton c&oacute; pha sợi spandex gi&uacute;p co gi&atilde;n tốt &amp; thoải m&aacute;i cho người mặc. Họa tiết được in bằng c&ocirc;ng nghệ in kỹ thuật số cao cấp sẽ kh&ocirc;ng bị phai m&agrave;u sau khi giặt.</p>'),
(11, 'Áo Oversize T-Shirt VX149', 0, 3, '/ckfinder/userfiles/images/%C3%81o%20Oversize%20T-Shirt/%C3%81o%20Oversize%20T-Shirt%20VX149/VXM149.jpg', 250000, '<p><a href=\"https://xtee.vn/\" rel=\"noopener noreferrer\" target=\"_blank\">&Aacute;o thun oversize</a>&nbsp;l&agrave; một m&oacute;n đồ hầu như kh&ocirc;ng thể thiếu trong tủ quần &aacute;o của nhiều người. Nhờ sự linh hoạt trong sự phối đồ, &aacute;o thun oversize ph&ugrave; hợp với mọi giới t&iacute;nh v&agrave; mọi lứa tuổi từ gi&agrave; đến trẻ v&agrave; với mọi v&oacute;c d&aacute;ng. Ch&iacute;nh v&igrave; vậy, tuy đ&atilde; xuất hiện từ rất l&acirc;u trong lịch sử thời trang nhưng sức h&uacute;t của &aacute;o over size vẫn chưa bao giờ giảm &ldquo;nhiệt&rdquo;. Lu&ocirc;n giữ vững vị tr&iacute; được ưa chuộng trong l&ograve;ng kh&aacute;ch h&agrave;ng ti&ecirc;u d&ugrave;ng.&nbsp;<a href=\"https://xtee.vn/ao-thun-oversize-tay-lo/\">&Aacute;o thun oversize Unbreak&nbsp;</a><a href=\"https://xtee.vn/\" rel=\"noopener noreferrer\" target=\"_blank\">VX236</a>&nbsp;của Navy l&agrave;m bằng chất liệu thun cotton 100%, co gi&atilde;n nhẹ.</p>\r\n\r\n<p>Kh&ocirc;ng bị ra m&agrave;u, r&aacute;ch h&igrave;nh khi giặt bằng m&aacute;y giặt hay giặt tay.</p>\r\n\r\n<p>Mẫu c&oacute; đủ size từ 40kg-120kg.</p>\r\n\r\n<p>Form d&aacute;ng đẹp</p>'),
(12, 'Áo Oversize T-Shirt VX158', 0, 3, '/ckfinder/userfiles/images/%C3%81o%20Oversize%20T-Shirt/%C3%81o%20Oversize%20T-Shirt%20VX158/VXC158-800x800.jpg', 250000, '<p><a href=\"https://xtee.vn/\" rel=\"noopener noreferrer\" target=\"_blank\">&Aacute;o thun oversize</a>&nbsp;l&agrave; một m&oacute;n đồ hầu như kh&ocirc;ng thể thiếu trong tủ quần &aacute;o của nhiều người. Nhờ sự linh hoạt trong sự phối đồ, &aacute;o thun oversize ph&ugrave; hợp với mọi giới t&iacute;nh v&agrave; mọi lứa tuổi từ gi&agrave; đến trẻ v&agrave; với mọi v&oacute;c d&aacute;ng. Ch&iacute;nh v&igrave; vậy, tuy đ&atilde; xuất hiện từ rất l&acirc;u trong lịch sử thời trang nhưng sức h&uacute;t của &aacute;o over size vẫn chưa bao giờ giảm &ldquo;nhiệt&rdquo;. Lu&ocirc;n giữ vững vị tr&iacute; được ưa chuộng trong l&ograve;ng kh&aacute;ch h&agrave;ng ti&ecirc;u d&ugrave;ng.&nbsp;<a href=\"https://xtee.vn/ao-thun-oversize-tay-lo/\">&Aacute;o thun oversize Unbreak&nbsp;</a><a href=\"https://xtee.vn/\" rel=\"noopener noreferrer\" target=\"_blank\">VX236</a>&nbsp;của Navy l&agrave;m bằng chất liệu thun cotton 100%, co gi&atilde;n nhẹ.</p>\r\n\r\n<p>Kh&ocirc;ng bị ra m&agrave;u, r&aacute;ch h&igrave;nh khi giặt bằng m&aacute;y giặt hay giặt tay.</p>\r\n\r\n<p>Mẫu c&oacute; đủ size từ 40kg-120kg.</p>\r\n\r\n<p>Form d&aacute;ng đẹp</p>'),
(13, 'Áo Oversize T-Shirt VX192', 0, 3, '/ckfinder/userfiles/images/%C3%81o%20Oversize%20T-Shirt/%C3%81o%20Oversize%20T-Shirt%20VX192/VXM192-800x800.jpg', 200000, '<p><a href=\"https://xtee.vn/\" rel=\"noopener noreferrer\" target=\"_blank\">&Aacute;o thun oversize</a>&nbsp;l&agrave; một m&oacute;n đồ hầu như kh&ocirc;ng thể thiếu trong tủ quần &aacute;o của nhiều người. Nhờ sự linh hoạt trong sự phối đồ, &aacute;o thun oversize ph&ugrave; hợp với mọi giới t&iacute;nh v&agrave; mọi lứa tuổi từ gi&agrave; đến trẻ v&agrave; với mọi v&oacute;c d&aacute;ng. Ch&iacute;nh v&igrave; vậy, tuy đ&atilde; xuất hiện từ rất l&acirc;u trong lịch sử thời trang nhưng sức h&uacute;t của &aacute;o over size vẫn chưa bao giờ giảm &ldquo;nhiệt&rdquo;. Lu&ocirc;n giữ vững vị tr&iacute; được ưa chuộng trong l&ograve;ng kh&aacute;ch h&agrave;ng ti&ecirc;u d&ugrave;ng.&nbsp;<a href=\"https://xtee.vn/ao-thun-oversize-tay-lo/\">&Aacute;o thun oversize Unbreak&nbsp;</a><a href=\"https://xtee.vn/\" rel=\"noopener noreferrer\" target=\"_blank\">VX236</a>&nbsp;của Navy l&agrave;m bằng chất liệu thun cotton 100%, co gi&atilde;n nhẹ.</p>\r\n\r\n<p>Kh&ocirc;ng bị ra m&agrave;u, r&aacute;ch h&igrave;nh khi giặt bằng m&aacute;y giặt hay giặt tay.</p>\r\n\r\n<p>Mẫu c&oacute; đủ size từ 40kg-120kg.</p>\r\n\r\n<p>Form d&aacute;ng đẹp</p>'),
(14, 'Áo Oversize T-Shirt VX213', 0, 3, '/ckfinder/userfiles/images/%C3%81o%20Oversize%20T-Shirt/%C3%81o%20Oversize%20T-Shirt%20VX213/VXQ213-800x800.jpg', 200000, '<p><a href=\"https://xtee.vn/\" rel=\"noopener noreferrer\" target=\"_blank\">&Aacute;o thun oversize</a>&nbsp;l&agrave; một m&oacute;n đồ hầu như kh&ocirc;ng thể thiếu trong tủ quần &aacute;o của nhiều người. Nhờ sự linh hoạt trong sự phối đồ, &aacute;o thun oversize ph&ugrave; hợp với mọi giới t&iacute;nh v&agrave; mọi lứa tuổi từ gi&agrave; đến trẻ v&agrave; với mọi v&oacute;c d&aacute;ng. Ch&iacute;nh v&igrave; vậy, tuy đ&atilde; xuất hiện từ rất l&acirc;u trong lịch sử thời trang nhưng sức h&uacute;t của &aacute;o over size vẫn chưa bao giờ giảm &ldquo;nhiệt&rdquo;. Lu&ocirc;n giữ vững vị tr&iacute; được ưa chuộng trong l&ograve;ng kh&aacute;ch h&agrave;ng ti&ecirc;u d&ugrave;ng.&nbsp;<a href=\"https://xtee.vn/ao-thun-oversize-tay-lo/\">&Aacute;o thun oversize Unbreak&nbsp;</a><a href=\"https://xtee.vn/\" rel=\"noopener noreferrer\" target=\"_blank\">VX236</a>&nbsp;của Navy l&agrave;m bằng chất liệu thun cotton 100%, co gi&atilde;n nhẹ.</p>\r\n\r\n<p>Kh&ocirc;ng bị ra m&agrave;u, r&aacute;ch h&igrave;nh khi giặt bằng m&aacute;y giặt hay giặt tay.</p>\r\n\r\n<p>Mẫu c&oacute; đủ size từ 40kg-120kg.</p>\r\n\r\n<p>Form d&aacute;ng đẹp</p>'),
(15, 'Áo Oversize T-Shirt VX255', 0, 3, '/ckfinder/userfiles/images/%C3%81o%20Oversize%20T-Shirt/%C3%81o%20Oversize%20T-Shirt%20VX255/VXD255.jpg', 220000, '<p><a href=\"https://xtee.vn/\" rel=\"noopener noreferrer\" target=\"_blank\">&Aacute;o thun oversize</a>&nbsp;l&agrave; một m&oacute;n đồ hầu như kh&ocirc;ng thể thiếu trong tủ quần &aacute;o của nhiều người. Nhờ sự linh hoạt trong sự phối đồ, &aacute;o thun oversize ph&ugrave; hợp với mọi giới t&iacute;nh v&agrave; mọi lứa tuổi từ gi&agrave; đến trẻ v&agrave; với mọi v&oacute;c d&aacute;ng. Ch&iacute;nh v&igrave; vậy, tuy đ&atilde; xuất hiện từ rất l&acirc;u trong lịch sử thời trang nhưng sức h&uacute;t của &aacute;o over size vẫn chưa bao giờ giảm &ldquo;nhiệt&rdquo;. Lu&ocirc;n giữ vững vị tr&iacute; được ưa chuộng trong l&ograve;ng kh&aacute;ch h&agrave;ng ti&ecirc;u d&ugrave;ng.&nbsp;<a href=\"https://xtee.vn/ao-thun-oversize-tay-lo/\">&Aacute;o thun oversize Unbreak&nbsp;</a><a href=\"https://xtee.vn/\" rel=\"noopener noreferrer\" target=\"_blank\">VX236</a>&nbsp;của Navy l&agrave;m bằng chất liệu thun cotton 100%, co gi&atilde;n nhẹ.</p>\r\n\r\n<p>Kh&ocirc;ng bị ra m&agrave;u, r&aacute;ch h&igrave;nh khi giặt bằng m&aacute;y giặt hay giặt tay.</p>\r\n\r\n<p>Mẫu c&oacute; đủ size từ 40kg-120kg.</p>\r\n\r\n<p>Form d&aacute;ng đẹp</p>'),
(16, 'Áo Thun Wash ABX014', 0, 5, '/ckfinder/userfiles/images/%C3%81o%20Thun%20Wash/%C3%81o%20Thun%20Wash%20ABX014/ABX014-800x800.jpg', 180000, '<p><a href=\"https://xtee.vn/wash-t-shirt/\">&Aacute;o Thun Wash Stronger AIX014</a>&nbsp;thiết kế đơn giản, tinh tế mang một vẻ đẹp ri&ecirc;ng gi&uacute;p bạn trờ n&ecirc;n tự tin khi mặc l&ecirc;n người. Bạn sẽ dễ d&agrave;ng phối đồ nhiều phong c&aacute;ch. Năng động c&aacute; t&iacute;nh v&agrave; ch&uacute;t bụi đường phố. &Aacute;o được l&agrave;m chất liệu 100% cotton co d&atilde;n v&agrave; bền m&agrave;u, thấm h&uacute;t mồ h&ocirc;i cực tốt</p>\r\n\r\n<p><a href=\"https://xtee.vn/ao-thun-wash/\" rel=\"noopener noreferrer\" target=\"_blank\">&Aacute;o Thun Wash Stronger AIX014&nbsp;</a>của Navy đang l&agrave; mẫu h&oacute;t được nhiều bạn trẻ săn đ&oacute;n</p>\r\n\r\n<p>Mẫu c&oacute; đủ size từ 40kg-110kg.</p>\r\n\r\n<p>form d&aacute;ng đẹp.</p>'),
(17, 'Áo Thun Wash ACX003', 0, 5, '/ckfinder/userfiles/images/%C3%81o%20Thun%20Wash/%C3%81o%20Thun%20Wash%20ACX003/ACX003-800x800.jpg', 180000, '<p><a href=\"https://xtee.vn/wash-t-shirt/\">&Aacute;o Thun Wash Stronger AIX014</a>&nbsp;thiết kế đơn giản, tinh tế mang một vẻ đẹp ri&ecirc;ng gi&uacute;p bạn trờ n&ecirc;n tự tin khi mặc l&ecirc;n người. Bạn sẽ dễ d&agrave;ng phối đồ nhiều phong c&aacute;ch. Năng động c&aacute; t&iacute;nh v&agrave; ch&uacute;t bụi đường phố. &Aacute;o được l&agrave;m chất liệu 100% cotton co d&atilde;n v&agrave; bền m&agrave;u, thấm h&uacute;t mồ h&ocirc;i cực tốt</p>\r\n\r\n<p><a href=\"https://xtee.vn/ao-thun-wash/\" rel=\"noopener noreferrer\" target=\"_blank\">&Aacute;o Thun Wash Stronger AIX014&nbsp;</a>của Navy đang l&agrave; mẫu h&oacute;t được nhiều bạn trẻ săn đ&oacute;n</p>\r\n\r\n<p>Mẫu c&oacute; đủ size từ 40kg-110kg.</p>\r\n\r\n<p>form d&aacute;ng đẹp.</p>'),
(18, 'Áo Thun Wash ACX004', 0, 5, '/ckfinder/userfiles/images/%C3%81o%20Thun%20Wash/%C3%81o%20Thun%20Wash%20ACX004/ACX004-800x800.jpg', 180000, '<p><a href=\"https://xtee.vn/wash-t-shirt/\">&Aacute;o Thun Wash Stronger AIX014</a>&nbsp;thiết kế đơn giản, tinh tế mang một vẻ đẹp ri&ecirc;ng gi&uacute;p bạn trờ n&ecirc;n tự tin khi mặc l&ecirc;n người. Bạn sẽ dễ d&agrave;ng phối đồ nhiều phong c&aacute;ch. Năng động c&aacute; t&iacute;nh v&agrave; ch&uacute;t bụi đường phố. &Aacute;o được l&agrave;m chất liệu 100% cotton co d&atilde;n v&agrave; bền m&agrave;u, thấm h&uacute;t mồ h&ocirc;i cực tốt</p>\r\n\r\n<p><a href=\"https://xtee.vn/ao-thun-wash/\" rel=\"noopener noreferrer\" target=\"_blank\">&Aacute;o Thun Wash Stronger AIX014&nbsp;</a>của Navy đang l&agrave; mẫu h&oacute;t được nhiều bạn trẻ săn đ&oacute;n</p>\r\n\r\n<p>Mẫu c&oacute; đủ size từ 40kg-110kg.</p>\r\n\r\n<p>form d&aacute;ng đẹp.</p>'),
(19, 'Áo Thun Wash ACX035', 0, 5, '/ckfinder/userfiles/images/%C3%81o%20Thun%20Wash/%C3%81o%20Thun%20Wash%20ACX035/ACX035-800x800.jpg', 150000, '<p><a href=\"https://xtee.vn/wash-t-shirt/\">&Aacute;o Thun Wash Stronger AIX014</a>&nbsp;thiết kế đơn giản, tinh tế mang một vẻ đẹp ri&ecirc;ng gi&uacute;p bạn trờ n&ecirc;n tự tin khi mặc l&ecirc;n người. Bạn sẽ dễ d&agrave;ng phối đồ nhiều phong c&aacute;ch. Năng động c&aacute; t&iacute;nh v&agrave; ch&uacute;t bụi đường phố. &Aacute;o được l&agrave;m chất liệu 100% cotton co d&atilde;n v&agrave; bền m&agrave;u, thấm h&uacute;t mồ h&ocirc;i cực tốt</p>\r\n\r\n<p><a href=\"https://xtee.vn/ao-thun-wash/\" rel=\"noopener noreferrer\" target=\"_blank\">&Aacute;o Thun Wash Stronger AIX014&nbsp;</a>của Navy đang l&agrave; mẫu h&oacute;t được nhiều bạn trẻ săn đ&oacute;n</p>\r\n\r\n<p>Mẫu c&oacute; đủ size từ 40kg-110kg.</p>\r\n\r\n<p>form d&aacute;ng đẹp.</p>'),
(20, 'Áo Thun Wash AGX014', 0, 5, '/ckfinder/userfiles/images/%C3%81o%20Thun%20Wash/%C3%81o%20Thun%20Wash%20AGX014/AGX014-800x800.jpg', 150000, '<p><a href=\"https://xtee.vn/wash-t-shirt/\">&Aacute;o Thun Wash Stronger AIX014</a>&nbsp;thiết kế đơn giản, tinh tế mang một vẻ đẹp ri&ecirc;ng gi&uacute;p bạn trờ n&ecirc;n tự tin khi mặc l&ecirc;n người. Bạn sẽ dễ d&agrave;ng phối đồ nhiều phong c&aacute;ch. Năng động c&aacute; t&iacute;nh v&agrave; ch&uacute;t bụi đường phố. &Aacute;o được l&agrave;m chất liệu 100% cotton co d&atilde;n v&agrave; bền m&agrave;u, thấm h&uacute;t mồ h&ocirc;i cực tốt</p>\r\n\r\n<p><a href=\"https://xtee.vn/ao-thun-wash/\" rel=\"noopener noreferrer\" target=\"_blank\">&Aacute;o Thun Wash Stronger AIX014&nbsp;</a>của Navy đang l&agrave; mẫu h&oacute;t được nhiều bạn trẻ săn đ&oacute;n</p>\r\n\r\n<p>Mẫu c&oacute; đủ size từ 40kg-110kg.</p>\r\n\r\n<p>form d&aacute;ng đẹp.</p>'),
(21, 'Áo Thun Wash AGX019', 0, 5, '/ckfinder/userfiles/images/%C3%81o%20Thun%20Wash/%C3%81o%20Thun%20Wash%20AGX019/AGX019-800x800.jpg', 150000, '<p><a href=\"https://xtee.vn/wash-t-shirt/\">&Aacute;o Thun Wash Stronger AIX014</a>&nbsp;thiết kế đơn giản, tinh tế mang một vẻ đẹp ri&ecirc;ng gi&uacute;p bạn trờ n&ecirc;n tự tin khi mặc l&ecirc;n người. Bạn sẽ dễ d&agrave;ng phối đồ nhiều phong c&aacute;ch. Năng động c&aacute; t&iacute;nh v&agrave; ch&uacute;t bụi đường phố. &Aacute;o được l&agrave;m chất liệu 100% cotton co d&atilde;n v&agrave; bền m&agrave;u, thấm h&uacute;t mồ h&ocirc;i cực tốt</p>\r\n\r\n<p><a href=\"https://xtee.vn/ao-thun-wash/\" rel=\"noopener noreferrer\" target=\"_blank\">&Aacute;o Thun Wash Stronger AIX014&nbsp;</a>của Navy đang l&agrave; mẫu h&oacute;t được nhiều bạn trẻ săn đ&oacute;n</p>\r\n\r\n<p>Mẫu c&oacute; đủ size từ 40kg-110kg.</p>\r\n\r\n<p>form d&aacute;ng đẹp.</p>'),
(22, 'Áo Thun Wash AIX014', 0, 5, '/ckfinder/userfiles/images/%C3%81o%20Thun%20Wash/%C3%81o%20Thun%20Wash%20AIX014/AIX014-800x800.jpg', 150000, '<p><a href=\"https://xtee.vn/wash-t-shirt/\">&Aacute;o Thun Wash Stronger AIX014</a>&nbsp;thiết kế đơn giản, tinh tế mang một vẻ đẹp ri&ecirc;ng gi&uacute;p bạn trờ n&ecirc;n tự tin khi mặc l&ecirc;n người. Bạn sẽ dễ d&agrave;ng phối đồ nhiều phong c&aacute;ch. Năng động c&aacute; t&iacute;nh v&agrave; ch&uacute;t bụi đường phố. &Aacute;o được l&agrave;m chất liệu 100% cotton co d&atilde;n v&agrave; bền m&agrave;u, thấm h&uacute;t mồ h&ocirc;i cực tốt</p>\r\n\r\n<p><a href=\"https://xtee.vn/ao-thun-wash/\" rel=\"noopener noreferrer\" target=\"_blank\">&Aacute;o Thun Wash Stronger AIX014&nbsp;</a>của Navy đang l&agrave; mẫu h&oacute;t được nhiều bạn trẻ săn đ&oacute;n</p>\r\n\r\n<p>Mẫu c&oacute; đủ size từ 40kg-110kg.</p>\r\n\r\n<p>form d&aacute;ng đẹp.</p>'),
(24, 'Áo Hoodie Trơn', 5, 1, '/ckfinder/userfiles/images/%C3%81o%20Hoodie/%C3%81o%20Hoodie%20Tr%C6%A1n/HXX044.jpg', 3000000, '');

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `id` int(11) NOT NULL,
  `id_models` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `import` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `id_order_detail` int(11) DEFAULT NULL,
  `id_import_detail` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`id`, `id_models`, `order`, `import`, `price`, `id_order_detail`, `id_import_detail`) VALUES
(1, 1, NULL, 2, 100000, NULL, 1),
(2, 1, NULL, 7, 100000, NULL, 2),
(3, 1, NULL, 4, 120000, NULL, 3),
(4, 1, NULL, 5, 150000, NULL, 4),
(5, 1, NULL, 12, 250000, NULL, 5),
(6, 2, NULL, 10, 250000, NULL, 6),
(7, 3, NULL, 10, 250000, NULL, 7),
(8, 4, NULL, 10, 250000, NULL, 8),
(9, 5, NULL, 10, 250000, NULL, 9),
(10, 6, NULL, 10, 220000, NULL, 10),
(11, 7, NULL, 10, 220000, NULL, 11),
(12, 8, NULL, 15, 200000, NULL, 12),
(13, 9, NULL, 15, 200000, NULL, 13),
(14, 10, NULL, 10, 200000, NULL, 14),
(15, 11, NULL, 10, 200000, NULL, 15),
(16, 12, NULL, 10, 200000, NULL, 16),
(17, 13, NULL, 10, 200000, NULL, 17),
(18, 14, NULL, 10, 200000, NULL, 18),
(19, 15, NULL, 10, 200000, NULL, 19),
(20, 16, NULL, 10, 200000, NULL, 20),
(21, 17, NULL, 10, 200000, NULL, 21),
(22, 18, NULL, 10, 200000, NULL, 22),
(23, 19, NULL, 10, 200000, NULL, 23),
(24, 8, NULL, 20, 220000, NULL, 24),
(25, 9, NULL, 20, 220000, NULL, 25),
(26, 10, 1, NULL, 380000, 3, NULL),
(27, 11, 3, NULL, 380000, 4, NULL),
(28, 3, 1, NULL, 380000, 6, NULL),
(29, 14, NULL, 18, 150000, NULL, 26),
(30, 15, NULL, 18, 150000, NULL, 27),
(31, 6, 1, NULL, 380000, 7, NULL),
(32, 6, 2, NULL, 380000, 7, NULL),
(33, 6, 3, NULL, 380000, 7, NULL),
(34, 9, 1, NULL, 380000, 8, NULL),
(35, 9, 2, NULL, 380000, 8, NULL),
(36, 6, 3, NULL, 380000, 7, NULL),
(37, 9, 2, NULL, 380000, 8, NULL),
(38, 10, NULL, 25, 150000, NULL, 28),
(39, 11, NULL, 20, 150000, NULL, 29),
(41, 1, 1, NULL, 380000, 13, NULL),
(42, 5, 1, NULL, 380000, 14, NULL),
(43, 22, NULL, 5, 150000, NULL, 31);

-- --------------------------------------------------------

--
-- Table structure for table `product_models`
--

CREATE TABLE `product_models` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `size` varchar(50) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `id_product` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_models`
--

INSERT INTO `product_models` (`id`, `name`, `size`, `color`, `quantity`, `id_product`, `price`, `image`) VALUES
(1, 'Áo Hoodie HX044 (Đen - S)', 'S', 'Đen', 20, 3, 380000, '/ckfinder/userfiles/images/%C3%81o%20Hoodie/%C3%81o%20Hoodie%20HX065/HX065-A-800x800.jpg'),
(2, 'Áo Hoodie HX044 (Trắng - S)', 'S', 'Trắng', 10, 3, 380000, '/ckfinder/userfiles/images/%C3%81o%20Hoodie/%C3%81o%20Hoodie%20HX044/HX044-1.png'),
(3, 'Áo Hoodie HX044 (Đỏ - S)', 'S', 'Đỏ', 6, 3, 380000, '/ckfinder/userfiles/images/%C3%81o%20Hoodie/%C3%81o%20Hoodie%20HX044/HXR044.jpg'),
(4, 'Áo Hoodie HX044 (Vàng - S)', 'S', 'Vàng', 10, 3, 380000, '/ckfinder/userfiles/images/%C3%81o%20Hoodie/%C3%81o%20Hoodie%20HX044/HXV044.jpg'),
(5, 'Áo Hoodie HX044 (Xám - S)', 'S', 'Xám', 9, 3, 380000, '/ckfinder/userfiles/images/%C3%81o%20Hoodie/%C3%81o%20Hoodie%20HX044/HXX044.jpg'),
(6, 'Áo Hoodie HX058 (Đen - S)', 'S', 'Đen', 7, 4, 380000, '/ckfinder/userfiles/images/%C3%81o%20Hoodie/%C3%81o%20Hoodie%20HX065/HX065-A-800x800.jpg'),
(7, 'Áo Hoodie HX058 (Trắng - S)', 'S', 'Trắng', 10, 4, 380000, '/ckfinder/userfiles/images/%C3%81o%20Hoodie/%C3%81o%20Hoodie%20HX058/HX058T.jpg'),
(8, 'Áo Hoodie HX065 (Đen - S)', 'S', 'Đen', 20, 5, 380000, '/ckfinder/userfiles/images/%C3%81o%20Hoodie/%C3%81o%20Hoodie%20HX065/HX065-A-800x800.jpg'),
(9, 'Áo Hoodie HX065 (Trắng - S)', 'S', 'Trắng', 18, 5, 380000, '/ckfinder/userfiles/images/%C3%81o%20Hoodie/%C3%81o%20Hoodie%20HX065/HX065-800x800.jpg'),
(10, 'Áo Hoodie HX076 (Đen - S)', 'S', 'Đen', 24, 6, 380000, '/ckfinder/userfiles/images/%C3%81o%20Hoodie/%C3%81o%20Hoodie%20HX076/HX076-800x800.jpg'),
(11, 'Áo Hoodie HX076 (Trắng - S)', 'S', 'Trắng', 17, 6, 380000, '/ckfinder/userfiles/images/%C3%81o%20Hoodie/%C3%81o%20Hoodie%20HX076/HX076-A-800x800.jpg'),
(12, 'Áo Hoodie HX077 (Đen - S)', 'S', 'Đen', 8, 7, 380000, '/ckfinder/userfiles/images/%C3%81o%20Hoodie/%C3%81o%20Hoodie%20HX077/HX077-800x800.jpg'),
(13, 'Áo Hoodie HX077 (Trắng - S)', 'S', 'Trắng', 9, 7, 380000, '/ckfinder/userfiles/images/%C3%81o%20Hoodie/%C3%81o%20Hoodie%20HX077/HX077-A-800x800.jpg'),
(14, 'Áo Hoodie HX078 (Đen - S)', 'S', 'Đen', 18, 8, 350000, '/ckfinder/userfiles/images/%C3%81o%20Hoodie/%C3%81o%20Hoodie%20HX078/HX078-800x800.jpg'),
(15, 'Áo Hoodie HX078 (Trắng - S)', 'S', 'Trắng', 18, 8, 350000, '/ckfinder/userfiles/images/%C3%81o%20Hoodie/%C3%81o%20Hoodie%20HX078/HX078-A-800x800.jpg'),
(16, 'Áo Hoodie HX086 (Đen - S)', 'S', 'Đen', 10, 9, 350000, '/ckfinder/userfiles/images/%C3%81o%20Hoodie/%C3%81o%20Hoodie%20HX086/HX086-800x800.jpg'),
(17, 'Áo Hoodie HX086 (Trắng - S)', 'S', 'Trắng', 10, 9, 350000, '/ckfinder/userfiles/images/%C3%81o%20Hoodie/%C3%81o%20Hoodie%20HX086/HX086-A-800x800.jpg'),
(18, 'Áo Hoodie HX129 (Trắng - S)', 'S', 'Trắng', 9, 10, 300000, '/ckfinder/userfiles/images/%C3%81o%20Hoodie/%C3%81o%20Hoodie%20HX129/HX129T.jpg'),
(19, 'Áo Hoodie HX129 (Đen - S)', 'S', 'Đen', 7, 10, 300000, '/ckfinder/userfiles/images/%C3%81o%20Hoodie/%C3%81o%20Hoodie%20HX129/HX129D.jpg'),
(22, 'Áo Hoodie Trơn (Trắng - S)', 'S', 'Trắng', 5, 24, 3000000, '/ckfinder/userfiles/images/%C3%81o%20Hoodie/%C3%81o%20Hoodie%20Tr%C6%A1n/HX044-1.png');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumb` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_by` int(11) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `name`, `url`, `thumb`, `sort_by`, `active`) VALUES
(1, 'Special Clothing', '/shop', '/ckfinder/userfiles/images/Slider/slider4.jpg', 1, 1),
(2, 'Simplify Everything', '/shop', '/ckfinder/userfiles/images/Slider/slider5.jpg', 2, 1),
(3, 'Hello Summer', '/shop', '/ckfinder/userfiles/images/Slider/slider6.jpg', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `id_products` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `id_products`, `name`, `description`) VALUES
(1, NULL, 'Xưởng Bắc Thái', 'Hà Nam'),
(2, NULL, 'Xưởng Thái Hà', 'Hà Nội');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 3,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `role`, `password`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', NULL, 1, '$2a$12$/gwnGNevVJoMp7WCa3O9HOhG1VUSq3Z62SiKAyVuouj/WPjQREJzu', NULL, NULL, '2022-06-21 06:26:09', '2022-06-21 06:26:10'),
(14, NULL, 'tiendatvxhg', 'tiendatvxhg@gmail.com', 3, NULL, '0344585983', 'ha giang', '2024-04-24 07:36:23', '2024-04-24 07:36:23'),
(15, NULL, 'Pham Quang Dat', 'đâsdasdas', 3, NULL, '0344585983', 'ha Noi', '2024-05-02 01:03:32', '2024-05-02 01:03:32');

-- --------------------------------------------------------

--
-- Stand-in structure for view `year_chart`
-- (See below for the actual view)
--
CREATE TABLE `year_chart` (
`month` int(2)
,`total_of_month` float
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `year_chart_import`
-- (See below for the actual view)
--
CREATE TABLE `year_chart_import` (
`month` int(2)
,`total_of_month` float
);

-- --------------------------------------------------------

--
-- Structure for view `month_chart`
--
DROP TABLE IF EXISTS `month_chart`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `month_chart`  AS SELECT `orders`.`kind` AS `kind` FROM `orders` WHERE year(`orders`.`created_at`) = year(curtime()) AND month(`orders`.`created_at`) = month(curtime()) ;

-- --------------------------------------------------------

--
-- Structure for view `orders_in_month`
--
DROP TABLE IF EXISTS `orders_in_month`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `orders_in_month`  AS SELECT count(`orders`.`id`) AS `number_of_orders`, sum(`orders`.`total_money`) AS `total_money_of_month` FROM `orders` WHERE year(`orders`.`created_at`) = year(curtime()) AND month(`orders`.`created_at`) = month(curtime()) AND `orders`.`kind` = 3 ;

-- --------------------------------------------------------

--
-- Structure for view `orders_in_year`
--
DROP TABLE IF EXISTS `orders_in_year`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `orders_in_year`  AS SELECT count(`orders`.`id`) AS `number_of_orders`, sum(`orders`.`total_money`) AS `total_money_of_year` FROM `orders` WHERE year(`orders`.`created_at`) = year(curtime()) AND `orders`.`kind` = 3 ;

-- --------------------------------------------------------

--
-- Structure for view `year_chart`
--
DROP TABLE IF EXISTS `year_chart`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `year_chart`  AS SELECT month(`orders`.`created_at`) AS `month`, `orders`.`total_money` AS `total_of_month` FROM `orders` WHERE year(`orders`.`created_at`) = year(curtime()) AND `orders`.`kind` = 3 ;

-- --------------------------------------------------------

--
-- Structure for view `year_chart_import`
--
DROP TABLE IF EXISTS `year_chart_import`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `year_chart_import`  AS SELECT month(`import_bill`.`created_at`) AS `month`, `import_bill`.`total_money` AS `total_of_month` FROM `import_bill` WHERE year(`import_bill`.`created_at`) = year(curtime()) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `import_bill`
--
ALTER TABLE `import_bill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `import_details`
--
ALTER TABLE `import_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_import_details_import_bill` (`id_import`),
  ADD KEY `FK_import_details_product_models` (`id_model`);

--
-- Indexes for table `list_of_values`
--
ALTER TABLE `list_of_values`
  ADD PRIMARY KEY (`id_list`,`id_element`),
  ADD UNIQUE KEY `list_of_values_name_list_name_element_uindex` (`name_list`,`name_element`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kind` (`kind`) USING BTREE;

--
-- Indexes for table `orders_details`
--
ALTER TABLE `orders_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_orders_details_orders` (`id_order`),
  ADD KEY `FK_orders_details_product_models` (`id_model`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_products_categories` (`id_category`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_product_details_product_models` (`id_models`),
  ADD KEY `FK_product_details_orders_details` (`id_order_detail`),
  ADD KEY `FK_product_details_import_details` (`id_import_detail`);

--
-- Indexes for table `product_models`
--
ALTER TABLE `product_models`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_product_models_products` (`id_product`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `import_bill`
--
ALTER TABLE `import_bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `import_details`
--
ALTER TABLE `import_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders_details`
--
ALTER TABLE `orders_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `product_models`
--
ALTER TABLE `product_models`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `import_details`
--
ALTER TABLE `import_details`
  ADD CONSTRAINT `FK_import_details_import_bill` FOREIGN KEY (`id_import`) REFERENCES `import_bill` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_import_details_product_models` FOREIGN KEY (`id_model`) REFERENCES `product_models` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `orders_details`
--
ALTER TABLE `orders_details`
  ADD CONSTRAINT `FK_orders_details_orders` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_orders_details_product_models` FOREIGN KEY (`id_model`) REFERENCES `product_models` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_products_categories` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product_details`
--
ALTER TABLE `product_details`
  ADD CONSTRAINT `FK_product_details_import_details` FOREIGN KEY (`id_import_detail`) REFERENCES `import_details` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_product_details_orders_details` FOREIGN KEY (`id_order_detail`) REFERENCES `orders_details` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_product_details_product_models` FOREIGN KEY (`id_models`) REFERENCES `product_models` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product_models`
--
ALTER TABLE `product_models`
  ADD CONSTRAINT `FK_product_models_products` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
