<?php
$query = "SELECT * FROM #_emails WHERE `email_type` = 'dat_hang'";
$items = $d->o_fet($query);

$tell = $items[0]['tell'];
$zalo = $items[0]['zalo'];
$skype = $items[0]['skype'];
$website = $items[0]['website'];
$reply_content = $items[0]['reply_content'];
$thank_you = $items[0]['thank_you'];
$dear_name = $items[0]['dear_name'];
$company_info_title = $items[0]['company_info_title'];
$company_info_account = $items[0]['company_info_account'];
$personal_info_title = $items[0]['personal_info_title'];
$personal_info_account = $items[0]['personal_info_account'];
?>
<div>
    <?php echo $reply_content; ?>
</div>

<p><span style="color:rgb(34, 34, 34); font-family:arial,helvetica,sans-serif; font-size:small">--&nbsp;</span></p>

<div dir="ltr" style="color: rgb(34, 34, 34); font-family: Arial, Helvetica, sans-serif; font-size: small;">
    <div dir="ltr">
        <div>------------------------------------</div>

        <div>
            <div dir="ltr">
                <div>
                    <div>
                        <div>
                            <div>
                                <span style="color:rgb(11, 83, 148)"><strong><?php echo $thank_you; ?></strong></span>

                                <div>
                                    &nbsp;
                                </div>

                                <div>
                                    <span style="color:rgb(11, 83, 148)"><strong><?php echo $dear_name; ?></strong></span>
                                </div>
                            </div>
                            =======================
                        </div>
                        <span style="color:rgb(11, 83, 148)">Website: <a
                                    href="<?php echo $website; ?>/"
                                    style="color: rgb(17, 85, 204);"
                                    target="_blank"><em><?php echo $website; ?></em></a></span>
                    </div>

                    <div>
                        <span style="color:rgb(11, 83, 148)">Tell: <strong><?php echo $tell; ?></strong></span>
                    </div>
                    <div>
                        <span style="color:rgb(11, 83, 148)">Zalo: <strong><?php echo $zalo; ?></strong></span>
                    </div>
                </div>
                <span style="color:rgb(11, 83, 148)">Skype: <strong><?php echo $skype; ?></strong></span><br/>
            </div>

            <div style="margin-top: 20px">
                <span style="color:rgb(11, 83, 148)"><strong><span style="color:rgb(0, 0, 0)"><?php echo $company_info_title; ?></span></strong></span>
            </div>

            <div>
                <?php echo $company_info_account; ?>
            </div>
        </div>

        <div>
            <div>
                <span style="color:rgb(0, 0, 0)"><strong><?php echo $personal_info_title; ?></strong></span>
            </div>

            <div>
                <?php echo $personal_info_account; ?>
            </div>
        </div>
    </div>
</div>