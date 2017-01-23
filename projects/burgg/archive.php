<?php
$table = 'burgg';
include($_SERVER['DOCUMENT_ROOT'] . '/includes/sql.php');

$title = 'the burgg';
$desc = 'an archive of movie scene drawings from the defunct website "the burgg," preserved by matt harrison.';

$columnLength = count($archive) / 3;
if ($columnLength != floor($columnLength)) {
	$columnLength = floor($columnLength) + 1;
}

$type = (isset($_GET['type'])) ? $_GET['type'] : 'thumbs';

$reveal = $_GET['reveal'] || 0;
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="mAuto w1000">
	<div class="line mAuto mb5 p10 bdrLtBrown bgWhite">
		<p class="line mb0">
			<span class="unit mr20 mobile">movie drawing archive:</span>
			<?php if ($type == 'list') { ?>
				<span class="unit mr20 underline mobile">list</span>
				<a href="http://www.rootbeercomics.com/projects/burgg/archive.php?type=thumbs<?= ($reveal) ? '&reveal=1' : ''; ?>" class="unit mr20">thumbnails</a>
			<?php } else { ?>
				<a href="http://www.rootbeercomics.com/projects/burgg/archive.php?type=list<?= ($reveal) ? '&reveal=1' : ''; ?>" class="unit mr20">list</a>
				<span class="unit mr20 underline mobile">thumbnails</span>
			<?php } ?>
			<a href="http://www.rootbeercomics.com/projects/burgg/archive.php?type=<?= $type; ?>&reveal=1" class="unit mr20<?= ($reveal) ? ' hide' : ''; ?>">show movie titles</a>
			<a href="http://www.rootbeercomics.com/projects/burgg/archive.php?type=<?= $type; ?>" class="unit mr20<?= ($reveal) ? '' : ' hide'; ?>">hide movie titles</a>
		</p>
	</div>
	<?php if ($type == 'list') { ?>
		<div class="line mb5">
			<?php $num = 1; ?>
			<div class="unit mr5 bdrBox p10 w330 bdrLtBrown bgWhite">
				<?php foreach ($archive as $scene) {?>
					<?php 
					if($reveal){
						$title = $scene['caption'];
					} else {
						$title = $scene['title'];
					}
					if(strlen($title) > 50){
						$title = substr($title, 0, 47) . '...';
					}
					?>
					<p class="mb5 nowrap">
						<span><?= $num; ?>. </span>
						<a href="index.php?id=<?= $scene['uniqueID']; ?>&amp;records=1" data-thumb="<?= $scene['thumb']; ?>" class="link"><?= $title; ?></a>
					</p>
					<?php if($num == $columnLength){ ?>
						</div>
						<div class="unit mr5 bdrBox p10 w330 bdrLtBrown bgWhite">
					<?php } else if ($num == $columnLength*2) { ?>
						</div>
						<div class="unit bdrBox p10 w330 bdrLtBrown bgWhite">
					<?php } ?>
					<?php $num++; ?>
				<?php } ?>
				<?php if($num <= $columnLength*3){ ?>
					<?php for ($num; $num<=$columnLength*3; $num++) { ?>
						<p class="mb5">&nbsp;</p>
					<?php } ?>
				<?php } ?>
			</div>
		</div>
	<?php } else { ?>
		<div class="line">
				<?php foreach ($archive as $scene) {?>
				<?php
				if ($reveal) {
					$title = $scene['caption'];
				} else {
					$title = $scene['title'];
				}
				$title = str_replace("'", '\&apos;', $title);
				$title = str_replace('"', "\&quot;", $title);
				?>
				<a href="index.php?id=<?= $scene['uniqueID']; ?>&records=1" class="unit mr5 mb5">
					<img src="<?= $scene['thumb']; ?>" data-title="<?= $title; ?>" alt="<?= $title; ?>" class="w100 thumb"/>
				</a>
			<?php } ?>
		</div>
	<?php } ?>
</div>
<div id="tooltip" class="absolute p5 bdrLtBrown bgFoam hide">
	<span></span>
	<img src="" alt=""/>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
