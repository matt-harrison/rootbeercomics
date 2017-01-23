<?php
$title = 'anarchynerd pixel art archive';
$desc = 'an archive of the defunct website anarchynerd, by matt harrison.';
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<?php
$con = mysql_connect('localhost','kittenb1_matt','uncannyx0545');
mysql_select_db('kittenb1_nerd', $con);
$result = mysql_query("SELECT * FROM mattman ORDER BY type, title ASC", $con);
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
	<?php if($row['type'] == 'monsters'){ ?>
		<p class="mb5"><?= $uniqueID; ?>. <?= $title; ?> >>> <?= $gif; ?></p>
		<?php //mysql_query("UPDATE mattman SET XYZ='$XYZ' WHERE uniqueID='$uniqueID'"); ?>
		<?php $num++; ?>
	<?php } ?>
<?php } ?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>