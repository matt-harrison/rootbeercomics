<?php
$title = 'king arthur comics';
$img = '/minicomics/king/img/king1.jpg';
$desc = 'an abandoned ongoing newspaper-style strip about the daily exploits of king arthur.';

$book = 'king';
$first = 1;
$last = 16;

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