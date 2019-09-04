<?php
$title = 'snake(s)';
$desc  = 'a flash-based rebuild of the classic mobile game "Snake," by matt harrison.';
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
		<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="320" height="260" id="snakes" align="middle">
			<param name="allowScriptAccess" value="sameDomain"/>
			<param name="allowFullScreen" value="false"/>
			<param name="movie" value="snakes.swf"/>
			<param name="quality" value="high"/>
			<param name="scale" value="noscale"/>
			<param name="salign" value="lt"/>
			<embed src="snakes.swf" quality="high" scale="noscale" salign="lt" width="320" height="260" name="snakes" align="middle" allowscriptaccess="sameDomain" allowfullscreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"/>
		</object>
	</div>
<?php } ?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
