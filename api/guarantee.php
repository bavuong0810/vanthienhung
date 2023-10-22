<?php
function check_guarantee() {
	global $d;

	if (empty($_POST['specification'])) {
		echo '<div class="alert alert-danger">Vui lòng nhập specification!</div>';
		return;
	}

	$specification = $d->clear(addslashes($_POST['specification']));
	$items = $d->o_fet("SELECT * from #_baohanh WHERE specification = '" . $specification . "'");
	// Check existed
	if (empty($items)) {
		echo '<div class="alert alert-danger">Số specification sản phẩm không tồn tại!</div>';
		return;
	}

	$item = $items[0];
	if (!$item['is_actived']) {
		echo '<div class="alert alert-warning">Sản phẩm này chưa được kích hoạt bảo hành!</div>';
		return;
	}

	echo '<div class="alert alert-success">Sản phẩm được bảo hành đến: <strong>'.date('d-m-Y', strtotime($item['end_at'])).'</strong></div>';
}

function active_guarantee() {
	global $d;

	// Get data
	$data = ['is_actived' => true];
	$fields = ['specification', 'code', 'name', 'phone', 'email', 'address'];
	foreach ($fields as $field) {

		if (empty($_POST[$field])) {
			echo '<div class="alert alert-warning">Vui lòng nhập đầy đủ thông tin!</div>';
			return;
		}

		$data[$field] = $d->clear(addslashes($_POST[$field]));
	}

	$items = $d->o_fet("SELECT * from #_baohanh WHERE specification = '" . $data['specification'] . "' AND code = '".$data['code']."'");
	// Check existed
	if (empty($items)) {
		echo '<div class="alert alert-danger">Số specification sản phẩm không tồn tại hoặc mã cào không đúng!</div>';
		return;
	}

	$item = $items[0];
	if ($item['is_actived']) {
		echo '<div class="alert alert-warning">Sản phẩm này đã được kích hoạt bảo hành!</div>';
		return;
	}

	$d->setTable('#_baohanh');
	$d->setWhere('id', $item['id']);
	if (!$d->update($data)) {
		echo '<div class="alert alert-danger">Không kích hoạt được, vui lòng thử lại sau hoặc liên hệ hỗ trợ trực tuyến!</div>';
		return;
	}

	echo '<div class="alert alert-success">Kích hoạt thành công! Sản phẩm được bảo hành đến: <strong>'.date('d-m-Y', strtotime($item['end_at'])).'</strong></div>';
}