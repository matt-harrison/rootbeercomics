<?php
$title = 'the anarchynerd pixel art archive';
$desc = 'an archive of the defunct website anarchynerd, by matt harrison.';

$con = mysql_connect('localhost', 'kittenb1_matt', 'uncannyx0545');
mysql_select_db('kittenb1_nerd', $con);
$animations = mysql_query("SELECT * FROM mattman", $con);
$animationCount = mysql_num_rows($animations);

if($_GET['id'] != NULL){
	$page = $_GET['id'];
}else{
	$page = 1;
}

if(isset($_GET['zoom'])){
	$zoom = $_GET['zoom'];
} else {
	$zoom = 8;
}

$records = 1;
$lastPage = $page-$records+1;
$rowCount = $animationCount;

$iPod = stripos($_SERVER['HTTP_USER_AGENT'], 'iPod');
$iPhone = stripos($_SERVER['HTTP_USER_AGENT'], 'iPhone');
$iPad = stripos($_SERVER['HTTP_USER_AGENT'] , 'iPad');
$webOS = stripos($_SERVER['HTTP_USER_AGENT'], 'webOS');
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="line mAuto w1000">
	<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php'); ?>
	<?php $animations = mysql_query("SELECT * FROM mattman WHERE uniqueID='$page' ORDER BY uniqueID ASC", $con); ?>
	<?php while($animation = mysql_fetch_array($animations)){ ?>
		<div class="mAuto mb1 p20 bdrBox bgWhite">
			<div class="mAuto w800 noSelect">
				<div class="line mb10">
					<h2 class="unit mr5 mb0 bold">
						<a href="index.php?id=<?= $animation['uniqueID']; ?>"><?= $animation['title']; ?></a>
					</h2>
					<p class="unitR">
						<a href="index.php?id=<?= $page; ?>&zoom=1" class="mr5">small</a>
						<a href="index.php?id=<?= $page; ?>&zoom=4" class="mr5">medium</a>
						<a href="index.php?id=<?= $page; ?>&zoom=8">large</a>
					</p>
				</div>
				<div>
					<?php
					if($animation['width'] != NULL){
						if($animation['width'] >= 120){
							$embedW = $_GET['w'];
						}else{
							$embedW = 120;
						}
					}else{
						$embedW = 120;
					}
					if($animation['height'] != NULL){
						$embedH = $animation['height']+20;
					}else{
						$embedH = 120;
					}
					if($_GET['zoom'] != NULL){
						$embedW *= $_GET['zoom'];
						$embedH *= $_GET['zoom'];
					}else{
						$embedW *= 4;
						$embedH *= 4;
					}
					?>
					<?php if($iPod || $iPhone || $iPad || $webOS){ ?>
						<img src="<?= $animation['gif']; ?>" alt="" class="mAuto mb5"/>
					<?php } else { ?>
						<div class="mAuto txtC">
							<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="' . $embedW . '" height="' . $embedH . '" id="anim" align="middle">
								<param name="allowScriptAccess" value="sameDomain"/>
								<param name="allowFullScreen" value="false"/>
								<param name="movie" value="/projects/nerd/mattman/flash/anim.swf?url=<?= $animation['url']; ?>"/>
								<param name="quality" value="high"/>
								<embed src="/projects/nerd//flash/anim.swf?url=<?= $animation['url']; ?>" quality="high" width="<?= $embedW; ?>" height="<?= $embedH; ?>" name="anim" align="middle" allowscriptaccess="sameDomain" allowfullscreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"/>
							</object>
						</div>
					<?php } ?>
				</div>
				<div class="mAuto pt5 w500"><?= $animation['caption']; ?></div>
			</div>
		</div>
		<?php if($_COOKIE['username'] == 'matt!' & $records == 1){ ?>
			<?php $title = $animation['title']; ?>
			<div class="mAuto mb1 p20 bdrBox bgGray private">
				<div class="line">
					<div class="unit mr5 w100">
						<p class="mb5 txtR label">title:</p>
						<p class="mb5 txtR label">url:</p>
						<p class="mb5 txtR label">gif:</p>
						<p class="mb5 txtR label">tags:</p>
						<p class="mb5 txtR label">caption:</p>
					</div>
					<form enctype="multipart/form-data" action="update.php" method="post" target="get.html" class="unitF">
						<input type="hidden" name="table" value="mattman"/>
						<input type="hidden" name="uniqueID" value="<?= $animation['uniqueID']; ?>"/>
						<input type="text" name="title" class="mb5 wFull" value="<?= $animation['title']; ?>"/>
						<input type="text" name="url" class="mb5 wFull" value="<?= $animation['url']; ?>"/>
						<input type="text" name="gif" class="mb5 wFull" value="<?= $animation['gif']; ?>"/>
						<input type="text" name="tags" class="mb5 wFull" value="<?= $animation['tags']; ?>"/>
						<input type="text" name="width" class="mb5 wFull" value="<?= $animation['width']; ?>"/>
						<input type="text" name="height" class="mb5 wFull" value="<?= $animation['height']; ?>"/>
						<textarea name="caption" class="mb5 wFull" rows="10"><?= $animation['caption']; ?></textarea>
						<input type="submit" value="update"/>
					</form>
				</div>
			</div>
		<?php } ?>
	<?php } ?>
	<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php'); ?>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>