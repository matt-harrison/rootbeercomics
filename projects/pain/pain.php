<div class="bsBorder mAuto mb5 p20 w1000 bgWhite">
	<h2 class="mb10 fs16">
		<a href="/projects/pain/index.php?id=<?= $row['uniqueID']; ?>&records=1"><?= $row['title']; ?></a>
		<span class="txtGray">by <?= $row['author']; ?></span>
	</h2>
	<img src="<?= $row['img']; ?>" alt="<?= $row['title']; ?>" class="mAuto"/>
	<?php if($row['caption'] != ''){ ?>
		<p class="mt10"><?= $row['caption']; ?></p>
	<?php } ?>
</div>
