<?php
$meta = array(
  'description' => 'an archive of the defunct website anarchynerd, by matt harrison.',
  'image'       => null,
  'title'       => 'the anarchynerd pixel art archive'
);

include($_SERVER['DOCUMENT_ROOT'] . '/includes/query.php');

$rows = select("SELECT * FROM other ORDER BY id DESC", 'kittenb1_nerd');
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div id="archive" class="line mAuto w1000">
  <div class="unit size1of3 bdrBox">
    <div class="mr1 mb1 p10 bgWhite">
      <p class="bold">mattman</p>
      <?php $num = 1; ?>
      <?php $rows = select("SELECT * FROM other WHERE type='mattman' ORDER BY id ASC", 'kittenb1_nerd'); ?>
      <?php foreach ($rows as $row) { ?>
        <p class="mb5">
          <span><?= $num; ?>. </span>
          <a href="index.php?id=<?= $row['id']; ?>" data-thumb="<?= $row['gif']; ?>" class="link"><?= $row['title']; ?></a>
        </p>
        <?php $num++; ?>
      <?php } ?>
    </div>
    <div class="mr1 mb1 p10 bgWhite">
      <p class="bold">monsters</p>
      <?php $num = 1; ?>
      <?php $rows = select("SELECT * FROM other WHERE type='monsters' ORDER BY id ASC", 'kittenb1_nerd'); ?>
      <?php foreach ($rows as $row) { ?>
        <p class="mb5">
          <span><?= $num; ?>. </span>
          <a href="index.php?id=<?= $row['id']; ?>" data-thumb="<?= $row['gif']; ?>" class="link"><?= $row['title']; ?></a>
        </p>
        <?php $num++; ?>
      <?php } ?>
    </div>
  </div>
  <div class="unit size1of3 bdrBox">
    <div class="mr1 mb1 p10 bgWhite">
      <p class="bold">stuff</p>
      <?php $num = 1; ?>
      <?php $rows = select("SELECT * FROM other WHERE type='stuff' ORDER BY id ASC", 'kittenb1_nerd'); ?>
      <?php foreach ($rows as $row) { ?>
        <p class="mb5">
          <span><?= $num; ?>. </span>
          <a href="index.php?id=<?= $row['id']; ?>" data-thumb="<?= $row['gif']; ?>" class="link"><?= $row['title']; ?></a>
        </p>
        <?php $num++; ?>
      <?php } ?>
    </div>
  </div>
  <div class="unit size1of3 bdrBox">
    <div class="mr1 mb1 p10 bgWhite">
      <p class="bold">violence</p>
      <?php $num = 1; ?>
      <?php $rows = select("SELECT * FROM other WHERE type='violence' ORDER BY id ASC", 'kittenb1_nerd'); ?>
      <?php foreach ($rows as $row) { ?>
        <p class="mb5">
          <span><?= $num; ?>. </span>
          <a href="index.php?id=<?= $row['id']; ?>" data-thumb="<?= $row['gif']; ?>" class="link"><?= $row['title']; ?></a>
        </p>
        <?php $num++; ?>
      <?php } ?>
    </div>
  </div>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
