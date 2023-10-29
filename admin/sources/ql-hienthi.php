<?php
if(!defined('_source')) die("Error");
$a = (isset($_REQUEST['a'])) ? addslashes($_REQUEST['a']) : "";
switch($a){

	case "man":
        global $d;
        // check table option have option_name 'view_san_pham_tieu_bieu_top'
        $query_san_pham_tieu_bieu_top = "SELECT * FROM `#_options` WHERE `option_name` = 'view_san_pham_tieu_bieu_top'";
        $result = $d->simple_fetch($query_san_pham_tieu_bieu_top);
        if (count($result) == 0) {
            $d->query("INSERT INTO `#_options`(`option_name`, `option_value_1`) VALUES('view_san_pham_tieu_bieu_top', '0')");
        }

        // check table option have option_name 'view_product_category_list_layout_2'
        $query_product_category_list_layout_2 = "SELECT * FROM `#_options` WHERE `option_name` = 'view_product_category_list_layout_2'";
        $result = $d->simple_fetch($query_product_category_list_layout_2);
        if (count($result) == 0) {
            $d->query("INSERT INTO `#_options`(`option_name`, `option_value_1`) VALUES('view_product_category_list_layout_2', '0')");
        }

        // popup zalo
        // check table option have option_name 'popup_zalo_title'
        $query_popup_zalo_title = "SELECT * FROM `#_options` WHERE `option_name` = 'popup_zalo_title'";
        $result = $d->simple_fetch($query_popup_zalo_title);
        if (count($result) == 0) {
            $d->query("INSERT INTO `#_options`(`option_name`, `option_value_1`) VALUES('popup_zalo_title', '')");
        }
        // check table option have option_name 'popup_zalo_phone'
        $query_popup_zalo_phone = "SELECT * FROM `#_options` WHERE `option_name` = 'popup_zalo_phone'";
        $result = $d->simple_fetch($query_popup_zalo_phone);
        if (count($result) == 0) {
            $d->query("INSERT INTO `#_options`(`option_name`, `option_value_1`) VALUES('popup_zalo_phone', '')");
        }
        // check table option have option_name 'popup_zalo_address'
        $query_popup_zalo_address = "SELECT * FROM `#_options` WHERE `option_name` = 'popup_zalo_address'";
        $result = $d->simple_fetch($query_popup_zalo_address);
        if (count($result) == 0) {
            $d->query("INSERT INTO `#_options`(`option_name`, `option_value_1`) VALUES('popup_zalo_address', '')");
        }
        // check table option have option_name 'popup_zalo_address'
        $query_popup_zalo_website = "SELECT * FROM `#_options` WHERE `option_name` = 'popup_zalo_website'";
        $result = $d->simple_fetch($query_popup_zalo_website);
        if (count($result) == 0) {
            $d->query("INSERT INTO `#_options`(`option_name`, `option_value_1`) VALUES('popup_zalo_website', '')");
        }
        // check table option have option_name 'popup_zalo_mail'
        $query_popup_zalo_mail = "SELECT * FROM `#_options` WHERE `option_name` = 'popup_zalo_mail'";
        $result = $d->simple_fetch($query_popup_zalo_mail);
        if (count($result) == 0) {
            $d->query("INSERT INTO `#_options`(`option_name`, `option_value_1`) VALUES('popup_zalo_mail', '')");
        }
        // check table option have option_name 'popup_zalo_description'
        $query_popup_zalo_description = "SELECT * FROM `#_options` WHERE `option_name` = 'popup_zalo_description'";
        $result = $d->simple_fetch($query_popup_zalo_description);
        if (count($result) == 0) {
            $d->query("INSERT INTO `#_options`(`option_name`, `option_value_1`) VALUES('popup_zalo_description', '')");
        }
        // check table option have option_name 'popup_zalo_qr'
        $query_popup_zalo_qr = "SELECT * FROM `#_options` WHERE `option_name` = 'popup_zalo_qr'";
        $result = $d->simple_fetch($query_popup_zalo_qr);
        if (count($result) == 0) {
            $d->query("INSERT INTO `#_options`(`option_name`, `option_value_1`) VALUES('popup_zalo_qr', '')");
        }

		showdulieu();
		$template = @$_REQUEST['p']."/them";
		break;
	case "save":
		luudulieu();
		break;
	default:
		$template = "index";
}

function showdulieu(){
	global $d, $items;
	$d->disableCacheQuery();
}

function luudulieu(){
	global $d;
	$data['view_san_pham'] = $_POST['view_san_pham'];
	$data['view_ho_tro'] = $_POST['view_ho_tro'];
	$data['view_footer'] = $_POST['view_footer'];
	$view_footer_content = addslashes($_POST['view_footer_content']);

	$data['view_dm_truc_tuyen'] = $_POST['view_dm_truc_tuyen'];
	$data['view_ct_truc_tuyen'] = $_POST['view_ct_truc_tuyen'];
	$data['view_thong_so'] = $_POST['view_thong_so'];
	$data['view_san_pham_layout'] = $_POST['view_san_pham_layout'];
    $data['view_product_category_list_layout_2'] = $_POST['view_product_category_list_layout_2'];

	$data['view_home_slider'] = $_POST['view_home_slider'];
	$data['view_home_gallery'] = $_POST['view_home_gallery'];
	$data['view_home_business'] = $_POST['view_home_business'];
	$data['view_home_services'] = $_POST['view_home_services'];
	$data['view_chi_tiet_san_pham'] = $_POST['view_chi_tiet_san_pham'];
	$data['view_san_pham_tieu_bieu'] = $_POST['view_san_pham_tieu_bieu'];
    $data['view_san_pham_tieu_bieu_top'] = $_POST['view_san_pham_tieu_bieu_top'];
	$data['view_button_placeorder'] = $_POST['view_button_placeorder'];

	$data['view_num_category'] = $_POST['view_num_category'];
	$data['view_num_related'] = $_POST['view_num_related'];

	$data['view_price_report_form_right'] = $_POST['view_price_report_form_right'];
	$data['view_product_description'] = $_POST['view_product_description'];

	$data['footer_widget_title_4'] = $_POST['footer_widget_title_4'];
	$data['view_button_placeorder_right'] = $_POST['view_button_placeorder_right'];
	$data['view_ban_do_bottom'] = $_POST['view_ban_do_bottom'];
	$data['view_product_noprice'] = $_POST['view_product_noprice'];

	$data['footer_copyright'] = $_POST['footer_copyright'];
	$data['footer_design_by'] = $_POST['footer_design_by'];

	$data['view_print_price_request'] = $_POST['view_print_price_request'];
	$data['view_print_price_template'] = $_POST['view_print_price_template'];
	$data['view_vnpay_payment'] = $_POST['view_vnpay_payment'];

	$data['view_product_detail_above'] = $_POST['view_product_detail_above'];
	$data['view_product_detail_below'] = $_POST['view_product_detail_below'];

	$data['view_danh_muc'] = $_POST['view_danh_muc'];
	$data['view_nhan_hieu'] = $_POST['view_nhan_hieu'];
	$data['view_add_to_cart'] = $_POST['view_add_to_cart'];
	$data['view_request_price'] = $_POST['view_request_price'];

	$data['view_website_fullwidth'] = $_POST['view_website_fullwidth'];
	$data['view_right_sidebar_large'] = $_POST['view_right_sidebar_large'];
	$data['view_small_button_placeorder'] = $_POST['view_small_button_placeorder'];

	$data['view_vi_tri_nhan_hieu'] = $_POST['view_vi_tri_nhan_hieu'];
	$data['view_vi_tri_form_bao_gia'] = $_POST['view_vi_tri_form_bao_gia'];

	$data['view_button_facebook_zalo'] = $_POST['view_button_facebook_zalo'];
	$data['view_button_like_share'] = $_POST['view_button_like_share'];
	$data['view_menu_type'] = $_POST['view_menu_type'];
	$data['view_menu_brand_type'] = $_POST['view_menu_brand_type'];
	$data['view_menu_brand_button'] = $_POST['view_menu_brand_button'];
	$data['view_count_product'] = $_POST['view_count_product'];
	$data['view_menu_category_brand'] = $_POST['view_menu_category_brand'];
	$data['view_btn_contact'] = $_POST['view_btn_contact'];

	$data['view_button_checkorder_right'] = $_POST['view_button_checkorder_right'];
	$data['view_button_warrantyonline_right'] = $_POST['view_button_warrantyonline_right'];
	$data['view_button_price_request_right'] = $_POST['view_button_price_request_right'];
	$data['view_button_contact_right'] = $_POST['view_button_contact_right'];
	$data['view_zalo_right'] = $_POST['view_zalo_right'];
	$data['view_calendar_right'] = $_POST['view_calendar_right'];

	$data['view_button_checkorder_left'] = $_POST['view_button_checkorder_left'];
	$data['view_button_warrantyonline_left'] = $_POST['view_button_warrantyonline_left'];
	$data['view_button_price_request_left'] = $_POST['view_button_price_request_left'];
	$data['view_button_contact_left'] = $_POST['view_button_contact_left'];
	$data['view_zalo_left'] = $_POST['view_zalo_left'];
	$data['view_calendar_left'] = $_POST['view_calendar_left'];

	$data['view_button_checkorder'] = $_POST['view_button_checkorder'];
	$data['view_button_warrantyonline'] = $_POST['view_button_warrantyonline'];

	$data['view_category_page'] = $_POST['view_category_page'];
	$data['view_brand_page_type'] = $_POST['view_brand_page_type'];

	$data['view_shipping_content'] = addslashes($_POST['view_shipping_content']);
	$data['view_return_content'] = addslashes($_POST['view_return_content']);

    //popup zalo
    $data['popup_zalo_title'] = $_POST['popup_zalo_title'];
    $data['popup_zalo_phone'] = $_POST['popup_zalo_phone'];
    $data['popup_zalo_address'] = $_POST['popup_zalo_address'];
    $data['popup_zalo_website'] = $_POST['popup_zalo_website'];
    $data['popup_zalo_mail'] = $_POST['popup_zalo_mail'];
    $data['popup_zalo_description'] = addslashes($_POST['popup_zalo_description']);
    $data['popup_zalo_qr'] = $_POST['popup_zalo_qr'];

	foreach( $data as $key=>$val ){
		$d->disableCacheQuery();
		$d->reset();
		
		if( $key == 'view_footer' ){
			$d->updateOption($key, $val, $view_footer_content);
		} else {
			$d->updateOption($key, $val);
		}
	}
	$d->disableCacheQuery();
	$d->reset();
	$d->clearMemCached();
	$d->alert("Cập nhật dữ liệu thành công.");
	$d->redirect("index.php?p=".$_GET['p']."&a=man");
}