<?php
$PAYMENT_STATUS = [
	'pending' => 'Chờ thanh toán',
	'failed' => 'Thất bại',
	'paid' => 'Đã thanh toán',
];
$PAYMENT_STATUS_COLOR = [
	'pending' => '#3a87ad',
	'failed' => '#c09853',
	'paid' => '#468847',
];
?>

<ol class="breadcrumb">
	<li><a href="."><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
	<li class="active"><a href=".">Đơn hàng</a></li>
	<li class="active"><a href="#">Danh sách đơn hàng</a></li>
</ol>

<div class="col-xs-12">
	<div class="form-group">
		<div class="btn-group">
			<select id="action" name="action" onclick="form_submit(this)" class="form-control">
				<option selected>Tác vụ</option>
				<option value="delete">Xóa</option>
			</select>
		</div>

		<div class="btn-group">
			<input id="search" name="search" type="text" class="form-control" placeholder="Tìm kiếm" />
		</div>
		<div class="btn-group">
			<select id="action" onchange="seach(this,'danh-sach-don-hang')" name="action" class="form-control">
				<option value="0" selected>Tìm theo</option>
				<option value="1">ID</option>
				<option value="2">Tên</option>
			</select>
		</div>
		<div class="btn-group">
			<select id="action" onchange="show(this,'danh-sach-don-hang')" name="action" class="form-control">
				<option value="0" selected>Số hiển thị</option>
				<option value="1">15</option>
				<option value="2">25</option>
				<option value="3">50</option>
				<option value="4">75</option>
				<option value="5">100</option>
				<option value="6">200</option>
				<option value="7">300</option>
			</select>
		</div>
	</div>

	<form id="form" method="post" action="index.php?p=danh-sach-don-hang&a=delete_all" role="form">

		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th style="width:2%"><input type="checkbox" name="chk" value="0" class="chk_box checkall" id="check_all"></th>
					<th style="width:2%">STT</th>
					<th style="width:10%;">Mã đơn hàng</th>
					<th style="width:15%;">Tên khách hàng</th>
					<th style="width:9%;">Ngày đặt</th>
					<!-- <th style="width:9%;">Ngày giao</th> -->
					<!-- <th style="width:15%;">Thời gian giao hàng</th> -->
					<!-- <th style="width:14%;">Hình thức thanh toán</th> -->
					<th style="width:8%;">Thanh toán</th>
					<th style="width:14%;">Trạng thái</th>
					<th style="width:10%">Tác vụ</th>
				</tr>
			</thead>
			<tbody>
				<?php $count = count($items);
				for ($i = 0; $i < $count; $i++) {
				?>
					<tr>
						<td>
							<input type="checkbox" name="chk_child[]" value="<?= $items[$i]['id'] ?>" class="chk_box ">
						</td>
						<td><?= ($i + 1) ?></td>
						<td>
							<?php
							$id_dh = $d->o_fet("select * from #_chitietdathang where id_dh = '" . $items[$i]['id'] . "'");
							if ($items[$i]['trang_thai'] == 0) : ?>
								<strong style="color: red">
									<?php echo @$id_dh[0]['ma_dh']; ?>
									<strong>
									<?php else : ?>
										<?php echo @$id_dh[0]['ma_dh']; ?>
									<?php endif; ?>
						</td>
						<td>
							<?= $items[$i]['ho_ten'] ?>
						</td>
						<td>
							<?= date('d-m-Y H:i:s', $items[$i]['ngay_dat_hang']) ?>
						</td>
						<!-- <td>
				<?php
					// @$ngh = explode('/', $items[$i]['ngay_giao_hang']);
					// echo @$ngh[1].'-'.@$ngh[0].'-'. @$ngh[2];
					echo $items[$i]['ngay_giao_hang'];
				?>
			</td> -->
						<!-- <td>
				<?php
					echo $items[$i]['thoi_gian_giao_hang'];
				?>
			</td>
			<td>
		      	<?php
					//$_hinhthucthanhtoan = $d->o_sel("name_vi", "#_hinhthucthanhtoan", "id ='" . $items[$i]['hinh_thuc_thanh_toan'] . "'");
					//echo $_hinhthucthanhtoan[0]['name_vi'];
					?>
			</td> -->
						<td style="color: <?php echo $PAYMENT_STATUS_COLOR[$items[$i]['payment_status']]; ?>">
							<?php
								echo $PAYMENT_STATUS[$items[$i]['payment_status']];
							?>
						</td>
						<td>
							<?php if (@$items[$i]['tinh_trang'] == 0) { ?>
								<a style="color:rgb(57, 170, 4)" href="index.php?p=danh-sach-don-hang&a=man&b=tinh_trang&TT=1&id=<?php echo $items[$i]['id'] ?>&page=<?php echo @$_REQUEST['page']; ?>">Chưa giao</a>
							<?php } else if (@$items[$i]['tinh_trang'] == 1) { ?>
								<a style="color:blue" href="index.php?p=danh-sach-don-hang&a=man&b=tinh_trang&TT=2&id=<?php echo $items[$i]['id'] ?>&page=<?php echo @$_REQUEST['page']; ?>">Đang giao</a>
							<?php } else if (@$items[$i]['tinh_trang'] == -1) { ?>
								<span style="color:blue">In báo giá</span>
							<?php } else { ?>
								<a style="color:red" href="index.php?p=danh-sach-don-hang&a=man&b=tinh_trang&TT=2&id=<?php echo $items[$i]['id'] ?>&page=<?php echo @$_REQUEST['page']; ?>">Đã giao</a>
							<?php } ?>
							<span style="border-left: 1px solid #ddd; margin: 0 10px;"></span>
							<?php if ($items[$i]['is_replied']) : ?>
								<span style="color: green">Đã trả lời</span>
							<?php else : ?>
								<span style="color: red">Chưa trả lời</span>
							<?php endif; ?>
						</td>
						<td>
							<a href="index.php?p=danh-sach-don-hang&a=view&id=<?php echo $items[$i]['id'] ?>">
								<i class="glyphicon glyphicon-eye-open"></i>
							</a>
							<span style="border-left: 1px solid #ddd; margin: 0 10px;"></span>
							<a href="index.php?p=danh-sach-don-hang&a=reply-page&id=<?php echo $items[$i]['id'] ?>">
								<i class="glyphicon glyphicon-comment"></i>
							</a>
							<span style="border-left: 1px solid #ddd; margin: 0 10px;"></span>
							<a href="index.php?p=danh-sach-don-hang&a=delete&id=<?= $items[$i]['id'] ?>&page=<?= @$_GET['page'] ?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</form>
</div>
<div class="pagination">
	<?php echo @$paging['paging'] ?>
</div>