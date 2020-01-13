<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/query.php');

$id   = $_GET['id'] != NULL ? $_GET['id'] : 1;
$zoom = isset($_GET['zoom']) ? number_format($_GET['zoom']) : 8;

$row      = select("SELECT * FROM turnarounds WHERE id = $id", 'kittenb1_nerd')[0];
$rowCount = select("SELECT COUNT(id) AS rowCount FROM turnarounds", 'kittenb1_nerd')[0]['rowCount'];

$meta = array(
  'description' => null,
  'image'       => $row['png'],
  'title'       => $row['title']
);
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="mAuto w1000">
  <?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php'); ?>
  <div class="mb10 p20 bgWhite">
    <div class="mAuto noSelect">
      <div class="line mb10">
        <h2 class="unit mr5 mb0 bold"><?= $row['title']; ?></h2>
        <p class="unitR">
          <a href="index.php?id=<?= $id; ?>&zoom=1" class="mr5">small</a>
          <a href="index.php?id=<?= $id; ?>&zoom=4" class="mr5">medium</a>
          <a href="index.php?id=<?= $id; ?>&zoom=8">large</a>
        </p>
      </div>
      <div id="buttons" class="line mAuto mb5 bdrGray bgWhite txtC resize invisible">
        <p id="playBackward" class="unit mb0 pt10 pb10 size1of5 bdrBox csrPointer">&lt;&lt;</p>
        <p id="stepBackward" class="unit mb0 pt10 pb10 size1of5 bdrBox csrPointer">&lt;</p>
        <p id="stop" class="unit mb0 pt10 pb10 size1of5 bdrBox csrPointer">x</p>
        <p id="stepForward" class="unit mb0 pt10 pb10 size1of5 bdrBox csrPointer">&gt;</p>
        <p id="playForward" class="unit mb0 pt10 pb10 size1of5 bdrBox csrPointer">&gt;&gt;</p>
      </div>
      <div id="anim" data-zoom="<?= $zoom; ?>" class="mAuto mb5 dotted bgWhite resize anim invisible">
        <img
        alt="<?= $row['title']; ?>"
        data-framecount="<?= $row['frameCount']; ?>"
        id="sprite"
        src="<?= $row['png']; ?>"
        />
      </div>
    </div>
  </div>
  <?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php'); ?>
</div>
<script src="/assets/js/spin.js"></script>
<style>
  #sprite {
    max-width: none;
    image-rendering: pixelated;
  }
</style>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
