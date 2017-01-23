<?php
$title = 'comics archive';
$desc = 'view all comic posts.';
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<?php
$con = mysql_connect('localhost','kittenb1_matt','uncannyx0545');
mysql_select_db('kittenb1_nerd', $con);
$result = mysql_query("SELECT * FROM turnarounds ORDER BY type, title ASC", $con);
$num = 1;
?>
<?php while($row = mysql_fetch_array($result)){ ?>
	<?php 
	$uniqueID = $row['uniqueID'];
	$title = $row['title'];
	$caption = $row['caption'];
	$tags = $row['tags'];
	$url = $row['url'];
	$gif = $row['gif'];
	$type = $row['type'];
	?>
	<p class="mb5"><?= $uniqueID; ?>. <?= $title; ?> >>> <?= $url; ?></p>
	<?php //mysql_query("UPDATE turnarounds SET XYZ='$XYZ' WHERE uniqueID='$uniqueID'"); ?>
	<?php $num++; ?>
<?php } ?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>