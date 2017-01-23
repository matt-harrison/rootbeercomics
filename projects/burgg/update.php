<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="mb5 mAuto w1000">
	<div class="mAuto bdrLtBrown bdrRound p10 bgWhite">
		<?php if($_COOKIE['username'] == 'matt!'){ ?>
			<?php
			$con = mysql_connect('localhost','kittenb1_matt','uncannyx0545');
			mysql_select_db('kittenb1_main', $con);
			
			$uniqueID = $_POST['uniqueID'];
			$title = $_POST['title'];
			$author = $_POST['author'];
			$date = $_POST['date'];
			$tags = $_POST['tags'];
			$caption = $_POST['caption'];
			
			$img = $_POST['img'];
			$thumb = $_POST['thumb'];
			
			$result = mysql_query("SELECT * FROM burgg WHERE uniqueID='$uniqueID'", $con);
			while($row = mysql_fetch_array($result)){
				if($row['uniqueID'] == $uniqueID){
					if($row['title'] != $title){
						$myUpdate = mysql_query("UPDATE burgg SET title='$title' WHERE uniqueID='$uniqueID'");
						if(!$myUpdate) {
							die('error updating ' . $title . ': ' . mysql_error());
						}else{
							echo 'title updated to: ' . $title . '<br/>';
						}
					}
					if($row['author'] != $author){
						$myUpdate = mysql_query("UPDATE burgg SET author='$author' WHERE uniqueID='$uniqueID'");
						if(!$myUpdate) {
							die('error updating ' . $author . ': ' . mysql_error());
						}else{
							echo 'author updated to: ' . $author . '<br/>';
						}
					}
					if($row['date'] != $date){
						$myUpdate = mysql_query("UPDATE burgg SET date='$date' WHERE uniqueID='$uniqueID'");
						if(!$myUpdate) {
							die('error updating ' . $date . ': ' . mysql_error());
						}else{
							echo 'date updated to: ' . $date . '<br/>';
						}
					}
					
					if($row['tags'] != $tags){
						$myUpdate = mysql_query("UPDATE burgg SET tags='$tags' WHERE uniqueID='$uniqueID'");
						if(!$myUpdate) {
							die('error updating ' . $tags . ': ' . mysql_error());
						}else{
							echo 'tags updated to: ' . $tags . '<br/>';
						}
					}
					if($row['caption'] != $caption){
						$myUpdate = mysql_query("UPDATE burgg SET caption='$caption' WHERE uniqueID='$uniqueID'");
						$caption = str_replace('\"', '"', $caption);
						$caption = str_replace("\'", "'", $caption);
						if(!$myUpdate) {
							die('error updating ' . $caption . ': ' . mysql_error());
						}else{
							echo 'answer updated to: ' . $caption . '<br/>';
						}
					}
					if($row['img'] != $img){
						$myUpdate = mysql_query("UPDATE burgg SET img='$img' WHERE uniqueID='$uniqueID'");
						if(!$myUpdate) {
							die('error updating ' . $img . ': ' . mysql_error());
						}else{
							echo 'color updated to: ' . $img . '<br/>';
						}
					}
					if($row['thumb'] != $thumb){
						$myUpdate = mysql_query("UPDATE burgg SET thumb='$thumb' WHERE uniqueID='$uniqueID'");
						if(!$myUpdate) {
							die('error updating ' . $thumb . ': ' . mysql_error());
						}else{
							echo 'thumb updated to: ' . $thumb . '<br/>';
						}
					}
				}
			}
			?>
		<?php } else { ?>
			<p class="mb0">you are not authorized to alter content.';</p>
		<?php } ?>
	</div>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>