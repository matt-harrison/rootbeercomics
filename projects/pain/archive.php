<?php
$title = 'the website of pain';
$desc  = 'an archive of the defunct website of pain, preserved by matt harrison.';

$table = 'pain';
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
