<?php 
$view_chi_tiet_san_pham = $d->getOption('view_chi_tiet_san_pham');

if( $view_chi_tiet_san_pham ){
?>
<div class="thong_tin mb-2">
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#thong_tin_2" aria-controls="thong_tin_2" role="tab" data-toggle="tab"><?= _pro_detail ?></a></li>
    </ul>
    <div class="tab-content">

        <div role="tabpanel" class="tab-pane fade in active" id="thong_tin_2">
            
            <div class="row10 clearfix">
                
                <div class="col-md-12">
                    <?php
                    $isShowPrice = true;
                    $item = $ctsp;
                    include 'ct_tooltip.php';
                    $isShowPrice = false;
                    echo $title;
                    ?>
                </div>

            </div>

            <div class="clearfix mb15"></div>
            
            <?php if( $view_product_detail_below ){?>
            <div class="product-detail-below">
                <?= $ctsp['description_' . $_SESSION['lang']] ?>
            </div>
            <?php }?>
        </div>
    </div>   
</div>
<?php }?>