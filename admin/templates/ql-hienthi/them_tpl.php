<?php @include_once "sources/editor.php" ?>
<style>
    .row-flex{
        display: flex;
        flex-wrap: wrap;
    }
    .row-flex .col-flex {
        margin-bottom: 10px;
    }
    .col-flex .ar_admin{
        height: 100%;
    }
    .ar_admin_v2{
        padding-bottom: 0;
    }
    .tbl-nomargin{
        margin: 0;
    }
	
    input[type=number]{
        width: 100px;
        font-size: 15px;
        line-height: 23px;
        padding: 5px 8px;
    }
</style>
<ol class="breadcrumb">
	<li><a href="<?= URLPATH . "admin" ?>"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
	<li class="active"><a href="<?= URLPATH . "admin" ?>/index.php">Hiển thị</a></li>
	<li class="active"><a href="<?= URLPATH . "admin" ?>/index.php?p=<?= @$_REQUEST['p'] ?>&a=man">Ql hiển thị</a></li>
</ol>

<?php
global $d;
$d->clearMemCached();
$d->disableCacheQuery();
$d->reset();

$view_san_pham = $d->getOption('view_san_pham');
$view_ho_tro = $d->getOption('view_ho_tro');
$view_thong_so = $d->getOption('view_thong_so');
$view_chi_tiet_san_pham = $d->getOption('view_chi_tiet_san_pham');
$view_san_pham_tieu_bieu = $d->getOption('view_san_pham_tieu_bieu');
$view_san_pham_tieu_bieu_top = $d->getOption('view_san_pham_tieu_bieu_top');
$view_button_placeorder = $d->getOption('view_button_placeorder');
$view_small_button_placeorder = $d->getOption('view_small_button_placeorder');

$view_san_pham_layout = $d->getOption('view_san_pham_layout');
$view_num_category = ($d->getOption('view_num_category'))?$d->getOption('view_num_category'):60;
$view_num_related = ($d->getOption('view_num_related'))?$d->getOption('view_num_related'):42;

$view_home_slider = $d->getOption('view_home_slider');
$view_home_gallery = $d->getOption('view_home_gallery');
$view_home_business = $d->getOption('view_home_business');
$view_home_services = $d->getOption('view_home_services');
$view_product_description = $d->getOption('view_product_description');

$opt_view_footer = $d->getOptions('view_footer');
$view_footer = ($opt_view_footer)?$opt_view_footer['option_value_1']:'';
$view_footer_content = ($opt_view_footer)?$opt_view_footer['option_value_2']:'';

$footer_widget_title_4 = $d->getOption('footer_widget_title_4');
$view_ban_do_bottom = $d->getOption('view_ban_do_bottom');
$view_product_noprice = $d->getOption('view_product_noprice');

$footer_copyright = $d->getOption('footer_copyright');
$footer_design_by = $d->getOption('footer_design_by');
$view_print_price_request = $d->getOption('view_print_price_request');
$view_print_price_template = $d->getOption('view_print_price_template');
$view_vnpay_payment =  $d->getOption('view_vnpay_payment');
$view_product_detail_above =  $d->getOption('view_product_detail_above');
$view_product_detail_below =  $d->getOption('view_product_detail_below');
$view_add_to_cart =  $d->getOption('view_add_to_cart');
$view_request_price =  $d->getOption('view_request_price');
$view_website_fullwidth =  $d->getOption('view_website_fullwidth');
$view_right_sidebar_large =  $d->getOption('view_right_sidebar_large');
$view_vi_tri_form_bao_gia =  $d->getOption('view_vi_tri_form_bao_gia');
$view_button_facebook_zalo =  $d->getOption('view_button_facebook_zalo');
$view_button_like_share =  $d->getOption('view_button_like_share');
$view_menu_type =  $d->getOption('view_menu_type');
$view_menu_brand_type =  $d->getOption('view_menu_brand_type');
$view_menu_brand_button =  $d->getOption('view_menu_brand_button');
$view_menu_brand_button =  $d->getOption('view_menu_brand_button');
$view_menu_category_brand =  $d->getOption('view_menu_category_brand');
$view_btn_contact =  $d->getOption('view_btn_contact');
$view_button_checkorder =  $d->getOption('view_button_checkorder');
$view_button_warrantyonline =  $d->getOption('view_button_warrantyonline');
$view_category_page =  $d->getOption('view_category_page');
$view_brand_page_type =  $d->getOption('view_brand_page_type');
$view_product_category_list_layout_2 = $d->getOption('view_product_category_list_layout_2');
//Left col
$view_dm_truc_tuyen = $d->getOption('view_dm_truc_tuyen');
$view_danh_muc =  $d->getOption('view_danh_muc');
$view_nhan_hieu =  $d->getOption('view_nhan_hieu');
$view_vi_tri_nhan_hieu =  $d->getOption('view_vi_tri_nhan_hieu');
$view_count_product =  $d->getOption('view_count_product');

$view_button_checkorder_left =  $d->getOption('view_button_checkorder_left');
$view_button_warrantyonline_left =  $d->getOption('view_button_warrantyonline_left');
$view_button_price_request_left =  $d->getOption('view_button_price_request_left');
$view_button_contact_left =  $d->getOption('view_button_contact_left');
$view_zalo_left =  $d->getOption('view_zalo_left');
$view_calendar_left =  $d->getOption('view_calendar_left');

//Right col
$view_ct_truc_tuyen = $d->getOption('view_ct_truc_tuyen');
$view_price_report_form_right = $d->getOption('view_price_report_form_right');
$view_button_placeorder_right = $d->getOption('view_button_placeorder_right');
$view_button_checkorder_right =  $d->getOption('view_button_checkorder_right');
$view_button_warrantyonline_right =  $d->getOption('view_button_warrantyonline_right');
$view_button_price_request_right =  $d->getOption('view_button_price_request_right');
$view_button_contact_right =  $d->getOption('view_button_contact_right');
$view_zalo_right =  $d->getOption('view_zalo_right');
$view_calendar_right =  $d->getOption('view_calendar_right');

$count_cats = $d->simple_fetch("select count(id) as cntid from #_category where hien_thi=1");

$view_shipping_content =  $d->getOption('view_shipping_content');
$view_return_content =  $d->getOption('view_return_content');

?>

<div class="col-xs-12">
    <form name="frm" method="post" action="index.php?p=ql-hienthi&a=save" enctype="multipart/form-data">
        <div class="row row-flex">
            <div class="col-lg-6 col-flex">
                <div class="ar_admin ar_admin_v2">
                    <table class="table table-bordered table-hover them_dt tbl-nomargin" style="border:none">
                        <tbody>
                            <div class="title_thongtinchung">
                                Danh mục sản phẩm
                            </div>
                            
                            <tr>
                                <td class="td_left" style="vertical-align: top !important;">
                                    Kiểu hiển thị sản phẩm:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="grid"><input <?php echo ($view_san_pham == 'grid')?'checked="checked"':''?> id="grid" type="radio" name="view_san_pham" value="grid"> Dạng Lưới</label></p>
                                    <p style="margin:0"><label for="list"><input <?php echo ($view_san_pham == 'list')?'checked="checked"':''?> id="list" type="radio" name="view_san_pham" value="list"> Dòng Lớn</label></p>
                                    <p style="margin:0"><label for="small_list"><input <?php echo ($view_san_pham == 'small_list')?'checked="checked"':''?> id="small_list" type="radio" name="view_san_pham" value="small_list"> Dòng nhỏ</label></p>						
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="td_left" style="vertical-align: top !important;">
                                    Số lượng mặc định danh mục:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><input type="number" class="form-control" id="view_num_category" name="view_num_category" value="<?php echo $view_num_category?>"></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="td_left" style="vertical-align: top !important;">
                                    Số lượng mặc định sp cùng loại:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><input type="number" id="view_num_related" class="form-control" name="view_num_related" value="<?php echo $view_num_related?>"></p>
                                </td>
                            </tr>

                            <tr>
                                <td class="td_left" style="vertical-align: top !important;">
                                    Hiển thị sản phẩm không có giá:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_product_noprice"><input <?php echo ($view_product_noprice == '1')?'checked="checked"':''?> id="view_product_noprice" type="checkbox" name="view_product_noprice" value="1"> Hiển thị</label></p>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-lg-6 col-flex">
                <div class="ar_admin ar_admin_v2">
                    <table class="table table-bordered table-hover them_dt tbl-nomargin" style="border:none">
                        <tbody>
                            <div class="title_thongtinchung">
                                Chi tiết sản phẩm
                            </div>
                            <tr>
                                <td class="td_left" style="vertical-align: top !important;width:50%">
                                    Hiển thị giao diện 2:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_san_pham_layout"><input <?php echo ($view_san_pham_layout == '2')?'checked="checked"':''?> id="view_san_pham_layout" type="checkbox" name="view_san_pham_layout" value="2"> Giao diện 2</label></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="td_left" style="vertical-align: top !important;width:50%">
                                    Hiển thị danh mục sản phẩm (Dòng lớn) giao diện 2:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_product_category_list_layout_2"><input <?php echo ($view_product_category_list_layout_2 == '1')?'checked="checked"':''?> id="view_product_category_list_layout_2" type="checkbox" name="view_product_category_list_layout_2" value="1"> Giao diện 2</label></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="td_left" style="vertical-align: top !important;">
                                    Bạn cần hỗ trợ:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_ho_tro"><input <?php echo ($view_ho_tro == '1')?'checked="checked"':''?> id="view_ho_tro" type="checkbox" name="view_ho_tro" value="1"> Hiển thị</label></p>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="td_left" style="vertical-align: top !important;">
                                    Hiển thị thông số:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_thong_so"><input <?php echo ($view_thong_so == '1')?'checked="checked"':''?> id="view_thong_so" type="checkbox" name="view_thong_so" value="1"> Hiển thị</label></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="td_left" style="vertical-align: top !important;">
                                    Hiển thị chi tiết sản phẩm:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_chi_tiet_san_pham"><input <?php echo ($view_chi_tiet_san_pham == '1')?'checked="checked"':''?> id="view_chi_tiet_san_pham" type="checkbox" name="view_chi_tiet_san_pham" value="1"> Hiển thị</label></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="td_left" style="vertical-align: top !important;">
                                    Hiển thị sản phẩm tiêu biểu:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_san_pham_tieu_bieu"><input <?php echo ($view_san_pham_tieu_bieu == '1')?'checked="checked"':''?> id="view_san_pham_tieu_bieu" type="checkbox" name="view_san_pham_tieu_bieu" value="1"> Hiển thị</label></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="td_left" style="vertical-align: top !important;">
                                    Hiển thị sản phẩm tiêu biểu (Vị trí trên cùng):
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_san_pham_tieu_bieu_top"><input <?php echo ($view_san_pham_tieu_bieu_top == '1')?'checked="checked"':''?> id="view_san_pham_tieu_bieu_top" type="checkbox" name="view_san_pham_tieu_bieu_top" value="1"> Hiển thị</label></p>
                                </td>
                            </tr>

                            <tr>
                                <td class="td_left" style="vertical-align: top !important;">
                                    Hiển thị mô tả sản phẩm:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_product_description"><input <?php echo ($view_product_description == '1')?'checked="checked"':''?> id="view_product_description" type="checkbox" name="view_product_description" value="1"> Hiển thị</label></p>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="td_left" style="vertical-align: top !important;">
                                    Mẫu trang IN BÁO GIÁ:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="temp1"><input <?php echo ($view_print_price_template == '1')?'checked="checked"':''?> id="temp1" type="radio" name="view_print_price_template" value="1"> Kiểu cũ</label></p>
                                    <p style="margin:0"><label for="temp2"><input <?php echo ($view_print_price_template == '2')?'checked="checked"':''?> id="temp2" type="radio" name="view_print_price_template" value="2"> Kiểu mới</label></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="td_left" style="vertical-align: top !important;">
                                    Hiển thị nút thanh toán VNPAY:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_vnpay_payment"><input <?php echo ($view_vnpay_payment == '1')?'checked="checked"':''?> id="view_vnpay_payment" type="checkbox" name="view_vnpay_payment" value="1"> Hiển thị</label></p>
                                </td>
                            </tr>

                            <tr>
                                <td class="td_left" style="vertical-align: top !important;">
                                    Hiển thị chi tiết sản phẩm (Trên):
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_product_detail_above"><input <?php echo ($view_product_detail_above == '1')?'checked="checked"':''?> id="view_product_detail_above" type="checkbox" name="view_product_detail_above" value="1"> Hiển thị</label></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="td_left" style="vertical-align: top !important;">
                                    Hiển thị chi tiết sản phẩm (Dưới):
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_product_detail_below"><input <?php echo ($view_product_detail_below == '1')?'checked="checked"':''?> id="view_product_detail_below" type="checkbox" name="view_product_detail_below" value="1"> Hiển thị</label></p>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="td_left" style="vertical-align: top !important;">
                                    Hiển thị nút ĐẶT HÀNG:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_button_placeorder"><input <?php echo ($view_button_placeorder == '1')?'checked="checked"':''?> id="view_button_placeorder" type="checkbox" name="view_button_placeorder" value="1"> Hiển thị</label></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="td_left" style="vertical-align: top !important;">
                                    Hiển thị nút ĐẶT HÀNG (Nhỏ):
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_small_button_placeorder"><input <?php echo ($view_small_button_placeorder == '1')?'checked="checked"':''?> id="view_small_button_placeorder" type="checkbox" name="view_small_button_placeorder" value="1"> Hiển thị</label></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="td_left" style="vertical-align: top !important;">
                                    Hiển thị nút IN BÁO GIÁ:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_print_price_request"><input <?php echo ($view_print_price_request == '1')?'checked="checked"':''?> id="view_print_price_request" type="checkbox" name="view_print_price_request" value="1"> Hiển thị</label></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="td_left" style="vertical-align: top !important;">
                                    Hiển thị nút THÊM VÀO GIỎ:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_add_to_cart"><input <?php echo ($view_add_to_cart == '1')?'checked="checked"':''?> id="view_add_to_cart" type="checkbox" name="view_add_to_cart" value="1"> Hiển thị</label></p>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="td_left" style="vertical-align: top !important;">
                                    Hiển thị nút YÊU CẦU BÁO GIÁ:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_request_price"><input <?php echo ($view_request_price == '1')?'checked="checked"':''?> id="view_request_price" type="checkbox" name="view_request_price" value="1"> Hiển thị</label></p>
                                </td>
                            </tr>

                            <tr>
                                <td class="td_left" style="vertical-align: top !important;">
                                    Hiển thị nút LIÊN HỆ:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_btn_contact_1"><input <?php echo ($view_btn_contact == 'small')?'checked="checked"':''?> id="view_btn_contact_1" type="radio" name="view_btn_contact" value="small"> Nút Liên hệ nhỏ</label></p>
                                    <p style="margin:0"><label for="view_btn_contact_2"><input <?php echo ($view_btn_contact == 'large')?'checked="checked"':''?> id="view_btn_contact_2" type="radio" name="view_btn_contact" value="large"> Nút liên hệ lớn</label></p>
                                    <p style="margin:0"><label for="view_btn_contact_3"><input <?php echo ($view_btn_contact == 'hidden')?'checked="checked"':''?> id="view_btn_contact_3" type="radio" name="view_btn_contact" value="hidden"> Ẩn nút liên hệ</label></p>
                                </td>
                            </tr>

                            <tr>
                                <td class="td_left" style="vertical-align: top !important;">
                                    Hiển thị nút KIỂM TRA ĐƠN HÀNG:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_button_checkorder"><input <?php echo ($view_button_checkorder == '1')?'checked="checked"':''?> id="view_button_checkorder" type="checkbox" name="view_button_checkorder" value="1"> Hiển thị</label></p>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="td_left" style="vertical-align: top !important;">
                                    Hiển thị nút BẢO HÀNH ONLNE:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_button_warrantyonline"><input <?php echo ($view_button_warrantyonline == '1')?'checked="checked"':''?> id="view_button_warrantyonline" type="checkbox" name="view_button_warrantyonline" value="1"> Hiển thị</label></p>
                                </td>
                            </tr>

                            <tr>
                                <td class="td_left" style="vertical-align: top !important;">
                                    Vị trí form báo giá:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_vi_tri_form_bao_gia_1"><input <?php echo ($view_vi_tri_form_bao_gia == 'above')?'checked="checked"':''?> id="view_vi_tri_form_bao_gia_1" type="radio" name="view_vi_tri_form_bao_gia" value="above"> Nằm dưới chi tiết sản phẩm</label></p>
                                    <p style="margin:0"><label for="view_vi_tri_form_bao_gia_2"><input <?php echo ($view_vi_tri_form_bao_gia == 'bellow')?'checked="checked"':''?> id="view_vi_tri_form_bao_gia_2" type="radio" name="view_vi_tri_form_bao_gia" value="bellow"> Nằm trên mục bình luận</label></p>
                                    <p style="margin:0"><label for="view_vi_tri_form_bao_gia_3"><input <?php echo ($view_vi_tri_form_bao_gia == 'hidden')?'checked="checked"':''?> id="view_vi_tri_form_bao_gia_3" type="radio" name="view_vi_tri_form_bao_gia" value="hidden"> Ẩn</label></p>
                                </td>
                            </tr>

                            <tr>
                                <td class="td_left" style="vertical-align: top !important;">
                                    Hiển thị các nút Facebbook, Zalo, Điện thoại:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_button_facebook_zalo"><input <?php echo ($view_button_facebook_zalo == '1')?'checked="checked"':''?> id="view_button_facebook_zalo" type="checkbox" name="view_button_facebook_zalo" value="1"> Hiển thị</label></p>
                                </td>
                            </tr>

                            <tr>
                                <td class="td_left" style="vertical-align: top !important;">
                                    Hiển thị các nút Like, Share, Chia sẻ:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_button_like_share"><input <?php echo ($view_button_like_share == '1')?'checked="checked"':''?> id="view_button_like_share" type="checkbox" name="view_button_like_share" value="1"> Hiển thị</label></p>
                                </td>
                            </tr>

                            <tr>
                                <td class="td_left" style="vertical-align: top !important;">
                                    Hiển thị nội dung vận chuyển/đổi trả:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_shipping_content"><input <?php echo ($view_shipping_content == '1')?'checked="checked"':''?> id="view_shipping_content" type="checkbox" name="view_shipping_content" value="1"> Hiển thị</label></p>
                                </td>
                            </tr>

                            <?php
                            /*
                            <tr>
                                <td class="td_left" style="vertical-align: top !important;">
                                    Đổi trả:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0">
                                        <textarea class="form-control" name="view_return_content" rows="2"><?php echo stripslashes($view_return_content)?></textarea>
                                    </p>
                                </td>
                            </tr>
                            */
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row row-flex">
            <div class="col-lg-6 col-flex">
                <div class="ar_admin ar_admin_v2">
                    <table class="table table-bordered table-hover them_dt tbl-nomargin" style="border:none">
                        <tbody>
                            <div class="title_thongtinchung">
                                Hiển thị cột bên trái
                            </div>
                            
                            <tr>
                                <td class="td_left" style="vertical-align: top !important;">
                                    Hiển thị hỗ trợ trực tuyến:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_dm_truc_tuyen"><input <?php echo ($view_dm_truc_tuyen == '1')?'checked="checked"':''?> id="view_dm_truc_tuyen" type="checkbox" name="view_dm_truc_tuyen" value="1"> Hiển thị</label></p>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="td_left" style="vertical-align: top !important;">
                                    Hiển thị danh mục:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_danh_muc_toggle"><input <?php echo ($view_danh_muc == 'toggle')?'checked="checked"':''?> id="view_danh_muc_toggle" type="radio" name="view_danh_muc" value="toggle"> Kiểu thu gọn</label></p>
                                    <p style="margin:0"><label for="view_danh_muc_full"><input <?php echo ($view_danh_muc == 'full')?'checked="checked"':''?> id="view_danh_muc_full" type="radio" name="view_danh_muc" value="full"> Kiểu không thu gọn</label></p>
                                    <p style="margin:0"><label for="view_danh_muc_hidden"><input <?php echo ($view_danh_muc == 'hidden')?'checked="checked"':''?> id="view_danh_muc_hidden" type="radio" name="view_danh_muc" value="hidden"> Ẩn</label></p>						
                                </td>
                            </tr>

                            <tr>
                                <td class="td_left" style="vertical-align: top !important;">
                                    Hiển thị nhãn hiệu:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_nhan_hieu_normal"><input <?php echo ($view_nhan_hieu == 'normal')?'checked="checked"':''?> id="view_nhan_hieu_normal" type="radio" name="view_nhan_hieu" value="normal"> Kiểu 1 cấp</label></p>
                                    <p style="margin:0"><label for="view_nhan_hieu_group"><input <?php echo ($view_nhan_hieu == 'group')?'checked="checked"':''?> id="view_nhan_hieu_group" type="radio" name="view_nhan_hieu" value="group"> Kiểu nhóm nhãn hiệu thu gọn</label></p>
                                    <p style="margin:0"><label for="view_nhan_hieu_group_normal"><input <?php echo ($view_nhan_hieu == 'group_normal')?'checked="checked"':''?> id="view_nhan_hieu_group_normal" type="radio" name="view_nhan_hieu" value="group_normal"> Kiểu nhóm nhãn hiệu không thu gọn</label></p>
                                    <p style="margin:0"><label for="view_nhan_hieu_hidden"><input <?php echo ($view_nhan_hieu == 'hidden')?'checked="checked"':''?> id="view_nhan_hieu_hidden" type="radio" name="view_nhan_hieu" value="hidden"> Ẩn</label></p>
                                </td>
                            </tr>

                            <tr>
                                <td class="td_left" style="vertical-align: top !important;">
                                    Vị trí nhãn hiệu:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_vi_tri_nhan_hieu_1"><input <?php echo ($view_vi_tri_nhan_hieu == 'above')?'checked="checked"':''?> id="view_vi_tri_nhan_hieu_1" type="radio" name="view_vi_tri_nhan_hieu" value="above"> Nằm trên danh mục</label></p>
                                    <p style="margin:0"><label for="view_vi_tri_nhan_hieu_2"><input <?php echo ($view_vi_tri_nhan_hieu == 'bellow')?'checked="checked"':''?> id="view_vi_tri_nhan_hieu_2" type="radio" name="view_vi_tri_nhan_hieu" value="bellow"> Nằm dưới danh mục</label></p>
                                </td>
                            </tr>

                            <tr>
                                <td class="td_left" style="vertical-align: top !important;width:50%">
                                    Hiển thị Zalo:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_zalo_left"><input <?php echo ($view_zalo_left == '1')?'checked="checked"':''?> id="view_zalo_left" type="checkbox" name="view_zalo_left" value="1"> Hiển thị</label></p>
                                </td>
                            </tr>

                            <tr>
                                <td class="td_left" style="vertical-align: top !important;width:50%">
                                    Hiển thị Lịch làm việc:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_calendar_left"><input <?php echo ($view_calendar_left == '1')?'checked="checked"':''?> id="view_calendar_left" type="checkbox" name="view_calendar_left" value="1"> Hiển thị</label></p>
                                </td>
                            </tr>

                            <tr>
                                <td class="td_left" style="vertical-align: top !important;">
                                    Hiển thị nút Yêu cầu báo giá:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_button_price_request_left"><input <?php echo ($view_button_price_request_left == '1')?'checked="checked"':''?> id="view_button_price_request_left" type="checkbox" name="view_button_price_request_left" value="1"> Hiển thị</label></p>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="td_left" style="vertical-align: top !important;">
                                    Hiển thị nút KIỂM TRA ĐƠN HÀNG:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_button_checkorder_left"><input <?php echo ($view_button_checkorder_left == '1')?'checked="checked"':''?> id="view_button_checkorder_left" type="checkbox" name="view_button_checkorder_left" value="1"> Hiển thị</label></p>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="td_left" style="vertical-align: top !important;">
                                    Hiển thị nút BẢO HÀNH ONLNE:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_button_warrantyonline_left"><input <?php echo ($view_button_warrantyonline_left == '1')?'checked="checked"':''?> id="view_button_warrantyonline_left" type="checkbox" name="view_button_warrantyonline_left" value="1"> Hiển thị</label></p>
                                </td>
                            </tr>

                            <tr>
                                <td class="td_left" style="vertical-align: top !important;">
                                    Hiển thị nút LIÊN HỆ:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_button_contact_left"><input <?php echo ($view_button_contact_left == '1')?'checked="checked"':''?> id="view_button_contact_left" type="checkbox" name="view_button_contact_left" value="1"> Hiển thị</label></p>
                                </td>
                            </tr>

                            <tr>
                                <td class="td_left" style="vertical-align: top !important;width:50%">
                                    Hiển thị đếm sản phẩm (danh mục + nhãn hiệu cột bên trái):
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_count_product"><input <?php echo ($view_count_product == '1')?'checked="checked"':''?> id="view_count_product" type="checkbox" name="view_count_product" value="1"> Hiển thị</label></p>
                                </td>
                            </tr>

                            <tr>
                                <td class="td_left" style="vertical-align: top !important;width:50%">
                                    Cập nhật số lượng sản phẩm
                                </td>
                                <td class="td_right">
                                    <?php
                                    $sum_cat = $count_cats['cntid'];
                                    $plit_cat = round($sum_cat/3);
                                    $cat_val_1 = '1-'.$plit_cat;
                                    $cat_val_2 = $plit_cat.'-'.($plit_cat * 2);
                                    $cat_val_3 = ($plit_cat * 2).'-'.$sum_cat;
                                    ?>
                                    <p style="margin:0">
                                        <label for="scat1"><input class="cat-inp" checked type="radio" name="cat_split" id="scat1" value="<?php echo $cat_val_1?>"> <?php echo $cat_val_1?> danh mục</label>
                                    </p>
                                    <p style="margin:0">
                                        <label for="scat2"><input class="cat-inp" type="radio" name="cat_split" id="scat2" value="<?php echo $cat_val_2?>"> <?php echo $cat_val_2?> danh mục</label>
                                    </p>
                                    <p style="margin:0 0 10px">
                                        <label for="scat3"><input class="cat-inp" type="radio" name="cat_split" id="scat3" value="<?php echo $cat_val_3?>"> <?php echo $cat_val_3?> danh mục</label>
                                    </p>
                                    <p>
                                        <a id="update-cat-number" class="btn btn-primary update-cat-number" href="#update-cat-number">Cập nhật danh mục</a>
                                    </p>
                                   
                                </td>
                            </tr>

                            <tr>
                                <td class="td_left" style="vertical-align: top !important;width:50%">
                                    Cập nhật số lượng sản phẩm
                                </td>
                                <td class="td_right">
                                    <p style="margin:0;">
                                        <a id="update-brand-number" class="btn btn-primary update-brand-number" href="#update-brand-number">Cập nhật nhãn hiệu</a>
                                    </p>
                                </td>
                            </tr>
                           
                        </tbody>
                    </table>
                </div>                                        
            </div>
            <div class="col-lg-6 col-flex">
                <div class="ar_admin ar_admin_v2">
                    <table class="table table-bordered table-hover them_dt tbl-nomargin" style="border:none">
                        <tbody>
                            <div class="title_thongtinchung">
                                Hiển thị cột bên phải
                            </div>
                            
                            <tr>
                                <td class="td_left" style="vertical-align: top !important;width:50%">
                                    Hiển thị hỗ trợ trực tuyến:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_ct_truc_tuyen"><input <?php echo ($view_ct_truc_tuyen == '1')?'checked="checked"':''?> id="view_ct_truc_tuyen" type="checkbox" name="view_ct_truc_tuyen" value="1"> Hiển thị</label></p>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="td_left" style="vertical-align: top !important;">
                                    Hiển thị ô báo giá:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_price_report_form_right"><input <?php echo ($view_price_report_form_right == '1')?'checked="checked"':''?> id="view_price_report_form_right" type="checkbox" name="view_price_report_form_right" value="1"> Hiển thị</label></p>
                                </td>
                            </tr>

                            <tr>
                                <td class="td_left" style="vertical-align: top !important;width:50%">
                                    Hiển thị Zalo:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_zalo_right"><input <?php echo ($view_zalo_right == '1')?'checked="checked"':''?> id="view_zalo_right" type="checkbox" name="view_zalo_right" value="1"> Hiển thị</label></p>
                                </td>
                            </tr>

                            <tr>
                                <td class="td_left" style="vertical-align: top !important;width:50%">
                                    Hiển thị Lịch làm việc:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_calendar_right"><input <?php echo ($view_calendar_right == '1')?'checked="checked"':''?> id="view_calendar_right" type="checkbox" name="view_calendar_right" value="1"> Hiển thị</label></p>
                                </td>
                            </tr>

                            <tr>
                                <td class="td_left" style="vertical-align: top !important;">
                                    Hiển thị nút Yêu cầu báo giá:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_button_price_request_right"><input <?php echo ($view_button_price_request_right == '1')?'checked="checked"':''?> id="view_button_price_request_right" type="checkbox" name="view_button_price_request_right" value="1"> Hiển thị</label></p>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="td_left" style="vertical-align: top !important;">
                                    Hiển thị nút ĐẶT HÀNG:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_button_placeorder_right"><input <?php echo ($view_button_placeorder_right == '1')?'checked="checked"':''?> id="view_button_placeorder_right" type="checkbox" name="view_button_placeorder_right" value="1"> Hiển thị</label></p>
                                </td>
                            </tr>

                            <tr>
                                <td class="td_left" style="vertical-align: top !important;">
                                    Hiển thị nút KIỂM TRA ĐƠN HÀNG:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_button_checkorder_right"><input <?php echo ($view_button_checkorder_right == '1')?'checked="checked"':''?> id="view_button_checkorder_right" type="checkbox" name="view_button_checkorder_right" value="1"> Hiển thị</label></p>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="td_left" style="vertical-align: top !important;">
                                    Hiển thị nút BẢO HÀNH ONLNE:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_button_warrantyonline_right"><input <?php echo ($view_button_warrantyonline_right == '1')?'checked="checked"':''?> id="view_button_warrantyonline_right" type="checkbox" name="view_button_warrantyonline_right" value="1"> Hiển thị</label></p>
                                </td>
                            </tr>

                            <tr>
                                <td class="td_left" style="vertical-align: top !important;">
                                    Hiển thị nút LIÊN HỆ:
                                </td>
                                <td class="td_right">
                                    <p style="margin:0"><label for="view_button_contact_right"><input <?php echo ($view_button_contact_right == '1')?'checked="checked"':''?> id="view_button_contact_right" type="checkbox" name="view_button_contact_right" value="1"> Hiển thị</label></p>
                                </td>
                            </tr>
                           
                        </tbody>
                    </table>
                </div>  
            </div>
        </div>                                        

        <div class="ar_admin ar_admin_v2">
            <table class="table table-bordered table-hover them_dt tbl-nomargin" style="border:none">
                <tbody>
                    <div class="title_thongtinchung">
                        Hiển thị cài đặt website
                    </div>
                    <tr>
                        <td class="td_left" style="vertical-align: top !important;">
                            Độ rộng website toàn màn hình:
                        </td>
                        <td class="td_right">
                            <p style="margin:0"><label for="view_website_fullwidth"><input <?php echo ($view_website_fullwidth == '1')?'checked="checked"':''?> id="view_website_fullwidth" type="checkbox" name="view_website_fullwidth" value="1"> Hiển thị</label></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_left" style="vertical-align: top !important;">
                            Tăng độ rộng cột bên phải:<br />
                            (Chi tiết sản phẩm)
                        </td>
                        <td class="td_right">
                            <p style="margin:0"><label for="view_right_sidebar_large"><input <?php echo ($view_right_sidebar_large == '1')?'checked="checked"':''?> id="view_right_sidebar_large" type="checkbox" name="view_right_sidebar_large" value="1"> Hiển thị</label></p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
       
        <div class="ar_admin ar_admin_v2">
            <table class="table table-bordered table-hover them_dt tbl-nomargin" style="border:none">
                <tbody>
                    <div class="title_thongtinchung">
                        Hiển thị trang chủ
                    </div>
                    <tr>
                        <td class="td_left" style="vertical-align: top !important;">
                            Hiển thị Slider:
                        </td>
                        <td class="td_right">
                            <p style="margin:0"><label for="view_home_slider"><input <?php echo ($view_home_slider == '1')?'checked="checked"':''?> id="view_home_slider" type="checkbox" name="view_home_slider" value="1"> Hiển thị</label></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_left" style="vertical-align: top !important;">
                            Hiển thị Gallery:
                        </td>
                        <td class="td_right">
                            <p style="margin:0"><label for="view_home_gallery"><input <?php echo ($view_home_gallery == '1')?'checked="checked"':''?> id="view_home_gallery" type="checkbox" name="view_home_gallery" value="1"> Hiển thị</label></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_left" style="vertical-align: top !important;">
                            Hiển thị ngành nghề kinh doanh:
                        </td>
                        <td class="td_right">
                            <p style="margin:0"><label for="view_home_business"><input <?php echo ($view_home_business == '1')?'checked="checked"':''?> id="view_home_business" type="checkbox" name="view_home_business" value="1"> Hiển thị</label></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_left" style="vertical-align: top !important;">
                            Hiển thị sản phẩm/dịch vụ:
                        </td>
                        <td class="td_right">
                            <p style="margin:0"><label for="view_home_services"><input <?php echo ($view_home_services == '1')?'checked="checked"':''?> id="view_home_services" type="checkbox" name="view_home_services" value="1"> Hiển thị</label></p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="ar_admin ar_admin_v2">
            <table class="table table-bordered table-hover them_dt tbl-nomargin" style="border:none">
                <tbody>
                    <div class="title_thongtinchung">
                        Hiển thị trang nhãn hiệu
                    </div>
                    <tr>
                        <td class="td_left" style="vertical-align: top !important;">
                            Kiểu hiển thị:
                        </td>
                        <td class="td_right">
                            <p style="margin:0"><label for="view_brand_page_type_1"><input <?php echo ($view_brand_page_type == '1')?'checked="checked"':''?> id="view_brand_page_type_1" type="radio" name="view_brand_page_type" value="1"> Hiển thị logo theo nhóm</label></p>
                            <p style="margin:0"><label for="view_brand_page_type_3"><input <?php echo ($view_brand_page_type == '3')?'checked="checked"':''?> id="view_brand_page_type_3" type="radio" name="view_brand_page_type" value="3"> Hiển thị logo không theo nhóm</label></p>
                            <p style="margin:0"><label for="view_brand_page_type_2"><input <?php echo ($view_brand_page_type == '2')?'checked="checked"':''?> id="view_brand_page_type_2" type="radio" name="view_brand_page_type" value="2"> Không hiển thị logo</label></p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="ar_admin ar_admin_v2">
            <table class="table table-bordered table-hover them_dt tbl-nomargin" style="border:none">
                <tbody>
                    <div class="title_thongtinchung">
                        Hiển thị Header
                    </div>
                    <tr>
                        <td class="td_left" style="vertical-align: top !important;">
                            Kiểu menu chính:
                        </td>
                        <td class="td_right">
                            <p style="margin:0"><label for="view_menu_type"><input <?php echo ($view_menu_type == '1')?'checked="checked"':''?> id="view_menu_type" type="checkbox" name="view_menu_type" value="1"> Hiển thị menu con</label></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_left" style="vertical-align: top !important;">
                            Kiểu menu nhãn hiệu:
                        </td>
                        <td class="td_right">
                            <p style="margin:0"><label for="view_menu_brand_type"><input <?php echo ($view_menu_brand_type == '1')?'checked="checked"':''?> id="view_menu_brand_type" type="checkbox" name="view_menu_brand_type" value="1"> Hiển thị nhóm nhãn hiệu</label></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_left" style="vertical-align: top !important;">
                            Hiển thị nút Danh mục sản phẩm (menu chính):
                        </td>
                        <td class="td_right">
                            <p style="margin:0"><label for="view_menu_brand_button"><input <?php echo ($view_menu_brand_button == '1')?'checked="checked"':''?> id="view_menu_brand_button" type="checkbox" name="view_menu_brand_button" value="1"> Hiển thị</label></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_left" style="vertical-align: top !important;width: 350px;">
                            Hiển thị trang danh mục nút Danh mục sản phẩm:
                        </td>
                        <td class="td_right">
                            <p style="margin:0"><label for="view_category_page"><input <?php echo ($view_category_page == '1')?'checked="checked"':''?> id="view_category_page" type="checkbox" name="view_category_page" value="1"> Hiển thị</label></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_left" style="vertical-align: top !important;">
                            Hiển thị:
                        </td>
                        <td class="td_right">
                            <p style="margin:0"><label for="view_menu_brand_only"><input <?php echo ($view_menu_category_brand == '1')?'checked="checked"':''?> id="view_menu_brand_only" type="radio" name="view_menu_category_brand" value="1"> Nhãn hiệu trên menu chính (ẩn menu chính mặc định)</label></p>
                            <p style="margin:0"><label for="view_menu_category_brand"><input <?php echo ($view_menu_category_brand == '2')?'checked="checked"':''?> id="view_menu_category_brand" type="radio" name="view_menu_category_brand" value="2"> Danh mục + Nhãn hiệu trên menu chính (ẩn menu chính mặc định)</label></p>
                            <p style="margin:0"><label for="view_menu_default"><input <?php echo (!$view_menu_category_brand || $view_menu_category_brand == '0')?'checked="checked"':''?> id="view_menu_default" type="radio" name="view_menu_category_brand" value="0"> Mặc định (hiển thị menu chính mặc định)</label></p>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
        </div>

        <div class="ar_admin ar_admin_v2">
            <table class="table table-bordered table-hover them_dt" style="border:none">
                <tbody>
                    <div class="title_thongtinchung">
                        Hiển thị footer
                    </div>

                    <tr>
                        <td class="td_left" style="vertical-align: top !important;">
                            Tiêu đề cột 4:
                        </td>
                        <td class="td_right">
                            <p style="margin:0"><input type="text" class="form-control" id="footer_widget_title_4" name="footer_widget_title_4" value="<?php echo $footer_widget_title_4?>"></p>
                        </td>
                    </tr>

                    <tr>
                        <td class="td_left" style="vertical-align: top !important;">
                            Hiện thị bản đồ lớn dưới cùng:
                        </td>
                        <td class="td_right">
                            <p style="margin:0"><label for="view_ban_do_bottom"><input <?php echo ($view_ban_do_bottom == '1')?'checked="checked"':''?> id="view_ban_do_bottom" type="checkbox" name="view_ban_do_bottom" value="1"> Hiển thị</label></p>
                        </td>
                    </tr>

                    <tr>
                        <td class="td_left" style="vertical-align: top !important;">
                            Copyright:
                        </td>
                        <td class="td_right">
                            <p style="margin:0"><input type="text" class="form-control" id="footer_copyright" name="footer_copyright" value="<?php echo $footer_copyright?>"></p>
                        </td>
                    </tr>

                    <tr>
                        <td class="td_left" style="vertical-align: top !important;">
                            Thiết kế website:
                        </td>
                        <td class="td_right">
                            <p style="margin:0"><input type="text" class="form-control" id="footer_design_by" name="footer_design_by" value="<?php echo $footer_design_by?>"></p>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="td_left" style="vertical-align: top !important;">
                            Tùy chọn hiển thị footer:
                        </td>
                        <td class="td_right">
                            <p style="margin:0"><label for="bando"><input <?php echo ($view_footer == 'bando')?'checked="checked"':''?> id="bando" type="radio" name="view_footer" value="bando"> Hiển thị bản đồ</label></p>
                            <p style="margin:0"><label for="thanhtoan"><input <?php echo ($view_footer == 'thanhtoan')?'checked="checked"':''?> id="thanhtoan" type="radio" name="view_footer" value="thanhtoan"> Hiển thị thanh toán</label></p>
                            <p style="margin:0"><label for="tuychon"><input <?php echo ($view_footer == 'tuychon')?'checked="checked"':''?> id="tuychon" type="radio" name="view_footer" value="tuychon"> Hiển thị tùy chọn nội dung</label></p>						
                            <p style="margin:0">
                                <textarea  name="view_footer_content" id="view_footer_content"><?php echo $view_footer_content?></textarea>
                                <?php $ckeditor->replace('view_footer_content'); ?>
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="ar_admin last">
            <table class="table table-bordered table-hover them_dt" style="border:none">
                <tr>
                    <td class="td_left" style="text-align:right">
                        <input type="submit" value="Lưu" class="btn btn-primary" />
                    </td>
                    <td class="td_right">
                        <input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=giaodien&a=man'" class="btn btn-primary" />
                    </td>
                </tr>
            </table>
        </div>

    </form>
</div>

<script type="text/javascript">
    (function ($){
        $(document).ready(function(){
            $('#update-cat-number').on('click', function(){
                
                var cat_limit = 0;
                $('.cat-inp').each(function(){
                    if( $(this).is(':checked') ){
                        cat_limit = $(this).val();
                    }
                });
                    
                swal({
                        title: "Đang cập nhật...",
                        type: "info",
                        showCancelButton: false,
                        confirmButtonClass: 'btn-info',
                        confirmButtonText: 'Vui lòng chờ!'
                    });

                    $.ajax({
                            url: '../../../ajax/ajax_update_category_product_number.php',
                            dataType: 'json',
                            type: 'get',
                            data: 'update_cat_number&limit='+cat_limit,
                            timeout: 240000,
                            success: function(res) {
                                console.log(res);
                                
                                if(res.isSuccess){
                                    swal({
                                            title: "Cập nhật thành công",
                                            text: "Cập nhật dữ liệu thành công!",
                                            type: "success",
                                            confirmButtonClass: 'btn-success',
                                            confirmButtonText: 'OK'
                                        });
                                    } else {
                                        swal({
                                            title: res.msg,
                                            text: "Cập nhật chưa thành công!",
                                            type: "error",
                                            confirmButtonClass: 'btn-danger',
                                            confirmButtonText: 'OK'
                                        });
                                    }
                            },
                            error: function(xhr, textStatus, errorThrown) {
                                swal({
                                            title: "Cập nhật chưa thành công",
                                            text: "Cập nhật dữ liệu chưa hoàn thành!",
                                            type: "error",
                                            confirmButtonClass: 'btn-danger',
                                            confirmButtonText: 'OK'
                                        });
                            }
                    });
                
                return false;
            });

            $('#update-brand-number').on('click', function(){
                swal({
                        title: "Đang cập nhật...",
                        type: "info",
                        showCancelButton: false,
                        confirmButtonClass: 'btn-info',
                        confirmButtonText: 'Vui lòng chờ!'
                    });
                
                    $.ajax({
                            url: '../../../ajax/ajax_update_brand_product_number.php',
                            dataType: 'json',
                            type: 'get',
                            data: 'update_brand_number',
                            timeout: 240000,
                            success: function(res) {
                                console.log(res);
                                
                                if(res.isSuccess){
                                    swal({
                                            title: "Cập nhật thành công",
                                            text: "Cập nhật dữ liệu thành công!",
                                            type: "success",
                                            confirmButtonClass: 'btn-success',
                                            confirmButtonText: 'OK'
                                        });
                                    } else {
                                        swal({
                                            title: res.msg,
                                            text: "Cập nhật chưa thành công!",
                                            type: "error",
                                            confirmButtonClass: 'btn-danger',
                                            confirmButtonText: 'OK'
                                        });
                                    }
                            },
                            error: function(xhr, textStatus, errorThrown) {
                                swal({
                                            title: "Cập nhật chưa thành công",
                                            text: "Cập nhật dữ liệu chưa hoàn thành!",
                                            type: "error",
                                            confirmButtonClass: 'btn-danger',
                                            confirmButtonText: 'OK'
                                        });
                            }
                    });
                
                return false;
            });
        });
    })(jQuery);
</script>