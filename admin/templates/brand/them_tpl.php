<link rel="stylesheet" type="text/css" href="/admin/assets/bootstrap-select-1.12.4/css/bootstrap-select.min.css">
<?php
@include "sources/editor.php";

// Prepare data
$item = ['is_show' => 1];
if ($_GET['a'] == 'edit') {
	$item = $items[0];
} else if ($_POST['submit']) {
	$item = $_POST;
}

?>
<ol class="breadcrumb">
	<li><a href="<?=urladmin ?>"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
	<li class="active"><a href="<?=urladmin ?>index.php?p=brand&a=man">Nhãn hiệu</a></li>
	<li class="active"><a href="#"><?php if(isset($_GET['id'])) echo "Sửa "; else echo "Thêm mới" ?></a></li>
</ol>
<div class="col-xs-12">
	<form name="frm" method="post" action="index.php?p=brand&a=save&id=<?=@$_REQUEST['id']?>&page=<?=@$_REQUEST['page']?>" enctype="multipart/form-data">
		<div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
			<ul id="myTabs" class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active">
					<a href="#id_viet" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Thông tin</a>
				</li>
			</ul>
			<div id="myTabContent" class="tab-content">
				<div role="tabpanel" class="tab-pane fade active in" id="id_viet" aria-labelledby="home-tab">
					<table class="table table-bordered table-hover them_dt" style="border:none">
						<tbody>
							<?php if ($item['id']): ?>
							<tr>
								<td class="td_left">
									Thay thế bằng:
								</td>
								<td class="td_right">
									<select id="replace_brand" class="input width400 form-control selectpicker" data-live-search="true" style="border-radius:4px">
					    				<option value="0">Chọn nhãn hiệu</option>
										<?php foreach ($brands as $brand): ?>
											<option value="<?php echo $brand['id'] ?>"><?php echo $brand['name'] ?></option>
										<?php endforeach ?>
									</select>
									<a id="replace_brand_btn" href="#" onClick="if(!confirm('Xác nhận thay thế?')) return false;" class="btn btn-danger" title="Thay thế" disabled>Thay</a>
								</td>
							</tr>
							<?php endif ?>
							<tr>
								<td class="td_left">
									Tên:
								</td>
								<td class="td_right">
									<input
										type="text"
										class="input width400 form-control"
										id="name" name="name"
										value="<?php echo @$item['name'];  ?>"
									/>
								</td>
							</tr>
							<tr>
								<td class="td_left">
									Nhóm:
								</td>
								<td class="td_right">
									<select id="group_id" name="group_id" class="input width400 form-control selectpicker" data-live-search="true" style="border-radius:4px">
					    				<option value="0">Chọn nhóm</option>
										<?php foreach ($brandGroups as $group): ?>
											<option value="<?php echo $group['id'] ?>" <?php echo $item['group_id'] == $group['id'] ? 'selected' : '' ?>><?php echo $group['name_vi'] ?></option>
										<?php endforeach ?>
									</select>
								</td>
							</tr>
							<tr>
								<td class="td_left">
									Logo:
								</td>
								<td class="td_right">
									<input
										type="file"
										class="input width400 form-control"
										id="image" name="image"
									/>
									<?php
										if (!empty($item['image'])) {
											?>
											<img class="mt-2" src="/img_data/images/<?php echo $item['image']; ?>" style="max-height: 200px">
											<?php
										}
									?>
								</td>
							</tr>
							<tr>
								<td class="td_left">
									Tùy chọn:
								</td>
								<td class="td_right">
									<label>
										<input
											type="checkbox"
											id="is_show" name="is_show"
											value="1"
											<?php echo $item['is_show'] ? 'checked' : '';  ?>
										/>
										Hiển thị
									</label>
									<label class="ml-4">
										<input
											type="checkbox"
											id="is_featured" name="is_featured"
											value="1"
											<?php echo $item['is_featured'] ? 'checked' : '';  ?>
										/>
										Tiêu biểu
									</label>
								</td>
							</tr>
							<tr>
								<td class="td_left">
									Mô tả VN:
								</td>
								<td class="td_right">
									<textarea class="input width400 form-control" style="height:80px" name="desc_vn" id="desc_vn">
									<?=@$item['desc_vn']?></textarea>
									<?php $ckeditor->replace('desc_vn'); ?>
								</td>
							</tr>
							<tr>
								<td class="td_left">
									Mô tả US:
								</td>
								<td class="td_right">
									<textarea class="input width400 form-control" style="height:80px" name="desc_us" id="desc_us">
									<?=@$item['desc_us']?></textarea>
									<?php $ckeditor->replace('desc_us'); ?>
								</td>
							</tr>
							<tr>
								<td class="td_left">
									Mô tả CH:
								</td>
								<td class="td_right">
									<textarea class="input width400 form-control" style="height:80px" name="desc_ch" id="desc_ch">
									<?=@$item['desc_ch']?></textarea>
									<?php $ckeditor->replace('desc_ch'); ?>
								</td>
							</tr>
							<tr>
								<td class="td_left" style="text-align:right">
									<input type="submit" name="submit" value="Lưu"  class="btn btn-primary" />
								</td>
								<td class="td_right">
									<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=brand&a=man'" class="btn btn-primary" />
									<?php if ($item['id']): ?>
										<a href="index.php?p=brand&a=delete&id=<?=$item['id']?>&page=<?=@$_GET['page']?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger ml-4" title="Xóa">Xóa</a>
									<?php endif ?>
								</td>
							</tr>
						</tbody>
					</table>
					<!-- end -->
				</div>
			</div>
		</div>
	</form>
</div>

<script type="text/javascript" src="/admin/assets/bootstrap-select-1.12.4/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="/admin/assets/bootstrap-select-1.12.4/js/i18n/defaults-vi_VN.min.js"></script>
<?php if ($item['id']): ?>
	
<script type="text/javascript">
	$(document).ready(function() {
		$replaceBrandSelect = $('#replace_brand');
		$replaceBrandButton = $('#replace_brand_btn');
		$replaceBrandSelect.on('change', function() {
			const toId = $replaceBrandSelect.val();

			if (+toId === 0) {
				$replaceBrandButton.attr('href', '#');
				$replaceBrandButton.attr('disabled', 'true');
				return;
			}

			$replaceBrandButton.attr('href', `index.php?p=brand&a=replace&id=<?=$item['id']?>&toId=${toId}&page=<?php echo @$_REQUEST['page']; ?>`);
			$replaceBrandButton.removeAttr('disabled');
		});
	});
</script>
<?php endif ?>