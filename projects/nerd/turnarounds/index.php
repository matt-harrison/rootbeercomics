<?php
$title = 'the anarchynerd pixel art archive';
$desc = 'an archive of the defunct website anarchynerd, by matt harrison.';

$con = mysql_connect('localhost', 'kittenb1_matt', 'uncannyx0545');
mysql_select_db('kittenb1_nerd', $con);
$animations = mysql_query("SELECT * FROM turnarounds", $con);
$lastRow = mysql_num_rows($animations);

if($_GET['id'] != NULL){
	$page = $_GET['id'];
}else{
	$page = 1;
}

if (isset($_GET['zoom'])){
	$zoom = number_format($_GET['zoom']);
} else {
	$zoom = 8;
}

$records = 1;
$lastPage = $page - $records + 1;

if($animation['tags'] != NULL){
	$tags = $animation['tags'];
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
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="mAuto w1000">
	<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php'); ?>
	<?php $animations = mysql_query("SELECT * FROM turnarounds WHERE uniqueID='$page' ORDER BY uniqueID ASC", $con); ?>
	<?php while($animation = mysql_fetch_array($animations)){ ?>
		<div class="mb1 p20 bgWhite">
			<div class="mAuto w800 noSelect">
				<div class="line mb10">
					<h2 class="unit mr5 mb0 bold">
						<a href="index.php?id=<?= $animation['uniqueID']; ?>&records=1"><?= $animation['title']; ?></a>
					</h2>
					<p class="unitR">
						<a href="index.php?id=<?= $page; ?>&zoom=1" class="mr5">small</a>
						<a href="index.php?id=<?= $page; ?>&zoom=4" class="mr5">medium</a>
						<a href="index.php?id=<?= $page; ?>&zoom=8">large</a>
					</p>
				</div>
				<div id="buttons" class="line mAuto mb5 bdrLtBrown bgWhite txtC resize invisible">
					<p id="playBackward" class="unit mb0 pt10 pb10 size1of5 bdrBox csrPointer">&lt;&lt;</p>
					<p id="stepBackward" class="unit mb0 pt10 pb10 size1of5 bdrBox csrPointer">&lt;</p>
					<p id="stop" class="unit mb0 pt10 pb10 size1of5 bdrBox csrPointer">x</p>
					<p id="stepForward" class="unit mb0 pt10 pb10 size1of5 bdrBox csrPointer">&gt;</p>
					<p id="playForward" class="unit mb0 pt10 pb10 size1of5 bdrBox csrPointer">&gt;&gt;</p>
				</div>
				<div id="anim" data-zoom="<?= $zoom; ?>" class="mAuto mb5 dotted bgWhite resize anim invisible">
					<img src="<?= $animation['url']; ?>" id="sprite" alt=""<?= ($animation['frameCount'] != 0) ? ' data-frameCount="' . $animation['frameCount'] . '"' : ''; ?>/>
				</div>
				<div class="mAuto pt5 w500"><?= $animation['caption']; ?></div>
			</div>
		</div>
		<?php if($_COOKIE['username'] == 'matt!' & $records == 1){ ?>
			<?php $title = $animation['title']; ?>
			<div class="mb5 p20 bgGray private">
				<div class="line">
					<div class="unit mr5 w100">
						<p class="mb5 txtR label">title:</p>
						<p class="mb5 txtR label">url:</p>
						<p class="mb5 txtR label">gif:</p>
						<p class="mb5 txtR label">tags:</p>
						<p class="mb5 txtR label">caption:</p>
						<img src="<?= $animation['gif']; ?>" class="unitR"/>
					</div>
					<form enctype="multipart/form-data" action="update.php" method="post" target="get.html" class="unitF">
						<input type="hidden" name="table" value="turnarounds"/>
						<input type="hidden" name="uniqueID" value="<?= $animation['uniqueID']; ?>"/>
						<input type="text" name="title" class="mb5 wFull" value="<?= $animation['title']; ?>"/>
						<input type="text" name="url" class="mb5 wFull" value="<?= $animation['url']; ?>"/>
						<input type="text" name="gif" class="mb5 wFull" value="<?= $animation['gif']; ?>"/>
						<input type="text" name="tags" class="mb5 wFull" value="<?= $animation['tags']; ?>"/>
						<textarea name="caption" class="mb5 wFull" rows="10"><?= $animation['caption']; ?></textarea>
						<input type="submit" value="update"/>
					</form>
				</div>
			</div>
		<?php } ?>
	<?php } ?>
	<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php'); ?>
</div>
<script type="text/javascript" src="/includes/js/spin.js"></script>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>