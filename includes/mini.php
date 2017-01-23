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
		<link type="text/css" href="/includes/styles.css" rel="stylesheet"/>
		<link type="image/x-icon" href="/images/icons/matt.ico" rel="icon"/>
		<link type="application/rss+xml" href="/scripts/feed.php" rel="alternate"/>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	</head>
	<body class="m5 bgGrayDark">
		<div class="mAuto flex spaceBetween mb5 w800 bgWhite">
			<?php if ($start == $end && $prev >= $first) { ?>
				<a href="index.php?page=<?= $prev; ?>" class="p10">&lt;</a>
			<?php } ?>
			<a href="/" class="p10 bold">home</a>
			<?php if (!empty($purchaseUrl)) { ?>
				<a href="<?= $purchaseUrl; ?>" target="_blank" class="p10">purchase</a>
			<?php } ?>
			<?php if ($start != $end) { ?>
				<a href="index.php?page=<?= $first; ?>" class="p10">page by page</a>
			<?php } else { ?>
				<a href="index.php?page=full" class="p10">view all</a>
			<?php } ?>
			<?php if ($start == $end && $next <= $last) { ?>
				<a href="index.php?page=<?= $next; ?>" class="p10">&gt;</a>
			<?php } ?>
			</div>
		</div>
		<div id="comic">
			<?php for($i = $start; $i <= $end; $i++){ ?>
				<img src="img/<?= $book; ?><?= $i ?>.jpg" class="mAuto mb5"/>
			<?php } ?>
		</div>
		<div class="mAuto flex spaceBetween mb5 w800 bgWhite">
			<?php if ($start == $end && $prev >= $first) { ?>
				<a href="index.php?page=<?= $prev; ?>" class="p10">&lt;</a>
			<?php } ?>
			<a href="/" class="p10 bold">home</a>
			<?php if (!empty($purchaseUrl)) { ?>
				<a href="<?= $purchaseUrl; ?>" target="_blank" class="p10">purchase</a>
			<?php } ?>
			<?php if ($start != $end) { ?>
				<a href="index.php?page=<?= $first; ?>" class="p10">page by page</a>
			<?php } else { ?>
				<a href="index.php?page=full" class="p10">view all</a>
			<?php } ?>
			<?php if ($start == $end && $next <= $last) { ?>
				<a href="index.php?page=<?= $next; ?>" class="p10">&gt;</a>
			<?php } ?>
			</div>
		</div>
	</body>
</html>
