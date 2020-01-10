<?php
$prevRow = $id - 1;
$nextRow = $id + 1;
?>
<div class="mb10 flex spaceBetween wrap">
  <a href="index.php?id=1" class="<?= ($prevRow >= 1) ? '' : ' invisible'; ?>">
    <img src="/images/nav/buttons/oldest.png" alt="oldest" class="mAuto"/>
  </a>
  <a href="index.php?id=<?= $prevRow; ?>" class="<?= ($prevRow >= 1) ? '' : ' invisible'; ?>">
    <img src="/images/nav/buttons/older.png" alt="older" class="mAuto"/>
  </a>
  <a href="archive.php" class="">
    <img src="/images/nav/buttons/archive.png" alt="all" class="mAuto"/>
  </a>
  <a href="index.php?id=<?= $nextRow; ?>" class="<?= ($nextRow <= $rowCount) ? '' : ' invisible'; ?>">
    <img src="/images/nav/buttons/newer.png" alt="newer" class="mAuto"/>
  </a>
  <a href="index.php?id=<?= $rowCount; ?>" class="<?= ($nextRow <= $rowCount) ? '' : ' invisible'; ?>">
    <img src="/images/nav/buttons/newest.png" alt="newest" class="mAuto"/>
  </a>
</div>
