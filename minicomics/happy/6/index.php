<?php
$title = 'the happy detective #6';
$img = '/minicomics/happy/thumbs/happy06.jpg';
$desc = 'detective samantha travels to a medieval castle.';

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