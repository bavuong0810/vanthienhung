<?php

function updateProduct()
{
    global $d;
    $data = json_decode(file_get_contents('php://input'), true);
    if (empty($data) || empty($data['id']) || empty($data['update'])) {
        echo json_encode([
            'success' => false,
            'message' => 'Không đủ thông tin để cập nhật sản phẩm!',
        ]);

        return;
    }

    $d->reset();
    $d->setTable('#_sanpham');
    $d->setWhere('id', $data['id']);
    $result = $d->update($data['update']);

    echo json_encode([
        'success' => $result,
    ]);
}

function getParentProducts()
{
    global $d;
    $data = [
        'term' => trim(!empty($_GET['term']) ? $_GET['term'] : ''),
        'page' => isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0 ? intval($_GET['page']) : 0,
    ];

    $limit = 30;
    $offset = 0;
    if ($data['page'] > 0) {
        $offset = ($data['page'] - 1) * $limit;
    }
    $where = '';
    if (!empty($data['term'])) {
        $where = " AND (parent_number LIKE '%{$data['term']}%' OR name_vi LIKE '%{$data['term']}%')";
    }

    $d->reset();
    $parents = $d->o_fet("
        SELECT CONCAT(parent_number, ' - ', name_vi) as text, parent_number as id
        FROM #_sanpham
        WHERE
            product_type = " . ProductConfigs::TYPE_PRODUCT_GROUP . "
            " . $where . "
        ORDER BY name_vi ASC, parent_number DESC
        LIMIT $offset, $limit
        ");
    $totalResult = $d->simple_fetch("
        SELECT COUNT(id) as total
        FROM #_sanpham
        WHERE
            product_type = " . ProductConfigs::TYPE_PRODUCT_GROUP . "
            " . $where . "
        ORDER BY name_vi ASC, parent_number DESC
        ");

    echo json_encode([
        'results' => $parents,
        'pagination' => [
            'more' => $data['page'] * 30 < $totalResult['total'],
        ],
        'total' => intval($totalResult['total']),
    ]);
}

function getBrands()
{
    global $d;
    $data = [
        'term' => trim(!empty($_GET['term']) ? $_GET['term'] : ''),
        'page' => isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0 ? intval($_GET['page']) : 0,
    ];

    $limit = 30;
    $offset = 0;
    if ($data['page'] > 0) {
        $offset = ($data['page'] - 1) * $limit;
    }
    $where = '';
    if (!empty($data['term'])) {
        $where = "WHERE name LIKE '%{$data['term']}%'";
    }

    $d->reset();
    $parents = $d->o_fet("
        SELECT CONCAT(id, ' - ', name) as text, id
        FROM #_brand
        " . $where . "
        ORDER BY name ASC
        LIMIT $offset, $limit
        ");
    $totalResult = $d->simple_fetch("
        SELECT COUNT(id) as total
        FROM #_brand
        " . $where);

    echo json_encode([
        'results' => $parents,
        'pagination' => [
            'more' => $data['page'] * 30 < $totalResult['total'],
        ],
        'total' => intval($totalResult['total']),
    ]);
}

function bulk_update_images()
{
    global $d;
    $payload = getRequestJSON();

    if (empty($payload['ids']) || !is_array($payload['ids']) || count($payload['ids']) === 0) {
        return [
            'isSuccess' => false,
            'message' => 'Bạn chưa chọn sản phẩm nào',
        ];
    }

    if (empty($payload['thumbPath']) && empty($payload['slides'])) {
        return [
            'isSuccess' => false,
            'message' => 'Không có thông tin cập nhật, vui lòng tải ảnh lên để cập nhật',
        ];
    }

    $ids = $payload['ids'];
    $idsStr = implode($payload['ids']);

    $dataUpdate = [
        'updated_at' => date('Y-m-d H-i-s', time()),
        'image_path' => trim($payload['thumbPath']),
    ];
    $d->reset();
    $d->setTable('#_sanpham');
    $d->setWhereRaw("id IN({$idsStr})");
    if (!$d->update($dataUpdate)) {
        return [
            'isSuccess' => false,
            'message' => 'Không thể cập nhật dữ liệu',
        ];
    }

    // Insert slide image records
    $slides = empty($payload['slides']) ? [] : $payload['slides'];
    // TODO: BULK INSERT
    foreach ($ids as $id) {
        foreach ($slides as $slide) {
            $slideData = [
                'id_sp' => $id,
                'image_path' => $slide['path'],
                'title' => $slide['title'],
            ];
            $d->reset();
            $d->setTable('#_sanpham_hinhanh');
            $d->insert($slideData);
        }
    }

    return [
        'isSuccess' => true,
        'data' => $dataUpdate,
    ];
}

function cloneProduct()
{
    global $d;

    $id = (int) $_GET['id'];

    $additionalFields = ['product_type'];
    if ($_GET['isClonePartNumber'] == "true") {
        $additionalFields[] = 'part_number';
    }

    $fieldHinhAnh = '';
    $valueHinhAnh = '';
    if ($_GET['isCloneImages'] == "true") {
        $sps = $d->o_fet("select * from #_sanpham where id = '" . $id . "'");

        foreach ($sps as $sp) {
            $newName = time() . '_' . $sp['image_path'];
            @copy("../img_data/images/" . $sp['image_path'], "../img_data/images/" . $newName);
        }

        $fieldHinhAnh = ', `image_path`';
        $valueHinhAnh = ', "' . $newName . '"';
    }

    if (count($additionalFields) > 0) {
        $additionalFields = ', ' . implode(', ', $additionalFields);
    } else {
        $additionalFields = '';
    }

    //$sql = "INSERT INTO `#_sanpham`(`category_id`, `alias_vi`, `alias_en`, `alias_ch`, `code_2`, `code_3`, `name_vi`, `name_en`, `name_ch`, `description_vi`, `description_en`, `description_ch`, `price`, `promotion_price`, `description_2`, `content_en`, `content_ch`, `ngay_dang`, `is_hot`, `sp_moi`, `sp_hot`, `title_vi`, `title_en`, `title_ch`, `keyword`, `des`, `view`, `thanh_pho`, `quan`, `hien_thi`, `gear_type`, `group_pos`, `parent_number`, `group_quantity`, `extra4`, `extra5`, `extra6`, `extra7`, `extra8`, `extra9`, `extra10`, `con_hang`, `so_thu_tu`, `style`, `specification`, `model`, `brand_id`, `loai`, `weight`, `nang_cao`, `khung_nang`, `mfg_year`, `gio_su_dung`, `xuat_xu`, `tinh_trang_hang`, `banh_sau`, `chieu_dai_cang`, `nang_thap_nhat`, `mat_ban`, `chieu_rong`, `bao_hanh`, `cong_suat`, `ti_so_truyen`, `nguon_dien`, `kieu_dang`, `unit` " . $additionalFields . " " . $fieldHinhAnh . " ) SELECT `category_id`, `alias_vi`, `alias_en`, `alias_ch`, `code_2`, `code_3`, `name_vi`, `name_en`, `name_ch`, `description_vi`, `description_en`, `description_ch`, `price`, `promotion_price`, `description_2`, `content_en`, `content_ch`, `ngay_dang`, `is_hot`, `sp_moi`, `sp_hot`, `title_vi`, `title_en`, `title_ch`, `keyword`, `des`, `view`, `thanh_pho`, `quan`, `hien_thi`, `gear_type`, `group_pos`, `parent_number`, `group_quantity`, `extra4`, `extra5`, `extra6`, `extra7`, `extra8`, `extra9`, `extra10`, `con_hang`, `so_thu_tu`, `style`, `specification`, `model`, `brand_id`, `loai`, `weight`, `nang_cao`, `khung_nang`, `mfg_year`, `gio_su_dung`, `xuat_xu`, `tinh_trang_hang`, `banh_sau`, `chieu_dai_cang`, `nang_thap_nhat`, `mat_ban`, `chieu_rong`, `bao_hanh`, `cong_suat`, `ti_so_truyen`, `nguon_dien`, `kieu_dang`, `unit` " . $additionalFields . " " . $valueHinhAnh . " FROM `#_sanpham` WHERE `id` = $id";
    $sql = "INSERT INTO `#_sanpham`(`category_id`, `alias_vi`, `alias_en`, `alias_ch`, `code_2`, `name_vi`, `name_en`, `name_ch`, `description_vi`, `description_en`, `description_ch`, `price`, `promotion_price`, `description_2`, `content_en`, `content_ch`, `ngay_dang`, `is_hot`, `sp_moi`, `sp_hot`, `title_vi`, `title_en`, `title_ch`, `keyword`, `des`, `view`, `hien_thi`, `group_pos`, `parent_number`, `group_quantity`, `con_hang`, `so_thu_tu`, `style`, `specification`, `model`, `brand_id`, `loai`, `weight`, `khung_nang`, `mfg_year`, `xuat_xu`, `tinh_trang_hang`, `bao_hanh`, `unit` " . $additionalFields . " " . $fieldHinhAnh . " ) SELECT `category_id`, `alias_vi`, `alias_en`, `alias_ch`, `code_2`, `name_vi`, `name_en`, `name_ch`, `description_vi`, `description_en`, `description_ch`, `price`, `promotion_price`, `description_2`, `content_en`, `content_ch`, `ngay_dang`, `is_hot`, `sp_moi`, `sp_hot`, `title_vi`, `title_en`, `title_ch`, `keyword`, `des`, `view`, `hien_thi`, `group_pos`, `parent_number`, `group_quantity`, `con_hang`, `so_thu_tu`, `style`, `specification`, `model`, `brand_id`, `loai`, `weight`, `khung_nang`, `mfg_year`, `xuat_xu`, `tinh_trang_hang`, `bao_hanh`, `unit` " . $additionalFields . " " . $valueHinhAnh . " FROM `#_sanpham` WHERE `id` = $id";
    $result = $d->query($sql);
    if ($result) {
        $newId = (int)$d->db->lastInsertId();
        $sql = "UPDATE `#_sanpham` SET `code` = 'VTH$newId', `alias_vi` = CONCAT(`alias_vi`, '-', '$newId'), `alias_en` = CONCAT(`alias_en`, '-', '$newId'), `alias_ch` = CONCAT(`alias_ch`, '-', '$newId') WHERE `id` = $newId";
        $d->query($sql);

        if ($_GET['isCloneImages'] == "true") {
            $images = $d->o_fet("select * from #_sanpham_hinhanh where id_sp = '" . $id . "'");

            foreach ($images as $image) {
                $newName = $newId . '_' . $image['image_path'];
                @copy("../img_data/images/" . $image['image_path'], "../img_data/images/" . $newName);

                $imageData['image_path'] = $newName;
                $imageData['title'] = $image['title'];
                $imageData['id_sp'] = $newId;

                $d->reset();
                $d->setTable('#_sanpham_hinhanh');
                $d->insert($imageData);
            }
        }
    }

    header('Content-type: application/json');
    echo json_encode(array('isSuccess' => $result, 'id' => $newId));
}

function getProductSlideImage()
{
    global $d;
    $id = $_GET['productId'];

    $hinhanh_chitiet = $d->o_fet("select * from #_sanpham_hinhanh where id_sp = '" . $id . "'");

    foreach ($hinhanh_chitiet as $k => $hact) {
        echo '
		<a href="' . FILEURL . '/img_data/images/' . $hact['image_path'] . '" id="slide_' . $k . '" link="' . FILEURL . '/img_data/images/' . $hact['image_path'] . '" data-lightbox="lightbox"></a>
		';
    }
}

function checkPartNumber()
{
    global $d;
    header('Content-type: application/json');

    $productId = isset($_POST['productId']) ? $_POST['productId'] : 0;
    $productId = $d->clear(addslashes($productId));
    $partNumber = $d->clear(addslashes($_POST['partNumber']));

    $result = $d->o_fet("SELECT id FROM `#_sanpham` WHERE `id` <> $productId AND `part_number` LIKE '%$partNumber%'");
    // $result['query'] = "SELECT COUNT(`id`) as `count` FROM `#_sanpham` WHERE `id` <> $productId AND `part_number` = '$partNumber'";

    echo json_encode($result);
}

function getIdsIncludesString()
{
    global $d;
    header('Content-type: application/json');

    $productId = isset($_REQUEST['productId']) ? $_REQUEST['productId'] : 0;
    $productId = $d->clear(addslashes($productId));
    $name = $d->clear(addslashes($_REQUEST['name']));
    $value = $d->clear(addslashes($_REQUEST['value']));

    switch ($name) {
        case 'parent_number':
            $productType = ProductConfigs::TYPE_PRODUCT_GROUP;
            $query = "SELECT id FROM `#_sanpham` WHERE `id` <> $productId AND `{$name}` = $value AND product_type = {$productType}";
            $result = $d->o_fet($query);
            break;

        default:
            $result = $d->o_fet("SELECT id FROM `#_sanpham` WHERE `id` <> $productId AND `$name` LIKE '%$value%'");
            break;
    }

    echo json_encode($result);
}
