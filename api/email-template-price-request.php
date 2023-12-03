<?php 
ob_start();
if (!isset($_SESSION)) {
  session_start();
}

$site_url = getenv('APP_URL');
$SETTINGS = $d->getAllSettings();

$type = '';
$price_promotion_price = '';

if ( $_POST['thongSoSanPham'] ) {
  $type.= '<p>- Để bán lại</p>';
}
if ( $_POST['chungNhanKiemDinh'] ) {
	$type.= '<p>- Dùng cho doanh nghiệp</p>';
}
if ( $_POST['hoSoCongTy'] ) {
  $type.= '<p>- Dùng tại nhà</p>';
}

if (!!$ctsp[0]['price'] || !!$ctsp[0]['promotion_price']) {
	$price_promotion_price = ': ' . $d->vnd($ctsp[0]['promotion_price'] ?: $ctsp[0]['price']) . '/' . ($ctsp[0]['unit'] ?: 'Cái');
} else{
    $price_promotion_price = 'Liên hệ';
}

if (empty($ctsp[0]['image_path'])) {
    //$ctsp_img = $d->getDefaultProductImage();
} else {
    $ctsp_img = THUMB_BASE . 'images/100/100/' . $ctsp[0]['id'] . '/' . $ctsp[0]['image_path'];
}

$tbl_style = 'width:100%;margin:0;';
$tbl_wrap_style = 'color:#000000;margin:0 auto;border:1px solid #cccccc;width:700px;max-width:100%;font-size:15px;line-height:23px;';
$a_style = 'color:#000000;';
//$logo_url = $site_url. '/img_data/images/'.$SETTINGS['website_logo']['value'];
$logo_url = $site_url. '/images/160/65/'.$SETTINGS['website_logo']['value'] . '?zc=0';

$email_query = "SELECT * FROM #_email_bao_gia";
$email_items = $d->o_fet($email_query);
$email_menu_title_1 = $email_items[0]['email_menu_title_1'];
$email_menu_link_1 = $email_items[0]['email_menu_link_1'];
$email_menu_title_2 = $email_items[0]['email_menu_title_2'];
$email_menu_link_2 = $email_items[0]['email_menu_link_2'];
$email_menu_title_3 = $email_items[0]['email_menu_title_3'];
$email_menu_link_3 = $email_items[0]['email_menu_link_3'];
$email_content = $email_items[0]['email_content'];
$email_address = $email_items[0]['email_address'];
$email_phone = $email_items[0]['email_phone'];
$email_email = $email_items[0]['email_email'];
$email_footer_title = $email_items[0]['email_footer_title'];
$email_footer_content = $email_items[0]['email_footer_content'];
$email_footer_menu_title_1 = $email_items[0]['email_footer_menu_title_1'];
$email_footer_menu_link_1 = $email_items[0]['email_footer_menu_link_1'];
$email_footer_menu_title_2 = $email_items[0]['email_footer_menu_title_2'];
$email_footer_menu_link_2 = $email_items[0]['email_footer_menu_link_2'];
$email_footer_menu_title_3 = $email_items[0]['email_footer_menu_title_3'];
$email_footer_menu_link_3 = $email_items[0]['email_footer_menu_link_3'];

$mail_price_request_template = '<div style="'.$tbl_wrap_style.'"><table style="'.$tbl_style.' background-color: #fef5e4;" cellpadding="15" cellspacing="0">
                <tr>
                    <td><img width="160" src="'.$logo_url.'" alt=""></td>
                    <td><a style="'.$a_style.'" href="'.$email_menu_link_1.'/he-thong-phu-tung.html">'.$email_menu_title_1.'</a></td>
                    <td><a style="'.$a_style.'" href="'.$email_menu_link_2.'/thiet-bi-nang-ha.html">'.$email_menu_title_2.'</a></td>
                    <td><a style="'.$a_style.'" href="'.$email_menu_link_3.'/thiet-bi-cong-nghiep.html">'.$email_menu_title_3.'</a></td>
                </tr>
            </table>
            <table style="'.$tbl_style.'" cellpadding="15" cellspacing="0">
                <tr>
                    <td style="padding: 25px 0;text-align: center;">
                        '.$email_content.'
                        <p style="margin:0;"><a style="background-color: #f0ad4e;display:inline-block;padding:10px 20px;border-radius:5px;text-decoration:none;color:#ffffff;" href="'.$site_url.'">Xem website</a></p>
                    </td>
                </tr>
            </table>
            <table style="'.$tbl_style.' background-color: #fef5e4;" cellpadding="15" cellspacing="0">
                <tr>
                    <td style="border-bottom:1px solid #cccccc;">Bạn đã yêu cầu:</td>
                    <td style="border-bottom:1px solid #cccccc;">
                        <p>Giá: '.$price_promotion_price.'</p>
                        '.$type.'
                    </td>
                </tr>
                <tr>
                    <td style="border-bottom:1px solid #cccccc;">Lời nhắn:</td>
                    <td style="border-bottom:1px solid #cccccc;">'.$_POST['noi_dung'].'</td>
                </tr>
            </table>
            <table style="'.$tbl_style.' padding:25px;text-align:center" cellpadding="15" cellspacing="0">
                <tr>
                    <th style="border-bottom:1px solid #cccccc;">SẢN PHẨM</th>
                    <th style="border-bottom:1px solid #cccccc;">TÊN</th>
                    <th style="border-bottom:1px solid #cccccc;">SỐ LƯỢNG</th>
                </tr>
                <tr style="border-bottom:1px solid #cccccc;">
                    <td><img src="'.$ctsp_img.'" /></td>
                    <td>'.$ctsp[0]['name_' . $_SESSION['lang']].'</td>
                    <td>'.$_POST['soLuong'].'</td>
                </tr>
            </table>
            <table style="'.$tbl_style.' background-color: #fef5e4;" cellpadding="15" cellspacing="0">
                <tr>
                    <td>
                        <p><img src="'.$logo_url.'" alt="" style="width: 160px; margin: 0 auto; display: block"></p>
                        <p>'.$email_address.'</p>
                        <p style="margin:0 0 5px;"><a style="'.$a_style.'" href="tel:'.$email_phone.'">'.$email_phone.'</a></p>
                        <p style="margin:0;"><a style="'.$a_style.'" href="mailto:'.$email_email.'">'.$email_email.'</a></p>
                    </td>
                    <td>
                        <p><strong>'.$email_footer_title.'</strong></p>
                        <p>'.$email_footer_content.'</p>
                        <p>
                            <a style="'.$a_style.'" href="'.$email_footer_menu_link_1.'">'.$email_footer_menu_title_1.'</a>&nbsp;&nbsp;&nbsp;
                            <a style="'.$a_style.'" href="'.$email_footer_menu_link_2.'">'.$email_footer_menu_title_2.'</a>&nbsp;&nbsp;&nbsp;
                            <a style="'.$a_style.'" href="'.$email_footer_menu_link_3.'">'.$email_footer_menu_title_3.'</a>
                        </p>
                    </td>
                </tr>
            </table>';
?>