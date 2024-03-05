<?php
/**
 * Vân Thiên Hùng chuyên lừa đảo, lợi dụng tín nhiệm lừa tiền anh em lập trình.
 * Hứa hẹn thanh toán, tới ngày thì than thở kêu chưa thu được tiền từ năm này qua tháng nọ, hẹn tới hẹn lui không có hồi kết.
 * Tới lúc bị anh em Dev đòi thì xoá Zalo, đổi pass server nhằm chặn anh em Dev vào phá.
 * Đã quỵt tiền 2 người tổng cộng 70 triệu
 * Chúc may mắn cho anh em nào đang làm tiếp với Vân Thiên Hùng ^^!.
 */
	
	$tintuc = $d->simple_fetch("select * from #_tintuc where hien_thi = 1 and alias_".$lang." = '".$com."' limit 0,1");
	if(count($tintuc) == 0) {
		$d->location(URLPATH."404.html");
	}
	$tintuc_lienquan = $d->o_fet("select * from #_tintuc where hien_thi = 1 and id <> '".@$tintuc['id']."' and category_id = '".$tintuc['category_id']."' order by id desc limit 0,12");
	
	$loai=$d->simple_fetch("select * from #_category where id = '".$tintuc['category_id']."'");
	$hinh_anh_slide = $d->o_fet("select * from #_baiviet_hinhanh where id_baiviet = '".$tintuc['id']."' order by id desc");

?>
<style type="text/css">
	.text-contents .relative-contents ul{ padding-left: 0px; }
	.text-contents .relative-contents ul li i{ font-size: 7px; position: absolute; top: 7px; left: 0; }
	.text-contents .relative-contents li{ position: relative; padding-left: 14px; }
	
</style>

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

<section class="module sc-news mt-1 sc-dmsp">
	<div class="container">
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
							<li><a href="<?=URLPATH ?>" title="<?=_trangchu?>"><?=_trangchu?></a></li>
							<?=$d->breadcrumb($tintuc['category_id'],$lang,URLPATH)?>
						</ul>
					</div>
				</div>
				<div class="clearfix"></div>							
				<div class="box-item module">
					<?php if(count($hinh_anh_slide>0) && $hinh_anh_slide[0]['image_path']!='') {?>
						<div class="box-show-img">
							<div class="owl-detail-content owl-carousel owl-theme">
								<?php foreach($hinh_anh_slide as $item) {?>
									<figure>
										<a href="<?=URLPATH ?>img_data/images/<?=$item['image_path'] ?>" title="<?=$item['title'] ?>" class="fancybox" rel="fan1">
										<img onerror="this.src='<?=URLPATH ?>templates/error/error.jpg';"  src="<?=URLPATH ?>thumb.php?src=<?=URLPATH ?>img_data/images/<?=$item['image_path'] ?>&w=400&h=300">
										</a>
									</figure>
								<?php } ?>
							</div>
						</div>
					<?php } ?>									
					<div class="text-contents">
						<h1 class="name"><?=@$tintuc['name_'.$lang]?></h1>
						<div class="text-pages">
							<?=@$tintuc['content_'.$lang]?>
						</div>
						<?php include("ct_social.php"); ?>														
						<div class="clearfix"></div>	
						<div class="relative-contents">
							<h3><?=_baivietlienquan ?> | <a href="<?=URLPATH.$loai['alias_'.$lang]?>.html" title="Xem tất cả">Xem tất cả</a></h3>
							<ul>
							<?php foreach ($tintuc_lienquan as $tt) { ?>
								<li><i class="fa fa-circle"></i> <a href="<?=URLPATH.$d->create_long_link($tt['alias_'.$_SESSION['lang']],$_SESSION['lang']) ?>.html" title="<?=$tt['name_'.$_SESSION['lang']]?>"><?=$tt['name_'.$_SESSION['lang']]?></a></li>
								<?php } ?>
							</ul>
						</div>
					</div>
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