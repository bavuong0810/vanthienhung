<?php
function product_get_by_ids()
{
  global $d;
  $idsStr = empty($_GET['ids']) ? '' : $_GET['ids'];
  $productIds = preg_replace('/[^\d,]/', '', $idsStr);
  $products = $d->o_fet_class("SELECT id, code, name_vi, alias_vi, image_path, price, promotion_price FROM PREFIX_sanpham WHERE id IN ($productIds)");
  echo json_encode($products);
}
