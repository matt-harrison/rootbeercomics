<?php
$meta = array(
  'description' => 'an archive of movie scene drawings from the defunct website "the burgg," preserved by matt harrison.',
  'image'       => null,
  'title'       => 'the burgg'
);

include($_SERVER['DOCUMENT_ROOT'] . '/includes/query.php');

$rows = select("SELECT * FROM burgg ORDER BY id ASC");
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="flex wrap">
  <?php foreach ($rows as $row) { ?>
    <a href="index.php?id=<?= $row['id']; ?>" class="mr1 mb1">
      <img
      alt="<?= $row['title']; ?>"
      class="thumb"
      src="<?= $row['thumb']; ?>"
      />
    </a>
  <?php } ?>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
