<?php
$today = date('Y-m-d H:i:s');
$count = 0;

$con = mysql_connect('localhost', 'kittenb1_matt', 'uncannyx0545');
mysql_select_db('kittenb1_main', $con);
$comics = mysql_query(
	"SELECT uniqueID, title, 
			DATEDIFF('$today', date) AS diff 
	FROM comics 
	WHERE DATEDIFF('$today', date) >= 0 
	OR date = 0 
	ORDER BY uniqueID ASC", $con);
$count = mysql_num_rows($comics);

if($_GET['id'] != NULL){
	$page = $_GET['id'];
}else{
	$page = $count;
}

if($_GET['records'] != NULL){
	$records = $_GET['records'];
}else{
	$records = 10;
}
$lastPage = $page - $records + 1;
$rowCount = $count;

$query = mysql_query("SELECT * FROM comics WHERE uniqueID='$page' LIMIT 1", $con);
while($record = mysql_fetch_array($query)){
	$title = $record['title'];
	$caption = $record['caption'];
	if($record['colorLink']){
		$img = $record['colorLink'];
	} else if($record['color']){
		$img = $record['color'];
	} else if($record['bwLink']){
		$img = $record['bwLink'];
	} else if($record['bw']){
		$img = $record['bw'];
	}
}
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div id="comics" class="line mAuto w1000">
	<?php
	$comics = mysql_query("SELECT *, DATEDIFF('$today', date) AS diff, UNIX_TIMESTAMP(date) AS utime FROM comics WHERE uniqueID BETWEEN $lastPage AND $page ORDER BY uniqueID DESC", $con);
	while ($comic = mysql_fetch_array($comics)) { ?>
		<?php if ($comic['diff'] >= 0) { ?>
			<?php $img = ($comic['color'] != '') ? $comic['color'] : $comic['bw']; ?>
			<img src="<?= $img; ?>" class="mAuto mb20"/>
		<?php } ?>
	<?php } ?>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>