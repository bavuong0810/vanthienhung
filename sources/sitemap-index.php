<?php
/**
 * Vân Thiên Hùng chuyên lừa đảo, lợi dụng tín nhiệm lừa tiền anh em lập trình.
 * Hứa hẹn thanh toán, tới ngày thì than thở kêu chưa thu được tiền từ năm này qua tháng nọ, hẹn tới hẹn lui không có hồi kết.
 * Tới lúc bị anh em Dev đòi thì xoá Zalo, đổi pass server nhằm chặn anh em Dev vào phá.
 * Đã quỵt tiền 2 người tổng cộng 70 triệu
 * Chúc may mắn cho anh em nào đang làm tiếp với Vân Thiên Hùng ^^!.
 */
ob_start();

global $d;
$d->reset();
$numberOfProducts = $d->o_fet("SELECT COUNT(id) AS NumberOfProducts FROM #_sanpham;");
$numberPages = ceil($numberOfProducts[0]['NumberOfProducts'] / 10000);
$sitemapForProducts = '';
for ($i = 1; $i <= $numberPages; $i++) {
    $sitemapForProducts .= '<sitemap>
        <loc>' . @URLPATH . 'sitemap-index/products/' . $i . '.xml</loc>
        <lastmod>' . date('Y-m-d') . '</lastmod>
    </sitemap>';
}
$xml_file='<?xml version="1.0" encoding="utf-8"?>';
$xml_file.= '<sitemapindex xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd">
    <sitemap>
        <loc>' . @URLPATH . '</loc>
        <lastmod>' . date('Y-m-d') . '</lastmod>
    </sitemap>
    <sitemap>
        <loc>' . @URLPATH . 'sitemap-index/news.xml</loc>
        <lastmod>' . date('Y-m-d') . '</lastmod>
    </sitemap>
    <sitemap>
        <loc>' . @URLPATH . 'sitemap-index/product-categories.xml</loc>
        <lastmod>' . date('Y-m-d') . '</lastmod>
    </sitemap>
    ' . $sitemapForProducts . '
         '."\n".'</sitemapindex>';
header('Content-type: text/xml');
echo $xml_file;

ob_flush();
?>
