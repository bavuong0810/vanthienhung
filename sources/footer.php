<?php
$cachePath = '/footer.html_' . $lang;
$cachePath = __CACHE_HTML . $cachePath;
if (file_exists($cachePath) && 1 == 2) {
    echo file_get_contents($cachePath);
    echo '<!--cached-->';
} else {

    ob_start("minify_html");
    $textfooter = $d->getTemplates(28);
    $textfooter_2 = $d->getTemplates(47);
    $doitac = $d->getImg(108);
    $congty = $d->o_fet("select * from #_tintuc where hien_thi = 1 AND category_id=1040 order by so_thu_tu asc, id desc LIMIT 0,10");
    // $danhmuc = $d->o_fet("select * from #_category where hien_thi = 1 AND category_id=1113 order by so_thu_tu asc, id desc");
    $chinhsach = $d->o_fet("select * from #_tintuc where hien_thi = 1 AND category_id=1112 order by so_thu_tu asc, id desc LIMIT 0,10");
    $aboutUsPosts = $d->o_fet("select * from #_tintuc where hien_thi = 1 AND category_id=2048 order by so_thu_tu asc, id desc LIMIT 0,10");
    ?>

    <div class="footerTop"></div><!--/ use this for sticy HTTT. Do not delete this.-->

    <?php require 'categories-tags.php'; ?>
    <div class="clearfix"></div>
    <footer class="footer">
        <div class="container">
            <div class="row foot-top">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <span><i class="fa fa-phone"></i>Hotline: <?= $information['hotline'] ?></span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

                    <a class="btn-sendmail" href="mailto:<?= $information['email'] ?>"><span><i
                                    class="fa fa-envelope-o"></i>Email: <?= $information['email'] ?></span></a>

                    <!--<span><i class="fa fa-envelope-o"></i>Email: <a href="mailto:<?= $information['email'] ?>"><?= $information['email'] ?></a></span>-->
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pc">
                    <span class="bg-red"><a href="lien-he.html"><i
                                    class="fa fa-ticket"></i>Gửi email hỗ trợ kỹ thuật</a></span>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row10 hidden-xs">
                <div class="col-md-4 plr10">
                    <div class="row5">
                        <div class="col-md-12 plr5">
                            <div class="thong-tin">
                                <h3 class="title-font"><?= $textfooter['name_' . $lang] ?></h3>
                                <div class="content-footer">
                                    <?= $textfooter['content_' . $lang] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 prl10">
                    <div class="row5">
                        <div class="col-sm-4 plr5">
                            <div class="title-foot">
                                <h3 class="title-font"><?= _sale_policy ?></h3>
                            </div>
                            <div class="news-home text-justify">
                                <ul>
                                    <?php foreach ($chinhsach as $key => $item): ?>
                                        <li>
                                            <a class="max-line-2" href="<?= URLPATH . $item['alias_' . $lang] ?>.html"
                                               title="<?= $item['name_' . $lang] ?>">
                                                <i class="fa fa-angle-double-right"></i>
                                                <?= $item['name_' . $lang] ?>
                                            </a>
                                        </li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-4 plr5">
                            <div class="title-foot">
                                <h3 class="title-font"><?= _gioithieucongty ?></h3>
                            </div>
                            <div class="news-home text-justify">
                                <ul>
                                    <?php foreach ($congty as $key => $item): ?>
                                        <li>
                                            <i class="fa fa-angle-double-right"></i>
                                            <a href="<?= URLPATH . $item['alias_' . $lang] ?>.html"
                                               title="<?= $item['name_' . $lang] ?>"><?= $item['name_' . $lang] ?></a>
                                        </li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-4 plr5">
                            <div class="title-foot">
                                <h3 class="title-font">
                                    <?php
                                    $footer_widget_title_4 = $d->getOption('footer_widget_title_4');
                                    if ($footer_widget_title_4) {
                                        echo $footer_widget_title_4;
                                    } else { ?>
                                        Về <?php echo getenv('COMPANY_NAME'); ?>
                                    <?php } ?>
                                </h3>
                            </div>
                            <div class="news-home text-justify">
                                <ul>
                                    <?php foreach ($aboutUsPosts as $key => $item): ?>
                                        <li>
                                            <i class="fa fa-angle-double-right"></i>
                                            <a href="<?= URLPATH . $item['alias_' . $lang] ?>.html"
                                               title="<?= $item['name_' . $lang] ?>"><?= $item['name_' . $lang] ?></a>
                                        </li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-3 plr5" style="display:none !important;">
                            <div class="title-foot">
                                <h3 class="title-font">Thống kê</h3>
                            </div>
                            <?php
                            $onlineResult = $d->simple_fetch("SELECT COUNT(DISTINCT `ip`) as `online` FROM `#_view` WHERE `time` >= CONVERT_TZ(ADDTIME(NOW(), '-900'),'+00:00','+07:00')");
                            $online = $onlineResult['online'] + rand(20, 25);

                            $botResult = $d->simple_fetch("SELECT COUNT(DISTINCT `ip`) as `online` FROM `#_view` WHERE is_bot = 1 AND `time` >= CONVERT_TZ(ADDTIME(NOW(), '-900'),'+00:00','+07:00')");
                            $bot = $botResult['online'];

                            $todayResult = $d->simple_fetch("SELECT COUNT(`ip`) as `online` FROM `#_view` WHERE `time` >= '" . date('Y-m-d 00:00:00') . "'");
                            $today = $todayResult['online'] + 6000;

                            $totalResult = $d->simple_fetch("SELECT COUNT(`ip`) as `online` FROM `#_view`");
                            $total = $totalResult['online'] + 30000000;
                            ?>
                            <p>Đang truy cập: <strong><?php echo $online; ?></strong></p>
                            <p>Máy chủ tìm kiếm: <strong><?php echo $bot; ?></strong></p>
                            <p>Khách viến thăm: <strong><?php echo $online - $bot; ?></strong></p>
                            <p>Hôm nay: <strong><?php echo $today; ?></strong></p>
                            <p>Tổng: <strong><?php echo $total; ?></strong></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="bottom-footer">
                <div class="row10">
                    <div class="col-sm-6 plr10">
                        <div class="ct-footer">
                            <?= $textfooter_2['content_' . $lang] ?>
                        </div>
                    </div>
                    <div class="col-sm-6 plr10">
                        <?php
                        $opt_view_footer = $d->getOptions('view_footer');
                        $footer_view_type = ($opt_view_footer) ? $opt_view_footer['option_value_1'] : '';
                        $view_footer_content = ($opt_view_footer) ? $opt_view_footer['option_value_2'] : '';
                        ?>

                        <?php if ($footer_view_type == 'thanhtoan') { ?>
                            <div class="payments-delivery hidden-xs">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h4 class="mt-0">CÁCH THỨC THANH TOÁN</h4>
                                        <ul>
                                            <li><img src="//media3.scdn.vn/img2/2018/7_27/ExHghW.png"
                                                     class=" lazyloaded"
                                                     data-src="//media3.scdn.vn/img2/2018/7_27/ExHghW.png"
                                                     alt="master"></li>
                                            <li><img src="//media3.scdn.vn/img2/2018/7_27/6HLfiO.png"
                                                     class=" lazyloaded"
                                                     data-src="//media3.scdn.vn/img2/2018/7_27/6HLfiO.png"
                                                     alt="visa"></li>
                                            <li><img src="//media3.scdn.vn/img2/2018/7_27/ZyrCMU.png"
                                                     class=" lazyloaded"
                                                     data-src="//media3.scdn.vn/img2/2018/7_27/ZyrCMU.png"
                                                     alt="napas"></li>
                                            <li><img src="//media3.scdn.vn/img2/2018/7_27/BN05j2.png"
                                                     class=" lazyloaded"
                                                     data-src="//media3.scdn.vn/img2/2018/7_27/BN05j2.png"
                                                     alt="vietcom"></li>
                                            <li><img src="//media3.scdn.vn/img2/2018/7_27/o2k0s5.png"
                                                     class=" lazyloaded"
                                                     data-src="//media3.scdn.vn/img2/2018/7_27/o2k0s5.png"
                                                     alt="vietinbank"></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h4 class="mt-0">ĐỐI TÁC VẬN CHUYỂN</h4>
                                        <ul>
                                            <li><img src="//media3.scdn.vn/img2/2018/7_27/CT6J11.png"
                                                     class=" lazyloaded"
                                                     data-src="//media3.scdn.vn/img2/2018/7_27/CT6J11.png"
                                                     alt="vnpost"></li>
                                            <li><img src="//media3.scdn.vn/img2/2018/7_27/TsZls2.png"
                                                     class=" lazyloaded"
                                                     data-src="//media3.scdn.vn/img2/2018/7_27/TsZls2.png"
                                                     alt="viettelpost"></li>
                                            <li><img src="//media3.scdn.vn/img2/2018/7_27/p3g3X4.png"
                                                     class=" lazyloaded"
                                                     data-src="//media3.scdn.vn/img2/2018/7_27/p3g3X4.png"
                                                     alt="ghn"></li>
                                            <li><img src="//media3.scdn.vn/img2/2018/7_27/hSiUGD.png"
                                                     class=" lazyloaded"
                                                     data-src="//media3.scdn.vn/img2/2018/7_27/hSiUGD.png"
                                                     alt="dhl"></li>
                                            <li><img src="//media3.scdn.vn/img2/2018/8_3/TU9pU8.png" class=" lazyloaded"
                                                     data-src="//media3.scdn.vn/img2/2018/8_3/TU9pU8.png"
                                                     alt="vncpost"></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php } elseif ($footer_view_type == 'tuychon') { ?>
                            <div class="custom-footer-text"><?php echo $view_footer_content ?></div>
                            <?php
                        } else { ?>
                            <div class="map-footer"><?= $information['map'] ?></div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="clearfix"></div>
    <?php
    $footer_copyright = $d->getOption('footer_copyright');
    $footer_design_by = $d->getOption('footer_design_by');
    ?>
    <div class="copyright">
        <div class="container p0">
            <div class="row10">
                <div class="col-md-3 plr10">
                    <div class="clearfix designed">
                        <a href="<?= URLPATH ?>"
                           title="<?php echo $footer_copyright; ?>"><?php echo $footer_copyright; ?></a>
                    </div>
                </div>
                <div class="col-md-6 plr10">
                    <div class="clearfix designed text-left">
                        <a href="<?php echo getenv('APP_URL'); ?>/" rel="nofollow" target="_blank"
                           title="<?php echo $footer_design_by; ?>"><?php echo $footer_design_by; ?> </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    $view_ban_do_bottom = $d->getOption('view_ban_do_bottom');
    if ($view_ban_do_bottom) {
        ?>
        <div class="bando-bottom container"><?= $information['map'] ?></div>
    <?php } ?>

    <!-- <div class="call_now">
  <a href="tel:<?= $information['hotline'] ?>">
    <div class="call_now_circle"></div>
    <div class="call_now_circle_fill"></div>
    <div class="call_now_icon"></div>
  </a>
</div> -->

    <!-- Modal order -->
    <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         data-backdrop="false">
        <div class="modal-dialog" role="document">
            <form id="price_request_form" name="price_request_form" class="request-price" method="post"
                  enctype="multipart/form-data">
                <input type="hidden" name="productId" id="productId" value="">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">YÊU CẦU BÁO GIÁ</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <img id="productImage" src=""
                                     style="width:70px;height:auto;max-width: 100%;margin-bottom: 15px;"
                                     class="pull-left"/>
                                <span>
          <h4 style="margin-left: 90px;" id="productName"></h4>
        </span>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email <i class="text-danger">*</i></label>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Email"
                                           required>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="so_dien_thoai"><?= _sodienthoai ?><i class="text-danger">*</i></label>
                                    <input type="text" id="so_dien_thoai" name="so_dien_thoai" class="form-control"
                                           placeholder="<?= _sodienthoai ?>" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="soLuong">Số lượng</label>
                                    <input type="number" class="form-control" name="soLuong" id="soLuong" value="1"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group textarea-message">
                                    <label for="noi_dung">Lời nhắn <i class="text-danger">*</i></label>
                                    <textarea type="text" class="form-control" style="max-width: 100%" id="noi_dung"
                                              name="noi_dung"
                                              placeholder="Thêm lời nhắn hoặc các yêu cầu khác của bạn..." rows="8"
                                              required aria-required></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Thông tin khác</label>
                                    <div>
                                        <label style="margin-right: 10px"><input type="checkbox" id="thongSoSanPham"
                                                                                 name="thongSoSanPham"> Để bán
                                            lại</label>
                                        <label style="margin-right: 10px"><input type="checkbox" id="chungNhanKiemDinh"
                                                                                 name="chungNhanKiemDinh"> Dùng cho
                                            doanh nghiệp</label>
                                        <label style="margin-right: 10px"><input type="checkbox" id="hoSoCongTy"
                                                                                 name="hoSoCongTy"> Dùng tại nhà</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group" id="listFiles">
                                    <label>Thêm tệp đính kèm (<small>Nhiều nhất 5 tệp</small>)</label>
                                    <input type="file" name="dinhKem[]"
                                           placeholder="Chọn file mẫu hoặc hình ảnh mà bạn muốn gửi cho chúng tôi"
                                           class="form-control file-att"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group item-captcha">
                                    <label for="captcha">Mã xác nhận <i class="text-danger">*</i></label>
                                    <input type="text" placeholder="Mã xác nhận" class="form-control" id="captcha"
                                           name="captcha"
                                           style="background: url(./sources/capchaimage.php) center right no-repeat"
                                           required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default col-md-5" data-dismiss="modal">Đóng</button>
                        <button name="sub_email" type="submit" class="btn btn-success col-md-6 pull-right"><i
                                    class="fa fa-paper-plane"></i> <?= _send ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Send Email -->
    <div class="modal fade" id="sendEmailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         data-backdrop="false">
        <div class="modal-dialog" role="document">
            <form id="send_email_form" name="send_email_form" class="send_email_form" method="post"
                  enctype="multipart/form-data">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Gửi Email Liên Hệ</h4>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ho_ten">Họ Tên <i class="text-danger">*</i></label>
                                    <input type="text" id="ho_ten" name="ho_ten" class="form-control"
                                           placeholder="Họ tên" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dien_thoai">Số điện thoại<i class="text-danger">*</i></label>
                                    <input type="text" id="dien_thoai" name="dien_thoai" class="form-control"
                                           placeholder="Số điện thoại" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tieu_de">Email <i class="text-danger">*</i></label>
                            <input type="email" id="contact_email" name="contact_email" class="form-control"
                                   placeholder="Email" required>
                        </div>

                        <div class="form-group">
                            <label for="tieu_de">Tiêu đề <i class="text-danger">*</i></label>
                            <input type="text" id="tieu_de" name="tieu_de" class="form-control" placeholder="Tiêu đề"
                                   required>
                        </div>

                        <div class="form-group textarea-message">
                            <label for="noi_dung">Lời nhắn <i class="text-danger">*</i></label>
                            <textarea type="text" class="form-control" style="max-width: 100%;" id="noi_dung"
                                      name="noi_dung" placeholder="Thông tin liên hệ hoặc yêu cầu của bạn..." rows="3"
                                      required aria-required></textarea>
                        </div>

                        <div class="form-group" id="listFiles">
                            <label>Thêm tệp đính kèm (<small>Nhiều nhất 3 tệp</small>)</label>
                            <input type="file" name="dinhKem[]"
                                   placeholder="Chọn file mẫu hoặc hình ảnh mà bạn muốn gửi cho chúng tôi"
                                   class="form-control file-att" multiple="multiple"/>
                        </div>

                        <div class="form-group item-captcha">
                            <label for="captcha">Mã xác nhận <i class="text-danger">*</i></label>
                            <input type="text" placeholder="Mã xác nhận" class="form-control" id="captcha"
                                   name="captcha"
                                   style="background: url(./sources/capchaimage.php) center right no-repeat" required>
                        </div>
                    </div>

                    <input type="hidden" name="root_path" value="<?php echo __ROOT_PATH ?>">
                    <input type="hidden" name="file_url" value="<?php echo FILEURL ?>">


                    <div class="modal-footer">
                        <button type="button" class="btn btn-default col-md-5" data-dismiss="modal">Đóng</button>
                        <button name="sub_email" type="submit" class="btn btn-success"><i class="fa fa-paper-plane"></i>
                            Gửi Email
                        </button>
                        <?php
                        $view_map_iframe_in_contact = $d->getOption('view_map_iframe_in_contact');
                        if ($view_map_iframe_in_contact):
                        ?>
                        <div class="iframe-contact" style="margin: 2rem 0;">
                            <?php echo $information['map']; ?>
                        </div>
                        <?php endif; ?>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <!-- Modal Contact Price -->
    <div class="modal fade" id="priceContactModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         data-backdrop="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-uppercase" id="myModalLabel">Yêu cầu báo giá</h4>
                </div>

                <div class="modal-body">
                    <div class="priceContactMsg"></div>
                    <div class="price-contact clearfix">
                        <?php include 'ct_form_lienhe.php'; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Check Order -->
    <div class="modal fade" id="checkorderModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         data-backdrop="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-uppercase" id="myModalLabel">Kiểm tra đơn hàng</h4>
                </div>

                <div class="modal-body">
                    <div class="checkOrderMsg"></div>
                    <form id="frmCheckOrder" action="" method="POST">
                        <div class="form-group text-center">
                            <label class="form-label">Mã đơn hàng:</label>
                            <input class="form-control" name="order_code" placeholder="Mã đơn hàng"
                                   style="max-width: 320px; margin: 0 auto" required/>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-success" type="submit">Kiểm tra</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Warranty Online -->
    <div class="modal modal-large fade" id="warrantyonlineModal" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" data-backdrop="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-uppercase" id="myModalLabel">Bảo hành online</h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <form id="frmWarrantyOnline" action="" method="POST">
                                <div class="warrantyOnlineMsg"></div>
                                <div class="form-group">
                                    <input placeholder="Serial*" type="text" class="form-control" name="specification"
                                           required/>
                                </div>
                                <div class="form-group">
                                    <input placeholder="Mã cào*" type="text" class="form-control" name="code" required/>
                                </div>
                                <div class="form-group">
                                    <input placeholder="Tên khách hàng*" type="text" class="form-control" name="name"
                                           minlength="2" required/>
                                </div>
                                <div class="form-group">
                                    <input placeholder="Điện thoại*" type="text" class="form-control" name="phone"
                                           minlength="10" required/>
                                </div>
                                <div class="form-group">
                                    <input placeholder="Email*" type="email" class="form-control" name="email"
                                           required/>
                                </div>
                                <div class="form-group">
                                    <input placeholder="Địa chỉ*" type="text" class="form-control" name="address"
                                           minlength="10" required/>
                                </div>
                                <div class="form-group text-center">
                                    <button class="btn btn-success" type="submit">Kích hoạt</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <div class="alert alert-success">
                                <h4>Hướng dẫn kích hoạt</h4>
                                1. Nhập số Serial, mã cào từ sản phẩm <br/>
                                2. Nhập các thông tin còn lại theo thông tin của bạn <br/>
                                3. Nhấn kích hoạt và chờ kết quả
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="box-item module text-center">
                                <h3>
                                    Xem trạng thái bảo hành
                                </h3>
                                <div class="checkSerialMsg"></div>
                                <form id="frmCheckSerial" action="" method="POST">
                                    <div class="form-group">
                                        <label class="form-label">Serial: <i class="text-danger">*</i></label>
                                        <input class="form-control" name="specification" placeholder="Serial sản phẩm"
                                               style="max-width: 320px; margin: 0 auto" required/>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-success" type="submit">Xem</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div><!--/.modal body-->
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal modal-large fade" id="supportModal" tabindex="-1" role="dialog" aria-labelledby="supportModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="supportModalLabel">Hỗ trợ trực tuyến</h4>
                </div>
                <div class="modal-body">
                    <?php
                    $supporters = $d->o_fet("select * from #_hotro where hien_thi=1 order by so_thu_tu asc, id desc");
                    ?>
                    <div class="row10 clearfix">
                        <?php foreach ($supporters as $support): ?>
                            <div class="col-md-4">
                                <div class="box-item module bg-white text-center shadow my-1" style="padding: 20px 0;">
                                    <?php if($support['image_path']){
                                        $support_img = '../img_data/images/'.$support['image_path'];
                                    } else {
                                        if (@$support['gender'] == 'female'){
                                            $support_img = '/templates/images/supporter-female.ico';
                                        } else {
                                            $support_img = '/templates/images/supporter-male.ico';
                                        }
                                    }?>
                                    <div class="support-img">
                                        <img src="<?php echo $support_img?>">
                                    </div>

                                    <h4 class="red">
                                        <?php echo $support['name_vi'] ?>
                                    </h4>
                                    <h3 class="phone">
                                        <?php echo $support['sdt'] ?>
                                    </h3>
                                    <div class="title-hotro hot-zalo text-center">
                                        <a class="btn btn-default btn-circle mr-1" href="tel:<?php echo $support['sdt'] ?>">
                                            <i class="fa fa-phone" style="width:20px"></i>
                                        </a>
                                        <a class="btn btn-default btn-circle mr-1" href="skype:<?php echo $support['skype'] ?>?chat">
                                            <img src="templates/images/skype.png" width="20" alt="skype">
                                        </a>
                                        <a class="btn btn-default btn-circle" href="https://zalo.me/<?php echo $support['yahoo'] ?>">
                                            <img src="templates/images/zalo.png" class="zalo" width="20" style="border-radius: 50%">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modalAddToCart" tabindex="-1" role="dialog" aria-labelledby="modalAddToCartLabel" data-backdrop="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modalAddToCartLabel">Sản phẩm <span class="product-name"></span> đã được thêm vào giỏ hàng</h4>
                </div>
                <div class="modal-body">
                    <form action="/gio-hang" id="form-shopping" class="form-horizontal form-order" method="post">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="dathang-form"><?php include 'form-dat-hang.php';?></div>
                            </div>
                            <div class="col-md-8">
                                <div class="title-form text-uppercase">Thông tin đơn hàng</div>
                                <div class="dathang-cart"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-large fade" id="modalZalo" tabindex="-1" role="dialog" aria-labelledby="modalZaloLabel" data-backdrop="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modalZaloLabel">Liên hệ qua Zalo</h4>
                </div>
                <div class="modal-body">
                    <?php
                    $popup_zalo_title = $d->getOption('popup_zalo_title');
                    $popup_zalo_phone = $d->getOption('popup_zalo_phone');
                    $popup_zalo_address = $d->getOption('popup_zalo_address');
                    $popup_zalo_website = $d->getOption('popup_zalo_website');
                    $popup_zalo_mail = $d->getOption('popup_zalo_mail');
                    $popup_zalo_description = $d->getOption('popup_zalo_description');
                    $popup_zalo_qr = $d->getOption('popup_zalo_qr');
                    $popup_zalo_avatar = $d->getOption('popup_zalo_avatar');
                    ?>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="zalo-head txt-flex">
                                <div class="thumb">
                                    <div class="text-center">
                                        <img src="<?php echo FILEURL . "img_data/images/" . $popup_zalo_avatar; ?>"
                                             alt="<?php echo $popup_zalo_title; ?>" width="80">
                                    </div>
                                </div>
                                <div class="info ml-1">
                                    <h3 class="zalo-name"><?php echo $popup_zalo_title; ?></h3>
                                    <a href="zalo://conversation?phone=<?php echo $popup_zalo_phone; ?>" class="btn btn-primary">
                                        <i class="fa fa-commenting" aria-hidden="true"></i> Nhắn tin
                                    </a>
                                </div>
                            </div>
                            <div class="zalo-body">
                                <h3>Hồ sơ kinh doanh</h3>
                                <p><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $popup_zalo_address; ?></p>
                                <p><i class="fa fa-link" aria-hidden="true"></i> <a href="<?php echo $popup_zalo_website; ?>"><?php echo $popup_zalo_website; ?></a></p>
                                <p><i class="fa fa-envelope" aria-hidden="true"></i> <?php echo $popup_zalo_mail; ?></p>
                                <hr class="mb-2 mt-2">
                                <div class="zalo-description">
                                    <?php echo $popup_zalo_description; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <img src="<?php echo FILEURL . "img_data/images/" . $popup_zalo_qr; ?>" alt="<?php echo $popup_zalo_phone; ?>" width="200">
                                <p>Mở Zalo, bấm quét QR để quét và xem trên điện thoại</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    $stt = 0;
    $cartTable = '';
    if (count($_SESSION['cart']) > 0) {
        foreach ($_SESSION['cart'] as $key => $value) {
            $product = $d->simple_fetch("select * from #_sanpham where id={$key}");
            $product['name_' . $_SESSION['lang']] = getCustomProductName($product);

            $cartProducts[] = $product;
            if (!empty($product)) {
                $stt++;
                $cartTable .= '
                    <tr>
                        <td>' . $stt . '</td>
                        <td>
                            <img onerror="this.src=\'' . $d->getDefaultProductImage() . '\';" 
                            src="' . THUMB_BASE . 'images/50/50/' . @$product['id'] . '/' . @$product['image_path'] . '" width="50" height="50">
                        </td>
                        <td class="text-left">' . @$product['name_' . $_SESSION['lang']] . '</td>
                        <td>' . $value['so_luong'] . '</td>
                    </tr>
                ';
            }
        }

        $cartTable = '<table class="table table-hover table-bordered ">
            <thead>
                <tr>
                    <th>STT</th>
                    <th align="left">Hình ảnh</th>
                    <th>' . _namepro . '</th>
                    <th align="center" class="th_soluong">' . _number . '</th>
                </tr>
            </thead>
            <tbody>
            ' . $cartTable . '
            </tbody>
        </table>
        ';
    }
    ?>
    <!-- Modal order -->
    <div class="modal fade" id="request_quote_cart_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="false">
        <div class="modal-dialog" role="document">
            <form id="request_quote_cart_form" name="request_quote_cart_form" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">YÊU CẦU BÁO GIÁ GIỎ HÀNG</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="request-price-cart-content">
                                <?php echo $cartTable; ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="request_quote_cart_ten">Tên <i class="text-danger">*</i></label>
                                    <input type="text" id="request_quote_cart_ten" name="ten" class="form-control" placeholder="Tên" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="request_quote_cart_email">Email <i class="text-danger">*</i></label>
                                    <input type="email" id="request_quote_cart_email" name="email" class="form-control" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="request_quote_cart_phone"><?= _sodienthoai ?><i class="text-danger">*</i></label>
                                    <input type="text" id="request_quote_cart_phone" name="dienthoai" class="form-control" placeholder="<?= _sodienthoai ?>" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group textarea-message">
                                    <label for="noi_dung">Lời nhắn</label>
                                    <textarea class="form-control" style="max-width: 100%" id="request_quote_cart_noi_dung" name="noi_dung"
                                              placeholder="Thêm lời nhắn hoặc các yêu cầu khác của bạn..." rows="4"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Bạn mua sản phẩm để</label>
                                    <div>
                                        <label style="margin-right: 10px"><input type="checkbox" id="thongSoSanPham" name="thongSoSanPham"> Để bán lại</label>
                                        <label style="margin-right: 10px"><input type="checkbox" id="chungNhanKiemDinh" name="chungNhanKiemDinh"> Dành cho doanh nghiệp</label>
                                        <label style="margin-right: 10px"><input type="checkbox" id="hoSoCongTy" name="hoSoCongTy"> Sử dụng tại nhà</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group" id="listFiles">
                                    <label>Thêm tệp đính kèm (<small>Nhiều nhất 5 tệp</small>)</label>
                                    <input type="file" name="dinhKem[]" placeholder="Chọn file mẫu hoặc hình ảnh mà bạn muốn gửi cho chúng tôi" class="form-control file-att" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group item-captcha">
                                    <label for="captcha">Mã xác nhận <i class="text-danger">*</i></label>
                                    <input type="text" placeholder="Mã xác nhận" class="form-control" id="captcha" name="captcha" style="background: url(./sources/capchaimage.php) center right no-repeat" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default col-md-5" data-dismiss="modal">Đóng</button>
                        <button name="sub_email" type="submit" class="btn btn-success col-md-6 pull-right"><i class="fa fa-paper-plane"></i> <?= _send ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php
        if (@$_SESSION['is_admin']) {
            include __ROOT_PATH . '/admin/templates/_parts/change-image.php';
        }
    ?>

    <script type="text/javascript">
        const Wind = {
            province: <?php echo !empty($_SESSION['delivery_area']) ? json_encode($_SESSION['delivery_area']) : '{}'; ?>,
            products: null,
            total: <?php echo 0; ?>
        };

        $(document).ready(function () {
            $('.btn-sendmail').on('click', function () {
                $('#sendEmailModal').modal('show');
                return false;
            });

            $('.btn-checkorder').on('click', function () {
                $('#checkorderModal').modal('show');
                return false;
            });

            $('.btn-warrantyonline').on('click', function () {
                $('#warrantyonlineModal').modal('show');
                return false;
            });

            $('.btn-priceContact').on('click', function () {
                $('#priceContactModal').modal('show');
                return false;
            });


            $('#frmCheckOrder').submit(function () {
                $('.checkOrderMsg').html('<h5 class="alert alert-warning text-center">Đơn hàng không tồn tại!</h5>');
                return false;
            });

            $('#frmWarrantyOnline').submit(function () {
                $('.warrantyOnlineMsg').html('<h5 class="alert alert-danger text-center">Số Serial sản phẩm không tồn tại hoặc mã cào không đúng!</h5>');
                return false;
            });

            $('#frmCheckSerial').submit(function () {
                $('.checkSerialMsg').html('<h5 class="alert alert-danger text-center">Số Serial sản phẩm không tồn tại!</h5>');
                return false;
            });

            $('#request_quote_cart_form').on('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);

                // Show loading
                swal("Đang gửi yêu cầu...");
                sweetAlert.disableButtons();

                $.ajax({
                    url: '/api.php?func=request_price_cart',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    timeout: 1000 * 60 * 5,
                    dataType: 'json',
                    success: data => {
                        if (!data || !data.isSuccess) {
                            swal({
                                title: "Có lỗi xảy ra",
                                text: data.error,
                                type: "error",
                                confirmButtonClass: 'btn-danger',
                                confirmButtonText: 'OK'
                            });

                            return;
                        }

                        swal({
                            title: "Gửi thành công",
                            text: "Chúng tôi sẽ liên hệ với bạn sớm nhất có thể!",
                            type: "success",
                            confirmButtonClass: 'btn-success',
                            confirmButtonText: 'OK'
                        }, function() {
                            window.location.href = '/';
                        });
                    },
                    fail: () => {
                        swal({
                            title: "Vui lòng thử lại!",
                            type: "warning",
                        });
                    },
                });
            });

            $("#send_email_form").submit(function (e) {
                e.preventDefault();
                $form = $(this);

                const formData = new FormData(this);

                // alert sending message
                swal({
                    title: "Đang gửi...",
                    type: "info",
                    showCancelButton: false,
                    confirmButtonClass: 'btn-info',
                    confirmButtonText: 'Sending'
                });
                sweetAlert.disableButtons();

                // Send data
                $.ajax({
                    url: '/api.php?func=email_contact',
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    method: 'POST',
                    data: formData,
                    timeout: 5000,
                    async: false,
                    success: function (data) {

                        //console.log(data);

                        if (data.isSuccess) {

                            $('#send_email_form')[0].reset();
                            $('#sendEmailModal').modal('toggle');

                            swal({
                                title: "Gửi thành công",
                                text: "Chúng tôi sẽ liên hệ với bạn sớm nhất có thể!",
                                type: "success",
                                confirmButtonClass: 'btn-success',
                                confirmButtonText: 'OK'
                            });


                        } else {

                            swal({
                                title: "Có lỗi xảy ra",
                                text: "Vui lòng thử lại!",
                                type: "error",
                                confirmButtonClass: 'btn-danger',
                                confirmButtonText: 'OK'
                            });

                        }
                    },
                    fail: () => {
                        swal({
                            title: "Có lỗi xảy ra",
                            text: "Vui lòng thử lại!",
                            type: "error",
                            confirmButtonClass: 'btn-danger',
                            confirmButtonText: 'OK'
                        });
                    },
                    error: () => {

                        $('#send_email_form')[0].reset();
                        $('#sendEmailModal').modal('toggle');

                        swal({
                            title: "Gửi thành công",
                            text: "Chúng tôi sẽ liên hệ với bạn sớm nhất có thể!",
                            type: "success",
                            confirmButtonClass: 'btn-success',
                            confirmButtonText: 'OK'
                        });
                    }
                }).always(() => {
                    // load new captcha
                    $form.find('#captcha').css('background', 'url(./sources/capchaimage.php?time=' + new Date().getTime() + ') center right no-repeat');
                }).error((er) => {

                    $('#send_email_form')[0].reset();
                    $('#sendEmailModal').modal('toggle');

                    swal({
                        title: "Gửi thành công",
                        text: "Chúng tôi sẽ liên hệ với bạn sớm nhất có thể!",
                        type: "success",
                        confirmButtonClass: 'btn-success',
                        confirmButtonText: 'OK'
                    });
                });
            });

            $('#send_email_form_1').submit(function (e) {
                e.preventDefault();
                $form = $(this);
                //var frmdata = $(this).serialize();

                // alert sending message
                swal({
                    title: "Đang gửi...",
                    type: "info",
                    showCancelButton: false,
                    confirmButtonClass: 'btn-info',
                    confirmButtonText: 'Sending'
                });
                sweetAlert.disableButtons();
                $.ajax({
                    //url: './ajax/ajax_send_mail.php',
                    url: '/api.php?func=email_contact',
                    dataType: 'json',
                    type: 'post',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    async: false,
                    success: function (res) {
                        console.log(res);
                        //alert(res.msg);

                        if (res.isSuccess) {
                            $('#send_email_form')[0].reset();
                            $('#sendEmailModal').modal('toggle');

                            swal({
                                title: "Gửi thành công",
                                text: "Chúng tôi sẽ liên hệ với bạn sớm nhất có thể!",
                                type: "success",
                                confirmButtonClass: 'btn-success',
                                confirmButtonText: 'OK'
                            });

                        } else {

                            swal({
                                title: res.msg,
                                text: "Vui lòng thử lại!",
                                type: "error",
                                confirmButtonClass: 'btn-danger',
                                confirmButtonText: 'OK'
                            });
                        }
                    }
                }).always(() => {
                    // load new captcha
                    $form.find('#captcha').css('background', 'url(./sources/capchaimage.php?time=' + new Date().getTime() + ') center right no-repeat');
                });

                return false;
            });

        });
    </script>

    <script type="text/javascript" src="<?= URLPATH ?>templates/js/crawler.js"></script>
    <script type="text/javascript">
        marqueeInit({
            uniqueid: 'mycrawler2',
            inc: 1,
            mouse: 'pause',
            moveatleast: 1,
            neutral: 120,
            savedirection: true,
            random: true,
        });
    </script>
    <script type="text/javascript">
        function email_subscribe() {
            var name = $('#txtemail').val();
            if (name === '') {
                alert('Vui lòng nhập Email!.');
                return false;
            }
            $.ajax({
                url: './sources/ajax.php',
                type: 'post',
                data: {'email': name, 'do': 'register_email'},
                success: function (data) {
                    if (data == 'ok') {
                        alert('Đăng ký thành công!');
                        location.reload();
                    } else if (data == 'replace') {
                        alert('Email đã được đăng ký!');
                    } else {
                        alert('Xảy ra lỗi!');
                        $('#subscribe_email').val('');
                    }
                }
            });
        };
    </script>
    <script type="text/javascript" src="/templates/js/jquery.lazy.min.js"></script>
    <script type="text/javascript" src="/admin/assets/bootstrap-sweetalert/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/admin/assets/bootstrap-sweetalert/sweetalert.css">

    <script>
        function updateInput2(input, value, pid) {
            input.value = value;
            chang_soluong(input, pid, '<?= @$_SESSION['iddonhang'] ?>');
        };

        function autoAddNewFile() {
            $('input.file-att').off();
            $('input.file-att').on('change', e => {

                const listFiles = $('input.file-att');
                for (let i = 0; i < listFiles.length; i++) {
                    const fileAtt = listFiles[i];
                    if (fileAtt.files.length === 0)
                        $(fileAtt).remove();
                }
                if ($('input.file-att').length < 5) {
                    $('#listFiles').append(`<input type="file" name="dinhKem[]" style="margin-top: 8px" placeholder="Chọn file mẫu hoặc hình ảnh mà bạn muốn gửi cho chúng tôi" class="form-control file-att" />`);
                }

                autoAddNewFile();
            });
        }

        $(document).ready(function () {
            autoAddNewFile();

            $('[data-toggle="tooltip"]').tooltip();

            $('.lazy').Lazy({
                // your configuration goes here
                // scrollDirection: 'vertical',
                effect: 'fadeIn',
                visibleOnly: true,
                onError: function (element) {
                    if (element.error) {
                        element.error();
                        return;
                    }
                    element.src = '<?= $d->getDefaultProductImage(300, 220) ?>';
                }
            });

            $('.show-price-request').on('click', function (e) {
                e.preventDefault();

                if ($('#product_detail_price_request').length > 0) {
                    const $priceRequestButton = $('#product_detail_price_request');
                    const detail = $priceRequestButton.data('detail');
                    const code = $priceRequestButton.data('code');
                    const productId = $priceRequestButton.data('product');
                    const image = $priceRequestButton.data('image');
                    const name = $priceRequestButton.data('title');

                    if (detail === true) {
                        $('#soLuong').val($('#numberOfProduct').val());
                    }

                    $('#productImage').attr('src', image);
                    $('#productId').val(productId);
                    $('#productName').html(name);
                    // $('#productCode').html(code);
                }

                $('#orderModal').modal('show');
            });

            $('.addcart').on('click', function (e) {
                const detail = $(this).data('detail');
                const code = $(this).data('code');
                const productId = $(this).data('product');
                const image = $(this).data('image');
                const name = $(this).data('title');

                if (detail === true) {
                    $('#soLuong').val($('#numberOfProduct').val());
                }

                $('#productImage').attr('src', image);
                $('#productId').val(productId);
                $('#productName').html(name);
                // $('#productCode').html(code);

                $('#orderModal').modal('show');
            });
        });

        $("form.request-price").submit(function (e) {
            e.preventDefault();
            $form = $(this);

            const formData = new FormData(this);

            // alert sending message
            swal({
                title: "Đang gửi...",
                type: "info",
                showCancelButton: false,
                confirmButtonClass: 'btn-info',
                confirmButtonText: 'Sending'
            });
            sweetAlert.disableButtons();

            // Send data
            $.ajax({
                url: '/api.php?func=request_price',
                processData: false,
                contentType: false,
                dataType: 'json',
                method: 'POST',
                data: formData,
                timeout: 5000,
                async: false,
                success: function (data) {

                    //console.log(data);

                    if (data.isSuccess) {

                        $('#price_request_form')[0].reset();
                        $('#orderModal').modal('toggle');

                        swal({
                            title: "Gửi thành công",
                            text: "Chúng tôi sẽ liên hệ với bạn sớm nhất có thể!",
                            type: "success",
                            confirmButtonClass: 'btn-success',
                            confirmButtonText: 'OK'
                        });


                    } else {

                        swal({
                            title: "Có lỗi xảy ra",
                            text: "Vui lòng thử lại!",
                            type: "error",
                            confirmButtonClass: 'btn-danger',
                            confirmButtonText: 'OK'
                        });

                    }
                },
                fail: () => {
                    swal({
                        title: "Có lỗi xảy ra",
                        text: "Vui lòng thử lại!",
                        type: "error",
                        confirmButtonClass: 'btn-danger',
                        confirmButtonText: 'OK'
                    });
                },
                error: () => {
                    /*
                    swal({
                      title: "Có lỗi xảy ra",
                      text: "Vui lòng thử lại!",
                      type: "error",
                      confirmButtonClass: 'btn-danger',
                      confirmButtonText: 'OK'
                    });*/
                    $('#price_request_form')[0].reset();
                    $('#orderModal').modal('toggle');

                    swal({
                        title: "Gửi thành công",
                        text: "Chúng tôi sẽ liên hệ với bạn sớm nhất có thể!",
                        type: "success",
                        confirmButtonClass: 'btn-success',
                        confirmButtonText: 'OK'
                    });
                }
            }).always(() => {
                // load new captcha
                $form.find('#captcha').css('background', 'url(./sources/capchaimage.php?time=' + new Date().getTime() + ') center right no-repeat');
            }).error((er) => {
                //console.log(er);
                /*
                swal({
                  title: "Có lỗi xảy ra 3",
                  text: "Vui lòng thử lại!",
                  type: "error",
                  confirmButtonClass: 'btn-danger',
                  confirmButtonText: 'OK'
                });*/
                $('#price_request_form')[0].reset();
                $('#orderModal').modal('toggle');

                swal({
                    title: "Gửi thành công",
                    text: "Chúng tôi sẽ liên hệ với bạn sớm nhất có thể!",
                    type: "success",
                    confirmButtonClass: 'btn-success',
                    confirmButtonText: 'OK'
                });
            });
        });
    </script>

    <?php

    ?>
    <script type="text/javascript" src="<?= URLPATH ?>templates/js/jquery.cookie.js"></script>
    <script type="text/javascript">

        function changeProductLayout(layout) {
            $.cookie('productLayout', layout);
            location.reload();
        }

    </script>

    <!-- Update view -->
    <script type="text/javascript">
        <?php
        $productId = 0;
        if (defined('__PRODUCT_ID')) {
            $productId = __PRODUCT_ID;
        }
        ?>
        var apiViewCount = '/api.php?func=view&productId=<?php echo $productId ?>';
        $(document).ready(function () {
            $.get(apiViewCount);
        });
    </script>
    <?php
    $cacheContent = ob_get_flush();
    file_put_contents($cachePath, minify_html($cacheContent));
}
?>