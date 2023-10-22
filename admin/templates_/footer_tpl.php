<nav class="navbar navbar-inverse fix-footer" role="navigation">
<div id="footer">
    <div><a href="<?php echo getenv('APP_URL'); ?>/" class="a-footer" title="<?php echo getenv('FULL_COMPANY_NAME'); ?>"><?php echo getenv('FULL_COMPANY_NAME'); ?></a><div>
    <div>Điện thoại: (0274) 350 1763 - Website: <a href="<?php echo getenv('APP_URL'); ?>/" target="_blank" style="color: #fff;  text-decoration: none;"><?php echo getenv('APP_DOMAIN'); ?></a>, <a href="<?php echo getenv('APP_URL'); ?>/" target="_blank" style="color: #fff;  text-decoration: none;">websitechuyennghiep.vn</a> <div>
    <div>Email hỗ trợ kỹ thuật: <a href="mailto:xe.xenang@gmail.com" style="color: #fff;  text-decoration: none;">xe.xenang@gmail.com</a><div>
    <div>Hotline hỗ trợ khách hàng: 0902.70.73.79<div>
</div>
</nav>

    <script type="text/javascript" src="public/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="public/js/ajax.js"></script>
    <script type="text/javascript" src="public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="public/extra/select2/select2.full.js"></script>
    <script type="text/javascript" src="public/js/admin.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#check_all').change(function(){
                $('.table input:checkbox').prop('checked', this.checked);
            });
            $('#action').change(function(){
                $('#product_form').submit();
            });
            $('#search').keyup(function(e){
                if (e.which==13) {
                    $('#product_form').submit();
                }                
            });
			$('.select2').select2();
			$("select").on("select2:close", function (e) {  
				$(this).valid(); 
			});	
        });
    </script>
</body>
</html>