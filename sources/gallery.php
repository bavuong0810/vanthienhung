<?php

	$loai = $d->simple_fetch("select * from #_category where hien_thi = 1 and alias_{$_SESSION['lang']} = '$com'");
	if(count($loai) == 0) $d->location(URLPATH."404.html");
	$category_id=$loai['id'];
	$check_index=0;
	

	if($d->findIdSub($loai['id'])!='') {
		$idsub=$d->findIdSub($loai['id']);	
		$check_index=1;
		$data = $d->o_fet("select * from #_category where hien_thi = 1 and FIND_IN_SET(id,'$idsub') <> 0 order by so_thu_tu asc, id desc");
	}
	else {
		$data = $d->o_fet("select * from #_gallery where hide = 1 and FIND_IN_SET(parent,'$category_id') <> 0 order by stt asc, id desc");
		
	}

	
    if(isset($_GET['page']) && !is_numeric(@$_GET['page'])) $d->location(URLPATH."404.html");
    
    $curPage = isset($_GET['page']) ? addslashes($_GET['page']) : 1;
    $url= $d->fullAddress();
    $maxR=20;
    $maxP=5;
    $phantrang=$d->phantrang($data, $url, $curPage, $maxR, $maxP,'classunlink','classlink','page');
    $data=$phantrang['source'];
	
	
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

<section class="include">
	<div class="container">
		
		<div class="row10">
				
			<?php 
			if( $has_left_sidebar && !__IS_MOBILE ){
				include 'left_danh_muc.php'; 
			}
			?>
		
			<div class="main-content plr10 <?php echo ($has_left_sidebar)?'col-md-9':'col-md-12 product-grid-6'?>">
				<div class="page-title">
					<ul class="breadcrumb">
						<li><a href="<?=URLPATH ?>" title="<?=_trangchu?>"><i class="fa fa-home"></i></a></li>
						<?=$d->breadcrumb($category_id,$_SESSION['lang'],URLPATH)?>
					</ul>
				</div>
				<div class="clearfix"></div>
				
				<div class="bg-left row10">	
					
					<?php foreach($data as $item) {?>
					<div class="col-gallery">
						<div class="item-gallery">
							<div class="img">
								<?php if($check_index>0) {  ?>
								<a href="<?=URLPATH.$d->create_long_link($item['alias_'.$_SESSION['lang']],$_SESSION['lang']) ?>.html" title="<?=@$item['name_'.$_SESSION['lang']] ?>">
									<div class="mask"><span></span></div>
									<img src="<?=URLPATH ?>thumb.php?src=<?=URLPATH ?>img_data/images/<?=$item['image_path']?>&w=400&h=300" alt="<?=@$item['name_'.$_SESSION['lang']] ?>" onerror="this.src='templates/error/error.jpg';" border="0">
									<h3 class="name"><?=$item['name_'.$_SESSION['lang']]?></h3>
								</a>
								<?php } else { ?>
								<a href="<?=URLPATH ?>img_data/images/<?=$item['picture']?>" title="<?=@$item['title_'.$_SESSION['lang']] ?>" class="fancybox" rel="group1">
									<div class="mask"><span></span></div>
									<img src="<?=URLPATH ?>thumb.php?src=<?=URLPATH ?>img_data/images/<?=$item['picture']?>&w=400&h=300" alt="<?=@$item['name_'.$_SESSION['lang']] ?>" onerror="this.src='templates/error/error.jpg';" border="0">
									<h3 class="name"><?=$item['title_'.$_SESSION['lang']]?></h3>
								</a>
								<?php } ?>
							</div>
						</div>	
					</div>
					<?php } ?>
					<div class="clearfix"></div>
					<?php if(@$phantrang['paging'] <> ''){ ?>
					<div class="pagination-page">
						<?php echo @$phantrang['paging']?>
					</div>
					<?php } ?>	
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