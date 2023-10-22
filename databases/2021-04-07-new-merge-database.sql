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

SELECT CONCAT(
    'ALTER TABLE ', TABLE_NAME,
    ' CHANGE ', COLUMN_NAME,
    ' name_en',
    ' ', COLUMN_TYPE, ';') AS rename_script 
FROM INFORMATION_SCHEMA.COLUMNS  
WHERE TABLE_SCHEMA = 'vanthienhung_20210406' AND COLUMN_NAME = 'ten_us';

SELECT CONCAT(
    'ALTER TABLE ', TABLE_NAME,
    ' CHANGE ', COLUMN_NAME,
    ' name_ch',
    ' ', COLUMN_TYPE, ';') AS rename_script 
FROM INFORMATION_SCHEMA.COLUMNS  
WHERE TABLE_SCHEMA = 'vanthienhung_20210406' AND COLUMN_NAME = 'ten_ch';

**/

ALTER TABLE db_hinhthucthanhtoan CHANGE ten_vn name_vi varchar(255);
ALTER TABLE db_thanhpho CHANGE ten_vn name_vi varchar(255);
ALTER TABLE db_quan CHANGE ten_vn name_vi varchar(255);
ALTER TABLE binhduong_thuvienanh CHANGE ten_vn name_vi varchar(255);
ALTER TABLE hanoi_hotro CHANGE ten_vn name_vi varchar(255);
ALTER TABLE dongnai_file CHANGE ten_vn name_vi varchar(255);
ALTER TABLE binhduong_file CHANGE ten_vn name_vi varchar(255);
ALTER TABLE dongnai_hinhthucthanhtoan CHANGE ten_vn name_vi varchar(255);
ALTER TABLE bdcomvn_danhmuc_hoidap CHANGE ten_vn name_vi varchar(255);
ALTER TABLE dongnai_dknhamau CHANGE ten_vn name_vi varchar(255);
ALTER TABLE nguyenle_file CHANGE ten_vn name_vi varchar(255);
ALTER TABLE dongnai_tags CHANGE ten_vn name_vi varchar(255);
ALTER TABLE nguyenle_map CHANGE ten_vn name_vi text;
ALTER TABLE bdcomvn_dknhamau CHANGE ten_vn name_vi varchar(255);
ALTER TABLE bdcomvn_tintuc CHANGE ten_vn name_vi varchar(255);
ALTER TABLE binhduong_sanpham_old CHANGE ten_vn name_vi varchar(1000);
ALTER TABLE db_file CHANGE ten_vn name_vi varchar(255);
ALTER TABLE binhduong_map CHANGE ten_vn name_vi text;
ALTER TABLE binhduong_hotro CHANGE ten_vn name_vi varchar(255);
ALTER TABLE dongnai_danhmuc_hoidap CHANGE ten_vn name_vi varchar(255);
ALTER TABLE dongnai_thuvienanh CHANGE ten_vn name_vi varchar(255);
ALTER TABLE nguyenle_hinhthucthanhtoan CHANGE ten_vn name_vi varchar(255);
ALTER TABLE binhduong_tags CHANGE ten_vn name_vi varchar(255);
ALTER TABLE binhduong_dknhamau CHANGE ten_vn name_vi varchar(255);
ALTER TABLE db_tags CHANGE ten_vn name_vi varchar(255);

ALTER TABLE db_hinhthucthanhtoan CHANGE ten_us name_en varchar(255);
ALTER TABLE hanoi_hotro CHANGE ten_us name_en varchar(255);
ALTER TABLE dongnai_hinhthucthanhtoan CHANGE ten_us name_en varchar(255);
ALTER TABLE nguyenle_map CHANGE ten_us name_en text;
ALTER TABLE bdcomvn_tintuc CHANGE ten_us name_en varchar(255);
ALTER TABLE binhduong_sanpham_old CHANGE ten_us name_en varchar(255);
ALTER TABLE binhduong_map CHANGE ten_us name_en text;
ALTER TABLE binhduong_hotro CHANGE ten_us name_en varchar(255);
ALTER TABLE nguyenle_hinhthucthanhtoan CHANGE ten_us name_en varchar(255);
ALTER TABLE bdcomvn_hinhthucthanhtoan CHANGE ten_us name_en varchar(255);
ALTER TABLE bdcomvn_map CHANGE ten_us name_en text;
ALTER TABLE nguyenle_setting CHANGE ten_us name_en varchar(255);
ALTER TABLE db_sanpham CHANGE ten_us name_en varchar(255);
ALTER TABLE hanoi_tintuc CHANGE ten_us name_en varchar(255);
ALTER TABLE binhduong_setting CHANGE ten_us name_en varchar(255);
ALTER TABLE dongnai_map CHANGE ten_us name_en text;
ALTER TABLE nguyenle_tintuc CHANGE ten_us name_en varchar(255);
ALTER TABLE db_video CHANGE ten_us name_en varchar(255);
ALTER TABLE bdcomvn_setting CHANGE ten_us name_en varchar(255);
ALTER TABLE hanoi_video CHANGE ten_us name_en varchar(255);
ALTER TABLE db_map CHANGE ten_us name_en text;
ALTER TABLE nguyenle_video CHANGE ten_us name_en varchar(255);
ALTER TABLE dongnai_tintuc CHANGE ten_us name_en varchar(255);
ALTER TABLE dongnai_hotro CHANGE ten_us name_en varchar(255);
ALTER TABLE bdcomvn_video CHANGE ten_us name_en varchar(255);

ALTER TABLE hanoi_hotro CHANGE ten_ch name_ch varchar(255);
ALTER TABLE nguyenle_map CHANGE ten_ch name_ch text;
ALTER TABLE bdcomvn_tintuc CHANGE ten_ch name_ch text;
ALTER TABLE binhduong_sanpham_old CHANGE ten_ch name_ch text;
ALTER TABLE binhduong_map CHANGE ten_ch name_ch text;
ALTER TABLE binhduong_hotro CHANGE ten_ch name_ch varchar(255);
ALTER TABLE bdcomvn_map CHANGE ten_ch name_ch text;
ALTER TABLE nguyenle_setting CHANGE ten_ch name_ch text;
ALTER TABLE db_sanpham CHANGE ten_ch name_ch varchar(255);
ALTER TABLE hanoi_tintuc CHANGE ten_ch name_ch text;
ALTER TABLE binhduong_setting CHANGE ten_ch name_ch text;
ALTER TABLE dongnai_map CHANGE ten_ch name_ch text;
ALTER TABLE nguyenle_tintuc CHANGE ten_ch name_ch text;
ALTER TABLE bdcomvn_setting CHANGE ten_ch name_ch text;
ALTER TABLE db_map CHANGE ten_ch name_ch text;
ALTER TABLE dongnai_tintuc CHANGE ten_ch name_ch text;
ALTER TABLE dongnai_hotro CHANGE ten_ch name_ch varchar(255);
ALTER TABLE db_sanpham_old CHANGE ten_ch name_ch text;
ALTER TABLE dongnai_sanpham_old CHANGE ten_ch name_ch text;
ALTER TABLE db_hotro CHANGE ten_ch name_ch varchar(255);
ALTER TABLE hanoi_map CHANGE ten_ch name_ch text;
ALTER TABLE hanoi_setting CHANGE ten_ch name_ch text;
ALTER TABLE db_category CHANGE ten_ch name_ch text;
ALTER TABLE db_tintuc CHANGE ten_ch name_ch text;
ALTER TABLE nguyenle_hotro CHANGE ten_ch name_ch varchar(255);


ALTER TABLE db_sanpham RENAME COLUMN don_vi TO unit;
ALTER TABLE db_sanpham RENAME COLUMN gia_nhap TO cost;
ALTER TABLE db_sanpham RENAME COLUMN gia TO price;
ALTER TABLE db_sanpham RENAME COLUMN khuyen_mai TO promotion_price;
ALTER TABLE db_sanpham RENAME COLUMN tieu_bieu TO is_hot;

ALTER TABLE `db_sanpham` CHANGE `don_vi` `unit` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;



--- tieu_bieu to is_hot
SELECT CONCAT(
    'ALTER TABLE ', TABLE_NAME,
    ' CHANGE ', COLUMN_NAME,
    ' is_hot',
    ' ', COLUMN_TYPE, ';') AS rename_script 
FROM INFORMATION_SCHEMA.COLUMNS  
WHERE TABLE_SCHEMA = 'vanthienhung_20210406' AND COLUMN_NAME = 'tieu_bieu';


ALTER TABLE bdcomvn_tintuc CHANGE tieu_bieu is_hot tinyint(4);
ALTER TABLE binhduong_sanpham_old CHANGE tieu_bieu is_hot tinyint(1);
ALTER TABLE hanoi_tintuc CHANGE tieu_bieu is_hot tinyint(4);
ALTER TABLE nguyenle_tintuc CHANGE tieu_bieu is_hot tinyint(4);
ALTER TABLE dongnai_tintuc CHANGE tieu_bieu is_hot tinyint(4);
ALTER TABLE db_sanpham_old CHANGE tieu_bieu is_hot tinyint(1);
ALTER TABLE dongnai_sanpham_old CHANGE tieu_bieu is_hot tinyint(1);
ALTER TABLE db_category CHANGE tieu_bieu is_hot tinyint(1);
ALTER TABLE db_tintuc CHANGE tieu_bieu is_hot tinyint(4);
ALTER TABLE bdcomvn_sanpham_old CHANGE tieu_bieu is_hot tinyint(1);
ALTER TABLE binhduong_tintuc CHANGE tieu_bieu is_hot tinyint(4);
ALTER TABLE hanoi_sanpham_old CHANGE tieu_bieu is_hot tinyint(1);
ALTER TABLE nguyenle_sanpham_old CHANGE tieu_bieu is_hot tinyint(1);

SELECT CONCAT(
    'ALTER TABLE ', TABLE_NAME,
    ' CHANGE ', COLUMN_NAME,
    ' specification',
    ' ', COLUMN_TYPE, ';') AS rename_script 
FROM INFORMATION_SCHEMA.COLUMNS  
WHERE TABLE_SCHEMA = 'vanthienhung_20210406' AND COLUMN_NAME = 'serial';

ALTER TABLE binhduong_sanpham_old CHANGE serial specification varchar(255);
ALTER TABLE db_sanpham CHANGE serial specification varchar(255);
ALTER TABLE bdcomvn_baohanh CHANGE serial specification varchar(255);
ALTER TABLE dongnai_baohanh CHANGE serial specification varchar(255);
ALTER TABLE hanoi_baohanh CHANGE serial specification varchar(255);
ALTER TABLE nguyenle_baohanh CHANGE serial specification varchar(255);
ALTER TABLE db_sanpham_old CHANGE serial specification varchar(255);
ALTER TABLE dongnai_sanpham_old CHANGE serial specification varchar(255);
ALTER TABLE db_sanpham_new CHANGE serial specification varchar(255);
ALTER TABLE db_baohanh CHANGE serial specification varchar(255);
ALTER TABLE bdcomvn_sanpham_old CHANGE serial specification varchar(255);
ALTER TABLE hanoi_sanpham_old CHANGE serial specification varchar(255);
ALTER TABLE nguyenle_sanpham_old CHANGE serial specification varchar(255);
ALTER TABLE binhduong_baohanh CHANGE serial specification varchar(255);

ALTER TABLE db_sanpham RENAME COLUMN tai_trong TO weight;
ALTER TABLE db_sanpham RENAME COLUMN nam TO mfg_year;


SELECT CONCAT(
    'ALTER TABLE ', TABLE_NAME,
    ' CHANGE ', COLUMN_NAME,
    ' description_vi',
    ' ', COLUMN_TYPE, ';') AS rename_script 
FROM INFORMATION_SCHEMA.COLUMNS  
WHERE TABLE_SCHEMA = 'vanthienhung_20210406' AND COLUMN_NAME = 'mo_ta_vn';

ALTER TABLE hanoi_hotro CHANGE mo_ta_vn description_vi text;
ALTER TABLE nguyenle_map CHANGE mo_ta_vn description_vi text;
ALTER TABLE bdcomvn_tintuc CHANGE mo_ta_vn description_vi text;
ALTER TABLE binhduong_sanpham_old CHANGE mo_ta_vn description_vi text;
ALTER TABLE binhduong_map CHANGE mo_ta_vn description_vi text;
ALTER TABLE binhduong_hotro CHANGE mo_ta_vn description_vi text;
ALTER TABLE bdcomvn_map CHANGE mo_ta_vn description_vi text;
ALTER TABLE nguyenle_slide_sp CHANGE mo_ta_vn description_vi varchar(255);
ALTER TABLE db_sanpham CHANGE mo_ta_vn description_vi text;
ALTER TABLE hanoi_tintuc CHANGE mo_ta_vn description_vi text;
ALTER TABLE dongnai_map CHANGE mo_ta_vn description_vi text;
ALTER TABLE nguyenle_tintuc CHANGE mo_ta_vn description_vi text;
ALTER TABLE db_slide_sp CHANGE mo_ta_vn description_vi varchar(255);
ALTER TABLE db_map CHANGE mo_ta_vn description_vi text;
ALTER TABLE bdcomvn_slide_sp CHANGE mo_ta_vn description_vi varchar(255);
ALTER TABLE dongnai_tintuc CHANGE mo_ta_vn description_vi text;
ALTER TABLE dongnai_hotro CHANGE mo_ta_vn description_vi text;
ALTER TABLE db_sanpham_old CHANGE mo_ta_vn description_vi text;
ALTER TABLE dongnai_sanpham_old CHANGE mo_ta_vn description_vi text;
ALTER TABLE db_hotro CHANGE mo_ta_vn description_vi text;
ALTER TABLE hanoi_map CHANGE mo_ta_vn description_vi text;
ALTER TABLE hanoi_slide_sp CHANGE mo_ta_vn description_vi varchar(255);
ALTER TABLE db_category CHANGE mo_ta_vn description_vi text;
ALTER TABLE db_tintuc CHANGE mo_ta_vn description_vi text;
ALTER TABLE nguyenle_hotro CHANGE mo_ta_vn description_vi text;

SELECT CONCAT(
    'ALTER TABLE ', TABLE_NAME,
    ' CHANGE ', COLUMN_NAME,
    ' alias_vi',
    ' ', COLUMN_TYPE, ';') AS rename_script 
FROM INFORMATION_SCHEMA.COLUMNS  
WHERE TABLE_SCHEMA = 'vanthienhung_20210406' AND COLUMN_NAME = 'alias_vn';

ALTER TABLE bdcomvn_danhmuc_hoidap CHANGE alias_vn alias_vi varchar(255);
ALTER TABLE bdcomvn_tintuc CHANGE alias_vn alias_vi varchar(255);
ALTER TABLE binhduong_sanpham_old CHANGE alias_vn alias_vi varchar(255);
ALTER TABLE dongnai_danhmuc_hoidap CHANGE alias_vn alias_vi varchar(255);
ALTER TABLE db_sanpham CHANGE alias_vn alias_vi varchar(255);
ALTER TABLE hanoi_tintuc CHANGE alias_vn alias_vi varchar(255);
ALTER TABLE nguyenle_tintuc CHANGE alias_vn alias_vi varchar(255);
ALTER TABLE db_danhmuc_hoidap CHANGE alias_vn alias_vi varchar(255);
ALTER TABLE binhduong_danhmuc_hoidap CHANGE alias_vn alias_vi varchar(255);
ALTER TABLE nguyenle_danhmuc_hoidap CHANGE alias_vn alias_vi varchar(255);
ALTER TABLE dongnai_tintuc CHANGE alias_vn alias_vi varchar(255);
ALTER TABLE db_sanpham_old CHANGE alias_vn alias_vi varchar(255);
ALTER TABLE dongnai_sanpham_old CHANGE alias_vn alias_vi varchar(255);
ALTER TABLE db_sanpham_new CHANGE alias_vn alias_vi varchar(255);
ALTER TABLE hanoi_danhmuc_hoidap CHANGE alias_vn alias_vi varchar(255);
ALTER TABLE db_category CHANGE alias_vn alias_vi varchar(255);
ALTER TABLE db_tintuc CHANGE alias_vn alias_vi varchar(255);
ALTER TABLE bdcomvn_sanpham_old CHANGE alias_vn alias_vi varchar(255);
ALTER TABLE binhduong_tintuc CHANGE alias_vn alias_vi varchar(255);
ALTER TABLE hanoi_sanpham_old CHANGE alias_vn alias_vi varchar(255);
ALTER TABLE nguyenle_sanpham_old CHANGE alias_vn alias_vi varchar(255);


SELECT CONCAT(
    'ALTER TABLE ', TABLE_NAME,
    ' CHANGE ', COLUMN_NAME,
    ' alias_en',
    ' ', COLUMN_TYPE, ';') AS rename_script 
FROM INFORMATION_SCHEMA.COLUMNS  
WHERE TABLE_SCHEMA = 'vanthienhung_20210406' AND COLUMN_NAME = 'alias_us';

ALTER TABLE bdcomvn_tintuc CHANGE alias_us alias_en varchar(255);
ALTER TABLE binhduong_sanpham_old CHANGE alias_us alias_en varchar(255);
ALTER TABLE db_sanpham CHANGE alias_us alias_en varchar(255);
ALTER TABLE hanoi_tintuc CHANGE alias_us alias_en varchar(255);
ALTER TABLE nguyenle_tintuc CHANGE alias_us alias_en varchar(255);
ALTER TABLE dongnai_tintuc CHANGE alias_us alias_en varchar(255);
ALTER TABLE db_sanpham_old CHANGE alias_us alias_en varchar(255);
ALTER TABLE dongnai_sanpham_old CHANGE alias_us alias_en varchar(255);
ALTER TABLE db_sanpham_new CHANGE alias_us alias_en varchar(255);
ALTER TABLE db_category CHANGE alias_us alias_en varchar(255);
ALTER TABLE db_tintuc CHANGE alias_us alias_en varchar(255);
ALTER TABLE bdcomvn_sanpham_old CHANGE alias_us alias_en varchar(255);
ALTER TABLE binhduong_tintuc CHANGE alias_us alias_en varchar(255);
ALTER TABLE hanoi_sanpham_old CHANGE alias_us alias_en varchar(255);
ALTER TABLE nguyenle_sanpham_old CHANGE alias_us alias_en varchar(255);

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

ALTER TABLE hanoi_hotro CHANGE mo_ta_us description_en text;
ALTER TABLE nguyenle_map CHANGE mo_ta_us description_en text;
ALTER TABLE bdcomvn_tintuc CHANGE mo_ta_us description_en text;
ALTER TABLE binhduong_sanpham_old CHANGE mo_ta_us description_en text;
ALTER TABLE binhduong_map CHANGE mo_ta_us description_en text;
ALTER TABLE binhduong_hotro CHANGE mo_ta_us description_en text;
ALTER TABLE bdcomvn_map CHANGE mo_ta_us description_en text;
ALTER TABLE nguyenle_slide_sp CHANGE mo_ta_us description_en varchar(255);
ALTER TABLE db_sanpham CHANGE mo_ta_us description_en text;
ALTER TABLE hanoi_tintuc CHANGE mo_ta_us description_en text;
ALTER TABLE dongnai_map CHANGE mo_ta_us description_en text;
ALTER TABLE nguyenle_tintuc CHANGE mo_ta_us description_en text;
ALTER TABLE db_slide_sp CHANGE mo_ta_us description_en varchar(255);
ALTER TABLE db_map CHANGE mo_ta_us description_en text;
ALTER TABLE bdcomvn_slide_sp CHANGE mo_ta_us description_en varchar(255);
ALTER TABLE dongnai_tintuc CHANGE mo_ta_us description_en text;
ALTER TABLE dongnai_hotro CHANGE mo_ta_us description_en text;
ALTER TABLE db_sanpham_old CHANGE mo_ta_us description_en text;
ALTER TABLE dongnai_sanpham_old CHANGE mo_ta_us description_en text;
ALTER TABLE db_hotro CHANGE mo_ta_us description_en text;
ALTER TABLE hanoi_map CHANGE mo_ta_us description_en text;
ALTER TABLE hanoi_slide_sp CHANGE mo_ta_us description_en varchar(255);
ALTER TABLE db_category CHANGE mo_ta_us description_en text;
ALTER TABLE db_tintuc CHANGE mo_ta_us description_en text;
ALTER TABLE nguyenle_hotro CHANGE mo_ta_us description_en text;

SELECT CONCAT(
    'ALTER TABLE ', TABLE_NAME,
    ' CHANGE ', COLUMN_NAME,
    ' description_ch',
    ' ', COLUMN_TYPE, ';') AS rename_script 
FROM INFORMATION_SCHEMA.COLUMNS  
WHERE TABLE_SCHEMA = 'vanthienhung_20210406' AND COLUMN_NAME = 'mo_ta_ch';

ALTER TABLE nguyenle_map CHANGE mo_ta_ch description_ch text;
ALTER TABLE bdcomvn_tintuc CHANGE mo_ta_ch description_ch text;
ALTER TABLE binhduong_sanpham_old CHANGE mo_ta_ch description_ch text;
ALTER TABLE binhduong_map CHANGE mo_ta_ch description_ch text;
ALTER TABLE bdcomvn_map CHANGE mo_ta_ch description_ch text;
ALTER TABLE db_sanpham CHANGE mo_ta_ch description_ch text;
ALTER TABLE hanoi_tintuc CHANGE mo_ta_ch description_ch text;
ALTER TABLE dongnai_map CHANGE mo_ta_ch description_ch text;
ALTER TABLE nguyenle_tintuc CHANGE mo_ta_ch description_ch text;
ALTER TABLE db_map CHANGE mo_ta_ch description_ch text;
ALTER TABLE dongnai_tintuc CHANGE mo_ta_ch description_ch text;
ALTER TABLE db_sanpham_old CHANGE mo_ta_ch description_ch text;
ALTER TABLE dongnai_sanpham_old CHANGE mo_ta_ch description_ch text;
ALTER TABLE hanoi_map CHANGE mo_ta_ch description_ch text;
ALTER TABLE db_category CHANGE mo_ta_ch description_ch text;
ALTER TABLE db_tintuc CHANGE mo_ta_ch description_ch text;
ALTER TABLE bdcomvn_sanpham_old CHANGE mo_ta_ch description_ch text;
ALTER TABLE binhduong_tintuc CHANGE mo_ta_ch description_ch text;
ALTER TABLE hanoi_sanpham_old CHANGE mo_ta_ch description_ch text;
ALTER TABLE nguyenle_sanpham_old CHANGE mo_ta_ch description_ch text;

SELECT CONCAT(
    'ALTER TABLE ', TABLE_NAME,
    ' CHANGE ', COLUMN_NAME,
    ' image_path',
    ' ', COLUMN_TYPE, ';') AS rename_script 
FROM INFORMATION_SCHEMA.COLUMNS  
WHERE TABLE_SCHEMA = 'vanthienhung_20210406' AND COLUMN_NAME = 'hinh_anh';

ALTER TABLE binhduong_sanpham_hinhanh CHANGE hinh_anh image_path varchar(255);
ALTER TABLE binhduong_thuvienanh CHANGE hinh_anh image_path varchar(255);
ALTER TABLE hanoi_hotro CHANGE hinh_anh image_path varchar(255);
ALTER TABLE bdcomvn_baiviet_hinhanh CHANGE hinh_anh image_path varchar(255);
ALTER TABLE bdcomvn_tintuc CHANGE hinh_anh image_path varchar(255);
ALTER TABLE binhduong_sanpham_old CHANGE hinh_anh image_path varchar(255);
ALTER TABLE binhduong_hotro CHANGE hinh_anh image_path varchar(255);
ALTER TABLE bdcomvn_thongtin CHANGE hinh_anh image_path varchar(255);
ALTER TABLE binhduong_thongtin CHANGE hinh_anh image_path varchar(255);
ALTER TABLE dongnai_thuvienanh CHANGE hinh_anh image_path varchar(255);
ALTER TABLE hanoi_baiviet_hinhanh CHANGE hinh_anh image_path varchar(255);
ALTER TABLE dongnai_thongtin CHANGE hinh_anh image_path varchar(255);
ALTER TABLE dongnai_baiviet_hinhanh CHANGE hinh_anh image_path varchar(255);
ALTER TABLE db_baiviet_hinhanh CHANGE hinh_anh image_path varchar(255);
ALTER TABLE nguyenle_slide_sp CHANGE hinh_anh image_path varchar(255);
ALTER TABLE nguyenle_setting CHANGE hinh_anh image_path varchar(255);
ALTER TABLE db_sanpham CHANGE hinh_anh image_path varchar(255);
ALTER TABLE hanoi_tintuc CHANGE hinh_anh image_path varchar(255);
ALTER TABLE nguyenle_thongtin CHANGE hinh_anh image_path varchar(255);
ALTER TABLE binhduong_setting CHANGE hinh_anh image_path varchar(255);
ALTER TABLE nguyenle_tintuc CHANGE hinh_anh image_path varchar(255);
ALTER TABLE db_slide_sp CHANGE hinh_anh image_path varchar(255);
ALTER TABLE bdcomvn_thuvienanh CHANGE hinh_anh image_path varchar(255);
ALTER TABLE bdcomvn_setting CHANGE hinh_anh image_path varchar(255);
ALTER TABLE hanoi_thongtin CHANGE hinh_anh image_path varchar(255);

SELECT CONCAT(
    'ALTER TABLE ', TABLE_NAME,
    ' CHANGE ', COLUMN_NAME,
    ' content_en',
    ' ', COLUMN_TYPE, ';') AS rename_script 
FROM INFORMATION_SCHEMA.COLUMNS  
WHERE TABLE_SCHEMA = 'vanthienhung_20210406' AND COLUMN_NAME = 'thong_tin_us';

ALTER TABLE binhduong_sanpham_old CHANGE thong_tin_us content_en text;
ALTER TABLE db_sanpham CHANGE thong_tin_us content_en mediumtext;
ALTER TABLE db_sanpham_old CHANGE thong_tin_us content_en text;
ALTER TABLE dongnai_sanpham_old CHANGE thong_tin_us content_en text;
ALTER TABLE bdcomvn_sanpham_old CHANGE thong_tin_us content_en text;
ALTER TABLE hanoi_sanpham_old CHANGE thong_tin_us content_en text;
ALTER TABLE nguyenle_sanpham_old CHANGE thong_tin_us content_en text;
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

ALTER TABLE bdcomvn_seo CHANGE title_vn title_vi varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE bdcomvn_gallery CHANGE title_vn title_vi varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE bdcomvn_tintuc CHANGE title_vn title_vi varchar(255);
ALTER TABLE binhduong_sanpham_old CHANGE title_vn title_vi varchar(255);
ALTER TABLE dongnai_danhmuc_hoidap CHANGE title_vn title_vi varchar(255);
ALTER TABLE db_seo CHANGE title_vn title_vi varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE nguyenle_slide_sp CHANGE title_vn title_vi varchar(255);
ALTER TABLE nguyenle_setting CHANGE title_vn title_vi varchar(255);
ALTER TABLE db_sanpham CHANGE title_vn title_vi varchar(255);
ALTER TABLE hanoi_tintuc CHANGE title_vn title_vi varchar(255);
ALTER TABLE db_gallery CHANGE title_vn title_vi varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE binhduong_seo CHANGE title_vn title_vi varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE binhduong_setting CHANGE title_vn title_vi varchar(255);
ALTER TABLE db_extra CHANGE title_vn title_vi varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE nguyenle_tintuc CHANGE title_vn title_vi varchar(255);
ALTER TABLE db_slide_sp CHANGE title_vn title_vi varchar(255);
ALTER TABLE binhduong_extra CHANGE title_vn title_vi varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE db_danhmuc_hoidap CHANGE title_vn title_vi varchar(255);
ALTER TABLE bdcomvn_setting CHANGE title_vn title_vi varchar(255);
ALTER TABLE hanoi_gallery CHANGE title_vn title_vi varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE binhduong_danhmuc_hoidap CHANGE title_vn title_vi varchar(255);
ALTER TABLE nguyenle_gallery CHANGE title_vn title_vi varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE dongnai_seo CHANGE title_vn title_vi varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE dongnai_extra CHANGE title_vn title_vi varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE bdcomvn_slide_sp CHANGE title_vn title_vi varchar(255);
ALTER TABLE hanoi_extra CHANGE title_vn title_vi varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE nguyenle_danhmuc_hoidap CHANGE title_vn title_vi varchar(255);
ALTER TABLE dongnai_tintuc CHANGE title_vn title_vi varchar(255);
ALTER TABLE db_sanpham_old CHANGE title_vn title_vi varchar(255);
ALTER TABLE dongnai_sanpham_old CHANGE title_vn title_vi varchar(255);
ALTER TABLE hanoi_setting CHANGE title_vn title_vi varchar(255);
ALTER TABLE hanoi_slide_sp CHANGE title_vn title_vi varchar(255);
ALTER TABLE hanoi_danhmuc_hoidap CHANGE title_vn title_vi varchar(255);
ALTER TABLE db_category CHANGE title_vn title_vi varchar(255);
ALTER TABLE db_tintuc CHANGE title_vn title_vi varchar(255);
ALTER TABLE hanoi_seo CHANGE title_vn title_vi varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE bdcomvn_sanpham_old CHANGE title_vn title_vi varchar(255);
ALTER TABLE binhduong_tintuc CHANGE title_vn title_vi varchar(255);
ALTER TABLE hanoi_sanpham_old CHANGE title_vn title_vi varchar(255);
ALTER TABLE nguyenle_sanpham_old CHANGE title_vn title_vi varchar(255);
ALTER TABLE dongnai_setting CHANGE title_vn title_vi varchar(255);
ALTER TABLE db_setting CHANGE title_vn title_vi varchar(255);
ALTER TABLE binhduong_gallery CHANGE title_vn title_vi varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE dongnai_gallery CHANGE title_vn title_vi varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE bdcomvn_extra CHANGE title_vn title_vi varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE binhduong_slide_sp CHANGE title_vn title_vi varchar(255);
ALTER TABLE nguyenle_extra CHANGE title_vn title_vi varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE dongnai_slide_sp CHANGE title_vn title_vi varchar(255);


SELECT CONCAT(
    'ALTER TABLE ', TABLE_NAME,
    ' CHANGE ', COLUMN_NAME,
    ' title_en',
    ' ', COLUMN_TYPE, ';') AS rename_script 
FROM INFORMATION_SCHEMA.COLUMNS  
WHERE TABLE_SCHEMA = 'vanthienhung_20210406' AND COLUMN_NAME = 'title_us';


ALTER TABLE nguyenle_seo CHANGE title_us title_en varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE bdcomvn_seo CHANGE title_us title_en varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE bdcomvn_gallery CHANGE title_us title_en varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE bdcomvn_tintuc CHANGE title_us title_en varchar(255);
ALTER TABLE binhduong_sanpham_old CHANGE title_us title_en varchar(255);
ALTER TABLE db_seo CHANGE title_us title_en varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE nguyenle_slide_sp CHANGE title_us title_en varchar(255);
ALTER TABLE nguyenle_setting CHANGE title_us title_en varchar(255);
ALTER TABLE db_sanpham CHANGE title_us title_en varchar(255);
ALTER TABLE hanoi_tintuc CHANGE title_us title_en varchar(255);
ALTER TABLE db_gallery CHANGE title_us title_en varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE binhduong_seo CHANGE title_us title_en varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE binhduong_setting CHANGE title_us title_en varchar(255);
ALTER TABLE db_extra CHANGE title_us title_en varchar(255);
ALTER TABLE nguyenle_tintuc CHANGE title_us title_en varchar(255);
ALTER TABLE db_slide_sp CHANGE title_us title_en varchar(255);
ALTER TABLE binhduong_extra CHANGE title_us title_en varchar(255);
ALTER TABLE bdcomvn_setting CHANGE title_us title_en varchar(255);
ALTER TABLE hanoi_gallery CHANGE title_us title_en varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE nguyenle_gallery CHANGE title_us title_en varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE dongnai_seo CHANGE title_us title_en varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE dongnai_extra CHANGE title_us title_en varchar(255);
ALTER TABLE bdcomvn_slide_sp CHANGE title_us title_en varchar(255);
ALTER TABLE hanoi_extra CHANGE title_us title_en varchar(255);
ALTER TABLE dongnai_tintuc CHANGE title_us title_en varchar(255);
ALTER TABLE db_sanpham_old CHANGE title_us title_en varchar(255);
ALTER TABLE dongnai_sanpham_old CHANGE title_us title_en varchar(255);
ALTER TABLE hanoi_setting CHANGE title_us title_en varchar(255);
ALTER TABLE hanoi_slide_sp CHANGE title_us title_en varchar(255);
ALTER TABLE db_category CHANGE title_us title_en varchar(255);
ALTER TABLE db_tintuc CHANGE title_us title_en varchar(255);
ALTER TABLE hanoi_seo CHANGE title_us title_en varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE bdcomvn_sanpham_old CHANGE title_us title_en varchar(255);
ALTER TABLE binhduong_tintuc CHANGE title_us title_en varchar(255);
ALTER TABLE hanoi_sanpham_old CHANGE title_us title_en varchar(255);
ALTER TABLE nguyenle_sanpham_old CHANGE title_us title_en varchar(255);
ALTER TABLE dongnai_setting CHANGE title_us title_en varchar(255);
ALTER TABLE db_setting CHANGE title_us title_en varchar(255);
ALTER TABLE binhduong_gallery CHANGE title_us title_en varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE dongnai_gallery CHANGE title_us title_en varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE bdcomvn_extra CHANGE title_us title_en varchar(255);
ALTER TABLE binhduong_slide_sp CHANGE title_us title_en varchar(255);
ALTER TABLE nguyenle_extra CHANGE title_us title_en varchar(255);
ALTER TABLE dongnai_slide_sp CHANGE title_us title_en varchar(255);

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

-- CREATE FUNCTION `convert_to_integer`(`v_input` TEXT) RETURNS INT NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER BEGIN
-- DECLARE result INT;
-- declare exit handler for sqlexception
-- begin
--   RETURN NULL;
-- end;
-- SET result = CAST(v_input AS INT);
-- RETURN result;
-- END;

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


ALTER TABLE bdcomvn_widget CHANGE name_us name_en  varchar(255);
ALTER TABLE db_widget CHANGE name_us name_en  varchar(255);
ALTER TABLE dongnai_widget CHANGE name_us name_en  varchar(255);
ALTER TABLE hanoi_widget CHANGE name_us name_en  varchar(255);
ALTER TABLE binhduong_widget CHANGE name_us name_en  varchar(255);
ALTER TABLE nguyenle_widget CHANGE name_us name_en  varchar(255);
ALTER TABLE db_brand_group CHANGE name_us name_en  varchar(255);

ALTER TABLE bdcomvn_widget CHANGE content_vn content_vi  longtext;
ALTER TABLE db_widget CHANGE content_vn content_vi  longtext;
ALTER TABLE dongnai_widget CHANGE content_vn content_vi  longtext;
ALTER TABLE hanoi_widget CHANGE content_vn content_vi  longtext;
ALTER TABLE binhduong_widget CHANGE content_vn content_vi  longtext;
ALTER TABLE nguyenle_widget CHANGE content_vn content_vi  longtext;

ALTER TABLE bdcomvn_widget CHANGE content_us content_en  longtext;
ALTER TABLE db_widget CHANGE content_us content_en  longtext;
ALTER TABLE dongnai_widget CHANGE content_us content_en  longtext;
ALTER TABLE hanoi_widget CHANGE content_us content_en  longtext;
ALTER TABLE binhduong_widget CHANGE content_us content_en  longtext;
ALTER TABLE nguyenle_widget CHANGE content_us content_en  longtext;
