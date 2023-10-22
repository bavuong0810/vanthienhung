<?php
$sticky_left_sidebar = false;
if( $view_dm_truc_tuyen ){
    if( $view_danh_muc == "hidden" && !$view_nhan_hieu ){
        $sticky_left_sidebar = true;
    }
}
$view_vi_tri_nhan_hieu =  $d->getOption('view_vi_tri_nhan_hieu');
$view_count_product = $d->getOption('view_count_product');
?>

<div class="col-md-3 col-left plr10 hotrotructuyen-wrap">

    <div class="<?php echo $sticky_left_sidebar?'hotrotructuyen-widget':'hotrotructuyen-widget-2'?>">

        <?php if( $view_zalo_left ){?>
        <div class="info-box mb20">
            <h4 class="title"><?php echo $chiTietHoTroZalo['name_' . $lang]; ?></h4>
            <div class="plr10">
                <?php
                echo $chiTietHoTroZalo['content_' . $lang];
                ?>
            </div>
        </div>
        <?php } ?>

        <?php 
        if( $view_dm_truc_tuyen ){
            $support = $d->o_fet("select * from #_hotro where hien_thi=1 order by so_thu_tu asc, id desc");
        ?>
        <style type="text/css">
            .hot-zalo{ margin-top: 10px; }
            .hot-zalo img{ max-width: 20px; }
            .ic-all{ width: 22px; height: 30px; z-index: 9; }
        </style>
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
        
        <?php if( $view_vi_tri_nhan_hieu == 'above' ){?>
            <?php if ($is_view_nhan_hieu) {?>
            <div class="clearfix bao-left">
                <h3 class="title-left title-font clearfix"><span class="at"></span>Nhãn hiệu</h3>
                <div class="clearfix"></div>
                <div class="nav-left clearfix">
                    <?php 
                    if( $view_nhan_hieu == 'group' || $view_nhan_hieu == 'group_normal' ){
                        include 'menu-nhan-hieu-group-sidebar.php'; 
                    } else {
                        include 'menu-nhan-hieu-sidebar.php'; 
                    }
                    ?>
                </div>
            </div>
            <?php }?>
        <?php }?>
        
        <?php if ($is_view_danh_muc) {?>
        <div class="clearfix bao-left">
            <h3 class="title-left title-font clearfix"><span class="at"></span>Danh mục hàng</h3>
            <div class="clearfix"></div>
            <div class="nav-left clearfix">
                <?php include 'menu-danh-muc-sidebar.php'; ?>
            </div>
        </div>
        <?php }?>

        <?php if( $view_vi_tri_nhan_hieu == 'bellow' ){?>
            <?php if ($is_view_nhan_hieu) {?>
            <div class="clearfix bao-left">
                <h3 class="title-left title-font clearfix"><span class="at"></span>Nhãn hiệu</h3>
                <div class="clearfix"></div>
                <div class="nav-left clearfix">
                    <?php 
                    if( $view_nhan_hieu == 'group' ){
                        include 'menu-nhan-hieu-group-sidebar.php'; 
                    } else {
                        include 'menu-nhan-hieu-sidebar.php'; 
                    }
                    ?>
                </div>
            </div>
            <?php }?>
        <?php }?>

        <?php if ($view_button_price_request_left) {?>
        <div class="clearfix">
            <div class="detail-button-wrap detail-button-order mb-1">
                <a href="#bao-gia" type="button" class="btn btn-flat btn-red btn-priceContact">
                    Yêu cầu báo giá
                </a>
            </div>
        </div>
        <?php }?>

        <?php if ($view_button_checkorder_left) {?>
        <div class="clearfix">
            <div class="detail-button-wrap detail-button-order mb-1">
                <a href="#kiem-tra-don-hang" class="btn btn-flat btn-green btn-checkorder">
                    Kiểm tra đơn hàng
                </a>
            </div>
        </div>
        <?php }?>

        <?php if ($view_button_warrantyonline_left) {?>
        <div class="clearfix">
            <div class="detail-button-wrap detail-button-order mb-1">
                <a href="#kich-hoat-bao-hanh" class="btn btn-flat btn-blue btn-warrantyonline">
                    Bảo hành online
                </a>
            </div>
        </div>
        <?php }?>

        <?php if ($view_button_contact_left) {?>
        <div class="clearfix">
            <div class="detail-button-wrap detail-button-order mb-1">
                <a type="button" class="btn btn-sendmail btn-product-contact btn-blue btn-flat" href="#lien-he">Liên hệ</a>
            </div>
        </div>
        <?php }?>

        <?php if ( $view_calendar_left ) {?>
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