<div class="mAuto mb1 p20 w900 bdrBox bgWhite">
	<h2 class="mb10">
		<a href="/projects/pain/index.php?id=<?= $pain['uniqueID']; ?>&records=1"><?= $pain['title']; ?></a>
		<span class="txtGray">by <?= $pain['author']; ?></span>
	</h2>
	<img src="<?= $pain['img']; ?>" alt="<?= $pain['title']; ?>" class="mAuto"/>
	<?php if($pain['tags'] != ''){ ?>
		<p class="line mt5 mAuto mb0 w800 txtR">
			<?php
			if(!is_null($pain['tags'])){
				$tags = $pain['tags'];
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
	<?php if($pain['caption'] != ''){ ?>
		<p class="mt10"><?= $pain['caption']; ?></p>
	<?php } ?>
</div>
<?php if($_COOKIE['username'] == 'matt!' & $records == 1){ ?>
	<div id="edit" class="mAuto mb5 p20 w900 bdrBox bgGray private">
		<div class="line">
			<div class="unit mr5 w100">
				<p class="mb5 txtR label">title:</p>
				<p class="mb5 txtR label">author:</p>
				<p class="mb5 txtR label">date:</p>
				<p class="mb5 txtR label">tags:</p>
				<p class="mb5 txtR label">img:</p>
				<p class="mb5 txtR label">thumb:</p>
				<p class="mb5 txtR label">caption</p>
				<div>
					<?php if($pain['thumb'] != ''){ ?>
						<img src="<?= $pain['thumb']; ?>" class="unitR mb5 dotted"/>
					<?php } else { ?>
						<div class="unitR dotted w100">no thumbnail</div>
					<?php } ?>
				</div>
			</div>
			<form enctype="multipart/form-data" action="/projects/pain/update.php" method="post" target="get.html" class="unitF">
				<input type="hidden" name="uniqueID" value="<?= $pain['uniqueID']; ?>"/>
				<input type="text" name="title" class="mb5 wFull" value="<?= $pain['title']; ?>"/>
				<input type="text" name="author" class="mb5 wFull" value="<?= $pain['author']; ?>"/>
				<input type="text" name="date" class="mb5 wFull" value="<?= $pain['date']; ?>"/>
				<input type="text" name="tags" class="mb5 wFull" value="<?= $pain['tags']; ?>"/>
				<input type="text" name="img" class="mb5 wFull" value="<?= $pain['img']; ?>"/>
				<input type="text" name="thumb" class="mb5 wFull" value="<?= $pain['thumb']; ?>"/>
				<textarea name="caption" class="mb5 wFull h100"><?= $pain['caption']; ?></textarea>
				<input type="submit" value="update"/>
			</form>
		</div>
	</div>
<?php } ?>