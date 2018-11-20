<?php
$id     = $post['id'];
$images = explode(',', $post['images']);
?>
<div class="mAuto mb5 p20 bdrBox bgWhite post">
	<p class="mAuto mb5 w800 txtR fs12">
		<a href="/blog/index.php?id=<?= $id; ?>&records=1" class="txtGray">permalink</a>
	</p>
	<?php foreach ($images as $key => $image) { ?>
		<img src="<?= $image; ?>" alt="<?= $key; ?>" class="mAuto dotted<?= ($key < count($images) - 1) ? ' mb10' : ''; ?>"/>
	<?php } ?>
</div>
<?php if ($_COOKIE['username'] == 'matt!' & $records == 1) { ?>
	<div class="mAuto mb5 p20 w900 bdrBox bgFoam private">
		<div class="line">
			<div class="unit mr5 w100">
				<p class="mb5 txtR label">title:</p>
				<p class="mb5 txtR label">date:</p>
				<p class="mb5 txtR label">tags:</p>
				<p class="mb5 txtR label">thumb:</p>
				<p class="mb5 txtR label">body:</p>
				<div>
					<?php if ($post['thumb'] != '') { ?>
						<img src="<?= $post['thumb']; ?>" class="unitR mb5 dotted"/>
					<?php } else { ?>
						<div class="unitR dotted w100">no thumbnail</div>
					<?php } ?>
				</div>
			</div>
			<form enctype="multipart/form-data" action="update.php" method="post" target="get.html" class="unitF">
				<input type="hidden" name="table" value="blog"/>
				<input type="hidden" name="$id" value="<?= $post['$id']; ?>"/>
				<input type="text" name="title" class="mb5 wFull" value="<?= $post['title']; ?>"/>
				<input type="text" name="date" class="mb5 wFull" value="<?= $post['date']; ?>"/>
				<?php if ($post['thumb'] != '') { ?>
					<input type="text" name="thumb" class="mb5 wFull" value="<?= $post['thumb']; ?>"/>
				<?php } else { ?>
					<input type="text" name="thumb" class="mb5 wFull" value="http://www.rootbeercomics.com/blog/thumbs/"/>
				<?php } ?>
				<input type="text" name="caption" class="mb5 wFull" value="<?= $post['caption']; ?>"/>
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
				<?php if ($body != $imageLinksBody) { ?>
					<form enctype="multipart/form-data" action="update.php" method="post" target="get.html" class="mt50">
						<input type="hidden" name="table" value="blog"/>
						<input type="hidden" name="$id" value="<?= $post['$id']; ?>"/>
						<input type="text" name="thumb" rows="5" value="<?= $thumb; ?>" class="mb5 wFull"/>
						<input type="text" name="caption" rows="5" value="<?= $post['caption']; ?>" class="mb5 wFull"/>
						<textarea name="body" class="mb5 wFull" rows="5"><?= $body; ?></textarea>
						<input type="submit" value="fix"/>
					</form>
				<?php } ?>
			<?php } ?>
		</div>
	</div>
<?php } ?>
