<?php
	
?>
<section class="mt-1">
	<div class="container">
		<h2 class="text-center text-uppercase mb-1">Danh mục hàng</h2>
        <?php
        $navdm = $d->o_fet("select * from #_category where menu=1 and hien_thi=1 order by so_thu_tu asc, id desc");
        ?>
        
        <ul class="cat-grid grid">
            <?php foreach ($navdm as $itemdm) {
                $subdm = $d->o_fet("select * from #_category where category_id={$itemdm['id']} and hien_thi=1 order by so_thu_tu asc, id desc");
                $count_child = count($subdm);
            ?>
                <li class="grid-item">

                    <a href="<?= URLPATH . $itemdm['alias_' . $lang] ?>.html" title="<?= $itemdm['name_' . $lang] ?>">
                        <?= $itemdm['name_' . $lang] ?>

                        <?php if ($view_count_product){?>
                        <span class="pcount" style="font-weight:400;"> (<?php echo count_category_product_number($itemdm['id'])?>)</span>
                        <?php }?>

                    </a>
                    
                    <?php if ($count_child > 0) {
                    ?>
                        <ul class="cat-grid-1 <?php echo $count_child ?>">
                        
                            <?php foreach ($subdm as $itemdm1) {
                                $subdm1 = $d->o_fet("select * from #_category where category_id={$itemdm1['id']} and hien_thi=1 order by so_thu_tu asc, id desc");
                            ?>
                                <li class="">
                                    <a class="sub-1-title" href="<?= URLPATH . $itemdm1['alias_' . $lang] ?>.html" title="<?= $itemdm1['name_' . $lang] ?>">
                                        <?= $itemdm1['name_' . $lang] ?>

                                        <?php if ($view_count_product){?>
                                        <span class="pcount" style="font-weight:400;"> (<?php echo count_category_product_number($itemdm1['id'])?>)</span>
                                        <?php }?>

                                    </a>

                                    <?php if (count($subdm1) > 0) {
                                    ?>
                                        <ul class="cat-grid-2">
                                            <?php foreach ($subdm1 as $itemdm2) {
                                                $subdm2 = $d->o_fet("select * from #_category where category_id={$itemdm2['id']} and hien_thi=1 order by so_thu_tu asc, id desc");
                                            ?>
                                                <li class="">
                                                    <a href="<?= URLPATH . $itemdm2['alias_' . $lang] ?>.html" title="<?= $itemdm2['name_' . $lang] ?>">
                                                        <?= $itemdm2['name_' . $lang] ?>

                                                        <?php if ($view_count_product){?>
                                                        <span class="pcount" style="font-weight:400;">(<?php echo $itemdm2['so_luong']?>)</span>
                                                        <?php }?>
                                                    </a>
                                                    
                                                    <?php if (count($subdm2) > 0) {?>

                                                    <ul class="cat-grid-3">
                                                    <?php foreach ($subdm2 as $itemdm3) { ?>
                                                        <li class="">
                                                            <a href="<?= URLPATH . $itemdm3['alias_' . $lang] ?>.html" title="<?= $itemdm3['name_' . $lang] ?>">
                                                                <?= $itemdm3['name_' . $lang] ?>

                                                                <?php if ($view_count_product){?>
                                                                <span class="pcount" style="font-weight:400;"> (<?php echo $itemdm3['so_luong']?>)</span>
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
	</div>
</section>

<style type="text/css">
	.clearfix:after{
		content:"";
		clear: both;
		display: table;
	}
    .grid{
        margin: 0;
        padding: 0;
    }
    .grid-item { 
        width: 20%;
        margin: 0 0 50px;
        padding: 0;
    }
    .cat-grid{
        margin: 0;
        padding: 0;
        list-style: none;
    }
    .cat-grid li{
        padding: 0;
        margin: 0 0 4px;
    }
    .cat-grid a{
        position: relative;
        display: inline-block;
        padding-left: 18px;
    }
    .cat-grid a:before{
        position: absolute;
        top: 3px;
        left: 0;
        width: 14px;
        height: 14px;
        font-weight: 400;
        font-size: 10px;
        line-height: 10px;
        background-color: #fff;
        display: flex;
        border-radius: 3px;
        color: #ee1b25;
        align-items: center;
        justify-content: center;
        border: 1px solid #ddd;
    }
    .cat-grid > li > a{
        font-weight: 700;
    }
    .cat-grid-1,
    .cat-grid-2,
    .cat-grid-3{
        padding: 4px 0 0 15px;
        margin: 0;
        list-style: none;
    }
    .cat-grid-3{
        padding-left: 0;
    }
    .cat-grid > li > a:before{
        content:"-";
    }
    .cat-grid-1 > li > a:before{
        content:"+";
    }
    .cat-grid-2 > li > a:before,
    .cat-grid-3 > li > a:before{
        display: none;
    }
    .cat-grid-2 > li > a,
    .cat-grid-3 > li > a{
        padding: 0;
    }
    .cat-grid-2{
        list-style: square;
        margin-left: 18px;
    }
    .cat-grid-2 > li::marker{
        color: #ee1b25;
    }
    @media (max-width: 1200px){
        .grid-item { 
            width: 25%;
        }
    }
    @media (max-width: 992px){
        .grid-item { 
            width: 33.33333%;
        }
    }
    @media (max-width: 767px){
        .grid-item { 
            width: 100%;
        }
    }
</style>
<script src="<?=URLPATH?>templates/js/masonry-pkgd-min.js"></script>
<script type="text/javascript">
	$(window).on('load', function(){
		$('.grid').masonry({
            itemSelector: '.grid-item',
        });
	});
</script>