<?php
$title = '';
$desc = 'a flash-based prototype for a game based on the arcade classic "Asteroids," by matt harrison.';
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
		<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="500" height="450" id="pilots5" align="middle">
			<param name="allowScriptAccess" value="sameDomain" />
			<param name="allowFullScreen" value="false" />
			<param name="movie" value="pilots5.swf" />
			<param name="quality" value="high" />
			<embed src="pilots5.swf" quality="high" width="500" height="450" name="pilots5" align="middle" allowscriptaccess="sameDomain" allowfullscreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
		</object>
	</div>
	<div class="mAuto mb5 bdrLtBrown bdrRound p10 w1000 bdrBox bgWhite">
		<div class="line mb20">
			<div class="unit size1of3">
				<p class="mb5">in ship:</p>
				<p class="mb5 ml10">up: thrusters</p>
				<p class="mb5 ml10">left/right: turn</p>
				<p class="mb5 ml10">spacebar: shoot</p>
				<p class="mb5 ml10">D: detonate</p>
				<p class="mb0 ml10">E: eject</p>
			</div>
			<div class="unit size1of3">
				<p class="mb5">on foot:</p>
				<p class="mb5 ml10">up: board vehicle</p>
				<p class="mb5 ml10">left/right: run</p>
				<p class="mb5 ml10">spacebar: shoot</p>
				<p class="mb5 ml10">D: remote detonate vehicle</p>
				<p class="mb0 ml10">F: self-destruct</p>
			</div>
			<div class="unit size1of3">
				<p class="mb5">in rover:</p>
				<p class="mb5 ml10">left/right: drive</p>
				<p class="mb5 ml10">down: breaks</p>
				<p class="mb5 ml10">E: eject</p>
				<p class="mb0 ml10">D: detonate</p>
			</div>
		</div>
		<p class="mb5">objective: fly around, kill bad guys, goof off.</p>
	</div>
<?php } ?> 
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>