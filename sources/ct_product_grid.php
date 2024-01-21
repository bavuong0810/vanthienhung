<?php
// include 'ct_tooltip.php';
$tooltip = '';
// $tooltip = $title;
// if (@$_SESSION['is_admin']) {
// 	global $d;
// 	$images = $d->o_fet("select * from #_sanpham_hinhanh where id_sp = '".@$item['id']."' AND `hien_thi` = 1 order by id desc");
// 	foreach ($images as $key => $image){
// 	    $tooltip .= '<div class="pull-left" style="width:50%">
// 	      <img src="'.URLPATH.'images/120/88/'.$item['id'].'/'.$image['image_path'].'" style="width:100%;height:auto">
// 	    </div>';
//     }

//     $tooltip .= '<div class="clearfix"></div>';
// }
?>

<?php
$discountPercent = 0;
if ($item['promotion_price'] < $item['price'] && $item['promotion_price'] > 0) {
    $discountPercent = intval(100 - ($item['promotion_price'] / $item['price'] * 100));
}
?>

<div class="product-grid col-md-3 col-sm-4 col-xs-6 plr10">
    <?php /*<div class="item-pro mb10" data-toggle="tooltip" data-html="true" data-placement="left" title="<?php echo htmlspecialchars($tooltip) ?>"> **/ ?>
    <div class="item-pro mb10" data-toggle="tooltip" data-html="true" data-placement="left" title="<?php echo htmlspecialchars($tooltip) ?>">
        <div class="img-pro">
            <?php if (@$_SESSION['is_admin']) { ?>
                <a data-id="<?php echo $item['id']; ?>" data-image="<?= $image_file_name ?>" href="#" title="Xóa ảnh" class="btn btn-circle btn-del-img text-center btn-danger" style="
                    position: absolute;
                    z-index: 2;
                    left: 5px;
                "><i class="fa fa-close" style="width: 20px;height: 20px;line-height: 20px;"></i></a>
                <a data-id="<?php echo $item['id']; ?>" href="javascript:void(0)" onclick="changeImage(this)" title="Đổi ảnh" class="btn btn-circle text-center btn-warning"
                   data-title="<?= $item['name_' . $lang] ?>" data-image="<?= $item['image_path'] ?>"
                   style="
                    position: absolute;
                    z-index: 2;
                    left: 45px;
                ">
                    <i class="fa fa-file-image-o" aria-hidden="true" style="width: 20px;height: 20px;line-height: 20px;"></i>
                </a>
                <a href="javascript:void(0)" title="View" class="btn text-center btn-info" style="
                    position: absolute;
                    z-index: 2;
                    left: 85px;
                    padding: 6px;
                "><i class="fa fa-eye" style="width: 20px;height: 20px;line-height: 20px;"></i> <?php echo number_format($item['view']); ?></a>
                <a href="/admin/index.php?p=san-pham&a=edit&id=<?php echo $item['id']; ?>" title="Chỉnh sửa sản phẩm" class="btn btn-circle text-center btn-success" style="
                    position: absolute;
                    z-index: 2;
                    right: 5px;
                "><i class="fa fa-pencil" style="width: 20px;height: 20px;line-height: 20px;"></i></a>
            <?php } ?>
            <a class="img-shine-2" href="<?= URLPATH . $item['alias_' . $lang] ?>.html" title="<?= $item['name_' . $lang] ?>" target="_blank">
                <img alt="<?= $item['name_' . $lang] ?>" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAWCAQAAAB9auREAAAAGklEQVR42mP8X89ANmAc1TyqeVTzqOaRqhkAD/0g67N/o4cAAAAASUVORK5CYII=" class="lazy product_image_<?php echo $item['id']; ?>" data-src="<?= $item['image_path'] ?>" onerror="this.src='<?= $d->getDefaultProductImage(300, 220) ?>';">
            </a>
            <?php if($discountPercent > 0): ?>
                <span class="fd-discount">- <?php echo $discountPercent; ?>%</span>
            <?php endif; ?>
        </div>
        <div class="info">
            <h3>
                <a href="<?= URLPATH . $item['alias_' . $lang] ?>.html" title="<?= $item['name_' . $lang] ?>" target="_blank">
                    <?= $item['name_' . $lang] ?>
                </a>
            </h3>
            <div class="price-home">
                <div class="product-detail-price">
                    <?php if ($item['promotion_price'] > 0) { ?>
                        <span class="price-km mr-1"><?= $d->vnd($item['promotion_price']) ?></span>
                        <span class="price old-price"><i><small><?= ($item['price'] > 0) ? $d->vnd($item['price']) : _lienhe; ?></small></i></span>
                    <?php } else { ?>
                        <span class="price"><?= ($item['price'] > 0) ? $d->vnd($item['price']) : _lienhe; ?></span>
                    <?php } ?>
                    <?php echo '/' . ($item['unit'] ?: 'Cái'); ?>
                </div>
            </div>
            <div class="row text-center">
                <?php /*
                <a class="btn-default btn" href="<?= URLPATH . $item['alias_' . $lang] ?>.html" title="<?= $item['name_' . $lang] ?>" target="_blank">
                    Chi tiết
                </a>
                */ ?>
                <a href="javascript:void(0)" type="button" class="bg-primary btn"
                   onclick="actionAddToCart(this)"
                   data-product="<?= $item['id'] ?>" data-title="<?= $item['name_' . $lang] ?>"
                   data-price="<?= $item['price'] ?>" data-detail="true">
                    Thêm vào giỏ
                </a>
                <span class="bg-primary btn addcart" title="<?= $item['name_' . $lang] ?>" data-product="<?= $item['id'] ?>" data-code="<?= $item['code']; ?>" data-image="<?= $item['image_path'] ?>?zc=2" data-title="<?= $item['name_' . $lang] ?>">
                    Yêu cầu báo giá
                </span>
            </div>
        </div>
    </div>
</div>