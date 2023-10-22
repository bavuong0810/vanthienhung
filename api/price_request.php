<?php

include_once __ROOT_PATH . "/smtpv2/index.php";

function request_price()
{
    global $d;
    $email_admin_url = __ROOT_PATH . '/smtpv2/email_admin.json';
    $email_admin = file_get_contents($email_admin_url);

    if (!isset($_POST['email'])) {
        echo json_encode(array('isSuccess' => false, 'error' => 'Không nhận được dữ liệu!'));
        return;
    }
    $chuoi = strtolower($_POST['captcha']);

    if (!checkCaptcha($chuoi)) {
        echo json_encode(array('isSuccess' => false, 'error' => 'Sai mã xác nhận'));
        return;
    }

    $d->reset();

    $id = intval($_POST['productId']);
    if ($id) {
        $ctsp = $d->o_fet("SELECT * FROM #_sanpham WHERE id = '" . $id . "'");
    }

    $data['ho_ten'] = addslashes(@$_POST['ho_ten']);
    $data['email'] = addslashes(@$_POST['email']);
    $data['sdt'] = addslashes(@$_POST['so_dien_thoai']);
    $contentData = [];
    $contentData['message'] = $d->cleanData(@$_POST['noi_dung']);
    $contentData['products'] = [];
    $contentData['products'][$id] = $d->cleanData(@$_POST['soLuong']);
    $contentData['attachments'] = [];
    $item = $ctsp[0];

    $thongTinThem[] = @$_POST['thongSoSanPham'] ? addslashes('Để bán lại') : '';
    $thongTinThem[] = @$_POST['chungNhanKiemDinh'] ? addslashes('Dùng cho doanh nghiệp') : '';
    $thongTinThem[] = @$_POST['hoSoCongTy'] ? addslashes('Dùng tại nhà') : '';
    $noidung = [];
    $contentData['additions'] = $thongTinThem;

    if ($id) {
        $noidung[] = "
			<img src='" . FILEURL . "img_data/images/" . $ctsp[0]['image_path'] . "' style='max-width:500px' />
			<p>
				Sản phẩm: <strong>" . $ctsp[0]['name_' . $_SESSION['lang']] . "</strong>
			</p>
			<p>
				Mã sản phẩm: <strong>" . $ctsp[0]['code'] . "</strong>
			</p>
			<p>
				Giá: <strong>" . $d->vnd($ctsp[0]['price'] ?: 0) . '/' . ($ctsp[0]['unit'] ?: 'Cái') . "</strong>
			</p>
			<p>
				Giá khuyến mãi: <strong>" . $d->vnd($ctsp[0]['promotion_price']) . '/' . ($ctsp[0]['unit'] ?: 'Cái') . "</strong>
			</p>";
    }

    $noidung[] = "
		<p>
			Số lượng: <strong>" . $_POST['soLuong'] . "</strong>
		</p>
		<p>
			Số điện thoại: <strong>" . $_POST['so_dien_thoai'] . "</strong>
		</p>
		<p>
			Yêu cầu thông tin thêm: <strong>" . join(', ', $thongTinThem) . "</strong>
		</p>
		<p>
			Lời nhắn: <strong>" . $_POST['noi_dung'] . "</strong>
		</p>";
    $noidung[] = '<p><strong>Thông tin khách hàng:</strong></p>';
    $noidung[] = '<p>Họ tên: <strong>' . empty($data['ho_ten']) ? '' : $data['ho_ten'] . '</strong></p>';
    $noidung[] = '<p>Email: <strong>' . $data['email'] . '</strong></p>';
    $noidung[] = '<p>Số điện thoại: <strong>' . $data['sdt'] . '</strong></p>';
    $noidung[] = '<br/>';

    $target_dir = __ROOT_PATH . "/img_data/upload-lien-he/";
    $link_dir = URLPATH . 'img_data/upload-lien-he/';
    $numberOfFiles = count($_FILES['dinhKem']['name']);

    $noidung[] = '<p><strong>Đính kèm:</strong></p>';
    $errors = array();
    for ($i = 0; $i < $numberOfFiles; $i++) {
        if (!$_FILES["dinhKem"]["name"][$i]) {
            continue;
        }

        $fileName = basename($_FILES["dinhKem"]["name"][$i]);
        $target_file = $target_dir . $fileName;
        $link = $link_dir . $fileName;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check file size
        if ($_FILES["dinhKem"]["size"][$i] > 1024 * 1024 * 5) {
            $errors[] = "Chỉ cho phép đính kèm các tệp tin nhỏ hơn 5MB";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" && $imageFileType != "xls" && $imageFileType != "xlsx" && $imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "pdf") {
            $errors[] = "Chỉ cho phép đính kèm các định dạng: JPG, JPEG, PNG, GIF, XLS, XLSX, DOC, DOCX và PDF ";
            $uploadOk = 0;
        }

        // check att is image or doc
        $check = getimagesize($_FILES["dinhKem"]["tmp_name"][$i]);
        if ($check !== false) {
            $noidung[] = '<p style="text-align: center"><img src="' . $link . '" style="max-width: 90%" /></p>';
            $contentData['attachments'][] = ['type' => 'image', 'url' => $link];
        } else {
            $noidung[] = '<p><a href="' . $link . '" title="Click để tải file đính kèm">' . $fileName . '</a></p>';
            $contentData['attachments'][] = ['type' => 'file', 'name' => $fileName, 'url' => $link];
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            continue;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo json_encode(array('isSuccess' => false, 'error' => "Đã xảy ra các lỗi sau khi tải lên đính kèm: \n" . join("\n", $errors)));
            return;
            // if everything is ok, try to upload file
        } else {
            if (!move_uploaded_file($_FILES["dinhKem"]["tmp_name"][$i], $target_file)) {
                echo json_encode(array('isSuccess' => false, 'error' => 'Lỗi khi gửi yêu cầu, vui lòng thử lại!'));
                return;
            }
        }
    }

    $noidung[] = "<div style='color:red; margin-top:10px; font-style:italic; font-size:12px'>Đây là thư gửi tự động, vui lòng ko trả lời thư này!</div>";
    $data['noi_dung'] = json_encode($contentData, JSON_UNESCAPED_UNICODE);
    $data['dia_chi'] = addslashes(@$_POST['dia_chi']);
    $data['ngay_hoi'] = date('d-m-Y H:i:s');
    $data['trang_thai'] = '0';

    $d->setTable('#_lienhe');
    if ($d->insert($data)) {

        // Send to CRM
        $data['subject'] = "Liên hệ từ website ".getenv('APP_DOMAIN');
        $data['productIds'] = array_keys($contentData['products']);
        $data['messageType'] = 2; // price quote

		sendToCRM($data);

        // send email for admin
        $admin_email = $email_admin?$email_admin:getenv('ADMIN_EMAIL');
        //$admin_email = 'it.danang.info@gmail.com';
        $admin_sms = file_get_contents(__ROOT_PATH . '/img_data/files/sms/admin_sms.json');

        sendEmail("Liên hệ từ website " .getenv('APP_DOMAIN')."\r\n", implode('', $noidung), $admin_email, $admin_email, getenv('APP_NAME'));
        if($admin_sms){
            @sendSms($admin_sms, 'new_email_sent');
        }

        // send email for customer
        ob_start();
        include 'email-template-price-request.php';
        //$content = ob_get_clean();
        $content = $mail_price_request_template;
        sendEmail("Liên hệ từ website ".getenv('APP_DOMAIN')."\r\n", $content, $_POST['email'], $_POST['email'], getenv('APP_NAME'));
        @sendSms($data['sdt'], 'request_received');

        echo json_encode(array('isSuccess' => true));
        
    } else {
        echo json_encode(array('isSuccess' => false, 'error' => 'Lỗi khi gửi yêu cầu, vui lòng thử lại!'));
    }
}

function request_price_cart()
{
    global $d;
    $d->reset();

    if (
        empty($_POST['ten'])
        || empty($_POST['email'])
        || empty($_POST['dienthoai'])
    ) {
        echo json_encode([
            'isSuccess' => false,
            'error' => 'Vui lòng nhập đầy đủ thông tin!',
        ]);
        return;
    }

    $chuoi = strtolower($_POST['captcha']);

    if (!checkCaptcha($chuoi)) {
        echo json_encode([
            'isSuccess' => false,
            'error' => 'Sai mã xác nhận!',
        ]);
        return;
    }

    $email_admin_url = __ROOT_PATH . '/smtpv2/email_admin.json';
    $email_admin = file_get_contents($email_admin_url);

    header("Content-Type: application/json", true);

    $data['ho_ten'] = addslashes(@$_POST['ten']);
    $data['email'] = addslashes(@$_POST['email']);
    $data['sdt'] = addslashes(@$_POST['dienthoai']);
    $contentData = [];
    $contentData['message'] = $d->cleanData(@$_POST['noi_dung']);
    $contentData['products'] = [];
    $contentData['attachments'] = [];
    foreach ($_SESSION['cart'] as $key => $value) {
    	$contentData['products'][$key] = $value['so_luong'];
    }

    $thongTinThem[] = @$_POST['thongSoSanPham'] ? 'Để bán lại' : '';
    $thongTinThem[] = @$_POST['chungNhanKiemDinh'] ? 'Dùng cho doanh nghiệp' : '';
    $thongTinThem[] = @$_POST['hoSoCongTy'] ? 'Dùng tại nhà' : '';
    $contentData['additions'] = $thongTinThem;

    $noidung = '<h2>Yêu cầu báo giá</h2>';
    $noidung .= getCartTable();
    $noidung .= "
				<p>
					Lời nhắn: <strong>" . $_POST['noi_dung'] . "</strong>
				</p>";

    $noidung .= '<hr/>';
    $noidung .= '<p><strong>Thông tin khách hàng:</strong></p>';
    $noidung .= '<p>Họ tên: <strong>' . empty($data['ho_ten']) ? '' : $data['ho_ten'] . '</strong></p>';
    $noidung .= '<p>Email: <strong>' . $data['email'] . '</strong></p>';
    $noidung .= '<p>Số điện thoại: <strong>' . $data['sdt'] . '</strong></p>';
    $noidung .= '<p>
					Yêu cầu thông tin thêm: <strong>' . join(', ', $thongTinThem) . '</strong>
				</p>';
    $noidung .= '<br/>';

    $target_dir = __ROOT_PATH . "/img_data/upload-lien-he/";
    $link_dir = URLPATH . 'img_data/upload-lien-he/';
    $numberOfFiles = count($_FILES['dinhKem']['name']);

    $noidung .= '<p><strong>Đính kèm:</strong></p>';
    $errors = array();
    for ($i = 0; $i < $numberOfFiles; $i++) {
        if (!$_FILES["dinhKem"]["name"][$i]) {
            continue;
        }

        $fileName = basename($_FILES["dinhKem"]["name"][$i]);
        $target_file = $target_dir . $fileName;
        $link = $link_dir . $fileName;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check file size
        if ($_FILES["dinhKem"]["size"][$i] > 1024 * 1024 * 5) {
            $errors[] = "Chỉ cho phép đính kèm các tệp tin nhỏ hơn 5MB";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" && $imageFileType != "xls" && $imageFileType != "xlsx" && $imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "pdf") {
            $errors[] = "Chỉ cho phép đính kèm các định dạng: JPG, JPEG, PNG, GIF, XLS, XLSX, DOC, DOCX và PDF ";
            $uploadOk = 0;
        }

        // check att is image or doc
        $check = getimagesize($_FILES["dinhKem"]["tmp_name"][$i]);
        if ($check !== false) {
            $noidung .= '<p style="text-align: center"><img src="' . $link . '" style="max-width: 90%" /></p>';
            $contentData['attachments'][] = ['type' => 'image', 'url' => $link];
        } else {
            $noidung .= '<p><a href="' . $link . '" title="Click để tải file đính kèm">' . $fileName . '</a></p>';
            $contentData['attachments'][] = ['type' => 'file', 'name' => $fileName, 'url' => $link];
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            continue;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo json_encode(array('isSuccess' => false, 'error' => "Đã xảy ra các lỗi sau khi tải lên đính kèm: \n" . join("\n", $errors)));
            return;
            // if everything is ok, try to upload file
        } else {
            if (!move_uploaded_file($_FILES["dinhKem"]["tmp_name"][$i], $target_file)) {
                echo json_encode(array('isSuccess' => false, 'error' => 'Lỗi khi gửi yêu cầu, vui lòng thử lại!'));
                return;
            }
        }
    }

    $noidung .= "<div style='color:red; margin-top:10px; font-style:italic; font-size:12px'>Đây là thư gửi tự động, vui lòng ko trả lời thư này!</div>";
    $contentDataStr = json_encode($contentData);
    $data['noi_dung'] = addslashes($contentDataStr);
    $data['dia_chi'] = addslashes(@$_POST['dia_chi']);
    $data['ngay_hoi'] = date('d-m-Y H:i:s');
    $data['trang_thai'] = '0';

    $d->setTable('#_lienhe');
    if ($d->insert($data)) {
        // Send to CRM
        $data['noi_dung'] = $contentDataStr;
        $data['subject'] = "Liên hệ từ website ".getenv('APP_DOMAIN');
        $data['productIds'] = array_keys($contentData['products']);
        $data['messageType'] = 2; // price quote
        sendToCRM($data);

        // send email for admin
        $admin_email = $email_admin?$email_admin:getenv('ADMIN_EMAIL');
        //$admin_email = 'it.danang.info@gmail.com';
        $admin_sms = file_get_contents(__ROOT_PATH . '/img_data/files/sms/admin_sms.json');

        sendEmail("Liên hệ từ website ".getenv('APP_DOMAIN')."\r\n", $noidung, $admin_email, $admin_email, getenv('APP_NAME'));
        if($admin_sms){
            @sendSms($admin_sms, 'new_email_sent');
        }

        // send email for customer
        ob_start();
        include 'email-template-price-request-cart.php';
        $content = ob_get_clean();
        sendEmail("Liên hệ từ website ".getenv('APP_DOMAIN')."\r\n", $content, $_POST['email'], $_POST['email'], getenv('APP_NAME'));
        @sendSms($data['sdt'], 'request_received');

        // Remove current cart
        $_SESSION['cart'] = [];

        echo json_encode(array('isSuccess' => true));
    } else {
        echo json_encode(array('isSuccess' => false, 'error' => 'Lỗi khi gửi yêu cầu, vui lòng thử lại!'));
    }

}

function getCartTable()
{
    global $d;
    $d->reset();

    if (empty($_SESSION['cart'])) {
        return '';
    }

    $rows = '';

    foreach ($_SESSION['cart'] as $key => $value) {

        $product = $d->simple_fetch("select * from #_sanpham where id={$key}");
        if (empty($product)) {
            continue;
        }

        $rows .= '
			<tr>
				<td><img src="' . FILEURL . "thumb.php?src=" . FILEURL . "img_data/images/" . $product['image_path'] . '&h=50" alt="' . $product['name_' . $_SESSION['lang']] . '"></td>
				<td>' . $product['code'] . '</td>
				<td>' . $product['name_' . $_SESSION['lang']] . '</td>
				<td>
					Giá: <strong>' . $d->vnd($product['price'] ?: 0) . '</strong>
					<hr/>
					Khuyến mãi: <strong>' . $d->vnd($product['promotion_price'] ?: 0) . '</strong>
				</td>
				<td>' . $value['so_luong'] . '</td>
			</tr>
		';

    }

    return <<<EOT
<style>
	.table th,
	.table td {
		padding: 10px;
	}
</style>
<table class="table table-bordered" border="1" style="border-spacing: 0; border-collapse: collapse">
	<thead>
		<tr>
			<th>Hình ảnh</th>
			<th>Mã sản phẩm</th>
			<th>Tên sản phẩm</th>
			<th>Giá</th>
			<th>Số lượng</th>
		</tr>
	</thead>
	<tbody>
		{$rows}
	</tbody>
</table>
EOT;
}
