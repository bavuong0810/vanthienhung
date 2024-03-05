<?php
/**
 * Vân Thiên Hùng chuyên lừa đảo, lợi dụng tín nhiệm lừa tiền anh em lập trình.
 * Hứa hẹn thanh toán, tới ngày thì than thở kêu chưa thu được tiền từ năm này qua tháng nọ, hẹn tới hẹn lui không có hồi kết.
 * Tới lúc bị anh em Dev đòi thì xoá Zalo, đổi pass server nhằm chặn anh em Dev vào phá.
 * Đã quỵt tiền 2 người tổng cộng 70 triệu
 * Chúc may mắn cho anh em nào đang làm tiếp với Vân Thiên Hùng ^^!.
 */
$nav = $d->o_fet("select * from #_category where menu=1 and hien_thi=1 order by so_thu_tu asc, id desc");
?>
   
<ul class="nav-dm nav-dm-<?php echo $view_danh_muc?>">
    <?php foreach ($nav as $item) {
        $sub = $d->o_fet("select * from #_category where category_id={$item['id']} and hien_thi=1 order by so_thu_tu asc, id desc");
        $count_child = count($sub);
    ?>
        <li class="<?php if (count($sub) > 0) {
                        echo "has-dropdown";
                    }
                    if ($item['id'] == $_SESSION['nav'][0]) {
                        echo ' active';
                    }?>">

            <a href="<?= URLPATH . $item['alias_' . $lang] ?>.html" title="<?= $item['name_' . $lang] ?>">
                <?= $item['name_' . $lang] ?>

                <?php if ($view_count_product){?>
                <span class="pcount" style="font-weight:400;"> (<?php echo count_category_product_number($item['id'])?>)</span>
                <?php }?>

                <?php if (count($sub) > 0){?>
                <span class="menu-icon menu-icon-lg"><i class="fa fa-caret-down"></i></span>
                <?php }?>
            </a>
            
            <?php if ($count_child > 0) {
            ?>
                <ul class="sub-menu-1 <?php echo $count_child ?>">
                   
                    <?php foreach ($sub as $item1) {
                        $sub1 = $d->o_fet("select * from #_category where category_id={$item1['id']} and hien_thi=1 order by so_thu_tu asc, id desc");
                    ?>
                        <li class="<?php if (count($sub1) > 0) {
                                        echo "has-dropdown has-dropdown-submenu";
                                    }
                                    ?>">
                            <a class="sub-1-title" href="<?= URLPATH . $item1['alias_' . $lang] ?>.html" title="<?= $item1['name_' . $lang] ?>">
                                <?= $item1['name_' . $lang] ?>

                                <?php if ($view_count_product){?>
                                <span class="pcount" style="font-weight:400;"> (<?php echo count_category_product_number($item1['id'])?>)</span>
                                <?php }?>

                                <?php if (count($sub1) > 0){?>
                                <span class="menu-icon"><i class="fa fa-plus"></i></span>
                                <?php }?>
                            </a>

                            <?php if (count($sub1) > 0) {
                            ?>
                                <ul class="sub-menu-2 <?= count($sub1) > 2 ? 'menu-2fix' : '' ?>">
                                    <?php foreach ($sub1 as $item2) {
                                        $sub2 = $d->o_fet("select * from #_category where category_id={$item2['id']} and hien_thi=1 order by so_thu_tu asc, id desc");
                                    ?>
                                        <li class="<?php if (count($sub2) > 0) {
                                                        echo "has-dropdown has-dropdown-submenu";
                                                    }
                                                    ?>">
                                            <a href="<?= URLPATH . $item2['alias_' . $lang] ?>.html" title="<?= $item2['name_' . $lang] ?>">
                                                <?= $item2['name_' . $lang] ?>

                                                <?php if ($view_count_product){?>
                                                <span class="pcount" style="font-weight:400;">(<?php echo $item2['so_luong']?>)</span>
                                                <?php }?>
                                            </a>
                                            
                                            <?php if (count($sub2) > 0) {?>

                                            <ul class="dropdown-menu fadeInUp animate1 <?= count($sub2) > 2 ? 'menu-2fix' : '' ?>">
                                            <?php foreach ($sub2 as $item3) { ?>
                                                <li class="<?php if (count($sub3) > 0) {
                                                                        echo "has-dropdown has-dropdown-submenu";
                                                                    }
                                                            ?>">
                                                    <a href="<?= URLPATH . $item3['alias_' . $lang] ?>.html" title="<?= $item3['name_' . $lang] ?>">
                                                        <?= $item3['name_' . $lang] ?>

                                                        <?php if ($view_count_product){?>
                                                        <span class="pcount" style="font-weight:400;"> (<?php echo $item3['so_luong']?>)</span>
                                                        <?php }?>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                            </ul>
                                            <?php } ?>
                                        </li>
                                <?php } ?>
                                </ul>
                            <?php } ?>
                        </li>
                    <?php }?>
                </ul>
            <?php } ?>
        </li>
    <?php } ?>
</ul>