<?php
$title = 'the happy detective #1';
$img = '/projects/happy/1/img/happy0.jpg';
$desc = 'a loving homage to the dick tracy-style cop strips of decades past. with a nasty twist.';

$book = 'happy';
$first = 0;
$last = 10;

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