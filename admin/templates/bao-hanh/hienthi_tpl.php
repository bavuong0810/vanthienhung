<ol class="breadcrumb sticky-left">
	<li><a href="."><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
	<li class="active"><a href=".">Bảo hành</a></li>
	<li class="active"><a href="#">Danh sách bảo hành</a></li>
</ol>
<div class="form-group sticky-left px-3">
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
	<div class="pull-right">
		<a href="/admin/index.php?p=bao-hanh&a=add" title="Thêm mới">
			<button class="btn btn-success">Thêm mới</button>
		</a>
	</div>
	<div class="clearfix"></div>
</div>
<div class="col-xs-12">
	<form id="form" method="post" action="index.php?p=bao-hanh&a=delete_all" role="form">
		<table class="table table-bordered table-hover" style="width:2000px">
			<thead>
				<tr>
					<th style="width:2%"><input type="checkbox" name="chk" value="0" class="chk_box checkall" id="check_all"></th>
					<th style="width:10%;">Serial</th>
					<th style="width:10%;">Code</th>
					<th style="width:5%;">Trạng thái</th>
					<th style="width:5%;">Bắt đầu</th>
					<th style="width:5%;">Kết thúc</th>
					<th style="width:10%;">Tên khách hàng</th>
					<th style="width:6%;">Điện thoại</th>
					<th style="width:10%;">Email</th>
					<th style="width:20%;">Địa chỉ</th>
					<th style="width:5%">Tác vụ</th>
				</tr>
			</thead>
			<tbody>
				<?php $count = count($items);for ($i = 0; $i < $count; $i++) {
					$item = $items[$i];
				?>
				<tr>
					<td>
						<input type="checkbox" name="chk_child[]" value="<?=$items[$i]['id']?>" class="chk_box ">
					</td>
					<td>
						<?php echo $item['specification']; ?>
					</td>
					<td>
						<?php echo $item['code']; ?>
					</td>
					<td>
						<?php
							echo $item['is_actived']
								? '<span style="color: green">Đã kích hoạt</span>'
								: '<span style="color: gray">Chưa kích hoạt</span>';
						?>
					</td>
					<td>
						<?php echo date('d-m-Y', strtotime($item['start_at'])); ?>
					</td>
					<td>
						<?php echo date('d-m-Y', strtotime($item['end_at'])); ?>
					</td>
					<td>
						<?php echo $item['name']; ?>
					</td>
					<td>
						<?php echo $item['phone']; ?>
					</td>
					<td>
						<?php echo $item['email']; ?>
					</td>
					<td>
						<?php echo $item['address']; ?>
					</td>
					<td>
						<a href="index.php?p=bao-hanh&a=edit&id=<?=$item['id']?>&page=<?=@$_GET['page']?>" class="text-danger" title="Sửa"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;
						<a href="index.php?p=bao-hanh&a=delete&id=<?=$item['id']?>&page=<?=@$_GET['page']?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
					</td>
				</tr>
				<?php }?>
			</tbody>
		</table>
	</form>
</div>
<div class="pagination">
	<?php echo @$paging['paging'] ?>
</div>