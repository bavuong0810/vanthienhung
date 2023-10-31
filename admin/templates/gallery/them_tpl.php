<?php @include "sources/editor.php" ?>
<ol class="breadcrumb">
	<li><a href="."><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
	<li class="active"><a href="./index.php">Danh mục</a></li>
	<li class="active"><a href="./index.php?p=gallery&a=man">Hình ảnh</a></li>
	<li class="active"><a href="#"><?php if (isset($_GET['id'])) echo "Sửa ảnh";
																	else echo "Thêm ảnh" ?></a></li>
</ol>
<div class="col-xs-12">
	<form name="frm" method="post" action="index.php?p=gallery&a=save&id=<?= @$_REQUEST['id'] ?>&page=<?= @$_REQUEST['page'] ?>" enctype="multipart/form-data">
		<div class="ar_admin">
			<div class="title_thongtinchung">
				Thông tin chung
			</div>
			<table class="table table-bordered table-hover them_dt" style="border:none">
				<tbody>
					<tr>
						<td class="td_left">
							Danh mục:
						</td>
						<td class="td_right">
							<select class="input width400 form-control" name="parent">
								<?php if (count($parent) > 0) {
									foreach ($parent as $lsp) {
								?>
										<option value="<?php echo $lsp['id'] ?>" <?php if ($lsp['id'] == $items[0]['parent']) echo "selected"; ?>>
											<?php echo $lsp['name_vi'] ?></option>
										<!-- /// -->
										<?php
										$sp_child1 = $d->o_fet("select * from #_category where category_id = '" . $lsp['id'] . "' order by so_thu_tu asc");
										if (count($sp_child1) > 0) {
											foreach ($sp_child1 as $lsp1) {
										?>
												<option value="<?php echo $lsp1['id'] ?>" <?php if ($lsp1['id'] == $items[0]['parent']) echo "selected"; ?>>&nbsp;&nbsp;&nbsp;&nbsp;|__ <?php echo $lsp1['name_vi'] ?></option>
												<!-- // -->
												<!-- /// -->
												<?php
												$sp_child2 = $d->o_fet("select * from #_category where category_id = '" . $lsp1['id'] . "' order by so_thu_tu asc");
												if (count($sp_child2) > 0) {
													foreach ($sp_child2 as $lsp2) {
												?>
														<option value="<?php echo $lsp2['id'] ?>" <?php if ($lsp2['id'] == $items[0]['parent']) echo "selected"; ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|__ <?php echo $lsp2['name_vi'] ?></option>
												<?php }
												} ?>
												<!-- /// -->
												<!-- / -->
										<?php }
										} ?>
										<!-- /// -->
								<?php }
								} ?>
							</select>
						</td>
					</tr>


					<tr class="show_1" id="thumb">
						<td class="td_left">
							Hình hiện tại:
						</td>
						<td class="td_right">
							<input type="hidden" class="input-clipboard js-upload-result" name="picture" value="<?php echo @$items[0]['picture']; ?>">
							<div class="img-result">
								<?php if (isset($_GET['id'])) { ?>
									<img src="<?php echo FILEURL . "img_data/images/" . @$items[0]['picture']; ?>" width="120" alt="NO PHOTO" /><br />
								<?php } ?>
							</div>
						</td>
					</tr>
					<tr class="show_1">
						<td class="td_left">
							Hình ảnh:
						</td>
						<td class="td_right">
							<input type="file" name="file" class="input width400 form-control js-image-field" data-api="<?php echo getApiUploadFile(); ?>" data-result="#thumb" />
						</td>
					</tr>

                    <tr class="show_1">
                        <td class="td_left">
                            Hoặc nhập link hình ảnh, dán ảnh:
                        </td>
                        <td class="td_right">
                            <input type="text" name="file2_url" placeholder="Link hình ảnh..." class="input width400 form-control" data-result="#thumb">
                        </td>
                    </tr>

					<tr>
						<td class="td_left">
							Link:
						</td>
						<td class="td_right">
							<input class="input width400 form-control" type="text" name="link" value="<?php echo @$items[0]['link'] ?>" />
						</td>
					</tr>

				</tbody>
			</table>
		</div>
		<div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
			<ul id="myTabs" class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active">
					<a href="#id_viet" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Ngôn ngữ VN</a>
				</li>
				<!-- <li role="presentation" class="">
				<a href="#id_us" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Ngôn ngữ EN</a>
			</li>
			<li role="presentation" class="">
				<a href="#id_ch" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Ngôn ngữ Japan</a>
			</li> -->
			</ul>
		</div>
		<div id="myTabContent" class="tab-content">
			<div role="tabpanel" class="tab-pane fade active in" id="id_viet" aria-labelledby="home-tab">
				<!-- //lang viet -->
				<div class="ar_admin">
					<table class="table table-bordered table-hover them_dt" style="border:none">
						<tbody>
							<tr>
								<td class="td_left">
									Tên ảnh:
								</td>
								<td class="td_right">
									<input class="input width400 form-control" type="text" name="title_vi" value="<?php echo @$items[0]['title_vi'] ?>" />
								</td>
							</tr>
							<tr>
								<td class="td_left">
									Thông tin:
								</td>
								<td class="td_right">
									<textarea name="body_vn" rows="5" class="input width400 form-control" id="body_vn"><?= @$items[0]['body_vn'] ?></textarea>
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
									Tên ảnh (en):
								</td>
								<td class="td_right">
									<input class="input width400 form-control" type="text" name="title_en" value="<?php echo @$items[0]['title_en'] ?>" />
								</td>
							</tr>
							<tr>
								<td class="td_left">
									Thông tin (en):
								</td>
								<td class="td_right">
									<textarea name="body_us" rows="5" class="input width400 form-control" id="body_us"><?= @$items[0]['body_us'] ?></textarea>

								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div role="tabpanel" class="tab-pane fade" id="id_ch" aria-labelledby="profile-tab">
				<div class="ar_admin">
					<table class="table table-bordered table-hover them_dt" style="border:none">
						<tbody>
							<tr>
								<td class="td_left">
									Tên ảnh (Ja):
								</td>
								<td class="td_right">
									<input class="input width400 form-control" type="text" name="title_ch" value="<?php echo @$items[0]['title_ch'] ?>" />
								</td>
							</tr>
							<tr>
								<td class="td_left">
									Thông tin (Ja):
								</td>
								<td class="td_right">
									<textarea name="body_ch" rows="5" class="input width400 form-control" id="body_ch"><?= @$items[0]['body_ch'] ?></textarea>

								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="ar_admin last">
			<table class="table table-bordered table-hover them_dt" style="border:none">
				<tbody>
					<tr>
						<td class="td_left">
							Số thứ tự:
						</td>
						<td class="td_right">
							<input type="text" name="stt" value="<?php if (isset($items[0]['stt'])) echo $items[0]['stt'];
																										else echo @count($soluong) + 1; ?>" class="input width400 form-control" style="width:60px">
						</td>
					</tr>
					<tr>
						<td class="td_left">
							Hiển thị:
						</td>
						<td class="td_right">
							<input type="checkbox" class="chkbox" name="hide" <?php if (isset($items[0]['hide'])) {
																																	if (@$items[0]['hide'] == 1) echo 'checked="checked"';
																																	else echo '';
																																} else echo 'checked="checked"';	?>>
						</td>
					</tr>
					<tr>
						<td class="td_left" style="text-align:right">
							<input type="submit" value="Lưu" class="btn btn-primary" />
						</td>
						<td class="td_right">
							<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=gallery&a=man'" class="btn btn-primary" />
						</td>
					</tr>
				</tbody>
			</table>
		</div>
</div>
</form>
</div>
<script type="text/javascript" src="/admin/assets/pasteimage.js"></script>
<script src="/admin/js/form.js?v=<?php echo getenv('APP_VERSION'); ?>"></script>
<script>
    $(document).ready(function() {
        pasteimage('#thumb', showImage);
        $('#thumb input[name=file2_url]').on('blur', urlToImage);
    });

    function urlToImage(e) {
        const target = e.target.dataset.result;
        const url = e.target.value;
        console.log('url', url);
        if (!url || url.trim().length === 0 || url.indexOf('http') !== 0) {
            return;
        }

        const baseUrl = AppConfig && AppConfig.fileBaseUrl ? AppConfig.fileBaseUrl : '/';
        $.ajax({
            type: 'GET',
            url: baseUrl + 'admin/api.php?func=url_to_image',
            data: { url },
            contentType: 'application/json',
            success: (res) => {
                if (!res.result) {
                    alert('Lỗi tải lên hình ảnh!');
                    return;
                }

                src = res.result;
                if ($(target + ' .img-result img').length > 0) {
                    $(target + ' .img-result img').attr('src', baseUrl + 'img_data/images/' + src).attr('data-original-title', '');
                } else {
                    $(target + ' .img-result').append('<img src="' + baseUrl + 'img_data/images/' + src + '" style="max-height:150px;"/>');
                }

                $(target + ' .input-clipboard').val(src);
                e.target.value = '';
            },
            dataType: 'json'
        });
    }

    function showImage(src, target) {
        var sourceSplit = src.split("base64,");
        var sourceString = sourceSplit[1];

        const baseUrl = AppConfig && AppConfig.fileBaseUrl ? AppConfig.fileBaseUrl : '/';
        $.ajax({
            type: 'POST',
            url: baseUrl + 'admin/upload.php?image_source=1',
            data: sourceString,
            contentType: 'application/json',
            success: (res) => {
                console.log({res});
                if (!res.name) {
                    alert('Lỗi tải lên hình ảnh!');
                    return;
                }

                src = res.name;
                if ($(target + ' .img-result img').length > 0) {
                    $(target + ' .img-result img').attr('src', baseUrl + 'img_data/images/' + src).attr('data-original-title', '');
                } else {
                    $(target + ' .img-result').append('<img src="' + baseUrl + 'img_data/images/' + src + '" style="max-height:150px;"/>');
                }

                $(target + ' .input-clipboard').val(src);
            },
            dataType: 'json'
        });
    }
</script>
