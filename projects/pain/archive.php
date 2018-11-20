<?php
$table = 'pain';
$sort  = 'ASC';
include($_SERVER['DOCUMENT_ROOT'] . '/includes/sql.php');

$title = 'the website of pain';
$desc  = 'an archive of the defunct website of pain, preserved by matt harrison.';
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="flex wrap">
	<?php foreach ($archive as $record) { ?>
		<a href="index.php?id=<?= $record['id']; ?>&records=1" class="mr1 mb1">
			<img src="<?= $record['thumb']; ?>" alt="<?= $title; ?>" class="thumb"/>
		</a>
	<?php } ?>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
