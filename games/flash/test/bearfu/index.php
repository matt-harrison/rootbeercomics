<?php
$title = 'bear fu';
$desc  = 'a flash game by matt harrison based on the NES cartridge "Kung Fu."';
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
		<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="https://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="512" height="448" id="kungfu" align="middle">
			<param name="allowScriptAccess" value="sameDomain" />
			<param name="allowFullScreen" value="false" />
			<param name="movie" value="bearfu.swf" />
			<param name="quality" value="high" />
			<param name="bgcolor" value="#6699cc" />
			<embed src="bearfu.swf" quality="high" bgcolor="#6699cc" width="512" height="448" name="kungfu" align="middle" allowscriptaccess="sameDomain" allowfullscreen="false" type="application/x-shockwave-flash" pluginspage="https://www.macromedia.com/go/getflashplayer"/>
		</object>
	</div>
	<div class="mAuto mb5 p10 w500 bgWhite">
		<p class="mb5">left/right: walk; down: crouch; up:jump</p>
		<p class="mb5">z: punch; x: kick</p>
		<p class="mb5">spacebar: pause/toggle custom color choosers</p>
		<p class="mb5">air attacks do more damage, crouch attacks do less</p>
		<p class="mb5">deflect projectiles with jumpkicks and ground sweeps</p>
		<p class="mb20">objective: fight badguys forever</p>
		<p class="mb0">this is not a real game. play <a href="/games/kungfu/">kung fu*</a></p>
	</div>
<?php } ?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
