<?php
$title = 'Potential';
$desc  = 'Click to compare each of the original Potential pages with its revision.';
$width = 800;
$pages = array(
  array(
    '/minicomics/potential/img/potential1.jpg',
    '/minicomics/potential/draft2/potential1.jpg'
  ),
  array(
    '/minicomics/potential/img/potential2.jpg',
    '/minicomics/potential/draft2/potential2.jpg'
  )
);
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
    <meta property="og:image" content="<?= $images[0]; ?>"/>
    <meta property="og:title" content="click to toggle, by matt!"/>
    <meta property="og:url" content="<?= 'http://' . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI]; ?>"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <style>
      .mb40 {margin-bottom: 40px;}
      .customWidth {width: <?= $width; ?>px;}
    </style>
    <title>click to toggle</title>
  </head>
  <body class="m5">
    <?php foreach ($pages as $page) { ?>
      <div class="mAuto mb40 customWidth btnToggle csrPointer">
        <?php foreach ($page as $key => $image) { ?>
          <img src="<?= $image; ?>" alt="<?= $title; ?>"<?= ($key > 0) ? ' class="hide"' : ''; ?>/>
        <?php } ?>
      </div>
    <?php } ?>
    <script>
      $('.btnToggle').click(function() {
        $(this).find('img').toggleClass('hide');
      });
    </script>
  </body>
</html>
