<?php //print_r($item);die();?>
<?php
$brand_name = '';
if( $item['brand_id'] ){
    $brand_name = $d->getBrandById($item['brand_id']);
}
?>

<tr class="product-small-list">
    
    <td>
        <div class="excerpt">
            <a href="<?= URLPATH . $item['alias_' . $lang] ?>.html" title="<?= $item['name_' . $lang] ?>" target="_blank">
                <strong>
                    <?php echo $item['name_' . $_SESSION['lang']]; ?>
                </strong>
            </a>
        </div>

        <?php if($item['brand_id']){?>
        <div class="visible-xs small text-muted">
            Thương hiệu: <?php echo $brand_name; ?>
        </div>
        <?php }?>

        <?php if($item['model']){?>
        <div class="visible-xs small text-muted">
            Model: <?php echo $item['model']; ?>
        </div>
        <?php }?>
        
        <?php if($item['specification']){?>
        <div class="visible-xs small text-muted">
            Quy cách: <?php echo $item['specification']; ?>
        </div>
        <?php }?>

        <?php if($item['part_number']){?>
        <div class="visible-xs small text-muted txt-2line">
            Part Number: <?php echo $item['part_number']; ?>
        </div>
        <?php }?>

    </td>
    
    
    <td class="hidden-xs">
        <div class="excerpt">
            <?php echo $brand_name['name']; ?>
        </div>
    </td>

    <td class="hidden-xs">
        <div class="excerpt">
            <?php echo $item['model']; ?>
        </div>
    </td>

    <td class="hidden-xs">
        <div class="excerpt">
            <?php echo $item['specification']; ?>
        </div>
    </td>

    <td class="hidden-xs">
        <div class="txt-2line"><?php echo $item['part_number']; ?></div>
    </td>

    <td class="hidden-xs txt-inline">
        <?php
        $discountPercent = 0;
        if ($item['promotion_price'] < $item['price'] && $item['promotion_price'] > 0) {
            $discountPercent = intval(100 - ($item['promotion_price'] / $item['price'] * 100));
        }
        ?>
        <?php if ($item['promotion_price'] > 0) { ?>
            <span class="price-km mr-1"><?= $d->vnd($item['promotion_price']) ?></span>
            <span class="price old-price"><i><small><?= ($item['price'] > 0) ? $d->vnd($item['price']) : _lienhe; ?></small></i></span>
        <?php } else { ?>
            <span><?php echo ($item['price'] > 0) ? $d->vnd($item['price']) : _lienhe; ?></span>
        <?php } ?>
        <?php if ($discountPercent > 0): ?>
            <span class="fd-discount" style="float: right">- <?php echo $discountPercent; ?>%</span>
        <?php endif; ?>
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
            <?php
                $discountPercent = 0;
                if ($item['promotion_price'] < $item['price'] && $item['promotion_price'] > 0) {
                    $discountPercent = intval(100 - ($item['promotion_price'] / $item['price'] * 100));
                }
            ?>
                Giá:
                <?php if ($item['promotion_price'] > 0) { ?>
                    <span class="price-km mr-1"><?php echo $d->vnd($item['promotion_price']); ?></span>
                    <span class="price old-price"><i><small><?php echo ($item['price'] > 0) ? $d->vnd($item['price']) : _lienhe; ?></small></i></span>
                <?php } else { ?>
                    <span><?php echo ($item['price'] > 0) ? $d->vnd($item['price']) : _lienhe; ?></span>
                <?php } ?>
                <?php if ($discountPercent > 0): ?>
                    <span class="fd-discount">- <?php echo $discountPercent; ?>%</span>
                <?php endif; ?>
           
        </div>

    </td>
</tr>