-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th3 22, 2023 lúc 09:21 PM
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
-- Cấu trúc bảng cho bảng `db_options`
--

CREATE TABLE `db_options` (
  `id` int(11) NOT NULL,
  `option_name` varchar(255) DEFAULT NULL,
  `option_value_1` varchar(255) DEFAULT NULL,
  `option_value_2` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `db_options`
--

INSERT INTO `db_options` (`id`, `option_name`, `option_value_1`, `option_value_2`) VALUES
(1, 'view_san_pham', 'grid', ''),
(2, 'view_ho_tro', '1', ''),
(3, 'view_footer', 'bando', ''),
(4, '1', '2', '3'),
(5, 'view_dm_truc_tuyen', '', ''),
(6, 'view_ct_truc_tuyen', '1', ''),
(7, 'view_thong_so', '1', ''),
(8, 'view_san_pham_layout', '', ''),
(9, 'view_home_slider', '1', ''),
(10, 'view_home_gallery', '1', ''),
(11, 'view_home_business', '', ''),
(12, 'view_home_services', '1', '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `db_options`
--
ALTER TABLE `db_options`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `db_options`
--
ALTER TABLE `db_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
