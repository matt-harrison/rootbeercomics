<?php
$prev = $page - $records;
$next = $page + $records;

$lastRow = (isset($archive)) ? count($archive) : $lastRow;
?>
<div class="mb5 flex spaceBetween wrap bgWhite">
	<a href="index.php?id=1&records=<?= $records; ?>" class="p10 size1of5 bdrBox<?= ($prev >= 1) ? '' : ' invisible'; ?>">
		<img src="/images/nav/scribble/oldest.png" alt="oldest" class="mAuto"/>
	</a>
	<a href="index.php?id=<?= $prev; ?>&records=<?= $records; ?>" class="p10 size1of5 bdrBox<?= ($prev >= 1) ? '' : ' invisible'; ?>">
		<img src="/images/nav/scribble/older.png" alt="older" class="mAuto"/>
	</a>
	<a href="archive.php" class="p10 size1of5 bdrBox">
		<img src="/images/nav/scribble/all.png" alt="all" class="mAuto"/>
	</a>
	<a href="index.php?id=<?= $next; ?>&records=<?= $records; ?>" class="p10 size1of5 bdrBox<?= ($next <= $lastRow) ? '' : ' invisible'; ?>">
		<img src="/images/nav/scribble/newer.png" alt="newer" class="mAuto"/>
	</a>
	<a href="index.php?id=<?= $lastRow; ?>&records=<?= $records; ?>" class="p10 size1of5 bdrBox<?= ($next <= $lastRow) ? '' : ' invisible'; ?>">
		<img src="/images/nav/scribble/newest.png" alt="newest" class="mAuto"/>
	</a>
</div>
