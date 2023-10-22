UPDATE db_sanpham
INNER JOIN db_brand ON db_sanpham.brand_id = db_brand.id
SET db_sanpham.brand = db_brand.name
WHERE (db_sanpham.brand IS NULL OR db_sanpham.brand <> '') AND db_sanpham.brand_id IS NOT NULL;
