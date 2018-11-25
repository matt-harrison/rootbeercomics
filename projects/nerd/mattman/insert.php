<?php
$title = 'the anarchynerd pixel art archive';
$desc = 'an archive of the defunct website anarchynerd, by matt harrison.';
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="p10">
	<div class="mAuto bdrLtBrown bdrRound p10 w800">
		<?php
		$con = mysql_connect('localhost','kittenb1_matt','uncannyx0545');
		mysql_select_db('kittenb1_nerd', $con);
		$result = mysql_query("SELECT * FROM mattman", $con);
		$rowCount = mysql_num_rows($result);
		$num = (int)$rowCount;
		$next = ($num+1);
		$url = '/projects/nerd/monsters/' . $_POST['type'] . '/' . $_POST['filename'] . '.png';
		$gif = '/projects/nerd/gif/monsters/' . $_POST['type'] . '/' . $_POST['filename'] . '.gif';

		if($_COOKIE['username'] == 'matt!'){
			$sql="INSERT INTO mattman
			(uniqueID, title, url, gif, type, caption, tags, width, height) VALUES
			('$next', '$_POST[title]', '$url', '$gif', '$_POST[type]', '$_POST[caption]', '$_POST[tags]', '$_POST[width]', '$_POST[height]')";
			if (!mysql_query($sql,$con)){
				die('<p class="txtC">Error: ' . mysql_error() . '</p>');
			}else{
				echo 'post #' . $next . '<br />';
				echo 'title: ' . $_POST['title'] . '<br />';
				echo 'URL: ' . $url . '<br />';
				echo 'GIF: ' . $gif . '<br />';
			}
		}else{
			echo 'you are not authorized to alter content.<br />';
		}
		?>
	</div>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
