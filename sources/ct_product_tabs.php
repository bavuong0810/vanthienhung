<div class="row10 clearfix">
	<div class="col-md-12 plr10">
		<div class="thong_tin">
			<?php
			$view_ho_tro = $d->getOption('view_ho_tro');
			$is_active = '';
			?>
			<ul class="nav nav-tabs" role="tablist">
				<?php if (!empty($parentProduct)) : $is_active = 1;?>
					<li class="active">
						<a href="#below_detail_list_childs" aria-controls="below_detail_list_childs" role="tab" data-toggle="tab">
							Thành phần thuộc nhóm
						</a>
					</li>
				<?php $is_active = 1; endif; ?>

				<?php if( $view_ho_tro == '1' ){?>
					<li class="<?php echo(!$is_active)?'active':''?>"><a href="#below_detail_left_1" aria-controls="below_detail_left_1" role="tab" data-toggle="tab"><?php echo $belowDetailLeft1['name_' . $lang]; ?></a></li>
				<?php $is_active = 1; }?>

				<!-- Right -->
				<?php if($belowDetailRight1['name_' . $lang]){?>
				<li class="<?php echo(!$is_active)?'active':''?> hidden-xs"><a href="#below_detail_right_1" aria-controls="below_detail_right_1" role="tab" data-toggle="tab"><?php echo $belowDetailRight1['name_' . $lang]; ?></a></li>
				<?php $is_active = 1;}?>
				
				<?php if (!empty($belowDetailRight2['hien_thi']) && $belowDetailRight2['hien_thi']) { ?>
					<li class="<?php echo(!$is_active)?'active':''?> hidden-xs"><a href="#below_detail_right_2" aria-controls="below_detail_right_2" role="tab" data-toggle="tab"><?php echo $belowDetailRight2['name_' . $lang]; ?></a></li>
				<?php $is_active = 1;} ?>

				<?php if (!empty($belowDetailRight3['hien_thi']) && $belowDetailRight3['hien_thi']) { ?>
					<li class="<?php echo(!$is_active)?'active':''?> hidden-xs"><a href="#below_detail_right_3" aria-controls="below_detail_right_3" role="tab" data-toggle="tab"><?php echo $belowDetailRight3['name_' . $lang]; ?></a></li>
				<?php $is_active = 1;} ?>

				<?php if (!empty($belowDetailRight4['hien_thi']) && $belowDetailRight4['hien_thi']) { ?>
					<li class="<?php echo(!$is_active)?'active':''?> hidden-xs"><a href="#below_detail_right_4" aria-controls="below_detail_right_4" role="tab" data-toggle="tab"><?php echo $belowDetailRight4['name_' . $lang]; ?></a></li>
				<?php $is_active = 1;} ?>
			</ul>
			
			<?php $is_active = '';?>
			<div class="tab-content">
				<?php if (!empty($parentProduct)) : ?>
					<div role="tabpanel" class="tab-pane fade in active" id="below_detail_list_childs">
						<?php
						include 'parts/product/child-products.php';
						?>
					</div>
				<?php $is_active = 1; endif; ?>

				<?php if( $view_ho_tro == '1' ){?>
					<div role="tabpanel" class="tab-pane fade<?php echo(!$is_active)?' in active':''?>" id="below_detail_left_1">
						<?php echo $belowDetailLeft1['content_' . $lang]; ?>
					</div>
				<?php $is_active = 1;}?>

				<!-- Right -->
				
				<?php if($belowDetailRight1['name_' . $lang]){?>
				<div role="tabpanel" class="tab-pane fade<?php echo(!$is_active)?' in active':''?>" id="below_detail_right_1">
					<?php echo $belowDetailRight1['content_' . $lang]; ?>
				</div>
				<?php $is_active = 1;}?>

				<?php if (!empty($belowDetailRight2['hien_thi'])) { ?>
					<div role="tabpanel" class="tab-pane fade<?php echo(!$is_active)?' in active':''?>" id="below_detail_right_2">
						<?php echo $belowDetailRight2['content_' . $lang]; ?>
					</div>
				<?php $is_active = 1;} ?>

				<?php if (!empty($belowDetailRight3['hien_thi'])) { ?>
					<div role="tabpanel" class="tab-pane fade<?php echo(!$is_active)?' in active':''?>" id="below_detail_right_3">
						<?php echo $belowDetailRight3['content_' . $lang]; ?>
					</div>
				<?php $is_active = 1;} ?>

				<?php if (!empty($belowDetailRight4['hien_thi'])) { ?>
					<div role="tabpanel" class="tab-pane fade<?php echo(!$is_active)?' in active':''?>" id="below_detail_right_4">
						<?php echo $belowDetailRight4['content_' . $lang]; ?>
					</div>
				<?php $is_active = 1;} ?>

			</div>
		</div>
	</div>
	<div class="clearfix mb30"></div>
</div>