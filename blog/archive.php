<?php
$table = 'blog';
$sort  = 'DESC';
include($_SERVER['DOCUMENT_ROOT'] . '/includes/sql.php');

$title = 'blog archive';
$desc = 'view all blog posts';

$colHeight = count($archive) / 3;
if ($colHeight != floor($colHeight)){
	$colHeight = floor($colHeight) + 1;
}
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="flex center wrap">
	<?php foreach ($archive as $post) { ?>
		<?php
		$title = $post['title'];
		$title = str_replace("'", '\&apos;', $title);
		$title = str_replace('"', "\&quot;", $title);
		?>
		<a href="index.php?id=<?= $post['uniqueID']; ?>&records=1" class="mr1 mb1">
			<img src="<?= $post['thumb']; ?>" data-title="<?= $title; ?>" alt="<?= $title; ?>" class="w100 h100 thumb"/>
		</a>
	<?php } ?>
</div>
<div id="tooltip" class="absolute p5 bgWhite hide">
	<span></span>
	<img src="" alt=""/>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
