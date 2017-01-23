<?php
$title = 'yearbook';
$img = '/minicomics/yearbook/img/yearbook1.jpg';
$desc = 'no plan, just one more panel for each day of 2014.';

$book = 'yearbook';
$first = 1;
$last = 22;

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