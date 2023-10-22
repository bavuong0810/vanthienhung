<?php
@include "sources/editor.php";

// Prepare data
$item = [];
if ($_GET['a'] == 'edit') {
	$item = $items[0];
} else if ($_POST['submit']) {
	$item = $_POST;
}

$item['start_at'] = $item['start_at'] ? date('d-m-Y', strtotime($item['start_at'])): date('d-m-Y');
$item['end_at'] = $item['end_at'] ? date('d-m-Y', strtotime($item['end_at'])): date('d-m-Y', time() + 60 * 60 * 24 * 365);

?>
<script type="text/javascript" src="public/extra/bootstrap-datepicker/bootstrap-datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="public/extra/bootstrap-datepicker/bootstrap-datepicker.css">
<ol class="breadcrumb">
	<li><a href="<?=urladmin ?>"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
	<li class="active"><a href="<?=urladmin ?>index.php?p=bao-hanh&a=man">Bảo hành</a></li>
	<li class="active"><a href="#"><?php if(isset($_GET['id'])) echo "Sửa "; else echo "Thêm mới" ?></a></li>
</ol>
<div class="col-xs-12">
	<form name="frm" method="post" action="index.php?p=bao-hanh&a=save&id=<?=@$_REQUEST['id']?>&page=<?=@$_REQUEST['page']?>" enctype="multipart/form-data">
		<div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
			<ul id="myTabs" class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active">
					<a href="#id_viet" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Thông tin bảo hành sản phẩm</a>
				</li>
			</ul>
			<div id="myTabContent" class="tab-content">
				<div role="tabpanel" class="tab-pane fade active in" id="id_viet" aria-labelledby="home-tab">
					<table class="table table-bordered table-hover them_dt" style="border:none">
						<tbody>
							<tr>
								<td class="td_left">
									Serial:
								</td>
								<td class="td_right">
									<input
										type="text"
										class="input width400 form-control"
										id="specification" name="specification"
										value="<?php echo @$item['specification'];  ?>"
									/>
								</td>
							</tr>
							<tr>
								<td class="td_left">
									Code:
								</td>
								<td class="td_right">
									<input
										type="text"
										class="input width400 form-control"
										id="code" name="code"
										value="<?php echo @$item['code'];  ?>"
									/>
								</td>
							</tr>
							<tr>
								<td class="td_left">
									Bắt đầu:
								</td>
								<td class="td_right">
									<input
										type="text"
										class="input width400 form-control datepicker"
										id="start_at" name="start_at"
										value="<?php echo $item['start_at'];  ?>"
									/>
								</td>
							</tr>
							<tr>
								<td class="td_left">
									Kết thúc:
								</td>
								<td class="td_right">
									<input
										type="text"
										class="input width400 form-control datepicker"
										id="end_at" name="end_at"
										value="<?php echo @$item['end_at'];  ?>"
									/>
								</td>
							</tr>
							<!-- <tr>
								<td class="td_left">
									Nội dung bảo hành:
								</td>
								<td class="td_right">
									<textarea class="input width400 form-control" style="height:80px" name="noi_dung" id="noi_dung">
									<?=@$item['noi_dung']?></textarea>
									<?php $ckeditor->replace('noi_dung'); ?>
								</td>
							</tr> -->
							<tr>
								<td class="td_left" style="text-align:right">
									<input type="submit" name="submit" value="Lưu"  class="btn btn-primary" />
								</td>
								<td class="td_right">
									<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=bao-hanh&a=man'" class="btn btn-primary" />
								</td>
							</tr>
						</tbody>
					</table>
					<!-- end -->
				</div>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('.datepicker').datepicker({
			format: 'dd-mm-yyyy'
		});
	});
</script>