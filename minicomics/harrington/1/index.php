<?php
$title = 'harrington comics #1';
$img = '/minicomics/thumbs/harrington01.jpg';
$desc = 'a self-published mini-comics anthology by greg steele, matt harrison, and todd webb.';

$book = 'harrington';
$first = 1;
$last = 54;

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