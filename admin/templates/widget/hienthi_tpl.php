<style type="text/css">
	.label {
		margin: 5px;
	    padding: .5em;
    	font-size: .75em;
    	display: inline-block;
	}
</style>
<ol class="breadcrumb">
  <li><a href="<?=urladmin ?>index.php"><i class="glyphicon glyphicon-home"></i> Admin</a></li>
  <li class="active"><a href="<?=urladmin ?>index.php?p=widget&a=man">Quản lý widget</a></li>
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
		<select id="action" onchange="seach(this,'widget')" name="action" class="form-control">
			<option value="0" selected>Tìm theo</option>
			<option value="1">ID</option>
			<option value="2">Tên</option>
		</select>
	</div>
	<script type="text/javascript">
	    jQuery(document).ready(function($) {
	        $('input#search').keypress(function (e) {
	         var key = this.value;
	           if (e.which == 13) {
	             window.location = "index.php?p=widget&a=man&seach=name&key="+key;
	           }
	        });        
	    }); 
	</script>
	<div class="btn-group">
		<select id="action" onchange="show(this,'widget')" name="action" class="form-control">
			<option value="0" selected>Số hiển thị</option>
			<option value="1" <?php if(@$_GET['hienthi'] == 1) echo 'selected'; ?>>15</option>
			<option value="2" <?php if(@$_GET['hienthi'] == 2) echo 'selected'; ?>>25</option>
			<option value="3" <?php if(@$_GET['hienthi'] == 3) echo 'selected'; ?>>50</option>
			<option value="4" <?php if(@$_GET['hienthi'] == 4) echo 'selected'; ?>>75</option>
			<option value="5" <?php if(@$_GET['hienthi'] == 5) echo 'selected'; ?>>100</option>
			<option value="6" <?php if(@$_GET['hienthi'] == 6) echo 'selected'; ?>>200</option>
			<option value="7" <?php if(@$_GET['hienthi'] == 7) echo 'selected'; ?>>300</option>
			<option value="8" <?php if(@$_GET['hienthi'] == 8) echo 'selected'; ?>>500</option>
			<option value="9" <?php if(@$_GET['hienthi'] == 9) echo 'selected'; ?>>1000</option>
			<option value="10" <?php if(@$_GET['hienthi'] == 10) echo 'selected'; ?>>2000</option>
		</select>
	</div>
	<a href="index.php?p=widget&a=add" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-plus"></i> Thêm mới</a>
</div>

<form id="form" method="post" action="index.php?p=widget&a=delete_all" role="form">

<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th><input class="chk_box checkall" type="checkbox" name="chk" value="0"  id="check_all"></th>
			<th>STT</th>
			<th>Vị trí</th>
			<th>Tên VN</th>
			<th>Tên US</th>
			<th>Tên CH</th>
			<th width="300px">Nhóm</th>
			<th>Hiển thị</th>
			<th>Tác vụ</th>
		</tr>
	</thead>
	<tbody>
		<?php $count=count($items); for($i=0; $i<$count; $i++){ ?>
		<tr>
			<td>
				<input class="chk_box" type="checkbox" name="chk_child[]" value="<?=$items[$i]['id']?>">
			</td>
			<td>
				<input type="number" value="<?=$items[$i]['weight']?>" class="a_stt" data-table="#_widget" data-col="weight" data-id="<?=$items[$i]['id']?>" />
            </td>
			<td>
				<?php echo $items[$i]['group_id'] ?>
            </td>
			
			<td style=" text-align:left">
				<a href="index.php?p=widget&a=edit&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>"><?=$items[$i]['name_vi']?></a> 
			</td>
			<td>
				<a href="index.php?p=widget&a=edit&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>"><?=$items[$i]['name_en']?></a>
			</td>
			<td>
				<a href="index.php?p=widget&a=edit&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>"><?=$items[$i]['name_ch']?></a>
			</td>
			<td width="300px">
				<?php
				$id = $items[$i]['id'];
				$selectedCategories = $d->o_fet("select name_vi from #_widget_category wc JOIN #_category c ON wc.category_id = c.id where wc.widget_id =  '".$id."'");
				foreach ($selectedCategories as $selectedCategory) {
					echo '<span class="label label-primary">' . $selectedCategory['name_vi'] . '</span>';
				}
				?>
			</td>
			<td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_widget','is_active','<?=$items[$i]['id']?>')" <?php if($items[$i]['is_active'] == 1) echo 'checked="checked"'; ?>>
			</td>
			<td>
				<a href="index.php?p=widget&a=edit&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>" class="text-danger" title="Sửa"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;
				<a href="index.php?p=widget&a=delete&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
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
