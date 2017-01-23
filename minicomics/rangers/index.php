<?php
$title = 'power rangers parody comics #1';
$img = '/projects/rangers/img/rangers0.jpg';
$desc = 'an unauthorized sendup of the classic kids tv show. likely violates copyright law, but made with love.';

$book = 'rangers';
$first = 0;
$last = 14;

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