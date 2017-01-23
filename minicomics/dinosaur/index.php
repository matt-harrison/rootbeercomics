<?php
$title = 'dinosaur island';
$img = '/minicomics/demons/img/dinosaur.jpg';
$desc = 'a jurassic park parody.';

$book = 'dinosaur';
$first = 1;
$last = 2;

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
