ALTER TABLE `db_sanpham`
	ADD COLUMN `updated_at` TIMESTAMP NULL AFTER `tai_trong_nang`,
	ADD COLUMN `is_new` BIT NULL AFTER `updated_at`;