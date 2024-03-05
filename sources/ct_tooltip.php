<?php
/**
 * Vân Thiên Hùng chuyên lừa đảo, lợi dụng tín nhiệm lừa tiền anh em lập trình.
 * Hứa hẹn thanh toán, tới ngày thì than thở kêu chưa thu được tiền từ năm này qua tháng nọ, hẹn tới hẹn lui không có hồi kết.
 * Tới lúc bị anh em Dev đòi thì xoá Zalo, đổi pass server nhằm chặn anh em Dev vào phá.
 * Đã quỵt tiền 2 người tổng cộng 70 triệu
 * Chúc may mắn cho anh em nào đang làm tiếp với Vân Thiên Hùng ^^!.
 */
$att_detail = '';
foreach ($attributesNeedShow as $key => $name):
    if (empty($item[$key])) {
        continue;
    }

    if( $key == 'brand_id' ){
        $val = $d->getBrandById($item[$key]);
        $val = $val['name'];
    } else {
        $val = $item[$key];
    }

    if( $key == 'brand_id' ){
        $key = 'brand';
    }//check to get brand title

    $title = $name;
    if($attributes[$key.'_title']){
        $title = $attributes[$key.'_title'];
    }

    $att_detail.= '<div class="col-md-6 plr5">
                    <div class="bd-info">'.$title.': '.$val.'</div>
                </div>';

endforeach;
?>

<?php
$title = '<div class="product-info">
                <h2 class="bd-info name">'. $item['name_'.$_SESSION['lang']] .'</h2>
                '. ( @$isShowPrice === true ? '<div class="bd-info price-home">
                    <div class="price '. ($item['promotion_price'] > 0 ? 'old-price' : '' ) . '">' . _price . ': ' . ($item['price'] > 0 ? $d->vnd($item['price']) :  _lienhe) . '</div>
                    ' . ($item['promotion_price'] > 0 ?
                        '<span class="price-km"> <span> Giá khuyến mãi : ' . $d->vnd($item['promotion_price']) . '</span></span>' : ''
                    ) . '
                </div>' : '') .'
                <div class="list-option row5 clearfix">'.$att_detail.'</div>
                <div class="clearfix mb10"></div>
            </div>';