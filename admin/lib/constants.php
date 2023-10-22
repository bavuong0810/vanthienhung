<?php
$currentDomain = str_replace('www.', '', $_SERVER['HTTP_HOST']) ?: 'vanthienhung.vn';

define('SITE_DOMAIN', $currentDomain);

$config['domainNameMap'] = [
  'phutungoto.online' => 'phutungoto_ol',
  'bacdan.online' => 'bacdan_online',
  'phutungxecogioi.online' => 'phutungxecogioi_online',
  'phutungxenang.online' => 'phutungxenang_online',
  'phutungxe.online' => 'phutungxe_online',
  'chodansin.online' => 'chodansin_online',
  'phutungxetai.online' => 'phutungxetai_online',
  'congnghiepbinhduong.com.vn' => 'cnbd_com_vn',
  'suaxe.online' => 'suaxe_online',
  'thuyluc.online' => 'thuyluc_online',
  'congnghiepbinhduong.online' => 'cnbd_online',
  'vanthienhung.com' => 'vth_com',
  'congnghiepbinhduong.vn' => 'cnbd_vn',
  'vanthienhung.com.vn' => 'vth_com_vn',
  'congnghiepdongnai.vn' => 'cndn_vn',
  'vanthienhung.online' => 'vanthienhung_ol',
  'congnghiephanoi.vn' => 'cnhn_vn',
  'vanthienhung.vn' => 'vth_vn',
  'congnghiepnguyenle.vn' => 'nguyenle_vn',
  'voxe.online' => 'voxe_online',
  'daycuroa.online' => 'daycuroa_online',
  'xenang.online' => 'xenang_online',
  'xetai.online' => 'xetai_online',
];

if (!defined('MIN_PRICE')) {
  define("MIN_PRICE", 0);
}
