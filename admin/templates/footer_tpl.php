<!-- <nav class="navbar navbar-inverse fix-footer" role="navigation">
<div id="footer">
    <div><a href="<?php echo getenv('APP_URL'); ?>/" class="a-footer" title="<?php echo getenv('FULL_COMPANY_NAME'); ?>"><?php echo getenv('FULL_COMPANY_NAME'); ?></a><div>
    <div>Điện thoại: 02743501763 - Website: <a href="<?php echo getenv('APP_URL'); ?>/" target="_blank" style="color: #fff;  text-decoration: none;"><?php echo getenv('APP_DOMAIN'); ?></a>, <a href="<?php echo getenv('APP_URL'); ?>/" target="_blank" style="color: #fff;  text-decoration: none;">website <?php echo getenv('APP_DOMAIN'); ?></a> <div>
    <div>Email hỗ trợ kỹ thuật: <a href="mailto:<?php echo getenv('ADMIN_EMAIL'); ?>" style="color: #fff;  text-decoration: none;"><?php echo getenv('ADMIN_EMAIL'); ?></a><div>
    <div>Hotline hỗ trợ khách hàng: <?php echo getenv('FIRST_PHONE'); ?><div>
</div>
</nav> -->

<!-- <script type="text/javascript" src="public/js/jquery-1.10.2.min.js"></script> -->
<script type="text/javascript" src="/admin/assets/jquery-knob/js/jquery.knob.js"></script>
<script type="text/javascript" src="/admin/js/jquery.cookie.js"></script>
<script type="text/javascript" src="public/js/ajax.js"></script>
<script type="text/javascript" src="public/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/admin/assets/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script>
<script type="text/javascript" src="public/js/admin.js?v=<?php echo getenv('APP_VERSION'); ?>"></script>
<script type="text/javascript" src="/admin/js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.full.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/i18n/vi.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#check_all').change(function() {
            $('.table input.chk_box:checkbox').prop('checked', this.checked);
        });
        $('#action').change(function() {
            $('#product_form').submit();
        });
        $('#search').keyup(function(e) {
            if (e.which == 13) {
                $('#product_form').submit();
            }
        });
        $('select.select2').select2();
        $("select").on("select2:close", function(e) {
            $(this).valid();
        });
        App.init();
    });
</script>
</body>

</html>