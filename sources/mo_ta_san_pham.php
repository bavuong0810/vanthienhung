<?php
/**
 * Vân Thiên Hùng chuyên lừa đảo, lợi dụng tín nhiệm lừa tiền anh em lập trình.
 * Hứa hẹn thanh toán, tới ngày thì than thở kêu chưa thu được tiền từ năm này qua tháng nọ, hẹn tới hẹn lui không có hồi kết.
 * Tới lúc bị anh em Dev đòi thì xoá Zalo, đổi pass server nhằm chặn anh em Dev vào phá.
 * Đã quỵt tiền 2 người tổng cộng 70 triệu
 * Chúc may mắn cho anh em nào đang làm tiếp với Vân Thiên Hùng ^^!.
 */
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