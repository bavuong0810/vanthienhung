<?php

// $inGroupProducts = [];
// $parentProduct = [];
// if ($item['product_type'] == ProductConfigs::TYPE_PRODUCT_GROUP) {
//     $parentProduct = $item;
// }
// if (!empty($item['parent_number']) && is_numeric($item['parent_number'])) {
//     if ($item['product_type'] == ProductConfigs::TYPE_PRODUCT) {
//         $parentProduct = $d->simple_fetch(
//             'SELECT `id`, `name_en`, `name_vi`, `name_ch`, `alias_vi`, `alias_en`, `alias_ch`, `image_path` from `#_sanpham` WHERE `hien_thi` = 1 AND `product_type` = ' .
//                 ProductConfigs::TYPE_PRODUCT_GROUP .
//                 " AND `parent_number` = {$item['parent_number']} ORDER BY `group_pos` ASC LIMIT 1"
//         );
//     }
//     $inGroupProducts = $d->o_fet(
//         'SELECT `id`, `name_en`, `name_vi`, `name_ch`, `alias_vi`, `alias_en`, `alias_ch`, `group_pos`, `parent_number`, `part_number`, `group_quantity` from `#_sanpham` WHERE `hien_thi` = 1 AND `product_type` = ' .
//             ProductConfigs::TYPE_PRODUCT .
//             " AND `parent_number` = {$item['parent_number']} ORDER BY CAST(`group_pos` AS unsigned) ASC LIMIT 100"
//     );
// }
if (!empty($inGroupProducts) && count($inGroupProducts) > 0) { ?>
    <?php if (
        $item['product_type'] == ProductConfigs::TYPE_PRODUCT &&
        !empty($parentProduct['image_path'])
    ) : ?>
        <a target="_blank" href="<?= $parentProduct['alias_' . $lang] ?>.html" title="<?php echo $parentProduct['name_' . $_SESSION['lang']]; ?>">
            <img alt="<?php echo $parentProduct['name_' . $_SESSION['lang']]; ?>" onerror="this.src='<?= URLPATH ?>templates/error/error.jpg';" src="<?= FILEURL ?>images/600/450/<?= $parentProduct['id'] ?>/<?= $parentProduct['image_path'] ?>?zc=2" />
        </a>
    <?php endif; ?>
    <h3>Thành phần thuộc nhóm
        <?php if (!empty($parentProduct)) { ?>
            <a target="_blank" href="<?= $parentProduct['alias_' . $lang] ?>.html" title="<?php echo @$parentProduct['name_' . $_SESSION['lang']]; ?>">
                <?php echo @$parentProduct['name_vi'] ?:
                    $parentProduct['name_en']; ?>
            </a>
        <?php } ?>
    </h3>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="60">Vị trí</th>
                <th>Tên</th>
                <th width="100">Số lượng</th>
                <th width="300">Quy cách</th>
                <th width="200">Part number</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($inGroupProducts as $key => $product) { ?>
                <tr>
                    <td><?php echo $product['group_pos']; ?></td>
                    <td>
                        <a target="_blank" href="<?php echo $product['alias_' . $lang]; ?>.html" title="<?php echo @$product['name_' . $_SESSION['lang']]; ?>">
                            <?php echo @$product['name_vi'] ?:
                                @$product['name_en']; ?>
                        </a>
                    </td>
                    <td><?php echo @$product['group_quantity']; ?></td>
                    <td>
                        <div class="txt-2line"><?php echo @$product['specification']; ?></div>
                    </td>
                    <td><?php echo @$product['part_number']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php }
