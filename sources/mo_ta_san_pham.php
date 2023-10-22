<?php 
$view_product_description = $d->getOption('view_product_description');

if( $view_product_description ){
    $tuyChinh4 = $d->getTemplates(67, 1);
?>

<div class="thong_tin mb-2">
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#product_description" aria-controls="product_description" role="tab" data-toggle="tab"><?php echo $tuyChinh4['name_' . $lang]?></a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="product_description">
            
            <?php echo $tuyChinh4['content_' . $lang]; ?>

            <?php echo get_widget_by_category_position($cat_id, 2)?>

        </div>
    </div>   
</div>
<?php }?>