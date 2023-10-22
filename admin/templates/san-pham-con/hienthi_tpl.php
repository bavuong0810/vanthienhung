<?php
include('lang.php');
$currentPageParams = $_GET;
unset($currentPageParams['clone_id']);
$currentPageParams['wind_action'] = 'clone';
$currentPageUrlQueryString = http_build_query($currentPageParams);
$cloneBaseUrl = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) . '?' . $currentPageUrlQueryString . '&clone_id=';
?>


<link rel="stylesheet" href="/admin/assets/lightbox2/css/lightbox.min.css" type="text/css" media="screen" />
<style type="text/css">
	#lightbox {
		top: 80px !important;
	}

	.break-word {
		word-break: break-word;
	}
</style>
<ol class="breadcrumb sticky-left">
	<li><a href="<?= urladmin ?>"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
	<li class="active"><a href="<?= urladmin ?>">Danh mục</a></li>
	<li class="active"><a href="<?= urladmin ?>index.php?p=san-pham-con&a=man">Sản phẩm</a></li>
</ol>

<div class="col-xs-12 sticky-left">
	<form action="index.php">
		<div class="form-group tac-vu">
			<input type="hidden" name="p" value="san-pham-con" />
			<input type="hidden" name="a" value="man" />
			<?php
			// add search field for advanced search if existed
			if (isset($_GET['search'])) {
				echo '<input type="hidden" name="search" value=""/>';
			}
			?>
			<div class="btn-group">
				<select onclick="form_submit(this)" class="form-control">
					<option selected>Tác vụ</option>
					<option value="delete">Xóa</option>
				</select>
			</div>
			<!-- <div class="btn-group">
		<input id="search" name="search" type="text" class="form-control" placeholder="Tìm kiếm"/>
	</div>
	<div class="btn-group">
		<select id="action" onchange="search(this,'san-pham-con')" name="action" class="form-control">
			<option value="0" selected>Tìm theo</option>
			<option value="1">ID</option>
			<option value="3">Mã SP</option>
			<option value="2">Tên</option>
		</select>
	</div> -->
			<!-- <script type="text/javascript">
	    jQuery(document).ready(function($) {
	        $('input#search').keypress(function (e) {
	         var key = this.value;
	           if (e.which == 13) {
	             window.location = "index.php?p=san-pham-con&a=man&search=name&key="+key;
	           }
	        });        
	    }); 
	</script> -->
			<div class="btn-group">
				<select onchange="this.form.submit()" name="hienthi" class="form-control">
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
			<div class="btn-group">
				<select onchange="this.form.submit()" name="category_id" class="form-control">
					<option value="0" selected>Xem tất cả sản phẩm</option>
					<option value="-1" <?php echo $_GET['category_id'] == -1 ? 'selected' : ''; ?>>Không thuộc danh mục nào
					</option>
					<option value="-2" <?php echo $_GET['category_id'] == -2 ? 'selected' : ''; ?>>Có danh mục</option>
					<?= $loai ?>
				</select>
			</div>
			<div class="btn-group">
				<select onchange="this.form.submit()" name="orderby" class="form-control">
					<option value="">Sắp xếp</option>
					<?php
					$orderBys = array(
						'price' => 'Giá',
						'cost' => 'Giá nhập',
						'view' => 'Lượt xem',
						'weight' => 'Trọng lượng',
						'khung_nang' => 'Tình trạng %',
						'mfg_year' => 'Năm',
						'gio_su_dung' => 'Giờ sử dụng',
						'so_thu_tu' => 'Số thứ tự',
						'category_id'	=> 'Danh mục',
						'ngay_dang' => 'Ngày đăng',
					);

					foreach ($orderBys as $value => $name) {
						echo '<option value="' . $value . '-asc"' . (@$_GET['orderby'] == $value . '-asc' ? ' selected' : '') . '>' . $name . ' tăng dần</option>';
						echo '<option value="' . $value . '-desc"' . (@$_GET['orderby'] == $value . '-desc' ? ' selected' : '') . '>' . $name . ' giảm dần</option>';
					}
					?>
				</select>
			</div>
			<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#advancedSearch" aria-expanded="false" aria-controls="advancedSearch">
				Mở rộng
			</button>
			<a href="index.php?p=san-pham-con&a=man&remove_filter" class="text-danger">Xóa bộ lọc</a>
			<!--a style="margin-left:10px;" href="index.php?p=ql-binhluan&a=export_list&ex_id=<?= $_GET['id'] ?>" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-file"></i> Xuất FILE</a-->
			<div class="pull-right">
				<a href="index.php?p=san-pham-con&a=add" class="btn btn-primary">
					<i class="glyphicon glyphicon-plus"></i> Thêm mới
				</a>
			</div>
		</div>
	</form>
</div>
<div class="col-xs-12 sticky-left">
	<?php
	$advancedSearchUrl = $_SERVER['REQUEST_URI'];
	$advancedSearchUrl .= !isset($_GET['search']) ? '&search=' : '';
	?>
	<form action="<?php echo $advancedSearchUrl; ?>" method="POST">
		<div class="collapse" id="advancedSearch">
			<div class="conditions"></div>
			<span onclick="addField()" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Thêm điều
				kiện</span>
			<button class="btn btn-success" name="search" value="search"><i class="glyphicon glyphicon-search"></i>
				Tìm</button>
		</div>
	</form>
</div>
<div class="col-xs-12">

	<script type="text/javascript">
		const advancedSearchField = {
			all_field: {
				type: 'text',
				name: 'Tất cả',
			},
			image_path: {
				type: 'select',
				name: 'Hình ảnh',
				dataEnum: '1:Có;0:Không'
			},
			so_thu_tu: {
				type: 'text',
				name: 'Số thứ tự',
				compare: '=',
			},
			name_vi: {
				type: 'text',
				name: 'Tên sản phẩm',
			},
			code: {
				type: 'text',
				name: 'Mã sản phẩm',
			},
			code_2: {
				type: 'text',
				name: 'Mã sản phẩm 2',
			},
			model: {
				type: 'text',
				name: 'Model',
			},
			view: {
				type: 'number',
				name: 'Lượt xem',
			},
			brand_id: {
				type: 'select',
				name: 'Hiệu (Có/Không)',
				dataEnum: '1:Có;0:Không'
			},
			'br.name': {
				type: 'text',
				name: 'Hiệu'
			},
			part_number: {
				type: 'text',
				name: 'Part Number , S/N',
			},
			price: {
				type: 'number',
				name: 'Giá',
			},
			cost: {
				type: 'number',
				name: 'Giá nhập',
			},
			promotion_price: {
				type: 'number',
				name: 'Giá khuyến mãi'
			},
			specification: {
				type: 'text',
				name: 'Quy cách',
			},
			loai: {
				type: 'text',
				name: 'Loại Động cơ , bình điện',
			},
			weight: {
				type: 'number',
				name: 'Trọng lượng (kg)',
			},
			nang_cao: {
				type: 'number',
				name: 'Chiều cao khung nâng (m)',
			},
			khung_nang: {
				type: 'number',
				name: 'Tình trạng hàng hóa (%)',
			},
			mfg_year: {
				type: 'number',
				name: 'Năm sản xuất',
			},
			gio_su_dung: {
				type: 'number',
				name: 'Giờ sử dụng (h)'
			},
			xuat_xu: {
				type: 'text',
				name: 'Xuất xứ',
			},
			hien_thi: {
				type: 'select',
				name: 'Hiển thị',
				dataEnum: '1:Có;0:Không'
			},
			is_hot: {
				type: 'select',
				name: 'Tiêu biểu',
				dataEnum: '1:Có;0:Không'
			},
			sp_hot: {
				type: 'select',
				name: 'Home',
				dataEnum: '1:Có;0:Không'
			},
			is_completed: {
				type: 'select',
				name: 'Đã hoàn thành',
				dataEnum: '1:Có;0:Không'
			},
			is_new: {
				type: 'select',
				name: 'Mới',
				dataEnum: '1:Có;0:Không'
			},
			cong_suat: {
				type: 'text',
				name: 'Công suất'
			},
			ti_so_truyen: {
				type: 'text',
				name: 'Tỉ số truyền'
			},
			nguon_dien: {
				type: 'text',
				name: 'Nguồn điện'
			},
			kieu_dang: {
				type: 'text',
				name: 'Kiểu dáng/Chủng loại'
			},
			gear_type: {
				type: 'text',
				name: 'Kiểu gai'
			},
			updated_at: {
				type: 'date',
				name: 'Ngày cập nhật',
			},
			parent_number: {
				type: 'number',
				name: 'ID Nhóm',
			},
			group_pos: {
				type: 'number',
				name: 'Vị trí',
			},
			group_quantity: {
				type: 'number',
				name: 'Số lượng',
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
			<span class="btn-group">
				<span onclick="removeField(this)" class="btn btn-primary"><i class="glyphicon glyphicon-trash"></i></span>
			</span>
			<span class="btn-group">
				<select onchange="selectField(this)" data-index="${numberOfField}" class="form-control" name="fields[${numberOfField}][name]">
			`);
			options.push('<option value="">Chọn mục muốn tìm</option>');
			Object.keys(advancedSearchField).forEach(value => {
				const field = advancedSearchField[value];
				options.push(`<option value="${value}">${field.name}</option>`);
			});
			options.push(
				'</select></span><span class="conditions" style="margin-left: 3px;"></span><div class="clearfix"></div></div>'
			);

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
					<span class="btn-group">
					<select name="fields[${index}][compare]" class="compare form-control">
						<option value="=">Bằng</option>
						<option value=">">Lớn hơn</option>
						<option value="<">Bé hơn</option>
					</select>
					</span>
					<span class="btn-group">
						<input name="fields[${index}][value]" type="text" class="form-control value" placeholder="Có chứa từ..." />
					</span>
				`;

					break;

				case 'text':
					conditions += `
					<span class="btn-group">
						<select name="fields[${index}][compare]" class="compare form-control">
							<option value="start">Bắt đầu bằng</option>
							<option value="like">Có chứa</option>
						</select>
					</span>
					<span class="btn-group">
						<input name="fields[${index}][value]" type="text" class="form-control value" placeholder="Giá trị" />
					</span>
				`;

					break;

				case 'date':
					conditions += `
					<span class="btn-group">
						<select name="fields[${index}][compare]" class="compare form-control">
							<option value=">=">Từ ngày</option>
							<option value="<=">Đến ngày</option>
						</select>
					</span>
					<span class="btn-group">
						<input name="fields[${index}][value]" type="date" class="form-control value" style="width:200px" placeholder="Giá trị" />
					</span>
				`;

					break;

				case 'select':

					conditions += `
					<span class="btn-group">
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
					conditions += '</select></span>';

					break;

				default:
					// statements_def
					break;
			}

			$(e).parent().parent().find('>.conditions').html(conditions);
		}
	</script>

	<form id="form" method="post" action="index.php?p=san-pham-con&a=delete_all" role="form">

		<?php
		$itemFields = array(
			'title_vi' => 'Tiêu đề SEO',
			'code' => 'Mã sản phẩm',
			'code_2' => 'Mã sản phẩm 2',
			'model' => 'Model',
			'brand_name' => 'Hiệu',
			'part_number' => 'Part Number , S/N',
			'price' => 'Giá',
			'cost' => 'Giá nhập',
			'promotion_price' => 'Giá khuyến mãi',
			'specification' => 'Quy cách',
			'loai' => 'Loại Động cơ , bình điện',
			'weight' => 'Trọng lượng ( kg )',
			'bao_hanh' => 'Bảo hành',
			'tinh_trang_hang' => 'Tình trạng hàng hóa (%)',
			'mfg_year' => 'Năm sản xuất',
			'xuat_xu' => 'Xuất xứ',
			'unit'	=> 'Đơn vị',
		);
		?>

		<table class="table table-bordered table-hover table-striped table-responsive" style="width: 4500px; max-width: unset;">
			<thead>
				<tr>
					<th style="width:50px"><input type="checkbox" name="chk" value="0" class=" chk_box checkall" id="check_all"></th>
					<th style="width:50px">STT</th>
					<!-- <th style="width:8%">Mã SP</th> -->
					<th style="width:200px; text-align:left">Danh mục</th>
					<th style="width:200px">Tác vụ</th>
					<th style="width:80px">ID nhóm</th>
					<th style="width:80px">Vị trí</th>
					<th style="width:80px">Số lượng</th>
					<th style="width:300px; text-align:left">Tiêu đề</th>
					<th style="width:200px; text-align:left">Tiêu đề US</th>
					<th style="width:200px; text-align:left">Tiêu đề CH</th>

					<th style="width:80px">Ảnh</th>
					<th style="width:80px">Lượt xem</th>
					<th style="width:80px">Tiêu biểu</th>
					<th style="width:80px">Home</th>
					<th style="width:80px">Cảnh báo</th>
					<!-- <th style="width:6%">Bán chạy</th> -->
					<!-- <th style="width:6%">Còn hàng</th> -->
					<th style="width:80px">Hiển thị</th>
					<th style="width:80px">Hoàn thành</th>
					<th style="width:80px">Mới</th>
					<th style="width:200px">Tác vụ</th>
					<?php
					foreach ($itemFields as $key => $name) {
						echo '<th style="width:' . ($key === 'part_number' ? '300' : '130') . 'px">' . $name . '</th>';
						if ($key == 'loai') {
							echo '<th style="width:200px">Tác vụ</th>';
						}
					}
					?>
					<th style="width:200px">Tác vụ</th>
				</tr>
			</thead>
			<tbody>
				<?php $count = count($items);
				for ($i = 0; $i < $count; $i++) {
					$item = $items[$i];
					$title = '<div class="box">
				<h4 class="bd-info name">' . $item['name_' . $_SESSION['lang']] . '</h4>
				<div class="bd-info price-home">
					<div class="price ' . ($item['promotion_price'] > 0 ? 'old-price' : '') . '">' . _price . ': ' . ($item['price'] > 0 ? $d->vnd($item['price']) :  _lienhe) . '</div>
					' . ($item['promotion_price'] > 0 ?
						'<span class="price-km"> <span> Giá khuyến mãi : ' . $d->vnd($item['promotion_price']) . '</span></span>' : '') . '	
				</div>	
				<div class="list-option">
					' . (!empty($item['code']) ?
						'<div class="col-sm-12 plr5">
								<div class="bd-info">
									' . _masp . ': ' . $item['code'] . '
								</div>
							</div>' : '') .
						(!empty($item['part_number']) ?
							'<div class="col-sm-12 plr5">
							<div class="bd-info">
								' . _partnumber . ': ' . $item['part_number'] . '
							</div>
						</div>' : '') .
						(!empty($item['specification']) ?
							'<div class="col-sm-12 plr5">
							<div class="bd-info">
								' . _serial . ': ' . $item['specification'] . '
							</div>
						</div>' : '') .
						(!empty($item['model']) ?
							'<div class="col-sm-12 plr5">
							<div class="bd-info">
								' . _model . ': ' . $item['model'] . '
							</div>
						</div>' : '') .
						(!empty($item['brand_name']) ?
							'<div class="col-sm-12 plr5">
							<div class="bd-info">
								' . _brand . ': ' . $item['brand_name'] . '
							</div>
						</div>' : '') .
						(!empty($item['loai']) ?
							'<div class="col-sm-12 plr5">
							<div class="bd-info">
								' . _loai . ': ' . $item['loai'] . '
							</div>
						</div>' : '') .
						(!empty($item['weight']) ?
							'<div class="col-sm-12 plr5">
							<div class="bd-info">
								' . _taitrong . ': ' . $item['weight'] . '
							</div>
						</div>' : '') .
						(!empty($item['nang_cao']) ?
							'<div class="col-sm-12 plr5">
							<div class="bd-info">
								' . _nangcao . ': ' . $item['nang_cao'] . '
							</div>
						</div>' : '') .
						(!empty($item['khung_nang']) ?
							'<div class="col-sm-12 plr5">
							<div class="bd-info">
								' . _khungnang . ': ' . $item['khung_nang'] . '
							</div>
						</div>' : '') .
						(!empty($item['mfg_year']) ?
							'<div class="col-sm-12 plr5">
							<div class="bd-info">
								' . _nam . ': ' . $item['mfg_year'] . '
							</div>
						</div>' : '') .
						(!empty($item['gio_su_dung']) ?
							'<div class="col-sm-12 plr5">
							<div class="bd-info">
								' . _giosudung . ': ' . $item['gio_su_dung'] . '
							</div>
						</div>' : '') .
						(!empty($item['xuat_xu']) ?
							'<div class="col-sm-12 plr5">
							<div class="bd-info">
								' . _xuatxu . ': ' . $item['xuat_xu'] . '
							</div>
						</div>' : '') .
						(!empty($item['tinh_trang_hang']) ?
							'<div class="col-sm-12 plr5">
							<div class="bd-info">
								' . _tinh_trang_hang . ': ' . $item['tinh_trang_hang'] . '
							</div>
						</div>' : '') .
						(!empty($item['cong_suat']) ?
							'<div class="col-sm-12 plr5">
                            <div class="bd-info">
                                Công suất: ' . $item['cong_suat'] . '
                            </div>
                        </div>' : '') .
						(!empty($item['ti_so_truyen']) ?
							'<div class="col-sm-12 plr5">
                            <div class="bd-info">
                                Tỉ số truyền: ' . $item['ti_so_truyen'] . '
                            </div>
                        </div>' : '') .
						(!empty($item['nguon_dien']) ?
							'<div class="col-sm-12 plr5">
                            <div class="bd-info">
                                Nguồn điện: ' . $item['nguon_dien'] . '
                            </div>
                        </div>' : '') .
						(!empty($item['kieu_dang']) ?
							'<div class="col-sm-12 plr5">
                            <div class="bd-info">
                                Kiểu dáng: ' . $item['kieu_dang'] . '
                            </div>
                        </div>'
							: '') .
						(!empty($item['mat_ban']) ?
							'<div class="col-sm-12 plr5">
                            <div class="bd-info">
                                Kích thước (D x R x C) mm: ' . $item['mat_ban'] . '
                            </div>
                        </div>' : '') .
						'<div class="clearfix"></div>
				</div>
				<div class="clearfix mb10"></div>
			</div>';
				?>
					<tr>
						<td>
							<input class="chk_box" type="checkbox" name="chk_child[]" value="<?= $items[$i]['id'] ?>">
						</td>
						<td><input type="number" value="<?= $items[$i]['so_thu_tu'] ?>" class="a_stt" data-table="#_sanpham" data-col="so_thu_tu" data-id="<?= $items[$i]['id'] ?>" /></td>

						<!-- <td><?= $items[$i]['code'] ?></td> -->
						<td style="text-align:left">
							<?php
							$query = $d->simple_fetch("select * from #_category where id={$items[$i]['category_id']}");
							$str = "";
							for ($k = 0; $k < $query['level']; $k++) {
								$str .= "= ";
							}
							echo $str . $query['name_vi']

							?>
						</td>
						<td>
							<a href="/<?php echo $items[$i]['alias_vi']; ?>.html" class="text-success" target="_blank"><i class="glyphicon glyphicon-eye-open"></i></a>
							&nbsp;&nbsp;&nbsp;
							<a href="<?php echo $cloneBaseUrl . $items[$i]['id']; ?>"><i class="glyphicon glyphicon-flash text-warning"></i></a>&nbsp;&nbsp;&nbsp;
							<a href="index.php?p=san-pham-con&a=edit&id=<?= $items[$i]['id'] ?>&page=<?= @$_GET['page'] ?>" class="text-danger" title="Sửa"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;
							<a href="index.php?p=san-pham-con&a=delete&id=<?= $items[$i]['id'] ?>&page=<?= @$_GET['page'] ?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
						</td>
						<td><?php echo $items[$i]['parent_number']; ?></td>
						<td><?php echo $items[$i]['group_pos']; ?></td>
						<td><?php echo $items[$i]['group_quantity']; ?></td>
						<td style="text-align:left" class="break-word">
							<a href="index.php?p=san-pham-con&a=edit&id=<?= $items[$i]['id'] ?>&page=<?= @$_GET['page'] ?>"><?= $items[$i]['name_vi'] ?></a>

							<i class="glyphicon glyphicon-info-sign" style="font-size: 20px;vertical-align: bottom;" data-toggle="tooltip" data-html="true" data-placement="right" title="<?php echo htmlspecialchars($title) ?>"></i>
						</td>
						<td class="break-word">
							<a href="index.php?p=san-pham-con&a=edit&id=<?= $items[$i]['id'] ?>&page=<?= @$_GET['page'] ?>"><?= $items[$i]['name_en'] ?></a>
						</td>
						<td class="break-word">
							<a href="index.php?p=san-pham-con&a=edit&id=<?= $items[$i]['id'] ?>&page=<?= @$_GET['page'] ?>"><?= $items[$i]['name_ch'] ?></a>
						</td>
						<td>
							<?php if (ADMIN_IMAGE): ?>
								<a class="thumb" href="#" title="<?= $items[$i]['name_vi'] ?>" data-src="<?php echo FILEURL . "img_data/images/" . $items[$i]['image_path']; ?>">
									<?php
									echo ($items[$i]['image_path'] <> '') ? "<img width=\"200\" src='" . FILEURL . "images/200/140/" . $items[$i]['image_path'] . "?zc=2'>" : "";
									?>
								</a>
							<?php else: ?>
								<?php if (!empty($items[$i]['image_path'])) : ?>
									<span class="btn btn-sm btn-info image-placeholder image-placeholder-<?php echo $items[$i]['id']; ?>" data-path="<?php echo $items[$i]['image_path']; ?>">Xem hình</span>
								<?php endif; ?>
							<?php endif;?>
							<a class="view-slide mt-10" href="api.php?func=getProductSlideImage&productId=<?php echo $items[$i]['id']; ?>">Hình
									slide</a>
						</td>
						<td><?php echo $items[$i]['view']; ?></td>
						<td>
							<input class="chk_box" type="checkbox" onclick="on_check(this,'#_sanpham','is_hot','<?= $items[$i]['id'] ?>')" <?php if ($items[$i]['is_hot'] == 1) echo 'checked="checked"'; ?>>
						</td>

						<!-- <td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_sanpham','sp_moi','<?= $items[$i]['id'] ?>')" <?php if ($items[$i]['sp_moi'] == 1) echo 'checked="checked"'; ?>>
			</td> -->
						<td>
							<input class="chk_box" type="checkbox" onclick="on_check(this,'#_sanpham','sp_hot','<?= $items[$i]['id'] ?>')" <?php if ($items[$i]['sp_hot'] == 1) echo 'checked="checked"'; ?>>
						</td>
						<td>
							<input type="checkbox" onclick="on_check(this,'#_sanpham','is_warning','<?= $items[$i]['id'] ?>')" <?php if ($items[$i]['is_warning'] == 1) echo 'checked="checked"'; ?>>
						</td>
						<!-- <td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_sanpham','con_hang','<?= $items[$i]['id'] ?>')" <?php if ($items[$i]['con_hang'] == 1) echo 'checked="checked"'; ?>>
			</td> -->
						<td>
							<input class="chk_box" type="checkbox" onclick="on_check(this,'#_sanpham','hien_thi','<?= $items[$i]['id'] ?>')" <?php if ($items[$i]['hien_thi'] == 1) echo 'checked="checked"'; ?>>
						</td>
						<td>
							<input class="chk_box" type="checkbox" onclick="on_check(this,'#_sanpham','is_completed','<?= $items[$i]['id'] ?>')" <?php if ($items[$i]['is_completed'] == 1) echo 'checked="checked"'; ?>>
						</td>
						<td>
							<input class="chk_box" type="checkbox" onclick="on_check(this,'#_sanpham','is_new','<?= $items[$i]['id'] ?>')" <?php if ($items[$i]['is_new'] == 1) echo 'checked="checked"'; ?>>
						</td>
						<td>
							<a href="/<?php echo $items[$i]['alias_vi']; ?>.html" class="text-success" target="_blank"><i class="glyphicon glyphicon-eye-open"></i></a>
							&nbsp;&nbsp;&nbsp;
							<a href="<?php echo $cloneBaseUrl . $items[$i]['id']; ?>"><i class="glyphicon glyphicon-flash text-warning"></i></a>&nbsp;&nbsp;&nbsp;
							<a href="index.php?p=san-pham-con&a=edit&id=<?= $items[$i]['id'] ?>&page=<?= @$_GET['page'] ?>" class="text-danger" title="Sửa"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;
							<a href="index.php?p=san-pham-con&a=delete&id=<?= $items[$i]['id'] ?>&page=<?= @$_GET['page'] ?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
						</td>
						<?php
						foreach ($itemFields as $key => $name) {
							echo '<td class="break-word">' . @$items[$i][$key] . '</td>';

							if ($key == 'loai') {
						?>

								<td>
									<a href="/<?php echo $items[$i]['alias_vi']; ?>.html" title="Xem sản phẩm" class="text-success" target="_blank"><i class="glyphicon glyphicon-eye-open"></i></a>
									&nbsp;&nbsp;&nbsp;
									<a href="<?php echo $cloneBaseUrl . $items[$i]['id']; ?>"><i class="glyphicon glyphicon-flash text-warning"></i></a>&nbsp;&nbsp;&nbsp;
									<a href="index.php?p=san-pham-con&a=edit&id=<?= $items[$i]['id'] ?>&page=<?= @$_GET['page'] ?>" class="text-danger" title="Sửa"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;
									<a href="index.php?p=san-pham-con&a=delete&id=<?= $items[$i]['id'] ?>&page=<?= @$_GET['page'] ?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
								</td>
						<?php
							}
						}
						?>

						<td>
							<a href="/<?php echo $items[$i]['alias_vi']; ?>.html" class="text-success" target="_blank"><i class="glyphicon glyphicon-eye-open"></i></a>
							&nbsp;&nbsp;&nbsp;
							<a href="<?php echo $cloneBaseUrl . $items[$i]['id']; ?>"><i class="glyphicon glyphicon-flash text-warning"></i></a>&nbsp;&nbsp;&nbsp;
							<a href="index.php?p=san-pham-con&a=edit&id=<?= $items[$i]['id'] ?>&page=<?= @$_GET['page'] ?>" class="text-danger" title="Sửa"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;
							<a href="index.php?p=san-pham-con&a=delete&id=<?= $items[$i]['id'] ?>&page=<?= @$_GET['page'] ?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</form>
</div>
<div class="pagination">
	<?php echo @$paging['paging'] ?>
</div>
<script>
	$(document).ready(function() {
		$('[data-toggle="tooltip"]').tooltip();
	});
</script>
<script type="text/javascript">
	function loc_tin(obj, tenp) {
		var show = $(obj).val();
		window.location.href = "index.php?p=" + tenp + "&a=man&category_id=" + show;
	}
</script>

<!-- .modal-img-preview -->
<div class="modal fade modal-img-preview" tabindex="-1" role="dialog" aria-labelledby="modalProfile" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" data-dismiss="modal">×</button>
				<h3 class="modal-title"></h3>
			</div>
			<div class="modal-body text-center">
			</div>
			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>

	</div>
</div>
<!-- //.modal-img-preview -->
<div id="preview-image" style="display: none;">
</div>


<script type="text/javascript">
	$(document).ready(function() {
		/* show lightbox when clicking a thumbnail */
		$('a.thumb').click(function(event) {
			event.preventDefault();
			var content = $('.modal-body');
			content.empty();
			var title = $(this).attr("title");
			$('.modal-title').html(title);
			content.html('<img src="' + $(this).attr("data-src") + '"/>');
			$(".modal-img-preview").modal({
				show: true
			});
		});

	});
</script>

<script src="/admin/assets/lightbox2/js/lightbox.min.js"></script>
<script type="text/javascript">
	const seft = this;
	$(document).on('click', '.view-slide', function(event) {
		event.preventDefault();
		const url = event.target.href;

		$.ajax({
			url: url,
			type: 'GET',
			success: function(data) {
				$('#preview-image').html(data);
				lightbox.init();
				lightbox.option({
					alwaysShowNavOnTouchDevices: true,
					disableScrolling: true,
					positionFromTop: 80
				});
				lightbox.start($('#slide_0'));
			}
		});
		return false;
	});
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.5/dist/sweetalert2.all.min.js"></script>

<?php
if (!empty($_GET['clone_id'])) {
?>

	<script type="text/javascript">
		$(document).ready(function() {
			cloneProduct(<?php echo $_GET['clone_id']; ?>, 'san-pham-con');
		});
	</script>

<?php
}
?>