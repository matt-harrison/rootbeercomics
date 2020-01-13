<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/utils.php');

$meta = array(
  'description' => 'view all comic posts.',
  'image'       => null,
  'title'       => 'jam comics archive'
);

$rows = select("SELECT * FROM jamcomics ORDER BY id DESC");
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="flex wrap mb5">
  <?php foreach ($rows as $row) { ?>
    <a href="index.php?id=<?= $row['id']; ?>" class="mr1 mb1">
      <img src="<?= $row['thumb']; ?>" alt="<?= $row['title']; ?>"/>
    </a>
  <?php } ?>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
