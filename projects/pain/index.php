<?php
$table = 'pain';
$page = (isset($_GET['id'])) ? $_GET['id'] : null;
$records = (isset($_GET['records'])) ? $_GET['records'] : 1;
include($_SERVER['DOCUMENT_ROOT'] . '/includes/sql.php');

$title = 'the website of pain archive';
$desc = 'an archive of the defunct website of pain, preserved by matt harrison.';
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="mAuto w1000">
	<?php 
	include($_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php');
	foreach ($data as $pain) {
		include($_SERVER['DOCUMENT_ROOT'] . '/includes/pain.php');
	}
	include($_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php');
	?>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
