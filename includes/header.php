<?php
$showSearch = isset($_GET['tag']);

$title   = (isset($title)) ? $title . ' / root beer comics' : 'root beer comics, by matt!';
$caption = (isset($caption)) ? $caption : 'webcomics, minicomics, and sketch blog by matt harrison.';

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
		<meta property="og:title" content="<?= $title; ?>, by matt!"/>
		<meta property="og:image" content="http://<?= $_SERVER[HTTP_HOST] . $img; ?>"/>
		<meta property="og:description" content="<?= $caption; ?>"/>
		<meta property="og:url" content="http://<?= $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI]; ?>"/>
		<link type="text/css" href="/includes/styles.css" rel="stylesheet"/>
		<link type="image/x-icon" href="/images/icons/r.ico" rel="icon"/>
		<link type="application/rss+xml" href="/scripts/feed.php" rel="alternate"/>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	</head>
	<body class="m5">
		<div id="header" class="mb10 wFull">
			<div id="nav" class="m10 flex spaceBetween wrap">
				<div id="logo" class="mr20">
					<a href="/">
						<img src="/images/nav/scribble/rootbeercomics.png" alt="home"/>
					</a>
				</div>
				<a href="/comics" class="dBlock mr20 pt30 pb25 navLink">
					<img src="/images/nav/caps/comics.png" alt="comics" class="mAuto"/>
				</a>
				<a href="/blog/" class="dBlock mr20 pt30 pb25 navLink">
					<img src="/images/nav/caps/drawings.png" alt="drawings" class="mAuto"/>
				</a>
				<a href="/minicomics/" class="dBlock mr20 pt30 pb25 navLink">
					<img src="/images/nav/caps/books.png" alt="books" class="mAuto"/>
				</a>
				<a href="http://rootbeercomics.storenvy.com" class="dBlock mr20 pt30 pb25 navLink">
					<img src="/images/nav/caps/store.png" alt="store" class="mAuto"/>
				</a>
				<div class="dBlock pt30 pb25 navLink csrPointer">
					<img id="btnShowSearch" src="/images/nav/caps/search.png" alt="search" class="mAuto"/>
				</div>
			</div>
			<form id="searchNav" enctype="multipart/form-data" method="GET" action="/search" class="line mAuto mb1 w1000<?= ($showSearch) ? '' : ' hide'; ?>">
				<input type="text" id="tag" name="tag" value="<?= $tag; ?>" placeholder="enter search term" class="unit bsBorder p10 size4of5"/>
				<p id="btnSearch" class="bsBorder unitR mb0 bdrBlack p10 size1of5 txtC csrPointer">go</p>
			</form>
		</div>
		<div id="content" class="mr5 ml5">