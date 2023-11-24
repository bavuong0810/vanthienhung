<?php
$view_san_pham =  $d->getOption('view_san_pham');
$detailNeedShow = [
    'brand_id' => 'Nhãn hiệu',
    'model' => 'Model',
    //'code' => 'Mã sản phẩm',
    'part_number' => 'Part number',
    'specification' => 'Quy cách',
    'loai' => 'Loại Động cơ',
    'weight' => 'Trọng lượng (kg)',
    'mfg_year' => 'Năm sản xuất',
    'khung_nang' => 'Khung nâng (m)',
    'bao_hanh' => 'Bảo hành',
    'tinh_trang_hang' => 'Tình trạng',
    'xuat_xu' => 'Xuất xứ',
    'group_quantity' => 'Số lượng',
    'group_pos' => 'Vị trí',
];
$table = false;
if (!empty($_COOKIE['productLayout'])
    && ($_COOKIE['productLayout'] == 'list' || $_COOKIE['productLayout'] == 'small_list' || $_COOKIE['productLayout'] == 'grid')) {
        if ($_COOKIE['productLayout'] == 'small_list') {
            $table = true;
        }
} else if ($view_san_pham == 'small_list') {
    $table = true;
}
?>

<?php if ($table): ?>
<table class="table table-striped bg-white">
    <thead>
    <tr>
        <th style="width: 350px;">Tên</th>
        <th class="hidden-xs txt-inline" style="width: 170px;">Thương hiệu</th>
        <th class="hidden-xs txt-inline" style="width: 140px;">Model</th>
        <th class="hidden-xs txt-inline" style="width: 160px;">Quy cách</th>
        <th class="hidden-xs" style="width: 200px;">Part Number</th>
        <th class="hidden-xs" style="width: 200px;">Giá</th>
        <th class="hidden-xs" style="width: 200px;">Liên hệ</th>
        <th style="width: 110px;">Order</th>
    </tr>
    </thead>
    <tbody>
<?php endif; ?>

    <?php
    foreach ($sanpham as $item) {

        if (empty($item['image_path'])) {
            $image_file_name = '';
            $item['image_path'] = $d->getDefaultProductImage(300, 220);

        } else {
            $image_file_name = $item['image_path'];
            $item['image_path'] = THUMB_BASE . 'images/300/220/' . $item['id'] . '/' . $item['image_path'];
        }

        // Custom name
        $item['name_' . $_SESSION['lang']] = getCustomProductName($item);

        if (!empty($_COOKIE['productLayout'])
            && ($_COOKIE['productLayout'] == 'list' || $_COOKIE['productLayout'] == 'small_list' || $_COOKIE['productLayout'] == 'grid')) {
            if ($_COOKIE['productLayout'] == 'list') {
                include 'ct_product_list.php';
            } else if ($_COOKIE['productLayout'] == 'small_list') {
                include 'ct_product_small_list.php';
            } else {
                include 'ct_product_grid.php';
            }
        } else {
            if ($view_san_pham == 'list') {
                include 'ct_product_list.php';
            } else if ($view_san_pham == 'small_list') {
                include 'ct_product_small_list.php';
            } else {
                include 'ct_product_grid.php';
            }
        }
    }
?>
<?php if ($table): ?>
    </tbody>
</table>
<?php endif; ?>

<script type="text/javascript">
    $(document).ready(function($) {
        $('.cart-quantity-input .minus-one').on('click', function () {
            let product_id = $(this).data('product');
            let quantity = $('#quantity_' + product_id).val();
            quantity = parseInt(quantity);
            if (quantity > 1) {
                $('#quantity_' + product_id).val(quantity - 1);
            }

            let data = {
                func: 'updateRequestPriceCart',
            };

            let error = (res) => {
                console.log('Fail to reload request price cart content.')
            };

            const success = (res) => {
                $('#request-price-cart-content').html(res);
            };

            $.ajax({
                url: '/api.php',
                method: 'POST',
                data,
                success,
                error,
            });
        });

        $('.cart-quantity-input .add-one').on('click', function () {
            let product_id = $(this).data('product');
            let quantity = $('#quantity_' + product_id).val();
            quantity = parseInt(quantity);
            $('#quantity_' + product_id).val(quantity + 1);

            let data = {
                func: 'updateRequestPriceCart',
            };

            let error = (res) => {
                console.log('Fail to reload request price cart content.')
            };

            const success = (res) => {
                $('#request-price-cart-content').html(res);
            };

            $.ajax({
                url: '/api.php',
                method: 'POST',
                data,
                success,
                error,
            });
        });

        $('.detail-button-wrap .addToCart').click(function(e) {
            const id = $(this).data('product');
            //const soluong = $('#numberOfProduct').val();
            const soluong = 1;

            const data = {
                id,
                soluong,
                func: 'addToCart',
            };

            const success = (res) => {
                /*
                $('#modalBackdrop').removeClass('hidden').animate({
                    opacity: 0.3
                }, 500);
                $(this).effect("transfer", {
                    to: "#cart",
                    className: "add-to-cart-effect"
                }, 500, () => $('#modalBackdrop').animate({
                    display: "block !important",
                    opacity: 0.3
                }, 500).addClass('hidden'));
                */

                updateProductInCart();
            };

            const error = (res) => {
                alert('Thêm sản phẩm vào giỏ hàng không thành công, vui lòng thử lại!');
            };

            $.ajax({
                url: '/api.php',
                method: 'POST',
                data,
                success,
                error,
            });

        });
    });
</script>
