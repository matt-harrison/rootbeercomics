<?php
$title = 'games';
$desc = 'flash and javascript games, developed by matt harrison.';
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="line mAuto w1000">
	<div class="unit mr10 w500 bdrBox">
		<div onclick="location.href='/games/flash/berrics/';" class="line mAuto mb10 bgWhite csrPointer gameLink">
			<div class="unit p10">
				<img src="/games/thumbs/berrics.jpg"/>
			</div>
			<div class="unitF p10">
				<span class="dBlock full right txtGray">updated 10.21.10</span>
				<span class="dBlock full fs24 txtDkBlue">the berrics</span>
				<span class="dBlock">the most comprehensive skateboarding game on the web.</span>
			</div>
		</div>
		<div onclick="location.href='/games/flash/kungfu/';" class="line mAuto mb10 bgWhite csrPointer gameLink">
			<div class="unit p10">
				<img src="/games/thumbs/kungfu.jpg"/>
			</div>
			<div class="unitF p10">
				<span class="dBlock full right txtGray">updated 08.04.10</span>
				<span class="dBlock full fs24 txtDkBlue">kung fu remix</span>
				<span class="dBlock">customize the sprites. play continuously.</span>
			</div>
		</div>
		<div onclick="location.href='/games/flash/pilots/';"  class="line mAuto mb10 bgWhite csrPointer gameLink">
			<div class="unit p10">
				<img src="/games/thumbs/pilots.jpg"/>
			</div>
			<div class="unitF p10">
				<span class="dBlock full right txtGray">updated 02.09.11</span><br/>
				<span class="dBlock full fs24 txtDkBlue">pilots (asteroids remix)</span>
				<span class="dBlock">fly, land, eject, explore.</span>
			</div>
		</div>
		<div onclick="location.href='/games/flash/tecmo/';"  class="line mAuto mb10 bgWhite csrPointer gameLink">
			<div class="unit p10">
				<img src="/games/thumbs/tecmo.jpg"/>
			</div>
			<div class="unitF p10">
				<span class="dBlock full right txtGray">updated 01.18.11</span>
				<span class="dBlock full fs24 txtDkBlue">tic-tec-mo</span>
				<span class="dBlock">play a full NFL season with tic-tac-toe.</span>
			</div>
		</div>
		<div onclick="location.href='/games/flash/bearpursuit/';"  class="line mAuto mb10 bgWhite csrPointer gameLink">
			<div class="unit p10">
				<img src="/games/thumbs/bearpursuit.jpg"/>
			</div>
			<div class="unitF p10">
				<span class="dBlock full right txtGray">posted 11.17.08</span>
				<span class="dBlock full fs24 txtDkBlue">bear pursuit (with andy helms)</span>
				<span class="dBlock">visceral combat.</span>
			</div>
		</div>
		<div onclick="location.href='/games/flash/fortfisher/';"  class="line mAuto mb10 bgWhite csrPointer gameLink">
			<div class="unit p10">
				<img src="/games/thumbs/fortfisher.jpg"/>
			</div>
			<div class="unitF p10">
				<span class="dBlock full right txtGray">posted 04.14.11</span>
				<span class="dBlock full fs24 txtDkBlue">fort fisher: based on a true story</span>
				<span class="dBlock">the war of pixel aggression</span>
			</div>
		</div>
	</div>
	<div class="unit w490 bdrBox">
		<?php/*
		<div onclick="location.href='/games/flash/starwars/';"  class="line mAuto mb10 bgWhite csrPointer gameLink">
			<div class="unit p10">
				<img src="/games/thumbs/starwars.jpg"/>
			</div>
			<div class="unitF p10">
				<span class="dBlock full right txtGray">posted 10.23.11</span>
				<span class="dBlock full fs24 txtDkBlue">star wars</span>
				<span class="dBlock">definitely not endorsed by lucasfilm</span>
			</div>
		</div>
		*/
		?>
		<div onclick="location.href='/games/flash/snake/';"  class="line mAuto mb10 bgWhite csrPointer gameLink">
			<div class="unit p10">
				<img src="/games/thumbs/snakes.jpg"/>
			</div>
			<div class="unitF p10">
				<span class="dBlock full right txtGray">updated 04.22.09</span>
				<span class="dBlock full fs24 txtDkBlue">snake(s)</span>
				<span class="dBlock">play classic or boss mode.</span>
			</div>
		</div>
		<div onclick="location.href='/games/flash/sweep/';"  class="line mAuto mb10 bgWhite csrPointer gameLink">
			<div class="unit p10">
				<img src="/games/thumbs/sweep.jpg"/>
			</div>
			<div class="unitF p10">
				<span class="dBlock full right txtGray">updated 12.22.10</span>
				<span class="dBlock txtDkBlue fs24">minesweeper</span>
				<span class="dBlock">start > all programs > accessories > games</span>
			</div>
		</div>
		<div onclick="location.href='/games/flash/decay/';"  class="line mAuto mb10 bgWhite csrPointer gameLink">
			<div class="unit p10">
				<img src="/games/thumbs/decay.jpg"/>
			</div>
			<div class="unitF p10">
				<span class="dBlock full right txtGray">updated 02.15.07</span>
				<span class="dBlock full fs24 txtDkBlue">decay</span>
				<span class="dBlock">deplete enemy shields and protect your own.</span>
			</div>
		</div>
		<div onclick="location.href='/games/flash/cards/';"  class="line mAuto mb10 bgWhite csrPointer gameLink">
			<div class="unit p10">
				<img src="/games/thumbs/cards.jpg"/>
			</div>
			<div class="unitF p10">
				<span class="dBlock full right txtGray">updated 11.17.08</span>
				<span class="dBlock full fs24 txtDkBlue">cards</span>
				<span class="dBlock">no game, no rules. just a digital deck.</span>
			</div>
		</div>
		<div onclick="location.href='/games/flash/mancala/';"  class="line mAuto mb10 bgWhite csrPointer gameLink">
			<div class="unit p10">
				<img src="/games/thumbs/mancala.jpg"/>
			</div>
			<div class="unitF p10">
				<span class="dBlock full right txtGray">updated 07.24.09</span>
				<span class="dBlock full fs24 txtDkBlue">mancala</span><br/>
				<span class="dBlock">standard rules</span>
			</div>
		</div>
	</div>
</div>
<?php if($_COOKIE['username'] == 'matt!'){ ?>
	<div class="mAuto w1000 mb10 p10 bdrBox bgFoam private">
		<p class="sep bold">experiments</p>
		<p class="mb5"><a href="/games/flash/beach/">beach</a></p>
		<p class="mb5"><a href="/games/flash/bearfu/">bear fu</a></p>
		<p class="mb5"><a href="/games/flash/dd/">dungeons and dragons</a></p>
		<p class="mb5"><a href="/games/flash/mattris/">mattris</a></p>
		<p class="mb5"><a href="/games/flash/pacman/">pacman</a></p>
		<p class="mb5"><a href="/games/flash/platform/">platform</a></p>
		<p class="mb5"><a href="/games/flash/slider/">slide puzzle</a></p>
		<p class="mb5"><a href="/games/flash/spriteboard/">spriteboard</a></p>
		<p class="mb5"><a href="/games/flash/tic/">tic-tac-toe</a></p>
		<p>- - - - -</p>
		<p class="mb0"><a href="/games/flash/js/">JS progress</a></p>
	</div>
<?php } ?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>