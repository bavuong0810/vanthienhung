<?php
$view_home_services = $d->getOption('view_home_services');
if(!$view_home_services){
    return;
}
?>

  <?php
  $categories = $d->o_fet("select id, alias_vi, name_vi  from #_category where hien_thi=1 and module=3 and category_id=0 order by so_thu_tu asc");
  ?>
  <section class="sec-tags hidden-xs">
    <div class="container">
      <h3><?= _spdichvu ?></h3>
      <div class="ct-tags">
        <?php 
        foreach ($categories as $cat) :
          echo '<a class="a-tags" href="' . URLPATH . $cat['alias_vi'] . '.html">' . $cat['name_vi'] . '</a>';
          $cat_id = $cat['id'];
          $categories_2 = $d->o_fet("select alias_vi, name_vi  from #_category where hien_thi=1 and module=3 and category_id=$cat_id order by so_thu_tu asc");
          if( $categories_2 ){
            foreach( $categories_2 as $cat_2 ){
              echo '<a class="a-tags" href="' . URLPATH . $cat_2['alias_vi'] . '.html">' . $cat_2['name_vi'] . '</a>';
            }
          }
        endforeach 
        ?>
      </div>
    </div>
  </section>

<?php
//   $cacheContent = ob_get_flush();
//   file_put_contents($cachePath, minify_html($cacheContent));
// }
?>