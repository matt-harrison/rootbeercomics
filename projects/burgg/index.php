<?php
$table = 'burgg';
$page = (isset($_GET['id'])) ? $_GET['id'] : null;
$records = (isset($_GET['records'])) ? $_GET['records'] : 1;
include($_SERVER['DOCUMENT_ROOT'] . '/includes/sql.php');

$title = 'movie drawings';
$desc = 'archive of movie scene illustrations from the defunct website, "theburgg.com," by matt harrison and friends.';
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="mAuto w900 bdrBox">
	<?php
	include($_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php');
	foreach ($data as $scene) {
		include($_SERVER['DOCUMENT_ROOT'] . '/includes/scene.php');
	}
	include($_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php');
	?>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
<script type="text/javascript" src="/includes/js/burgg.js"></script>
