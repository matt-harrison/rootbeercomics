<?php
$table   = 'burgg';
$page    = (isset($_GET['id'])) ? $_GET['id'] : null;
$records = (isset($_GET['records'])) ? $_GET['records'] : 1;
include($_SERVER['DOCUMENT_ROOT'] . '/includes/sql.php');

$title = 'movie drawings';
$desc  = 'archive of movie scene illustrations from the defunct website, "theburgg.com," by matt harrison and friends.';
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="mAuto w1000">
	<?php
	include($_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php');
	foreach ($rows as $row) {
		include($_SERVER['DOCUMENT_ROOT'] . '/projects/burgg/scene.php');
	}
	include($_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php');
	?>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
