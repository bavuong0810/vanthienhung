<?php
$cachePath = '/mmenu.html_' . $lang;
$cachePath = __CACHE_HTML . $cachePath;
if (file_exists($cachePath)) {
    echo file_get_contents($cachePath);
    echo '<!--cached-->';
} else {
    ob_start("minify_html");
    $nav = $d->o_fet("select * from #_category where menu=1 and hien_thi=1 order by so_thu_tu asc, id desc");
?>
    <style type="text/css">
        /*body{
-webkit-user-select: none;
-moz-user-select: none;
-ms-user-select: none;
user-select: none;
}*/
        @media(min-width: 1023px) {
            nav.nav .dropdown-menu.menu-2fix {
                min-width: 500px;
            }

            nav.nav .dropdown-menu.menu-2fix li {
                width: 50%;
                float: left;
            }
        }
    </style>
    <ul class="nav navbar-nav 333333333">
        <li>
            <a href="/admin" title="Dành cho đại lý">Dành cho đại lý</a>
        </li>
        <li>
            <a href="/kiem-tra-don-hang.html" title="Kiểm tra đơn hàng">Kiểm tra đơn hàng</a>
        </li>
        <li>
            <a href="/kich-hoat-bao-hanh.html" title="Bảo hành online">Bảo hành online</a>
        </li>
        <?php foreach ($nav as $item) {
            // $sub = $d->o_fet("select * from #_category where category_id={$item['id']} and hien_thi=1 order by so_thu_tu asc, id desc");
            $sub = [];
            $count_child = count($sub);
        ?>
            <li class="<?php if (count($sub) > 0) {
                            echo "dropdown";
                        }
                        if ($item['id'] == $_SESSION['nav'][0]) {
                            echo ' active';
                        }
                        ?>">
                <a href="<?= URLPATH . $item['alias_' . $lang] ?>.html" title="<?= $item['name_' . $lang] ?>">
                    <?= $item['name_' . $lang] ?>
                </a>
                <?php if ($count_child > 0) {
                ?>
                    <ul class="dropdown-menu fadeInUp animate1 <?= $count_child > 6 ? 'menu-2fix' : '' ?>">
                        <?php foreach ($sub as $item1) {
                            $sub1 = $d->o_fet("select * from #_category where category_id={$item1['id']} and hien_thi=1 order by so_thu_tu asc, id desc");
                        ?>
                            <li class="<?php if (count($sub1) > 0) {
                                            echo "dropdown-submenu";
                                        }
                                        ?>">
                                <a href="<?= URLPATH . $item1['alias_' . $lang] ?>.html" title="<?= $item1['name_' . $lang] ?>"><?= $item1['name_' . $lang] ?></a>
                                <?php if (count($sub1) > 0) {
                                ?>
                                    <ul class="dropdown-menu fadeInUp animate1 <?= count($sub1) > 2 ? 'menu-2fix' : '' ?>">
                                        <?php foreach ($sub1 as $item2) {
                                            $sub2 = $d->o_fet("select * from #_category where category_id={$item2['id']} and hien_thi=1 order by so_thu_tu asc, id desc");
                                        ?>
                                            <li class="<?php if (count($sub2) > 0) {
                                                            echo "dropdown-submenu";
                                                        }
                                                        ?>">
                                                <a href="<?= URLPATH . $item2['alias_' . $lang] ?>.html" title="<?= $item2['name_' . $lang] ?>"><?= $item2['name_' . $lang] ?></a>
                                                <?php if (count($sub2) > 0) {
                                                ?>
                                                    <ul class="dropdown-menu fadeInUp animate1 <?= count($sub2) > 2 ? 'menu-2fix' : '' ?>">
                                                        <?php foreach ($sub2 as $item3) { ?>
                                                            <li class="<?php if (count($sub3) > 0) {
                                                                            echo "dropdown-submenu";
                                                                        }
                                                                        ?>">
                                                                <a href="<?= URLPATH . $item3['alias_' . $lang] ?>.html" title="  <?= $item3['name_' . $lang] ?>"><?= $item3['name_' . $lang] ?></a>
                                                            </li>
                                                        <?php } ?>
                                                    </ul>
                                                <?php } ?>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } ?>
            </li>
        <?php } ?>
        <li>
        <li>
            <a href="<?php echo URLPATH ?>nhan-hieu.html" title="Nhãn hiệu">
                Nhãn hiệu
            </a>
        </li>
        <!-- <div class="d7 d7-search">
            <form method="get" action="index.php">
                <input type="hidden" name="com" value="search">
                <input type="text" name="textsearch" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?= _typekey ?>'" placeholder="<?= _typekey ?>" class="form-control">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div> -->
        </li>
    </ul>
    <!-- product (id,type)
attribute (id,id_product,code)
product_attribute(id,id_attribute,value) -->
<?php
    $cacheContent = ob_get_flush();
    file_put_contents($cachePath, minify_html($cacheContent));
}
?>