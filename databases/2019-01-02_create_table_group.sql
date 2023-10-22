CREATE TABLE `db_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name_vn` varchar(255) COLLATE 'utf8_general_ci' NULL,
  `name_us` varchar(255) COLLATE 'utf8_general_ci' NULL,
  `name_ch` varchar(255) COLLATE 'utf8_general_ci' NULL
) ENGINE='MyISAM' COLLATE 'utf8_general_ci';

ALTER TABLE `db_group`
ADD `is_active` tinyint(1) NULL DEFAULT 1;

ALTER TABLE `db_group`
ADD `weight` int(11) NULL DEFAULT 0;

ALTER TABLE `db_sanpham`
ADD `group_id` int(11) NULL DEFAULT 0;