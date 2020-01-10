<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/query.php');

$id = $_GET['id'] != NULL ? $_GET['id'] : 1;

$row      = select("SELECT * FROM quicklies WHERE id = $id")[0];
$rowCount = select("SELECT COUNT(id) AS rowCount FROM quicklies")[0]['rowCount'];

$meta = array(
  'description' => $row['caption'],
  'image'       => $row['final'],
  'title'       => $row['title']
);
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div id="comics" class="mAuto w800">
  <?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php'); ?>
  <img
  alt="<?= $row['caption']; ?>"
  class="mb10"
  src="<?= $row['final']; ?>"
  />
  <?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php'); ?>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
