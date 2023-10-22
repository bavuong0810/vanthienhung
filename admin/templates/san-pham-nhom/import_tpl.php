<link rel="stylesheet" type="text/css" href="/admin/assets/bootstrap-select-1.12.4/css/bootstrap-select.min.css">
<style type="text/css">
	.tooltip.in {
		opacity: 1 !important;
	}

	.width400 {
		max-width: unset;
	}

	.ar_admin .row.form-group {
		border-bottom: 1px solid #dedede;
		margin-bottom: 0px;
		padding: 10px 0;
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
	}

	.text-label {
		font-weight: 700;
		color: #153FA3;
	}
</style>
<?php

?>
<ol class="breadcrumb">
	<li><a href="<?= urladmin ?>"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
	<li class="active"><a href="<?= urladmin ?>index.php">Danh mục</a></li>
	<li class="active"><a href="<?= urladmin ?>index.php?p=san-pham&a=man">Sản phẩm</a></li>
	<li class="active"><a href="#">Nhập nhiều sản phẩm</a></li>
</ol>
<div class="col-xs-12">
	<div class="page-header mt-0">
		<h3 class="mt-0">Nhập nhiều sản phẩm từ file EXCEL</h1>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="jumbotron">
				<div class="row">
					<div class="col-md-12">
						<form action="" id="form_import">
							<div class="form-group">
								<label for="">Chọn tệp</label>
								<input type="file" name="file" class="form-control file-input" required />
							</div>
							<div class="form-group">
								<label for="">Danh mục mặc định</label>
								<select name="categoryId" id="categoryId" class="input width400 form-control selectpicker" data-live-search="true" style="border-radius:4px" required>
									<option value="0">Chọn danh mục</option>
									<?= $loai ?>
								</select>
							</div>
							<div class="form-group">
								<button class="btn btn-primary">Nhập ngay</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="jumbotron hide"></div>
		</div>
	</div>
</div>

<script>
	function onSubmitForm(e) {
		e.preventDefault();
		$messageErrorElement = $('#message_error');

		const categoryId = document.getElementById('categoryId').value;
		if (!categoryId) {
			swal('Vui lòng chọn danh mục mặc định', '', 'info');
			return;
		}

		swal({
			title: `Bạn có chắc chắn muốn nhập toàn bộ sản phẩm trong tệp này?`,
			type: "warning",
			showCancelButton: true,
			closeOnConfirm: false,
			confirmButtonText: "Nhập ngay",
			cancelButtonText: "Hủy",
			showLoaderOnConfirm: true,
			preConfirm: () => submitForm(e.target),
		}).then(preConfirmRes => {
			const res = preConfirmRes.value;
			console.log('res ====>', res);
			if (res.message) {
				swal(res.message, '', 'info');
				return;
			}
			const desc = `Thành công: ${res.inserted}<br/> Trùng: ${res.duplicated}<br/> Thất bại: ${res.failed}`;
			swal(`Đã nhập ${res.inserted} sản phẩm!`, desc, 'success');
		}, err => {
			console.log('err ====>', err);
			swal('Có lỗi xảy ra, vui lòng thử lại!', '', 'warning');
		});
	}

	function submitForm(form) {
		const formData = new FormData(form);

		return $.ajax({
			url: '/admin/sources/import.php',
			method: 'POST',
			dataType: 'json',
			data: formData,
			contentType: false,
			processData: false,
		});
	};

	$(document).ready(function() {
		$('#form_import').on('submit', onSubmitForm);
	});
</script>

<!-- Boostrap select box -->
<script type="text/javascript" src="/admin/assets/bootstrap-select-1.12.4/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="/admin/assets/bootstrap-select-1.12.4/js/i18n/defaults-vi_VN.min.js"></script>