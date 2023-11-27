function ResizeWindows() {
	var Xwidth = $(window).width();
	var Yheight = $(window).height();

	// if($('.item-pro').length) {
	// 	var h = 0;
	// 	$('.item-pro .info').css('height','');
	// 	$('.item-pro').each(function() {
	// 		var i = $(this).find('.info').innerHeight();
	// 		if(i>h) h=i;
	// 	});
	// 	$('.item-pro .info').css('height',h);
	// }

	if ($('#adv-fixed-left').length && Xwidth > 1200) {
		MainContentW = 1000; LeftBannerW = 170; RightBannerW = 170; LeftAdjust = 15; RightAdjust = 15; TopAdjust = 10;
		ShowAdDiv();
	}

}

function FloatTopDiv() {
	startLX = ((document.body.clientWidth - MainContentW) / 2) - LeftBannerW - LeftAdjust, startLY = TopAdjust + 80;
	startRX = ((document.body.clientWidth - MainContentW) / 2) + MainContentW + RightAdjust, startRY = TopAdjust + 80;
	var d = document;
	function ml(id) {
		var el = d.getElementById ? d.getElementById(id) : d.all ? d.all[id] : d.layers[id];
		el.sP = function (x, y) { this.style.left = x + 'px'; this.style.top = y + 'px'; };
		el.x = startRX;
		el.y = startRY;
		return el;
	}

	function m2(id) {
		var e2 = d.getElementById ? d.getElementById(id) : d.all ? d.all[id] : d.layers[id];
		e2.sP = function (x, y) { this.style.left = x + 'px'; this.style.top = y + 'px'; };
		e2.x = startLX;
		e2.y = startLY;
		return e2;
	}
	window.stayTopLeft = function () {
		if (document.documentElement && document.documentElement.scrollTop)
			var pY = document.documentElement.scrollTop;
		else if (document.body)
			var pY = document.body.scrollTop;
		if (document.body.scrollTop > 30) { startLY = 3; startRY = 3; } else { startLY = TopAdjust; startRY = TopAdjust; };
		ftlObj.y += (pY + startRY - ftlObj.y) / 16;
		ftlObj.sP(ftlObj.x, ftlObj.y);
		ftlObj2.y += (pY + startLY - ftlObj2.y) / 16;
		ftlObj2.sP(ftlObj2.x, ftlObj2.y);
		setTimeout("stayTopLeft()", 1);
	}
	ftlObj = ml("adv-fixed-right");
	//stayTopLeft();
	ftlObj2 = m2("adv-fixed-left");
	stayTopLeft();
}
function ShowAdDiv() {
	var objAdDivRight = document.getElementById("adv-fixed-right");
	var objAdDivLeft = document.getElementById("adv-fixed-left");
	if (document.body.clientWidth < 1000) {
		objAdDivRight.style.display = "none";
		objAdDivLeft.style.display = "none";
	}
	else {
		objAdDivRight.style.display = "block";
		objAdDivLeft.style.display = "block";
		FloatTopDiv();
	}
}

function ajaxDeleteImg() {
	$('.btn-del-img').on('click', function (e) {
		e.preventDefault();

		var id = $(this).attr('data-id');
		var image_name = $(this).attr('data-image');
		var default_image = '';
		const apiUrl = 'https://cdn.vanthienhung.vn/admin/api.php?func=deleteImg';

		if (image_name == '') {
			swal({
				type: 'warning',
				title: 'Không tìm thấy ảnh!',
			});
			return false;
		}

		$(this).parent().addClass('img-exc');

		$.ajax({
			type: 'GET',
			url: apiUrl,
			data: {
				product_id: id,
				image_name: image_name,
				func: 'deleteImg',
			},
			dataType: 'json',
			success: (res) => {
				if (res.isSuccess) {
					//console.log(res.message);
					default_image = triggleDeleteImageField(id);
					$(this).siblings('.img-shine-2').find('img').attr('src', default_image);
					$(this).parent().removeClass('img-exc');
					$(this).attr('data-image', '');
				}
			},
		});
		$(this).parent().removeClass('img-exc');
		return false;
	});
}

function triggleDeleteImageField(id) {
	var default_img = '';
	$.ajax({
		type: 'GET',
		url: 'ajax/ajax_deleteProductImg.php',
		data: {
			product_id: id,
		},
		dataType: 'json',
		success: (res) => {
			//console.log(res);
			default_img = res.default_image;
		},
	});
	return default_img;
}

function ajaxChangeImg() {
	$('.btn-change-img').on('click', function (e) {
		e.preventDefault();

		let id = $(this).attr('data-id');
		$('#changeImageModal #changeImageProductId').val(id);
		$('#changeImageModal #changeImageProductTitle').text($(this).attr('data-title'));
		$('#changeImageModal .img-result').html('');
		$('#changeImageModal').modal('show');
	});
}

function carouselProductImgs() {
	$('.prod-slider-nav').slick({
		infinite: true,
		slidesToShow: 3,
		slidesToScroll: 1,
		//asNavFor: '.slider-for',
		dots: false,
		arrows: false,
		focusOnSelect: true,
		autoplay: true,
		autoplaySpeed: 1500,
	});
	$('.prod-slider-nav-item').on('click', function (e) {
		e.preventDefault();
		var id = $(this).attr('data-id');
		var thumb_src = $(this).find('img').attr('src');
		$('.prod-slider-main-' + id).find('img').attr('src', thumb_src);
		return false;
	});
}

function stickyHoTroTrucTuyen() {
	if ($('.hotrotructuyen-widget').length) {
		var stickyTop = $('.hotrotructuyen-wrap').offset().top;
		var scrollTop = $(window).scrollTop();

		//var windowHeight = $(window).outerHeight();
		var htttHeight = $('.hotrotructuyen-widget').outerHeight();
		var footerTop = $('.footerTop').offset().top - (htttHeight + 90);

		if (scrollTop > stickyTop) {
			$('body').addClass('sticky-hotrott');
		} else {
			$('body').removeClass('sticky-hotrott');
		}

		//console.log('scrolltop' + scrollTop);
		//console.log('footerTop' + footerTop);

		if (scrollTop > footerTop) {
			$('body').removeClass('sticky-hotrott');
		}

		if ($('.end-ctsp-top').length) {
			var endSticky = $('.end-ctsp-top').offset().top - (htttHeight + 50);
			if (scrollTop > endSticky) {
				$('body').removeClass('sticky-hotrott');
			}
		}

	}
	return false;
}

function tiepTucMuaHang() {
	$('body').on('click', '.btn-continute-order', function (e) {
		e.preventDefault();
		$('#modalDathang').modal('hide');
		$('html, body').animate({
			scrollTop: $("#relatedProduct").offset().top - 60
		}, 800);
		return false;
	});
}

$(document).ready(function () {

	AOS.init({
		easing: 'ease-in-out-sine',
		disable: 'mobile',
		duration: 800,
		once: true
	});

	ajaxDeleteImg();

	carouselProductImgs();

	stickyHoTroTrucTuyen();

	tiepTucMuaHang();

	ajaxChangeImg();

	$('[data-toggle="tooltip"]').tooltip();

	$(window).on('resize load', function () {
		ResizeWindows();
	});

	$(window).scroll(function () {
		stickyHoTroTrucTuyen();
		return false;
	});

});