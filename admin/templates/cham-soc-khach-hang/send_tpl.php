<link rel="stylesheet" type="text/css" href="/admin/assets/bootstrap-select-1.12.4/css/bootstrap-select.min.css">
<?php @include "sources/editor.php" ?>
<ol class="breadcrumb">
    <li><a href="."><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
    <li class="active"><a href="index.php?p=cham-soc-khach-hang&a=man">Chăm sóc khách hàng</a></li>
    <li class="active"><a href="#">Gửi thư mới</a></li>
</ol>
<div class="col-xs-12">
    <form name="frm" method="post" id="edit_form"
          action="index.php?p=cham-soc-khach-hang&a=send&id=<?= @$_REQUEST['id'] ?>&page=<?= @$_REQUEST['page'] ?>"
          enctype="multipart/form-data">
        <div class="bs-example bs-example-tabs">
            <!-- //lang viet -->
            <table class="table table-bordered table-hover them_dt" style="border:none">
                <tbody>
                <tr>
                    <td class="td_left">
                        Người nhận:
                    </td>
                    <td class="td_right">
                        <select name="customer_ids[]" class="input form-control selectpicker"
                                multiple data-live-search="true" required>
                            <?php
                            foreach ($customers as $customer) {
                                echo '<option value="' . $customer['id'] . '"' . ($_GET['id'] && $_GET['id'] == $customer['id'] ? 'selected' : '') . '>' . $customer['name_vi'] . ' | ' . $customer['email'] . ' | ' . $customer['so_dien_thoai'] . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="td_left">
                        Tiêu đề:
                    </td>
                    <td class="td_right">
                        <input class="input width400 form-control" type="text" name="title"
                               value="<?php echo @$items[0]['title'] ?>"/>
                    </td>
                </tr>
                <tr>
                    <td class="td_left">
                        Nội dung:
                    </td>
                    <td class="td_right">
                        <textarea name="message" id="messagge"><?= @$items[0]['content_vi'] ?></textarea>
                        <?php $ckeditor->replace('message'); ?>
                    </td>
                </tr>
                <tr>
                    <td class="td_left">
                        Đính kèm:
                    </td>
                    <td class="td_right">
                        <input type="file" name="attachments[]" id="attachments" placeholder="Chọn 1 hoặc nhiều đính kèm của bạn" multiple />
                    </td>
                </tr>
                <tr>
                    <td class="td_left" style="text-align:right">
                        <input type="submit" value="Gửi" class="btn btn-primary"/>
                    </td>
                    <td class="td_right">
                        <input type="button" value="Thoát"
                               onclick="javascript:window.location='index.php?p=cham-soc-khach-hang&a=man'"
                               class="btn btn-primary"/>
                    </td>
                </tr>
                </tbody>
            </table>
            <!-- end -->
        </div>

    </form>
</div>
<script type="text/javascript" src="/admin/assets/bootstrap-select-1.12.4/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="/admin/assets/bootstrap-select-1.12.4/js/i18n/defaults-vi_VN.min.js"></script>
<script type="text/javascript">
    function showLoading() {
        swal({
            title: 'Sending...',
            html: '<svg style="animation: swal2-rotate-loading 1.5s linear 0s infinite normal" viewBox="0 0 140 140" width="140" height="140"><g class="outline"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="rgba(0,0,0,0.1)" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round"></path></g><g class="circle"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="#71BBFF" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-dashoffset="200" stroke-dasharray="300"></path></g></svg>',
            showConfirmButton: false,
            allowOutsideClick: false
        });
    }
    $(document).ready(function() {
        $('#edit_form').on('submit', function(e){
            e.preventDefault();
            showLoading();
            $('#messagge').val(CKEDITOR.instances.messagge.getData());
            const formData = new FormData(e.target);
            $.ajax(e.target.action, {
                method: 'POST',
                dataType: 'json',
                data: formData,
                contentType: false,
                processData: false,
                success: function (res) {
                    if (!res.isSuccess) {
                        swal('Có lỗi xảy ra, vui lòng thử lại!', res.error, 'error');
                        return;
                    }
                    swal({
                        title: 'Gửi thành công!',
                        type: 'success',
                        onClose: () => {
                            window.location = 'index.php?p=cham-soc-khach-hang&a=view&id=' + res.messageId;
                        },
                    });
                },
                error: function (xhr, textStatus, error) {
                    swal('Có lỗi xảy ra, vui lòng thử lại!', error, 'warning');
                }
            });
        });
    });
</script>