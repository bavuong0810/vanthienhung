<?php @include "sources/editor.php" ?>

<ol class="breadcrumb">
  <li><a href="."><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
   <li class="active"><a href="index.php">Danh mục</a></li>
  <li class="active"><a href="index.php?p=map&a=man">Map</a></li>
  <li class="active"><a href="#"><?php if(isset($_GET['id'])) echo "Sửa bản đồ"; else echo "Thêm bản đồ" ?></a></li>
</ol>
<div class="col-xs-12">
<form name="frm" method="post" action="index.php?p=map&a=save&id=<?=@$_REQUEST['id']?>&page=<?=@$_REQUEST['page']?>" enctype="multipart/form-data">
<div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
	<ul id="myTabs" class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active">
			<a href="#id_viet" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Ngôn ngữ Việt Nam</a>
		</li>
		<!--li role="presentation" class="">
			<a href="#id_us" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Ngôn ngữ US</a>
		</li>
		<li role="presentation" class="">
			<a href="#id_ch" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Ngôn ngữ Chinese</a>
		</li-->

	</ul>
	<div id="myTabContent" class="tab-content">
		<div role="tabpanel" class="tab-pane fade active in" id="id_viet" aria-labelledby="home-tab">
		<!-- //lang viet -->
		<table class="table table-bordered table-hover them_dt" style="border:none">
			<tbody>
				
				<tr>
					<td class="td_left">
						Tọa độ Map:
					</td>
					<td class="td_right">
						<input class="input width400 form-control" type="text" name="map" value="<?php echo $items[0]['map']?>"  />
					</td>
				</tr>
				
				<tr>
					<td class="td_left">
						Tên (vn):
					</td>
					<td class="td_right">
						<input class="input width400 form-control" type="text" name="name_vi" value="<?php echo $items[0]['name_vi']?>"  />
					</td>
				</tr>

				
				<tr>
					<td class="td_left">
						Mô tả (vn):
					</td>
					<td class="td_right">
						<textarea class="input width400 form-control" style="height:80px" name="description_vi" id="description_vi"><?=@$items[0]['description_vi']?></textarea>
						<?php $ckeditor->replace('description_vi'); ?>
					</td>
				</tr>
				
				<tr>
					<td class="td_left">
						Nội dung (vn):
					</td>
					<td class="td_right">
						<textarea class="input width400 form-control" style="height:80px" name="content_vi" id="content_vi"><?=@$items[0]['content_vi']?></textarea>
						<?php $ckeditor->replace('content_vi'); ?>
					</td>
				</tr>
					
				<tr>
					<td class="td_left">
						Số thứ tự
					</td>
					<td class="td_right">
						<input type="text" name="so_thu_tu" value="<?php if(isset($items[0]['so_thu_tu'])) echo $items[0]['so_thu_tu']; else echo @count($soluong)+1; ?>" class="input width400 form-control" style="width:60px">
					</td>
				</tr>
				
				<tr>
					<td class="td_left">
						Hiển thị:
					</td>
					<td class="td_right">
						<input type="checkbox" class="chkbox" name="hien_thi" <?php if(isset($items[0]['hien_thi'])){	if(@$items[0]['hien_thi']==1) echo 'checked="checked"';	else echo'';}else echo 'checked="checked"';	?>>
					</td>
				</tr>
				<tr>
					<td class="td_left" style="text-align:right">
						<input type="submit" value="Lưu" class="btn btn-primary" />
					</td>
					<td class="td_right">
						<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=map&a=man'" class="btn btn-primary" />
					</td>
				</tr>
			</tbody>
		</table>
		<!-- end -->
		</div>

		<div role="tabpanel" class="tab-pane fade" id="id_us" aria-labelledby="home-tab">
		<!-- //lang us -->
		<table class="table table-bordered table-hover them_dt" style="border:none">
			<tbody>
				
				<tr>
					<td class="td_left">
						Tên (us):
					</td>
					<td class="td_right">
						<input class="input width400 form-control" type="text" name="name_en" value="<?php echo $items[0]['name_en']?>"  />
					</td>
				</tr>
				
				<tr>
					<td class="td_left">
						Mô tả (us):
					</td>
					<td class="td_right">
						<textarea class="input width400 form-control" style="height:80px" name="description_en" id="description_en"><?=@$items[0]['description_en']?></textarea>
						<?php $ckeditor->replace('description_en'); ?>
					</td>
				</tr>

				<tr>
					<td class="td_left">
						Nội dung (us):
					</td>
					<td class="td_right">
						<textarea class="input width400 form-control" style="height:80px" name="content_en" id="content_en"><?=@$items[0]['content_en']?></textarea>
						<?php $ckeditor->replace('content_en'); ?>
					</td>
				</tr>

				<tr>
					<td class="td_left" style="text-align:right">
						<input type="submit" value="Lưu" class="btn btn-primary" />
					</td>
					<td class="td_right">
						<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=map&a=man'" class="btn btn-primary" />
					</td>
				</tr>
			</tbody>
		</table>
		<!-- end -->
		</div>
		

		<div role="tabpanel" class="tab-pane fade" id="id_ch" aria-labelledby="home-tab">
		<!-- //lang us -->
		<table class="table table-bordered table-hover them_dt" style="border:none">
			<tbody>
				
				<tr>
					<td class="td_left">
						Tên (ch):
					</td>
					<td class="td_right">
						<input class="input width400 form-control" type="text" name="name_ch" value="<?php echo $items[0]['name_ch']?>"  />
					</td>
				</tr>

				<tr>
					<td class="td_left">
						Mô tả (ch):
					</td>
					<td class="td_right">
						<textarea class="input width400 form-control" style="height:80px" name="description_ch" id="description_ch"><?=@$items[0]['description_ch']?></textarea>
						<?php $ckeditor->replace('description_ch'); ?>
					</td>
				</tr>
				
				<tr>
					<td class="td_left">
						Nội dung (ch):
					</td>
					<td class="td_right">
						<textarea class="input width400 form-control" style="height:80px" name="content_ch" id="content_ch"><?=@$items[0]['content_ch']?></textarea>
						<?php $ckeditor->replace('content_ch'); ?>
					</td>
				</tr>

				<tr>
					<td class="td_left" style="text-align:right">
						<input type="submit" value="Lưu" class="btn btn-primary" />
					</td>
					<td class="td_right">
						<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=map&a=man'" class="btn btn-primary" />
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