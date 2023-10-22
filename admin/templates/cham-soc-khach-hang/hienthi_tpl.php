<ol class="breadcrumb sticky-left">
    <li><a href="."><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
    <li class="active"><a href=".">Hiển thị</a></li>
    <li class="active"><a href="#">Liên hệ</a></li>
</ol>
<div class="col-xs-12 sticky-left">
    <div class="form-group tac-vu">
        <div class="btn-group">
            <select id="action" name="action" onclick="form_submit(this)" class="form-control">
                <option selected>Tác vụ</option>
                <option value="delete">Xóa</option>
            </select>
        </div>
        <div class="btn-group">
            <input id="search" name="search" type="text" class="form-control" placeholder="Tìm kiếm"/>
        </div>
        <div class="btn-group">
            <select id="action" onchange="searchByColumn(this,'cham-soc-khach-hang')" name="action" class="form-control">
                <option value="" selected>Tìm theo</option>
                <option value="id">ID</option>
                <option value="ho_ten">Tên</option>
                <option value="email">Email</option>
                <option value="sdt">Số điện thoại</option>
            </select>
        </div>
        <div class="btn-group">
            <?php $hienthi = $_GET['hienthi']; ?>
            <select id="action" onchange="show(this,'cham-soc-khach-hang')" name="action" class="form-control">
                <option value="0" <?php echo empty($hienthi) ? 'selected' : '' ?>>Số hiển thị</option>
                <option value="1" <?php echo $hienthi == 1 ? 'selected' : '' ?>>15</option>
                <option value="2" <?php echo $hienthi == 2 ? 'selected' : '' ?>>25</option>
                <option value="3" <?php echo $hienthi == 3 ? 'selected' : '' ?>>50</option>
                <option value="4" <?php echo $hienthi == 4 ? 'selected' : '' ?>>75</option>
                <option value="5" <?php echo $hienthi == 5 ? 'selected' : '' ?>>100</option>
                <option value="6" <?php echo $hienthi == 6 ? 'selected' : '' ?>>200</option>
                <option value="7" <?php echo $hienthi == 7 ? 'selected' : '' ?>>300</option>
            </select>
        </div>
        <a href="index.php?p=cham-soc-khach-hang&a=send-new" class="btn btn-success">Gửi thư mới</a>
    </div>
</div>
<div class="col-xs-12">
    <form id="form" method="post" action="index.php?p=cham-soc-khach-hang&a=delete_all" role="form">
        <table class="table table-bordered table-hover" style="width: 100%; min-width: 950px;">
            <thead>
            <tr>
                <th style="width:2%"><input type="checkbox" name="chk" value="0" class="checkall chk_box"
                                            id="check_all"></th>
                <th style="width:2%">STT</th>
                <th style="width:20%">Tiêu đề</th>
                <th style="width:10%">Người nhận</th>
                <th style="width:4%">Đính kèm</th>
                <th style="width:8%">Ngày gửi</th>
                <th style="width:8%">Tác vụ</th>
            </tr>
            </thead>
            <tbody>
            <?php $count = count($items);
            for ($i = 0; $i < $count; $i++) { ?>
                <tr>
                    <td>
                        <input type="checkbox" class="chk_box" name="chk_child[]" value="<?= $items[$i]['id'] ?>">
                    </td>
                    <td><?= ($i + 1 + ($page - 1) * $maxR) ?></td>
                    <td>
                        <?= $items[$i]['title'] ?>
                    </td>
                    <td>
                        <?= $items[$i]['email'] ?>
                        <?php
                        if ($items[$i]['email_count'] > 1) {
                            echo '<span class="label label-primary">+ ' . ($items[$i]['email_count'] - 1) . '</span>';
                        }
                        ?>
                    </td>
                    <td>
                        <?= $items[$i]['attachment_count'] ?>
                    </td>
                    <td>
                        <?= $items[$i]['created_at'] ?>
                    </td>
                    <td align="center">
                        <a href="index.php?p=cham-soc-khach-hang&a=view&id=<?= $items[$i]['id'] ?>&page=<?= @$_REQUEST['page']; ?>">
                            <i class="glyphicon glyphicon-eye-open"></i>
                        </a>
                        <a href="index.php?p=cham-soc-khach-hang&a=send-new&id=<?=$items[$i]['customer_id']?>" class="text-success mx-3">
                            <i class="glyphicon glyphicon-comment"></i>
                        </a>
                        <!--<a href="index.php?p=cham-soc-khach-hang&a=delete&id=<?/*= $items[$i]['id'] */?>&page=<?/*= @$_GET['page'] */?>"
                           onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i
                                    class="glyphicon glyphicon-remove"></i></a>-->
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </form>
</div>
<div class="pagination">
    <?php echo @$paging['paging'] ?>
</div>