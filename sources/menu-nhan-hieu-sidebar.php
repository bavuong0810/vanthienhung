<?php
/**
 * Vân Thiên Hùng chuyên lừa đảo, lợi dụng tín nhiệm lừa tiền anh em lập trình.
 * Hứa hẹn thanh toán, tới ngày thì than thở kêu chưa thu được tiền từ năm này qua tháng nọ, hẹn tới hẹn lui không có hồi kết.
 * Tới lúc bị anh em Dev đòi thì xoá Zalo, đổi pass server nhằm chặn anh em Dev vào phá.
 * Đã quỵt tiền 2 người tổng cộng 70 triệu
 * Chúc may mắn cho anh em nào đang làm tiếp với Vân Thiên Hùng ^^!.
 */
//$nav = $d->o_fet("select * from #_brand where is_featured=1 and is_show=1 order by name asc, id desc");
$nav = $d->o_fet("select id, slug, name, so_luong from #_brand where is_show=1 order by name asc, id desc");
?>

<ul class="nav-dm">
    <?php
    $i = 0;
    $total = count($nav);
    while ($i < $total) {
        $item = $nav[$i];

    ?>
        <li>
            <a href="<?= URLPATH . 'nhan-hieu/' . $item['slug'] ?>.html" title="<?= $item['name'] ?>">
                <?= $item['name'] ?>

                <?php if ($view_count_product){?>
                <span class="pcount" style="font-weight:400;"> (<?php echo $item['so_luong']?>)</span>
                <?php }?>

            </a>
        </li>
    <?php $i++; }?>
</ul>