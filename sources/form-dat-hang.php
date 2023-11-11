<div class="title-form text-uppercase"><?= _infouser ?></div>
<div class="form-group">
    <input type="text" class="form-control" id="ten" name="ten" data-error="<?= _typehoten ?>" placeholder="<?= _hoten ?>*" require>
</div>
<div class="form-group">
    <input type="email" class="form-control" id="email" name="email" data-error="<?= _type_email ?>" placeholder="Email*" require>
</div>

<div class="form-group">
    <input type="text" class="form-control" id="dienthoai" name="dienthoai" data-error="<?= _typesodienthoai ?>" placeholder="<?= _sodienthoai ?>*" require>
</div>

<div class="title-form text-uppercase">Địa chỉ nhận hàng</div>

<div class="form-group">
    <select name="province" id="province" class="form-control" require></select>
</div>
<div class="form-group">
    <select name="county" id="county" class="form-control" require>
        <option>Chọn quận/huyện</option>
    </select>
</div>
<div class="form-group">
    <select name="commune" id="commune" class="form-control" require>
        <option>Chọn xã/phường</option>
    </select>
</div>

<div class="form-group">
    <input type="text" class="form-control" name="address" id="address" placeholder="Địa chỉ">
</div>

<div class="form-group">
    <textarea id="loinhan" class="form-control" rows="5" name="loinhan" placeholder="Lời nhắn..."></textarea>
</div>

<div class="form-close-group">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">ĐÓNG</button>
</div>

<style type="text/css">
    .table tr th a {
        color: #000;
    }

    .wrapper-contai {
        position: static;
    }

    .payment-method {
        padding: 8px 0 8px 10px;
        margin-bottom: 8px;
        background: #f5f5f5;
        border-radius: 5px;
    }

    .payment-method.disabled-method {
        opacity: 0.5;
    }

    .payment-method label {
        cursor: pointer;
        margin-bottom: 0;
        display: block;
    }

    .payment-method label img {
        margin: 0 5px;
    }
    .payment-description{
        border-top: 1px solid #ddd;
        padding-top: 10px;
        margin-top: 10px;
        display: none;
    }
    .payment-method-active .payment-description{
        display: block;
    }
    .company-order-wrap{
        display: none;
    }
    .company-order-wrap.active{
        display: block;
    }

    @keyframes hover-color {
        from {
            border-color: #c0c0c0;
            border-width: 1.5px;
            box-shadow: 0 0 5px #c0c0c0;
        }

        to {
            border-color: #3e97eb;
            border-width: 1.5px;
            box-shadow: 0 0 5px #3e97eb;
        }
    }

    .magic-radio,
    .magic-checkbox {
        position: absolute;
        display: none;
    }

    .magic-radio[disabled],
    .magic-checkbox[disabled] {
        cursor: not-allowed;
    }

    .magic-radio+label,
    .magic-checkbox+label {
        position: relative;
        display: block;
        padding-left: 30px;
        cursor: pointer;
        vertical-align: middle;
    }

    .magic-radio+label:hover:before,
    .magic-checkbox+label:hover:before {
        animation-duration: 0.4s;
        animation-fill-mode: both;
        animation-name: hover-color;
    }

    .magic-radio+label:before,
    .magic-checkbox+label:before {
        position: absolute;
        top: 50%;
        left: 0;
        transform: translateY(-50%);
        display: inline-block;
        width: 20px;
        height: 20px;
        content: '';
        border: 1px solid #c0c0c0;
    }

    .magic-radio+label:after,
    .magic-checkbox+label:after {
        position: absolute;
        display: none;
        content: '';
    }

    .magic-radio[disabled]+label,
    .magic-checkbox[disabled]+label {
        cursor: not-allowed;
        color: #e4e4e4;
    }

    .magic-radio[disabled]+label:hover,
    .magic-radio[disabled]+label:before,
    .magic-radio[disabled]+label:after,
    .magic-checkbox[disabled]+label:hover,
    .magic-checkbox[disabled]+label:before,
    .magic-checkbox[disabled]+label:after {
        cursor: not-allowed;
    }

    .magic-radio[disabled]+label:hover:before,
    .magic-checkbox[disabled]+label:hover:before {
        border: 1px solid #e4e4e4;
        animation-name: none;
    }

    .magic-radio[disabled]+label:before,
    .magic-checkbox[disabled]+label:before {
        border-color: #e4e4e4;
    }

    .magic-radio:checked+label:before,
    .magic-checkbox:checked+label:before {
        animation-name: none;
    }

    .magic-radio:checked+label:after,
    .magic-checkbox:checked+label:after {
        display: block;
    }

    .magic-radio+label:before {
        border-radius: 50%;
    }

    .magic-radio+label:after {
        top: 50%;
        left: 6px;
        transform: translateY(-50%);
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #3e97eb;
    }

    .magic-radio:checked+label:before {
        border: 1px solid #3e97eb;
    }

    .magic-radio:checked[disabled]+label:before {
        border: 1px solid #c9e2f9;
    }

    .magic-radio:checked[disabled]+label:after {
        background: #c9e2f9;
    }

    .magic-checkbox+label:before {
        border-radius: 3px;
    }

    .magic-checkbox+label:after {
        top: 2px;
        left: 7px;
        box-sizing: border-box;
        width: 6px;
        height: 12px;
        transform: rotate(45deg);
        border-width: 2px;
        border-style: solid;
        border-color: #fff;
        border-top: 0;
        border-left: 0;
    }

    .magic-checkbox:checked+label:before {
        border: #3e97eb;
        background: #3e97eb;
    }

    .magic-checkbox:checked[disabled]+label:before {
        border: #c9e2f9;
        background: #c9e2f9;
    }
</style>