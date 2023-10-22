ALTER TABLE `db_dathang`
	ADD `is_replied` TINYINT(1) NOT NULL DEFAULT '0' AFTER `ma_dh`,
	ADD `replied_content` TEXT NULL AFTER `is_replied`;