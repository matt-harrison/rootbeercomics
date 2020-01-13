<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/utils.php');

$id = $_GET['id'] != NULL ? $_GET['id'] : 1;

$row      = select("SELECT * FROM drawings WHERE id = $id")[0];
$rowCount = select("SELECT COUNT(id) AS rowCount FROM drawings")[0]['rowCount'];

$meta = array(
  'description' => $row['caption'],
  'image'       => $row['final'],
  'title'       => $row['title']
);
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div id="drawings" class="mAuto w800">
  <?php
  include($_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php');
  include($_SERVER['DOCUMENT_ROOT'] . '/drawings/drawing.php');
  include($_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php');
  ?>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
