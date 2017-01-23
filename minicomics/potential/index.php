<?php
$title = 'potential';
$img = '/minicomics/potential/thumbs/potential.jpg';
$desc = 'a historical survey of my personal ambition.';

$book = 'potential';
$first = 1;
$last = 2;

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