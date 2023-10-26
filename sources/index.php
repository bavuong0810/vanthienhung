<?php
$home_content = $d->getTemplates(46);
$topNews = $d->o_fet("SELECT * FROM #_tintuc WHERE hien_thi = 1 AND category_id=1026 AND noi_bat=1 ORDER BY so_thu_tu ASC, id DESC LIMIT 0,100");
$homeImgs = $d->getImg(2047);
$nganhnghe = $d->o_fet("SELECT * FROM #_category WHERE hien_thi = 1 AND category_id=1113 ORDER BY so_thu_tu ASC, id DESC");

$doiTacs = $d->o_fet("SELECT * FROM `#_gallery` WHERE `parent` = 1117 AND `hide` = 1");
?>
<style type="text/css">
	@media(min-width: 1025px) {
		.slider-gallery {
			margin-top: 40px;
		}
	}

	.item-tin .wrap-img {
		background: #fff;
		border-radius: 4px;
	}

    .nganh-nghe .slider-doitacs img {
        height: 145px;
        margin: 0 auto;
    }
	/*
	@media (min-width:992px){
		.row-flex-index{
			display: flex;
			flex-wrap: wrap;
		}
		.slider-gallery-wrap{
			display: flex;
			align-items: center;
		}
	}*/
</style>
<div class="clearfix mb20"></div>
<?php $view_home_gallery = $d->getOption('view_home_gallery');?>
<section class="sec-home">
	<div class="container p01">
		<div class="row10 row-flex-index">
			<div class="<?php echo $view_home_gallery?'col-md-4':'col-md-8'?> about-us plr10">
				<div class="title-main">
					<h3><?= $home_content['name_' . $lang] ?></h3>
				</div>
				<div class="content-about text-justify">
					<?= $home_content['content_' . $lang] ?>
				</div>
                <span class="more cursor-pointer" style="font-weight: bold; color: #0000c3;">Xem thêm</span>
			</div>
			<div class="<?php echo $view_home_gallery?'col-md-4':'col-md-4'?> hot-news plr10">
				<div class="title-main">
					<h3><?= _tintucnoibat ?></h3>
				</div>
				<div class="news-home text-justify">
					<ul>
						<?php foreach ($topNews as $key => $item) : ?>
							<li>
								<i class="fa fa-angle-double-right"></i>
								<a href="<?= URLPATH . $item['alias_' . $lang] ?>.html" title="<?= $item['name_' . $lang] ?>"><?= $item['name_' . $lang] ?></a>
							</li>
						<?php endforeach ?>
					</ul>
				</div>
                <span class="more cursor-pointer" style="font-weight: bold; color: #0000c3;">Xem thêm</span>
			</div>
			<?php 
			if($view_home_gallery){
			?>
			<div class="col-md-4 plr10">
				<div class="slider-gallery-wrap">
					<div class="slider-gallery">
						<?php
						foreach ($homeImgs as $img) :
						?>
							<div class="img-gal">
								<a href="<?= $img['link'] ?>" title="<?= $img['title_vi'] ?>">
									<img alt="<?= $img['body_vn'] ?>" src="<?= THUMB_BASE ?>images/500/330/<?= $img['picture'] ?>" onerror="this.src='<?= $d->getDefaultProductImage(500, 330) ?>';">
								</a>
							</div>
						<?php endforeach ?>
					</div>
				</div>
			</div>
			<?php }?>
		</div>
	</div>
</section>
<div class="clearfix"></div>

<?php 
$view_home_business = $d->getOption('view_home_business');
if($view_home_business){
?>
<section class="sec-nganhnghe hidden-xs">
	<div class="container p0">
		<div class="title-nganh">
			<h3><?= _nganhnghe ?>:</h3>
		</div>
		<div class="list-nganh">
			<?php foreach ($nganhnghe as $key => $item) : ?>
				<a href="<?= URLPATH . $item['alias_' . $lang] ?>.html" title="<?= $item['name_' . $lang] ?>">
					<?= $item['name_' . $lang] ?>
				</a>
			<?php endforeach ?>
		</div>
	</div>
</section>
<div class="clearfix"></div>

<section class="sec-pro hidden-xs">
	<div class="container">
		<div class="row10 nganh-nghe">
			<div class="slider-doitacs">
				<?php foreach ($doiTacs as $key => $doitac) {
				?>
					<div class="col-md-2 col-sm-12 plr10">
						<div class="clearfix item-tin mb10">
							<div class="img-slogan">
								<a href="<?= $doitac['link'] ?>" title="<?php echo $doitac['title_' . $lang] ?>" target="_blank">
									<div class="wrap-img">
										<img alt="<?php echo $doitac['title_' . $lang] ?>" onerror="this.src='<?= $d->getDefaultProductImage() ?>';" src="<?= THUMB_BASE ?>images/190/120/<?= $doitac['picture'] ?>?zc=0">
									</div>
								</a>
							</div>
						</div>
					</div>
				<?php
				}
				?>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</section>
<div class="clearfix mb20"></div>
<?php }?>

<script>
	$(document).ready(function() {
		$('[data-toggle="tooltip"]').tooltip();
	});
</script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
        $('.hot-news .more.cursor-pointer').on('click', function () {
            if($('.hot-news .news-home').hasClass('expanded')) {
                $(this).html('Xem thêm');
                $('.hot-news .news-home').removeClass('expanded');
            } else {
                $('.hot-news .news-home').addClass('expanded');
                $(this).html('Thu gọn');
            }
        });

        $('.sec-home .about-us .more.cursor-pointer').on('click', function () {
            if($('.sec-home .about-us .content-about').hasClass('expanded')) {
                $(this).html('Xem thêm');
                $('.sec-home .about-us .content-about').removeClass('expanded');
            } else {
                $('.sec-home .about-us .content-about').addClass('expanded');
                $(this).html('Thu gọn');
            }
        });

        let heightContentAbout = $('.sec-home .about-us .content-about').height();
        if (heightContentAbout > 295) {
            $('.sec-home .about-us .content-about').css('height', '295px');
            $('.sec-home .about-us .more.cursor-pointer').show();
        } else {
            $('.sec-home .about-us .more.cursor-pointer').hide();
        }

		$('.slider-doitacs').slick({
			slidesToShow: 7,
			autoplay: true,
			autoplaySpeed: 4000,
			prevArrow: "<button class='style-bt bt-prev'><i class='fa fa-chevron-left'></i></button>",
			nextArrow: "<button class='style-bt bt-next'><i class='fa fa-chevron-right'></i></button>",
			responsive: [{
					breakpoint: 991,
					breakpointSettings: {
						slidesToShow: 3,
						slidesToScroll: 3
					}
				},
				{
					breakpoint: 480,
					breakpointSettings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}
			]
		});
	});
</script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('.slider-gallery').slick({
			slidesToShow: 1,
			autoplay: true,
			atoplaySpeed: 4000,
			prevArrow: "",
			nextArrow: "",
		});
	});
</script>