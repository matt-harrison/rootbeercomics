<?php
$images = array();

if (!empty($row['final'])) {
	$images[] = $row['final'];
}

if (!empty($row['original'])) {
	$images[] = $row['original'];
}

$hasMultiple = (count($images) > 1);
?>
<div class="mAuto <?= ($records == 1) ? 'mb10' : 'mb100'; ?>">
	<?php foreach ($images as $key => $image) { ?>
		<img
		src="<?= $image; ?>"
		data-id="<?= $row['id']; ?>"
		data-version="<?= $key; ?>"
		alt="<?= $row['title']; ?>"
		class="mAuto<?= ($hasMultiple) ? ' multiple csrPointer' : ''; ?><?= ($key > 0) ? ' hide' : ''; ?>"/>
	<?php } ?>
</div>
<?php if ($user->isAdmin & $records == 1) { ?>
	<div class="bsBorder mAuto mb5 p20 bgGray private">
		<div class="flex">
			<div class="mr10">
				<?php if ($row['thumb'] != '') { ?>
					<img src="<?= $row['thumb']; ?>" class="unitR mb5"/>
				<?php } else { ?>
					<div class="unitR w100">no thumbnail</div>
				<?php } ?>
			</div>
			<form enctype="multipart/form-data" action="/scripts/update.php" method="post" target="get.html" class="wFull">
				<input type="hidden" name="table" value="<?= $table; ?>"/>
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
					<label class="mr10 size1of5 txtR label">original:</label>
					<input type="text" name="original" value="<?= $row['original']; ?>" class="size4of5"/>
				</div>
				<div class="flex bsBorder mb5">
					<label class="mr10 size1of5 txtR label">final:</label>
					<input type="text" name="final" value="<?= $row['final']; ?>" class="size4of5"/>
				</div>
				<div class="flex bsBorder mb5">
					<label class="mr10 size1of5 txtR label">thumb:</label>
					<input type="text" name="thumb" value="<?= $row['thumb']; ?>" class="size4of5"/>
				</div>
				<div class="flex bsBorder mb5">
					<label class="mr10 size1of5 txtR label">caption:</label>
					<textarea name="caption" rows="5" class="size4of5"><?= $row['caption']; ?></textarea>
				</div>
				<div class="flex bsBorder mb5">
					<label class="mr10 size1of5 txtR label">author:</label>
					<textarea name="author" rows="3" class="size4of5"><?= $row['author']; ?></textarea>
				</div>
				<div class="flex bsBorder mb5">
					<label class="mr10 size1of5 txtR label">tags:</label>
					<textarea name="tags" rows="3" class="size4of5"><?= $row['tags']; ?></textarea>
				</div>
				<div class="flex flexEnd">
					<input type="submit" value="update"/>
				</div>
			</form>
		</div>
	</div>
<?php } ?>
<?php if ($hasMultiple) { ?>
	<script type="text/javascript" src="/assets/js/multiple.js"></script>
<?php } ?>
