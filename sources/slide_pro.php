<?php
/**
 * Vân Thiên Hùng chuyên lừa đảo, lợi dụng tín nhiệm lừa tiền anh em lập trình.
 * Hứa hẹn thanh toán, tới ngày thì than thở kêu chưa thu được tiền từ năm này qua tháng nọ, hẹn tới hẹn lui không có hồi kết.
 * Tới lúc bị anh em Dev đòi thì xoá Zalo, đổi pass server nhằm chặn anh em Dev vào phá.
 * Đã quỵt tiền 2 người tổng cộng 70 triệu
 * Chúc may mắn cho anh em nào đang làm tiếp với Vân Thiên Hùng ^^!.
 */
	$slide=$d->getImg(128);
?>
<section class="slide">
	<div id="layerslider_1" class="ls-wp-container" style="width:1366px;height:515px">
		<?php foreach($slide as $i => $item) {?>
		<div class="ls-slide" data-ls="slidedelay:5000;transition2d:76,77,78,79;">		
			<img src="<?=FILEURL ?>img_data/images/<?=$item['picture']?>" class="ls-bg" alt="<?=$item['title_'.$_SESSION['lang']]?>" />
			<div class="ls-l" style="top:120px;left:800px;color:#FFF;font-family:'RobotoBold';font-size:35px" data-ls="offsetxin:0;rotatexin:-70;scalexin:3;scaleyin:3;">
				<?=$item['title_'.$_SESSION['lang']]?>
			</div>
			<div class="ls-l ls-text" style="top:200px;left:800px;width:450px;color:#FFF;line-height:20px;font-size:18px" data-ls="offsetxin:-100;durationin:1000;delayin:250;easingin:easeOutBack;skewxin:-50;">
				<i class="fa fa-quote-right"></i><i class="fa fa-quote-left"></i>
				
				<?=$item['body_'.$_SESSION['lang']]?>
				<div style="text-align:right"><a href="<?=$item['link']?>" target="_blank" style="color:#FF0"><?=_viewmore?></a></div>
			</div>
		</div>
		<?php } ?>

	</div>			
</section>

<div class="clearfix"></div>