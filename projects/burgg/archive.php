<?php
$title = 'the burgg';
$desc  = 'an archive of movie scene drawings from the defunct website "the burgg," preserved by matt harrison.';

$table = 'burgg';
$sort  = 'ASC';
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/sql.php'); ?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="flex wrap">
  <?php foreach ($archive as $record) { ?>
    <a href="index.php?id=<?= $record['id']; ?>" class="mr1 mb1">
      <img src="<?= $record['thumb']; ?>" alt="<?= $title; ?>" class="thumb"/>
    </a>
  <?php } ?>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
