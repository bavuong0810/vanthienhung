ALTER TABLE `db_sanpham`
CHANGE `id_loai` `category_id` int(11) NOT NULL AFTER `product_type`,
DROP `id_hang`,
CHANGE `ma_sp` `code` varchar(255) COLLATE 'utf8_general_ci' NULL AFTER `alias_ch`,
CHANGE `ma_sp2` `code_2` varchar(255) COLLATE 'utf8_general_ci' NULL AFTER `code`,
CHANGE `ma_sp3` `code_3` varchar(255) COLLATE 'utf8_general_ci' NULL AFTER `code_2`;


SELECT CONCAT(
    'ALTER TABLE ', TABLE_NAME,
    ' CHANGE ', COLUMN_NAME,
    ' category_id ',
    ' ', COLUMN_TYPE, ';') AS rename_script 
FROM INFORMATION_SCHEMA.COLUMNS  
WHERE TABLE_SCHEMA = 'vanthienhung_20210406' AND COLUMN_NAME = 'id_loai';

--CHANGE `id_loai` `category_id` int(11) NOT NULL DEFAULT '0' AFTER `id`;
ALTER TABLE db_thuvienanh RENAME COLUMN id_loai TO category_id;
ALTER TABLE db_permission_group RENAME COLUMN id_loai TO category_id;
ALTER TABLE db_video RENAME COLUMN id_loai TO category_id;
ALTER TABLE db_tintuc RENAME COLUMN id_loai TO category_id;
ALTER TABLE db_category RENAME COLUMN id_loai TO category_id;
ALTER TABLE db_category_old RENAME COLUMN id_loai TO category_id;
ALTER TABLE db_hotro RENAME COLUMN id_loai TO category_id;
ALTER TABLE db_slide_sp RENAME COLUMN id_loai TO category_id;
ALTER TABLE db_quan RENAME COLUMN id_loai TO category_id;
ALTER TABLE db_sanpham_old RENAME COLUMN id_loai TO category_id;

/**
--- GEN QUERY TO RENAME COLUMN IN ALL TABLE

SELECT CONCAT(
    'ALTER TABLE ', TABLE_NAME,
    ' CHANGE ', COLUMN_NAME,
    ' name_vi',
    ' ', COLUMN_TYPE, ';') AS rename_script 
FROM INFORMATION_SCHEMA.COLUMNS  
WHERE TABLE_SCHEMA = 'vanthienhung_20210406' AND COLUMN_NAME = 'ten_vn';
**/

ALTER TABLE db_category RENAME COLUMN ten_vn TO name_vi;
ALTER TABLE db_category_old RENAME COLUMN ten_vn TO name_vi;
ALTER TABLE db_danhmuc_hoidap RENAME COLUMN ten_vn TO name_vi;
ALTER TABLE db_dknhamau RENAME COLUMN ten_vn TO name_vi;
ALTER TABLE db_file RENAME COLUMN ten_vn TO name_vi;
ALTER TABLE db_hinhthucthanhtoan RENAME COLUMN ten_vn TO name_vi;
ALTER TABLE db_hotro RENAME COLUMN ten_vn TO name_vi;
ALTER TABLE db_khachhang RENAME COLUMN ten_vn TO name_vi;
ALTER TABLE db_map RENAME COLUMN ten_vn TO name_vi;
ALTER TABLE db_quan RENAME COLUMN ten_vn TO name_vi;
ALTER TABLE db_sanpham RENAME COLUMN ten_vn TO name_vi;
ALTER TABLE db_sanpham_old RENAME COLUMN ten_vn TO name_vi;
ALTER TABLE db_setting RENAME COLUMN ten_vn TO name_vi;
ALTER TABLE db_tags RENAME COLUMN ten_vn TO name_vi;
ALTER TABLE db_thanhpho RENAME COLUMN ten_vn TO name_vi;
ALTER TABLE db_thuvienanh RENAME COLUMN ten_vn TO name_vi;
ALTER TABLE db_tintuc RENAME COLUMN ten_vn TO name_vi;
ALTER TABLE db_video RENAME COLUMN ten_vn TO name_vi;

ALTER TABLE db_category RENAME COLUMN ten_us TO name_en;
ALTER TABLE db_category_old RENAME COLUMN ten_us TO name_en;
ALTER TABLE db_danhmuc_hoidap RENAME COLUMN ten_us TO name_en;
ALTER TABLE db_dknhamau RENAME COLUMN ten_us TO name_en;
ALTER TABLE db_file RENAME COLUMN ten_us TO name_en;
ALTER TABLE db_hinhthucthanhtoan RENAME COLUMN ten_us TO name_en;
ALTER TABLE db_hotro RENAME COLUMN ten_us TO name_en;
ALTER TABLE db_khachhang RENAME COLUMN ten_us TO name_en;
ALTER TABLE db_map RENAME COLUMN ten_us TO name_en;
ALTER TABLE db_quan RENAME COLUMN ten_us TO name_en;
ALTER TABLE db_sanpham RENAME COLUMN ten_us TO name_en;
ALTER TABLE db_sanpham_old RENAME COLUMN ten_us TO name_en;
ALTER TABLE db_setting RENAME COLUMN ten_us TO name_en;
ALTER TABLE db_tags RENAME COLUMN ten_us TO name_en;
ALTER TABLE db_thanhpho RENAME COLUMN ten_us TO name_en;
ALTER TABLE db_thuvienanh RENAME COLUMN ten_us TO name_en;
ALTER TABLE db_tintuc RENAME COLUMN ten_us TO name_en;
ALTER TABLE db_video RENAME COLUMN ten_us TO name_en;

ALTER TABLE db_category RENAME COLUMN ten_ch TO name_ch;
ALTER TABLE db_category_old RENAME COLUMN ten_ch TO name_ch;
ALTER TABLE db_danhmuc_hoidap RENAME COLUMN ten_ch TO name_ch;
ALTER TABLE db_dknhamau RENAME COLUMN ten_ch TO name_ch;
ALTER TABLE db_file RENAME COLUMN ten_ch TO name_ch;
ALTER TABLE db_hinhthucthanhtoan RENAME COLUMN ten_ch TO name_ch;
ALTER TABLE db_hotro RENAME COLUMN ten_ch TO name_ch;
ALTER TABLE db_khachhang RENAME COLUMN ten_ch TO name_ch;
ALTER TABLE db_map RENAME COLUMN ten_ch TO name_ch;
ALTER TABLE db_quan RENAME COLUMN ten_ch TO name_ch;
ALTER TABLE db_sanpham RENAME COLUMN ten_ch TO name_ch;
ALTER TABLE db_sanpham_old RENAME COLUMN ten_ch TO name_ch;
ALTER TABLE db_setting RENAME COLUMN ten_ch TO name_ch;
ALTER TABLE db_tags RENAME COLUMN ten_ch TO name_ch;
ALTER TABLE db_thanhpho RENAME COLUMN ten_ch TO name_ch;
ALTER TABLE db_thuvienanh RENAME COLUMN ten_ch TO name_ch;
ALTER TABLE db_tintuc RENAME COLUMN ten_ch TO name_ch;
ALTER TABLE db_video RENAME COLUMN ten_ch TO name_ch;


ALTER TABLE db_sanpham RENAME COLUMN don_vi TO unit;
ALTER TABLE db_sanpham RENAME COLUMN gia_nhap TO cost;
ALTER TABLE db_sanpham RENAME COLUMN gia TO price;
ALTER TABLE db_sanpham RENAME COLUMN khuyen_mai TO promotion_price;
ALTER TABLE db_sanpham RENAME COLUMN tieu_bieu TO is_hot;


--- tieu_bieu to is_hot
SELECT CONCAT(
    'ALTER TABLE ', TABLE_NAME,
    ' CHANGE ', COLUMN_NAME,
    ' is_hot',
    ' ', COLUMN_TYPE, ';') AS rename_script 
FROM INFORMATION_SCHEMA.COLUMNS  
WHERE TABLE_SCHEMA = 'vanthienhung_20210406' AND COLUMN_NAME = 'tieu_bieu';


ALTER TABLE db_sanpham RENAME COLUMN tieu_bieu TO is_hot;
ALTER TABLE db_tintuc RENAME COLUMN tieu_bieu TO is_hot;
ALTER TABLE db_category_old RENAME COLUMN tieu_bieu TO is_hot;
ALTER TABLE db_sanpham_old RENAME COLUMN tieu_bieu TO is_hot;
ALTER TABLE db_category RENAME COLUMN tieu_bieu TO is_hot;

SELECT CONCAT(
    'ALTER TABLE ', TABLE_NAME,
    ' CHANGE ', COLUMN_NAME,
    ' specification',
    ' ', COLUMN_TYPE, ';') AS rename_script 
FROM INFORMATION_SCHEMA.COLUMNS  
WHERE TABLE_SCHEMA = 'vanthienhung_20210406' AND COLUMN_NAME = 'serial';

ALTER TABLE db_sanpham RENAME COLUMN serial TO specification;
ALTER TABLE db_sanpham_old RENAME COLUMN serial TO specification;
ALTER TABLE db_baohanh RENAME COLUMN serial TO specification;

ALTER TABLE db_sanpham RENAME COLUMN tai_trong TO weight;
ALTER TABLE db_sanpham RENAME COLUMN nam TO mfg_year;


SELECT CONCAT(
    'ALTER TABLE ', TABLE_NAME,
    ' CHANGE ', COLUMN_NAME,
    ' description_vi',
    ' ', COLUMN_TYPE, ';') AS rename_script 
FROM INFORMATION_SCHEMA.COLUMNS  
WHERE TABLE_SCHEMA = 'vanthienhung_20210406' AND COLUMN_NAME = 'mo_ta_vn';

ALTER TABLE db_sanpham RENAME COLUMN mo_ta_vn TO description_vi;
ALTER TABLE db_tintuc RENAME COLUMN mo_ta_vn TO description_vi;
ALTER TABLE db_category_old RENAME COLUMN mo_ta_vn TO description_vi;
ALTER TABLE db_hotro RENAME COLUMN mo_ta_vn TO description_vi;
ALTER TABLE db_slide_sp RENAME COLUMN mo_ta_vn TO description_vi;
ALTER TABLE db_sanpham_old RENAME COLUMN mo_ta_vn TO description_vi;
ALTER TABLE db_map RENAME COLUMN mo_ta_vn TO description_vi;
ALTER TABLE db_category RENAME COLUMN mo_ta_vn TO description_vi;

SELECT CONCAT(
    'ALTER TABLE ', TABLE_NAME,
    ' CHANGE ', COLUMN_NAME,
    ' alias_vi',
    ' ', COLUMN_TYPE, ';') AS rename_script 
FROM INFORMATION_SCHEMA.COLUMNS  
WHERE TABLE_SCHEMA = 'vanthienhung_20210406' AND COLUMN_NAME = 'alias_vn';

ALTER TABLE db_sanpham RENAME COLUMN alias_vn TO alias_vi;
ALTER TABLE db_tintuc RENAME COLUMN alias_vn TO alias_vi;
ALTER TABLE db_category_old RENAME COLUMN alias_vn TO alias_vi;
ALTER TABLE db_sanpham_old RENAME COLUMN alias_vn TO alias_vi;
ALTER TABLE db_danhmuc_hoidap RENAME COLUMN alias_vn TO alias_vi;
ALTER TABLE db_category RENAME COLUMN alias_vn TO alias_vi;


SELECT CONCAT(
    'ALTER TABLE ', TABLE_NAME,
    ' CHANGE ', COLUMN_NAME,
    ' alias_en',
    ' ', COLUMN_TYPE, ';') AS rename_script 
FROM INFORMATION_SCHEMA.COLUMNS  
WHERE TABLE_SCHEMA = 'vanthienhung_20210406' AND COLUMN_NAME = 'alias_us';

ALTER TABLE db_sanpham RENAME COLUMN alias_us TO alias_en;
ALTER TABLE db_tintuc RENAME COLUMN alias_us TO alias_en;
ALTER TABLE db_category_old RENAME COLUMN alias_us TO alias_en;
ALTER TABLE db_sanpham_old RENAME COLUMN alias_us TO alias_en;
ALTER TABLE db_category RENAME COLUMN alias_us TO alias_en;

SELECT CONCAT(
    'ALTER TABLE ', TABLE_NAME,
    ' CHANGE ', COLUMN_NAME,
    ' code_3',
    ' ', COLUMN_TYPE, ';') AS rename_script 
FROM INFORMATION_SCHEMA.COLUMNS  
WHERE TABLE_SCHEMA = 'vanthienhung_20210406' AND COLUMN_NAME = 'ma_sp3';

ALTER TABLE db_sanpham_old RENAME COLUMN ma_sp3 TO code_3;


SELECT CONCAT(
    'ALTER TABLE ', TABLE_NAME,
    ' CHANGE ', COLUMN_NAME,
    ' description_en',
    ' ', COLUMN_TYPE, ';') AS rename_script 
FROM INFORMATION_SCHEMA.COLUMNS  
WHERE TABLE_SCHEMA = 'vanthienhung_20210406' AND COLUMN_NAME = 'mo_ta_us';

ALTER TABLE db_sanpham RENAME COLUMN mo_ta_us TO description_en;
ALTER TABLE db_tintuc RENAME COLUMN mo_ta_us TO description_en;
ALTER TABLE db_category_old RENAME COLUMN mo_ta_us TO description_en;
ALTER TABLE db_hotro RENAME COLUMN mo_ta_us TO description_en;
ALTER TABLE db_slide_sp RENAME COLUMN mo_ta_us TO description_en;
ALTER TABLE db_sanpham_old RENAME COLUMN mo_ta_us TO description_en;
ALTER TABLE db_map RENAME COLUMN mo_ta_us TO description_en;
ALTER TABLE db_category RENAME COLUMN mo_ta_us TO description_en;

SELECT CONCAT(
    'ALTER TABLE ', TABLE_NAME,
    ' CHANGE ', COLUMN_NAME,
    ' description_ch',
    ' ', COLUMN_TYPE, ';') AS rename_script 
FROM INFORMATION_SCHEMA.COLUMNS  
WHERE TABLE_SCHEMA = 'vanthienhung_20210406' AND COLUMN_NAME = 'mo_ta_ch';

ALTER TABLE db_sanpham RENAME COLUMN mo_ta_ch TO description_ch;
ALTER TABLE db_tintuc RENAME COLUMN mo_ta_ch TO description_ch;
ALTER TABLE db_category_old RENAME COLUMN mo_ta_ch TO description_ch;
ALTER TABLE db_sanpham_old RENAME COLUMN mo_ta_ch TO description_ch;
ALTER TABLE db_map RENAME COLUMN mo_ta_ch TO description_ch;
ALTER TABLE db_category RENAME COLUMN mo_ta_ch TO description_ch;

SELECT CONCAT(
    'ALTER TABLE ', TABLE_NAME,
    ' CHANGE ', COLUMN_NAME,
    ' image_path',
    ' ', COLUMN_TYPE, ';') AS rename_script 
FROM INFORMATION_SCHEMA.COLUMNS  
WHERE TABLE_SCHEMA = 'vanthienhung_20210406' AND COLUMN_NAME = 'hinh_anh';

ALTER TABLE db_sanpham RENAME COLUMN hinh_anh TO image_path;
ALTER TABLE db_baiviet_hinhanh RENAME COLUMN hinh_anh TO image_path;
ALTER TABLE db_thongtin RENAME COLUMN hinh_anh TO image_path;
ALTER TABLE db_setting RENAME COLUMN hinh_anh TO image_path;
ALTER TABLE db_thuvienanh RENAME COLUMN hinh_anh TO image_path;
ALTER TABLE db_user RENAME COLUMN hinh_anh TO image_path;
ALTER TABLE db_sanpham_hinhanh RENAME COLUMN hinh_anh TO image_path;
ALTER TABLE db_tintuc RENAME COLUMN hinh_anh TO image_path;
ALTER TABLE db_category_old RENAME COLUMN hinh_anh TO image_path;
ALTER TABLE db_hotro RENAME COLUMN hinh_anh TO image_path;
ALTER TABLE db_slide_sp RENAME COLUMN hinh_anh TO image_path;
ALTER TABLE db_sanpham_old RENAME COLUMN hinh_anh TO image_path;
ALTER TABLE db_category RENAME COLUMN hinh_anh TO image_path;

SELECT CONCAT(
    'ALTER TABLE ', TABLE_NAME,
    ' CHANGE ', COLUMN_NAME,
    ' content_en',
    ' ', COLUMN_TYPE, ';') AS rename_script 
FROM INFORMATION_SCHEMA.COLUMNS  
WHERE TABLE_SCHEMA = 'vanthienhung_20210406' AND COLUMN_NAME = 'thong_tin_us';

ALTER TABLE db_sanpham RENAME COLUMN thong_tin_us TO content_en;
ALTER TABLE db_sanpham RENAME COLUMN thong_tin_ch TO content_ch;
ALTER TABLE `db_sanpham` DROP `thong_so_vn`;
ALTER TABLE `db_sanpham` DROP `thong_tai_vn`;
ALTER TABLE `db_sanpham` DROP `thong_chon_vn`;


SELECT CONCAT(
    'ALTER TABLE ', TABLE_NAME,
    ' CHANGE ', COLUMN_NAME,
    ' title_vi',
    ' ', COLUMN_TYPE, ';') AS rename_script 
FROM INFORMATION_SCHEMA.COLUMNS  
WHERE TABLE_SCHEMA = 'vanthienhung_20210406' AND COLUMN_NAME = 'title_vn';

ALTER TABLE db_sanpham RENAME COLUMN title_vn TO title_vi;
ALTER TABLE db_setting RENAME COLUMN title_vn TO title_vi;
ALTER TABLE db_extra RENAME COLUMN title_vn TO title_vi;
ALTER TABLE db_tintuc RENAME COLUMN title_vn TO title_vi;
ALTER TABLE db_category_old RENAME COLUMN title_vn TO title_vi;
ALTER TABLE db_slide_sp RENAME COLUMN title_vn TO title_vi;
ALTER TABLE db_gallery RENAME COLUMN title_vn TO title_vi;
ALTER TABLE db_sanpham_old RENAME COLUMN title_vn TO title_vi;
ALTER TABLE db_seo RENAME COLUMN title_vn TO title_vi;
ALTER TABLE db_danhmuc_hoidap RENAME COLUMN title_vn TO title_vi;
ALTER TABLE db_category RENAME COLUMN title_vn TO title_vi;


SELECT CONCAT(
    'ALTER TABLE ', TABLE_NAME,
    ' CHANGE ', COLUMN_NAME,
    ' title_en',
    ' ', COLUMN_TYPE, ';') AS rename_script 
FROM INFORMATION_SCHEMA.COLUMNS  
WHERE TABLE_SCHEMA = 'vanthienhung_20210406' AND COLUMN_NAME = 'title_us';


ALTER TABLE db_sanpham RENAME COLUMN title_us TO title_en;
ALTER TABLE db_setting RENAME COLUMN title_us TO title_en;
ALTER TABLE db_extra RENAME COLUMN title_us TO title_en;
ALTER TABLE db_tintuc RENAME COLUMN title_us TO title_en;
ALTER TABLE db_category_old RENAME COLUMN title_us TO title_en;
ALTER TABLE db_slide_sp RENAME COLUMN title_us TO title_en;
ALTER TABLE db_gallery RENAME COLUMN title_us TO title_en;
ALTER TABLE db_sanpham_old RENAME COLUMN title_us TO title_en;
ALTER TABLE db_seo RENAME COLUMN title_us TO title_en;
ALTER TABLE db_category RENAME COLUMN title_us TO title_en;

ALTER TABLE `db_sanpham` CHANGE `extra0` `gear_type` varchar(255) COLLATE 'utf8_unicode_ci' NULL AFTER `hien_thi`;
ALTER TABLE `db_sanpham` CHANGE `extra1` `group_pos` varchar(255) COLLATE 'utf8_unicode_ci' NULL AFTER `gear_type`;

CREATE FUNCTION `convert_to_integer` (`v_input` text) RETURNS int(11)
BEGIN
DECLARE result INT;
declare exit handler for sqlexception
begin
  RETURN NULL;
end;
SET result = CAST(v_input AS INT);
RETURN result;
END;

UPDATE `db_sanpham` SET `extra2` = convert_to_integer(`extra2`);
ALTER TABLE `db_sanpham` CHANGE `extra2` `group_quantity` int(11) NULL AFTER `group_pos`;
UPDATE `db_sanpham` SET `extra3` = convert_to_integer(`extra3`);
ALTER TABLE `db_sanpham` CHANGE `extra3` `parent_number` int(11) NULL AFTER `group_quantity`;


SELECT CONCAT(
    'ALTER TABLE ', TABLE_NAME,
    ' CHANGE ', COLUMN_NAME,
    ' description_2',
    ' ', COLUMN_TYPE, ';') AS rename_script 
FROM INFORMATION_SCHEMA.COLUMNS  
WHERE TABLE_SCHEMA = 'vanthienhung_20210406' AND COLUMN_NAME = 'thong_tin_vn';


ALTER TABLE db_sanpham RENAME COLUMN thong_tin_vn TO description_2;

ALTER TABLE `db_sanpham`
ADD `is_service` bool NULL DEFAULT false,
ADD `is_deactive` bool NULL DEFAULT false AFTER `is_service`,
ADD `deactived_at` datetime NULL AFTER `is_deactive`,
ADD `warehouse_position` varchar(10) COLLATE 'utf8_general_ci' NULL AFTER `deactived_at`,
ADD `note` varchar(500) COLLATE 'utf8_general_ci' NULL AFTER `warehouse_position`,
ADD `created_at` datetime NULL AFTER `note`,
ADD `created_by` int NULL AFTER `created_at`,
ADD `updated_by` int NULL AFTER `created_by`;


--- TABLE CATEGORY
ALTER TABLE `db_category`
ADD `code` varchar(10) NULL,
ADD `created_at` datetime NULL AFTER `code`,
ADD `updated_at` datetime NULL AFTER `created_at`,
ADD `created_by` int NULL AFTER `updated_at`,
ADD `updated_by` int NULL AFTER `created_by`;


SELECT CONCAT(
    'ALTER TABLE ', TABLE_NAME,
    ' CHANGE ', COLUMN_NAME,
    ' content_vi',
    ' ', COLUMN_TYPE, ';') AS rename_script 
FROM INFORMATION_SCHEMA.COLUMNS  
WHERE TABLE_SCHEMA = 'vanthienhung_20210406' AND COLUMN_NAME = 'noi_dung_vn';

SELECT CONCAT(
    'ALTER TABLE ', TABLE_NAME,
    ' CHANGE ', COLUMN_NAME,
    ' content_en',
    ' ', COLUMN_TYPE, ';') AS rename_script 
FROM INFORMATION_SCHEMA.COLUMNS  
WHERE TABLE_SCHEMA = 'vanthienhung_20210406' AND COLUMN_NAME = 'noi_dung_us';

SELECT CONCAT(
    'ALTER TABLE ', TABLE_NAME,
    ' CHANGE ', COLUMN_NAME,
    ' content_ch',
    ' ', COLUMN_TYPE, ';') AS rename_script 
FROM INFORMATION_SCHEMA.COLUMNS  
WHERE TABLE_SCHEMA = 'vanthienhung_20210406' AND COLUMN_NAME = 'noi_dung_ch';

ALTER TABLE db_setting RENAME COLUMN noi_dung_vn TO content_vi;
ALTER TABLE db_hinhthucthanhtoan RENAME COLUMN noi_dung_vn TO content_vi;
ALTER TABLE db_tintuc RENAME COLUMN noi_dung_vn TO content_vi;
ALTER TABLE db_category_old RENAME COLUMN noi_dung_vn TO content_vi;
ALTER TABLE db_map RENAME COLUMN noi_dung_vn TO content_vi;
ALTER TABLE db_category RENAME COLUMN noi_dung_vn TO content_vi;


ALTER TABLE db_setting RENAME COLUMN noi_dung_us TO content_en;
ALTER TABLE db_tintuc RENAME COLUMN noi_dung_us TO content_en;
ALTER TABLE db_category_old RENAME COLUMN noi_dung_us TO content_en;
ALTER TABLE db_map RENAME COLUMN noi_dung_us TO content_en;
ALTER TABLE db_category RENAME COLUMN noi_dung_us TO content_en;

ALTER TABLE db_setting RENAME COLUMN noi_dung_ch TO content_ch;
ALTER TABLE db_tintuc RENAME COLUMN noi_dung_ch TO content_ch;
ALTER TABLE db_category_old RENAME COLUMN noi_dung_ch TO content_ch;
ALTER TABLE db_map RENAME COLUMN noi_dung_ch TO content_ch;
ALTER TABLE db_category RENAME COLUMN noi_dung_ch TO content_ch;


---- GROUP

ALTER TABLE `db_group`
ADD `code` varchar(10) NULL,
ADD `created_at` datetime NULL AFTER `code`,
ADD `updated_at` datetime NULL AFTER `created_at`,
ADD `created_by` int NULL AFTER `updated_at`,
ADD `updated_by` int NULL AFTER `created_by`;

---SEO
ALTER TABLE `db_seo`
CHANGE `keyword_vn` `keyword_vi` text COLLATE 'utf8_unicode_ci' NOT NULL AFTER `title_en`,
CHANGE `keyword_us` `keyword_en` text COLLATE 'utf8_unicode_ci' NOT NULL AFTER `keyword_vi`,
CHANGE `description_vn` `description_vi` text COLLATE 'utf8_unicode_ci' NOT NULL AFTER `keyword_en`,
CHANGE `description_us` `description_en` text COLLATE 'utf8_unicode_ci' NOT NULL AFTER `description_vi`;
