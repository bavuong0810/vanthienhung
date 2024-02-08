<?php
if(isset($_GET['page']) && !is_numeric(@$_GET['page'])) {
    $d->location(URLPATH."404.html");
}

// Search from header
$t = $d->cleanData(@$_REQUEST['textsearch']);
$searchType = 'product';

// Search from advanced search
$searchColumns = [
    'productName' => [
        'fields' => [
            'name_vi',
            'name_en',
            'name_ch',
        ],
    ],
    'brandId' => [
        'fields' => [
            'brand_id',
        ],
    ],
    'minPrice' => [
        'fields' => [
            'price',
        ],
        'condition' => '>=',
    ],
    'maxPrice' => [
        'fields' => [
            'price',
        ],
        'condition' => '<=',
    ]
];
$searchParams = array_keys($searchColumns);
$params = [];
foreach ($searchParams as $param) {
    if (empty($_REQUEST[$param])) {
        continue;
    }

    $params[$param] = $_REQUEST[$param];
}

$queries = [];

//set show/hide when product no price
$view_product_noprice = $d->getOption('view_product_noprice');
$pwhere = (!$view_product_noprice)?' and price > '.MIN_PRICE:'';

$order = '';
$orderByOptions = [
    'price_increase' => ' ORDER BY price ASC',
    'price_decrease' => ' ORDER BY price DESC',
    'view_increase' => ' ORDER BY view ASC',
    'view_decrease' => ' ORDER BY view DESC',
];
if (@$_GET['orderBy']) {
    $selectedOrder = @$_GET['orderBy'];
    if ($orderByOptions[$selectedOrder]) {
        $order = $orderByOptions[$selectedOrder];
    }
}

if ($t || count($params) > 0) {
    if ($t) {
        $whereName = '';
        $searchTextE = explode(' ', $t);
        foreach ($searchTextE as $textE) {
            if ($whereName == '') {
                $whereName = " name_vi LIKE '%" . $textE . "%'";
            } else {
                $whereName .= " AND name_vi LIKE '%" . $textE ."%'";
            }
        }
        if (!$order) {
            $order = ' ORDER BY name_vi ASC';
        }
        $query = "SELECT * FROM #_sanpham
				WHERE $whereName $pwhere $order";
    } else {
        $params = array_map(function($str) use($d) { return $d->cleanData($str); }, $params);
        if (!empty($params['minPrice'])) {
            $params['minPrice'] = preg_replace('/\D/is', '', $params['minPrice']);
        }
        if (!empty($params['maxPrice'])) {
            $params['maxPrice'] = preg_replace('/\D/is', '', $params['maxPrice']);
        }
        $conditions = arrayToConditions($params, $searchColumns);
        $whereString = implode(' AND ', $conditions);

        if (!$order) {
            if ( empty($params['minPrice']) && empty($params['maxPrice']) ){
                $order = ' ORDER BY name_vi ASC';
            } elseif ( empty($params['minPrice']) && !empty($params['maxPrice']) ) {
                $order = ' ORDER BY price DESC';
            }  else {
                $order = ' ORDER BY price ASC';
            }
        }

        $query = "SELECT * FROM #_sanpham
				WHERE $whereString $pwhere $order
			";
    }


    $queryCount = str_replace('*', 'count(id) as totalRecords', $query);

    $countResult = $d->o_fet($queryCount);
    $totalRecords = $countResult[0]['totalRecords'];


    $itemPerPage = 60;
    if(isset($_GET['perpage']) && $_GET['perpage'] != 0){
        $itemPerPage = $_GET['perpage'];
    }
    $page = isset($_GET['page']) ? addslashes($_GET['page']) : 1;
    $offset = ($page - 1) * $itemPerPage;

    // get items
    $query .= " limit $offset, $itemPerPage";
    $sanpham = $d->o_fet($query);

    $name = _ketquatimkiem. " (".$totalRecords.")";
    $url= $d->fullAddress();
    $parts = parse_url($_SERVER["REQUEST_URI"]);
    parse_str($parts['query'], $queries);
    unset($queries['perpage']);
    $showPages = 5;
    $phantrang = $d->phantrang($totalRecords, $url, $page, $itemPerPage, $showPages, 'classunlink', 'classlink', 'page');
}

?>
<?php
$chiTietHoTroZalo = $d->getTemplates(49, true);
$timetable = $d->getTemplates(54, true);

$view_dm_truc_tuyen = $d->getOption('view_dm_truc_tuyen');
$view_danh_muc = $d->getOption('view_danh_muc');
$view_nhan_hieu = $d->getOption('view_nhan_hieu');
$is_view_danh_muc = ($view_danh_muc && $view_danh_muc != "hidden")?true:false;
$is_view_nhan_hieu = ($view_nhan_hieu && $view_nhan_hieu != "hidden")?true:false;

$view_button_placeorder_left = $d->getOption('view_button_placeorder_left');
$view_button_checkorder_left =  $d->getOption('view_button_checkorder_left');
$view_button_warrantyonline_left =  $d->getOption('view_button_warrantyonline_left');
$view_button_price_request_left =  $d->getOption('view_button_price_request_left');
$view_button_contact_left =  $d->getOption('view_button_contact_left');
$view_zalo_left =  $d->getOption('view_zalo_left');
$view_calendar_left =  $d->getOption('view_calendar_left');

$has_left_sidebar = false;
if( $view_dm_truc_tuyen || $is_view_danh_muc || $is_view_nhan_hieu || $view_button_placeorder_left || $view_button_checkorder_left || $view_button_warrantyonline_left || $view_button_price_request_left || $view_button_contact_left || $view_zalo_left || $view_calendar_left ){
    $has_left_sidebar = true;
}
?>

<section>
    <div class="container">
        <?php if (isset($_GET['advanced-search'])): ?>
            <?php include 'ct_search.php'; ?>
        <?php endif ?>
        <div class="row10">

            <?php
            if( $has_left_sidebar && !__IS_MOBILE ){
                include 'left_danh_muc.php';
            }
            ?>

            <div class="main-content plr10 <?php echo ($has_left_sidebar)?'col-md-9':'col-md-12 product-grid-6'?>">
                <div class="page-title">
                    <div class="col-md-12 plr0">
                        <ul class="breadcrumb">
                            <li><a href="<?=URLPATH ?>" title="<?=_trangchu?>"><i class="fa fa-home"></i></a></li>
                            <li><a title="<?=_search?>"><?=_search?></a></li>
                            <div class="pull-right">
                                <form class="form-inline">Hiển thị:
                                    <select name="perpage" onchange="this.form.submit()">
                                        <?php
                                        $nums = array(12, 24, 36, 48, 60, 72, 84, 100, 120, 140, 180, 200);
                                        if (@$_SESSION['is_admin']) {
                                            $nums[] = 500;
                                            $nums[] = 1000;
                                            $nums[] = 1300;
                                            $nums[] = 1500;
                                            $nums[] = 2000;
                                            $nums[] = 3000;
                                            $nums[] = 4000;
                                            $nums[] = 5000;
                                        }
                                        foreach ($nums as $num) {
                                            echo '<option'. ($num == $itemPerPage ? ' selected' : '') .'>'. $num .'</option>';
                                        }
                                        ?>
                                    </select>
                                    <?php foreach ($queries as $key => $value) {
                                        echo '<input type="hidden" name="'.$key.'" value="'.$value.'"/>';
                                    }; ?>
                                </form>
                            </div>
                            <div class="btn-group pull-right" style="margin-right: 10px">
                                <button onclick="changeProductLayout('grid')" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th"></span> Dạng lưới</button>
                                <button onclick="changeProductLayout('list')" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list"></span> Dòng lớn</button>
                                <button onclick="changeProductLayout('small_list')" class="btn btn-default btn-sm"><span class="glyphicon glyphicon glyphicon-list"></span> Dòng nhỏ</button>
                            </div>
                        </ul>
                    </div>
                </div>
                <h4 class="title-module"><span><?=@$name?></span></h4>
                <div class="clearfix"></div>
                <div class="box-item module row10">
                    <?php if (!$t && count($params) === 0): ?>
                        <h3 class="alert alert-warning text-center mt-2">Hãy nhập từ khóa để tìm kiếm!</h3>
                    <?php else: ?>
                        <?php if($searchType == 'blog'){ ?>
                            <?php foreach ($sanpham  as $i => $item) { ?>
                                <div class="item-content-row" >
                                    <div class="img">
                                        <a href="<?=URLPATH.$item['alias_'.$lang]?>.html" title="<?=@$item['name_'.$lang] ?>">
                                            <img src="<?=URLPATH ?>images/150/120/<?=$item['image_path']?>" alt="<?=@$item['name_'.$lang] ?>" onerror="this.src='<?=URLPATH ?>templates/error/error.jpg';">
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h3 class="name"><a href="<?=URLPATH.$item['alias_'.$lang] ?>.html" title="<?=@$item['name_'.$lang] ?>"><?=@$item['name_'.$lang] ?></a></h3>
                                        <div class="quote hidden-xs"><?=$d->catchuoi_new(strip_tags($item['description_'.$lang]),350) ?></div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <?php include("ct_product.php"); ?>
                        <?php } ?>
                    <?php endif ?>
                </div>
                <div class="clearfix"></div>
                <?php if(@$phantrang['paging'] <> ''){ ?>
                    <div class="pagination-page">
                        <?php echo @$phantrang['paging']?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<style type="text/css">
    .clearfix:after{
        content:"";
        clear: both;
        display: table;
    }
    .nav-left{
        padding: 0 0;
        background-color: #ffffff;
    }
    .nav-dm-toggle ul{
        display: none;
    }
    .nav-dm .has-dropdown > a{
        padding-right: 25px;
        position: relative;
    }
    .menu-icon{
        position: absolute;
        right: 0;
        top: 0;
        width: 35px;
        padding: 0;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        cursor: pointer;
    }
    .menu-icon-lg{
        font-size: 14px;
    }
    /** Level 1 */
    .nav-dm{
        margin: 0;
        padding: 0;
        list-style: none;
    }
    .nav-dm > li{
        margin: 0;
        padding: 0;
        background-color: #ffffff;
        border-bottom: 1px solid #dddddd;
        width: 100%;
    }
    .nav-dm > li > a{
        padding: 10px 10px;
        display: block;
        color: #000;
        font-weight: 700;
        font-size: 14px;
        line-height: 20px;
        position: relative;
        background-color: #eee;
    }
    .nav-dm > li > a:hover{
        color: #ee1b25;
    }
    /** Level 2 */
    .nav-dm > li > ul{
        margin: 5px 0 0;
        padding: 0 0 0 10px;
        list-style: none;
    }
    .nav-dm > li > ul > li{
        margin: 0;
        padding: 0;
    }
    .nav-dm > li > ul > li > a{
        padding: 5px 10px 5px 14px;
        display: block;
        color: #000;
        font-weight: 700;
        font-size: 13px;
        line-height: 19px;
        position: relative;
    }
    .nav-dm > li > ul > li > a:before{
        content: "\f0c8";
        font-family: FontAwesome;
        font-size: 5px;
        position: absolute;
        top: 50%;
        left: 0;
        line-height: 5px;
        margin-top: -3px;
        color: #ee1b25;
    }
    .nav-dm > li > ul > li > a:hover{
        color: #ee1b25;
    }

    /** Level 3 */
    .nav-dm > li > ul > li > ul{
        margin: 0;
        padding: 0;
        list-style: none;
    }
    .nav-dm > li > ul > li > ul > li{
        margin: 0;
        padding: 0;
    }
    .nav-dm > li > ul > li > ul > li > a{
        padding: 5px 10px 5px 14px;
        display: block;
        color: #000;
        font-weight: 700;
        font-size: 13px;
        line-height: 19px;
        position: relative;
    }
    .nav-dm > li > ul > li > ul > li > a:hover{
        color: #ee1b25;
    }

</style>
<script type="text/javascript">
    $(document).ready(function(){
        /*
        $('.brand-group-title').on('click', function(){
            $(this).parent().find('.sub-menu-1').slideToggle();
            return false;
        });*/

        $('.nav-dm-toggle a').on('click', '.menu-icon', function(){
            $(this).parent().siblings('ul').slideToggle();
            return false;
        });
    });
</script>