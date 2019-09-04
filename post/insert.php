<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/query.php');
include($_SERVER['DOCUMENT_ROOT'] . '/includes/require-superuser.php');

$table   = $_POST['table'];
$caption = $_POST['caption'];
$date  = $_POST['date'];
$title   = $_POST['title'];
$thumb   = $_POST['thumb'];
$title   = str_replace("'", "\'", $title);
$caption = str_replace("'", "\'", $caption);

$rows = select("SELECT * FROM $table");
$id   = (count($rows) + 1);

$isDrawings = ($table == 'drawings');

if ($isDrawings) {
  $images = $_POST['images'];
  $query  = "INSERT INTO drawings (
    id,
    title,
    date,
    thumb,
    caption,
    images
  ) VALUES (
    '$id',
    '$title',
    '$date',
    '$thumb',
    '$caption',
    '$images'
  )";
} else {
  $final  = $_POST['final'];
  $original = $_POST['original'];
  $query  = "INSERT INTO comics (
    id,
    date,
    final,
    original,
    thumb,
    title,
    caption
  ) VALUES (
    '$id',
    '$date',
    '$final',
    '$original',
    '$thumb',
    '$title',
    '$caption'
  )";
}
$result = execute($query);
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="mb5 mAuto bdrBox w1000 bdrGray bgWhite">
  <div class="p10">
    <?php if ($isDrawings) { ?>
      <a href="/drawings/index.php?id=<?= $id ?>" target="_blank">view drawing #<?= $id; ?></a><br/>
      <span>title:   <?= $title; ?></span><br/>
      <span>date:  <?= $date; ?></span><br/>
      <span>thumb:   <?= $thumb; ?></span><br/><br/>
      <span>caption: <?= $caption; ?></span><br/>
      <span>images:</span><br/>
      <textarea style="width:500px;height:300px;"><?= $images; ?></textarea><br/>
    <?php } else { ?>
      <a href="/comics/index.php?id=<?= $id ?>" target="_blank">view comic #<?= $id; ?></a><br/>
      <span>title:  <?= $title; ?></span><br/>
      <span>date:   <?= $date; ?></span><br/><br/>
      <span>thumb:  <?= $thumb; ?></span><br/>
      <span>final:  <?= $final; ?></span><br/>
      <span>original: <?= $original; ?></span><br/>
      <span>caption:  <?= $caption; ?></span><br/>
    <?php } ?>
  </div>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
