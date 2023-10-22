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
		Kích thước (D x R x C) (mm):
	</td>
	<td class="td_right">
		<input class="input width400 form-control" id="mat_ban" name="mat_ban" value="<?php echo @$items[0]['mat_ban']?>"  />
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
		Xuất xứ :
	</td>
	<td class="td_right">
		<input class="input width400 form-control" id="xuat_xu" name="xuat_xu" value="<?php echo @$items[0]['xuat_xu']?>"  />
	</td>
</tr>