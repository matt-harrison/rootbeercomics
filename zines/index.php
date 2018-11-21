<?php
$title = 'zines';
$desc  = 'zines by matt harrison.';
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div>
	<img src="/images/nav/scribble/zines.png" class="mb10"/>
	<div class="flex wrap mb50">
	    <?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/zines.php'); ?>
	</div>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
