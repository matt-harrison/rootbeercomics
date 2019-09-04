<?php
$title = 'illustration';
$desc  = 'illustration by matt harrison.';
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>

<div class="mb50">
  <img src="/images/nav/scribble/commissions.png" class="mb10"/>
  <div class="flex wrap">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/commissions.php'); ?>
  </div>
</div>
<div class="mb50">
  <img src="/images/nav/scribble/posters.png" class="mb10"/>
  <div class="flex wrap">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/posters.php'); ?>
  </div>
</div>
<div class="mb50">
  <img src="/images/nav/scribble/published.png" class="mb10"/>
  <div class="flex wrap">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/whurk.php'); ?>
  </div>
</div>
<div class="mb50">
  <img src="/images/nav/scribble/zines.png" class="mb10"/>
  <div class="flex wrap">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/zines.php'); ?>
  </div>
</div>
<div class="mb50">
  <img src="/images/nav/scribble/fiction.png" class="mb10"/>
  <div class="flex wrap">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/fiction.php'); ?>
  </div>
</div>
<div class="mb50">
  <img src="/images/nav/scribble/non-fiction.png" class="mb10"/>
  <div class="flex wrap">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/non-fiction.php'); ?>
  </div>
</div>
<div class="mb50">
  <img src="/images/nav/scribble/cover-songs.png" class="mb10"/>
  <div class="flex wrap">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/cover-songs.php'); ?>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/one-page-cover-songs.php'); ?>
  </div>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
