<?php
$title = 'star wars';
$desc = 'a flash game based on the "Star Wars" films. developed by matt harrison.';
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
	<div id="flash" class="mAuto mb5 w400 txtC bdrBlack">
		<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="400" height="400" id="sw">
			<param name="allowScriptAccess" value="sameDomain"/>
			<param name="allowFullScreen" value="false"/>
			<param name="movie" value="sw.swf"/>
			<param name="quality" value="high"/>
			<embed src="sw.swf" quality="high" width="400" height="400" name="sw" align="middle" allowscriptaccess="sameDomain" allowfullscreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"/>
		</object>
	</div>
	<div class="mAuto mb5 bdrLtBrown bdrRound p10 w500 bgWhite controls">
		<p class="mb5">1. STORY: play through episode IV as multiple characters.</p>
		<p class="mb5">2. ENDURANCE: Kill as many enemies as possible.</p>
		<p class="mb5">3. EVASION: Survive by avoiding contact.</p>
		<p class="mb20">4. PASSWORD: Guess codes to unlock levels, play secret modes, or be invincible.</p>
		<p class="mb5">arrows: move character<br/>
		<p class="mb5">spacebar: shoot blaster/throw lightsaber</p>
		<p class="mb5">enter: make selection/pause/enter password</p>
		<p class="mb20">escape: quit game.</p>
		<p class="mb5">use the arrow keys to control the lightsaber in flight.</p>
		<p class="mb5">guide the lightsaber back to the character to resume movement.</p>
		<p class="mb5">-----</p>
		<p class="mb0">objective: never give up.                    
	</div>
	<div class="mAuto mb5 bdrLtBrown bdrRound p10 w500 bgWhite controls">
		<p class="mb20">UPDATE: 2011-12-29</p>
		<p class="mb5">1. rebuilt smoother left and right running animations for each character.</p>
		<p class="mb5">2. enabled jedi/sith saber throw in all 4 directions.</p>
		<p class="mb5">3. laid UI groundwork for levels for other episodes.</p>
		<p class="mb0">4. added playable characters in preparation for future levels.</p>
		</p>
	</div>
<?php } ?> 
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>