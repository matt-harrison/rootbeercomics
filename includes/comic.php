<?php
if ($comic['tags'] != NULL) {
	$tags = $comic['tags'];
	$tagArr = array();
	$lastComma = strrpos($tags, ',');
	if ($lastComma+2 >= strlen($tags)) {
		$tags = substr_replace($tags, '', $lastComma);
	}
	if (strpos($tags, ',') != false) {
		$nextComma = strpos($tags, ', ');
		for ($i=0; $nextComma != false; $i++) {
			$nextTag = substr($tags, 0, $nextComma);
			$tags = substr($tags, $nextComma);
			$tags = substr($tags, 2);
			array_push($tagArr, $nextTag);
			$nextComma = strpos($tags, ', ');
		}
		$tags = str_replace(', ', '', $tags);
		array_push($tagArr, $tags);
	} else {
		array_push($tagArr, $tags);
	}
}
?>
<?php if ($comic['diff'] >= 0 || $comic['uniqueID'] == $page) { ?>
	<div class="mAuto mb5 p20 bdrBox bgWhite">
		<h1 class="line mb10">
			<a href="/comics/index.php?id=<?= $comic['uniqueID']; ?>&records=1" class="unit mr10"><?= $comic['title']; ?></a>
			<span class="unit txtGray mobile">by <?= $comic['author']; ?></span>
			<?php
			if ($comic['utime'] != 0) {
				$date = date('m.d.y', $comic['utime']);
			} else {
				$date = 'undated';
			}
			?>
			<span class="unitR txtGray mobile"><?= $date; ?></span>
		</h1>
		<?php if ($comic['bw'] != '') { ?>
			<?php if ($comic['color'] != '') { ?>
				<img src="<?= $comic['bw']; ?>" id="bw<?= $comic['uniqueID']; ?>" onclick="toggle(<?= $comic['uniqueID']; ?>, 'color');" alt="<?= $comic['title']; ?>" class="mAuto mb10 csrPointer hide"/>
			<?php } else { ?>
				<img src="<?= $comic['bw']; ?>" alt="<?= $comic['title']; ?>" class="mAuto mb10"/>
			<?php } ?>
		<?php } ?>
		<?php if ($comic['color'] != '') { ?>
			<?php if ($comic['bw'] != '') { ?>
				<img src="<?= $comic['color']; ?>" id="color<?= $comic['uniqueID']; ?>" onclick="toggle(<?= $comic['uniqueID']; ?>, 'bw');" alt="<?= $comic['title']; ?>" class="mAuto mb10 csrPointer"/>
			<?php } else { ?>
				<img src="<?= $comic['color']; ?>" alt="<?= $comic['title']; ?>" class="mAuto mb10"/>
			<?php } ?>
		<?php } ?>
		<?php if ($comic['body'] != '') { ?>
			<p><?= $comic['body']; ?></p>
		<?php } ?>
		<p class="line mt10">
			<?php if ($comic['colorLink'] != '' || ($comic['bw'] != '' && $comic['color'] != '')) { ?>
				<span class="unit size1of2 hideOnMobile">
					<?php if ($comic['colorLink'] != '') { ?>
						<a href="<?= $comic['colorLink']; ?>" target="_blank" class="mt10">view full size</a>
					<?php } ?>
					<?php if ($comic['bw'] != '' && $comic['colorLink'] != '') { ?>
						<span> | </span>
					<?php } ?>
					<?php if ($comic['bw'] != '' && $comic['color'] != '') { ?>
						<a id="bwLink<?= $comic['uniqueID']; ?>" href="javascript:toggle(<?= $comic['uniqueID']; ?>, 'bw');">view original</a>
						<a id="colorLink<?= $comic['uniqueID']; ?>" href="javascript:toggle(<?= $comic['uniqueID']; ?>, 'color');" class="hide">view final</a>
					<?php } ?>
				</span>
			<?php } ?>
			<?php if (sizeof($tagArr) > 0) { ?>
				<span class="unitR size1of2 txtR tags">
					<span>tags: </span>
					<?php for ($i=0; $i<sizeof($tagArr); $i++) { ?>
						<?php $tagLink = str_replace(' ', '%20', $tagArr[$i]); ?>
						<a href="/search?tag=<?= $tagLink; ?>"><?= $tagArr[$i]; ?></a><?= ($i != sizeof($tagArr)-1) ? ', ' : ''; ?>
					<?php } ?>
				</span>
			<?php } ?>
		</p>
	</div>
<?php } ?>
<?php if ($_COOKIE['username'] == 'matt!' & $records == 1) { ?>
	<div id="edit" class="mAuto mb5 w900 p20 bdrBox bgFoam private">
		<div class="line">
			<div class="unit mr5 w150">
				<p class="mb5 txtR label">title:</p>
				<p class="mb5 txtR label">author:</p>
				<p class="mb5 txtR label">date:</p>
				<p class="mb5 txtR label">tags:</p>
				<p class="mb5 txtR label">color:</p>
				<p class="mb5 txtR label">bw:</p>
				<p class="mb5 txtR label">color link:</p>
				<p class="mb5 txtR label">bw link:</p>
				<p class="mb5 txtR label">thumb:</p>
				<p class="mb5 txtR label">caption:</p>
				<p class="mb5 txtR label">body:</p>
				<div>
					<?php if ($comic['thumb'] != '') { ?>
						<img src="<?= $comic['thumb']; ?>" class="unitR mb5 dotted"/>
					<?php } else { ?>
						<div class="unitR dotted w100">no thumbnail</div>
					<?php } ?>
				</div>
			</div>
			<form enctype="multipart/form-data" action="/comics/update.php" method="post" target="get.html" class="unitF">
				<input type="hidden" name="uniqueID" value="<?= $comic['uniqueID']; ?>"/>
				<input type="text" name="title" class="mb5 wFull" value="<?= $comic['title']; ?>"/>
				<input type="text" name="author" class="mb5 wFull" value="<?= $comic['author']; ?>"/>
				<input type="text" name="date" class="mb5 wFull" value="<?= $comic['date']; ?>"/>
				<input type="text" name="tags" class="mb5 wFull" value="<?= $comic['tags']; ?>"/>
				<input type="text" name="color" class="mb5 wFull" value="<?= $comic['color']; ?>"/>
				<input type="text" name="bw" class="mb5 wFull" value="<?= $comic['bw']; ?>"/>
				<input type="text" name="colorLink" class="mb5 wFull" value="<?= $comic['colorLink']; ?>"/>
				<input type="text" name="bwLink" class="mb5 wFull" value="<?= $comic['bwLink']; ?>"/>
				<input type="text" name="thumb" class="mb5 wFull" value="<?= $comic['thumb']; ?>"/>
				<input type="text" name="caption" class="mb5 wFull" value="<?= $comic['caption']; ?>"/>
				<textarea name="body" class="mb5 wFull h100"><?= $comic['body']; ?></textarea>
				<input type="submit" value="update"/>
			</form>
		</div>
	</div>
<?php } ?>
