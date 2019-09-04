<?php
$title = 'fort fisher';
$desc  = 'a flash game by matt harrison, based on the famous civil war battle in wilmington, NC.';
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
		<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="800" height="600" id="fish">
			<param name="allowScriptAccess" value="sameDomain"/>
			<param name="allowFullScreen" value="false"/>
			<param name="movie" value="fish.swf"/>
			<param name="quality" value="high"/>
			<param name="bgcolor" value="#0000ff"/>
			<embed src="fish.swf" quality="high" bgcolor="#0000ff" width="800" height="600" name="fish" align="middle" allowscriptaccess="sameDomain" allowfullscreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"/>
		</object>
	</div>
	<div class="mAuto mb5 p10 w500 bgWhite">
		<p class="mb5">enter: quickstart/pause</p>
		<p class="mb5">arrow keys: move soldier</p>
		<p class="mb20">spacebar: shoot</p>
		<p class="mb5">use NORTH or SOUTH button to choose a side.</p>
		<p class="mb5">musket takes a moment to reload between shots.</p>
		<p class="mb20">enemy flow increases with each kill.</p>
		<p class="mb0">objective: defend hill by killing enemies.</p>
	</div>
<?php } ?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
