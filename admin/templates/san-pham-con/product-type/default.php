<tr>
	<td class="td_left">
		Part Number , S/N :
	</td>
	<td class="td_right">
		<input class="input width400 form-control" id="part_number" name="part_number" value="<?php echo @$items[0]['part_number']?>"  />
	</td>
</tr>
<tr>
	<td class="td_left">
		Giá :
	</td>
	<td class="td_right">
		<input class="input width400 form-control" autocomplete="off" OnkeyUp="gia_promotion_price(this,'#gia_km')" type="text" name="price" id="price" value="<?php echo @$items[0]['price']?>"  />
		<font id="gia_km"><p style="margin-top:5px;color:red"><?php if(!empty($items[0]['price'])) echo $d->vnd($items[0]['price']) ?></p></font>
	</td>
</tr>
<tr>
	<td class="td_left">
		Giá khuyến mãi  :
	</td>
	<td class="td_right">
		<input class="input width400 form-control" autocomplete="off" OnkeyUp="gia_promotion_price(this,'#km')" type
		    ="text" name="promotion_price" id="promotion_price" value="<?php echo @$items[0]['promotion_price']?>"  />
		<font id="km"><p style="margin-top:5px;color:red"><?php 
		    if(!empty($items[0]['promotion_price'])) echo $d->vnd     ($items[0]['promotion_price']) ?></p></font>
	</td>
</tr>
<tr>
	<td class="td_left">
		Tải trọng nâng :
	</td>
	<td class="td_right">
		<input class="input width400 form-control" autocomplete="off" type="text" name="tai_trong_nang" id="tai_trong_nang" value="<?php echo @$items[0]['tai_trong_nang']?>"  />
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
		Loại Động cơ , bình điện :
	</td>
	<td class="td_right">
		<input class="input width400 form-control" id="loai" name="loai" value="<?php echo @$items[0]['loai']?>"  />
	</td>
</tr>
<tr>
	<td class="td_left">
		Trọng lượng ( kg ) :
	</td>
	<td class="td_right">
		<input class="input width400 form-control" id="weight" name="weight" value="<?php echo @$items[0]['weight']?>"  />
	</td>
</tr>
<tr>
	<td class="td_left">
		Chiều cao nâng (m) :
	</td>
	<td class="td_right">
		<input class="input width400 form-control" id="nang_cao" name="nang_cao" value="<?php echo @$items[0]['nang_cao']?>"  />
	</td>
</tr>
<tr>
	<td class="td_left">
		Chiều dài càng (mm):
	</td>
	<td class="td_right">
		<input class="input width400 form-control" id="chieu_dai_cang" name="chieu_dai_cang" value="<?php echo @$items[0]['chieu_dai_cang']?>"  />
	</td>
</tr>
<tr>
	<td class="td_left">
		Chiều cao nâng thấp nhất:
	</td>
	<td class="td_right">
		<input class="input width400 form-control" id="nang_thap_nhat" name="nang_thap_nhat" value="<?php echo @$items[0]['nang_thap_nhat']?>"  />
	</td>
</tr>
<tr>
	<td class="td_left">
		Kích thước (D x R x C) (mm):
	</td>
	<td class="td_right">
		<input class="input width400 form-control" id="mat_ban" name="mat_ban" value="<?php echo @$items[0]['mat_ban']?>"  />
	</td>
</tr>
<tr>
	<td class="td_left">
		Chiều rộng xe:
	</td>
	<td class="td_right">
		<input class="input width400 form-control" id="chieu_rong" name="chieu_rong" value="<?php echo @$items[0]['chieu_rong']?>"  />
	</td>
</tr>
<tr>
	<td class="td_left">
		Bảo hành:
	</td>
	<td class="td_right">
		<input class="input width400 form-control" id="bao_hanh" name="bao_hanh" value="<?php echo @$items[0]['bao_hanh']?>"  />
	</td>
</tr>
<tr>
	<td class="td_left">
		Tình trạng hàng hóa (%) :
	</td>
	<td class="td_right">
		<input class="input width400 form-control" id="khung_nang" name="khung_nang" value="<?php echo @$items[0]['khung_nang']?>"  />
	</td>
</tr>
<tr>
	<td class="td_left">
		Năm sản xuất :
	</td>
	<td class="td_right">
		<input class="input width400 form-control" id="mfg_year" name="mfg_year" value="<?php echo @$items[0]['mfg_year']?>"  />
	</td>
</tr>
<tr>
	<td class="td_left">
		Giờ sử dụng (h) :
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
		Bánh xe trước :
	</td>
	<td class="td_right">
		<input class="input width400 form-control" id="tinh_trang_hang" name="tinh_trang_hang" value="<?php echo @$items[0]['tinh_trang_hang']?>"  />
	</td>
</tr>
<tr>
	<td class="td_left">
		Bánh xe sau :
	</td>
	<td class="td_right">
		<input class="input width400 form-control" id="banh_sau" name="banh_sau" value="<?php echo @$items[0]['banh_sau']?>"  />
	</td>
</tr>