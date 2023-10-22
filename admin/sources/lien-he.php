<?php
include_once _ROOT . "/smtp/index.php";

if (!defined('_source')) {
	die("Error");
}

$a = (isset($_REQUEST['a'])) ? addslashes($_REQUEST['a']) : "";
switch ($a) {
case "man":
	showdulieu();
	$template = @$_REQUEST['p'] . "/hienthi";
	// $template = @$_REQUEST['p']."/them_noidung";
	break;
case "sua-noi-dung":
	showdulieu();
	$template = @$_REQUEST['p'] . "/them_noidung";
	break;
case "edit":
	showdulieu();
	luudulieu();
	$template = @$_REQUEST['p'] . "/them";
	break;
case "delete":
	xoadulieu();
	break;
case "save_noidung":
	luunoidung_lien_he();
	break;
case "delete_all":
	xoadulieu_mang();
	break;
case "reply-page":
	replyPage();
	luudulieu();
	$template = @$_REQUEST['p'] . "/reply";
	break;
case "reply":
	reply();
	break;
default:
	$template = "index";
}
function luunoidung_lien_he() {
	global $d;
	$id = (isset($_REQUEST['p'])) ? addslashes($_REQUEST['p']) : "";
	if ($id != '') {

		$d->reset();
		$d->setWhere('id', $id);
		$d->setTable('#_setting');
		$d->delete();
		//

		$data['id'] = $id;
		$data['title_vi'] = $data['name_vi'] = addslashes($_POST['name_vi']);
		$data['title_en'] = $data['name_en'] = addslashes($_POST['name_en']);
		$data['title_jp'] = $data['ten_jp'] = addslashes($_POST['ten_jp']);
		$data['title_cn'] = $data['ten_cn'] = addslashes($_POST['ten_cn']);

		$data['content_vi'] = addslashes($_POST['content_vi']);
		$data['content_en'] = addslashes($_POST['content_en']);
		$data['noi_dung_jp'] = addslashes($_POST['noi_dung_jp']);
		$data['noi_dung_cn'] = addslashes($_POST['noi_dung_cn']);

		$d->reset();
		$d->setTable('#_setting');
		if ($d->insert($data)) {
			$d->alert("Cập nhật dữ liệu thành công");
			$d->redirect("index.php?p=" . $_GET['p'] . "&a=man&page=" . @$_REQUEST['page'] . "");
		} else {
			$d->alert("Cập nhật dữ liệu không thành công");
			$d->redirect("index.php?p=" . $_GET['p'] . "&a=man&page=" . @$_REQUEST['page'] . "");
		}
	}
}

function showdulieu() {
	global $d, $items, $paging, $loai, $hang, $maxR, $page;
	if ($_REQUEST['a'] == 'man') {

		$id = isset($_GET['id']) ? addslashes($_GET['id']) : "";
		if ($id != null) {
			$cot = (isset($_GET['b'])) ? addslashes($_GET['b']) : "";
			$trangthai = (isset($_GET['TT'])) ? addslashes($_GET['TT']) : "";

			$d->reset();
			$d->setTable('#_lienhe');
			$d->setWhere('id', $id);
			if ($trangthai == '0') {
				$data['trang_thai'] = 0;
			} else {
				$data['trang_thai'] = 1;
			}

			if ($d->update($data)) {}
			$d->redirect("index.php?p=lien-he&a=man&page=" . @$_REQUEST['page'] . "");
		}

		if (isset($_GET['column'])) {
			$column = addslashes($_GET['column']);
			$key = (isset($_GET['key'])) ? addslashes($_GET['key']) : "";
			if ($column == 'id') {
				$items = $d->o_fet("
					SELECT lh.*,
					       email_count,
					       phone_count
					FROM #_lienhe lh
					LEFT JOIN
					    (SELECT COUNT(id) AS email_count,
					            email
					     FROM #_lienhe
					     GROUP BY email) e ON lh.email = e.email
					LEFT JOIN
					    (SELECT COUNT(id) AS phone_count,
					            sdt
					     FROM #_lienhe
					     GROUP BY sdt) p ON lh.sdt = p.sdt
				    WHERE id = {$key}
					ORDER BY id DESC
					");
			} else {
				$items = $d->o_fet("
					SELECT lh.*,
				       email_count,
				       phone_count
				FROM #_lienhe lh
				LEFT JOIN
				    (SELECT COUNT(id) AS email_count,
				            email
				     FROM #_lienhe
				     GROUP BY email) e ON lh.email = e.email
				LEFT JOIN
				    (SELECT COUNT(id) AS phone_count,
				            sdt
				     FROM #_lienhe
				     GROUP BY sdt) p ON lh.sdt = p.sdt
			    WHERE lh.{$column} LIKE '%{$key}%'
				ORDER BY id DESC
				");
			}
		} else {
			$items = $d->o_fet("
				SELECT lh.*,
				       email_count,
				       phone_count
				FROM #_lienhe lh
				LEFT JOIN
				    (SELECT COUNT(id) AS email_count,
				            email
				     FROM #_lienhe
				     GROUP BY email) e ON lh.email = e.email
				LEFT JOIN
				    (SELECT COUNT(id) AS phone_count,
				            sdt
				     FROM #_lienhe
				     GROUP BY sdt) p ON lh.sdt = p.sdt
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
			$items = $d->o_fet("select * from #_lienhe where id =  '" . $id . "'");
		}
	} else
	if ($_REQUEST['a'] == 'sua-noi-dung') {
		$id = addslashes($_REQUEST['p']);
		$items = $d->o_fet("select * from #_setting where id =  '" . $id . "'");
	}
}

function luudulieu() {
	global $d;
	$id = (isset($_REQUEST['id'])) ? addslashes($_REQUEST['id']) : "";

	if ($id != '') {
		$data['trang_thai'] = '1';
		$d->reset();
		$d->setWhere('id', $id);
		$d->setTable('#_lienhe');
		if ($d->update($data)) {}
	}
}

function xoadulieu() {
	global $d;
	if (isset($_GET['id'])) {
		$id = addslashes($_GET['id']);
		$hinhanh = $d->o_fet("select * from #_lienhe where id = '" . $id . "'");
		@unlink('../img_data/images/' . $hinhanh[0]['image_path']);

		$d->reset();
		$d->setTable('#_lienhe');
		$d->setWhere('id', $id);
		if ($d->delete()) {
			$d->redirect("index.php?p=lien-he&a=man&page=" . @$_REQUEST['page'] . "");
		} else {
			$d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=lien-he&a=man");
		}
	} else {
		$d->transfer("Không nhận được dữ liệu", "index.php?p=lien-he&a=man");
	}

}

function xoadulieu_mang() {
	global $d;
	if (isset($_POST['chk_child'])) {
		$chuoi = "";
		foreach ($_POST['chk_child'] as $val) {
			$chuoi .= $val . ',';
		}
		$chuoi = trim($chuoi, ',');
		//lay danh sách idsp theo chuoi
		$hinhanh = $d->o_fet("select * from #_lienhe where id in ($chuoi)");
		if ($d->o_que("delete from #_lienhe where id in ($chuoi)")) {
			//xoa hình ảnh
			foreach ($hinhanh as $ha) {
				@unlink('../img_data/images/' . $ha['image_path']);

			}
			$d->redirect("index.php?p=lien-he&a=man&page=" . @$_REQUEST['page'] . "");
		} else {
			$d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=lien-he&a=man");
		}

	} else {
		$d->redirect("index.php?p=lien-he&a=man&page=" . @$_REQUEST['page'] . "");
	}

}

function replyPage() {
	global $d, $item;

	$contactId = intval($_REQUEST['id']);
	$items = $d->o_fet("
					SELECT lh.*,
					       email_count,
					       phone_count
					FROM #_lienhe lh
					LEFT JOIN
					    (SELECT COUNT(id) AS email_count,
					            email
					     FROM #_lienhe
					     GROUP BY email) e ON lh.email = e.email
					LEFT JOIN
					    (SELECT COUNT(id) AS phone_count,
					            sdt
					     FROM #_lienhe
					     GROUP BY sdt) p ON lh.sdt = p.sdt
				    WHERE id = {$contactId}
					ORDER BY id DESC
					");

	if (!$items[0]) {
		$d->transfer("Dữ liệu không tồn tại!", "index.php?p=lien-he&a=man");
		return;
	}

	$item = $items[0];
}

function reply() {
	global $d;

	if (empty($_POST['title']) || empty($_POST['content'])) {
		$d->transfer("Vui lòng nhập đầy đủ thông tin!", "index.php?p=lien-he&a=reply-page&id=" . $_GET['id']);
	}

	$contactId = intval($_GET['id']);
	$items = $d->o_fet("
					SELECT *
					FROM #_lienhe
				    WHERE id = {$contactId}
					ORDER BY id DESC
					");

	if (!$items[0]) {
		$d->transfer("Liên hệ không tồn tại!", "index.php?p=lien-he&a=reply-page&id=" . $_GET['id']);
	}

	$title = addslashes($_POST['title']);
	$content = addslashes($_POST['content']);

	$mailResult = sendmail($title, $content, getenv('ADMIN_EMAIL'), $items[0]['email'], getenv('APP_NAME'));
	if ($items[0]['sdt']) {
		sendSms($items[0]['sdt'], 'new_email_sent');
	}

	if (!$mailResult) {

		$d->transfer("Gửi mail không thành công!", "index.php?p=lien-he&a=reply-page&id=" . $_GET['id']);
	}
	// Update replied_content and replied status
	$d->reset();
	$d->setWhere('id', $contactId);
	$d->setTable('#_lienhe');
	$replyData = [
		'is_replied' => 1,
		'replied_content' => '<h2>' . $title . '</h2><hr/><br/>' . $content,
	];
	if (!$d->update($replyData)) {
		$d->transfer("Gửi mail thành công nhưng lưu dữ liệu bị lỗi!", "index.php?p=lien-he&a=reply-page&id=" . $_GET['id']);
	}

	$d->transfer("Gửi mail thành công!", "index.php?p=lien-he&a=reply-page&id=" . $_GET['id']);

}

function showContactContent($content) {
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
			    WHERE id IN (".implode(',', $productIds).")
				ORDER BY id DESC
				";
		$products = $d->o_fet($query);
	}

	include _template . 'lien-he/content_tpl.php';
}