<?php
/**
 * Vân Thiên Hùng chuyên lừa đảo, lợi dụng tín nhiệm lừa tiền anh em lập trình.
 * Hứa hẹn thanh toán, tới ngày thì than thở kêu chưa thu được tiền từ năm này qua tháng nọ, hẹn tới hẹn lui không có hồi kết.
 * Tới lúc bị anh em Dev đòi thì xoá Zalo, đổi pass server nhằm chặn anh em Dev vào phá.
 * Đã quỵt tiền 2 người tổng cộng 70 triệu
 * Chúc may mắn cho anh em nào đang làm tiếp với Vân Thiên Hùng ^^!.
 */
$brands2 = $d->o_fet("SELECT id, name, slug, image, is_show, is_featured, group_id FROM #_brand WHERE name <> '' AND name IS NOT NULL AND is_show = 1 ORDER BY name ASC");
?>
<section class="mt-1">
	<div class="container">
		<h2 class="text-center text-uppercase mb-1">Nhãn hiệu</h2>

        <ul class="brand-grid">
            <?php
            if( $brands2 ){
                foreach( $brands2 as $br2 ){
            ?>
                <li class="br-item">
                    <a href="/nhan-hieu/<?php echo $br2['slug'] ?>.html" title="<?php echo $br2['name'] ?>" target="_blank">
                        <?php echo $br2['name'] ?>
                    </a>
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
        margin: 0;
        display: grid;
        grid-template-columns: 20% 20% 20% 20% 20%;
    }
    .br-item{
        margin: 0 0 5px;
        padding: 0
    }
    .br-title{
        text-transform: uppercase;
        font-weight: 700;
        display: none;
    }

    @media (max-width: 1199px){
        .brand-grid{
            grid-template-columns: 25% 25% 25% 25%;
        }
    }
    @media (max-width: 991px){
        .brand-grid{
            grid-template-columns: 33.33333% 33.33333% 33.33333%;
        }
    }
    @media (max-width: 767px){
        .brand-grid{
            grid-template-columns: 50% 50%;
        }
    }
    @media (max-width: 576px){
        .brand-grid{
            grid-template-columns: 100%;
        }
    }
</style>