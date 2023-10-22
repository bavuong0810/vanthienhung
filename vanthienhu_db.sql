-- MySQL dump 10.13  Distrib 5.5.31, for Linux (x86_64)
--
-- Host: localhost    Database: vanthienhu_db
-- ------------------------------------------------------
-- Server version	5.5.31

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `db_baiviet_hinhanh`
--

DROP TABLE IF EXISTS `db_baiviet_hinhanh`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_baiviet_hinhanh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `id_baiviet` int(11) NOT NULL,
  `hinh_anh` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_baiviet_hinhanh`
--

LOCK TABLES `db_baiviet_hinhanh` WRITE;
/*!40000 ALTER TABLE `db_baiviet_hinhanh` DISABLE KEYS */;
INSERT INTO `db_baiviet_hinhanh` VALUES (1,'',495,'798323657107_avatar1.png');
/*!40000 ALTER TABLE `db_baiviet_hinhanh` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_category`
--

DROP TABLE IF EXISTS `db_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_loai` int(11) NOT NULL,
  `alias_vn` varchar(255) NOT NULL,
  `alias_us` varchar(255) NOT NULL,
  `alias_ch` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ten_vn` varchar(255) NOT NULL,
  `ten_us` varchar(255) NOT NULL,
  `ten_ch` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mo_ta_vn` text NOT NULL,
  `mo_ta_us` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mo_ta_ch` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung_vn` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung_us` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung_ch` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hinh_anh` varchar(255) NOT NULL,
  `so_thu_tu` int(11) NOT NULL,
  `title_vn` varchar(255) NOT NULL,
  `title_us` varchar(255) NOT NULL,
  `title_ch` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `des` text NOT NULL,
  `hien_thi` tinyint(1) NOT NULL,
  `tieu_bieu` tinyint(1) NOT NULL,
  `menu` tinyint(1) NOT NULL,
  `module` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1181 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_category`
--

LOCK TABLES `db_category` WRITE;
/*!40000 ALTER TABLE `db_category` DISABLE KEYS */;
INSERT INTO `db_category` VALUES (1117,0,'doi-tac','','','Đối tác','','','','','','','','','',12,'Đối tác','','','','',1,0,0,1,0),(105,0,'lien-he','contacts','聯繫我們','Liên hệ','Contacts','聯繫我們','','','','','','','',10,'Liên hệ','','','','',1,1,0,5,0),(106,0,'gio-hang','gio-hang','','Giỏ hàng','Giỏ hàng','','','','','','','','',7,'Giỏ hàng','Giỏ hàng','','','',1,0,0,7,0),(1026,0,'tin-tuc','news','新聞','Tin tức','News','新聞','','','','','','','',6,'Tin tức','','','','',1,1,0,2,0),(1040,0,'gioi-thieu','about-us','介紹','Giới thiệu','About us','介紹','','','','','','','',1,'Giới thiệu','','','','',1,1,0,2,0),(1098,0,'cho-thue-xe-nang','forklift-rental','叉車租賃','Cho thuê xe nâng','Forklift rental','叉車租賃','','','','','','','',2,'Cho thuê xe nâng','','','','',1,1,0,3,0),(1113,0,'xe-nang-hang','forklift','叉車','Xe nâng hàng','Forklift','叉車','','','','','','','',4,'Xe nâng hàng','','','','',1,1,0,3,0),(1112,0,'chinh-sach','','','Chính sách','','','','','','','','','',11,'Chính sách','','','','',1,0,0,2,0),(1118,0,'sua-chua-xe-nang','forklift-maintenance','叉車維護','Sửa chữa xe nâng','Forklift maintenance','叉車維護','','','','','','','',3,'Sửa chữa xe nâng','','','','',1,1,0,3,0),(1119,0,'phu-tung-xe-nang','forklift-accessories','叉車配件','Phụ tùng xe nâng','Forklift accessories','叉車配件','','','','','','','',5,'Phụ tùng xe nâng','','','','',1,1,0,3,0),(1120,1113,'xe-nang-dau-diesel-','diesel-forklift','柴油叉車','Xe Nâng Dầu (Diesel)','Diesel Forklift','柴油叉車','','','','','','','',11,'Xe Nâng Dầu (Diesel)','','','','',1,0,0,3,1),(1121,1113,'xe-nang-hang-toyota','toyota-forklift','豐田叉車','Xe Nâng Hàng Toyota','Toyota Forklift','豐田叉車','','','','','','','',12,'Xe Nâng Hàng Toyota','','','','',1,0,0,3,1),(1122,1113,'xe-nang-tay','hand-pallet-truck','舉手','Xe Nâng Tay','Hand pallet truck','舉手','','','','','','','7i7c9atn6m4e5m7npvcxleslb421199124939.jpg',13,'Xe Nâng Tay','','','','',1,0,0,3,1),(1123,1113,'xe-nang-dien','electric-forklift','電動叉車','Xe Nâng Điện','Electric Forklift','電動叉車','','','','','','','',14,'Xe Nâng Điện','','','','',1,0,0,3,1),(1124,1113,'xe-nang-gas-xang','forklift-gasoline-forklift','叉車-汽油叉車','Xe Nâng Gas/Xăng','Forklift / Gasoline Forklift','叉車/汽油叉車','','','','','','','',15,'Xe Nâng Gas/Xăng','','','','',1,0,0,3,1),(1125,1113,'xe-nang-hang-komatsu','komatsu-forklift','小松叉車','Xe Nâng Hàng Komatsu','Komatsu Forklift','小松叉車','','','','','','','',16,'Xe Nâng Hàng Komatsu','','','','',1,0,0,3,1),(1137,1113,'phu-tung-xe-nang-tay','','','Phụ tùng xe nâng tay','','','','','','','','','',28,'Phụ tùng xe nâng tay','','','','',1,0,0,3,1),(1174,1165,'bom-nuoc-7','water-pump-2','水泵总成--6','Bơm nước','Water Pump','水泵总成 ','','','','','','','',54,'Bơm nước','','','','',1,0,0,3,2),(1173,1163,'cang--9','brake-shoe-8','制动蹄片-4','Càng Bố Thắng','BRAKE SHOE','制动蹄片','','','','','','','',56,'Càng ','','','','',1,0,0,3,2),(1180,1153,'banh-da-xe-nang-3','','飞轮齿圈总成-7','Bánh đà xe nâng','Flywheel assy','飞轮齿圈总成','','','','','','','',51,'Bánh đà xe nâng','','','','',1,0,0,3,2),(1179,1159,'bom-nhot-hop-so','charging-pump','供油泵','Bơm nhớt hợp số','Charging Pump','供油泵','','','','','','','',51,'Bơm nhớt hợp số','','','','',1,0,0,3,2),(1177,1166,'den-pha-xe-nang-1','head-lamp-assy','前转向灯总成-2','Đèn pha xe nâng','Head lamp assy','前转向灯总成','','','','','','','',51,'Đèn pha xe nâng','','','','',1,0,0,3,2),(1176,1153,'bom-nhot-dong-co-0','oil-pump-5','机油泵-8','Bơm nhớt động cơ','Oil pump','机油泵','','','','','','','',52,'Bơm nhớt động cơ','','','','',1,0,0,3,2),(1175,1171,'mam-xe-nang-9','rim-front-weel','轮辋-5','Mâm xe nâng','Rim,front weel','轮辋','','','','','','','',52,'Mâm xe nâng','','','','',1,0,0,3,2),(1150,1098,'xe-nang-toyota','','xe-nang-toyota','xe nâng toyota','xe nâng toyota','xe nâng toyota','','','','','','','',37,'xe nâng toyota','','','','',1,0,0,3,1),(1148,1118,'','','','Sửa xe nâng','sửa xe nâng','sửa xe nâng','','','','','','','',36,'','','','','',1,0,0,3,1),(1149,1118,'bao-tri-xe-nang','','','Bảo trì xe nâng','','','','','','','','','',37,'Bảo trì xe nâng','','','','',1,0,0,3,1),(1151,1098,'xe-nang-tcm','xe-nang-tcm','xe-nang-tcm','xe nâng TCM','xe nâng TCM','xe nâng TCM','','','','','','','',38,'xe nâng TCM','','','','',1,0,0,3,1),(1154,1151,'xe-nang-tcm-0','','','xe nâng tcm','','','','','','','','','',40,'xe nâng tcm','','','','',1,0,0,3,2),(1153,1119,'he-thong-dong-co','engine-system','发动机系统','Hệ thống động cơ','Engine system','发动机系统','','','','','','','',40,'Hệ thống động cơ','','','','',1,0,0,3,1),(1155,1153,'bom-nhot-dong-co-3','','','Bơm nhớt động cơ','','','','','','','','','',41,'Bơm nhớt động cơ','','','','',1,0,0,3,2),(1156,1153,'de','starter','启动马达总成','Đề xe nâng','STARTER','启动马达总成','','','','','','','',42,'Đề','','','','',1,0,0,3,2),(1157,1153,'may-phat-dien-6','','','Máy phát điện','Alternator','发电机总成','','','','','','','',43,'Máy phát điện','','','','',1,0,0,3,2),(1178,1166,'den-canh-bao-xe-nang','lamp-warning','警示灯总成','Đèn cảnh báo xe nâng','lamp warning','警示灯总成','','','','','','','',51,'Đèn cảnh báo xe nâng','','','','',1,0,0,3,2),(1159,1119,'he-thong-hop-so','transmission-system','传动系统','Hệ Thống Hộp số','Transmission system','传动系统','','','','','','','',44,'Hệ Thống Hộp số','','','','',1,0,0,3,1),(1160,1119,'he-thong-thuy-luc','hydraulic-system','液压系统','Hệ thống Thủy lực','Hydraulic system','液压系统','','','','','','','',45,'Hệ thống Thủy lực','','','','',1,0,0,3,1),(1161,1119,'he-thong-lai','steering-system','转向系统','Hệ thống Lái','steering system','转向系统','','','','','','','',46,'Hệ thống Lái','','','','',1,0,0,3,1),(1162,1119,'he-thong-linh-kien','frame-and-other','车架与其他','Hệ thống linh kiện','Frame and other','车架与其他','','','','','','','',47,'Hệ thống linh kiện','','','','',1,0,0,3,1),(1163,1119,'he-thong-phanh','braking-system','制动系统','hệ thống phanh','Braking System','制动系统','','','','','','','',48,'hệ thống phanh','','','','',1,0,0,3,1),(1164,1119,'he-thong-lap','drive-system','驱动系统','Hệ thống láp','Drive System','驱动系统','','','','','','','',49,'Hệ thống láp','','','','',1,0,0,3,1),(1165,1119,'he-thong-lam-mat','cooling-system','制冷系统','Hệ thống làm mát','Cooling System','制冷系统','','','','','','','',50,'Hệ thống làm mát','','','','',1,0,0,3,1),(1166,1119,'he-thong-dien','electrical-system','电器系统','Hệ thống điện','Electrical system','电器系统','','','','','','','',51,'Hệ thống điện','','','','',1,0,0,3,1),(1167,1119,'he-thong-loc','filter-series','滤芯系列','Hệ thống lọc','Filter series','滤芯系列','','','','','','','',52,'Hệ thống lọc','','','','',1,0,0,3,1),(1168,1119,'he-thong-nhien-lieu','body-parts','车身件','Hệ thống nhiên Liệu','Body Parts','车身件','','','','','','','',53,'Hệ thống nhiên Liệu','','','','',1,0,0,3,1),(1169,1119,'he-thong-khung-nang','lifting-system','起重系统','Hệ thống khung nâng','Lifting system','起重系统','','','','','','','',54,'Hệ thống khung nâng','','','','',1,0,0,3,1),(1170,1119,'he-thong-ty-ben','cylinder','油缸类','Hệ thống ty ben','Cylinder','油缸类','','','','','','','',55,'Hệ thống ty ben','','','','',1,0,0,3,1),(1171,1119,'he-thong-banh-xe','wheel-rim','轮辋-2','Hệ thống bánh xe','Wheel rim','轮辋','','','','','','','',56,'Hệ thống bánh xe','','','','',1,0,0,3,1),(1172,1160,'bo-0','hydraulic-pump-4','液压油泵-8','Bơm thủy lực','Hydraulic pump','液压油泵','','','','','','','',57,'Bơ','','','','',1,0,0,3,2);
/*!40000 ALTER TABLE `db_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_chitietdathang`
--

DROP TABLE IF EXISTS `db_chitietdathang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_chitietdathang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_dh` int(11) NOT NULL,
  `ma_dh` varchar(255) NOT NULL,
  `id_sp` int(11) NOT NULL,
  `gia` int(11) NOT NULL,
  `khuyen_mai` int(11) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `mau` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_chitietdathang`
--

LOCK TABLES `db_chitietdathang` WRITE;
/*!40000 ALTER TABLE `db_chitietdathang` DISABLE KEYS */;
INSERT INTO `db_chitietdathang` VALUES (1,251,'DHXTHPF',69,600000,450000,5,32,33),(2,252,'DHDDK43',70,600000,450000,1,32,5),(3,253,'DHU5LIY',71,600000,450000,2,32,33),(4,254,'DHZ99R0',69,600000,450000,1,0,0),(5,255,'DHM8SNL',67,600000,0,1,0,0),(6,255,'DHM8SNL',68,600000,0,3,0,0),(7,256,'DHKQQXV',80,100000,0,1,0,0);
/*!40000 ALTER TABLE `db_chitietdathang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_danhmuc_hoidap`
--

DROP TABLE IF EXISTS `db_danhmuc_hoidap`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_danhmuc_hoidap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten_vn` varchar(255) NOT NULL,
  `alias_vn` varchar(255) NOT NULL,
  `so_thu_tu` int(11) NOT NULL,
  `title_vn` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `des` varchar(255) NOT NULL,
  `hien_thi` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_danhmuc_hoidap`
--

LOCK TABLES `db_danhmuc_hoidap` WRITE;
/*!40000 ALTER TABLE `db_danhmuc_hoidap` DISABLE KEYS */;
INSERT INTO `db_danhmuc_hoidap` VALUES (1,'Nhóm câu 1','nhom-cau-1',1,'Nhóm câu 1','','',1),(3,'Nhóm câu 2','nhom-cau-2',2,'Nhóm câu 2','','',1);
/*!40000 ALTER TABLE `db_danhmuc_hoidap` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_dathang`
--

DROP TABLE IF EXISTS `db_dathang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_dathang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ho_ten` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dia_chi` varchar(255) NOT NULL,
  `dien_thoai` varchar(20) NOT NULL,
  `thoi_gian_giao_hang` varchar(255) NOT NULL,
  `ngay_giao_hang` varchar(20) NOT NULL,
  `hinh_thuc_thanh_toan` tinyint(1) NOT NULL,
  `loi_nhan` varchar(1000) NOT NULL,
  `ngay_dat_hang` varchar(20) NOT NULL,
  `trang_thai` tinyint(1) NOT NULL,
  `tinh_trang` tinyint(1) NOT NULL,
  `ma_dh` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=258 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_dathang`
--

LOCK TABLES `db_dathang` WRITE;
/*!40000 ALTER TABLE `db_dathang` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_dathang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_datlich`
--

DROP TABLE IF EXISTS `db_datlich`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_datlich` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `donvi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `chuyenmon` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mota` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mucdo` int(11) NOT NULL,
  `vaitro` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `khac` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tuvan` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `capthiet` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `day` int(11) NOT NULL,
  `view` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_datlich`
--

LOCK TABLES `db_datlich` WRITE;
/*!40000 ALTER TABLE `db_datlich` DISABLE KEYS */;
INSERT INTO `db_datlich` VALUES (1,'Hoàng Hiển','Trường Trung Cấp Công Nghiệp Bình Dương','Công nghệ thông tin và kỹ thuật máy tính','thantaihoi@zing.vn','45345435','Công dụng, đặc tính, những điểm nổi bật so với những sản phẩm/dịch vụ hiện có trên thị trườngCông dụng, đặc tính, những điểm nổi bật so với những sản phẩm/dịch vụ hiện có trên thị trườngCông dụng, đặc tính, những điểm nổi bật so với những sản phẩm/dịch vụ hiện có trên thị trườngCông dụng, đặc tính, những điểm nổi bật so với những sản phẩm/dịch vụ hiện có trên thị trường',1,'0','test khác lung tung xì ngầu','(Ví dụ: tư vấn nghiên cứu hoàn thiện sản phẩm/dịch vụ; kiểm nghiệm tính khả thi của ý tưởng; tư vấn xây dựng/hoàn thiện KHKD; tư vấn bảo hộ SHTT; tư vấn pháp lý; tư vấn cách thức triển khai; ...)...)','rất cần thiết lun đó nha! dự án trăm triệu đô la đó',1461295558,1),(2,'Nguyễn Văn A','Trường Đại Học Hồng Bàng','Nghiên cứu vi sinh vật','hnhoanghien@gmail.com','554534566','Công dụng, đặc tính, những điểm nổi bật so với những sản phẩm/dịch vụ hiện có trên thị trườngCông dụng, đặc tính, những điểm nổi bật so với những sản phẩm/dịch vụ hiện có trên thị trườngCông dụng, đặc tính, những điểm nổi bật so với những sản phẩm/dịch vụ hiện có trên thị trường',2,'5,6,10','','(Ví dụ: tư vấn nghiên cứu hoàn thiện sản phẩm/dịch vụ; kiểm nghiệm tính khả thi của ý tưởng; tư vấn xây dựng/hoàn thiện KHKD; tư vấn bảo hộ SHTT; tư vấn pháp lý; tư vấn cách thức triển khai; ...)...)','Nếu dự án của bạn đang cần được hỗ trợ gấp hãy thông tin để chúng tôi biết và ưu tiên xếp lịch hẹn sớm',1461296811,1);
/*!40000 ALTER TABLE `db_datlich` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_dknhamau`
--

DROP TABLE IF EXISTS `db_dknhamau`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_dknhamau` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten_vn` varchar(255) NOT NULL,
  `so_dien_thoai` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dia_chi` varchar(255) NOT NULL,
  `ngay_dang` int(11) NOT NULL,
  `hien_thi` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_dknhamau`
--

LOCK TABLES `db_dknhamau` WRITE;
/*!40000 ALTER TABLE `db_dknhamau` DISABLE KEYS */;
INSERT INTO `db_dknhamau` VALUES (1,'Nguyễn Long','0982 382 323','kythuat01.pnvn@gmail.com','',272637,1),(2,'Nguyễn Long','0928 329 212','kythuat01.pnvn@gmail.com','',1446870899,1),(3,'','','','',1447053480,1);
/*!40000 ALTER TABLE `db_dknhamau` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_email`
--

DROP TABLE IF EXISTS `db_email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `ngay_gui` int(11) NOT NULL,
  `ho_ten` varchar(255) NOT NULL,
  `trang_thai` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_email`
--

LOCK TABLES `db_email` WRITE;
/*!40000 ALTER TABLE `db_email` DISABLE KEYS */;
INSERT INTO `db_email` VALUES (18,'09123123123',1514515357,'',0);
/*!40000 ALTER TABLE `db_email` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_extra`
--

DROP TABLE IF EXISTS `db_extra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_extra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stt` int(11) NOT NULL,
  `hide` int(11) NOT NULL,
  `title_vn` text COLLATE utf8_unicode_ci NOT NULL,
  `gia` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `title_us` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_extra`
--

LOCK TABLES `db_extra` WRITE;
/*!40000 ALTER TABLE `db_extra` DISABLE KEYS */;
INSERT INTO `db_extra` VALUES (1,1,1,'Dịch vụ làm bằng đại học chính quy',0,0,'Red','#776464','http://sieuthimaiche.com'),(5,0,1,'L',0,1,'','',''),(7,1,1,'HP Smart Array P440ar/2GB FBWC 12Gb 2-ports Int SAS Controller ',9000000,2,'','',''),(8,2,1,'HP Smart Array P440ar/2GB FBWC 12Gb 4-ports',15000000,2,'','',''),(11,5,1,'Proliant DL380 Gen9 motherboard, Intel C610 chipset, 24 DIMM slot, 6 PCIe, iLo',12500000,3,'','',''),(12,1,1,' Proliant DL380 Gen9 chassis, 2U rackmount, 8*2.5 SFF drives, 1x 500W',11050000,4,'','',''),(13,2,1,'Proliant DL380 Gen9 chassis, 2U rackmount, 8*2.5 SFF drives, 2x 500W',14500000,4,'','',''),(15,1,1,'HP 300GB 6G SAS 10K SFF SC HDD',4800000,5,'','',''),(16,2,1,'HP 300GB 6G SAS 15K SFF SC HDD',6500000,5,'','',''),(17,1,1,'Embedded HP 1Gb Ethernet 4-port 331i Adapter ',7500000,6,'','',''),(18,2,1,'HP NC365T 4-port 1GbE adapter',1500000,6,'','',''),(19,1,1,'Integrated VGA onboard ',1600000,7,'','',''),(20,1,1,'External Slim USB DVD-RW',850000,8,'','',''),(21,2,1,'External Slim USB Bluray Combo Drive',1780000,8,'','',''),(22,1,1,'Không chọn Màn hình ',0,9,'','',''),(23,1,1,'Không chọn Bộ lưu điện ',0,10,'','',''),(24,1,1,'Không chọn Hệ Điều Hành',0,11,'','',''),(28,3,1,'HP 300GB 12G SAS 10K SFF SC HDD ',4080000,5,'','',''),(29,4,1,'HP 300GB 12G SAS 15K SFF SC HDD',6950000,5,'','',''),(30,5,1,'HP 500GB 6G SATA 7.2K SFF SC HDD ',5000000,5,'','',''),(31,2,1,'Dịch vụ làm bằng đại học chính quy',0,0,'White','#000','#'),(32,3,1,'Dịch vụ làm bằng đại học chính quy',0,0,'Yellow','#f4f71d','#'),(33,2,1,'S',0,1,'','',''),(34,3,1,'M',0,1,'','',''),(35,4,1,'Dịch vụ làm bằng đại học chính quy',0,0,'','','#');
/*!40000 ALTER TABLE `db_extra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_file`
--

DROP TABLE IF EXISTS `db_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten_vn` varchar(255) NOT NULL,
  `ngay_dang` varchar(255) NOT NULL,
  `id_code` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `hien_thi` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_file`
--

LOCK TABLES `db_file` WRITE;
/*!40000 ALTER TABLE `db_file` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_gallery`
--

DROP TABLE IF EXISTS `db_gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) NOT NULL,
  `picture` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `stt` int(11) NOT NULL,
  `hide` int(11) NOT NULL,
  `title_vn` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title_us` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title_ch` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `link` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `body_vn` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `body_us` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `body_ch` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=124 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_gallery`
--

LOCK TABLES `db_gallery` WRITE;
/*!40000 ALTER TABLE `db_gallery` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_gallery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_hinhanh`
--

DROP TABLE IF EXISTS `db_hinhanh`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_hinhanh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sp` int(11) NOT NULL,
  `id_mau` int(11) NOT NULL,
  `hinh_lon` varchar(255) NOT NULL,
  `hinh_nho` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=90 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_hinhanh`
--

LOCK TABLES `db_hinhanh` WRITE;
/*!40000 ALTER TABLE `db_hinhanh` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_hinhanh` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_hinhthucthanhtoan`
--

DROP TABLE IF EXISTS `db_hinhthucthanhtoan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_hinhthucthanhtoan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten_vn` varchar(255) NOT NULL,
  `noi_dung_vn` text NOT NULL,
  `so_thu_tu` int(11) NOT NULL,
  `hien_thi` tinyint(1) NOT NULL,
  `ten_us` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_hinhthucthanhtoan`
--

LOCK TABLES `db_hinhthucthanhtoan` WRITE;
/*!40000 ALTER TABLE `db_hinhthucthanhtoan` DISABLE KEYS */;
INSERT INTO `db_hinhthucthanhtoan` VALUES (1,'Thanh toán khi nhận hàng','',1,1,'Payment on delivery'),(2,'Chuyển khoản','',2,1,'Transfer');
/*!40000 ALTER TABLE `db_hinhthucthanhtoan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_hotro`
--

DROP TABLE IF EXISTS `db_hotro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_hotro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_loai` varchar(255) NOT NULL,
  `ten_vn` varchar(255) NOT NULL,
  `ten_us` varchar(255) NOT NULL,
  `ten_jp` varchar(255) NOT NULL,
  `ten_ch` varchar(255) NOT NULL,
  `hinh_anh` varchar(255) NOT NULL,
  `yahoo` varchar(255) NOT NULL,
  `skype` varchar(255) NOT NULL,
  `sdt` varchar(200) NOT NULL,
  `so_thu_tu` int(11) NOT NULL DEFAULT '1',
  `hien_thi` tinyint(1) NOT NULL,
  `zalo` varchar(255) NOT NULL,
  `mo_ta_vn` text NOT NULL,
  `mo_ta_us` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_hotro`
--

LOCK TABLES `db_hotro` WRITE;
/*!40000 ALTER TABLE `db_hotro` DISABLE KEYS */;
INSERT INTO `db_hotro` VALUES (18,'','Mr Đức Tuấn','','','','zalo_logo_new450005326735.jpg','Zalo','xenang_ts','0902 70 73 79',1,1,'0933 642 269','',''),(23,'','Ms Ly','','','','zalo_logo_new103878654529.jpg','Zalo','','0938 983 040',3,1,'','',''),(24,'','Mr Tân','','','','zalo_logo_new536247571826.jpg','Zalo','','0902 833 040',3,1,'','',''),(25,'','Ms Ly','','','','zalo_logo_new157287860874.jpg','Zalo','','01279 70 73 79',2,1,'','','');
/*!40000 ALTER TABLE `db_hotro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_khachhang`
--

DROP TABLE IF EXISTS `db_khachhang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_khachhang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten_vn` varchar(255) NOT NULL,
  `mat_khau` varchar(255) NOT NULL,
  `ho_ten` varchar(255) NOT NULL,
  `so_dien_thoai` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dia_chi` varchar(255) NOT NULL,
  `ngay_dang` int(11) NOT NULL,
  `hien_thi` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_khachhang`
--

LOCK TABLES `db_khachhang` WRITE;
/*!40000 ALTER TABLE `db_khachhang` DISABLE KEYS */;
INSERT INTO `db_khachhang` VALUES (3,'kythuat01','c9ece136c3e846349a5a1312442fb99a','ho ten','so dt','emai','dc',1442303304,1);
/*!40000 ALTER TABLE `db_khachhang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_lienhe`
--

DROP TABLE IF EXISTS `db_lienhe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_lienhe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ho_ten` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sdt` varchar(20) NOT NULL,
  `dia_chi` varchar(255) NOT NULL,
  `ten_cong_ty` varchar(255) NOT NULL,
  `tieu_de` varchar(255) NOT NULL,
  `noi_dung` text NOT NULL,
  `ngay_hoi` varchar(20) NOT NULL,
  `trang_thai` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_lienhe`
--

LOCK TABLES `db_lienhe` WRITE;
/*!40000 ALTER TABLE `db_lienhe` DISABLE KEYS */;
INSERT INTO `db_lienhe` VALUES (44,'Tony','kythuat01.pnvn@gmail.com','0999999999','','','','','11-01-2018 15:09:38',1),(45,'QUANG PHUC VO','xenangts@gmail.com','0938983040','GO VAP','','','bvjghfuytrfuyti7ghju','08-03-2018 08:54:26',1),(46,'Ms Lê Na','lena@phuongnamvina.vn','0912817117','số 3 Bùi Đình Túy, Phường 26, Quận Bình Thạnh','','','test gửi vào mail','08-03-2018 09:12:42',1),(47,'Tony','kythuat01.pnvn@gmail.com','0999999999','Quận 1','','','tester','08-03-2018 09:14:34',1),(48,'hung','xenangts@gmail.com','0938983040','fcbdfg','','',' ndth','16-03-2018 09:54:42',1);
/*!40000 ALTER TABLE `db_lienhe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_lienketwebsite`
--

DROP TABLE IF EXISTS `db_lienketwebsite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_lienketwebsite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `link` text NOT NULL,
  `so_thu_tu` int(11) NOT NULL,
  `hien_thi` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_lienketwebsite`
--

LOCK TABLES `db_lienketwebsite` WRITE;
/*!40000 ALTER TABLE `db_lienketwebsite` DISABLE KEYS */;
INSERT INTO `db_lienketwebsite` VALUES (77,'vnexpress','http://vnexpress.net',7,1),(76,'dantri','htpp://dantri.com',6,1),(75,'facebook','http://facebook.com',5,1),(74,'Youtube','http://youtube.com',4,1),(78,'google.com','http://google.com.vn',8,1);
/*!40000 ALTER TABLE `db_lienketwebsite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_map`
--

DROP TABLE IF EXISTS `db_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `map` text NOT NULL,
  `ten_vn` text NOT NULL,
  `ten_us` text NOT NULL,
  `ten_ch` text NOT NULL,
  `mo_ta_vn` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mo_ta_us` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mo_ta_ch` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung_vn` text NOT NULL,
  `noi_dung_us` text NOT NULL,
  `noi_dung_ch` text NOT NULL,
  `so_thu_tu` int(11) NOT NULL DEFAULT '1',
  `hien_thi` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_map`
--

LOCK TABLES `db_map` WRITE;
/*!40000 ALTER TABLE `db_map` DISABLE KEYS */;
INSERT INTO `db_map` VALUES (17,'10.757722, 106.659059','Tên công ty chi nhánh 3','','','Tên công ty chi nhánh 3Tên công ty chi nhánh 3Tên công ty chi nhánh 3Tên công ty chi nhánh 3Tên công ty chi nhánh 3','','','0985 357 584Tên công ty chi nhánh 3Tên công ty chi nhánh 3Tên công ty chi nhánh 3Tên công ty chi nhánh 3Tên công ty chi nhánh 3<br />\r\n<br />\r\nTên công ty chi nhánh 3Tên công ty chi nhánh 3Tên công ty chi nhánh 3Tên công ty chi nhánh 3Tên công ty chi nhánh 3<br />\r\n<br />\r\nTên công ty chi nhánh 3Tên công ty chi nhánh 3Tên công ty chi nhánh 3Tên công ty chi nhánh 3Tên công ty chi nhánh 3<br />\r\n<br />\r\nTên công ty chi nhánh 3Tên công ty chi nhánh 3Tên công ty chi nhánh 3Tên công ty chi nhánh 3Tên công ty chi nhánh 3<br />\r\n<br />\r\nTên công ty chi nhánh 3Tên công ty chi nhánh 3Tên công ty chi nhánh 3Tên công ty chi nhánh 3Tên công ty chi nhánh 3<br />\r\n<br />\r\nTên công ty chi nhánh 3Tên công ty chi nhánh 3Tên công ty chi nhánh 3Tên công ty chi nhánh 3Tên công ty chi nhánh 3<br />\r\n<br />\r\nTên công ty chi nhánh 3Tên công ty chi nhánh 3Tên công ty chi nhánh 3Tên công ty chi nhánh 3Tên công ty chi nhánh 3','','',1,1),(18,'10.754707, 106.657053','Tên công ty chi nhánh 2','','','Tên công ty chi nhánh 2&nbsp;Tên công ty chi nhánh 2&nbsp;Tên công ty chi nhánh 2','','','Tên công ty chi nhánh 2&nbsp;Tên công ty chi nhánh 2&nbsp;Tên công ty chi nhánh 2<br />\r\n<br />\r\nTên công ty chi nhánh 2&nbsp;Tên công ty chi nhánh 2&nbsp;Tên công ty chi nhánh 2<br />\r\n<br />\r\nTên công ty chi nhánh 2&nbsp;Tên công ty chi nhánh 2&nbsp;Tên công ty chi nhánh 2<br />\r\n<br />\r\n<br />\r\nTên công ty chi nhánh 2&nbsp;Tên công ty chi nhánh 2&nbsp;Tên công ty chi nhánh 2<br />\r\n<br />\r\nTên công ty chi nhánh 2&nbsp;Tên công ty chi nhánh 2&nbsp;Tên công ty chi nhánh 2','','',2,1),(19,'10.753210, 106.661151','Tên chi nhánh 1','','','Mô tả ngắn chi nhánh 1 !<br />\r\ndia diem cong ty chinh nhanh 1<br />\r\nso phone cong ty chi nhánh 1','','','Mô tả ngắn chi nhánh 1 !<br />\r\ndia diem cong ty chinh nhanh 1<br />\r\nso phone cong ty chi nhánh 1Mô tả ngắn chi nhánh 1 !<br />\r\ndia diem cong ty chinh nhanh 1<br />\r\nso phone cong ty chi nhánh 1Mô tả ngắn chi nhánh 1 !<br />\r\ndia diem cong ty chinh nhanh 1<br />\r\nso phone cong ty chi nhánh 1Mô tả ngắn chi nhánh 1 !<br />\r\ndia diem cong ty chinh nhanh 1<br />\r\nso phone cong ty chi nhánh 1Mô tả ngắn chi nhánh 1 !<br />\r\ndia diem cong ty chinh nhanh 1<br />\r\nso phone cong ty chi nhánh 1Mô tả ngắn chi nhánh 1 !<br />\r\ndia diem cong ty chinh nhanh 1<br />\r\nso phone cong ty chi nhánh 1Mô tả ngắn chi nhánh 1 !<br />\r\ndia diem cong ty chinh nhanh 1<br />\r\nso phone cong ty chi nhánh 1Mô tả ngắn chi nhánh 1 !<br />\r\ndia diem cong ty chinh nhanh 1<br />\r\nso phone cong ty chi nhánh 1Mô tả ngắn chi nhánh 1 !<br />\r\ndia diem cong ty chinh nhanh 1<br />\r\nso phone cong ty chi nhánh 1Mô tả ngắn chi nhánh 1 !<br />\r\ndia diem cong ty chinh nhanh 1<br />\r\nso phone cong ty chi nhánh 1','','',3,1);
/*!40000 ALTER TABLE `db_map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_module`
--

DROP TABLE IF EXISTS `db_module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stt` int(11) NOT NULL,
  `hide` int(11) NOT NULL,
  `title` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_module`
--

LOCK TABLES `db_module` WRITE;
/*!40000 ALTER TABLE `db_module` DISABLE KEYS */;
INSERT INTO `db_module` VALUES (1,1,1,'Hình ảnh'),(2,2,1,'Bài viết'),(3,3,1,'Sản phẩm'),(4,4,1,'Tư vấn'),(5,5,1,'Liên hệ'),(6,6,1,'Video'),(7,7,1,'Giỏ hàng'),(8,8,1,'Đặt hàng thành công');
/*!40000 ALTER TABLE `db_module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_nhomhotro`
--

DROP TABLE IF EXISTS `db_nhomhotro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_nhomhotro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `stt` int(11) NOT NULL,
  `hide` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_nhomhotro`
--

LOCK TABLES `db_nhomhotro` WRITE;
/*!40000 ALTER TABLE `db_nhomhotro` DISABLE KEYS */;
INSERT INTO `db_nhomhotro` VALUES (1,'Hỗ trợ kinh doanh',1,1),(2,'Tư vấn khách hàng',2,1);
/*!40000 ALTER TABLE `db_nhomhotro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_permission_group`
--

DROP TABLE IF EXISTS `db_permission_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_permission_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `stt` int(11) NOT NULL,
  `hide` tinyint(4) NOT NULL,
  `id_loai` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_permission_group`
--

LOCK TABLES `db_permission_group` WRITE;
/*!40000 ALTER TABLE `db_permission_group` DISABLE KEYS */;
INSERT INTO `db_permission_group` VALUES (2,'bai-viet','Bài viết',2,1,17),(3,'gallery','Hình ảnh',3,1,16),(4,'category','Danh mục',1,1,17),(6,'ho-tro-truc-tuyen','Hỗ trợ trực tuyến',6,1,16),(7,'video','Video',7,1,16),(8,'upload-file','Upload file',8,1,16),(9,'slider-sp','Slider',2,1,16),(10,'ql-user','Quản lý User',1,1,18),(11,'ql-thongtin','Quản lý thông tin',11,1,16),(12,'seo-website','Seo website',2,1,0),(13,'giaodien','Nội dung khác',13,1,16),(14,'seo-co-ban','Seo cơ bản',14,1,12),(15,'seo-nang-cao','Seo nâng cao',15,1,12),(16,'quan-tri-giao-dien','Quản trị giao diện',1,1,0),(17,'quan-tri-danh-muc','Quản trị Danh mục',0,1,0),(18,'cau-hinh-user','Cấu hình user',5,1,0),(19,'quan-tri-thong-tin','Quản trị thông tin',4,1,0),(20,'danh-sach-don-hang','Danh sách đơn hàng',18,1,19),(21,'lien-he','Khách hàng Liên hệ',19,1,19),(22,'san-pham','Sản phẩm',20,1,17),(23,'ql-email','Danh sách Điện thoại',21,1,19);
/*!40000 ALTER TABLE `db_permission_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_quan`
--

DROP TABLE IF EXISTS `db_quan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_quan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_loai` int(11) NOT NULL,
  `ten_vn` varchar(255) NOT NULL,
  `so_thu_tu` int(11) NOT NULL,
  `hien_thi` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_quan`
--

LOCK TABLES `db_quan` WRITE;
/*!40000 ALTER TABLE `db_quan` DISABLE KEYS */;
INSERT INTO `db_quan` VALUES (1,1,'Quận 1',1,1),(2,1,'Quận 2',2,1),(3,1,'Quận 3',3,1),(4,4,'Hoàng Kiếm',4,1);
/*!40000 ALTER TABLE `db_quan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_question`
--

DROP TABLE IF EXISTS `db_question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cau_hoi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tra_loi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ngay` int(11) NOT NULL,
  `hien_thi` int(11) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `cau_hoi_us` text NOT NULL,
  `tra_loi_us` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_question`
--

LOCK TABLES `db_question` WRITE;
/*!40000 ALTER TABLE `db_question` DISABLE KEYS */;
INSERT INTO `db_question` VALUES (1,'Tony Tèo','<p>Làm sao để có thể làm giàu nhanh chóng không cần làm việc</p>\r\n','<p>Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!<br />\r\n<br />\r\n<br />\r\nBỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!<br />\r\n<br />\r\n<br />\r\nBỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!</p>\r\n',1459741196,1,'','',''),(2,'Tèo si rô','Kinh doanh cà phê làm giàu kiểu nào bà con, tiền sao nhiều nhiều vào','Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!<br />\r\n<br />\r\n<br />\r\nBỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!<br />\r\n<br />\r\n<br />\r\nBỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!Bỏ tiền nhiều vào, ăn may, tới lúc tự động giàu!',1459741247,1,'','',''),(3,'Tony','Oke chua ta!!!','',1502864656,0,'xe.xenang@gmail.com','','');
/*!40000 ALTER TABLE `db_question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_sanpham`
--

DROP TABLE IF EXISTS `db_sanpham`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_sanpham` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_loai` int(11) NOT NULL,
  `id_hang` varchar(255) NOT NULL DEFAULT '0',
  `alias_vn` varchar(255) NOT NULL,
  `alias_us` varchar(255) NOT NULL,
  `alias_ch` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ma_sp` varchar(255) NOT NULL,
  `ten_vn` varchar(1000) NOT NULL,
  `ten_us` varchar(255) NOT NULL,
  `ten_ch` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mo_ta_vn` text NOT NULL,
  `mo_ta_us` text NOT NULL,
  `mo_ta_ch` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hinh_anh` varchar(255) NOT NULL,
  `gia` double NOT NULL DEFAULT '0',
  `khuyen_mai` int(11) NOT NULL DEFAULT '0',
  `thong_tin_vn` text NOT NULL,
  `thong_tin_us` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `thong_tin_ch` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `thong_so_vn` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `thong_tai_vn` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `thong_chon_vn` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ngay_dang` int(11) DEFAULT NULL,
  `tieu_bieu` tinyint(1) DEFAULT NULL,
  `sp_moi` tinyint(1) NOT NULL DEFAULT '0',
  `sp_hot` tinyint(1) NOT NULL,
  `title_vn` varchar(255) DEFAULT NULL,
  `title_us` varchar(255) NOT NULL,
  `title_ch` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `des` varchar(255) DEFAULT NULL,
  `view` int(11) NOT NULL DEFAULT '0',
  `thanh_pho` int(11) NOT NULL DEFAULT '0',
  `quan` int(11) NOT NULL DEFAULT '0',
  `hien_thi` tinyint(1) NOT NULL DEFAULT '1',
  `extra0` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `extra1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `extra2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `extra3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `extra4` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `extra5` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `extra6` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `extra7` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `extra8` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `extra9` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `extra10` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `con_hang` tinyint(4) NOT NULL,
  `so_thu_tu` int(11) NOT NULL,
  `style` int(11) NOT NULL,
  `serial` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `loai` varchar(255) NOT NULL,
  `tai_trong` varchar(255) NOT NULL,
  `nang_cao` varchar(255) NOT NULL,
  `khung_nang` varchar(255) NOT NULL,
  `nam` varchar(255) NOT NULL,
  `gio_su_dung` varchar(255) NOT NULL,
  `xuat_xu` varchar(255) NOT NULL,
  `part_number` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=222 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_sanpham`
--

LOCK TABLES `db_sanpham` WRITE;
/*!40000 ALTER TABLE `db_sanpham` DISABLE KEYS */;
INSERT INTO `db_sanpham` VALUES (157,1120,'0','bo','bom-thuy-luc','Reachtruck汽车BT-Reflex-RRE160-E','GZLQ','Bơm thủy lực','bơm thủy lực','Reachtruck汽车BT Reflex RRE160 E','Dòng xe nâng Reachtruck BT Reflex RRE160 E xuất xứ Thụy Điển cũng có những đặc điểm tương tự như dòng xe nâng Reachtruck BT Reflex RRE160 R trước.','The BT Replicas BT Reflex RRE160 E from Sweden also has the same characteristics as the previous BT Reflex RRE160 R forklift.','來自瑞典的BT Replicas BT Reflex RRE160 E也具有與以前的BT Reflex RRE160 R叉車相同的特性。','IMG_2534985241720229.JPG',0,0,'<p>Dòng xe nâng Reachtruck BT Reflex RRE160 E xuất xứ Thụy Điển cũng có những đặc điểm tương tự như dòng xe nâng Reachtruck BT Reflex RRE160 R trước.<br />\r\n- Sử dụng động cơ nguồn điện xoay chiều AC, dòng xe nâng Reachtruck BT Reflex RRE160 E thích hợp cho các ứng dụng xe nâng bao gồm khả năng nâng cao và vận tải nặng.</p>\r\n\r\n<p>- Xe nâng Reachtruck BT Reflex RRE160 E cũng được thiết kế một chiếc cabin kín giúp xe có thể hoạt động được trong kho lạnh trong thời gian dài mà không ảnh hưởng đến sức khỏe của người lái.</p>\r\n\r\n<p>Cabin của xe nâng Reach truck rất thoải mái và rộng rãi với ghế ngồi có thể điều chỉnh.</p>\r\n\r\n<p>- Bình ắc quy Lithium-Ion được sử dụng trong xe nâng điện Reach truck BT Reflex RRE160 R giúp tối đa hóa công suất xe và hạn chế đến mức thấp nhất thời gian lãng phí trong quá trình chuyển ca làm việc.</p>\r\n\r\n<p>- Tầm nhìn của xe nâng thoáng và vượt trội</p>\r\n\r\n<p>Đặc điểm vượt trội của dòng xe nâng Reachtruck BT Reflex RRE160 E so với dòng xe nâng RRE160 R trước đó chính là thiết kế cabin dành cho người lái.<br />\r\nĐối với các hoạt động nâng hàng lên cao, dòng xe nâng Reachtruck BT Reflex RRE160 E có cabin nghiêng độc đáo, làm giảm căng thẳng cho cổ, lưng người lái trong quá trình làm việc và giúp xử lý tải trọng khối hàng chính xác hơn.</p>\r\n\r\n<p>Cabin của xe nâng Reach truck có độ nghiêng độc đáo, được thiết kế kín phù hợp làm việc trong kho lạnh</p>\r\n','','','','','',1519959196,1,0,0,'bơ','','','','',0,0,0,1,'','','2015','','','','','','','','',0,0,0,'HPT50M','HPT50M','HPT50M','Hand','5T','HPT50M','HPT50M','2015','5000','Korea','HPT50M'),(183,1174,'0','','','','YONZ','Bơm nước 1Z,2Z,13 Z','Water Pump','水泵总成 ','','','','IMG_3298771483378232.JPG',0,0,'','','','','','',1520496061,0,0,0,'','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','1Z,2Z,13 Z','TOYOTA','','','','','','','',''),(158,1121,'0','mam-ep','reachtruck-car-bt-reflex-rre160-e-932','Reachtruck汽车BT-Reflex-RRE160-E-954','GZLQ','Mâm ép','Mâm ép','Reachtruck汽车BT Reflex RRE160 E','Dòng xe nâng Reachtruck BT Reflex RRE160 E xuất xứ Thụy Điển cũng có những đặc điểm tương tự như dòng xe nâng Reachtruck BT Reflex RRE160 R trước.','The BT Replicas BT Reflex RRE160 E from Sweden also has the same characteristics as the previous BT Reflex RRE160 R forklift.','來自瑞典的BT Replicas BT Reflex RRE160 E也具有與以前的BT Reflex RRE160 R叉車相同的特性。','IMG_0412383963574701.JPG',0,0,'<p>Dòng xe nâng Reachtruck BT Reflex RRE160 E xuất xứ Thụy Điển cũng có những đặc điểm tương tự như dòng xe nâng Reachtruck BT Reflex RRE160 R trước.<br />\r\n- Sử dụng động cơ nguồn điện xoay chiều AC, dòng xe nâng Reachtruck BT Reflex RRE160 E thích hợp cho các ứng dụng xe nâng bao gồm khả năng nâng cao và vận tải nặng.</p>\r\n\r\n<p>- Xe nâng Reachtruck BT Reflex RRE160 E cũng được thiết kế một chiếc cabin kín giúp xe có thể hoạt động được trong kho lạnh trong thời gian dài mà không ảnh hưởng đến sức khỏe của người lái.</p>\r\n\r\n<p>Cabin của xe nâng Reach truck rất thoải mái và rộng rãi với ghế ngồi có thể điều chỉnh.</p>\r\n\r\n<p>- Bình ắc quy Lithium-Ion được sử dụng trong xe nâng điện Reach truck BT Reflex RRE160 R giúp tối đa hóa công suất xe và hạn chế đến mức thấp nhất thời gian lãng phí trong quá trình chuyển ca làm việc.</p>\r\n\r\n<p>- Tầm nhìn của xe nâng thoáng và vượt trội</p>\r\n\r\n<p>Đặc điểm vượt trội của dòng xe nâng Reachtruck BT Reflex RRE160 E so với dòng xe nâng RRE160 R trước đó chính là thiết kế cabin dành cho người lái.<br />\r\nĐối với các hoạt động nâng hàng lên cao, dòng xe nâng Reachtruck BT Reflex RRE160 E có cabin nghiêng độc đáo, làm giảm căng thẳng cho cổ, lưng người lái trong quá trình làm việc và giúp xử lý tải trọng khối hàng chính xác hơn.</p>\r\n\r\n<p>Cabin của xe nâng Reach truck có độ nghiêng độc đáo, được thiết kế kín phù hợp làm việc trong kho lạnh</p>\r\n','','','','','',1519959198,1,0,0,'Mâm ép','','','','',0,0,0,1,'','','2015','','','','','','','','',0,0,0,'HPT50M','HPT50M','HPT50M','Hand','5T','HPT50M','HPT50M','2015','5000','Korea','HPT50M'),(159,1113,'0','Heo-Thang-194','reachtruck-car-bt-reflex-rre160-e-57','Reachtruck汽车BT-Reflex-RRE160-E-805','GZLQ','Heo Thắng','Heo thắng','Reachtruck汽车BT Reflex RRE160 E','Dòng xe nâng Reachtruck BT Reflex RRE160 E xuất xứ Thụy Điển cũng có những đặc điểm tương tự như dòng xe nâng Reachtruck BT Reflex RRE160 R trước.','The BT Replicas BT Reflex RRE160 E from Sweden also has the same characteristics as the previous BT Reflex RRE160 R forklift.','來自瑞典的BT Replicas BT Reflex RRE160 E也具有與以前的BT Reflex RRE160 R叉車相同的特性。','IMG_2679972111230587.JPG',0,0,'<p>Dòng xe nâng Reachtruck BT Reflex RRE160 E xuất xứ Thụy Điển cũng có những đặc điểm tương tự như dòng xe nâng Reachtruck BT Reflex RRE160 R trước.<br />\r\n- Sử dụng động cơ nguồn điện xoay chiều AC, dòng xe nâng Reachtruck BT Reflex RRE160 E thích hợp cho các ứng dụng xe nâng bao gồm khả năng nâng cao và vận tải nặng.</p>\r\n\r\n<p>- Xe nâng Reachtruck BT Reflex RRE160 E cũng được thiết kế một chiếc cabin kín giúp xe có thể hoạt động được trong kho lạnh trong thời gian dài mà không ảnh hưởng đến sức khỏe của người lái.</p>\r\n\r\n<p>Cabin của xe nâng Reach truck rất thoải mái và rộng rãi với ghế ngồi có thể điều chỉnh.</p>\r\n\r\n<p>- Bình ắc quy Lithium-Ion được sử dụng trong xe nâng điện Reach truck BT Reflex RRE160 R giúp tối đa hóa công suất xe và hạn chế đến mức thấp nhất thời gian lãng phí trong quá trình chuyển ca làm việc.</p>\r\n\r\n<p>- Tầm nhìn của xe nâng thoáng và vượt trội</p>\r\n\r\n<p>Đặc điểm vượt trội của dòng xe nâng Reachtruck BT Reflex RRE160 E so với dòng xe nâng RRE160 R trước đó chính là thiết kế cabin dành cho người lái.<br />\r\nĐối với các hoạt động nâng hàng lên cao, dòng xe nâng Reachtruck BT Reflex RRE160 E có cabin nghiêng độc đáo, làm giảm căng thẳng cho cổ, lưng người lái trong quá trình làm việc và giúp xử lý tải trọng khối hàng chính xác hơn.</p>\r\n\r\n<p>Cabin của xe nâng Reach truck có độ nghiêng độc đáo, được thiết kế kín phù hợp làm việc trong kho lạnh</p>\r\n','','','','','',1519959200,1,0,0,'Xe Reachtruck ngồi lái BT Reflex RRE160 E','','','','',0,0,0,1,'','','2015','','','','','','','','',0,0,0,'HPT50M','HPT50M','HPT50M','Hand','5T','HPT50M','HPT50M','2015','5000','Korea','HPT50M'),(160,1113,'0','ba','reachtruck-car-bt-reflex-rre160-e-735','Reachtruck汽车BT-Reflex-RRE160-E-567','GZLQ','Bạc đạn khung nâng','Bạc đạn khung nâng','Reachtruck汽车BT Reflex RRE160 E','Dòng xe nâng Reachtruck BT Reflex RRE160 E xuất xứ Thụy Điển cũng có những đặc điểm tương tự như dòng xe nâng Reachtruck BT Reflex RRE160 R trước.','The BT Replicas BT Reflex RRE160 E from Sweden also has the same characteristics as the previous BT Reflex RRE160 R forklift.','來自瑞典的BT Replicas BT Reflex RRE160 E也具有與以前的BT Reflex RRE160 R叉車相同的特性。','IMG_1365856521410716.JPG',0,0,'<p>Dòng xe nâng Reachtruck BT Reflex RRE160 E xuất xứ Thụy Điển cũng có những đặc điểm tương tự như dòng xe nâng Reachtruck BT Reflex RRE160 R trước.<br />\r\n- Sử dụng động cơ nguồn điện xoay chiều AC, dòng xe nâng Reachtruck BT Reflex RRE160 E thích hợp cho các ứng dụng xe nâng bao gồm khả năng nâng cao và vận tải nặng.</p>\r\n\r\n<p>- Xe nâng Reachtruck BT Reflex RRE160 E cũng được thiết kế một chiếc cabin kín giúp xe có thể hoạt động được trong kho lạnh trong thời gian dài mà không ảnh hưởng đến sức khỏe của người lái.</p>\r\n\r\n<p>Cabin của xe nâng Reach truck rất thoải mái và rộng rãi với ghế ngồi có thể điều chỉnh.</p>\r\n\r\n<p>- Bình ắc quy Lithium-Ion được sử dụng trong xe nâng điện Reach truck BT Reflex RRE160 R giúp tối đa hóa công suất xe và hạn chế đến mức thấp nhất thời gian lãng phí trong quá trình chuyển ca làm việc.</p>\r\n\r\n<p>- Tầm nhìn của xe nâng thoáng và vượt trội</p>\r\n\r\n<p>Đặc điểm vượt trội của dòng xe nâng Reachtruck BT Reflex RRE160 E so với dòng xe nâng RRE160 R trước đó chính là thiết kế cabin dành cho người lái.<br />\r\nĐối với các hoạt động nâng hàng lên cao, dòng xe nâng Reachtruck BT Reflex RRE160 E có cabin nghiêng độc đáo, làm giảm căng thẳng cho cổ, lưng người lái trong quá trình làm việc và giúp xử lý tải trọng khối hàng chính xác hơn.</p>\r\n\r\n<p>Cabin của xe nâng Reach truck có độ nghiêng độc đáo, được thiết kế kín phù hợp làm việc trong kho lạnh</p>\r\n','','','','','',1519959201,1,0,0,'Ba','','','','',0,0,0,1,'','','2015','','','','','','','','',0,0,0,'HPT50M','HPT50M','HPT50M','Hand','5T','HPT50M','HPT50M','2015','5000','Korea','HPT50M'),(213,1179,'0','bom','ch','供油泵-827','0FLV','Bơm nhớt hợp số','Charging pump','供油泵','','','','IMG_1974218263553312.JPG',0,0,'','','','','','',1521096323,1,0,0,'bơm','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','','','','','','','','','',''),(161,1113,'0','xe-reachtruck-ngoi-lai-bt-reflex-rre160-e-469','reachtruck-car-bt-reflex-rre160-e-569','Reachtruck汽车BT-Reflex-RRE160-E-450','GZLQ','Heo con','Heo con','Reachtruck汽车BT Reflex RRE160 E','Dòng xe nâng Reachtruck BT Reflex RRE160 E xuất xứ Thụy Điển cũng có những đặc điểm tương tự như dòng xe nâng Reachtruck BT Reflex RRE160 R trước.','The BT Replicas BT Reflex RRE160 E from Sweden also has the same characteristics as the previous BT Reflex RRE160 R forklift.','來自瑞典的BT Replicas BT Reflex RRE160 E也具有與以前的BT Reflex RRE160 R叉車相同的特性。','IMG_2693206175804561.JPG',0,0,'<p>Dòng xe nâng Reachtruck BT Reflex RRE160 E xuất xứ Thụy Điển cũng có những đặc điểm tương tự như dòng xe nâng Reachtruck BT Reflex RRE160 R trước.<br />\r\n- Sử dụng động cơ nguồn điện xoay chiều AC, dòng xe nâng Reachtruck BT Reflex RRE160 E thích hợp cho các ứng dụng xe nâng bao gồm khả năng nâng cao và vận tải nặng.</p>\r\n\r\n<p>- Xe nâng Reachtruck BT Reflex RRE160 E cũng được thiết kế một chiếc cabin kín giúp xe có thể hoạt động được trong kho lạnh trong thời gian dài mà không ảnh hưởng đến sức khỏe của người lái.</p>\r\n\r\n<p>Cabin của xe nâng Reach truck rất thoải mái và rộng rãi với ghế ngồi có thể điều chỉnh.</p>\r\n\r\n<p>- Bình ắc quy Lithium-Ion được sử dụng trong xe nâng điện Reach truck BT Reflex RRE160 R giúp tối đa hóa công suất xe và hạn chế đến mức thấp nhất thời gian lãng phí trong quá trình chuyển ca làm việc.</p>\r\n\r\n<p>- Tầm nhìn của xe nâng thoáng và vượt trội</p>\r\n\r\n<p>Đặc điểm vượt trội của dòng xe nâng Reachtruck BT Reflex RRE160 E so với dòng xe nâng RRE160 R trước đó chính là thiết kế cabin dành cho người lái.<br />\r\nĐối với các hoạt động nâng hàng lên cao, dòng xe nâng Reachtruck BT Reflex RRE160 E có cabin nghiêng độc đáo, làm giảm căng thẳng cho cổ, lưng người lái trong quá trình làm việc và giúp xử lý tải trọng khối hàng chính xác hơn.</p>\r\n\r\n<p>Cabin của xe nâng Reach truck có độ nghiêng độc đáo, được thiết kế kín phù hợp làm việc trong kho lạnh</p>\r\n','','','','','',1519959201,1,0,0,'Xe Reachtruck ngồi lái BT Reflex RRE160 E','','','','',0,0,0,1,'','','2015','','','','','','','','',0,0,0,'HPT50M','HPT50M','HPT50M','Hand','5T','HPT50M','HPT50M','2015','5000','Korea','HPT50M'),(182,1174,'0','bom-nuoc-1dz-ii','','','DU28','Bơm nước 1DZ-II','Water Pump','水泵总成 ','','','','15380828_110469326114217_6536250164349811232_n224008703182.jpg',0,0,'','','','','','',1520495656,0,0,0,'Bơm nước 1DZ-II','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','1DZ-II','TOYOTA','','','','','','','','56540-23321-71'),(162,1113,'0','xe-reachtruck-ngoi-lai-bt-reflex-rre160-e-899','reachtruck-car-bt-reflex-rre160-e-725','Reachtruck汽车BT-Reflex-RRE160-E-29','GZLQ','Bơm Nước','Bơm Nước','Bơm Nước','Dòng xe nâng Reachtruck BT Reflex RRE160 E xuất xứ Thụy Điển cũng có những đặc điểm tương tự như dòng xe nâng Reachtruck BT Reflex RRE160 R trước.','The BT Replicas BT Reflex RRE160 E from Sweden also has the same characteristics as the previous BT Reflex RRE160 R forklift.','來自瑞典的BT Replicas BT Reflex RRE160 E也具有與以前的BT Reflex RRE160 R叉車相同的特性。','IMG_3191182138557144.JPG',0,0,'<p>Dòng xe nâng Reachtruck BT Reflex RRE160 E xuất xứ Thụy Điển cũng có những đặc điểm tương tự như dòng xe nâng Reachtruck BT Reflex RRE160 R trước.<br />\r\n- Sử dụng động cơ nguồn điện xoay chiều AC, dòng xe nâng Reachtruck BT Reflex RRE160 E thích hợp cho các ứng dụng xe nâng bao gồm khả năng nâng cao và vận tải nặng.</p>\r\n\r\n<p>- Xe nâng Reachtruck BT Reflex RRE160 E cũng được thiết kế một chiếc cabin kín giúp xe có thể hoạt động được trong kho lạnh trong thời gian dài mà không ảnh hưởng đến sức khỏe của người lái.</p>\r\n\r\n<p>Cabin của xe nâng Reach truck rất thoải mái và rộng rãi với ghế ngồi có thể điều chỉnh.</p>\r\n\r\n<p>- Bình ắc quy Lithium-Ion được sử dụng trong xe nâng điện Reach truck BT Reflex RRE160 R giúp tối đa hóa công suất xe và hạn chế đến mức thấp nhất thời gian lãng phí trong quá trình chuyển ca làm việc.</p>\r\n\r\n<p>- Tầm nhìn của xe nâng thoáng và vượt trội</p>\r\n\r\n<p>Đặc điểm vượt trội của dòng xe nâng Reachtruck BT Reflex RRE160 E so với dòng xe nâng RRE160 R trước đó chính là thiết kế cabin dành cho người lái.<br />\r\nĐối với các hoạt động nâng hàng lên cao, dòng xe nâng Reachtruck BT Reflex RRE160 E có cabin nghiêng độc đáo, làm giảm căng thẳng cho cổ, lưng người lái trong quá trình làm việc và giúp xử lý tải trọng khối hàng chính xác hơn.</p>\r\n\r\n<p>Cabin của xe nâng Reach truck có độ nghiêng độc đáo, được thiết kế kín phù hợp làm việc trong kho lạnh</p>\r\n','','','','','',1519959202,1,0,0,'Xe Reachtruck ngồi lái BT Reflex RRE160 E','','','','',0,0,0,1,'','','2015','','','','','','','','',0,0,0,'HPT50M','HPT50M','HPT50M','Hand','5T','HPT50M','HPT50M','2015','5000','Korea','HPT50M'),(177,1137,'0','','','','233U','Cùi dĩa','Cùi dĩa','Cùi dĩa','','','','IMG_0604556736244480.JPG',0,0,'','','','','','',1520483129,1,0,0,'','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','','','','','','','','','',''),(163,1178,'0','','lamp-warning-580','警示灯总成-323','GZLQ','Đèn cảnh báo','Lamp warning','警示灯总成','','','','image-8a32205aa094bd80a9682a3768c743916529f126224d4bd3bd67821369a9cbe9-V906685502402.jpg',0,0,'<p>Dòng xe nâng Reachtruck BT Reflex RRE160 E xuất xứ Thụy Điển cũng có những đặc điểm tương tự như dòng xe nâng Reachtruck BT Reflex RRE160 R trước.<br />\r\n- Sử dụng động cơ nguồn điện xoay chiều AC, dòng xe nâng Reachtruck BT Reflex RRE160 E thích hợp cho các ứng dụng xe nâng bao gồm khả năng nâng cao và vận tải nặng.</p>\r\n\r\n<p>- Xe nâng Reachtruck BT Reflex RRE160 E cũng được thiết kế một chiếc cabin kín giúp xe có thể hoạt động được trong kho lạnh trong thời gian dài mà không ảnh hưởng đến sức khỏe của người lái.</p>\r\n\r\n<p>Cabin của xe nâng Reach truck rất thoải mái và rộng rãi với ghế ngồi có thể điều chỉnh.</p>\r\n\r\n<p>- Bình ắc quy Lithium-Ion được sử dụng trong xe nâng điện Reach truck BT Reflex RRE160 R giúp tối đa hóa công suất xe và hạn chế đến mức thấp nhất thời gian lãng phí trong quá trình chuyển ca làm việc.</p>\r\n\r\n<p>- Tầm nhìn của xe nâng thoáng và vượt trội</p>\r\n\r\n<p>Đặc điểm vượt trội của dòng xe nâng Reachtruck BT Reflex RRE160 E so với dòng xe nâng RRE160 R trước đó chính là thiết kế cabin dành cho người lái.<br />\r\nĐối với các hoạt động nâng hàng lên cao, dòng xe nâng Reachtruck BT Reflex RRE160 E có cabin nghiêng độc đáo, làm giảm căng thẳng cho cổ, lưng người lái trong quá trình làm việc và giúp xử lý tải trọng khối hàng chính xác hơn.</p>\r\n\r\n<p>Cabin của xe nâng Reach truck có độ nghiêng độc đáo, được thiết kế kín phù hợp làm việc trong kho lạnh</p>\r\n','','','','','',1519959203,1,0,0,'Xe Reachtruck ngồi lái BT Reflex RRE160 E','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','','','','','','','','','',''),(214,1179,'0','','ch-571','供油泵-556','XAFJ','bơm nhớt hộp số','Charging pump','供油泵','','','','IMG_1915260353015473.JPG',0,0,'','','','','','',1521096472,1,0,0,'','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','','','','','','','','','',''),(164,1173,'0','cang-bo-thang-320','','制动蹄片','GZLQ','Càng Bố Thắng','BRAKE SHOE','制动蹄片','','','','IMG_0605-(2)540965714278.JPG',0,0,'','','','','','',1519959204,1,0,0,'Càng Bố Thắng','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','','','','','','','','','',''),(165,1180,'0','banh-da-xe-nang-930','flywheel-assy-674','飞轮齿圈总成-111','GZLQ','Bánh đà xe nâng','Flywheel assy','飞轮齿圈总成','','','','20160419_182700132168939051.jpg',0,0,'','','','','','',1519959205,0,0,0,'Bánh đà xe nâng','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','','','','','','','','','',''),(166,1157,'0','may-phat-dien-112','alternator-174','发电机总成-618','GZLQ','Máy phát điện','Alternator','发电机总成','','','','IMG_0797-(2)894063492602.JPG',0,0,'','','','','','',1519959205,0,0,0,'Máy phát điện','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','','','','','','','','','',''),(215,1149,'0','bao-tri-xe-nang-754','bao-tri-xe-nang','Bao-tri-xe-nang','CAMK','Bảo trì xe nâng','Bảo trì xe nâng','Bảo trì xe nâng','','','','IMG_20161023_095531171126223696.jpg',0,0,'','','','','','',1521133640,0,0,1,'Bảo trì xe nâng','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','','','','','','','','','',''),(216,1150,'0','van-thien-hung','van-thien-hung','Van-Thien-Hung','1BVS','Vân Thiên Hùng','Vân Thiên Hùng','Vân Thiên Hùng','','','','4lc800096rz7wcdlxrw1lx180264736975391.jpg',0,0,'','','','','','',1521134042,0,0,1,'Vân Thiên Hùng','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','','','','','','','','','',''),(217,1151,'0','van-thien-hung-136','van-thien-hung-158','Van-Thien-Hung','7I8U','Vân Thiên Hùng','Vân Thiên Hùng','Vân Thiên Hùng','','','','IMG_20161023_095534784189618117.jpg',0,0,'','','','','','',1521134134,0,0,1,'Vân Thiên Hùng','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','','','','','','','','','',''),(167,1176,'0','xe-reachtruck-ngoi-lai-bt-reflex-rre160-e-53','oil-pumps','机油泵-93','GZLQ','Bơm nhớt động cơ','Oil pumps','机油泵','Dòng xe nâng Reachtruck BT Reflex RRE160 E xuất xứ Thụy Điển cũng có những đặc điểm tương tự như dòng xe nâng Reachtruck BT Reflex RRE160 R trước.','.','','IMG_2515-(1)542284399064.JPG',0,0,'','','','','','',1519959206,0,0,0,'Xe Reachtruck ngồi lái BT Reflex RRE160 E','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','','','','','','','','','',''),(168,1177,'0','den-xe-nang','head-lamp-assy-286','前转向灯总成-557','GZLQ','Đèn xe nâng','Head lamp assy','前转向灯总成','','','','IMG_2732750287295068.JPG',0,0,'','','','','','',1519959207,1,0,0,'Đèn xe nâng','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','','','','','','','','','',''),(169,1125,'0','sua-xe-nang-132','sua-xe-nang-29','sua-xe-nang','GZLQ','Sửa xe nâng','sửa xe nâng','sửa xe nâng','','','','IMG_1953861824186270.JPG',0,0,'','','','','','',1519959213,0,0,1,'Sửa xe nâng','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','','','','','','','','','',''),(219,1149,'0','phu-tung-xe-nang-962','phu-tung-xe-nang','Phu-tung-xe-nang','X0CH','Phụ tùng xe nâng','Phụ tùng xe nâng','Phụ tùng xe nâng','','','','IMG_20160817_100339993715184929.jpg',0,0,'','','','','','',1521138441,0,0,1,'Phụ tùng xe nâng','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','','','','','','','','','',''),(220,1149,'0','phu-tung-xe-nang-50','phu-tung-xe-nang-248','phu-tung-xe-nang','0810','Phụ tùng xe nâng','Phụ tùng xe nâng','phụ tùng xe nâng','','','','IMG_20160817_100230629589055478.jpg',0,0,'','','','','','',1521138520,0,0,1,'Phụ tùng xe nâng','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','','','','','','','','','',''),(221,1149,'0','phu-tung-xe-nang-822','phu-tung-xe-nang-959','phu-tung-xe-nang','BCJ2','Phụ tùng xe nâng','Phụ tùng xe nâng','phụ tùng xe nâng','','','','IMG_2069402004678922.JPG',0,0,'','','','','','',1521138742,0,0,1,'Phụ tùng xe nâng','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','','','','','','','','','',''),(179,1174,'0','bom-nuoc','','','Z5FU','Bơm nước 4jg2','Water Pump ','水泵总成 ','','','','IMG_20170516_164831804983361915.jpg',0,0,'','','','','','',1520485676,0,0,0,'Bơm nước ','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','4jg2','ISUZU','','','','','','','','Z-8-97028-590-0'),(170,1124,'0','sua-xe-nang-23','sua-xe-nang-228','sua-xe-nang','GZLQ','Sửa xe nâng','Sửa xe nâng','sửa xe nâng','','','','1476211030921.jpg',0,0,'','','','','','',1519959214,0,0,1,'Sửa xe nâng','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','','','','','','','','','',''),(218,1154,'0','xe-nang','xe-nang','xe-nang','3OJC','xe nâng','xe nâng','xe nâng','','','','IMG_20161023_094431251530170125.jpg',0,0,'','','','','','',1521137465,0,0,1,'xe nâng','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','','','','','','','','','',''),(171,1122,'0','sua-xe-nang','sua-xe-nang','Reachtruck汽车BT-Reflex-RRE160-E-280','GZLQ','Sửa xe nâng','sửa xe nâng','Reachtruck汽车BT Reflex RRE160 E ','','The BT Replicas BT Reflex RRE160 E from Sweden also has the same characteristics as the previous BT Reflex RRE160 R forklift.','來自瑞典的BT Replicas BT Reflex RRE160 E也具有與以前的BT Reflex RRE160 R叉車相同的特性。','22045865_1446085312142478_908872181362825725_n632471526558.jpg',0,0,'<p>Dòng xe nâng Reachtruck BT Reflex RRE160 E xuất xứ Thụy Điển cũng có những đặc điểm tương tự như dòng xe nâng Reachtruck BT Reflex RRE160 R trước.<br />\r\n- Sử dụng động cơ nguồn điện xoay chiều AC, dòng xe nâng Reachtruck BT Reflex RRE160 E thích hợp cho các ứng dụng xe nâng bao gồm khả năng nâng cao và vận tải nặng.</p>\r\n\r\n<p>- Xe nâng Reachtruck BT Reflex RRE160 E cũng được thiết kế một chiếc cabin kín giúp xe có thể hoạt động được trong kho lạnh trong thời gian dài mà không ảnh hưởng đến sức khỏe của người lái.</p>\r\n\r\n<p>Cabin của xe nâng Reach truck rất thoải mái và rộng rãi với ghế ngồi có thể điều chỉnh.</p>\r\n\r\n<p>- Bình ắc quy Lithium-Ion được sử dụng trong xe nâng điện Reach truck BT Reflex RRE160 R giúp tối đa hóa công suất xe và hạn chế đến mức thấp nhất thời gian lãng phí trong quá trình chuyển ca làm việc.</p>\r\n\r\n<p>- Tầm nhìn của xe nâng thoáng và vượt trội</p>\r\n\r\n<p>Đặc điểm vượt trội của dòng xe nâng Reachtruck BT Reflex RRE160 E so với dòng xe nâng RRE160 R trước đó chính là thiết kế cabin dành cho người lái.<br />\r\nĐối với các hoạt động nâng hàng lên cao, dòng xe nâng Reachtruck BT Reflex RRE160 E có cabin nghiêng độc đáo, làm giảm căng thẳng cho cổ, lưng người lái trong quá trình làm việc và giúp xử lý tải trọng khối hàng chính xác hơn.</p>\r\n\r\n<p>Cabin của xe nâng Reach truck có độ nghiêng độc đáo, được thiết kế kín phù hợp làm việc trong kho lạnh</p>\r\n','','','','','',1519959215,0,0,0,'Sửa xe nâng','','','','',0,0,0,1,'','','2015','','','','','','','','',0,0,0,'HPT50M','HPT50M','HPT50M','Hand','5T','HPT50M','HPT50M','2015','5000','Korea','HPT50M'),(181,1174,'0','bom-nuoc-1dz','','','XMVF','Bơm nước 1DZ','Bơm nước TOYOTA','水泵总成 ','','','','16100-78202-71-water-pump-1532099670096.jpg',0,0,'','','','','','',1520495303,0,0,0,'Bơm nước 1DZ','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','1DZ/7FD, 6FD','TOYOTA','','','','','','','','16100-78202-71,16100-78203-71'),(172,1123,'0','sua-xe-nang-633','reachtruck-car-bt-reflex-rre160-e-876','Reachtruck汽车BT-Reflex-RRE160-E-462','GZLQ','Sửa xe nâng','Sửa xe nâng','Reachtruck汽车BT Reflex RRE160 E','','The BT Replicas BT Reflex RRE160 E from Sweden also has the same characteristics as the previous BT Reflex RRE160 R forklift.','來自瑞典的BT Replicas BT Reflex RRE160 E也具有與以前的BT Reflex RRE160 R叉車相同的特性。','3t6261n9rykcyrlvs1fc1wb1c112299065368.jpg',0,0,'','','','','','',1519959215,0,0,1,'Sửa xe nâng','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','','','','','','','','','',''),(180,1174,'0','bom-nuoc-6','','','QIRL','Bơm nước 6bg1','Water Pump ','水泵总成 ','','','','Image496756502630.jpg',0,0,'','','','','','',1520486014,0,0,0,'Bơm nước 6','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','6bg1','ISUZU','','','','','','','','Z-1-13610-876-1,Z-1-13650-090-1'),(173,1172,'0','bom-thuy-luc-59','','','HP00-48','Bơm thủy lực','Hydraulic pump','液压油泵','','','','094190398626985.JPG',1000,0,'','','','','','',1520440089,0,0,0,'Bơ','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','FD30-11/4D95S\\FD30-11','KOMATSU','','','','','','','','37B-1KB-2020,3EB-60-12410,CBT-F430-AFL'),(174,1172,'0','b','','','4QEZ','Bơm thủy lực','Hydraulic pump','液压油泵','','','','image-652fd993afacdd19372f1b31667c1178106855b3868aec6a77441413709df960-V558584747713.jpg',1000,0,'','','','','','',1520440680,0,0,0,'b','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','FD35-45T/-7,6D102E、TB42','KOMATSU','','','','','','','','3EC-60-31711,3EC-60-31710,3EC-60-31211'),(175,1172,'0','b-272','h','','M273','Bơm thủy lực','Hydraulic pump','液压油泵','','','','DSC_0020950810377678.JPG',1000,0,'','','','','','',1520441306,0,0,0,'b','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','FG20-30H/-12,14','KOMATSU','','','','','','','','37B-1KB-3040,37B-1KB-3050'),(208,1175,'0','mam-xe-nang-650-10','rim-front-weel-414','轮辋','YN93','Mâm xe nâng 650-10','Rim,front weel','轮辋','','','','IMG_2247093136747147.JPG',0,0,'','','','','','',1520598953,1,0,0,'Mâm xe nâng 650-10','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','','','','','','','','','',''),(178,1174,'0','bom-nuoc-c240','','水泵总成','KIKI','Bơm nước C240','Water Pump','水泵总成 ','','','','IMG_20170516_164944336355005700.jpg',0,0,'','','','','','',1520484758,0,0,0,'Bơm nước C240','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','C240PKJ,C240PKG','ISUZU','','','','','','','','Z-8-94376-863-0,20801-0W012,Z-8-97379-807-0'),(176,1120,'0','','','gcgfcgfcg','V939','Mâm xe nâng','Mâm xe nâng','gcgfcgfcg','','','','IMG_2246432274945434.JPG',0,0,'','','','','','',1520473178,1,0,0,'','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','','','','','','','','','',''),(184,1174,'0','bom-nuoc-2z-3z','','','XNKX','Bơm nước 2Z,3Z','Water Pump','水泵总成 ','','','','1588946983611.jpg',0,0,'','','','','','',1520496446,0,0,0,'Bơm nước 2Z,3Z','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','2Z,3Z/8FD10-30','TOYOTA','','','','','','','',''),(185,1174,'0','bom-nuoc-2j','','','1J5X','Bơm nước 2j','Water Pump','水泵总成 ','','','','FB_IMG_1432211639839725911145730.jpg',0,0,'','','','','','',1520496985,0,0,0,'Bơm nước 2j','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','2J','TOYOTA','','','','','','','',''),(186,1174,'0','bom-nuoc-1dz-2z-3z','','','MAFP','Bơm nước 1DZ,2Z,3Z','Water Pump','水泵总成 ','','','','15390951_110469379447545_1726558813298638641_n715353081568.jpg',0,0,'','','','','','',1520497500,0,0,0,'Bơm nước 1DZ,2Z,3Z','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','1DZ/7FD,2Z1DZ,2Z, 3Z/8FD','TOYOTA','','','','','','','',''),(189,1174,'0','bom-nuoc-6d102','water-pump','','BLLG','Bơm nước 6D102','Water Pump ','水泵总成 ','','','','Image101771495881.jpg',0,0,'','','','','','',1520498263,0,0,0,'Bơm nước 6D102','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','FD35-50A/-7,-8  ;FD50-80/-7,-8/6D102E,','KOMATSU','','','','','','','','6735-61-1101,6735-61-1500,3EC-04-31711'),(188,1174,'0','bom-nuoc-4d95-4d98','','','4815','Bơm nước 4D95 ,4D98','Water Pump','水泵总成 ','','','','IMG_20160707_104927480446870504.jpg',0,0,'','','','','','',1520497973,0,0,0,'Bơm nước 4D95 ,4D98','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','4D95','KOMATSU','','','','','','','','6202-61-1201'),(190,1174,'0','bom-nuoc-6d95','','','OXZ2','Bơm nước 6D95','Water Pump','水泵总成 ','','','','Image566633529318.jpg',0,0,'','','','','','',1520498709,0,0,0,'Bơm nước 6D95','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','6D95S','komatsu','','','','','','','','6206-61-1102,6206-61-1100'),(191,1174,'0','bom-nuoc-4d94','water-pump-91','水泵总成-446','VA0D','Bơm nước 4D94 ','Water Pump','水泵总成 ','','','','15317864_110469356114214_4893288701974320479_n199619587150.jpg',0,0,'','','','','','',1520498866,0,0,0,'Bơm nước 4D94 ','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','4D94E,4D94E-C12 FD20/25/30,4D94LE,4TNV98E','KOMATSU','','','','','','','',''),(192,1120,'0','ac-di-xe-nang','','石油叉车','HRIK','Ắc dí xe nâng','Ắc dí xe nâng',' 石油叉车','ewretg','','','IMG_2443181936335290.JPG',550,0,'<h1>Ông Trần Ngọc Tâm được bổ nhiệm quyền Tổng giám đốc Nam A Bank</h1>\r\n\r\n<div class=\"social-time mb10\" style=\"box-sizing: border-box; margin-bottom: 10px; float: left; width: 563.264px; font-family: Arial, Helvetica, Roboto, sans-serif; font-size: 14px;\">\r\n<div class=\"social-left\" style=\"box-sizing: border-box; float: left;\">&nbsp;&nbsp;&nbsp;&nbsp;</div>\r\n\r\n<div class=\"time-top time-right\" style=\"box-sizing: border-box; text-align: right; padding: 0px; float: right;\">\r\n<ul>\r\n	<li>Thứ ba, 06/03/2018</li>\r\n	<li>&nbsp;</li>\r\n	<li>16:39 GMT + 7</li>\r\n</ul>\r\n</div>\r\n</div>\r\n\r\n<div class=\"clearfix\" style=\"box-sizing: border-box; font-family: Arial, Helvetica, Roboto, sans-serif; font-size: 14px;\">&nbsp;</div>\r\n\r\n<div class=\"desc-news-detail\" style=\"box-sizing: border-box; color: rgb(0, 0, 0); margin-bottom: 10px; font-weight: bold; font-size: 16px; font-family: Arial, Helvetica, Roboto, sans-serif;\"><span style=\"color:rgb(255, 255, 255); font-size:12px\">thegioitiepthi.vn</span>&nbsp;HĐQT Nam A Bank vừa có quyết định bổ nhiệm chức danh Quyền Tổng Giám đốc đối với ông Trần Ngọc Tâm sau khi có quyết định chấp thuận từ nhiệm chức vụ Tổng giám đốc của Bà Lương Thị Cẩm Tú theo nguyện vọng để thực hiện công việc mới theo định hướng cá nhân.</div>\r\n\r\n<div class=\"clearfix\" style=\"box-sizing: border-box; font-family: Arial, Helvetica, Roboto, sans-serif; font-size: 14px;\">&nbsp;</div>\r\n\r\n<div class=\"content-news\" style=\"box-sizing: border-box; font-size: 16px; font-family: Arial; line-height: 1.5; letter-spacing: 0.2px; word-spacing: 1px;\">\r\n<p style=\"text-align:center\"><img alt=\"\" src=\"http://thegioitiepthi.vn/img_data/images/MinhHai/new7/hinh-anh-tran-ngoc-tam-1.jpg\" style=\"border:0px; box-sizing:border-box; height:900px; max-width:100%; vertical-align:middle; width:600px\" /></p>\r\n</div>\r\n','','','','','',1520499045,1,0,0,'Ắc dí xe nâng','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','','','','','','','','','',''),(193,1174,'0','bom-nuoc-s4s-s6s','','','R6OT','Bơm nước S4S , S6S','Water Pump','水泵总成 ','','','','IMG_3908189734190169.JPG',0,0,'','','','','','',1520499143,1,0,0,'Bơm nước S4S , S6S','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','S4S,S6S/FD35-50','MITSUBISHI','','','','','','','','34745-00022,34745-01010,34545-00013,34745-11010,34545-10010'),(194,1172,'0','bom-thuy-luc-mitsubishi-881','','','BKYL','Bơm thủy lực MITSUBISHI','HYDRAULIC PUMP','液压油泵','','','','image-01298cf3d3528f7d0de957e5cd9b62a5ce2d6c738a504692b79542b47d48cf88-V034771402765.jpg',0,0,'','','','','','',1520502108,0,0,0,'Bơm thủy lực MITSUBISHI','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','F18A/S4E,S4E2','MITSUBISHI','','','','','','','','91271-26200'),(195,1172,'0','b-328','h-19','','KYXA','Bơm thủy lực MITSUBISHI','Hydraulic pump','液压油泵','','','','IMG_0775119606426864.JPG',0,0,'','','','','','',1520502470,0,0,0,'b','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','FD20-30,FD20-30K MC/S4S','Bơm thủy lực','','','','','','','','91771-10600, 91771-00100'),(196,1172,'0','b-814','','','LJ7N','Bơm thủy lực MITSUBISHI','Hydraulic pump','液压油泵','','','','image-1fc6092803e37c28e329f029c214e60c6e582920a46cbbeed1e5d83ee17699cf-V618438038850.jpg',0,0,'','','','','','',1520502838,0,0,0,'b','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','FG20-25N/K21','MITSUBISHI','','','','','','','','91E71-10200,69101-FK281'),(197,1172,'0','b-603','h-306','','65H8','Bơm thủy lực MITSUBISHI','Hydraulic pump','液压油泵','','','','IMG_3992840514759203.JPG',0,0,'','','','','','',1520503421,0,0,0,'b','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','FD40-50(F19B-F28A)s6s','MITSUBISHI','','','','','','','','91871-03600,91871-32100'),(198,1172,'0','b-569','h-930','','57M6','Bơm thủy lực MITSUBISHI','Hydraulic pump','液压油泵','','','','17799239_202325680261914_3447063893686526740_n149425818920.jpg',0,0,'','','','','','',1520505287,0,0,0,'b','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','4g63,4g64','MITSUBISHI','','','','','','','','91371-10300/91571-10100'),(199,1172,'0','b-879','h-752','','RR5A','Bơm thủy lực','Hydraulic pump','液压油泵','','','','IMG_2257602559340322.JPG',0,0,'','','','','','',1520506416,0,0,0,'b','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','FD30 with S4S','MITSUBISHI','','','','','','','','16312-53361'),(200,1172,'0','bom-thuy-luc-mitsubishi','h-95','','BYJQ','Bơm thủy lực MITSUBISHI','Hydraulic pump','液压油泵','','','','image-01298cf3d3528f7d0de957e5cd9b62a5ce2d6c738a504692b79542b47d48cf88-V405818720242.jpg',0,0,'','','','','','',1520507346,0,0,0,'Bơm thủy lực MITSUBISHI','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','','MITSUBISHI','','','','','','','','9147-46100,N-69101-4K005'),(201,1172,'0','bom-thuy-luc-komatsu','h-478','','JUB4','Bơm thủy lực komatsu','Hydraulic pump','液压油泵','','','','094860617327432.JPG',0,0,'','','','','','',1520509228,0,0,0,'Bơm thủy lực komatsu','','','','',0,0,0,0,'','','','','','','','','','','',0,0,0,'','FD30-11/4D95S\\FD30-11/C240\\HL a 2-3T with C240','KOMATSU','','','','','','','','37B-1KB-2020,3EB-60-12410,CBT-F430-AFL'),(205,1172,'0','b-939','h-302','','F5TG','Bơm thủy lực','Hydraulic pump','液压油泵','','','','IMG_2534437259239043.JPG',0,0,'','','','','','',1520598209,1,0,0,'b','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','','','','','','','','','',''),(202,1175,'0','mam-xe-nang-700-12','rim-front-weel-696','轮辋-46','QREP','Mâm xe nâng 700-12','Rim,front weel','轮辋','','','','IMG_2246951483220148.JPG',0,0,'','','','','','',1520596143,1,0,0,'Mâm xe nâng 700-12','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','','','','','','','','','',''),(203,1172,'0','bo-317','h-779','','GHFZ','Bơm thủy lực','Hydraulic pump','液压油泵','','','','20161020_172327635379143372.jpg',0,0,'','','','','','',1520597984,1,0,0,'bơ','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','','','','','','','','','',''),(204,1172,'0','b-506','h-243','','SORU','Bơm thủy lực','Hydraulic pump','液压油泵','','','','IMG_2533774113988178.JPG',0,0,'','','','','','',1520598041,1,0,0,'b','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','','','','','','','','','',''),(206,1172,'0','b-835','h-399','','8EW2','Bơm thủy lực','Hydraulic pump','液压油泵','','','','IMG_2539647109624368.JPG',0,0,'','','','','','',1520598580,1,0,0,'b','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','','','','','','','','','',''),(207,1172,'0','','h-424','','YB6C','Bơm thủy lực','Hydraulic pump','液压油泵','','','','IMG_2540213151698584.JPG',0,0,'','','','','','',1520598646,1,0,0,'','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','','','','','','','','','',''),(209,1156,'0','de-xe-nang-toyota','starter-185','启动马达总成-56','GR90','Đề xe nâng TOYOTA','STARTER','启动马达总成','','','','IMG_2943111955838454.JPG',0,0,'','','','','','',1520599222,1,0,0,'Đề xe nâng TOYOTA','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','','','','','','','','','',''),(210,1156,'0','de-xe-nang-toyota-737','starter-886','启动马达总成-290','JOZR','Đề xe nâng TOYOTA','STARTER','启动马达总成','','test','','IMG_0582716408241806.JPG',0,0,'','<p>test</p>\r\n','','','','',1520599442,1,0,0,'Đề xe nâng TOYOTA','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','','','','','','','','','',''),(211,1148,'0','sua-xe-nang-115','','','C9N5','sửa xe nâng','sửa xe nâng','sửa xe nâng','','','','IMG_20161010_081118599662394970.jpg',0,0,'','','','','','',1521086741,0,0,1,'sửa xe nâng','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','','','','','','','','','',''),(212,1151,'0','xe-nang-tcm-126','','','6K3R','xe nâng tcm','','','','','','IMG_0752750941098613.JPG',0,0,'','','','','','',1521087281,0,0,0,'xe nâng tcm','','','','',0,0,0,1,'','','','','','','','','','','',0,0,0,'','','','','','','','','','','');
/*!40000 ALTER TABLE `db_sanpham` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_sanpham_hinhanh`
--

DROP TABLE IF EXISTS `db_sanpham_hinhanh`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_sanpham_hinhanh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sp` int(11) NOT NULL,
  `hinh_anh` varchar(255) NOT NULL,
  `title` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=740 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_sanpham_hinhanh`
--

LOCK TABLES `db_sanpham_hinhanh` WRITE;
/*!40000 ALTER TABLE `db_sanpham_hinhanh` DISABLE KEYS */;
INSERT INTO `db_sanpham_hinhanh` VALUES (570,157,'IMG_20141229_141955386257081011.jpg','bơm thủy lực'),(575,158,'image-ac8d5bb64e88527baff03da8bafbae1e823ff6ab7cc4f3a150eb51932cc8a1fb-V566683845015.jpg','Mâm ép'),(582,159,'IMG_0837156774790330.JPG','Heo thắng'),(592,160,'IMG_1366314782176013.JPG','Bạc đạn khung nâng'),(587,161,'IMG_2677575391375386.JPG','Heo con'),(600,163,'18893287_342602006157793_6783646804449057631_n662897487156.jpg','Đèn cảnh báo'),(626,162,'20130614_123943400256633887.jpg','Bơm Nước'),(599,163,'5a6yrjq5qpjfyizw41wrvoqj2-(1)231829698988.jpg','Đèn cảnh báo'),(614,164,'IMG_3286-(1)007959004190.JPG','Càng bố Thắng'),(618,165,'20160419_182753922933195269.jpg','Bánh đà xe nâng'),(621,166,'IMG_0621-(2)450984488720.JPG','Máy phát điện'),(609,167,'IMG_2516-(1)836281174250.JPG','Bơm nhớt động cơ'),(604,168,'108030689478406.JPG','Đèn xe nâng'),(594,160,'IMG_2580951527258637.JPG','Bạc đạn khung nâng'),(593,160,'IMG_2995947130612085.JPG','Bạc đạn khung nâng'),(595,160,'IMG_1366353124991813.JPG','Bạc đạn khung nâng'),(564,173,'093301582773071.JPG',''),(563,173,'094810860493412.JPG',''),(565,173,'095707783874850.JPG',''),(566,174,'IMG_0571178785613074.JPG',''),(567,174,'IMG_1644055026572430.JPG',''),(568,174,'IMG_1645-(1)805676083862.JPG',''),(569,175,'DSC_0021426568850103.JPG',''),(571,157,'IMG_2536812702100735.JPG','bơm thủy lực'),(572,157,'IMG_2524818830869594.JPG','bơm thủy lực'),(573,157,'IMG_2539303415507877.JPG','bơm thủy lực'),(574,157,'IMG_2538088152643436.JPG','bơm thủy lực'),(576,158,'IMG_3229228418947244.JPG','Mâm ép'),(577,158,'IMG_0782-(1)691072138896.JPG','Mâm ép'),(578,158,'FB_IMG_1495682536855181692215066.jpg','Mâm ép'),(579,158,'FB_IMG_1495682540564961695155352.jpg','Mâm ép'),(580,176,'IMG_2247194826665321.JPG','Mâm xe nâng'),(581,176,'IMG_2244167304458675.JPG','Mâm xe nâng'),(583,159,'IMG_2686728489187308.JPG','Heo thắng'),(584,159,'IMG_2689522680395062.JPG','Heo thắng'),(585,159,'IMG_2690442585567305.JPG','Heo thắng'),(586,159,'IMG_2687223963826084.JPG','Heo thắng'),(588,161,'IMG_2678303311831448.JPG','Heo con'),(589,161,'IMG_2694939486643173.JPG','Heo con'),(590,161,'IMG_2866211849589921.JPG','Heo con'),(591,161,'IMG_2695004249142191.JPG','Heo con'),(596,160,'IMG_2995856213499152.JPG','Bạc đạn khung nâng'),(597,160,'IMG_2580393375000422.JPG','Bạc đạn khung nâng'),(601,163,'FB_IMG_1497192647915607857181263.jpg','Đèn cảnh báo'),(602,163,'IMG_2222-(1)223022988178.JPG','Đèn cảnh báo'),(603,163,'IMG_2472827632203998.JPG','Đèn cảnh báo'),(605,168,'image-11ec6134b66b0bf0cce2ca012b631642669248ae8a4548d5eef2652afcd04867-V570889164283.jpg','Đèn xe nâng'),(606,168,'image-db84c17340106f35a31246a7a0b5c7227b468808999ce4c5f826513f1c875b1f-V903419213382.jpg','Đèn xe nâng'),(607,168,'IMG_0410239170738816.JPG','Đèn xe nâng'),(608,168,'IMG_2731733252643994.JPG','Đèn xe nâng'),(610,167,'IMG_2429280697642960.JPG','Bơm nhớt động cơ'),(611,167,'IMG_20160530_121320-(1)409416800528.jpg','Bơm nhớt động cơ'),(612,167,'IMG_2430636062190259.JPG','Bơm nhớt động cơ'),(613,167,'1qw6k460anka0t8ehq14kotto924111251103.jpg','Bơm nhớt động cơ'),(615,164,'IMG_3292-(1)672109945764.JPG','Càng bố Thắng'),(616,164,'IMG_3296-(1)482190190885.JPG','Càng bố Thắng'),(617,164,'IMG_20150127_142155896206364574.jpg','Càng bố Thắng'),(619,165,'IMG_1575545558062288.JPG','Bánh đà xe nâng'),(620,165,'IMG_1579172088280574.JPG','Bánh đà xe nâng'),(622,166,'IMG_2948-(1)912362952458.JPG','Máy phát điện'),(623,166,'IMG_2944-(2)707077323312.JPG','Máy phát điện'),(624,166,'IMG_3882850632624960.JPG','Máy phát điện'),(625,166,'IMG_20150813_180123-(2)165301282099.jpg','Máy phát điện'),(627,162,'20130614_123943180470326056.jpg','Bơm Nước'),(628,162,'15326479_110471562780660_3372326278517108508_n808217467483.jpg','Bơm Nước'),(629,162,'IMG_20160707_104334147435244292.jpg','Bơm Nước'),(630,162,'IMG_20170516_164833325031611442.jpg','Bơm Nước'),(631,177,'IMG_0413553726238758.JPG','Cùi dĩa'),(632,177,'IMG_0150-(2)885891946610.JPG','Cùi dĩa'),(633,177,'IMG_0788-(1)344793848211.JPG','Cùi dĩa'),(634,177,'IMG_0787844720519098.JPG','Cùi dĩa'),(635,177,'IMG_0153192854888267.JPG','Cùi dĩa'),(636,178,'IMG_3193-(2)755021347710.JPG','Bơm Nước'),(637,179,'IMG_3191886079795890.JPG','Bơm Nước'),(638,180,'27540574_362608584215456_1344342218244034118_n874369675626.jpg','Bơm Nước'),(639,181,'IMG_20170529_104008913592065869.jpg','Bơm Nước'),(640,181,'16100-78202-71-water-pump488027671980.jpg','Bơm Nước'),(641,181,'IMG_20170516_164833848857559909.jpg','Bơm Nước'),(642,181,'27656967_362608190882162_140953383960348665_n105692631443.jpg','Bơm Nước'),(643,181,'IMG_3192201399483269.JPG','Bơm Nước'),(644,182,'20130614_123935228599726691.jpg','Bơm Nước '),(645,182,'20130614_123943392611933792.jpg','Bơm Nước'),(646,182,'20130614_124014674344564344.jpg','Bơm Nước'),(647,182,'IMG_3191246399529880.JPG','Bơm Nước'),(648,183,'IMG_3300345043133998.JPG','Bơm Nước'),(649,183,'IMG_3302683584361400.JPG','Bơm Nước'),(650,183,'IMG_20160916_093102838661996400.jpg','Bơm Nước'),(651,183,'IMG_20160916_093145814213172430.jpg','Bơm Nước'),(652,183,'IMG_3192967007191957.JPG','Bơm Nước'),(653,184,'2272387876314.jpg',''),(654,184,'23518806_215830035624417_6724772022880504855_n909736984778.jpg',''),(655,184,'IMG_20160916_093145477838955283.jpg',''),(656,184,'IMG_3193-(2)070602003976.JPG',''),(657,185,'20130614_123935505527585027.jpg','Bơm Nước'),(658,185,'FB_IMG_1435751188334326892275877.jpg','Bơm Nước'),(659,185,'IMG_3193981565625177.JPG','Bơm Nước'),(660,186,'IMG_3195156772150672.JPG',''),(661,186,'741d6badd8fa37a46eeb786159721366.jpg',''),(662,186,'27540574_362608584215456_1344342218244034118_n675722547225.jpg',''),(663,186,'IMG_3192-(1)540608977592.JPG',''),(667,189,'IMG_3191-(1)026075045714.JPG',''),(665,188,'IMG_20160707_104334618394924514.jpg',''),(666,188,'IMG_20160707_104946025322960914.jpg',''),(668,190,'3201231021387.jpg','Bơm Nước'),(669,190,'6841090446000.jpg','Bơm Nước'),(670,190,'4352393214448.jpg','Bơm Nước'),(671,191,'IMG_20160707_104334199022297784.jpg',''),(672,191,'IMG_20160707_104946028496115187.jpg',''),(673,193,'15319238_110471612780655_2904967758733949467_n090291944645.jpg','Bơm Nước'),(674,193,'IMG_20170529_104025181720153642.jpg','Bơm Nước'),(675,193,'IMG_3908242994403422.JPG','Bơm Nước'),(676,193,'24068572_1887192354930331_7278127032201360099_o617181600873.jpg','Bơm Nước'),(677,192,'IMG_2242399977698389.JPG',''),(678,192,'IMG_2993168746254357.JPG',''),(679,192,'IMG_2243081510650548.JPG',''),(680,192,'IMG_2990217145061835.JPG',''),(681,192,'IMG_2442561907706867.JPG',''),(682,193,'IMG_3910770245243492.JPG','Bơm Nước'),(683,194,'image-6d452f56d24802e23df6ae5cf516965d23a5566e1a3a741389c3b5874620fe49-V965896200624.jpg','bơm thủy lực'),(684,194,'IMG_3990672810014592.JPG','bơm thủy lực'),(689,195,'image-b9e2bef2ab78026c865098daae732aff2063ea135a2ee7d2a2f0a3c978014ac8-V241496996052.jpg','bơm thủy lực'),(686,194,'IMG_20150513_161503605768125417.jpg','bơm thủy lực'),(687,194,'IMG_0768418967130321.JPG','bơm thủy lực'),(688,194,'IMG_2533271879440016.JPG','bơm thủy lực'),(690,195,'IMG_0576-(2)905577773838.JPG','bơm thủy lực'),(691,195,'IMG_2541096749774813.JPG','bơm thủy lực'),(692,196,'IMG_1568957660716585.JPG',''),(693,196,'IMG_1567759940669198.JPG',''),(694,196,'IMG_0578126986782549.JPG',''),(695,197,'IMG_3994424138337692.JPG',''),(696,197,'IMG_2535990249744892.JPG',''),(697,197,'IMG_20160523_104318385421773286.jpg',''),(698,197,'IMG_20160523_104343010779979093.jpg',''),(699,198,'20161020_172432428972750252.jpg',''),(700,198,'20161020_172409357318813062.jpg',''),(701,199,'image-a85f87ed0349e16d8a57816635310e5dda2f5f55e585041ef943db3eeeb51245-V011319901489.jpg','bơm thủy lực'),(702,199,'IMG_0578530577602196.JPG','bơm thủy lực'),(703,199,'IMG_0776590818620761.JPG','bơm thủy lực'),(704,199,'IMG_2259751890853801.JPG','bơm thủy lực'),(705,199,'image-125bbf14b60e118dff27f67369844a7887799d4368a7c3f3d44f713809a18def-V661881530522.jpg','bơm thủy lực'),(706,200,'image-30111f4673fa37f6a8754d7c54a5a82b2b991eb23ad8021a910d3dfb739a7fd3-V480712948545.jpg',''),(707,200,'IMG_20150127_142217353156552460.jpg',''),(708,200,'IMG_2539191443581563.JPG',''),(709,201,'093299401238667.JPG',''),(710,201,'095747654414031.JPG',''),(711,201,'image-125bbf14b60e118dff27f67369844a7887799d4368a7c3f3d44f713809a18def-V495352136991.jpg',''),(712,198,'4d892e86b63759690026029431848036.jpg','bơm thủy lực'),(713,202,'IMG_2247163001291468.JPG','mâm xe nâng'),(714,202,'IMG_20170918_225919915586381520.jpg','mâm xe nâng'),(715,202,'IMG_20170918_225924852966783184.jpg','mâm xe nâng'),(716,208,'IMG_20170918_225931774979072290.jpg','mâm xe nâng'),(717,208,'IMG_20170918_225934145250250673.jpg','mâm xe nâng'),(718,210,'IMG_20170516_164643628009890546.jpg','Đề xe nâng'),(719,210,'IMG_20170516_164646147539255754.jpg','Đề xe nâng'),(720,211,'IMG_20161023_093935444471133073.jpg','sửa xe nâng'),(721,211,'IMG_20160927_083634932480079732.jpg','sửa xe nâng'),(722,211,'IMG_20161023_094024036007151509.jpg','sửa xe nâng'),(723,211,'IMG_20161010_081100712029412660.jpg','sửa xe nâng'),(724,211,'IMG_20160927_083739778652866567.jpg','sửa xe nâng'),(725,212,'IMG_0755641827843622.JPG',''),(726,212,'IMG_0756025446322316.JPG',''),(727,212,'IMG_0757526387642724.JPG',''),(728,213,'115643402001929.JPG',''),(729,213,'116720505823087.JPG',''),(730,213,'117630953827168.JPG',''),(731,214,'IMG_1693263162256260.JPG','bơm nhớt hộp số'),(732,214,'IMG_1912595667270800.JPG','bơm nhớt hộp số'),(733,214,'IMG_2996065891318724.JPG','bơm nhớt hộp số'),(734,214,'IMG_2997059675734291.JPG','bơm nhớt hộp số'),(735,215,'IMG_20161023_095531663648358901.jpg',''),(736,215,'IMG_20161023_095510564434251463.jpg',''),(737,215,'4lc800096rz7wcdlxrw1lx180096356012386.jpg',''),(738,215,'1qcmfzz329jc6jju3d1h0ic9j121912179512.jpg',''),(739,215,'20161023_090915947084483129.jpg','');
/*!40000 ALTER TABLE `db_sanpham_hinhanh` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_sanpham_phienban`
--

DROP TABLE IF EXISTS `db_sanpham_phienban`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_sanpham_phienban` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sanpham` int(11) NOT NULL,
  `id_extra` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_sanpham_phienban`
--

LOCK TABLES `db_sanpham_phienban` WRITE;
/*!40000 ALTER TABLE `db_sanpham_phienban` DISABLE KEYS */;
INSERT INTO `db_sanpham_phienban` VALUES (1,59,1,0),(2,59,31,0),(3,59,33,1),(24,64,1,0),(25,64,31,0),(26,64,32,0),(27,64,5,1),(28,64,33,1),(44,68,1,0),(45,68,31,0),(46,68,32,0),(47,68,5,1),(48,68,33,1),(64,71,1,0),(65,71,31,0),(66,71,32,0),(67,71,5,1),(68,71,33,1),(69,70,1,0),(70,70,31,0),(71,70,32,0),(72,70,5,1),(73,70,33,1),(74,69,1,0),(75,69,31,0),(76,69,32,0),(77,69,5,1),(78,69,33,1),(79,67,1,0),(80,67,31,0),(81,67,32,0),(82,67,5,1),(83,67,33,1),(84,66,1,0),(85,66,31,0),(86,66,32,0),(87,66,5,1),(88,66,33,1),(89,65,1,0),(90,65,31,0),(91,65,32,0),(92,65,5,1),(93,65,33,1),(109,63,1,0),(110,63,31,0),(111,63,32,0),(112,63,5,1),(113,63,33,1),(114,62,1,0),(115,62,31,0),(116,62,32,0),(117,62,5,1),(118,62,33,1),(119,61,1,0),(120,61,31,0),(121,61,32,0),(122,61,5,1),(123,61,33,1),(124,60,1,0),(125,60,31,0),(126,60,32,0),(127,60,5,1),(128,60,33,1);
/*!40000 ALTER TABLE `db_sanpham_phienban` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_seo`
--

DROP TABLE IF EXISTS `db_seo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_seo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_vn` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title_us` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `keyword_vn` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `keyword_us` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description_vn` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description_us` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `g_a` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_seo`
--

LOCK TABLES `db_seo` WRITE;
/*!40000 ALTER TABLE `db_seo` DISABLE KEYS */;
INSERT INTO `db_seo` VALUES (1,'CÔNG TY TNHH THIẾT BỊ XE NÂNG VÂN THIÊN HÙNG','','CÔNG TY TNHH THIẾT BỊ XE NÂNG VÂN THIÊN HÙNG','','CÔNG TY TNHH THIẾT BỊ XE NÂNG VÂN THIÊN HÙNG','','');
/*!40000 ALTER TABLE `db_seo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_setting`
--

DROP TABLE IF EXISTS `db_setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten_vn` varchar(255) NOT NULL,
  `ten_us` varchar(255) NOT NULL,
  `ten_jp` varchar(255) NOT NULL,
  `ten_ch` text NOT NULL,
  `noi_dung_vn` longtext NOT NULL,
  `noi_dung_us` longtext NOT NULL,
  `noi_dung_jp` longtext NOT NULL,
  `noi_dung_ch` text NOT NULL,
  `hinh_anh` varchar(255) NOT NULL,
  `title_vn` varchar(255) NOT NULL,
  `title_us` varchar(255) NOT NULL,
  `title_jp` varchar(255) NOT NULL,
  `title_ch` text NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `des` varchar(255) NOT NULL,
  `hien_thi` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_setting`
--

LOCK TABLES `db_setting` WRITE;
/*!40000 ALTER TABLE `db_setting` DISABLE KEYS */;
INSERT INTO `db_setting` VALUES (10,'Text trang liên hệ','Text trang liên hệ','','Text trang liên hệ','<div>\r\n<p><strong>CÔNG TY TNHH THIẾT BỊ XE NÂNG VÂN THIÊN HÙNG</strong></p>\r\n\r\n<p>Địa chỉ:&nbsp;Ki ốt số 7, đường số 1, KCN Đồng An - P. Bình Hòa - TX Thuận An - Bình Dương</p>\r\n\r\n<p><span style=\"color:rgb(255, 255, 255); font-family:arial; font-size:14px\">Ki ốt số 7, đường số 1, KCN Đồng An - P. Bình Hòa - TX Thuận An - Bình Dương</span></p>\r\n\r\n<p>Hotline: 0902 70 73 79</p>\r\n\r\n<p>Email: xe.xenang@gmail.com</p>\r\n\r\n<p>Website: www.vanthienhung.vn</p>\r\n</div>\r\n\r\n<p>&nbsp;</p>\r\n','<p>NANG VAN THIEN HUNG TRUCK EQUIPMENT CO., LTD</p>\r\n\r\n<p>Ki ốt số 7, đường số 1, KCN Đồng An - P. Bình Hòa - TX Thuận An - Bình Dương</p>\r\n\r\n<p>Hotline: 0902 70 73 79</p>\r\n\r\n<p>Email: xe.xenang@gmail.com</p>\r\n\r\n<p>Website: www.vanthienhung.vn</p>\r\n','','<p>南梵軒車輛設備有限公司</p>\r\n\r\n<p>Ki ốt số 7, đường số 1, KCN Đồng An - P. Bình Hòa - TX Thuận An - Bình Dương</p>\r\n\r\n<p>Hotline: 0902 70 73 79</p>\r\n\r\n<p>Email: xe.xenang@gmail.com</p>\r\n\r\n<p>Website: www.vanthienhung.vn</p>\r\n','','','','','','','',1),(28,'VÂN THIÊN HÙNG','VAN THIEN HUNG','','VAN THIEN HUNG','<p>“Sản Phẩm Tốt – Giá tốt – Dịch Vụ Tốt”</p>\r\n\r\n<p>Chuyên cung cấp phụ tùng xe nâng hàng , sửa chữa xe nâng hàng ,mua bán xe nâng hàng ,cho thuê xe nâng hàng</p>\r\n','<div>\"Good Product - Good Price - Good Service\"</div>\r\n\r\n<div>\r\n<p>Supply of forklift spare parts, forklift repair, forklifts, forklifts</p>\r\n</div>\r\n','','<p>“良好的产品 - 良好的价格 - 良好的服务”</p>\r\n\r\n<p>供应叉车零配件，叉车修理，叉车，叉车</p>\r\n','','','','','','','',1),(29,'Đặt hàng thành công','','','','<p><span style=\"font-size:14px\"><strong><span style=\"color:#FF0000\">Đặt hàng thành công!<br />\r\n<br />\r\nChúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất. Xin cảm ơn!</span></strong></span></p>\r\n','','','','','','','','','','',1),(30,'Logo','','','','','','','','favicon538904166815.png','','','','','','',1),(46,'Về chúng tôi','About us','','關於我們','<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:14px\"><span style=\"color:rgb(51, 51, 51); font-family:arial,sans-serif\">Vân Thiên Hùng là công ty chuyên sửa chữa , cung cấp phụ tùng thiết bị xe nâng , phục vụ nhiều đối tượng khách hàng, bao gồm ngành sản xuất và chế biến, xưởng đóng tàu, cảng biển và sân bay. Bất kể nhu cầu xe nâng nào của khách hàng , Vân Thiên Hùng &nbsp;cam kết cung cấp cho khách hàng thiết bị và dịch vụ xe nâng tốt nhất,&nbsp;góp phần tăng giá trị và hiệu quả kinh doanh của khách hàng .</span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:14px\"><span style=\"color:rgb(51, 51, 51); font-family:arial,sans-serif\">Chúng tôi luôn hết lòng cải thiện hiệu quả kinh doanh ở tất cả các ngành. Và chúng tôi đã thực hiện được bằng việc không ngừng cung cấp thiết bị và dịch vụ xe nâng mà khách hàng có thể tin tưởng.</span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:14px\"><span style=\"color:rgb(51, 51, 51); font-family:arial,sans-serif\">Khi khách hàng lựa chọn Vân Thiên Hùng , Khách hàng có nhiều dịch vụ và phụ tùng thay thế được sự trợ giúp của các hãng xe nâng hàng đầu thế giới.</span></span></p>\r\n','<p>Is a unit specializing in the supply of forklift trucks and spare parts.<br />\r\nOur company offers a wide range of vehicles including:<br />\r\n- Electric forklift: Electric, Oil, Gas, Gas<br />\r\n- Hand pallet trucks: Automatic and semi-automatic<br />\r\nOur company also deal in spare parts such as: Paper clamps, Electric Kettle, Tires, Back-up Control Boards, Lifting and Steering, Filter, Propeller, etc. Also available forklifts from 1 to 15 tons such as TCM, Hyter, Komatsu, Nissan, Toyota, Clack, Crow, ..</p>\r\n','','<p>是一個專門從事叉車和備件供應的單位。<br />\r\n我們公司提供多種車輛，包括：<br />\r\n- 電動叉車：電力，石油，天然氣，煤氣<br />\r\n- 手動托盤搬運車：自動和半自動<br />\r\n我們公司還經營備件，如：紙夾，電熱水壺，輪胎，備用控制板，起重和轉向，過濾器，螺旋槳等。 也可提供從1到15噸的叉車，如TCM，Hyter，小松，日產，豐田，克拉克，烏鴉，..</p>\r\n','','','','','','','',1),(47,'Thông tin footer 2','','','','<p><span style=\"font-size:20px\"><strong>CÔNG TY TNHH THIẾT BỊ XE NÂNG VÂN THIÊN HÙNG</strong></span></p>\r\n\r\n<p>Địa chỉ: Ki ốt số 7, đường số 1, KCN Đồng An - P. Bình Hòa - TX Thuận An - Bình Dương</p>\r\n\r\n<p>Điện thoại: <span style=\"font-size:22px\"><strong><span style=\"color:#FF0000\">0274 350 17 63 - 0902 70 73 79</span></strong></span></p>\r\n\r\n<p>Email: <span style=\"color:#FF0000\"><span style=\"font-size:20px\">xe.xenang@gmail.com</span></span></p>\r\n\r\n<p>Website: <span style=\"color:#FF0000\"><span style=\"font-size:20px\">www.vanthienhung.vn</span></span></p>\r\n','<p>VAN THIEN HUNG TRUCK EQUIPMENT CO., LTD</p>\r\n\r\n<p>Address: Kiosk No.7, Road No. 1, Dong An Industrial Park - Binh Hoa Ward - Thuan An Township - Binh Duong Province</p>\r\n\r\n<p>Tel: 06506517326 - 0902 70 73 79</p>\r\n\r\n<p>Email: xe.xenang@gmail.com</p>\r\n\r\n<p>Website: www.vanthienhung.vn</p>\r\n','','<p>南梵軒車輛設備有限公司</p>\r\n\r\n<p>地址：平安區順安鄉東和工業區平和坊道1號亭7號舖</p>\r\n\r\n<p>電話：06506 517 326 - 0902 70 73 79</p>\r\n\r\n<p>電子郵件：xe.xenang@gmail.com</p>\r\n\r\n<p>網站：www.vanthienhung.vn</p>\r\n','','','','','','','',1),(48,'Chi nhánh Bắc Ninh',' Bac Ninh Branch','',' Bac Ninh分行','<p><span style=\"font-size:14px\"><span style=\"font-family:arial,helvetica,sans-serif\">ĐC :KCN Quế võ Huyện Quế Võ ,Bắc Ninh</span></span><br />\r\n<span style=\"font-family:arial,helvetica,sans-serif\"><span style=\"font-size:14px\">Điện thoại :</span></span>&nbsp;<span style=\"font-size:22px\"><span style=\"font-family:arial,helvetica,sans-serif\"><span style=\"color:#FF0000\">02226 512 555 - 0902 833 040</span></span></span></p>\r\n\r\n<p><span style=\"font-size:14px\"><span style=\"font-family:arial,helvetica,sans-serif\">Email: <span style=\"color:#FF0000\">xe.xenang@gmail.com</span></span></span></p>\r\n','<p><span style=\"font-size:14px\">Address: Que Vo Industrial Park Que Vo District Bac Ninh Provice</span></p>\r\n\r\n<p>Phone :<span style=\"color:#000000\"><span style=\"font-family:arial,sans-serif; font-size:18px\"> </span></span><span style=\"color:rgb(255, 0, 0)\"><span style=\"font-family:arial,sans-serif; font-size:18px\">02226 512 555 - 0902 833 040</span></span></p>\r\n\r\n<div>\r\n<p><span style=\"font-size:14px\">Email: <span style=\"color:#FF0000\">xe.xenang@gmail.com</span></span></p>\r\n</div>\r\n','','<p><span style=\"font-size:12px\">地址：Que Vo工业区Que Vo地区Bac Ninh省</span></p>\r\n\r\n<p><span style=\"font-size:14px\">电话 :&nbsp;<span style=\"color:#FF0000\"><span style=\"font-size:22px\">02226 512 555 - 0902 833 040</span></span></span></p>\r\n\r\n<p>电子邮件：xe.xenang@gmail.com</p>\r\n','','','','','','','',1);
/*!40000 ALTER TABLE `db_setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_slide_sp`
--

DROP TABLE IF EXISTS `db_slide_sp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_slide_sp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hinh_anh` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `href` varchar(255) DEFAULT NULL,
  `title_vn` varchar(255) DEFAULT NULL,
  `mo_ta_vn` varchar(255) NOT NULL,
  `mo_ta_us` varchar(255) NOT NULL,
  `title_us` varchar(255) NOT NULL,
  `so_thu_tu` int(11) NOT NULL DEFAULT '1',
  `hien_thi` tinyint(1) NOT NULL DEFAULT '1',
  `id_loai` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=115 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_slide_sp`
--

LOCK TABLES `db_slide_sp` WRITE;
/*!40000 ALTER TABLE `db_slide_sp` DISABLE KEYS */;
INSERT INTO `db_slide_sp` VALUES (102,'slide818832916548.jpg','','','Slider 1','','','',1,1,0),(105,'3-15-2018-10-54-55-PM745159405432.jpg','','','Slider 2','','','',2,1,0),(109,'Capture798537517011.JPG','','','Slider 3','','','',3,1,0),(113,'4525630841018.jpg','','','Slider 5','','','',5,1,0),(112,'10083168238556.jpg','','','Slider 4','','','',4,1,0),(114,'2037609241316.jpg','','','Slider 6','','','',6,1,0);
/*!40000 ALTER TABLE `db_slide_sp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_tags`
--

DROP TABLE IF EXISTS `db_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten_vn` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=174 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_tags`
--

LOCK TABLES `db_tags` WRITE;
/*!40000 ALTER TABLE `db_tags` DISABLE KEYS */;
INSERT INTO `db_tags` VALUES (100,'sửa xe nâng biên hòa , sửa xe nâng Bắc Ninh','cho-thue-Thuan-Duc'),(99,'sửa xe nâng hố nai , sửa xe nâng Hà Nội','Quang-Dong-nang'),(98,'sửa xe nâng kcx tân thuận , sửa xe nâng Vĩnh Long','xe-nang-hang'),(97,'sửa xe nâng kcn long thành , sửa xe nâng Đồng tháp','xe-nang'),(101,'sửa xe nâng sóng thần  , sửa xe nâng Bắc Giang','cho-thue-xe-nang-Trung-Son'),(102,'sửa xe nâng linh trung , sửa xe nâng hà Nam','cho-thue-xe-nang-Phat-Son'),(103,'sửa xe nâng kcn long bình, sửa xe nâng Hải Dương','cho-thue-xe-nang-Zhuhai'),(104,'sửa xe nâng kcn tân tạo , sửa xe nâng Phú thọ','xe-nang-Thue-Giang-Mon'),(105,'sửa xe nâng kcn tân phú trung , sửa xe nâng Vĩnh Phúc','xe-nang-cho-thue-Trieu-Khanh'),(106,'sửa xe nâng kcn củ chi , sửa xe nâng Thái nguyên','xe-nang-cho-thue-Quang-Chau-Phien-Ngung'),(107,'sửa xe nâng kcn Mỹ phước , sửa xe nâng Hải Phòng','xe-nang-cho-thue-Quang-Chau-Hoang-Pho'),(108,'sửa xe nâng kcn long hậu , sửa xe nâng Thanh hóa','xe-nang-cho-thue-Huadu-Quang-Chau'),(109,'sửa xe nâng đức hòa , sửa xe nâng An Giang','xe-nang-cho-thue-Quang-Chau-Ze'),(110,'sửa xe nâng kcn long giang , sửa xe nâng Kiên Giang','moi-thue-Quang-Chau'),(111,'sửa xe nâng kcn giao long , sửa xe nâng Cần thơ','cho-thue-xe-nang-Dalingshan'),(112,'sửa xe nâng kcn tân chánh hiệp , sửa xe nâng phú yên','cho-thue-xe-nang-Pingshan'),(113,'sửa xe nâng kcn vsip , sửa xe nâng Nha trang','xe-nang-cho-thue-Tham-Quyen-Komeito'),(114,'sửa xe nâng kcn vn singapor , sửa xe nâng Bình Thuận','xe-nang-cho-thue-Tangxia'),(115,'sửa xe nâng kcn an phước, sửa xe nâng Vũng Tàu','xe-nang-cho-thue-Tham-Quyen'),(116,'sửa xe nâng kcn dệt may nhơn trạch , sửa xe nâng Long thành','Hue-Chau-cho-thue-xe-nang-Gaoming'),(117,'sửa xe nâng kcn tam phước , sửa xe nâng Đồng Nai','cho-thue-xe-nang'),(118,'sửa xe nâng kcn mỹ xuân , sửa xe nâng Bình Dương','cho-thue-xe-nang-Giang-To'),(119,'sửa xe nâng kcn đại đồng , sửa xe nâng sóc Trăng','cho-thue-xe-nang-Giang-To'),(120,'sửa xe nâng kcn quế võ , sửa xe nâng Trà Vinh','test-tags'),(121,'sửa xe nâng kcn long đức, sửa xe nâng Cà Mau','11333333'),(122,'sửa xe nâng kcn hưng phú , sửa xe nâng Bạc Liêu','4444444'),(123,'sửa xe nâng cụm cn bình thành , sửa xe nâng Hậu Giang','nbgy'),(124,'sửa xe nâng kcn mỹ tho , sửa xe nâng Bến tre','nbgy'),(125,'sửa xe nâng kcn sa đéc , sửa xe nâng Long An','njhuu'),(126,'sửa xe nâng kcn tân bình , sửa xe nâng Tiền Giang','vhnbnbhvjh'),(127,'sửa xe nâng kcn vsip bắc ninh , sửa xe nâng Tây Ninh','fgbsrg'),(128,'sửa xe nâng kcn vĩnh lộc , sửa xe nâng Bình Phước','cnmxdgndt'),(129,'sửa xe nâng kcn phú hội , sửa xe nâng Bình Định','bj'),(130,'sửa xe nâng kcn bàu bàng , sửa xe nâng Thái Bình','bvj'),(131,'sửa xe nâng kcn nam tân uyên, sửa xe nâng sóng thần','gj'),(132,'Phụ tùng xe nâng , sửa xe nâng Hà Tây','nmbm'),(133,'Phụ tùng xe nâng , sửa xe nâng Trà nóc','cbmfghj'),(134,'Phụ tùng xe nâng , sửa xe nâng Lâm Đồng','cvzxdgaghr'),(135,'Phụ tùng xe nâng , sửa xe nâng Đắc lắt','fgbsrgncxgnjh'),(137,'Phụ tùng xe nâng , sửa xe nâng bến cát','dgagug'),(138,'Phụ tùng xe nâng , sửa xe nâng Biên Hòa','fgbsrgncxgnjhxvbdgfb'),(139,'Phụ tùng xe nâng , sửa xe nâng Hố Nai','xe-nang'),(140,'Phụ tùng xe nâng , sửa xe nâng Đại Đồng','xe-nang-hang'),(141,'Phụ tùng xe nâng , sửa xe nâng Tân An','cvzxdgaghr'),(142,'Phụ tùng xe nâng , sửa xe nâng Đông Anh','cho-thue-xe-nang-Giang-To'),(143,'Phụ tùng xe nâng , sửa xe nâng khu công nghệ cao','test-tags'),(144,'Phụ tùng xe nâng , sửa xe nâng Cao Lãnh','bj'),(145,'Phụ tùng xe nâng , sửa xe nâng tân uyên','bvj'),(146,'Phụ tùng xe nâng , sửa xe nâng Tân Thuận','gj'),(147,'Phụ tùng xe nâng , sửa xe nâng Nhà bè','nmbm'),(148,'Phụ tùng xe nâng , sửa xe nâng Đức Hòa','cbmfghj'),(149,'Phụ tùng xe nâng , sửa xe nâng Đồng An','cvzxdgaghrvzdg'),(171,'cho thuê xe nâng Giang Tô','cho-thue-xe-nang-Giang-To'),(172,'test tags','test-tags'),(170,'nmbm','nmbm'),(164,'cvzxdgảghrvzdg','cvzxdgaghrvzdg'),(165,'xe nâng','xe-nang'),(166,'xe nâng hàng','xe-nang-hang'),(167,'bj','bj'),(168,'bvj','bvj'),(169,'gj','gj'),(173,'cbmfghj','cbmfghj');
/*!40000 ALTER TABLE `db_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_thanhpho`
--

DROP TABLE IF EXISTS `db_thanhpho`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_thanhpho` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten_vn` varchar(255) NOT NULL,
  `so_thu_tu` int(11) NOT NULL,
  `hien_thi` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_thanhpho`
--

LOCK TABLES `db_thanhpho` WRITE;
/*!40000 ALTER TABLE `db_thanhpho` DISABLE KEYS */;
INSERT INTO `db_thanhpho` VALUES (1,'Hồ Chí Minh',1,1),(2,'Bình Dương',2,1),(3,'Vũng Tàu',3,1),(4,'Hà Nội',4,1);
/*!40000 ALTER TABLE `db_thanhpho` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_thongke`
--

DROP TABLE IF EXISTS `db_thongke`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_thongke` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trong_ngay` int(11) NOT NULL,
  `trong_ngay_date` int(11) NOT NULL,
  `trong_tuan` int(11) NOT NULL,
  `trong_tuan_date` int(11) NOT NULL,
  `trong_thang` int(11) NOT NULL,
  `trong_thang_date` int(11) NOT NULL,
  `tong_truy_cap` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_thongke`
--

LOCK TABLES `db_thongke` WRITE;
/*!40000 ALTER TABLE `db_thongke` DISABLE KEYS */;
INSERT INTO `db_thongke` VALUES (1,2,25,38,4,38,1,16154);
/*!40000 ALTER TABLE `db_thongke` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_thongke_detail`
--

DROP TABLE IF EXISTS `db_thongke_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_thongke_detail` (
  `session_id` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_thongke_detail`
--

LOCK TABLES `db_thongke_detail` WRITE;
/*!40000 ALTER TABLE `db_thongke_detail` DISABLE KEYS */;
INSERT INTO `db_thongke_detail` VALUES ('ohj3knt7eu18iqe3ijt9c0fm11',1516861842);
/*!40000 ALTER TABLE `db_thongke_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_thongtin`
--

DROP TABLE IF EXISTS `db_thongtin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_thongtin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_vn` text NOT NULL,
  `hotline` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `hinh_anh` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `google` varchar(255) NOT NULL,
  `dien_thoai` varchar(255) NOT NULL,
  `fax` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `coppy_right` varchar(255) NOT NULL,
  `map` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id_facebook` varchar(255) NOT NULL,
  `toa_do` varchar(255) NOT NULL,
  `favicon` varchar(255) NOT NULL,
  `icon_share` varchar(255) NOT NULL,
  `youtube` varchar(255) NOT NULL,
  `pinterest` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  `company_us` varchar(255) NOT NULL,
  `company_ch` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_thongtin`
--

LOCK TABLES `db_thongtin` WRITE;
/*!40000 ALTER TABLE `db_thongtin` DISABLE KEYS */;
INSERT INTO `db_thongtin` VALUES (1,'CÔNG TY TNHH THIẾT BỊ XE NÂNG VÂN THIÊN HÙNG','0902 70 73 79','Ki ốt số 7, đường số 1, KCN Đồng An - P. Bình Hòa - TX Thuận An - Bình Dương','416506557301_favicon.jpg','https://www.facebook.com/profile.php?id=100010181506111','https://www.facebook.com/vanthienhung/','https://plus.google.com/u/0/','','','xe.xenang@gmail.com','','<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3917.8591740912857!2d106.7350969!3d10.8983054!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3174d83d1ba9d87b%3A0xe03ddee09e1dcf14!2zQ8O0bmcgVHkgVGhp4bq_dCBC4buLIFhlIE7Dom5nIFbDom4gVGhpw6puIEjDuW5n!5e0!3m2!1svi!2s!4v1520413064821\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>','','','favicon3445991283.png','sline1.jpg','Youtube','Pinterest','Instagram','NANG VAN THIEN HUNG TRUCK EQUIPMENT CO., LTD','南梵軒車輛設備有限公司');
/*!40000 ALTER TABLE `db_thongtin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_thuvienanh`
--

DROP TABLE IF EXISTS `db_thuvienanh`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_thuvienanh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_loai` tinyint(1) NOT NULL,
  `ten_vn` varchar(255) NOT NULL,
  `hinh_anh` varchar(255) NOT NULL,
  `hinh_anh_thumb` varchar(255) NOT NULL,
  `id_video` varchar(255) NOT NULL,
  `so_thu_tu` int(11) NOT NULL,
  `hien_thi` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_thuvienanh`
--

LOCK TABLES `db_thuvienanh` WRITE;
/*!40000 ALTER TABLE `db_thuvienanh` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_thuvienanh` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_tintuc`
--

DROP TABLE IF EXISTS `db_tintuc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_tintuc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten_vn` varchar(255) NOT NULL,
  `ten_us` varchar(255) NOT NULL,
  `ten_ch` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `alias_vn` varchar(255) NOT NULL,
  `alias_us` varchar(255) NOT NULL,
  `alias_ch` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mo_ta_vn` text NOT NULL,
  `mo_ta_us` text NOT NULL,
  `mo_ta_ch` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung_vn` text NOT NULL,
  `noi_dung_us` text NOT NULL,
  `noi_dung_ch` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hinh_anh` varchar(255) NOT NULL,
  `ngay_dang` int(11) NOT NULL,
  `noi_bat` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 la noi bat, mac định là 0',
  `tieu_bieu` tinyint(4) NOT NULL,
  `hien_thi` tinyint(1) NOT NULL COMMENT '0 là ẩn, 1 là hiện',
  `title_vn` varchar(255) NOT NULL,
  `title_us` varchar(255) NOT NULL,
  `title_ch` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `tags_hienthi` varchar(255) NOT NULL,
  `des` text NOT NULL,
  `id_loai` int(11) NOT NULL,
  `so_thu_tu` int(11) NOT NULL,
  `hen_gio` int(11) NOT NULL,
  `hen_ngay` varchar(255) NOT NULL,
  `hen_ngay_dang` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=611 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_tintuc`
--

LOCK TABLES `db_tintuc` WRITE;
/*!40000 ALTER TABLE `db_tintuc` DISABLE KEYS */;
INSERT INTO `db_tintuc` VALUES (566,'Dịch vụ sửa chữa xe nâng','Repair Services','维修服务','dich-vu-sua-chua-xe-nang','repair-services','维修服务','Xe Nâng Vân Thiên Hùng với đội ngũ kỹ thuật tay nghề cao-tận tâm sẽ xuống tận công ty/kho/xưởng của Quý khách hàng để tiến hành kiểm tra tình trạng xe nâng của Quý khách. Sau khi kiểm tra xong công ty chúng tôi sẽ đưa ra bảng báo giá, nếu quý khách hài lòng với bảng giá thì chúng tôi mới bắt đầu tiến hành sửa chữa, lắp đặt và tính phí.','','','<p><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_20161023_093935.jpg\" style=\"height:852px; width:640px\" /></p>\r\n\r\n<p><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_20161010_105126(2).jpg\" style=\"height:540px; width:960px\" /><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_20161023_094027(1).jpg\" style=\"height:719px; width:959px\" /><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_20161023_094024(1).jpg\" style=\"height:539px; width:959px\" /><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_20160927_083634(1).jpg\" style=\"height:540px; width:960px\" /><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/13087316_684791994992859_7814924830472071667_n.jpg\" style=\"height:960px; width:720px\" /></p>\r\n','','','262x262_cong-ty-tnhh-thiet-bi-xe-nang-van-thien-hung-logo296595888035.jpg',1514513143,1,0,1,'Dịch vụ sửa chữa xe nâng','','','','','','',1040,0,0,'2017-12-29',1514480400),(569,'Dịch vụ cho thuê xe nâng','Forklift rental service','叉车租赁服务','dich-vu-cho-thue-xe-nang','forklift-rental-service','叉车租赁服务','“Sản Phẩm Tốt – Giá tốt – Dịch Vụ Tốt”\r\n\r\nChuyên cung cấp xe nâng hàng, xe cơ giới, máy công \r\n- nông - cơ - ngư nghiệp nhập khẩu Nhật Bản','','','<div style=\"box-sizing: border-box; font-family: Arial; font-size: 14px; text-align: justify;\">&nbsp;</div>\r\n\r\n<div style=\"box-sizing: border-box; font-family: Arial; font-size: 14px; text-align: justify;\"><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/4lc800096rz7wcdlxrw1lx180.jpg\" style=\"height:371px; width:719px\" /></div>\r\n\r\n<div style=\"box-sizing: border-box; font-family: Arial; font-size: 14px; text-align: justify;\">&nbsp;</div>\r\n\r\n<div style=\"box-sizing: border-box; font-family: Arial; font-size: 14px; text-align: center;\">&nbsp;</div>\r\n\r\n<div style=\"box-sizing: border-box; font-family: Arial; font-size: 14px; text-align: justify;\"><br />\r\n&nbsp;</div>\r\n','','','262x262_cong-ty-tnhh-thiet-bi-xe-nang-van-thien-hung-logo248921053993.jpg',1514513146,1,0,1,'Dịch vụ cho thuê xe nâng','','','','','','',1040,0,0,'2017-12-29',1514480400),(608,'Chính sách đổi trả hàng','Return Policy','退货政策','chinh-sach-doi-tra-hang','return-policy','退货政策','Chính sách đổi trả hàng','','','<h2>Chính sách đổi trả hàng</h2>\r\n\r\n<div class=\"rte\" style=\"box-sizing: border-box; color: rgb(51, 51, 51); font-family: Arial, Arial, Helvetica, sans-serif; font-size: 14px; background-color: rgb(245, 245, 245);\">\r\n<p style=\"text-align:justify\"><strong>Điều kiện trả hàng - Đổi hàng</strong><br />\r\nTuỳ theo loại sản phẩm mà chúng tôi có các chính sách đổi hàng hoặc trả lại hàng khác nhau. Chúng tôi đồng ý cho phép quý khách hàng có thể đổi hàng, trả lại hàng trong những trường hợp sau:<br />\r\n- Sản phẩm bị lỗi do nhà sản xuất.<br />\r\n- Sản phẩm không đúng như mô tả trên website.<br />\r\n- Hàng không đúng chủng loại, mẫu mã như quý khách đặt hàng.<br />\r\n- Không đủ số lượng, không đủ bộ như trong đơn hàng.<br />\r\n- Tình trạng bên ngoài bị ảnh hưởng như rách bao bì, bong tróc, bể vỡ…<br />\r\n- Trong vòng 24 giờ sau khi nhận được hàng, nếu không vừa ý Quý khách có thể hoàn trả lại hàng hoặc yêu cầu chúng tôi đổi hàng khác.&nbsp;<br />\r\n- Khi nhận lại hàng đảm bảo phải còn nguyên trạng thái như ban đầu, chưa được sử dụng</p>\r\n</div>\r\n','','','262x262_cong-ty-tnhh-thiet-bi-xe-nang-van-thien-hung-logo149953749488.jpg',1520590994,0,0,1,'Chính sách đổi trả hàng','','','','','','',1112,0,0,'2018-03-09',1520528400),(570,'Công ty Vân Thiên Hùng','Van Thien Hung Company','Van Thien Hung公司','cong-ty-van-thien-hung','van-thien-hung-company','van-thien-hung公司','Công ty Vân Thiên Hùng là đơn vị chuyên nhập khẩu trực tiếp các dòng xe nâng hàng. Với hơn 5 năm hoạt động, chúng tôi hân hạnh đã được phục vụ đáp ứng tất cả các yêu cầu của quý khách hàng trên toàn Quốc về Xe nâng: \r\n-Cung cấp phụ tùng xe nâng.\r\n- Sửa chữa xe nâng.\r\n-Mua bán xe nâng.\r\n-Cho thuê xe nâng.\r\nCông ty chúng tôi cung cấp các loại xe đa dạng gồm nhiều chủng loại : \r\n- Xe nâng hạ bằng động cơ: Điện, Dầu, Xăng, Gas \r\n- Xe nâng hạ bằng tay: Tự động và bán tự động \r\nNgoài  ra còn cho thuê  xe nâng hàng từ 1 đến 15 tấn như: TCM, Hyter, Komatsu, Nissan, Toyota, Clack, Crow,..\r\nĐặc biệt, chúng tôi  còn kinh  doanh các phụ tùng như: \r\n-Kẹp giấy, \r\n-Bình điện,\r\n- Vỏ xe, \r\n-Bo mạch điều khiển tới lui,\r\n- Nâng hạ và Trợ lực tay lái,\r\n- Các loại lõi lọc, \r\n-Cánh quạt, \r\n-Các loại phốt..','','','<div style=\"box-sizing: border-box; font-family: Arial; font-size: 14px; text-align: justify;\">\r\n<p>Công ty Vân Thiên Hùng là đơn vị chuyên nhập khẩu trực tiếp các dòng xe nâng hàng. Với hơn 5 năm hoạt động, chúng tôi hân hạnh đã được phục vụ đáp ứng tất cả các yêu cầu của quý khách hàng trên toàn Quốc về Xe nâng:&nbsp;</p>\r\n\r\n<p>-Cung cấp phụ tùng xe nâng.<br />\r\n- Sửa chữa xe nâng.<br />\r\n-Mua bán xe nâng.<br />\r\n-Cho thuê xe nâng.<br />\r\nCông ty chúng tôi cung cấp các loại xe đa dạng gồm nhiều chủng loại :&nbsp;<br />\r\n- Xe nâng hạ bằng động cơ: Điện, Dầu, Xăng, Gas&nbsp;<br />\r\n- Xe nâng hạ bằng tay: Tự động và bán tự động&nbsp;<br />\r\nNgoài&nbsp; ra còn cho thuê&nbsp; xe nâng hàng từ 1 đến 15 tấn như: TCM, Hyter, Komatsu, Nissan, Toyota, Clack, Crow,..<br />\r\nĐặc biệt, chúng tôi&nbsp; còn kinh&nbsp; doanh các phụ tùng như:&nbsp;<br />\r\n-Kẹp giấy,&nbsp;<br />\r\n-Bình điện,<br />\r\n- Vỏ xe,&nbsp;<br />\r\n-Bo mạch điều khiển tới lui,<br />\r\n- Nâng hạ và Trợ lực tay lái,<br />\r\n- Các loại lõi lọc,&nbsp;<br />\r\n-Cánh quạt,&nbsp;<br />\r\n-Các loại phốt..</p>\r\n\r\n<p><em>Với đội ngũ kỹ thuật lành nghề , công ty Vân Thiên Hùng mang đến những sản phẩm phụ tùng xe Nâng chính hãng , có chất lượng cao, tiến độ giao hàng đảm bảo, giá thành hợp lý nhằm đáp ứng yêu cầu và nhu cầu khác nhau của khách hàng.&nbsp;</em></p>\r\n</div>\r\n\r\n<div style=\"box-sizing: border-box; font-family: Arial; font-size: 14px; text-align: justify;\"><span style=\"font-family:sans-serif,arial,verdana,trebuchet ms; font-size:13px\"><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/2smlzlekacowxwoc0vowy0mey.jpg\" style=\"height:720px; width:957px\" /></span></div>\r\n\r\n<div style=\"box-sizing: border-box; font-family: Arial; font-size: 14px; text-align: justify;\"><span style=\"font-family:arial,helvetica,sans-serif\"><span style=\"background-color:rgb(255, 255, 255)\">&nbsp;</span>Thế mạnh làm nên thương hiệu Xe Nâng Vân Thiên Hùng khác biệt chính là:<strong>&nbsp;PHỤ TÙNG TỐT- XE TỐT- GIÁ TỐT</strong>. Tinh thần trách nhiệm cao cùng những nhân Viên làm việc nghiêm túc. Ngoài ra, các bộ phận thường xuyên trao đổi công việc, chia sẻ những khó khăn, sáng kiến xây dựng nên một Vân Thiên Hùng&nbsp; năng động, sáng tạo, chuyên nghiệp trong công việc.&nbsp;</span></div>\r\n\r\n<div style=\"box-sizing: border-box; font-family: Arial; font-size: 14px; text-align: justify;\"><span style=\"font-family:arial,helvetica,sans-serif\">&nbsp; &nbsp;Với phương châm<strong>&nbsp;“ Hợp tác để cùng thành công”</strong>, và định hướng<strong>&nbsp;“Liên tục cải tiến”&nbsp;</strong>Vân Thiên Hùng đã luôn nỗ lực cả về nhân lực, vật lực, xây dựng uy tín thương hiệu, niềm tin với khách hàng với những sản phẩm chúng tôi cung cấp.&nbsp;</span></div>\r\n\r\n<div style=\"box-sizing: border-box; font-family: Arial; font-size: 14px; text-align: justify;\"><span style=\"font-family:arial,helvetica,sans-serif\">&nbsp; &nbsp;Sự tin tưởng và ủng hộ của khách hàng trong suốt thời gian qua là nguồn động viên to lớn trên bước đường phát triển của xe nâng Vân Thiên Hùng. Chúng tôi xin hứa sẽ không ngừng hoàn thiện, phục vụ khách hàng tốt nhất để luôn xứng đáng với niềm tin ấy.</span></div>\r\n','','','262x262_cong-ty-tnhh-thiet-bi-xe-nang-van-thien-hung-logo528741993779.jpg',1514513146,1,0,1,'Công ty Vân Thiên Hùng','','','','','','',1040,0,0,'2017-12-29',1514480400),(571,'Lá bố xe nâng','Clutch discs','离合器片(干式)','la-bo-xe-nang','clutch-discs','离合器片-干式-','Các sản phẩm do VÂN THIÊN HÙNG cung cấp đều từ các nhà cung cấp hàng đầu đạt chuẩn chất lượng quốc tế','','','<div style=\"box-sizing: border-box; font-family: Arial; font-size: 14px; text-align: justify;\">&nbsp;</div>\r\n\r\n<div style=\"box-sizing: border-box; font-family: Arial; font-size: 14px; text-align: justify;\"><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_20160817_100201.jpg\" style=\"height:516px; width:291px\" /></div>\r\n\r\n<div style=\"box-sizing: border-box; font-family: Arial; font-size: 14px; text-align: justify;\">&nbsp;</div>\r\n\r\n<div style=\"box-sizing: border-box; font-family: Arial; font-size: 14px; text-align: justify;\"><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_20160817_100230.jpg\" style=\"height:812px; width:457px\" /></div>\r\n\r\n<div style=\"box-sizing: border-box; font-family: Arial; font-size: 14px; text-align: justify;\">&nbsp;</div>\r\n\r\n<div style=\"box-sizing: border-box; font-family: Arial; font-size: 14px; text-align: justify;\"><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_20160817_100249.jpg\" style=\"height:1200px; width:675px\" /></div>\r\n\r\n<div style=\"box-sizing: border-box; font-family: Arial; font-size: 14px; text-align: justify;\">&nbsp;</div>\r\n\r\n<div style=\"box-sizing: border-box; font-family: Arial; font-size: 14px; text-align: justify;\"><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_20160817_100303.jpg\" style=\"height:369px; width:208px\" /></div>\r\n\r\n<div style=\"box-sizing: border-box; font-family: Arial; font-size: 14px; text-align: justify;\">&nbsp;</div>\r\n\r\n<div style=\"box-sizing: border-box; font-family: Arial; font-size: 14px; text-align: justify;\"><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_20160817_100339.jpg\" style=\"height:738px; width:415px\" /></div>\r\n\r\n<div style=\"box-sizing: border-box; font-family: Arial; font-size: 14px; text-align: justify;\">&nbsp;</div>\r\n\r\n<div style=\"box-sizing: border-box; font-family: Arial; font-size: 14px; text-align: justify;\">&nbsp;</div>\r\n','','','image-e5823173cb73b9f942aea8e67716b2e8e97d3dcc61f9978471183a3ce7719b7e-V909196353182.jpg',1514513147,1,0,1,'Lá bố xe nâng','','','','159','fgbsrgncxgnjhxvbdgfb','',1026,7,0,'2017-12-29',1514480400),(574,'Dịch vụ tư vấn miễn phí','Free consulting service','免费咨询服务','dich-vu-tu-van-mien-phi','free-consulting-service','免费咨询服务','Cam kết mọi sản phẩm được cung cấp đều đảm bảo các tiêu chuẩn chất lượng khắt khe của Việt Nam và thế giới','','','<p style=\"text-align:justify\"><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_20161023_094024.jpg\" style=\"height:539px; width:959px\" /></p>\r\n','','','262x262_cong-ty-tnhh-thiet-bi-xe-nang-van-thien-hung-logo377118642493.jpg',1514514019,1,0,1,'Dịch vụ tư vấn miễn phí','','','','','','',1040,1,0,'2017-12-29',1514480400),(575,'Heo Thắng xe nâng','Master cylinder','刹车总泵','heo-thang-xe-nang','master-cylinder','刹车总泵','Công ty cung cấp heo thắng xe nâng hàng từ 1.5 tấn đến 15 tấn , có bảo hành sản phẩm','','','<p>Công ty cung cấp heo thắng xe nâng hàng từ 1.5 tấn đến 15 tấn , có bảo hành sản phẩm</p>\r\n\r\n<p><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_0837.JPG\" style=\"height:942px; width:1256px\" /><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/image-97a75ae8753e0bd52ab5dc9d0367a4cf0f3eac2a20123e91f7810702a7f363df-V.jpg\" style=\"height:960px; width:1280px\" /><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_2680.JPG\" style=\"height:942px; width:1256px\" /><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_2681.JPG\" style=\"height:942px; width:1256px\" /><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_2686.JPG\" style=\"height:942px; width:1256px\" /><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_3320.JPG\" style=\"height:1080px; width:810px\" /></p>\r\n','','','image-58e32bc5eca4a0e8948e0f697882971618b5202a6769c4b8b86156fb32a21517-V539513137759.jpg',1514514066,1,0,1,'Heo Thắng xe nâng','','','','164','cvzxdgảghrvzdg','',1026,2,0,'2017-12-29',1514480400),(607,'Bơm nước xe nâng','Water Pump','水泵总成 ','bom-nuoc-xe-nang','water-pump-723','水泵总成-',' Công ty cung cấp bơm nước xe nâng hàng từ 1.5 tấn đến 15 tấn , có bảo hành sản phẩm','','','<p>Công ty cung cấp bơm nước xe nâng hàng từ 1.5 tấn đến 15 tấn , có bảo hành sản phẩm</p>\r\n\r\n<p><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_3192%20(2).JPG\" style=\"height:720px; width:960px\" /><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_3193%20(2).JPG\" style=\"height:720px; width:960px\" /><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/27540574_362608584215456_1344342218244034118_n.jpg\" style=\"height:720px; width:960px\" /><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/741d6badd8fa37a46eeb.jpg\" style=\"height:720px; width:960px\" /></p>\r\n','','','IMG_3191726585535124.JPG',1520579187,1,0,1,'Bơm nước xe nâng','','','','','','',1026,9,0,'2018-03-09',1520528400),(576,'Đề khởi động xe nâng','STARTER','雷诺马达','de-khoi-dong-xe-nang','starter-551','雷诺马达','Chúng tôi kiểm tra xe nâng của Quý Khách miễn phí. Sau khi báo giá, nếu Quý khách hàng đồng ý và xác nhận đơn đặt hàng thì chúng tôi mới tiến hành sửa chữa và lắp đặt thiết bị','','','<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_20161010_105126(1).jpg\" style=\"height:540px; width:960px\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_20161023_094027.jpg\" style=\"height:719px; width:959px\" /></p>\r\n\r\n<p><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_20160927_083634.jpg\" style=\"height:540px; width:960px\" /></p>\r\n','','','IMG_20161010_105135764145255312.jpg',1514514128,1,0,1,'Đề khởi động xe nâng','','','','165,166','xe nâng, xe nâng hàng','',1026,3,0,'2017-12-29',1514480400),(529,'Dịch vụ sau bán hàng','After-sales service','售后服务','dich-vu-sau-ban-hang','after-sales-service','售后服务','Cam kết nỗ lực cung cấp dịch vụ sau bán hàng hoàn chỉnh theo yêu cầu của khách hàng.','','','<div style=\"box-sizing: border-box; font-family: Arial; font-size: 14px; text-align: justify;\">&nbsp;</div>\r\n\r\n<div style=\"box-sizing: border-box; font-family: Arial; font-size: 14px; text-align: justify;\">&nbsp;</div>\r\n\r\n<div style=\"box-sizing: border-box; font-family: Arial; font-size: 14px; text-align: justify;\"><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_20161010_105126.jpg\" style=\"height:540px; width:960px\" /></div>\r\n','<p>Nowadays many people are using fire hoses and will use fire hoses, but to find the right quality, the right product for the purpose of their needs is very difficult. To have the option to buy the product we send the characteristics and features of the product to customers have the perfect choice.</p>\r\n','','262x262_cong-ty-tnhh-thiet-bi-xe-nang-van-thien-hung-logo535978091216.jpg',1510287516,1,0,1,'Dịch vụ sau bán hàng','','','','163','dgảgửg','',1040,0,0,'2017-12-22',1513875600),(599,'Bơm thủy lực xe nâng','Hydraulic Pump','林德齿轮泵','bom-thuy-luc-xe-nang','hydraulic-pump','林德齿轮泵','Công ty cung cấp bơm thủy lực xe nâng hàng từ 1.5 tấn đến 15 tấn , có bảo hành sản phẩm','','','<p><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/20161020_172327.jpg\" style=\"height:735px; width:1307px\" /></p>\r\n\r\n<p><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_2533.JPG\" style=\"height:578px; width:771px\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_0576%20(2).JPG\" style=\"height:720px; width:960px\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_20160826_132024.jpg\" style=\"height:785px; width:589px\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_2535.JPG\" style=\"height:1200px; width:1600px\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_2542.JPG\" style=\"height:1080px; width:1440px\" /></p>\r\n','','','IMG_20141229_141955653614391935.jpg',1516861301,1,0,1,'Bơm thủy lực xe nâng','','','','173','  cbmfghj','',1026,6,0,'2018-01-25',1516813200),(600,'Càng Bố Thắng xe nâng','BRAKE SHOE','刹车片','cang-bo-thang-xe-nang','brake-shoe','刹车片','Công ty cung cấp Càng bố xe nâng hàng từ 1.5 tấn đến 15 tấn , có bảo hành sản phẩm','','','<p><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_0605.JPG\" style=\"height:942px; width:1256px\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_0798%20(2).JPG\" style=\"height:720px; width:960px\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_3296%20(1).JPG\" style=\"height:960px; width:720px\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_3286%20(1).JPG\" style=\"height:1080px; width:1440px\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_3292.JPG\" style=\"height:960px; width:720px\" /></p>\r\n','','','FB_IMG_1437140458504542690706012.jpg',1516861301,1,0,1,'Càng Bố Thắng xe nâng','','','','171,172','cho thuê xe nâng Giang Tô, test tags','',1026,5,0,'2018-01-25',1516813200),(601,'Cánh quạt làm mát xe nâng','Fan blades','发动机风扇叶','canh-quat-lam-mat-xe-nang','fan-blades','发动机风扇叶','Công ty cung cấp Cánh quạt xe nâng hàng từ 1.5 tấn đến 15 tấn , có bảo hành sản phẩm','','','<p><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/21586681_100310804052209_8707049094752405568_o.jpg\" style=\"height:576px; width:1024px\" /><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_0795.JPG\" style=\"height:942px; width:1256px\" /><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_2490.JPG\" style=\"height:960px; width:720px\" /><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_0796.JPG\" style=\"height:942px; width:1256px\" /><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/21753427_100307800719176_2955433750529674569_o.jpg\" style=\"height:576px; width:1024px\" /><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_2488.JPG\" style=\"height:720px; width:960px\" /></p>\r\n','','','21587351_100310707385552_9188911854645478455_o603887254294.jpg',1516861302,1,0,1,'Cánh quạt làm mát xe nâng','','','','167,168,169,170','bj,bvj,gj,nmbm','',1026,4,0,'2018-01-25',1516813200),(606,'Heo con xe nâng','BRAKE WHEEL CYLINDERS','刹车分泵','heo-con-xe-nang','brake-wheel-cylinders','刹车分泵','Công ty cung cấp Heo con xe nâng hàng từ 1.5 tấn đến 15 tấn , có bảo hành sản phẩm','','','<p><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_0803.JPG\" style=\"height:942px; width:1256px\" /><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_0804.JPG\" style=\"height:942px; width:1256px\" /><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_0834.JPG\" style=\"height:942px; width:1256px\" /><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_0835.JPG\" style=\"height:942px; width:1256px\" /><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_2866.JPG\" style=\"height:720px; width:960px\" /><img alt=\"\" src=\"http://vanthienhung.vn/img_data/images/IMG_2868.JPG\" style=\"height:720px; width:960px\" /></p>\r\n','','','image-79ba2b8525eb1e385f94d8e72a417c51c3a9299e51f55f95e4ca4bd5c37efbd3-V267482882045.jpg',1520578045,1,0,1,'Heo con xe nâng','','','','','','',1026,8,0,'2018-03-09',1520528400),(602,'Chính sách giao nhận và thanh toán','Delivery and payment policies','交付和付款政策','chinh-sach-giao-nhan-va-thanh-toan','delivery-and-payment-policies','交付和付款政策','Chính sách giao nhận và thanh toán','','','<h2>&nbsp;</h2>\r\n\r\n<div class=\"title_detail\" style=\"margin: 0px; font-size: 19px; padding: 10px 5px 10px 0px; text-transform: uppercase; text-align: center; font-weight: bold; color: rgb(48, 48, 48); font-family: \">CHÍNH SÁCH THANH TOÁN VÀ GIAO NHẬN HÀNG</div>\r\n\r\n<div class=\"detail_content\" style=\"margin: 0px; padding: 0px 10px; color: rgb(48, 48, 48); font-family: \"><span style=\"font-size:16px\">Các khách hàng, quý công ty mua phụ tùng, thiết bị sẽ được áp dụng hình thức thanh toán như sau:<br />\r\n+ Thanh toán trực tiếp bằng tiền mặt hoặc chuyển khoản<br />\r\n+ Nhận hàng trực tiếp tại </span><span style=\"color:rgb(51, 51, 51); font-family:arial,arial,helvetica,sans-serif; font-size:14px\">CÔNG TY TNHH THIẾT BỊ XE NÂNG VÂN THIÊN HÙNG</span><span style=\"font-size:16px\">&nbsp;, không có dịch vụ giao hàng tận nơi, nếu có sẽ phát sinh thêm chi phí vận chuyển.<br />\r\n+ Khách hàng, quý công ty nhận phiếu thanh toán: phiếu thu, hóa đơn VAT khi thanh toán.<br />\r\n+ Chỉ áp dụng hóa đơn VAT 10%, viết hóa đơn nếu có yêu cầu từ khách hàng, quý công ty.<br />\r\n+ Đối với đơn hàng lớn (&gt; 30 triệu): Khách hàng chi trả tiền đặt cọc trước 30% của đơn hàng&nbsp;</span><span style=\"color:rgb(51, 51, 51); font-family:arial,arial,helvetica,sans-serif; font-size:14px\">CÔNG TY TNHH THIẾT BỊ XE NÂNG VÂN THIÊN HÙNG</span><span style=\"font-size:16px\">, thanh toán khoản còn lại 70% và hóa đơn (nếu có) khi đến nhận hàng.<br />\r\n+ Đối với đơn hàng nhỏ (&lt; 10 triệu): Khách hàng chi trả hoàn toàn 100% giá trị đơn hàng ngay khi nhận hàng.<br />\r\n+ Đối với các thiết bị phụ tùng có giá thành cao hoặc hiếm, cần phải đặt hàng: khách hàng phải chi trả tiền cọc trước 30% của đơn hàng Vân Thiên Hùng để tiến hành đặt hàng (thời gian đặc hàng sẽ báo cho khách khi báo giá), thanh toán số còn lại 70% và hóa đơn (nếu có) khi&nbsp; đến nhận hàng.<br />\r\n+ Cộng thêm chi phí lắp ráp nếu khách hàng, quý công ty yêu cầu lắp ráp phụ tùng mới vào xe.</span></div>\r\n\r\n<div class=\"detail_content\" style=\"margin: 0px; padding: 0px 10px; color: rgb(48, 48, 48); font-family: \">\r\n<p><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</strong>CÔNG TY TNHH THIẾT BỊ XE NÂNG VÂN THIÊN HÙNG<br />\r\nKi ốt số 7, đường số 1, KCN Đồng An - P. Bình Hòa - TX Thuận An - Bình Dương&nbsp; &nbsp;<br />\r\nSố tài khoản &nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;0381000469 tại Ngân hàng TMCP Ngoại thương Việt Nam (Vietcombank). CN Thủ Đức - PGD Linh Trung</p>\r\n</div>\r\n\r\n<div class=\"rte\" style=\"box-sizing: border-box; color: rgb(51, 51, 51); font-family: Arial, Arial, Helvetica, sans-serif; font-size: 14px; background-color: rgb(245, 245, 245);\">\r\n<p>&nbsp;</p>\r\n</div>\r\n','','','262x262_cong-ty-tnhh-thiet-bi-xe-nang-van-thien-hung-logo676064795596.jpg',1519959849,0,0,1,'Chính sách giao nhận và thanh toán','','','','','','',1112,0,0,'2018-03-02',1519923600),(604,'Chính sách bảo hành ','Warranty Policy','保修政策','chinh-sach-bao-hanh-','warranty-policy','保修政策','Chính sách bảo hành ','','','<div class=\"defaultContent newsDetail-content newsList-content\" style=\"margin: 0px; padding: 1px 7px;\">\r\n<div class=\"Block newsDetail_Content Clear\" style=\"margin: 0px; padding: 5px; clear: both; font-size: 12px; font-family: Tahoma, Arial, Helvetica, sans-serif; background-color: rgb(255, 255, 255); color: rgb(60, 60, 60); overflow: hidden;\">\r\n<h2>Chính sách bảo hành</h2>\r\n\r\n<div class=\"rte\" style=\"box-sizing: border-box; color: rgb(51, 51, 51); font-family: Arial, Arial, Helvetica, sans-serif; font-size: 14px; background-color: rgb(245, 245, 245);\">\r\n<p style=\"text-align:justify\"><strong>Chính sách bảo hành của công ty TNHH Thiết Bị Xe Nâng Vân Thiên Hùng</strong><br />\r\n1. Trường hợp được bảo hành<br />\r\n- Trong trường hợp sự cố hư hỏng được xác định do lỗi của nhà sản xuất và vẫn còn thời hạn bảo hành.<br />\r\n- Sản phẩm không có dấu hiệu can thiệp của bên thứ 03 (sửa chữa ngoài).<br />\r\n- Số series, tem niêm phong trên sản phẩm và phiếu bảo hành phải giống nhau, nguyên vẹn, không rách mất hoặc bị cạo sửa.<br />\r\n- Hàng hóa không bị tác động của môi trường (thấm nước, hóa chất ăn mòn, tác động nhiệt gây biến dạng).<br />\r\n2. Những trường hợp không được bảo hành<br />\r\n- Những sản phẩm không thể xác định được nguồn gốc mua tại Công ty chúng tôi có quyền từ chối bảo hành.<br />\r\n- Sản phẩm đã quá thời hạn ghi trên Phiếu bảo hành hoặc mất Phiếu bảo hành.<br />\r\n- Phiếu bảo hành, hoặc tem bảo hành bị rách, không còn tem bảo hành, tem bảo hành dán đè hoặc bị sửa đổi.<br />\r\n- Phiếu bảo hành không ghi rõ số Serial và ngày mua hàng.<br />\r\n- Sản phẩm bị hư hỏng do tác động cơ học làm rơi, vỡ, va đập, trầy xước, móp méo, ẩm ướt, hoen rỉ hoặc do hỏa hoạn, thiên tai gây nên.<br />\r\n- Sản phẩm bị hư hỏng do sử dụng không đúng sách hướng dẫn, sử dụng sai điện áp quy định.<br />\r\n- Tự ý tháo dỡ, thay đổi cấu trúc sản phẩm, sử dụng sai hướng dẫn, sử dụng linh kiện không đúng.<br />\r\n- Những sản phẩm được mua tại Công ty Vân Thiên Hùng nhưng đã quá thời hạn bảo hành, Công ty chúng tôi sẽ cung cấp dịch vụ sửa chữa tính phí cho Quý khách.</p>\r\n</div>\r\n</div>\r\n\r\n<div class=\"newsDetail_PrintBottom\" style=\"margin: 0px; padding: 5px 0px; font-family: Tahoma, Arial, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255); float: right;\">&nbsp;</div>\r\n</div>\r\n','','','262x262_cong-ty-tnhh-thiet-bi-xe-nang-van-thien-hung-logo914816365838.jpg',1519959871,0,0,1,'Chính sách bảo hành ','','','','','','',1112,0,0,'2018-03-02',1519923600),(605,'Quy định đặt hàng','Ordering Order','订购订单','quy-dinh-dat-hang','ordering-order','订购订单','Công ty Vân Thiên Hùng chuyên Cung cấp  các dòng xe nâng:\r\n-Xe nâng động cơ dầu (diesel),\r\n-Xe nâng động cơ điện, \r\nXe nâng động cơ xăng - gas\r\n của các hãng KOMATSU, TOYOTA, TCM, NISSAN, SUMITOMO, NICHIYU, …','','','<p style=\"text-align:justify\"><span style=\"color:rgb(0, 100, 0)\"><strong>Quy trình đặt hàng:</strong></span></p>\r\n\r\n<p style=\"text-align:justify\"><strong>Bước 1:</strong>&nbsp;Quý khách hàng gọi điện đến công ty cung cấp nhu cầu về xe nâng ,phụ tùng xe nâng ,thuê xe nâng hay dịch vụ sửa chữa</p>\r\n\r\n<p style=\"text-align:justify\"><strong>Bước 2:</strong>&nbsp;Nhân viên công ty tư vấn tìm hiểu nhu cầu của quý khách, tư vấn cho quý khách chính xác xe nâng ,phụ tùng xe nâng hay dịch vụ sửa chữa cần tìm</p>\r\n\r\n<p style=\"text-align:justify\"><strong>Bước 3: T</strong>iến hành báo giá và hình ảnh gửi khách hàng.</p>\r\n\r\n<p style=\"text-align:justify\"><strong>Bước 4:</strong>&nbsp;Nếu khách hàng đồng ý, tiến hành ký hợp đồng đặt hàng.</p>\r\n\r\n<p style=\"text-align:justify\"><strong>Bước 5:</strong>&nbsp;Công ty giao hàng cho quý Khách kiểm tra hàng hóa có đúng theo chủng loại. Nếu đúng tiếng hành giao hàng theo hợp đồng.</p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n','','','262x262_cong-ty-tnhh-thiet-bi-xe-nang-van-thien-hung-logo556872953787.jpg',1519959885,0,0,1,'Quy định đặt hàng','','','','','','',1112,0,0,'2018-03-02',1519923600),(609,'Chính sách bảo mật thông tin','Information privacy policy','信息隐私政策','chinh-sach-bao-mat-thong-tin','information-privacy-policy','信息隐私政策','Chính sách bảo mật thông tin','','','<h1><a href=\"http://xenang7777.vn/chinh-sach-bao-mat-thong-tin-cttt-48.html\" style=\"margin: 0px; padding: 0px; box-sizing: border-box; color: rgb(102, 102, 102); text-decoration-line: none; background: 0px 0px; border: 0px; outline: 0px; vertical-align: baseline; font-size: 16px; font-weight: bold;\" title=\"Chính sách bảo mật thông tin\">Chính sách bảo mật thông tin</a></h1>\r\n\r\n<div class=\"date-send\" style=\"margin: 0px; padding: 0px; box-sizing: border-box; border: 0px; outline: 0px; vertical-align: baseline; color: rgb(51, 51, 51); font-family: HelveticaNeue-Light, Arial, Helvetica, sans-serif; font-size: 15px; -webkit-text-stroke: 0.1px rgba(255, 255, 255, 0.01); background-color: rgb(255, 255, 255);\"><span style=\"color:rgb(102, 102, 102); font-size:11px\">Ngày: 03-13-2018</span></div>\r\n\r\n<div class=\"detail-news\" style=\"margin: 10px 0px; padding: 0px; box-sizing: border-box; border: 0px; outline: 0px; vertical-align: baseline; color: rgb(51, 51, 51); font-family: HelveticaNeue-Light, Arial, Helvetica, sans-serif; font-size: 15px; -webkit-text-stroke: 0.1px rgba(255, 255, 255, 0.01); background-color: rgb(255, 255, 255);\">\r\n<p style=\"text-align:justify\"><strong>a.Mục đích và phạm vi thu thập:</strong></p>\r\n\r\n<p style=\"text-align:justify\">Việc thu thập dữ liệu chủ yếu trên website vanthienhung.vn bao gồm: họ tên, email, điện thoại, địa chỉ khách hàng,… .Đây là các thông tin mà vanthienhung.vn cần khách hàng cung cấp bắt buộc khi đăng ký sử dụng dịch vụ và để vanthienhung.vn liên hệ xác nhận khi khách hàng đăng ký sử dụng dịch vụ trên website nhằm đảm bảo quyền lợi cho cho người tiêu dùng.</p>\r\n\r\n<p style=\"text-align:justify\"><strong>b.Phạm vi sử dụng thông tin:</strong></p>\r\n\r\n<p style=\"text-align:justify\">Công ty sử dụng thông tin khách hàng cung cấp để:</p>\r\n\r\n<p style=\"text-align:justify\">- Cung cấp các thông tin về sản phẩm, dịch vụ đến khách hàng;</p>\r\n\r\n<p style=\"text-align:justify\">- Giao hàng hoặc gửi chứng từ cho khách hàng;</p>\r\n\r\n<p style=\"text-align:justify\">- Gửi các thông báo về các hoạt động trao đổi thông tin giữa khách hàng và website vanthienhung.vn như các chường trình khuyến mãi, tri ân khách hàng,…;</p>\r\n\r\n<p style=\"text-align:justify\">- Ngăn ngừa các hoạt động phá hủy tài khoản người dùng của khách hàng hoặc các hoạt động giả mạo khách hàng;</p>\r\n\r\n<p style=\"text-align:justify\">- Liên lạc và giải quyết với khách hàng trong những trường hợp đặc biệt.</p>\r\n\r\n<p style=\"text-align:justify\">- Không sử dụng thông tin cá nhân của khách hàng ngoài mục đích xác nhận và liên hệ có liên quan đến giao dịch tại vanthienhung.vn</p>\r\n\r\n<p style=\"text-align:justify\">- Trong trường hợp có yêu cầu của pháp luật: Công ty có trách nhiệm hợp tác cung cấp thông tin cá nhân khách hàng khi có yêu cầu từ cơ quan tư pháp bao gồm: Viện kiểm sát, tòa án, cơ quan công an điều tra liên quan đến hành vi vi phạm pháp luật nào đó của khách hàng. Ngoài ra, không ai có quyền xâm phạm vào thông tin cá nhân của khách hàng.</p>\r\n\r\n<p style=\"text-align:justify\"><strong>c. Thời gian lưu trữ thông tin:</strong></p>\r\n\r\n<p style=\"text-align:justify\">Dữ liệu cá nhân của khách hàng sẽ được lưu trữ cho đến khi có yêu cầu hủy bỏ, còn lại trong mọi trường hợp thông tin cá nhân khách hàng sẽ được bảo mật trên máy chủ của Công Ty Vân Thiên Hùng .</p>\r\n\r\n<p style=\"text-align:justify\"><strong>d.Địa chỉ của đơn vị thu thập và quản lý thông tin cá nhân:</strong></p>\r\n\r\n<p style=\"text-align:justify\">CÔNG TY TNHH THIẾT BỊ XE NÂNG VÂN THIÊN HÙNG</p>\r\n\r\n<p style=\"text-align:justify\"><strong>Trụ sở:</strong></p>\r\n\r\n<p style=\"text-align:justify\"><strong>Địa Chỉ:</strong>&nbsp;Ki ốt số 7, đường số 1, KCN Đồng An - P. Bình Hòa - TX Thuận An - Bình Dương</p>\r\n\r\n<p style=\"text-align:justify\"><strong>MST:</strong>&nbsp;<span style=\"font-family:arial,verdana,helvetica,sans-serif; font-size:13px\">3702189577</span></p>\r\n\r\n<p style=\"text-align:justify\"><strong>Email:</strong>&nbsp;xexenang@gmail.com</p>\r\n\r\n<p style=\"text-align:justify\"><strong>Tel:</strong>&nbsp;0274 350 17 63 - 0902 70 73 79 - Fax : 0274 376 55 47</p>\r\n\r\n<p style=\"text-align:justify\"><strong>e. Phương tiện và công cụ để người dùng tiếp cận và chỉnh sửa dữ liệu cá nhân của mình:</strong></p>\r\n\r\n<p style=\"text-align:justify\">Khách hàng có quyền tự kiểm tra, cập nhật, điều chỉnh hoặc hủy bỏ thông tin cá nhân của mình bằng cách yêu cầu vanthienhung.vn thực hiện việc này.</p>\r\n\r\n<p style=\"text-align:justify\"><strong>f. Cam kết bảo mật thông tin cá nhân khách hàng:</strong></p>\r\n\r\n<p style=\"text-align:justify\">Thông tin cá nhân của khách hàng tại vanthienhung.vn được vanthienhung.vn cam kết bảo mật tuyệt đối theo chính sách bảo vệ thông tin cá nhân của vanthienhung.vn . Việc thu thập và sử dụng thông tin của mỗi khách hàng chỉ được thực hiện khi có sự đồng ý của khách hàng đó trừ những trường hợp pháp luật có quy định khác.</p>\r\n\r\n<p style=\"text-align:justify\">Không sử dụng, không chuyển giao, cung cấp hay tiết lộ cho bên thứ 3 nào về thông tin cá nhân của khách hàng khi không có sự cho phép đồng ý từ khách hàng.</p>\r\n\r\n<p style=\"text-align:justify\">Trong trường hợp máy chủ lưu trữ thông tin bị hacker tấn công dẫn đến mất mát dữ liệu cá nhân khách hàng, vanthienhung.vn sẽ có trách nhiệm thông báo vụ việc cho cơ quan chức năng điều tra xử lý kịp thời và thông báo cho khách hàng được biết.</p>\r\n</div>\r\n','','','',1520951795,0,0,1,'Chính sách bảo mật thông tin','','','','','','',1112,0,0,'2018-03-13',1520874000);
/*!40000 ALTER TABLE `db_tintuc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_user`
--

DROP TABLE IF EXISTS `db_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` text NOT NULL,
  `user_hash` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pass_hash` text NOT NULL,
  `tai_khoan` text NOT NULL,
  `email` text NOT NULL,
  `ho_ten` text NOT NULL,
  `dien_thoai` text NOT NULL,
  `dia_chi` text NOT NULL,
  `hinh_anh` text NOT NULL,
  `ngay_sinh` text NOT NULL,
  `gioi_tinh` int(11) NOT NULL,
  `quyen_han` int(11) NOT NULL,
  `hien_thi` int(11) NOT NULL,
  `ngay_tao` int(11) NOT NULL,
  `is_admin` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_user`
--

LOCK TABLES `db_user` WRITE;
/*!40000 ALTER TABLE `db_user` DISABLE KEYS */;
INSERT INTO `db_user` VALUES (1,'2c723b91d9c723c3691700c260c2c05cbb1edf5b','d033e22ae348aeb5660fc2140aec35850c4da997','4e759135aec962609165c496ab8dcb98b856d933','admin','admin@gmail.com','Administrator','','','','',1,1,1,1473306606,1),(16,'','cb0ef4c7be04ff1bf4cfcd104ef8df03251266ab','cb0ef4c7be04ff1bf4cfcd104ef8df03251266ab','','','','','','','',1,1,1,1,1);
/*!40000 ALTER TABLE `db_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_user_permission_group`
--

DROP TABLE IF EXISTS `db_user_permission_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_user_permission_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_permission` int(11) NOT NULL,
  `stt` int(11) NOT NULL,
  `hide` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_user_permission_group`
--

LOCK TABLES `db_user_permission_group` WRITE;
/*!40000 ALTER TABLE `db_user_permission_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_user_permission_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_video`
--

DROP TABLE IF EXISTS `db_video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten_vn` varchar(255) NOT NULL,
  `ten_us` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `hien_thi` tinyint(1) NOT NULL,
  `id_loai` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_video`
--

LOCK TABLES `db_video` WRITE;
/*!40000 ALTER TABLE `db_video` DISABLE KEYS */;
INSERT INTO `db_video` VALUES (19,'Apple','','WVPRkcczXCY',1,0),(20,'Phòng cháy','Phòng cháy','FYmDP09vSYQ',1,0);
/*!40000 ALTER TABLE `db_video` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-03-19  8:24:04
