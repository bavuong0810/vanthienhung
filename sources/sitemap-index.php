<?php
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
