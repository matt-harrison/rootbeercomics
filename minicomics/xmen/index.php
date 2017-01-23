<?php
$title = 'x-men #1 straight-to-ink cover song.';
$img = '/minicomics/xmen/img/xmen0.jpg';
$desc = 'a shot-for-shot remake of jack kirby\'s x-men #1.';
$purchaseUrl = 'http://www.storenvy.com/products/18103499-x-men-1-straight-to-ink-cover-song';

$book = 'xmen';
$first = 0;
$last = 23;

$page = $_GET['page'];

if($page == 'full'){
	$start = $first;
	$end = $last;
} else if($page != ''){
	$start = $page;
	$end = $page;
} else {
	$start = $first;
	$end = $first;
}
$prev = $start - 1;
$next = $start + 1;
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/mini.php'); ?>
