<?php
$title = 'comics archive';
$desc = 'view all comic posts.';

$today = date('Y-m-d H:i:s');
$comicCount = 0;

$con = mysql_connect('localhost', 'kittenb1_matt', 'uncannyx0545');
mysql_select_db('kittenb1_main', $con);
$comics = mysql_query("SELECT *, DATEDIFF('$today', date) AS diff, UNIX_TIMESTAMP(date) AS utime FROM comics ORDER BY date ASC", $con);
while($comic = mysql_fetch_array($comics)){
	if($comic['diff'] >= 0){
		$date = date('m.d.y', $comic['utime']);
		$comicCount++;
	}
}
$colHeight = $comicCount/3;
if($colHeight != floor($colHeight)){
	$colHeight = floor($colHeight) + 1;
}
$orderBy = ($_GET['type'] == 'list') ? 'ASC' : 'DESC';
$comics = mysql_query("SELECT *, DATEDIFF('$today', date) AS diff FROM comics ORDER BY uniqueID $orderBy", $con);
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="mAuto w1000">
	<div class="line mAuto mb1 p10 bgWhite">
		<p class="line mb0">
			<?php if($_GET['type'] == 'list'){ ?>
				<span class="unit mr10 underline">list</span>
				<a href="?type=thumbs" class="unit mr10">thumbnails</a>
			<?php } else { ?>
				<a href="?type=list" class="unit mr10">list</a>
				<span class="unit mr10 underline">thumbnails</span>
			<?php } ?>
			<span class="unitR txtGray">updated <?= $date; ?></span>
		</p>
	</div>
	<?php if($_GET['type'] == 'list'){ ?>
		<div class="line mb1 p20 bgWhite">
			<?php $num = 1; ?>
			<div class="unit pr10 size1of3 bdrBox">
				<?php while($comic = mysql_fetch_array($comics)){ ?>
					<?php if($comic['diff'] >= 0){ ?>
						<?php
						$title = $comic['title'];
						if(strlen($title) > 50){
							$title = substr($title, 0, 47) . '...';
						}
						?>
						<p class="mb5 nowrap">
							<span><?= $num; ?>. </span>
							<a href="index.php?id=<?= $comic['uniqueID']; ?>&amp;records=1" data-thumb="<?= $comic['thumb']; ?>" class="link"><?= $title; ?></a>
						</p>
						<?php if($num == $colHeight){ ?>
							</div>
							<div class="unit pr10 size1of3 bdrBox">
						<?php }else if($num == $colHeight*2){ ?>
							</div>
							<div class="unit pr10 size1of3 bdrBox">
						<?php } ?>
						<?php $num++; ?>
					<?php } ?>
				<?php } ?>
			</div>
		</div>
	<?php } else { ?>
		<div class="line">
			<?php while($comic = mysql_fetch_array($comics)){ ?>
				<?php if($comic['diff'] >= 0){ ?>
					<?php
					$title = $comic['title'];
					$title = str_replace("'", '\&apos;', $title);
					$title = str_replace('"', "\&quot;", $title);
					?>
					<a href="index.php?id=<?= $comic['uniqueID']; ?>&records=1" class="unit mr1 mb1">
						<img src="<?= $comic['thumb']; ?>" data-title="<?= $title; ?>" alt="<?= $title; ?>" class="w100 h100 thumb"/>
					</a>
				<?php } ?>
			<?php } ?>
		</div>
	<?php } ?>
</div>
<div id="tooltip" class="absolute p5 bgFoam hide">
	<span></span>
	<img src="" alt=""/>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
