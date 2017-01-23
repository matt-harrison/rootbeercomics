<?php
$title = 'bear pursuit';
$desc = 'a flash game by matt harrison, based on pixel art by andy helms.';
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
		<p class="t48">flash is not available on this device.</p>
		<p class="t48">go sit at a computer.</p>
		<p class="t48">it's worth it.</p>
	</div>
<?php } else { ?>
	<div id="flash" class="mAuto mb5 txtC">
	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="500" height="500" id="bearPursuit" align="middle">
		<param name="allowScriptAccess" value="sameDomain"/>
		<param name="allowFullScreen" value="false"/>
		<param name="movie" value="bearPursuit.swf"/>
		<param name="quality" value="high"/>
		<param name="bgcolor" value="#ffffff"/>
		<embed src="bearPursuit.swf" quality="high" bgcolor="#ffffff" width="500" height="500" name="bearPursuit" align="middle" allowscriptaccess="sameDomain" allowfullscreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"/>
	</object>
	</div>
	<div class="mAuto mb5 bdrLtBrown bdrRound p10 w500 bgWhite">
		<p class="mb5">based on pixel art by <a href="http://oktotally.tumblr.com/post/4509053686/o-visceral-combat-o-high-stakes-lumber-jacking-o" target="_blank">andy helms</a>
		<p class="mb5">enter/spacebar: start game</p>
		<p class="mb5">arrow keys: move lumberjack</p>
		<p class="mb5">hey, look out for that bear!</p>
		<p class="mb5">get the pancakes to summon bearfighting strength.</p>
		<p class="mb0">objective: visceral combat.</p>
	</div>
<?php } ?> 
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>