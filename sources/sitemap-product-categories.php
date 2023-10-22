<?php
ob_start();
global $d;
$d->reset();
$categories = $d->o_fet("select alias_vi, updated_at, created_at from #_category where hien_thi = 1 order by so_thu_tu asc,id desc");
$xml_file='';
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns:xhtml="http://www.w3.org/1999/xhtml">';
foreach ($categories as $category) {
    $updated_at = ($category['updated_at'] != '') ? date("Y-m-d", strtotime($category['updated_at'])) : date('Y-m-d');
    $xml_file .= '
    <url>
        <loc>' . URLPATH . $category['alias_vi'] . '.html</loc>
        <lastmod>' . $updated_at . '</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>';
}
?>
<?php
$xml_file .='</urlset>';
header('Content-type: text/xml');
echo $xml_file;
ob_flush();
?>
