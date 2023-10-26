<?php
$view_san_pham_tieu_bieu_top = $d->getOption('view_san_pham_tieu_bieu_top');
if($view_san_pham_tieu_bieu_top){
?>
<section class="hidden-sm hidden-xs">
    <div class="container">
        <div class="title-main">
            <h3>Sản phẩm tiêu biểu</h3>
        </div>
        <div class="row101">
            <div class="slider-doitacs-2">
                <?php foreach ($sp_tieubieu as $key => $item) {
                    if (empty($item['image_path'])) {
                        $item['image_path'] = $d->getDefaultProductImage();
                    } else {
                        $item['image_path'] = THUMB_BASE . 'images/190/120/' . $item['id'] . '/' . $item['image_path'] . '?zc=0';
                    }
                    ?>
                    <div class="plr10">
                        <div class="clearfix item-tin">
                            <div class="img-slogan">
                                <a href="<?= $item['alias_' . $lang] ?>.html" title="<?php echo $ctsp['name_' . $_SESSION['lang']] ?>">
                                    <div class="wrap-img">
                                        <img alt="<?php echo $ctsp['name_' . $_SESSION['lang']] ?>" onerror="this.src='<?= $d->getDefaultProductImage() ?>';" src="<?= $item['image_path'] ?>">
                                    </div>
                                    <span class="max-line-2">
                                        <?= $item['name_' . $_SESSION['lang']] ?>
                                    </span>
                                </a>
                            </div>
                            <div class="clearfix product_info_price">
                                <?php if ($item['promotion_price'] < $item['price'] && $item['promotion_price'] > 0):
                                    $discountPercent = intval(100 - ($item['promotion_price'] / $item['price'] * 100));
                                    ?>
                                    <p>
	    					        <span class="fd-price">
                                        <?php echo $d->vnd($item['promotion_price']); ?>
                                    </span>

                                        <span class="fd-discount">- <?php echo $discountPercent;?>%</span>
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