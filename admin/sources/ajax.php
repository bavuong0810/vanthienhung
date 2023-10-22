<?php
	define('_lib','../lib/');
	@include _lib."config.php";
	@include_once _lib."function.php";
	$d = new func_index($config['database']);

	$do = addslashes($_POST['do']);
	
	if($do=='update_stt') {
		$table = $_POST['table'];
		$col = $_POST['col'];
		$val = $_POST['val'];
		$id = $_POST['id'];
		$d->o_que("update $table set $col=$val where id=$id");
	}
	else if($do=='get_list_extra') {

		$id = $_POST['id'];
		$id =implode(", ", $id);
		$list = $d->o_fet("select * from #_extra where id IN ($id) order by stt asc,id desc");
		//$selected="selected='selected'";
		//echo $str1 ='<option></option>';
		foreach($list as $a) {
			
			echo $str = "<option value='{$a['id']}' >{$a['title_vi']}</option>";
		}

	}

?>