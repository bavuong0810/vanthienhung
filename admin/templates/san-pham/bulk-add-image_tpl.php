<ol class="breadcrumb">
  <li><a href="<?= urladmin ?>"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
  <li class="active"><a href="<?= urladmin ?>index.php">Danh mục</a></li>
  <li class="active"><a href="<?= urladmin ?>index.php?p=san-pham&a=man">Sản phẩm</a></li>
  <li class="active"><a href="#">Thêm ảnh sản phẩm</a></li>
</ol>
<div class="col-xs-12">
  <div class="page-header mt-0">
    <h3 class="mt-0">Thêm ảnh sản phẩm nhanh <button type="button" class="btn btn-info-outline js-btn-clear-ids">Làm trống danh sách</button></h1>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="jumbotron">
        <div class="row">
          <div class="col-md-12">
            <form id="form_import">
              <div class="form-group">
                <div>Số sản phẩm đã chọn: <strong id="selected_product_count">--</strong></div>
              </div>
              <div class="row form-group">
                <div class="col-md-1 text-label">
                  Hình ảnh:
                </div>
                <div class="col-md-11" id="thumb">
                  <div class="img-result">
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <input type="hidden" i="thumb_path" name="thumb_path" class="js-upload-url-result">
                      <input type="file" class="input width400 form-control js-upload-file" data-result="#thumb" />
                    </div>
                    <div class="col-md-2 text-label">
                      Hoặc nhập link hình ảnh, dán ảnh:
                    </div>
                    <div class="col-md-4">
                      <input type="text" placeholder="Link hình ảnh..." class="input width400 form-control js-upload-url">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-1 text-label">
                  Hình ảnh slide:
                </div>
                <div class="col-md-11">
                  <div class="td_hinhanh">
                  </div>
                  <div class="add_img">
                  </div>
                  <div style="clear:both"></div>
                  <div><button type="button" onclick="them_anh()" class="btn btn-info">Thêm ảnh</button></div>
                </div>
              </div>
              <hr>
              <div class="form-group">
                <button type="submit" class="btn btn-lg btn-primary">Cập nhật</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="jumbotron hide"></div>
    </div>
  </div>
</div>

<script>
  var listIds = [];
  var isSubmitting = false;
  async function uploadImage(e) {
    const file = e.target.files[0];
    const formData = new FormData();
    formData.append('file', file);

    const res = await fetch('/admin/api.php?func=uploadFile', {
      method: 'POST',
      body: formData,
    });
    if (!res.ok) {
      swal({
        type: 'warning',
        title: 'Tải lên thất bại, vui lòng thử lại!',
      });
      return;
    }
    const data = await res.json();
    e.target.value = '';

    const target = e.target.dataset.result;
    const src = '/img_data/images/' + data.path;
    $(target + ' .js-upload-url-result').val(data.path);
    $(target + ' .img-result').html('<img src="' + src + '" style="max-height:150px; max-width: 178px; margin-top: 5px; margin-bottom: 10px;"/>');
  }
  async function uploadFromUrl(url = '', target) {
    url = url.trim();
    if (url.length === 0) {
      return;
    }
    if (url.indexOf('http') !== 0) {
      swal({
        type: 'info',
        title: 'Đường dẫn không hợp lệ',
      });
      return;
    }

    $.ajax({
      type: 'GET',
      url: '/admin/api.php',
      data: {
        url,
        func: 'url_to_image',
      },
      dataType: 'json',
      success: (res) => {
        console.log({
          res
        });
        if (!res.result) {
          swal({
            type: 'error',
            title: 'Lỗi tải lên hình ảnh!' + res.message,
          });
          return;
        }

        src = res.result;
        $(target + ' .js-upload-url-result').val(src);
        $(target + ' .img-result').html('<img src="/img_data/images/' + src + '" style="max-height:150px; max-width: 178px; margin-top: 5px; margin-bottom: 10px;"/>');
      },
    });
  }
  async function initUploadFromUrl() {
    $('.js-upload-url').on('blur', (e) => {
      const url = e.target.value;
      uploadFromUrl(url, '#thumb');
    });
    // upload on paste URL
    // $('.js-upload-url').on('paste', (event) => {
    //   let url = (event.clipboardData || window.clipboardData).getData('text');
    //   uploadFromUrl(url);
    // });
  }

  async function checkSelectIds() {
    const listIdsStr = $.cookie('bulk_add_image_ids');
    if (!listIdsStr) {
      swal({
        title: 'Bạn chưa chọn sản phẩm nào',
        type: 'warning',
      });
      return;
    }
    listIds = listIdsStr.split(',');
    $('#selected_product_count').html(listIds.length);
  }

  async function handleSubmitForm(e) {
    e.preventDefault();
    if (isSubmitting) {
      return;
    }
    isSubmitting = true;

    const dataArr = $(e.target).serializeArray();
    console.log('dataArr', dataArr);
    const data = {};
    let thumbPath = '';
    const slideImages = {};
    dataArr.forEach(field => {
      if (field.name === 'thumb_path') {
        thumbPath = field.value;
        return;
      }
      if (field.name.indexOf('slide_path_') === 0) {
        slideImages[field.name] = slideImages[field.name] || {};
        slideImages[field.name].path = field.value;
        return;
      }
      if (field.name.indexOf('title_') === 0) {
        const fieldName = 'slide_path_' + field.name.replace('title_', '');
        slideImages[fieldName] = slideImages[fieldName] || {};
        slideImages[fieldName].title = field.value;
        return;
      }
      data[field.name] = field.value;
    });
    data.slides = Object.values(slideImages);
    data.thumbPath = thumbPath;
    data.ids = ($.cookie('bulk_add_image_ids') || '').split(',').map(id => +id);

    swal({
      type: 'info',
      title: 'Đang cập nhật!',
      allowOutsideClick: false,
    });
    swal.showLoading();

    $.ajax({
      type: 'POST',
      url: '/admin/api.php?func=bulk_update_images',
      data: JSON.stringify(data),
      contentType: 'application/json',
      dataType: 'json',
      success: (res) => {
        isSubmitting = false;
        if (res.isSuccess) {
          swal({
            type: 'success',
            title: 'Đã cập nhật!',
          });
          return;
        }

        swal({
          type: 'warning',
          title: res.message,
        });
        console.log('res', res);
      },
      error: (err) => {
        console.log('ewrwrawfawdfsdf', err);
      },
    }).fail(() => {
      isSubmitting = false;
      swal({
        type: 'error',
        title: 'Lỗi khi cập nhật!',
      });
    });
  }

  initUploadImageOnSelect = (selector = 'input.js-upload-file[type=file]') => {
    $(selector).on('change', uploadImage);
  };

  const handleClearIds = () => {
    $.removeCookie('bulk_add_image_ids');
    swal({
      type: 'success',
      title: 'Đã làm trống danh sách',
    });

    setTimeout(() => {
      window.location.reload();
    }, 600);
  };

  $(document).ready(function() {
    initUploadFromUrl();
    initUploadImageOnSelect();
    checkSelectIds();
    $('#form_import').on('submit', handleSubmitForm);
    $('.js-btn-clear-ids').on('click', handleClearIds);
  });
</script>
<script type="text/javascript" src="/admin/assets/pasteimage.js"></script>
<script>
  function showImage(src, target) {

    var sourceSplit = src.split("base64,");
    var sourceString = sourceSplit[1];
    $.ajax({
      type: 'POST',
      url: '/admin/upload.php?image_source=1',
      data: sourceString,
      contentType: 'application/json',
      dataType: 'json',
      success: (res) => {
        console.log({
          res
        });
        if (!res.name) {
          swal({
            type: 'warning',
            title: 'Lỗi tải lên hình ảnh!',
          });
          return;
        }

        src = res.name;
        if ($(target + ' .img-result img').length > 0) {
          $(target + ' .img-result img').attr('src', '/img_data/images/' + src);
        } else {
          $(target + ' .img-result').append('<img src="/img_data/images/' + src + '" style="max-height:150px;"/>');
        }

        $(target + ' .js-upload-url-result').val(src);
      },
    });
  }

  function showSlideImage(src, target) {
    var sourceSplit = src.split("base64,");
    var sourceString = sourceSplit[1];

    $.ajax({
      type: 'POST',
      url: '/admin/upload.php?image_source=1',
      data: sourceString,
      contentType: 'application/json',
      dataType: 'json',
      success: (res) => {
        console.log({
          res
        });
        if (!res.name) {
          swal({
            type: 'warning',
            title: 'Lỗi tải lên hình ảnh!',
          });
          return;
        }
        $(target).height('210px');

        src = res.name;
        if ($(target + ' .img-result img').length > 0) {
          $(target + ' .img-result img').attr('src', '/img_data/images/' + src);
        } else {
          $(target + ' .img-result').append('<img src="/img_data/images/' + src + '" style="max-height:150px; max-width: 100%; margin-top: 5px"/>');
        }

        $(target + ' .js-upload-url-result').val(src);
      },
    });
  }

  pasteimage('#thumb', showImage);
  var fs_img = 0;

  function them_anh() {
    fs_img++;
    if (fs_img < 31) {
      $(".add_img").append('<div class="dv-img-ad hide_js_' + fs_img + '"><input type="hidden" class="input form-control js-upload-url-result" name="slide_path_' + fs_img + '"><input type="file" class="js-upload-file file_img form-control" data-result=".hide_js_' + fs_img + '"><input type="text" placeholder="Link ảnh" class="input form-control js-upload-url"><input type="text" name="title_' + fs_img + '" class="form-control" placeholder="Tên sản phẩm" style="margin-top:5px;"/><div class="img-result"></div><a class="delete-img" href="javascript:;" onclick="xoa_anh_up(\'' + fs_img + '\')"> Xóa </a></div>');
      const targetSelector = '.hide_js_' + fs_img;
      pasteimage(targetSelector, showSlideImage);
      initUploadImageOnSelect('.hide_js_' + fs_img + ' .js-upload-file');
      $(targetSelector + ' .js-upload-url').on('blur', (e) => {
        const url = e.target.value;
        uploadFromUrl(url, targetSelector);
      });
    } else {
      alert("Mỗi lần up tối đa 30 ảnh.");
    }
  }

  function xoa_anh_up(id) {
    const $target = $(".hide_js_" + id);
    $target.fadeOut();
    setTimeout(() => {
      $target.remove();
    }, 1000);
  }
</script>