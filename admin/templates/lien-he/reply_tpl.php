<?php @include "sources/editor.php"?>
<ol class="breadcrumb">
  <li><a href="."><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
   <li class="active"><a href="index.php">Hiển thị</a></li>
  <li class="active"><a href="index.php?p=lien-he&a=man">Liên hệ</a></li>
  <li class="active"><a href="#">Nội dung liên hệ</a></li>
</ol>
<div class="col-xs-12">
<form name="frm" method="post" action="index.php?p=lien-he&a=reply&id=<?=@$_REQUEST['id']?>" enctype="multipart/form-data">
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
		<h3 style="margin-top: 0">Chi tiết liên hệ</h3>
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
			Số điện thoại: <strong><?php echo $item['sdt']; ?></strong>
		</p>
		<p>
			Ngày liên hệ: <strong><?php echo $item['ngay_hoi']; ?></strong>
		</p>
		<p>
			Tiêu đề: <strong><?php echo $item['tieu_de']; ?></strong>
		</p>
		<hr style="border-color: #ddd" />
		<div style="background: #f9f9f9; padding: 10px; overflow-x: auto;">
			<?php echo $item['noi_dung']; ?>
		</div>
	</div>
</div>
<div class="ar_admin">
	<table class="table table-bordered table-hover them_dt" style="border:none">
		<tr>
			<td class="td_left" style="text-align:right">
			</td>
			<td class="td_right">
				<input type="button" value="Quay lại" onclick="javascript:window.location='index.php?p=lien-he&a=man'" class="btn btn-primary" />
				<button class="btn btn-success">Gửi</button>
			</td>
		</tr>
	</table>
</div>
</div>
</form>
</div>