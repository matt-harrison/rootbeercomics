<?php
$title = 'the happy detective #2';
$img = '/minicomics/happy/2/img/happy0.jpg';
$desc = 'in which our hero seeks closure... by revenge.';

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