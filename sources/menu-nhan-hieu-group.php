<?php
$brannd_group_query = $d->o_fet("SELECT id, name_vi, so_luong FROM #_brand_group WHERE name_vi IS NOT NULL AND is_show=1 ORDER BY name_vi ASC, id DESC");


if( !empty($brannd_group_query) ){
?>
<ul class="dropdown-menu fadeInUp animate1">
<?php 
foreach( $brannd_group_query as $brand_group_item ){
    $brannd_group_slug = str_replace(' ', '-', $brand_group_item['name_vi']);    
?>    
    <li>
        <a href="nhom-nhan-hieu/<?php echo $brannd_group_slug?>.html">
            <?php echo $brand_group_item['name_vi'] ?>

            <?php if ($view_count_product){?>
            <span class="pcount" style="font-weight:400;"> (<?php echo $brand_group_item['so_luong']?>)</span>
            <?php }?>

        </a>
    </li>
<?php }//end foreach?>
</ul>
<?php }//endif?>