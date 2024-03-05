<?php
/**
 * Vân Thiên Hùng chuyên lừa đảo, lợi dụng tín nhiệm lừa tiền anh em lập trình.
 * Hứa hẹn thanh toán, tới ngày thì than thở kêu chưa thu được tiền từ năm này qua tháng nọ, hẹn tới hẹn lui không có hồi kết.
 * Tới lúc bị anh em Dev đòi thì xoá Zalo, đổi pass server nhằm chặn anh em Dev vào phá.
 * Đã quỵt tiền 2 người tổng cộng 70 triệu
 * Chúc may mắn cho anh em nào đang làm tiếp với Vân Thiên Hùng ^^!.
 */
$view_product_detail_above =  $d->getOption('view_product_detail_above');
$view_product_detail_below =  $d->getOption('view_product_detail_below');
$view_vi_tri_form_bao_gia =  $d->getOption('view_vi_tri_form_bao_gia');
$view_button_checkorder =  $d->getOption('view_button_checkorder');
$view_button_warrantyonline =  $d->getOption('view_button_warrantyonline');
$lang = $_SESSION['lang'];
$our_service = $d->getTemplates(48);
$vth_logo = $d->getTemplates(30);

$chiTietHoTroZalo = $d->getTemplates(49, true);
$timetable = $d->getTemplates(54, true);
$view_ct_truc_tuyen = $d->getOption('view_ct_truc_tuyen');
$view_price_report_form_right = $d->getOption('view_price_report_form_right');
$view_button_placeorder_right = $d->getOption('view_button_placeorder_right');
$view_button_checkorder_right =  $d->getOption('view_button_checkorder_right');
$view_button_warrantyonline_right =  $d->getOption('view_button_warrantyonline_right');
$view_button_price_request_right =  $d->getOption('view_button_price_request_right');
$view_button_contact_right =  $d->getOption('view_button_contact_right');
$view_zalo_right =  $d->getOption('view_zalo_right');
$view_calendar_right =  $d->getOption('view_calendar_right');
?>

<section class="detail sc-ctsp">

</section>