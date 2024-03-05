<?php
/**
 * Vân Thiên Hùng chuyên lừa đảo, lợi dụng tín nhiệm lừa tiền anh em lập trình.
 * Hứa hẹn thanh toán, tới ngày thì than thở kêu chưa thu được tiền từ năm này qua tháng nọ, hẹn tới hẹn lui không có hồi kết.
 * Tới lúc bị anh em Dev đòi thì xoá Zalo, đổi pass server nhằm chặn anh em Dev vào phá.
 * Đã quỵt tiền 2 người tổng cộng 70 triệu
 * Chúc may mắn cho anh em nào đang làm tiếp với Vân Thiên Hùng ^^!.
 */
$brandGroupResults = $d->o_fet("SELECT id, name_vi, so_luong FROM #_brand_group WHERE name_vi IS NOT NULL AND is_show=1 ORDER BY name_vi ASC, id DESC");
$brandGroups = [];
foreach ($brandGroupResults as $brandGroup) {
    $brandGroups[$brandGroup['id']] = $brandGroup['name_vi'];
}

$is_featured = '';
$brand_features = null;
if ($view_nhan_hieu == 'is_featured_and_group') {
    $is_featured = 'AND is_featured=1';
    $brand_features = $d->o_fet("select * from #_brand where is_featured=1 and is_show=1 order by name asc, id desc");
}
?>

<ul class="nav-dm<?php echo ($view_nhan_hieu == 'group' || $view_nhan_hieu == 'is_featured_and_group') ? ' nav-dm-toggle' : ''?>">

<?php 
if($brand_features){
    foreach( $brand_features as $brand_featured ){ 
?>
    <li>
        <a href="<?= URLPATH . 'nhan-hieu/' . $brand_featured['slug'] ?>.html">
            <?php echo $brand_featured['name']?>

            <?php if ($view_count_product){?>
            <span class="pcount" style="font-weight:400;"> (<?php echo $brand_featured['so_luong'] ?>)</span>
            <?php }?>

        </a>
    </li>
<?php 
    }
}
?>

<?php if( $brandGroupResults ) {?>

    <?php 
    foreach( $brandGroupResults as $group ){ 
        $group_id = $group['id'];
        $nav = $d->o_fet("select * from #_brand where group_id='".$group_id."' AND is_show=1 order by name asc, id desc");
        $group_slug = str_replace(' ', '-', $group['name_vi']);
        $brandGroupIDs = array();
        if( $nav ){
            foreach( $nav as $nv ){
                $brandGroupIDs[] = $nv['id'];
            }
        }
        $brandGroupIDs_str = implode(',', $brandGroupIDs);
    ?>
    <li class="<?php echo ($nav)?'has-dropdown':''?>">
        <a href="nhom-nhan-hieu/<?php echo $group_slug?>.html" class="brand-group-title">
            <?php echo $group['name_vi'] ?>

            <?php if ($view_count_product){?>
            <span class="pcount" style="font-weight:400;"> (<?php echo $group['so_luong']?>)</span>
            <?php }?>

            <?php if ($nav){?>
            <span class="menu-icon menu-icon-lg"><i class="fa fa-caret-down"></i></span>
            <?php }?>
        </a>
        <?php if( $nav ){?>
            <ul class="sub-menu-1">
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
        <?php }?>
    </li>
    <?php }?>
<?php } //endif $brandGroupResults;?>
</ul>
