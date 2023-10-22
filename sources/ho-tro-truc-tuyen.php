<?php
	$supporters = $d->o_fet("select * from #_hotro where hien_thi=1 order by so_thu_tu asc, id desc");
?>
<style type="text/css">
	.shadow {
		box-shadow: 2px 2px 10px rgba(0, 0, 0, .3);
	}
	.shadow:hover {
		box-shadow: 4px 4px 20px rgba(0, 0, 0, .3);
	}
	.box-item .phone {
		margin-top: .5em;
	}
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

<div class="container">
	<div class="row10 clearfix">
		
		<?php 
		if( $has_left_sidebar && !__IS_MOBILE ){
			include 'left_danh_muc.php'; 
		}
		?>

		<div class="main-content plr10 <?php echo ($has_left_sidebar)?'col-md-9':'col-md-12 product-grid-6'?>">
			<div class="clearfix"></div>
			<div class="title-main title-font">
		        <h3>Hỗ trợ trực tuyến</h3>
		    </div>
			<div class="row10">
				<?php foreach ($supporters as $support): ?>
					<div class="col-md-4">
						<div class="box-item module bg-white text-center shadow my-1" style="padding: 20px 0;">
							<?php if($support['image_path']){
								$support_img = '../img_data/images/'.$support['image_path'];
							} else {
								if (@$support['gender'] == 'female'){
									$support_img = '/templates/images/supporter-female.ico';
								} else {
									$support_img = '/templates/images/supporter-male.ico';
								}
							}?>
							<div class="support-img">
								<img src="<?php echo $support_img?>">
							</div>
							
							<h4 class="red">
								<?php echo $support['name_vi'] ?>
							</h4>
							<h3 class="phone">
								<?php echo $support['sdt'] ?>
							</h3>
							<div class="title-hotro hot-zalo text-center">
								<a class="btn btn-default btn-circle mr-1" href="tel:<?php echo $support['sdt'] ?>">
									<i class="fa fa-phone" style="width:20px"></i>
								</a>
								<a class="btn btn-default btn-circle mr-1" href="skype:<?php echo $support['skype'] ?>?chat">
									<img src="templates/images/skype.png" width="20" alt="skype">
								</a>
								<a class="btn btn-default btn-circle" href="https://zalo.me/<?php echo $support['yahoo'] ?>">
									<img src="templates/images/zalo.png" class="zalo">
								</a>
							</div>
						</div>
					</div>
				<?php endforeach ?>
			</div>
		</div>
	</div>
</div>

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