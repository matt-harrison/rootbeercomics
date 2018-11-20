<div class="mAuto mb5 p20 bdrBox bgWhite">
	<p class="mAuto mb5 w800 txtR fs12">
		<a href="/deadhays/index.php?id=<?= $row['id']; ?>&records=1" class="txtGray">permalink</a>
	</p>
	<?php $canToggle = (!empty($row['original']) && !empty($row['final'])); ?>
	<?php if (!empty($row['original'])) { ?>
		<img data-id="<?= $row['id']; ?>" src="<?= $row['original']; ?>" alt="<?= $row['title']; ?>" class="mAuto dotted original<?= ($canToggle) ? ' toggle csrPointer hide' : ''; ?>"/>
	<?php } ?>
	<?php if (!empty($row['final'])) { ?>
		<img data-id="<?= $row['id']; ?>" src="<?= $row['final']; ?>" alt="<?= $row['title']; ?>" class="mAuto dotted final<?= ($canToggle) ? ' toggle csrPointer' : ''; ?>"/>
	<?php } ?>
</div>
<?php if ($_COOKIE['username'] == 'matt!' & $records == 1) { ?>
	<div class="mAuto mb5 p20 w1000 bdrBox bgGray private">
		<div class="flex">
			<div class="mr10">
				<?php if ($row['thumb'] != '') { ?>
					<img src="<?= $row['thumb']; ?>" class="unitR mb5 dotted"/>
				<?php } else { ?>
					<div class="unitR dotted w100">no thumbnail</div>
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
					<label class="mr10 size1of5 txtR label">thumb:</label>
					<input type="text" name="thumb" value="<?= $row['thumb']; ?>" class="size4of5"/>
				</div>
				<div class="flex bsBorder mb5">
					<label class="mr10 size1of5 txtR label">caption:</label>
					<textarea name="caption" rows="5" class="size4of5"><?= $row['caption']; ?></textarea>
				</div>
				<div class="flex bsBorder mb5">
					<label class="mr10 size1of5 txtR label">original:</label>
					<textarea name="original" rows="2" class="size4of5"><?= $row['original']; ?></textarea>
				</div>
				<div class="flex bsBorder mb5">
					<label class="mr10 size1of5 txtR label">final:</label>
					<textarea name="final" rows="3" class="size4of5"><?= $row['final']; ?></textarea>
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
