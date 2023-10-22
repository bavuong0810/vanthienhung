CREATE TABLE `db_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `option_name` varchar(255) COLLATE 'utf8_general_ci' NULL,
  `option_value_1` varchar(255) COLLATE 'utf8_general_ci' NULL,
  `option_value_2` text(0) COLLATE 'utf8_general_ci' NULL
) ENGINE='MyISAM' COLLATE 'utf8_general_ci';
