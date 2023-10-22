ALTER TABLE `db_sanpham`
ADD `visible_bd` tinyint NULL DEFAULT '0',
ADD `visible_hn` tinyint NULL DEFAULT '0' AFTER `visible_bd`,
ADD `visible_dn` tinyint NULL DEFAULT '0' AFTER `visible_hn`;
