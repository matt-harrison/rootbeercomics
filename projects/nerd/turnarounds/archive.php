<?php
$title = 'the anarchynerd pixel art archive';
$desc = 'an archive of the defunct website anarchynerd, by matt harrison.';

$con = mysql_connect('localhost', 'kittenb1_matt', 'uncannyx0545');
mysql_select_db('kittenb1_nerd', $con);
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div id="content">
	<div id="archive" class="line mAuto w1000">
		<div class="unit size1of3 bdrBox">
			<div class="mr1 mb1 p10 bgWhite">
				<p class="bold">marvel</p>
				<ol>
					<?php $animations = mysql_query("SELECT * FROM turnarounds WHERE type='marvel' ORDER BY uniqueID ASC", $con); ?>
					<?php while($animation = mysql_fetch_array($animations)){ ?>
						<li class="mb5"><a href="index.php?id=<?= $animation['uniqueID']; ?>" data-thumb="<?= $animation['gif']; ?>" class="link"><?= $animation['title']; ?></a></li>
					<?php } ?>
				</ol>
			</div>
			<div class="mr1 mb1 p10 bgWhite">
				<p class="bold">star wars</p>
				<ol>
					<?php $animations = mysql_query("SELECT * FROM turnarounds WHERE type='starwars' ORDER BY uniqueID ASC", $con); ?>
					<?php while($animation = mysql_fetch_array($animations)){ ?>
						<li class="mb5"><a href="index.php?id=<?= $animation['uniqueID']; ?>" data-thumb="<?= $animation['gif']; ?>" class="link"><?= $animation['title']; ?></a></li>
					<?php } ?>
				</ol>
			 </div>
			<div class="mr1 mb1 p10 bgWhite">
				<p class="bold">mortal kombat</p>
				<ol>
					<?php $animations = mysql_query("SELECT * FROM turnarounds WHERE type='mk' ORDER BY uniqueID ASC", $con); ?>
					<?php while($animation = mysql_fetch_array($animations)){ ?>
						<li class="mb5"><a href="index.php?id=<?= $animation['uniqueID']; ?>" data-thumb="<?= $animation['gif']; ?>" class="link"><?= $animation['title']; ?></a></li>
					<?php } ?>
				</ol>
			 </div>
		</div>
		<div class="unit size1of3 bdrBox">
			<div class="mr1 mb1 p10 bgWhite">
				<p class="bold">matt</p>
				<ol>
					<?php $animations = mysql_query("SELECT * FROM turnarounds WHERE type='matt' ORDER BY uniqueID ASC", $con); ?>
					<?php while($animation = mysql_fetch_array($animations)){ ?>
						<li class="mb5"><a href="index.php?id=<?= $animation['uniqueID']; ?>" data-thumb="<?= $animation['gif']; ?>" class="link"><?= $animation['title']; ?></a></li>
					<?php } ?>
				</ol>
			 </div>
			<div class="mr1 mb1 p10 bgWhite">
				<p class="bold">anarchynerd</p>
				<ol>
					<?php $animations = mysql_query("SELECT * FROM turnarounds WHERE type='nerd' ORDER BY uniqueID ASC", $con); ?>
					<?php while($animation = mysql_fetch_array($animations)){ ?>
						<li class="mb5"><a href="index.php?id=<?= $animation['uniqueID']; ?>" data-thumb="<?= $animation['gif']; ?>" class="link"><?= $animation['title']; ?></a></li>
					<?php } ?>
				</ol>
			 </div>
			<div class="mr1 mb1 p10 bgWhite">
				<p class="bold">other</p>
				<ol>
					<?php $animations = mysql_query("SELECT * FROM turnarounds WHERE type='other' ORDER BY uniqueID ASC", $con); ?>
					<?php while($animation = mysql_fetch_array($animations)){ ?>
						<li class="mb5"><a href="index.php?id=<?= $animation['uniqueID']; ?>" data-thumb="<?= $animation['gif']; ?>" class="link"><?= $animation['title']; ?></a></li>
					<?php } ?>
				</ol>
			</div>
		</div>
		<div class="unit size1of3 bdrBox">
			<div class="mb1 p10 bgWhite">
				<p class="bold">friends</p>
				<ol>
					<?php $animations = mysql_query("SELECT * FROM turnarounds ORDER BY uniqueID ASC", $con); ?>
					<?php while($animation = mysql_fetch_array($animations)){ ?>
						<?php if($animation['type'] == 'friends'){ ?>
							<li class="mb5"><a href="index.php?id=<?= $animation['uniqueID']; ?>" data-thumb="<?= $animation['gif']; ?>" class="link"><?= $animation['title']; ?></a></li>
						<?php } ?>
					<?php } ?>
				</ol>
			 </div>
		</div>
	</div>
</div>
<div id="tooltip" class="absolute hide">
	<span></span>
	<img src="" alt=""/>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
