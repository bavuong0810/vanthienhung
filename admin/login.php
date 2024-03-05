<?php
/**
 * Vân Thiên Hùng chuyên lừa đảo, lợi dụng tín nhiệm lừa tiền anh em lập trình.
 * Hứa hẹn thanh toán, tới ngày thì than thở kêu chưa thu được tiền từ năm này qua tháng nọ, hẹn tới hẹn lui không có hồi kết.
 * Tới lúc bị anh em Dev đòi thì xoá Zalo, đổi pass server nhằm chặn anh em Dev vào phá.
 * Đã quỵt tiền 2 người tổng cộng 70 triệu
 * Chúc may mắn cho anh em nào đang làm tiếp với Vân Thiên Hùng ^^!.
 */
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

@define('_template', '/templates/');
@define('_source', '/sources/');
@define('_lib', '/lib/');
define('__ROOT_PATH', dirname(dirname(__FILE__)));

include "lib/config.php";
include "lib/function.php";
include_once "../smtp/index.php";
global $d;
$d = new func_index($config['database']);

$cacheFile = __ROOT_PATH . '/tmp/html/' . md5('information') . '.cache'; // Cache file path
if (file_exists($cacheFile) && (time() - filemtime($cacheFile)) < 3600) {
    $information = unserialize(file_get_contents($cacheFile));
} else {
    $information = $d->simple_fetch("select * from #_thongtin limit 0,1");
    // Cache the result
    file_put_contents($cacheFile, serialize($information));
}

$SETTINGS = $d->getAllSettings();

if (isset($_POST['login'])) {
	$user_hash = sha1($d->clean(addslashes($_POST['input-username'])));
	$pass_hash = sha1($d->clean(addslashes($_POST['input-password'])));

	$login = $d->o_fet("select * from #_user where user_hash = '$user_hash' and pass_hash = '$pass_hash' and quyen_han>=1");

	if (count($login) > 0 && $pass_hash == $login[0]['pass_hash']) {
		$_SESSION['id_user'] = $login[0]['id'];
		$_SESSION['user_admin'] = $login[0]['tai_khoan'];
		$_SESSION['user_hash'] = $user_hash;
		$_SESSION['quyen'] = @$login[0]['quyen_han'];
		$_SESSION['name'] = @$login[0]['ho_ten'];
		$_SESSION['is_admin'] = $login[0]['is_admin'];

		$d->location("index.php");
	} else {
		$err = 'Tài khoản hoặc mật khẩu chưa đúng.';
	}
}

if (isset($_POST['quen_mat_khau'])) {
	$user_hash = sha1($d->clean(addslashes($_POST['username'])));
	$email = $d->clean(addslashes($_POST['quen_mat_khau']));
	$user = $d->o_fet("select * from #_user where user_hash = '$user_hash' and email = '$email' and quyen_han>=1");

	if (count($user) > 0) {
		$newPassword = $d->generateRandomString(10);
		$newPasswordHashed = sha1($newPassword);

		$user = $user[0];
		$d->reset();
		$d->setTable('#_user');
		$d->setWhere('id', $user['id']);
		$data = [
			'pass_hash' => $newPasswordHashed,
		];
		if ($d->update($data)) {
			$mailResult = sendmail('Mật khẩu mới của bạn tại '.getenv('APP_NAME'), $newPassword, getenv('ADMIN_EMAIL'), $email, getenv('APP_NAME'));
			if ($mailResult) {
				$d->transfer('Mật khẩu đã được thay đổi, vui lòng kiểm tra trong email!', '/admin/login.php');
			}
		}
	}

	$err = 'Lỗi, vui lòng thử lại!' . count($user);
}
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <title>Đăng nhập hệ thống</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link href="./assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="./css/style.min.css" rel="stylesheet" />
    <link href="./css/style_responsive.css" rel="stylesheet" />
    <link href="./css/style_default.css" rel="stylesheet" id="style_color" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style type="text/css">
        .login-header{
            width: 410px;
            margin: 100px auto 0;
            border-radius: 5px;
        }
        .login-header .alert-custom h3{
            font-size: 16px;
            margin-top: 0px;
        }
        .login-header .alert-custom{
            padding: 10px;
            border-radius: 5px;
        }
        .huong-dan{
            text-align: left;
            padding-left: 15px;
            font-size: 14px;
        }
        .red{ color: red; }
        #login{
            margin-top: 85px;
        }
        @media(max-width: 767px){
            .control-wrap h4{ text-align: center; }
        }

    </style>
</head>
<body id="login-body">
    <div class="login-header">
        <div class="alert alert-success alert-custom">
            <h3>Cần hỗ trợ kỹ thuật, quý khách vui lòng thực hiện:</h3>
            <div class="huong-dan">
                <ul>
                    <li>Gửi yêu cầu vào email: <span class="red"><?php echo $information['email']; ?></span></li>
                    <li>Gọi số Hotline HTKH: <?= $SETTINGS['tell_contact']['value'] ?></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div id="login">
        <form id="loginform" class="form-vertical no-padding no-margin" action=""  method="post"/>
        <div class="lock">
            <i class="icon-lock"></i>
        </div><div class="control-wrap">
        <h4 style='margin-top:-3px'>Đăng nhập hệ thống</h4>
        <div class="control-group">
            <div class="controls">
                <div class="input-prepend">
                    <span class="add-on">
                        <i class="icon-user"></i>
                    </span>
                    <input id="input-username" name="input-username" onchange="coockie()" type="text" placeholder="Username" /></div>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <div class="input-prepend input-append">
                        <span class="add-on">
                            <i class="icon-key"></i>
                        </span>
                        <input id="input-password" name="input-password" type="password" placeholder="Password" />
                        <span class="add-on" style="cursor: pointer;" onclick="togglePassword()">
                            <span class="icon-eye-open" id="show-password-icon"></span>
                        </span>
                    </div>
                    <div>
                        <font class='err' style="color: red"><?=@$err?></font>
                    </div>
                    <div class="mtop10">
                        <div class="block-hint pull-left small">
                            <input type="checkbox" name="checkbox" id="" /> Ghi nhớ </div>
                            <div class="block-hint pull-right">
                                <a href="javascript:;" class="" id="forget-password">Quên mật khẩu?</a>
                            </div>
                        </div>
                        <div class="clearfix space5"></div>
                    </div>
                </div>
            </div>
            <input type="submit" id="login-btn" name="login" onclick="return kiem_tra_login()" class="btn btn-block login-btn" value="Login" />
        </form>
        <form id="forgotform" class="form-vertical no-padding no-margin hide" action="" method="POST" />
        <h4 style='margin-top:-3px;' class="text-center">Quên mật khẩu</h4>
        <div class="control-group">
            <div class="input-prepend">
                <span class="add-on"><i class="icon-user"></i></span>
                <input id="input-forgot-username" name="username" type="text" placeholder="Username" />
            </div>
            <div class="input-prepend">
                <span class="add-on"><i class="icon-envelope"></i></span>
                <input id="input-email" name="quen_mat_khau" type="text" placeholder="Email" />
            </div>
            <a href="javascript:;" onclick="toggleForgotPassword()">Đăng nhập</a>
            <div class="space20"></div>
        </div>
    <button type="submit" id="forget-btn" class="btn btn-block login-btn">Submit</button>
</form>
</div>
<div id="login-copyright"> <a href="<?php echo getenv('APP_URL'); ?>/" rel="nofollow" target="_blank" title="Thiết kế website: <?php echo getenv('COMPANY_NAME'); ?>">Thiết kế website: <?php echo getenv('COMPANY_NAME'); ?></a> </div>
<script src="./js/jquery-1.8.3.min.js"></script><script src="./assets/bootstrap/js/bootstrap.min.js"></script>
<script src="./js/jquery.blockui.js"></script>

</body>
</html>
<script type="text/javascript" charset="utf-8" async defer>
    var passwordInput = document.getElementById('input-password');
    var showPasswordIcon = document.getElementById('show-password-icon');

    function togglePassword() {

        if (passwordInput.type === 'text') {
            passwordInput.setAttribute('type', 'password');
            showPasswordIcon.setAttribute('class', 'icon-eye-open');
        } else {
            passwordInput.setAttribute('type', 'text');
            showPasswordIcon.setAttribute('class', 'icon-eye-open red');
        }
    }
    function kiem_tra_login(){
        if($("#input-username").val() == ''){
            $("#input-username").focus();
            $(".err").text("Chưa nhập tên tài khoản");
            return false;
        }else if($("#input-password").val() == ''){
            $("#input-password").focus();
            $(".err").text("Chưa nhập mật khẩu");
            return false;
        }else return true;
    }

    function toggleForgotPassword() {
        $('#forgotform').toggleClass('hide');
        $('#loginform').toggleClass('hide');
    }

    $('document').ready(function() {
        $('#forget-password').on('click', toggleForgotPassword);
    });
</script>

<style type="text/css">
    @media(max-width: 991px){
        #login{ margin-top: 110px !important; }
        .login-header{ width: 100%; margin-top: 40px;  }
        .login-header .alert-custom h3{ font-size: 13px; line-height: 20px; }
        .huong-dan{ padding: 0; font-size: 12px; }
    }
    @media(max-width: 320px){
        .huong-dan{ padding: 0; font-size: 11px; }
    }
</style>