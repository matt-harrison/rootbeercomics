<?php
$date = ($post['utime'] != 0) ? date('m.d.y', $post['utime']) : '';

$body = $post['body'];
$body = str_replace('<a href', '<a target="_blank" href', $body);

//parse tag data
if($post['tags'] != NULL){
	$tags = $post['tags'];
	$tagArr = array();
	$lastComma = strrpos($tags, ',');
	if($lastComma+2 >= strlen($tags)){//strip comma (with one space) after last item
		$tags = substr_replace($tags, '', $lastComma);
	}
	if(strpos($tags, ',') != false){
		$nextComma = strpos($tags, ', ');
		for($i=0;$nextComma != false;$i++){
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
<div class="mAuto mb5 p20 bdrBox bgWhite post">
	<h1 class="line mb10">
		<a href="/blog/index.php?id=<?= $post['uniqueID']; ?>&amp;records=1" class="unit"><?= $post['title']; ?></a>
		<span class="unitR txtGray mobile"><?= $date; ?></span>
	</h1>
	<div class="mAuto w800">
		<?= $body; ?>
	</div>
	<p class="mt10 mb0">
		<span>tags: </span>
		<?php for($i=0; $i<sizeof($tagArr); $i++){ ?>
			<?php $tagLink = str_replace(' ', '%20', $tagArr[$i]); ?>
			<a href="/search?tag=<?= $tagLink; ?>"><?= $tagArr[$i]; ?></a><?= ($i != sizeof($tagArr)-1 ? ', ' : ''); ?>
		<?php } ?>
	</p>
</div>
<?php if($_COOKIE['username'] == 'matt!' & $records == 1){ ?>
	<div class="mAuto mb5 p20 w900 bdrBox bgFoam private">
		<div class="line">
			<div class="unit mr5 w100">
				<p class="mb5 txtR label">title:</p>
				<p class="mb5 txtR label">date:</p>
				<p class="mb5 txtR label">tags:</p>
				<p class="mb5 txtR label">thumb:</p>
				<p class="mb5 txtR label">body:</p>
				<div>
					<?php if($post['thumb'] != ''){ ?>
						<img src="<?= $post['thumb']; ?>" class="unitR mb5 dotted"/>
					<?php } else { ?>
						<div class="unitR dotted w100">no thumbnail</div>
					<?php } ?>
				</div>
			</div>
			<form enctype="multipart/form-data" action="update.php" method="post" target="get.html" class="unitF">
				<input type="hidden" name="table" value="blog"/>
				<input type="hidden" name="uniqueID" value="<?= $post['uniqueID']; ?>"/>
				<input type="text" name="title" class="mb5 wFull" value="<?= $post['title']; ?>"/>
				<input type="text" name="date" class="mb5 wFull" value="<?= $post['date']; ?>"/>
				<input type="text" name="tags" class="mb5 wFull" value="<?= $post['tags']; ?>"/>
				<?php if($post['thumb'] != ''){ ?>
					<input type="text" name="thumb" class="mb5 wFull" value="<?= $post['thumb']; ?>"/>
				<?php } else { ?>
					<input type="text" name="thumb" class="mb5 wFull" value="http://www.rootbeercomics.com/blog/thumbs/"/>
				<?php } ?>
				<textarea name="body" class="mb5 wFull" rows="10"><?= $post['body']; ?></textarea>
				<input type="submit" value="update"/>
			</form>


			<?php
			$body  = $post['body'];
			$thumb = $post['thumb'];
			?>
			<?php if (strpos($body, 'http://www.rootbeercomics.com/') || strpos($thumb, 'http://www.rootbeercomics.com/')) { ?>
				<?php
				$body  = str_replace('http://www.rootbeercomics.com/', '/', $body);
				$thumb = str_replace('http://www.rootbeercomics.com/', '/', $thumb);
				?>
				<?php if($body != $imageLinksBody){ ?>
					<form enctype="multipart/form-data" action="update.php" method="post" target="get.html" class="mt50">
						<input type="hidden" name="table" value="blog"/>
						<input type="hidden" name="uniqueID" value="<?= $post['uniqueID']; ?>"/>
						<input type="text" name="thumb" rows="5" value="<?= $thumb; ?>" class="mb5 wFull"/>
						<textarea name="body" class="mb5 wFull" rows="5"><?= $body; ?></textarea>
						<input type="submit" value="fix"/>
					</form>
				<?php } ?>
			<?php } ?>
		</div>
	</div>
<?php } ?>
