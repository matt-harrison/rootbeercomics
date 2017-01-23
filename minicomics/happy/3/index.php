<?php
$title = 'the happy detective #3';
$img = '/projects/happy/thumbs/happy03.jpg';
$desc = 'detective samantha uncovers a technological conspiracy with ties to his past.';

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