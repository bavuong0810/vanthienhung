<?php
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