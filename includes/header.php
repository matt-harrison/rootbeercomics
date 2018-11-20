<?php
$showSearch = isset($_GET['tag']);

$title   = (isset($title)) ? $title . ' / root beer comics, by matt!' : 'root beer comics, by matt!';
$caption = (isset($caption)) ? $caption : 'comics and drawings by matt harrison.';

if(!isset($img)){
	$img = '/images/avatar.jpg';
}
?>
<!doctype html>
<html>
	<head>
		<title><?= $title; ?></title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<meta property="og:type" content="website"/>
		<meta property="og:title" content="<?= $title; ?>"/>
		<meta property="og:image" content="http://<?= $_SERVER[HTTP_HOST] . $img; ?>"/>
		<meta property="og:description" content="<?= $caption; ?>"/>
		<meta property="og:url" content="http://<?= $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI]; ?>"/>
		<link type="text/css" href="/includes/styles.css" rel="stylesheet"/>
		<link type="image/x-icon" href="/images/icons/r.ico" rel="icon"/>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	</head>
	<body class="m5">
		<div id="header" class="mb5 wFull">
			<div id="nav" class="m10 flex spaceBetween wrap">
				<div id="logo" class="mr20">
					<a href="/">
						<img src="/images/nav/scribble/rootbeercomics.png" alt="home"/>
					</a>
				</div>
				<a href="/comics/archive.php" class="dBlock mr20 pt30 pb25 navLink">
					<img src="/images/nav/caps/comics.png" alt="comics" class="mAuto"/>
				</a>
				<a href="/drawings/archive.php" class="dBlock mr20 pt30 pb25 navLink">
					<img src="/images/nav/caps/drawings.png" alt="drawings" class="mAuto"/>
				</a>
				<a href="/minicomics/" class="dBlock mr20 pt30 pb25 navLink">
					<img src="/images/nav/caps/books.png" alt="books" class="mAuto"/>
				</a>
				<a href="http://rootbeercomics.storenvy.com" target="_blank" class="dBlock mr20 pt30 pb25 navLink">
					<img src="/images/nav/caps/store.png" alt="store" class="mAuto"/>
				</a>
			</div>
		</div>
		<div id="content">