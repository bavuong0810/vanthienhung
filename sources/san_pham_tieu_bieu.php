<?php
$view_san_pham_tieu_bieu = $d->getOption('view_san_pham_tieu_bieu');
if( $view_san_pham_tieu_bieu ){
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