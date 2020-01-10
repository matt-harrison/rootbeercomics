<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/query.php');

$id = $_GET['id'] != NULL ? $_GET['id'] : 1;

$row      = select("SELECT * FROM burgg WHERE id = $id")[0];
$rowCount = select("SELECT COUNT(id) AS rowCount FROM burgg")[0]['rowCount'];

$meta = array(
  'description' => $row['hint'],
  'image'       => $row['img'],
  'title'       => $row['title']
);
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="mAuto w1000">
  <?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php'); ?>
  <div class="mb5 p20 bgWhite">
    <div class="mAuto w800">
      <h2 class="mb10 fs16">
        <a href="/projects/burgg/index.php?id=<?= $row['id']; ?>"><?= $row['title']; ?></a>
        <span class="txtGray">by <?= $row['author']; ?></span>
      </h2>
      <div class="scene">
        <img
        alt="<?= $row['title']; ?>"
        class="mAuto mb5"
        src="<?= $row['img']; ?>"
        />
      </div>
    </div>
  </div>
  <?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php'); ?>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
