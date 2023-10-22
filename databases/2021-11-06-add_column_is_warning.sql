ALTER TABLE `db_sanpham`
ADD `visible_nguyenle` tinyint NULL DEFAULT '1',
ADD `is_warning` tinyint NULL DEFAULT '0' AFTER `visible_nguyenle`;
