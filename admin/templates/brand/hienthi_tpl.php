<ol class="breadcrumb sticky-left">
	<li><a href="."><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
	<li class="active"><a href=".">Nhãn hiệu</a></li>
	<li class="active"><a href="#">Danh sách</a></li>
</ol>
<div class="form-group sticky-left px-3">
	<div class="btn-group">
		<select id="action" name="action" onclick="form_submit(this)" class="form-control">
			<option selected>Tác vụ</option>
			<option value="delete">Xóa</option>
		</select>
	</div>
	<!-- <div class="btn-group">
		<input id="search" name="search" type="text" class="form-control" placeholder="Tìm kiếm"/>
	</div>
	<div class="btn-group">
		<select id="action" onchange="seach(this,'brand')" name="action" class="form-control">
			<option value="0" selected>Tìm theo</option>
			<option value="1">ID</option>
			<option value="2">Tên</option>
		</select>
	</div> -->
	<div class="btn-group">
		<select id="action" onchange="show(this,'brand')" name="action" class="form-control">
			<option value="0" selected>Số hiển thị</option>
			<option value="1">15</option>
			<option value="2">25</option>
			<option value="3">50</option>
			<option value="4">75</option>
			<option value="5">100</option>
			<option value="6">200</option>
			<option value="7">300</option>
		</select>
	</div>
	
	<!-- Advanced search -->
	<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#advancedSearch" aria-expanded="false" aria-controls="advancedSearch">
	  Mở rộng
	</button>
	<a href="index.php?p=<?php echo $p ?>&a=man&remove_filter" class="text-danger">Xóa bộ lọc</a>

	<div class="pull-right">
		<a href="/admin/index.php?p=brand&a=add" title="Thêm mới">
			<button class="btn btn-success">Thêm mới</button>
		</a>
	</div>
	<div class="clearfix"></div>
</div>

<div class="col-xs-12" style="margin-bottom: 8px;">
	<?php
		$advancedSearchUrl = $_SERVER[REQUEST_URI];
		$advancedSearchUrl .= !isset($_GET['search']) ? '&search=' : '';
		$advancedSearchUrl = preg_replace('|page=(\d).*|is', 'page=1', $advancedSearchUrl);
	?>
	<form action="<?php echo $advancedSearchUrl; ?>&search=" method="POST">
		<div class="collapse" id="advancedSearch">
			<div class="conditions"></div>
			<span onclick="addField()" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Thêm điều kiện</span>
			<button class="btn btn-success" name="search" value="search"><i class="glyphicon glyphicon-search"></i> Tìm</button>
		</div>
	</form>
</div>
<?php
$dataEnumGroup = [];
foreach ($brandGroups as $groupId => $group) {
	$dataEnumGroup[] = $groupId . ':' . $group['name_vi'];
}
$dataEnumGroup = join(';', $dataEnumGroup);
?>
<script type="text/javascript">
	const advancedSearchField = {
		all_field: {
			type: 'text',
			name: 'Tất cả',
		},
		name: {
			type: 'text',
			name: 'Tên',
		},
		group_id: {
			type: 'select',
			name: 'Nhóm',
			dataEnum: '<?php echo $dataEnumGroup; ?>'
		},
		slug: {
			type: 'text',
			name: 'Đường dẫn',
		},
		desc_vn: {
			type: 'text',
			name: 'Mô tả VN',
		},
		desc_us: {
			type: 'text',
			name: 'Mô tả US',
		},
		desc_ch: {
			type: 'text',
			name: 'Mô tả CH',
		},
		image: {
			type: 'select',
			name: 'Hình ảnh',
			dataEnum: '1:Có;0:Không'
		},
		is_show: {
			type: 'select',
			name: 'Hiển thị',
			dataEnum: '1:Có;0:Không'
		},
		is_featured: {
			type: 'select',
			name: 'Tiêu biểu',
			dataEnum: '1:Có;0:Không'
		},
	};

	<?php
		echo 'const currentFields = ' . (!empty($fields) ? json_encode($fields) : '""') . ';';
	?>

	let numberOfField = 0;

	if (currentFields) {
		Object.keys(currentFields).forEach( function(i, index) {
			const field = currentFields[i];
			addField();
			$('select[data-index="' + numberOfField + '"]').val(field.name);
			selectField($('select[data-index="' + numberOfField + '"]')[0]);
			$('.form-group[data-index="' + numberOfField + '"]').find('.compare').val(field.compare);
			$('.form-group[data-index="' + numberOfField + '"]').find('.value').val(field.value);
		});

		$('#advancedSearch').addClass('in');
	}

	function addField() {
		numberOfField++;
		let options = [];
		options.push(`
		<div class="form-group" data-index="${numberOfField}">
			<div class="btn-group pull-left">
				<span onclick="removeField(this)" class="btn btn-primary"><i class="glyphicon glyphicon-trash"></i></span>
			</div>
			<div class="btn-group pull-left">
				<select onchange="selectField(this)" data-index="${numberOfField}" class="form-control" name="fields[${numberOfField}][name]">
			`);
		options.push('<option value="">Chọn mục muốn tìm</option>');
		Object.keys(advancedSearchField).forEach(value => {
			const field = advancedSearchField[value];
			options.push(`<option value="${value}">${field.name}</option>`);
		});
		options.push('</select></div><span class="conditions" style="margin-left: 3px;"></span><div class="clearfix"></div></div>');

		// append to html
		$('#advancedSearch>.conditions').append(options.join(''));
	}

	function removeField(e) {
		const field = $(e).parent().parent();
		field.fadeOut('fast', () => field.remove());
	}

	function selectField(e) {
		const name = e.value;
		const field = advancedSearchField[name];
		const index = e.dataset.index;
		let conditions = '';
			

		switch (field.type) {
			case 'number':
				conditions += `
					<div class="btn-group pull-left ml-2">
					<select name="fields[${index}][compare]" class="compare form-control">
						<option value="=">Bằng</option>
						<option value=">">Lớn hơn</option>
						<option value="<">Bé hơn</option>
					</select>
					</div>
					<div class="btn-group col-md-6">
						<input name="fields[${index}][value]" type="text" class="form-control value width400" placeholder="Có chứa từ..." />
					</div>
				`;

				break;

			case 'text':
				conditions += `
					<div class="btn-group pull-left ml-2">
						<select name="fields[${index}][compare]" class="compare form-control">
							<option value="start">Bắt đầu bằng</option>
							<option value="like">Có chứa</option>
						</select>
					</div>
					<div class="btn-group col-md-7">
						<input name="fields[${index}][value]" type="text" class="form-control value width400" placeholder="Giá trị" />
					</div>
				`;

				break;

			case 'date':
				conditions += `
					<div class="btn-group pull-left ml-2">
						<select name="fields[${index}][compare]" class="compare form-control">
							<option value=">=">Từ ngày</option>
							<option value="<=">Đến ngày</option>
						</select>
					</div>
					<div class="btn-group col-md-7">
						<input name="fields[${index}][value]" type="date" class="form-control value width400" style="width:200px" placeholder="Giá trị" />
					</div>
				`;

				break;

			case 'select':

				conditions += `
					<div class="btn-group col-md-7">
						<input type="hidden" class="compare" name="fields[${index}][compare]" value="="/>
						<select name="fields[${index}][value]" class="form-control value width400">
				`;
				field.dataEnum.split(';').forEach(item => {
					console.log(item);
					const dataItem = item.split(':');
					const value = dataItem[0];
					const label = dataItem[1] || dataItem[0];

					conditions += `<option value="${value}">${label}</option>`;
				});
				conditions += '</select></div>';

				break;

			default:
				// statements_def
				break;
		}

		$(e).parent().parent().find('>.conditions').html(conditions);
	}
</script>

<div class="col-xs-12">
	<form id="form" method="post" action="index.php?p=brand&a=delete_all" role="form">
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th style="width:2%"><input type="checkbox" name="chk" value="0" class="chk_box checkall" id="check_all"></th>
					<th style="width:5%;">ID</th>
					<th style="width:10%;">Tên</th>
					<th style="width:3%;">Số sản phẩm</th>
					<th style="width:10%;">Đường dẫn</th>
					<th style="width:10%;">Nhóm</th>
					<th style="width:5%;">Hình ảnh</th>
					<th style="width:5%;">Hiển thị</th>
					<th style="width:5%;">Tiêu biểu</th>
					<th style="width:5%">Tác vụ</th>
				</tr>
			</thead>
			<tbody>
				<?php $count = count($items);for ($i = 0; $i < $count; $i++) {
					$item = $items[$i];
				?>
				<tr>
					<td>
						<input type="checkbox" name="chk_child[]" value="<?=$items[$i]['id']?>" class="chk_box ">
					</td>
					<td>
						<input type="text" class="a_stt" value="<?=$items[$i]['id'] ?>" readonly />
					</td>
					<td>
						<a href="index.php?p=brand&a=edit&id=<?=$item['id']?>&page=<?=@$_GET['page']?>" title="Sửa">
							<?php echo $item['name']; ?>
						</a>
						<a href="/nhan-hieu/<?php echo $item['slug']; ?>.html" target="_blank" class="text-success ml-4" title="Xem">
							<i class="glyphicon glyphicon-eye-open"></i>
						</a>
					</td>
					<td>
						<?php echo $countForBrands[$item['id']]; ?>
					</td>
					<td>
						<?php echo $item['slug']; ?>
					</td>
					<td>
						<?php echo $item['group_id'] > 0 && !empty($brandGroups[$item['group_id']]) ? $brandGroups[$item['group_id']]['name_vi'] : ''; ?>
					</td>
					<td>
						<?php
						if (!empty($item['image'])) {
							?>
							<img style="max-height: 120px" src="/img_data/images/<?php echo $item['image']; ?>" />
							<?php
						}
						?>
					</td>
					<td>
						<input class="chk_box" type="checkbox" onclick="on_check(this,'#_brand','is_show','<?php echo $item['id']; ?>')" <?php if($item['is_show'] == 1) echo 'checked="checked"'; ?>>
					</td>
					<td>
						<input class="chk_box" type="checkbox" onclick="on_check(this,'#_brand','is_featured','<?php echo $item['id']; ?>')" <?php if($item['is_featured'] == 1) echo 'checked="checked"'; ?>>
					</td>
					<td>
						<a href="index.php?p=brand&a=edit&id=<?=$item['id']?>&page=<?=@$_GET['page']?>" class="text-danger" title="Sửa"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;
						<a href="index.php?p=brand&a=delete&id=<?=$item['id']?>&page=<?=@$_GET['page']?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
					</td>
				</tr>
				<?php }?>
			</tbody>
		</table>
	</form>
</div>
<div class="pagination">
	<?php echo @$paging['paging'] ?>
</div>