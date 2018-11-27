<div class="mb5 p20 bgWhite">
	<div class="mAuto w800">
		<h2 class="mb10 fs16">
			<a href="/projects/burgg/index.php?id=<?= $row['uniqueID']; ?>&records=1"><?= $row['title']; ?></a>
			<span class="txtGray">by <?= $row['author']; ?></span>
		</h2>
		<div class="scene">
			<img src="<?= $row['img']; ?>" id="scene<?= $row['uniqueID']; ?>" alt="<?= $row['title']; ?>" class="mAuto mb5 csrPointer answerLink"/>
		</div>
	</div>
</div>
