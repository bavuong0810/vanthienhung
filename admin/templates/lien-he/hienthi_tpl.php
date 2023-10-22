<ol class="breadcrumb sticky-left">
	<li><a href="."><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
	<li class="active"><a href=".">Hiển thị</a></li>
	<li class="active"><a href="#">Liên hệ</a></li>
</ol>
<div class="col-xs-12 sticky-left">
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
			<select id="action" onchange="searchByColumn(this,'lien-he')" name="action" class="form-control">
				<option value="" selected>Tìm theo</option>
				<option value="id">ID</option>
				<option value="ho_ten">Tên</option>
				<option value="email">Email</option>
				<option value="sdt">Số điện thoại</option>
			</select>
		</div>
		<div class="btn-group">
			<?php $hienthi = $_GET['hienthi'];?>
			<select id="action" onchange="show(this,'lien-he')" name="action" class="form-control">
				<option value="0" <?php echo empty($hienthi) ? 'selected' : '' ?>>Số hiển thị</option>
				<option value="1" <?php echo $hienthi == 1 ? 'selected' : '' ?>>15</option>
				<option value="2" <?php echo $hienthi == 2 ? 'selected' : '' ?>>25</option>
				<option value="3" <?php echo $hienthi == 3 ? 'selected' : '' ?>>50</option>
				<option value="4" <?php echo $hienthi == 4 ? 'selected' : '' ?>>75</option>
				<option value="5" <?php echo $hienthi == 5 ? 'selected' : '' ?>>100</option>
				<option value="6" <?php echo $hienthi == 6 ? 'selected' : '' ?>>200</option>
				<option value="7" <?php echo $hienthi == 7 ? 'selected' : '' ?>>300</option>
			</select>
		</div>
	</div>
</div>
<div class="col-xs-12">
	<form id="form" method="post" action="index.php?p=lien-he&a=delete_all" role="form">
		<table class="table table-bordered table-hover" style="width: 1920px;">
			<thead>
				<tr>
					<th style="width:3%"><input  type="checkbox" name="chk" value="0" class="checkall chk_box" id="check_all"></th>
					<th style="width:3%">STT</th>
					<th style="width:10%">Họ tên</th>
					<th style="width:8%">Email</th>
					<th style="width:8%">Điện thoại</th>
					<th style="width:50%">Nội dung</th>
					<th style="width:8%">Ngày hỏi</th>
					<th style="width:5%">Trạng thái</th>
					<th style="width:10%">Tác vụ</th>
				</tr>
			</thead>
			<tbody>
				<?php $count = count($items);for ($i = 0; $i < $count; $i++) {?>
				<tr>
					<td>
						<input type="checkbox" class="chk_box" name="chk_child[]" value="<?=$items[$i]['id']?>">
					</td>
					<td><?=($i + 1 + ($page - 1) * $maxR)?></td>
					<td>
						<?=$items[$i]['ho_ten']?>
					</td>
					<td>
						<?=($items[$i]['email'] != '') ? $items[$i]['email'] : ""?>
						<hr>
						Liên hệ: <strong><?php echo $items[$i]['email_count']; ?> lần</strong>
					</td>
					<td>
						<?=($items[$i]['sdt'] != '') ? $items[$i]['sdt'] : ""?>
						<hr>
						Liên hệ: <strong><?php echo $items[$i]['phone_count']; ?> lần</strong>
					</td>
					<td>
						<div class="noi-dung-lien-he">
							<?php
								showContactContent(@$items[$i]['noi_dung']);
							?>
						</div>
					</td>
					<td>
						<?=$items[$i]['ngay_hoi']?>
					</td>
					<td align="center">
						<?php if (@$items[$i]['trang_thai'] == 1) {?>
						<font style="color:blue">Đã xem</font>
						<?php } else {?>
						<font style="color:red">Chưa xem</font>
						<?php }?>
						<hr/>
						<?php if (@$items[$i]['is_replied'] == 1) {?>
						<font style="color:blue">Đã trả lời</font>
						<?php } else {?>
						<font style="color:red">Chưa trả lời</font>
						<?php }?>
					</td>
					<td align="center">
						<a href="index.php?p=lien-he&a=edit&id=<?=$items[$i]['id']?>&page=<?=@$_REQUEST['page'];?>">
							<i class="glyphicon glyphicon-eye-open"></i>
						</a>&nbsp;&nbsp;&nbsp;
						<a href="index.php?p=lien-he&a=reply-page&id=<?=$items[$i]['id']?>" class="text-success">
							<i class="glyphicon glyphicon-comment"></i>
						</a>&nbsp;&nbsp;&nbsp;
						<a href="index.php?p=lien-he&a=delete&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
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