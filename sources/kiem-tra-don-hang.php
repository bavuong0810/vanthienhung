<?php
		$thanhcong = $d->getTemplates(29);
?>
<div class="container">
	<div class="row10">
		<?php include "left.php"; ?>
		<div class="main-content col-md-9 plr10 bg-white">
			<div class="clearfix"></div>
			
			<div class="box-item module text-success text-center">
				<h3>
					Kiểm tra đơn hàng
				</h3>
				<?php
				if (!empty($_POST['order_code'])) {
					?>
					<h4 class="alert alert-warning">Đơn hàng không tồn tại!</h4>
					<?php
				}
				?>
				<form action="/kiem-tra-don-hang.html" method="POST">
					<div class="form-group">
						<label class="form-label">Mã đơn hàng:</label>
						<input class="form-control" name="order_code" placeholder="Mã đơn hàng" style="max-width: 320px; margin: 0 auto" required />
					</div>
					<div class="form-group">
						<button class="btn btn-success" type="submit">Kiểm tra</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>