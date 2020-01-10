<?php
$images = explode(',', $row['images']);
?>
<div class="mAuto">
  <?php foreach ($images as $key => $image) { ?>
    <img
    alt="<?= $row['title']; ?>"
    class="mAuto mb10"
    src="<?= $image; ?>"
    />
  <?php } ?>
</div>
