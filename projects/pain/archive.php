<?php
$meta = array(
  'description' => 'an archive of the defunct website of pain, preserved by matt harrison.',
  'image'       => null,
  'title'       => 'the website of pain'
);

include($_SERVER['DOCUMENT_ROOT'] . '/includes/utils.php');

$rows = select("SELECT * FROM pain ORDER BY id ASC");
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="flex wrap">
  <?php foreach ($rows as $row) { ?>
    <a href="index.php?id=<?= $row['id']; ?>" class="mr1 mb1">
      <img src="<?= $row['thumb']; ?>" alt="<?= $title; ?>" class="thumb"/>
    </a>
  <?php } ?>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
