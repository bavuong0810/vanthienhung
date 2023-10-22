<?php

$query = $d->simple_fetch("select id,name_vi,alias_vi,description_vi from #_category where alias_{$_SESSION['lang']}='$com'");
$category_id = $query['id'];
$category_name = $query['name_vi'];
$cat_ids = array();
$cat_ids[] = $category_id;
//$all_id = $category_id . $d->findIdSub($category_id);
$cat_sub_1 = $d->o_fet("select id from #_category where category_id=$category_id and hien_thi=1 order by so_thu_tu asc");

if( !empty($cat_sub_1) ){
	foreach( $cat_sub_1 as $s1 ){
		$s1_id = $s1['id'];
		$cat_ids[] = $s1_id;
		
		$cat_sub_2 = $d->o_fet("select id from #_category where category_id=$s1_id and hien_thi=1 order by so_thu_tu asc");
		if( !empty( $cat_sub_2 ) ){
			foreach( $cat_sub_2 as $s2 ){
				$s2_id = $s2['id'];
				$cat_ids[] = $s2_id;
			}
		}
	}
}

if( !empty($cat_ids) ){
	$all_id = implode(',', $cat_ids);
}

if ($category_id == '') {
	$d->location(URLPATH . "404.html");
}

$maxR = $d->getOption('view_num_category')?$d->getOption('view_num_category') : 60;



if (isset($_GET['perpage']) && $_GET['perpage'] != 0) {
	$maxR = $_GET['perpage'];
}
$page = isset($_GET['page']) ? addslashes($_GET['page']) : 1;
$offset = ($page - 1) * $maxR;

//set show/hide when product no price
$view_product_noprice = $d->getOption('view_product_noprice');
$pwhere = (!$view_product_noprice)?' and price > '.MIN_PRICE:'';

$query = "select * from #_sanpham where " . get_column_show() . " = 1 $pwhere  and category_id in ( $all_id ) and style=0 order by so_thu_tu asc, id desc";

// get total records for paging

$queryCount = str_replace('*', 'count(id) as totalRecords', $query);
$countResult = $d->o_fet($queryCount);
$totalRecords = $countResult[0]['totalRecords'];

// get items
$query .= " limit $offset, $maxR";

$sanpham = $d->o_fet($query);

if (isset($_GET['page']) && !is_numeric(@$_GET['page'])) {
	$d->location(URLPATH . "404.html");
}
$curPage = isset($_GET['page']) ? addslashes($_GET['page']) : 1;
$url = $d->fullAddress();
$parts = parse_url($_SERVER["REQUEST_URI"]);
$queryStr = !empty($parts['query']) ? $parts['query'] : '';
parse_str($queryStr, $queryArr);

$maxP = $maxR;
$phantrang = $d->phantrang($totalRecords, $url, $curPage, $maxR, $maxP, 'classunlink', 'classlink', 'page');
// $sanpham=$phantrang['source'];

unset($queryArr['perpage']);
?>
<section class="mt-1 sc-dmsp">
	<div class="container">

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

		<div class="row10 clearfix">

			<?php 
			if( $has_left_sidebar && !__IS_MOBILE ){
				include 'left_danh_muc.php'; 
			}
			?>

			<div class="main-content plr10 <?php echo ($has_left_sidebar)?'col-md-9':'col-md-12 product-grid-6'?>">
				<div class="page-title">
					<div class="col-md-12 plr0">
						<ul class="breadcrumb pull-left">
							<li><a href="<?= URLPATH ?>" title="<?= _trangchu ?>"><?= _trangchu ?></a></li>
							<li><?php echo $category_name; //echo $d->breadcrumb($category_id, $_SESSION['lang'], URLPATH) ?></li>
							<div class="pull-right">
								<form>Hiển thị:
									<select name="perpage" onchange="this.form.submit()">
										<?php
										$nums = array(10, 25, 40, 60, 80, 100, 120, 140, 180, 200, 300);
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
											echo '<option' . ($num == $maxR ? ' selected' : '') . '>' . $num . '</option>';
										}
										?>
									</select>
									<?php
									foreach ($queryArr as $key => $value) {
										echo '<input type="hidden" name="' . $key . '" value="' . $value . '" />';
									}
									?>
								</form>
							</div>

							<div class="btn-group pull-right" style="margin-right: 10px">
								<?php include 'parts/change-layout-buttons.php'; ?>
							</div>
						</ul>
					</div>
				</div>
				<?php if (!empty($query['description_' . $lang])) { ?>
					<div class="des-module mb10">
						<?= $query['description_' . $lang]; ?>
					</div>
				<?php } ?>
				<div class="clearfix"></div>
				<div class="row03 clearfix">
					<?php
					if (!empty($sanpham)) {
						include("ct_product.php");
					} else {
						echo '<div class="updating">' . _updating . '</div>';
					}
					?>
				</div>
				<div class="clearfix"></div>
				<div class="pagination-page">
					<?php echo @$phantrang['paging'] ?>
				</div>
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