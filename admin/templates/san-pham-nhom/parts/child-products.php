<?php
if (!empty($items[0]['parent_number']) && is_numeric($items[0]['parent_number'])) {
    $query = "SELECT `id`, `name_vi`, `group_pos`, `group_quantity`, `part_number`, `code` from `#_sanpham` WHERE `product_type` = " . ProductConfigs::TYPE_PRODUCT . " AND `parent_number` = {$items[0]['parent_number']} ORDER BY `group_pos` ASC";
    $inGroupProducts = $d->o_fet($query);
}
if (!empty($inGroupProducts) && count($inGroupProducts) > 0) {

?>
    <h3>Sản phẩm con:</h3>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="60">Vị trí</th>
                <th>Mã SP</th>
                <th>Tên</th>
                <th width="100">Số lượng</th>
                <th width="150">Part number</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($inGroupProducts as $key => $product) {
            ?>
                <tr>
                    <td class="table-input">
                        <input type="number" class="form-control update-on-blur" data-name="group_pos" data-id="<?php echo $product['id']; ?>" value="<?php echo $product['group_pos']; ?>">
                    </td>
                    <td><?php echo $product['code']; ?></td>
                    <td><?php echo $product['name_vi']; ?></td>
                    <td class="table-input">
                        <input type="number" class="form-control update-on-blur" data-name="group_quantity" data-id="<?php echo $product['id']; ?>" value="<?php echo $product['group_quantity']; ?>">
                    </td>
                    <td><?php echo $product['part_number']; ?></td>
                    <th>
                        <a target="_blank" title="Sửa" href="index.php?p=san-pham&a=edit&id=<?php echo $product['id'] ?>">
                            <button type="button" class="btn btn-default">
                                <i class="glyphicon glyphicon-edit text-primary"></i>
                            </button>
                        </a>
                        |
                        <button type="button" class="btn btn-default remove-child-row" data-id="<?php echo $product['id'] ?>">
                            <i class="glyphicon glyphicon-trash text-danger"></i>
                        </button>
                    </th>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
<?php
}
?>

<script>
    function updateOnBlur(e) {
        const input = e.target;
        const value = input.value.trim();
        const {
            name,
            id
        } = input.dataset;

        const data = {
            id,
            update: {
                [name]: value,
            }
        };

        $.ajax({
            method: 'POST',
            url: '/admin/api.php?func=updateProduct',
            contentType: 'application/json',
            dataType: 'json',
            data: JSON.stringify(data),
        }).then(
            (result) => {
                if (!result || !result.success) {
                    swal(result.message || 'Có lỗi xảy ra khi cập nhật dữ liệu!', '', 'warning');
                    return;
                }
            },
            (error) => {
                console.log('update product error', error, data);
                swal('Có lỗi xảy ra khi cập nhật dữ liệu, vui lòng thử lại', '', 'warning');
            },
        );
    }

    function confirmRemoveRow(e) {
        e.preventDefault();

        swal({
            title: 'Bạn chắc chắn muốn xóa sản phẩm con khỏi danh sách?',
            type: 'question',
            showCancelButton: true,
            preConfirm: () => {
                removeChildRow(e);
            },
        });
    }

    function removeChildRow(e) {
        const id = e.target.dataset.id;
        if (!id) {
            swal('Không xác định được sản phẩm', '', 'warning');
            return;
        }

        const data = {
            id,
            update: {
                group_pos: null,
                parent_number: null,
                group_quantity: null,
            },
        };

        swal('Vui lòng chờ', '', 'info');
        Swal.showLoading();

        return $.ajax({
            method: 'POST',
            url: '/admin/api.php?func=updateProduct',
            contentType: 'application/json',
            dataType: 'json',
            data: JSON.stringify(data),
        }).then(
            (result) => {
                if (!result || !result.success) {
                    swal(result.message || 'Có lỗi xảy ra khi cập nhật dữ liệu!', '', 'warning');
                    return;
                }
                swal('Xóa thành công!', '', 'success');
                $(e.target).closest('tr').fadeOut();
            },
            (error) => {
                console.log('update product error', error, data);
                swal('Có lỗi xảy ra khi cập nhật dữ liệu, vui lòng thử lại', '', 'warning');
            },
        );
    }

    $(document).ready(function() {
        $('.update-on-blur').on('blur', updateOnBlur);
        $('.remove-child-row').on('click', confirmRemoveRow);
    });
</script>
