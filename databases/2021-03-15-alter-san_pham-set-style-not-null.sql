UPDATE db_sanpham SET style=0 WHERE style IS NULL
ALTER TABLE `db_sanpham`
CHANGE `style` `style` int(11) NOT NULL DEFAULT '0' AFTER `so_thu_tu`;
