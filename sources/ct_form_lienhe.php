<form id="form-contact" action="/lien-he.html" method="post">
    <div class="col-sm-12">
        <div class="form-group">
        <input type="text" id="ho_ten" name="ho_ten" class="form-control"  placeholder="<?=_hoten ?>">
        </div>
        <div class="form-group">
        <input type="text" id="dia_chi" name="dia_chi" class="form-control"  placeholder="<?=_address ?>">
        </div>
        <div class="form-group">
        <input type="email" id="email" name="email" class="form-control"  placeholder="Email">
        </div>
        <div class="form-group">
        <input type="text" id="so_dien_thoai" name="so_dien_thoai" class="form-control" placeholder="<?=_sodienthoai ?>">
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group textarea-message">
            <textarea class="form-control" name="noi_dung" placeholder="Message" rows="3"></textarea>
        </div>
        <div class="form-group item-captcha">
            <div class="row10">
                <div class="col-sm-8 plr10">
                <input type="text" class="form-control" id="captcha" name="captcha" style="background: url(./sources/capchaimage.php) center right no-repeat">
                </div>
                <div class="col-sm-4 plr10">
                <button class="form-control btn btn-success btn-send-contact" name="sub_email" type="submit"><?=_send ?> 
                <i class="fa fa-paper-plane"></i>
                </button>
                </div>
            </div>
        </div>
    </div>
</form>