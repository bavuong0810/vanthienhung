<div class="row">
    <div class="col-md-12">
        <h3 class="mt-0">Thêm sản phẩm mới</h3>
    </div>
    <div class="col-md-6">
        <div class="jumbotron">
            <div class="form-group">
                <label for="add_new_code">Mã sản phẩm <i class="text-danger">*</i></label>
                <input type="text" id="add_new_code" placeholder="Nhập mã sản phẩm" class="form-control" />
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="add_new_pos">Vị trí <i class="text-danger">*</i></label>
                        <input type="number" id="add_new_pos" placeholder="Vị trí" class="form-control" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="add_new_quantity">Số lượng <i class="text-danger">*</i></label>
                        <input type="number" id="add_new_quantity" placeholder="Số lượng" class="form-control" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="button" id="btn_add_new_child" class="btn btn-primary">
                    Thêm
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    const $addNewCode = $('#add_new_code');
    const $addNewQuantity = $('#add_new_quantity');
    const $addNewPos = $('#add_new_pos');

    function getAddNewData() {
        const code = $addNewCode.val();
        const quantity = $addNewQuantity.val();
        const pos = $addNewPos.val();
        const parentId = <?php echo @$items[0]['parent_number'] ?: 0 ?>;
        
        if (!parentId) {
            swal('Vui lòng điền vào số ID nhóm của sản phẩm hiện tại và lưu lại trước khi thêm sản phẩm con!', '', 'info');
            return false;
        }

        if (!code || !quantity || !pos) {
            swal('Vui lòng nhập đủ mã sản phẩm, vị trí và số lượng!', '', 'info');
            return false;
        }

        return {
            code,
            quantity,
            pos,
            parentId,
        };
    }

    function addProductByCode(isConfirmed = false) {
        const data = getAddNewData();
        if (!data) {
            return;
        }
        data.isConfirmed = isConfirmed;

        swal('Vui lòng chờ', '', 'info');
        Swal.showLoading();

        $.ajax({
            method: 'POST',
            url: '/admin/api.php?func=productGroupAddChild',
            data: new URLSearchParams(data).toString(),
            dataType: 'json',
        }).then(
            (result) => {
                console.log('result', result);

                if (!result) {
                    swal('Có lỗi xảy ra, vui lòng thử lại!1', 'Lỗi không xác định...', 'warning');
                    return;
                }

                if (result.needConfirm) {
                    swal({
                        title: result.message || 'Vui lòng xác nhận',
                        showCancelButton: true,
                        preConfirm: () => {
                            addProductByCode(true);
                        },
                        type: 'question',
                    });
                    return;
                }

                if (!result.success) {
                    swal(result.message || 'Có lỗi xảy ra, vui lòng thử lại!', '', 'warning');
                    return;
                }

                swal({
                    title: 'Thêm thành công!',
                    type: 'success',
                    preConfirm: () => {
                        location.reload();
                    },
                });
            },
            (error) => {
                console.log('error', error);
                swal('Có lỗi xảy ra, vui lòng thử lại!2', error.message, 'warning');
            });
    }
    $(document).ready(function() {
        $('#btn_add_new_child').click(e => {
            e.preventDefault();
            addProductByCode();
        });
    });
</script>