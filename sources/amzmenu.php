<?php
$nav		= $d->o_fet("select * from #_category where menu=1 and hien_thi=1 order by so_thu_tu asc, id desc");

?>
<div class="sub-menu-2">
    <div class="ebay-sub-menu amazon">
        <div class="left">
<div class="row">
    <div class="col-md-6">
        <div class="item">
<ul>
    <li class="<?php if($com=='') echo 'active'; ?>">
        <a href="<?=URLPATH?>" title="<?=_trangchu?>">
           <?=_trangchu?>
        </a>
    </li>
    <?php foreach($nav as $item) {
        $sub=$d->o_fet("select * from #_category where category_id={$item['id']} and hien_thi=1 order by so_thu_tu asc, id desc");
        $count_child = count($sub);
        ?>
        <li class="<?php if(count($sub)>0) echo "dropdown"; if($item['id']==$_SESSION['nav'][0]) echo ' active'?>">
            <a href="<?=URLPATH.$item['alias_'.$lang]?>.html" title="<?=$item['name_'.$lang]?>">
                <?=$item['name_'.$lang]?>
            </a>
            <?php if($count_child>0) {?>
               <ul class="dropdown-menu fadeInUp animate1 <?=$count_child>6?'menu-2fix':''?>">
                    <?php foreach($sub as $item1) {
                    $sub1=$d->o_fet("select * from #_category where category_id={$item1['id']} and hien_thi=1 order by so_thu_tu asc, id desc");
                    ?>
                        <li class="<?php if(count($sub1)>0) echo "dropdown-submenu"?>">
                            <a href="<?=URLPATH.$item1['alias_'.$lang] ?>.html" title="<?=$item1['name_'.$lang]?>"><?=$item1['name_'.$lang]?></a>                                                    
                            <?php if(count($sub1)>0) {?>                                                    
                            <ul class="dropdown-menu fadeInUp animate1 <?=count($sub1)>2?'menu-2fix':''?>">    
                                <?php foreach($sub1 as $item2) { 
                                    $sub2=$d->o_fet("select * from #_category where category_id={$item2['id']} and hien_thi=1 order by so_thu_tu asc, id desc");
                                    ?>
                                    <li class="<?php if(count($sub2)>0) echo "dropdown-submenu"?>">
                                        <a href="<?=URLPATH.$item2['alias_'.$lang] ?>.html" title="<?=$item2['name_'.$lang]?>"><?=$item2['name_'.$lang]?></a>
                                        <?php if(count($sub2)>0) {?>
                                        <ul class="dropdown-menu fadeInUp animate1 <?=count($sub2)>2?'menu-2fix':''?>">
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
    </li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- product (id,type)
attribute (id,id_product,code)
product_attribute(id,id_attribute,value) -->