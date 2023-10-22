<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Quản trị hệ thống</title>
    <link rel="shortcut icon" href="public/images/favicon.png"/>
    <link href="public/css/bootstrap.min.css" rel="stylesheet"/>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="public/css/admin.css?v=<?php echo getenv('APP_VERSION'); ?>" rel="stylesheet"/>
    <link href="/admin/assets/bootstrap-toggle-buttons/static/stylesheets/bootstrap-toggle-buttons.css" rel="stylesheet"/>

    <!-- -->
	<script type="text/javascript" src="public/js/jquery-1.10.2.min.js"></script>
    <!-- <script type="text/javascript" src="/admin/assets/bootstrap-sweetalert/sweetalert.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.5/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/admin/assets/bootstrap-sweetalert/sweetalert.css">
    <script>
        const AppConfig = {
            fileBaseUrl: '<?php echo FILEURL; ?>',
            thumbFolder: '<?php echo THUMB_SITE_FOLDER; ?>',
        };
    </script>
</head>
<body>