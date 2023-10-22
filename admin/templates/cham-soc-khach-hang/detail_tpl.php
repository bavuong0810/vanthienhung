<?php @include "sources/editor.php"?>
<ol class="breadcrumb">
  <li><a href="index.php"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
  <li class="active"><a href="index.php?p=cham-soc-khach-hang&a=man">Chăm sóc khách hàng</a></li>
  <li class="active"><a href="#">Nội dung liên hệ</a></li>
</ol>
<div class="col-xs-12">
<div class="">
<table class="table table-bordered table-hover them_dt" style="border:none">
	<tbody>
		<tr>
			<td class="td_left">
				Người nhận:
			</td>
			<td class="td_right">
				<div  style="line-height:1.8;border:1px solid #ccc;padding:5px; border-radius:4px">
                    <?php
                    $receiverNames = [];
                    foreach ($receivers as $receiver) {
                        $receiverNames[] = '<span class="label label-primary">' . ($receiver['name_vi'] ?: $receiver['email']) . '</span>';
                    }
                    echo implode(', ', $receiverNames);
                    ?>
                </div>
			</td>
		</tr>
		<tr>
			<td class="td_left">
				Ngày gửi:
			</td>
			<td class="td_right">
				<div style="line-height:1.8;border:1px solid #ccc;padding:5px; border-radius:4px"><?=@$message['created_at']?></div>
			</td>
		</tr>
		<tr>
			<td class="td_left">
				Tiêu đề:
			</td>
			<td class="td_right">
				<div  style="line-height:1.8;border:1px solid #ccc;padding:5px; border-radius:4px"><?=@$message['title']?></div>
			</td>
		</tr>
		<tr>
			<td class="td_left">
				Nội dung:
			</td>
			<td class="td_right">
				<div  style="line-height:1.8;border:1px solid #ccc;padding:5px; border-radius:4px">
                    <?php echo @$message['message']; ?>
				</div>
			</td>
		</tr>
        <tr>
			<td class="td_left">
				Đính kèm:
			</td>
			<td class="td_right">
				<div style="line-height:1.8;border:1px solid #ccc;padding:5px; border-radius:4px">
                    <?php
                    if (!empty($attachments)) {
                        foreach ($attachments as $attachment) {
                            ?>
                            <p>
                                <a href="<?php echo FILEURL . 'img_data/upload-lien-he/' . $attachment['path'] ?>" target="_blank"><?php echo $attachment['name']; ?></a>
                                |
                                <?php echo floor($attachment['size'] / 1024); ?> KB
                            </p>
                            <?php
                        }
                    }
                    ?>
				</div>
			</td>
		</tr>
	</tbody>
</table>
</div>
<div class="ar_admin">
	<table class="table table-bordered table-hover them_dt" style="border:none">
		<tr>
			<td class="td_left" style="text-align:right">
			</td>
			<td class="td_right">
				<input type="button" value="Quay lại" onclick="javascript:window.location='index.php?p=cham-soc-khach-hang&a=man'" class="btn btn-primary" />
			</td>
		</tr>
	</table>
</div>
</div>
</div>