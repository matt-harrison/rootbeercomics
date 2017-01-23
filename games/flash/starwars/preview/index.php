<?php
if($_GET['w'] != NULL){
	$w = $_GET['w'];
}else{
	$w = 400;
}
$h = $w*(12/10);

if($_GET['char']){
	$char = $_GET['char'];
	$vars = 'char=img/' . $char . '.png';
}else{
	$char = 'matt';
	$vars = '';
}

if($_GET['compare']){
	$compare = true;
}

$charArr = array();
array_push($charArr, 'amidala');
array_push($charArr, 'matt');
array_push($charArr, 'matt2');
array_push($charArr, 'stormtrooper');
array_push($charArr, 'yoda');
?>
<!doctype html>
<html dir="ltr" lang="en-us">
    <head>
        <title>sprite animation preview</title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
		<meta name="viewport" content="width=410"/>
		<meta property="og:title" content="sprite animation preview, by matt!"/>
		<meta property="og:image" content="/images/matt.jpg"/>
		<meta property="og:description" content="a sprite animation preview application, by matt harrison."/>
		<meta property="og:url" content="/games/starwars/preview.php"/>
        <link type="text/css" href="/includes/styles.css" rel="stylesheet"/>
        <link type="image/x-icon" href="/images/icons/matt.ico" rel="icon"/>
        <link type="application/rss+xml" href="/scripts/feed.php" rel="alternate"/>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
		<script type="text/javascript" src="/games/starwars/preview/preview.js"></script>
		<style>
			.player {
				background-color:#0f0;
				background-image:url('/games/starwars/img/<?= $char; ?>.png');
				background-size:<?= $w*10; ?>px <?= $h*5; ?>px;
				width:<?= $w; ?>px;
				height:<?= $h; ?>px;
				image-rendering:crisp-edges;
				image-rendering:-moz-crisp-edges;
				image-rendering:-o-crisp-edges;
				image-rendering:-webkit-optimize-contrast;
				-ms-interpolation-mode: nearest-neighbor;
			}
			.matt {background-image:url('/games/starwars/img/matt.png') !important;}
			.w805 {width:805px;}
		</style>
    </head>
    <body class="m5">
		<div id="animate" class="line mAuto <?= ($compare) ? 'w805' : 'w400'; ?>">
			<div id="player" class="unit mr5 mb5 player"></div>
			<?php if($compare){ ?>
				<div id="compare" class="unit mb5 player matt"></div>
			<?php } ?>
		</div>
        <div class="mAuto w400 bdrLtBrown bdrRound">
			<div class="p10 bgWhite rules">
				<p class="txtC bold">animation test</p>
				<p>arrows keys: run</p>
				<p>shift: hold to view death frame</p>
				<p>spacebar: hold to view saber throw (where applicable)</p>
				<p>click to change BG color.</p>
				<form class="line p10 hide">
					<select name="char" class="unit mr5">
						<?php if(array_search($char, $charArr) === FALSE){ ?>
							<option value="<?= $char; ?>" selected><?= $char; ?></option>
						<?php } ?>
						<?php for($i=0; $i<count($charArr); $i++){ ?>
							<option value="<?= $charArr[$i]; ?>"<?= ($charArr[$i] == $char) ? ' selected' : ''; ?>><?= $charArr[$i]; ?></option>
						<?php } ?>
					</select> 
					<select name="w" class="unit mr5">
						<option value="10"<?= ($w == 10) ? ' selected' : ''; ?>>10x12</option>
						<option value="40"<?= ($w == 40 || empty($w)) ? ' selected' : ''; ?>>40x48</option>
						<option value="400"<?= ($w == 400) ? ' selected' : ''; ?>>400x480</option>
					</select> 
					<input type="submit" value="go." class="unit"/>
				</form>
				<p class="mb0">
					<a href="/games/starwars/preview/?char=<?= $char; ?>">default view</a>
					<span class="mr5 ml5">|</span>
					<a href="/games/starwars/preview/?char=<?= $char; ?>&compare=1">comparison view</a>
				</p>
			</div>
		</div>
    </body>
</html>
