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
-- Cơ sở dữ liệu: `ptxecogioi_vth_online`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ptxecogioi_emails`
--

CREATE TABLE `ptxecogioi_emails` (
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
-- Đang đổ dữ liệu cho bảng `ptxecogioi_emails`
--

INSERT INTO `ptxecogioi_emails` (`id`, `email_type`, `email_admin`, `thank_you`, `dear_name`, `company_info_title`, `company_info_account`, `personal_info_title`, `personal_info_account`) VALUES
(2, 'dat_hang', 'xe.xenang@gmail.com', '', '', '', '', '', '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `ptxecogioi_emails`
--
ALTER TABLE `ptxecogioi_emails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `ptxecogioi_emails`
--
ALTER TABLE `ptxecogioi_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

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
-- Cơ sở dữ liệu: `hanoi_vth_online`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hanoi_emails`
--

CREATE TABLE `hanoi_emails` (
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
-- Đang đổ dữ liệu cho bảng `hanoi_emails`
--

INSERT INTO `hanoi_emails` (`id`, `email_type`, `email_admin`, `thank_you`, `dear_name`, `company_info_title`, `company_info_account`, `personal_info_title`, `personal_info_account`) VALUES
(2, 'dat_hang', 'xe.xenang@gmail.com', '', '', '', '', '', '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `hanoi_emails`
--
ALTER TABLE `hanoi_emails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `hanoi_emails`
--
ALTER TABLE `hanoi_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

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
-- Cơ sở dữ liệu: `phutungxeol_vth_online`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phutungxeol_emails`
--

CREATE TABLE `phutungxeol_emails` (
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
-- Đang đổ dữ liệu cho bảng `phutungxeol_emails`
--

INSERT INTO `phutungxeol_emails` (`id`, `email_type`, `email_admin`, `thank_you`, `dear_name`, `company_info_title`, `company_info_account`, `personal_info_title`, `personal_info_account`) VALUES
(2, 'dat_hang', 'xe.xenang@gmail.com', '', '', '', '', '', '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `phutungxeol_emails`
--
ALTER TABLE `phutungxeol_emails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `phutungxeol_emails`
--
ALTER TABLE `phutungxeol_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

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
-- Cơ sở dữ liệu: `bacdanol_vth_online`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bacdanol_emails`
--

CREATE TABLE `bacdanol_emails` (
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
-- Đang đổ dữ liệu cho bảng `bacdanol_emails`
--

INSERT INTO `bacdanol_emails` (`id`, `email_type`, `email_admin`, `thank_you`, `dear_name`, `company_info_title`, `company_info_account`, `personal_info_title`, `personal_info_account`) VALUES
(2, 'dat_hang', 'xe.xenang@gmail.com', '', '', '', '', '', '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bacdanol_emails`
--
ALTER TABLE `bacdanol_emails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bacdanol_emails`
--
ALTER TABLE `bacdanol_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

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
-- Cơ sở dữ liệu: `xetaiol_vth_online`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `xetaiol_emails`
--

CREATE TABLE `xetaiol_emails` (
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
-- Đang đổ dữ liệu cho bảng `xetaiol_emails`
--

INSERT INTO `xetaiol_emails` (`id`, `email_type`, `email_admin`, `thank_you`, `dear_name`, `company_info_title`, `company_info_account`, `personal_info_title`, `personal_info_account`) VALUES
(2, 'dat_hang', 'xe.xenang@gmail.com', '', '', '', '', '', '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `xetaiol_emails`
--
ALTER TABLE `xetaiol_emails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `xetaiol_emails`
--
ALTER TABLE `xetaiol_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

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
-- Cơ sở dữ liệu: `binhduong_vth_online`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `binhduong_emails`
--

CREATE TABLE `binhduong_emails` (
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
-- Đang đổ dữ liệu cho bảng `binhduong_emails`
--

INSERT INTO `binhduong_emails` (`id`, `email_type`, `email_admin`, `thank_you`, `dear_name`, `company_info_title`, `company_info_account`, `personal_info_title`, `personal_info_account`) VALUES
(2, 'dat_hang', 'xe.xenang@gmail.com', '', '', '', '', '', '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `binhduong_emails`
--
ALTER TABLE `binhduong_emails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `binhduong_emails`
--
ALTER TABLE `binhduong_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

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
-- Cơ sở dữ liệu: `xenangol_vth_online`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `xenangol_emails`
--

CREATE TABLE `xenangol_emails` (
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
-- Đang đổ dữ liệu cho bảng `xenangol_emails`
--

INSERT INTO `xenangol_emails` (`id`, `email_type`, `email_admin`, `thank_you`, `dear_name`, `company_info_title`, `company_info_account`, `personal_info_title`, `personal_info_account`) VALUES
(2, 'dat_hang', 'xe.xenang@gmail.com', '', '', '', '', '', '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `xenangol_emails`
--
ALTER TABLE `xenangol_emails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `xenangol_emails`
--
ALTER TABLE `xenangol_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

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
-- Cơ sở dữ liệu: `chodansinol_vth_online`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chodansinol_emails`
--

CREATE TABLE `chodansinol_emails` (
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
-- Đang đổ dữ liệu cho bảng `chodansinol_emails`
--

INSERT INTO `chodansinol_emails` (`id`, `email_type`, `email_admin`, `thank_you`, `dear_name`, `company_info_title`, `company_info_account`, `personal_info_title`, `personal_info_account`) VALUES
(2, 'dat_hang', 'xe.xenang@gmail.com', '', '', '', '', '', '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chodansinol_emails`
--
ALTER TABLE `chodansinol_emails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chodansinol_emails`
--
ALTER TABLE `chodansinol_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

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
-- Cơ sở dữ liệu: `vthol_vth_online`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vthol_emails`
--

CREATE TABLE `vthol_emails` (
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
-- Đang đổ dữ liệu cho bảng `vthol_emails`
--

INSERT INTO `vthol_emails` (`id`, `email_type`, `email_admin`, `thank_you`, `dear_name`, `company_info_title`, `company_info_account`, `personal_info_title`, `personal_info_account`) VALUES
(2, 'dat_hang', 'xe.xenang@gmail.com', '', '', '', '', '', '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `vthol_emails`
--
ALTER TABLE `vthol_emails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `vthol_emails`
--
ALTER TABLE `vthol_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

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
-- Cơ sở dữ liệu: `thuylucol_vth_online`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thuylucol_emails`
--

CREATE TABLE `thuylucol_emails` (
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
-- Đang đổ dữ liệu cho bảng `thuylucol_emails`
--

INSERT INTO `thuylucol_emails` (`id`, `email_type`, `email_admin`, `thank_you`, `dear_name`, `company_info_title`, `company_info_account`, `personal_info_title`, `personal_info_account`) VALUES
(2, 'dat_hang', 'xe.xenang@gmail.com', '', '', '', '', '', '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `thuylucol_emails`
--
ALTER TABLE `thuylucol_emails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `thuylucol_emails`
--
ALTER TABLE `thuylucol_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

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
-- Cơ sở dữ liệu: `cnbdol_vth_online`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cnbdol_emails`
--

CREATE TABLE `cnbdol_emails` (
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
-- Đang đổ dữ liệu cho bảng `cnbdol_emails`
--

INSERT INTO `cnbdol_emails` (`id`, `email_type`, `email_admin`, `thank_you`, `dear_name`, `company_info_title`, `company_info_account`, `personal_info_title`, `personal_info_account`) VALUES
(2, 'dat_hang', 'xe.xenang@gmail.com', '', '', '', '', '', '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cnbdol_emails`
--
ALTER TABLE `cnbdol_emails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cnbdol_emails`
--
ALTER TABLE `cnbdol_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

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
-- Cơ sở dữ liệu: `vthcomvn_vth_online`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vthcomvn_emails`
--

CREATE TABLE `vthcomvn_emails` (
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
-- Đang đổ dữ liệu cho bảng `vthcomvn_emails`
--

INSERT INTO `vthcomvn_emails` (`id`, `email_type`, `email_admin`, `thank_you`, `dear_name`, `company_info_title`, `company_info_account`, `personal_info_title`, `personal_info_account`) VALUES
(2, 'dat_hang', 'xe.xenang@gmail.com', '', '', '', '', '', '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `vthcomvn_emails`
--
ALTER TABLE `vthcomvn_emails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `vthcomvn_emails`
--
ALTER TABLE `vthcomvn_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

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
-- Cơ sở dữ liệu: `dongnai_vth_online`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dongnai_emails`
--

CREATE TABLE `dongnai_emails` (
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
-- Đang đổ dữ liệu cho bảng `dongnai_emails`
--

INSERT INTO `dongnai_emails` (`id`, `email_type`, `email_admin`, `thank_you`, `dear_name`, `company_info_title`, `company_info_account`, `personal_info_title`, `personal_info_account`) VALUES
(2, 'dat_hang', 'xe.xenang@gmail.com', '', '', '', '', '', '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `dongnai_emails`
--
ALTER TABLE `dongnai_emails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `dongnai_emails`
--
ALTER TABLE `dongnai_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

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
-- Cơ sở dữ liệu: `suaxeol_vth_online`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `suaxeol_emails`
--

CREATE TABLE `suaxeol_emails` (
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
-- Đang đổ dữ liệu cho bảng `suaxeol_emails`
--

INSERT INTO `suaxeol_emails` (`id`, `email_type`, `email_admin`, `thank_you`, `dear_name`, `company_info_title`, `company_info_account`, `personal_info_title`, `personal_info_account`) VALUES
(2, 'dat_hang', 'xe.xenang@gmail.com', '', '', '', '', '', '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `suaxeol_emails`
--
ALTER TABLE `suaxeol_emails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `suaxeol_emails`
--
ALTER TABLE `suaxeol_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

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
-- Cơ sở dữ liệu: `daycuroaol_vth_online`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `daycuroaol_emails`
--

CREATE TABLE `daycuroaol_emails` (
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
-- Đang đổ dữ liệu cho bảng `daycuroaol_emails`
--

INSERT INTO `daycuroaol_emails` (`id`, `email_type`, `email_admin`, `thank_you`, `dear_name`, `company_info_title`, `company_info_account`, `personal_info_title`, `personal_info_account`) VALUES
(2, 'dat_hang', 'xe.xenang@gmail.com', '', '', '', '', '', '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `daycuroaol_emails`
--
ALTER TABLE `daycuroaol_emails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `daycuroaol_emails`
--
ALTER TABLE `daycuroaol_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

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
-- Cơ sở dữ liệu: `ptxenangol_vth_online`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ptxenangol_emails`
--

CREATE TABLE `ptxenangol_emails` (
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
-- Đang đổ dữ liệu cho bảng `ptxenangol_emails`
--

INSERT INTO `ptxenangol_emails` (`id`, `email_type`, `email_admin`, `thank_you`, `dear_name`, `company_info_title`, `company_info_account`, `personal_info_title`, `personal_info_account`) VALUES
(2, 'dat_hang', 'xe.xenang@gmail.com', '', '', '', '', '', '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `ptxenangol_emails`
--
ALTER TABLE `ptxenangol_emails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `ptxenangol_emails`
--
ALTER TABLE `ptxenangol_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

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
-- Cơ sở dữ liệu: `bdcomvn_vth_online`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bdcomvn_emails`
--

CREATE TABLE `bdcomvn_emails` (
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
-- Đang đổ dữ liệu cho bảng `bdcomvn_emails`
--

INSERT INTO `bdcomvn_emails` (`id`, `email_type`, `email_admin`, `thank_you`, `dear_name`, `company_info_title`, `company_info_account`, `personal_info_title`, `personal_info_account`) VALUES
(2, 'dat_hang', 'xe.xenang@gmail.com', '', '', '', '', '', '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bdcomvn_emails`
--
ALTER TABLE `bdcomvn_emails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bdcomvn_emails`
--
ALTER TABLE `bdcomvn_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

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
-- Cơ sở dữ liệu: `voxeol_vth_online`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `voxeol_emails`
--

CREATE TABLE `voxeol_emails` (
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
-- Đang đổ dữ liệu cho bảng `voxeol_emails`
--

INSERT INTO `voxeol_emails` (`id`, `email_type`, `email_admin`, `thank_you`, `dear_name`, `company_info_title`, `company_info_account`, `personal_info_title`, `personal_info_account`) VALUES
(2, 'dat_hang', 'xe.xenang@gmail.com', '', '', '', '', '', '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `voxeol_emails`
--
ALTER TABLE `voxeol_emails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `voxeol_emails`
--
ALTER TABLE `voxeol_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

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
-- Cơ sở dữ liệu: `vthcom_vth_online`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vthcom_emails`
--

CREATE TABLE `vthcom_emails` (
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
-- Đang đổ dữ liệu cho bảng `vthcom_emails`
--

INSERT INTO `vthcom_emails` (`id`, `email_type`, `email_admin`, `thank_you`, `dear_name`, `company_info_title`, `company_info_account`, `personal_info_title`, `personal_info_account`) VALUES
(2, 'dat_hang', 'xe.xenang@gmail.com', '', '', '', '', '', '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `vthcom_emails`
--
ALTER TABLE `vthcom_emails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `vthcom_emails`
--
ALTER TABLE `vthcom_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
