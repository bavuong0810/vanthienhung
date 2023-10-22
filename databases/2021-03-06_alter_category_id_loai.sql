-- Make category_id of category not allow null and set default as 0
ALTER TABLE `db_category` CHANGE `category_id` `category_id` INT(11) NOT NULL DEFAULT 0;
UPDATE `db_category` SET `hien_thi` = 1 WHERE `hien_thi` IS NULL;
ALTER TABLE `db_category` CHANGE `hien_thi` `hien_thi` TINYINT(1) NOT NULL DEFAULT 1;

