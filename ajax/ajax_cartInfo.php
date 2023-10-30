<?php 
if (!isset($_SESSION)) {
    session_start();
}

define('_lib', '../admin/lib/');
@include _lib . "config.php";
@include_once _lib . "function.php";

global $d;
global $lang;
$d = new func_index($config['database']);

$SETTINGS = $d->getAllSettings();

if (isset($_SESSION['cart'])) {

$stt = 0;
$deliveryFee = 0;
$tongtien = 0;
$cartProducts = [];
$sumQuantity = 0;
$canPayOnline = false;
$cartTable = '';

ob_start();

if (count($_SESSION['cart']) > 0) {
    $canPayOnline = true;
    foreach ($_SESSION['cart'] as $key => $value) {
        //$product = $d->simple_fetch("select `id`, `category_id`, `alias_vi`, `alias_en`, `alias_ch`, `code`, `code_2`, `code_3`, `name_vi`, `name_en`, `name_ch`, `description_vi`, `description_en`, `description_ch`, `image_path`, `price`, `promotion_price`, `ngay_dang`, `is_hot`, `sp_moi`, `sp_hot`, `title_vi`, `title_en`, `title_ch`, `keyword`, `des`, `view`, `thanh_pho`, `quan`, `hien_thi`, `gear_type`, `group_pos`, `group_quantity`, `group_quantity`, `extra4`, `extra5`, `extra6`, `extra7`, `extra8`, `extra9`, `extra10`, `con_hang`, `so_thu_tu`, `style`, `specification`, `model`, `brand`, `loai`, `weight`, `nang_cao`, `khung_nang`, `mfg_year`, `gio_su_dung`, `xuat_xu`, `part_number`, `tinh_trang_hang`, `banh_sau`, `chieu_dai_cang`, `nang_thap_nhat`, `mat_ban`, `chieu_rong`, `bao_hanh`, `is_completed`, `cong_suat`, `ti_so_truyen`, `nguon_dien`, `kieu_dang`, `name_json` from #_sanpham where id={$key}");
        $product = $d->simple_fetch("select * from #_sanpham where id={$key}");
        $product['name_' . $_SESSION['lang']] = getCustomProductName($product);

        $cartProducts[] = $product;
        if (!empty($product)) {
            $id_product = $product['id'];
            $price = $product['price'];
            if ($product['promotion_price'] > 0) {
                $price = $product['promotion_price'];
            }

            // check online payment is available
            if ($price == 0) {
                $canPayOnline = false;
            }

            if (!is_string($deliveryFee) && !empty($product['weight']) && $product['weight'] !== 0 && !empty($_SESSION['delivery_area']['price'])) {
                $fee = $product['weight'] * $value['so_luong'] * $_SESSION['delivery_area']['price'];
                $deliveryFee += $fee;
                $tongtien += $fee;
            } else {
                $deliveryFee = 'Thông báo sau!';
            }

            $sumQuantity += $value['so_luong'];
            $tongtien += $price * $value['so_luong'];
            $stt++;

            $cartTable .= '
                <tr>
                    <td>
                        <img onerror="this.src=\'' . URLPATH . 'templates/error/error.jpg\';" src="' . URLPATH . 'thumb.php?src=' . URLPATH . 'img_data/images/' . @$product['image_path'] . '&w=50&h=50" width="50" height="50">
                    </td>
                    <td class="text-left">' . @$product['name_' . $_SESSION['lang']] . '</td>
                    <td>' . $value['so_luong'] . '</td>
                </tr>
            ';
?>
            <tr>
                <td>
                    <a href="<?= URLPATH . $product['alias_' . $_SESSION['lang']] ?>.html">
                        <?= @$product['name_' . $_SESSION['lang']] ?>
                    </a>
                </td>

                <td align="left"><strong><?= @$d->vnd($price) ?></strong></td>

                <td align="center">
                    <!-- <input name="soluong" style="width: 50px;" type="number" value="<?= $value['so_luong'] ?>" onchange="chang_soluong(this,'<?= $product['id'] ?>','<?= $_SESSION['iddonhang'] ?>')" class="text-center soluong_<?= $value['soluong'] ?>"> -->
                    <span class="input-group quantity-input cart-quantity-input">
                        <span class="input-group-btn">
                            <button class="btn minus-one" data-product="<?= $product['id'] ?>">
                                <i class="fa fa-minus"></i>
                            </button>
                        </span>
                        <input type="number" name="soluong" value="<?= $value['so_luong'] ?>" min="1" step="1" onchange="chang_soluong(this,'<?= $product['id'] ?>','<?= $_SESSION['iddonhang'] ?>')" class="form-control text-center soluong_<?= $value['soluong'] ?>">
                        <span class="input-group-btn">
                            <button class="btn add-one" data-product="<?= $product['id'] ?>">
                                <i class="fa fa-plus"></i>
                            </button>
                        </span>
                    </span>
                </td>

                <td align="left">
                    <div id="thanhtien_117" class="thanhtien_<?= $val['id'] ?> color-main">
                        <?php echo $d->vnd($price * $value['so_luong']); ?>
                    </div>
                </td>

                <td align="center">
                    <a class="xoa_sp_gh_dh" data-product="<?= $product['id'] ?>" data-cart-item="<?= $_SESSION['iddonhang'] ?>" data-confirm="Xác nhận xóa?" href="javascript:void(0)" title="Xóa sản phẩm"><i class="fa fa-trash-o"></i></a>
                </td>
            </tr>
<?php
        }
    }
}

$tableContent = ob_get_clean();
?>

<div class="info-cart info-cart-overlay">
  
    <div class="table-responsive">
        <table class="table table-hover table-bordered ">
            <tbody>
                <tr>
                    <th style="width:28%;" class="">Tên sản phẩm</th>
                    <th style="width:15%; text-align: center;">Giá</th>
                    <th style="width:10%;" class="th_soluong">Số lượng</th>
                    <th style="width:15%;">Thành tiền</th>
                    <th style="width:10%; text-align: center;">Xóa</th>
                </tr>
                <?php echo $tableContent; ?>
                <tr>
                    <td colspan="5" style="color:#4cae4c">Phí vận chuyển: <span id="delivery_fee"><?php echo is_string($deliveryFee) ? $deliveryFee : $d->vnd($deliveryFee); ?></span></td>
                </tr>
                <tr>
                    <td colspan="3">Tổng tiền</td>
                    <td colspan="2" style="border-left: 0;">
                        <div class="tong_tt">
                            <h3 class="text-center">
                                <font id="tong_tien_gh" class="color-main"><?= $d->vnd($tongtien) ?></font>
                            </h3>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php }?>

<?php
$vat_content = $d->getTemplates(72);
$lang = $_SESSION['lang'];
if ($vat_content['content_' . $lang] != ''):
?>
    <hr style="margin: 5px 0;">
    <div class="cart-vat">
        <?php if ($vat_content['name_' . $lang] != ''): ?>
            <div class="title-main">
                <h3><?= $vat_content['name_' . $lang]; ?></h3>
            </div>
        <?php endif; ?>
        <div class="cart-vat-content">
            <?= $vat_content['content_' . $lang] ?>
        </div>
    </div>
<?php endif; ?>

<!-- Thanh toan -->

<div class="dathang-pay">
    <div class="form-group">
        <div class="col-sm-9">
            <input type="text" class="form-control" id="voucher" name="voucher" placeholder="Mã giảm giá">
        </div>
        <div class="col-sm-3">
            <button type="button" class="btn btn-primary" id="add-voucher">Thêm</button>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-12">
            <input type="checkbox" value="1" name="company_order" class="company_order" id="company_order">
            <label for="company_order">Xuất hóa đơn công ty</label>
        </div>
    </div>
    <div class="company-order-wrap">
        <div class="form-group">
            <div class="col-sm-12">
                <input class="form-control" type="text" name="company_name" placeholder="Tên công ty">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <input class="form-control" type="text" name="company_vat" placeholder="Mã số thuế">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <input class="form-control" type="text" name="company_address" placeholder="Địa chỉ công ty">
            </div>
        </div>
    </div>

    <div class="title-form text-uppercase">Thanh toán</div>

    <div class="form-group">
        <div class="col-sm-12">
            <?php
            $view_vnpay_payment =  $d->getOption('view_vnpay_payment');
            if($view_vnpay_payment){
            ?>
            <div class="payment-method <?php echo !$canPayOnline ? 'disabled-method' : '' ?>">
                <input id="thanhtoan_vnpay" type="radio" name="thanhtoan" value="6" class="magic-radio" <?php echo $canPayOnline ? 'checked' : 'disabled'; ?>>
                <label for="thanhtoan_vnpay">
                    <img src="/templates/images/logo-vnpay-qr.png" height="33" />
                    Thanh toán trực tuyến qua VNPAY
                </label>
            </div>
            <?php }?>

            <div class="payment-method 1111">
                <input id="thanhtoan_ck" type="radio" name="thanhtoan" value="2" class="magic-radio" <?php echo !$canPayOnline ? 'checked' : '' ?>>
                <label for="thanhtoan_ck">
                    <img src="/templates/images/icon-bank.png" height="33" />
                    Chuyển khoản
                </label>
                <?php 
                $bank_account = $SETTINGS['bank_account']['value'];
                if( $bank_account ){
                ?>
                <div class="bank-account payment-description"><?php echo $bank_account?></div>
                <?php }?>
            </div>

            <div class="payment-method">
                <input id="thanhtoan_cod" type="radio" name="thanhtoan" value="1" class="magic-radio">
                <label for="thanhtoan_cod">
                    <img src="/templates/images/icon-cod.png" height="50">
                    Thanh toán khi nhận hàng
                </label>
            </div>
        </div>
    </div>

    <div class="form-group btn-placeorder-wrap">
        <div class="col-sm-12">
            <button type="submit" id="popup" class="btn-placeorder button button--aylen button--pd button--size-m" name="guidonhang">
                Đặt hàng
            </button>
        </div>
    </div>
</div>