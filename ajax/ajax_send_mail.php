<?php 
ob_start();
session_start();
/*
@include_once '../admin/consts/index.php';
@include_once '../admin/lib/form.php';
@include_once '../admin/lib/VietGuys.php';
@include_once '../admin/lib/constants.php';
*/

@include "../admin/lib/config.php";
@include_once "../admin/lib/function.php";
@include_once "../smtp/index.php";


global $d;
global $lang;
$d = new func_index($config['database']);

$email_admin_url = '../smtp/email_admin.json';
$email_admin = file_get_contents($email_admin_url);
header("Content-Type: application/json", true);

$ho_ten = $_POST['ho_ten'];
$dien_thoai = trim($_POST['dien_thoai']);
$tieu_de = $_POST['tieu_de'];
$email = $_POST['contact_email'];
$loi_nhan = $_POST['noi_dung'];
$captcha = $_POST['captcha'];

$root_path = $_POST['root_path'];
$file_url = $_POST['file_url'];

if (!$tieu_de || !$ho_ten || !$loi_nhan) {
    echo json_encode(array('isSuccess' => false, 'msg' => 'Không nhận được dữ liệu!'));
    return;
}

$chuoi = strtolower($captcha);
if (!checkCaptcha($chuoi)) {
    echo json_encode(array('isSuccess' => false, 'msg' => 'Sai mã xác nhận'));
    return;
}

header("Content-Type: application/json", true);

$noidung = array();

//Email template
$noidung[] = "
		<p>
			Họ tên: <strong>" . $ho_ten . "</strong>
		</p>
		<p>
			Số điện thoại: <strong>" . $dien_thoai . "</strong>
		</p>
        <p>
			Email: <strong>" . $email . "</strong>
		</p>
		<p>
			Lời nhắn: <strong>" . $loi_nhan . "</strong>
		</p>";

//Image
$target_dir = ROOT_PATH . "/img_data/upload-lien-he/";
$link_dir = FILEURL . 'img_data/upload-lien-he/';
$numberOfFiles = count($_FILES['dinhKem']['name']);

$noidung[] = '<p><strong>Đính kèm:</strong></p>';
$errors = array();
for ($i = 0; $i < $numberOfFiles; $i++) {
    if (!$_FILES["dinhKem"]["name"][$i]) {
        continue;
    }

    $fileName = basename($_FILES["dinhKem"]["name"][$i]);
    //$org_fileName = basename($_FILES["dinhKem"]["name"][$i]);
    //$fileName_path = pathinfo($org_fileName);
    //$fileName = time().rand().$fileName_path['extension'];
    $target_file = $target_dir . $fileName;
    //$link = $link_dir . $fileName;
    $link = URLPATH . 'img_data/upload-lien-he/' . $fileName;
    
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
        //$noidung[] = '<p style="text-align: center"><img src="' . $link . '" style="max-width: 100%" /></p>';
        $noidung[] = '<p><a href="' . $link . '" title="Click để tải file đính kèm">' . $fileName . '</a></p>';
    } else {
        $noidung[] = '<p><a href="' . $link . '" title="Click để tải file đính kèm">' . $fileName . '</a></p>';
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        continue;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo json_encode(array('isSuccess' => false, 'msg' => "Đã xảy ra các lỗi sau khi tải lên đính kèm: \n" . join("\n", $errors)));
        return;
        // if everything is ok, try to upload file
    } else {
        if (!move_uploaded_file($_FILES["dinhKem"]["tmp_name"][$i], $target_file)) {
            echo json_encode(array('isSuccess' => false, 'msg' => 'Lỗi khi gửi yêu cầu, vui lòng thử lại!'));
            return;
        }
    }
}

//echo json_encode($noidung);

$admin_email = $email_admin?$email_admin:getenv('ADMIN_EMAIL');
//$admin_email = 'it.danang.info@gmail.com';

/* Insert table lien_he */
$ho_ten = $_POST['ho_ten'];
$dien_thoai = trim($_POST['dien_thoai']);
$tieu_de = $_POST['tieu_de'];
$email = $_POST['contact_email'];
$loi_nhan = $_POST['noi_dung'];

$data = array();
$data['ho_ten'] = addslashes($ho_ten);
$data['email'] = addslashes($email);
$data['sdt'] = addslashes(@$_POST['dien_thoai']);
$data['noi_dung'] = addslashes($loi_nhan);
$data['dia_chi'] = '';
$data['ten_cong_ty'] = '';
$data['tieu_de'] = '';
$data['ngay_hoi'] = date('d-m-Y H:i:s');
$data['trang_thai'] = '0';
$d->setTable('#_lienhe');
if ($d->insert($data)) {
    sendmail("Liên hệ từ website ". getenv('APP_DOMAIN')."\r\n", implode('', $noidung), $admin_email, $admin_email, getenv('APP_NAME'));
    @sendSms($data['sdt'], 'request_received');

    echo json_encode(array('isSuccess' => true, 'msg' => 'Gửi thành công aaaa!'));
} else {
    echo json_encode(array('isSuccess' => false, 'error' => 'Lỗi khi gửi yêu cầu, vui lòng thử lại!'));
}

exit;