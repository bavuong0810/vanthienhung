
function getSlideImages(productId) {
	return new Promise((resolve, reject) => {
		const apiUrl = '/admin/api-public.php';
		$.ajax({
			type: 'GET',
			url: apiUrl,
			data: {
				func: 'getSlideImagesByProduct',
				id: productId,
			},
			dataType: 'json',
			success: (res) => {
				resolve(res);
			},
			error: reject,
		});
	});
}

function toImagesHTML(imgs, productId) {
	if (!Array.isArray(imgs)) {
		return '';
	}

	const strs = imgs.map((item) => `
	<div class="dv-img-ad hide_js_${item.id}" data-toggle="tooltip" data-html="true" data-placement="right" title="${item.title}">
		<div class="img_addimage">
			<img src="${FILE_URL}/img_data/images/${item.image_path}">
		</div>
		<div class="icon_deleteimage">
			<a href="javascript:xoa_anh_sp('${item.id}','${productId}')" data-id="${item.id}" onclick="if(!confirm('Xác nhận xóa?')) return false;  "><img src="/admin/public/images/delete.png" alt="Delete"></a>
		</div>
		<a href="javascript:toggleShowImage('${item.id}')" data-id="${item.id}" class="toggle_image"><i class="glyphicon ${ +item.hien_thi ? ' glyphicon-eye-open' : ' glyphicon-eye-close'}"></i></a>
	</div>`);

	return strs.join('');
}

async function changeImage(target) {
	const $target = $(target);
	let id = $target.attr('data-id');
	const res = await getSlideImages(id);
	const slideImgsHTML = toImagesHTML(res, id);
	$('#changeImageModal #changeImageProductId').val(id);
	$('#changeImageModal #changeImageProductTitle').text($target.attr('data-title'));
	$('#changeImageModal #product_title').val($target.attr('data-title'));
	$('#changeImageModal #editBtn').attr('href', '/admin/index.php?p=san-pham&a=edit&id=' + $target.attr('data-id'));
	$('#changeImageModal .slide-imgs').html(slideImgsHTML);
	$('#changeImageModal .add_img').html('');
	$('#changeImageModal .img-result').html('');
	fs_img = 0;

	$('#changeImageModal').modal('show');
}

function showSlideImage(src, target) {
  // $(target).height('210px');

  // if ($(target + ' .img-result img').length > 0) {
  // 	$(target + ' .img-result img').attr('src', src);
  // } else {
  // 	$(target + ' .img-result').append('<img src="' + src + '" style="max-height:150px; max-width: 178px; margin-top: 5px"/>');
  // }

  var sourceSplit = src.split("base64,");
  var sourceString = sourceSplit[1];
  const baseUrl = FILE_URL ? FILE_URL : '/';
  // $(target + ' .input-clipboard').val(sourceString);
  $.ajax({
    type: 'POST',
    url: baseUrl + '/admin/upload.php?image_source=1',
    data: sourceString,
    contentType: 'application/json',
    success: (res) => {
      console.log({res});
      if (!res.name) {
        alert('Lỗi tải lên hình ảnh!');
        return;
      }
      $(target).height('210px');

      src = res.name;
      if ($(target + ' .img-result img').length > 0) {
        $(target + ' .img-result img').attr('src', src);
      } else {
        $(target + ' .img-result').append('<img src="'+baseUrl+'img_data/images/' + src + '" style="max-height:150px; max-width: 178px; margin-top: 5px"/>');
      }

    $(target + ' .input-clipboard').val(src);
    },
    dataType: 'json'
  });
}

function xoa_anh_sp(id,idsp){
  $.ajax({
    url: "/admin/sources/ajax_xoaanh_sp.php",
    type:'POST',
    data:"id="+id+"&idsp="+idsp,
    success: function(data){
      // $(".td_hinhanh").html(data);
      $(".hide_js_"+id).remove();
    }
  })
}

var fs_img = 0;
function them_anh(){
  fs_img++;
  if(fs_img < 31){
    $(".add_img").append('<div class="dv-img-ad hide_js_'+fs_img+'"><input type="hidden" name="txt_up_'+fs_img+'" class="txt_up_'+fs_img+'"  value="1"><input type="file" class="file_img form-control" name="file_'+fs_img+'" data-api="' + FILE_URL + '" data-result=".hide_js_'+fs_img+'"><input type="text" placeholder="Link ảnh" class="input form-control" name="file_url_'+fs_img+'"><input type="text" name="title'+fs_img+'" class="form-control" placeholder="Tên sản phẩm" style="margin-top:5px;"/><input type="hidden" class="input form-control input-clipboard js-upload-result" name="file_clipboard_'+fs_img+'"><div class="img-result"></div><a class="delete-img" href="javascript:;" onclick="xoa_anh_up(\''+fs_img+'\')"> Xóa </a></div>');
    const newWrapperId = '.hide_js_' + fs_img;
    pasteimage(newWrapperId, showSlideImage);
    initImageFieldAutoUpload(`${newWrapperId} .file_img`);
  }else{
    alert("Mỗi lần up tối đa 30 ảnh.");
  }
}

function xoa_anh_up(id){
  $(".hide_js_"+id).hide();
  $(".txt_up_"+id).val("0");
}


function toggleShowImage(id) {

  const icon = '.hide_js_' + id + ' .glyphicon';
  const $icon = $(icon);

  $.ajax({
    url: '/admin/index.php',
    type:'POST',
    data: {
      id,
      p: 'san-pham',
      a: 'toggle_image'
    },
    dataType: 'JSON',
    success: data => {
      if (data.result) {
        if ($icon.hasClass('glyphicon-eye-open')) {
          $icon.removeClass('glyphicon-eye-open').addClass('glyphicon-eye-close');
        } else {
          $icon.removeClass('glyphicon-eye-close').addClass('glyphicon-eye-open');
        }
      }
    },
    fail: (error) => {
      alert('Có lỗi xảy ra!')
      console.log(error);
    }
  });
}