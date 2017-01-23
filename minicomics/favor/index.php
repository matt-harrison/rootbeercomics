<?php
$title = 'favor';
$img = '/minicomics/favor/img/favor0.jpg';
$desc = 'a story about different types of people all pursuing the same goal.';

$book = 'favor';
$first = 0;
$last = 18;

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