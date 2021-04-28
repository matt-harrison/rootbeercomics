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
    <meta property="og:url" content="<?= 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <style>
      .mb40 {margin-bottom: 40px;}
      .customWidth {width: <?= $width; ?>px;}
    </style>
    <title>click to toggle</title>
  </head>
  <body class="m5">
    <?php foreach ($pages as $pageIndex => $page) { ?>
      <div class="mAuto mb40 btnToggle customWidth csrPointer">
        <?php foreach ($page as $imageIndex => $image) { ?>
          <img
          alt="<?= $title; ?>"
          class="flex100 btnToggle customWidth csrPointer<?= ($imageIndex > 0) ? ' hide' : ''; ?>"
          data-index="<?= $imageIndex; ?>"
          data-page="<?= $pageIndex; ?>"
          src="<?= $image; ?>"
          />
        <?php } ?>
      </div>
    <?php } ?>
    <script>
      $('.btnToggle').click(function() {
        var previousIndex = $(this).attr('data-index');
        var page          = $(this).attr('data-page');
        var nextIndex     = 1 + Number(previousIndex);
        var nextImage     = $('[data-page="' + page + '"][data-index="' + nextIndex + '"]');
        var firstImage    = $('[data-page="' + page + '"][data-index="0"]');
        var displayImage  = (nextImage.length > 0) ? nextImage : firstImage;

        $('.btnToggle[data-page="' + page + '"]').addClass('hide');
        displayImage.removeClass('hide');
      });
    </script>
  </body>
</html>