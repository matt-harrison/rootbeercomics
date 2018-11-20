<?php
$index    = str_replace('.php', '', basename($_SERVER['PHP_SELF']));
$previous = $index - 1;
$next     = $index + 1;
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/projects/portfolio/includes/header.php'); ?>
<h2 class="flex spaceBetween">
    <span class="size2of3">Day <?= $index; ?>: <i><?= $title; ?></i> by <?= $author; ?> - <?= $yearPublished; ?></span>
    <span><?= $date; ?></span>
</h2>
<div id="content">
    <?php include('includes/nav.php'); ?>
    <div class="auto mb20 w700">