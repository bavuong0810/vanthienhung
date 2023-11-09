function ResizeModule() {
	
}

function updateCartNum(quantity, type = 'replace') {
	let finalQuantity = quantity;
	$cart = $('#productInCart');
	if (type === 'replace') {
		$cat.html(finalQuantity);
		return;
	}
	
	let currentInCart = $cart.html();
	currentInCart = isNaN(currentInCart) ? 0 : +currentInCart;
	if (type === 'plus') {
		finalQuantity = currentInCart + finalQuantity;
	}
	if (type === 'minus') {
		finalQuantity = currentInCart - finalQuantity;
	}
	if (finalQuantity < 0) {
		finalQuantity = 0;
	}
	$cart.html(finalQuantity);
}

function updateProductInCart() {

	const data = {
		func: 'getCart',
	};

	const success = (res) => {
		const cart = res;
		num = 0;
		Object.keys(cart).forEach( function(productId) {
			const product = cart[productId];
			num += +product.so_luong;
		});

		$('#productInCart').html(num);
	};

	const error = (err) => {
		console.log(err);
		alert('Cập nhật giỏ hàng thất bại, vui lòng tải lại trang để thử lại!');
	};

	$.ajax({
		url: '/api.php',
		dataType: 'json',
		method: 'POST',
		data,
		success,
		error,
	});
}

$(document).ready(function() {

	updateProductInCart();

	$(window).on('resize load',function() {
		ResizeModule();
	});

	$('.modal').on('show.bs.modal', function (e) {
	  $('#modalBackdrop').removeClass('hidden').addClass('in');
	});
	$('.modal').on('hide.bs.modal', function (e) {
	  $('#modalBackdrop').removeClass('in').addClass('hidden');
	})

	$(window).scroll(function () {
		if ($(this).scrollTop() > 300) {
			$('.fback-top').fadeIn();
		} else {
			$('.fback-top').fadeOut();
		}
	});

	$('.fback-top').click(function () {
		$('body,html').animate({
			scrollTop: 0
		}, 500);
		return false;
	});
	
	$('.fancybox').fancybox();


	if($(".form-shopping").length) {
		var error1=$('.form-shopping input[name="ten"]').attr('data-error');
		var error2=$('.form-shopping input[name="email"]').attr('data-error');
		var error3=$('.form-shopping input[name="diachi"]').attr('data-error');
		var error4=$('.form-shopping input[name="dienthoai"]').attr('data-error');
		
		$(".form-shopping").validate({
			rules: {
				ten: "required",				
				email: {
					required: true,
					email: true
				},
				diachi: "required",
				dienthoai: "required",
			},
			messages: {
				ten: error1,
				email: error2,
				diachi: error3,
				dienthoai: error4,
			}
		});	
	}

	if($(".form-order").length) {
		var error1=$('.form-order input[name="ten"]').attr('data-error');
		var error2=$('.form-order input[name="email"]').attr('data-error');
		var error3=$('.form-order input[name="diachi"]').attr('data-error');
		var error4=$('.form-order input[name="dienthoai"]').attr('data-error');

		$(".form-order").validate({
			rules: {
				ten: "required",
				email: {
					required: true,
					email: true
				},
				diachi: "required",
				dienthoai: "required",
			},
			messages: {
				ten: error1,
				email: error2,
				diachi: error3,
				dienthoai: error4,
			}
		});
	}
	if($("#form-contact").length) {
		var error1=$('#form-contact #ho_ten').attr('data-error');
		var error2=$('#form-contact #so_dien_thoai').attr('data-error');
		
		var error4=$('#form-contact #email').attr('data-error');
		var error5=$('#form-contact #noi_dung').attr('data-error');
		var error6=$('#form-contact #captcha').attr('data-error');
		
		$("#form-contact").validate({
			rules: {
				ho_ten: "required",
				so_dien_thoai: "required",
				
				email: {
					required: true,
					email: true
				},
				noi_dung: "required",
				captcha: "required",

			},
			messages: {
				ho_ten: '',
				so_dien_thoai: '',
				
				email: '',
				noi_dung: '',
				captcha: '',
			},
			highlight : function (element) {
				$(element).closest('.form-group').addClass('has-error');
			},
			unhighlight : function (element) {
				$(element).closest('.form-group').removeClass('has-error');
			}
			
		});	
		
	}

	if($('.owl-detail-content').length) {
		$('.owl-detail-content').owlCarousel({
			loop:true,
			responsive : {
			    0 : { items : 2, nav: false, },
			    991 : { items : 4 }
			}
		});	
	}	

	/* thanh vien */	
	if($(".form-register").length) {
		var error1=$('.form-register #tai_khoan').attr('data-error');
		var error_username=$('.form-register #tai_khoan').attr('data-error-1');
		var error2=$('.form-register #pass').attr('data-error');
		var error3=$('.form-register #re_pass').attr('data-error');
		var error4=$('.form-register #ho_ten').attr('data-error');
		var error5=$('.form-register #email').attr('data-error');
		var error_email=$('.form-register #email').attr('data-error-1');
		var error6=$('.form-register #dien_thoai').attr('data-error');
		var error7=$('.form-register #dia_chi').attr('data-error');
		
		$(".form-register").validate({
			rules: {
				tai_khoan: {
					required: true,
					remote: {
						url: './sources/ajax.php',
						type: "post",
						data: {
							tai_khoan: function() {
								return $('.form-register #tai_khoan').val();
							},
							'do' : 'check_tai_khoan'
						}					
					}
				},
				pass: "required",
				re_pass: {
					required: true,
					equalTo: ".form-register #pass",
				},				
				ho_ten: "required",
				email: {
					required: true,
					email: true,
					remote: {
						url: './sources/ajax.php',
						type: "post",
						data: {
							email: function() {
								return $('.form-register #email').val();
							},
							'do' : 'check_email'
						}
					}
				},
				dien_thoai: "required",
				dia_chi: "required",
				ngay: "required",	
				thang: "required",	
				mfg_year: "required",	
				gioi_tinh: "required",	
			},
			messages: {
				tai_khoan: {
					required: error1,
					remote: error_username
				},
				pass: error2,
				re_pass: {
					required: error2,
					equalTo: error3,
				},
				ho_ten: error4,
				email: {
					required: error5,
					email: error5,
					remote: error_email,
				},
				dien_thoai: error6,
				dia_chi: error7,
				ngay: '',
				thang: '',
				mfg_year: '',
				gioi_tinh: '',	
			},
			highlight : function (element) {
				$(element).closest('.form-group').addClass('has-error');
			},
			unhighlight : function (element) {
				$(element).closest('.form-group').removeClass('has-error');
			},
			submitHandler : function(form) {				
				$.ajax({
					url: './sources/ajax.php',
					type: 'post',
					data: $(form).serialize() + '&do=dang_ky',
					//dataType: "json",
					beforeSend: function() {
						$('.custom-tab2 .mask').fadeIn();
					},
					success: function(data) {
						if(data=='ok') {
							$(form).get(0).reset();
							$(".form-register .alert").removeClass('hide');
							setTimeout(function() {
								$(".form-register .alert").addClass('hide');
								$('#model_user').modal('hide');
							},1000);
						}
						else {
							alert('error');
						}
					},
					complete: function() {
						$('.custom-tab2 .mask').hide();
					},					
				});				
			}
		});	
	}	
	
	
	if($(".form-login").length) {

		var error1=$('.form-login #username').attr('data-error');
		var error2=$('.form-login #pass').attr('data-error');
		
		$(".form-login").validate({
			rules: {
				username: "required",
				pass: "required",					
			},
			messages: {
				username: error1,
				pass: error2,
			},
			highlight : function (element) {
				$(element).closest('.form-group').addClass('has-error');
			},
			unhighlight : function (element) {
				$(element).closest('.form-group').removeClass('has-error');
			},
			submitHandler : function(form) {				
				$.ajax({
					url: './sources/ajax.php',
					type: 'post',
					data: $(form).serialize() + '&do=dang_nhap',
					//dataType: "json",
					beforeSend: function() {
						$('.custom-tab2 .mask').fadeIn();
					},
					success: function(data) {
						if(data=='ok') {
							$(form).get(0).reset();
							$(".form-login .alert.alert-success").removeClass('hide');
							setTimeout(function() {
								$(".form-login .alert").addClass('hide');
								$('#model_user').modal('hide');
								parent.window.location.reload(true);
							},1000);
						}
						else {
							$(".form-login .alert.alert-danger").removeClass('hide');
							setTimeout(function() {
								$(".form-login .alert.alert-danger").addClass('hide');
							},1000);
						}
						$('.custom-tab2 .mask').hide();
					}  				
				});				
			}
		});	
	}		
	
	$('.link_logout').on('click',function() {
		var token = $(this).attr('data-token');
		$.ajax({
			url: './sources/ajax.php',
			type: 'post',
			data: {'do':'dang_xuat'},
			success: function(data) {
				if(data=='ok') {
					parent.window.location.reload(true);
				}
			}  				
		});				
	});

	initAddToCartAction();

	$('body').on('click', '#modalAddToCart .xoa_sp_gh_dh', function (e) {
		e.preventDefault();
		var id = $(this).attr('data-product');
		var iddh = $(this).attr('data-cart-item');
		var al = $(this).attr('data-confirm');

		xoa_sp_gh_dm(id, iddh, al);
		return false;
	});
	getAllProvince();
	$('.form-shopping #province').on('change', handleSelectProvince);
	$('.form-shopping #county').on('change', handleSelectCounty);

	$('.form-order select[name="province"]').on('change', handleSelectProvinceCart);
	$('.form-order select[name="county"]').on('change', handleSelectCountryCart);
});
function timeRadiosChange(e) {
	if ($(e).val() !== 'timeNow') {
		$('.picktime_selecter').show();
	} else {
		$('.picktime_selecter').hide();
	}
}
function actionAddToCart(e) {
	const id = $(e).data('product');
	const soluong = 1;
	const product_name = $(e).data('title');
	const data = {
		id,
		soluong,
		func: 'addToCart',
	};

	const error = (res) => {
		alert('Thêm sản phẩm vào giỏ hàng không thành công, vui lòng thử lại!');
	};

	const success = (res) => {
		updateProductInCart();
		$('#modalAddToCart .dathang-cart').load('ajax/ajax_cartInfo.php');
		$('#modalAddToCart span.product-name').html(product_name);
		$('#modalAddToCart').modal('show');
	};

	$.ajax({
		url: '/api.php',
		method: 'POST',
		data,
		success,
		error,
	});

	return false;
}

function openCartModal() {
	$('#modalAddToCart .dathang-cart').load('ajax/ajax_cartInfo.php');
	$('#modalAddToCart #modalAddToCartLabel').html("Giỏ hàng của bạn");
	$('#modalAddToCart').modal('show');
	return false;
}

function xoa_sp_gh_dm(id, iddh, al) {
	var cf = confirm(al);
	if (cf) {
		$.ajax({
			url: "./sources/ajax.php",
			type: 'POST',
			data: {
				'do': 'xoa_sp_gh',
				'id': id,
				'iddh': iddh
			},
			success: function(data) {
				updateProductInCart();
				$('#modalAddToCart .dathang-cart').load('ajax/ajax_cartInfo.php');
			}
		})
	}
}

function handleAddToCartAction(e) {
	e.preventDefault();
	const button = e.target;
	button.disabled = true;
	const id = button.dataset.id;
	const inputQuantity = button.closest('div').querySelector('.input-quantity');
	if (!inputQuantity || !inputQuantity.value || inputQuantity.value < 1) {
		swal('Vui lòng nhập số lượng sản phẩm', '', 'info');
	}
	const soluong = +inputQuantity.value;
	
	const data = {
		id,
		soluong,
	};

	swal('Đang thêm vào giỏ hàng', '', 'info');
	sweetAlert.disableButtons();

	const success = () => {
		button.disabled = false;
		updateCartNum(soluong, 'plus');
		swal({
			title: 'Thành công, bạn có muốn xem giỏ hàng?',
			type: 'success',
			showCancelButton: true,
			confirmButtonText: 'Xem',
			cancelButtonText: 'Không',
			closeOnConfirm: true,
			showLoaderOnConfirm: true,
		}, (isConfirmed) => {
			if (isConfirmed) {
				$('#modalAddToCart .dathang-cart').load('ajax/ajax_cartInfo.php');
				$('#modalAddToCart').modal('show');

			}
		});
	};

	const error = error => {
		button.disabled = false;
		console.log(error);
		swal('Thêm vào giỏ hàng thất bại, vui lòng thử lại!', '', 'info');
	};

	$.ajax({
		url: '/api.php?func=addToCart',
		dataType: 'json',
		method: 'POST',
		data,
		success,
		error,
	});
}

function initAddToCartAction() {
	$addCartButtons = $('.action-add-to-cart');
	if (!$addCartButtons.length) {
		return;
	}

	$addCartButtons.on('click', handleAddToCartAction);
}

function getAllProvince() {
	$.ajax('/img_data/files/viet-nam/tinh_tp.json', {
		success: data => {
			$('select[name="province"]').append(`<option value="">Chọn tỉnh/thành phố</option>`);
			Object.keys(data).forEach(function(i) {
				const element = data[i];
				$('select[name="province"]').append(`<option value="${element.name}" data-id="${element.code}">${element.name}</option>`);
			});

			$('.form-shopping select[name="province"]').trigger('change');
			$('.form-shopping select[name="province"]').on('change', handleGetDeliveryFee);

			$('.form-order select[name="province"]').trigger('change');
			$('.form-order select[name="province"]').on('change', handleGetDeliveryFee);
		},
		fail: () => {
			alert('Có lỗi khi lấy thông tin, vui lòng tải lại trang!');
		},
	});
}

function handleSelectProvince() {
	const provinceId = $('#province').find(":selected").data('id');
	if (!provinceId) {
		return;
	}
	$.ajax(`/img_data/files/viet-nam/quan-huyen/${provinceId}.json`, {
		success: data => {
			$('select[name="county"]').html('');
			$('select[name="county"]').append(`<option>Chọn quận/huyện</option>`);
			Object.keys(data).forEach(function(i) {
				const element = data[i];
				$('select[name="county"]').append(`<option value="${element.name}" data-id="${element.code}">${element.name}</option>`);
			});
		},
		fail: () => {
			alert('Có lỗi khi lấy thông tin, vui lòng tải lại trang!');
		},
	});
}

function handleSelectCounty() {
	const countyId = $('#county').find(":selected").data('id');
	$.ajax(`/img_data/files/viet-nam/xa-phuong/${countyId}.json`, {
		success: data => {
			$('#commune').html('');
			$('#commune').append(`<option>Chọn xã/phường</option>`);
			Object.keys(data).forEach(function(i) {
				const element = data[i];
				$('#commune').append(`<option value="${element.name}" data-id="${element.code}">${element.name}</option>`);
			});
		},
		fail: () => {
			alert('Có lỗi khi lấy thông tin, vui lòng tải lại trang!');
		},
	});
}

function handleSelectProvinceCart() {
	const provinceId = $('#modalAddToCart #province').find(":selected").data('id');
	if (!provinceId) {
		return;
	}
	$.ajax(`/img_data/files/viet-nam/quan-huyen/${provinceId}.json`, {
		success: data => {
			$('#modalAddToCart select[name="county"]').html('');
			$('#modalAddToCart select[name="county"]').append(`<option>Chọn quận/huyện</option>`);
			Object.keys(data).forEach(function(i) {
				const element = data[i];
				$('#modalAddToCart select[name="county"]').append(`<option value="${element.name}" data-id="${element.code}">${element.name}</option>`);
			});
		},
		fail: () => {
			alert('Có lỗi khi lấy thông tin, vui lòng tải lại trang!');
		},
	});
}

function handleSelectCountryCart() {
	const countyId = $('#modalAddToCart #county').find(":selected").data('id');
	$.ajax(`/img_data/files/viet-nam/xa-phuong/${countyId}.json`, {
		success: data => {
			$('#modalAddToCart #commune').html('');
			$('#modalAddToCart #commune').append(`<option>Chọn xã/phường</option>`);
			Object.keys(data).forEach(function(i) {
				const element = data[i];
				$('#modalAddToCart #commune').append(`<option value="${element.name}" data-id="${element.code}">${element.name}</option>`);
			});
		},
		fail: () => {
			alert('Có lỗi khi lấy thông tin, vui lòng tải lại trang!');
		},
	});
}

function handleGetDeliveryFee(e) {
	e.preventDefault();
	const name = e.target.value;

	$.ajax({
		url: '/api.php',
		method: 'POST',
		data: {
			func: 'get_area_by_name',
			name,
		},
		dataType: 'json',
		success: data => {
			if (!data.isSuccess) {
				alert('Fail!');
				return;
			}

			Wind.province = data.delivery_area || {};

			updateFee();
		},
		error: err => {
			alert('Fail!');
			console.log(err);
		},
	});
}

function updateFee() {
	if (!Wind.province.price) {
		$('.delivery_fee').html('Thông báo sau!');
		// $('.tong_tien_gh').html(moneyFormat(Wind.total) + 'đ');
	} else {
		$('.delivery_fee').html(moneyFormat(+Wind.province.price) + 'đ');
		let total = $('.tong_tien_gh').text().replaceAll('đ', '');
		total = total.replaceAll('.', '');
		$('.tong_tien_gh').html(moneyFormat(+Wind.province.price + parseInt(total)) + 'đ');
	}
}

function isValidEmailAddress(emailAddress) {
	var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
	return pattern.test(emailAddress);
};

function moneyFormat(n, c = 0, d = ',', t = '.') {
	c = isNaN(c = Math.abs(c)) ? 2 : c,
		d = d == undefined ? "." : d,
		t = t == undefined ? "," : t,
		s = n < 0 ? "-" : "",
		i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
		j = (j = i.length) > 3 ? j % 3 : 0;

	return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}

function updateUndefineArea() {
	$('.delivery_fee').html('Thông báo sau!');
}

$('#chat_online .toggle-button').on('click', function() {
	if ($(this).hasClass('is-close')) {
		$(this).removeClass('is-close');
	} else {
		$(this).addClass('is-close');
	}
});

function printQuote(e) {
	(function ($) {
		let formShopping = $(e).closest('form');
		var name = $(formShopping).find('#ten').val();
		var email = $(formShopping).find('#email').val();
		var phone = $(formShopping).find('#dienthoai').val();
		if (!name || name.length === 0 ||
			!phone || phone.length === 0 ||
			!email || email.length === 0
		) {
			alert("Vui lòng nhập tên, email và điện thoại của quý khách!");
			return;
		}

		// Show loading
		alert("Xin quý khách chờ trong giây lát...");

		// Prepare pdf URL
		var query = 'name=' + encodeURIComponent(name);
		query += '&email=' + encodeURIComponent(email);
		query += '&phone=' + encodeURIComponent(phone);
		var baogiaUrl = '/tai-bao-gia-pdf.php?' + query;

		// Save current cart
		var data = formShopping.serialize();
		data += '&in_bao_gia=1&guidonhang=1'
		$.ajax({
			url: '/gio-hang.html',
			data,
			method: 'POST'
		}).done(function() {
			// Open pdf URL
			window.open(baogiaUrl, '_blank');
		}).fail(function() {
			alert("Có lỗi xảy ra, vui lòng thử lại!");
		});
	})(jQuery);
}

function requestQuoteCart(e) {
	(function ($) {
		let formShopping = $(e).closest('form');
		let name = $(formShopping).find('#ten').val();
		let email = $(formShopping).find('#email').val();
		let phone = $(formShopping).find('#dienthoai').val();
		let message = $(formShopping).find('#loinhan').val();

		if (name) {
			$('#request_quote_cart_ten').val(name);
		}

		if (email) {
			$('#request_quote_cart_email').val(email);
		}

		if (phone) {
			$('#request_quote_cart_phone').val(phone);
		}

		if (message) {
			$('#request_quote_cart_noi_dung').val(message);
		}

		$('#modalAddToCart').modal('hide');
		$('#modalDathang').modal('hide');
		setTimeout(function () {
			$('#request_quote_cart_modal').modal('show');
		}, 500);
	})(jQuery);
}

