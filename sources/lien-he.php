<?php
/**
 * Vân Thiên Hùng chuyên lừa đảo, lợi dụng tín nhiệm lừa tiền anh em lập trình.
 * Hứa hẹn thanh toán, tới ngày thì than thở kêu chưa thu được tiền từ năm này qua tháng nọ, hẹn tới hẹn lui không có hồi kết.
 * Tới lúc bị anh em Dev đòi thì xoá Zalo, đổi pass server nhằm chặn anh em Dev vào phá.
 * Đã quỵt tiền 2 người tổng cộng 70 triệu
 * Chúc may mắn cho anh em nào đang làm tiếp với Vân Thiên Hùng ^^!.
 */
if (!isset($_SESSION)) {
	session_start();
}
date_default_timezone_set('Asia/Ho_Chi_Minh');

if (isset($_POST['sub_email'])) {
	$chuoi = strtolower($_POST['captcha']);
	if (checkCaptcha($chuoi)) {
		$d->reset();
		$data['ho_ten'] = addslashes($_POST['ho_ten']);
		$data['email'] = addslashes($_POST['email']);
		$data['sdt'] = addslashes($_POST['so_dien_thoai']);
		$data['noi_dung'] = addslashes($_POST['noi_dung']);
		$data['dia_chi'] = addslashes($_POST['dia_chi']);
		$data['ngay_hoi'] = date('d-m-Y H:i:s');
		$data['trang_thai'] = '0';

		$d->setTable('#_lienhe');
		$noidung = "<div style='margin-bottom:5px;'>Bạn nhận được tin nhắn từ website: " . URLPATH . " : </div>";
		$noidung .= "<div style='margin-bottom:5px;'>Thông tin: </div>";
		$noidung .= "<div style='margin-bottom:5px;'>Họ tên: " . $_POST['ho_ten'] . "</div>";
		$noidung .= "<div style='margin-bottom:5px;'>Địa chỉ: " . $_POST['dia_chi'] . "</div>";
		$noidung .= "<div style='margin-bottom:5px;'>Số điện thoại: " . $_POST['so_dien_thoai'] . "</div>";
		$noidung .= "<div style='margin-bottom:5px;'>Email: " . $_POST['email'] . "</div>";
		// $noidung .= "<div style='margin-bottom:5px;'>Tiêu đề: ".$_POST['tieu_de']."</div>";
		$noidung .= "<div style='margin-bottom:5px;    line-height: 1.5;'>Content: " . $_POST['noi_dung'] . "</div>";
		$noidung .= "<div style='margin-bottom:5px;'>Date: " . date('d-m-Y h:i:s', time()) . "</div>";
		$noidung .= "<div style='color:red; margin-top:10px; font-style:italic; font-size:12px'>Đây là thư gửi tự động, vui lòng ko trả lời thư này!</div>";
		if ($d->insert($data)) {
			// Send to CRM
			$data['subject'] = "Liên hệ từ website " . URLPATH;
			sendToCRM($data);
			@sendSms($_POST['so_dien_thoai'], 'request_received');
			include "./smtp/index.php";
			sendmail($data['subject'], $noidung, $_POST['email'], getenv('ADMIN_EMAIL'), $data['ho_ten']);
			$d->alert("Gửi thành công!");
			$d->location(URLPATH);
		} else {
			$d->alert("Error!");
		}
	} else {
		$d->alert("Security code is incorrect " . $chuoi . ' == ' . json_encode($_SESSION['captcha_code']));
	}
}
$dulieu = $d->getTemplates(10);
?>
<style type="text/css">
	#map_contact {
		height: 350px;
	}

	.map_title {
		text-align: center;
		font-weight: bold;
		color: red;
		margin-bottom: 5px;
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

<section>
	<div class="container">
		<div class="row10">
			
			<?php 
			if( $has_left_sidebar && !__IS_MOBILE ){
				include 'left_danh_muc.php'; 
			}
			?>

			<div class="main-content plr10 <?php echo ($has_left_sidebar)?'col-md-9':'col-md-12 product-grid-6'?>">
				<div class="page-title">
					<div class="bg-white">
						<div class="col-md-12 plr0">
							<ul class="breadcrumb">
								<li><a href="<?= URLPATH ?>" title="<?= _trangchu ?>"><?= _trangchu ?></a></li>
								<li><a href="<?= URLPATH ?>lien-he.html" title="Liên hệ"><?= _lienhe ?></a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="contact-info">
					<div class="contact-form">
						<div class="col-sm-12 plr0 mb10">
							<?= $dulieu['content_' . $_SESSION['lang']]; ?>
						</div>
						<div class="config-map">
							<div id="map">
								<?php if (!empty($information['map'])) { ?>
									<?= $information['map'] ?>
								<?php } else { ?>
									<div id="map_contact"></div>
								<?php } ?>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12 plr0">
							<div class="row">
								<h3 class="title-contact"><?= _lienhe ?></h3>
								<?php include 'ct_form_lienhe.php'; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php if (!empty($information['toado']) && empty($information['map'])) { ?>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyDbYXUfyXrfWP46Zq7koC2u08xw_8So_ng&sensor=true"></script>
	<script type="text/javascript">
		var map;
		var infowindow;
		var marker = new Array();
		var old_id = 0;
		var infoWindowArray = new Array();
		var infowindow_array = new Array();

		function initialize() {
			var defaultLatLng = new google.maps.LatLng(<?= $information['toa_do'] ?>);
			var myOptions = {
				zoom: 16,
				center: defaultLatLng,
				scrollwheel: false,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			map = new google.maps.Map(document.getElementById("map_contact"), myOptions);
			map.setCenter(defaultLatLng);

			var arrLatLng = new google.maps.LatLng(<?= $information['toa_do'] ?>);
			infoWindowArray[7895] = '<div class="map_description"><div class="map_title"><?= $information['company'] ?></div><div>Địa Chỉ : <?= $information['address'] ?></div></div>';
			loadMarker(arrLatLng, infoWindowArray[7895], 7895);
			moveToMaker(7895);
		}

		function loadMarker(myLocation, myInfoWindow, id) {
			marker[id] = new google.maps.Marker({
				position: myLocation,
				map: map,
				visible: true,
				animation: google.maps.Animation.BOUNCE
			});
			var popup = myInfoWindow;
			infowindow_array[id] = new google.maps.InfoWindow({
				content: popup
			});
			google.maps.event.addListener(marker[id], 'mouseover', function() {
				if (id == old_id) return;
				if (old_id > 0) infowindow_array[old_id].close();
				infowindow_array[id].open(map, marker[id]);
				old_id = id;
			});
			google.maps.event.addListener(infowindow_array[id], 'closeclick', function() {
				old_id = 0;
			});
		}

		function moveToMaker(id) {
			var location = marker[id].position;
			map.setCenter(location);
			if (old_id > 0) infowindow_array[old_id].close();
			infowindow_array[id].open(map, marker[id]);
			old_id = id;
		}

		google.maps.event.addDomListener(window, "load", initialize);
	</script>
<?php } ?>

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