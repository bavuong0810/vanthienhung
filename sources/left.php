<?php

$cachePath = '/menu-left.html_' . $lang;
$cachePath = __CACHE_HTML . $cachePath;
if (file_exists($cachePath)) {
	echo file_get_contents($cachePath);
	echo '<!--cached-->';
} else {

	ob_start("minify_html");
	?>
<?php
    $nav_left = $d->o_fet("select * from #_category where hien_thi=1 and is_hot=1 and module=3 order by so_thu_tu asc, id desc");
	$support = $d->o_fet("select * from #_hotro where hien_thi=1 order by so_thu_tu asc, id desc");
	$list_id = '1026' . $d->findIdSub(1026);
	$news_left = $d->o_fet("select * from #_tintuc where hen_ngay_dang<'" . time() . "' and hien_thi=1 and category_id in ({$list_id}) order by so_thu_tu asc, id desc limit 0,4");
	$sp_hot = $d->o_fet("select * from #_sanpham where is_hot=1 and ".get_column_show()."=1 order by so_thu_tu asc, id desc limit 0,10");
	$video = $d->o_fet("select * from #_video where hien_thi=1 order by id desc");
?>
<style type="text/css">
    .hot-zalo{ margin-top: 10px; }
    .hot-zalo img{ max-width: 20px; }
    .ic-all{ width: 22px; height: 30px; z-index: 9; }
    /*.box.category ul.sub li.arrow-sub:hover > ul{ display: block; }*/
</style>

<?php 
$sticky_widget = true;
if( ($view_zalo_right && $view_ct_truc_tuyen) || ($view_zalo_right && $view_price_report_form_right) || ($view_ct_truc_tuyen && $view_price_report_form_right) ){
    $sticky_widget = false;
}
?>

<div class="col-md-3 col-left plr10 hotrotructuyen-wrap">

    <div class="<?php echo $sticky_widget?'hotrotructuyen-widget':'hotrotructuyen-widget-2'?>">

        <?php
        if($view_shipping_content == 1):
            $shipping_return_content = $information['delivery_return'];
            ?>
            <div class="shipping-return">
                <div class="content-about text-justify">
                    <?= $shipping_return_content ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if( $view_zalo_right ){?>
        <div class="info-box mb20">
            <h4 class="title"><?php echo $chiTietHoTroZalo['name_' . $lang]; ?></h4>
            <div class="plr10">
                <?php
                echo $chiTietHoTroZalo['content_' . $lang];
                ?>
            </div>
        </div>
        <?php } ?>
        
        <?php if( $view_ct_truc_tuyen ){?>
        <div class="clearfix bao-left">
            <h3 class="title-left title-font"><span class="at"></span><?=_support_online?></h3>
            <div class="box box10">
                <div class="support-online text-center ">
                    <div class="img-hotline mb10">
                        <img src="templates/images/hot-line.png" alt="hot line">
                    </div>
                    <?php foreach ($support as $item) { ?>

                        <div class="col-md-12 col-sm-6 plr5">
                            <div class="support mb10">
                                <div class="phone">
                                    <i class="fa fa-phone"></i>
                                    <span class="so-dt"><?=$item['name_vi']?></span>
                                </div>
                                <div class="title-hotro hot-zalo text-center">
                                    <span class="name"><strong><?=$item['sdt']?></strong></span>
                                    <a class="btn btn-default btn-circle" href="skype:<?=$item['skype']?>?chat">
                                        <img src="templates/images/skype.png" width="20" alt="skype">
                                    </a>
                                    <a class="btn btn-default btn-circle" href="https://zalo.me/<?=$item['yahoo']?>">
                                        <img src="templates/images/zalo.png" class="zalo">
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php }?>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <?php }?>

        <?php
        $view_price_report_form_right = $d->getOption('view_price_report_form_right');
        ?>
        <?php if ($view_price_report_form_right) {?>
        <div class="clearfix bao-left">
            <h3 class="title-left title-font"><span class="at"></span>Yêu cầu báo giá</h3>
            <div class="box box10">
                <div class="support-online text-center">
                    <div class="row">
                        <?php include 'ct_form_lienhe.php'; ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <?php }?>

        <?php if ($view_button_placeorder_right) {?>
        <div class="clearfix btn-placeholder-right">
            <div class="detail-button-wrap detail-button-order mb-1">
                <a href="#dat-hang" type="button" class="btn btn-dathang btn-flat" data-product="<?= $ctsp['id'] ?>" data-title="<?= $ctsp['name_' . $lang] ?>" data-price="<?= $ctsp['price'] ?>" data-detail="true">
                    Đặt hàng
                </a>
            </div>
        </div>
        <?php }?>

        <?php if ($view_button_price_request_right) {?>
        <div class="clearfix btn-placeholder-right">
            <div class="detail-button-wrap detail-button-order mb-1">
                <a href="#bao-gia" type="button" class="btn btn-flat btn-red btn-priceContact">
                    Yêu cầu báo giá
                </a>
            </div>
        </div>
        <?php }?>

        <?php if ($view_button_checkorder_right) {?>
        <div class="clearfix btn-placeholder-right">
            <div class="detail-button-wrap detail-button-order mb-1">
                <a href="#kiem-tra-don-hang" class="btn btn-flat btn-green btn-checkorder">
                    Kiểm tra đơn hàng
                </a>
            </div>
        </div>
        <?php }?>

        <?php if ($view_button_warrantyonline_right) {?>
        <div class="clearfix btn-placeholder-right">
            <div class="detail-button-wrap detail-button-order mb-1">
                <a href="#kich-hoat-bao-hanh" class="btn btn-flat btn-blue btn-warrantyonline">
                    Bảo hành online
                </a>
            </div>
        </div>
        <?php }?>

        <?php if ($view_button_contact_right) {?>
        <div class="clearfix btn-placeholder-right">
            <div class="detail-button-wrap detail-button-order mb-1">
                <a class="btn btn-sendmail btn-product-contact btn-blue btn-flat"
                   data-target="#sendEmailModal" data-toggle="modal" href="javascript:void(0)">Liên hệ</a>
            </div>
        </div>
        <?php }?>

        <?php if ( $view_calendar_right ) {?>
        <div class="clearfix bao-left">
            <h3 class="title-left title-font"><span class="at"></span><?=_time_table?></h3>
            <div class="box box10">
                <div class="support-online text-center ">
                    <?php echo $timetable['content_' . $lang]; ?>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <?php }?>

    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        // category
        $('span.ic-menu').click(function(event) {
            $(this).siblings('ul').slideToggle('fast');
            event.stopPropagation();
        });
        $('span.ic-menu-2').click(function(event) {
            $(this).siblings('ul').slideToggle('fast');
            event.stopPropagation();
        });
        
        $('.list-video').change(function(event) {
            var link = this.value;
            $('#video_left iframe').attr('src', 'https://www.youtube.com/embed/'+link);
        });

    });
    jQuery(document).ready(function($) {
        $(".carousel-sanpham").slick({
            slidesToShow: 9,
            slidesToScroll: 1,
            prevArrow: "",
            nextArrow: "",
            vertical:true,
            verticalScrolling: true,
            autoplay: true,
            autoplaySpeed: 3000,
        });
    });
</script>

<?php
$cacheContent = ob_get_flush();
	file_put_contents($cachePath, minify_html($cacheContent));
}
?>