<?php
$images = explode(',', $row['images']);

$caption = $row['body'];
preg_match_all('/\<[^>]+>/', $caption, $tags);

foreach ($tags as $tag) {
	$caption = str_replace($tag, '', $caption);
}

$caption = empty($row['caption']) ? $caption : $row['caption'];
?>
<div class="mAuto mb5 p20 bdrBox bgWhite post">
	<p class="mAuto mb5 w800 txtR fs12">
		<a href="/drawings/index.php?id=<?= $row['id']; ?>&records=1" class="txtGray">permalink</a>
	</p>
	<?php foreach ($images as $key => $image) { ?>
		<img src="<?= $image; ?>" alt="<?= $key; ?>" class="mAuto dotted<?= ($key < count($images) - 1) ? ' mb10' : ''; ?>"/>
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
