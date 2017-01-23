<?php
$title = 'medic';
$img = '/minicomics/medic/img/medic1.jpg';
$desc = 'an anonymous hero finally makes a difference.';

$book = 'medic';
$first = 1;
$last = 4;

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
