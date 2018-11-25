<?php
$title = 'Good Man';
$desc  = 'Click to compare each of the original Good Man pages with its revision.';
$width = 800;
$pages = array(
    array(
        '/minicomics/good/img/good0.jpg',
        '/minicomics/good/old/img/good0.jpg'
    ),
    array(
        '/minicomics/good/img/good1.jpg',
        '/minicomics/good/old/img/good1.jpg'
    ),
    array(
        '/minicomics/good/img/good2.jpg',
        '/minicomics/good/old/img/good2.jpg'
    ),
    array(
        '/minicomics/good/img/good3.jpg',
        '/minicomics/good/old/img/good3.jpg'
    ),
    array(
        '/minicomics/good/img/good4.jpg',
        '/minicomics/good/old/img/good4.jpg'
    ),
    array(
        '/minicomics/good/img/good5.jpg',
        '/minicomics/good/old/img/good5.jpg'
    ),
    array(
        '/minicomics/good/img/good6.jpg',
        '/minicomics/good/old/img/good6.jpg'
    ),
    array(
        '/minicomics/good/img/good7.jpg',
        '/minicomics/good/old/img/good7.jpg'
    ),
    array(
        '/minicomics/good/img/good8.jpg',
        '/minicomics/good/old/img/good8.jpg'
    ),
);
?>
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
        <link type="text/css" href="/assets/css/library.css" rel="stylesheet"/>
        <link type="image/x-icon" href="/images/icons/matt.ico" rel="icon"/>
        <link type="application/rss+xml" href="/scripts/feed.php" rel="alternate"/>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <style>
            .mb40 {margin-bottom: 40px;}
            .customWidth {width: <?= $width; ?>px;}
        </style>
    </head>
    <body class="m5">
        <?php foreach ($pages as $page) { ?>
            <div class="mAuto mb40 customWidth btnToggle csrPointer">
                <?php foreach ($page as $key => $image) { ?>
                    <img src="<?= $image; ?>" alt="<?= $title; ?>"<?= ($key > 0) ? ' class="hide"' : ''; ?>/>
                <?php } ?>
            </div>
        <?php } ?>
        <script type="text/javascript">
            $('.btnToggle').click(function() {
                $(this).find('img').toggleClass('hide');
            });
        </script>
    </body>
</html>
