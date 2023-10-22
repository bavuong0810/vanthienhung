<?php @include "sources/editor.php" ?>
<ol class="breadcrumb">
  <li><a href="<?=urladmin ?>"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
   <li class="active"><a href="<?=urladmin ?>index.php">Cấu hình</a></li>
  <li class="active"><a href="<?=urladmin ?>index.php?p=extra1&a=man"> Nhà sản xuất</a></li>
  <li class="active"><a href="#"><?php if(isset($_GET['id'])) echo "Sửa"; else echo "Thêm mới" ?></a></li>
</ol>
<div class="col-xs-12">
<form name="frm" method="post" action="index.php?p=extra1&a=save&id=<?=@$_REQUEST['id']?>&page=<?=@$_REQUEST['page']?>" enctype="multipart/form-data">
<div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
	<ul id="myTabs" class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active">
<a href="#id_viet" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Ngôn ngữ Việt Nam</a>
		</li>
		<li role="presentation" class="">
			<a href="#id_us" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Ngôn ngữ US</a>
		</li>

	</ul>
	<div id="myTabContent" class="tab-content">
		<div role="tabpanel" class="tab-pane fade active in" id="id_viet" aria-labelledby="home-tab">
		<!-- //lang viet -->
		<table class="table table-bordered table-hover them_dt" style="border:none">
			<tbody>
				
				<tr>
					<td class="td_left">
						Tên:
					</td>
					<td class="td_right">
						<input class="input width400 form-control" id="title_vi" name="title_vi" value="<?php echo @$items[0]['title_vi']?>"  />
					</td>
				</tr>
                
               <!--  <tr>
					<td class="td_left">
						Giá:
					</td>
						<td class="td_right">
							<input class="input width400 form-control" autocomplete="off" OnkeyUp="gia_promotion_price(this,'#gia_km')" type="text" name="price" id="price" value="<?php echo @$items[0]['price']?>"  />
							<font id="gia_km"><p style="margin-top:5px;color:red"><?php if(!empty($items[0]['price'])) echo $d->vnd($items[0]['price']) ?></p></font>
						</td>
				</tr>
				 -->
				
				<tr>
					<td class="td_left">
						Số thứ tự:
					</td>
					<td class="td_right">
						<input type="text" name="stt" value="<?php if(isset($items[0]['stt'])) echo $items[0]['stt']; else echo @count($soluong)+1; ?>" class="input width400 form-control" style="width:60px">
					</td>
				</tr>
				<tr>
					<td class="td_left">
						Tác vụ: 
					</td>
					<td class="td_right">

						<input type="checkbox" class="chkbox" name="hide" <?php if(isset($items[0]['hide'])) { if(@$items[0]['hide']==1) echo 'checked="checked"';} else echo'checked="checked"'; ?> id="hide"><label class="lb_nut" for="hide">Hiển thị</label>
					</td>
				</tr>
				<tr>
					<td class="td_left" style="text-align:right">
						<input type="submit" value="Lưu" class="btn btn-primary" />
					</td>
					<td class="td_right">
						<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=extra1&a=man'" class="btn btn-primary" />
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
						Tên (us):
					</td>
					<td class="td_right">
						<input class="input width400 form-control" id="title_en" name="title_en" value="<?php echo @$items[0]['title_en']?>"  />
					</td>
				</tr>

				
				<tr>
					<td class="td_left" style="text-align:right">
						<input type="submit" value="Lưu" class="btn btn-primary" />
					</td>
					<td class="td_right">
						<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=extra1&a=man'" class="btn btn-primary" />
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
<script>

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