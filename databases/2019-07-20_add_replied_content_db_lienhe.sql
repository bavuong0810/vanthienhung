ALTER TABLE `db_lienhe` ADD `is_replied` TINYINT(1) NOT NULL DEFAULT '0' AFTER `trang_thai`, ADD `replied_content` TEXT NULL AFTER `is_replied`;