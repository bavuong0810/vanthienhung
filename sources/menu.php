<?php
/**
 * Vân Thiên Hùng chuyên lừa đảo, lợi dụng tín nhiệm lừa tiền anh em lập trình.
 * Hứa hẹn thanh toán, tới ngày thì than thở kêu chưa thu được tiền từ năm này qua tháng nọ, hẹn tới hẹn lui không có hồi kết.
 * Tới lúc bị anh em Dev đòi thì xoá Zalo, đổi pass server nhằm chặn anh em Dev vào phá.
 * Đã quỵt tiền 2 người tổng cộng 70 triệu
 * Chúc may mắn cho anh em nào đang làm tiếp với Vân Thiên Hùng ^^!.
 */
$cachePath = '/menu.html_' . $lang;
$cachePath = __CACHE_HTML . $cachePath;
if (file_exists($cachePath)) {
    echo file_get_contents($cachePath);
    echo '<--cached-->';
} else {

ob_start("minify_html");

$nav = $d->o_fet("select * from #_category where is_hot=1 and hien_thi=1 order by so_thu_tu asc, id desc");

?>
<ul class="nav navbar-nav 222222222222">
    <li class="<?php if($com=='') echo 'active'; ?>">
        <a href="<?=URLPATH?>" title="<?=_trangchu?>">
            <?=_trangchu?>
        </a>
    </li>
    <?php foreach($nav as $item) {
        $sub=$d->o_fet("select * from #_category where category_id={$item['id']} and hien_thi=1 order by so_thu_tu asc, id desc");
        ?>
        <li class="<?php if(count($sub)>0) echo "dropdown"; if($item['id']==$_SESSION['nav'][0]) echo ' active'?> <?= ($item['module']==3 && $item['category_id']==0)?'no-relative':'' ?>">
            <a href="<?=URLPATH.$item['alias_'.$lang]?>.html" title="<?=$item['name_'.$lang]?>">
                <?=$item['name_'.$lang]?>
            </a>
            <?php if(count($sub)>0) {?>
                <?php if($item['module']==3 && $item['category_id']==0){ ?>
                    <div class="mega-menu fadeInUp animate1">
                        <div class="row10">
                            <?php foreach ($sub as $key => $item1): 
                                $sub1=$d->o_fet("select * from #_category where category_id={$item1['id']} and hien_thi=1 order by so_thu_tu asc, id desc");
                                ?>
                                <div class="col-md-2 col-sm-3 plr10">
                                    <div class="item-mega">
                                        <div class="title-mega">
                                             <a href="<?=URLPATH.$item1['alias_'.$lang] ?>.html" title="<?=$item1['name_'.$lang]?>"><?=$item1['name_'.$lang]?></a>
                                        </div>
                                        <?php foreach ($sub1 as $k => $item2): 
                                            $sub2=$d->o_fet("select * from #_category where category_id={$item2['id']} and hien_thi=1 order by so_thu_tu asc, id desc");
                                            ?>
                                            <div class="child-mega">
                                                <a href="<?=URLPATH.$item2['alias_'.$lang] ?>.html" title="<?=$item2['name_'.$lang]?>"><?=$item2['name_'.$lang]?></a>
                                                <?php foreach($sub2 as $item3) { ?>
                                                    <div class="child2-mega">
                                                        <a href="<?=URLPATH.$item3['alias_'.$lang] ?>.html" title=" <?=$item3['name_'.$lang]?>"><?=$item3['name_'.$lang]?></a> 
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                                <?= ($key==5)?'<div class="clear-des"></div>':'' ?>
                            <?php endforeach ?>
                        </div>
                    </div>
                <?php } else { ?>
                   <ul class="dropdown-menu fadeInUp animate1">
                        <?php foreach($sub as $item1) {
                        $sub1=$d->o_fet("select * from #_category where category_id={$item1['id']} and hien_thi=1 order by so_thu_tu asc, id desc");
                        ?>
                            <li class="<?php if(count($sub1)>0) echo "dropdown-submenu"?>">
                                <a href="<?=URLPATH.$item1['alias_'.$lang] ?>.html" title="<?=$item1['name_'.$lang]?>"><?=$item1['name_'.$lang]?></a>                                                    
                                <?php if(count($sub1)>0) {?>                                                    
                                <ul class="dropdown-menu fadeInUp animate1">    
                                    <?php foreach($sub1 as $item2) { 
                                        $sub2=$d->o_fet("select * from #_category where category_id={$item2['id']} and hien_thi=1 order by so_thu_tu asc, id desc");
                                        ?>
                                        <li class="<?php if(count($sub2)>0) echo "dropdown-submenu"?>">
                                            <a href="<?=URLPATH.$item2['alias_'.$lang] ?>.html" title="<?=$item2['name_'.$lang]?>"><?=$item2['name_'.$lang]?></a>
                                            <?php if(count($sub2)>0) {?>
                                            <ul class="dropdown-menu fadeInUp animate1">
                                            <?php foreach($sub2 as $item3) { ?>
                                             	<li class="<?php if(count($sub3)>0) echo "dropdown-submenu"?>">
                                                    <a href="<?=URLPATH.$item3['alias_'.$lang] ?>.html" title="	<?=$item3['name_'.$lang]?>"><?=$item3['name_'.$lang]?></a> 
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
            <?php } ?>
        </li>
    <?php } ?>
    <li>
        <!-- <div class="d7 d7-search">
            <form method="get" action="index.php">
                <input type="hidden" name="com" value="search">
                <input type="text" name="textsearch" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?=_typekey?>'" placeholder="<?=_typekey?>" class="form-control">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div> -->
        <div class="tu-van">
            <img src="templates/images/ic-phone.png">
            <div>
                <p><?=$information['hotline']?></p>
                <span>Tư vấn & mua hàng</span>
            </div>
        </div>
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