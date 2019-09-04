<?php
$title = 'decay';
$desc  = 'a flash experiment by matt harrison.';
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
		<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="350" height="350" id="decay" align="middle">
			<param name="allowScriptAccess" value="sameDomain"/>
			<param name="allowFullScreen" value="false"/>
			<param name="movie" value="decay.swf"/>
			<param name="quality" value="high"/>
			<param name="bgcolor" value="#ffffff"/>
			<embed src="decay.swf" quality="high" bgcolor="#ffffff" width="350" height="350" name="decay" align="middle" allowscriptaccess="sameDomain" allowfullscreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"/>
		</object>
	</div>
	<div class="mAuto mb5 p10 w500 bgWhite">
		<p class="mb5">overlap your shield (outer circle) with enemy cores (inner circles) to attack</p>
		<p class="mb5">when shields are fully depleted, you die</p>
		<p class="mb5">enemy shields deplete at the same rate</p>
		<p class="mb5">shields:</p>
		<p class="mb5 ml10">green: at 100%</p>
		<p class="mb5 ml10">orange: actively regenerating</p>
		<p class="mb5 ml10">red: actively depleting</p>
		<p class="mb0">objective: survive, get kills</p>
	</div>
<?php } ?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
