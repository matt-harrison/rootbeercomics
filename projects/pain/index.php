<?php
$title = 'the website of pain archive';
$desc  = 'an archive of the defunct website of pain, preserved by matt harrison.';

$table = 'pain';
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/sql.php'); ?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="mAuto mb50 w1000">
  <?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php'); ?>
  <?php foreach ($rows as $row) { ?>
    <div class="bsBorder mAuto mb5 p20 w1000 bgWhite">
      <h2 class="mb10 fs16">
        <a href="/projects/pain/index.php?id=<?= $row['uniqueID']; ?>"><?= $row['title']; ?></a>
        <span class="txtGray">by <?= $row['author']; ?></span>
      </h2>
      <img src="<?= $row['img']; ?>" alt="<?= $row['title']; ?>" class="mAuto"/>
      <?php if($row['caption'] != ''){ ?>
        <p class="mt10"><?= $row['caption']; ?></p>
      <?php } ?>
    </div>
  <?php } ?>
  <?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php'); ?>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
