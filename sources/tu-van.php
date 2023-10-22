<?php
	if(isset($_POST['btn_question'])){
		$d->reset();
		$d->setTable('#_question');
		$data['ten'] = addslashes($_POST['ho_ten']);
		$data['email'] = addslashes($_POST['email']);
		$data['cau_hoi'] = addslashes($_POST['cau_hoi']);
		$data['ngay'] = time();
		if($d->insert($data)) {
			$d->alert("Gửi thành công!");
			$d->location(URLPATH);
			}
	}
	$loai = $d->simple_fetch("select * from #_category where hien_thi = 1 and alias_{$_SESSION['lang']} = '$com'");

	if(count($loai) == 0) $d->location(URLPATH."404.html");
	$id_sub=substr($d->findIdSub($loai['id'],1),1);
	
	$category_id=$loai['id'].$d->findIdSub($loai['id']);
	$listQuestion = $d->o_fet("select * from #_question where hien_thi = 1 order by id desc");
?>
<style type="text/css">
	.panel-heading h3{ font-weight: bold; text-transform: uppercase; font-size: 16px; text-align: center; margin: 0; padding: 5px 0; }
</style>
<section class="module">
	<div class="container bg-white">
		<div class="row10">
			<?php include "left.php"; ?>						
			<div class="main-content col-md-9 plr10">
				<div class="page-title">
					<div class="col-md-12 plr0">
						<ul class="breadcrumb">
							<li><a href="<?=URLPATH ?>" title="<?=_trangchu?>"><i class="fa fa-home"></i></a></li>
							<li><a href="<?=URLPATH ?>" title="<?=_tuvan?>"><?=_tuvan?></a></li>
						</ul>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					<?php foreach ($listQuestion as $key => $value) { ?>
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="headingOne">
								<h4 class="panel-title">
									<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_<?=$key?>" aria-expanded="<?=($key==0)?'true':'false'?>" aria-controls="collapse_<?=$key?>">
										<i class="more-less glyphicon glyphicon-plus"></i>
										<?= strip_tags($value['cau_hoi']) ?>
									</a>
								</h4>
							</div>
							<div id="collapse_<?=$key?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
								<div class="panel-body">
									<?= $value['tra_loi'] ?>
								</div>
							</div>
						</div>
					<?php } ?>
				</div><!-- panel-group -->
				<div class="clearfix mb10"></div>
				<div class="col-md-8 col-md-offset-2">
					<div class="panel panel-default">
					  	<div class="panel-heading"><h3><?=_guicauhoi?></h3></div>
					  	<div class="panel-body">
					  		<form method="POST" action="">
					  			<div class="clearfix form-group">
					  				<input type="text" name="ho_ten" required class="form-control" placeholder="<?=_hoten?>">
					  			</div>
					  			<div class="clearfix form-group">
					  				<input type="email" name="email" required class="form-control" placeholder="Email">
					  			</div>
					  			<div class="clearfix form-group">
					  				<textarea name="cau_hoi" class="form-control" required rows="5" placeholder="<?=_cauhoi?>"></textarea> 
					  			</div>
					  			<div class="clearfix form-group text-right">
					  				<button class="btn btn-success" type="submit" name="btn_question"><?=_send?></button>
					  			</div>
					  		</form>
					  	</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	/*******************************
* ACCORDION WITH TOGGLE ICONS
*******************************/
	function toggleIcon(e) {
        $(e.target)
            .prev('.panel-heading')
            .find(".more-less")
            .toggleClass('glyphicon-plus glyphicon-minus');
    }
    $('.panel-group').on('hidden.bs.collapse', toggleIcon);
    $('.panel-group').on('shown.bs.collapse', toggleIcon);
</script>