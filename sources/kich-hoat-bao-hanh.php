<?php
/**
 * Vân Thiên Hùng chuyên lừa đảo, lợi dụng tín nhiệm lừa tiền anh em lập trình.
 * Hứa hẹn thanh toán, tới ngày thì than thở kêu chưa thu được tiền từ năm này qua tháng nọ, hẹn tới hẹn lui không có hồi kết.
 * Tới lúc bị anh em Dev đòi thì xoá Zalo, đổi pass server nhằm chặn anh em Dev vào phá.
 * Đã quỵt tiền 2 người tổng cộng 70 triệu
 * Chúc may mắn cho anh em nào đang làm tiếp với Vân Thiên Hùng ^^!.
 */
$thanhcong = $d->getTemplates(29);
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

<div class="container">
	<div class="row10">
		
		<?php 
		if( $has_left_sidebar && !__IS_MOBILE ){
			include 'left_danh_muc.php'; 
		}
		?>

		<div class="main-content plr10 <?php echo ($has_left_sidebar)?'col-md-9':'col-md-12 product-grid-6'?>">
			<div class="clearfix"></div>

			<div class="box-item module">
				<h3 class="text-center">
					Bảo hành online
				</h3>
				<div class="row">
					<div class="col-md-8">
						<form action="/api.php?func=active_guarantee" class="ajax-form" method="POST">
							<div class="result"></div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-3">
										<label class="form-label">Serial: <i class="text-danger">*</i></label>
									</div>
									<div class="col-md-9">
										<input type="text" class="form-control" name="specification" required />
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-3">
										<label class="form-label">Mã cào: <i class="text-danger">*</i></label>
									</div>
									<div class="col-md-9">
										<input type="text" class="form-control" name="code" required />
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-3">
										<label class="form-label">Tên khách hàng: <i class="text-danger">*</i></label>
									</div>
									<div class="col-md-9">
										<input type="text" class="form-control" name="name" minlength="2" required />
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-3">
										<label class="form-label">Điện thoại: <i class="text-danger">*</i></label>
									</div>
									<div class="col-md-9">
										<input type="text" class="form-control" name="phone" minlength="10" required />
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-3">
										<label class="form-label">Email: <i class="text-danger">*</i></label>
									</div>
									<div class="col-md-9">
										<input type="email" class="form-control" name="email" required />
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-3">
										<label class="form-label">Đại chỉ: <i class="text-danger">*</i></label>
									</div>
									<div class="col-md-9">
										<input type="text" class="form-control" name="address" minlength="10" required />
									</div>
								</div>
							</div>
							<div class="form-group text-center">
								<div class="row">
									<div class="col-md-3">
									</div>
									<div class="col-md-9">
										<button class="btn btn-success" type="submit">Kích hoạt</button>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="col-md-4">
						<div class="alert alert-success">
							<h4>Hướng dẫn kích hoạt</h4>
							 1. Nhập số specification, mã cào từ sản phẩm <br/>
							 2. Nhập các thông tin còn lại theo thông tin của bạn <br/>
							 3. Nhấn kích hoạt và chờ kết quả
						</div>
					</div>
				</div>
				<hr />
				<div class="box-item module text-center">
					<h3>
						Xem trạng thái bảo hành
					</h3>
					<form action="/api.php?func=check_guarantee" class="ajax-form" method="POST">
						<div class="form-group">
							<label class="form-label">Serial: <i class="text-danger">*</i></label>
							<input class="form-control" name="specification" placeholder="Serial sản phẩm" style="max-width: 320px; margin: 0 auto" required />
						</div>
						<div class="form-group">
							<button class="btn btn-success" type="submit">Xem</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('.ajax-form').on('submit', function(e) {
			e.preventDefault();

			// Get form settings
			const form = $(this);
			const url = form.attr('action');
			const method = form.attr('method');

			// Prepare result element
			if(form.find('.result').length === 0) {
				form.prepend('<div class="result"></div>');
			}

			const resultEle = form.find('.result')[0];
			$(resultEle).toggle('slow');
			// Reset current result
			resultEle.innerHTML = '';

			// Disable submit button
			const submitButton = form.find('button[type="submit"]')[0];
			const oldSubmitText = submitButton.innerText;
			submitButton.setAttribute('disabled', true);
			submitButton.innerText = 'Vui lòng chờ...';
			swal({
				type:"info",
				title:"Vui lòng chờ...",
				showCancelButton:false,
				confirmButtonClass:'btn-info',
				confirmButtonText:'Đang xử lý...'
			});
			sweetAlert.disableButtons();

			$.ajax(url, {
				method,
				data: form.serialize(),
				success: function(res) {
					resultEle.innerHTML = res;
					$(resultEle).toggle('slow');
				},
				error: function(error) {
					console.log(error);
					swal({
						type:"error",
						title:"Có lỗi xảy ra",
						text:"Vui lòng thử lại!",
						confirmButtonClass:'btn-danger',
						confirmButtonText:'OK'
					});
				},
				complete: function() {
					submitButton.removeAttribute('disabled');
					submitButton.innerText = oldSubmitText;
					setTimeout(function() {
						sweetAlert.close();
					}, 500);
				},
			});
		});
	});
</script>

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