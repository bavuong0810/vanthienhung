<?php
    $images = $d->o_fet("select * from #_sanpham_hinhanh where id_sp = '".@$item['id']."' AND `hien_thi` = 1 order by id desc");
    $length = count($images);

    $img_baogia = empty($item['image_path']) ? $d->getDefaultProductImage() : $item['image_path'];
?>
<div class="product-row col-sm-12">
    <div class="row bg-white">
        <div class="col-md-3">

            <div class="product-slide-wrap">

                <div class="prod-slider-main prod-slider-main-<?=$item['id'] ?>">
                    <div class="prod-main-thumb">
                        <?php if (@$_SESSION['is_admin']) { ?>
                            <a data-id="<?php echo $item['id']; ?>" data-image="<?= $image_file_name ?>" href="#" title="Xóa ảnh" class="btn btn-circle btn-del-img text-center btn-danger" style="
                                position: absolute;
                                z-index: 2;
                                left: 5px;
                            "><i class="fa fa-close" style="width: 20px;height: 20px;line-height: 20px;"></i></a>
                        <?php } ?>
                        <a class="img-shine-2" href="<?=URLPATH.$item['alias_'.$lang] ?>.html" title="<?=$item['name_'.$lang] ?>">
                            <img alt="<?=$item['name_' . $lang]?>" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAWCAQAAAB9auREAAAAGklEQVR42mP8X89ANmAc1TyqeVTzqOaRqhkAD/0g67N/o4cAAAAASUVORK5CYII=" class="lazy" data-src="<?=$item['image_path'] ?>" onerror="this.src='<?= $d->getDefaultProductImage(300, 220) ?>';">
                        </a>
                    </div>
                </div>

                <?php if($length){?>
                <div class="slider prod-slider-nav">
                    <?php foreach ($images as $key => $image): ?>
                        <div class="item prod-slider-nav-item" data-id="<?=$item['id'] ?>">
                            <img src="<?=THUMB_BASE ?>images/300/220/<?=$item['id'] ?>/<?=$image['image_path'] ?>" alt="<?php echo $item['name_' . $lang]; ?>" onerror="this.src='<?= $d->getDefaultProductImage(300, 220) ?>';">
                        </div>
                    <?php endforeach ?>
                </div>
                <?php } //end $length?>
       
            </div><!--.product-slide-wrap-->
        </div>

        <div class="col-md-6">
            <h3 class="m-0 mb-1">
                <a href="<?=URLPATH.$item['alias_'.$lang] ?>.html" title="<?=$item['name_'.$lang] ?>">
                    <?=$item['name_'.$lang] ?>
                </a>
            </h3>
            
            <div class="row">
                <?php
                $count = 0;
                $attributes = (!empty($item['name_json']))?$item['name_json']:array();

                foreach ($detailNeedShow as $key => $name):
                    if (empty($item[$key])) {
                        continue;
                    }
                    /*
                    if ($count++ == 16) {
                        break;
                    }*/

                    if( $key == 'brand_id' ){
                        $val = $d->getBrandById($item[$key]);
                        $val = $val['name'];
                    } else {
                        $val = $item[$key];
                    }

                    if( $key == 'brand_id' ){
                        $key = 'brand';
                    }//check to get brand title

                    //$title = $name;
                    //$val = $item[$key];
                    $title = $name;
                    if($attributes[$key.'_title']){
                        $title = $attributes[$key.'_title'];
                    }
                ?>
                    <div class="col-sm-6 detail-row">
                        <span class="text-muted"><?php echo $title; ?>:</span> <?php echo $val; ?>
                    </div>
                <?php endforeach ?>
            </div>
        </div>

        <div class="col-md-3" style="display: flex; flex-direction: column; justify-content: space-between;">
            <?php if (@$_SESSION['is_admin']) { ?>
                <a href="/admin/index.php?p=san-pham&a=edit&id=<?php echo $item['id']; ?>" title="Chỉnh sửa sản phẩm" class="btn btn-circle text-center btn-success" style="
                    position: absolute;
                    z-index: 2;
                    right: 5px;
                "><i class="fa fa-pencil" style="width: 20px;height: 20px;line-height: 20px;"></i></a>
            <?php } ?>
            <div class="price-home">
                <?php if($item['promotion_price'] > 0){ ?>
                    <span class="price-km mr-1"><?= $d->vnd($item['promotion_price']) ?></span>
                    <span class="price 'old-price"><i><small><?=($item['price']>0) ? $d->vnd($item['price']) :  _lienhe;?></small></i></span>
                <?php } else { ?>
                    <span class="price"><?=($item['price']>0) ? $d->vnd($item['price']) :  _lienhe;?></span>
                <?php } ?>
                
                <?php echo '/' . ($item['unit'] ?: 'Cái'); ?>

                <?php if (!empty($item['updated_at'])) { ?>
                    <div><span class="text-muted">Cập nhật lúc:</span> <?php echo date('d-m-Y', strtotime($item['updated_at'])) ?></div>
                <?php } ?>
            </div>

            <?php
            $view_print_price_request = $d->getOption('view_print_price_request');
            $view_add_to_cart =  $d->getOption('view_add_to_cart');
            $view_request_price =  $d->getOption('view_request_price');
            $view_small_button_placeorder = $d->getOption('view_small_button_placeorder');
            $view_btn_contact =  $d->getOption('view_btn_contact');
            $view_shipping_content =  $d->getOption('view_shipping_content');
            $view_return_content =  $d->getOption('view_return_content');
            $view_button_checkorder =  $d->getOption('view_button_checkorder');
            $view_button_warrantyonline =  $d->getOption('view_button_warrantyonline');
            $view_button_placeorder = $d->getOption('view_button_placeorder');
            ?>
            <div class="dong-lon-buttons">
                <?php if ($view_add_to_cart): ?>
                <a href="javascript:void(0)" type="button" class="dl-btn btn btn-success btn-flat mr-1 addToCart" id="addToCart" data-product="<?= $item['id'] ?>" data-title="<?= $item['name_' . $lang] ?>" data-price="<?= $item['price'] ?>" data-detail="true">
                    Thêm vào giỏ
                </a>
                <?php endif ?>

                <?php if ($view_request_price): ?>
                <button id="product_detail_price_request" type="button" class="dl-btn btn btn-danger mr-1 addcart" data-product="<?= $item['id'] ?>" data-code="<?= $item['code']; ?>" data-image="<?= $img_baogia ?>" data-title="<?= $item['name_' . $lang] ?>" data-price="<?= $item['price'] ?>" data-detail="true">
                    Yêu cầu báo giá
                </button>
                <?php endif; ?>

                <?php if( $view_button_checkorder || $view_button_warrantyonline ) { $vbtn2 = ( $view_button_checkorder && $view_button_warrantyonline ) ? 2 : 1;?>
                    <?php if($view_button_checkorder){?>
                        <a href="javascript:void(0)" class="dl-btn dl-btn-inline btn btn-flat btn-blue btn-checkorder" data-toggle="modal" data-target="#checkorderModal">
                            Kiểm tra đơn hàng
                        </a>
                    <?php }?>

                    <?php if($view_button_warrantyonline){?>
                        <a href="javascript:void(0)" class="dl-btn dl-btn-inline btn btn-flat btn-blue btn-warrantyonline" data-toggle="modal" data-target="#warrantyonlineModal">
                            Bảo hành online
                        </a>
                    <?php }?>
                <?php }?>

                <?php if($view_btn_contact != ''){?>
                    <a class="dl-btn-inline dl-btn btn btn-sendmail btn-product-contact btn-flat" href="javascript:void(0)"
                       data-toggle="modal" data-target="#sendEmailModal">Liên hệ</a>
                <?php }?>

                <?php if ($view_print_price_request): ?>
                <a class="dl-btn-inline" href="/in-bao-gia-san-pham.php?pid=<?php echo $item['id'] ?>" title="In báo giá" target="_blank">
                    <button type="button" class="dl-btn btn btn-danger btn-flat print-price">
                        In báo giá
                    </button>
                </a>
                <?php endif; ?>

                <a class="dl-btn-inline dl-btn btn-default btn" href="<?=URLPATH.$item['alias_'.$lang] ?>.html" title="<?=$item['name_'.$lang] ?>">
                    Chi tiết
                </a>

                <?php if ($view_button_placeorder && !$view_small_button_placeorder): ?>
                    <a href="javascript:void(0)" type="button" class="dl-btn btn btn-dathang btn-dathang-sm btn-flat addToCart" id="addToCart" data-product="<?= $item['id'] ?>" data-title="<?= $item['name_' . $lang] ?>" data-price="<?= $item['price'] ?>" data-detail="true">
                        Đặt hàng
                    </a>
                <?php endif ?>
            </div>

        </div>
    </div>
</div>