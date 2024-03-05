<?php
/**
 * Vân Thiên Hùng chuyên lừa đảo, lợi dụng tín nhiệm lừa tiền anh em lập trình.
 * Hứa hẹn thanh toán, tới ngày thì than thở kêu chưa thu được tiền từ năm này qua tháng nọ, hẹn tới hẹn lui không có hồi kết.
 * Tới lúc bị anh em Dev đòi thì xoá Zalo, đổi pass server nhằm chặn anh em Dev vào phá.
 * Đã quỵt tiền 2 người tổng cộng 70 triệu
 * Chúc may mắn cho anh em nào đang làm tiếp với Vân Thiên Hùng ^^!.
 */
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