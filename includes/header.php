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
			<div class="line mAuto w1000">
				<div id="logo" class="unit size1of5">
					<a href="/">
						<img src="/images/nav/scribble/rootbeercomics.png" alt="home"/>
					</a>
				</div>
				<a href="/comics" class="dBlock unit size1of5 pt25 pb25 navLink">
					<img src="/images/nav/scribble/comics.png" alt="comics" class="mAuto"/>
				</a>
				<a href="/blog/" class="dBlock unit size1of5 pt25 pb25 navLink">
					<img src="/images/nav/scribble/blog.png" alt="blog" class="mAuto"/>
				</a>
				<a href="/minicomics/" class="dBlock unit size1of5 pt25 pb25 navLink">
					<img src="/images/nav/scribble/books.png" alt="books" class="mAuto"/>
				</a>
				<div class="dBlock unit size1of5 pt25 pb25 navLink csrPointer">
					<img id="btnShowSearch" src="/images/nav/scribble/search.png" alt="search" class="mAuto"/>
				</div>
			</div>
			<form id="searchNav" enctype="multipart/form-data" method="GET" action="/search" class="line mAuto mb1 w1000<?= ($showSearch) ? '' : ' hide'; ?>">
				<input type="text" id="tag" name="tag" value="<?= $tag; ?>" placeholder="enter search term" class="unit bsBorder p10 size4of5"/>
				<p id="btnSearch" class="bsBorder unitR mb0 bdrBlack p10 size1of5 txtC csrPointer">go</p>
			</form>
		</div>
		<div id="content" class="mr5 ml5">