-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th6 21, 2023 lúc 01:47 AM
-- Phiên bản máy phục vụ: 10.3.39-MariaDB-cll-lve
-- Phiên bản PHP: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `krandomviponl_shopmanguon`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bank`
--

CREATE TABLE `bank` (
  `id` int(11) NOT NULL,
  `short_name` text NOT NULL,
  `accountNumber` text NOT NULL,
  `accountName` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `bank`
--

INSERT INTO `bank` (`id`, `short_name`, `accountNumber`, `accountName`) VALUES
(1, 'VCB', '0978009289', 'NGUYEN DUY KHANH');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cards`
--

CREATE TABLE `cards` (
  `id` int(11) NOT NULL,
  `code` varchar(32) DEFAULT NULL,
  `username` varchar(32) NOT NULL,
  `loaithe` varchar(32) NOT NULL,
  `menhgia` int(11) NOT NULL,
  `thucnhan` int(11) DEFAULT 0,
  `seri` text NOT NULL,
  `pin` text NOT NULL,
  `createdate` datetime NOT NULL,
  `status` varchar(32) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dongtien`
--

CREATE TABLE `dongtien` (
  `id` int(11) NOT NULL,
  `sotientruoc` int(11) DEFAULT NULL,
  `sotienthaydoi` int(11) DEFAULT NULL,
  `sotiensau` int(11) DEFAULT NULL,
  `thoigian` datetime DEFAULT NULL,
  `noidung` text DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `history_spam_sms`
--

CREATE TABLE `history_spam_sms` (
  `id` int(11) NOT NULL,
  `username` text DEFAULT NULL,
  `magd` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `id_server` varchar(255) DEFAULT NULL,
  `time` int(11) NOT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `user_id` text DEFAULT NULL,
  `trans_id` text DEFAULT NULL,
  `payment_method` text DEFAULT NULL,
  `amount` int(11) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `create_time` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `list_url_cron`
--

CREATE TABLE `list_url_cron` (
  `id` int(11) NOT NULL,
  `chunhan` varchar(255) DEFAULT NULL,
  `id_server` varchar(255) NOT NULL,
  `url` longtext DEFAULT NULL,
  `sogiay` longtext DEFAULT NULL,
  `magd` varchar(255) NOT NULL,
  `trangthai` varchar(255) DEFAULT NULL,
  `response` longtext DEFAULT NULL,
  `ngay_mua` int(11) DEFAULT 0,
  `ngay_het` int(11) DEFAULT 0,
  `time_his` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip` text DEFAULT NULL,
  `device` text DEFAULT NULL,
  `create_date` text DEFAULT NULL,
  `action` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `ip`, `device`, `create_date`, `action`) VALUES
(1, 1, '14.191.8.204', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '2023/06/20 08:32:03', 'Đăng ký tài khoản thành công'),
(2, 2, '14.191.8.204', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '2023/06/20 08:36:50', 'Đăng ký tài khoản thành công'),
(3, 1, '14.191.8.204', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '2023/06/20 09:48:30', 'Đăng nhập thành công vào hệ thống'),
(4, 1, '14.191.8.204', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '2023/06/20 11:06:40', 'Đăng nhập thành công vào hệ thống'),
(5, 1, '14.191.8.204', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '2023/06/20 11:59:13', 'Đăng nhập thành công vào hệ thống'),
(6, 2, '14.191.8.204', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '2023/06/20 12:10:32', 'Đăng nhập thành công vào hệ thống'),
(7, 1, '14.191.8.204', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '2023/06/20 12:10:55', 'Đăng nhập thành công vào hệ thống'),
(8, 1, '14.191.8.221', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '2023/06/20 20:46:47', 'Đăng nhập thành công vào hệ thống'),
(9, 1, '14.191.8.221', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '2023/06/20 21:18:50', 'Đăng nhập thành công vào hệ thống'),
(10, 1, '14.191.9.223', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '2023/06/21 08:10:41', 'Đăng nhập thành công vào hệ thống');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `log_balance`
--

CREATE TABLE `log_balance` (
  `id` int(11) NOT NULL,
  `money_before` text DEFAULT NULL,
  `money_change` text DEFAULT NULL,
  `money_after` text DEFAULT NULL,
  `time` text DEFAULT NULL,
  `content` text DEFAULT NULL,
  `user_id` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `server_cron_auto`
--

CREATE TABLE `server_cron_auto` (
  `id` int(11) NOT NULL,
  `status` text NOT NULL,
  `name` text NOT NULL,
  `count` int(11) DEFAULT NULL,
  `rate` int(11) DEFAULT NULL,
  `limit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `server_cron_auto`
--

INSERT INTO `server_cron_auto` (`id`, `status`, `name`, `count`, `rate`, `limit`) VALUES
(1, 'ON', 'Server 1', 7, 5000, 100),
(2, 'ON', 'Server 2', 1, 5000, 50),
(3, 'ON', 'Server 3', 1, 3000, 50);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `server_spam_sms`
--

CREATE TABLE `server_spam_sms` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `time` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `server_spam_sms`
--

INSERT INTO `server_spam_sms` (`id`, `name`, `time`, `price`, `status`) VALUES
(1, 'Server 1', 90, 300, '1'),
(2, 'Server 2', 300, 1350, '1'),
(3, 'Server 3', 600, 2500, '1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`) VALUES
(1, 'status_send_mail', '0'),
(2, 'title', 'DICHVURIGHT.IO.VN'),
(3, 'description', 'Hệ Thống Bán Mã Nguồn Website Chất Lượng Tại Việt Nam | DichVuLight.Vn'),
(4, 'keywords', 'dichvuright, Shop bán source website giá rẻ'),
(5, 'author', 'Nguyễn Duy Khánh'),
(6, 'status_noti', '1'),
(7, 'status_update', '0'),
(8, 'hotline', '0559818207'),
(9, 'email', 'dichvunguyenduykhanh.vn@gmail.com'),
(10, 'email_smtp', 'cskh.thesieusao@gmail.com'),
(11, 'pass_email_smtp', 'cwgreslqjpjanzig'),
(12, 'session_login', '1800'),
(13, 'min_recharge', '1000'),
(14, 'time_delete_invoices', '2592000'),
(15, 'notification', '<p style=\"text-align: center; \"><b><font color=\"#0ea5e9\"><b>Chào mừng bạn đến với dịch vụ của chúng tôi</b></font></b></p>\r\n\r\n<p style=\"text-align: center;\"><b><b>Đổi thẻ cào uy tín tại: <font #0ea5e9\\\"\"=\"\" color=\"#0ea5e9\"><a href=\"https://cardvip2s.com\" target=\"_blank\">https://cardvip2s.com</a></font></b></b></p>\r\n\r\n<p style=\"text-align: center;\"><b><b>Thuê API giá rẻ tại: <font #0ea5e9\\\"\"=\"\" color=\"#0ea5e9\"><a href=\"https://api.dichvuright.io.vn\" target=\"_blank\">Tại Đây</a></font></b></b></p>\r\n\r\n<p style=\"text-align: center;\"><b><b>Nhóm hỗ trợ: <font #0ea5e9\\\"\"=\"\" color=\"#0ea5e9\"><a href=\"https://zalo.me/0978009289\" target=\"_blank\">Nguyễn Duy Khánh</a></font></b></b></p>'),
(16, 'notications', ''),
(17, 'display_api_vcb', '1'),
(18, 'limit_api_vcb', '3'),
(19, 'money_api_vcb', '10000'),
(20, 'status_tsr', '1'),
(21, 'token_tsr', 'LPtZqBUEcuXD-XUPEFd-tEgW-ZAnJ-kCeG'),
(22, 'status_vcb', '1'),
(23, 'token_vcb', 'Aaaaaaaaaafe3ed9268b19'),
(24, 'time_test_api', '86400'),
(25, 'noidungnap_vcb', 'dichvuright'),
(26, 'link_facebook', 'https://www.facebook.com/DuyKhanhRealL01'),
(27, 'link_zalo', 'https://zalo.me/0978009289'),
(28, 'logo', 'https://i.imgur.com/RLBlJfY.png'),
(29, 'anhbia', 'https://i.imgur.com/RLBlJfY.png'),
(30, 'favicon', 'https://i.imgur.com/24p9wNQ.png'),
(31, 'token_telegram', '6145455681:AAE5pufqmDQNknIYk8JptV3IibMOgNRkEsw'),
(32, 'chat_id_telegram', '1244823958'),
(33, 'apikey_dlsr', '#'),
(34, 'tkwhm', 'zencmsco'),
(35, 'mkwhm', '#ZenCms2006'),
(36, 'linkwhm', 'https://vmi1160798.contaboserver.net'),
(37, 'display_api_thesieure', '1'),
(38, 'limit_api_thesieure', '3'),
(39, 'money_api_thesieure', '10000'),
(40, 'display_api_tpbank', '1'),
(41, 'limit_api_tpbank', '3'),
(42, 'money_api_tpbank', '10000'),
(43, 'display_api_mbbank', '1'),
(44, 'limit_api_mbbank', '3'),
(45, 'money_api_mbbank', '10000'),
(46, 'api_ecaptcha', '66d2e80be2a17de918596ed948212703'),
(47, 'status_card', '1'),
(48, 'api_card', '3rtc9yh2piabzxloudqjfkm5ve4gw1ns876'),
(49, 'ck_card', '20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_his_code`
--

CREATE TABLE `tbl_his_code` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `magd` text DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_list_code`
--

CREATE TABLE `tbl_list_code` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `price` int(11) DEFAULT 0,
  `images` text DEFAULT NULL,
  `list_images` text DEFAULT NULL,
  `intro` longtext DEFAULT NULL,
  `view` bigint(20) DEFAULT 0,
  `sold` bigint(20) DEFAULT 0,
  `link_down` text DEFAULT NULL,
  `link_demo` text DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_list_code`
--

INSERT INTO `tbl_list_code` (`id`, `name`, `price`, `images`, `list_images`, `intro`, `view`, `sold`, `link_down`, `link_demo`, `status`, `create_date`, `update_date`) VALUES
(1, 'CODE CHECKSCAM GIỐNG ADMIN.VN', 0, 'https://i.imgur.com/PKy0Bhm.png', 'https://i.imgur.com/PKy0Bhm.png', 'code có key log anh em tự tìm nhé', 7, 0, 'bEdVSGRuUUN6eXRtV3RsVXgrSkZjRnlnRnI2cS9DNXk1VFNCSTFVaU5vSzRPWDJ6ajErVFlrQ2tIb2grOEdzQjJRd2llbi9TdjA2SEVSUmI2RUhRcU5taWVmejBUUVB4RFdtM05ZZlhQSERTNEJrTXArS21jRUtKeGlpaDhHVlY=', 'https://admin.vn/', 1, '2023-06-20 10:26:00', '2023-06-20 10:26:43'),
(2, 'CODE CLMM BẢN NODE JS V1', 0, 'https://i.imgur.com/lNl0CEP.png', 'https://i.imgur.com/lNl0CEP.png', '<p>cần hỗ trợ ib tele @DuyKhanhRealL</p>', 3, 0, 'bEdVSGRuUUN6eXRtV3RsVXgrSkZjRnlnRnI2cS9DNXk1VFNCSTFVaU5vSWZNNVRpakx0TkppZFF3MEdCUFVGSDIrZTl3N0k1UzdxQi93MUlneFE1T3QvZ0tKQUdVTHpMc1FZNVpsWVZZVDgxV2wrRUxpbHVmenBxQUJYa3dpOVc=', 'https://dichvuright.io.vn/', 1, '2023-06-20 21:16:16', '2023-06-20 21:16:16'),
(3, 'CODE CLONE V6 BẢN CŨ CỦA TUẤN ORI', 0, 'https://i.imgur.com/eyvWNvF.png', 'https://i.imgur.com/eyvWNvF.png\r\nhttps://i.imgur.com/9xd5kEQ.png\r\nhttps://i.imgur.com/G8PcmX5.jpg\r\nhttps://i.imgur.com/Q3QLIDb.png\r\nhttps://i.imgur.com/PlZFjbz.png\r\nhttps://i.imgur.com/9iU7x8B.png\r\nhttps://i.imgur.com/nzDkvlH.png\r\nhttps://i.imgur.com/6GEOrFB.png', 'cần hỗ trợ ib @DuyKhanhRealL', 1, 0, 'bEdVSGRuUUN6eXRtV3RsVXgrSkZjRnlnRnI2cS9DNXk1VFNCSTFVaU5vS3Yrc3BSTEZnejVBR1NVWXg0YVBRNVdnd3NJbWpiWE5KckhzWU8xS293azNqYTFFNk9mbU9Xd0x3dmZkOEdtNWViNlJlVW16MUlDQ3ZnYUNWcGlrbzQ=', 'https://dichvuright.io.vn/', 1, '2023-06-20 21:26:07', '2023-06-20 21:26:07'),
(4, 'CODE BÁN HOSTING CỦA TUẤN ORI V1', 0, 'https://i.imgur.com/n3xe1Cu.png', 'https://i.imgur.com/n3xe1Cu.png\r\nhttps://i.imgur.com/tT0KIcq.png\r\nhttps://i.imgur.com/wuCfBv0.png\r\nhttps://i.imgur.com/xZolgxj.png\r\nhttps://i.imgur.com/cKldbUs.png', '<p>cần hỗ trợ ib @DuykhanhRealL</p>', 0, 0, 'aEpYbzJKZGJSWlVGclJMNTdQelpMYkVtSWJoZ3Y4QXp4MXA4bkpXbUxORjJMREhPVnFxczVMQjlxRk9CeXVBSEJjQlZyUWowamRCUTRFWnRpSmlLajJ0SnVlckc0VER2TUljazFpZWNNenlYazBaM0VUd0RadmJKQ1hFOWZoR2M=', 'https://hosting2w.vn/', 1, '2023-06-20 21:42:58', '2023-06-20 21:42:58');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT 0,
  `token` text DEFAULT NULL,
  `ip` text DEFAULT NULL,
  `device` text DEFAULT NULL,
  `otp` text DEFAULT NULL,
  `money` int(11) NOT NULL DEFAULT 0,
  `total_money` int(11) NOT NULL DEFAULT 0,
  `banned` int(11) NOT NULL DEFAULT 0,
  `create_date` text DEFAULT NULL,
  `update_date` text DEFAULT NULL,
  `time_session` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `level`, `token`, `ip`, `device`, `otp`, `money`, `total_money`, `banned`, `create_date`, `update_date`, `time_session`) VALUES
(1, 'Khanhmuzatv2', '841cbc5586fd2b21bcc6e266782852b9d5ef1a9a', 'khanhbts5@gmail.com', 1, '9a3ceb29ff87a2dc6fc56bd326ad33a5', '14.191.9.223', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', NULL, 0, 0, 0, '2023/06/20 08:32:03', '1687224723', '1687311701'),
(2, 'Boladuykhanh', '3902b5138e176e19f48ade979da77005ba1c5652', 'khanhbts504@gmail.com', 0, 'c5bacb2b4455a52b57c98a872358d6bf', '14.191.8.204', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', NULL, 0, 0, 0, '2023/06/20 08:36:50', '1687225010', '1687237835');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `history_spam_sms`
--
ALTER TABLE `history_spam_sms`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `list_url_cron`
--
ALTER TABLE `list_url_cron`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `log_balance`
--
ALTER TABLE `log_balance`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `server_cron_auto`
--
ALTER TABLE `server_cron_auto`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `server_spam_sms`
--
ALTER TABLE `server_spam_sms`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_his_code`
--
ALTER TABLE `tbl_his_code`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_list_code`
--
ALTER TABLE `tbl_list_code`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `history_spam_sms`
--
ALTER TABLE `history_spam_sms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `list_url_cron`
--
ALTER TABLE `list_url_cron`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `log_balance`
--
ALTER TABLE `log_balance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `server_cron_auto`
--
ALTER TABLE `server_cron_auto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `server_spam_sms`
--
ALTER TABLE `server_spam_sms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT cho bảng `tbl_his_code`
--
ALTER TABLE `tbl_his_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_list_code`
--
ALTER TABLE `tbl_list_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
