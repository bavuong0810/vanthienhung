<ol class="breadcrumb">
  <li><a href="<?=urladmin ?>"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
  <li class="active"><a href="<?=urladmin ?>">Danh mục</a></li>
  <li class="active"><a href="<?=urladmin ?>index.php?p=giaodien&a=man">Giao diện</a></li>
</ol>

<div class="col-xs-12">
<div class="form-group">
	<div class="btn-group">
		<select id="action" name="action" onclick="form_submit(this)" class="form-control">
			<option selected>Tác vụ</option>
			<!--<option value="delete">Xóa</option>-->
		</select>
	</div>

	
	<a href="index.php?p=giaodien&a=add" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-plus"></i> Thêm mới</a>
</div>

<form id="form" method="post" action="index.php?p=giaodien&a=delete_all" role="form">

<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th style="width:3%"><input class="chk_box" type="checkbox" name="chk" value="0" class="checkall" id="check_all"></th>
			<th style="width:4%">STT</th>
			<th style="width:25%;text-align: left;">Giao diện</th>
			<th style="width:15%;text-align: left;">Mô tả</th>
			<th style="width:7%">IMG</th>
			<th style="width:5%">Hiển thị</th>
			<th style="width:5%">Tác vụ</th>
		</tr>
	</thead>
	<?php
	$specials = array(49, 63, 59, 61, 54, 67, 62, 68, 69, 30, 48);
	$mota = array();
	$mota[49] = 'Hiển thị zalo: phải, trái';
	$mota[54] = 'Hiển thị cột bên phải, trái';
	$mota[67] = 'Hiển thị mô tả, hiển thị bài viết nhóm 2 - Tab bình luận';
	$mota[68] = 'Bài viết nhóm 3 - Tab bình luận';
	$mota[69] = 'Bài viết nhóm 4 - Tab bình luận';
	$mota[59] = 'Hiển thị bạn cần hỗ trợ';

    $mota[30] = 'Hiển thị cột bên phải trong chi tiết sản phẩm "Giao diện 2"';
    $mota[48] = 'Hiển thị cột bên phải trong chi tiết sản phẩm "Giao diện 2"';
    $mota[70] = 'Hiển thị cột bên phải của danh mục sản phẩm (Dòng lớn) "Giao diện 2"';
    $mota[71] = 'Hiển thị vận chuyển và đổi trả';
    $mota[72] = 'Hiển thị ghi chú bên trong giỏ hàng';

	$mota[60] = 'Tab bạn cần hỗ trợ';
	$mota[51] = 'Tab bình luận';
	$mota[53] = 'Tab bình luận';
	$mota[58] = 'Tab bình luận';
	$mota[64] = 'Hiển thị bạn cần hỗ trợ';
	$mota[65] = 'Hiển thị bạn cần hỗ trợ';
	$mota[66] = 'Hiển thị bạn cần hỗ trợ';
	?>
	<tbody>
		<?php $count=count($items); for($i=0; $i<$count; $i++){ ?>
		<tr>
			<td>
				<input class="chk_box" type="checkbox" name="chk_child[]" value="<?=$items[$i]['id']?>">
			</td>
			
			<td><?=$i+1 ?></td>

			<td style="text-align: left;">
				<a style="<?php echo ( in_array($items[$i]['id'], $specials) )?' color:#ff0000;':''?>" href="index.php?p=giaodien&a=edit&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>"><?=$items[$i]['name_vi']?></a>
			</td>

			<td style="text-align: left;">
				<?php echo $mota[$items[$i]['id']]?>
			</td>

			<td>
				<a href="index.php?p=giaodien&a=delete_image&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa">
					<?=($items[$i]['image_path'] <> '')?"<img src='".FILEURL."thumb.php?src=".FILEURL."img_data/images/".$items[$i]['image_path']."&w=70&h=50'>":""; ?>
				</a>
			</td>

			
		
			<td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_setting','hien_thi','<?=$items[$i]['id']?>')" <?php if($items[$i]['hien_thi'] == 1) echo 'checked="checked"'; ?>>
			</td>
			<td>
				<a href="index.php?p=giaodien&a=edit&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>&loaitin=<?=@$_GET['loaitin']?>" class="text-danger" title="Sửa"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;
				<!--<a href="index.php?p=giaodien&a=delete&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>&loaitin=<?=@$_GET['loaitin']?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>-->
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
</form>
</div>
<div class="pagination">
  <?php echo @$paging['paging']?>
</div>
