<?php
// Prepare data
$item = ['is_show' => 1, 'weight' => 0];
if ($_GET['a'] == 'edit') {
	$item = $items[0];
} else if ($_POST['submit']) {
	$item = $_POST;
}

?>
<ol class="breadcrumb">
	<li><a href="<?=urladmin ?>"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
	<li class="active"><a href="<?=urladmin ?>index.php?p=brand_group&a=man">Nhóm nhãn hiệu</a></li>
	<li class="active"><a href="#"><?php if(isset($_GET['id'])) echo "Sửa "; else echo "Thêm mới" ?></a></li>
</ol>
<div class="col-xs-12">
	<form name="frm" method="post" action="index.php?p=brand_group&a=save&id=<?=@$_REQUEST['id']?>&page=<?=@$_REQUEST['page']?>" enctype="multipart/form-data">
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
							<tr>
								<td class="td_left">
									Tên VN:
								</td>
								<td class="td_right">
									<input
										type="text"
										class="input width400 form-control"
										id="name_vi" name="name_vi"
										value="<?php echo @$item['name_vi'];  ?>"
									/>
								</td>
							</tr>
							<tr>
								<td class="td_left">
									Tên US:
								</td>
								<td class="td_right">
									<input
										type="text"
										class="input width400 form-control"
										id="name_en" name="name_en"
										value="<?php echo @$item['name_en'];  ?>"
									/>
								</td>
							</tr>
							<tr>
								<td class="td_left">
									Tên CH:
								</td>
								<td class="td_right">
									<input
										type="text"
										class="input width400 form-control"
										id="name_ch" name="name_ch"
										value="<?php echo @$item['name_ch'];  ?>"
									/>
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
									<span class="pull-left mr-4">
										<input type="number" name="weight" value="<?php echo $item['weight'] ?>" class="input form-control" style="width:80px">
									</span>
									<label>
										<input
											type="checkbox"
											id="is_show" name="is_show"
											value="1"
											<?php echo $item['is_show'] ? 'checked' : '';  ?>
										/>
										Hiển thị
									</label>
								</td>
							</tr>
							<tr>
								<td class="td_left" style="text-align:right">
									<input type="submit" name="submit" value="Lưu"  class="btn btn-primary" />
								</td>
								<td class="td_right">
									<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=brand_group&a=man'" class="btn btn-primary" />
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