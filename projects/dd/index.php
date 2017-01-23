<?php
$title = 'D&amp;D jam comics';
$desc = 'a game of dungeons &amp; dragons adapted into comic form by matt harrison and friends.';

$records = 6;
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<?php for($i=1; $i<=$records; $i++){ ?>
	<img src="/projects/dd/display/color/dd<?= $i; ?>.jpg" class="mAuto mb20"/>
<?php } ?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>