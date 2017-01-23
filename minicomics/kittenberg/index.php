<?php
$title = 'the seafaring adventures of captain kittenberg';
$img = '/minicomics/kittenberg/thumbs/kittenberg.jpg';
$desc = 'an abandoned graphic novel about feline adventure on the high seas.';

$book = 'kittenberg';
$first = 1;
$last = 19;

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