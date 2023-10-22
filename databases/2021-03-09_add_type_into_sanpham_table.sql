ALTER TABLE `db_sanpham`
ADD `product_type` smallint NOT NULL DEFAULT '1' AFTER `id`;
ALTER TABLE `db_sanpham` ADD INDEX(`product_type`);
