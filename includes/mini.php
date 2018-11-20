<?php
$width      = empty($width) ? 800 : $width;
$incomplete = empty($incomplete) ? false : $incomplete;
$title      = (strpos($title, 'by')) ? $title : $title . ', by matt!';
?>
<!doctype html>
<html>
	<head>
		<title><?= $title; ?></title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<meta property="og:title" content="<?= $title; ?>"/>
		<meta property="og:image" content="<?= 'http://' . $_SERVER[HTTP_HOST]; ?><?= $img; ?>"/>
		<meta property="og:description" content="<?= $desc; ?>"/>
		<meta property="og:url" content="<?= 'http://' . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI]; ?>"/>
		<link type="text/css" href="/includes/styles.css" rel="stylesheet"/>
		<link type="image/x-icon" href="/images/icons/r.ico" rel="icon"/>
		<link type="application/rss+xml" href="/scripts/feed.php" rel="alternate"/>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	</head>
	<body class="m5 bgGrayDark">
		<?php if (!empty($purchaseUrl)) { ?>
			<div class="bsBorder mAuto mb5 p5 w<?= $width; ?> bgWhite">
				<a href="<?= $purchaseUrl; ?>" target="_blank">
					<img src="/images/nav/buttons/purchase.png" alt="purchase" class="mAuto"/>
				</a>
			</div>
		<?php } ?>
		<div id="comic" class="bsBorder mAuto w<?= $width; ?>">
			<?php for ($i = $first; $i <= $last; $i++) { ?>
				<img src="img/<?= $book; ?><?= $i; ?>.jpg" class="flex100 mAuto mb5"/>
			<?php } ?>
		</div>
		<?php if ($incomplete) { ?>
			<div class="bsBorder mAuto mb5 p5 w<?= $width; ?> bgWhite">
				<img src="/images/nav/buttons/to-be-continued.png" alt="to be continued..." class="mAuto"/>
			</div>
		<?php } elseif (!empty($purchaseUrl)) { ?>
			<div class="bsBorder mAuto p5 w<?= $width; ?> bgWhite">
				<a href="<?= $purchaseUrl; ?>" target="_blank">
					<img src="/images/nav/buttons/purchase.png" alt="purchase" class="mAuto"/>
				</a>
			</div>
		<?php } ?>
	</body>
</html>
