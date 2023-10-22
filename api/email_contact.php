<?php

include_once __ROOT_PATH . "/smtpv2/index.php";

function email_contact()
{
    global $d;
    $email_admin_url = __ROOT_PATH . '/smtpv2/email_admin.json';
    $email_admin = file_get_contents($email_admin_url);

    if (!isset($_POST['contact_email'])) {
        echo json_encode(array('isSuccess' => false, 'error' => 'Không nhận được dữ liệu!'));
        return;
    }

    if (!isset($_POST['ho_ten']) || !isset($_POST['tieu_de'])) {
        echo json_encode(array('isSuccess' => false, 'msg' => 'Không nhận được dữ liệu!'));
        return;
    }

    $chuoi = strtolower($_POST['captcha']);

    if (!checkCaptcha($chuoi)) {
        echo json_encode(array('isSuccess' => false, 'error' => 'Sai mã xác nhận'));
        return;
    }

    $d->reset();

    $data['ho_ten'] = addslashes(@$_POST['ho_ten']);
    $data['email'] = addslashes(@$_POST['contact_email']);
    $data['sdt'] = addslashes(@$_POST['dien_thoai']);
    $data['tieu_de'] = addslashes(@$_POST['tieu_de']);
    $data['noi_dung'] = addslashes(@$_POST['noi_dung']);
    
    $noidung = array();
    //Email template
    $noidung[] = "
        <p>
            Họ tên: <strong>" . $data['ho_ten'] . "</strong>
        </p>
        <p>
            Số điện thoại: <strong>" . $data['sdt'] . "</strong>
        </p>
        <p>
            Email: <strong>" . $data['email'] . "</strong>
        </p>
        <p>
            Tiêu đề: <strong>" . $data['tieu_de'] . "</strong>
        </p>
        <p>
            Lời nhắn: <strong>" . $data['noi_dung'] . "</strong>
        </p>";

    $target_dir = __ROOT_PATH . "/img_data/upload-lien-he/";
    //$link_dir = FILEURL . 'img_data/upload-lien-he/';
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
                //return;
            }
        }
    }

    $d->setTable('#_lienhe');
    if ($d->insert($data)) {

        // send email for admin
        $admin_email = $email_admin?$email_admin:getenv('ADMIN_EMAIL');
        //$admin_email = 'it.danang.info@gmail.com';
        $admin_sms = file_get_contents(__ROOT_PATH . '/img_data/files/sms/admin_sms.json');

        sendEmail("Liên hệ từ website " .getenv('APP_DOMAIN')."\r\n", implode('', $noidung), $admin_email, $admin_email, getenv('APP_NAME'));

        @sendSms($data['sdt'], 'request_received');
        if($admin_sms){
            @sendSms($admin_sms, 'new_email_sent');
        }
        echo json_encode(array('isSuccess' => true, 'msg' => 'Gửi thành công!'));
        
    } else {
        echo json_encode(array('isSuccess' => false, 'error' => 'Lỗi khi gửi yêu cầu, vui lòng thử lại!'));
    }
}