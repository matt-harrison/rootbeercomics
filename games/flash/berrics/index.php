<?php
$title = 'the berrics';
$desc = 'a flash skateboarding game by matt harrison, based on theberrics.com.';
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<?php
$iPod = stripos($_SERVER['HTTP_USER_AGENT'], 'iPod');
$iPhone = stripos($_SERVER['HTTP_USER_AGENT'], 'iPhone');
$iPad = stripos($_SERVER['HTTP_USER_AGENT'] , 'iPad');
$webOS = stripos($_SERVER['HTTP_USER_AGENT'], 'webOS');
?>
<?php if($iPod || $iPhone || $iPad || $webOS){ ?>
	<div id="flash" class="mAuto mb5 p10 w800 txtC">
		<p class="fs48">flash is not available on this device.</p>
		<p class="fs48">go sit at a computer.</p>
		<p class="fs48">it's worth it.</p>
	</div>
<?php } else { ?>
	<div id="flash" class="mAuto mb5 txtC">
		<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="580" height="500" id="berrics" align="middle">
			<param name="allowScriptAccess" value="sameDomain" />
			<param name="allowFullScreen" value="false" />
			<param name="movie" value="berrics.swf" />
			<param name="quality" value="high" />
			<param name="bgcolor" value="#ffffff" />
			<embed src="berrics.swf" quality="high" bgcolor="#ffffff" width="580" height="500" name="berrics" align="middle" allowscriptaccess="sameDomain" allowfullscreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
		</object>
	</div>
	<div class="mAuto mb5 p10 w500 bgWhite">
		<p class="mb5">use left/right arrows on the ground to change direction or gain speed</p>
		<p class="mb5">hold spacebar to charge ollie, release to snap</p>
		<p class="mb5">use up/down arrows in the air to do fliptricks</p>
		<p class="mb5">use left/right arrows in the air to land in a grind or a manual</p>
		<p class="mb5">more fliptricks and grinds described in "controls" menu</p>
		<p class="mb0">objective: just skate.</p>
	</div>
<?php } ?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
