<?php @include "sources/editor.php"?>
<ol class="breadcrumb">
  <li><a href="."><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
   <li class="active"><a href="index.php">Quản trị thông tin</a></li>
  <li class="active"><a href="index.php?p=danh-sach-don-hang&a=man">Đơn hàng</a></li>
  <li class="active"><a href="#">Trả lời đơn hàng</a></li>
</ol>
<div class="col-xs-12">
<form name="frm" method="post" action="index.php?p=danh-sach-don-hang&a=reply&id=<?=@$_REQUEST['id']?>" enctype="multipart/form-data">
<div class="row">
	<div class="col-md-6">
		<h3 style="margin-top: 0">Trả lời</h3>
		<div class="form-group">
			<label>
				Tiêu đề:
			</label>
			<input name="title" value="Báo giá từ website <?php echo getenv('APP_DOMAIN'); ?>" type="text" class="form-control" required>
		</div>
		<div class="form-group">
			<label>Nội dung:</label>
			<textarea  name="content" id="content" class="form-control">
				<?php require 'reply_content.php';?>
			</textarea>
			<?php $ckeditor->replace('content');?>
		</div>
	</div>
	<div class="col-md-6" style="background: #eee; padding: 20px">
		<?php
if ($item['is_replied'] == 1) {
	?>
		<h3 style="margin-top: 0">Đã rả lời:</h3>
		<div style="background: #f9f9f9; padding: 10px; max-height: 400px; overflow-x: auto; margin-bottom: 20px">
			<?php echo $item['replied_content']; ?>
		</div>
		<hr style="border-color: #ddd" />
		<?php
}
?>
		<h3 style="margin-top: 0">Thông tin đơn hàng</h3>
		<p>
			Mã đơn hàng: <strong><?php echo $item['ma_dh'] ?: '--'; ?></strong>
		</p>
		<p>
			Họ tên: <strong><?php echo $item['ho_ten'] ?: '--'; ?></strong>
		</p>
		<p>
			Địa chỉ: <strong><?php echo $item['dia_chi'] ?: '--'; ?></strong>
		</p>
		<p>
			Email: <strong><?php echo $item['email'] ?: '--'; ?></strong>
		</p>
		<p>
			Số điện thoại: <strong><?php echo $item['dien_thoai']; ?></strong>
		</p>
		<p>
			Ngày đặt hàng: <strong><?php echo $item['ngay_dat_hang']; ?></strong>
		</p>
		<p>
			Đã đặt hàng qua sđt: <strong><?php echo $item['phone_count']; ?> lần</strong>
		</p>
		<p>
			Đã đặt hàng qua email: <strong><?php echo $item['email_count']; ?> lần</strong>
		</p>
		<hr style="border-color: #ddd" />
		<div style="background: #f9f9f9; padding: 10px; overflow-x: auto;">
			<?php echo $item['loi_nhan']; ?>
		</div>
	</div>
</div>
<div class="ar_admin">
	<table class="table table-bordered table-hover them_dt" style="border:none">
		<tr>
			<td class="td_left" style="text-align:right">
			</td>
			<td class="td_right">
				<input type="button" value="Quay lại" onclick="javascript:window.location='index.php?p=danh-sach-don-hang&a=man'" class="btn btn-primary" />
				<button class="btn btn-success">Gửi</button>
			</td>
		</tr>
	</table>
</div>
</div>
</form>
</div>