<?php
$title = 'the happy detective #4';
$img = '/minicomics/happy/5/img/happy0.jpg';
$desc = 'detective samantha encounters a street vigilante.';

$book = 'happy';
$first = 0;
$last = 8;

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