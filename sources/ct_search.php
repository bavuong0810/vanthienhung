<?php
function checkExpanded($params) {
	$fields = [
		'categoryId',
		'brandId',
		'minPrice',
		'maxPrice',
	];

	foreach($fields as $field) {
		if (!empty($params[$field])) {
			return true;
		}
	}

	return false;
}

$brands = $d->o_fet("SELECT id, name FROM #_brand WHERE name IS NOT NULL ORDER BY name ASC, id DESC");
$isExpended = checkExpanded($params);

?>
<form method="GET" action="/search.html">
	<input type="hidden" name="advanced-search" value="true" />
	<input type="hidden" name="com" value="search" />
	<div class="adv-search-box search-box bg-white mb-1">
		<h4>Tìm kiếm nâng cao</h4>
		<div class="row">
			<div class="col-md-8">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Tên phụ tùng</label>
							<input type="text" class="form-control" name="productName" value="<?php echo @$params['productName'] ?>">
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<label>&nbsp;</label>
				<div>
					<button class="btn btn-primary">
						<i class="fa fa-search"></i>
						Tìm
					</button>
					<button class="btn btn-info" type="button" data-toggle="collapse" data-target="#advancedSearch" aria-expanded="false" aria-controls="advancedSearch">
						<i class="fa fa-chevron-down"></i>
						Nâng cao
					</button>
					<a href="/?com=search" title="Xóa tìm kiếm">
						<button type="button" class="btn btn-default">
							<i class="fa fa-times"></i>
							Xóa
						</button>
					</a>
				</div>
			</div>
		</div>
		<div class="collapse row <?php echo $isExpended ? 'in' : '' ?>" id="advancedSearch">
			<div class="col-md-4">
				<div class="form-group">
					<label>Nhãn hiệu</label>
					<select name="brandId" class="input form-control selectpicker" data-live-search="true">
						<option value="">Chọn nhãn hiệu</option>
						<?php foreach ($brands as $brand): ?>
							<option value="<?php echo $brand['id'] ?>" <?php echo @$params['brandId'] == $brand['id'] ? 'selected' : '' ?>><?php echo $brand['name'] ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>

			<div class="col-md-4">
				<div class="form-group">
					<label>Giá lớn hơn</label>
					<input type="text" placeholder="Giá cao hơn..." class="form-control" name="minPrice" value="<?php echo @$params['minPrice'] ?>" data-type="currency" maxlength="20">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label>Giá thấp hơn</label>
					<input type="text" placeholder="Giá thấp hơn..." class="form-control" name="maxPrice" value="<?php echo @$params['maxPrice'] ?>" data-type="currency" maxlength="20">
				</div>
			</div>
		</div>
	</div>
</form>

<script type="text/javascript" src="/templates/extra/bootstrap-select-1.12.4/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="/templates/extra/bootstrap-select-1.12.4/js/i18n/defaults-vi_VN.min.js"></script>
<script defer>
	$("input[data-type='currency']").on({
		keyup: function() {
			formatCurrency($(this));
		},
		blur: function() { 
			formatCurrency($(this));
		}
	});
	// Format on rendered
	$(document).ready(function(){
		$("input[data-type='currency']").each(function() {
			formatCurrency($(this));
		});
	});


	function formatNumber(n) {
	// format number 1000000 to 1,234,567
	return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
	}


	function formatCurrency(input, blur) {
	// appends $ to value, validates decimal side
	// and puts cursor back in right position.
	
	// get input value
	var input_val = input.val();
	
	// don't validate empty input
	if (input_val === "") { return; }
	
	// original length
	var original_len = input_val.length;

	// initial caret position 
	var caret_pos = input.prop("selectionStart");
		
	// check for decimal
	if (input_val.indexOf(".") >= 0) {

		// get position of first decimal
		// this prevents multiple decimals from
		// being entered
		var decimal_pos = input_val.indexOf(".");

		// split number by decimal point
		var left_side = input_val.substring(0, decimal_pos);
		var right_side = input_val.substring(decimal_pos);

		// add commas to left side of number
		left_side = formatNumber(left_side);

		// validate right side
		right_side = formatNumber(right_side);
		
		// On blur make sure 2 numbers after decimal
		// if (blur === "blur") {
		// right_side += "00";
		// }
		
		// Limit decimal to only 2 digits
		right_side = right_side.substring(0, 2);

		// join number by .
		input_val = left_side + "." + right_side;

	} else {
		// no decimal entered
		// add commas to number
		// remove all non-digits
		input_val = formatNumber(input_val);
		input_val = input_val;
		
		// final formatting
		// if (blur === "blur") {
		// input_val += ".00";
		// }
	}
	
	// send updated string to input
	input.val(input_val);

	// put caret back in the right position
	var updated_len = input_val.length;
	caret_pos = updated_len - original_len + caret_pos;
	input[0].setSelectionRange(caret_pos, caret_pos);
	}
</script>