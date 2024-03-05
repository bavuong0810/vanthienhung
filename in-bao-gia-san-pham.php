<?php
/**
 * Vân Thiên Hùng chuyên lừa đảo, lợi dụng tín nhiệm lừa tiền anh em lập trình.
 * Hứa hẹn thanh toán, tới ngày thì than thở kêu chưa thu được tiền từ năm này qua tháng nọ, hẹn tới hẹn lui không có hồi kết.
 * Tới lúc bị anh em Dev đòi thì xoá Zalo, đổi pass server nhằm chặn anh em Dev vào phá.
 * Đã quỵt tiền 2 người tổng cộng 70 triệu
 * Chúc may mắn cho anh em nào đang làm tiếp với Vân Thiên Hùng ^^!.
 */
include 'admin/lib/html2pdf/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

try {
    $html2pdf = new Html2Pdf('P', 'A4', 'en', true, 'UTF-8', array(0, 0, 0, 0));
    $html2pdf->pdf->SetDisplayMode('fullpage');
    ob_start();

    @include_once "./admin/lib/config.php";
    @include_once "./admin/lib/function.php";
    global $d;
    $d = new func_index($config['database']);
   
    $view_print_price_template = $d->getOption('view_print_price_template');
    if($view_print_price_template == 2){
        include 'bao-gia-san-pham3.php';
    } else {
        include 'bao-gia-san-pham.php';
    }
    
    $content = ob_get_clean();
    $html2pdf->writeHTML($content);
    // error_reporting(0);
    // $html2pdf->addFont('arial', '', dirname(__FILE__) . '/arial.ttf');
    $html2pdf->setDefaultFont('freeserif');
    $html2pdf->createIndex('', 30, 12, false, true, 1, "freeserif");
    $html2pdf->output(getenv('APP_DOMAIN') . '-' . date('Y-m-d') . '.pdf', 'I');
} catch (Html2PdfException $e) {
    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}