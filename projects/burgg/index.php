<?php
$table = 'burgg';

include($_SERVER['DOCUMENT_ROOT'] . '/includes/sql.php');

$title = 'movie drawings';
$desc  = 'archive of movie scene illustrations from the defunct website, "theburgg.com," by matt harrison and friends.';
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="mAuto w1000">
	<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php'); ?>
	<?php foreach ($rows as $row) { ?>
		<div class="mb5 p20 bgWhite">
			<div class="mAuto w800">
				<h2 class="mb10 fs16">
					<a href="/projects/burgg/index.php?id=<?= $row['uniqueID']; ?>"><?= $row['title']; ?></a>
					<span class="txtGray">by <?= $row['author']; ?></span>
				</h2>
				<div class="scene">
					<img src="<?= $row['img']; ?>" id="scene<?= $row['uniqueID']; ?>" alt="<?= $row['title']; ?>" class="mAuto mb5 csrPointer answerLink"/>
				</div>
			</div>
		</div>
	<?php } ?>
	<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php'); ?>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
