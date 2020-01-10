<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/query.php');

$id = $_GET['id'] != NULL ? $_GET['id'] : 1;

$row      = select("SELECT * FROM pain WHERE id = $id")[0];
$rowCount = select("SELECT COUNT(id) AS rowCount FROM pain")[0]['rowCount'];

$meta = array(
  'description' => $row['caption'],
  'image'       => $row['img'],
  'title'       => $row['title']
);
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="mAuto w1000">
  <?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php'); ?>
  <div class="bsBorder mAuto mb10 p20 w1000 bgWhite">
    <h2 class="mb10 fs16"><?= $row['title']; ?> by <?= $row['author']; ?></h2>
    <img
    alt="<?= $row['title']; ?>"
    class="mAuto"
    src="<?= $row['img']; ?>"
    />
    <?php if ($row['caption'] != '') { ?>
      <p class="mt10"><?= $row['caption']; ?></p>
    <?php } ?>
  </div>
  <?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php'); ?>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
