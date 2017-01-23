<?php
$title = 'the anarchynerd pixel art archive';
$desc = 'an archive of the defunct website anarchynerd, by matt harrison.';

$con = mysql_connect('localhost', 'kittenb1_matt', 'uncannyx0545');
mysql_select_db('kittenb1_nerd', $con);
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div id="archive" class="line mAuto w1000">
	<div class="unit size1of3 bdrBox">
		<div class="mr1 mb1 p10 bgWhite">
			<p class="bold">mattman</p>
			<?php $num = 1; ?>
			<?php $animations = mysql_query("SELECT * FROM mattman WHERE type='mattman' ORDER BY uniqueID ASC", $con); ?>
			<?php while($animation = mysql_fetch_array($animations)){ ?>
				<p class="mb5">
					<span><?= $num; ?>. </span>
					<a href="index.php?id=<?= $animation['uniqueID']; ?>" data-thumb="<?= $animation['gif']; ?>" class="link"><?= $animation['title']; ?></a>
				</p>
				<?php $num++; ?>
			<?php } ?>
		</div>
	</div>
	<div class="unit size1of3 bdrBox">
		<div class="mr1 mb1 p10 bgWhite">
			<p class="bold">monsters</p>
			<?php $num = 1; ?>
			<?php $animations = mysql_query("SELECT * FROM mattman WHERE type='monsters' ORDER BY uniqueID ASC", $con); ?>
			<?php while($animation = mysql_fetch_array($animations)){ ?>
				<p class="mb5">
					<span><?= $num; ?>. </span>
					<a href="index.php?id=<?= $animation['uniqueID']; ?>" data-thumb="<?= $animation['gif']; ?>" class="link"><?= $animation['title']; ?></a>
				</p>
				<?php $num++; ?>
			<?php } ?>
		</div>
	</div>
	<div class="unit size1of3 bdrBox">
	</div>
</div>
<div id="tooltip" class="absolute hide">
	<span></span>
	<img src="" alt=""/>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>