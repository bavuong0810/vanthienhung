<?php
$mainProduct = $items[0];
?>
<link rel="stylesheet" type="text/css" href="/admin/assets/bootstrap-select-1.12.4/css/bootstrap-select.min.css">
<style type="text/css">
	.tooltip.in {
		opacity: 1 !important;
	}
	.width400 {
	    max-width: unset;
	}
	.ar_admin .row.form-group {
	    border-bottom: 1px solid #dedede;
	    margin-bottom: 0px;
	    padding: 10px 0;
	    display: -webkit-box;
	    display: -webkit-flex;
	    display: -ms-flexbox;
	    display: flex;
	    -webkit-box-align: center;
	    -webkit-align-items: center;
	    -ms-flex-align: center;
	    align-items: center;
	}
	.text-label {
		font-weight: 700;
    	color: #153FA3;
	}
	
	.inline-title{
		display: flex;
    	align-items: center;
	}
	.inline-title .lbl-title{
		width: 90px;
		display: block;
		font-style: italic;
		color: #4cae4c;
	}
</style>
<?php @include "sources/editor.php" ?>
<?php
	// $nhacungcap = $d->o_fet("select * from #_extra where type = 0 order by stt asc");
	// $nhasanxuat = $d->o_fet("select * from #_extra where type = 1 order by stt asc");
?>
<ol class="breadcrumb">
  <li><a href="<?=urladmin ?>"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
   <li class="active"><a href="<?=urladmin ?>index.php">Danh mục</a></li>
  <li class="active"><a href="<?=urladmin ?>index.php?p=san-pham&a=man">Sản phẩm</a></li>
  <li class="active"><a href="#"><?php if(isset($_GET['id'])) echo "Sửa"; else echo "Thêm mới" ?></a></li>
</ol>
<div class="col-xs-12">
<form name="CHm" method="post" action="index.php?p=san-pham&a=save&id=<?=@$_REQUEST['id']?>&page=<?=@$_REQUEST['page']?>" enctype="multipart/form-data">

<?php
if (!empty($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'p=san-pham-nhom') === false) {
	echo '<input type="hidden" name="referer" value="' . $_SERVER['HTTP_REFERER'] . '" />';
}
?>

<div class="ar_admin last fixed-bottom text-center" style="position: sticky; top: 0; bottom: auto; box-shadow: none; margin-bottom: 10px;">
	<a href="/<?php echo $items[0]['alias_vi']; ?>.html" target="_blank" class="btn btn-primary"><i class="glyphicon glyphicon-eye-open"></i></a>
	<span onclick="cloneProduct(<?php echo $items[0]['id']; ?>)" target="_blank" class="btn btn-default" title="Sao chép sản phẩm này"><i class="glyphicon glyphicon-flash text-warning"></i></span>
	<input type="submit" value="Lưu" class="btn btn-success"/>
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=san-pham&a=man'" class="btn btn-default" />
	<?php if(isset($_GET['id'])) { ?>
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="/admin/index.php?p=san-pham&a=delete&id=<?php echo $items[0]['id']; ?>" class="text-danger">Xóa</a>
	<?php } ?>
</div>

<!-- <div class="ar_admin">
	<div class="title_thongtinchung row">
		Thông tin chung

		<div class="btn-group pull-right">
		  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		    Chuyển sang <span class="caret"></span>
		  </button>
		  <ul class="dropdown-menu">
		    <li><a href="<?php echo $d->addParam('type', ''); ?>">Mặc định</a></li>
		    <li><a href="<?php echo $d->addParam('type', 'phutung'); ?>">Phụ tùng</a></li>
		    <li><a href="<?php echo $d->addParam('type', 'pallet'); ?>">Pallet</a></li>
		  </ul>
		</div>
	</div>
	
</div> -->

<?php 
$attributes = (!empty(@$items[0]['name_json']))?@$items[0]['name_json']:array();

$part_number_title = $attributes['part_number_title'];
$specification_title = $attributes['specification_title'];
$loai_title = $attributes['loai_title'];
$bao_hanh_title = $attributes['bao_hanh_title'];
$mfg_year_title = $attributes['mfg_year_title'];
$group_pos_title = $attributes['group_pos_title'];
$group_quantity_title = $attributes['group_quantity_title'];
$model_title = $attributes['model_title'];
$brand_title = $attributes['brand_title'];
?>

<div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
	<ul id="myTabs" class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active">
			<a href="#detail_tab" id="detail-tab" role="tab" data-toggle="tab" aria-controls="detail_tab" aria-expanded="true">Thông tin</a>
		</li>
		<li role="presentation">
			<a href="#id_viet" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="false">Ngôn ngữ VN </a>
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
		<li role="presentation" class="">
			<a href="#id_names" role="tab" id="names-tab" data-toggle="tab" aria-controls="names" aria-expanded="false">Tên</a>
		</li>
		<li style="margin-left: 20px">
			<input type="checkbox" class="chkbox" name="sp_hot" <?php if(isset($items[0]['sp_hot'])) { if(@$items[0]['sp_hot']==1) echo 'checked="checked"';else echo'';	}?> id="sp_hot"><label class="lb_nut" for="sp_hot">Home</label> 
			<input type="checkbox" class="chkbox" name="is_hot" <?php if(isset($items[0]['is_hot'])) { if(@$items[0]['is_hot']==1) echo 'checked="checked"';else echo'';	}?> id="is_hot"><label class="lb_nut" for="is_hot">SP Tiêu biểu</label>
			<input type="checkbox" class="chkbox" name="hien_thi" <?php if(isset($items[0]['hien_thi'])) { if(@$items[0]['hien_thi']==1) echo 'checked="checked"';} else echo'checked="checked"'; ?> id="hien_thi"><label class="lb_nut" for="hien_thi">Hiển thị</label>
			<input type="checkbox" class="chkbox" name="is_new" <?php if(isset($items[0]['is_new'])) { if(@$items[0]['is_new']==1) echo 'checked="checked"';} ?> id="is_new"><label class="lb_nut" for="is_new">Mới</label>
			<input type="checkbox" class="chkbox" name="is_warning" <?php if(isset($items[0]['is_warning'])) { if(@$items[0]['is_warning']==1) echo 'checked="checked"';} ?> id="is_warning"><label class="lb_nut" for="is_warning">Cảnh báo</label>
		</li>
	</ul>
	<div id="myTabContent" class="tab-content">
		<div role="tabpanel" class="tab-pane fade active in" id="detail_tab" aria-labelledby="detail_tab">
			<div class="ar_admin">

				<div class="form-group row">
					<div class="col-md-1 col-sm-6 text-label">
						Tiêu đề:
					</div>
					<div class="col-md-11 col-sm-6">
						<div class="row">
							<div class="col-md-9 col-sm-6">
								<input class="input width400 form-control field-need-check" data-result="check_field_name_vi" OnkeyUp="addText(this,'#alias_vi','#title_vi')"  id="name_vi" name="name_vi" value="<?php echo @$items[0]['name_vi']?>" />
							</div>
							<div class="col-md-3 col-sm-6" id="check_field_name_vi"></div>
						</div>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-1 col-sm-6 text-label">
						Đường dẫn:
					</div>
					<div class="col-md-11 col-sm-6">
						<input class="input width400 form-control" name="alias_vi" id="alias_vi" value="<?php echo @$items[0]['alias_vi']?>"   OnkeyUp="addText(this,'#alias_vi')" />
					</div>
				</div>
				<!-- Detail tab -->

				<div class="row form-group">
					<div class="col-md-1 text-label">
						Hình ảnh:
					</div>
					<div class="col-md-11" id="thumb">
						<div class="row">
							<div class="col-md-4">
								<input type="file" name="file2" class="input width400 form-control js-image-field" data-api="<?php echo getApiUploadFile(); ?>" data-result="#thumb"/>
							</div>
							<div class="col-md-2 text-label">
								Hoặc nhập link hình ảnh: 
							</div>
							<div class="col-md-4">
								<input type="text" name="file2_url" placeholder="Link hình ảnh..." class="input width400 form-control" data-result="#thumb">
							</div>
							<div>
								<input type="hidden" class="input-clipboard js-upload-result" name="file2_clipboard">
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-md-1 text-label">
								Hiện tại:
							</div>
							<div class="col-md-3 img-result">
								<?php if(isset($_GET['id'])){ ?>
								<?php if(ADMIN_IMAGE): ?>
									<?php if($items[0]['image_path'] <> ''){ 
										$title = '<img src="'.FILEURL.'img_data/images/'.$items[0]['image_path'].'" style="max-width:100%; opacity: 1">';
									?>
										<img src="<?php echo FILEURL; ?>img_data/images/<?php echo @$items[0]['image_path']?>"  width="120" alt="NO PHOTO" data-toggle="tooltip" data-html="true" data-placement="right" title="<?php echo htmlspecialchars($title) ?>" />
									<?php } ?>
								<?php else: ?>
									<?php if(@$items[0]['image_path']){?>
									<img src="<?php echo FILEURL; ?>img_data/images/<?php echo @$items[0]['image_path']?>"  width="120" alt="NO PHOTO" data-toggle="tooltip" data-html="true" data-placement="right" title="<?php echo htmlspecialchars($title) ?>" />
									<?php } else {
										echo '<span style="color:#ff0000;">Chưa có ảnh</span>';
									}?>
								<?php endif; ?>
								<?php }?>
							</div>
						</div>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-1 text-label">
						Hình ảnh slide:
					</div>
					<div class="col-md-11">
						<div class="td_hinhanh">
						<?php 
							$hinhanh =  $d->o_fet("select * FROM #_sanpham_hinhanh where id_sp ='".$_GET['id']."'");
							foreach ($hinhanh as $val) {
								$title = '<img src="'.FILEURL.'img_data/images/'.$val['image_path'].'" style="max-width:100%; opacity: 1">';
						?>
						<div class="dv-img-ad hide_js_<?=$val['id']?>" data-toggle="tooltip" data-html="true" data-placement="right" title="<?php echo htmlspecialchars($title) ?>">
							<div class="img_addimage">
                                <img src="<?php echo FILEURL; ?>img_data/images/<?php echo @$val['image_path']?>">
                                <?php /*
								<?php if (ADMIN_IMAGE): ?>
									<img src="<?php echo FILEURL; ?>img_data/images/<?php echo @$val['image_path']?>">
								<?php else: ?>
									Hình ảnh
								<?php endif; ?>
                                */?>
							</div>
							<div class="icon_deleteimage">
								<a href="javascript:xoa_anh_sp('<?=$val['id']?>','<?=$val['id_sp']?>')" data-id="<?=$val['id']?>" onclick="if(!confirm('Xác nhận xóa?')) return false;  "><img src="public/images/delete.png" alt="Delete"></a>
							</div>
							<a href="#" data-id="<?=$val['id']?>" class="toggle_image"><i class="glyphicon <?php echo $val['hien_thi'] ? ' glyphicon-eye-open' : ' glyphicon-eye-close' ?>"></i></a>
						</div>
						<?php } ?>
						</div>
						<div class="add_img">

						</div>
						<div style="clear:both"></div>
						<div style=""><a href="javascript:them_anh()" style="  background-color: rgb(66, 139, 202);  padding: 5px 22px;  border-radius: 3px;  color: #fff;  text-decoration: none;">Thêm ảnh</a></div>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-1 text-label">
						Danh mục:
					</div>
					<div class="col-md-3">
						<select name="category_id" class="input width400 form-control selectpicker" data-live-search="true" style="border-radius:4px">
		    				<option value="0">Chọn danh mục</option>
							<?=$loai?>
						</select>
					</div>
					<div class="col-md-1 text-label">
						Loại:
					</div>
					<div class="col-md-3">
						<select name="group_id" class="input width400 form-control selectpicker" data-live-search="true" style="border-radius:4px">
		    				<option value="0">Chọn nhóm</option>
							<?php foreach ($groups as $group): ?>
								<option value="<?php echo $group['id'] ?>" <?php echo @$items[0]['group_id'] == $group['id'] ? 'selected' : '' ?>><?php echo $group['name_vi'] ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="col-md-1 text-label">
						Hiệu:
					</div>
					<div class="col-md-3">
						
							<label class="inline-title" for=""><span class="lbl-title">Tiêu đề</span> <input class="input width400 form-control" id="brand_title" name="brand_title" value="<?php echo $brand_title?>"  /></label>
							<label class="inline-title" for=""><span class="lbl-title">Giá trị</span>
								<select name="brand_id" class="input width400 form-control selectpicker" data-live-search="true" style="border-radius:4px">
									<option value="0">Chọn nhãn hiệu</option>
									<?php foreach ($brands as $brand): if($brand['id']):?>
										<option value="<?php echo $brand['id'] ?>" <?php echo @$items[0]['brand_id'] == $brand['id'] ? 'selected' : '' ?>><?php echo $brand['name'] ?></option>
									<?php endif; endforeach; ?>
								</select>
							</label>
						
					</div>
					<div class="col-md-1 text-label">
						Model:
					</div>
					<div class="col-md-3">
						
							<label class="inline-title" for=""><span class="lbl-title">Tiêu đề</span> <input class="input width400 form-control" id="model_title" name="model_title" value="<?php echo $model_title?>"  /></label>
							<label class="inline-title" for=""><span class="lbl-title">Giá trị</span>
								<input class="input width400 form-control" id="model" name="model" value="<?php echo @$items[0]['model']?>"  />
							</label>
						
					</div>
				</div>
				<div class="row form-group">
					<?php if ($mainProduct['product_type'] == ProductConfigs::TYPE_PRODUCT): ?>
						<div class="col-md-1 text-label">
							SP lớn:
						</div>
						<div class="col-md-3">
							<select name="parent_number" class="input width400 form-control parent_number_select" data-live-search="true" style="border-radius:4px">
								<option value="0">Chọn sản phẩm lớn</option>
								<?php foreach ($parents as $parent) : ?>
									<option value="<?php echo $parent['parent_number'] ?>" <?php echo @$items[0]['parent_number'] == $parent['parent_number'] ? 'selected' : '' ?>>
										<?php echo $parent['parent_number'] ?>
										-
										<?php echo $parent['name_vi'] ?>
									</option>
								<?php endforeach ?>
							</select>
						</div>
					<?php endif; ?>
					<?php if ($mainProduct['product_type'] == ProductConfigs::TYPE_PRODUCT_GROUP) {
						?>
						<div class="col-md-1 text-label">
							ID nhóm:
						</div>
						<div class="col-md-3">
							<input class="input width400 form-control" id="parent_number" name="parent_number" value="<?php echo @$items[0]['parent_number']?>"  />
						</div>
						<?php
					}
					?>
				</div>
				<div class="row form-group">
					<div class="col-md-1 text-label">
						Mã SP 1:
					</div>
					<div class="col-md-3">
						<?php if(isset($_GET['id'])){ ?>
							<input class="input width400 form-control" type="text" name="code" value="<?php echo @$items[0]['code']?>"  />
						<?php }else{ ?>
							<input class="input width400 form-control" type="text" name="code" value="<?=$d->chuoird(4); ?>"  />
						<?php } ?>
					</div>
					<div class="col-md-1 text-label">
						Mã SP 2:
					</div>
					<div class="col-md-3">
						<?php if(isset($_GET['id'])){ ?>
							<input class="input width400 form-control" type="text" name="code_2" value="<?php echo @$items[0]['code_2']?>"  />
						<?php }else{ ?>
							<input class="input width400 form-control" type="text" name="code_2" value=""  />
						<?php } ?>
					</div>
				</div>
				
				<div class="row form-group">
					<div class="col-md-1 text-label">
						Giá nhập:
					</div>
					<div class="col-md-3">
						<input class="input form-control" autocomplete="off" OnkeyUp="gia_promotion_price(this,'#cost_text')" type="text" name="cost" id="cost" value="<?php echo @$items[0]['cost']?>"  />
						<font id="cost_text"><p style="margin:0px;color:red"><?php if(!empty($items[0]['cost'])) echo $d->vnd($items[0]['cost']) ?></p></font>
					</div>
					<div class="col-md-1 text-label">
						Giá:
					</div>
					<div class="col-md-3">
						<input class="input form-control" autocomplete="off" OnkeyUp="gia_promotion_price(this,'#gia_km')" type="text" name="price" id="price" value="<?php echo @$items[0]['price']?>"  />
						<font id="gia_km"><p style="margin:0px;color:red"><?php if(!empty($items[0]['price'])) echo $d->vnd($items[0]['price']) ?></p></font>
					</div>
					<div class="col-md-1 text-label">
						Giá khuyến mãi:
					</div>
					<div class="col-md-3">
						<input class="input form-control" autocomplete="off" OnkeyUp="gia_promotion_price(this,'#km')" type
						    ="text" name="promotion_price" id="promotion_price" value="<?php echo @$items[0]['promotion_price']?>"  />
						<font id="km"><p style="margin:0px;color:red"><?php 
						    if(!empty($items[0]['promotion_price'])) echo $d->vnd     ($items[0]['promotion_price']) ?></p></font>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-1 text-label">
						Đơn vị:
					</div>
					<div class="col-md-3">
						<input class="input width400 form-control" type="text" name="unit" id="unit" value="<?php echo @$items[0]['unit']?>"  />
					</div>
				</div>
                <div class="row form-group">
					<div class="col-md-1 text-label">
						Part Number:
					</div>
					<div class="col-md-9">
						<label class="inline-title" for=""><span class="lbl-title">Tiêu đề</span> <input class="input width400 form-control" id="part_number_title" name="part_number_title" value="<?php echo $part_number_title?>"  /></label>
						<label class="inline-title" for=""><span class="lbl-title">Giá trị</span><input class="input width400 form-control" id="part_number" name="part_number" value="<?php echo @$items[0]['part_number']?>"  /></label>
					</div>
					<div class="col-md-3" id="checkPartNumberResult">
						
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-1 text-label">
						Quy cách:
					</div>
					<?php 
					$specification = trim(@$items[0]['specification']);
					$specification = trim($specification);
					preg_match('|"(.*?)".*|is', $specification, $specification_matches);
					
					if( $specification_matches['1'] ){
						$specification = $specification_matches[1];
					}
					?>
					<div class="col-md-3">
						<label class="inline-title" for=""><span class="lbl-title">Tiêu đề</span> <input class="input width400 form-control" id="specification_title" name="specification_title" value="<?php echo $specification_title?>"  /></label>
						<label class="inline-title" for=""><span class="lbl-title">Giá trị</span><input class="input width400 form-control" id="specification" name="specification" value="<?php echo $specification?>"  /></label>
					</div>
					<div class="col-md-1 text-label">
						Động cơ:
					</div>
					<div class="col-md-3">
						<label class="inline-title" for=""><span class="lbl-title">Tiêu đề</span> <input class="input width400 form-control" id="loai_title" name="loai_title" value="<?php echo $loai_title?>"  /></label>
						<label class="inline-title" for=""><span class="lbl-title">Giá trị</span><input class="input width400 form-control" id="loai" name="loai" value="<?php echo @$items[0]['loai']?>"  /></label>
					</div>
					<div class="col-md-1 text-label">
						Trọng lượng (kg):
					</div>
					<div class="col-md-3">
						<input class="input width400 form-control" id="weight" name="weight" value="<?php echo @$items[0]['weight']?>"  />
					</div>
				</div>
				
				
				<div class="row form-group">
					
					<div class="col-md-1 text-label">
						Năm sản xuất:
					</div>
					<div class="col-md-3">
						<label class="inline-title" for=""><span class="lbl-title">Tiêu đề</span> <input class="input width400 form-control" id="mfg_year_title" name="mfg_year_title" value="<?php echo $mfg_year_title?>"  /></label>
						<label class="inline-title" for=""><span class="lbl-title">Giá trị</span><input class="input width400 form-control" id="mfg_year" name="mfg_year" value="<?php echo @$items[0]['mfg_year']?>"  /></label>
					</div>
                    <div class="col-md-1 text-label">
						Bảo hành:
					</div>
					<div class="col-md-3">
						<label class="inline-title" for=""><span class="lbl-title">Tiêu đề</span> <input class="input width400 form-control" id="bao_hanh_title" name="bao_hanh_title" value="<?php echo $bao_hanh_title?>"  /></label>
						<label class="inline-title" for=""><span class="lbl-title">Giá trị</span><input class="input width400 form-control" id="bao_hanh" name="bao_hanh" value="<?php echo @$items[0]['bao_hanh']?>"  /></label>
					</div>
					
				</div>

                <div class="row form-group">
                    <div class="col-md-1 text-label">
						Vị trí:
					</div>
					<div class="col-md-3">
						<label class="inline-title" for=""><span class="lbl-title">Tiêu đề</span> <input class="input width400 form-control" id="group_pos_title" name="group_pos_title" value="<?php echo $group_pos_title?>"  /></label>
						<label class="inline-title" for=""><span class="lbl-title">Giá trị</span><input class="input width400 form-control" id="group_pos" name="group_pos" value="<?php echo @$items[0]['group_pos']?>"  /></label>
					</div>

					<div class="col-md-1 text-label">
						Số lượng:
					</div>
					<div class="col-md-3">
						<label class="inline-title" for=""><span class="lbl-title">Tiêu đề</span> <input class="input width400 form-control" id="group_quantity_title" name="group_quantity_title" value="<?php echo $group_quantity_title?>"  /></label>
						<label class="inline-title" for=""><span class="lbl-title">Giá trị</span><input class="input width400 form-control" id="group_quantity" name="group_quantity" value="<?php echo @$items[0]['group_quantity']?>"  /></label>
					</div>
				</div>

				<div class="row form-group">
					<div class="col-md-1 text-label">
						Xuất xứ:
					</div>
					<div class="col-md-3">
						<input class="input width400 form-control" id="xuat_xu" name="xuat_xu" value="<?php echo @$items[0]['xuat_xu']?>"  />
					</div>

                    <div class="col-md-1 text-label">
						Giờ sử dụng (h):
					</div>
					<div class="col-md-3">
						<input class="input width400 form-control" id="gio_su_dung" name="gio_su_dung" value="<?php echo @$items[0]['gio_su_dung']?>"  />
					</div>
					
					<div class="col-md-1 text-label">
						Bánh xe sau:
					</div>
					<div class="col-md-3">
						<input class="input width400 form-control" id="banh_sau" name="banh_sau" value="<?php echo @$items[0]['banh_sau']?>"  />
					</div>
				</div>
				<div class="row form-group">
                    <div class="col-md-1 text-label">
						Tình trạng hàng hóa (%):
					</div>
					<div class="col-md-3">
						<input class="input width400 form-control" id="tinh_trang_hang" name="tinh_trang_hang" value="<?php echo @$items[0]['tinh_trang_hang']?>"  />
					</div>

					<div class="col-md-1 text-label">
						Công suất:
					</div>
					<div class="col-md-3">
						<input class="input width400 form-control" id="cong_suat" name="cong_suat" value="<?php echo @$items[0]['cong_suat']?>"  />
					</div>
					
					<div class="col-md-1 text-label">
						Nguồn điện
					</div>
					<div class="col-md-3">
						<input class="input width400 form-control" id="nguon_dien" name="nguon_dien" value="<?php echo @$items[0]['nguon_dien']?>"  />
					</div>
				</div>
				
				
			</div>
		</div>
		<div role="tabpanel" class="tab-pane fade" id="id_viet" aria-labelledby="home-tab">
		<!-- //lang viet -->
		<div class="ar_admin">
			<table class="table table-bordered table-hover them_dt" style="border:none">
				<tbody>
					
					<tr>
						<td class="td_left">
							Mô tả:
						</td>
						<td class="td_right">
							<textarea class="input width400 form-control" style="height:80px" name="description_vi" id="description_vi"><?=@$items[0]['description_vi']?></textarea>
							<?php $ckeditor->replace('description_vi'); ?>
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
							<div class="row form-group">
								<div class="col-md-9">
									<input class="input width400 form-control field-need-check" data-result="check_field_name_en" OnkeyUp="addText(this,'#alias_en','#title_en')" id="name_en" name="name_en" value="<?php echo @$items[0]['name_en']?>"  />
								</div>
								<div class="col-md-3" id="check_field_name_en"></div>
							</div>
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
							<?php $ckeditor->replace('description_en'); ?>
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
							<div class="row form-group">
								<div class="col-md-9">
									<input class="input width400 form-control field-need-check" data-result="check_field_name_ch" OnkeyUp="addText(this,'#alias_ch','#alias_ch')" id="name_ch" name="name_ch" value="<?php echo @$items[0]['name_ch']?>"  />
								</div>
								<div class="col-md-3" id="check_field_name_ch"></div>
							</div>
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
							<?php $ckeditor->replace('description_ch'); ?>
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
		<div role="tabpanel" class="tab-pane fade" id="id_names" aria-labelledby="names-tab">
		<!-- /seo -->
			<div class="ar_admin">
				<table class="table table-bordered table-hover them_dt" style="border:none">
					<tbody>
						<?php
						foreach ($config['domainNameMap'] as $domain => $nameKey) {
						?>
							<tr>
								<td class="td_left">
									<?php echo $domain; ?>:
								</td>
								<td class="td_right">
									<input class="input width400 form-control" autocomplete="off"  type="text" name="name_json2[<?php echo $nameKey; ?>]" value="<?php //echo @$items[0]['name_json'][$nameKey]?>"  />
								</td>
							</tr>
						<?php
						}
						?>
					</tbody>
				</table>
			<!-- end -->
			</div>
		</div>
	</div>
</div>
<div class="ar_admin last fixed-bottom text-center" style="position: sticky;">
	<label> <input type="checkbox" name="is_completed" id="is_completed" value="1" <?php echo $items[0]['is_completed'] ? 'checked' : ''; ?>/> Đã hoàn thành</label>
	<a href="/<?php echo $items[0]['alias_vi']; ?>.html" target="_blank" class="btn btn-primary"><i class="glyphicon glyphicon-eye-open"></i></a>
	<span onclick="cloneProduct(<?php echo $items[0]['id']; ?>)" target="_blank" class="btn btn-default" title="Sao chép sản phẩm này"><i class="glyphicon glyphicon-flash text-warning"></i></span>
	<input type="submit" value="Lưu" class="btn btn-success"/>
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=san-pham&a=man'" class="btn btn-default" />
	<?php if(isset($_GET['id'])) { ?>
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="/admin/index.php?p=san-pham&a=delete&id=<?php echo $items[0]['id']; ?>" class="text-danger">Xóa</a>
	<?php } ?>
</div>
</form>
</div>



<script type="text/javascript" src="/admin/assets/pasteimage.js"></script>
<script type="text/javascript">
	function showImage(src, target) {

		// if ($(target + ' .img-result img').length > 0) {
		// 	$(target + ' .img-result img').attr('src', src);
		// } else {
		// 	$(target + ' .img-result').append('<img src="' + src + '" style="max-height:150px"/>');
		// }

		var sourceSplit = src.split("base64,");
		var sourceString = sourceSplit[1];
		// $(target + ' .input-clipboard').val(sourceString);
		// 
		var sourceSplit = src.split("base64,");
		var sourceString = sourceSplit[1];
		// $(target + ' .input-clipboard').val(sourceString);
		const baseUrl = AppConfig && AppConfig.fileBaseUrl ? AppConfig.fileBaseUrl : '/';
		$.ajax({
		  type: 'POST',
		  url: baseUrl + 'admin/upload.php?image_source=1',
		  data: sourceString,
		  contentType: 'application/json',
		  success: (res) => {
		  	console.log({res});
		  	if (!res.name) {
		  		alert('Lỗi tải lên hình ảnh!');
		  		return;
		  	}

		  	src = res.name;
		  	if ($(target + ' .img-result img').length > 0) {
					$(target + ' .img-result img').attr('src', baseUrl + 'img_data/images/' + src).attr('data-original-title', '');
				} else {
					$(target + ' .img-result').append('<img src="' + baseUrl + 'img_data/images/' + src + '" style="max-height:150px;"/>');
				}

			$(target + ' .input-clipboard').val(src);
		  },
		  dataType: 'json'
		});
	}

	function urlToImage(e) {
		const target = e.target.dataset.result;
		const url = e.target.value;
		console.log('url', url);
		if (!url || url.trim().length === 0 || url.indexOf('http') !== 0) {
			return;
		}

		const baseUrl = AppConfig && AppConfig.fileBaseUrl ? AppConfig.fileBaseUrl : '/';
		$.ajax({
			type: 'GET',
			url: baseUrl + 'admin/api.php?func=url_to_image',
			data: { url },
			contentType: 'application/json',
			success: (res) => {
				if (!res.result) {
					alert('Lỗi tải lên hình ảnh!');
					return;
				}

				src = res.result;
				if ($(target + ' .img-result img').length > 0) {
					$(target + ' .img-result img').attr('src', baseUrl + 'img_data/images/' + src).attr('data-original-title', '');
				} else {
					$(target + ' .img-result').append('<img src="' + baseUrl + 'img_data/images/' + src + '" style="max-height:150px;"/>');
				}

				$(target + ' .input-clipboard').val(src);
				e.target.value = '';
			},
			dataType: 'json'
		});
	}

	function showSlideImage(src, target) {
		// $(target).height('210px');

		// if ($(target + ' .img-result img').length > 0) {
		// 	$(target + ' .img-result img').attr('src', src);
		// } else {
		// 	$(target + ' .img-result').append('<img src="' + src + '" style="max-height:150px; max-width: 178px; margin-top: 5px"/>');
		// }

		var sourceSplit = src.split("base64,");
		var sourceString = sourceSplit[1];
		const baseUrl = AppConfig && AppConfig.fileBaseUrl ? AppConfig.fileBaseUrl : '/';
		// $(target + ' .input-clipboard').val(sourceString);
		$.ajax({
		  type: 'POST',
		  url: baseUrl + 'admin/upload.php?image_source=1',
		  data: sourceString,
		  contentType: 'application/json',
		  success: (res) => {
		  	console.log({res});
		  	if (!res.name) {
		  		alert('Lỗi tải lên hình ảnh!');
		  		return;
		  	}
		  	$(target).height('210px');

		  	src = res.name;
		  	if ($(target + ' .img-result img').length > 0) {
					$(target + ' .img-result img').attr('src', src);
				} else {
					$(target + ' .img-result').append('<img src="'+baseUrl+'img_data/images/' + src + '" style="max-height:150px; max-width: 178px; margin-top: 5px"/>');
				}

			$(target + ' .input-clipboard').val(src);
		  },
		  dataType: 'json'
		});

		// $(target + ' input').hide();
	}

	$(document).ready(function() {
		pasteimage('#thumb', showImage);
		$('#thumb input[name=file2_url]').on('blur', urlToImage);

		// toggle slide image
		$('.toggle_image').on('click', function(e) {
			e.preventDefault();
			const target = e.target;
			const icon = $(this).find('>.glyphicon')[0];
			const id = $(this).attr('data-id');

			$.ajax({
				url: 'index.php',
				type:'POST',
				data: {
					id,
					p: 'san-pham',
					a: 'toggle_image'
				},
				dataType: 'JSON',
				success: data => {
				  if (data.result) {
				  	if ($(icon).hasClass('glyphicon-eye-open')) {
				  		$(icon).removeClass('glyphicon-eye-open').addClass('glyphicon-eye-close');
				  	} else {
				  		$(icon).removeClass('glyphicon-eye-close').addClass('glyphicon-eye-open');
				  	}
				  }
				},
				fail: (error) => {
					alert('Có lỗi xảy ra!')
					console.log(error);
				}
			});
		});
	});
</script>

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
			  // $(".td_hinhanh").html(data);
				$(".hide_js_"+id).remove();
		  }
		})
	}

	var fs_img = 0;
	function them_anh(){
		fs_img++;
		if(fs_img < 31){
			$(".add_img").append('<div class="dv-img-ad hide_js_'+fs_img+'"><input type="hidden" name="txt_up_'+fs_img+'" class="txt_up_'+fs_img+'"  value="1"><input type="file" class="file_img form-control" name="file_'+fs_img+'" data-api="<?php echo getApiUploadFile(); ?>" data-result=".hide_js_'+fs_img+'"><input type="text" placeholder="Link ảnh" class="input form-control" name="file_url_'+fs_img+'"><input type="text" name="title'+fs_img+'" class="form-control" placeholder="Tên sản phẩm" style="margin-top:5px;"/><input type="hidden" class="input form-control input-clipboard js-upload-result" name="file_clipboard_'+fs_img+'"><div class="img-result"></div><a class="delete-img" href="javascript:;" onclick="xoa_anh_up(\''+fs_img+'\')"> Xóa </a></div>');
			const newWrapperId = '.hide_js_' + fs_img;
			pasteimage(newWrapperId, showSlideImage);
			initImageFieldAutoUpload(`${newWrapperId} .file_img`);
		}else{
			alert("Mỗi lần up tối đa 30 ảnh.");
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

<!-- Boostrap select box -->
<script type="text/javascript" src="/admin/assets/bootstrap-select-1.12.4/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="/admin/assets/bootstrap-select-1.12.4/js/i18n/defaults-vi_VN.min.js"></script>
<script>
var checkPartNumberTimeout = null;
var checkFieldTimeout = null;
const productId = <?php echo isset($items[0]['id']) ? $items[0]['id'] : null; ?>;
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();

    const partNumberInput = $('#part_number');
    const checkPartNumberResult = $('#checkPartNumberResult');

    function checkPartNumber() {

    	const partNumber = partNumberInput.val();

    	$.ajax('/admin/api.php', {
    		method: 'POST',
    		data: {
    			productId,
    			partNumber,
    			func: 'checkPartNumber'
    		},
    		success: data => {
    			if (data.length > 0) {
    				checkPartNumberResult.removeClass('text-success text-info');
    				checkPartNumberResult.addClass('text-danger');
    				checkPartNumberResult.html('Đã tồn tại partNumber giống: ' + data.length);
    				return;
    			}

    			checkPartNumberResult.removeClass('text-danger text-info');
				checkPartNumberResult.addClass('text-success');
				checkPartNumberResult.html('Chưa tồn tại');
    		},
    		fail: error => {
    			checkPartNumberResult.removeClass('text-success text-info');
				checkPartNumberResult.addClass('text-danger');
				checkPartNumberResult.html('Vui lòng thử lại');
    			console.log(error);
    		}
    	});
    }

    function checkField(currentField, resultElement) {
    	var name = currentField.attr('name');
    	var value = currentField.val();

    	$.ajax('/admin/api.php', {
    		method: 'POST',
    		data: {
    			name,
    			value,
    			func: 'getIdsIncludesString'
    		},
    		success: data => {
    			if (data.length > 0) {
    				resultElement.removeClass('text-success text-info');
    				resultElement.addClass('text-danger');
    				resultElement.html('Đã tồn tại ' + name + ' giống: ' + data.length);
    				return;
    			}

    			resultElement.removeClass('text-danger text-info');
				resultElement.addClass('text-success');
				resultElement.html('Chưa tồn tại');
    		},
    		fail: error => {
    			resultElement.removeClass('text-success text-info');
				resultElement.addClass('text-danger');
				resultElement.html('Vui lòng thử lại');
    			console.log(error);
    		}
    	});
    }

    $('.field-need-check').on('keyup', function() {
    	var currentField = $(this);
    	var value = currentField.val();
    	var resultId = currentField.data('result');
		var resultElement = $('#' + resultId);

    	if (checkFieldTimeout !== null) {
    		clearTimeout(checkFieldTimeout);
    		checkFieldTimeout = null;
    	}

    	if (value.length > 0) {
    		checkFieldTimeout = setTimeout(checkField, 700, currentField, resultElement);

    		resultElement.removeClass('text-success text-danger');
			resultElement.addClass('text-info');
			resultElement.html('Đang kiểm tra...');
    	} else {
    		resultElement.html('');
    	}
    });

    partNumberInput.on('keyup', function() {
    	if (checkPartNumberTimeout !== null) {
    		clearTimeout(checkPartNumberTimeout);
    		checkPartNumberTimeout = null;
    	}
    	const partNumber = partNumberInput.val();

    	if (partNumber.length > 0) {
    		checkPartNumberTimeout = setTimeout(checkPartNumber, 700, partNumber);

    		checkPartNumberResult.removeClass('text-success text-danger');
			checkPartNumberResult.addClass('text-info');
			checkPartNumberResult.html('Đang kiểm tra...');
    	} else {
    		checkPartNumberResult.html('');
    	}
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.5/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.parent_number_select').select2({
			ajax: {
				url: '/admin/api.php?func=getParentProducts',
				dataType: 'json',
				delay: 350,
				cache: true,
				// Additional AJAX parameters go here; see the end of this chapter for the full code of this example
			},
			minimumInputLength: 1,
			placeholder: 'Chọn sản phẩm lớn',
			language: 'vi',
		});
	});
</script>
<script src="/admin/js/form.js?v=<?php echo getenv('APP_VERSION'); ?>"></script>
