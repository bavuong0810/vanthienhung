<?php @include_once "sources/editor.php" ?>
<style>
    textarea{
        width: 100%;
    }
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
	.form-group {
		padding-bottom: 20px;
		border-bottom: 1px solid #ddd;
	}
</style>
<ol class="breadcrumb">
	<li><a href="<?= URLPATH . "admin" ?>"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
	<li class="active"><a href="<?= URLPATH . "admin" ?>/index.php">Hiển thị</a></li>
	<li class="active"><a href="<?= URLPATH . "admin" ?>/index.php?p=<?= @$_REQUEST['p'] ?>&a=man">Email báo giá</a></li>
</ol>

<?php
global $d;
$d->clearMemCached();
$d->disableCacheQuery();
$d->reset();

$tell = $items[0]['tell'];
$zalo = $items[0]['zalo'];
$skype = $items[0]['skype'];
$website = $items[0]['website'];
$company_info_title = $items[0]['company_info_title'];
$company_info_account = $items[0]['company_info_account'];
$personal_info_title = $items[0]['personal_info_title'];
$personal_info_account = $items[0]['personal_info_account'];

$email_menu_title_1 = $items[0]['email_menu_title_1'];
$email_menu_link_1 = $items[0]['email_menu_link_1'];
$email_menu_title_2 = $items[0]['email_menu_title_2'];
$email_menu_link_2 = $items[0]['email_menu_link_2'];
$email_menu_title_3 = $items[0]['email_menu_title_3'];
$email_menu_link_3 = $items[0]['email_menu_link_3'];
$email_content = $items[0]['email_content'];
$email_address = $items[0]['email_address'];
$email_phone = $items[0]['email_phone'];
$email_email = $items[0]['email_email'];
$email_footer_title = $items[0]['email_footer_title'];
$email_footer_content = $items[0]['email_footer_content'];
$email_footer_menu_title_1 = $items[0]['email_footer_menu_title_1'];
$email_footer_menu_link_1 = $items[0]['email_footer_menu_link_1'];
$email_footer_menu_title_2 = $items[0]['email_footer_menu_title_2'];
$email_footer_menu_link_2 = $items[0]['email_footer_menu_link_2'];
$email_footer_menu_title_3 = $items[0]['email_footer_menu_title_3'];
$email_footer_menu_link_3 = $items[0]['email_footer_menu_link_3'];
?>

<div class="col-xs-12">
    <form name="frm" method="post" action="index.php?p=email-bao-gia&a=save" enctype="multipart/form-data">
        <input type="hidden" name="email_type" value="bao_gia">
        <div class="ar_admin ar_admin_v2">
            <table class="table table-bordered table-hover them_dt" style="border:none">
                <tbody>
                    <div class="title_thongtinchung">
                        Quản lý thông tin email báo giá
                    </div>

                    <tr>
                        <td class="td_left" style="vertical-align: top !important;">
                            SĐT
                        </td>
                        <td class="td_right">
                            <p style="margin:0">
                                <input class="input form-control" type="text" name="tell" value="<?php echo $tell?>">
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_left" style="vertical-align: top !important;">
                            Zalo
                        </td>
                        <td class="td_right">
                            <p style="margin:0">
                                <input class="input form-control" type="text" name="zalo" value="<?php echo $zalo?>">
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_left" style="vertical-align: top !important;">
                            Skype
                        </td>
                        <td class="td_right">
                            <p style="margin:0">
                                <input class="input form-control" type="text" name="skype" value="<?php echo $skype?>">
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_left" style="vertical-align: top !important;">
                            Website
                        </td>
                        <td class="td_right">
                            <p style="margin:0">
                                <input class="input form-control" type="text" name="website" value="<?php echo $website?>">
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td class="td_left" style="vertical-align: top !important;">
                            Menu 1
                        </td>
                        <td class="td_right">
                            <p style="margin:0 0 8px"><input placeholder="Tiêu đề" class="input form-control" type="text" name="email_menu_title_1" value="<?php echo $email_menu_title_1?>"></p>
                            <p style="margin:0"><input placeholder="Link Url" class="input form-control" type="text" name="email_menu_link_1" value="<?php echo $email_menu_link_1?>"></p>
                        </td>
                    </tr>

                    <tr>
                        <td class="td_left" style="vertical-align: top !important;">
                            Menu 2
                        </td>
                        <td class="td_right">
                            <p style="margin:0 0 8px"><input placeholder="Tiêu đề" class="input form-control" type="text" name="email_menu_title_2" value="<?php echo $email_menu_title_2?>"></p>
                            <p style="margin:0"><input placeholder="Link Url" class="input form-control" type="text" name="email_menu_link_2" value="<?php echo $email_menu_link_2?>"></p>
                        </td>
                    </tr>

                    <tr>
                        <td class="td_left" style="vertical-align: top !important;">
                            Menu 3
                        </td>
                        <td class="td_right">
                            <p style="margin:0 0 8px"><input placeholder="Tiêu đề" class="input form-control" type="text" name="email_menu_title_3" value="<?php echo $email_menu_title_3?>"></p>
                            <p style="margin:0"><input placeholder="Link Url" class="input form-control" type="text" name="email_menu_link_3" value="<?php echo $email_menu_link_3?>"></p>
                        </td>
                    </tr>

                    <tr>
                        <td class="td_left" style="vertical-align: top !important;">
                            Nội dung
                        </td>
                        <td class="td_right">
                            <label>Nội dung email</label>
                            <p style="margin:0">
                                <textarea  name="email_content" id="email_content"><?php echo $email_content?></textarea>
                                <?php $ckeditor->replace('email_content'); ?>
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td class="td_left" style="vertical-align: top !important;">
                            Thông tin công ty
                        </td>
                        <td class="td_right">
                            <label>Tiêu đề</label>
                            <p style="margin:0 0 25px"><input class="input form-control" type="text" name="company_info_title" value="<?php echo $company_info_title?>"></p>

                            <label>Thông tin tài khoản</label>
                            <p style="margin:0">
                                <textarea  name="company_info_account" id="company_info_account"><?php echo $company_info_account?></textarea>
                                <?php $ckeditor->replace('company_info_account'); ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_left" style="vertical-align: top !important;">
                            Thông tin cá nhân
                        </td>
                        <td class="td_right">
                            <label>Tiêu đề</label>
                            <p style="margin:0 0 25px"><input class="input form-control" type="text" name="personal_info_title" value="<?php echo $personal_info_title?>"></p>

                            <label>Thông tin tài khoản</label>
                            <p style="margin:0">
                                <textarea  name="personal_info_account" id="personal_info_account"><?php echo $personal_info_account?></textarea>
                                <?php $ckeditor->replace('personal_info_account'); ?>
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td class="td_left" style="vertical-align: top !important;">
                            Footer 1( Cột bên trái )
                        </td>
                        <td class="td_right">
                            <label>Địa chỉ</label>
                            <p style="margin:0 0 25px">
                                <textarea class="input form-control" name="email_address" id="email_address" rows="3"><?php echo $email_address?></textarea>
                            </p>
                            
                            <label>Số điện thoại</label>
                            <p style="margin:0 0 25px">
                                <input class="input form-control" type="text" name="email_phone" value="<?php echo $email_phone?>">
                            </p>

                            <label>Email</label>
                            <p style="margin:0 0 25px">
                                <input class="input form-control" type="text" name="email_email" value="<?php echo $email_email?>">
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td class="td_left" style="vertical-align: top !important;">
                            Footer 2 ( Cột bên phải )
                        </td>
                        <td class="td_right">
                            <label>Tiêu đề</label>
                            <p style="margin:0 0 25px">
                                <input class="input form-control" type="text" name="email_footer_title" value="<?php echo $email_footer_title?>">
                            </p>
                            
                            <label>Nội dung</label>
                            <p style="margin:0 0 25px">
                                <textarea class="input form-control" name="email_footer_content" id="email_address" rows="3"><?php echo $email_footer_content?></textarea>
                            </p>

                            <label>Link 1</label>
                            <div style="margin:0 0 25px">
                                <p style="margin:0 0 8px"><input placeholder="Tiêu đề" class="input form-control" type="text" name="email_footer_menu_title_1" value="<?php echo $email_footer_menu_title_1?>"></p>
                                <p style="margin:0"><input placeholder="Link Url" class="input form-control" type="text" name="email_footer_menu_link_1" value="<?php echo $email_footer_menu_link_1?>"></p>
                            </div>

                            <label>Link 2</label>
                            <div style="margin:0 0 25px">
                                <p style="margin:0 0 8px"><input placeholder="Tiêu đề" class="input form-control" type="text" name="email_footer_menu_title_2" value="<?php echo $email_footer_menu_title_2?>"></p>
                                <p style="margin:0"><input placeholder="Link Url" class="input form-control" type="text" name="email_footer_menu_link_2" value="<?php echo $email_footer_menu_link_2?>"></p>
                            </div>

                            <label>Link 3</label>
                            <div style="margin:0 0 25px">
                                <p style="margin:0 0 8px"><input placeholder="Tiêu đề" class="input form-control" type="text" name="email_footer_menu_title_3" value="<?php echo $email_footer_menu_title_3?>"></p>
                                <p style="margin:0"><input placeholder="Link Url" class="input form-control" type="text" name="email_footer_menu_link_3" value="<?php echo $email_footer_menu_link_3?>"></p>
                            </div>
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