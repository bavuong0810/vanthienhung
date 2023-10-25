<?php
($com != '') ? $linkcom = "&langcom=" . $com : $linkcom = '';

$view_menu_type =  $d->getOption('view_menu_type');
$view_menu_brand_type =  $d->getOption('view_menu_brand_type');
$view_menu_brand_button =  $d->getOption('view_menu_brand_button');
$view_menu_category_brand =  $d->getOption('view_menu_category_brand');
$view_count_product = $d->getOption('view_count_product');
$view_category_page =  $d->getOption('view_category_page');
?>

<header class="site-header">
    <div class="top-bar">
        <div class="container main-topbar">
            <div class="row10 row-top">
                <div class="col-top col-md-8 col-xs-12 plr10 hidden-xs">
                    <ul class="nav-topbar">
                        <li>
                            <a href="/admin" title="Dành cho đại lý">
                                <span>Dành cho đại lý</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" title="Yêu cầu báo giá" class="show-price-request">
                                <span class="divider">Yêu cầu báo giá</span>
                            </a>
                        </li>
                        <li>
                            <a class="btn-checkorder" href="#kiem-tra-don-hang" title="Kiểm tra đơn hàng">
                                <span class="divider">Kiểm tra đơn hàng</span>
                            </a>
                        </li>
                        <li>
                            <a class="btn-warrantyonline" href="#kich-hoat-bao-hanh" title="Bảo hành online">
                                <span class="divider">Bảo hành online</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" title="Liên hệ" data-toggle="modal" data-target="#sendEmailModal">
                                <span class="divider">Liên hệ</span>
                            </a>
                        </li>
                        <li class="has-dropdw">
                            <a href="javascript:void(0)" class="httt-nav-top" data-toggle="modal" data-target="#supportModal">
                                <span class="divider">Hỗ trợ trực tuyến</span>
                            </a>
                            <?php
                            //show ho tro truc tuyen submenu topbar
                            $support_menu = $d->o_fet("select * from #_hotro where hien_thi=1 order by so_thu_tu asc, id desc");
                            if($support_menu){
                            ?>
                            <div class="httt-dropdown-box">
                                <div class="container p0">
                                    <div class="row">
                                    <?php foreach ($support_menu as $mitem) { ?>
                                        <div class="col-md-3 col-sm-12">
                                            <div class="support-menu">
                                                <div class="phone">
                                                    <i class="fa fa-phone"></i>
                                                    <span class="so-dt"><?=$mitem['name_vi']?></span>
                                                </div>
                                                <div class="title-hotro hot-zalo">
                                                    <span class="name"><strong><?=$mitem['sdt']?></strong></span>
                                                    <a class="btn btn-default btn-circle" href="skype:<?=$mitem['skype']?>?chat">
                                                        <img src="templates/images/skype.png" width="20" alt="skype">
                                                    </a>
                                                    <a class="btn btn-default btn-circle" href="https://zalo.me/<?=$mitem['yahoo']?>">
                                                        <img src="templates/images/zalo.png" width="20" class="zalo">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }?>
                                    </div>
                                </div>
                            </div>
                            <?php }?>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 col-xs-12 plr10 text-right">
                    <span class="topbar-hotline"><span class="hidden-xs">Hotline:</span> <strong><?= $SETTINGS['tell_contact']['value'] ?></strong></span>
                    <span class="register-login divider">
                        Ngôn ngữ:
                        <a href="<?= URLPATH ?>?lang=vi<?= @$linkcom ?>" title="VI">
                            <img src="templates/images/vn.png" width="40" height="24" alt="VI">
                        </a>
                        <?php if ($information['lang_us']) { ?>
                            <a href="<?= URLPATH ?>?lang=en<?= @$linkcom ?>" title="EN">
                                <img src="templates/images/us.png" width="40" height="24" alt="EN">
                            </a>
                        <?php } ?>
                        <?php if ($information['lang_ch']) { ?>
                            <a href="<?= URLPATH ?>?lang=ch<?= @$linkcom ?>" title="CN">
                                <img src="templates/images/ch.png" width="40" height="24" alt="CN">
                            </a>
                        <?php } ?>
                    </span>
                </div>
            </div>
        </div>
        
    </div><!--/endtopbar-->

    <div class="top-header">
        <div class="container p01">
            <div class="row10">
                <div class="col-md-2 col-xs-12 plr10">
                    <div class="logo-top mb-1">
                        <a href="<?= URLPATH ?>" title="Home">
                            <img src="<?= URLPATH ?>img_data/images/<?php echo $SETTINGS['website_logo']['value']; ?>" alt="banner" style="max-height: 80px; vertical-align: bottom;">
                        </a>
                    </div>
                </div>
                <div class="col-md-6 hidden-xs hidden-sm plr10">
                    <form method="get" action="/search.html">
                        <div class="search-box">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" value="<?php echo @$_GET['textsearch']; ?>" name="textsearch" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?= _typekey ?>'" placeholder="<?= _typekey ?>" required>
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-warning">
                                            <i class="fa fa-search"></i> Tìm kiếm
                                        </button>
                                        <a href="/search.html?advanced-search=true" class="btn btn-primary">
                                            Nâng cao <i class="fa fa-chevron-right"></i>
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-4">
                    <div class="mt-1 col-md-12">
                        <div class="pull-left hidden-xs" id="recent-viewed">
                            <span class="pull-left">
                                Sản phẩm vừa xem
                            </span>
                        </div>
                        <a href="javascript:void(0)" title="Giỏ hàng" onclick="openCartModal()" class="pull-right ml-1 cart-info">
                            <span class="chat-button cart" id="cart">
                                <span class="badge" id="productInCart">0</span>
                                <i class="fa fa-shopping-cart"></i>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="keep-navbar amazon">
        <div class="container">
            <div class="header-nav-wrap<?php echo $view_menu_brand_button?' view-brand-button':''?>">       
                
                <?php if($view_menu_brand_button){?>         
                <div class="cate-nav">
                    <ul>
                        <li class="globe-sub open">
                            <?php if($view_category_page){?>
                                <a href="danh-muc-san-pham.html">
                                    <i class="fa fa-bars"></i>
                                    <span class="text-title">Danh mục hàng</span>
                                    <i class="fa fa-chevron-down"></i>
                                </a>
                                <div class="sub-menu animated fadeIn">
                                    <?php if (!__IS_MOBILE) include 'menu-desktop.php'; ?>
                                </div>
                            <?php } else {?>
                                <a href="#">
                                    <i class="fa fa-bars"></i>
                                    <span class="text-title">Danh mục hàng</span>
                                    <i class="fa fa-chevron-down"></i>
                                </a>
                                <div class="sub-menu animated fadeIn">
                                    <?php if (!__IS_MOBILE) include 'menu-desktop.php'; ?>
                                </div>
                            <?php }?>
                        </li>
                    </ul>
                    <input type="hidden" name="menu-global-slide" value="2" />
                </div>
                <?php }?>
                
                <?php ?>
                <ul class="nav navbar-nav main-menu">

                    <?php 
                    $categories_menu = $d->o_fet("select * from #_category where hien_thi=1 and is_hot=1 order by so_thu_tu asc");

                    if( $view_menu_category_brand == '1' || $view_menu_category_brand == '2' ){
                        $brand_only = $d->o_fet("select slug, name, so_luong from #_brand where is_show=1 and is_featured=1 order by name asc");
                        
                        if( $brand_only && $view_menu_category_brand == '1' ){
                            foreach( $brand_only  as $brand_on ){?>
                            <li>
                                <a href="<?php echo URLPATH . 'nhan-hieu/'. $brand_on['slug']?>.html">
                                    <?php echo $brand_on['name']?>
                                </a>
                            </li>
                            <?php }//end foreach brandonly
                        
                        } else {//end if only brand

                            if( $categories_menu ){
                                foreach( $categories_menu as $mcat ){
                                    $mcat_id = $mcat['id'];
                                    $categories_menu_sub = $d->o_fet("select * from #_category where hien_thi=1 and category_id=$mcat_id order by so_thu_tu asc");
                            ?>
                                <li class="<?php echo $categories_menu_sub?'dropdown':''?> <?php echo count($categories_menu_sub) < 10?'dropdown-container':'dropdown-fullwidth'?>">
                                    <a class="<?php echo $categories_menu_sub?'dropdown-toggle':''?>" href="<?php echo $mcat['alias_vi']?>.html">
                                        <?php echo $mcat['name_vi']?>
                                        <?php echo ($categories_menu_sub && $view_menu_type)?'<span class="caret"></span>':''?>
                                    </a>
                                    
                                    <?php 
                                    if( $categories_menu_sub && $view_menu_type ){
                                        echo '<ul class="dropdown-menu fadeInUp animate1">';
                                        foreach( $categories_menu_sub as $category_menu_sub ){
                                    ?>
                                            <li>
                                                <a href="<?php echo $category_menu_sub['alias_vi']?>.html">
                                                    <?php echo $category_menu_sub['name_vi']?>

                                                    <?php if ($view_count_product){?>
                                                    <span class="pcount" style="font-weight:400;"> (<?php echo count_category_product_number($category_menu_sub['id'])?>)</span>
                                                    <?php }?>
                                                </a>

                                            </li>
                                    <?php
                                        }
                                        echo '</ul>';
                                    }
                                    ?>
                                </li>
                            <?php
                                }
                            }

                            if( $brand_only ){
                                foreach( $brand_only  as $brand_on ){?>
                                <li>
                                    <a href="<?php echo URLPATH . 'nhan-hieu/'. $brand_on['slug']?>.html">
                                        <?php echo $brand_on['name']?>
                                    </a>
                                </li>
                                <?php }//end foreach brandonly
                            
                            }

                        }//category & brand

                    }else { //else $view_menu_category_brand?>

                        <?php if( !$view_menu_brand_type ){?>
                        <li class="dropdown dropdown-fullwidth btn-brand-menu-item">
                            <a href="/nhan-hieu.html" class="dropdown-toggle btn-brand-menu-link">Nhãn hiệu <span class="caret"></span></a>
                            <?php 
                                include 'menu-nhan-hieu.php'; 
                            ?>
                        </li>
                        <?php }?>

                        <?php
                        if( $categories_menu ){
                            foreach( $categories_menu as $mcat ){
                                $mcat_id = $mcat['id'];
                                $categories_menu_sub = $d->o_fet("select * from #_category where hien_thi=1 and category_id=$mcat_id order by so_thu_tu asc");
                        ?>
                            <li class="<?php echo $categories_menu_sub?'dropdown':''?> <?php echo count($categories_menu_sub) < 10?'dropdown-container':'dropdown-fullwidth'?>">
                                <a class="<?php echo $categories_menu_sub?'dropdown-toggle':''?>" href="<?php echo $mcat['alias_vi']?>.html">
                                    <?php echo $mcat['name_vi']?>
                                    <?php echo ($categories_menu_sub && $view_menu_type)?'<span class="caret"></span>':''?>
                                </a>
                                
                                <?php 
                                if( $categories_menu_sub && $view_menu_type ){
                                    echo '<ul class="dropdown-menu fadeInUp animate1">';
                                    foreach( $categories_menu_sub as $category_menu_sub ){
                                ?>
                                        <li>
                                            <a href="<?php echo $category_menu_sub['alias_vi']?>.html">
                                                <?php echo $category_menu_sub['name_vi']?>
                                                
                                                <?php if ($view_count_product){?>
                                                <span class="pcount" style="font-weight:400;"> (<?php echo count_category_product_number($category_menu_sub['id'])?>)</span>
                                                <?php }?>
                                            </a>

                                        </li>
                                <?php
                                    }
                                    echo '</ul>';
                                }
                                ?>
                            </li>
                        <?php
                            }
                        }
                        ?>

                        <?php if( $view_menu_brand_type ){?>
                        <li class="dropdown btn-brand-menu-item<?php echo $view_menu_brand_type?' dropdown-container':''?>">
                            <a href="/nhan-hieu.html" class="dropdown-toggle btn-brand-menu-link">Nhãn hiệu 
                                <span class="caret"></span>
                            </a>
                            <?php 
                                include 'menu-nhan-hieu-group.php'; 
                            ?>
                        </li>
                        <?php }?>

                    <?php }?>
                </ul>
            </div>
        </div>

        <script defer="defer">
            // isIndex = <?php echo $source == 'index' ? 'true' : 'false'; ?>;
            isIndex = false;
            isMenuOpen = false;
            const navbarOffsetTop = $('.keep-navbar').offset().top;

            if (!isIndex) {
                $('.keep-navbar .cate-nav ul li.globe-sub').removeClass('open');
            }

            $(window).scroll(function() {
                if ($(this).scrollTop() > navbarOffsetTop) {
                    $('.keep-navbar').addClass('fixed');
                    if (!isMenuOpen) {
                        $('.keep-navbar .cate-nav ul li.globe-sub').removeClass('open');
                    }
                } else {
                    $('.keep-navbar').removeClass('fixed').removeClass('open');
                    if (isIndex) {
                        $('.keep-navbar .cate-nav ul li.globe-sub').addClass('open');
                    }
                }
            });

            // const toggleMenu = e => {
            //     e.preventDefault();
            //     $('.keep-navbar .cate-nav ul li.globe-sub').toggleClass('open');
            //     isMenuOpen = !isMenuOpen;
            // };

            $('.keep-navbar .cate-nav ul li.globe-sub').on('mouseenter', () => {
                $('.keep-navbar .cate-nav ul li.globe-sub').addClass('open');
                $('.backdrop-menu').fadeIn();
                isMenuOpen = true;
            });
            $('.keep-navbar .cate-nav ul li.globe-sub').on('mouseleave', () => {
                isMenuOpen = false;
                $('.backdrop-menu').fadeOut();
                if (isIndex && $(window).scrollTop() <= navbarOffsetTop) {
                    return;
                }

                $('.keep-navbar .cate-nav ul li.globe-sub').removeClass('open');
            });

            $('.main-menu .dropdown-toggle').hover(function(){
                //var offset = $(this).offset().top;
                //alert(offset);
                //$(this).siblings('.dropdown-menu').css('top', offset);
                //$('.httt-dropdown-box').show();
            });
            

        </script>
    </div>
    <?php
    if (__IS_MOBILE) {
    ?>
        <div id="mobile_menu">
            <div class="header">
                <a href="#menu"><span class="fa fa-bars" title="Danh mục sản phẩm"></span></a>
                <form method="get" action="index.php">
                    <input type="hidden" name="com" value="search">
                    <input type="text" name="textsearch" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?= _typekey ?>'" placeholder="<?= _typekey ?>" class="form-control">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
            <nav id="menu">
                <?php include 'mmenu.php'; ?>
            </nav>
        </div>

    <?php
    }
    ?>
</header>
<div class="backdrop-menu"></div>
<div class="clearfix"></div>
<?php
if ($source == 'index') {
    include 'slider.php';
}
?>

<style type="text/css">
    .top-bar{
        position: relative;
    }
    .col-top{
        position: static;
    }
    .main-topbar{
        position: static;
    }
    .main-topbar a{
        display: inline-block;
        padding-top: 8px;
        padding-bottom: 8px;
    }
    .main-topbar a.btn-circle{
        padding: 6px;
    }

    .top-bar .main-topbar .row10>div {
        padding-top: 0;
        padding-bottom: 0;
    }
    .nav-topbar{
        display: flex;
        flex-wrap: wrap;
        margin: 0;
        padding: 0;
        list-style: none;
    }
    .nav-topbar li{
        margin: 0;
        padding: 0;
    }
    .has-dropdw:hover .httt-dropdown-box{
        display: block;
    }
    .httt-menu-item{
        width: 100% !important;
    }
    .httt-menu-item .row{
        margin: 0 !important;
        width: 100% !important;
    }
    .support-menu{
        padding: 20px;
    }
    .httt-dropdown-box{
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        z-index: 9999;
        background-color: #ffffff;
        color: #333333;
    }
    .httt-dropdown-box ul{
        list-style: none;
        margin: 0;
        padding: 0;
    }
    .httt-dropdown-box .httt-menu-item{
        
    }
    .httt-dropdown-box .httt-menu-item .row{
        display: flex;
        flex-wrap: wrap;
    }

    .keep-navbar{
        height: auto;
    }
    .header-nav-wrap{
        display: flex;
    }
    .cate-nav ul,
    .cate-nav li.globe-sub{
        height: 100%;
        float: none;
    }
    .cate-nav li.globe-sub{
        position: relative;
    }
    .cate-nav .globe-sub > a{
        display: flex !important;
        height: 100%;
        align-items: center;
        justify-content: center;
    }
    .cate-nav .globe-sub > a .text-title{
        margin-left: 8px;
        margin-right: 8px;
    }
    .keep-navbar .cate-nav ul li .sub-menu{
        top: 100%;
    }
    .main-menu > li.dropdown-container {
        position: relative;
    }
    .main-menu > li.dropdown-container .dropdown-menu{
        width: 298px !important;
    }
    .main-menu > li.dropdown .dropdown-menu > li{
        display: block !important;
    }
    .main-menu > li.dropdown-container .dropdown-menu > li{
        width: 100% !important;
        display: block !important;
    }
    .main-menu > li.dropdown .dropdown-menu > li > a,
    .main-menu > li.dropdown-container .dropdown-menu > li > a{
        display: block;
        padding: 5px 15px;
    }
    header .navbar-nav.main-menu > li > .dropdown-menu{
        top: 40px;
        overflow-y: auto;
    }
    .ct-tags{
        overflow-y: auto !important;
    }
    .btn-brand-menu-link{
        background-color: #33adff !important;
        border-radius: 4px;
            -moz-border-radius: 4px;
            -webkit-border-radius: 4px;
            -o-border-radius: 4px;
    }
    .btn-brand-menu-link:hover,
    .btn-brand-menu-link:focus{
        background-color: #33adff !important;
        color: #ffffff !important;
    }
    .main-menu>li.btn-brand-menu-item:hover {
        background-color: transparent;
    }
    .main-menu>li.btn-brand-menu-item:hover > a {
        color: #ffffff !important;
    }
    @media (max-width: 1199px){
        .dropdown-fullwidth .dropdown-menu{
            height: auto !important;
        }
    }
</style>

<script type="text/javascript">
    $(window).on('load', function(){
        var winHeight = $(window).height();
        $('.dropdown-fullwidth').each(function(){
            var dHeight = $(this).find('.dropdown-menu').outerHeight();
            if( dHeight > winHeight ){
                $(this).find('.dropdown-menu').css('height', winHeight);
            }
        });
    });
</script>