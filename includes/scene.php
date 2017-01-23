<div class="mb5 bdrLtBrown p20 bgWhite">
	<div class="mAuto w800">
		<h2 class="mb10">
			<a href="/projects/burgg/index.php?id=<?= $scene['uniqueID']; ?>&records=1"><?= $scene['title']; ?></a>
			<span class="txtGray">by <?= $scene['author']; ?></span>
		</h2>
		<div class="scene">
			<img src="<?= $scene['img']; ?>" id="scene<?= $scene['uniqueID']; ?>" alt="<?= $scene['title']; ?>" class="mAuto mb5 csrPointer answerLink"/>
			<div class="mAuto w500 csrPointer answerBox">
				<p class="mb0 bdrGray p10 bgGray answerPrompt">reveal movie title?</p>
				<p class="mb0 bdrRed p10 bgPink answer hide"><?= $scene['caption']; ?></p>
			</div>
		</div>
		<?php if($scene['tags'] != ''){ ?>
			<p class="line mt5 mAuto mb0 w500 txtR">
				<?php
				if($scene['tags'] != NULL){
					$tags = $scene['tags'];
					$tagArr = array();
					$lastComma = strrpos($tags, ',');
					if($lastComma+2 >= strlen($tags)){
						$tags = substr_replace($tags, '', $lastComma);
					}
					if(strpos($tags, ',') != false){
						$nextComma = strpos($tags, ', ');
						for($i=0; $nextComma != false; $i++){
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
				<?php if(sizeof($tagArr) > 0){ ?>
					<span>tags: </span>
					<?php for($i=0;$i<sizeof($tagArr);$i++){ ?>
						<?php $tagLink = str_replace(' ', '%20', $tagArr[$i]); ?>
						<a href="/search?tag=<?= $tagLink; ?>"><?= $tagArr[$i]; ?></a><?= ($i != sizeof($tagArr)-1) ? ', ' : ''; ?>
					<?php } ?>
				<?php } ?>
			</p>
		<?php } ?>
	</div>
</div>
<?php if($_COOKIE['username'] == 'matt!' & $records == 1){ ?>
	<div id="edit" class="mb5 p20 bgGray private">
		<div class="line">
			<div class="unit mr5 w100">
				<p class="mb5 txtR label">title:</p>
				<p class="mb5 txtR label">author:</p>
				<p class="mb5 txtR label">date:</p>
				<p class="mb5 txtR label">tags:</p>
				<p class="mb5 txtR label">img:</p>
				<p class="mb5 txtR label">thumb:</p>
				<p class="mb5 txtR label">answer</p>
				<div>
					<?php if($scene['thumb'] != ''){ ?>
						<img src="<?= $scene['thumb']; ?>" class="unitR mb5 dotted"/>
					<?php } else { ?>
						<div class="unitR dotted w100">no thumbnail</div>
					<?php } ?>
				</div>
			</div>
			<form enctype="multipart/form-data" action="/projects/burgg/update.php" method="post" target="get.html" class="unitF">
				<input type="hidden" name="uniqueID" value="<?= $scene['uniqueID']; ?>"/>
				<input type="text" name="title" class="mb5 wFull" value="<?= $scene['title']; ?>"/>
				<input type="text" name="author" class="mb5 wFull" value="<?= $scene['author']; ?>"/>
				<input type="text" name="date" class="mb5 wFull" value="<?= $scene['date']; ?>"/>
				<input type="text" name="tags" class="mb5 wFull" value="<?= $scene['tags']; ?>"/>
				<input type="text" name="img" class="mb5 wFull" value="<?= $scene['img']; ?>"/>
				<input type="text" name="thumb" class="mb5 wFull" value="<?= $scene['thumb']; ?>"/>
				<input type="text" name="caption" class="mb5 wFull" value="<?= $scene['caption']; ?>"/>
				<input type="submit" value="update"/>
			</form>
		</div>
	</div>
<?php } ?>