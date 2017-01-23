<?php
$title = 'lincoln vs. booth';
$img = '/projects/lincoln/img/lincoln0.jpg';
$desc = 'the true story of lincoln\'s murder and the hunt for booth, told in modern language. and with swear words.';

$book = 'lincoln';
$first = 0;
$last = 38;

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