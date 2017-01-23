<?php
$prev = $page - $records;
$next = $page + $records;

$lastRow = (isset($archive)) ? count($archive) : $lastRow;
?>
<div class="line bdrBox mAuto mb5 wFull bgWhite txtC">
	<a href="index.php?id=1&amp;records=<?= $records; ?>" class="unit p10 size1of5 bdrBox<?= ($prev >= 1) ? '' : ' invisible'; ?>">
		<img src="/images/nav/scribble/oldest.png" alt="oldest" class="mAuto"/>
	</a>
	<a href="index.php?id=<?= $prev; ?>&amp;records=<?= $records; ?>" class="unit p10 size1of5 bdrBox<?= ($prev >= 1) ? '' : ' invisible'; ?>">
		<img src="/images/nav/scribble/older.png" alt="older" class="mAuto"/>
	</a>
	<a href="archive.php" class="unit p10 size1of5 bdrBox">
		<img src="/images/nav/scribble/all.png" alt="all" class="mAuto"/>
	</a>
	<a href="index.php?id=<?= $next; ?>&amp;records=<?= $records; ?>" class="unit p10 size1of5 bdrBox<?= ($next <= $lastRow) ? '' : ' invisible'; ?>">
		<img src="/images/nav/scribble/newer.png" alt="newer" class="mAuto"/>
	</a>
	<a href="index.php?id=<?= $lastRow; ?>&amp;records=<?= $records; ?>" class="unit p10 size1of5 bdrBox<?= ($next <= $lastRow) ? '' : ' invisible'; ?>">
		<img src="/images/nav/scribble/newest.png" alt="newest" class="mAuto"/>
	</a>
</div>
