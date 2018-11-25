<?php
$page = $_GET['page'];

if ($page == '') {
	$start = $first;
	$end   = $last;
} else {
	$start = $page;
	$end   = $page;
}
$prev = $start - 1;
$next = $start + 1;
?>
<!doctype html>
<html>
	<head>
		<title><?= $title; ?></title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<meta property="og:title" content="<?= $title; ?>, by matt!"/>
		<meta property="og:image" content="<?= 'http://' . $_SERVER[HTTP_HOST]; ?><?= $img; ?>"/>
		<meta property="og:description" content="<?= $desc; ?>"/>
		<meta property="og:url" content="<?= 'http://' . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI]; ?>"/>
		<link type="text/css" href="/assets/css/library.css" rel="stylesheet"/>
		<link type="image/x-icon" href="/images/icons/r.ico" rel="icon"/>
		<link type="application/rss+xml" href="/scripts/feed.php" rel="alternate"/>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	</head>
	<body class="m5 bgGrayDark">
		<div id="comic">
			<?php for ($i = $start; $i <= $end; $i++) { ?>
				<img src="img/<?= $book; ?><?= $i; ?>.jpg" class="mAuto mb5"/>
			<?php } ?>
		</div>
		<?php if ($incomplete) { ?>
			<p class="bsBorder mAuto mb5 p5 bgWhite txtC" style="width: <?= $width; ?>">to be continued...</p>
		<?php } elseif (!empty($purchaseUrl)) { ?>
			<a href="<?= $purchaseUrl; ?>" target="_blank" class="flex flexEnd mAuto w800 bgWhite">
				<img src="/images/nav/buttons/store.png" alt="store" class="p5"/>
			</a>
		<?php } ?>
	</body>
</html>
