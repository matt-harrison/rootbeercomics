<?php
$prev = $page - $records;
$next = $page + $records;

$lastRow = (isset($archive)) ? count($archive) : $lastRow;
?>
<div class="mb10 flex spaceBetween wrap">
	<a href="index.php?id=1&records=<?= $records; ?>" class="<?= ($prev >= 1) ? '' : ' invisible'; ?>">
		<img src="/images/nav/buttons/oldest.png" alt="oldest" class="mAuto"/>
	</a>
	<a href="index.php?id=<?= $prev; ?>&records=<?= $records; ?>" class="<?= ($prev >= 1) ? '' : ' invisible'; ?>">
		<img src="/images/nav/buttons/older.png" alt="older" class="mAuto"/>
	</a>
	<a href="archive.php" class="">
		<img src="/images/nav/buttons/archive.png" alt="all" class="mAuto"/>
	</a>
	<a href="index.php?id=<?= $next; ?>&records=<?= $records; ?>" class="<?= ($next <= $lastRow) ? '' : ' invisible'; ?>">
		<img src="/images/nav/buttons/newer.png" alt="newer" class="mAuto"/>
	</a>
	<a href="index.php?id=<?= $lastRow; ?>&records=<?= $records; ?>" class="<?= ($next <= $lastRow) ? '' : ' invisible'; ?>">
		<img src="/images/nav/buttons/newest.png" alt="newest" class="mAuto"/>
	</a>
</div>
