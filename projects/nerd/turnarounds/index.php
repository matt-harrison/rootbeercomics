<?php
$title    = 'the anarchynerd pixel art archive';
$desc     = 'an archive of the defunct website anarchynerd, by matt harrison.';

include($_SERVER['DOCUMENT_ROOT'] . '/includes/query.php');

$page    = $_GET['id'] != NULL ? $_GET['id'] : 1;
$zoom    = isset($_GET['zoom']) ? number_format($_GET['zoom']) : 8;
$records = 1;

$query   = "SELECT * FROM turnarounds WHERE id <= $page ORDER BY id DESC LIMIT 1";
$record  = select($query, 'kittenb1_nerd')[0];
$archive = select('SELECT * FROM turnarounds', 'kittenb1_nerd');
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="mAuto w1000">
  <?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php'); ?>
  <div class="mb10 p20 bgWhite">
    <div class="mAuto w800 noSelect">
      <div class="line mb10">
        <h2 class="unit mr5 mb0 bold">
          <a href="index.php?id=<?= $record['uniqueID']; ?>"><?= $record['title']; ?></a>
        </h2>
        <p class="unitR">
          <a href="index.php?id=<?= $page; ?>&zoom=1" class="mr5">small</a>
          <a href="index.php?id=<?= $page; ?>&zoom=4" class="mr5">medium</a>
          <a href="index.php?id=<?= $page; ?>&zoom=8">large</a>
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
        alt="<?= $record['title']; ?>"
        data-framecount="<?= $record['frameCount']; ?>"
        id="sprite"
        src="<?= $record['url']; ?>"
        />
      </div>
    </div>
  </div>
  <?php if ($user->isAdmin & $records == 1) { ?>
    <?php $title = $record['title']; ?>
    <div class="mb5 p20 bgGray private">
      <div class="line">
        <div class="unit mr5 w100">
          <p class="mb5 txtR label">title:</p>
          <p class="mb5 txtR label">url:</p>
          <p class="mb5 txtR label">gif:</p>
          <p class="mb5 txtR label">tags:</p>
          <p class="mb5 txtR label">caption:</p>
          <img src="<?= $record['gif']; ?>" class="unitR"/>
        </div>
        <form enctype="multipart/form-data" action="update.php" method="post" target="get.html" class="unitF">
          <input type="hidden" name="table" value="turnarounds"/>
          <input type="hidden" name="uniqueID" value="<?= $record['uniqueID']; ?>"/>
          <input type="text" name="title" class="mb5 wFull" value="<?= $record['title']; ?>"/>
          <input type="text" name="url" class="mb5 wFull" value="<?= $record['url']; ?>"/>
          <input type="text" name="gif" class="mb5 wFull" value="<?= $record['gif']; ?>"/>
          <input type="text" name="tags" class="mb5 wFull" value="<?= $record['tags']; ?>"/>
          <textarea name="caption" class="mb5 wFull" rows="10"><?= $record['caption']; ?></textarea>
          <input type="submit" value="update"/>
        </form>
      </div>
    </div>
  <?php } ?>
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
