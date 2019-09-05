<?php
$title    = 'the anarchynerd pixel art archive';
$desc     = 'an archive of the defunct website anarchynerd, by matt harrison.';

include($_SERVER['DOCUMENT_ROOT'] . '/includes/query.php');
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div id="content">
  <div id="archive" class="line mAuto w1000">
    <div class="unit size1of3 bdrBox">
      <div class="mr1 mb1 p10 bgWhite">
        <p class="bold">marvel</p>
        <ol>
          <?php
          $query   = "SELECT * FROM turnarounds WHERE type='marvel' ORDER BY id";
          $archive = select($query, 'kittenb1_nerd');
          ?>
          <?php foreach ($archive as $animation) { ?>
            <li class="mb5"><a href="index.php?id=<?= $animation['id']; ?>" data-thumb="<?= $animation['gif']; ?>" class="link"><?= $animation['title']; ?></a></li>
          <?php } ?>
        </ol>
      </div>
      <div class="mr1 mb1 p10 bgWhite">
        <p class="bold">star wars</p>
        <ol>
          <?php
          $query   = "SELECT * FROM turnarounds WHERE type='starwars' ORDER BY id";
          $archive = select($query, 'kittenb1_nerd');
          ?>
          <?php foreach ($archive as $animation) { ?>
            <li class="mb5"><a href="index.php?id=<?= $animation['id']; ?>" data-thumb="<?= $animation['gif']; ?>" class="link"><?= $animation['title']; ?></a></li>
          <?php } ?>
        </ol>
       </div>
      <div class="mr1 mb1 p10 bgWhite">
        <p class="bold">mortal kombat</p>
        <ol>
          <?php
          $query   = "SELECT * FROM turnarounds WHERE type='mk' ORDER BY id";
          $archive = select($query, 'kittenb1_nerd');
          ?>
          <?php foreach ($archive as $animation) { ?>
            <li class="mb5"><a href="index.php?id=<?= $animation['id']; ?>" data-thumb="<?= $animation['gif']; ?>" class="link"><?= $animation['title']; ?></a></li>
          <?php } ?>
        </ol>
       </div>
    </div>
    <div class="unit size1of3 bdrBox">
      <div class="mr1 mb1 p10 bgWhite">
        <p class="bold">matt</p>
        <ol>
          <?php
          $query   = "SELECT * FROM turnarounds WHERE type='matt' ORDER BY id";
          $archive = select($query, 'kittenb1_nerd');
          ?>
          <?php foreach ($archive as $animation) { ?>
            <li class="mb5"><a href="index.php?id=<?= $animation['id']; ?>" data-thumb="<?= $animation['gif']; ?>" class="link"><?= $animation['title']; ?></a></li>
          <?php } ?>
        </ol>
       </div>
      <div class="mr1 mb1 p10 bgWhite">
        <p class="bold">anarchynerd</p>
        <ol>
          <?php
          $query   = "SELECT * FROM turnarounds WHERE type='nerd' ORDER BY id";
          $archive = select($query, 'kittenb1_nerd');
          ?>
          <?php foreach ($archive as $animation) { ?>
            <li class="mb5"><a href="index.php?id=<?= $animation['id']; ?>" data-thumb="<?= $animation['gif']; ?>" class="link"><?= $animation['title']; ?></a></li>
          <?php } ?>
        </ol>
       </div>
      <div class="mr1 mb1 p10 bgWhite">
        <p class="bold">other</p>
        <ol>
          <?php
          $query   = "SELECT * FROM turnarounds WHERE type='other' ORDER BY id";
          $archive = select($query, 'kittenb1_nerd');
          ?>
          <?php foreach ($archive as $animation) { ?>
            <li class="mb5"><a href="index.php?id=<?= $animation['id']; ?>" data-thumb="<?= $animation['gif']; ?>" class="link"><?= $animation['title']; ?></a></li>
          <?php } ?>
        </ol>
      </div>
    </div>
    <div class="unit size1of3 bdrBox">
      <div class="mb1 p10 bgWhite">
        <p class="bold">friends</p>
        <ol>
          <?php
          $query   = "SELECT * FROM turnarounds WHERE type='friends' ORDER BY id";
          $archive = select($query, 'kittenb1_nerd');
          ?>
          <?php foreach ($archive as $animation) { ?>
            <li class="mb5"><a href="index.php?id=<?= $animation['id']; ?>" data-thumb="<?= $animation['gif']; ?>" class="link"><?= $animation['title']; ?></a></li>
          <?php } ?>
        </ol>
       </div>
    </div>
  </div>
</div>
<div id="tooltip" class="absolute hide">
  <span></span>
  <img src="" alt=""/>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
