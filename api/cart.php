<?php
/*
 * Author: MinhTranFU@gmail.com
 * Date: Friday, June 1, 2018
 * Description: All api related to cart operation
 */

function addToCart() {
    global $d;

    $id = $_POST['id'];
    $soluong = isset($_POST['soluong'])?$_POST['soluong']:1;
    $soluong = (int)$soluong;
    $color = addslashes(@$_POST['color']);
    $size = addslashes(@$_POST['size']);
    $detail = $d->simple_fetch("select * from #_sanpham where id={$id}");
    if(!empty($detail)){
        $id_pro = $detail['id'];
        if(isset($_SESSION['cart'][$id_pro])){
            $_SESSION['cart'][$id_pro]['so_luong'] = $_SESSION['cart'][$id_pro]['so_luong'] + $soluong;
            $_SESSION['cart'][$id_pro]['mau'] =  $color;
            $_SESSION['cart'][$id_pro]['size'] =  $size;
        }
        else{
            $_SESSION['cart'][$id_pro]['so_luong'] = $soluong;
            $_SESSION['cart'][$id_pro]['mau'] =  $color;
            $_SESSION['cart'][$id_pro]['size'] =  $size;
        }
        echo json_encode(array('isSuccess' => true));
    } else {
        echo json_encode(array('isSuccess' => false, 'message' => 'Product not found!'));
    }
}

function getCart() {
    $cart = @$_SESSION['cart'] ?: array();

    echo json_encode($cart);
}

function change_address() {
    global $d;
    if (!$_POST['id'] || empty($_POST['id'])) {
        unset($_SESSION['delivery_area']);
        echo json_encode(array('isSuccess' => true, 'delivery_area' => null));
        return;
    }

    $id = intval($_POST['id']);

    $delivery_area = $d->simple_fetch("select * from #_delivery_area where id={$id}");
    if(empty($delivery_area)){
        echo json_encode(array('isSuccess' => false, 'message' => 'Area not found!'));
        return;
    }

    $_SESSION['delivery_area'] = $delivery_area;

    echo json_encode(array('isSuccess' => true, 'delivery_area' => $delivery_area));
    return;
}

function get_area_by_name() {
    global $d;
    if (!$_POST['name'] || empty($_POST['name'])) {
        unset($_SESSION['delivery_area']);
        echo json_encode(array('isSuccess' => true, 'delivery_area' => null));
        return;
    }

    $name = $d->clean($_POST['name']);

    $delivery_area = $d->simple_fetch("select * from #_delivery_area where name='{$name}'");
    if(empty($delivery_area)){
        echo json_encode(array('isSuccess' => false, 'message' => 'Area not found!'));
        return;
    }

    $_SESSION['delivery_area'] = $delivery_area;

    echo json_encode(array('isSuccess' => true, 'delivery_area' => $delivery_area));
    return;
}

function updateRequestPriceCart() {
    global $d;
    $stt = 0;
    $cartTable = '';
    if (count($_SESSION['cart']) > 0) {
        foreach ($_SESSION['cart'] as $key => $value) {
            $product = $d->simple_fetch("select * from #_sanpham where id={$key}");
            $product['name_' . $_SESSION['lang']] = getCustomProductName($product);

            if (!empty($product)) {
                $stt++;
                $cartTable .= '
                    <tr>
                        <td>' . $stt . '</td>
                        <td>
                            <img onerror="this.src=\'' . $d->getDefaultProductImage() . '\';" 
                            src="' . THUMB_BASE . 'images/50/50/' . @$product['id'] . '/' . @$product['image_path'] . '" width="50" height="50">
                        </td>
                        <td class="text-left">' . @$product['name_' . $_SESSION['lang']] . '</td>
                        <td>' . $value['so_luong'] . '</td>
                    </tr>
                ';
            }
        }

        $cartTable = '<table class="table table-hover table-bordered ">
            <thead>
                <tr>
                    <th>STT</th>
                    <th align="left">Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th align="center" class="th_soluong">Số lượng</th>
                </tr>
            </thead>
            <tbody>
            ' . $cartTable . '
            </tbody>
        </table>
        ';
    }
    return $cartTable;
}

