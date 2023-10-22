UPDATE db_sanpham SET xuat_xu = 'Chính hãng' WHERE xuat_xu = '' OR xuat_xu IS NULL;
UPDATE db_sanpham SET bao_hanh = '12 Tháng' WHERE bao_hanh = '' OR bao_hanh IS NULL;
UPDATE db_sanpham SET khung_nang = 'Mới 100%' WHERE khung_nang = '' OR khung_nang IS NULL;
