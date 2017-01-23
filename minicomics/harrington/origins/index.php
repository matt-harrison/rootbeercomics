<?php
$title = 'harrington origins';
$img = '/minicomics/potential/thumbs/harrington.jpg';
$desc = 'a brief bit of background on the norfolk hub of our friend group.';

$book = 'harrington';
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