<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/utils.php');

$id   = $_GET['id'] != NULL ? $_GET['id'] : 1;
$zoom = isset($_GET['zoom']) ? number_format($_GET['zoom']) : 8;

$row      = select("SELECT * FROM other WHERE id = $id", 'kittenb1_nerd')[0];
$rowCount = select("SELECT COUNT(id) AS rowCount FROM other", 'kittenb1_nerd')[0]['rowCount'];


$meta = array(
  'description' => $row['caption'],
  'image'       => $row['gif'],
  'title'       => $row['title']
);
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="line mAuto w1000">
  <?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php'); ?>
  <div class="mAuto mb10 p20 bdrBox bgWhite">
    <img src="<?= $row['gif']; ?>" alt="" class="mAuto"/>
  </div>
  <?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php'); ?>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
