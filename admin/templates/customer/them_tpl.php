<?php
@include "sources/editor.php";

// Prepare data
$item = ['hien_thi' => 1];
if ($_GET['a'] == 'edit') {
    $item = $items[0];
} else if ($_POST['submit']) {
    $item = $_POST;
}

?>
<ol class="breadcrumb">
    <li><a href="<?= urladmin ?>"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
    <li class="active"><a href="<?= urladmin ?>index.php?p=customer&a=man">Khách hàng</a></li>
    <li class="active"><a href="#"><?php if (isset($_GET['id'])) echo "Sửa "; else echo "Thêm mới" ?></a></li>
</ol>
<div class="col-xs-12">
    <form name="frm" method="post"
          action="index.php?p=customer&a=save&id=<?= @$_REQUEST['id'] ?>&page=<?= @$_REQUEST['page'] ?>"
          enctype="multipart/form-data">
        <div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
            <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in" id="id_viet" aria-labelledby="home-tab">
                    <table class="table table-bordered table-hover them_dt" style="border:none">
                        <tbody>
                        <tr>
                            <td class="td_left">
                                Tên:
                            </td>
                            <td class="td_right">
                                <input
                                    type="text"
                                    class="input width400 form-control"
                                    id="ho_ten" name="ho_ten"
                                    value="<?php echo @$item['ho_ten']; ?>"
                                />
                            </td>
                        </tr>
                        <tr>
                            <td class="td_left">
                                Số điện thoại:
                            </td>
                            <td class="td_right">
                                <input
                                    type="text"
                                    class="input width400 form-control"
                                    id="so_dien_thoai" name="so_dien_thoai"
                                    value="<?php echo @$item['so_dien_thoai']; ?>"
                                />
                            </td>
                        </tr>
                        <tr>
                            <td class="td_left">
                                Email:
                            </td>
                            <td class="td_right">
                                <input
                                    type="text"
                                    class="input width400 form-control"
                                    id="email" name="email"
                                    value="<?php echo @$item['email']; ?>"
                                />
                            </td>
                        </tr>
                        <tr>
                            <td class="td_left">
                                Địa chỉ:
                            </td>
                            <td class="td_right">
                                <input
                                    type="text"
                                    class="input width400 form-control"
                                    id="dia_chi" name="dia_chi"
                                    value="<?php echo @$item['dia_chi']; ?>"
                                />
                            </td>
                        </tr>
                        <tr>
                            <td class="td_left">
                                Tùy chọn:
                            </td>
                            <td class="td_right">
                                <label>
                                    <input
                                        type="checkbox"
                                        id="hien_thi" name="hien_thi"
                                        value="1"
                                        <?php echo $item['hien_thi']  ? 'checked' : ''; ?>
                                    />
                                    Hiển thị
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="td_left" style="text-align:right">
                                <input type="submit" name="submit" value="Lưu" class="btn btn-primary"/>
                            </td>
                            <td class="td_right">
                                <input type="button" value="Thoát"
                                       onclick="javascript:window.location='index.php?p=customer&a=man'"
                                       class="btn btn-default"/>
                                <?php if ($item['id']): ?>
                                    <a href="index.php?p=customer&a=delete&id=<?= $item['id'] ?>&page=<?= @$_GET['page'] ?>"
                                       onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger ml-4"
                                       title="Xóa">Xóa</a>
                                <?php endif ?>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <!-- end -->
                </div>
            </div>
        </div>
    </form>
</div>