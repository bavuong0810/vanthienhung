<?php @include "sources/editor.php" ?>
<ol class="breadcrumb">
	<li><a href="<?= urladmin ?>"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
	<li class="active"><a href="<?= urladmin ?>index.php">Liên kết</a></li>
	<li class="active"><a href="<?= urladmin ?>index.php?p=slider-sp&a=man">Slider</a></li>
	<li class="active"><a href="<?= urladmin ?>index.php?p=slider-sp&a=man"><?php if (isset($_GET['id'])) echo "Sửa slider";
																																					else echo "Thêm slider" ?></a></li>
</ol>
<div class="col-xs-12">
	<form name="frm" method="post" action="index.php?p=slider-sp&a=save&id=<?= @$_REQUEST['id'] ?>&page=<?= @$_REQUEST['page'] ?>" enctype="multipart/form-data">
		<div class="ar_admin">
			<div class="title_thongtinchung">
				Thông tin chung
			</div>
			<table class="table table-bordered table-hover them_dt" style="border:none">
				<tbody>
					<tr>
						<td class="td_left">
							Hình hiện tại:
						</td>
						<td class="td_right" id="thumb">
							<input type="hidden" class="input-clipboard js-upload-result" name="image_path">
							<div class="img-result">
								<?php if (isset($_GET['id'])) { ?>
									<img src="<?php echo FILEURL . "img_data/images/" . @$items[0]['image_path']; ?>" width="120" alt="NO PHOTO" /><br />
								<?php } ?>
							</div>
						</td>
					</tr>
					<tr>
						<td class="td_left">
							Hình ảnh:
						</td>
						<td class="td_right">
							<input type="file" name="file" class="input width400 form-control js-image-field" data-api="<?php echo getApiUploadFile(); ?>" data-result="#thumb" />
							<h3 style="margin-top: 10px;font-size: 12px;color: #5f5f5f;">Kích thước chuẩn: <span style="font-size: 13px;color: #f00;font-weight: bold;">1900 x 550</span> (px)</h3>
						</td>
					</tr>
					<tr>
						<td class="td_left">
							Liên kết:
						</td>
						<td class="td_right">
							<input class="input width400 form-control" type="text" name="href" value="<?php echo @$items[0]['href'] ?>" />
						</td>
					</tr>
					<!-- <tr>
					<td class="td_left">
						Danh mục:
					</td>
					<td class="td_right">
						<select  class="input width400 form-control" name="category_id">
							<option value="0" <?php if ($items[0]['category_id'] == '0') echo 'selected="selected"'; ?>>Trang chủ</option>
							<option value="1" <?php if ($items[0]['category_id'] == '1') echo 'selected="selected"'; ?>>Giới thiệu</option>
							<option value="2" <?php if ($items[0]['category_id'] == '2') echo 'selected="selected"'; ?>>Kinh doanh</option>
							<option value="3" <?php if ($items[0]['category_id'] == '3') echo 'selected="selected"'; ?>>Tin tức</option>
							<option value="4" <?php if ($items[0]['category_id'] == '4') echo 'selected="selected"'; ?>>Liên hệ</option>
						</select>
					</td>
				</tr> -->
					<tr>
						<td class="td_left">
							Tiêu đề:
						</td>
						<td class="td_right">
							<input class="input width400 form-control" type="text" name="title_vi" value="<?php echo @$items[0]['title_vi'] ?>" />
						</td>
					</tr>
					<!-- <tr>
					<td class="td_left">
						Mô tả (vn):
					</td>
					<td class="td_right">
						<input class="input width400 form-control" type="text" name="description_vi" value="<?php echo @$items[0]['description_vi'] ?>"  />
					</td>
				</tr> -->

					<!-- <tr>
					<td class="td_left">
						Tiêu đề (us):
					</td>
					<td class="td_right">
						<input class="input width400 form-control" type="text" name="title_en" value="<?php echo @$items[0]['title_en'] ?>"  />
					</td>
				</tr> -->
					<!-- <tr>
					<td class="td_left">
						Mô tả (us):
					</td>
					<td class="td_right">
						<input class="input width400 form-control" type="text" name="description_en" value="<?php echo @$items[0]['description_en'] ?>"  />
					</td>
				</tr> -->
				</tbody>
			</table>
		</div>
		<div class="ar_admin ">
			<table class="table table-bordered table-hover them_dt" style="border:none">
				<tr>
					<td class="td_left">
						Số thứ tự:
					</td>
					<td class="td_right">
						<input type="text" name="so_thu_tu" value="<?php if (isset($items[0]['so_thu_tu'])) echo $items[0]['so_thu_tu'];
																												else echo @count($soluong) + 1; ?>" class="input width400 form-control" style="width:60px">
					</td>
				</tr>
				<tr>
					<td class="td_left">
						Hiển thị:
					</td>
					<td class="td_right">
						<input type="checkbox" class="chkbox" name="hien_thi" <?php if (isset($items[0]['hien_thi'])) {
																																		if (@$items[0]['hien_thi'] == 1) echo 'checked="checked"';
																																		else echo '';
																																	} else echo 'checked="checked"';	?>>
					</td>
				</tr>
				<tr>
					<td class="td_left">
					</td>
					<td class="td_right">
						<input type="submit" value="Lưu" class="btn btn-primary" />
						<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=slider-sp&a=man'" class="btn btn-primary" />
					</td>
				</tr>
			</table>
		</div>
	</form>
</div>
<script src="/admin/js/form.js?v=<?php echo getenv('APP_VERSION'); ?>"></script>