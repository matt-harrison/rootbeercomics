<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/utils.php');

$query = $_GET['query'] != NULL ? $_GET['query'] : '';

$rows     = select("SELECT * FROM quicklies WHERE title LIKE '%$query%'");
$rowCount = select("SELECT COUNT(id) AS rowCount FROM quicklies")[0]['rowCount'];

$meta = array(
  'description' => 'quick comics about ' . $query,
  'image'       => $rows[0]['final'],
  'title'       => $query . ' quicklies'
);
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div id="comics" class="mAuto w800">
  <?php foreach ($rows as $row) { ?>
    <img
    alt="<?= $row['caption']; ?>"
    class="mb20"
    src="<?= $row['final']; ?>"
    />
  <?php } ?>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
