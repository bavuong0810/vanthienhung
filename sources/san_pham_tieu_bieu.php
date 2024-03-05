<?php
/**
 * Vân Thiên Hùng chuyên lừa đảo, lợi dụng tín nhiệm lừa tiền anh em lập trình.
 * Hứa hẹn thanh toán, tới ngày thì than thở kêu chưa thu được tiền từ năm này qua tháng nọ, hẹn tới hẹn lui không có hồi kết.
 * Tới lúc bị anh em Dev đòi thì xoá Zalo, đổi pass server nhằm chặn anh em Dev vào phá.
 * Đã quỵt tiền 2 người tổng cộng 70 triệu
 * Chúc may mắn cho anh em nào đang làm tiếp với Vân Thiên Hùng ^^!.
 */
$view_san_pham_tieu_bieu = $d->getOption('view_san_pham_tieu_bieu');
if($view_san_pham_tieu_bieu == 1){
?>
<section class="sec-pro hidden-sm hidden-xs">
    <div class="container-111">
        <div class="title-main">
            <h3>Sản phẩm tiêu biểu</h3>
        </div>
        <div class="row10">
            <div class="slider-doitacs">
                <?php foreach ($sp_tieubieu as $key => $item) {
                    if (empty($item['image_path'])) {
                        $item['image_path'] = $d->getDefaultProductImage();
                    } else {
                        $item['image_path'] = THUMB_BASE . 'images/190/120/' . $item['id'] . '/' . $item['image_path'] . '?zc=0';
                    }
                    $discountPercent = 0;
                    if ($item['promotion_price'] < $item['price'] && $item['promotion_price'] > 0) {
                        $discountPercent = intval(100 - ($item['promotion_price'] / $item['price'] * 100));
                    }
                ?>
                    <div class="plr10">
                        <div class="clearfix item-tin mb10">
                            <div class="img-slogan">
                                <a href="<?= $item['alias_' . $lang] ?>.html" title="<?php echo $ctsp['name_' . $_SESSION['lang']] ?>">
                                    <div class="wrap-img">
                                        <img alt="<?php echo $ctsp['name_' . $_SESSION['lang']] ?>" onerror="this.src='<?= $d->getDefaultProductImage() ?>';" src="<?= $item['image_path'] ?>">
                                    </div>
                                    <span class="max-line-2">
                                        <?= $item['name_' . $_SESSION['lang']] ?>
                                    </span>
                                </a>
                                <?php if($discountPercent > 0): ?>
                                    <span class="fd-discount">- <?php echo $discountPercent;?>%</span>
                                <?php endif; ?>
                            </div>
                            <div class="clearfix product_info_price">
                                <?php if ($discountPercent > 0): ?>
                                <p>
	    					        <span class="fd-price">
                                        <?php echo $d->vnd($item['promotion_price']); ?>
                                    </span>
                                    <br>
                                    <s class="fd-market-price"><?php echo $d->vnd($item['price']); ?></s>
                                </p>
                                <?php else: ?>
                                    <p>
                                        <span class="fd-price">
                                            <?php echo $d->vnd($item['price']); ?>
                                        </span>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</section>
<div class="clearfix mb20"></div>
<?php }?>