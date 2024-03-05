<?php
/**
 * Vân Thiên Hùng chuyên lừa đảo, lợi dụng tín nhiệm lừa tiền anh em lập trình.
 * Hứa hẹn thanh toán, tới ngày thì than thở kêu chưa thu được tiền từ năm này qua tháng nọ, hẹn tới hẹn lui không có hồi kết.
 * Tới lúc bị anh em Dev đòi thì xoá Zalo, đổi pass server nhằm chặn anh em Dev vào phá.
 * Đã quỵt tiền 2 người tổng cộng 70 triệu
 * Chúc may mắn cho anh em nào đang làm tiếp với Vân Thiên Hùng ^^!.
 */
include_once _ROOT . "/smtp/index.php";
define('MAX_SIZE', 10); // max size of attachment in MB

if (!defined('_source')) {
    die("Error");
}

$a = (isset($_REQUEST['a'])) ? addslashes($_REQUEST['a']) : "";
switch ($a) {
    case "man":
        showdulieu();
        $template = @$_REQUEST['p'] . "/hienthi";
        break;
    case "send-new":
        sendNew();
        $template = @$_REQUEST['p'] . "/send";
        break;
    case "view":
        detail();
        $template = @$_REQUEST['p'] . "/detail";
        break;
    case "delete":
        xoadulieu();
        break;
    case "delete_all":
        xoadulieu_mang();
        break;
    case "send":
        echo send();
        exit(0);
        break;
    default:
        $template = "index";
}

function showdulieu()
{
    global $d, $items, $paging, $loai, $hang, $maxR, $page;
    if ($_REQUEST['a'] == 'man') {

        $id = isset($_GET['id']) ? addslashes($_GET['id']) : "";
        if ($id != null) {
            $cot = (isset($_GET['b'])) ? addslashes($_GET['b']) : "";
            $trangthai = (isset($_GET['TT'])) ? addslashes($_GET['TT']) : "";

            $d->reset();
            $d->setTable('#_sent_message');
            $d->setWhere('id', $id);
            if ($trangthai == '0') {
                $data['trang_thai'] = 0;
            } else {
                $data['trang_thai'] = 1;
            }

            if ($d->update($data)) {
            }
            $d->redirect("index.php?p=cham-soc-khach-hang&a=man&page=" . @$_REQUEST['page'] . "");
        }

        if (isset($_GET['column'])) {
            $column = addslashes($_GET['column']);
            $key = (isset($_GET['key'])) ? addslashes($_GET['key']) : "";
            if ($column == 'id') {
                $items = $d->o_fet("
					SELECT lh.*,
					       email_count,
					       khach.name_vi,
					       khach.ho_ten,
					       khach.so_dien_thoai,
					       khach.email,
					       khach.dia_chi,
					       khach.hien_thi,
					       attachment_count
					FROM #_sent_message lh
					LEFT JOIN #_khachhang khach
					    ON lh.customer_id = khach.id
					LEFT JOIN
					    (SELECT COUNT(id) AS email_count, message_id
                         FROM #_message_receiver
                         GROUP BY message_id) p ON lh.id = p.message_id
                    LEFT JOIN
                        (SELECT COUNT(id) AS attachment_count, message_id
                         FROM #_sent_message_attachment
                         GROUP BY message_id) a ON lh.id = a.message_id
				    WHERE id = {$key}
					ORDER BY id DESC
					");
            } else {
                $items = $d->o_fet("
					SELECT lh.*,
					       email_count,
					       khach.name_vi,
					       khach.ho_ten,
					       khach.so_dien_thoai,
					       khach.email,
					       khach.dia_chi,
					       khach.hien_thi,
					       attachment_count
					FROM #_sent_message lh
					LEFT JOIN #_khachhang khach
					    ON lh.customer_id = khach.id
                    FROM #_sent_message lh
                    LEFT JOIN
                        (SELECT COUNT(id) AS email_count, message_id
                         FROM #_message_receiver
                         GROUP BY message_id) p ON lh.id = p.message_id
                    LEFT JOIN
                        (SELECT COUNT(id) AS attachment_count, message_id
                         FROM #_sent_message_attachment
                         GROUP BY message_id) a ON lh.id = a.message_id
                    WHERE lh.{$column} LIKE '%{$key}%'
                    ORDER BY id DESC
                    ");
            }
        } else {
            $items = $d->o_fet("
				SELECT lh.*,
                       email_count,
                       khach.name_vi,
                       khach.ho_ten,
                       khach.so_dien_thoai,
                       khach.email,
                       khach.dia_chi,
                       khach.hien_thi,
                       attachment_count
					FROM #_sent_message lh
					LEFT JOIN #_khachhang khach
					    ON lh.customer_id = khach.id
				LEFT JOIN
				    (SELECT COUNT(id) AS email_count, message_id
                     FROM #_message_receiver
                     GROUP BY message_id) p ON lh.id = p.message_id
                LEFT JOIN
                    (SELECT COUNT(id) AS attachment_count, message_id
                     FROM #_sent_message_attachment
                     GROUP BY message_id) a ON lh.id = a.message_id
				ORDER BY id DESC
				");
        }

        $hienthi = 2;
        if (isset($_GET['hienthi'])) {
            $hienthi = intval($_GET['hienthi']);
        }
        $maxR = $d->lay_show_hienthi(addslashes($_GET['hienthi']));
        // phan trang
        $page = isset($_GET['page']) ? addslashes($_GET['page']) : 1;
        $url = $d->fullAddress();
        $maxP = $maxR;
        $paging = $d->phantrang($items, $url, $page, $maxR, $maxP, 'classunlink', 'classlink', 'page');
        $items = $paging['source'];
        //
    } elseif ($_REQUEST['a'] == 'edit') {

        if (isset($_REQUEST['id'])) {
            @$id = addslashes($_REQUEST['id']);
            $items = $d->o_fet("select * from #_sent_message where id =  '" . $id . "'");
        }
    } else
        if ($_REQUEST['a'] == 'sua-noi-dung') {
            $id = addslashes($_REQUEST['p']);
            $items = $d->o_fet("select * from #_setting where id =  '" . $id . "'");
        }
}

function detail() {
    global $d, $message, $receivers, $attachments;
    $id = intval($_GET['id']);

    $items = $d->o_fet("
					SELECT lh.*,
					       khach.name_vi,
					       khach.ho_ten,
					       khach.so_dien_thoai,
					       khach.email,
					       khach.dia_chi,
					       khach.hien_thi
					FROM #_sent_message lh
					LEFT JOIN #_khachhang khach
					    ON lh.customer_id = khach.id
				    WHERE lh.id = {$id}");

    $receivers = $d->o_fet("
					SELECT khach.*,
					       mc.id as receiver_id
					FROM #_message_receiver mc
					LEFT JOIN #_khachhang khach
					    ON mc.customer_id = khach.id
				    WHERE mc.message_id = {$id}");
    $attachments = $d->o_fet("
					SELECT mc.*
					FROM #_sent_message_attachment mc
				    WHERE mc.message_id = {$id}");
    $message = $items[0];
}

function sendNew() {
    global $d, $customers;
    $customers = $d->o_fet("select id, name_vi, email, so_dien_thoai from #_khachhang");
}

function luudulieu()
{
    global $d;
    $id = (isset($_REQUEST['id'])) ? addslashes($_REQUEST['id']) : "";

    if ($id != '') {
        $data['trang_thai'] = '1';
        $d->reset();
        $d->setWhere('id', $id);
        $d->setTable('#_sent_message');
        if ($d->update($data)) {
        }
    }
}

function xoadulieu()
{
    global $d;
    if (isset($_GET['id'])) {
        $id = addslashes($_GET['id']);
        $hinhanh = $d->o_fet("select * from #_sent_message where id = '" . $id . "'");
        @unlink('../img_data/images/' . $hinhanh[0]['image_path']);

        $d->reset();
        $d->setTable('#_sent_message');
        $d->setWhere('id', $id);
        if ($d->delete()) {
            $d->redirect("index.php?p=cham-soc-khach-hang&a=man&page=" . @$_REQUEST['page'] . "");
        } else {
            $d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=cham-soc-khach-hang&a=man");
        }
    } else {
        $d->transfer("Không nhận được dữ liệu", "index.php?p=cham-soc-khach-hang&a=man");
    }

}

function xoadulieu_mang()
{
    global $d;
    if (isset($_POST['chk_child'])) {
        $chuoi = "";
        foreach ($_POST['chk_child'] as $val) {
            $chuoi .= $val . ',';
        }
        $chuoi = trim($chuoi, ',');
        //lay danh sách idsp theo chuoi
        $hinhanh = $d->o_fet("select * from #_sent_message where id in ($chuoi)");
        if ($d->o_que("delete from #_sent_message where id in ($chuoi)")) {
            //xoa hình ảnh
            foreach ($hinhanh as $ha) {
                @unlink('../img_data/images/' . $ha['image_path']);

            }
            $d->redirect("index.php?p=cham-soc-khach-hang&a=man&page=" . @$_REQUEST['page'] . "");
        } else {
            $d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=cham-soc-khach-hang&a=man");
        }

    } else {
        $d->redirect("index.php?p=cham-soc-khach-hang&a=man&page=" . @$_REQUEST['page'] . "");
    }

}

function replyPage()
{
    global $d, $item;

    $contactId = intval($_REQUEST['id']);
    $items = $d->o_fet("
					SELECT lh.*,
					       email_count,
					       phone_count
					FROM #_sent_message lh
					LEFT JOIN
					    (SELECT COUNT(id) AS email_count,
					            email
					     FROM #_sent_message
					     GROUP BY email) e ON lh.email = e.email
					LEFT JOIN
					    (SELECT COUNT(id) AS phone_count,
					            sdt
					     FROM #_sent_message
					     GROUP BY sdt) p ON lh.sdt = p.sdt
				    WHERE id = {$contactId}
					ORDER BY id DESC
					");

    if (!$items[0]) {
        $d->transfer("Dữ liệu không tồn tại!", "index.php?p=cham-soc-khach-hang&a=man");
        return;
    }

    $item = $items[0];
}

function send()
{
    global $d;

    if (empty($_POST['title']) || empty($_POST['message'])) {
        $d->transfer("Vui lòng nhập đầy đủ thông tin!", "index.php?p=cham-soc-khach-hang&a=send-new");
    }

    $items = $d->o_fet("
					SELECT email
					FROM #_khachhang
				    WHERE id IN (". implode(', ', $_POST['customer_ids']) .")
					");

    if (!$items[0]) {
        $d->transfer("Liên hệ không tồn tại!", "index.php?p=cham-soc-khach-hang&a=send-new");
    }
    $emails = [];
    foreach ($items as $item) {
        $emails[] = $item['email'];
    }

    $data = [
        'title' => $d->cleanData($_POST['title']),
        'message' => addslashes($_POST['message']),
        'customer_id' => intval($_POST['customer_ids'][0]),
        'user_id' => $d->cleanData($_SESSION['id_user']),
        'type' => 'email',
        'status' => 'sent',
    ];

    /*
     * Attachments
     * */
    $target_dir = __ROOT_PATH . "/img_data/upload-lien-he/";
    $datePath = date('Y-m-d/');
    mkdir($target_dir . $datePath, 0777, true);
    $link_dir = FILEURL . 'img_data/upload-lien-he/';
    $numberOfFiles = count($_FILES['attachments']['name']);
    $allowedTypes = [
        'jpg',
        'png',
        'jpeg',
        'gif',
        'xls',
        'xlsx',
        'doc',
        'docx',
        'pdf',
    ];

    $attachments = [];
    for ($i = 0; $i < $numberOfFiles; $i++) {
        if (!$_FILES["attachments"]["name"][$i]) {
            continue;
        }

        $fileName = $_FILES["attachments"]["name"][$i];
        $target_file = $target_dir . $datePath . $fileName;
        $link = $link_dir . $datePath . $fileName;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $attachment = [
            'fileName' => $fileName,
            'link' => $link,
            'path' => $target_file,
            'related_path' => $datePath . $fileName,
            'type' => $imageFileType,
            'size' => $_FILES["attachments"]["size"][$i],
        ];

        // Check file size
        if ($_FILES["attachments"]["size"][$i] > 1024 * 1024 * MAX_SIZE) {
            $errors[] = "Chỉ cho phép đính kèm các tệp tin nhỏ hơn " . MAX_SIZE . "MB";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (!in_array($imageFileType, $allowedTypes)) {
            $errors[] = "Chỉ cho phép đính kèm các định dạng: JPG, JPEG, PNG, GIF, XLS, XLSX, DOC, DOCX và PDF. Uploaded: " . $imageFileType;
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            $attachments[] = $attachment;
            continue;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo json_encode(array('isSuccess' => false, 'error' => "Đã xảy ra các lỗi sau khi tải lên đính kèm: \n" . join("\n", $errors)));
            return;
            // if everything is ok, try to upload file
        } else {
            $errorMovingFile = move_uploaded_file($_FILES["attachments"]["tmp_name"][$i], $target_file);
            if (!$errorMovingFile) {
                echo json_encode(array('isSuccess' => false, 'error' => 'Lỗi khi gửi yêu cầu, vui lòng thử lại!', 'path' => $target_file));
                return;
            }
        }
        $attachments[] = $attachment;
    }

    $mailResult = sendmail($data['title'], $_POST['message'], getenv('ADMIN_EMAIL'), $emails, getenv('APP_NAME'), $attachments);
    if (!$mailResult) {
        return json_encode([
            'isSuccess' => false,
            'error' => 'Gửi mail không thành công!',
        ]);
    }

    try {
        $d->reset();
        $d->setTable('#_sent_message');
        $messageId = $d->insert($data);
        if (!$messageId) {
            return json_encode([
                'isSuccess' => false,
                'error' => 'Gửi mail thành công nhưng lưu dữ liệu bị lỗi!',
            ]);
        }
        $d->reset();
        $d->setTable('#_message_receiver');
        foreach ($_POST['customer_ids'] as $customerId) {
            $dataReceiver = [
                'customer_id' => intval($customerId),
                'message_id'  => $messageId,
            ];
            $d->insert($dataReceiver);
        }

        // insert attachments
        if ($attachments) {
            $d->reset();
            $d->setTable('#_sent_message_attachment');
            foreach ($attachments as $attachment) {
                $attachmentData = [
                    'message_id' => $messageId,
                    'name' => $attachment['fileName'],
                    'type' => $attachment['type'],
                    'path' => $attachment['related_path'],
                    'size' => $attachment['size'],
                ];
                $d->insert($attachmentData);
            }
        }
    } catch(Exception $e) {
        return json_encode([
            'isSuccess' => false,
            'error' => 'Gửi mail thành công nhưng lưu dữ liệu bị lỗi: ' . $e->getMessage(),
        ]);
    }

    return json_encode([
        'isSuccess' => true,
        'messageId' => $messageId,
    ]);
}

function showContactContent($content)
{
    global $d;
    $contentData = json_decode($content, true);

    if (!$contentData) {
        echo $content;
        return;
    }

    $products = [];
    if (count($contentData['products']) > 0) {
        $productIds = array_keys($contentData['products']);
        $query = "
				SELECT *
				FROM #_sanpham
			    WHERE id IN (" . implode(',', $productIds) . ")
				ORDER BY id DESC
				";
        $products = $d->o_fet($query);
    }

    include _template . 'cham-soc-khach-hang/content_tpl.php';
}