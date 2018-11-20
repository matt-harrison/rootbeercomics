<?php
$title = 'minicomics';
$desc  = 'minicomics by matt harrison.';
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="flex wrap mb50">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/cover-songs.php'); ?>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/old-cover-songs.php'); ?>
</div>
<div class="flex wrap mb50">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/autobio.php'); ?>
</div>
<div class="flex wrap mb50">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/fiction.php'); ?>
</div>
<div class="flex wrap mb50">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/zines.php'); ?>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/old-zines.php'); ?>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
