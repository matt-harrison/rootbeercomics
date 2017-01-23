<?php
$title = 'amazing fantasy #15 straight-to-ink cover song';
$img   = '/minicomics/amazing/img/amazing0.jpg';
$desc  = 'a shot-for-shot remake of steve ditko\'s spider-man feature from amazing fantasy #15.';
$purchaseUrl = 'http://rootbeercomics.storenvy.com/products/18887458-amazing-fantasy-15-straight-to-ink-cover-song';

$book  = 'amazing';
$first =  0;
$last  = 11;

$page = $_GET['page'];

if ($page == 'full') {
    $start = $first;
    $end = $last;
} else if ($page != '') {
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
