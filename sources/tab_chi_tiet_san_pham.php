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

            <?php
            if (!empty($ctsp['category_id'])) {
                $whereCatIds = "AND (category_id = " . $ctsp['category_id'];
                $cat = $d->simple_fetch('SELECT category_id FROM #_category WHERE id=' . $ctsp['category_id']);
                if (!empty($cat['category_id'])) {
                    $catId = $cat['category_id'];
                    $whereCatIds .= " OR category_id = " . $catId;
                    while (!empty($catId)) {
                        $cat = $d->simple_fetch('SELECT category_id FROM #_category WHERE id=' . $catId);
                        $catId = $cat['category_id'];
                        if (empty($catId)) {
                            break;
                        }
                        $whereCatIds .= " OR category_id = " . $catId;
                    }
                }
                $whereCatIds .= ")";

                $query = "select name_" . $lang . ", content_" . $lang . "
                    FROM #_widget w INNER JOIN #_widget_category wc ON w.id = wc.widget_id
                    WHERE content_" . $lang . " IS NOT NULL
                        AND is_active = 1
                        AND group_id = 1
                        " . $whereCatIds . "
                    ORDER BY weight ASC, w.id DESC
                    ";
                $widgets = $d->o_fet($query);
            ?>
                <?php foreach ($widgets as $widget) : ?>
                    <div class="clearfix mb15"></div>
                    <div class="widget-content">
                        <h3 class="mt-0 mt-000"><?php echo $widget['name_' . $lang] ?></h3>
                        <?php echo $widget['content_' . $lang] ?>
                    </div>
                <?php endforeach ?>

                <div class="clearfix mb15"></div>
            <?php } ?>
        </div>
    </div>   
</div>
<?php }?>