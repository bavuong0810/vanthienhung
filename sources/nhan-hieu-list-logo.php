<?php
$brands2 = $d->o_fet("SELECT id, name, slug, image, is_show, is_featured, group_id, so_luong FROM #_brand WHERE name <> '' AND name IS NOT NULL AND is_show = 1 ORDER BY name ASC");
?>
<?php if (@$_SESSION['is_admin']) {
    
    $changeImage_hideSlide = true;
    $changeImage_baseFile = '/';
    $changeImage_api = '/api.php?func=changeBrandLogo';
    ?>
<style>
    .br-item {
        position: relative;
    }
</style>
<?php } ?>
<section class="mt-1">
	<div class="container">
		<h2 class="text-center text-uppercase mb-1">Nhãn hiệu</h2>

        <ul class="brand-grid">
            <?php
            if( $brands2 ){
                foreach( $brands2 as $br2 ){
					if (!$br2['image']) {
						$img = $d->getDefaultProductImage();
					} else {
						$img = URLPATH . 'images/brands/200/100/' . $br2['image'] . '?zc=0';
					}
            ?>
                <li class="br-item">
                    <a href="/nhan-hieu/<?php echo $br2['slug'] ?>.html" title="<?php echo $br2['name'] ?>" target="_blank" class="img-shine-2">
						<span class="brand-logo-wrap">
                            <img class="product_image_<?php echo $br2['id'] ?>" src="<?php echo $img ?>" alt="<?php echo $br2['name'] ?>" title="<?php echo $br2['name'] ?>" onerror="this.src='<?= $d->getDefaultProductImage() ?>';">
                        </span>
                        <span class="brand-name"><span class="item-title-<?php echo $br2['id']; ?>"><?php echo $br2['name'] ?></span> (<?php echo $br2['so_luong']?$br2['so_luong']:'0' ?>)</span>
                    </a>
                    <?php if (@$_SESSION['is_admin']) { ?>
                        <a data-id="<?php echo $br2['id']; ?>" data-image="<?= $img ?>" href="#" title="Xóa ảnh" class="btn btn-circle btn-del-img text-center btn-danger" style="
                            position: absolute;
                            z-index: 2;
                            top: 0;
                            left: 5px;
                        "><i class="fa fa-close" style="width: 20px;height: 20px;line-height: 20px;"></i></a>
                        <a data-id="<?php echo $br2['id']; ?>" href="javascript:void(0)" onclick="changeImage(this)" title="Đổi ảnh" class="btn btn-circle text-center btn-warning quick-item-<?php echo $br2['id']; ?>"
                        data-title="<?= $br2['name'] ?>" data-image="<?= $br2['image'] ?>"
                        style="
                            position: absolute;
                            z-index: 2;
                            top: 0;
                            left: 45px;
                        ">
                            <i class="fa fa-file-image-o" aria-hidden="true" style="width: 20px;height: 20px;line-height: 20px;"></i>
                        </a>
                        <a href="/admin/index.php?p=brand&a=edit&id=<?php echo $br2['id']; ?>" title="Chỉnh sửa sản phẩm" class="btn btn-circle text-center btn-success" style="
                            position: absolute;
                            z-index: 2;
                            top: 0;
                            right: 5px;
                        "><i class="fa fa-pencil" style="width: 20px;height: 20px;line-height: 20px;"></i></a>
                    <?php } ?>
                </li>
            <?php
                }
            }
            ?>
        </ul>
			
	</div>
</section>

<style type="text/css">
	.clearfix:after{
		content:"";
		clear: both;
		display: table;
	}
    .brand-grid{
        list-style: none;
        padding: 0;
        margin: 0 -10px;
        display: grid;
        grid-template-columns: 14.28571% 14.28571% 14.28571% 14.28571% 14.28571% 14.28571% 14.28571%;
    }
    .br-item{
        margin: 0 0 20px;
        padding: 0 10px;
    }
    .br-title{
        text-transform: uppercase;
        font-weight: 700;
        display: none;
    }
	.brand-logo-wrap{
		position: relative;
		padding: 0 0 68%;
		display: block;
		background-color: #ffffff;
	}
	.brand-logo-wrap img{
		position: absolute;
		top: 50%;
		left: 50%;
        transform: translate(-50%,-50%);
	}

    @media (max-width: 1199px){
        .brand-grid{
            grid-template-columns: 20% 20% 20% 20% 20%;
        }
    }
    @media (max-width: 991px){
        .brand-grid{
            grid-template-columns: 25% 25% 25% 25%;
        }
    }
    @media (max-width: 767px){
        .brand-grid{
            grid-template-columns: 50% 50%;
        }
    }
    
</style>