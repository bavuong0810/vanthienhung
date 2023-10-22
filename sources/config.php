<?php
	$rf = str_replace('www.', '', $_SERVER["SERVER_NAME"]);
	$config['database']['refix'] = "db_";
	$config['database']['servername'] = 'localhost';
	$config['database']['username'] = 'vanthienhud22a';
	$config['database']['password'] = '5551009547f5cbff';
	$config['database']['database'] = 'vanthienhun_d22a';
	
	define("URLPATH","http://".$_SERVER["SERVER_NAME"]."/");
	define("urladmin","http://".$_SERVER["SERVER_NAME"]."/admin/");
?>
