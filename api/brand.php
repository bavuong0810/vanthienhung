<?php

function changeBrandLogo()
{
    global $d;

    if (!@$_SESSION['is_admin']) {
      exit();
    }

    $id = intval($_POST['changeImageProductId']);
    if (!$id) {
        echo json_encode(['success' => false]);
        exit();
    }
    
    $data = [];
    if (!empty($_POST['file2_clipboard'])) {
        $data['image'] = $_POST['file2_clipboard'];
    }

    if (!empty($_POST['product_title'])) {
        $data['name'] = $_POST['product_title'];
    }

    $d->reset();
    $d->setTable('#_brand');
    $d->setWhere('id', $id);
    if (count($data)) {
        if (!$d->update($data)) {
            echo json_encode(['success' => false]);
            exit();
        }
    }

    echo json_encode(['success' => true]);
    exit();
}
