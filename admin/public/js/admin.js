async function cloneProduct(id, type = 'san-pham') {
	var m = await swal({
	  title: `Bạn muốn sao chép sản phẩm này?`,
	  html: 
	  	'<p><label><input type="checkbox" id="isCloneImages"/> Sao chép hình ảnh</label></p>' +
	  	'<p><label><input type="checkbox" id="isClonePartNumber"/> Sao chép part number</label></p>'
	  ,
	  type: "warning",
	  showCancelButton: true,
	  closeOnConfirm: false,
	  confirmButtonText: "Có",
	  cancelButtonText: "Hủy",
	  showLoaderOnConfirm: true,
	  preConfirm: function () {
	  	var isCloneImages = document.getElementById('isCloneImages');
	  	isCloneImages = isCloneImages.checked;
	  	var isClonePartNumber = document.getElementById('isClonePartNumber');
	  	isClonePartNumber = isClonePartNumber.checked;

		  $.ajax({
		  	url: '/admin/api.php',
		  	data: {
		  		func: 'cloneProduct',
		  		id,
		  		isCloneImages,
		  		isClonePartNumber
		  	},
		  	success: (data) => {
		  		if (data.isSuccess) {
		  			swal('Sao chép thành công!', '', 'success');
		  			var newUrl = `/admin/index.php?p=${type}&a=edit&id=${data.id}&page=`;
		  			// Open in new tab
		  			// window.open(newUrl, '_blank');

		  			// Open in current tab
		  			window.location.href = newUrl;

		  		} else {
		  			swal("Có lỗi xảy ra, vui lòng thử lại!");
		  		}
		  	},
		  	fail: () => {
		  		swal("Có lỗi xảy ra, vui lòng thử lại!");
		  	}
		  });
		}
	});

	if (m.dismiss) {
		// remove clone_id param
		var queryString = document.location.search;
		queryString = removeParam('clone_id', queryString);
		document.location.search = queryString;
		// history.pushState({"pageTitle": document.title}, "", document.location.origin + document.location.pathname + queryString);
	}
}

function removeParam(key, queryString) {
    var param,
        params_arr = [];
    if (queryString !== "") {
        params_arr = queryString.split("&");
        for (var i = params_arr.length - 1; i >= 0; i -= 1) {
            param = params_arr[i].split("=")[0];
            if (param === key) {
                params_arr.splice(i, 1);
            }
        }
    }
    return params_arr.join("&");
}

function clearCache(e) {
	e.preventDefault();

	swal({
	  title: `Bạn muốn xóa cache?`,
	  type: "warning",
	  showCancelButton: true,
	  closeOnConfirm: false,
	  confirmButtonText: "Xóa",
	  cancelButtonText: "Hủy",
	  showLoaderOnConfirm: true,
	  preConfirm: function() {
		  return $.ajax({
		  	url: '/admin/api.php',
		  	data: {
		  		func: 'clearCache',
		  	}
		  });
		}
	}).then((result) => {
	  if (result.value) {
	  	var data = result.value;
	    if (data.status == 'success') {
  			swal('Xóa thành công!', '', 'success');
  		} else {
  			swal("Có lỗi xảy ra, vui lòng thử lại!");
  		}
	  } else {
	  	swal("Có lỗi xảy ra, vui lòng thử lại!");
	  }
	});
}

$(document).ready(function () {
    $('ul#menu>li>a[href="#"]').click(function(){
        $(this).next('ul').toggle();
        return false;
    });
	
	
	$('.a_stt').on('blur',function() {
		var table=$(this).attr('data-table');
		var col=$(this).attr('data-col');
		var id=$(this).attr('data-id');
		var val=$(this).val();
		$.ajax({
			url: './sources/ajax.php',
			type: "POST",
			data: {'table': table, 'col': col, 'val':val, 'id':id, 'do':'update_stt'},	
			dataType: "json",
		})
	});

	$('.clear-cat-button').on('click', clearCache);
	
});