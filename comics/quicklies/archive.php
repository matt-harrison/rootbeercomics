<?php
$meta = array(
  'description' => 'view all comic posts.',
  'image'       => null,
  'title'       => 'quicklies archive'
);

include($_SERVER['DOCUMENT_ROOT'] . '/includes/query.php');

$rows = select("SELECT * FROM quicklies ORDER BY id DESC");
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php');?>
<div class="flex wrap mb5">
  <?php foreach ($rows as $row) { ?>
    <a href="index.php?id=<?= $row['id']; ?>" class="mr1 mb1">
      <img src="<?= $row['thumb']; ?>" alt="<?= $row['title']; ?>" class="thumb"/>
    </a>
  <?php } ?>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
