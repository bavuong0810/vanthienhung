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


	if($("#form-shopping").length) {
		var error1=$('#form-shopping #ten').attr('data-error');
		var error2=$('#form-shopping #email').attr('data-error');
		var error3=$('#form-shopping #diachi').attr('data-error');
		var error4=$('#form-shopping #dienthoai').attr('data-error');
		
		$("#form-shopping").validate({
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

	$('.dong-lon-buttons .addToCart, .detail-button-wrap a.addToCart').click(function(e) {
		const id = $(this).data('product');
		const soluong = 1;
		const product_name = $(this).data('title');
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
	});

	$('body').on('click', '#modalAddToCart .xoa_sp_gh_dh', function (e) {
		e.preventDefault();
		var id = $(this).attr('data-product');
		var iddh = $(this).attr('data-cart-item');
		var al = $(this).attr('data-confirm');

		xoa_sp_gh_dm(id, iddh, al);
		return false;
	});
});

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
				$('#modalAddToCart .modal-body').load('ajax/ajax_cartInfo.php');
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
			closeOnConfirm: false,
			showLoaderOnConfirm: true,
		}, (isConfirmed) => {
			if (isConfirmed) {
				window.location = '/gio-hang.html';
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

function isValidEmailAddress(emailAddress) {
	var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
	return pattern.test(emailAddress);
};

$('#chat_online .toggle-button').on('click', function() {
	if ($(this).hasClass('is-close')) {
		$(this).removeClass('is-close');
	} else {
		$(this).addClass('is-close');
	}
});

