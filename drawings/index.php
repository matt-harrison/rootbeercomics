<?php
$table = 'drawings';
$sort  = 'DESC';

include($_SERVER['DOCUMENT_ROOT'] . '/includes/sql.php');

if ($records == 1) {
  $title   = $rows[0]['title'];
  $caption = $rows[0]['caption'];
  $body  = $rows[0]['body'];
  $img   = $rows[0]['thumb'];
}
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div id="drawings" class="line mAuto w800">
  <?php
  include($_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php');

  foreach ($rows as $row) {
    include($_SERVER['DOCUMENT_ROOT'] . '/drawings/drawing.php');
  }

  include($_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php');
  ?>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
