<tr class="product-small-list">
    
    <td>
        <a href="<?= URLPATH . $item['alias_' . $lang] ?>.html" title="<?= $item['name_' . $lang] ?>" target="_blank">
            <strong>
                <?php echo $item['name_' . $_SESSION['lang']]; ?>
            </strong>
        </a>

        <?php if($item['brand']){?>
        <div class="visible-xs small text-muted">
            Thương hiệu: <?php echo $item['brand']; ?>
        </div>
        <?php }?>
        
        <?php if($item['tinh_trang_hang']){?>
        <div class="visible-xs small text-muted">
            Tình trạng: <?php echo $item['tinh_trang_hang']; ?>
        </div>
        <?php }?>

        <?php if($item['xuat_xu']){?>
        <div class="visible-xs small text-muted">
            Xuất sứ: <?php echo $item['xuat_xu']; ?>
        </div>
        <?php }?>

    </td>

    <td class="hidden-xs"><?php echo $item['brand']; ?></td>

    <td class="hidden-xs"><?php echo $item['loai']; ?></td>

    <td class="hidden-xs"><?php echo $item['specification']; ?></td>

    <td class="hidden-xs txt-inline"><?php echo $item['tinh_trang_hang']; ?></td>

    <td class="hidden-xs txt-inline"><?php echo $item['xuat_xu']; ?></td>

    <td class="hidden-xs txt-inline">
        <?php if ($item['promotion_price'] > 0) { ?>
            <span class="price-km mr-1"><?= $d->vnd($item['promotion_price']) ?></span>
            <span class="price old-price"><i><small><?= ($item['price'] > 0) ? $d->vnd($item['price']) : _lienhe; ?></small></i></span>
        <?php } else { ?>
            <span><?php echo ($item['price'] > 0) ? $d->vnd($item['price']) : _lienhe; ?></span>
        <?php } ?>
    </td>
    
    <td>
        <div class="input-group btn-group txt-flex">
            <input value="1" type="number" min="1" class="form-control input-quantity" />
            <button type="button" class="btn btn-primary action-add-to-cart" data-id="<?php echo $item['id']; ?>">
                <i class="glyphicon glyphicon-shopping-cart"></i>
            </button>
        </div>
        
        <!--
        <div class="input-group btn-group visible-xs txt-flex">
            <input value="1" type="number" min="1" class="form-control input-sm input-quantity" />
            <button type="button" class="btn btn-primary btn-sm action-add-to-cart" data-id="<?php echo $item['id']; ?>">
                <i class="glyphicon glyphicon-shopping-cart"></i>
            </button>
        </div>-->

        <div class="visible-xs small text-muted" style="padding-top: 8px;color: #4cae4c;">
            
                Giá:
                <?php if ($item['promotion_price'] > 0) { ?>
                    <span class="price-km mr-1"><?php echo $d->vnd($item['promotion_price']); ?></span>
                    <span class="price old-price"><i><small><?php echo ($item['price'] > 0) ? $d->vnd($item['price']) : _lienhe; ?></small></i></span>
                <?php } else { ?>
                    <span><?php echo ($item['price'] > 0) ? $d->vnd($item['price']) : _lienhe; ?></span>
                <?php } ?>
           
        </div>

    </td>
</tr>