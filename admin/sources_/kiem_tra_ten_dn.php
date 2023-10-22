<?php
	if(!isset($_SESSION)){
		session_start();
	}

	@define('_template','../templates/');
	@define('_source','../sources/');
	@define('_lib','../lib/');

	@include _lib."config.php";
	@include_once _lib."function.php";
	$d = new func_index($config['database']);


	$bang = addslashes($_POST['bang']);
	$name_vi = addslashes($_POST['name_vi']);

	$sql = "select id from ".$bang." where name_vi = '".trim($name_vi," ")."'";
	if(count($d->o_fet($sql)) == 0) echo 1;
	else echo 0;
?>