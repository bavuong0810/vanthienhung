<?php
if (isset($_REQUEST['lang'])) {
	$langcom 			= $_REQUEST['langcom'];
	$_SESSION['lang'] 	= $_REQUEST['lang'];

	$query 		= $d->o_fet("select alias_vi,alias_en,alias_ch from #_category where alias_vi='$langcom' OR alias_en='$langcom' OR alias_ch='$langcom'");
	$query_news = $d->o_fet("select alias_vi,alias_en,alias_ch from #_tintuc where alias_vi='$langcom' OR alias_en='$langcom' OR alias_ch='$langcom'");
	$query_pro  = $d->o_fet("select alias_vi,alias_en,alias_ch from #_sanpham where alias_vi='$langcom' OR alias_en='$langcom' OR alias_ch='$langcom'");

	if(count($query)>0 && $langcom!=''){
		header("Location:".URLPATH.$query['0']['alias_'.$_REQUEST['lang']].'.html');
	}
	elseif(count($query_news)>0 && $langcom!=''){	
		header("Location:".URLPATH.$query_news['0']['alias_'.$_REQUEST['lang']].'.html');
	}
	elseif(count($query_pro)>0 && $langcom!=''){	
		header("Location:".URLPATH.$query_pro['0']['alias_'.$_REQUEST['lang']].'.html');
	}
	else{
		header("Location:".URLPATH);
	}
}
