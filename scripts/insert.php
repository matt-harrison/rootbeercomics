<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/user.php');
include($_SERVER['DOCUMENT_ROOT'] . '/includes/require-superuser.php');
include($_SERVER['DOCUMENT_ROOT'] . '/includes/query.php');

$table  = $_POST['table'];
$title  = $_POST['title'];
$type   = $_POST['type'];
$swf    = $_POST['swf'];
$gif    = $_POST['gif'];
$width  = $_POST['width'];
$height = $_POST['height'];

$query  = "INSERT INTO $table (
  title,
  type,
  swf,
  gif,
  width,
  height
) VALUES (
  '$title',
  '$type',
  '$swf',
  '$gif',
  $width,
  $height
)";

debug($query);

// $result = execute($query, 'kittenb1_nerd');

// debug($result);
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<a href="/scripts/form.php">add</a>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>