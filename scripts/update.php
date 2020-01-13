<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/utils.php');

requireSuperuser();

$messages = array();
$queries  = array();

$table = $_POST['table'];
$id    = $_POST['id'];

$query = "SELECT * FROM $table WHERE id = '$id'";
$rows  = select($query);

function sqlEscape($raw) {
  $modified = str_replace('"', '\"', $raw);
  $modified = str_replace("'", "\'", $modified);

  return $modified;
}
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<section class="mAuto mb10 p10 w1000 bgWhite">
  <?php
  foreach ($rows as $row) {
    foreach ($_POST as $field => $value) {
      if ($field !== 'table' && $value != $row[$field]) {
        $value = sqlEscape($value);
        $query = "UPDATE $table SET $field = '$value' WHERE id = '$id'";
        $queries[] = $query;
      }
    }
  }

  if (empty($queries)) {
    $messages[] = 'no queries were performed.';
  }
  ?>
  <?php foreach ($queries as $query) { ?>
    <?php $response = execute($query); ?>
    <textarea class="bsBorder mb10 wFull"><?= $query; ?></textarea>
  <?php } ?>
  <?php foreach ($messages as $message) { ?>
    <p class="mb0"><?= $message; ?></p>
  <?php } ?>
</section>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
