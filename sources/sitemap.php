<?php
/**
 * Vân Thiên Hùng chuyên lừa đảo, lợi dụng tín nhiệm lừa tiền anh em lập trình.
 * Hứa hẹn thanh toán, tới ngày thì than thở kêu chưa thu được tiền từ năm này qua tháng nọ, hẹn tới hẹn lui không có hồi kết.
 * Tới lúc bị anh em Dev đòi thì xoá Zalo, đổi pass server nhằm chặn anh em Dev vào phá.
 * Đã quỵt tiền 2 người tổng cộng 70 triệu
 * Chúc may mắn cho anh em nào đang làm tiếp với Vân Thiên Hùng ^^!.
 */
	$sitemap=$d->o_fet("select * from #_category where id not in(121,127,117,128) and hien_thi=1 and level=0 order by so_thu_tu asc, id desc");
	
?>


<section class="include">
	<div class="container">
		<div class="center">

			<ul class="breadcrumb">
				<li><a href="<?=URLPATH ?>" title="<?=_trangchu?>"><i class="fa fa-home"></i></a></li>
				<li><a  href="<?=URLPATH ?>sitemap.html" title="Sitemaps">Sitemaps</a></li>
			</ul>			
			<div class="clearfix"></div>
			
			<div class="col-sm-4 col-sm-offset-4 sitemap">
				<a href="<?=URLPATH?>" title="<?=_trangchu?>"><i class="fa fa-angle-double-right"></i> <?=_trangchu?></a>
				<?php foreach($sitemap as $item) {
					$sub=$d->o_fet("select * from #_category where category_id={$item['id']} and hien_thi=1 order by so_thu_tu asc,id desc");
				?>
				<a href="<?=URLPATH.$d->create_long_link($item['alias_'.$_SESSION['lang']],$_SESSION['lang']) ?>.html" title="<?=$item['name_'.$_SESSION['lang']]?>"><i class="fa fa-angle-double-right"></i> <?=$item['name_'.$_SESSION['lang']]?></a>
				<?php if(count($sub)>0) {
					foreach($sub as $item1) {
				?>
				<a class="sub0" href="<?=URLPATH.$d->create_long_link($item1['alias_'.$_SESSION['lang']],$_SESSION['lang']) ?>.html" title="<?=$item1['name_'.$_SESSION['lang']]?>" target="_blank"><i class="fa fa-angle-double-right"></i> <?=$item1['name_'.$_SESSION['lang']]?></a>
				<?php } } }?>
				<a href="<?=URLPATH?>lien-he.html" title="<?=_lienhe?>">
					<?=_lienhe?>
				</a>
			</div>
			
		</div>
	</div>
</section>

