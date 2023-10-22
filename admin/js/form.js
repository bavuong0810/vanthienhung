async function uploadImage(e) {
  const file = e.target.files[0];
  const formData = new FormData();
  formData.append('file', file);
  const dataset = e.target.dataset;

  const apiUrl =
    dataset && dataset.api ? dataset.api : '/admin/api.php?func=uploadFile';

  const target = dataset.result;

  $(target + ' .img-result').html('Đang tải lên...');
  const showError = () => {
    $(target + ' .img-result').html('Tải ảnh lên thất bại, vui lòng thử lại!');
  };

  const res = await fetch(apiUrl, {
    method: 'POST',
    body: formData,
  });
  if (!res.ok) {
    swal({
      type: 'warning',
      title: 'Tải lên thất bại, vui lòng thử lại!',
    });

    showError();
    return;
  }
  e.target.value = '';
  const data = await res.json();
  if (data.path === false) {
    swal({
      type: 'warning',
      title:
        'Không tìm thấy tệp tin tải lên, có thể bạn đang tải lên ảnh từ dữ liệu đám mây chưa được tài về máy của bạn!',
    });

    showError();
    return;
  }
  if (!data.path) {
    swal({
      type: 'warning',
      title: 'Tải lên thất bại, vui lòng thử lại',
    });

    showError();
    return;
  }

  let baseUrl =
    !dataset.api || dataset.api.indexOf('http') !== 0
      ? '/'
      : AppConfig && AppConfig.fileBaseUrl
      ? AppConfig.fileBaseUrl
      : '';

  if (e.target.dataset.baseUrl) {
    baseUrl = dataset.baseUrl;
  }

  const src =
    data.path.indexOf('http') === 0
      ? data.path
      : baseUrl + 'img_data/images/' + data.path;
  $(target + ' .js-upload-result').val(data.path);
  $(target + ' .img-result').html(
    '<img src="' +
      src +
      '" style="max-height:150px; max-width: 178px; margin-top: 5px; margin-bottom: 10px;"/>'
  );
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

  const dataset = e.target.dataset;

  const apiUrl =
    dataset && dataset.api ? dataset.api : '/admin/api.php?func=url_to_image';

  $.ajax({
    type: 'GET',
    url: apiUrl,
    data: {
      url,
      func: 'url_to_image',
    },
    dataType: 'json',
    success: (res) => {
      console.log({
        res,
      });
      if (!res.result) {
        swal({
          type: 'error',
          title: 'Lỗi tải lên hình ảnh!' + res.message,
        });
        return;
      }

      src = res.result;
      $(target + ' .js-upload-result').val(src);

      imageUrl = src.indexOf('http') === 0 ? src : '/img_data/images/' + src;
      $(target + ' .img-result').html(
        '<img src="' +
          imageUrl +
          '" style="max-height:150px; max-width: 178px; margin-top: 5px; margin-bottom: 10px;"/>'
      );
    },
  });
}

function initImageFieldAutoUpload(target = '.js-image-field') {
  $(target).on('change', (e) => {
    const target = e.target;
    if (target.files.length === 0) {
      return;
    }

    uploadImage(e);
  });
}

function initImageField() {
  initImageFieldAutoUpload();

  $('.js-image-remove').on('click', (e) => {
    e.preventDefault();

    const target = e.target.dataset.target;
    $(target + ' .js-upload-result').val('');
    $(target + ' .img-result').html('');
  });
}

function initForm() {
  initImageField();
}

function handleSubmitAjaxForm(e) {
  e.preventDefault();

  const formArr = $(e.target).serializeArray();
  const data = {};
  formArr.forEach((item) => {
    if (!item.name) {
      return;
    }
    data[item.name] = item.value;
  });

  console.log('data', data);
  return $.ajax({
    type: 'POST',
    url: e.target.action,
    data: JSON.stringify(data),
    contentType: 'application/json',
    dataType: 'json',
    success: (res, err) => {
      console.log({
        res,
        err,
      });
      if (!res || !res.isSuccess) {
        const message = res ? res.message : 'Lỗi không xác định';
        swal({
          type: 'error',
          title: 'Có lỗi xảy ra: ' + message,
        });
        return;
      }

      swal({
        type: 'success',
        title: 'Cập nhật thành công!',
      });
    },
  });
}

function initAjaxForm() {
  $('.js-ajax-form').on('submit', handleSubmitAjaxForm);
}

initForm();
initAjaxForm();
