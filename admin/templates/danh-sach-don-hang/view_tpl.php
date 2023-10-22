<ol class="breadcrumb">
  <li><a href="."><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
  <li class="active"><a href=".">Đơn hàng</a></li>
  <li class="active"><a href="index.php?p=danh-sach-don-hang&a=man">Danh sách đơn hàng</a></li>
  <li class="active"><a href="#">Thông tin đơn hàng</a></li>
</ol>
<style type="text/css" media="screen">
	.tieu_de_ad{
		font-weight: bold;
		font-size: 15px;
		margin: 5px 0;
		border: 1px solid #E2DCDC;
		width: 160px;
		padding: 5px;
		border-radius: 2px;
		color:#CE2236;
	}
</style>
<div class="col-xs-12">
<form id="form" method="post" action="index.php?p=danh-sach-don-hang&a=delete_all" role="form">
<div class="tieu_de_ad">
	Thông tin đơn hàng:
</div>
<table class="table table-bordered table-hover">
	<thead>
		<tr>
	      <th style="width:3%;">Stt</th>
	      <th style="width:8%;">Mã đơn hàng</th>
	      <th style="width:8%;">Mã sản phẩm</th>
	      <th style="width:5%;">Tác vụ</th>
	      <th style="width:30%;">Tên sản phẩm</th>
	      <th style="width:10%;">Hình ảnh</th>
	      <th style="width:8%;">Giá</th>
	      <th style="width:10%;">Khuyến mãi</th>
	      <th style="width:10%;">Số lượng</th>
	      <th style="width:10%;">Thành tiền</th>
		</tr>
	</thead>
	<tbody>
	    <?php
$tongtien = 0;
$stt = 0;for ($i = 0, $count = count($items); $i < $count; $i++) {
	$stt++;

	if ($items[$i]['promotion_price'] == 0) {
		$thanhtien = $items[$i]['price'] * $items[$i]['so_luong'];
	} else {
		$thanhtien = $items[$i]['promotion_price'] * $items[$i]['so_luong'];
	}
	$tongtien = $tongtien + $thanhtien;

	$sanpham = $d->o_fet("select * from #_sanpham where id = '" . $items[$i]['id_sp'] . "'");

	?>
		<tr>
			<td>
				<?php echo $stt ?>
			</td>
			<td><?=$items[$i]['ma_dh']?></td>
			<td><?=@$sanpham[0]['code']?></td>
			<td>
				<a target="_blank" href="/<?php echo @$sanpham[0]['alias_vi']; ?>.html" class="text-success" target="_blank"><i class="glyphicon glyphicon-eye-open"></i></a>
				&nbsp;&nbsp;&nbsp;
				<a target="_blank" href="index.php?p=san-pham&a=edit&id=<?=@$sanpham[0]['id']?>" class="text-danger" title="Sửa"><i class="glyphicon glyphicon-edit"></i></a>
			</td>
			<td>
				<a href="../san-pham/<?=@$sanpham[0]['alias_vi']?>.html" target="_blank" title="">
				<?=$sanpham[0]['name_vi']?></a>
			</td>
			<td>
				<image src="../img_data/images/<?=$sanpham[0]['image_path']?>" style="max-width:50px; max-height:50px;" />
			</td>
			<td>
				<?=$d->vnd($items[$i]['price'])?>
			</td>
			<td>
				<?=($items[$i]['promotion_price'] != 0) ? $d->vnd($items[$i]['promotion_price']) : $d->vnd($items[$i]['price']);?>
			</td>
			<td>
				<?=$items[$i]['so_luong']?>
			</td>
			<td>
				<font style="color:blue;font-weight:bold;"><?=$d->vnd($thanhtien)?></font>
			</td>
		</tr>
		<?php }?>
	</tbody>
</table>
</form>
<div style="margin: 7px 0px;">
<a class="tong_tien_ad" href="javascrip:;" style="padding: 7px 10px;border: 1px solid #ccc;border-radius: 2px;text-decoration: none;float: right;">
	<font style="font-size:15px; font-weight:bold;">Tổng tiền: <font style="color:red"><?=$d->vnd($tongtien)?></font></font>
</a>
<div style="clear:both"></div>
<div class="tieu_de_ad" style="width:180px;margin-top: -20px;">
	Thông tin khách hàng:
</div>
<table class="table table-bordered table-hover">
	<thead>
		<tr>
	      <th style="width:15%;">Họ tên KH</th>
	      <th style="width:15%;">Địa chỉ</th>
	      <th style="width:10%;">Số điện thoại</th>
	      <th style="width:10%;">Email</th>
	      <th style="width:10%;">Thời gian giao</th>

	      <th style="width:10%;">Thanh toán</th>
	      <th style="width:15%;">Yêu cầu khách hàng</th>
		</tr>
	</thead>

	<tbody>

		<tr>


			<td>
				<?=$dh[0]['ho_ten']?>
			</td>
			<td>
				<?=$dh[0]['dia_chi']?>
			</td>
			<td>
				<?=$dh[0]['dien_thoai']?>
			</td>
			<td>
				<?=$dh[0]['email']?>
			</td>
			<td>
				<?=date("d-m-Y", $dh[0]['ngay_dat_hang'])?>
			</td>

			<td>
		      	<?php
$_hinhthucthanhtoan = $d->o_sel("*", "#_hinhthucthanhtoan", "id ='" . $dh[0]['hinh_thuc_thanh_toan'] . "'");
echo $_hinhthucthanhtoan[0]['name_vi'];
?>
			</td>
			<td>
				<?=$dh[0]['loi_nhan']?>
			</td>
		</tr>

	</tbody>
</table>

<div style="clear:both;padding: 0 0 35px"></div>

<div class="tieu_de_ad" style="width:180px;margin-top: -20px;">
	Xuất hóa đơn công ty:
</div>
<table class="table table-bordered table-hover">
	
	<thead>
		<tr>
	      <th style="width:15%;">Tên công ty</th>
	      <th style="width:15%;">Địa chỉ công ty</th>
	      <th style="width:10%;">Mã số thuế</th>
		</tr>
	</thead>

	<tbody>

		<tr>
			<td>
				<?=$dh[0]['ten_cong_ty']?>
			</td>
			<td>
				<?=$dh[0]['dia_chi_cong_ty']?>
			</td>
			<td>
				<?=$dh[0]['ma_so_thue']?>
			</td>
		</tr>

	</tbody>
</table>

<a class="btn btn-primary" href="index.php?p=danh-sach-don-hang&a=man"> &lt;&lt; Trở về Đơn Hàng</a>
<a class="btn btn-success" href="index.php?p=danh-sach-don-hang&a=reply-page&id=<?php echo $dh[0]['id']; ?>"> Trả lời </a>
</div>
</div>
