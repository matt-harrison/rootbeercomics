<?php
$title = 'draw something screenshots';
$desc = 'draw something screenshots by matt harrison.';
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="mAuto w1005">
	<p class="mb10">get the <a href="http://itunes.apple.com/us/app/draw-something-free/id488628250?mt=8" target="_blank">Draw Something</a> app on itunes.</p>
	
	<div class="line">
		<?php 
		$picArr = array();
		$path = 'img/';
		if ($handle = opendir($path)) {
			while (($url = readdir($handle)) !== false) {
				if($url != '.' && $url != '..'){
					array_push($picArr,$url);
				}
			}
		}
		sort($picArr);
		?>
		<?php for($i=0;$i<sizeof($picArr);$i++){ ?>
			<?php $url = $picArr[$i]; ?>
			<img src="img/<?= $url ?>" class="unit mr5 mb5 bdrLtBrown bdrRound p1"/>
		<?php }	?>
	</div>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>