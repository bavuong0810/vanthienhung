-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th4 14, 2023 lúc 02:19 PM
-- Phiên bản máy phục vụ: 10.3.38-MariaDB-log
-- Phiên bản PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `db_vth_online`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `db_emails`
--

CREATE TABLE `db_emails` (
  `id` int(11) NOT NULL,
  `email_type` varchar(255) DEFAULT NULL,
  `email_admin` varchar(255) DEFAULT NULL,
  `thank_you` varchar(255) DEFAULT NULL,
  `dear_name` varchar(255) DEFAULT NULL,
  `company_info_title` varchar(255) DEFAULT NULL,
  `company_info_account` text DEFAULT NULL,
  `personal_info_title` varchar(255) DEFAULT NULL,
  `personal_info_account` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `db_emails`
--

INSERT INTO `db_emails` (`id`, `email_type`, `email_admin`, `thank_you`, `dear_name`, `company_info_title`, `company_info_account`, `personal_info_title`, `personal_info_account`) VALUES
(2, 'dat_hang', 'xe.xenang@gmail.com', '', '', '', '', '', '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `db_emails`
--
ALTER TABLE `db_emails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `db_emails`
--
ALTER TABLE `db_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
