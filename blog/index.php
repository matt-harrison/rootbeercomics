<?php
$table = 'blog';
$sort = 'DESC';
$page = (isset($_GET['id'])) ? $_GET['id'] : null;
$records = (isset($_GET['records'])) ? $_GET['records'] : 10;
include($_SERVER['DOCUMENT_ROOT'] . '/includes/sql.php');

if ($records == 1) {
	$title   = $data[0]['title'];
	$caption = $data[0]['caption'];
	$body    = $data[0]['body'];
	$img     = $data[0]['thumb'];
}
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div id="blog" class="line mAuto w1000">
	<?php
	include($_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php');

	foreach ($data as $post) {
		include($_SERVER['DOCUMENT_ROOT'] . '/includes/post.php');
	}

	include($_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php');
	?>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
