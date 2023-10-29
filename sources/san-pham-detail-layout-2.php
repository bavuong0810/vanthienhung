<?php
$view_product_detail_above =  $d->getOption('view_product_detail_above');
$view_product_detail_below =  $d->getOption('view_product_detail_below');
$view_vi_tri_form_bao_gia =  $d->getOption('view_vi_tri_form_bao_gia');
$view_button_checkorder =  $d->getOption('view_button_checkorder');
$view_button_warrantyonline =  $d->getOption('view_button_warrantyonline');
$lang = $_SESSION['lang'];
$our_service = $d->getTemplates(48);
$vth_logo = $d->getTemplates(30);
?>
<style type="text/css">
    .tab-content {
        background: #fff;
    }
</style>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<section class="detail sc-ctsp">
    <link href="<?= URLPATH ?>templates/extra/magiczoomplus/magiczoomplus.css" rel="stylesheet" />
    <script src="<?= URLPATH ?>templates/extra/magiczoomplus/magiczoomplus.js"></script>
    <?php
    $chiTietHoTroZalo = $d->getTemplates(49, true);
    $timetable = $d->getTemplates(54, true);
    $view_ct_truc_tuyen = $d->getOption('view_ct_truc_tuyen');
    $view_price_report_form_right = $d->getOption('view_price_report_form_right');
    $view_button_placeorder_right = $d->getOption('view_button_placeorder_right');
    $view_button_checkorder_right =  $d->getOption('view_button_checkorder_right');
    $view_button_warrantyonline_right =  $d->getOption('view_button_warrantyonline_right');
    $view_button_price_request_right =  $d->getOption('view_button_price_request_right');
    $view_button_contact_right =  $d->getOption('view_button_contact_right');
    $view_zalo_right =  $d->getOption('view_zalo_right');
    $view_calendar_right =  $d->getOption('view_calendar_right');

    if( $view_ct_truc_tuyen || $view_price_report_form_right || $view_button_placeorder_right || $view_button_checkorder_right || $view_button_warrantyonline_right || $view_button_price_request_right || $view_zalo_right || $view_calendar_right ){
        $has_sidebar = 1;
    } else {
        $has_sidebar = '';     
    }

    $extraClass = ($has_sidebar)?' has-col-right':' no-col-right';
    ?> 
    <div class="container clearfix">

        <div class="bg-white clearfix mb-2">
                        
            <div class="page-title" style="padding: 10px 0 !important;"></div>

            <div class="clearfix row-ctcp-top san_pham_tieu_bieu_top">
                <?php include 'san_pham_tieu_bieu_top.php'; ?>
            </div>

            <div class="row10 clearfix row-ctsp-detail">
                <!-- Product info -->
                <div class="col-md-5 plr10 ct-col-box ct-box-left">
                    <div class="owl-pro-slick product-thumbnail">
                        <a id="Zoomer" href="<?= $ctsp['image_path'] ?>" title="<?= $ctsp['name_' . $_SESSION['lang']] ?>" class="MagicZoomPlus" rel="zoom-width:300px; zoom-height:300px;selectors-effect-speed: 600; selectors-class: Active;">
                            <img alt="<?php echo $ctsp['name_' . $_SESSION['lang']] ?>" onerror="this.src='<?= $d->getDefaultProductImage() ?>';setTimeout(() => {$('.mz-loading').hide();}, 1000);" src="<?= $ctsp['image_path'] ?>?zc=2">
                        </a>
                    </div>
                    <div class="clearfix mb10"></div>
                    <?php if (!empty($hinh_anh_sp)) { ?>
                        <div id="sub_img_detail">
                            <div class="list_sub_img_detail">
                                <div class="owl_img_detail">
                                    <div class="col-md-3 plr5 item_owl_sub">
                                        <a href="<?= $ctsp['image_path'] ?>" rel="zoom-id: Zoomer" rev="<?= $ctsp['image_path'] ?>?zc=2">
                                            <img alt="<?php echo $ctsp['name_' . $_SESSION['lang']] ?>" src="<?= $ctsp['image_path'] ?>" class="w100" onerror="this.src='<?= $d->getDefaultProductImage(600, 450) ?>';setTimeout(() => {$('.mz-loading').hide();}, 1000);" />
                                        </a>
                                    </div>
                                    <?php foreach ($hinh_anh_sp as $key => $item) { ?>
                                        <div class="col-md-3 plr5 item_owl_sub">
                                            <a href="<?= THUMB_BASE ?>images/600/450/<?= $ctsp['id'] ?>/<?= $item['image_path'] ?>" rel="zoom-id: Zoomer" rev="<?= THUMB_BASE ?>images/600/450/<?= $ctsp['id'] ?>/<?= $item['image_path'] ?>?zc=2">
                                                <img alt="<?php echo $ctsp['name_' . $_SESSION['lang']] ?>" src="<?= THUMB_BASE ?>images/600/450/<?= $ctsp['id'] ?>/<?= $item['image_path'] ?>" onerror="this.src='<?= $d->getDefaultProductImage(600, 450) ?>';setTimeout(() => {$('.mz-loading').hide();}, 1000);" class="w100" />
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>
                                <!--owl img detail-->
                            </div>
                        </div>
                    <?php }
                    $item = $ctsp;

                    ?>
                    <div class="clearfix"></div>

                    <?php echo get_widget_by_category_position($cat_id, 5)?>

                </div>

                <div class="col-md-7 plr10 ct-col-box ct-box-right">
                    <div class="row15">
                        <div class="col-md-6">
                            <div class="ct-box-inner">

                                <!-- <form method="post" action="<?= URLPATH . "gio-hang.html" ?>"> -->
                                <input type="hidden" class="in-size" name="size" value="">
                                <h1 class="product-name"><?= $ctsp['name_' . $_SESSION['lang']] ?>
                                    <?php if (!empty($_SESSION['is_admin'])) { ?>
                                        <a href="/admin/index.php?p=san-pham&a=edit&id=<?php echo $ctsp['id']; ?>" class="btn btn-success">Sửa</a>
                                    <?php } ?>
                                </h1>

                                <div class="box product-detail">
                                    <div class="product-info">
                                        <div class="product-description">
                                            <?= $ctsp['description_' . $_SESSION['lang']] ?>
                                        </div>
                                        <?php
                                        $view_thong_so = $d->getOption('view_thong_so');
                                        $attributesNeedShow = [
                                            'brand_id' => 'Nhãn hiệu',
                                            'model' => 'Model',
                                            //'code' => 'Mã sản phẩm',
                                            'part_number' => 'Part number',
                                            'specification' => 'Quy cách',
                                            'loai' => 'Loại Động cơ',
                                            'weight' => 'Trọng lượng (kg)',
                                            'mfg_year' => 'Năm sản xuất',
                                            'khung_nang' => 'Khung nâng (m)',
                                            'bao_hanh' => 'Bảo hành',
                                            'tinh_trang_hang' => 'Tình trạng',
                                            'xuat_xu' => 'Xuất xứ',
                                            'group_quantity' => 'Số lượng',
                                            'group_pos' => 'Vị trí',
                                        ];
                                        $attributes = (!empty($ctsp['name_json'])) ? $ctsp['name_json'] : array();
                                        if ($view_thong_so):
                                        ?>
                                        <div class="ql-editor inner">
                                            <?php
                                            foreach ($attributesNeedShow as $key => $name):
                                                if (empty($ctsp[$key])) {
                                                    continue;
                                                }

                                                if( $key == 'brand_id' ){
                                                    $val = $d->getBrandById($ctsp[$key]);
                                                    $val = $val['name'];
                                                } else {
                                                    $val = $ctsp[$key];
                                                }

                                                if( $key == 'brand_id' ){
                                                    $key = 'brand';
                                                }//check to get brand title

                                                $title = $name;
                                                if($attributes[$key.'_title']){
                                                    $title = $attributes[$key.'_title'];
                                                }
                                                ?>
                                                <p style="margin-bottom: 0">
                                                    <span class="text-muted"><?php echo $title; ?>:</span> <?php echo $val; ?>
                                                </p>
                                            <?php
                                            endforeach;
                                            ?>
                                        </div>
                                        <span class="more cursor-pointer">Xem thêm</span>
                                        <?php endif; ?>
                                        <hr class="my-1">

                                        <div class="clearfix"></div>

                                        <?php
                                        if( $view_product_detail_above ){
                                            ?>
                                            <div class="product-detail-above">
                                                <?= $ctsp['description_' . $_SESSION['lang']] ?>
                                            </div>
                                        <?php }?>
                                        <div class="product-detail-price">
                                            <?php
                                            $discountPercent = 0;
                                            if ($ctsp['promotion_price'] < $ctsp['price']) {
                                                $discountPercent = intval(100 - ($ctsp['promotion_price'] / $ctsp['price'] * 100));
                                            }
                                            ?>
                                            <span><?= _price ?>:</span>
                                            <span class="price <?= ($ctsp['promotion_price'] > 0) ? 'old-price' : ''; ?>"><?= ($ctsp['price'] > 0) ? $d->vnd($ctsp['price']) : '<a class="price" href="/lien-he.html" title="Click để liên hệ">' . _lienhe . '</a>'; ?></span>
                                            <?php if ($ctsp['promotion_price'] > 0) { ?>
                                                <span class="price price-km">Giá khuyến mãi : <?= $d->vnd($ctsp['promotion_price']) ?></span>
                                            <?php } ?>
                                            <?php echo '/' . ($item['unit'] ?: 'Cái'); ?>
                                            <?php if($discountPercent > 0): ?>
                                                <span class="fd-discount">- <?php echo $discountPercent; ?>%</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <span>Số lượng:</span>
                                        <span class="input-group quantity-input">
                                            <span class="input-group-btn">
                                                <button class="btn minus-one">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </span>
                                            <input type="number" value="1" min="1" step="1" id="numberOfProduct" class="form-control text-center">
                                            <span class="input-group-btn">
                                                <button class="btn add-one">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </span>
                                        </span>
                                    </div>

                                    <?php if (!empty($ctsp['updated_at'])) { ?>
                                        <div class="product-info">
                                            <p>Được cập nhật lúc: <?php echo $ctsp['updated_at'] ?></p>
                                        </div>
                                    <?php } ?>

                                    <?php echo get_widget_by_category_position($cat_id, 7)?>

                                    <?php
                                    $view_print_price_request = $d->getOption('view_print_price_request');
                                    $view_add_to_cart =  $d->getOption('view_add_to_cart');
                                    $view_request_price =  $d->getOption('view_request_price');
                                    $view_small_button_placeorder = $d->getOption('view_small_button_placeorder');
                                    $view_btn_contact =  $d->getOption('view_btn_contact');
                                    $view_shipping_content =  $d->getOption('view_shipping_content');
                                    $view_return_content =  $d->getOption('view_return_content');

                                    $count_btn = 0;
                                    if($view_print_price_request){
                                        $count_btn+= 1;
                                    }
                                    if($view_add_to_cart){
                                        $count_btn+= 1;
                                    }
                                    if($view_request_price){
                                        $count_btn+= 1;
                                    }
                                    if($view_small_button_placeorder){
                                        $count_btn+= 1;
                                    }
                                    if($view_btn_contact == 'small'){
                                        $count_btn+= 1;
                                    }
                                    ?>

                                    <div class="detail-button-wrap detail-button-group detail-button-group-<?php echo $count_btn?> mb-1 mt-1<?php echo ($count_btn > 2)?' has-print-price':''?>">

                                        <?php if($view_small_button_placeorder){?>
                                            <div class="detail-button-item">
                                                <a href="#dat-hang" type="button" class="btn btn-dathang btn-dathang-sm btn-flat" data-product="<?= $ctsp['id'] ?>" data-title="<?= $ctsp['name_' . $lang] ?>" data-price="<?= $ctsp['price'] ?>" data-detail="true">
                                                    Đặt hàng
                                                </a>
                                            </div>
                                        <?php }?>

                                        <?php if($view_add_to_cart){?>
                                            <div class="detail-button-item">
                                                <a href="javascript:void(0)" type="button" class="btn btn-success btn-flat mr-1" id="addToCart"
                                                   onclick="actionAddToCart(this)"
                                                   data-product="<?= $ctsp['id'] ?>" data-title="<?= $ctsp['name_' . $lang] ?>"
                                                   data-price="<?= $ctsp['price'] ?>" data-detail="true">
                                                    Thêm vào giỏ
                                                </a>
                                            </div>
                                        <?php }?>

                                        <?php if($view_request_price){?>
                                            <div class="detail-button-item">
                                                <button id="product_detail_price_request" type="button" class="btn btn-danger mr-1 addcart" data-product="<?= $item['id'] ?>" data-code="<?= $item['code']; ?>" data-image="<?= $img_baogia ?>" data-title="<?= $ctsp['name_' . $lang] ?>" data-price="<?= $ctsp['price'] ?>" data-detail="true">
                                                    Yêu cầu báo giá
                                                </button>
                                            </div>
                                        <?php }?>

                                        <?php
                                        if( $view_print_price_request ){
                                            ?>
                                            <div class="detail-button-item">
                                                <a class="btn-w" href="/in-bao-gia-san-pham.php?pid=<?php echo $item['id'] ?>" title="In báo giá" target="_blank">
                                                    <button type="button" class="btn btn-danger btn-flat print-price">
                                                        In báo giá
                                                    </button>
                                                </a>
                                            </div>
                                        <?php }?>

                                        <?php if($view_btn_contact == 'small'){?>
                                            <div class="detail-button-item">
                                                <a type="button" class="btn btn-sendmail btn-product-contact btn-flat" href="#lien-he">Liên hệ</a>
                                            </div>
                                        <?php }?>

                                    </div>

                                    <?php if( $view_button_checkorder || $view_button_warrantyonline ){ $vbtn2 = ( $view_button_checkorder && $view_button_warrantyonline )?2:1;?>
                                        <div class="detail-button-wrap detail-button-group detail-button-group-<?php echo $vbtn2?> mb-1">
                                            <?php if($view_button_checkorder){?>
                                                <div class="detail-button-item">
                                                    <a href="#kiem-tra-don-hang" class="btn btn-flat btn-blue btn-checkorder">
                                                        Kiểm tra đơn hàng
                                                    </a>
                                                </div>
                                            <?php }?>

                                            <?php if($view_button_warrantyonline){?>
                                                <div class="detail-button-item">
                                                    <a href="#kich-hoat-bao-hanh" class="btn btn-flat btn-blue btn-warrantyonline">
                                                        Bảo hành online
                                                    </a>
                                                </div>
                                            <?php }?>

                                        </div>
                                    <?php }?>

                                    <?php
                                    $view_button_placeorder = $d->getOption('view_button_placeorder');
                                    if($view_button_placeorder && !$view_small_button_placeorder){
                                        ?>
                                        <div class="detail-button-wrap detail-button-order mb-1">
                                            <a href="#dat-hang" type="button" class="btn btn-dathang btn-flat" data-product="<?= $ctsp['id'] ?>" data-title="<?= $ctsp['name_' . $lang] ?>" data-price="<?= $ctsp['price'] ?>" data-detail="true">
                                                Đặt hàng
                                            </a>
                                        </div>
                                    <?php }?>

                                    <?php if($view_btn_contact == 'large'){?>
                                        <div class="detail-button-wrap detail-button-order mb-1">
                                            <a type="button" class="btn btn-sendmail btn-product-contact btn-lg btn-flat" href="#lien-he">Liên hệ</a>
                                        </div>
                                    <?php }?>

                                    <?php if($view_shipping_content == 1):
                                        $shipping_return = $d->getTemplates(71);
                                        ?>
                                        <div class="shipping-return">
                                            <?php if ($shipping_return['name_' . $lang] != ''): ?>
                                                <div class="title-main">
                                                    <h3><?= $shipping_return['name_' . $lang]; ?></h3>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($shipping_return['content_' . $lang] != ''): ?>
                                                <div class="content-about text-justify">
                                                    <?= $shipping_return['content_' . $lang] ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>

                                </div>
                                <!-- </form> -->
                                <div class="clearfix"></div>
                                <hr class="mt-1 mb-1" />

                                <?php if($view_button_facebook_zalo){?>
                                    <div class="contact-now social-button">
                                        <button href="" class="btn btn-flat facebook collapsed" data-toggle="collapse" data-target="#minhFacebookChat" aria-expanded="false" aria-controls="minhFacebookChat">
                                            Facebook
                                        </button>
                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#modalZalo"
                                           class="btn btn-flat zalo">
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Zalo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </a>
                                        <a href="tel:<?php echo $information['hotline']; ?>" class="btn btn-flat phone">
                                            <i class="fa fa-phone"></i> <?php echo $information['hotline']; ?>
                                        </a>
                                    </div>
                                <?php }?>

                                <?php
                                if($view_button_like_share){
                                    include("ct_share.php");
                                }
                                ?>

                                <div class="clearfix mb10"></div>
                                <?php echo get_widget_by_category_position($cat_id, 6)?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <?php if($vth_logo['name_' . $lang] != ''): ?>
                                <div class="title-main">
                                    <h3><?= $vth_logo['name_' . $lang]; ?></h3>
                                </div>
                            <?php endif; ?>
                            <?php if($vth_logo['content_' . $lang] != ''): ?>
                                <div class="content-about text-justify">
                                    <?= $vth_logo['content_' . $lang] ?>
                                </div>
                            <?php endif; ?>

                            <?php if($our_service['name_' . $lang] != ''): ?>
                                <div class="title-main">
                                    <h3><?= $our_service['name_' . $lang]; ?></h3>
                                </div>
                            <?php endif; ?>
                            <?php if($our_service['content_' . $lang] != ''): ?>
                                <div class="content-about text-justify">
                                    <?= $our_service['content_' . $lang] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="clearfix mb30"></div>
            </div>
        </div>

        <div class="clearfix row-ctcp-top">
            <?php include 'san_pham_tieu_bieu.php'; ?>
        </div>
        <div class="row10 clearfix row-ctcp-top<?php echo $extraClass?>">

            <div class="ctsp-col-left plr10 <?php echo ($has_sidebar)?'col-md-9':'col-md-12'?>">
                <?php include 'tab_chi_tiet_san_pham.php'; ?>
                <?php
                if( $view_vi_tri_form_bao_gia == 'above' ){
                    include 'tab_form_yeu_cau_bao_gia.php'; 
                }
                ?>

                <?php include 'mo_ta_san_pham.php'; ?>

                <?php include 'ct_company_info.php'; ?>
                
            </div><!--/.ctsp-col-left-->

            <?php if($has_sidebar){?>
            <div class="col-md-3 ctsp-col-right plr10 sticky-top">
                <?php
                include 'left.php'; 
                ?>
            </div>
            <?php }?>
            
        </div>

        <div class="end-ctsp-top"></div><!--Use this for end scroll sticky HTTT-->

        <?php include 'ct_product_tabs.php'; ?>

        <?php 
        if( $view_vi_tri_form_bao_gia == 'bellow' ){
            include 'tab_form_yeu_cau_bao_gia.php'; 
        }
        ?>
        
        <div class="row10 clearfix row-ctsp-comment">
            <?php //include 'left.php'; ?>
            <div class="main-content col-md-12 plr10">
                <div class="row10">
                    <?php
                    $tuyChinh1 = $d->getTemplates(51);
                    $tuyChinh2 = $d->getTemplates(52);
                    $tuyChinh3 = $d->getTemplates(53);
                    $tuyChinh4 = $d->getTemplates(67);
                    $tuyChinh5 = $d->getTemplates(68);
                    $tuyChinh6 = $d->getTemplates(69);
                    $chiTietHoTro = $d->getTemplates(58);

                    $view_chi_tiet_san_pham = $d->getOption('view_chi_tiet_san_pham');
                    $view_product_description = $d->getOption('view_product_description');
                    ?>
                    <div class="col-md-12 plr10">
                        <div class="thong_tin">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="active"><a href="#thong_tin_5" aria-controls="thong_tin_5" role="tab" data-toggle="tab"><?= _comment ?></a></li>
                                
                                <?php if( !$view_chi_tiet_san_pham ){?>
                                <li><a href="#thong_tin_2" aria-controls="thong_tin_2" role="tab" data-toggle="tab"><?= _pro_detail ?></a></li>
                                <?php }?>

                                <?php
                                if (!empty($chiTietHoTro['hien_thi'])) {
                                ?>
                                    <li class="hidden-xs"><a href="#thong_tin_6" aria-controls="thong_tin_6" role="tab" data-toggle="tab"><?php echo $chiTietHoTro['name_' . $lang] ?></a></li>
                                <?php } ?>
                                <?php
                                if (!empty($tuyChinh1['hien_thi'])) {
                                ?>
                                    <li class="hidden-xs"><a href="#thong_tin_7" aria-controls="thong_tin_7" role="tab" data-toggle="tab"><?php echo $tuyChinh1['name_' . $lang]; ?></a></li>
                                <?php } ?>
                                <?php
                                if (!empty($tuyChinh2['hien_thi'])) {
                                ?>
                                    <li class="hidden-xs"><a href="#thong_tin_8" aria-controls="thong_tin_8" role="tab" data-toggle="tab"><?php echo $tuyChinh2['name_' . $lang]; ?></a></li>
                                <?php } ?>
                                <?php
                                if (!empty($tuyChinh3['hien_thi'])) {
                                ?>
                                    <li class="hidden-xs"><a href="#thong_tin_9" aria-controls="thong_tin_9" role="tab" data-toggle="tab"><?php echo $tuyChinh3['name_' . $lang]; ?></a></li>
                                <?php } ?>

                                <?php
                                if (!$view_product_description && $tuyChinh4['name_' . $lang]) {
                                ?>
                                    <li class="hidden-xs"><a href="#tuy_chinh_4" aria-controls="tuy_chinh_4" role="tab" data-toggle="tab"><?php echo $tuyChinh4['name_' . $lang]; ?></a></li>
                                <?php } ?>

                                <?php
                                if (!empty($tuyChinh5['hien_thi'])) {
                                ?>
                                    <li class="hidden-xs"><a href="#tuy_chinh_5" aria-controls="tuy_chinh_5" role="tab" data-toggle="tab"><?php echo $tuyChinh5['name_' . $lang]; ?></a></li>
                                <?php } ?>
                                <?php
                                if (!empty($tuyChinh6['hien_thi'])) {
                                ?>
                                    <li class="hidden-xs"><a href="#tuy_chinh_6" aria-controls="tuy_chinh_6" role="tab" data-toggle="tab"><?php echo $tuyChinh6['name_' . $lang]; ?></a></li>
                                <?php } ?>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="thong_tin_5">
                                    <div class="comment-facebook">
                                        <div class="fb-comments" data-href="<?= $url_page ?>" data-numposts="5" data-width="100%"></div>
                                    </div>
                                </div>

                                <?php if( !$view_chi_tiet_san_pham ){?>
                                <div role="tabpanel" class="tab-pane fade" id="thong_tin_2">
                                  
                                    <div class="row10 clearfix">
                                        <div class="<?php echo ($view_vi_tri_form_bao_gia != 'hidden')?'col-md-6':'col-md-12'?>">
                                            <?php
                                            $isShowPrice = true;
                                            $item = $ctsp;
                                            include 'ct_tooltip.php';
                                            $isShowPrice = false;
                                            echo $title;
                                            ?>
                                        </div>

                                        <?php if($view_vi_tri_form_bao_gia != 'hidden'){?>
                                        <div class="col-md-6">
                                            <?php
                                            include 'ct_form_lienhe.php';
                                            ?>
                                        </div>
                                        <?php }?>

                                    </div>

                                    <div class="clearfix mb15"></div>

                                    <?php if( $view_product_detail_below ){?>
                                    <div class="product-detail-below">
                                        <?= $ctsp['description_' . $_SESSION['lang']] ?>
                                    </div>
                                    <?php }?> 


                                    <?php
                                    if (!empty($ctsp['category_id'])) {
                                        $whereCatIds = "AND (category_id = " . $ctsp['category_id'];
                                        $cat = $d->simple_fetch('SELECT category_id FROM #_category WHERE id=' . $ctsp['category_id']);
                                        if (!empty($cat['category_id'])) {
                                            $catId = $cat['category_id'];
                                            $whereCatIds .= " OR category_id = " . $catId;
                                            while (!empty($catId)) {
                                                $cat = $d->simple_fetch('SELECT category_id FROM #_category WHERE id=' . $catId);
                                                $catId = $cat['category_id'];
                                                if (empty($catId)) {
                                                    break;
                                                }
                                                $whereCatIds .= " OR category_id = " . $catId;
                                            }
                                        }
                                        $whereCatIds .= ")";

                                        $query = "select name_" . $lang . ", content_" . $lang . "
                                            FROM #_widget w INNER JOIN #_widget_category wc ON w.id = wc.widget_id
                                            WHERE content_" . $lang . " IS NOT NULL
                                                AND is_active = 1
                                                AND group_id = 1
                                                " . $whereCatIds . "
                                            ORDER BY weight ASC, w.id DESC
                                            ";
                                        $widgets = $d->o_fet($query);
                                    ?>
                                        <?php foreach ($widgets as $widget) : ?>
                                            <div class="clearfix mb15"></div>
                                            <div class="widget-content">
                                                <h3 class="mt-0 mt-000"><?php echo $widget['name_' . $lang] ?></h3>
                                                <?php echo $widget['content_' . $lang] ?>
                                            </div>
                                        <?php endforeach ?>

                                        <div class="clearfix mb15"></div>
                                    <?php } ?>
                                </div>
                                <?php }?>
                                
                                <?php
                                if (!empty($chiTietHoTro['hien_thi'])) {
                                ?>
                                    <div role="tabpanel" class="tab-pane fade" id="thong_tin_6">
                                        <?php
                                        echo $chiTietHoTro['content_' . $lang];
                                        ?>
                                    </div>
                                <?php } ?>
                                <?php
                                if (!empty($tuyChinh1['hien_thi'])) {
                                ?>
                                    <div role="tabpanel" id="thong_tin_7" class="tab-pane fade">
                                        <?php echo $tuyChinh1['content_' . $lang]; ?>
                                    </div>
                                <?php } ?>
                                <?php
                                if (!empty($tuyChinh2['hien_thi'])) {
                                ?>
                                    <div role="tabpanel" id="thong_tin_8" class="tab-pane fade">
                                        <?php echo $tuyChinh2['content_' . $lang]; ?>
                                    </div>
                                <?php } ?>
                                <?php
                                if (!empty($tuyChinh3['hien_thi'])) {
                                ?>
                                    <div role="tabpanel" id="thong_tin_9" class="tab-pane fade">
                                        <?php echo $tuyChinh3['content_' . $lang]; ?>
                                    </div>
                                <?php } ?>
                                <?php
                                if (!$view_product_description  && $tuyChinh4['name_' . $lang]) {
                                ?>
                                    <div role="tabpanel" id="tuy_chinh_4" class="tab-pane fade">
                                        <?php echo $tuyChinh4['content_' . $lang]; ?>

                                        <?php
                                        $widgets = $d->o_fet(
                                            "select name_" . $lang . ", content_" . $lang . "
										FROM #_widget w INNER JOIN #_widget_category wc ON w.id = wc.widget_id
										WHERE content_" . $lang . " IS NOT NULL
											AND is_active = 1
											AND group_id = 2
											" . $whereCatIds . "
										ORDER BY weight ASC, w.id DESC
										"
                                        );
                                        ?>
                                        <?php foreach ($widgets as $widget) : ?>
                                            <div class="clearfix mb15"></div>
                                            <div class="widget-content">
                                                <h3 class="mt-0"><?php echo $widget['name_' . $lang] ?></h3>
                                                <?php echo $widget['content_' . $lang] ?>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                <?php } ?>
                                <?php
                                if (!empty($tuyChinh5['hien_thi'])) {
                                ?>
                                    <div role="tabpanel" id="tuy_chinh_5" class="tab-pane fade">
                                        <?php echo $tuyChinh5['content_' . $lang]; ?>

                                        <?php
                                        $widgets = $d->o_fet(
                                            "select name_" . $lang . ", content_" . $lang . "
										FROM #_widget w INNER JOIN #_widget_category wc ON w.id = wc.widget_id
										WHERE content_" . $lang . " IS NOT NULL
											AND is_active = 1
											AND group_id = 3
											" . $whereCatIds . "
										ORDER BY weight ASC, w.id DESC
										"
                                        );
                                        ?>
                                        <?php foreach ($widgets as $widget) : ?>
                                            <div class="clearfix mb15"></div>
                                            <div class="widget-content">
                                                <h3 class="mt-0"><?php echo $widget['name_' . $lang] ?></h3>
                                                <?php echo $widget['content_' . $lang] ?>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                <?php } ?>
                                <?php
                                if (!empty($tuyChinh6['hien_thi'])) {
                                ?>
                                    <div role="tabpanel" id="tuy_chinh_6" class="tab-pane fade">
                                        <?php echo $tuyChinh6['content_' . $lang]; ?>

                                        <?php
                                        $widgets = $d->o_fet(
                                            "select name_" . $lang . ", content_" . $lang . "
										FROM #_widget w INNER JOIN #_widget_category wc ON w.id = wc.widget_id
										WHERE content_" . $lang . " IS NOT NULL
											AND is_active = 1
											AND group_id = 4
											" . $whereCatIds . "
										ORDER BY weight ASC, w.id DESC
										"
                                        );
                                        ?>
                                        <?php foreach ($widgets as $widget) : ?>
                                            <div class="clearfix mb15"></div>
                                            <div class="widget-content">
                                                <h3 class="mt-0"><?php echo $widget['name_' . $lang] ?></h3>
                                                <?php echo $widget['content_' . $lang] ?>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="clearfix mb20"></div>
                        <div id="relatedProduct" class="title-main title-font">
                            <h3><?= _pro_relative ?></h3>
                            
                            <div class="pull-right ctsp-perpage">
								<form>Hiển thị:
									<select name="perpage" onchange="this.form.submit()">
										<?php
										$nums = array(12, 24, 36, 42, 60, 120, 180);
										foreach ($nums as $num) {
											echo '<option' . ($num == $maxR ? ' selected' : '') . '>' . $num . '</option>';
										}
										?>
									</select>
								</form>
							</div>

                            <div class="btn-group pull-right ctsp-layout">
								<?php include 'parts/change-layout-buttons.php'; ?>
							</div>
                           
                        </div>
                        <div class="clearfix"></div>
                        <div class="row10 product-grid-6">
                            <?php include("ct_product.php"); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'san_pham_tieu_bieu_default.php'; ?>

<style type="text/css">
    /*button.style-bt{ position: absolute; top: 50%; margin-top: -20px; border: 0; background: #ddd; padding: 10px 5px; z-index: 99; outline: none; display: none; }
    button.bt-pre{ left: 10px; }
    button.bt-next{ right: 10px; }
    button.style-bt:hover{ background: #ccc; }
    .owl_img_detail:hover button.style-bt{ display: block; }*/
</style>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        window.mainSlider = $('.owl_img_detail').slick({
            slidesToShow: 5,
            infinite: true,
            prevArrow: "<button class='style-bt bt-pre'><i class='fa fa-chevron-left'></i></button>",
            nextArrow: "<button class='style-bt bt-next'><i class='fa fa-chevron-right'></i></button>",
            autoplay: true,
            autoplayTimeout: 6000,
            autoplayHoverPause: true
        });

        $('.choose-color > span').click(function(event) {
            var id = $(this).attr('rel');
            $('.choose-color').removeClass('selected');
            $(this).parent('.choose-color').addClass('selected');
            $('.in-color').val(id);
        });
        $('.choose-size > span').click(function(event) {
            var id = $(this).attr('rel');
            $('.choose-size').removeClass('selected');
            $(this).parent('.choose-size').addClass('selected');
            $('.in-size').val(id);
        });
    });
</script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript">
    function moneyFormat(n, c = 0, d = ',', t = '.') {
        c = isNaN(c = Math.abs(c)) ? 2 : c,
            d = d == undefined ? "." : d,
            t = t == undefined ? "," : t,
            s = n < 0 ? "-" : "",
            i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
            j = (j = i.length) > 3 ? j % 3 : 0;

        return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
    }
    function thanhtien(id, iddh) {
        var cls = ".thanhtien_" + id;
        $.ajax({
            url: "./sources/ajax.php",
            type: 'POST',
            data: {
                'do': 'thanh_tien',
                'id': id,
                'iddh': iddh
            },
            success: function(data) {
                $(cls).html(data);
            }
        })
    }

    function tongtien(id, iddh) {
        $.ajax({
            url: "./sources/ajax.php",
            type: 'POST',
            data: {
                'do': 'tong_tien',
                'id': id,
                'iddh': iddh
            },
            success: function(data) {
                $("#tong_tien_gh").html(data);
            }
        })
    }
    const Wind = {
        province: <?php echo !empty($_SESSION['delivery_area']) ? json_encode($_SESSION['delivery_area']) : '{}'; ?>,
        products: <?php echo json_encode($cartProducts); ?>,
        total: <?php echo $tongtien ?: 0; ?>
    };
    var elDeliveryFee = $('#delivery_fee');
    var elTotalFee = $('#tong_tien_gh');

    function updateUndefineArea() {
        elDeliveryFee.html('Thông báo sau!');
    }

    function handleGetDeliveryFee(e) {
        e.preventDefault();
        const name = e.target.value;

        $.ajax({
            url: '/api.php',
            method: 'POST',
            data: {
                func: 'get_area_by_name',
                name,
            },
            dataType: 'json',
            success: data => {
                if (!data.isSuccess) {
                    alert('Fail!');
                    return;
                }

                Wind.province = data.delivery_area || {};

                updateFee();
            },
            error: err => {
                alert('Fail!');
                console.log(err);
            },
        });
    }

    function updateFee() {
        if (!Wind.province.price) {
            elDeliveryFee.html('Thông báo sau!');
            elTotalFee.html(moneyFormat(Wind.total) + 'đ');
        } else {
            elDeliveryFee.html(moneyFormat(+Wind.province.price) + 'đ');
            elTotalFee.html(moneyFormat(+Wind.province.price + Wind.total) + 'đ');
        }

    }
    $(document).ready(function() {
        getAllProvince();
        $('#province').on('change', handleSelectProvince);
        $('#county').on('change', handleSelectCounty);
        updateFee();

        $('body').on('click', '#add-voucher', function() {
            const $voucher = $('#voucher');
            const voucher = $voucher.val();
            if (voucher.trim().length === 0) {
                swal({
                    title: "Vui lòng nhập mã của bạn!",
                    type: "info",
                    confirmButtonClass: 'btn-primary',
                    confirmButtonText: 'OK'
                });

                return;
            }
            // Show loading
            swal("Đang kiểm tra...");
            sweetAlert.disableButtons();

            setTimeout(function() {
                $voucher.val('');
                swal({
                    title: "Không tìm thấy mã: " + voucher,
                    type: "error",
                    confirmButtonClass: 'btn-danger',
                    confirmButtonText: 'OK'
                });
            }, 1500);
        });
    });
</script>
<script type="text/javascript">
    <?php
    $data = array(
        'id' => $ctsp['id'],
        'image' => $ctsp['image_path_origin'],
        'name_vi' => $ctsp['name_vi'],
        'name_en' => $ctsp['name_en'],
        'name_ch' => $ctsp['name_ch'],
        'url' => $_SERVER['REQUEST_URI']
    );
    if (empty($data['image'])) {
		$data['image'] = $d->getDefaultProductImage(300, 220);
	} else {
		$data['image'] = THUMB_BASE . 'images/300/220/' . $data['id'] . '/' . $data['image'];
	}

    ?>
    currentProduct = <?php echo json_encode($data); ?>;

    var recentViewed = localStorage.getItem('recentViewed');
    if (recentViewed != null) {
        recentViewed = JSON.parse(recentViewed);
    }

    if (!Array.isArray(recentViewed)) {
        recentViewed = [];
    }

    var indexOfCurrent = recentViewed.findIndex(function(product) {
        return +product.id == +currentProduct.id;
    });
    if (indexOfCurrent === -1) {
        recentViewed.push(currentProduct);
        localStorage.setItem('recentViewed', JSON.stringify(recentViewed));
    }


    $(document).ready(function($) {

        $('.more.cursor-pointer').on('click', function () {
            if($('.product-info .inner').hasClass('expanded')) {
                $(this).html('Xem thêm');
                $('.product-info .inner').removeClass('expanded');
            } else {
                $('.product-info .inner').addClass('expanded');
                $(this).html('Thu gọn');
            }
        });

        const quantityInput = $('#numberOfProduct');
        // const elDeliveryFee = $('#delivery_fee');
        // const elTotalPrice = $('#totalForProduct');
        const updateInput = value => {
            quantityInput.val(value);
            // updateFee();
        };

        $('.quantity-input .add-one').on('click', function(e) {
            var value = quantityInput.val();
            updateInput(++value);
        });
        $('.quantity-input .minus-one').on('click', function(e) {
            var value = quantityInput.val();
            if (--value < 1) {
                return
            }
            updateInput(value);
        });

        $('.detail-button-wrap .addToCart').click(function(e) {
            const id = $(this).data('product');
            const soluong = $('#numberOfProduct').val();

            const data = {
                id,
                soluong,
                func: 'addToCart',
            };

            const success = (res) => {

                $('#modalBackdrop').removeClass('hidden').animate({
                    opacity: 0.3
                }, 500);
                $(this).effect("transfer", {
                    to: "#cart",
                    className: "add-to-cart-effect"
                }, 500, () => $('#modalBackdrop').animate({
                    display: "block !important",
                    opacity: 0.3
                }, 500).addClass('hidden'));

                updateProductInCart();

            };

            const error = (res) => {
                alert('Thêm sản phẩm vào giỏ hàng không thành công, vui lòng thử lại!');
            };

            $.ajax({
                url: '/api.php',
                method: 'POST',
                data,
                success,
                error,
            });

        });
        /*
        function loadCartInfo(){
            $.ajax({
                type: 'GET',
                url: 'ajax/ajax_cartInfo.php',
                dataType : 'html',
                success: (res) => {
                    $('#modalDathang .modal-body').html(res);
                },
            });
        }*/

        $('.detail-button-wrap .btn-dathang').click(function(e) {
            const id = $(this).data('product');
            const soluong = $('#numberOfProduct').val();

            const data = {
                id,
                soluong,
                func: 'addToCart',
            };

            const error = (res) => {
                alert('Thêm sản phẩm vào giỏ hàng không thành công, vui lòng thử lại!');
            };

            const success = (res) => {
                updateProductInCart();
                //loadCartInfo();
                //$('#modalDathang .modal-body').load('ajax/ajax_cartInfo.php');
                $('#modalDathang .dathang-cart').load('ajax/ajax_cartInfo.php');
                $('#modalDathang').modal('show');
            };

            $.ajax({
                url: '/api.php',
                method: 'POST',
                data,
                success,
                error,
            });

            return false;
        });

        $('.slider-doitacs').slick({
            slidesToShow: 7,
            autoplay: true,
            autoplaySpeed: 4000,
            prevArrow: "<button class='style-bt bt-prev'><i class='fa fa-chevron-left'></i></button>",
            nextArrow: "<button class='style-bt bt-next'><i class='fa fa-chevron-right'></i></button>",
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 6,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 5,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                }
            ],
        });

        $('.slider-doitacs-2').slick({
            slidesToShow: 7,
            autoplay: true,
            autoplaySpeed: 4000,
            prevArrow: "<button class='style-bt bt-prev'><i class='fa fa-chevron-left'></i></button>",
            nextArrow: "<button class='style-bt bt-next'><i class='fa fa-chevron-right'></i></button>",
            responsive: [{
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                }
            ],
        });

        //update cart popup

        function chang_soluong(obj, id, iddh) {
            var sl = $(obj).val();
            $.ajax({
                url: "./sources/ajax.php",
                type: 'POST',
                data: {
                    'do': 'change_so_luong',
                    'id': id,
                    'iddh': iddh,
                    'sl': sl
                },
                success: function(data) {
                    if (data == 0) {
                        alert("Số lượng nhập không hợp lệ!");
                    } else {
                        //console.log(data);
                        //window.location.href = "<?= URLPATH ?>gio-hang.html";
                        // thanhtien(id,iddh);
                        // tongtien(id,iddh);
                    }
                }
            })
            return;
        }

        function updateInput2(input, value, pid) {
            input.value = value;
            chang_soluong(input, pid, '<?= @$_SESSION['iddonhang'] ?>');
        };

        $('body').on('click', '.cart-quantity-input .add-one', function(e) {
            var quantityInput = e.target.parentElement.parentElement.parentElement.querySelector('input');
            window.minh = e;
            var value = quantityInput.value;
            var pid = $(this).attr('data-product');
            updateInput2(quantityInput, ++value, pid);
            return false;
        });

        $('body').on('click', '.cart-quantity-input .minus-one', function(e) {
            var quantityInput = e.target.parentElement.parentElement.parentElement.querySelector('input');
            var value = quantityInput.value;
            var pid = $(this).attr('data-product');
            if (--value < 1) {
                return;
            }
            updateInput2(quantityInput, value, pid);
            return false;
        });

        function xoa_sp_gh_dh(id, iddh, al) {
            var cf = confirm(al);
            if (cf) {
                $.ajax({
                    url: "./sources/ajax.php",
                    type: 'POST',
                    data: {
                        'do': 'xoa_sp_gh',
                        'id': id,
                        'iddh': iddh
                    },
                    success: function(data) {
                        updateProductInCart();
                        $('#modalDathang .dathang-cart').load('ajax/ajax_cartInfo.php');
                    }
                })
            }
        }

        $('body').on('click', '#modalDathang .xoa_sp_gh_dh', function (e) {
            e.preventDefault();
            var id = $(this).attr('data-product');
            var iddh = $(this).attr('data-cart-item');
            var al = $(this).attr('data-confirm');
            
            xoa_sp_gh_dh(id, iddh, al);
            return false;
        });

        $(document).on('click', '.payment-method input', function(){
            $('.payment-method').removeClass('payment-method-active');
            $(this).parent().toggleClass('payment-method-active');
        });

        $(document).on('click', '.company_order', function(){
            if( $(this).is(":checked") ){
                $('.company-order-wrap').addClass('active');
            } else {
                $('.company-order-wrap').removeClass('active');
            }
        });

    });
</script>

<div class="modal fade" id="modalDathang" tabindex="-1" role="dialog" aria-labelledby="modalDathang" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Sản phẩm [<?php echo $ctsp['name_' . $lang]?>] đã được thêm vào giỏ hàng</h4>
            </div>
            <div class="modal-body">
                <?php //print_r($_SESSION['cart'])?>
                <form action="" id="form-shopping" class="form-horizontal form-shopping" method="post">
                <div class="row">
                    <div class="col-md-5">
                        <div class="dathang-form"><?php include 'form-dat-hang.php';?></div>
                    </div>
                    <div class="col-md-7">
                        <div class="title-form text-uppercase">Thông tin đơn hàng</div>
                        <div class="dathang-cart"></div>
                        
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    @media (min-width: 992px){
        .shipping-content-wrap{
            display: flex;
            flex-wrap: wrap;
        }
        .shipping-content-col{
            width: 50%;
            padding-left: 5px;
            padding-right: 5px;
        }
    }
    
    .shipping-inner {
        background-position: 8px center;
        background-repeat: no-repeat;
        background-size: 38px;
        background-color: #f8f8f8;
        padding: 10px 10px 10px 60px;
        margin-bottom: 15px;
    }
    .shipping-content-item {
        background-image: url('../templates/images/delivery.png');
    }
    .return-content-item {
        background-image: url('../templates/images/cash-back.png');
    }

    .slider-doitacs .img-slogan img {
        height: 140px;
        margin: 0 auto;
    }

    .slider-doitacs-2 .img-slogan img {
        height: 160px;
        margin: 0 auto;
    }

    .slider-doitacs-2 .max-line-2 {
        height: 3.7rem !important;
        max-height: 3.7rem !important;
    }
</style>