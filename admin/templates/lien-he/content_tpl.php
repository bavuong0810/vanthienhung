<div>
	<strong>Lời nhắn:</strong>
	<?php echo $contentData['message']; ?>
</div>
<div>
	<strong>Đính kèm:</strong>
	<?php foreach ($contentData['attachments'] as $attachment): ?>
		<?php if ($attachment['type'] === 'image'): ?>
			<img src="<?php echo $attachment['url']; ?>" style="max-height: 100px">
		<?php else: ?>
			<a href="<?php echo $attachment['url'] ?>" target="_blank">
				<p><?php echo $attachment['name'] ?></p>
			</a>
		<?php endif ?>
	<?php endforeach ?>
</div>
<div>
	<strong>Thông tin thêm:</strong>
	<ul>
		<?php foreach ($contentData['additions'] as $addition): ?>
			<?php if (!empty($addition)): ?>
				<li><?php echo stripslashes($addition) ?></li>
			<?php endif ?>
		<?php endforeach ?>
	</ul>
</div>
<div>
	<strong>Sản phẩm</strong>
	<table class="table table-bordered table-hover text-center">
		<thead>
			<tr>
				<th>STT</th>
				<th>Mã</th>
				<th>Tên SP</th>
				<th>Số lượng</th>
				<th>Giá</th>
				<th>Khuyến mãi</th>
				<th>Ảnh</th>
				<th>Hành động</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($products as $i => $product): ?>
			<tr>
				<td>
					<?php echo $i + 1 ?>
				</td>
				<td>
					<?php echo $product['code'] ?>
				</td>
				<td class="text-left">
					<?php echo $product['name_vi'] ?>
				</td>
				<td>
					<?php echo $contentData['products'][$product['id']]; ?>
				</td>
				<td>
					<?php echo $d->vnd($product['price']); ?>
				</td>
				<td>
					<?php echo $d->vnd($product['promotion_price']); ?>
				</td>
				<td>
					<?php if (!empty($product['image_path'])): ?>
						<img width="70" src="<?php echo URLPATH ?>images/70/50/<?php echo $product['image_path'] ?>?zc=2">
					<?php endif ?>
				</td>
				<td>
					<a href="/<?php echo $product['alias_vi']; ?>.html" class="text-success" target="_blank"><i class="glyphicon glyphicon-eye-open"></i></a>
					&nbsp;&nbsp;&nbsp;
					<a href="index.php?p=san-pham&a=edit&id=<?=$product['id']?>&page=<?=@$_GET['page']?>" class="text-danger" title="Sửa"><i class="glyphicon glyphicon-edit"></i></a>
				</td>
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>
</div>
