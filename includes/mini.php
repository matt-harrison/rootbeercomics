<?php
$width      = empty($width) ? 800 : $width;
$incomplete = empty($incomplete) ? false : $incomplete;
$title      = (strpos($title, 'by')) ? $title : $title . ', by matt!';
?>
<!doctype html>
<html lang="en">
  <head>
    <link type="text/css" href="/assets/css/library.css" rel="stylesheet"/>
    <link type="image/x-icon" href="/images/icons/r.ico" rel="icon"/>
    <link type="application/rss+xml" href="/scripts/feed.php" rel="alternate"/>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta property="og:description" content="<?= $desc; ?>"/>
    <meta property="og:image" content="https://<?= $_SERVER[HTTP_HOST] . $img; ?>"/>
    <meta property="og:title" content="<?= $title; ?>"/>
    <meta property="og:url" content="https://<?= $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI]; ?>"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <title><?= $title; ?></title>
  </head>
  <body class="m5 bgGrayDark">
    <div id="comic">
      <?php for ($i = $first; $i <= $last; $i++) { ?>
        <img src="img/<?= $book; ?><?= $i; ?>.jpg" alt="page <?= $i; ?>" class="mAuto mb5 w<?= $width; ?>"/>
      <?php } ?>
    </div>
    <?php if ($incomplete) { ?>
      <div class="bsBorder mAuto mb5 p5 w<?= $width; ?> bgWhite">
        <img src="/images/nav/buttons/to-be-continued.png" alt="to be continued..." class="mAuto"/>
      </div>
    <?php } ?>
  </body>
</html>
