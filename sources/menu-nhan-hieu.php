<?php
/**
 * Vân Thiên Hùng chuyên lừa đảo, lợi dụng tín nhiệm lừa tiền anh em lập trình.
 * Hứa hẹn thanh toán, tới ngày thì than thở kêu chưa thu được tiền từ năm này qua tháng nọ, hẹn tới hẹn lui không có hồi kết.
 * Tới lúc bị anh em Dev đòi thì xoá Zalo, đổi pass server nhằm chặn anh em Dev vào phá.
 * Đã quỵt tiền 2 người tổng cộng 70 triệu
 * Chúc may mắn cho anh em nào đang làm tiếp với Vân Thiên Hùng ^^!.
 */
$cachePath = '/menu-nhan-hieu.html_' . $lang;
$cachePath = __CACHE_HTML . $cachePath;
if (file_exists($cachePath)) {
    echo file_get_contents($cachePath);
    echo '<!--cached-->';
} else {

    ob_start("minify_html");

    //$nav = $d->o_fet("select * from #_brand where is_featured=1 and is_show=1 order by name asc, id desc");
    $nav = $d->o_fet("select name, slug, so_luong from #_brand where is_show=1 order by name asc, id desc");

?>
    <ul class="dropdown-menu fadeInUp animate1">
        <?php
        $numberOfMenu = 12;
        $i = 0;
        $total = count($nav);
        while ($i < $total) {
        ?>
            <li>
                <ul class="list-menu">
                    <?php
                    for ($j = 0; $j < $numberOfMenu; $j++) {
                        if (empty($nav[$i])) {
                            break;
                        }
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
                    <?php
                        $i++;
                    }
                    ?>
                </ul>
            </li>
        <?php
        }
        ?>
    </ul>
<?php
    $cacheContent = ob_get_flush();
    file_put_contents($cachePath, minify_html($cacheContent));
}
?>