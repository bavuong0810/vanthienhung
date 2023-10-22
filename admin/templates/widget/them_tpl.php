<?php @include "sources/editor.php" ?>

<ol class="breadcrumb">
  <li><a href="<?=urladmin ?>"><i class="glyphicon glyphicon-home"></i> Admin</a></li>
  <li class="active"><a href="<?=urladmin ?>index.php?p=widget&a=man">Quản lý nhóm</a></li>
  <li class="active"><a href="#"><?php if(isset($_GET['id'])) echo "Sửa "; else echo "Thêm mới" ?></a></li>
</ol>
<div class="col-xs-12">
<form name="frm" method="post" action="index.php?p=widget&a=save&id=<?=@$_REQUEST['id']?>&page=<?=@$_REQUEST['page']?>" enctype="multipart/form-data">
<ul id="myTabs" class="nav nav-tabs" role="tablist">
	<li role="presentation" class="active">
		<a href="#vn_tab" id="vn-tab" role="tab" data-toggle="tab" aria-controls="vn_tab" aria-expanded="true">Thông tin chính</a>
	</li>
	<li role="presentation" class="">
		<a href="#us_tab" role="tab" id="us-tab" data-toggle="tab" aria-controls="us_tab" aria-expanded="false">Ngôn ngữ EN</a>
	</li>
	<li role="presentation" class="">
		<a href="#ch_tab" role="tab" id="us-tab" data-toggle="tab" aria-controls="ch_tab" aria-expanded="false">Ngôn ngữ CH</a>
	</li>
	<li>
		<input type="submit" value="Lưu"  class="btn btn-primary" />
		<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=widget&a=man'" class="btn btn-default" />
	</li>
</ul>

<div id="myTabContent" class="tab-content">
	<div role="tabpanel" class="tab-pane fade active in" id="vn_tab" aria-labelledby="vn_tab">
		<div class="ar_admin">
			<div class="title_thongtinchung">
				Thông tin chính
			</div>
			<table class="table table-bordered table-hover them_dt" style="border:none">
				<tbody>
					<tr>
						<td class="td_left">
							Hiển thị:
						</td>
						<td class="td_right">
							<input type="checkbox" class="chkbox" name="is_active" <?php if(isset($items[0]['is_active'])) { if(@$items[0]['is_active']==1) echo 'checked="checked"';} else echo'checked="checked"'; ?> id="is_active"><label class="lb_nut" for="is_active">Hiển thị</label>
						</td>
					</tr>
					<tr>
						<td class="td_left">
							Số thứ tự:
						</td>
						<td class="td_right">
							<input type="number" name="weight" value="<?php if(isset($items[0]['weight'])) echo $items[0]['weight']; else echo @$soluong['soluong']+1; ?>" class="input width400 form-control" style="width:60px">
						</td>
					</tr>
					<tr>
						<td class="td_left">
							Danh mục:
						</td>
						<td class="td_right">
							<select name="widget_category[]" class="form-control width400 select2" multiple>
								<?php echo $loaibv ?>
							</select>
						</td>
					</tr>
					<tr>
						<td class="td_left">
							Vị trí:
						</td>
						<td class="td_right">
							<select name="group_id" class="form-control width400 select2">
								<option>Không</option>
								<?php
								for ($i=1; $i < 8; $i++) { 
									$selected = $items[0]['group_id'] == $i ? ' selected' : '';
									echo '<option value="' . $i .'"'.$selected.'>Vị trí '.$i.'</option>';
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td class="td_left">
							Tên VN:
						</td>
						<td class="td_right">
							<input type="text" name="name_vi" value="<?php echo @$items[0]['name_vi']; ?>" class="input width400 form-control">
						</td>
					</tr>
					<tr>
						<td class="td_left">
							Nội dung (VN):
						</td>
						<td class="td_right">
							<textarea  name="content_vi" id="content_vi"><?=@$items[0]['content_vi']?></textarea>
							<?php $ckeditor->replace('content_vi'); ?>
						</td>
					</tr>
					<tr>
						<td class="td_left" style="text-align:right">
							<input type="submit" value="Lưu"  class="btn btn-primary" />
						</td>
						<td class="td_right">
							<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=widget&a=man'" class="btn btn-default" />
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div role="tabpanel" class="tab-pane fade" id="us_tab" aria-labelledby="us_tab">
		<div class="ar_admin">
			<div class="title_thongtinchung">
				Thông tin US
			</div>
			<table class="table table-bordered table-hover them_dt" style="border:none">
				<tbody>
					<tr>
						<td class="td_left">
							Tên US:
						</td>
						<td class="td_right">
							<input type="text" name="name_en" value="<?php echo @$items[0]['name_en']; ?>" class="input width400 form-control">
						</td>
					</tr>
					<tr>
						<td class="td_left">
							Nội dung (US):
						</td>
						<td class="td_right">
							<textarea  name="content_en" id="content_en"><?=@$items[0]['content_en']?></textarea>
							<?php $ckeditor->replace('content_en'); ?>
						</td>
					</tr>
					<tr>
						<td class="td_left" style="text-align:right">
							<input type="submit" value="Lưu"  class="btn btn-primary" />
						</td>
						<td class="td_right">
							<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=widget&a=man'" class="btn btn-default" />
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div role="tabpanel" class="tab-pane fade" id="ch_tab" aria-labelledby="ch_tab">
		<div class="ar_admin">
			<div class="title_thongtinchung">
				Thông tin CH
			</div>
			<table class="table table-bordered table-hover them_dt" style="border:none">
				<tbody>
					<tr>
						<td class="td_left">
							Tên CH:
						</td>
						<td class="td_right">
							<input type="text" name="name_ch" value="<?php echo @$items[0]['name_ch']; ?>" class="input width400 form-control">
						</td>
					</tr>
					<tr>
						<td class="td_left">
							Nội dung (CH):
						</td>
						<td class="td_right">
							<textarea  name="content_ch" id="content_ch"><?=@$items[0]['content_ch']?></textarea>
							<?php $ckeditor->replace('content_ch'); ?>
						</td>
					</tr>
					<tr>
						<td class="td_left" style="text-align:right">
							<input type="submit" value="Lưu"  class="btn btn-primary" />
						</td>
						<td class="td_right">
							<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=widget&a=man'" class="btn btn-default" />
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
</form>
</div>




<script>

function addText(text,target,title) {
	var str=$(text).val();
	var link=locdau(str);
	$(target).val(link);
	$(title).val(str);
}	
	

</script>

