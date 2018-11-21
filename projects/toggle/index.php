<!doctype html>
<html>
    <head>
        <title>click to toggle</title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta property="og:title" content="click to toggle, by matt!"/>
        <meta property="og:image" content="<?= $images[0]; ?>"/>
        <meta property="og:description" content="<?= $desc; ?>"/>
        <meta property="og:url" content="<?= 'http://' . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI]; ?>"/>
        <link type="text/css" href="/includes/styles.css" rel="stylesheet"/>
        <link type="image/x-icon" href="/images/icons/r.ico" rel="icon"/>
        <link type="application/rss+xml" href="/scripts/feed.php" rel="alternate"/>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <style>
            .customWidth {width: <?= $width; ?>px;}
        </style>
    </head>
    <body class="m5">
        <div class="mAuto customWidth">
            <?php foreach ($images as $key => $image) { ?>
                <img data-id="<?= $key; ?>" src="<?= $image; ?>" alt="<?= $title; ?>" class="flex100 btnToggle csrPointer<?= ($key > 0) ? ' hide' : ''; ?>"/>
            <?php } ?>
        </div>
        <script type="text/javascript">
            $('.btnToggle').click(function() {
                var previousId   = $(this).attr('data-id');
                var nextId       = 1 + Number(previousId);
                var nextImage    = $('[data-id="' + nextId + '"]');
                var firstImage   = $('[data-id="0"]');
                var displayImage = (nextImage.length > 0) ? nextImage : firstImage;

                $('.btnToggle').addClass('hide');
                displayImage.removeClass('hide');
            });
        </script>
    </body>
</html>
