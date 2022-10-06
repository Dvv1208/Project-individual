-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th6 30, 2022 lúc 06:01 PM
-- Phiên bản máy phục vụ: 5.7.33
-- Phiên bản PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `nhom3`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhom3_category`
--

CREATE TABLE `nhom3_category` (
  `Id` int(10) UNSIGNED NOT NULL,
  `Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên loại SP',
  `Slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'SLug Loại SP',
  `ParentId` int(11) NOT NULL DEFAULT '0' COMMENT 'Mã cấp cha',
  `Orders` int(11) NOT NULL COMMENT 'Thứ tự',
  `MetaKey` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Từ khóa SEO',
  `MetaDesc` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Mô tả SEO',
  `CreatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày tạo',
  `CreatedBy` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Người tạo',
  `UpdatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày sửa',
  `UpdatedBy` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Người sửa',
  `Status` tinyint(4) NOT NULL DEFAULT '2' COMMENT 'Trạng thái'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhom3_category`
--

INSERT INTO `nhom3_category` (`Id`, `Name`, `Slug`, `ParentId`, `Orders`, `MetaKey`, `MetaDesc`, `CreatedAt`, `CreatedBy`, `UpdatedAt`, `UpdatedBy`, `Status`) VALUES
(1, 'Điện thoại Iphone', 'dienthoai-iphone', 0, 1, 'Từ khóa SEO', 'Mô tả SEO', '2022-05-23 07:09:55', 1, '2022-06-02 04:45:40', 1, 1),
(2, 'Điện thoại Samsung', 'dienthoai-samsung', 0, 1, 'Từ khóa SEO', 'Mô tả SEO', '2022-05-23 07:10:14', 1, '2022-06-02 09:49:53', 1, 1),
(3, 'Điện thoại Nokia', 'dienthoai-nokia', 0, 1, 'Từ khóa SEO', 'Mô tả SEO', '2022-05-23 07:11:32', 1, '2022-05-23 07:11:32', 1, 1),
(4, 'Điện thoại Vivo', 'dienthoai-vivo', 0, 1, 'Từ khóa SEO', 'Mô tả SEO', '2022-05-23 07:12:44', 1, '2022-06-05 19:37:02', 1, 1),
(8, 'Điện thoại Xiaomi', 'dienthoai-xiaomi', 0, 1, 'Từ khóa SEO', 'Mô tả SEO', '2022-06-06 05:22:49', 1, '2022-06-06 12:22:49', 0, 1),
(9, 'Điện thoại Oppo', 'dienthoai-oppo', 0, 1, 'Từ khóa SEO', 'Mô tả SEO', '2022-06-06 05:24:38', 1, '2022-06-06 12:24:38', 0, 1),
(10, 'Điện thoại Realme', 'dienthoai-realme', 0, 1, 'Từ khóa SEO', 'Mô tả SEO', '2022-06-06 05:24:59', 1, '2022-06-06 12:24:59', 0, 1),
(37, 'Iphone 13 Pro Max', 'iphone-13-pro-max', 1, 1, 'Iphone 13 Pro Max', 'Iphone 13 Pro Max', '2022-06-20 18:05:16', 1, '2022-06-20 18:05:16', 0, 1),
(38, 'Iphone 13 512G', 'iphone-13-512g', 1, 1, 'Iphone 13 512G', 'Iphone 13 512G', '2022-06-20 18:05:32', 1, '2022-06-20 18:05:32', 0, 1),
(39, 'Iphone 13 Pro Max 128Gb', 'iphone-13-pro-max-128gb', 1, 1, 'Iphone 13 Pro Max 128Gb', 'Iphone 13 Pro Max 128Gb', '2022-06-20 18:05:50', 1, '2022-06-20 18:05:50', 0, 1),
(40, 'Iphone 12 128Gb', 'iphone-12-128gb', 1, 1, 'Iphone 12 128Gb', 'Iphone 12 128Gb', '2022-06-20 18:06:00', 1, '2022-06-20 18:06:00', 0, 1),
(41, 'Iphone 11 64Gb', 'iphone-11-64gb', 1, 1, 'Iphone 11 64Gb', 'Iphone 11 64Gb', '2022-06-20 18:06:11', 1, '2022-06-20 18:06:11', 0, 1),
(42, 'Iphone X 64Gb', 'iphone-x-64gb', 1, 1, 'Iphone X 64Gb', 'Iphone X 64Gb', '2022-06-20 18:06:20', 1, '2022-06-20 18:06:20', 0, 1),
(43, 'Iphone 7 Plus 32Gb', 'iphone-7-plus-32gb', 1, 1, 'Iphone 7 Plus 32Gb', 'Iphone 7 Plus 32Gb', '2022-06-20 18:06:30', 1, '2022-06-20 18:06:30', 0, 1),
(44, 'Samsung Galaxy A03S', 'samsung-galaxy-a03s', 2, 1, 'Samsung Galaxy A03S', 'Samsung Galaxy A03S', '2022-06-20 18:06:44', 1, '2022-06-20 18:06:44', 0, 1),
(45, 'Nokia 21 Plus', 'nokia-21-plus', 3, 1, 'nokia 21 plus', 'nokia 21 plus', '2022-06-20 18:07:13', 1, '2022-06-20 18:07:13', 0, 1),
(46, 'Nokia 73', 'nokia-73', 3, 1, 'nokia 73', 'nokia 73', '2022-06-20 18:07:22', 1, '2022-06-20 18:07:22', 0, 1),
(47, 'Nokia G11', 'nokia-g11', 3, 1, 'Nokia-g11', 'Nokia-g11', '2022-06-20 18:07:30', 1, '2022-06-20 18:07:30', 0, 1),
(48, 'Nokia G10', 'nokiag10', 3, 1, 'Nokia G10', 'Nokia G10', '2022-06-20 18:07:41', 1, '2022-06-20 18:07:41', 0, 1),
(49, 'Nokia C30', 'nokia-c30', 3, 1, 'nokia C30', 'nokia C30', '2022-06-20 18:07:53', 1, '2022-06-20 18:07:53', 0, 1),
(50, 'Nokia C20', 'nokia-c20', 3, 1, 'nokia C20', 'nokia C20', '2022-06-20 18:08:07', 1, '2022-06-20 18:08:07', 0, 1),
(51, 'Nokia 105', 'nokia-105', 3, 1, 'nokia 105', 'nokia 105', '2022-06-20 18:08:20', 1, '2022-06-20 18:08:20', 0, 1),
(52, 'Nokia 105', 'nokia-105-4g-blue', 3, 1, 'nokia 105', 'nokia 105', '2022-06-20 18:08:32', 1, '2022-06-20 18:08:32', 0, 1),
(53, 'Nokia 110', 'nokia-110-4g-yellow', 3, 1, 'nokia 110', 'nokia 110', '2022-06-20 18:08:42', 1, '2022-06-20 18:08:42', 0, 1),
(54, 'Oppo A15s', 'oppo-a15s', 9, 1, 'oppo A15s', 'oppo A15s', '2022-06-20 18:08:53', 1, '2022-06-20 18:08:53', 0, 1),
(55, 'Oppo A16', 'oppo-a16', 9, 1, 'oppo a16', 'oppo a16', '2022-06-20 18:09:02', 1, '2022-06-20 18:09:02', 0, 1),
(56, 'Oppo A16k', 'oppo-a16k', 9, 1, 'oppo A16k', 'oppo A16k', '2022-06-20 18:09:13', 1, '2022-06-20 18:09:13', 0, 1),
(57, 'Oppo A55', 'oppo-a55', 9, 1, 'oppo A55', 'oppo A55', '2022-06-20 18:09:27', 1, '2022-06-20 18:09:27', 0, 1),
(58, 'Oppo A95', 'oppo-a95', 9, 1, 'oppo a95', 'oppo a95', '2022-06-20 18:09:37', 1, '2022-06-20 18:09:37', 0, 1),
(59, 'Oppo F17', 'oppo-f17', 9, 1, 'oppo F17', 'oppo F17', '2022-06-20 18:09:46', 1, '2022-06-20 18:09:46', 0, 1),
(60, 'Oppo Reno 6', 'oppo-reno6', 9, 1, 'oppo Reno6', 'oppo Reno6', '2022-06-20 18:09:57', 1, '2022-06-20 18:09:57', 0, 1),
(61, 'Oppo Reno7', 'oppo-reno7', 9, 1, 'oppo Reno7', 'oppo Reno7', '2022-06-20 18:10:07', 1, '2022-06-20 18:10:07', 0, 1),
(62, 'Oppo Reno7 Pro', 'oppo-reno7-pro', 9, 1, 'oppo Reno7-pro', 'oppo Reno7-pro', '2022-06-20 18:10:16', 1, '2022-06-20 18:10:16', 0, 1),
(63, 'Vivo V21 5G', 'vivo-v21-5g', 4, 1, 'vivo-v21-5g', 'vivo-v21-5g', '2022-06-20 18:10:30', 1, '2022-06-20 18:10:30', 0, 1),
(64, 'Vivo V23', 'vivo-v23-5g', 4, 1, 'vivo V23', 'vivo V23', '2022-06-20 18:10:38', 1, '2022-06-20 18:10:38', 0, 1),
(65, 'Vivo V23e', 'vivo-v23e', 4, 1, 'vivo V23e', 'vivo V23e', '2022-06-20 18:10:49', 1, '2022-06-20 18:10:49', 0, 1),
(66, 'Vivo Y01', 'vivo-y01', 4, 1, 'vivo-y01', 'vivo-y01', '2022-06-20 18:10:56', 1, '2022-06-20 18:10:56', 0, 1),
(67, 'Vivo Y15s', 'vivo-y15s', 4, 1, 'Vivo-y15s', 'Vivo-y15s', '2022-06-20 18:11:03', 1, '2022-06-20 18:11:03', 0, 1),
(68, 'Vivo Y33s', 'vivo-y33s', 4, 1, 'vivo-y33s', 'vivo-y33s', '2022-06-20 18:11:13', 1, '2022-06-20 18:11:13', 0, 1),
(69, 'Vivo Y53s', 'vivo-y53s', 4, 1, 'vivo-y53s', 'vivo-y53s', '2022-06-20 18:11:25', 1, '2022-06-20 18:11:25', 0, 1),
(70, 'Vivo Y55', 'vivo-y55', 4, 1, 'vivo-y55', 'vivo-y55', '2022-06-20 18:11:36', 1, '2022-06-20 18:11:36', 0, 1),
(71, 'Xiaomi Redmi 9A', 'xiaomi-redmi-9a', 8, 1, 'xiaomi Redmi9a', 'xiaomi Redmi9a', '2022-06-20 18:11:48', 1, '2022-06-20 18:11:48', 0, 1),
(72, 'Xiaomi Redmi 9C', 'xiaomi-redmi-9c', 8, 1, 'xiaomi Redmi9c', 'xiaomi Redmi9c', '2022-06-20 18:11:58', 1, '2022-06-20 18:11:58', 0, 1),
(73, 'Xiaomi Redmi 10C', 'xiaomi-redmi-10c', 8, 1, 'xiaomi Redmi 10c', 'xiaomi Redmi 10c', '2022-06-20 18:12:10', 1, '2022-06-20 18:12:10', 0, 1),
(74, 'Xiaomi Redmi Note 10 Pro', 'xiaomi-redmi-note-10-pro', 8, 1, 'xiaomi redmi note 10pro', 'xiaomi redmi note 10pro', '2022-06-20 18:12:18', 1, '2022-06-20 18:12:18', 0, 1),
(75, 'Xiaomi Redmi Note 11', 'xiaomi-redmi-note-11', 8, 1, 'xiaomi Redmi note11', 'xiaomi Redmi note11', '2022-06-20 18:12:26', 1, '2022-06-20 18:12:26', 0, 1),
(76, 'Realme 8 Pro', 'realme-8-pro', 10, 1, 'realme 8pro', 'realme 8pro', '2022-06-20 18:12:37', 1, '2022-06-20 18:12:37', 0, 1),
(77, 'Realme 9 4G Vàng', 'realme-9-4g-vang', 10, 1, 'realme-9', 'realme-9', '2022-06-20 18:12:45', 1, '2022-06-20 18:12:45', 0, 1),
(78, 'Realme C11', 'realme-c11', 10, 1, 'realme c11', 'realme c11', '2022-06-20 18:12:53', 1, '2022-06-20 18:12:53', 0, 1),
(79, 'Realme C21 Y', 'realme-c21-y', 10, 1, 'realme c21-y', 'realme c21-y', '2022-06-20 18:13:01', 1, '2022-06-20 18:13:01', 0, 1),
(80, 'Realme C35', 'realme-c35', 10, 1, 'realme-c35', 'realme-c35', '2022-06-20 18:13:10', 1, '2022-06-20 18:13:10', 0, 1),
(81, 'Redmi 10', 'redmi-10', 8, 1, 'redmi-10', 'redmi-10', '2022-06-20 18:13:45', 1, '2022-06-20 18:13:45', 0, 1),
(82, 'Samsung Galaxy A52s', 'samsung-galaxy-a52s-5g', 2, 1, 'samsung galaxy-a52s', 'samsung galaxy-a52s', '2022-06-20 18:13:56', 1, '2022-06-20 18:13:56', 0, 1),
(83, 'Samsung Galaxy A53', 'samsung-galaxy-a53', 2, 1, 'Samsung Galaxy-A53', 'Samsung Galaxy-A53', '2022-06-20 18:14:04', 1, '2022-06-20 18:14:04', 0, 1),
(84, 'Samsung Galaxy A73', 'samsung-galaxy-a73-5g', 2, 1, 'samsung Galaxy-a73', 'samsung Galaxy-a73', '2022-06-20 18:14:13', 1, '2022-06-20 18:14:13', 0, 1),
(85, 'Samsung Galaxy S20 FE', 'samsung-galaxy-s20-fe', 2, 1, 'Từ khóa SEO', 'Mô tả SEO', '2022-06-20 18:14:23', 1, '2022-06-30 17:36:35', 1, 1),
(86, 'samsung-galaxy-s22-ultra', 'samsung-galaxy-s22-ultra', 2, 1, 'samsung-galaxy-s22-ultra', 'samsung-galaxy-s22-ultra', '2022-06-20 18:14:32', 1, '2022-06-30 17:35:33', 1, 0),
(87, 'samsung-galaxy-z-flip3', 'samsung-galaxy-z-flip3-5g-128gb-flex-your-way-tim-1-3', 2, 1, 'samsung-galaxy-z-flip3', 'samsung-galaxy-z-flip3', '2022-06-20 18:14:58', 1, '2022-06-30 17:35:32', 1, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhom3_contact`
--

CREATE TABLE `nhom3_contact` (
  `Id` int(11) NOT NULL COMMENT 'Mã liên hệ',
  `UserId` int(10) UNSIGNED DEFAULT '0' COMMENT 'Mã người dùng',
  `FullName` varchar(255) NOT NULL COMMENT 'Họ và tên',
  `Email` varchar(100) NOT NULL COMMENT 'Email',
  `Phone` varchar(100) NOT NULL COMMENT 'Điện thoại',
  `Title` varchar(255) NOT NULL COMMENT 'Tiêu đề',
  `Detail` mediumtext NOT NULL COMMENT 'Chi tiết',
  `ReplyId` int(10) UNSIGNED DEFAULT NULL COMMENT 'Mã trả lời',
  `ReplyDetail` text COMMENT 'Nội dung liên hệ',
  `CreatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày liên hệ',
  `UpdatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày trả lời',
  `UpdatedBy` tinyint(3) UNSIGNED DEFAULT '0' COMMENT 'Người trả lời',
  `Status` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Trạng thái'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `nhom3_contact`
--

INSERT INTO `nhom3_contact` (`Id`, `UserId`, `FullName`, `Email`, `Phone`, `Title`, `Detail`, `ReplyId`, `ReplyDetail`, `CreatedAt`, `UpdatedAt`, `UpdatedBy`, `Status`) VALUES
(6, 0, 'Nguyễn Trường Giang', 'balabilu27@gmail.com', '0386102600', 'Dịch vụ sửa chữa', 'Dịch vụ sửa chữa bên mình giá cả ra sao và bảo hành như thế nào ạ                                ', NULL, NULL, '2022-06-21 10:27:14', '2022-06-21 15:37:28', 0, 1),
(7, 0, 'Nguyễn Trường Giang', 'balabilu27@gmail.com', '0386102600', 'Dịch vụ bảo hành', 'Tôi mới mua sản phẩm và muốn bảo hành do lỗi hiển thị màn hình                                                                                                                                ', NULL, 'Dạ cho em xin địa chỉ bên mình để em qua  xác minh lỗi sản phẩm ạ', '2022-06-21 10:38:45', '2022-06-25 02:57:39', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhom3_customer`
--

CREATE TABLE `nhom3_customer` (
  `Id` int(10) UNSIGNED NOT NULL COMMENT 'Mã tài khoản',
  `FullName` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Họ và tên',
  `Email` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Email',
  `Gender` tinyint(3) UNSIGNED NOT NULL COMMENT 'Giới tính',
  `Phone` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Điện thoại',
  `CreatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày tạo',
  `CreatedBy` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Người tạo',
  `UpdatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày sửa',
  `UpdatedBy` tinyint(3) UNSIGNED DEFAULT '1' COMMENT 'Người sửa',
  `Status` tinyint(3) UNSIGNED NOT NULL DEFAULT '2' COMMENT 'Trạng thái'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhom3_menu`
--

CREATE TABLE `nhom3_menu` (
  `Id` int(11) NOT NULL COMMENT 'Mã Menu',
  `Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên Menu',
  `Link` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Liên kết',
  `Type` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Kiểu Menu',
  `Tableid` int(10) UNSIGNED DEFAULT NULL COMMENT 'Mã trong bảng',
  `Orders` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Thứ tự',
  `Position` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Vị trí',
  `Parentid` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Mã cấp cha',
  `CreatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày Tạo',
  `CreatedBy` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Người tạo',
  `UpdatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày sửa',
  `UpdatedBy` tinyint(3) UNSIGNED DEFAULT '1' COMMENT 'Người sửa',
  `Status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Trạng thái'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhom3_menu`
--

INSERT INTO `nhom3_menu` (`Id`, `Name`, `Link`, `Type`, `Tableid`, `Orders`, `Position`, `Parentid`, `CreatedAt`, `CreatedBy`, `UpdatedAt`, `UpdatedBy`, `Status`) VALUES
(1, 'Trang chủ', 'index.php', 'custom', 1, 0, 'mainmenu', 0, '2022-06-02 15:36:22', 1, '2022-06-30 01:17:14', 1, 1),
(2, 'Bài viết', 'index.php?option=post&cat=gioi-thieu', 'page', 2, 0, 'mainmenu', 0, '2022-06-02 15:36:22', 1, '2022-06-05 15:36:22', 1, 1),
(3, 'Sản phẩm', 'index.php?option=product', 'custom', 1, 0, 'mainmenu', 0, '2022-06-02 15:36:22', 1, '2022-06-05 15:36:22', 1, 1),
(4, 'Điện thoại iphone', 'index.php?option=product&cat=dienthoai-iphone', 'category', 2, 0, 'mainmenu', 3, '2022-06-02 15:36:22', 1, '2022-06-05 15:36:22', 1, 1),
(5, 'Điện thoại Samsung', 'index.php?option=product&cat=dienthoai-samsung', 'category', 3, 0, 'mainmenu', 3, '2022-06-02 15:36:22', 1, '2022-06-05 15:36:22', 1, 1),
(6, 'Điện thoại Nokia', 'index.php?option=product&cat=dienthoai-nokia', 'category', 4, 0, 'mainmenu', 3, '2022-06-02 15:36:22', 1, '2022-06-05 15:36:22', 1, 1),
(7, 'Điện thoại Vivo', 'index.php?option=product&cat=dienthoai-vivo', 'category', 5, 0, 'mainmenu', 3, '2022-06-02 15:36:22', 1, '2022-06-05 15:36:22', 1, 1),
(8, 'Tin tức', 'index.php?option=post&cat=tin-tuc', 'topic', 1, 6, 'mainmenu', 2, '2022-06-02 06:50:40', 1, '2022-06-05 06:49:09', 1, 1),
(9, 'Liên hệ', 'index.php?option=contact', 'custom', 2, 0, 'mainmenu', 0, '2022-06-02 15:36:22', 1, '2022-06-05 15:36:22', 1, 1),
(10, 'Tin khuyễn mãi', 'index.php?option=post&cat=tin-khuyen-mai', 'topic', 1, 5, 'mainmenu', 2, '2022-06-02 15:36:22', 1, '2022-06-05 15:36:22', 1, 1),
(15, 'Dịch vụ', 'index.php?option=post&cat=dich-vu', 'topic', 2, 3, 'mainmenu', 2, '2022-06-02 06:50:40', 1, '2022-06-05 06:49:09', 1, 1),
(16, 'Chính sách vận chuyển', 'index.php?option=post&cat=chinh-sach-van-chuyen', 'page', 2, 1, 'mainmenu', 2, '2022-06-02 06:52:09', 1, '2022-06-05 06:49:09', 1, 1),
(17, 'Chính sách đổi trả', 'index.php?option=post&cat=chinh-sach-doi-tra', 'page', 3, 1, 'mainmenu', 2, '2022-06-02 06:52:09', 1, '2022-06-05 06:49:09', 1, 1),
(18, 'Điện thoại Xiaomi', 'index.php?option=product&cat=dienthoai-xiaomi', 'category', 5, 0, 'mainmenu', 3, '2022-06-02 15:36:22', 1, '2022-06-05 15:36:22', 1, 1),
(19, 'Điện thoại Oppo', 'index.php?option=product&cat=dienthoai-oppo', 'category', 5, 0, 'mainmenu', 3, '2022-06-02 15:36:22', 1, '2022-06-05 15:36:22', 1, 1),
(20, 'Điện thoại Realme', 'index.php?option=product&cat=dienthoai-realme', 'category', 5, 0, 'mainmenu', 3, '2022-06-02 15:36:22', 1, '2022-06-05 15:36:22', 1, 1),
(21, 'Giới thiệu', 'index.php?option=post&cat=gioi-thieu', 'page', 1, 4, 'mainmenu', 2, '2022-06-02 15:36:22', 1, '2022-06-05 15:36:22', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhom3_order`
--

CREATE TABLE `nhom3_order` (
  `Id` int(10) UNSIGNED NOT NULL COMMENT 'Id đơn hàng',
  `CreatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày tạo',
  `Diachi` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Địa chỉ người nhận',
  `Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên người nhận',
  `Phone` varchar(120) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Điện thoại người nhận',
  `Email` varchar(120) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Email người nhận',
  `UpdatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày cập nhật',
  `UpdatedBy` tinyint(3) UNSIGNED DEFAULT NULL COMMENT 'Người cập nhật',
  `Status` tinyint(3) UNSIGNED NOT NULL COMMENT 'Trạng thái'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhom3_order`
--

INSERT INTO `nhom3_order` (`Id`, `CreatedAt`, `Diachi`, `Name`, `Phone`, `Email`, `UpdatedAt`, `UpdatedBy`, `Status`) VALUES
(1, '2022-06-27 10:01:10', '97 đường số 11, P.Trường Thọ, TP Thủ Đức, TP HCM', 'Dương', '0985781353', 'vovanduong258@gmail.com', '2022-06-27 17:01:10', NULL, 1),
(2, '2022-06-27 10:22:27', 'abc', 'abc', 'abc', 'abc', '2022-06-27 17:22:27', NULL, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhom3_orderdetail`
--

CREATE TABLE `nhom3_orderdetail` (
  `Id` int(10) UNSIGNED NOT NULL COMMENT 'Mã CT Đơn hàng',
  `Orderid` int(10) UNSIGNED NOT NULL COMMENT 'Mã đơn hàng',
  `Productid` int(10) UNSIGNED NOT NULL COMMENT 'Mã sản phẩm',
  `Price` float(12,2) UNSIGNED NOT NULL COMMENT 'Giá sản phẩm',
  `Quantity` int(10) UNSIGNED NOT NULL COMMENT 'Số lượng',
  `Amount` float(12,2) UNSIGNED NOT NULL COMMENT 'Thành tiền'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhom3_orderdetail`
--

INSERT INTO `nhom3_orderdetail` (`Id`, `Orderid`, `Productid`, `Price`, `Quantity`, `Amount`) VALUES
(1, 1, 23, 250000.00, 2, 500000.00),
(2, 1, 25, 250000.00, 3, 750000.00),
(3, 2, 33, 250000.00, 2, 500000.00),
(4, 2, 43, 250000.00, 3, 750000.00),
(5, 3, 34, 250000.00, 2, 500000.00),
(7, 3, 34, 250000.00, 2, 500000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhom3_page`
--

CREATE TABLE `nhom3_page` (
  `Id` int(10) UNSIGNED NOT NULL COMMENT 'Mã bài viết',
  `Topid` int(10) UNSIGNED DEFAULT NULL COMMENT 'Mã chủ đề',
  `Title` varchar(1000) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tiêu đề bài viết',
  `Slug` varchar(1000) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Slug tiêu đề',
  `Detail` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'Chi tiết bài viết',
  `Img` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Hình ảnh',
  `Type` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'post' COMMENT 'Kiểu bài viết',
  `Metakey` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Từ khóa SEO',
  `Metadesc` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Mô tả SEO',
  `CreatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày tạo',
  `CreatedBy` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Người tạo',
  `UpdatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày sửa',
  `UpdatedBy` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Người sửa',
  `Status` tinyint(4) NOT NULL DEFAULT '2' COMMENT 'Trạng thái'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhom3_page`
--

INSERT INTO `nhom3_page` (`Id`, `Topid`, `Title`, `Slug`, `Detail`, `Img`, `Type`, `Metakey`, `Metadesc`, `CreatedAt`, `CreatedBy`, `UpdatedAt`, `UpdatedBy`, `Status`) VALUES
(1, NULL, 'Giới thiệu', 'gioi-thieu', 'Giới thiệu', 'gioi-thieu.jpg', '2', 'Giới thiệu', 'Giới thiệu', '2022-06-21 04:15:27', 1, '2022-06-21 04:15:28', 1, 1),
(2, NULL, 'Hình thức vận chuyển', 'hinh-thuc-van-chuyen', 'Hình thức vận chuyển', 'hinh-thuc-van-chuyen.jpg', '3', 'Hình thức vận chuyển', 'Hình thức vận chuyển', '2022-06-21 04:15:43', 1, '2022-06-21 04:15:43', 1, 1),
(3, NULL, 'Chính sách đổi trả', 'chinh-sach-doi-tra', 'Chính sách đổi trả', 'chinh-sach-doi-tra.jpg', '3', 'Chính sách đổi trả', 'Chính sách đổi trả', '2022-06-21 04:14:43', 1, '2022-06-21 04:14:43', 1, 1),
(4, NULL, 'Phương thức thanh toán', 'phuong-thuc-thanh-toan', 'Phương thức thanh toán', 'phuong-thuc-thanh-toan.jpg', '3', 'Phương thức thanh toán', 'Phương thức thanh toán', '2022-06-21 04:14:24', 1, '2022-06-21 04:14:24', 1, 1),
(5, NULL, 'Tin tức', 'tin-tuc', 'Tin tức', 'tin-tuc.jpg', '1', 'Tin tức', 'Tin tức', '2022-06-21 04:13:57', 1, '2022-06-21 04:13:57', 1, 1),
(6, NULL, 'Dịch vụ', 'dich-vu', 'Dịch vụ', 'dich-vu.jpg', '3', 'Dịch vụ', 'Dịch vụ', '2022-06-21 04:13:39', 1, '2022-06-21 04:13:39', 1, 1),
(0, NULL, 'Bảo hành sản phẩm', 'bao-hanh-san-pham', 'Bảo hành sản phẩm', 'dich-vu-bao-hanh.jpg', '3', 'Bảo hành sản phẩm', 'Bảo hành sản phẩm', '2022-06-21 12:46:48', 1, '2022-06-30 01:49:56', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhom3_post`
--

CREATE TABLE `nhom3_post` (
  `Id` int(10) UNSIGNED NOT NULL COMMENT 'Mã bài viết',
  `Topid` int(10) UNSIGNED DEFAULT NULL COMMENT 'Mã chủ đề',
  `Title` varchar(1000) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tiêu đề bài viết',
  `Slug` varchar(1000) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Slug tiêu đề',
  `Detail` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'Chi tiết bài viết',
  `Img` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Hình ảnh',
  `Type` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'post' COMMENT 'Kiểu bài viết',
  `Metakey` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Từ khóa SEO',
  `Metadesc` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Mô tả SEO',
  `CreatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày tạo',
  `CreatedBy` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Người tạo',
  `UpdatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày sửa',
  `UpdatedBy` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Người sửa',
  `Status` tinyint(4) NOT NULL DEFAULT '2' COMMENT 'Trạng thái'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhom3_post`
--

INSERT INTO `nhom3_post` (`Id`, `Topid`, `Title`, `Slug`, `Detail`, `Img`, `Type`, `Metakey`, `Metadesc`, `CreatedAt`, `CreatedBy`, `UpdatedAt`, `UpdatedBy`, `Status`) VALUES
(1, NULL, 'Giới thiệu', 'gioi-thieu', 'Giới thiệu', 'gioi-thieu.jpg', '2', 'Giới thiệu', 'Giới thiệu', '2022-06-21 04:15:27', 1, '2022-06-21 04:15:28', 1, 1),
(2, NULL, 'Hình thức vận chuyển', 'hinh-thuc-van-chuyen', 'Hình thức vận chuyển', 'hinh-thuc-van-chuyen.jpg', '3', 'Hình thức vận chuyển', 'Hình thức vận chuyển', '2022-06-21 04:15:43', 1, '2022-06-21 04:15:43', 1, 1),
(3, NULL, 'Chính sách đổi trả', 'chinh-sach-doi-tra', 'Chính sách đổi trả', 'chinh-sach-doi-tra.jpg', '3', 'Chính sách đổi trả', 'Chính sách đổi trả', '2022-06-21 04:14:43', 1, '2022-06-21 04:14:43', 1, 1),
(4, NULL, 'Phương thức thanh toán', 'phuong-thuc-thanh-toan', 'Phương thức thanh toán', 'phuong-thuc-thanh-toan.jpg', '3', 'Phương thức thanh toán', 'Phương thức thanh toán', '2022-06-21 04:14:24', 1, '2022-06-21 04:14:24', 1, 1),
(5, NULL, 'Tin tức', 'tin-tuc', 'Tin tức', 'tin-tuc.jpg', '1', 'Tin tức', 'Tin tức', '2022-06-21 04:13:57', 1, '2022-06-21 04:13:57', 1, 1),
(6, NULL, 'Dịch vụ', 'dich-vu', 'Dịch vụ', 'dich-vu.jpg', '3', 'Dịch vụ', 'Dịch vụ', '2022-06-21 04:13:39', 1, '2022-06-21 04:13:39', 1, 1),
(0, NULL, 'Bảo hành sản phẩm', 'bao-hanh-san-pham', 'Bảo hành sản phẩm', 'dich-vu-bao-hanh.jpg', '3', 'Bảo hành sản phẩm', 'Bảo hành sản phẩm', '2022-06-21 12:46:48', 1, '2022-06-21 12:46:48', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhom3_product`
--

CREATE TABLE `nhom3_product` (
  `Id` int(10) UNSIGNED NOT NULL COMMENT 'Mã sản phẩm',
  `Catid` int(10) UNSIGNED NOT NULL COMMENT 'Mã loại sản phẩm',
  `Name` varchar(1000) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên sản phẩm',
  `Slug` varchar(1000) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Slug tên sản phẩm',
  `Img` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Hình ảnh',
  `Detail` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'Chi tiết',
  `Number` smallint(5) UNSIGNED NOT NULL COMMENT 'Số lượng',
  `Price` float(12,2) NOT NULL COMMENT 'Giá',
  `Pricesale` float(12,3) NOT NULL COMMENT 'Giá khuyến mãi',
  `Metakey` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Từ khóa SEO',
  `Metadesc` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Mô tả SEO',
  `CreatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày tạo',
  `CreatedBy` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Người tạo',
  `UpdatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày sửa',
  `UpdatedBy` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Người sửa',
  `Status` tinyint(3) UNSIGNED NOT NULL DEFAULT '2' COMMENT 'Trạng thái'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhom3_product`
--

INSERT INTO `nhom3_product` (`Id`, `Catid`, `Name`, `Slug`, `Img`, `Detail`, `Number`, `Price`, `Pricesale`, `Metakey`, `Metadesc`, `CreatedAt`, `CreatedBy`, `UpdatedAt`, `UpdatedBy`, `Status`) VALUES
(1, 1, 'Iphone 13 Pro Max', 'iphone-13-pro-max', 'iphone-13-pro-max.jpg', 'Chi tiết sản phẩm', 1, 30000000.00, 30000000.000, 'Từ khóa SEO', 'Mô tả SEO', '2022-06-18 08:56:02', 1, '2022-06-30 16:56:00', 1, 1),
(2, 1, 'Iphone 13 512G', 'iphone-13-512g', 'iphone-13-512g.jpg', 'Chi tiết sản phẩm', 1, 32000000.00, 32000000.000, 'Từ khóa SEO', 'Mô tả SEO', '2022-06-18 08:58:32', 1, '2022-06-18 08:58:32', 1, 1),
(3, 1, 'Iphone 13 Pro Max 128Gb', 'iphone-13-pro-max-128gb', 'iphone-13-pro-max-128gb.jpg', 'Điện thoại iPhone 13 Pro Max 128 GB - siêu phẩm được mong chờ nhất ở nửa cuối năm 2021 đến từ Apple. Máy có thiết kế không mấy đột phá khi so với người tiền nhiệm, bên trong đây vẫn là một sản phẩm có màn hình siêu đẹp, tần số quét được nâng cấp lên 120 Hz mượt mà, cảm biến camera có kích thước lớn hơn, cùng hiệu năng mạnh mẽ với sức mạnh đến từ Apple A15 Bionic, sẵn sàng cùng bạn chinh phục mọi thử thách.  ', 1, 33900000.00, 33900000.000, 'Từ khóa SEO', 'Mô tả SEO', '2022-06-18 09:31:19', 1, '2022-06-18 09:39:35', 1, 1),
(4, 1, 'Iphone 12 128Gb', 'iphone-12-128gb', 'iphone-12-128gb.jpg', 'Điện thoại iPhone 12 128 GB - siêu phẩm được mong chờ nhất ở nửa cuối năm 2020 đến từ Apple. Máy có thiết kế không mấy đột phá khi so với người tiền nhiệm, bên trong đây vẫn là một sản phẩm có màn hình siêu đẹp, tần số quét được nâng cấp lên 120 Hz mượt mà, cảm biến camera có kích thước lớn hơn, cùng hiệu năng mạnh mẽ với sức mạnh đến từ Apple A15 Bionic, sẵn sàng cùng bạn chinh phục mọi thử thách.', 1, 20000000.00, 20000000.000, 'Từ khóa SEO', 'Mô tả SEO', '2022-06-18 09:41:47', 1, '2022-06-18 09:41:47', 1, 1),
(5, 1, 'Iphone 11 128Gb', 'iphone-11-128gb', 'iphone-11-128gb.jpg', 'Điện thoại iPhone 11 128 GB - siêu phẩm được mong chờ nhất ở nửa cuối năm 2019 đến từ Apple. Máy có thiết kế không mấy đột phá khi so với người tiền nhiệm, bên trong đây vẫn là một sản phẩm có màn hình siêu đẹp, tần số quét được nâng cấp lên 120 Hz mượt mà, cảm biến camera có kích thước lớn hơn, cùng hiệu năng mạnh mẽ với sức mạnh đến từ Apple A15 Bionic, sẵn sàng cùng bạn chinh phục mọi thử thách.', 1, 15000000.00, 15000000.000, 'Từ khóa SEO', 'Mô tả SEO', '2022-06-18 09:44:47', 1, '2022-06-18 09:44:47', 1, 1),
(6, 1, 'Iphone 11 64Gb', 'iphone-11-64gb', 'iphone-11-64gb.jpg', 'Điện thoại iPhone 11 64 GB - siêu phẩm được mong chờ nhất ở nửa cuối năm 2019 đến từ Apple. Máy có thiết kế không mấy đột phá khi so với người tiền nhiệm, bên trong đây vẫn là một sản phẩm có màn hình siêu đẹp, tần số quét được nâng cấp lên 120 Hz mượt mà, cảm biến camera có kích thước lớn hơn, cùng hiệu năng mạnh mẽ với sức mạnh đến từ Apple A15 Bionic, sẵn sàng cùng bạn chinh phục mọi thử thách.', 1, 10000000.00, 10000000.000, 'Từ khóa SEO', 'Mô tả SEO', '2022-06-18 09:46:03', 1, '2022-06-18 09:46:04', 1, 1),
(7, 1, 'Iphone X 64Gb', 'iphone-x-64gb', 'iphone-x-64gb.jpg', 'iPhone X 64 GB là cụm từ được rất nhiều người mong chờ muốn biết và tìm kiếm trên Google bởi đây là chiếc điện thoại mà Apple kỉ niệm 10 năm iPhone đầu tiên được bán ra.', 1, 7000000.00, 7000000.000, 'Từ khóa SEO', 'Mô tả SEO', '2022-06-18 09:49:37', 1, '2022-06-18 09:49:37', 1, 1),
(9, 1, 'Iphone 7 Plus 32Gb', 'iphone-7-plus-32gb', 'iphone-7-plus-32gb.jpg', 'iPhone 7 plus 32GB nổi bật với điểm nhấn mặt lưng kính và mặt trước giữ nguyên thiết kế như iPhone 7, cùng với đó là hàng loạt công nghệ đáng mong đợi như sạc nhanh, không dây hay hỗ trợ thực tế ảo AR.', 1, 4000000.00, 4000000.000, 'Từ khóa SEO', 'Mô tả SEO', '2022-06-18 09:55:39', 1, '2022-06-18 09:55:39', 1, 1),
(10, 2, 'Samsung Galaxy A03S', 'samsung-galaxy-a03s', 'samsung-galaxy-a03s.jpg', 'Nhằm đem đến cho người dùng thêm sự lựa chọn trong phân khúc, Samsung đã cho ra mắt thêm một chiếc điện thoại giá rẻ với tên gọi Galaxy A03s. So với người tiền nhiệm Galaxy A02s, thiết bị sẽ có một số nâng cấp mới, đây hứa hẹn sẽ là sản phẩm đáng để bạn trải nghiệm.', 1, 3000000.00, 3000000.000, 'Từ khóa SEO', 'Mô tả SEO', '2022-06-18 10:01:13', 1, '2022-06-18 10:01:13', 1, 1),
(13, 3, 'Nokia 21 Plus', 'nokia-21-plus', 'nokia-21-plus.jpg', 'nokia 21 plus', 1, 2990000.00, 2990000.000, 'nokia 21 plus', 'nokia 21 plus', '2022-06-20 12:05:12', 1, '2022-06-20 12:05:13', 1, 1),
(14, 3, 'Nokia 73 5G', 'nokia-73-5g', 'nokia-73-5g.jpg', 'nokia-73-5g', 1, 4990000.00, 4990000.000, 'nokia-73-5g', 'nokia-73-5g', '2022-06-20 12:05:44', 1, '2022-06-20 12:05:44', 1, 1),
(15, 3, 'Nokia G11', 'nokia-g11', 'nokia-g11.jpg', 'Nokia-g11', 1, 5990000.00, 5990000.000, 'Nokia-g11', 'Nokia-g11', '2022-06-20 12:06:20', 1, '2022-06-20 12:06:20', 1, 1),
(16, 3, 'Nokia G10', 'nokiag10', 'nokiag10.jpg', 'NokiaG10', 1, 4990000.00, 4990000.000, 'NokiaG10', 'NokiaG10', '2022-06-20 12:06:50', 1, '2022-06-20 12:06:50', 1, 1),
(17, 3, 'Nokia C30', 'nokia-c30', 'nokia-c30.jpg', 'nokia-c30', 1, 2990000.00, 2990000.000, 'nokia-c30', 'nokia-c30', '2022-06-20 12:07:32', 1, '2022-06-20 12:07:32', 1, 1),
(18, 3, 'Nokia C20', 'nokia-c20', 'nokia-c20.jpg', 'nokia-c20', 1, 2990000.00, 2990000.000, 'nokia-c20', 'nokia-c20', '2022-06-20 12:07:58', 1, '2022-06-20 12:07:58', 1, 1),
(19, 3, 'Nokia 105', 'nokia-105', 'nokia-105.jpg', 'nokia-105', 1, 599000.00, 599000.000, 'nokia-105', 'nokia-105', '2022-06-20 12:08:48', 1, '2022-06-20 12:08:48', 1, 1),
(20, 3, 'Nokia 105 4G Blue', 'nokia-105-4g-blue', 'nokia-105-4g-blue.jpg', 'nokia-105-4g-blue', 1, 3900000.00, 3900000.000, 'nokia-105-4g-blue', 'nokia-105-4g-blue', '2022-06-20 12:09:16', 1, '2022-06-20 12:09:16', 1, 1),
(21, 3, 'Nokia 110 4G Yellow', 'nokia-110-4g-yellow', 'nokia-110-4g-yellow.jpg', 'nokia-110-4g-yellow', 1, 2990000.00, 2999000.000, 'nokia-110-4g-yellow', 'nokia-110-4g-yellow', '2022-06-20 12:09:46', 1, '2022-06-20 12:09:46', 1, 1),
(22, 9, 'Oppo A15s', 'oppo-a15s', 'oppo-a15s.jpg', 'oppo-a15s', 1, 5900000.00, 5900000.000, 'oppo-a15s', 'oppo-a15s', '2022-06-20 12:10:25', 1, '2022-06-20 12:10:25', 1, 1),
(23, 9, 'Oppo A16', 'oppo-a16', 'oppo-a16.jpg', 'oppo a16', 1, 3000000.00, 3000000.000, 'oppo a16', 'oppo a16', '2022-06-20 12:10:56', 1, '2022-06-20 12:10:56', 1, 1),
(24, 9, 'Oppo A16k', 'oppo-a16k', 'oppo-a16k.jpg', 'oppo-a16k', 1, 3900000.00, 3900000.000, 'oppo-a16k', 'oppo-a16k', '2022-06-20 12:11:27', 1, '2022-06-20 12:11:27', 1, 1),
(25, 9, 'Oppo A55', 'oppo-a55', 'oppo-a55.jpg', 'oppo-a55', 1, 1900000.00, 1900000.000, 'oppo-a55', 'oppo-a55', '2022-06-20 12:11:54', 1, '2022-06-20 12:11:54', 1, 1),
(26, 9, 'Oppo A95', 'oppo-a95', 'oppo-a95.jpg', 'oppo a95', 1, 2900000.00, 2900000.000, 'oppo a95', 'oppo a95', '2022-06-20 12:12:29', 1, '2022-06-20 12:12:30', 1, 1),
(27, 9, 'Oppo F17', 'oppo-f17', 'oppo-f17.jpg', 'oppo F17', 1, 2900000.00, 2900000.000, 'oppo F17', 'oppo F17', '2022-06-20 12:12:57', 1, '2022-06-21 10:44:46', 1, 0),
(28, 9, 'Oppo Reno 6', 'oppo-reno6', 'oppo-reno6.jpg', 'oppo-reno6', 1, 11100000.00, 11199000.000, 'oppo-reno6', 'oppo-reno6', '2022-06-20 12:13:36', 1, '2022-06-20 12:13:36', 1, 1),
(29, 9, 'Oppo Reno 7', 'oppo-reno7', 'oppo-reno7.jpg', 'oppo-reno7', 1, 11100000.00, 11100000.000, 'oppo-reno7', 'oppo-reno7', '2022-06-20 12:13:56', 1, '2022-06-20 12:13:56', 1, 1),
(30, 9, 'Oppo Reno 7 Pro', 'oppo-reno7-pro', 'oppo-reno7-pro.jpg', 'oppo-reno7-pro', 1, 12100000.00, 12100000.000, 'oppo-reno7-pro', 'oppo-reno7-pro', '2022-06-20 12:14:16', 1, '2022-06-20 12:14:16', 1, 1),
(31, 4, 'Vivo V21 5G', 'vivo-v21-5g', 'vivo-v21-5g.jpg', 'vivo-v21-5g', 1, 11100000.00, 11100000.000, 'vivo-v21-5g', 'vivo-v21-5g', '2022-06-20 12:14:56', 1, '2022-06-20 12:14:56', 1, 1),
(32, 4, 'Vivo V23 5G', 'Vivo V23 5g', 'vivo-v23-5g.jpg', 'vivo-V23-5G', 1, 13100000.00, 13100000.000, 'vivo-V23-5G', 'vivo-V23-5G', '2022-06-20 12:15:17', 1, '2022-06-20 12:15:17', 1, 1),
(33, 4, 'Vivo V23 E', 'vivo-v23e', 'vivo-v23e.jpg', 'vivo-v23e', 1, 11100000.00, 11100000.000, 'vivo-v23e', 'vivo-v23e', '2022-06-20 12:15:42', 1, '2022-06-21 10:44:18', 1, 0),
(34, 4, 'Vivo Y01', 'vivo-y01', 'vivo-y01.jpg', 'vivo-y01', 1, 12100000.00, 12100000.000, 'vivo-y01', 'vivo-y01', '2022-06-20 12:16:02', 1, '2022-06-20 12:16:02', 1, 1),
(35, 4, 'Vivo V15S', 'vivo-y15s', 'vivo-y15s.jpg', 'Vivo-y15s', 1, 12100000.00, 12100000.000, 'Vivo-y15s', 'Vivo-y15s', '2022-06-20 12:16:23', 1, '2022-06-20 12:16:23', 1, 1),
(36, 4, 'Vivo Y33s', 'vivo-y33s', 'vivo-y33s.jpg', 'vivo-y33s', 1, 11100000.00, 11100000.000, 'vivo-y33s', 'vivo-y33s', '2022-06-20 12:16:44', 1, '2022-06-20 12:16:44', 1, 1),
(37, 4, 'Vivo Y53s', 'vivo-y53s', 'vivo-y53s.jpg', 'vivo-y53s', 1, 12100000.00, 12100000.000, 'vivo-y53s', 'vivo-y53s', '2022-06-20 12:17:07', 1, '2022-06-20 12:17:07', 1, 1),
(38, 4, 'Vivo Y55', 'vivo-y55', 'vivo-y55.jpg', 'vivo-y55', 1, 11100000.00, 11100000.000, 'vivo-y55', 'vivo-y55', '2022-06-20 12:17:28', 1, '2022-06-20 12:17:28', 1, 1),
(39, 8, 'Xiaomi Redmi 9A', 'xiaomi-redmi-9a', 'xiaomi-redmi-9a.jpg', 'xiaomi-redmi-9a', 1, 11100000.00, 11100000.000, 'xiaomi-redmi-9a', 'xiaomi-redmi-9a', '2022-06-20 12:18:16', 1, '2022-06-20 12:18:16', 1, 1),
(40, 8, 'Xiaomi Redmi 9C', 'xiaomi-redmi-9c', 'xiaomi-redmi-9c.jpg', 'xiaomi-redmi-9c', 1, 10100000.00, 10100000.000, 'xiaomi-redmi-9c', 'xiaomi-redmi-9c', '2022-06-20 12:18:37', 1, '2022-06-20 12:18:37', 1, 1),
(41, 8, 'Xiaomi Redmi 10C', 'xiaomi-redmi-10c', 'xiaomi-redmi-10c.jpg', 'xiaomi-redmi-10c', 1, 11100000.00, 111000000.000, 'xiaomi-redmi-10c', 'xiaomi-redmi-10c', '2022-06-20 12:18:59', 1, '2022-06-20 12:18:59', 1, 1),
(42, 8, 'Xiaomi Redmi Note 10 Pro', 'xiaomi-redmi-note-10-pro', 'xiaomi-redmi-note-10-pro.jpg', 'xiaomi-redmi-note-10-pro', 1, 12900000.00, 12900000.000, 'xiaomi-redmi-note-10-pro', 'xiaomi-redmi-note-10-pro', '2022-06-20 12:19:21', 1, '2022-06-20 12:19:21', 1, 1),
(43, 8, 'Xiaomi Redmi Note 11', 'xiaomi-redmi-note-11', 'xiaomi-redmi-note-11.jpg', 'xiaomi-redmi-note-11', 1, 4990000.00, 4990000.000, 'xiaomi-redmi-note-11', 'xiaomi-redmi-note-11', '2022-06-20 12:19:49', 1, '2022-06-20 12:19:49', 1, 1),
(44, 10, 'Realme 8 Pro', 'realme-8-pro', 'realme-8-pro.jpg', 'realme-8-pro', 1, 12100000.00, 12100000.000, 'realme-8-pro', 'realme-8-pro', '2022-06-20 12:21:52', 1, '2022-06-20 12:21:52', 1, 1),
(45, 10, 'Realme 9 4G Vang', 'realme-9-4g-vang', 'realme-9-4g-vang.jpg', 'realme-9-4g-vang', 1, 11100000.00, 11100000.000, 'realme-9-4g-vang', 'realme-9-4g-vang', '2022-06-20 12:22:14', 1, '2022-06-20 12:22:14', 1, 1),
(46, 10, 'Realme C11', 'realme-c11', 'realme-c11.jpg', 'realme-c11', 1, 9900000.00, 9900000.000, 'realme-c11', 'realme-c11', '2022-06-20 12:23:16', 1, '2022-06-20 12:23:16', 1, 1),
(47, 10, 'Realme C21 Y', 'realme-c21-y', 'realme-c21-y.jpg', 'realme-c21-y', 1, 8800000.00, 8800000.000, 'realme-c21-y', 'realme-c21-y', '2022-06-20 12:23:35', 1, '2022-06-20 12:23:35', 1, 1),
(48, 10, 'Realme C35', 'realme-c35', 'realme-c35.jpg', 'realme-c35', 1, 3100000.00, 3100000.000, 'realme-c35', 'realme-c35', '2022-06-20 12:24:12', 1, '2022-06-20 12:24:12', 1, 1),
(49, 10, 'Redmi 10', 'redmi-10', 'redmi-10.jpg', 'redmi-10', 1, 4100000.00, 4100000.000, 'redmi-10', 'redmi-10', '2022-06-20 12:24:27', 1, '2022-06-20 12:24:27', 1, 1),
(50, 2, 'Samsung Galaxy A52s 5g', 'samsung-galaxy-a52s-5g', 'samsung-galaxy-a52s-5g.jpg', 'Chi tiết sản phẩm', 1, 8800000.00, 8800000.000, 'samsung-galaxy-a52s-5g', 'samsung-galaxy-a52s-5g', '2022-06-20 12:25:31', 1, '2022-06-21 16:48:40', 1, 1),
(51, 2, 'Samsung Galaxy A53', 'samsung-galaxy-a53', 'samsung-galaxy-a53.jpg', 'Chi tiết sản phẩm', 1, 7100000.00, 7100000.000, 'Từ khóa', 'Mô tả', '2022-06-20 12:25:55', 1, '2022-06-21 16:47:42', 1, 1),
(52, 2, 'Samsung Galaxy A73 5G', 'samsung-galaxy-a73-5g', 'samsung-galaxy-a73-5g.jpg', 'Chi tiết sản phẩm ', 1, 3100000.00, 3100000.000, 'Từ khóa', 'Mô tả', '2022-06-20 12:26:18', 1, '2022-06-21 16:46:36', 1, 1),
(53, 2, 'Samsung Galaxy S20 FE', 'samsung-galaxy-s20-fe', 'samsung-galaxy-s20-fe.jpg', 'Chi tiết  sản phẩm     ', 1, 3100000.00, 3100000.000, 'Từ khóa sản phẩm', 'Mô tả sản phẩm', '2022-06-20 12:26:40', 1, '2022-06-21 16:46:19', 1, 1),
(54, 2, 'Samsung Galaxy S22 Ultra', 'samsung-galaxy-s22-ultra', 'samsung-galaxy-s22-ultra.jpg', 'samsung-galaxy-s22-ultra', 1, 6100000.00, 5100000.000, 'samsung-galaxy-s22-ultra', 'samsung-galaxy-s22-ultra', '2022-06-20 12:27:13', 1, '2022-06-21 10:43:36', 1, 0),
(55, 2, 'Samsung Galaxy Z Flip3 5g 128gb', 'samsung-galaxy-z-flip3-5g-128gb', 'samsung-galaxy-z-flip3-5g-128gb-flex-your-way-tim-1-3.jpg', 'samsung-galaxy-z-flip3-5g-128gb-flex-your-way-tim-1-3', 1, 7100000.00, 6100000.000, 'samsung-galaxy-z-flip3-5g-128gb-flex-your-way-tim-1-3', 'samsung-galaxy-z-flip3-5g-128gb-flex-your-way-tim-1-3', '2022-06-20 12:27:32', 1, '2022-06-21 10:43:34', 1, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhom3_slider`
--

CREATE TABLE `nhom3_slider` (
  `Id` int(10) UNSIGNED NOT NULL COMMENT 'Mã Slider',
  `Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên Slider',
  `Link` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Liên kết',
  `Position` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Vị trí',
  `Img` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Hình ảnh',
  `Orders` int(10) UNSIGNED NOT NULL COMMENT 'Thứ tự',
  `CreatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày tạo',
  `CreatedBy` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Người tạo',
  `UpdatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày sửa',
  `UpdatedBy` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Người sửa',
  `Status` tinyint(3) UNSIGNED DEFAULT '2' COMMENT 'Trạng thái'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhom3_slider`
--

INSERT INTO `nhom3_slider` (`Id`, `Name`, `Link`, `Position`, `Img`, `Orders`, `CreatedAt`, `CreatedBy`, `UpdatedAt`, `UpdatedBy`, `Status`) VALUES
(1, 'Khuyễn mãi 1', 'http://domain.com/index.php?option=page&cat=khuyen-mai-1', 'slideshow', 'slider1.jpg', 1, '2022-06-18 17:22:58', 1, '2022-06-18 17:22:58', 1, 1),
(2, 'Khuyễn mãi 2', 'http://domain.com/index.php?option=page&cat=khuyen-mai-2', 'slideshow', 'slider2.jpg', 1, '2022-06-18 17:23:08', 1, '2022-06-18 17:23:08', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhom3_topic`
--

CREATE TABLE `nhom3_topic` (
  `Id` int(10) UNSIGNED NOT NULL COMMENT 'Mã chủ đề',
  `Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên chủ đề',
  `Slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Slug tên chủ đề',
  `ParentId` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Mã cấp cha',
  `Orders` int(10) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Sắp xếp',
  `MetaKey` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Từ khóa SEO',
  `MetaDesc` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Mô tả SEO',
  `CreatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CreatedBy` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `UpdatedAt` timestamp NULL DEFAULT NULL,
  `UpdatedBy` tinyint(3) UNSIGNED DEFAULT NULL,
  `Status` tinyint(3) UNSIGNED NOT NULL DEFAULT '2' COMMENT 'Trạng thái'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhom3_topic`
--

INSERT INTO `nhom3_topic` (`Id`, `Name`, `Slug`, `ParentId`, `Orders`, `MetaKey`, `MetaDesc`, `CreatedAt`, `CreatedBy`, `UpdatedAt`, `UpdatedBy`, `Status`) VALUES
(1, 'Tin tức', 'tin-tuc', 0, 0, 'Tin tuc', 'Tin tuc', '2022-06-20 08:33:31', 0, '2022-06-20 08:49:22', 1, 2),
(2, 'Dịch vụ', 'dich-vu', 0, 1, 'Dich vu', 'Dich vu', '2022-06-20 08:33:31', 0, '2022-06-30 01:37:10', 1, 2),
(3, 'Giới thiệu', 'gioi-thieu', 0, 1, 'Gioi thieu', 'Gioi thieu', '2022-06-20 08:40:03', 1, '2022-06-20 08:49:52', 1, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhom3_user`
--

CREATE TABLE `nhom3_user` (
  `Id` int(10) UNSIGNED NOT NULL COMMENT 'Mã tài khoản',
  `Fullname` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Họ và tên',
  `Username` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên đăng nhâp',
  `Password` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Mật khẩu',
  `Email` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Email',
  `Gender` tinyint(3) UNSIGNED NOT NULL COMMENT 'Giới tính',
  `Phone` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Điện thoại',
  `Roles` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Quyền truy cập',
  `CreatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày tạo',
  `CreatedBy` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Người tạo',
  `UpdatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày sửa',
  `UpdatedBy` tinyint(3) UNSIGNED DEFAULT '1' COMMENT 'Người sửa',
  `Status` tinyint(3) UNSIGNED NOT NULL DEFAULT '2' COMMENT 'Trạng thái'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhom3_user`
--

INSERT INTO `nhom3_user` (`Id`, `Fullname`, `Username`, `Password`, `Email`, `Gender`, `Phone`, `Roles`, `CreatedAt`, `CreatedBy`, `UpdatedAt`, `UpdatedBy`, `Status`) VALUES
(1, 'Quản trị', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin@gmail.com', 1, '0987654367', '1', '2020-07-01 00:16:03', 1, '2020-07-01 00:16:03', 1, 1),
(5, 'Võ Văn Dương', 'dvv1208', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'vovanduong258@gmail.com', 1, '0985781353', '0', '2022-06-28 02:40:27', 1, '2022-06-28 09:40:27', 1, 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `nhom3_category`
--
ALTER TABLE `nhom3_category`
  ADD PRIMARY KEY (`Id`);

--
-- Chỉ mục cho bảng `nhom3_contact`
--
ALTER TABLE `nhom3_contact`
  ADD PRIMARY KEY (`Id`);

--
-- Chỉ mục cho bảng `nhom3_customer`
--
ALTER TABLE `nhom3_customer`
  ADD PRIMARY KEY (`Id`);

--
-- Chỉ mục cho bảng `nhom3_menu`
--
ALTER TABLE `nhom3_menu`
  ADD PRIMARY KEY (`Id`);

--
-- Chỉ mục cho bảng `nhom3_order`
--
ALTER TABLE `nhom3_order`
  ADD PRIMARY KEY (`Id`);

--
-- Chỉ mục cho bảng `nhom3_orderdetail`
--
ALTER TABLE `nhom3_orderdetail`
  ADD PRIMARY KEY (`Id`);

--
-- Chỉ mục cho bảng `nhom3_product`
--
ALTER TABLE `nhom3_product`
  ADD PRIMARY KEY (`Id`);

--
-- Chỉ mục cho bảng `nhom3_slider`
--
ALTER TABLE `nhom3_slider`
  ADD PRIMARY KEY (`Id`);

--
-- Chỉ mục cho bảng `nhom3_topic`
--
ALTER TABLE `nhom3_topic`
  ADD PRIMARY KEY (`Id`);

--
-- Chỉ mục cho bảng `nhom3_user`
--
ALTER TABLE `nhom3_user`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `nhom3_category`
--
ALTER TABLE `nhom3_category`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT cho bảng `nhom3_contact`
--
ALTER TABLE `nhom3_contact`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã liên hệ', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `nhom3_customer`
--
ALTER TABLE `nhom3_customer`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã tài khoản';

--
-- AUTO_INCREMENT cho bảng `nhom3_menu`
--
ALTER TABLE `nhom3_menu`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã Menu', AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `nhom3_order`
--
ALTER TABLE `nhom3_order`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id đơn hàng', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `nhom3_orderdetail`
--
ALTER TABLE `nhom3_orderdetail`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã CT Đơn hàng', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `nhom3_product`
--
ALTER TABLE `nhom3_product`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã sản phẩm', AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT cho bảng `nhom3_slider`
--
ALTER TABLE `nhom3_slider`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã Slider', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `nhom3_topic`
--
ALTER TABLE `nhom3_topic`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã chủ đề', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `nhom3_user`
--
ALTER TABLE `nhom3_user`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Mã tài khoản', AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
