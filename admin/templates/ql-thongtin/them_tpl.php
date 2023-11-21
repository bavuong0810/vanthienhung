<?php @include_once "sources/editor.php" ?>
<style>
	.form-group {
		padding-bottom: 20px;
		border-bottom: 1px solid #ddd;
	}
</style>
<ol class="breadcrumb">
	<li><a href="<?= URLPATH . "admin" ?>"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
	<li class="active"><a href="<?= URLPATH . "admin" ?>/index.php">Hiển thị</a></li>
	<li class="active"><a href="<?= URLPATH . "admin" ?>/index.php?p=<?= @$_REQUEST['p'] ?>&a=man">Ql thông tin</a></li>
</ol>
<div class="col-xs-12">
	<form name="frm" method="post" action="index.php?p=<?= @$_REQUEST['p'] ?>&a=save&id=<?= @$_REQUEST['id'] ?>&page=<?= @$_REQUEST['page'] ?>" enctype="multipart/form-data">
		<div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
			<ul id="myTabs" class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active">
					<a href="#id_viet" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Ngôn ngữ VN</a>
				</li>
				<!-- <li role="presentation" class="">
					<a href="#id_us" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Ngôn ngữ US</a>
				</li> -->
			</ul>
			<div id="myTabContent" class="tab-content">
				<div role="tabpanel" class="tab-pane fade active in" id="id_viet" aria-labelledby="home-tab">
					<div class="ar_admin">
						<table class="table table-bordered table-hover them_dt" style="border:none;">
							<tbody>
								<tr>
									<td class="td_left">
										Tên công ty VN:
									</td>
									<td class="td_right">
										<input class="input form-control  width400" name="company_vn" value="<?php echo @$items[0]['company_vn'] ?>" />
									</td>
								</tr>
								<tr>
									<td class="td_left">
										Tên công ty US:
									</td>
									<td class="td_right">
										<input class="input form-control  width400" name="company_us" value="<?php echo @$items[0]['company_us'] ?>" />
									</td>
								</tr>
								<tr>
									<td class="td_left">
										Tên công ty CH:
									</td>
									<td class="td_right">
										<input class="input form-control  width400" name="company_ch" value="<?php echo @$items[0]['company_ch'] ?>" />
									</td>
								</tr>
								<tr>
									<td class="td_left">
										Địa chỉ:
									</td>
									<td class="td_right">
										<input class="input form-control  width400" name="address" value="<?php echo @$items[0]['address'] ?>" />
									</td>
								</tr>
								<tr>
									<td class="td_left">
										Favicon:
									</td>
									<td class="td_right">
										<?php if ($items[0]['favicon'] <> '') { ?>
											<img src="../img_data/icon/<?php echo @$items[0]['favicon'] ?>" width="50" alt="NO PHOTO" />
										<?php } ?>
									</td>
								</tr>
								<tr>
									<td class="td_left">
										Icon Trình Duyệt:
									</td>
									<td class="td_right">
										<input type="file" name="file" class="input width400 form-control" />
									</td>
								</tr>
								<tr>
									<td class="td_left">
										Icon Chia sẻ:
									</td>
									<td class="td_right">
										<?php if ($items[0]['icon_share'] <> '') { ?>
											<img src="../img_data/icon/<?php echo @$items[0]['icon_share'] ?>" width="50" alt="NO PHOTO" />
										<?php } ?>
									</td>
								</tr>
								<tr>
									<td class="td_left">
										Icon Chia sẻ:
									</td>
									<td class="td_right">
										<input type="file" name="file_2" class="input width400 form-control" />
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane fade" id="id_us" aria-labelledby="profile-tab">
					<div class="ar_admin">
						<table class="table table-bordered table-hover them_dt" style="border:none">
							<tbody>
								<tr>
									<td class="td_left">
										Địa chỉ (en):
									</td>
									<td class="td_right">
										<input class="input form-control  width400" name="address_us" value="<?php echo @$items[0]['address_us'] ?>" />
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="ar_admin">
					<table class="table table-bordered table-hover them_dt" style="border:none">
						<tbody>
							<div class="title_thongtinchung">
								Thông tin chung
							</div>
							<tr>
								<td class="td_left">
									Hotline :
								</td>
								<td class="td_right">
									<input class="input form-control  width400" name="hotline" value="<?php echo @$items[0]['hotline'] ?>" />
								</td>
							</tr>

							<tr>
								<td class="td_left">
									Email
								</td>
								<td class="td_right">
									<input class="input form-control  width400" name="email" value="<?php echo @$items[0]['email'] ?>" />
								</td>
							</tr>

							<tr>
								<td class="td_left">
									Facebook:
								</td>
								<td class="td_right">
									<input class="input form-control  width400" name="facebook" value="<?php echo @$items[0]['facebook'] ?>" />
								</td>
							</tr>
							<tr>
								<td class="td_left">
									Twitter:
								</td>
								<td class="td_right">
									<input class="input form-control  width400" name="twitter" value="<?php echo @$items[0]['twitter'] ?>" />
								</td>
							</tr>
							<tr>
								<td class="td_left">
									G+:
								</td>
								<td class="td_right">
									<input class="input form-control  width400" name="google" value="<?= $items[0]['google'] ?>" />
								</td>
							</tr>
							<tr>
								<td class="td_left">
									Youtube:
								</td>
								<td class="td_right">
									<input class="input form-control  width400" name="youtube" value="<?= $items[0]['youtube'] ?>" />
								</td>
							</tr>
							<tr>
								<td class="td_left">
									Pinterest:
								</td>
								<td class="td_right">
									<input class="input form-control  width400" name="pinterest" value="<?= $items[0]['pinterest'] ?>" />
								</td>
							</tr>
							<tr>
								<td class="td_left">
									Instagram:
								</td>
								<td class="td_right">
									<input class="input form-control  width400" name="instagram" value="<?= $items[0]['instagram'] ?>" />
								</td>
							</tr>
							<tr>
								<td class="td_left">
									Iframe Map:
								</td>
								<td class="td_right">
									<textarea class="input width400 form-control" name="map" id="map" rows="10"><?= $items[0]['map'] ?></textarea>

								</td>
							</tr>
							<tr>
								<td class="td_left">
									Tọa độ:
								</td>
								<td class="td_right">
									<input class="input form-control  width400" name="toado" value="<?= $items[0]['toado'] ?>" />
								</td>
							</tr>
							<tr>
								<td class="td_left">
									Hỗ trợ thêm ngôn ngữ:
								</td>
								<td class="td_right">
									<span>
										<label>
											<input type="checkbox" name="lang_us" value="1" <?php echo $items[0]['lang_us'] ? 'checked' : '' ?> />
											Tiếng Anh
										</label>
										&nbsp;&nbsp;&nbsp;&nbsp;
										<label>
											<input type="checkbox" name="lang_ch" value="1" <?php echo $items[0]['lang_ch'] ? 'checked' : '' ?> />
											Tiếng Trung
										</label>
									</span>
								</td>
							</tr>
                            <tr>
                                <td class="td_left">
                                    Cài đặt thuế (%):
                                </td>
                                <td class="td_right">
                                    <input type="number" class="input form-control  width400" name="tax" value="<?= $items[0]['tax'] ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td class="td_left">
                                    Script Header:
                                </td>
                                <td class="td_right">
                                    <textarea class="input width400 form-control" name="google_analytics" id="google_analytics" rows="10"><?= $items[0]['google_analytics'] ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="td_left">
                                    Script Body:
                                </td>
                                <td class="td_right">
                                    <textarea class="input width400 form-control" name="script_body" id="script_body" rows="10"><?= $items[0]['script_body'] ?></textarea>
                                </td>
                            </tr>
						</tbody>
					</table>
				</div>
				<div class="ar_admin last">
					<table class="table table-bordered table-hover them_dt" style="border:none">
						<tr>
							<td class="td_left" style="text-align:right">
								<input type="submit" value="Lưu" class="btn btn-primary" />
							</td>
							<td class="td_right">
								<input type="button" value="Thoát" onclick="javascript:window.location='index.php'" class="btn btn-primary" />
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</form>
</div>

<?php
$chunkLength = ceil(count($settingsFields) / 2);
$keys = array_keys($settingsFields);
list($leftFieldKeys, $rightFieldKeys) = array_chunk($keys, $chunkLength);
$leftFields = [];
$rightFields = [];
foreach ($leftFieldKeys as $key) {
	$leftFields[$key] = $settingsFields[$key];
}
foreach ($rightFieldKeys as $key) {
	$rightFields[$key] = $settingsFields[$key];
}

if (!$settings['image_watermark'] || (is_array($settings['image_watermark']) && !$settings['image_watermark']['value'])) {
	$settings['image_watermark']['value'] = FILEURL . 'watermark_' . THUMB_SITE_FOLDER . '.png';
}

?>
<div class="col-xs-12 mt-4">
	<form action="index.php?p=<?= @$_REQUEST['p'] ?>&a=saveSettings" class="js-ajax-form-custom">
		<div class="ar_admin">
			<div class="title_thongtinchung">
				Thông tin khác
			</div>
			<div class="row">
				<div class="col-lg-6">
					<?php renderForm($leftFields, $settings); ?>
				</div>
				<div class="col-lg-6">
					<?php renderForm($rightFields, $settings); ?>
				</div>
			</div>
			<?php $ckeditor->replace('bank_account'); ?>
			<div>
				<button type="submit" class="btn btn-primary">Lưu</button>
			</div>
		</div>
	</form>
</div>

<script src="/admin/js/form.js?v=<?php echo getenv('APP_VERSION'); ?>"></script>
<script>
	const handleClearImageCache = async () => {
		const thumbFolder = AppConfig.thumbFolder || '';
		const apiUrl = AppConfig.fileBaseUrl + 'admin/api.php?func=clearCacheImage&thumbFolder=' + thumbFolder;
		return fetch(apiUrl, {
			method: 'DELETE'
		});
	};

	const handleSubmitFormCustom = async (e) => {
		e.preventDefault();
		const result = await handleSubmitAjaxForm(e);
		swal({
			type: 'info',
			title: 'Cập nhật thành công, đang xóa bộ nhớ đệm cho ảnh!',
			allowOutsideClick: false,
		});
		swal.showLoading();

		try {
			const res = await handleClearImageCache();
			console.log('handleClearImageCache', res);
			swal({
				type: 'success',
				title: 'Xóa bộ nhớ đệm cho ảnh thành công!',
			});
		} catch (error) {
			swal({
				type: 'warning',
				title: 'Xóa bộ nhớ đệm cho ảnh không thành công!',
			});
		}
	};
	$(document).ready(() => {
		$('.js-ajax-form-custom').on('submit', handleSubmitFormCustom);
	});
</script>