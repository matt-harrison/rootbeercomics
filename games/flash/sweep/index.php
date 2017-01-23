<?php
$title = 'minesweeper';
$desc = 'a flash-based rebuild of the classic computer game, "Minesweeper." developed by matt harrison.';

if($_GET['b'] != NULL){
	$b = $_GET['b'];
}else{
	$b = 20;
}
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<?php
$iPod = stripos($_SERVER['HTTP_USER_AGENT'], 'iPod');
$iPhone = stripos($_SERVER['HTTP_USER_AGENT'], 'iPhone');
$iPad = stripos($_SERVER['HTTP_USER_AGENT'] , 'iPad');
$webOS = stripos($_SERVER['HTTP_USER_AGENT'], 'webOS');
?>
<?php if($iPod || $iPhone || $iPad || $webOS){ ?>
	<div id="flash" class="mAuto mb5 bdrLtBrown bdrRound p10 w800 txtC">
		<p class="fs48">flash is not available on this device.</p>
		<p class="fs48">go sit at a computer.</p>
		<p class="fs48">it's worth it.</p>
	</div>
<?php } else { ?>
	<div id="flash" class="mAuto mb5 txtC">
		<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="321" height="321" id="mineplay" align="middle">
			<param name="allowScriptAccess" value="sameDomain"/>
			<param name="allowFullScreen" value="false"/>
			<param name="movie" value="mineplay.swf?bombCount=<?= $b; ?>"/>
			<param name="quality" value="high"/>
			<param name="bgcolor" value="#ffffff"/>
			<embed src="mineplay.swf?bombCount=<?= $b; ?>" quality="high" bgcolor="#ffffff" width="321" height="321" name="mineplay" align="middle" allowscriptaccess="sameDomain" allowfullscreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"/>
		</object>
	</div>
	<div class="mAuto mb5 bdrLtBrown bdrRound p10 w500 bgWhite controls">
		<p class="mb5">click to reveal box</p>
		<p class="mb5">SPACE + click to flag</p>
		<p class="mb20">ENTER to generate new game</p>
		<p class="mb0">objective: you've never played minesweeper before?</p>
	</div>
<?php } ?> 
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>