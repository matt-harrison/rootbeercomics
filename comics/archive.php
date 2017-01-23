<?php
$title = 'comics archive';
$desc = 'view all comic posts.';

$today = date('Y-m-d H:i:s');
$comicCount = 0;

$con = mysql_connect('localhost', 'kittenb1_matt', 'uncannyx0545');
mysql_select_db('kittenb1_main', $con);
$comics = mysql_query("SELECT *, DATEDIFF('$today', date) AS diff, UNIX_TIMESTAMP(date) AS utime FROM comics ORDER BY date ASC", $con);
while ($comic = mysql_fetch_array($comics)) {
	if ($comic['diff'] >= 0) {
		$date = date('m.d.y', $comic['utime']);
		$comicCount++;
	}
}
$colHeight = $comicCount/3;
if ($colHeight != floor($colHeight)) {
	$colHeight = floor($colHeight) + 1;
}
$orderBy = ($_GET['type'] == 'list') ? 'ASC' : 'DESC';
$comics = mysql_query("SELECT *, DATEDIFF('$today', date) AS diff FROM comics ORDER BY uniqueID $orderBy", $con);
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="flex center wrap">
	<?php while ($comic = mysql_fetch_array($comics)) { ?>
		<?php if ($comic['diff'] >= 0) { ?>
			<?php
			$title = $comic['title'];
			$title = str_replace("'", '\&apos;', $title);
			$title = str_replace('"', "\&quot;", $title);
			?>
			<a href="index.php?id=<?= $comic['uniqueID']; ?>&records=1" class="mr1 mb1">
				<img src="<?= $comic['thumb']; ?>" data-title="<?= $title; ?>" alt="<?= $title; ?>" class="w100 h100 thumb"/>
			</a>
		<?php } ?>
	<?php } ?>
</div>
<div id="tooltip" class="absolute p5 bgWhite hide">
	<span></span>
	<img src="" alt=""/>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
