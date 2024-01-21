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
    $id = intval($_POST['changeImageProductId']);
    if (!$id) {
        echo json_encode(['success' => false]);
        exit();
    }
    
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
        if (!$d->update($data)) {
            // HANDLE ERROR HERE
        }
    }

    for ($i = 1; $i <= 30; $i++) {
        $upload = false;
        if (isset($_POST['txt_up_' . $i]) && $_POST['txt_up_' . $i] == 1) {
            $file_name = $d->fns_Rand_digit(0, 9, 12);

            if (!empty($_POST['file_clipboard_' . $i])) {
                $upload = trim($_POST['file_clipboard_' . $i]);
                $data_hinh['image_path'] = $upload;
                $data_hinh['title'] = $_REQUEST['title' . $i];
                $data_hinh['id_sp'] = $id;
                $d->reset();
                $d->setTable('#_sanpham_hinhanh');
                $d->insert($data_hinh);
            }
            if (!$upload && !empty($_POST['file_url_' . $i])) {
                if ($upload = uploadImageFromUrl($_POST['file_url_' . $i])) {
                    $data_hinh['image_path'] = $upload;
                    $data_hinh['title'] = $_REQUEST['title' . $i];
                    $data_hinh['id_sp'] = $id;
                    $d->reset();
                    $d->setTable('#_sanpham_hinhanh');
                    $d->insert($data_hinh);
                }
            }
            if (!$upload && @$file = $d->upload_image("file_" . $i, '', '../img_data/images/', $file_name)) {
                $data_hinh['image_path'] = $file;
                $data_hinh['title'] = $_REQUEST['title' . $i];
                $data_hinh['id_sp'] = $id;
                $d->reset();
                $d->setTable('#_sanpham_hinhanh');
                $d->insert($data_hinh);
            }
        }
    }

    echo json_encode(['success' => true]);
    exit();
}
