<?php
function product_get_by_ids()
{
  global $d;
  $idsStr = empty($_GET['ids']) ? '' : $_GET['ids'];
  $productIds = preg_replace('/[^\d,]/', '', $idsStr);
  $products = $d->o_fet_class("SELECT id, code, name_vi, alias_vi, image_path, price, promotion_price FROM PREFIX_sanpham WHERE id IN ($productIds)");
  echo json_encode($products);
}

function changeProductThumb()
{
    global $d;
    $id = $_POST['changeImageProductId'];
    if ($id > 0) {
        $data = [];
        if (!empty($_POST['file2_clipboard'])) {
            $data['image_path'] = $_POST['file2_clipboard'];
        }

        if (!empty($_POST['product_title'])) {
            $data['name_vi'] = $_POST['product_title'];
        }

        $d->reset();
        $d->setTable('#_sanpham');
        $d->setWhere('id', $id);
        if (count($data)) {
            if ($d->update($data)) {
                echo json_encode(['success' => true]);
                exit();
            }
        }
    }
    echo json_encode(['success' => false]);
    exit();
}
