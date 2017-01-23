<?php
$title = 'demons';
$img = '/minicomics/demons/img/demons0.jpg';
$desc = 'the story behind all the little disappointments that accumulate throughout the day.';

$book = 'demons';
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
