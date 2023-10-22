CREATE TABLE `db_widget` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `group_id` int(11) NULL,
  `name_vn` varchar(255) COLLATE 'utf8_general_ci' NULL,
  `name_us` varchar(255) COLLATE 'utf8_general_ci' NULL,
  `name_ch` varchar(255) COLLATE 'utf8_general_ci' NULL,
  `content_vn` longtext COLLATE 'utf8_general_ci' NULL,
  `content_us` longtext COLLATE 'utf8_general_ci' NULL,
  `content_ch` longtext COLLATE 'utf8_general_ci' NULL,
  `weight` int(11) NOT NULL DEFAULT '0'
) ENGINE='MyISAM' COLLATE 'utf8_general_ci';

ALTER TABLE `db_widget`
ADD `is_active` tinyint(1) NULL DEFAULT 1;