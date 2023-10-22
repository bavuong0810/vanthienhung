<?php @include "sources/editor.php" ?>
<?php

	$nhacungcap = $d->o_fet("select * from #_extra where type = 0 order by stt asc");
	$nhasanxuat = $d->o_fet("select * from #_extra where type = 1 order by stt asc");
?>
<ol class="breadcrumb">
  <li><a href="<?=urladmin ?>"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
   <li class="active"><a href="<?=urladmin ?>index.php">Danh mục</a></li>
  <li class="active"><a href="<?=urladmin ?>index.php?p=san-pham&a=man">Sản phẩm</a></li>
  <li class="active"><a href="#"><?php if(isset($_GET['id'])) echo "Sửa"; else echo "Thêm mới" ?></a></li>
</ol>
<div class="col-xs-12">
<form name="CHm" method="post" action="index.php?p=san-pham&a=save&id=<?=@$_REQUEST['id']?>&page=<?=@$_REQUEST['page']?>" enctype="multipart/form-data">


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
					<?php if($items[0]['image_path'] <> ''){ ?>
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
					<input type="file" name="file2" class="input width400 form-control"/>
				</td>
			</tr>
			<tr>
				<td class="td_left">
					Hình ảnh slide:
				</td>
				<td class="td_right ">
					<div class="td_hinhanh">
					<?php 
						$hinhanh =  $d->o_fet("select * FROM #_sanpham_hinhanh where id_sp ='".$_GET['id']."'");
						foreach ($hinhanh as $val) {
					?>
					<div class="dv-img-ad">
						<div class="img_addimage">
							<img src="../img_data/images/<?php echo @$val['image_path']?>">
						</div>
						<div class="icon_deleteimage">
							<a href="javascript:xoa_anh_sp('<?=$val['id']?>','<?=$val['id_sp']?>')" onclick="if(!confirm('Xác nhận xóa?')) return false;  "><img src="public/images/delete.png" alt="Delete"></a>
						</div>
						<div class="name_addimg"><?php echo @$val['title']?></div>
					</div>
					<?php } ?>
					</div>
					<div class="add_img">

					</div>
					<div style="clear:both"></div>
					<div style=""><a href="javascript:them_anh()" style="  background-color: rgb(66, 139, 202);  padding: 5px 22px;  border-radius: 3px;  color: #fff;  text-decoration: none;">Thêm ảnh</a></div>
				</td>
			</tr>
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
			<tr>
				<td class="td_left">
					Mã sản phẩm:
				</td>
				<td class="td_right">
					<?php if(isset($_GET['id'])){ ?>
						<input class="input width400 form-control" type="text" name="code" value="<?php echo @$items[0]['code']?>"  />
					<?php }else{ ?>
						<input class="input width400 form-control" type="text" name="code" value="<?=$d->chuoird(4); ?>"  />
					<?php } ?>
				</td>
			</tr>
			
			<tr>
				<td class="td_left">
					Giá:
				</td>
				<td class="td_right">
					<input class="input width400 form-control" autocomplete="off" OnkeyUp="gia_promotion_price(this,'#gia_km')" type="text" name="price" id="price" value="<?php echo @$items[0]['price']?>"  />
					<font id="gia_km"><p style="margin-top:5px;color:red"><?php if(!empty($items[0]['price'])) echo $d->vnd($items[0]['price']) ?></p></font>
				</td>
			</tr>			
			<tr>
				<td class="td_left">
					Khuyến mãi:
				</td>
				<td class="td_right">
					<input class="input width400 form-control" autocomplete="off" OnkeyUp="gia_promotion_price(this,'#km')" type="text" name="promotion_price" id="promotion_price" value="<?php echo @$items[0]['promotion_price']?>"  />
					<font id="km"><p style="margin-top:5px;color:red"><?php if(!empty($items[0]['promotion_price'])) echo $d->vnd($items[0]['promotion_price']) ?></p></font>
				</td>
			</tr>
			<tr>
				<td class="td_left">
					Quy cách :
				</td>
				<td class="td_right">
					<input class="input width400 form-control" id="specification" name="specification" value="<?php echo @$items[0]['specification']?>"  />
				</td>
			</tr>
			<tr>
				<td class="td_left">
					Model :
				</td>
				<td class="td_right">
					<input class="input width400 form-control" id="model" name="model" value="<?php echo @$items[0]['model']?>"  />
				</td>
			</tr>
			<tr>
				<td class="td_left">
					Brand :
				</td>
				<td class="td_right">
					<input class="input width400 form-control" id="brand" name="brand" value="<?php echo @$items[0]['brand']?>"  />
				</td>
			</tr>
			<tr>
				<td class="td_left">
					Loại :
				</td>
				<td class="td_right">
					<input class="input width400 form-control" id="loai" name="loai" value="<?php echo @$items[0]['loai']?>"  />
				</td>
			</tr>
			<tr>
				<td class="td_left">
					Tải trọng :
				</td>
				<td class="td_right">
					<input class="input width400 form-control" id="weight" name="weight" value="<?php echo @$items[0]['weight']?>"  />
				</td>
			</tr>
			<tr>
				<td class="td_left">
					Nâng cao :
				</td>
				<td class="td_right">
					<input class="input width400 form-control" id="nang_cao" name="nang_cao" value="<?php echo @$items[0]['nang_cao']?>"  />
				</td>
			</tr>
			<tr>
				<td class="td_left">
					Khung nâng :
				</td>
				<td class="td_right">
					<input class="input width400 form-control" id="khung_nang" name="khung_nang" value="<?php echo @$items[0]['khung_nang']?>"  />
				</td>
			</tr>
			<tr>
				<td class="td_left">
					Năm :
				</td>
				<td class="td_right">
					<input class="input width400 form-control" id="mfg_year" name="mfg_year" value="<?php echo @$items[0]['mfg_year']?>"  />
				</td>
			</tr>
			<tr>
				<td class="td_left">
					Giờ sử dụng :
				</td>
				<td class="td_right">
					<input class="input width400 form-control" id="gio_su_dung" name="gio_su_dung" value="<?php echo @$items[0]['gio_su_dung']?>"  />
				</td>
			</tr>
			<tr>
				<td class="td_left">
					Xuất xứ :
				</td>
				<td class="td_right">
					<input class="input width400 form-control" id="xuat_xu" name="xuat_xu" value="<?php echo @$items[0]['xuat_xu']?>"  />
				</td>
			</tr>
			<tr>
				<td class="td_left">
					Part Number :
				</td>
				<td class="td_right">
					<input class="input width400 form-control" id="part_number" name="part_number" value="<?php echo @$items[0]['part_number']?>"  />
				</td>
			</tr>
		</tbody>
	</table>
</div>
<div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
	<ul id="myTabs" class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active">
			<a href="#id_viet" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Ngôn ngữ VN </a>
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
							Tiêu đề :
						</td>
						<td class="td_right">
							<input class="input width400 form-control" OnkeyUp="addText(this,'#alias_vi','#title_vi')"  id="name_vi" name="name_vi" value="<?php echo @$items[0]['name_vi']?>"  />
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
							<textarea class="input width400 form-control" style="height:80px" name="description_vi" id="description_vi"><?=@$items[0]['description_vi']?></textarea>
						</td>
					</tr>

		
					<tr>
						<td class="td_left">
							Thông tin nội dung:
						</td>
						<td class="td_right">
							<textarea  name="description_2" id="description_2"><?=@$items[0]['description_2']?></textarea>
							<?php $ckeditor->replace('description_2'); ?>
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
							<textarea  class="input width400 form-control" style="height:80px" name="description_en" id="description_en"><?=@$items[0]['description_en']?></textarea>
						</td>
					</tr>
				
					
					<tr>
						<td class="td_left">
							Nội dung chi tiết (en):
						</td>
						<td class="td_right">
							<textarea  name="content_en" id="content_en"><?=@$items[0]['content_en']?></textarea>
							<?php $ckeditor->replace('content_en'); ?>
						</td>
					</tr>
				</tbody>
			</table>
		<!-- end -->
		</div>
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
							<input class="input width400 form-control"OnkeyUp="addText(this,'#alias_ch','#alias_ch')" id="name_ch" name="name_ch" value="<?php echo @$items[0]['name_ch']?>"  />
						</td>
					</tr>

					<tr>
						<td class="td_left">
							Đường dẫn (ja):
						</td>
						<td class="td_right">
							<input class="input width400 form-control" name="alias_ch" id="alias_ch" value="<?php echo @$items[0]['alias_ch']?>" OnkeyUp="addText(this,'#alias_ch')"  />
						</td>
					</tr>

					<tr>
						<td class="td_left">
							Mô tả (ja):
						</td>
						<td class="td_right">
							<textarea  class="input width400 form-control" style="height:80px" name="description_ch" id="description_ch"><?=@$items[0]['description_ch']?></textarea>
						</td>
					</tr>
				
					
					<tr>
						<td class="td_left">
							Nội dung chi tiết (ja):
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
		<!-- end -->
		</div>
		</div>


		<div class="ar_admin last">
			<table class="table table-bordered table-hover tv them_dt" style="border:none">
				<tbody>
					<tr>
						<td class="td_left tv">
							Tác vụ: 
						</td>
						<td class="td_right">
							<input type="checkbox" class="chkbox" name="sp_hot" <?php if(isset($items[0]['sp_hot'])) { if(@$items[0]['sp_hot']==1) echo 'checked="checked"';else echo'';	}?> id="sp_hot"><label class="lb_nut" for="sp_hot">Home</label> 

							<!-- <input type="checkbox" class="chkbox" name="sp_moi" <?php if(isset($items[0]['sp_moi'])) { if(@$items[0]['sp_moi']==1) echo 'checked="checked"';else echo'';	}?> id="sp_moi"><label class="lb_nut" for="sp_moi">Nổi bật</label> -->
							<input type="checkbox" class="chkbox" name="is_hot" <?php if(isset($items[0]['is_hot'])) { if(@$items[0]['is_hot']==1) echo 'checked="checked"';else echo'';	}?> id="is_hot"><label class="lb_nut" for="is_hot">SP Tiêu biểu</label>
							<input type="checkbox" class="chkbox" name="hien_thi" <?php if(isset($items[0]['hien_thi'])) { if(@$items[0]['hien_thi']==1) echo 'checked="checked"';} else echo'checked="checked"'; ?> id="hien_thi"><label class="lb_nut" for="hien_thi">Hiển thị</label>
						</td>
					</tr>
					<div class="clear"></div>
					<tr>
						<td class="td_left tv" style="text-align:right">
						</td>
						<td class="td_right">
							<input type="submit" value="Lưu" class="btn btn-primary"/>
							<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=san-pham&a=man'" class="btn btn-primary" />
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
		  url: "./sources/ajax_xoaanh_sp.php",
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
			$(".add_img").append('<div class="dv-img-ad hide_js_'+fs_img+'"><input type="hidden" name="txt_up_'+fs_img+'" class="txt_up_'+fs_img+'"  value="1"><input type="file" class="file_img" name="file_'+fs_img+'"><input type="text" name="title'+fs_img+'" placeholder="Tên sản phẩm" style="margin-top:5px;"/><a class="delete-img" href="javascript:;" onclick="xoa_anh_up(\''+fs_img+'\')"> Xóa </a></div>');
		}else{
			alert("Mỗi lần up tối đa 15 ảnh.");
		}
	}

	function xoa_anh_up(id){
		$(".hide_js_"+id).hide();
		$(".txt_up_"+id).val("0");

	}
	function gia_promotion_price(obj,val){
		var price = $(obj).val();
		var km = "";
		if(price == '') price = 0;
		$.ajax({
			url: "./sources/giakm.php",
			type:'POST',
			data:"price="+price+"&khuyenmai="+km,
			success: function(data){
				$(val).html(data);
			}
		})
	}
	
	
</script>

