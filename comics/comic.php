<?php
$images = array();

if (!empty($row['final'])) {
  $images[] = $row['final'];
}

if (!empty($row['original'])) {
  $images[] = $row['original'];
}

$hasMultiple = (count($images) > 1);
?>
<div class="mAuto mb10">
  <?php foreach ($images as $key => $image) { ?>
    <img
    alt="<?= $row['title']; ?>"
    class="mAuto<?= ($hasMultiple) ? ' multiple csrPointer' : ''; ?><?= ($key > 0) ? ' hide' : ''; ?>"
    data-id="<?= $row['id']; ?>"
    data-version="<?= $key; ?>"
    src="<?= $image; ?>"/>
  <?php } ?>
</div>
<?php if ($hasMultiple) { ?>
  <script src="/assets/js/multiple.js"></script>
<?php } ?>
