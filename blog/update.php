<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<?php
$table = $_POST['table'];
$id = $_POST['id'];
$title = $_POST['title'];
$date = $_POST['date'];
$tags = $_POST['tags'];
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
		$result = mysql_query("SELECT * FROM $table WHERE id='$id'", $con);
		while($row = mysql_fetch_array($result)){
			if (!$result){
				die('<p class="txtC">Error: ' . mysql_error() . '</p>');
			}else{
				if($table != NULL && $id != NULL){
					echo 'table: ' . strtoupper($table) . ', record #' . $id . '<br/><br/>';
					if(!empty($title) && $title != $row['title']){
						echo $row['title'] . ' > ' . $title . '<br/>';
						mysql_query("UPDATE $table SET title='$title' WHERE id='$id'");
					}
					if(!empty($date) && $date != $row['date']){
						echo $row['date'] . ' > ' . $date . '<br/>';
						mysql_query("UPDATE $table SET date='$date' WHERE id='$id'");
					}
					if(!empty($tags) && $tags != $row['tags']){
						echo $row['tags'] . ' > ' . $tags . '<br/>';
						mysql_query("UPDATE $table SET tags='$tags' WHERE id='$id'");
					}
					if(!empty($thumb) && $thumb != $row['thumb']){
						echo $row['thumb'] . ' > ' . $thumb . '<br/>';
						mysql_query("UPDATE $table SET thumb='$thumb' WHERE id='$id'");
					}
					if(!empty($body) && $body != $row['body']){
						echo '<br/>was:<br/><textarea name="body" class="mb5 w600 mAuto" style="height:300px;">' . $row['body'] . '</textarea><br/>';
						echo '<br/>now:<br/><textarea name="body" class="mb5 w600 mAuto" style="height:300px;">' . $body . '</textarea><br/>';
						mysql_query("UPDATE $table SET body='$body' WHERE id='$id'");
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