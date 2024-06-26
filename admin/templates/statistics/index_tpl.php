<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<style type="text/css">
	td.details-control {
	    background: url('/admin/img/details_open.png') no-repeat center center;
	    cursor: pointer;
	}
	tr.shown td.details-control {
	    background: url('/admin/img/details_close.png') no-repeat center center;
	}
	tbody>tr:not([role='row']) {
	    background: #f4fdff !important;
	}
	.d-none {
		display: none;
	}
</style>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="/admin/public/extra/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="/admin/public/extra/bootstrap-datepicker/locales/bootstrap-datepicker.vi.min.js"></script>
<link rel="stylesheet" type="text/css" href="/admin/public/extra/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
<div class="col-md-12">
	<h2>Lượt xem sản phẩm trong 30 ngày gần nhất</h2>
	<div>
		<canvas id="inMonthDateViews" width="1000" height="385"></canvas>
	</div>
	<?php

	$currentYear = date('Y');
	$currentMonth = date('m');
	$currentDay = date('d');
	$currentDate = date('Y-m-d');

	// Prepare data for views graph
	$dataSetViews = array();
	for ($i=0; $i < 30; $i++) {
		$key = date('Y-m-d', strtotime("-$i days", strtotime($currentDate)));
		$dataSetViews[$key] = 0;
	}

	$dataSetViews = array_reverse($dataSetViews);

	foreach ($inMonthDateViews as $dateView) {
		$dataSetViews[$dateView['date']] = (int)$dateView['views'];
	}

	$dataViews = array_values($dataSetViews);
	$labels = array_keys($dataSetViews);

	// Prepare data for IPs graph
	$dataSetIps = array();
	for ($i=0; $i < 30; $i++) {
		$key = date('Y-m-d', strtotime("-$i days", strtotime($currentDate)));
		$dataSetIps[$key] = 0;
	}

	$dataSetIps = array_reverse($dataSetIps);

	foreach ($inMonthDateIps as $dateIp) {
		$dataSetIps[$dateIp['date']] = (int)$dateIp['ips'];
	}

	$dataIps = array_values($dataSetIps);

	?>
	<script type="text/javascript">
	var ctx = document.getElementById("inMonthDateViews").getContext('2d');
	var inMonthDateViews = new Chart(ctx, {
	    type: 'line',
	    data: {
	        labels: <?php echo json_encode($labels) ?>,
	        datasets: [{
	            label: 'Lượt xem',
	            data: <?php echo json_encode($dataViews) ?>,
	            backgroundColor: [
	                'rgba(255, 99, 132, 0.2)',
	                'rgba(54, 162, 235, 0.2)',
	                'rgba(255, 206, 86, 0.2)',
	                'rgba(75, 192, 192, 0.2)',
	                'rgba(153, 102, 255, 0.2)',
	                'rgba(255, 159, 64, 0.2)'
	            ],
	            borderColor: [
	                'rgba(255,99,132,1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(255, 206, 86, 1)',
	                'rgba(75, 192, 192, 1)',
	                'rgba(153, 102, 255, 1)',
	                'rgba(255, 159, 64, 1)'
	            ],
	            borderWidth: 1
	        },{
	            label: 'IP',
	            data: <?php echo json_encode($dataIps) ?>,
	            backgroundColor: [
	                'rgba(46, 177, 0, .2)'
	            ],
	            borderColor: [
	                'rgba(46, 177, 0, 1)'
	            ],
	            borderWidth: 1
	        }]
	    },
	    options: {
	        scales: {
	            yAxes: [{
	                ticks: {
	                    beginAtZero:true
	                }
	            }]
	        },
	        
	    }
	});
	</script>
</div>

<div class="col-md-12">
	<div class="row">
		<h2 class="col-md-8">Danh sách sản phẩm trong ngày <span class="badge" style="background: red;vertical-align: middle;"><?php echo $countInDateProducts; ?> sản phẩm</span></h2>
		<span class="col-md-4" style="margin-top:18px">
			<form>
                <div style="display: flex; justify-content: space-between">
                    <div class="input-group">
                        <label for="emptyImage">
                            <input type="checkbox" value="1" name="emptyImage" id="emptyImage"> Lọc SP không hình ảnh
                        </label>
                    </div>
                    <div class="input-group">
                        <input name="date" type="text" class="form-control" id="viewDate" value="<?php echo $_GET['date'] ? $_GET['date'] : date('Y-m-d'); ?>">
                        <input type="hidden" name="p" value="statistics">
                        <input type="hidden" name="a" value="perDay">
                        <span class="input-group-btn">
                            <button class="btn btn-primary">Xem</button>
                        </span>
                    </div>
                </div>
			</form>
		</span>
	</div>
	<script type="text/javascript">
		$('#viewDate').datepicker({
		    format: "yyyy-mm-dd",
		    startDate: '<?php echo date('Y-m-d', strtotime('-29 days', strtotime(date('Y-m-d')))); ?>',
		    endDate: '<?php echo date('Y-m-d'); ?>',
		    clearBtn: true,
		    autoclose: true,
		    language: "vi",
		    todayHighlight: true,
		    toggleActive: true
		});
	</script>


	<table id="inDateProducts">
		<thead>
			<tr>
				<th>STT</th>
				<th>Mã sản phẩm</th>
				<th class="no-sort">Hình ảnh</th>
				<th>Tên sản phẩm</th>
				<th>Hoàn thành</th>
				<th>Giá</th>
				<th>Khuyến mãi</th>
				<th>Lượt xem</th>
                <th>Thời gian</th>
                <th>IP</th>
                <th>Khu vực</th>
				<th class="no-sort">Hành động</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($inDateProducts as $i => $product) {
				?>
				<tr>
					<td><?php echo ++$i; ?></td>
					<td><?php echo $product['code']; ?></td>
					<td>
                        <div id="product_image_<?php echo $product['id_sanpham']; ?>">
						<?php
                            echo ($product['image_path'] <> '') ? "<img width=\"70\" src='" . THUMB_BASE . "images/70/50/" . $product['id'] . "/" . $product['image_path']."'>" : "";
						?>
                        </div>
					</td>
					<td>
                        <div id="product_title_<?php echo $product['id_sanpham']; ?>"><?php echo $product['name_vi']; ?></div>
                    </td>
					<td>
						<input class="chk_box" type="checkbox" onclick="on_check(this,'#_sanpham','is_completed','<?=$product['id']?>')" <?php if($product['is_completed'] == 1) echo 'checked="checked"'; ?>/>
						<span class="d-none"><?php echo $product['is_completed'] == 1 ? 'is-completed' : 'not-completed'; ?></span>
					</td>
					<td><?php echo $d->vnd($product['price']); ?></td>
					<td><?php echo $d->vnd($product['promotion_price']); ?></td>
					<td><?php echo $product['views']; ?></td>
                    <td><?php echo $product['time']; ?></td>
                    <td><?php echo $product['ip']; ?></td>
                    <td><?php echo $product['region']; ?></td>
					<td>
						<a href="index.php?p=san-pham&a=edit&id=<?php echo $product['id_sanpham']; ?>" target="_blank" class="text-success" title="Sửa sản phẩm"><i class="glyphicon glyphicon-pencil"></i></a>
						&nbsp;
						<a href="/<?php echo $product['alias_vi']; ?>.html" target="_blank" title="Xem sản phẩm"><i class="glyphicon glyphicon-eye-open"></i></a>
                        &nbsp;
                        <a data-id="<?php echo $product['id_sanpham']; ?>" href="javascript:void(0)" title="Đổi ảnh" onclick="changeImage(this)" data-title="<?php echo $product['name_vi']; ?>">
                            <i class="glyphicon glyphicon-picture"></i>
                        </a>
					</td>
				</tr>
				<?php
			}
			?>
		</tbody>
	</table>

	<script type="text/javascript">
		$('#inDateProducts').DataTable({
			columnDefs: [
				{
					targets: 2,
					orderable: false
				},
				{
					targets: 4,
					orderable: false
				},
				{
					targets: -1,
					orderable: false
				}
			],
			lengthMenu: [ 10, 25, 50, 75, 100, 150, 200, 250, 300, 500, 800, 1000, 1300, 1500, 2500, 5000 ],
			language: {
	            lengthMenu: "Hiển thị _MENU_ dòng mỗi trang",
	            zeroRecords: "Không có kết quả nào!",
	            info: "Đang hiển thị trang _PAGE_ của _PAGES_",
	            infoEmpty: "Không có dữ liệu",
	            infoFiltered: "(được lọc từ tổng _MAX_ dòng)"
	        },
            pageLength: 25,
	        scrollY: 800,
        	scrollCollapse: true,
        	initComplete: function () {
	            this.api().columns().every(function(columnIndex) {

	            	if (columnIndex !== 4) {
	            		return;
	            	}

	                var column = this;
	                $('<br/>').appendTo($(column.header()));
	                var select = $('\
	                	<select>\
		                	<option value="">Tất cả</option>\
		                	<option value="is-completed">Hoàn thành</option>\
		                	<option value="not-completed">Chưa hoàn thành</option>\
	                	</select>')
	                    .appendTo($(column.header()))
	                    .on('change', function () {
	                        var val = $(this).val();
	 
	                        column
	                            .search( val ? val : '', true, false )
	                            .draw();
	                    } );
	 
	                // column.data().unique().sort().each( function ( d, j ) {
	                //     select.append( '<option value="'+d+'">'+d+'</option>' )
	                // } );
	            } );
	        },
		});
		$('#inDateProducts')
		.removeClass( 'display' )
		.addClass('table table-striped table-bordered');
	</script>
</div>


<div class="col-md-12">
	<div class="row">
		<h2 class="col-md-9">Danh sác các IP trong ngày <span class="badge" style="background: red;vertical-align: middle;"><?php echo $countInDateIps; ?> IP</span></h2>
		<span class="col-md-3" style="margin-top:18px">
			<form>
				<div class="input-group">
					<input name="ipDate" type="text" class="form-control" id="ipDate" value="<?php echo $_GET['ipDate'] ? $_GET['ipDate'] : date('Y-m-d'); ?>">
					<input type="hidden" name="p" value="statistics">
					<span class="input-group-btn">
						<button class="btn btn-primary">Xem</button>
					</span>
				</div>
			</form>
		</span>
	</div>
	<script type="text/javascript">
		$('#ipDate').datepicker({
		    format: "yyyy-mm-dd",
		    startDate: '<?php echo date('Y-m-d', strtotime('-29 days', strtotime(date('Y-m-d')))); ?>',
		    endDate: '<?php echo date('Y-m-d'); ?>',
		    clearBtn: true,
		    autoclose: true,
		    language: "vi",
		    todayHighlight: true,
		    toggleActive: true
		});
	</script>


	<table id="inDateIps">
		<thead>
			<tr>
				<th>Mở rộng</th>
				<th>STT</th>
				<th>IP</th>
                <th>Khu vực</th>
                <th>Thời gian</th>
				<th>Số sản phẩm</th>
				<th>Lượt xem</th>
				<th class="no-sort">Hành động</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($inDateIps as $i => $ip) {
				?>
				<tr>
					<td class="details-control"></td>
					<td><?php echo ++$i; ?></td>
					<td><?php echo $ip['ip']; ?></td>
                    <td>
                        <?php
                        echo $ip['region'];
                        ?>
                    </td>
                    <td><?php echo $ip['time']; ?></td>
					<td><?php echo $ip['totalProduct']; ?></td>
					<td><?php echo $ip['totalView']; ?></td>
					<td>
						<span style="cursor: pointer;" onclick="<?php echo $ip['is_banned'] ? 'unbanIp' : 'banIp'; ?>('<?php echo $ip['ip']; ?>', this)" class="<?php echo $ip['is_banned'] ? 'text-success' : 'text-danger'; ?>" title="Khóa IP này"><i class="glyphicon <?php echo $ip['is_banned'] ? 'glyphicon-ok-circle' : 'glyphicon-ban-circle'; ?>"></i></span>
					</td>
				</tr>
				<?php
			}
			?>
		</tbody>
	</table>

	<!-- CHANGE IMAGE -->
	<script>
		function changeImageSuccessCB(id, data) {
			if (data.success === true) {
					if ($('#changeImageForm #thumb .img-result img').length) {
						const imgResult = $('#changeImageForm #thumb .img-result img').attr('src');
						$('#product_image_' + id).html('<img src="' + imgResult + '" alt="" width="70">');
					}
					$('#product_title_' + id).html($('#changeImageModal #product_title').val());
					$('#changeImageModal').modal('hide');
			} else {
				swal({
						title: "Vui lòng thử lại!",
						type: "warning",
				});
			}
		}
	</script>
	<?php include __ROOT_PATH . '/admin/templates/_parts/change-image.php'; ?>

	<script type="text/javascript">
		function banIp(ip, button) {
			swal({
			  title: `Khóa IP: ${ip}`,
			  type: "warning",
			  showCancelButton: true,
			  closeOnConfirm: false,
			  confirmButtonText: "Khóa",
			  cancelButtonText: "Hủy",
			  showLoaderOnConfirm: true
			}, function () {
			  $.ajax({
			  	url: '/admin/api.php',
			  	data: {
			  		func: 'banIp',
			  		ip,
			  	},
			  	success: () => {
			  		swal(`Đã khóa IP: ${ip}`, '', 'success');
			  		$(button).removeClass('text-danger').addClass('text-success').attr('onclick', `unbanIp('${ip}', this)`).attr('title', 'Mở khóa');
			  		$(button).find('i').removeClass('glyphicon-ban-circle').addClass('glyphicon-ok-circle');
			  	},
			  	fail: () => {
			  		swal("Có lỗi xảy ra, vui lòng thử lại!")
			  	}
			  });
			});
		}

		function unbanIp(ip, button) {
			swal({
			  title: `Mở khóa IP: ${ip}`,
			  type: "warning",
			  showCancelButton: true,
			  closeOnConfirm: false,
			  confirmButtonText: "Mở khóa",
			  cancelButtonText: "Hủy",
			  showLoaderOnConfirm: true
			}, function () {
			  $.ajax({
			  	url: '/admin/api.php',
			  	data: {
			  		func: 'unbanIp',
			  		ip,
			  	},
			  	success: () => {
			  		swal(`Đã mở khóa IP: ${ip}`, '', 'success');
			  		$(button).removeClass('text-danger').addClass('text-success').attr('onclick', `banIp('${ip}', this)`).attr('title', 'Khóa');
			  		$(button).find('i').removeClass('glyphicon-ban-circle').addClass('glyphicon-ok-circle');
			  	},
			  	fail: () => {
			  		swal("Có lỗi xảy ra, vui lòng thử lại!")
			  	}
			  });
			});
		}

		/* Formatting function for row details */
		function format( d ) {
			// get ip form third columns
			const ip = d.ip;
			const divId = ip.replace(/\./g, '_');
			const date = $('#ipDate').val();

			$.ajax({
		    	url: '/admin/api.php',
		    	type: 'GET',
		    	data: {
		    		func: 'getIpInfoOfDate',
		    		ip,
		    		date,
		    	},
		    	success: (data) => {
		    		const infoTable = makeIpInfoTable(data);
		    		$('#' + divId).html(infoTable);
		    	},
		    	fail: (error) => {
		    		console.log(error);

		    		$('#' + divId).html(`
	    				<p class="alert alert-danger">
	    					Có lỗi xảy ra, vui lòng thử lại!
	    				</p>
		    			`);
		    	}
		    });

		    return `
			    <div id="${divId}">
					<img src="/admin/img/loading.gif" style="width:50px;margin: 20px 0;" alt="Loading" />
					<p>Đang tải...</p>
			    </div>`;
		}

		function makeIpInfoTable(data) {
			const result = [];
			result.push(`
				<h4>Thông tin lượt xem của IP trong ngày</h4>
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>STT</th>
							<th>Sản phẩm</th>
							<th>Thời gian</th>
							<th>Tác vụ</th>
						</tr>
					</thead>
					<tbody>

				`);

			data.forEach( function(item, index) {
				result.push(`
					<tr role="row">
						<td>${index+1}</td>
						<td>${item.name_vi}</td>
						<td>${item.time}</td>
						<td>
							<a href="index.php?p=san-pham&amp;a=edit&amp;id=${item.id_sanpham}" target="_blank" class="text-success" title="Sửa sản phẩm"><i class="glyphicon glyphicon-pencil"></i></a>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="/${item.alias_vi}.html" target="_blank" title="Xem sản phẩm"><i class="glyphicon glyphicon-eye-open"></i></a>

                            <a href="/${item.alias_vi}.html" target="_blank" title="Xem sản phẩm"><i class="glyphicon glyphicon-eye-open"></i></a>

                            <a data-id="${item.id_sanpham}" href="javascript:void(0)" title="Đổi ảnh" onclick="changeImage(this)" data-title="${item.name_vi}">
                                <i class="glyphicon glyphicon-picture"></i>
                            </a>
						</td>
					</tr>
					`);
			});

			result.push(`
					</tbody>
				</table>
				`);

			return result.join("\n");
		}

		var table = $('#inDateIps').DataTable({
			lengthMenu: [ 10, 25, 50, 75, 100, 150, 200, 250, 300, 500, 800, 1000, 1300, 1500, 2500, 5000 ],
			columns: [
	            { orderable: false },
	            { data: "stt" },
	            { data: "ip" },
                { data: "region" },
                { data: "time" },
	            { data: "products" },
	            { data: "views" },
	            { orderable: false }
            ],
            order: [[1, 'asc']],
			language: {
	            lengthMenu: "Hiển thị _MENU_ dòng mỗi trang",
	            zeroRecords: "Không có kết quả nào!",
	            info: "Đang hiển thị trang _PAGE_ của _PAGES_",
	            infoEmpty: "Không có dữ liệu",
	            infoFiltered: "(được lọc từ tổng _MAX_ dòng)"
	        },
            pageLength: 25,
	        scrollY: 800,
        	scrollCollapse: true,
		});
		$('#inDateIps')
		.removeClass( 'display' )
		.addClass('table table-striped table-bordered');

		// Add event listener for opening and closing details
	    $('#inDateIps tbody').on('click', 'td.details-control', function () {
	        var tr = $(this).closest('tr');
	        var row = table.row( tr );
	 
	        if ( row.child.isShown() ) {
	            // This row is already open - close it
	            row.child.hide();
	            tr.removeClass('shown');
	        }
	        else {
	            // Open this row
	            row.child( format(row.data()) ).show();
	            tr.addClass('shown');
	        }
	    });
	</script>
</div>