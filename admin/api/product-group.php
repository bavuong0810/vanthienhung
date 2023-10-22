<?php

function productGroupAddChild()
{
    global $d;

    $parentId = intval($_REQUEST['parentId']);
    $code = $d->clean(trim($_REQUEST['code']));
    $position = intval($_REQUEST['pos']);
    $quantity = intval($_REQUEST['quantity']);
    $isConfirmed = !empty($_REQUEST['isConfirmed']) && $_REQUEST['isConfirmed'] == 'true';
    if (empty($parentId)) {
        echo json_encode([
            'success' => false,
            'message' => 'Không tìm thấy sản phẩm nhóm!',
        ]);
        return;
    }
    if (empty($code) || empty($position) || empty($quantity)) {
        echo json_encode([
            'success' => false,
            'message' => 'Vui lòng nhập đầy đủ mã sản phẩm, thứ tự, số lượng',
        ]);
        return;
    }

    $product = $d->simple_fetch("SELECT id, name_en, part_number, parent_number AS parent_id FROM `#_sanpham` WHERE code = '{$code}' LIMIT 1");
    if (!$product) {
        echo json_encode([
            'success' => false,
            'message' => 'Không tìm thấy sản phẩm',
        ]);
        return;
    }

    if (!$isConfirmed && !empty($product['parent_id'])) {
        if ($product['parent_id'] == $parentId) {
            echo json_encode([
                'success' => false,
                'message' => 'Sản phẩm đã thuộc nhóm hiện tại!',
            ]);
            return;
        }

        echo json_encode([
            'success' => false,
            'needConfirm' => true,
            'type' => 'in_other_product_group',
            'message' => 'Sản phẩm đang thuộc 1 nhóm khác. Bạn có muốn thay đổi?',
            'current_parent_id' => $product['parent_id'],
        ]);
        return;
    }

    $d->reset();
    $d->setTable('#_sanpham');
    $d->setWhere('id', $product['id']);
    $result = $d->update([
        'group_pos' => $position,
        'group_quantity' => $quantity,
        'parent_number' => $parentId,
    ]);

    if ($result) {
        $product['parentId'] = $parentId;
    }

    echo json_encode([
        'success' => $result,
        'product' => $product,
    ]);
}
