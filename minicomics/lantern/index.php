<?php
$title = 'showcase #22 straight-to-ink cover song.';
$img   = '/minicomics/thumbs/lantern.jpg';
$desc  = 'a panel-by-panel remake of the first appearance of hal jordan in showcase #22.';
$purchaseUrl = 'http://rootbeercomics.storenvy.com/products/18887503-green-lantern-straight-to-ink-cover-song';

$book  = 'lantern';
$first = 0;
$last  = 6;

$page = $_GET['page'];

if ($page == 'full') {
	$start = $first;
	$end   = $last;
} else if ($page != '') {
	$start = $page;
	$end   = $page;
} else {
	$start = $first;
	$end   = $first;
}
$prev = $start - 1;
$next = $start + 1;
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/mini.php'); ?>
