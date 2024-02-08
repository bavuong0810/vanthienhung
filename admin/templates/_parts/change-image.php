<div class="modal fade" id="changeImageModal" tabindex="-1" role="dialog" aria-labelledby="changeImageModalLabel" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <form id="changeImageForm" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="changeImageModalLabel">Thay đổi hình ảnh</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="changeImageProductId" name="changeImageProductId">
                    <h3 id="changeImageProductTitle"></h3>
                    <div class="form-group">
                        <a href="" target="_blank" class="text-success" id="editBtn" title="Sửa sản phẩm">
                            <i class="glyphicon glyphicon-pencil"></i>
                        </a>
                    </div>
                    <div class="form-group">
                        <label for="product_title">Tên sản phẩm</label>
                        <input type="text" name="product_title" class="form-control" value="" id="product_title">
                    </div>
                    <div id="thumb">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="file" name="file2" class="input width400 form-control js-image-field" data-api="<?php echo getApiUploadFile(); ?>" data-result="#thumb"/>
                            </div>
                            <div class="col-md-12 form-group text-label">
                                Hoặc nhập link hình ảnh:
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" name="file2_url" placeholder="Link hình ảnh..." class="input width400 form-control" data-result="#thumb">
                            </div>
                            <div>
                                <input type="hidden" class="input-clipboard js-upload-result" name="file2_clipboard">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12 form-group text-label">
                                Kết quả:
                            </div>
                            <div class="col-md-12 form-group img-result"></div>
                        </div>
                    </div>
                    <?php if (!@$changeImage_hideSlide) {
                    ?>
                    <div class="form-group">
                        <label class="text-label">
                            Hình ảnh slide:
                        </label>
                        <div>
                            <div class="td_hinhanh slide-imgs">
                            </div>
                            <div class="add_img">
                            </div>
                            <div style="clear:both"></div>
                            <div style=""><a href="javascript:them_anh()" style="  background-color: #089abf;  padding: 5px 22px;  border-radius: 3px;  color: #fff;  text-decoration: none;">Thêm ảnh</a></div>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="form-group text-center">
                        <button class="btn btn-primary" type="submit">CẬP NHẬT</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
  </div>
  <script type="text/javascript">
    const FILE_URL = '<?php echo FILEURL; ?>';
  </script>
  <script type="text/javascript" src="/admin/assets/pasteimage.js?v=<?php echo getenv('APP_VERSION'); ?>"></script>
  <script type="text/javascript" src="/templates/js/admin-image.js?v=<?php echo getenv('APP_VERSION'); ?>"></script>
  <link rel="stylesheet" href="/admin/public/css/admin.css?v=<?php echo getenv('APP_VERSION'); ?>">
  <script src="/admin/js/form.js?v=<?php echo getenv('APP_VERSION'); ?>"></script>
  <script>
    if (typeof AppConfig === 'undefined') {
      window.AppConfig = {
        fileBaseUrl: '<?php echo $changeImage_baseFile ?: FILEURL; ?>',
        thumbFolder: '<?php echo THUMB_SITE_FOLDER; ?>',
        changeImageUrl: '<?php echo @$changeImage_api; ?>',
      };
    }
    jQuery(document).ready(function($) {
        pasteimage('#thumb', showImage);
        $('#thumb input[name=file2_url]').on('blur', urlToImage);

        $('#changeImageForm').on('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            let id = $('#changeImageForm #changeImageProductId').val();
            $.ajax({
                url: AppConfig.changeImageUrl || '/api.php?func=changeProductThumb',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                timeout: 1000 * 60 * 5,
                dataType: 'json',
                success: data => {
                    fs_img = 0;

                    if (typeof changeImageSuccessCB === 'function') {
                      changeImageSuccessCB(id, data);
                      return;
                    }

                    if (data.success === true) {
                        let imgResult = $('#changeImageForm #thumb .img-result img').attr('src');
                        if ($('#changeImageForm #thumb .img-result img').length) {
                            $('.product_image_' + id).attr('src', imgResult);
                            $('.product_image_' + id).css('max-height', '200px');
                            $('.product_image_' + id).css('object-fit', 'cover');
                        }
                        const $titleInput = $('input#product_title');
                        if ($titleInput && $titleInput.val()) {
                            const title = $titleInput.val();
                            $('.quick-item-' + id).attr('data-title', title);
                            $('.item-title-' + id).text(title);
                        }
                        $('#changeImageModal').modal('hide');
                    } else {
                        alert('Có lỗi xảy ra.');
                    }
                },
                fail: () => {
                    swal({
                        title: "Vui lòng thử lại!",
                        type: "warning",
                    });
                },
            });
        });
    });

    function showImage(src, target) {
        var sourceSplit = src.split("base64,");
        var sourceString = sourceSplit[1];

        var sourceSplit = src.split("base64,");
        var sourceString = sourceSplit[1];
        // $(target + ' .input-clipboard').val(sourceString);
        const baseUrl = AppConfig && AppConfig.fileBaseUrl ? AppConfig.fileBaseUrl : '/';
        $.ajax({
            type: 'POST',
            url: baseUrl + 'admin/upload.php?image_source=1',
            data: sourceString,
            contentType: 'application/json',
            success: (res) => {
                console.log({res});
                if (!res.name) {
                    alert('Lỗi tải lên hình ảnh!');
                    return;
                }

                src = res.name;
                if ($(target + ' .img-result img').length > 0) {
                    $(target + ' .img-result img').attr('src', baseUrl + 'img_data/images/' + src).attr('data-original-title', '');
                } else {
                    $(target + ' .img-result').append('<img src="' + baseUrl + 'img_data/images/' + src + '" style="max-height:150px;"/>');
                }

                $(target + ' .input-clipboard').val(src);
            },
            dataType: 'json'
        });
    }

    function urlToImage(e) {
        const target = e.target.dataset.result;
        const url = e.target.value;
        console.log('url', url);
        if (!url || url.trim().length === 0 || url.indexOf('http') !== 0) {
            return;
        }

        const baseUrl = AppConfig && AppConfig.fileBaseUrl ? AppConfig.fileBaseUrl : '/';
        $.ajax({
            type: 'GET',
            url: baseUrl + 'admin/api.php?func=url_to_image',
            data: { url },
            contentType: 'application/json',
            success: (res) => {
                if (!res.result) {
                    alert('Lỗi tải lên hình ảnh!');
                    return;
                }

                src = res.result;
                if ($(target + ' .img-result img').length > 0) {
                    $(target + ' .img-result img').attr('src', baseUrl + 'img_data/images/' + src).attr('data-original-title', '');
                } else {
                    $(target + ' .img-result').append('<img src="' + baseUrl + 'img_data/images/' + src + '" style="max-height:150px;"/>');
                }

                $(target + ' .input-clipboard').val(src);
                e.target.value = '';
            },
            dataType: 'json'
        });
    }
</script>
<script src="<?= URLPATH ?>templates/extra/slick/slick.js"></script>
<script src="/templates/js/home.js"></script>