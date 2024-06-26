<ol class="breadcrumb">
  <li><a href="<?=urladmin ?>"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
  <li class="active"><a href="<?=urladmin ?>">Liên kết</a></li>
  <li class="active"><a href="<?=urladmin ?>index.php?p=slider-sp&a=man">Slider</a></li>
</ol>

<div class="col-xs-12">
<div class="form-group tac-vu">
	<div class="btn-group">
		<select id="action" name="action" onclick="form_submit(this)" class="form-control">
			<option selected>Tác vụ</option>
			<option value="delete">Xóa</option>
		</select>
	</div>

	<div class="btn-group">
		<input id="search" name="search" type="text" class="form-control" placeholder="Tìm kiếm"/>
	</div>
	<div class="btn-group">
		<select id="action" onchange="seach(this,'slider-sp')" name="action" class="form-control">
			<option value="0" selected>Tìm theo</option>
			<option value="1">ID</option>
			<option value="2">Tên</option>
		</select>
	</div>
	<div class="btn-group">
		<select id="action" onchange="show(this,'slider-sp')" name="action" class="form-control">
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
	<a href="index.php?p=slider-sp&a=add" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-plus"></i> Thêm mới</a>
</div>

<form id="form" method="post" action="index.php?p=slider-sp&a=delete_all" role="form">

<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th style="width:3%"><input  class="chk_box"  type="checkbox" name="chk" value="0" class="checkall" id="check_all"></th>
			<th style="width:5%">STT</th>
			<th style="width:35%">Tiêu đề</th>
			<th style="width:35%">Hình ảnh</th>
			<!-- <th style="width:26%">Liên kết</th> -->
			
	      	<th style="width:8%">Hiển thị</th>
			<th style="width:8%">Tác vụ</th>
		</tr>
	</thead>
	<tbody>
		<?php $count=count($items); for($i=0; $i<$count; $i++){ ?>
		<tr>
			<td>
				<input type="checkbox" class="chk_box"  name="chk_child[]" value="<?=$items[$i]['id']?>">
			</td>
			<td>
				<?=$items[$i]['so_thu_tu']?>
			</td>
			<!--  -->

			<td>
				<a href="index.php?p=slider-sp&a=edit&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>" class="text-danger" title="Sửa"><?=$items[$i]['title_vi']?></a><br/>
				<a href="index.php?p=slider-sp&a=edit&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>" class="text-danger" title="Sửa"><?=$items[$i]['title_en']?>
			</td>
			<td>
				<a href="index.php?p=slider-sp&a=edit&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>"><img src="<?php echo FILEURL . "img_data/images/" . $items[$i]['image_path']; ?>" alt="" style="max-width:50px; max-height:50px"></a>
			</td>
			<!-- 
			<td>
				<a href="<?=$items[$i]['href']?>" target="_blank" style="text-decoration:none;">
		        <?=$items[$i]['href']?>
		        </a>
			</td> -->

			
			<td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_slide_sp','hien_thi','<?=$items[$i]['id']?>')" <?php if($items[$i]['hien_thi'] == 1) echo 'checked="checked"'; ?>>
			</td>
			<td>
				<a href="index.php?p=slider-sp&a=edit&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>" class="text-danger" title="Sửa"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;
				<a href="index.php?p=slider-sp&a=delete&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
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