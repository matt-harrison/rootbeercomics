<?php
$description = (isset($meta['description']))
  ? $meta['description']
  : 'comics and drawings by matt harrison.';
$image = (isset($meta['image']))
  ? $meta['image']
  : '/images/avatar.jpg';
$title = (isset($meta['title']))
  ? $meta['title'] . ' / root beer comics, by matt!'
  : 'root beer comics, by matt!';

include($_SERVER['DOCUMENT_ROOT'] . '/includes/user.php');
?>
<!doctype html>
<html lang="en">
<head>
  <link rel="icon" type="image/x-icon" href="/images/icons/r.ico"/>
  <link type="text/css" href="/assets/css/library.css" rel="stylesheet"/>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <meta property="og:description" content="<?= $description; ?>"/>
  <meta property="og:image" content="http://<?= $_SERVER[HTTP_HOST] . $image; ?>"/>
  <meta property="og:title" content="<?= $title; ?>"/>
  <meta property="og:type" content="website"/>
  <meta property="og:url" content="http://<?= $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI]; ?>"/>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <title><?= $title; ?></title>
</head>
<body class="m5">
  <div id="header" class="mb50 wFull">
    <div id="nav" class="flex spaceBetween alignCenter wrap">
      <div id="logo" class="mr20">
        <a href="/">
          <img src="/images/nav/buttons/root-beer-comics.png" alt="home"/>
        </a>
      </div>
      <a href="/minicomics/" class="navLink">
        <img src="/images/nav/buttons/comic-books.png" alt="comic books" class="mr5 mb5"/>
      </a>
      <a href="/zines/" class="navLink">
        <img src="/images/nav/buttons/zines.png" alt="zines" class="mr5 mb5"/>
      </a>
      <a href="/comics/archive.php" class="navLink">
        <img src="/images/nav/buttons/comic-strips.png" alt="comic strips" class="mr5 mb5"/>
      </a>
      <a href="http://www.instagram.com/rootbeercomics" target="_blank" class="navLink">
        <img src="/images/nav/buttons/instagram.png" alt="instagram" class="mr5 mb5"/>
      </a>
      <a href="mailto:rootbeercomics@gmail.com" target="_blank" class="navLink">
        <img src="/images/nav/buttons/email.png" alt="email" class="mr5 mb5"/>
      </a>
      <a href="/projects" class="navLink">
        <img src="/images/nav/buttons/more.png" alt="more" class="mr5 mb5"/>
      </a>
    </div>
  </div>
  <div id="content">
