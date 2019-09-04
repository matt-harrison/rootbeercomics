<?php
$desc  = 'a flash game by matt harrison, based on the popular board game.';
$title = 'mancala';
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
		<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="420" height="120" id="mancala" align="middle">
			<param name="allowScriptAccess" value="sameDomain"/>
			<param name="allowFullScreen" value="false"/>
			<param name="movie" value="mancala.swf"/>
			<param name="quality" value="high"/>
			<param name="bgcolor" value="#ffffff"/>
			<embed src="mancala.swf" quality="high" bgcolor="#ffffff" width="420" height="120" name="mancala" align="middle" allowscriptaccess="sameDomain" allowfullscreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"/>
		</object>
	</div>
	<div class="mAuto mb5 p10 w500 bgWhite">
		<p class="mb5">P1: click a bowl along the bottom edge to distribute beads counter-clockwise, scores in goal at right</p>
		<p class="mb5">P2: click a bowl along the top edge to distribute beads counter-clockwise, scores in goal at left</p>
		<p class="mb5">last bead into empty bowl steals beads from across board</p>
		<p class="mb5">all beads in player's side go to same goal when opposite side is empty</p>
		<p class="mb20">click the red button to start a new game</p>
		<p class="mb0">objective: finish with more beads in your goal</p>
	</div>
<?php } ?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
