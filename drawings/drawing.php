<?php
$images      = explode(',', $row['images']);
$hasMultiple = (count($images > 1));
?>
<div class="mAuto<?= ($records == 1) ? '' : ' mb100'; ?>">
	<?php foreach ($images as $key => $image) { ?>
		<img
		src="<?= $image; ?>"
		data-id="<?= $row['id']; ?>"
		data-version="<?= $key; ?>"
		class="mAuto mb10<?= ($hasMultiple) ? ' multiple csrPointer' : ''; ?><?= ($key > 0) ? ' hide' : ''; ?>"/>
	<?php } ?>
	<?php if ($records != 1) { ?>
		<a href="/drawings/index.php?id=<?= $row['id']; ?>&records=1">
			<img src="/images/nav/buttons/permalink.png" alt="permalink" class="opac50"/>
		</a>
	<?php } ?>
</div>
<?php if ($_COOKIE['username'] == 'matt!' & $records == 1) { ?>
	<div class="mAuto mb5 p20 w1000 bdrBox bgGray private">
		<div class="flex">
			<div class="mr10">
				<?php if ($row['thumb'] != '') { ?>
					<img src="<?= $row['thumb']; ?>" class="unitR mb5"/>
				<?php } else { ?>
					<div class="unitR w100">no thumbnail</div>
				<?php } ?>
			</div>
			<form enctype="multipart/form-data" action="/scripts/update.php" method="post" target="get.html" class="wFull">
				<input type="hidden" name="table" value="drawings"/>
				<input type="hidden" name="id" value="<?= $row['id']; ?>"/>
				<div class="flex bsBorder mb5">
					<label class="mr10 size1of5 txtR label">title:</label>
					<input type="text" name="title" value="<?= $row['title']; ?>" class="size4of5"/>
				</div>
				<div class="flex bsBorder mb5">
					<label class="mr10 size1of5 txtR label">date:</label>
					<input type="text" name="date" value="<?= $row['date']; ?>" class="size4of5"/>
				</div>
				<div class="flex bsBorder mb5">
					<label class="mr10 size1of5 txtR label">thumb:</label>
					<input type="text" name="thumb" value="<?= $row['thumb']; ?>" class="size4of5"/>
				</div>
				<div class="flex bsBorder mb5">
					<label class="mr10 size1of5 txtR label">tags:</label>
					<input type="text" name="tags" value="<?= $row['tags']; ?>" class="size4of5"/>
				</div>
				<div class="flex bsBorder mb5">
					<label class="mr10 size1of5 txtR label">images:</label>
					<textarea name="images" rows="2" class="size4of5"><?= $row['images']; ?></textarea>
				</div>
				<div class="flex bsBorder mb5">
					<label class="mr10 size1of5 txtR label">caption:</label>
					<textarea name="caption" rows="10" class="size4of5"><?= $caption; ?></textarea>
				</div>
				<div class="flex flexEnd">
					<input type="submit" value="update"/>
				</div>
			</form>
		</div>
	</div>
<?php } ?>
