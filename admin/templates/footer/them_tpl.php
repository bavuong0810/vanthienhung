<?php @include "sources/editor.php" ?>
<ol class="breadcrumb">
  <li><a href="."><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
   <li class="active"><a href="index.php">Hiển thị</a></li>
  <li class="active"><a href="index.php?p=<?=@$_REQUEST['p']?>&a=man">Footer</a></li>
</ol>
<div class="col-xs-12">
<form name="frm" method="post" action="index.php?p=<?=@$_REQUEST['p']?>&a=save&id=<?=@$_REQUEST['id']?>&page=<?=@$_REQUEST['page']?>" enctype="multipart/form-data">
<div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
	<ul id="myTabs" class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active">
			<a href="#id_viet" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Ngôn ngữ Việt Nam</a>
		</li>
		<!--li role="presentation" class="">
			<a href="#id_us" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Ngôn ngữ US</a>
		</li-->
	</ul>
	<div id="myTabContent" class="tab-content">
		<div role="tabpanel" class="tab-pane fade active in" id="id_viet" aria-labelledby="home-tab">
		<!-- //lang viet -->
		<table class="table table-bordered table-hover them_dt" style="border:none">
			<tbody>
				<tr>
					<td class="td_left">
						Nội dung (vn):
					</td>
					<td class="td_right">
						<textarea  name="content_vi" id="content_vi"><?=@$items[0]['content_vi']?></textarea>
						<?php $ckeditor->replace('content_vi'); ?>
					</td>
				</tr>
				<tr>
					<td class="td_left" style="text-align:right">
						<input type="submit" value="Lưu" class="btn btn-primary" />
					</td>
					<td class="td_right">
						<input type="button" value="Thoát" onclick="javascript:window.location='index.php'" class="btn btn-primary" />
					</td>
				</tr>
			</tbody>
		</table>
		<!-- end -->
		</div>
		<div role="tabpanel" class="tab-pane fade" id="id_us" aria-labelledby="profile-tab">
		<!-- lang us -->
		<table class="table table-bordered table-hover them_dt" style="border:none">
			<tbody>
				<tr>
					<td class="td_left">
						Nội dung (us):
					</td>
					<td class="td_right">
						<textarea  name="content_en" id="content_en"><?=@$items[0]['content_en']?></textarea>
						<?php $ckeditor->replace('content_en'); ?>
					</td>
				</tr>
				<tr>
					<td class="td_left" style="text-align:right">
						<input type="submit" value="Lưu" class="btn btn-primary" />
					</td>
					<td class="td_right">
						<input type="button" value="Thoát" onclick="javascript:window.location='index.php'" class="btn btn-primary" />
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