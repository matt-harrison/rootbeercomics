<?php
$title = 'slider puzzle';
$desc  = 'a flash-based recreation of the classic sliding puzzle toy, by matt harrison.';

if($_GET['pic'] != NULL){
	$vars = 'pic=' . $_GET['pic'];
}else{
	$vars = '';
}
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<?php
$iPod   = stripos($_SERVER['HTTP_USER_AGENT'], 'iPod');
$iPhone = stripos($_SERVER['HTTP_USER_AGENT'], 'iPhone');
$iPad   = stripos($_SERVER['HTTP_USER_AGENT'] , 'iPad');
$webOS  = stripos($_SERVER['HTTP_USER_AGENT'], 'webOS');
?>
<?php if($iPod || $iPhone || $iPad || $webOS){ ?>
	<div id="flash" class="mAuto mb5 p10 w800 txtC">
		<p class="fs48">flash is not available on this device.</p>
		<p class="fs48">go sit at a computer.</p>
		<p class="fs48">it's worth it.</p>
	</div>
<?php } else { ?>
	<div id="flash" class="mAuto mb5 txtC">
		<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="https://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="200" height="200" id="slider">
			<param name="allowScriptAccess" value="sameDomain"/>
			<param name="allowFullScreen" value="false"/>
			<param name="movie" value="slider.swf"/>
			<param name="quality" value="high"/>
			<param name="flashVars" value="<?= $vars; ?>"/>
			<embed src="slider.swf" quality="high" width="200" height="200" flashvars="<?= $vars; ?>" name="slider" align="middle" allowscriptaccess="sameDomain" allowfullscreen="false" type="application/x-shockwave-flash" pluginspage="https://www.macromedia.com/go/getflashplayer"/>
		</object>
	</div>
	<div class="mAuto mb5 p10 w500 bgWhite controls">
		<p class="mb5">1. click a tile to slide it into the unoccupied space.</p>
		<p class="mb5">2. click and hold the unoccupied space to preview the solution.</p>
		<p class="mb5">3. customize the puzzle by posting a photo URL below.</p>
		<p class="mb20">objective: solve the puzzle.</p>
		<p class="mb5 bold">url: </p>
		<form action="index.php" method="get" class="line">
			<input type="text" name="pic" value="" class="unit mr10 w200"/>
			<input type="submit" value="Submit" class="unit w100;"/>
		</form>
	</div>
<?php } ?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
