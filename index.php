<?php
define('__ROOT_PATH', dirname(__FILE__));
define('__CACHE_HTML', __ROOT_PATH . '/tmp/html');
define('_source', __ROOT_PATH . '/sources/');
define('_ajax', __ROOT_PATH . '/ajax/');
define('_lib', './admin/lib/');
$isMobile = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), 'mobile'));
define('__IS_MOBILE', $isMobile);
define('__CACHE_POSTFIX', $isMobile ? '_m' : '');

@include _lib . "config.php";
if (getenv('APP_DEBUG') == 'false') {
    error_reporting(0);
    ini_set('display_startup_errors', 0);
    ini_set('display_errors', 0);
} else {
    error_reporting(-1);
    ini_set('display_startup_errors', 1);
    ini_set('display_errors', 1);
}

if (!isset($_SESSION)) {
    session_start();
}
@include_once _lib . "function.php";
date_default_timezone_set('Asia/Ho_Chi_Minh');

if (!empty($_REQUEST['lang'])) {
    $_SESSION['lang'] = $_REQUEST['lang'];
} elseif (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'vi';
}
$lang = $_SESSION['lang'];

include _source . "file_router_nosql.php";

// CHECK cache
if (!isset($_SESSION['user_admin'])) {

    if ($source == 'san-pham-detail' || $source == 'index') {
        if ($_SERVER['REQUEST_URI'] === '/') {
            $_SERVER['REQUEST_URI'] = '/index.html';
        }
        define('__PRODUCT_CACHE_PATH', __CACHE_HTML . $_SERVER['REQUEST_URI'] . '_' . $lang . __CACHE_POSTFIX);
        if (file_exists(__PRODUCT_CACHE_PATH)) {
            sendCachedFile(__PRODUCT_CACHE_PATH);
            exit;
        }
    } else if ($source == 'san-pham') {
        if (!isset($_COOKIE['productLayout'])) {
            $_COOKIE['productLayout'] = 'grid';
        }

        define('__PRODUCT_CACHE_PATH', __CACHE_HTML . '/' . md5($_SERVER['REQUEST_URI'] . $_COOKIE['productLayout'] . '_' . $lang) . __CACHE_POSTFIX);
        if (file_exists(__PRODUCT_CACHE_PATH)) {
            sendCachedFile(__PRODUCT_CACHE_PATH);
            exit;
        }
    }
}

global $d;
global $lang;
$d = new func_index($config['database']);
include _source . "lang.php";
include _source . "language_" . $_SESSION['lang'] . ".php";
include _source . "file_router_index.php";

// CHECK banned IP
if (!isset($_SESSION['user_admin'])) {
    $ip = $d->get_client_ip();
    // check ip is banned
    $checkIpResult = $d->o_fet("SELECT COUNT(`ip`) as `total` FROM `#_banned_ip` WHERE `ip` = '$ip' AND `is_banned` = 1 ");
    if ($checkIpResult[0]['total']) {
        header("HTTP/1.0 404 Not Found");
        die('404 Not Found');
    }
}

if (defined('__PRODUCT_CACHE_PATH')) {
    ob_start();
}


$cacheFile = __ROOT_PATH . '/tmp/html/' . md5('information') . '.cache'; // Cache file path
if (file_exists($cacheFile) && (time() - filemtime($cacheFile)) < 3600) {
    $information = unserialize(file_get_contents($cacheFile));
} else {
    $information = $d->simple_fetch("select * from #_thongtin limit 0,1");
    // Cache the result
    file_put_contents($cacheFile, serialize($information));
}

$SETTINGS = $d->getAllSettings();
$url_page = $d->fullAddress();
unset($_SESSION['nav']);
// $d->getActive($com,$_SESSION['lang']);

if (isset($_GET['product-id'])) {
    $ctsp = $d->o_fet("select * from #_sanpham where hien_thi = 1 and alias_" . $_SESSION['lang'] . " = '" . $com . "'");
    if (count($ctsp) == 0) {
        $d->location(URLPATH . "404.html");
        $d->disconnect();
        exit;
    }
}


if (isset($_GET['pid'])) {
    $pid = intval($_GET['pid']);
    $ctsp = $d->o_fet("select alias_" . $_SESSION['lang'] . " from #_sanpham where hien_thi = 1 and id = " . $pid);
    if (count($ctsp) == 0) {
        $d->location(URLPATH . "404.html");
        exit;
    } else {
        $d->location(URLPATH . $ctsp[0]['alias_' . $_SESSION['lang']] . '.html');
        exit;
    }
}

//set layout from admin setting
$opt_view_san_pham = $d->getOption('view_san_pham');
$view_san_pham = ($opt_view_san_pham)?$opt_view_san_pham['option_value_1']:'';
if (!isset($_COOKIE['productLayout']) && $view_san_pham) {
    $_COOKIE['productLayout'] = $view_san_pham;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="vi" lang="vi">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" class="metaview">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="format-detection" content="telephone=no">
    <base href="<?= URLPATH ?>" />
    <?php
    if (empty($_GET['com']) || $source == 'index') {
        echo '<link rel="canonical" href="' . URLPATH . '" />';
    } else {
        $exp_cal = explode("&", $d->fullAddress());
        $exp_cal = explode("?", $exp_cal[0]);
        echo '<link rel="canonical" href="' . $exp_cal[0] . '" />';
    }
    ?>
    <?php if (strpos($_SERVER['HTTP_HOST'], getenv('APP_DOMAIN')) != null) { ?>
        <meta name="robots" content="noindex">
        <meta name="googlebot" content="noindex">
    <?php } ?>
    <link href="<?= URLPATH . "img_data/icon/" . $information['favicon']; ?>" rel="shortcut icon" type="image/x-icon" />
    <?php include _source . "seo.php" ?>
    <link href="<?= URLPATH ?>templates/extra/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <script src="<?= URLPATH ?>templates/js/jquery-1.11.0.min.js"></script>
    <link href="<?= URLPATH ?>templates/fonts/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <link rel='stylesheet' href='<?= URLPATH ?>templates/extra/mmenu/jquery.mmenu.css' type='text/css' />
    <script src='<?= URLPATH ?>templates/extra/mmenu/jquery.mmenu.js'></script>
    <script type="text/javascript">
        const lang = '<?php echo $_SESSION['lang']; ?>';
        jQuery(document).ready(function($) {
            $('nav#menu').mmenu({
                navbar: {
                    title: '<?= _danhmuc ?>'
                }
            });
        });
    </script>
    <link href="templates/css/menu.css" rel="stylesheet" />
    <link href="<?= URLPATH ?>templates/extra/fancybox/jquery.fancybox.css" rel="stylesheet" />
    <link href="<?= URLPATH ?>templates/extra/slick/slick.css" rel="stylesheet" />
    <link href="<?= URLPATH ?>templates/extra/wow/animate.css" rel="stylesheet" />
    <link href="<?= URLPATH ?>templates/css/aos.css" rel="stylesheet" />
    <link href="<?= URLPATH ?>templates/css/style.css?v=<?php echo getenv('APP_VERSION'); ?>" rel="stylesheet" />
    <link href="<?= URLPATH ?>templates/css/module.css?v=<?php echo getenv('APP_VERSION'); ?>" rel="stylesheet" />
    <link href="<?= URLPATH ?>templates/css/responsive.css?v=<?php echo getenv('APP_VERSION'); ?>" rel="stylesheet" />
    <link href="<?= URLPATH ?>templates/css/responsive_module.css" rel="stylesheet" />
    <link href="<?= URLPATH ?>templates/extra/bootstrap-select-1.12.4/css/bootstrap-select.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/chat/styles.css?v=9">
    <script type="text/javascript">
        <?php if (!$_SESSION['is_admin'] && 0) { ?>
            jQuery(document).bind("contextmenu cut copy", function(e) {
                e.preventDefault();
            });
            jQuery(document).ready(function($) {
                if (event) {
                    if (event.keyCode == 123) {
                        return false;
                    } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) {
                        return false; //Prevent from ctrl+shift+i
                    }
                }
            });
        <?php } ?>
    </script>

    <?php
    //Google Analytics
    echo $information['google_analytics'];
    ?>
</head>

<?php
$view_website_fullwidth =  $d->getOption('view_website_fullwidth');
$view_right_sidebar_large =  $d->getOption('view_right_sidebar_large');
$body_class = $view_website_fullwidth?'full-width':'';
$body_class.= $view_right_sidebar_large?' sidebar-right-large':'';
$body_class.= ($com != '')?' module':'';
//echo $source;
$body_class.= ' source-'.$source;
$body_class.= ' com-'.$com;
?>

<body class="<?php echo $body_class?>">
    <?php
    //Google Analytics
    echo (isset($information['script_body']) ? $information['script_body'] : '');
    ?>
    <div class="fback-top"><i class="fa fa-angle-up"></i></div>
    <div id="container">
        <?php include _source . "header.php"; ?>
        <?php include _source . $source . ".php"; ?>
        <?php include _source . "footer.php"; ?>
        <?php //include _source."alert.php" 
        ?>
    </div>
    <div id="chat_online">
        <div id="listChat" class="list-chat collapse">
            <span class="chat-button close-all-chat facebook" data-toggle="collapse" data-target="#minhFacebookChat" aria-expanded="false" aria-controls="minhFacebookChat">
                <span class="chat-message">Chat Facebook</span>
                <i class="fa fa-facebook"></i>
            </span>
            <a href="javascript:void(0)" data-toggle="modal" data-target="#modalZalo"
               class="chat-button close-all-chat zalo">
                <span class="chat-message">Chat Zalo</span>
                <small>Zalo</small>
            </a>
            <a href="tel:<?php echo $information['hotline']; ?>" class="chat-button phone">
                <span class="chat-message"><strong><?php echo $information['hotline']; ?></strong></span>
                <i class="fa fa-phone"></i>
            </a>
        </div>
        <span class="chat-button toggle-button" data-toggle="collapse" data-target="#listChat" aria-expanded="false" aria-controls="listChat">
            <span class="chat-message">Bạn cần hỗ trợ, tư vấn?</span>
            <i class="fa fa-comments"></i>
            <i class="fa fa-times"></i>
        </span>
    </div>


    <script src="<?= URLPATH ?>templates/js/detect.js"></script>
    <script src="<?= URLPATH ?>templates/extra/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= URLPATH ?>templates/extra/fancybox/jquery.fancybox.js"></script>
    <script src="<?= URLPATH ?>templates/extra/fancybox/jquery.mousewheel-3.0.6.pack.js"></script>
    <script src="<?= URLPATH ?>templates/extra/validate/jquery.validate.min.js"></script>
    <script src="<?= URLPATH ?>templates/extra/slick/slick.js"></script>
    <script src="<?= URLPATH ?>templates/js/aos.js"></script>
    <script src="<?= URLPATH ?>templates/js/home.js"></script>
    <script src="<?= URLPATH ?>templates/js/module.js?v=<?php echo getenv('APP_VERSION'); ?>"></script>

    <!-- Chat with zalo -->
    <div id="minhZaloChat" class="minh-zalo-chat-widget collapse">
        <div class="minh-zalo-chat-header">
            <span class="title">Nhắn tin Zalo cho chúng tôi</span>
            <i class="fa fa-times-circle close-chat pull-right" data-toggle="collapse" data-target="#minhZaloChat" aria-expanded="false" aria-controls="minhZaloChat"></i>
        </div>
        <div class="zalo-chat-widget" data-oaid="3041463383137409281" data-welcome-message="Rất vui khi được hỗ trợ bạn!" data-autopopup="1" data-width="350" data-height="420"></div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src = "https://sp.zalo.me/plugins/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'zalo-jssdk'));

            if($('.hotrotructuyen-widget').length){
                var width = $('.hotrotructuyen-wrap').width();
                if( width > 220 ){
                    $('.hotrotructuyen-widget').css('width', width);
                }
            }
        });
    </script>

    <!-- Facebook chat -->
    <div id="fb-root"></div>
    <?php if ($lang == 'vn') { ?>
        <script>
            $(document).ready(function() {
                (function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s);
                    js.id = id;
                    js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));
            });
        </script>
    <?php } else { ?>
        <script>
            $(document).ready(function() {
                (function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s);
                    js.id = id;
                    js.src = "//connect.facebook.net/us_US/sdk.js#xfbml=1&version=v2.8";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));
            });
        </script>
    <?php } ?>
    <style>
        .box_chat {
            position: fixed;
            right: 110px;
            bottom: 0px;
            background: #fff;
            z-index: 9999;
            border-radius: 5px 5px 0 0;
        }

        .box_chat .title-fb {
            background: #297af2;
            border-radius: 5px 5px 0 0;
            color: #fff;
            font-size: 16px;
            font-weight: 500;
            padding: 6px 10px;
            line-height: 25px;
        }

        .fb-chat {
            z-index: 9999;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('#minhZaloChat').on('show.bs.collapse', function() {
                jQuery('#minhFacebookChat').collapse('hide');
            });
            $('#minhFacebookChat').on('show.bs.collapse', function() {
                jQuery('#minhZaloChat').collapse('hide');
            });
        });
    </script>
    <!-- <script type="text/javascript" src="templates/js/tamdt12.js"></script> -->
    <div id="minhFacebookChat" class="box_chat collapse">
        <div class="title-fb">
            <i class="fa fa-facebook-square"></i>
            <?= _nhantinchochungtoi ?>
            <i class="fa fa-times-circle close-chat pull-right" data-toggle="collapse" data-target="#minhFacebookChat" aria-expanded="false" aria-controls="minhFacebookChat"></i>
        </div>
        <div class="fb-page fb-chat" data-href="<?= $information['facebook'] ?>" data-tabs="messages" data-width="350" data-height="420" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
            <blockquote cite="<?= $information['facebook'] ?>" class="fb-xfbml-parse-ignore"><a href="<?= $information['facebook'] ?>">Fanpage</a></blockquote>
        </div>
    </div>
    <div id="modalBackdrop" class="modal-backdrop fade hidden"></div>
    <?php
    if (!empty($bodyAppend)) {
        echo $bodyAppend;
    }

    ?>
    <script type="text/javascript">
        function showRecentViewedProducts() {
            var products = localStorage.getItem('recentViewed');
            products = JSON.parse(products);

            if (!Array.isArray(products) || products.length === 0) {
                $('#recent-viewed').fadeOut();
                return;
            }

            var recentViewedContainer = $('#recent-viewed');
            var shown = 0;
            var maxShow = 3;
            if ($('body').width() < 400) {
                maxShow = 1;
            }

            products.forEach(function(product, index) {

                // show max 3 product
                if (shown >= maxShow) {
                    return;
                }

                // skip current product
                if (window.currentProduct && +product.id === +currentProduct.id) {
                    return;
                }

                var name = product['name_' + lang];
                var imgSrc = product.image;
                var productLink = product.url;

                var element = `<a href="${productLink}" title="${name}" rel="nofollow"><img src="${imgSrc}" alt="${name}" title="${name}" style="width: 50px; height: 50px"/></a>`;

                recentViewedContainer.append(element);
                shown++;
            });
            if (shown === 0) {
                $('#recent-viewed').fadeOut();
                return;
            }

            var popover = `<a id="toggle-recent-viewed" data-placement="bottom" tabindex="0" role="button" data-toggle="popover" title="Sản phẩm vừa xem"><i class="fa fa-chevron-down" style="color: red;"></i></a>`;
            recentViewedContainer.append(popover);
            $('#toggle-recent-viewed').popover({
                html: true,
                content: function() {
                    var htmlElements = products.map(function(product) {

                        // skip current product
                        if (window.currentProduct && +product.id === +currentProduct.id) {
                            return;
                        }

                        var name = product['name_' + lang];
                        var imgSrc = product.image;
                        var productLink = product.url;

                        return `
                        <a href="${productLink}" title="${name}" rel="nofollow" style="display: inline-block;">
                            <img src="${imgSrc}" alt="${name}" title="${name}"
                                onerror="this.src='<?= $d->getDefaultProductImage() ?>';setTimeout(() => {$('.mz-loading').hide();}, 1000);"
                                style="width: auto; height: 100px"/>
                            <p style="white-space: nowrap; text-overflow: ellipsis; color: #333; max-width: 120px;overflow-x: hidden;margin: 0 auto;">${name}</p>
                        </a>
                        `;
                    });

                    return htmlElements.join("\n");
                },
                template: '<div class="popover" role="tooltip"><div class="overlay"></div><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'
            });

            $('#toggle-recent-viewed').on('shown.bs.popover', function() {
                $('#recent-viewed .popover .overlay').off('click');
                $('#recent-viewed .popover .overlay').on('click', function() {
                    $('#toggle-recent-viewed').popover('hide');
                });
            });
        }

        $(document).ready(function() {
            showRecentViewedProducts();
        });
    </script>
    <div id="chat-root"></div>
    <script defer>
        window.WindChat = {
            title: '<?php echo getCustomSetting('CHAT_TITLE', null, 'Chat với Vân Thiên Hùng') ?>',
            siteName: '<?php echo getCustomSetting('CHAT_SITE_NAME', null, '') ?>',
        };
    </script>
    <script defer src="/chat/index.js?v=<?php echo getenv('APP_VERSION'); ?>"></script>
    <script>
        jQuery(document).ready(function($) {
            $('body').on('click', '.rcw-close-button', function() {
                localStorage.setItem("keep-logged-in", false);
            });
        });
    </script>
</body>
</html>

<?php $d->disconnect() ?>
<?php
if (defined('__PRODUCT_CACHE_PATH') && !empty(__PRODUCT_CACHE_PATH)) {
    $cacheContent = ob_get_flush();
    $safePath = toSafePath(__PRODUCT_CACHE_PATH);
    file_put_contents($safePath, minify_html($cacheContent));
}
