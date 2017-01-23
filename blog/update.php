<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<?php
$table = $_POST['table'];
$uniqueID = $_POST['uniqueID'];
$title = $_POST['title'];
$date = $_POST['date'];
$tags = $_POST['tags'];
$colorLink = $_POST['colorLink'];
$colorDisp = $_POST['colorDisp'];
$bwLink = $_POST['bwLink'];
$bwDisp = $_POST['bwDisp'];
$thumb = $_POST['thumb'];
$caption = $_POST['caption'];
$body = $_POST['body'];

$body = str_replace("'", "&apos;", $body);
$body = str_replace("&quot;", '"', $body);
?>
<section class="bdrLtBrown bdrRound mAuto mb10 p10 w1000 bdrBox bgWhite">
	<?php
	if($table != NULL && $table != ''){
		$con = mysql_connect('localhost','kittenb1_matt','uncannyx0545');
		mysql_select_db('kittenb1_main', $con);
		$result = mysql_query("SELECT * FROM $table WHERE uniqueID='$uniqueID'", $con);
		while($row = mysql_fetch_array($result)){
			if (!$result){ 
				die('<p class="txtC">Error: ' . mysql_error() . '</p>');
			}else{
				if($table != NULL && $uniqueID != NULL){
					echo 'table: ' . strtoupper($table) . ', record #' . $uniqueID . '<br/><br/>';
					if(!empty($title) && $title != $row['title']){
						echo $row['title'] . ' > ' . $title . '<br/>';
						mysql_query("UPDATE $table SET title='$title' WHERE uniqueID='$uniqueID'");
					}
					if(!empty($date) && $date != $row['date']){
						echo $row['date'] . ' > ' . $date . '<br/>';
						mysql_query("UPDATE $table SET date='$date' WHERE uniqueID='$uniqueID'");
					}
					if(!empty($tags) && $tags != $row['tags']){
						echo $row['tags'] . ' > ' . $tags . '<br/>';
						mysql_query("UPDATE $table SET tags='$tags' WHERE uniqueID='$uniqueID'");
					}
					if(!empty($colorLink) && $colorLink != $row['colorLink']){
						echo $row['colorLink'] . ' > ' . $colorLink . '<br/>';
						mysql_query("UPDATE $table SET colorLink='$colorLink' WHERE uniqueID='$uniqueID'");
					}
					if(!empty($colorDisp) && $colorDisp != $row['colorDisp']){
						echo $row['colorDisp'] . ' > ' . $colorDisp . '<br/>';
						mysql_query("UPDATE $table SET colorDisp='$colorDisp' WHERE uniqueID='$uniqueID'");
					}
					if(!empty($bwLink) && $bwLink != $row['bwLink']){
						echo $row['bwLink'] . ' > ' . $bwLink . '<br/>';
						mysql_query("UPDATE $table SET bwLink='$bwLink' WHERE uniqueID='$uniqueID'");
					}
					if(!empty($bwDisp) && $bwDisp != $row['bwDisp']){
						echo $row['bwDisp'] . ' > ' . $bwDisp . '<br/>';
						mysql_query("UPDATE $table SET bwDisp='$bwDisp' WHERE uniqueID='$uniqueID'");
					}
					if(!empty($thumb) && $thumb != $row['thumb']){
						echo $row['thumb'] . ' > ' . $thumb . '<br/>';
						mysql_query("UPDATE $table SET thumb='$thumb' WHERE uniqueID='$uniqueID'");
					}
					if(!empty($body) && $body != $row['body']){
						echo '<br/>was:<br/><textarea name="body" class="mb5 w600 mAuto" style="height:300px;">' . $row['body'] . '</textarea><br/>';
						echo '<br/>now:<br/><textarea name="body" class="mb5 w600 mAuto" style="height:300px;">' . $body . '</textarea><br/>';
						mysql_query("UPDATE $table SET body='$body' WHERE uniqueID='$uniqueID'");
					}
				}
			}
		}
		mysql_close($con);
	}else{
		echo 'invalid POST data.';
	}
	?>
</section>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>