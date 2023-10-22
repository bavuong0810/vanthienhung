<?php @include "sources/editor.php" ?>
<script type="text/javascript" src="public/extra/bootstrap-datepicker/bootstrap-datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="public/extra/bootstrap-datepicker/bootstrap-datepicker.css">
<ol class="breadcrumb">
  <li><a href="<?=urladmin ?>"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
   <li class="active"><a href="<?=urladmin ?>index.php">Danh mục</a></li>
  <li class="active"><a href="<?=urladmin ?>index.php?p=bai-viet&a=man">Bài viết</a></li>
  <li class="active"><a href="#"><?php if(isset($_GET['id'])) echo "Sửa "; else echo "Thêm mới" ?></a></li>
</ol>
<div class="col-xs-12">
<form name="frm" method="post" action="index.php?p=bai-viet&a=save&id=<?=@$_REQUEST['id']?>&page=<?=@$_REQUEST['page']?>&loaitin=<?=@$_GET['loaitin']?>" enctype="multipart/form-data">

<div class="ar_admin">
	<div class="title_thongtinchung">
		Thông tin chung
	</div>
	<table class="table table-bordered table-hover them_dt" style="border:none">
		<tbody>
			<?php if(isset($_GET['id'])){ ?>
			<tr>
				<td class="td_left">
					Hình ảnh:
				</td>
				<td class="td_right">
					<?php if(@$items[0]['image_path'] <> ''){ ?>
					<img src="../img_data/images/<?php echo @$items[0]['image_path']?>"  width="120" alt="NO PHOTO" />
					<?php } ?>
				</td>
			</tr>
			<?php }?>
			<tr>
				<td class="td_left">
					Hình ảnh:
				</td>
				<td class="td_right">
					<input type="file" name="file" class="input width400 form-control"/>
				</td>
			</tr>
			<!-- <tr>
				<td class="td_left">
					Hình ảnh slide:
				</td>
				<td class="td_right ">
					<div class="td_hinhanh">
					<?php 
						$hinhanh =  $d->o_fet("select * from #_baiviet_hinhanh where id_baiviet ='".$_GET['id']."'");
						foreach ($hinhanh as $val) {
					?>
					<div class="dv-img-ad">
						<img src="../img_data/images/<?php echo @$val['image_path']?>" style="width:70px;height:70px;float:left;margin-right:5px"/>
						<div><?php echo @$val['title']?></div>
						<a style="margin-top:3px; display:block; position:absolute; bottom:5px; padding-left:15px;  right: 10px;" href="javascript:xoa_anh_sp('<?=$val['id']?>','<?=$val['id_baiviet']?>')" onclick="if(!confirm('Xác nhận xóa?')) return false;  "> Xóa ảnh </a>
					</div>
					<?php } ?>
					</div>
					<div class="add_img">

					</div>
					<div style="clear:both"></div>
					<div style=""><a href="javascript:them_anh()" style="  background-color: rgb(66, 139, 202);  padding: 5px 22px;  border-radius: 3px;  color: #fff;  text-decoration: none;">Thêm ảnh</a></div>
				</td>
			</tr> -->
				
			<tr>
				<td class="td_left">
					Danh mục:
				</td>
				<td class="td_right">
					<select name="category_id" class="input width400 form-control" style="border-radius:4px">
	    				<option value="0">Chọn danh mục</option>
						<?=$loai?>
					</select>
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
		<li role="presentation" class="">
			<a href="#id_us" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Ngôn ngữ EN</a>
		</li>
		<li role="presentation" class="">
			<a href="#id_ch" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Ngôn ngữ CH</a>
		</li>
		<li role="presentation" class="">
			<a href="#id_seo" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Hỗ trợ SEO</a>
		</li>
	</ul>
	<div id="myTabContent" class="tab-content">
		<div role="tabpanel" class="tab-pane fade active in" id="id_viet" aria-labelledby="home-tab">
		<!-- //lang viet -->
		<div class="ar_admin">
		<table class="table table-bordered table-hover them_dt" style="border:none">
			<tbody>
				
				<tr>
					<td class="td_left">
						Tiêu đề:
					</td>
					<td class="td_right">
						<input class="input width400 form-control" OnkeyUp="addText(this,'#alias_vi','#title_vi')" id="name_vi" name="name_vi" value="<?php echo @$items[0]['name_vi']?>"  />
					</td>
				</tr>
				<tr>
					<td class="td_left">
						Đường dẫn:
					</td>
					<td class="td_right">
						<input class="input width400 form-control" name="alias_vi" id="alias_vi" value="<?php echo @$items[0]['alias_vi']?>"   OnkeyUp="addText(this,'#alias_vi')" />
					</td>
				</tr>


				<tr>
					<td class="td_left">
						Mô tả:
					</td>
					<td class="td_right">
						<textarea class="input width400 form-control"  style="height:80px" name="description_vi" id="description_vi"><?=@$items[0]['description_vi']?></textarea>
					</td>
				</tr>
		
				<tr>
					<td class="td_left">
						Nội dung:
					</td>
					<td class="td_right">
						<textarea  name="content_vi" id="content_vi"><?=@$items[0]['content_vi']?></textarea>
						<?php $ckeditor->replace('content_vi'); ?>
					</td>
				</tr>
			</tbody>
		</table>
		</div>
		<!-- end -->
		</div>
		<div role="tabpanel" class="tab-pane fade" id="id_us" aria-labelledby="profile-tab">
		<!-- lang us -->
		<div class="ar_admin">
		<table class="table table-bordered table-hover them_dt" style="border:none">
			<tbody>
				<tr>
					<td class="td_left">
						Tiêu đề (en):
					</td>
					<td class="td_right">
						<input class="input width400 form-control" OnkeyUp="addText(this,'#alias_en','#title_en')" id="name_en" name="name_en" value="<?php echo @$items[0]['name_en']?>"  />
					</td>
				</tr>

				<tr>
					<td class="td_left">
						Đường dẫn (en):
					</td>
					<td class="td_right">
						<input class="input width400 form-control" name="alias_en" id="alias_en" value="<?php echo @$items[0]['alias_en']?>"  OnkeyUp="addText(this,'#alias_en')"  />
					</td>
				</tr>

				<tr>
					<td class="td_left">
						Mô tả (en):
					</td>
					<td class="td_right">
						<textarea class="input width400 form-control"  style="height:80px" name="description_en" id=""><?=@$items[0]['description_en']?></textarea>
					</td>
				</tr>
				<tr>
					<td class="td_left">
						Nội dung (en):
					</td>
					<td class="td_right">
						<textarea  name="content_en" id="content_en"><?=@$items[0]['content_en']?></textarea>
						<?php $ckeditor->replace('content_en'); ?>
					</td>
				</tr>
			</tbody>
		</table>
		</div>
		<!-- end -->
		</div>
		<div role="tabpanel" class="tab-pane fade" id="id_ch" aria-labelledby="profile-tab">
		<!-- lang ch -->
		<div class="ar_admin">
		<table class="table table-bordered table-hover them_dt" style="border:none">
			<tbody>
				<tr>
					<td class="td_left">
						Tiêu đề (ja):
					</td>
					<td class="td_right">
						<input class="input width400 form-control" OnkeyUp="addText(this,'#alias_ch','#title_ch')"  id="name_ch" name="name_ch" value="<?php echo @$items[0]['name_ch']?>"  />
					</td>
				</tr>

				<tr>
					<td class="td_left">
						Đường dẫn (ja):
					</td>
					<td class="td_right">
						<input class="input width400 form-control" name="alias_ch" id="alias_ch" value="<?php echo @$items[0]['alias_ch']?>"  OnkeyUp="addText(this,'#alias_ch')"  />
					</td>
				</tr>
				<tr>
					<td class="td_left">
						Mô tả (ja):
					</td>
					<td class="td_right">
						<textarea class="input width400 form-control"  style="height:80px" name="description_ch" id=""><?=@$items[0]['description_ch']?></textarea>
					</td>
				</tr>
				<tr>
					<td class="td_left">
						Nội dung (ch):
					</td>
					<td class="td_right">
						<textarea  name="content_ch" id="content_ch"><?=@$items[0]['content_ch']?></textarea>
						<?php $ckeditor->replace('content_ch'); ?>
					</td>
				</tr>
			</tbody>
		</table>
		</div>
		<!-- end -->
		</div>
		<div role="tabpanel" class="tab-pane fade" id="id_seo" aria-labelledby="profile-tab">
		<!-- /seo -->
		<div class="ar_admin">
		<table class="table table-bordered table-hover them_dt" style="border:none">
			<tbody>
				<tr>
					<td class="td_left">
						Title:
					</td>
					<td class="td_right">
						<input class="input width400 form-control" autocomplete="off"  type="text" name="title_vi" id="title_vi" value="<?php echo @$items[0]['title_vi']?>"  />
					</td>
				</tr>
				<!--tr>
					<td class="td_left">
						Title (en):
					</td>
					<td class="td_right">
						<input class="input width400 form-control" autocomplete="off"  type="text" name="title_en" id="title_en" value="<?php echo @$items[0]['title_en']?>"  />
					</td>
				</tr-->
				<!--tr>
					<td class="td_left">
						Title (ja):
					</td>
					<td class="td_right">
						<input class="input width400 form-control" autocomplete="off"  type="text" name="title_ch" id="title_ch" value="<?php echo @$items[0]['title_ch']?>"  />
					</td>
				</tr-->
				<tr>
					<td class="td_left">
						Keyword:
					</td>
					<td class="td_right">
						<textarea class="input width400 form-control"  style="height:70px" name="keyword" id="keyword"><?=@$items[0]['keyword']?></textarea>
					</td>
				</tr>
				<!-- <tr>
					<td class="td_left">
						Tags:
					</td>
					<td class="td_right">
						<textarea class="input width400 form-control" OnkeyUp="kiemtrachuoi_tags(this)" style="height:70px" name="tags_hienthi" id="tags_hienthi" placeholder="Các tags cách nhau bởi dấu , Ví dụ: tags1, tags2, tags3..."><?=@$items[0]['tags_hienthi']; ?></textarea>
						<font class="f_cha" style="margin-top: 3px;display: block;">Số kí tự: <font class="f_con">0</font>/160 kí tự</font>
					</td>
				</tr> -->
				<tr>
					<td class="td_left">
						Description:
					</td>
					<td class="td_right">
						<textarea class="input width400 form-control"  style="height:70px" name="des" id="des"><?=@$items[0]['des']?></textarea>
					</td>
				</tr>
			</tbody>
		</table>
		</div>
		<!-- end -->
		</div>
		<div class="ar_admin last">
			<table class="table table-bordered table-hover them_dt" style="border:none">
				<tbody>
				<tr>
					<td class="td_left">
						Hẹn ngày đăng: 
					</td>
					<td class="td_right">
						<?php if($items[0]['hen_ngay']!= ''){ ?>
							<input type="text" name="hen_ngay" class="input width400 width150 form-control datepicker" value="<?=date('d-m-Y', strtotime($items[0]['hen_ngay']))?>">
						<?php } else { ?>
							<input type="text" name="hen_ngay" class="input width400 width150 form-control datepicker" value="<?=date('d-m-Y',time())?>">
						<?php } ?>
						<select class="input width400 form-control sl-gio" name="hen_gio">
							<option value="0">Chọn giờ</option>
							<?php for ($i=1;$i<=24;$i++) { ?>
								<option value="<?=$i?>" <?=$i==$items[0]['hen_gio']?'selected':''?>><?=$i?></option>
							<?php } ?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="td_left">
						Tác vụ: 
					</td>
					<td class="td_right">
						<!-- <input type="checkbox" class="chkbox" name="noi_bat" <?php if(isset($items[0]['noi_bat'])) { if(@$items[0]['noi_bat']==1) echo 'checked="checked"';else echo'';	}?> id="noi_bat"><label class="lb_nut" for="noi_bat">Tiêu biểu</label>  -->
						<input type="checkbox" class="chkbox" name="hien_thi" <?php if(isset($items[0]['hien_thi'])) { if(@$items[0]['hien_thi']==1) echo 'checked="checked"';} else echo'checked="checked"'; ?> id="hien_thi"><label class="lb_nut" for="hien_thi">Hiển thị</label>
					</td>
				</tr>
				<tr>
					<td class="td_left" style="text-align:right">
					</td>
					<td class="td_right">
						<div class="luu">
							<input type="submit" value="Lưu"  class="btn btn-primary" />
						</div>
						<div class="luu thoat">
							<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=bai-viet&a=man'" class="btn btn-primary" />
						</div>
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

	function xoa_anh_sp(id,idsp){
		$.ajax({
		  url: "./sources/ajax_xoaanh_bv.php",
		  type:'POST',
		  data:"id="+id+"&idsp="+idsp,
		  success: function(data){
			  $(".td_hinhanh").html(data);
		  }
		})
	}

	var fs_img = 0;
	function them_anh(){
		fs_img++;
		if(fs_img < 16){
			$(".add_img").append('<div class="dv-img-ad hide_js_'+fs_img+'"><input type="hidden" name="txt_up_'+fs_img+'" class="txt_up_'+fs_img+'"  value="1"><input type="file" name="file_'+fs_img+'"><input type="text" name="title'+fs_img+'" placeholder="Tên sản phẩm" style="margin-top:5px;"/><a class="delete-img" href="javascript:;" onclick="xoa_anh_up(\''+fs_img+'\')"> Xóa </a></div>');
		}else{
			alert("Mỗi lần up tối đa 15 ảnh.");
		}
	}

	function xoa_anh_up(id){
		$(".hide_js_"+id).hide();
		$(".txt_up_"+id).val("0");

	}	
	
	jQuery(document).ready(function($) {
		$('.datepicker').datepicker({
			format: 'dd-mm-yyyy'
		});
	});
</script>
<style type="text/css">
	.luu{ float: left; }
	.luu input{ margin-left: 0; margin-right: 10px; }
	.width150{ width: 150px; float: left;margin-right: 10px; }
	.sl-gio{ float: left; width: 150px; }
</style>