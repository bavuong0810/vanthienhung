<?php
ob_start();
global $d;
$d->reset();
if ($_REQUEST['alias1'] == 1) {
    $offset = 0;
} else {
    $offset = 5000 * ($_REQUEST['alias1'] - 1);
}
$limit = 'LIMIT ' . $offset . ', 5000';
$products = $d->o_fet("select alias_vi, updated_at from #_sanpham where hien_thi = 1 order by so_thu_tu asc, id desc " . $limit);

$xml_file = '';
$xml_file = '<?xml version="1.0" encoding="UTF-8"?>';
$xml_file .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns:xhtml="http://www.w3.org/1999/xhtml">';
$DefaultProductImage = $d->getDefaultProductImage();
foreach ($products as $product) {
    $productLink = URLPATH . $product['alias_vi'].'.html';
    $updated_at = ($product['updated_at'] != '') ? date("Y-m-d", strtotime($product['updated_at'])) : date('Y-m-d');
    $xml_file .= '
    <url>
        <loc>' . $productLink . '</loc>
        <lastmod>' . $updated_at . '</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>';
}
?>
<?php
$xml_file .='</urlset>';
header('Content-type: text/xml');
echo $xml_file;
ob_flush();
?>
