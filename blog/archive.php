<?php
$table = 'blog';
$type = (isset($_GET['type'])) ? $_GET['type'] : 'thumbs';
$sort = ($type == 'list') ? 'ASC' : 'DESC';
include($_SERVER['DOCUMENT_ROOT'] . '/includes/sql.php');

$title = 'blog archive';
$desc = 'view all blog posts';

$colHeight = count($archive) / 3;
if($colHeight != floor($colHeight)){
	$colHeight = floor($colHeight) + 1;
}
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="mAuto w1000">
	<div class="line mAuto mb1 p10 bgWhite">
		<p class="line mb0">
			<?php if($type == 'list'){ ?>
				<span class="unit mr10 underline mobile">list</span>
				<a href="?type=thumbs" class="unit mr10">thumbnails</a>
			<?php } else { ?>
				<a href="?type=list" class="unit mr10">list</a>
				<span class="unit mr10 underline mobile">thumbnails</span>
			<?php } ?>
			<span class="unitR txtGray mobile">
				<span class="hideOnMobile">updated</span>
				<span><?= $lastUpdate; ?></span>
			</span>
		</p>
	</div>
	<?php if($type == 'list'){ ?>
		<div id="archive" class="line mb1 p20 bgWhite">
			<?php $num = 1; ?>
			<div class="unit pr10 size1of3 bdrBox">
				<?php foreach ($archive as $post) { ?>
					<?php 
					$title = $post['title'];
					if(strlen($title) > 50){
						$title = substr($title, 0, 47) . '...';
					}
					?>
					<p class="mb5 nowrap">
						<span><?= $num; ?>. </span>
						<a href="index.php?id=<?= $post['uniqueID']; ?>&amp;records=1" data-thumb="<?= $post['thumb']; ?>" class="link"><?= $title; ?></a>
					</p>
					<?php if($num == $colHeight){ ?>
						</div>
						<div class="unit pr10 size1of3 bdrBox">
					<?php }else if($num == $colHeight*2){ ?>
						</div>
						<div class="unit pr10 size1of3 bdrBox">
					<?php } ?>
					<?php $num++; ?>
				<?php } ?>
			</div>
		</div>
	<?php } else { ?>
		<div class="line">
			<?php foreach ($archive as $post) { ?>
				<?php
				$title = $post['title'];
				$title = str_replace("'", '\&apos;', $title);
				$title = str_replace('"', "\&quot;", $title);
				?>
				<a href="index.php?id=<?= $post['uniqueID']; ?>&records=1" class="unit mr1 mb1">
					<img src="<?= $post['thumb']; ?>" data-title="<?= $title; ?>" alt="<?= $title; ?>" class="w100 h100 thumb"/>
				</a>
			<?php } ?>
		</div>
	<?php } ?>
</div>
<div id="tooltip" class="absolute p5 bdrLtBrown bgFoam hide">
	<span></span>
	<img src="" alt=""/>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
