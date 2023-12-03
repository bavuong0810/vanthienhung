<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html style="width:100%;font-family:arial, 'helvetica neue', helvetica, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0;">
 <head> 
  <meta charset="UTF-8"> 
  <meta content="width=device-width, initial-scale=1" name="viewport"> 
  <meta name="x-apple-disable-message-reformatting"> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
  <meta content="telephone=no" name="format-detection"> 
  <title><?php echo getenv('APP_DOMAIN'); ?></title> 
  <!--[if (mso 16)]>
    <style type="text/css">
    a {text-decoration: none;}
    </style>
    <![endif]--> 
  <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]--> 
  <style type="text/css">
@media only screen and (max-width:600px) {p, ul li, ol li, a { font-size:16px!important } h1 { font-size:30px!important; text-align:center } h2 { font-size:26px!important; text-align:center } h3 { font-size:20px!important; text-align:center } h1 a { font-size:30px!important } h2 a { font-size:26px!important } h3 a { font-size:20px!important } .es-header-body p, .es-header-body ul li, .es-header-body ol li, .es-header-body a { font-size:16px!important } .es-footer-body p, .es-footer-body ul li, .es-footer-body ol li, .es-footer-body a { font-size:16px!important } .es-infoblock p, .es-infoblock ul li, .es-infoblock ol li, .es-infoblock a { font-size:12px!important } *[class="gmail-fix"] { display:none!important } .es-m-txt-c, .es-m-txt-c h1, .es-m-txt-c h2, .es-m-txt-c h3 { text-align:center!important } .es-m-txt-r, .es-m-txt-r h1, .es-m-txt-r h2, .es-m-txt-r h3 { text-align:right!important } .es-m-txt-l, .es-m-txt-l h1, .es-m-txt-l h2, .es-m-txt-l h3 { text-align:left!important } .es-m-txt-r a img, .es-m-txt-c a img, .es-m-txt-l a img { display:inline!important } .es-button-border { display:block!important } .es-button { font-size:20px!important; display:block!important; border-left-width:0px!important; border-right-width:0px!important } .es-btn-fw { border-width:10px 0px!important; text-align:center!important } .es-adaptive table, .es-btn-fw, .es-btn-fw-brdr, .es-left, .es-right { width:100%!important } .es-content table, .es-header table, .es-footer table, .es-content, .es-footer, .es-header { width:100%!important; max-width:600px!important } .es-adapt-td { display:block!important; width:100%!important } .adapt-img { width:100%!important; height:auto!important } .es-m-p0 { padding:0px!important } .es-m-p0r { padding-right:0px!important } .es-m-p0l { padding-left:0px!important } .es-m-p0t { padding-top:0px!important } .es-m-p0b { padding-bottom:0!important } .es-m-p20b { padding-bottom:20px!important } .es-mobile-hidden, .es-hidden { display:none!important } .es-desk-hidden { display:table-row!important; width:auto!important; overflow:visible!important; float:none!important; max-height:inherit!important; line-height:inherit!important } .es-desk-menu-hidden { display:table-cell!important } table.es-table-not-adapt, .esd-block-html table { width:auto!important } table.es-social { display:inline-block!important } table.es-social td { display:inline-block!important } .es-menu td a { font-size:16px!important } }
#outlook a {
	padding:0;
}
.ExternalClass {
	width:100%;
}
.ExternalClass,
.ExternalClass p,
.ExternalClass span,
.ExternalClass font,
.ExternalClass td,
.ExternalClass div {
	line-height:100%;
}
.es-button {
	mso-style-priority:100!important;
	text-decoration:none!important;
}
a[x-apple-data-detectors] {
	color:inherit!important;
	text-decoration:none!important;
	font-size:inherit!important;
	font-family:inherit!important;
	font-weight:inherit!important;
	line-height:inherit!important;
}
.es-desk-hidden {
	display:none;
	float:left;
	overflow:hidden;
	width:0;
	max-height:0;
	line-height:0;
	mso-hide:all;
}

</style> 
 </head> 

<?php
$site_url = getenv('APP_URL');
$SETTINGS = $d->getAllSettings();
//$logo_url = $site_url. '/img_data/images/'.$SETTINGS['website_logo']['value'];
$logo_url = $site_url. '/images/160/65/'.$SETTINGS['website_logo']['value'] . '?zc=0';

$email_query = "SELECT * FROM #_email_bao_gia";
$email_items = $d->o_fet($email_query);
$email_menu_title_1 = $email_items[0]['email_menu_title_1'];
$email_menu_link_1 = $email_items[0]['email_menu_link_1'];
$email_menu_title_2 = $email_items[0]['email_menu_title_2'];
$email_menu_link_2 = $email_items[0]['email_menu_link_2'];
$email_menu_title_3 = $email_items[0]['email_menu_title_3'];
$email_menu_link_3 = $email_items[0]['email_menu_link_3'];
$email_content = $email_items[0]['email_content'];
$email_address = $email_items[0]['email_address'];
$email_phone = $email_items[0]['email_phone'];
$email_email = $email_items[0]['email_email'];
$email_footer_title = $email_items[0]['email_footer_title'];
$email_footer_content = $email_items[0]['email_footer_content'];
$email_footer_menu_title_1 = $email_items[0]['email_footer_menu_title_1'];
$email_footer_menu_link_1 = $email_items[0]['email_footer_menu_link_1'];
$email_footer_menu_title_2 = $email_items[0]['email_footer_menu_title_2'];
$email_footer_menu_link_2 = $email_items[0]['email_footer_menu_link_2'];
$email_footer_menu_title_3 = $email_items[0]['email_footer_menu_title_3'];
$email_footer_menu_link_3 = $email_items[0]['email_footer_menu_link_3'];
?>

 <body style="width:100%;font-family:arial, 'helvetica neue', helvetica, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0;"> 
  <div class="es-wrapper-color" style="background-color:#EFEFEF;"> 
   <!--[if gte mso 9]>
			<v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
				<v:fill type="tile" color="#efefef"></v:fill>
			</v:background>
		<![endif]--> 
  
   <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;"> 
    <tbody> 
     <tr style="border-collapse:collapse;"> 
      <td valign="top" style="padding:0;Margin:0;"> 
       <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;"> 
        <tbody> 
         <tr style="border-collapse:collapse;"> 
          <td class="es-adaptive" align="center" style="padding:0;Margin:0;"> 
           <table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#EFEFEF;" width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center"> 
            <tbody> 
             <tr style="border-collapse:collapse;"> 
              <td align="left" style="Margin:0;padding-top:5px;padding-bottom:5px;padding-left:20px;padding-right:20px;"> 
               <!--[if mso]><table width="560" cellpadding="0" cellspacing="0"><tr><td width="270" valign="top"><![endif]--> 
               <table class="es-left" cellspacing="0" cellpadding="0" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left;"> 
                <tbody> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="270" align="left" style="padding:0;Margin:0;"> 
                   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                    <tbody> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="center" style="padding:0;Margin:0;display:none;"></td> 
                     </tr> 
                    </tbody> 
                   </table> </td> 
                 </tr> 
                </tbody> 
               </table> 
               <!--[if mso]></td><td width="20"></td><td width="270" valign="top"><![endif]--> 
               <table class="es-right" cellspacing="0" cellpadding="0" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right;"> 
                <tbody> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="270" align="left" style="padding:0;Margin:0;"> 
                   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                    <tbody> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="center" style="padding:0;Margin:0;display:none;"></td> 
                     </tr> 
                    </tbody> 
                   </table> </td> 
                 </tr> 
                </tbody> 
               </table> 
               <!--[if mso]></td></tr></table><![endif]--> </td> 
             </tr> 
            </tbody> 
           </table> </td> 
         </tr> 
        </tbody> 
       </table> 
       <table class="es-header" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;"> 
        <tbody> 
         <tr style="border-collapse:collapse;"> 
          <td align="center" style="padding:0;Margin:0;"> 
           <table class="es-header-body" width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FEF5E4;"> 
            <tbody> 
             <tr style="border-collapse:collapse;"> 
              <td align="left" style="Margin:0;padding-top:5px;padding-bottom:5px;padding-left:15px;padding-right:15px;"> 
               <!--[if mso]><table width="570" cellpadding="0" cellspacing="0"><tr><td width="180" valign="top"><![endif]--> 
               <table class="es-left" cellspacing="0" cellpadding="0" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left;"> 
                <tbody> 
                 <tr style="border-collapse:collapse;"> 
                  <td class="es-m-p0r" width="180" valign="top" align="center" style="padding:0;Margin:0;"> 
                   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                    <tbody> 
                     <tr style="border-collapse:collapse;"> 
                      <td class="es-m-p0l es-m-txt-c" align="left" style="padding:0;Margin:0;padding-left:15px;"> <a href="<?php echo getenv('APP_URL'); ?>/" target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:14px;text-decoration:underline;color:#999999;"><img src="<?php echo $logo_url; ?>" alt="<?php echo getenv('APP_DOMAIN'); ?> logo" title="<?php echo getenv('APP_DOMAIN'); ?> logo" width="165" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" class="esdev-stretch-width"> </a> </td> 
                     </tr> 
                    </tbody> 
                   </table> </td> 
                 </tr> 
                </tbody> 
               </table> 
               <!--[if mso]></td><td width="20"></td><td width="370" valign="top"><![endif]--> 
               <table cellspacing="0" cellpadding="0" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                <tbody> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="370" align="left" style="padding:0;Margin:0;"> 
                   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                    <tbody> 
                     <tr style="border-collapse:collapse;"> 
                      <td style="padding:0;Margin:0;"> 
                       <table class="es-menu" width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                        <tbody> 
                         <tr class="links" style="border-collapse:collapse;"> 
                          <td align="center" width="33.33%" style="Margin:0;padding-left:5px;padding-right:5px;padding-top:20px;padding-bottom:10px;border:0;" id="esd-menu-id-0" bgcolor="transparent"> <a target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:16px;text-decoration:none;display:block;color:#333333;" href="<?php echo $email_menu_link_1; ?>"><?php echo $email_menu_title_1; ?></a> </td> 
                          <td align="center" width="33.33%" style="Margin:0;padding-left:5px;padding-right:5px;padding-top:20px;padding-bottom:10px;border:0;" id="esd-menu-id-1" bgcolor="transparent" esdev-border-color="#000000" esdev-border-style="solid"> <a target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:16px;text-decoration:none;display:block;color:#333333;" href="<?php echo $email_menu_link_2; ?>"><?php echo $email_menu_title_2; ?></a> </td> 
                          <td align="center" width="33.33%" style="Margin:0;padding-left:5px;padding-right:5px;padding-top:20px;padding-bottom:10px;border:0;" id="esd-menu-id-2" bgcolor="transparent" esdev-border-color="#000000" esdev-border-style="solid"> <a target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:16px;text-decoration:none;display:block;color:#333333;" href="<?php echo $email_menu_link_3; ?>"><?php echo $email_menu_title_3; ?></a> </td> 
                         </tr> 
                        </tbody> 
                       </table> </td> 
                     </tr> 
                    </tbody> 
                   </table> </td> 
                 </tr> 
                </tbody> 
               </table> 
               <!--[if mso]></td></tr></table><![endif]--> </td> 
             </tr> 
            </tbody> 
           </table> </td> 
         </tr> 
        </tbody> 
       </table> 
       <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;"> 
        <tbody> 
         <tr style="border-collapse:collapse;"> 
          <td align="center" style="padding:0;Margin:0;"> 
           <table class="es-content-body" width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;"> 
            <tbody> 
             <tr style="border-collapse:collapse;"> 
              <td align="left" style="Margin:0;padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;"> 
               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                <tbody> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="560" valign="top" align="center" style="padding:0;Margin:0;"> 
                   <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;border-radius:0px;" width="100%" cellspacing="0" cellpadding="0"> 
                    <tbody> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="center" style="padding:0;Margin:0;padding-top:10px;padding-bottom:15px;">
                        <?php echo $email_content?>
                      </td> 
                     </tr> 
                     
                     <tr style="border-collapse:collapse;"> 
                      <td align="center" style="padding:0;Margin:0;padding-bottom:10px;padding-top:15px;"> <span class="es-button-border" style="border-style:solid;border-color:#2CB543;background:none 0% 0% repeat scroll #D48344;border-width:0px;display:inline-block;border-radius:5px;width:auto;border-top-width:0px;border-bottom-width:0px;"> <a href="<?php echo getenv('APP_URL'); ?>/" class="es-button" target="_blank" style="mso-style-priority:100 !important;text-decoration:underline;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:16px;color:#FFFFFF;border-style:solid;border-color:#D48344;border-width:10px 20px 10px 20px;display:inline-block;background:#D48344 none repeat scroll 0% 0%;border-radius:5px;font-weight:normal;font-style:normal;line-height:120%;width:auto;text-align:center;border-top-width:10px;border-bottom-width:10px;">Xem website</a> </span> </td> 
                     </tr> 
                    </tbody> 
                   </table> </td> 
                 </tr> 
                </tbody> 
               </table> </td> 
             </tr> 
            </tbody> 
           </table> </td> 
         </tr> 
        </tbody> 
       </table> 
       <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;"> 
        <tbody> 
         <tr style="border-collapse:collapse;"> 
          <td align="center" style="padding:0;Margin:0;"> 
           <table class="es-content-body" width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;"> 
            <tbody> 
             <tr style="border-collapse:collapse;"> 
              <td align="left" style="Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;padding-bottom:30px;"> 
               <!--[if mso]><table width="560" cellpadding="0" cellspacing="0"><tr><td width="280" valign="top"><![endif]--> 
               <table class="es-left" cellspacing="0" cellpadding="0" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left;"> 
                <tbody> 
                 <tr style="border-collapse:collapse;"> 
                  <td class="es-m-p20b" width="280" align="left" style="padding:0;Margin:0;"> 
                   <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;background-color:#FEF9EF;border-color:#EFEFEF;border-width:1px 0px 1px 1px;border-style:solid;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#fef9ef"> 
                    <tbody> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="left" style="Margin:0;padding-bottom:10px;padding-top:20px;padding-left:20px;padding-right:20px;"> <h4 style="Margin:0;line-height:120%;mso-line-height-rule:exactly;font-family:'trebuchet ms', helvetica, sans-serif;">Bạn đã yêu cầu:</h4></td> 
                     </tr> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="left" style="padding:0;Margin:0;padding-bottom:20px;padding-left:20px;padding-right:20px;"> 
                       <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:100%;" class="cke_show_border" cellspacing="1" cellpadding="1" border="0" align="left"> 
                        <tbody> 
                         <tr style="border-collapse:collapse;"> 
                          <td style="padding:0;Margin:0;"><span style="font-size:14px;line-height:150%;">- Giá</span></td> 
                          <td style="padding:0;Margin:0;"><br></td> 
                         </tr>
                         <tr style="border-collapse:collapse;"> 
                          <td style="padding:0;Margin:0;">
                            <?php
                            if (@$_POST['thongSoSanPham']) {
                              ?>
                              <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:150%;color:#333333;"><span style="font-size:14px;line-height:150%;">- Để bán lại</span><br></p>
                              <?php
                            } ?>
                            <?php
                            if (@$_POST['chungNhanKiemDinh']) {
                              ?>
                              <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:150%;color:#333333;"><span style="font-size:14px;line-height:150%;">- Dùng cho doanh nghiệp</span><br></p>
                              <?php
                            } ?>
                            <?php
                            if (@$_POST['hoSoCongTy']) {
                              ?>
                              <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:150%;color:#333333;"><span style="font-size:14px;line-height:150%;">- Sử dụng tại nhà</span><br></p>
                              <?php
                            } ?>
                          </td> 
                          <td style="padding:0;Margin:0;"></td> 
                         </tr> 
                        </tbody> 
                       </table><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:150%;color:#333333;"><br></p></td> 
                     </tr> 
                    </tbody> 
                   </table> </td> 
                 </tr> 
                </tbody> 
               </table> 
               <!--[if mso]></td><td width="0"></td><td width="280" valign="top"><![endif]--> 
               <table class="es-right" cellspacing="0" cellpadding="0" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right;"> 
                <tbody> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="280" align="left" style="padding:0;Margin:0;"> 
                   <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;background-color:#FEF9EF;border-width:1px;border-style:solid;border-color:#EFEFEF;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#fef9ef"> 
                    <tbody> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="left" style="Margin:0;padding-bottom:10px;padding-top:20px;padding-left:20px;padding-right:20px;"> <h4 style="Margin:0;line-height:120%;mso-line-height-rule:exactly;font-family:'trebuchet ms', helvetica, sans-serif;">Lời nhắn:</h4></td> 
                     </tr> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="left" style="padding:0;Margin:0;padding-bottom:20px;padding-left:20px;padding-right:20px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:150%;color:#333333;"><?php echo @$_POST['noi_dung']; ?></p></td> 
                     </tr> 
                    </tbody> 
                   </table> </td> 
                 </tr> 
                </tbody> 
               </table> 
               <!--[if mso]></td></tr></table><![endif]--> </td> 
             </tr> 
            </tbody> 
           </table> </td> 
         </tr> 
        </tbody> 
       </table> 
       <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;"> 
        <tbody> 
         <tr style="border-collapse:collapse;"> 
          <td align="center" style="padding:0;Margin:0;"> 
           <table class="es-content-body" width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;"> 
            <tbody> 
             <tr style="border-collapse:collapse;"> 
              <td align="left" style="Margin:0;padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;"> 
               <!--[if mso]><table width="560" cellpadding="0" cellspacing="0"><tr><td width="270" valign="top"><![endif]--> 
               <table class="es-left" cellspacing="0" cellpadding="0" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left;"> 
                <tbody> 
                 <tr style="border-collapse:collapse;"> 
                  <td class="es-m-p0r es-m-p20b" width="140" valign="top" align="center" style="padding:0;Margin:0;"> 
                   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                    <tbody> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="left" style="padding:0;Margin:0;padding-left:20px;"> <h4 style="Margin:0;line-height:120%;mso-line-height-rule:exactly;font-family:'trebuchet ms', helvetica, sans-serif;">SẢN PHẨM</h4> </td> 
                     </tr> 
                    </tbody> 
                   </table> </td> 
                 </tr> 
                </tbody> 
               </table> 
               <!--[if mso]></td><td width="20"></td><td width="270" valign="top"><![endif]--> 
               <table cellspacing="0" cellpadding="0" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                <tbody> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="400" align="left" style="padding:0;Margin:0;"> 
                   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                    <tbody> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="left" style="padding:0;Margin:0;"> 
                       <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:100%;" class="cke_show_border" cellspacing="1" cellpadding="1" border="0"> 
                        <tbody> 
                         <tr style="border-collapse:collapse;"> 
                          <td style="padding:0;Margin:0;"><span style="font-size:13px;">TÊN</span></td> 
                          <td style="padding:0;Margin:0;text-align:center;" width="100"><span style="font-size:13px;"><span style="line-height:100%;">SỐ LƯỢNG</span></span> </td> 
                         </tr> 
                        </tbody> 
                       </table> </td> 
                     </tr> 
                    </tbody> 
                   </table> </td> 
                 </tr> 
                </tbody> 
               </table> 
               <!--[if mso]></td></tr></table><![endif]--> </td> 
             </tr> 
             <tr style="border-collapse:collapse;"> 
              <td align="left" style="padding:0;Margin:0;padding-left:20px;padding-right:20px;"> 
               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                <tbody> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="560" valign="top" align="center" style="padding:0;Margin:0;"> 
                   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                    <tbody> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="center" style="padding:0;Margin:0;padding-bottom:10px;"> 
                       <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                        <tbody> 
                         <tr style="border-collapse:collapse;"> 
                          <td style="padding:0;Margin:0px;border-bottom:1px solid #EFEFEF;background:rgba(0, 0, 0, 0) none repeat scroll 0% 0%;height:1px;width:100%;margin:0px;"></td> 
                         </tr> 
                        </tbody> 
                       </table> </td> 
                     </tr> 
                    </tbody> 
                   </table> </td> 
                 </tr> 
                </tbody> 
               </table> </td> 
             </tr> 
            <?php
            foreach ($_SESSION['cart'] as $key => $value) {

              $product = $d->simple_fetch("select * from #_sanpham where id={$key}");
              if (empty($product)) {
                continue;
              }
             ?>
             <!-- Start product row -->
             <tr style="border-collapse:collapse;"> 
              <td align="left" style="Margin:0;padding-top:5px;padding-bottom:10px;padding-left:20px;padding-right:20px;"> 
               <!--[if mso]><table width="560" cellpadding="0" cellspacing="0"><tr><td width="178" valign="top"><![endif]--> 
               <table class="es-left" cellspacing="0" cellpadding="0" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left;"> 
                <tbody> 
                 <tr style="border-collapse:collapse;"> 
                  <td class="es-m-p0r es-m-p20b" width="140" valign="top" align="center" style="padding:0;Margin:0;"> 
                   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                    <tbody> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="center" style="padding:0;Margin:0;"> <img src="<?php echo FILEURL."img_data/images/".$product['image_path']; ?>" alt="<?php echo $product['name_'.$_SESSION['lang']]; ?>" class="adapt-img" title="<?php echo $product['name_'.$_SESSION['lang']]; ?>" width="125" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;"></td>
                     </tr> 
                    </tbody> 
                   </table> </td> 
                 </tr> 
                </tbody> 
               </table> 
               <!--[if mso]></td><td width="20"></td><td width="362" valign="top"><![endif]--> 
               <table cellspacing="0" cellpadding="0" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                <tbody> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="400" align="left" style="padding:0;Margin:0;"> 
                   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                    <tbody> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="left" style="padding:0;Margin:0;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:150%;color:#333333;"><br></p> 
                       <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:100%;" class="cke_show_border" cellspacing="1" cellpadding="1" border="0"> 
                        <tbody> 
                         <tr style="border-collapse:collapse;"> 
                          <td style="padding:0;Margin:0;"><?php echo $product['name_'.$_SESSION['lang']]; ?></td> 
                          <td style="padding:0;Margin:0;text-align:center;" width="100"><?php echo $value['so_luong']; ?></td>
                         </tr> 
                        </tbody> 
                       </table> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:150%;color:#333333;"><br></p> </td> 
                     </tr> 
                    </tbody> 
                   </table> </td> 
                 </tr> 
                </tbody> 
               </table> 
               <!--[if mso]></td></tr></table><![endif]--> </td> 
             </tr>
             <!-- // End product row -->
           <?php } ?>
             <tr style="border-collapse:collapse;"> 
              <td align="left" style="padding:0;Margin:0;padding-left:20px;padding-right:20px;"> 
               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                <tbody> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="560" valign="top" align="center" style="padding:0;Margin:0;"> 
                   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                    <tbody> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="center" style="padding:0;Margin:0;padding-bottom:10px;"> 
                       <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                        <tbody> 
                         <tr style="border-collapse:collapse;"> 
                          <td style="padding:0;Margin:0px;border-bottom:1px solid #EFEFEF;background:rgba(0, 0, 0, 0) none repeat scroll 0% 0%;height:1px;width:100%;margin:0px;"></td> 
                         </tr> 
                        </tbody> 
                       </table> </td> 
                     </tr> 
                    </tbody> 
                   </table> </td> 
                 </tr> 
                </tbody> 
               </table> </td> 
             </tr>
            </tbody> 
           </table> </td> 
         </tr> 
        </tbody> 
       </table> 
       <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;"> 
        <tbody> 
         <tr style="border-collapse:collapse;"> 
         </tr> 
         <tr style="border-collapse:collapse;"> 
          <td align="center" style="padding:0;Margin:0;"> 
           <table class="es-footer-body" width="600" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FEF5E4;"> 
            <tbody> 
             <tr style="border-collapse:collapse;"> 
              <td align="left" style="padding:20px;Margin:0;"> 
               <!--[if mso]><table width="560" cellpadding="0" cellspacing="0"><tr><td width="178" valign="top"><![endif]--> 
               <table class="es-left" cellspacing="0" cellpadding="0" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left;"> 
                <tbody> 
                 <tr style="border-collapse:collapse;"> 
                  <td class="es-m-p0r es-m-p20b" width="178" valign="top" align="center" style="padding:0;Margin:0;"> 
                   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                    <tbody> 
                     <tr style="border-collapse:collapse;"> 
                      <td class="es-m-p0l es-m-txt-c" align="left" style="padding:0;Margin:0;"> <a href="<?php echo getenv('APP_URL'); ?>" target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:14px;text-decoration:underline;color:#333333;"><img src="<?php echo $logo_url ?>" alt="<?php echo getenv('APP_DOMAIN'); ?> logo" title="<?php echo getenv('APP_DOMAIN'); ?> logo" width="108" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;"></a> </td> 
                     </tr> 
                     <tr style="border-collapse:collapse;"> 
                      <td class="es-m-txt-c" align="left" style="padding:0;Margin:0;padding-bottom:5px;padding-top:10px;"><?php echo $email_address?></td> 
                     </tr> 
                     <tr style="border-collapse:collapse;"> 
                      <td class="es-m-txt-c" align="left" style="padding:0;Margin:0;padding-top:5px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:150%;color:#333333;"><a target="_blank" href="tel:<?php echo $email_phone?>" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:14px;text-decoration:underline;color:#333333;"><?php echo $email_phone?></a><br><a target="_blank" href="mailto:<?php echo $email_email?>" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:14px;text-decoration:underline;color:#333333;"><?php echo $email_email?></a></p></td> 
                     </tr> 
                    </tbody> 
                   </table> </td> 
                 </tr> 
                </tbody> 
               </table> 
               <!--[if mso]></td><td width="20"></td><td width="362" valign="top"><![endif]--> 
               <table cellspacing="0" cellpadding="0" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                <tbody> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="362" align="left" style="padding:0;Margin:0;"> 
                   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                    <tbody> 
                     <tr style="border-collapse:collapse;"> 
                      <td class="es-m-txt-c" align="left" style="padding:0;Margin:0;padding-top:15px;padding-bottom:20px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:20px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:150%;color:#333333;"><?php echo $email_footer_title?></p></td> 
                     </tr> 
                     <tr style="border-collapse:collapse;"> 
                      <td class="es-m-txt-c" align="left" style="padding:0;Margin:0;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:150%;color:#333333;"><?php echo $email_footer_content?></p></td> 
                     </tr> 
                     <tr style="border-collapse:collapse;"> 
                      <td class="es-m-txt-c" align="left" style="padding:0;Margin:0;padding-top:10px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:12px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:150%;color:#333333;"><a target="_blank" href="<?php echo $email_footer_menu_link_1?>" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:12px;text-decoration:underline;color:#333333;line-height:150%;"><?php echo $email_footer_menu_title_1?></a> ♦ <a target="_blank" href="<?php echo $email_footer_menu_link_2?>" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:12px;text-decoration:underline;color:#333333;"><?php echo $email_footer_menu_title_2?></a> ♦ <a target="_blank" href="<?php echo $email_footer_menu_link_3?>" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:12px;text-decoration:underline;color:#333333;"><?php echo $email_footer_menu_title_3?></a></p></td> 
                     </tr> 
                    </tbody> 
                   </table> </td> 
                 </tr> 
                </tbody> 
               </table> 
               <!--[if mso]></td></tr></table><![endif]--> </td> 
             </tr> 
            </tbody> 
           </table> </td> 
         </tr> 
        </tbody> 
       </table> 
       <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;"> 
        <tbody> 
         <tr style="border-collapse:collapse;"> 
          <td align="center" style="padding:0;Margin:0;"> 
           <table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;" width="600" cellspacing="0" cellpadding="0" align="center"> 
            <tbody> 
             <tr style="border-collapse:collapse;"> 
              <td align="left" style="Margin:0;padding-left:20px;padding-right:20px;padding-top:30px;padding-bottom:30px;"> 
               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                <tbody> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="560" valign="top" align="center" style="padding:0;Margin:0;"> 
                   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                    <tbody> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="center" style="padding:0;Margin:0;display:none;"></td> 
                     </tr> 
                    </tbody> 
                   </table> </td> 
                 </tr> 
                </tbody> 
               </table> </td> 
             </tr> 
            </tbody> 
           </table> </td> 
         </tr> 
        </tbody> 
       </table> </td> 
     </tr> 
    </tbody> 
   </table> 
  </div>  
 </body>
</html>