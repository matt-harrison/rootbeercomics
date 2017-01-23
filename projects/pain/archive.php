<?php
$table = 'pain';
include($_SERVER['DOCUMENT_ROOT'] . '/includes/sql.php');

$title = 'the website of pain';
$desc = 'an archive of the defunct website of pain, preserved by matt harrison.';

$columnLength = count($archive) / 3;
if ($columnLength != floor($columnLength)) {
	$columnLength = floor($columnLength) + 1;
}

$type = (isset($_GET['type'])) ? $_GET['type'] : 'thumbs';
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="mAuto w1000">
	<div class="line mAuto mb5 p10 bdrLtBrown bgWhite">
		<p class="line mb0">
			<span class="unit mr10 mobile">the website of pain archive:</span>
			<?php if ($type == 'list') { ?>
				<span class="unit mr10 underline mobile">list</span>
				<a href="http://www.rootbeercomics.com/projects/pain/archive.php?type=thumbs" class="unit">thumbnails</a>
			<?php } else { ?>
				<a href="http://www.rootbeercomics.com/projects/pain/archive.php?type=list" class="unit mr10">list</a>
				<span class="unit underline mobile">thumbnails</span>
			<?php } ?>
		</p>
	</div>
	<?php if ($type == 'list') { ?>
		<div class="line mb5">
			<?php $num = 1; ?>
			<div class="unit mr5 bdrBox p10 w330 bdrLtBrown bgWhite">
				<?php foreach ($archive as $pain) { ?>
					<?php
					$title = $pain['title'];
					if (strlen($title) > 50) {
						$title = substr($title, 0, 47) . '...';
					}
					?>
					<p class="mb5 nowrap">
						<span><?= $num; ?>. </span>
						<a href="index.php?id=<?= $pain['uniqueID']; ?>&amp;records=1" data-thumb="<?= $pain['thumb']; ?>" class="link"><?= $title; ?></a>
					</p>
					<?php if ($num == $columnLength) { ?>
						</div>
						<div class="unit mr5 bdrBox p10 w330 bdrLtBrown bgWhite">
					<?php }else if ($num == $columnLength*2) { ?>
						</div>
						<div class="unit bdrBox p10 w330 bdrLtBrown bgWhite">
					<?php } ?>
					<?php $num++; ?>
				<?php } ?>
				<?php if ($num <= $columnLength*3) { ?>
					<?php for ($num; $num<=$columnLength*3; $num++) { ?>
						<p class="mb5">&nbsp;</p>
					<?php } ?>
				<?php } ?>
			</div>
		</div>
	<?php } else { ?>
		<div class="line">
			<?php foreach ($archive as $pain) { ?>
				<?php
				$title = $pain['title'];
				$title = str_replace("'", '\&apos;', $title);
				$title = str_replace('"', "\&quot;", $title);
				?>
				<div class="unit mr5 mb5 h100">
					<a href="index.php?id=<?= $pain['uniqueID']; ?>&records=1">
						<img src="<?= $pain['thumb']; ?>" data-title="<?= $title; ?>" alt="<?= $title; ?>" class="thumb"/>
					</a>
				</div>
			<?php } ?>
		</div>
	<?php } ?>
</div>
<div id="tooltip" class="absolute p5 bdrLtBrown bgFoam hide">
	<span></span>
	<img src="" alt=""/>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
