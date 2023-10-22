function seach(obj, tenp) {
  var loai = $(obj).val();
  var key = $('#search').val();
  if (loai == 1) {
    window.location = 'index.php?p=' + tenp + '&a=man&seach=id&key=' + key;
  } else if (loai == 2) {
    window.location = 'index.php?p=' + tenp + '&a=man&seach=name&key=' + key;
  } else if (loai == 3) {
    window.location = 'index.php?p=' + tenp + '&a=man&seach=ma&key=' + key;
  }
}

function searchByColumn(obj, tenp) {
  var column = $(obj).val();

  if (!column) {
    return;
  }

  var key = $('#search').val();
  window.location =
    'index.php?p=' + tenp + '&a=man&column=' + column + '&key=' + key;
}

function show(obj, tenp) {
  var show = $(obj).val();
  window.location = 'index.php?p=' + tenp + '&a=man&hienthi=' + show;
}

function addSelectIdToCookie() {
  const checkboxs = $('.chk_box:checked[name="chk_child[]"]');
  if (checkboxs.length === 0) {
    swal({
      title: 'Bạn chưa chọn sản phẩm nào',
      type: 'warning',
    });
    return 0;
  }

  let selectedStr = $.cookie('bulk_add_image_ids');
  let selectedIds = [];
  if (selectedStr) {
    selectedIds = selectedStr.split(',');
  }
  const idSet = new Set(selectedIds);
  checkboxs.each((_, e) => idSet.add(e.value));
  selectedStr = Array.from(idSet).join(',');
  $.cookie('bulk_add_image_ids', selectedStr);
  return checkboxs.length;
}

function form_submit(obj) {
  const action = $(obj).val();
  if (action === 'delete') {
    if (confirm('Bạn có chắc muốn xóa?')) {
      $('#form').submit();
    }
    return;
  }

  if (action === 'add_image') {
    const count = addSelectIdToCookie();
    $(obj).val('');
    if (count > 0) {
      window.location.href = '/admin/index.php?p=san-pham&a=show_bulk_add_image';
    }
    return;
  }
  if (action === 'list_add_image') {
    const count = addSelectIdToCookie();
    swal({
      type: 'success',
      title: `Đã thêm ${count} sản phẩm vào danh sách thêm ảnh nhanh!`,
    });
    $(obj).val('');
    return;
  }
}

function on_check(obj, bang, cot, id) {
  var trangthai = 0;
  if ($(obj).is(':checked')) {
    trangthai = 1;
  }

  $.ajax({
    url: './sources/aj_checkbox.php',
    type: 'POST',
    data:
      'trangthai=' + trangthai + '&bang=' + bang + '&cot=' + cot + '&id=' + id,
    success: function (data) {},
  });
}

function locdau(str) {
  str = str.toLowerCase();

  str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, 'a');
  str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, 'e');
  str = str.replace(/ì|í|ị|ỉ|ĩ/g, 'i');
  str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, 'o');
  str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, 'u');
  str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, 'y');
  str = str.replace(/đ/g, 'd');
  str = str.replace(
    /!|@|\$|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\'| |\"|\&|\#|\[|\]|\;|\||\{|\}|~/g,
    '-'
  );
  str = str.replace(/^\-+|\-+$/g, '-');
  str = str.replace(/\–/g, '-');
  str = str.replace(/\\/g, '-');
  str = str.replace(/-+-/g, '-');
  return str;
}
