<?php @include "sources/editor.php" ?>

<ol class="breadcrumb">
  <li><a href="<?=urladmin ?>"><i class="glyphicon glyphicon-home"></i> Admin</a></li>
  <li class="active"><a href="<?=urladmin ?>index.php?p=group&a=man">Quản lý nhóm</a></li>
  <li class="active"><a href="#"><?php if(isset($_GET['id'])) echo "Sửa "; else echo "Thêm mới" ?></a></li>
</ol>
<div class="col-xs-12">
<form name="frm" method="post" action="index.php?p=group&a=save&id=<?=@$_REQUEST['id']?>&page=<?=@$_REQUEST['page']?>" enctype="multipart/form-data">

<div class="ar_admin">
	<div class="title_thongtinchung">
		Thông tin chung
	</div>
	<table class="table table-bordered table-hover them_dt" style="border:none">
		<tbody>
			<tr>
				<td class="td_left">
					Tên VN:
				</td>
				<td class="td_right">
					<input type="text" name="name_vi" value="<?php echo @$items[0]['name_vi']; ?>" class="input width400 form-control">
				</td>
			</tr>
			<tr>
				<td class="td_left">
					Tên US:
				</td>
				<td class="td_right">
					<input type="text" name="name_en" value="<?php echo @$items[0]['name_en']; ?>" class="input width400 form-control">
				</td>
			</tr>
			<tr>
				<td class="td_left">
					Tên CH:
				</td>
				<td class="td_right">
					<input type="text" name="name_ch" value="<?php echo @$items[0]['name_ch']; ?>" class="input width400 form-control">
				</td>
			</tr>
			<tr>
				<td class="td_left">
					Hiển thị:
				</td>
				<td class="td_right">
					<input type="checkbox" class="chkbox" name="is_active" <?php if(isset($items[0]['is_active'])) { if(@$items[0]['is_active']==1) echo 'checked="checked"';} else echo'checked="checked"'; ?> id="is_active"><label class="lb_nut" for="is_active">Hiển thị</label>
				</td>
			</tr>
			<tr>
				<td class="td_left">
					Số thứ tự:
				</td>
				<td class="td_right">
					<input type="number" name="weight" value="<?php if(isset($items[0]['weight'])) echo $items[0]['weight']; else echo @$soluong['soluong']+1; ?>" class="input width400 form-control" style="width:60px">
				</td>
			</tr>
			<tr>
				<td class="td_left" style="text-align:right">
					<input type="submit" value="Lưu"  class="btn btn-primary" />
				</td>
				<td class="td_right">
					<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=group&a=man'" class="btn btn-default" />
				</td>
			</tr>
		</tbody>
	</table>
</div>
</form>
</div>




<script>

function addText(text,target,title) {
	var str=$(text).val();
	var link=locdau(str);
	$(target).val(link);
	$(title).val(str);
}	
	

</script>

