<?php
$table = 'drawings';
$sort  = 'DESC';
include($_SERVER['DOCUMENT_ROOT'] . '/includes/sql.php');

$title = 'drawing archive';
$desc  = 'view all drawings';
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="flex wrap mb10">
	<?php foreach ($archive as $record) { ?>
		<?php
		$title = $record['title'];
		$title = str_replace("'", '\&apos;', $title);
		$title = str_replace('"', "\&quot;", $title);
		?>
		<a href="index.php?id=<?= $record['id']; ?>&records=1" class="mr1 mb1">
			<img src="<?= $record['thumb']; ?>" alt="<?= $title; ?>" class="w100 h100 thumb"/>
		</a>
	<?php } ?>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
