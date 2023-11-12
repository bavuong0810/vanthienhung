<?php
// debug
error_reporting(-1);
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
if (!isset($_SESSION["user_hash"])) {
	header("location: login.php");die;
}
define('__ADMIN_PATH', dirname(__FILE__));
@define('_template', __ADMIN_PATH . '/templates/');
@define('_source', __ADMIN_PATH . '/sources/');
@define('_lib', __ADMIN_PATH . '/lib/');
@define('_ROOT', dirname(dirname(__FILE__)));
define('__ROOT_PATH', dirname(dirname(__FILE__)));
if (isset($_COOKIE['admin_image']) && $_COOKIE['admin_image'] == 'true') {
    define('ADMIN_IMAGE', true);
} else {
    define('ADMIN_IMAGE', false);
}

@include "lib/config.php";
// if (getenv('APP_DEBUG') == 'false') {
//     error_reporting(0);
//     ini_set('display_startup_errors', 0);
//     ini_set('display_errors', 0);
// } else {
//     error_reporting(-1);
//     ini_set('display_startup_errors', 1);
//     ini_set('display_errors', 1);
// }


@include "lib/function.php";

global $d;
$d = new func_index($config['database']);

$cacheFile = 'tmp/html/' . md5('information') . '.cache'; // Cache file path
if (file_exists($cacheFile) && (time() - filemtime($cacheFile)) < 3600) {
    $information = unserialize(file_get_contents($cacheFile));
} else {
    $information = $d->simple_fetch("select * from #_thongtin limit 0,1");
    // Cache the result
    file_put_contents($cacheFile, serialize($information));
}

$SETTINGS = $d->getAllSettings();

date_default_timezone_set('Asia/Ho_Chi_Minh');

@include "lib/file_router_admin.php";

if (@$_SESSION['quyen'] == 2 && ($_REQUEST['p'] != 'san-pham' && $_REQUEST['p'] != 'ql-user' && $_REQUEST['p'] != 'danh-sach-don-hang' && $_REQUEST['p'] != '')) {
	$d->redirect("index.php");
}

?>

    <?php @include 'templates/header_tpl.php';?>
    <?php @include 'templates/navbar_tpl.php';?>
    <div class="clearfix" style="min-height: 471px;">
        <div id="sidebar-bg"></div>
        <div id="sidebar" role="navigation">
            <?php @include 'templates/sidebar_tpl.php';?>
       </div>
        <div id="main" style="height: calc(100vh - 45px); overflow: auto;">
            <?php @include "templates/" . $template . "_tpl.php";?>
        </div>
    </div>

<?php @include 'templates/footer_tpl.php';?>
<?php $d->disconnect()?>