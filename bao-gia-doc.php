<?php
if (!isset($_SESSION)) {
	session_start();
}

function convert_number_to_words($number) {
	$hyphen = ' ';
	$conjunction = '  ';
	$separator = ' ';
	$negative = 'âm ';
	$decimal = ' phẩy ';
	$dictionary = array(
		0 => 'Không',
		1 => 'Một',
		2 => 'Hai',
		3 => 'Ba',
		4 => 'Bốn',
		5 => 'Năm',
		6 => 'Sáu',
		7 => 'Bảy',
		8 => 'Tám',
		9 => 'Chín',
		10 => 'Mười',
		11 => 'Mười một',
		12 => 'Mười hai',
		13 => 'Mười ba',
		14 => 'Mười bốn',
		15 => 'Mười năm',
		16 => 'Mười sáu',
		17 => 'Mười bảy',
		18 => 'Mười tám',
		19 => 'Mười chín',
		20 => 'Hai mươi',
		30 => 'Ba mươi',
		40 => 'Bốn mươi',
		50 => 'Năm mươi',
		60 => 'Sáu mươi',
		70 => 'Bảy mươi',
		80 => 'Tám mươi',
		90 => 'Chín mươi',
		100 => 'trăm',
		1000 => 'ngàn',
		1000000 => 'triệu',
		1000000000 => 'tỷ',
		1000000000000 => 'nghìn tỷ',
		1000000000000000 => 'ngàn triệu triệu',
		1000000000000000000 => 'tỷ tỷ',
	);

	if (!is_numeric($number)) {
		return false;
	}

	if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
		// overflow
		trigger_error('convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING);
		return false;
	}

	if ($number < 0) {
		return $negative . convert_number_to_words(abs($number));
	}

	$string = $fraction = null;

	if (strpos($number, '.') !== false) {
		list($number, $fraction) = explode('.', $number);
	}

	switch (true) {
	case $number < 21:
		$string = $dictionary[$number];
		break;
	case $number < 100:
		$tens = ((int) ($number / 10)) * 10;
		$units = $number % 10;
		$string = $dictionary[$tens];
		if ($units) {
			$string .= $hyphen . $dictionary[$units];
		}
		break;
	case $number < 1000:
		$hundreds = $number / 100;
		$remainder = $number % 100;
		$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
		if ($remainder) {
			$string .= $conjunction . convert_number_to_words($remainder);
		}
		break;
	default:
		$baseUnit = pow(1000, floor(log($number, 1000)));
		$numBaseUnits = (int) ($number / $baseUnit);
		$remainder = $number % $baseUnit;
		$string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
		if ($remainder) {
			$string .= $remainder < 100 ? $conjunction : $separator;
			$string .= convert_number_to_words($remainder);
		}
		break;
	}

	if (null !== $fraction && is_numeric($fraction)) {
		$string .= $decimal;
		$words = array();
		foreach (str_split((string) $fraction) as $number) {
			$words[] = $dictionary[$number];
		}
		$string .= implode(' ', $words);
	}

	return $string;
}

define('__ROOT_PATH', dirname(__FILE__));
define('_lib', './admin/lib/');
define('_source', './sources/');
@include_once _lib . "config.php";
@include_once _lib . "function.php";
global $d;
global $lang;
include _source . "lang.php";
include _source . "language_" . $_SESSION['lang'] . ".php";
$d = new func_index($config['database']);
date_default_timezone_set('Asia/Ho_Chi_Minh');
$information = $d->simple_fetch("select * from #_thongtin limit 0,1");
$SETTINGS = $d->getAllSettings();
?>

<style type="text/css">
    * {
        box-sizing: border-box;
    }
    table.page_header {width: 100%; border: none; background-color: #245e8a;  padding: 2mm; color: white; }
    table.page_footer {width: 100%; border: none; background-color: #245e8a; padding: 2mm; color: white;}
    table.table { border: 1px solid #333; width: 100% }
    div.note {color: #333; width: 100%; padding: 0 15px; box-sizing: border-box; }
    ul.main { width: 95%; list-style-type: square; }
    ul.main li { padding-bottom: 2mm; }
    h3 { text-align: center; font-size: 14mm}
    p { margin: 5px 0; }
    table.page_footer a, table.page_header a { text-decoration: none; color: white;}
    table.table {
      font-family: freeserif, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;
      box-sizing: border-box;
      max-width: 100%;
    }

    table.table td, table.table th {
      border: 1px solid #ddd;
      padding: 8px;
    }

    table.table tr:nth-child(even){background-color: #f2f2f2;}

    table.table tr:hover {background-color: #ddd;}

    table.table th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
      background-color: #1c3e95;
      color: white;
    }
    img.logo {

    }
    pre {
        font-family: freeserif, Helvetica, sans-serif;
    }
</style>
<link href="<?=URLPATH . "img_data/icon/" . $information['favicon'];?>" rel="shortcut icon" type="image/x-icon" />
<page backbottom="14mm" style="font-size: 12pt; font-family: freeserif; width: 100%">
    <!-- <page_header>
        <table class="page_header">
            <tr>
                <td style="width: 50%; text-align: left">
                    Báo giá
                </td>
                <td style="width: 50%; text-align: right">
                    <?php echo getenv('APP_DOMAIN'); ?>
                </td>
            </tr>
        </table>
    </page_header> -->
    <page_footer>
        <table class="page_footer">
            <tr>
                <td style="width: 33%; text-align: left;">
                    <a href="<?php echo getenv('APP_URL'); ?>/"><?php echo getenv('APP_URL'); ?></a>
                </td>
                <td style="width: 34%; text-align: center">
                    Page [[page_cu]]/[[page_nb]]
                </td>
                <td style="width: 33%; text-align: right">
                    <?php echo date('d.m.Y h.m.sA'); ?>
                </td>
            </tr>
        </table>
    </page_footer>
    <table style="width: 100%;margin-bottom:35px;">
        <tr>
            <td align="center" style="vertical-align: middle; width: 260px; white-space: nowrap; overflow: hidden">
                <img src="img_data/images/<?php echo $SETTINGS['company_stamp']['value']; ?>" width=80 height=80 class="con dau" style="display:inline-block;width:82%;height:auto;">
                <img src="img_data/images/<?php echo $SETTINGS['website_logo']['value']; ?>" width=161 height=80 class="logo"style="display:inline-block;width:18%;height:auto;" >
            </td>
            <td align="center" style="width: auto;text-align:center;">
                <p style="pading-left: 35px;">
                    <b>
                        <font face="Times New Roman" color="#0000FF"><?php echo $information['company_vn']; ?></font>
                    </b>
                </p>
                <p style="pading-left: 35px;">
                    <i>
                        <font face="Times New Roman" color="#0000FF"><?php echo $information['address']; ?></font>
                    </i>
                </p>
                <p style="pading-left: 35px;">
                    <font face="Times New Roman" color="#0000FF">Email: <?php echo $information['email']; ?>, Website: <?php echo $SETTINGS['website']['value']; ?> </font>
                </p>
                <p style="pading-left: 35px;">
                    <font face="Times New Roman" color="#0000FF">Tell: <?php echo $SETTINGS['tell_contact']['value']; ?></font>
                </p>
            </td>
        </tr>
    </table>
    <h1 style="text-align: center">BÁO GIÁ</h1>
    <p style="text-align: center"><?php echo 'Ngày ' . date('d') . ' tháng ' . date('m') . ' năm ' . date('Y'); ?></p>
    <div class="note" style="width:100%;padding-top:35px;">
        <p>Kính gửi: <strong>Quý khách <?php echo !empty($_GET['name']) ? $_GET['name'] : ''; ?></strong></p>
        <p>
            <?php
                if (!empty($_GET['phone'])): ?>
                    <span>Điện thoại: <strong><?php echo $_GET['phone']; ?></strong></span>
                <?php
                endif;
                if (!empty($_GET['email'])): ?>
                    <span style="margin-left: 150px">Email: <strong><?php echo $_GET['email']; ?></strong></span>
                <?php
                endif;
            ?>
        </p>
        <p style="margin-bottom: 15px;"><?php echo $SETTINGS['welcome_message']['value']; ?></p>
        <?php if (isset($_SESSION['cart'])): ?>
            <table style="width: 100%;" class="table table-hover table-bordered">
                    <tr>
                        <th style="width: 10px; text-align: center;">STT</th>
                        <th style="width: 80px; text-align: center;">Mã SP</th>
                        <th style="width: 240px; text-align: center;"><?=_namepro?></th>
                        <th style="width: 80px; text-align: center;"><?=_price?></th>

                        <th style="width: 45px; text-align: center;">SL</th>
                        <th style="width: 95px; text-align: center;"><?=_money?></th>
                    </tr>
                    <?php
$stt = 0;
$deliveryFee = 0;
$tongtien = 0;
$cartProducts = [];
$sumQuantity = 0;

if (count($_SESSION['cart']) > 0) {
	foreach ($_SESSION['cart'] as $key => $value) {
		//$product = $d->simple_fetch("select `id`, `category_id`, `alias_vi`, `alias_en`, `alias_ch`, `code`, `code_2`, `code_3`, `name_vi`, `name_en`, `name_ch`, `description_vi`, `description_en`, `description_ch`, `image_path`, `price`, `promotion_price`, `ngay_dang`, `is_hot`, `sp_moi`, `sp_hot`, `title_vi`, `title_en`, `title_ch`, `keyword`, `des`, `view`, `thanh_pho`, `quan`, `hien_thi`, `gear_type`, `group_pos`, `group_quantity`, `group_quantity`, `extra4`, `extra5`, `extra6`, `extra7`, `extra8`, `extra9`, `extra10`, `con_hang`, `so_thu_tu`, `style`, `specification`, `model`, `brand`, `loai`, `weight`, `nang_cao`, `khung_nang`, `mfg_year`, `gio_su_dung`, `xuat_xu`, `part_number`, `tinh_trang_hang`, `banh_sau`, `chieu_dai_cang`, `nang_thap_nhat`, `mat_ban`, `chieu_rong`, `bao_hanh`, `is_completed`, `cong_suat`, `ti_so_truyen`, `nguon_dien`, `kieu_dang` from #_sanpham where id={$key}");
        $product = $d->simple_fetch("select * from #_sanpham where id={$key}");
		$cartProducts[] = $product;
		if (!empty($product)) {
			$id_product = $product['id'];
			$price = $product['price'];
			if ($product['promotion_price'] > 0) {
				$price = $product['promotion_price'];
			}
			if (!is_string($deliveryFee) && !empty($product['weight']) && $product['weight'] !== 0 && !empty($_SESSION['delivery_area']['price'])) {
				$fee = $product['weight'] * $value['so_luong'] * $_SESSION['delivery_area']['price'];
				$deliveryFee += $fee;
				$tongtien += $fee;
			} else {
				$deliveryFee = 'Thông báo sau!';
			}

			$sumQuantity += $value['so_luong'];
			$tongtien += $price * $value['so_luong'];
			$stt++;
			?>
                            <tr>
                                <td style="text-align: center;"><?=$stt?></td>
                                <td style="width: 80px; word-break: break-all; word-wrap: break-word; white-space: pre-wrap; letter-spacing: all; text-align: center;"><?php echo preg_replace('/([\w]{9})/', '$1 ', $product['code']); ?></td>
                                <td style="width: 240px;">
                                    <a href="<?=URLPATH . $product['alias_' . $_SESSION['lang']]?>.html" style="text-decoration: none;">
                                        <?php
echo trim(@$product['name_' . $_SESSION['lang']]);
			?>
                                    </a>
                                </td>
                                <td align="right" style="font-size: 15px;"><?=@$d->vnd($price)?></td>
                                <td align="center" style="font-size: 15px;">
                                    <?=$value['so_luong']?>
                                </td>

                                <td align="right" style="font-size: 15px;">
                                    <?php
echo $d->vnd($price * $value['so_luong']);
			?>
                                </td>
                            </tr>
                    <?php }}}?>
                    <?php if (!empty($_SESSION['delivery_area'])) {
	$tongtien += $_SESSION['delivery_area']['price'];
	?>
                    <tr>
                        <td colspan="5">Phí vận chuyển</td>
                        <td colspan="1" style="text-align: right; font-size: 15px;"><?php echo $d->vnd($_SESSION['delivery_area']['price']); ?></td>
                    </tr>
                    <?php }?>
                    <tr>
                        <td colspan="5">Cộng</td>
                        <td colspan="1" style="text-align: right; font-size: 15px;"><?php echo $d->vnd($tongtien); ?></td>
                    </tr>
                    <tr>
                        <td colspan="5">Thuế VAT 10%</td>
                        <td colspan="1" style="text-align: right; font-size: 15px;"><?php echo $d->vnd($tongtien * 0.1); ?></td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <b>Tổng tiền:</b>
                        </td>
                        <td colspan="1" style="text-align: right; font-size: 17px;">
                            <b><?php echo $d->vnd($tongtien * 1.1); ?></b>
                        </td>

                    </tr>
            </table>
            <p style="margin: 15px 0;">
                <b><font face="Times New Roman" size="3" color="#0000FF">Bằng chữ: <?php echo convert_number_to_words($tongtien * 1.1); ?> nghìn đồng</font></b>
            </p>


        <?php endif;?>
    </div>
    <div class="note" style="width:100%;">
        <table style="margin-top: 30px; width: 100%;">
            <tr>
                <td style="width: 50%;">
                    <b><u>Ghi chú:</u></b>
                    <i>
                        <pre><?php echo $SETTINGS['price_quote_note']['value']; ?></pre>
                    </i>
                    <p>
                        <b style="font-size: 13px">XÁC NHẬN CỦA QUÝ KHÁCH HÀNG</b>
                    </p>
                </td>
                <td style="width: 50%" align="center">
                    <p style="text-align: center; color: #0000FF;">
                        Người báo giá
                    </p>
                    <img src="img_data/images/<?php echo $SETTINGS['ceo_sign']['value']; ?>" width="287" height="82" hspace="5" vspace="1">
                    <p><?php echo $SETTINGS['ceo_name']['value']; ?></p>
                </td>
            </tr>
        </table>
    </div>
    <div class="note" style="width:100%;">
        <hr style="border: 1px solid #333; border-bottom: none;">
    </div>
</page>