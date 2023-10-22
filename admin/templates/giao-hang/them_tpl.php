<?php @include "sources/editor.php" ?>

<ol class="breadcrumb">
  <li><a href="<?=urladmin ?>"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
  <li class="active"><a href="<?=urladmin ?>index.php?p=giao-hang&a=man">Khu vực vận chuyển</a></li>
  <li class="active"><a href="#"><?php if(isset($_GET['id'])) echo "Sửa "; else echo "Thêm mới" ?></a></li>
</ol>
<div class="col-xs-12">
<form name="frm" method="post" action="index.php?p=giao-hang&a=save&id=<?=@$_REQUEST['id']?>&page=<?=@$_REQUEST['page']?>" enctype="multipart/form-data">

<div class="ar_admin">
	<div class="title_thongtinchung">
		Thông tin chung
	</div>
	<table class="table table-bordered table-hover them_dt" style="border:none">
		<tbody>
			<tr>
				<td class="td_left">
					Tên:
				</td>
				<td class="td_right">
					<input class="input width400 form-control" id="name" name="name" value="<?php echo @$items[0]['name']?>" />
				</td>
			</tr>
			<tr>
				<td class="td_left">
					Giá/Kg:
				</td>
				<td class="td_right">
					<input class="input width400 form-control" name="price" id="price" value="<?php echo @$items[0]['price']?>" />
				</td>
			</tr>
			<tr>
				<td class="td_left">
					Tác vụ: 
				</td>
				<td class="td_right">

					<input type="checkbox" class="chkbox" name="isActive" <?php if(isset($items[0]['isActive'])) { if(@$items[0]['isActive']==1) echo 'checked="checked"';} else echo'checked="checked"'; ?> id="hien_thi"><label class="lb_nut" for="hien_thi">Hiển thị</label>
				</td>
			</tr>
			<tr>
				<td class="td_left" style="text-align:right">
					<input type="submit" value="Lưu"  class="btn btn-primary" />
				</td>
				<td class="td_right">
					<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=giao-hang&a=man'" class="btn btn-primary" />
				</td>
			</tr>
		</tbody>
	</table>
</div>
</form>
</div>