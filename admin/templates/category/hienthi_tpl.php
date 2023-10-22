<ol class="breadcrumb">
	<li><a href="<?= urladmin ?>index.php"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
	<li class="active"><a href="<?= urladmin ?>index.php">Danh mục</a></li>
	<li class="active"><a href="<?= urladmin ?>index.php?p=category&a=man">Loại danh mục</a></li>
</ol>

<div class="col-xs-12">
	<div class="form-group tac-vu">
		<div class="btn-group">
			<select id="action" name="action" onclick="form_submit(this)" class="form-control">
				<option selected>Tác vụ</option>
				<option value="delete">Xóa</option>
			</select>
		</div>

		<div class="btn-group">
			<input id="search" name="search" type="text" class="form-control" placeholder="Tìm kiếm" />
		</div>
		<div class="btn-group">
			<select id="action" onchange="seach(this,'category')" name="action" class="form-control">
				<option value="0" selected>Tìm theo</option>
				<option value="1">ID</option>
				<option value="2">Tên</option>
			</select>
		</div>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$('input#search').keypress(function(e) {
					var key = this.value;
					if (e.which == 13) {
						window.location = "index.php?p=category&a=man&seach=name&key=" + key;
					}
				});
			});
		</script>
		<div class="btn-group">
			<select id="action" onchange="show(this,'category')" name="action" class="form-control">
				<option value="0" selected>Số hiển thị</option>
				<option value="1" <?php if (@$_GET['hienthi'] == 1) echo 'selected'; ?>>15</option>
				<option value="2" <?php if (@$_GET['hienthi'] == 2) echo 'selected'; ?>>25</option>
				<option value="3" <?php if (@$_GET['hienthi'] == 3) echo 'selected'; ?>>50</option>
				<option value="4" <?php if (@$_GET['hienthi'] == 4) echo 'selected'; ?>>75</option>
				<option value="5" <?php if (@$_GET['hienthi'] == 5) echo 'selected'; ?>>100</option>
				<option value="6" <?php if (@$_GET['hienthi'] == 6) echo 'selected'; ?>>200</option>
				<option value="7" <?php if (@$_GET['hienthi'] == 7) echo 'selected'; ?>>300</option>
				<option value="8" <?php if (@$_GET['hienthi'] == 8) echo 'selected'; ?>>500</option>
				<option value="9" <?php if (@$_GET['hienthi'] == 9) echo 'selected'; ?>>1000</option>
			</select>
		</div>


		<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#advancedSearch" aria-expanded="false" aria-controls="advancedSearch">
			Mở rộng
		</button>
		<a href="index.php?p=category&a=man&remove_filter" class="text-danger">Xóa bộ lọc</a>

		<a href="index.php?p=category&a=add" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-plus"></i> Thêm mới</a>
	</div>

	<div class="col-xs-12" style="margin-bottom: 8px;">
		<?php
		$advancedSearchUrl = $_SERVER[REQUEST_URI];
		$advancedSearchUrl .= !isset($_GET['search']) ? '&search=' : '';
		?>
		<form action="<?php echo $advancedSearchUrl; ?>" method="POST">
			<div class="collapse" id="advancedSearch">
				<div class="conditions"></div>
				<span onclick="addField()" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Thêm điều kiện</span>
				<button class="btn btn-success" name="search" value="search"><i class="glyphicon glyphicon-search"></i> Tìm</button>
			</div>
		</form>
	</div>

	<script type="text/javascript">
		const advancedSearchField = {
			all_field: {
				type: 'text',
				name: 'Tất cả',
			},
			so_thu_tu: {
				type: 'text',
				name: 'Số thứ tự',
				compare: '=',
			},
			name_vi: {
				type: 'text',
				name: 'Tên VN',
			},
			name_ch: {
				type: 'text',
				name: 'Tên CH',
			},
			name_en: {
				type: 'text',
				name: 'Tên US',
			},
			image_path: {
				type: 'select',
				name: 'Hình ảnh',
				dataEnum: '1:Có;0:Không'
			},
			hien_thi: {
				type: 'select',
				name: 'Hiển thị',
				dataEnum: '1:Có;0:Không'
			},
			is_hot: {
				type: 'select',
				name: 'Trang chủ',
				dataEnum: '1:Có;0:Không'
			},
			menu: {
				type: 'select',
				name: 'Danh mục',
				dataEnum: '1:Có;0:Không'
			},
		};

		<?php
		echo 'const currentFields = ' . (!empty($fields) ? json_encode($fields) : '""') . ';';
		?>

		let numberOfField = 0;

		if (currentFields) {
			Object.keys(currentFields).forEach(function(i, index) {
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
					<div class="btn-group pull-left">
					<select name="fields[${index}][compare]" class="compare form-control">
						<option value="=">Bằng</option>
						<option value=">">Lớn hơn</option>
						<option value="<">Bé hơn</option>
					</select>
					</div>
					<div class="btn-group col-md-6">
						<input name="fields[${index}][value]" type="text" class="form-control value" placeholder="Có chứa từ..." />
					</div>
				`;

					break;

				case 'text':
					conditions += `
					<div class="btn-group pull-left">
						<select name="fields[${index}][compare]" class="compare form-control">
							<option value="start">Bắt đầu bằng</option>
							<option value="like">Có chứa</option>
						</select>
					</div>
					<div class="btn-group col-md-7">
						<input name="fields[${index}][value]" type="text" class="form-control value" placeholder="Giá trị" />
					</div>
				`;

					break;

				case 'date':
					conditions += `
					<div class="btn-group pull-left">
						<select name="fields[${index}][compare]" class="compare form-control">
							<option value=">=">Từ ngày</option>
							<option value="<=">Đến ngày</option>
						</select>
					</div>
					<div class="btn-group col-md-7">
						<input name="fields[${index}][value]" type="date" class="form-control value" style="width:200px" placeholder="Giá trị" />
					</div>
				`;

					break;

				case 'select':

					conditions += `
					<div class="btn-group col-md-7">
						<input type="hidden" class="compare" name="fields[${index}][compare]" value="="/>
						<select name="fields[${index}][value]" class="form-control value">
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

	<form id="form" method="post" action="index.php?p=category&a=delete_all" role="form">

		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th style="width:3%"><input class="chk_box checkall" type="checkbox" name="chk" value="0" id="check_all"></th>
					<th style="width:5%">STT</th>
					<th style="width:5%">ID</th>
					<th style="width:40%; text-align:left">Danh mục</th>
					<th style="width:8%">Tên US</th>
					<th style="width:8%">Tên CH</th>
					<th style="width:8%">Hình ảnh</th>
					<th style="width:8%">Module</th>
					<th style="width:8%">Trang chủ</th>
					<th style="width:8%">Danh mục</th>
					<!-- <th style="width:8%">Top Menu</th> -->
					<th style="width:8%">Hiển thị</th>
					<th style="width:8%">Tác vụ</th>
				</tr>
			</thead>
			<tbody>
				<?php $count = count($items);
				for ($i = 0; $i < $count; $i++) { ?>
					<tr>
						<td>
							<input class="chk_box" type="checkbox" name="chk_child[]" value="<?= $items[$i]['id'] ?>">
						</td>
						<td>
							<input type="number" value="<?= $items[$i]['so_thu_tu'] ?>" class="a_stt" data-table="#_category" data-col="so_thu_tu" data-id="<?= $items[$i]['id'] ?>" />
						</td>

						<td>
							<input type="text" class="a_stt" value="<?=$items[$i]['id'] ?>" readonly />
						</td>

						<td style=" text-align:left">
							<a href="index.php?p=category&a=edit&id=<?= $items[$i]['id'] ?>&page=<?= @$_GET['page'] ?>"><?= $items[$i]['name_vi'] ?></a>
						</td>
						<td>
							<a href="index.php?p=category&a=edit&id=<?= $items[$i]['id'] ?>&page=<?= @$_GET['page'] ?>"><?= $items[$i]['name_en'] ?></a>
						</td>
						<td>
							<a href="index.php?p=category&a=edit&id=<?= $items[$i]['id'] ?>&page=<?= @$_GET['page'] ?>"><?= $items[$i]['name_ch'] ?></a>
						</td>
						<td>
							<?php if ($items[$i]['image_path'] <> '') { ?>
								<a href="index.php?p=category&a=delete_image&id=<?= $items[$i]['id'] ?>&page=<?= @$_GET['page'] ?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa">
									<img src="../img_data/images/<?= $items[$i]['image_path'] ?>" style="width:50px">
								</a>
							<?php } ?>
						</td>
						<td>
							<?php
							if (!empty($items[$i]['module']) && !empty($modulesMap[$items[$i]['module']])) {
								$module = $modulesMap[$items[$i]['module']];
								echo $module['title'];
							}
							?>
						</td>
						<td>
							<input class="chk_box" type="checkbox" onclick="on_check(this,'#_category','menu','<?= $items[$i]['id'] ?>')" <?php if ($items[$i]['menu'] == 1) echo 'checked="checked"'; ?>>
						</td>
						<td>
							<input class="chk_box" type="checkbox" onclick="on_check(this,'#_category','is_hot','<?= $items[$i]['id'] ?>')" <?php if ($items[$i]['is_hot'] == 1) echo 'checked="checked"'; ?>>
						</td>
						<!-- <td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_category','is_top','<?= $items[$i]['id'] ?>')" <?php if ($items[$i]['is_top'] == 1) echo 'checked="checked"'; ?>>
			</td> -->

						<!-- HIỂN THỊ -->
						<td>
							<input class="chk_box" type="checkbox" onclick="on_check(this,'#_category','hien_thi','<?= $items[$i]['id'] ?>')" <?php if ($items[$i]['hien_thi'] == 1) echo 'checked="checked"'; ?>>
						</td>
						<td>
							<a href="index.php?p=category&a=edit&id=<?= $items[$i]['id'] ?>&page=<?= @$_GET['page'] ?>" class="text-danger" title="Sửa"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;
							<a href="index.php?p=category&a=delete&id=<?= $items[$i]['id'] ?>&page=<?= @$_GET['page'] ?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
						</td>
					</tr>
					<!-- // cap 1 -->
					<?php
					$child_items = [];
					if (!isset($_GET['search'])) {
						$child_items = $d->o_fet("select * from #_category where category_id ='" . $items[$i]['id'] . "' order by so_thu_tu asc");
					}

					$count_child = count($child_items);
					for ($j = 0; $j < $count_child; $j++) {
					?>
						<tr>
							<td>
								<input type="checkbox" class="chk_box" name="chk_child[]" value="<?= $child_items[$j]['id'] ?>">
							</td>
							<td>
								<input type="text" class="a_stt" value="<?=$child_items[$j]['id'] ?>" readonly />
							</td>
							<td>
								<input type="number" value="<?= $child_items[$j]['so_thu_tu'] ?>" class="a_stt" data-table="#_category" data-col="so_thu_tu" data-id="<?= $child_items[$j]['id'] ?>" />
							</td>
							<td style="text-align:left">
								<a style="padding-left:15px" href="index.php?p=category&a=edit&id=<?= $child_items[$j]['id'] ?>&page=<?= @$_GET['page'] ?>">|____ <?= $child_items[$j]['name_vi'] ?></a>
								<!--br/>
				<a style="padding-left:50px" href="index.php?p=category&a=edit&id=<?= $child_items[$j]['id'] ?>&page=<?= @$_GET['page'] ?>"><?= $child_items[$j]['name_en'] ?></a>
				<br/>
				<a style="padding-left:50px" href="index.php?p=category&a=edit&id=<?= $child_items[$j]['id'] ?>&page=<?= @$_GET['page'] ?>"><?= $child_items[$j]['name_ch'] ?></a-->
							</td>
							<td>
								<a href="index.php?p=category&a=edit&id=<?= $child_items[$j]['id'] ?>&page=<?= @$_GET['page'] ?>"><?= $child_items[$j]['name_en'] ?></a>
							</td>
							<td>
								<a href="index.php?p=category&a=edit&id=<?= $child_items[$j]['id'] ?>&page=<?= @$_GET['page'] ?>"><?= $child_items[$j]['name_ch'] ?></a>
							</td>
							<td>
								<?php if ($child_items[$j]['image_path'] <> '') { ?>
									<a href="index.php?p=category&a=delete_image&id=<?= $child_items[$j]['id'] ?>&page=<?= @$_GET['page'] ?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa">
										<img src="../img_data/images/<?= $child_items[$j]['image_path'] ?>" style="width:50px">
									</a>
								<?php } ?>
							</td>
							<td>
								<?php
								if (!empty($child_items[$j]['module']) && !empty($modulesMap[$child_items[$j]['module']])) {
									$module = $modulesMap[$child_items[$j]['module']];
									echo $module['title'];
								}
								?>
							</td>
							<td>
								<input class="chk_box" type="checkbox" onclick="on_check(this,'#_category','menu','<?= $child_items[$j]['id'] ?>')" <?php if ($child_items[$j]['menu'] == 1) echo 'checked="checked"'; ?>>
							</td>
							<td>
								<input class="chk_box" type="checkbox" onclick="on_check(this,'#_category','is_hot','<?= $child_items[$j]['id'] ?>')" <?php if ($child_items[$j]['is_hot'] == 1) echo 'checked="checked"'; ?>>
							</td>
							<!-- <td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_category','is_top','<?= $child_items[$j]['id'] ?>')" <?php if ($child_items[$j]['is_top'] == 1) echo 'checked="checked"'; ?>>
			</td> -->
							<td>
								<input class="chk_box" type="checkbox" onclick="on_check(this,'#_category','hien_thi','<?= $child_items[$j]['id'] ?>')" <?php if ($child_items[$j]['hien_thi'] == 1) echo 'checked="checked"'; ?>>
							</td>
							<td>
								<a href="index.php?p=category&a=edit&id=<?= $child_items[$j]['id'] ?>&page=<?= @$_GET['page'] ?>" class="text-danger" title="Sửa"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;
								<a href="index.php?p=category&a=delete&id=<?= $child_items[$j]['id'] ?>&page=<?= @$_GET['page'] ?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
							</td>
						</tr>
						<!-- cap 2 -->
						<?php
						$child_items_2 = $d->o_fet("select * from #_category where category_id ='" . $child_items[$j]['id'] . "' order by so_thu_tu asc");
						$count_child_2 = count($child_items_2);
						for ($k = 0; $k < $count_child_2; $k++) {
						?>
							<tr>
								<td>
									<input type="checkbox" class="chk_box" name="chk_child[]" value="<?= $child_items_2[$k]['id'] ?>">
								</td>
								<td>
									<input type="text" class="a_stt" value="<?=$child_items_2[$k]['id'] ?>" readonly />
								</td>
								<td>
									<input type="number" value="<?= $child_items_2[$k]['so_thu_tu'] ?>" class="a_stt" data-table="#_category" data-col="so_thu_tu" data-id="<?= $child_items_2[$k]['id'] ?>" />
								</td>
								<td style="text-align:left">
									<a style="padding-left:60px" href="index.php?p=category&a=edit&id=<?= $child_items_2[$k]['id'] ?>&page=<?= @$_GET['page'] ?>">|____ <?= $child_items_2[$k]['name_vi'] ?></a>
									<!--br/>
				<a style="  padding-left: 95px;" href="index.php?p=category&a=edit&id=<?= $child_items_2[$k]['id'] ?>&page=<?= @$_GET['page'] ?>"><?= $child_items_2[$k]['name_en'] ?></a>
				<br/>
				<a style="  padding-left: 95px;" href="index.php?p=category&a=edit&id=<?= $child_items_2[$k]['id'] ?>&page=<?= @$_GET['page'] ?>"><?= $child_items_2[$k]['name_ch'] ?></a-->
								</td>
								<td>
									<a href="index.php?p=category&a=edit&id=<?= $child_items_2[$k]['id'] ?>&page=<?= @$_GET['page'] ?>"><?= $child_items_2[$k]['name_en'] ?></a>
								</td>
								<td>
									<a href="index.php?p=category&a=edit&id=<?= $child_items_2[$k]['id'] ?>&page=<?= @$_GET['page'] ?>"><?= $child_items_2[$k]['name_ch'] ?></a>
								</td>
								<td>
									<?php if ($child_items_2[$k]['image_path'] <> '') { ?>
										<a href="index.php?p=category&a=delete_image&id=<?= $child_items_2[$k]['id'] ?>&page=<?= @$_GET['page'] ?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa">
											<img src="../img_data/images/<?= $child_items_2[$k]['image_path'] ?>" style="width:50px">
										</a>
									<?php } ?>
								</td>
								<td>
									<?php
									if (!empty($child_items_2[$k]['module']) && !empty($modulesMap[$child_items_2[$k]['module']])) {
										$module = $modulesMap[$child_items_2[$k]['module']];
										echo $module['title'];
									}
									?>
								</td>
								<td>
									<input class="chk_box" type="checkbox" onclick="on_check(this,'#_category','menu','<?= $child_items_2[$k]['id'] ?>')" <?php if ($child_items_2[$k]['menu'] == 1) echo 'checked="checked"'; ?>>
								</td>
								<td>
									<input class="chk_box" type="checkbox" onclick="on_check(this,'#_category','is_hot','<?= $child_items_2[$k]['id'] ?>')" <?php if ($child_items_2[$k]['is_hot'] == 1) echo 'checked="checked"'; ?>>
								</td>
								<!-- <td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_category','is_top','<?= $child_items_2[$k]['id'] ?>')" <?php if ($child_items_2[$k]['is_top'] == 1) echo 'checked="checked"'; ?>>
			</td> -->
								<td>
									<input class="chk_box" type="checkbox" onclick="on_check(this,'#_category','hien_thi','<?= $child_items_2[$k]['id'] ?>')" <?php if ($child_items_2[$k]['hien_thi'] == 1) echo 'checked="checked"'; ?>>
								</td>
								<td>
									<a href="index.php?p=category&a=edit&id=<?= $child_items_2[$k]['id'] ?>&page=<?= @$_GET['page'] ?>" class="text-danger" title="Sửa"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;
									<a href="index.php?p=category&a=delete&id=<?= $child_items_2[$k]['id'] ?>&page=<?= @$_GET['page'] ?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
								</td>
							</tr>
							<!-- cap 3 -->
							<?php
							$child_items_3 = $d->o_fet("select * from #_category where category_id ='" . $child_items_2[$k]['id'] . "' order by so_thu_tu asc");
							$count_child_3 = count($child_items_3);
							for ($m = 0; $m < $count_child_3; $m++) {
							?>
								<tr>
									<td>
										<input type="checkbox" class="chk_box" name="chk_child[]" value="<?= $child_items_3[$m]['id'] ?>">
									</td>
									<td>
										<input type="text" class="a_stt" value="<?=$child_items_3[$m]['id'] ?>" readonly />
									</td>
									<td>
										<input type="number" value="<?= $child_items_3[$m]['so_thu_tu'] ?>" class="a_stt" data-table="#_category" data-col="so_thu_tu" data-id="<?= $child_items_3[$m]['id'] ?>" />
									</td>
									<td style="text-align:left">
										<a style="padding-left:120px" href="index.php?p=category&a=edit&id=<?= $child_items_3[$m]['id'] ?>&page=<?= @$_GET['page'] ?>">|____<?= $child_items_3[$m]['name_vi'] ?></a>
										<!--br/>
				<a style="  padding-left: 95px;" href="index.php?p=category&a=edit&id=<?= $child_items_3[$m]['id'] ?>&page=<?= @$_GET['page'] ?>"><?= $child_items_3[$m]['name_en'] ?></a>
				<br/>
				<a style="  padding-left: 95px;" href="index.php?p=category&a=edit&id=<?= $child_items_3[$m]['id'] ?>&page=<?= @$_GET['page'] ?>"><?= $child_items_3[$m]['name_ch'] ?></a-->
									</td>
									<td>
										<a href="index.php?p=category&a=edit&id=<?= $child_items_3[$i]['id'] ?>&page=<?= @$_GET['page'] ?>"><?= $child_items_3[$i]['name_en'] ?></a>
									</td>
									<td>
										<a href="index.php?p=category&a=edit&id=<?= $child_items_3[$i]['id'] ?>&page=<?= @$_GET['page'] ?>"><?= $child_items_3[$i]['name_ch'] ?></a>
									</td>
									<td>
										<?php if ($child_items_3[$m]['image_path'] <> '') { ?>
											<img src="../img_data/images/<?= $child_items_3[$m]['image_path'] ?>" style="width:50px">
										<?php } ?>
									</td>
									<td>
										<?php
										if (!empty($child_items_3[$m]['module']) && !empty($modulesMap[$child_items_3[$m]['module']])) {
											$module = $modulesMap[$child_items_3[$m]['module']];
											echo $module['title'];
										}
										?>
									</td>
									<td>
										<input class="chk_box" type="checkbox" onclick="on_check(this,'#_category','menu','<?= $child_items_3[$m]['id'] ?>')" <?php if ($child_items_3[$m]['menu'] == 1) echo 'checked="checked"'; ?>>
									</td>
									<td>
										<input class="chk_box" type="checkbox" onclick="on_check(this,'#_category','is_hot','<?= $child_items_3[$m]['id'] ?>')" <?php if ($child_items_3[$m]['is_hot'] == 1) echo 'checked="checked"'; ?>>
									</td>
									<!-- <td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_category','is_top','<?= $child_items_3[$m]['id'] ?>')" <?php if ($child_items_3[$m]['is_top'] == 1) echo 'checked="checked"'; ?>>
			</td> -->
									<td>
										<input class="chk_box" type="checkbox" onclick="on_check(this,'#_category','hien_thi','<?= $child_items_3[$m]['id'] ?>')" <?php if ($child_items_3[$m]['hien_thi'] == 1) echo 'checked="checked"'; ?>>
									</td>
									<td>
										<a href="index.php?p=category&a=edit&id=<?= $child_items_3[$m]['id'] ?>&page=<?= @$_GET['page'] ?>" class="text-danger" title="Sửa"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;
										<a href="index.php?p=category&a=delete&id=<?= $child_items_3[$m]['id'] ?>&page=<?= @$_GET['page'] ?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
									</td>
								</tr>

								<!-- cap 4 -->
								<?php
								$child_items_4 = $d->o_fet("select * from #_category where category_id ='" . $child_items_3[$m]['id'] . "' order by so_thu_tu asc");
								$count_child_4 = count($child_items_4);
								for ($l = 0; $l < $count_child_4; $l++) {
								?>
									<tr>
										<td>
											<input type="checkbox" class="chk_box" name="chk_child[]" value="<?= $child_items_4[$l]['id'] ?>">
										</td>
										<td>
											<input type="text" class="a_stt" value="<?=$child_items_4[$l]['id'] ?>" readonly />
										</td>
										<td>
											<input type="number" value="<?= $child_items_4[$l]['so_thu_tu'] ?>" class="a_stt" data-table="#_category" data-col="so_thu_tu" data-id="<?= $child_items_4[$l]['id'] ?>" />
										</td>
										<td style="text-align:left">
											<a style="padding-left:160px" href="index.php?p=category&a=edit&id=<?= $child_items_4[$l]['id'] ?>&page=<?= @$_GET['page'] ?>">|____<?= $child_items_4[$l]['name_vi'] ?></a>
											<!--br/>
				<a style="  padding-left: 95px;" href="index.php?p=category&a=edit&id=<?= $child_items_4[$l]['id'] ?>&page=<?= @$_GET['page'] ?>"><?= $child_items_4[$l]['name_en'] ?></a>
				<br/>
				<a style="  padding-left: 95px;" href="index.php?p=category&a=edit&id=<?= $child_items_4[$l]['id'] ?>&page=<?= @$_GET['page'] ?>"><?= $child_items_4[$l]['name_ch'] ?></a-->
										</td>
										<td>
											<a href="index.php?p=category&a=edit&id=<?= $child_items_4[$i]['id'] ?>&page=<?= @$_GET['page'] ?>"><?= $child_items_4[$i]['name_en'] ?></a>
										</td>
										<td>
											<a href="index.php?p=category&a=edit&id=<?= $child_items_4[$i]['id'] ?>&page=<?= @$_GET['page'] ?>"><?= $child_items_4[$i]['name_ch'] ?></a>
										</td>
										<td>
											<?php if ($child_items_4[$l]['image_path'] <> '') { ?>
												<img src="../img_data/images/<?= $child_items_3[$l]['image_path'] ?>" style="width:50px">
											<?php } ?>
										</td>
										<td>
											<?php
											if (!empty($child_items_4[$l]['module']) && !empty($modulesMap[$child_items_4[$l]['module']])) {
												$module = $modulesMap[$child_items_4[$l]['module']];
												echo $module['title'];
											}
											?>
										</td>
										<td>
											<input class="chk_box" type="checkbox" onclick="on_check(this,'#_category','menu','<?= $child_items_4[$l]['id'] ?>')" <?php if ($child_items_4[$l]['menu'] == 1) echo 'checked="checked"'; ?>>
										</td>
										<td>
											<input class="chk_box" type="checkbox" onclick="on_check(this,'#_category','is_hot','<?= $child_items_4[$l]['id'] ?>')" <?php if ($child_items_4[$l]['is_hot'] == 1) echo 'checked="checked"'; ?>>
										</td>
										<td>
											<input class="chk_box" type="checkbox" onclick="on_check(this,'#_category','hien_thi','<?= $child_items_4[$l]['id'] ?>')" <?php if ($child_items_4[$l]['hien_thi'] == 1) echo 'checked="checked"'; ?>>
										</td>
										<td>
											<a href="index.php?p=category&a=edit&id=<?= $child_items_4[$l]['id'] ?>&page=<?= @$_GET['page'] ?>" class="text-danger" title="Sửa"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;
											<a href="index.php?p=category&a=delete&id=<?= $child_items_4[$l]['id'] ?>&page=<?= @$_GET['page'] ?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
										</td>
									</tr>

								<?php } ?>
								<!-- end cap 4 -->
							<?php } ?>
							<!-- end cap 3 -->
						<?php } ?>
						<!-- end cap 2 -->
					<?php } ?>
					<!-- end cap 1 -->
				<?php } ?>
			</tbody>
		</table>
	</form>
</div>
<div class="pagination">
	<?php echo @$paging['paging'] ?>
</div>