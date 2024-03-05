<?php
/**
 * Vân Thiên Hùng chuyên lừa đảo, lợi dụng tín nhiệm lừa tiền anh em lập trình.
 * Hứa hẹn thanh toán, tới ngày thì than thở kêu chưa thu được tiền từ năm này qua tháng nọ, hẹn tới hẹn lui không có hồi kết.
 * Tới lúc bị anh em Dev đòi thì xoá Zalo, đổi pass server nhằm chặn anh em Dev vào phá.
 * Đã quỵt tiền 2 người tổng cộng 70 triệu
 * Chúc may mắn cho anh em nào đang làm tiếp với Vân Thiên Hùng ^^!.
 */
if (!isset($_SESSION)) {
    session_start();
}

$paymentMethods = [
    '1' => 'cod',
    '2' => 'banktransfer',
    '6' => 'vnpay'
];

if (isset($_POST['addcart'])) {
    $id = $_POST['id'];
    $soluong = isset($_POST['soluong']) ? $_POST['soluong'] : 1;
    $soluong = (int) $soluong;
    $color = addslashes($_POST['color']);
    $size = addslashes($_POST['size']);
    $detail = $d->simple_fetch("select * from #_sanpham where id={$id}");
    if (!empty($detail)) {
        $id_pro = $detail['id'];
        if (isset($_SESSION['cart'][$id_pro])) {
            $_SESSION['cart'][$id_pro]['so_luong'] = $_SESSION['cart'][$id_pro]['so_luong'] + $soluong;
            $_SESSION['cart'][$id_pro]['mau'] = $color;
            $_SESSION['cart'][$id_pro]['size'] = $size;
        } else {
            $_SESSION['cart'][$id_pro]['so_luong'] = $soluong;
            $_SESSION['cart'][$id_pro]['mau'] = $color;
            $_SESSION['cart'][$id_pro]['size'] = $size;
        }
    }
}

if (isset($_POST['guidonhang'])) {

    if (isset($_SESSION['cart'])) {
        //kiem tra so luong don hang

        $ma_donhang = 'DH' . $d->chuoird('5');

        $d->reset();
        $data['trang_thai'] = 0;
        $data['tinh_trang'] = isset($_POST['in_bao_gia']) ? -1 : 0;
        $data['ho_ten'] = $d->clear($_POST['ten']);
        $data['email'] = $d->clear($_POST['email']);
        $data['dia_chi'] = $d->clear($_POST['address'] . ', '. $_POST['commune'] . ', ' . $_POST['county'] . ', ' . $_POST['province']);
        $data['dien_thoai'] = $d->clear($_POST['dienthoai']);
        $data['hinh_thuc_thanh_toan'] = $d->clear($_POST['thanhtoan']);

        $province_name = $d->clean($_POST['province']);
        $delivery_area = $d->simple_fetch("select * from #_delivery_area where name='{$province_name}'");
        $shipping_fee = $delivery_area['price'];

        $timeRadios = ($_POST['timeRadios'] == 'timeNow') ? 'Giao khi có hàng' : 'Giao vào ngày ';
        if ($_POST['timeRadios'] == 'timeDate') {
            $timeRadios .= $_POST['date_shipping'] . ' ' . $_POST['time_shipping'];
        }

        $data['loi_nhan'] = addslashes($_POST['loinhan']);
        $data['ma_dh'] = $ma_donhang;
        $data['ngay_dat_hang'] = time();

        $data['ten_cong_ty'] = addslashes($_POST['company_name']);
        $data['dia_chi_cong_ty'] = addslashes($_POST['company_address']);
        $data['ma_so_thue'] = addslashes($_POST['company_vat']);

        // Data for send order to CRM
        $crmData = [
            'partnerOrderId' => $ma_donhang,
            'name' => $data['ho_ten'],
            'phone' => $data['dien_thoai'],
            'email' => $data['email'],
            'source' => getenv('APP_DOMAIN'),
            'paymentMethod' => $paymentMethods[$data['hinh_thuc_thanh_toan']],
            'message' => 'Địa chỉ: '. $data['dia_chi'] . '<br/>' . $data['loi_nhan'],
            'address' => [
                'countryId' => 'vn',
            ],
            'products' => [],
        ];

        $d->setTable('#_dathang');
        if ($id_don = $d->insert($data)) {

            $hinhthuc = [
                6 => 'Thanh toán trực tuyến VNPAY',
                2 => 'Chuyển khoản',
                1 => 'Thanh toán khi nhận hàng'
            ];

            $total = 0;
            $tongtien = 0;
            $no_image = URLPATH . $d->getDefaultProductImage2();

            foreach ($_SESSION['cart'] as $key => $value) {

                $product = $d->simple_fetch("select * from #_sanpham where id={$key}");
                // Custom name
                $product['name_' . $_SESSION['lang']] = getCustomProductName($product);

                if( $product['image_path'] ){
                    $product_img =THUMB_BASE . 'images/1000/1000/' . $product['id'] . '/' . $product['image_path'];
                } else {
                    $product_img = $no_image;
                }

                if (!empty($product)) {

                    $price = $product['price'];
                    if ($product['promotion_price'] > 0) {
                        $price = $product['promotion_price'];
                    }
                    $id_product = $product['id'];

                    $tongtien = $tongtien + ($price * $value['so_luong']);

                    $d->reset();
                    $data_2['ma_dh'] = $ma_donhang;
                    $data_2['id_dh'] = $id_don;
                    $data_2['price'] = $product['price'];
                    $data_2['promotion_price'] = $product['promotion_price'];
                    $data_2['id_sp'] = $id_product;
                    $data_2['so_luong'] = $value['so_luong'];
                    // $data_2['mau'] = $value['mau'] ?: 0;
                    // $data_2['size'] = $value['size'] ?: 0;
                    
                    $crmData['products'][] = [
                        'productId' => $id_product,
                        'price' => $product['promotion_price'] ?: $product['price'],
                        'oldPrice' => $product['price'],
                        'quantity' => $value['so_luong'],
                    ];

                    //Kết nối Cổng thanh toán VNPAY
                    $vnp_HashSecret = getenv('VNPAY_SECRET');
                    $vnp_Url = getenv('VNPAY_URL');
                    $vnp_Returnurl = getenv('APP_URL') . "/cart-success.html";
                    $vnp_TmnCode = getenv('VNPAY_TMN_CODE'); //Mã website tại VNPAY
                    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
                    $inputData = array(
                        "vnp_Version" => "2.0.0",
                        "vnp_TmnCode" => $vnp_TmnCode,
                        "vnp_Amount" => $tongtien * 100,
                        "vnp_Command" => "pay",
                        "vnp_CreateDate" => date('YmdHis'),
                        "vnp_CurrCode" => "VND",
                        "vnp_IpAddr" => $vnp_IpAddr,
                        "vnp_Locale" => "vn",
                        "vnp_OrderInfo" => "Thanh toan don hang $ma_donhang",
                        "vnp_OrderType" => "other",
                        "vnp_ReturnUrl" => $vnp_Returnurl,
                        "vnp_TxnRef" => $ma_donhang,
                    );
                    ksort($inputData);
                    $query = "";
                    $i = 0;
                    $hashdata = "";
                    foreach ($inputData as $key => $value) {
                        if ($i == 1) {
                            $hashdata .= '&' . $key . "=" . $value;
                        } else {
                            $hashdata .= $key . "=" . $value;
                            $i = 1;
                        }
                        $query .= urlencode($key) . "=" . urlencode($value) . '&';
                    }

                    $vnp_Url = $vnp_Url . "?" . $query;
                    if (isset($vnp_HashSecret)) {
                        // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
                        // $vnp_Url .= 'vnp_SecureHashType=MD5&vnp_SecureHash=' . $vnpSecureHash;
                        $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
                        $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
                    }
                    $d->setTable('#_chitietdathang');
                    $d->insert($data_2);

                    $row_nd .= '
                    <tr>
                        <td style="background-color:white;color:#000;text-align:center;"><img width="100px" style="width: 100px;" src="'.$product_img.'" alt="' . $product['name_' . $_SESSION['lang']] . '"></td>
                        <td style="background-color:white;color:#000">' . $product['name_' . $_SESSION['lang']] . '</td>
                        <td style="background-color:white;color:#000">' . $value['so_luong'] . '</td>
                        <td style="background-color:white;color:#000;text-align:right">' . number_format($price) . ' VNĐ</td>
                        <td style="background-color:white;color:#000;text-align:right">' . number_format($price * $value['so_luong']) . ' VNĐ</td>
                    </tr>
                                            ';
                }
            }

            include_once "./smtpv2/index.php";
            $email_admin_url = __ROOT_PATH . '/smtpv2/email_admin.json';
            $admin_email = file_get_contents($email_admin_url);
            $email_admin = $admin_email?$admin_email:getenv('ADMIN_EMAIL');

            //Get thong tin
            $thongtin = $d->simple_fetch("select * from #_thongtin limit 0,1");
            if (!isset($_POST['in_bao_gia'])) {
                unset($_SESSION['cart']);
            }

            //Get email settings
            $email_sql = "SELECT * FROM #_emails WHERE `email_type` = 'dat_hang'";
	        $email_query = $d->o_fet($email_sql);
            $email = array();

            $tell = $information['hotline'];
            $zalo = $information['zalo'];
            $skype = 'xenang_ts';
            $website = getenv('APP_DOMAIN');

            if( $email_query ){
                $email = $email_query[0];
                $thank_you = $email['thank_you'];
                $dear_name = $email['dear_name'];
                $company_info_title = $email['company_info_title'];
                $company_info_account = $email['company_info_account'];
                $personal_info_title = $email['personal_info_title'];
                $personal_info_account = $email['personal_info_account'];
                $tell = $email[0]['tell'];
                $zalo = $email[0]['zalo'];
                $skype = $email[0]['skype'];
                $website = $email[0]['website'];
            }
            $thank_you = $thank_you?$thank_you:'Thanks and best regards!';
            $dear_name = $dear_name?$dear_name:'Tuấn Nguyễn (Mr)';
            $company_info_title = $company_info_title?$company_info_title:'Thông tin Thanh Toán CTY:';
            if( !$company_info_account ){
                $company_info_account = '<div><span style="color:rgb(11, 83, 148)"><span style="color:rgb(0, 0, 0)">Chủ TK&nbsp; :</span>&nbsp;<strong>' . getenv('FULL_COMPANY_NAME') . '</strong></span></div>
                        <div><span style="color:rgb(11, 83, 148)"><span style="color:rgb(0, 0, 0)">Số TK 1 :</span>&nbsp;<strong>0381000400469 NH Vietcombank CN Thủ Đức - PGD Linh Trung</strong></span></div>
                        <div><span style="color:rgb(11, 83, 148)"><span style="color:rgb(0, 0, 0)">Số TK 2 :</span>&nbsp;<strong>125981461&nbsp; NH VPbank CN Bình Dương</strong></span></div>';
            }

            $personal_info_title = $personal_info_title?$personal_info_title:'Thông tin tk cá nhân:';
            if( !$personal_info_account ){
                $personal_info_account = '<div><strong><span style="color:rgb(11, 83, 148)"><em>Ctk: &nbsp; &nbsp; VÕ THỊ LY<br />
                        stk1: &nbsp; 31410001581028&nbsp;&nbsp;&nbsp;&nbsp;</em><em><em>NH&nbsp;<span style="color:rgb(204, 0, 0)">BIDV&nbsp;</span>Đông Sài Gòn PGD Linh Trung 2</em><br />
                        stk2:&nbsp;&nbsp; 0381000384758 &nbsp; &nbsp;&nbsp; NH&nbsp;<span style="color:rgb(204, 0, 0)">Vietcombank</span>&nbsp;CN Thủ Đức PGD Linh Trung</em></span></strong></div>
                        <strong><span style="color:rgb(11, 83, 148)"><em>stk3: &nbsp; 145480547&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; NH&nbsp;<span style="color:rgb(204, 0, 0)">VPbank</span>&nbsp;CN Thủ Đức,HCM</em></span></strong></div>
                        <div><strong><span style="color:rgb(11, 83, 148)"><em>stk3:&nbsp;&nbsp;</em></span></strong><strong><span style="color:rgb(11, 83, 148)"><em>060184498858&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; NH&nbsp;<span style="color:rgb(204, 0, 0)">Sacombank</span>&nbsp;CN Thủ Đức,HCM</em></span></strong></div>';
            }

            $export_order = '';
            if($data['ten_cong_ty']){
                $export_order = '<tr>
                                    <td style="background-color:white;color:#000">Xuất hóa đơn công ty</td>
                                    <td style="background-color:white;color:#000">
                                        <p style="margin:0 0 8px;">Tên công ty: '.stripslashes($data['ten_cong_ty']).'</p>
                                        <p style="margin:0 0 8px;">Địa chỉ công ty: '.stripslashes($data['dia_chi_cong_ty']).'</p>
                                        <p style="margin:0;">Mã số thuế: '.stripslashes($data['ma_so_thue']).'</p>
                                    </td>
                                </tr>';
            }

            $noidung = '
                    <h3><b>Mã đơn hàng: ' . $ma_donhang . '</b></h3><br>
                    <table style="width:100%;min-width:800px;margin:auto;background-color:#ccc;font-size:14px;font-family:Tahoma,Geneva,sans-serif;line-height:20px" border="0" cellpadding="8" cellspacing="1">
                        <tbody>
                            <tr style="background: linear-gradient(#ffffff, #f1f1f1);font-weight:bold">
                                <td style="color:#000">Hình ảnh</td>
                                <td style="color:#000">Tên</td>
                                <td style="color:#000">Số lượng</td>
                                <td style="color:#000">Giá</td>
                                <td style="color:#000">Thành tiền</td>
                            </tr>' . $row_nd . '
                            <tr>
                                <td colspan="5" style="color:#4cae4c">Phí vận chuyển: ' . number_format($shipping_fee) . ' VNĐ (Tạm tính)</td>
                            </tr>
                            <tr>
                                <td colspan="5">Thời gian giao hàng: ' . $timeRadios . '</td>
                            </tr>
                            <tr>
                                <td colspan="4" style="background-color:white;color:#000"></td>
                                <td style="background-color:white;color:#000;text-align:right"><b>Tổng tiền:</b></td>
                                <td style="background-color:white;color:#000;text-align:right;color:red"><b>' . number_format($tongtien) . ' VNĐ</b></td>
                            </tr>
                            
                        </tbody>
                    </table>

                    <br></br>

                    <table style="width:100%;min-width:800px;margin:auto;background-color:#ccc;font-size:14px;font-family:Tahoma,Geneva,sans-serif;line-height:20px" border="0" cellpadding="8" cellspacing="1">
                        <tbody>
                            <tr style="background: linear-gradient(#ffffff, #f1f1f1);">
                                <td colspan="2" style="color:#000"><b>Thông tin khách hàng</b></td>
                            </tr>
                            <tr>
                                <td style="background-color:white;color:#000">Họ tên</td>
                                <td style="background-color:white;color:#000">' . $data['ho_ten'] . '</td>
                            </tr>
                            <tr>
                                <td style="background-color:white;color:#000">Email</td>
                                <td style="background-color:white;color:#000">' . $data['email'] . '</td>
                            </tr>
                            <tr>
                                <td style="background-color:white;color:#000">Điện thoại</td>
                                <td style="background-color:white;color:#000">' . $data['dien_thoai'] . '</td>
                            </tr>
                            <tr>
                                <td style="background-color:white;color:#000">Địa chỉ</td>
                                <td style="background-color:white;color:#000">' . $data['dia_chi'] . '</td>
                            </tr>
                            <tr>
                                <td style="background-color:white;color:#000">Hình thức thanh toán</td>
                                <td style="background-color:white;color:#000">' . $hinhthuc[$_POST['thanhtoan']] . '</td>
                            </tr>
                            '.$export_order.'
                        </tbody>
                    </table>

                    <br></br>

                    <p>Cảm ơn quý khách!</p>

                    <p><span style="color:rgb(34, 34, 34); font-family:arial,helvetica,sans-serif; font-size:small">--&nbsp;</span></p>

                    <div style="color: rgb(34, 34, 34); font-family: Arial, Helvetica, sans-serif; font-size: small;">
                    
                        <div>------------------------------------</div>
                        <div>&nbsp;</div>
                    
                        <div><span style="color:rgb(11, 83, 148)"><strong>'.$thank_you.'</strong></span>
                        <div>&nbsp;</div>

                        <div><span style="color:rgb(11, 83, 148)"><strong>'.$dear_name.'</strong></span></div>
                        <div>=======================</div>

                        <div><span style="color:rgb(11, 83, 148)">Website: <a href="' . $website . '" style="color: rgb(17, 85, 204);" target="_blank"><em>' . $website . '</em></a></span></div>
                        <div><span style="color:rgb(11, 83, 148)">Tell: <strong>' . $tell . '</strong></span></div>
                        <div><span style="color:rgb(11, 83, 148)">Zalo: <strong>' . $zalo . '</strong></span></div>
                        <div><span style="color:rgb(11, 83, 148)">Skype: <strong>' . $skype . '</strong></span></div>
                        <div>&nbsp;</div>

                        <div><strong>'.$company_info_title.'</strong></div>
                        <div>&nbsp;</div>
                        '.$company_info_account.'
                 
                        <div dir="ltr">&nbsp;</div>

                        <div><strong>'.$personal_info_title.'</strong></div>
                        <div>&nbsp;</div>
                        '.$personal_info_account.'
                    </div>';
            $madh = $ma_donhang;

            // Send order to CRM
            sendOrderToCRM($crmData);

            $admin_sms = file_get_contents(__ROOT_PATH . '/img_data/files/sms/admin_sms.json');

            if (isset($_POST['in_bao_gia'])) {
                // send email to website owner
                sendEmail("1 khách hàng đã in báo giá! " . getenv('APP_DOMAIN'), $noidung, $email_admin, $email_admin,  $data['ho_ten']);
                if($admin_sms){
                    @sendSms($admin_sms, 'new_email_sent');
                }

                exit;
            } else {
                // send email to website owner and the customer
                sendEmail("Bạn có 1 đơn đặt hàng mới! " . getenv('APP_DOMAIN'), $noidung, $email_admin, $email_admin,  $data['ho_ten']);
                sendEmail("Đặt hàng thành công!", $noidung, $email_admin, $data['email'], $thongtin['company_vn']);
                
                @sendSms($data['dien_thoai'], 'order_received');
                
                if($admin_sms){
                    @sendSms($admin_sms, 'new_email_sent');
                }

                if ($_POST['thanhtoan'] == '6') {
                    // Disable online payment when 
                    if ($tongtien - $deliveryFee == 0) {
                        $d->transfer('Phương thức thanh toán này không khả dụng!', '/gio-hang.html');
                        exit;
                    }
    
                    $d->location($vnp_Url);
                } else {
                    // $d->location(URLPATH . "cart-success.html?id=" . $madh);
                    $d->transfer("Đặt hàng thành công, mã đơn hàng: " . $madh, '/');
                }
            }
        } else {
            $d->alert("The order has been sent or cart empty!");
        }
    }
}

if (isset($_POST['capnhatsl'])) {
    $id = addslashes($_POST['id']);
    $soluong = addslashes($_POST['soluong']);
    $d->reset();
    $data['so_luong'] = $soluong;
    $d->setWhere('id', $id);
    $d->setTable('#_chitietdathang');
    if (is_numeric($soluong) && $soluong > 0) {
        if ($d->update($data)) {
            $d->location(URLPATH . "gio-hang.html");
        }
    } else {
        $d->alert("Giỏ hàng trống");
    }
}

if (isset($_POST['xoasp'])) {
    $id = addslashes($_POST['id']);
    $d->reset();
    $d->setWhere('id', $id);
    $d->setTable('#_chitietdathang');
    if ($d->delete()) {
        $d->location(URLPATH . "gio-hang.html");
    }
}

if (isset($_POST['xoaall'])) {
    $d->reset();
    $d->setWhere('id_dh', @$_SESSION['iddonhang']);
    $d->setTable('#_chitietdathang');
    if ($d->delete()) {
        $d->location(URLPATH . "gio-hang.html");
    }
}

?>

<style type="text/css">
    .table tr th a {
        color: #000;
    }

    .wrapper-contai {
        position: static;
    }

    .payment-method {
        padding: 8px 8px 8px 10px;
        margin-bottom: 8px;
        background: #f5f5f5;
        border-radius: 5px;
    }

    .payment-method.disabled-method {
        opacity: 0.5;
    }

    .payment-method label {
        cursor: pointer;
        margin-bottom: 0;
        display: block;
    }

    .payment-method label img {
        margin: 0 5px;
    }
    .payment-description{
        border-top: 1px solid #ddd;
        padding-top: 10px;
        margin-top: 10px;
        display: none;
    }
    .payment-method-active .payment-description{
        display: block;
    }
    .company-order-wrap{
        display: none;
    }
    .company-order-wrap.active{
        display: block;
    }

    @keyframes hover-color {
        from {
            border-color: #c0c0c0;
            border-width: 1.5px;
            box-shadow: 0 0 5px #c0c0c0;
        }

        to {
            border-color: #3e97eb;
            border-width: 1.5px;
            box-shadow: 0 0 5px #3e97eb;
        }
    }

    .magic-radio,
    .magic-checkbox {
        position: absolute;
        display: none;
    }

    .magic-radio[disabled],
    .magic-checkbox[disabled] {
        cursor: not-allowed;
    }

    .magic-radio+label,
    .magic-checkbox+label {
        position: relative;
        display: block;
        padding-left: 30px;
        cursor: pointer;
        vertical-align: middle;
    }

    .magic-radio+label:hover:before,
    .magic-checkbox+label:hover:before {
        animation-duration: 0.4s;
        animation-fill-mode: both;
        animation-name: hover-color;
    }

    .magic-radio+label:before,
    .magic-checkbox+label:before {
        position: absolute;
        top: 50%;
        left: 0;
        transform: translateY(-50%);
        display: inline-block;
        width: 20px;
        height: 20px;
        content: '';
        border: 1px solid #c0c0c0;
    }

    .magic-radio+label:after,
    .magic-checkbox+label:after {
        position: absolute;
        display: none;
        content: '';
    }

    .magic-radio[disabled]+label,
    .magic-checkbox[disabled]+label {
        cursor: not-allowed;
        color: #e4e4e4;
    }

    .magic-radio[disabled]+label:hover,
    .magic-radio[disabled]+label:before,
    .magic-radio[disabled]+label:after,
    .magic-checkbox[disabled]+label:hover,
    .magic-checkbox[disabled]+label:before,
    .magic-checkbox[disabled]+label:after {
        cursor: not-allowed;
    }

    .magic-radio[disabled]+label:hover:before,
    .magic-checkbox[disabled]+label:hover:before {
        border: 1px solid #e4e4e4;
        animation-name: none;
    }

    .magic-radio[disabled]+label:before,
    .magic-checkbox[disabled]+label:before {
        border-color: #e4e4e4;
    }

    .magic-radio:checked+label:before,
    .magic-checkbox:checked+label:before {
        animation-name: none;
    }

    .magic-radio:checked+label:after,
    .magic-checkbox:checked+label:after {
        display: block;
    }

    .magic-radio+label:before {
        border-radius: 50%;
    }

    .magic-radio+label:after {
        top: 50%;
        left: 6px;
        transform: translateY(-50%);
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #3e97eb;
    }

    .magic-radio:checked+label:before {
        border: 1px solid #3e97eb;
    }

    .magic-radio:checked[disabled]+label:before {
        border: 1px solid #c9e2f9;
    }

    .magic-radio:checked[disabled]+label:after {
        background: #c9e2f9;
    }

    .magic-checkbox+label:before {
        border-radius: 3px;
    }

    .magic-checkbox+label:after {
        top: 2px;
        left: 7px;
        box-sizing: border-box;
        width: 6px;
        height: 12px;
        transform: rotate(45deg);
        border-width: 2px;
        border-style: solid;
        border-color: #fff;
        border-top: 0;
        border-left: 0;
    }

    .magic-checkbox:checked+label:before {
        border: #3e97eb;
        background: #3e97eb;
    }

    .magic-checkbox:checked[disabled]+label:before {
        border: #c9e2f9;
        background: #c9e2f9;
    }
</style>

<section>

    <div class="page-title">
        <div class="container bg-white">
            <div class="col-md-12 plr0">
                <ul class="breadcrumb">
                    <li><a href="<?= URLPATH ?>" title="<?= _trangchu ?>"><i class="fa fa-home"></i></a></li>
                    <li><a href="<?= URLPATH ?>gio-hang.html" title="<?= _cart ?>"><?= _cart ?></a></li>
                </ul>
            </div>
        </div>
    </div>

    <?php
    $stt = 0;
    $deliveryFee = 0;
    $tongtien = 0;
    $cartProducts = [];
    $sumQuantity = 0;
    $canPayOnline = false;
    $cartTable = '';

    ob_start();

    if (count($_SESSION['cart']) > 0) {
        $canPayOnline = true;
        foreach ($_SESSION['cart'] as $key => $value) {
            //$product = $d->simple_fetch("select `id`, `category_id`, `alias_vi`, `alias_en`, `alias_ch`, `code`, `code_2`, `code_3`, `name_vi`, `name_en`, `name_ch`, `description_vi`, `description_en`, `description_ch`, `image_path`, `price`, `promotion_price`, `ngay_dang`, `is_hot`, `sp_moi`, `sp_hot`, `title_vi`, `title_en`, `title_ch`, `keyword`, `des`, `view`, `thanh_pho`, `quan`, `hien_thi`, `gear_type`, `group_pos`, `group_quantity`, `group_quantity`, `extra4`, `extra5`, `extra6`, `extra7`, `extra8`, `extra9`, `extra10`, `con_hang`, `so_thu_tu`, `style`, `specification`, `model`, `brand`, `loai`, `weight`, `nang_cao`, `khung_nang`, `mfg_year`, `gio_su_dung`, `xuat_xu`, `part_number`, `tinh_trang_hang`, `banh_sau`, `chieu_dai_cang`, `nang_thap_nhat`, `mat_ban`, `chieu_rong`, `bao_hanh`, `is_completed`, `cong_suat`, `ti_so_truyen`, `nguon_dien`, `kieu_dang`, `name_json` from #_sanpham where id={$key}");
            $product = $d->simple_fetch("select * from #_sanpham where id={$key}");
            $product['name_' . $_SESSION['lang']] = getCustomProductName($product);

            $cartProducts[] = $product;
            if (!empty($product)) {
                $id_product = $product['id'];
                $price = $product['price'];
                if ($product['promotion_price'] > 0) {
                    $price = $product['promotion_price'];
                }

                // check online payment is available
                if ($price == 0) {
                    $canPayOnline = false;
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

                $cartTable .= '
                    <tr>
                        <td>' . $stt . '</td>
                        <td>
                            <img onerror="this.src=\'' . URLPATH . 'templates/error/error.jpg\';" src="' . URLPATH . 'thumb.php?src=' . URLPATH . 'img_data/images/' . @$product['image_path'] . '&w=50&h=50" width="50" height="50">
                        </td>
                        <td class="text-left">' . @$product['name_' . $_SESSION['lang']] . '</td>
                        <td>' . $value['so_luong'] . '</td>
                    </tr>
                ';
    ?>
                <tr>
                    <td><?= $stt ?></td>
                    <!--<td align="left">
                        <img onerror="this.src='<?= URLPATH ?>templates/error/error.jpg';" src="<?= URLPATH ?>thumb.php?src=<?= URLPATH ?>img_data/images/<?= @$product['image_path'] ?>&w=50&h=50">
                    </td>-->
                    <td>
                        <a href="<?= URLPATH . $product['alias_' . $_SESSION['lang']] ?>.html">
                            <?= @$product['name_' . $_SESSION['lang']] ?>
                        </a>
                    </td>
                    <td align="left"><strong><?= @$d->vnd($price) ?></strong></td>


                    <td align="center">
                        <!-- <input name="soluong" style="width: 50px;" type="number" value="<?= $value['so_luong'] ?>" onchange="chang_soluong(this,'<?= $product['id'] ?>','<?= $_SESSION['iddonhang'] ?>')" class="text-center soluong_<?= $value['soluong'] ?>"> -->
                        <span class="input-group quantity-input">
                            <span class="input-group-btn">
                                <button class="btn minus-one" data-product="<?= $product['id'] ?>">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </span>
                            <input type="number" name="soluong" value="<?= $value['so_luong'] ?>" min="1" step="1" onchange="chang_soluong(this,'<?= $product['id'] ?>','<?= $_SESSION['iddonhang'] ?>')" class="form-control text-center soluong_<?= $value['so_luong'] ?>">
                            <span class="input-group-btn">
                                <button class="btn add-one" data-product="<?= $product['id'] ?>">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </span>
                        </span>
                    </td>

                    <td align="left">
                        <div id="thanhtien_117" class="thanhtien_<?= $val['id'] ?> color-main">
                            <?php echo $d->vnd($price * $value['so_luong']); ?>
                        </div>
                    </td>
                    <td align="left">
                        <a href="javascript:;" onclick="xoa_sp_gh_dh('<?= $product['id'] ?>','<?= $_SESSION['iddonhang'] ?>','<?= _redel ?>?')" title="Xóa sản phẩm"><i class="fa fa-trash-o"></i></a>
                    </td>
                </tr>
    <?php
            }
        }
    }

    $tableContent = ob_get_clean();
    ?>

    <div class="container bg-white">

        <div class="col-md-5">
            <form action="" id="form-shopping" class="form-horizontal" method="post">
                <div class="title-form text-uppercase"><?= _infouser ?></div>
                <div class="form-group">
                    <label for="ten" class="col-sm-3 control-label "><?= _hoten ?> (<font class="red">*</font>)</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="ten" name="ten" data-error="<?= _typehoten ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email (<font class="red">*</font>)</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="email" name="email" data-error="<?= _type_email ?>">
                    </div>
                </div>
                <!-- <div class="form-group">
                            <label for="diachi" class="col-sm-3 control-label"><?= _address ?> (<font class="red">*</font>)</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="diachi" name="diachi" data-error="<?= _typeaddress ?>">
                            </div>
                        </div> -->
                <div class="form-group">
                    <label for="dienthoai" class="col-sm-3 control-label no-pd-right"><?= _sodienthoai ?> (<font class="red">*</font>)</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="dienthoai" name="dienthoai" data-error="<?= _typesodienthoai ?>">
                    </div>
                </div>

                <div class="title-form text-uppercase">Địa chỉ nhận hàng</div>

                <div class="form-group">
                    <label for="province" class="col-sm-3 control-label">Tỉnh/Thành phố:</label>
                    <div class="col-sm-9">
                        <select name="province" id="province" class="form-control" required>

                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="county" class="col-sm-3 control-label">Quận/Huyện:</label>
                    <div class="col-sm-9">
                        <select name="county" id="county" class="form-control" required>
                            <option>Chọn quận/huyện</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="commune" class="col-sm-3 control-label">Xã/Phường:</label>
                    <div class="col-sm-9">
                        <select name="commune" id="commune" class="form-control" required>
                            <option>Chọn xã/phường</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="loinhan" class="col-sm-3 control-label"><?= _message ?>:</label>
                    <div class="col-sm-9">
                        <textarea id="loinhan" class="form-control" rows="5" name="loinhan"></textarea>
                    </div>
                </div>

                <div class="title-form text-uppercase"><?= _voucher ?></div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="voucher" name="voucher">
                    </div>
                    <div class="col-sm-3">
                        <button type="button" class="btn btn-primary" id="add-voucher">Thêm</button>
                    </div>
                </div>

                
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="checkbox" value="1" name="company_order" class="company_order" id="company_order">
                        <label for="company_order">Xuất hóa đơn công ty</label>
                    </div>
                </div>
                <div class="company-order-wrap">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input class="form-control" type="text" name="company_name" placeholder="Tên công ty">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input class="form-control" type="text" name="company_vat" placeholder="Mã số thuế">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input class="form-control" type="text" name="company_address" placeholder="Địa chỉ công ty">
                        </div>
                    </div>
                </div>
               

                <div class="title-form text-uppercase"><?= _formpayment ?></div>

                <div class="form-group">
                    <label for="thanhtoan" class="col-sm-3 control-label">
                        <!-- <?= _formpayment ?>: --></label>
                    <div class="col-sm-12">
                        <?php
                        $view_vnpay_payment =  $d->getOption('view_vnpay_payment');
                        if($view_vnpay_payment){
                        ?>
                        <div class="payment-method <?php echo !$canPayOnline ? 'disabled-method' : '' ?>">
                            <input id="thanhtoan_vnpay" type="radio" name="thanhtoan" value="6" class="magic-radio" <?php echo $canPayOnline ? 'checked' : 'disabled'; ?>>
                            <label for="thanhtoan_vnpay">
                                <img src="/templates/images/logo-vnpay-qr.png" height="33" />
                                Thanh toán trực tuyến qua VNPAY
                            </label>
                        </div>
                        <?php }?>
                        
                        <div class="payment-method">
                            <input id="thanhtoan_ck" type="radio" name="thanhtoan" value="2" class="magic-radio" <?php echo !$canPayOnline ? 'checked' : '' ?>>
                            <label for="thanhtoan_ck">
                                <img src="/templates/images/icon-bank.png" height="33" />
                                Chuyển khoản
                            </label>
                            <?php 
                            $bank_account = $SETTINGS['bank_account']['value'];
                            if( $bank_account ){
                            ?>
                            <div class="bank-account payment-description"><?php echo $bank_account?></div>
                            <?php }?>
                        </div>
                        <div class="payment-method">
                            <input id="thanhtoan_cod" type="radio" name="thanhtoan" value="1" class="magic-radio">
                            <label for="thanhtoan_cod">
                                <img src="/templates/images/icon-cod.png" height="50">
                                Thanh toán khi nhận hàng
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group btn-placeorder-wrap">
                    <div class="col-sm-12">
                        <button type="submit" id="popup" class="btn-placeorder button button--aylen button--pd button--size-m" name="guidonhang">
                            <?= _sendcart ?>
                        </button>
                    </div>
                </div>

            </form>
        </div>

        <div class="col-sm-7 p0">
            <div class="page-cart">
                <div class="info-cart">
                    <?php if (isset($_SESSION['cart'])) {
                    ?>
                        <div class="title-form text-uppercase">
                            <?= _sp_chon ?>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered ">
                                <tbody>
                                    <tr>
                                        <th style="width:3%">STT</th>
                                        <!-- <th style="width:7%;">Mã sản phẩm</th> -->
                                        <!--<th style="width:7%;" align="left">Images</th>-->
                                        <th style="width:25%;" class=""><?= _namepro ?></th>
                                        <th style="width:15%; text-align: center;"><?= _price ?></th>

                                        <th style="width:10%;" align="center" class="th_soluong"><?= _number ?></th>
                                        <th style="width:15%;"><?= _money ?></th>
                                        <th style="width:10%;">
                                            <?= _del ?>
                                        </th>
                                    </tr>
                                    <?php echo $tableContent; ?>
                                    <tr>
                                        <td><?php echo $stt + 1; ?></td>
                                        <td colspan="3">Phí vận chuyển</td>
                                        <td>1</td>
                                        <td colspan="3" id="delivery_fee"><?php echo is_string($deliveryFee) ? $deliveryFee : $d->vnd($deliveryFee); ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="border-right: 0">
                                            <div class="mua-tiep">
                                                <a href="<?= URLPATH ?>" style="color: red;">Tiếp tục mua hàng</a>
                                            </div>
                                        </td>
                                        <td colspan="2">
                                            <?= _totalmoney ?>:
                                        </td>
                                        <td colspan="3" style="border-left: 0;">
                                            <div class="tong_tt">
                                                <h3 class="text-center"><span></span>
                                                    <font id="tong_tien_gh" class="color-main"><?= $d->vnd($tongtien) ?></font>
                                                </h3>
                                            </div>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>

                            <div>
                                <button type="button" class="btn btn-primary pull-right mr-1" id="request_quote_cart">Yêu cầu báo giá</button>
                                <?php 
                                $view_print_price_request = $d->getOption('view_print_price_request');
                                if($view_print_price_request){
                                ?>
                                <button class="button  button--aylen button--pd pull-right" id="print_price_request">In báo giá</button>
                                <?php }?>
                            </div>
                            <div class="clearfix"></div>

                        </div>
                </div>
            </div>
        </div>


        <div class="clearfix"></div>
        <?php
                        $cartTable = '<table class="table table-hover table-bordered ">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th align="left">Hình ảnh</th>
                                        <th>' . _namepro . '</th>

                                        <th align="center" class="th_soluong">' . _number . '</th>
                                    </tr>
                                </thead>
                                <tbody>
                                ' . $cartTable . '
                    </tbody>
                </table>
                ';
        ?>
    <?php } else { ?>

        <div class="well text-center">
            <a href="javascript:history.back()"><?= _cartblank ?></a>
        </div>

    <?php } ?>

    </div>
</section>

<!-- Modal order -->
<div class="modal fade" id="request_quote_cart_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <form id="request_quote_cart_form" name="request_quote_cart_form" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">YÊU CẦU BÁO GIÁ GIỎ HÀNG</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?php echo $cartTable; ?>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="request_quote_cart_ten">Tên <i class="text-danger">*</i></label>
                                <input type="text" id="request_quote_cart_ten" name="ten" class="form-control" placeholder="Tên" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="request_quote_cart_email">Email <i class="text-danger">*</i></label>
                                <input type="email" id="request_quote_cart_email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="request_quote_cart_phone"><?= _sodienthoai ?><i class="text-danger">*</i></label>
                                <input type="text" id="request_quote_cart_phone" name="dienthoai" class="form-control" placeholder="<?= _sodienthoai ?>" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group textarea-message">
                                <label for="noi_dung">Lời nhắn</label>
                                <textarea type="text" class="form-control" style="max-width: 100%" id="request_quote_cart_noi_dung" name="noi_dung" placeholder="Thêm lời nhắn hoặc các yêu cầu khác của bạn..." rows="8"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Bạn mua sản phẩm để</label>
                                <div>
                                    <label style="margin-right: 10px"><input type="checkbox" id="thongSoSanPham" name="thongSoSanPham"> Để bán lại</label>
                                    <label style="margin-right: 10px"><input type="checkbox" id="chungNhanKiemDinh" name="chungNhanKiemDinh"> Dành cho doanh nghiệp</label>
                                    <label style="margin-right: 10px"><input type="checkbox" id="hoSoCongTy" name="hoSoCongTy"> Sử dụng tại nhà</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group" id="listFiles">
                                <label>Thêm tệp đính kèm (<small>Nhiều nhất 5 tệp</small>)</label>
                                <input type="file" name="dinhKem[]" placeholder="Chọn file mẫu hoặc hình ảnh mà bạn muốn gửi cho chúng tôi" class="form-control file-att" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group item-captcha">
                                <label for="captcha">Mã xác nhận <i class="text-danger">*</i></label>
                                <input type="text" placeholder="Mã xác nhận" class="form-control" id="captcha" name="captcha" style="background: url(./sources/capchaimage.php) center right no-repeat" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default col-md-5" data-dismiss="modal">Đóng</button>
                    <button name="sub_email" type="submit" class="btn btn-success col-md-6 pull-right"><i class="fa fa-paper-plane"></i> <?= _send ?></button>
                </div>
            </div>
        </form>
    </div>
</div>

<style type="text/css">
    table th,
    table td {
        text-align: center;
    }

    #form-shopping button.button {
        margin-right: 15px;
    }
</style>
<script>
    function xoa_sp_gh_dh(id, iddh, al) {
        
        var cf = confirm(al);
        if (cf) {
            $.ajax({
                url: "./sources/ajax.php",
                type: 'POST',
                data: {
                    'do': 'xoa_sp_gh',
                    'id': id,
                    'iddh': iddh
                },
                success: function(data) {
                    window.location.href = "<?= URLPATH ?>gio-hang.html";
                }
            })
        }
    }

    function thanhtien(id, iddh) {
        var cls = ".thanhtien_" + id;
        $.ajax({
            url: "./sources/ajax.php",
            type: 'POST',
            data: {
                'do': 'thanh_tien',
                'id': id,
                'iddh': iddh
            },
            success: function(data) {
                $(cls).html(data);
            }
        })
    }

    function tongtien(id, iddh) {
        $.ajax({
            url: "./sources/ajax.php",
            type: 'POST',
            data: {
                'do': 'tong_tien',
                'id': id,
                'iddh': iddh
            },
            success: function(data) {
                $("#tong_tien_gh").html(data);
            }
        })
    }

    const Wind = {
        province: <?php echo !empty($_SESSION['delivery_area']) ? json_encode($_SESSION['delivery_area']) : '{}'; ?>,
        products: <?php echo json_encode($cartProducts); ?>,
        total: <?php echo $tongtien ?: 0; ?>
    };

    $(document).ready(function() {
        getAllProvince();
        $('#province').on('change', handleSelectProvince);
        $('#county').on('change', handleSelectCounty);
        updateFee();

        var formShopping = $('#form-shopping');

        function updateInput(input, value, pid) {
            input.value = value;
            chang_soluong(input, pid, '<?= @$_SESSION['iddonhang'] ?>');
        };

        $('.quantity-input .add-one').click(function(e) {
            var quantityInput = e.target.parentElement.parentElement.parentElement.querySelector('input');
            window.minh = e;
            var value = quantityInput.value;
            var pid = $(this).attr('data-product');
            updateInput(quantityInput, ++value, pid);
        });

        $('.quantity-input .minus-one').click(function(e) {
            var quantityInput = e.target.parentElement.parentElement.parentElement.querySelector('input');
            var value = quantityInput.value;
            var pid = $(this).attr('data-product');
            if (--value < 1) {
                return;
            }
            updateInput(quantityInput, value, pid);
        });

        $('#request_quote_cart').on('click', function() {
            const name = $('#ten').val();
            const email = $('#email').val();
            const phone = $('#dienthoai').val();
            const message = $('#loinhan').val();

            if (name) {
                $('#request_quote_cart_ten').val(name);
            }

            if (email) {
                $('#request_quote_cart_email').val(email);
            }

            if (phone) {
                $('#request_quote_cart_phone').val(phone);
            }

            if (message) {
                $('#request_quote_cart_noi_dung').val(message);
            }

            $('#request_quote_cart_modal').modal('show');
        });

        $('#request_quote_cart_form').on('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            // Show loading
            swal("Đang gửi yêu cầu...");
            sweetAlert.disableButtons();

            $.ajax({
                url: '/api.php?func=request_price_cart',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                timeout: 1000 * 60 * 5,
                dataType: 'json',
                success: data => {
                    if (!data || !data.isSuccess) {
                        swal({
                            title: "Có lỗi xảy ra",
                            text: data.error,
                            type: "error",
                            confirmButtonClass: 'btn-danger',
                            confirmButtonText: 'OK'
                        });

                        return;
                    }

                    swal({
                        title: "Gửi thành công",
                        text: "Chúng tôi sẽ liên hệ với bạn sớm nhất có thể!",
                        type: "success",
                        confirmButtonClass: 'btn-success',
                        confirmButtonText: 'OK'
                    }, function() {
                        window.location.href = '/';
                    });
                },
                fail: () => {
                    swal({
                        title: "Vui lòng thử lại!",
                        type: "warning",
                    });
                },
            });
        });

        $('#add-voucher').on('click', function() {
            const $voucher = $('#voucher');
            const voucher = $voucher.val();
            if (voucher.trim().length === 0) {
                swal({
                    title: "Vui lòng nhập mã của bạn!",
                    type: "info",
                    confirmButtonClass: 'btn-primary',
                    confirmButtonText: 'OK'
                });

                return;
            }
            // Show loading
            swal("Đang kiểm tra...");
            sweetAlert.disableButtons();

            setTimeout(function() {
                $voucher.val('');
                swal({
                    title: "Không tìm thấy mã: " + voucher,
                    type: "error",
                    confirmButtonClass: 'btn-danger',
                    confirmButtonText: 'OK'
                });
            }, 1500);
        });

        $('#print_price_request').on('click', function() {
            var name = $('#ten').val();
            var email = $('#email').val();
            var phone = $('#dienthoai').val();
            if (!name || name.length === 0 ||
                !phone || phone.length === 0 ||
                !email || email.length === 0
            ) {
                swal({
                    title: "Vui lòng nhập tên, email và điện thoại của quý khách!",
                    type: "info",
                });
                return;
            }

            // Show loading
            swal("Xin quý khách chờ trong giây lát...");
            sweetAlert.disableButtons();

            // Prepare pdf URL
            var query = 'name=' + encodeURIComponent(name);
            query += '&email=' + encodeURIComponent(email);
            query += '&phone=' + encodeURIComponent(phone);
            var baogiaUrl = '/tai-bao-gia-pdf.php?' + query;

            // Save current cart
            var data = formShopping.serialize();
            data += '&in_bao_gia=1&guidonhang=1'
            $.ajax({
                url: '/gio-hang.html',
                data,
                method: 'POST'
            }).done(function() {
                swal({
                    title: "Thành công!",
                    type: "success",
                });

                // Open pdf URL
                window.open(baogiaUrl, '_blank');
            }).fail(function() {
                swal({
                    title: "Có lỗi xảy ra, vui lòng thử lại!",
                    type: "info",
                });
            });
        });

        $(document).on('click', '.payment-method input#thanhtoan_ck', function(){
            $('.payment-description').hide();
            $(this).parent().find('.payment-description').show();
        });

        $(document).on('click', '.payment-method input#thanhtoan_cod', function(){
            $('.payment-description').hide();
            $(this).parent().find('.payment-description').show();
        });

        $('.company_order').on('click', function(){
            if( $(this).is(":checked") ){
                $('.company-order-wrap').addClass('active');
            } else {
                $('.company-order-wrap').removeClass('active');
            }
        });
    });
</script>