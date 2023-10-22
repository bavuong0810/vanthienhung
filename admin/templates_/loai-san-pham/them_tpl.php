<?php @include "sources/editor.php" ?>
<ol class="breadcrumb">
  <li><a href="<?=urladmin ?>"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
   <li class="active"><a href="<?=urladmin ?>index.php">Danh mục</a></li>
  <li class="active"><a href="<?=urladmin ?>index.php?p=loai-san-pham&a=man">Loại sản phẩm</a></li>
  <li class="active"><a href="#"><?php if(isset($_GET['id'])) echo "Sửa "; else echo "Thêm mới" ?></a></li>
</ol>
<div class="col-xs-12">
<form name="frm" method="post" action="index.php?p=loai-san-pham&a=save&id=<?=@$_REQUEST['id']?>&page=<?=@$_REQUEST['page']?>" enctype="multipart/form-data">
	
<div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
	<ul id="myTabs" class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active">
			<a href="#id_viet" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Ngôn ngữ Việt Nam</a>
		</li>
		<!--li role="presentation" class="">
			<a href="#id_us" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Ngôn ngữ US</a>
		</li-->
		<li role="presentation" class="">
			<a href="#id_seo" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Hỗ trợ SEO</a>
		</li>
	</ul>
	<div id="myTabContent" class="tab-content">
		<div role="tabpanel" class="tab-pane fade active in" id="id_viet" aria-labelledby="home-tab">
		<!-- //lang viet -->
		<table class="table table-bordered table-hover them_dt" style="border:none">
			<tbody>
			<?php if(isset($_GET['id'])){ ?>
				<!-- <tr>
					<td class="td_left">
						Hình ảnh:
					</td>
					<td class="td_right">
						<?php if($items[0]['image_path'] <> ''){ ?>
						<img src="../img_data/images/<?php echo @$items[0]['image_path']?>"  width="120" alt="NO PHOTO" />
						<?php } ?>
					</td>
				</tr> -->
				<?php }?>
				<!-- <tr>
					<td class="td_left">
						Hình ảnh:
					</td>
					<td class="td_right">
						<input type="file" name="file" class="input width400 form-control"/>
					</td>
				</tr> -->
				<tr>
					<td class="td_left">
						Danh mục:
					</td>
					<td class="td_right">
						<select name="category_id" class="input width400 form-control" style="border-radius:4px">
		    				<option value="0">Chọn làm mục cha</option>
		    				<?php if(count($loaibv)>0){foreach ($loaibv as $lsp) {
		    				?>
						    	<option value="<?php echo $lsp['id'] ?>" <?php if($lsp['id'] == $items[0]['category_id']) echo "selected"; ?>>-- <?php echo $lsp['name_vi'] ?></option>
						    	<?php
						    		$sp_child1 = $d->o_fet("select * from #_loaisanpham where category_id = '".$lsp['id']."' order by so_thu_tu asc");
						    		if(count($sp_child1)>0){foreach ($sp_child1 as $lsp1) {
						    	?>
								<option  value="<?php echo $lsp1['id'] ?>" <?php if($lsp1['id'] == $items[0]['category_id']) echo "selected"; ?>>&nbsp;&nbsp;&nbsp;&nbsp;|____ <?php echo $lsp1['name_vi'] ?></option>
								    	<?php
								    		$sp_child2 = $d->o_fet("select * from #_loaisanpham where category_id = '".$lsp1['id']."' order by so_thu_tu asc");
								    		 if(count($sp_child2)>0){foreach ($sp_child2 as $lsp2) {
								    	?>
										<option disabled="disabled" value="<?php echo $lsp2['id'] ?>" <?php if($lsp2['id'] == $items[0]['category_id']) echo "selected"; ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|____ <?php echo $lsp2['name_vi'] ?></option>
								    	<?php }} ?>
						    	<?php }} ?>
							<?php }} ?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="td_left">
						Tiêu đề (vn):
					</td>
					<td class="td_right">
						<input class="input width400 form-control" OnkeyUp="add_alias_vn(this)" onblur="kiem_tra_link_vn('<?=@$items[0]['id'] ?>')" id="name_vi" name="name_vi" value="<?php echo @$items[0]['name_vi']?>"  />
					</td>
				</tr>
				<tr>
					<td class="td_left">
						Đường dẫn (vn):
					</td>
					<td class="td_right">
						<input class="input width400 form-control" name="alias_vi" id="alias_vi" value="<?php echo @$items[0]['alias_vi']?>" onchange="kiem_tra_link_vn('<?=@$items[0]['id'] ?>')"  OnkeyUp="add_alias_vn(this)" />
						<font style="margin-top:3px; display: block;" id="warning_vn"></font>
					</td>
				</tr>

				<tr>
					<td class="td_left">
						Số thứ tự:
					</td>
					<td class="td_right">
						<input type="text" name="so_thu_tu" value="<?php if(isset($items[0]['so_thu_tu'])) echo $items[0]['so_thu_tu']; else echo @count($soluong)+1; ?>" class="input width400 form-control" style="width:60px">
					</td>
				</tr>
				<tr>
					<td class="td_left">
						Tác vụ: 
					</td>
					<td class="td_right">
						<input type="checkbox" class="chkbox" name="is_hot" <?php if(isset($items[0]['is_hot'])) { if(@$items[0]['is_hot']==1) echo 'checked="checked"';else echo'';	}?> id="is_hot"><label class="lb_nut" for="is_hot">Trang chủ</label>

						<!-- <input type="checkbox" class="chkbox" name="menu" <?php if(isset($items[0]['menu'])) { if(@$items[0]['menu']==1) echo 'checked="checked"';else echo'';	}?> id="menu_s"><label class="lb_nut" for="menu_s">Menu</label> -->

						<input type="checkbox" class="chkbox" name="hien_thi" <?php if(isset($items[0]['hien_thi'])) { if(@$items[0]['hien_thi']==1) echo 'checked="checked"';} else echo'checked="checked"'; ?> id="hien_thi"><label class="lb_nut" for="hien_thi">Hiển thị</label>
					</td>
				</tr>
				<tr>
					<td class="td_left" style="text-align:right">
						<input type="submit" value="Lưu" onclick="return kiemtra_link()" class="btn btn-primary" />
					</td>
					<td class="td_right">
						<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=loai-san-pham&a=man'" class="btn btn-primary" />
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
						Tiêu đề (us):
					</td>
					<td class="td_right">
						<input class="input width400 form-control" OnkeyUp="add_alias_us(this)" onblur="kiem_tra_link_us('<?=@$items[0]['id'] ?>')" id="name_en" name="name_en" value="<?php echo @$items[0]['name_en']?>"  />
					</td>
				</tr>

				<tr>
					<td class="td_left">
						Đường dẫn (us):
					</td>
					<td class="td_right">
						<input class="input width400 form-control" name="alias_en" id="alias_en" value="<?php echo @$items[0]['alias_en']?>" onchange="kiem_tra_link_us('<?=@$items[0]['id'] ?>')"  OnkeyUp="add_alias_us(this)"  />
						<font style="margin-top:3px; display: block;" id="warning_us"></font>
					</td>
				</tr>
				<!--  -->
				<tr>
					<td class="td_left" style="text-align:right">
						<input type="submit" value="Lưu" onclick="return kiemtra_link()" class="btn btn-primary" />
					</td>
					<td class="td_right">
						<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=loai-san-pham&a=man'" class="btn btn-primary" />
					</td>
				</tr>
			</tbody>
		</table>
		<!-- end -->
		</div>
		<div role="tabpanel" class="tab-pane fade" id="id_seo" aria-labelledby="profile-tab">
		<!-- /seo -->
			<table class="table table-bordered table-hover them_dt" style="border:none">
				<tbody>
					<tr>
						<td class="td_left">
							Title (vn):
						</td>
						<td class="td_right">
							<input class="input width400 form-control" name="title_vi" id="title_vi" value="<?php echo @$items[0]['title_vi']?>" />
						</td>
					</tr>
					<!-- <tr>
						<td class="td_left">
							Title (us):
						</td>
						<td class="td_right">
							<input class="input width400 form-control" name="title_en" id="title_en" value="<?php echo @$items[0]['title_en']?>" />
						</td>
					</tr> -->
					
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
					<tr>
						<td class="td_left" style="text-align:right">
							<input type="submit" value="Lưu" onclick="return kiemtra_link()" class="btn btn-primary" />
						</td>
						<td class="td_right">
							<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=loai-san-pham&a=man'" class="btn btn-primary" />
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
<script type="text/javascript" charset="utf-8" async defer>
var dk = <?php if(isset($_GET['id'])) echo 1;else echo 0; ?>;
var dk2 = <?php if(isset($_GET['id'])) echo 1;else echo 0; ?>;


	function add_alias_vn(obj){
		var str = $(obj).val();
		var als = locdau(str);
		$("#title_vi").val($("#name_vi").val());
		$("#keyword").val($("#name_vi").val());
		$("#des").val($("#name_vi").val());

		$("#alias_vi").val(als);
	}


	function add_alias_us(obj){
		var str = $(obj).val();
		var als = locdau(str);
		$("#title_en").val($("#name_en").val());
		$("#alias_en").val(als);

	}
	

	function kiemtra_link(){
		var id = '<?php if(!empty($_GET["id"])) echo $_GET["id"] ?>';
		duyet_link(id);
		var alias_vi = $("#alias_vi").val();
		var alias_en = $("#alias_en").val();
		if(alias_vi == ''){
			$("#alias").focus();
			return false;
		}
		// else if(alias_en == ''){
		// 	$("#alias_en").focus();
		// 	return false;
		// }
		// else if(dk == 0 || dk2 == 0){
		else if(dk == 0){
			$("#alias_vi").focus();
			return false;
		}
		else return true;
	}

	function duyet_link(id){
		kiem_tra_link_vn(id);
		// kiem_tra_link_us(id);
	}

	function kiem_tra_link_vn(id){
		var alias = $("#alias_vi").val();
		if(alias == ''){
			$("#alias_vi").focus();
		}else{
			$.ajax({
				url: "./sources/kiem_tra_alias.php",
				type:'POST',
				data:"bang=#_loaisanpham&alias_vi="+alias+"&id="+id,
				success: function(data){
					$("#alias_vi").val(data);
					dk = 1;
				}
			})
		}
		
	}
	function kiem_tra_link_us(id){
		var alias = $("#alias_en").val();
		if(alias == ''){
			alert("Chưa nhập liên kết (us).");
		}else{
			$.ajax({
				url: "./sources/kiem_tra_alias.php",
				type:'POST',
				data:"bang=#_loaisanpham&alias_en="+alias+"&id="+id,
				success: function(data){
					$("#alias_en").val(data);
					dk2 = 1;
				}
			})
		}
	}
</script>
