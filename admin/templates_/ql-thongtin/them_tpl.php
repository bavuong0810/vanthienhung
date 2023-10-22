<?php @include "sources/editor.php" ?>
<ol class="breadcrumb">
  <li><a href="<?=URLPATH."admin" ?>"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
  <li class="active"><a href="<?=URLPATH."admin" ?>/index.php">Hiển thị</a></li>
  <li class="active"><a href="<?=URLPATH."admin" ?>/index.php?p=<?=@$_REQUEST['p']?>&a=man">Ql thông tin</a></li>
</ol>
<div class="col-xs-12">
<form name="frm" method="post" action="index.php?p=<?=@$_REQUEST['p']?>&a=save&id=<?=@$_REQUEST['id']?>&page=<?=@$_REQUEST['page']?>" enctype="multipart/form-data">

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
								<input class="input form-control  width400"  name="company_vn" value="<?php echo @$items[0]['company_vn']?>"  />
							</td>
						</tr>
						<tr>
							<td class="td_left">
								Tên công ty US:
							</td>
							<td class="td_right">
								<input class="input form-control  width400"  name="company_us" value="<?php echo @$items[0]['company_us']?>"  />
							</td>
						</tr>
						<tr>
							<td class="td_left">
								Tên công ty CH:
							</td>
							<td class="td_right">
								<input class="input form-control  width400"  name="company_ch" value="<?php echo @$items[0]['company_ch']?>"  />
							</td>
						</tr>
						<tr>
							<td class="td_left">
								Địa chỉ:
							</td>
							<td class="td_right">
								<input class="input form-control  width400"  name="address" value="<?php echo @$items[0]['address']?>"  />
							</td>
						</tr>
						<tr>
							<td class="td_left">
								Favicon:
							</td>
							<td class="td_right">
								<?php if($items[0]['favicon'] <> ''){ ?>
								<img src="../img_data/icon/<?php echo @$items[0]['favicon']?>"  width="50" alt="NO PHOTO" />
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td class="td_left">
								Icon Trình Duyệt:
							</td>
							<td class="td_right">
								<input type="file" name="file" class="input width400 form-control"/>
							</td>
						</tr>
						<tr>
							<td class="td_left">
								Icon Chia sẻ:
							</td>
							<td class="td_right">
								<?php if($items[0]['icon_share'] <> ''){ ?>
								<img src="../img_data/icon/<?php echo @$items[0]['icon_share']?>"  width="50" alt="NO PHOTO" />
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td class="td_left">
								Icon Chia sẻ:
							</td>
							<td class="td_right">
								<input type="file" name="file_2" class="input width400 form-control"/>
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
							<input class="input form-control  width400"  name="address_us" value="<?php echo @$items[0]['address_us']?>"  />
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
							<input class="input form-control  width400" name="hotline" value="<?php echo @$items[0]['hotline']?>"  />
						</td>
					</tr>

					<tr>
						<td class="td_left">
							Email
						</td>
						<td class="td_right">
							<input class="input form-control  width400"  name="email" value="<?php echo @$items[0]['email']?>"  />
						</td>
					</tr>

					<tr>
						<td class="td_left">
							Facebook:
						</td>
						<td class="td_right">
							<input class="input form-control  width400"  name="facebook" value="<?php echo @$items[0]['facebook']?>"  />
						</td>
					</tr>
					<tr>
						<td class="td_left">
							Twitter:
						</td>
						<td class="td_right">
							<input class="input form-control  width400"  name="twitter" value="<?php echo @$items[0]['twitter']?>"  />
						</td>
					</tr>
					<tr>
						<td class="td_left">
							G+:
						</td>
						<td class="td_right">
							<input class="input form-control  width400"  name="google" value="<?=$items[0]['google'] ?>"  />
						</td>
					</tr>
					<tr>
						<td class="td_left">
							Youtube:
						</td>
						<td class="td_right">
							<input class="input form-control  width400"  name="youtube" value="<?=$items[0]['youtube'] ?>"  />
						</td>
					</tr>
					<tr>
						<td class="td_left">
							Pinterest:
						</td>
						<td class="td_right">
							<input class="input form-control  width400"  name="pinterest" value="<?=$items[0]['pinterest'] ?>"  />
						</td>
					</tr>
					<tr>
						<td class="td_left">
							Instagram:
						</td>
						<td class="td_right">
							<input class="input form-control  width400"  name="instagram" value="<?=$items[0]['instagram'] ?>"  />
						</td>
					</tr>
					<tr>
						<td class="td_left">
							Iframe Map:
						</td>
						<td class="td_right">
							<textarea class="input width400 form-control"  name="map" id="map" rows="10"><?=$items[0]['map'] ?></textarea>
							
						</td>
					</tr>
					<tr>
						<td class="td_left">
							Tọa độ: 
						</td>
						<td class="td_right">
							<input class="input form-control  width400"  name="toado" value="<?=$items[0]['toado'] ?>"  />
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