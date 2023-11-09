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
	.form-group {
		padding-bottom: 20px;
		border-bottom: 1px solid #ddd;
	}
</style>
<ol class="breadcrumb">
	<li><a href="<?= URLPATH . "admin" ?>"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
	<li class="active"><a href="<?= URLPATH . "admin" ?>/index.php">Hiển thị</a></li>
	<li class="active"><a href="<?= URLPATH . "admin" ?>/index.php?p=<?= @$_REQUEST['p'] ?>&a=man">Email đặt hàng</a></li>
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

$thank_you = $items[0]['thank_you'];
$dear_name = $items[0]['dear_name'];
$company_info_title = $items[0]['company_info_title'];
$company_info_account = $items[0]['company_info_account'];
$personal_info_title = $items[0]['personal_info_title'];
$personal_info_account = $items[0]['personal_info_account'];
?>

<div class="col-xs-12">
    <form name="frm" method="post" action="index.php?p=email-dat-hang&a=save" enctype="multipart/form-data">
        <input type="hidden" name="email_type" value="dat_hang">
        <div class="ar_admin ar_admin_v2">
            <table class="table table-bordered table-hover them_dt" style="border:none">
                <tbody>
                    <div class="title_thongtinchung">
                        Quản lý thông tin email đặt hàng
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
                            Cảm ơn
                        </td>
                        <td class="td_right">
                            <p style="margin:0"><input class="input form-control" type="text" name="thank_you" value="<?php echo $thank_you?>"></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_left" style="vertical-align: top !important;">
                            Họ tên
                        </td>
                        <td class="td_right">
                            <p style="margin:0"><input class="input form-control" type="text" name="dear_name" value="<?php echo $dear_name?>"></p>
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