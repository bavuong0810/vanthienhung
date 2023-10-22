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

$email_admin_url = './../smtpv2/email_admin.json';
$email_admin_cc_url = './../smtpv2/email_admin_cc.json';
$email_password_url = './../smtpv2/email_password.json';
//$credentials_url = './../smtpv2/credentials.json';
//$access_token_url = './../smtpv2/token.json';

$email_admin = file_get_contents($email_admin_url);
$email_admin_cc = file_get_contents($email_admin_cc_url);
$email_password_json = file_get_contents($email_password_url);
$admin_sms_json = file_get_contents(__ROOT_PATH . '/img_data/files/sms/admin_sms.json');

//$oauth_client_json = file_get_contents($credentials_url);;
//$access_token_json = file_get_contents($access_token_url);
?>

<div class="col-xs-12">
    <form name="frm" method="post" action="index.php?p=email-cai-dat&a=save" enctype="multipart/form-data">
        <input type="hidden" name="email_type" value="dat_hang">
        <div class="ar_admin ar_admin_v2">
            <table class="table table-bordered table-hover them_dt" style="border:none">
                <tbody>
                    <div class="title_thongtinchung">
                        Cài đặt email admin
                    </div>
                    
                    <tr>
                        <td class="td_left" style="vertical-align: top !important;">
                            Email Admin
                        </td>
                        <td class="td_right">
                            <p style="margin:0"><input id="email_admin" class="input form-control" type="text" name="email_admin" value="<?php echo $email_admin?>"></p>
                        </td>
                    </tr>

                    <tr>
                        <td class="td_left" style="vertical-align: top !important;">
                            Email Admin Cc
                        </td>
                        <td class="td_right">
                            <p style="margin:0"><input id="email_admin_cc" class="input form-control" type="text" name="email_admin_cc" value="<?php echo $email_admin_cc?>"></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_left" style="vertical-align: top !important;">
                            Host
                        </td>
                        <td class="td_right">
                            <p style="margin:0">
                                <input type="text" class="input form-control" name="host" id="host" value="smtp.gmail.com" readonly>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_left" style="vertical-align: top !important;">
                            Port
                        </td>
                        <td class="td_right">
                            <p style="margin:0">
                                <input type="text" class="input form-control" name="port" id="port" value="587" readonly>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_left" style="vertical-align: top !important;">
                            Mật khẩu ứng dụng
                        </td>
                        <td class="td_right">
                            <p style="margin:0">
                                <input type="password" class="input form-control" name="email_password" id="email_password" value="<?php echo $email_password_json?>">
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_left" style="vertical-align: top !important;">
                            ADMIN SMS
                        </td>
                        <td class="td_right">
                            <p style="margin:0">
                            <input type="text" class="input form-control" name="admin_sms" id="admin_sms" value="<?php echo $admin_sms_json?>">
                            </p>
                        </td>
                    </tr>
                    <!--
                    <tr>
                        <td class="td_left" style="vertical-align: top !important;">
                            OAuth 2.0 Client IDs
                        </td>
                        <td class="td_right">
                            <p style="margin:0">
                                <textarea class="input form-control" name="oauth_client_json" id="oauth_client_json" rows="13" cols="80"><?php echo $oauth_client_json?></textarea>
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td class="td_left" style="vertical-align: top !important;">
                            Access Token
                        </td>
                        <td class="td_right">
                            <p style="margin:0">
                                <textarea class="input form-control" name="access_token_json" id="access_token_json" rows="13" cols="80"><?php echo $access_token_json?></textarea>
                            </p>
                        </td>
                    </tr>-->
                    
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