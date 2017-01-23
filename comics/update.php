<?php
$title = '';
$desc = 'updating a record in the comics table.';
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="mAuto mb5 w1000">
	<div class="mAuto bdrLtBrown bdrRound p10 bgWhite">
		<?php if($_COOKIE['username'] == 'matt!'){ ?>
			<?php
			$con = mysql_connect('localhost','kittenb1_matt','uncannyx0545');
			mysql_select_db('kittenb1_main', $con);

			$uniqueID  = $_POST['uniqueID'];
			$title     = $_POST['title'];
			$author    = $_POST['author'];
			$date      = $_POST['date'];
			$tags      = $_POST['tags'];
			$caption   = $_POST['caption'];
			$body      = $_POST['body'];

			$color     = $_POST['color'];
			$bw        = $_POST['bw'];
			$colorLink = $_POST['colorLink'];
			$bwLink    = $_POST['bwLink'];
			$thumb     = $_POST['thumb'];

			$result = mysql_query("SELECT * FROM comics WHERE uniqueID='$uniqueID'", $con);
			while($row = mysql_fetch_array($result)){
				if($row['uniqueID'] == $uniqueID){
					if($row['title'] != $title){
						$title = str_replace('"', '\"', $title);
						$title = str_replace("'", "\'", $title);

						$myUpdate = mysql_query("UPDATE comics SET title='$title' WHERE uniqueID='$uniqueID'");

						if(!$myUpdate) {
							die('error updating ' . $title . ': ' . mysql_error());
						}else{
							echo 'title updated to: ' . $title . '<br/>';
						}
					}
					if($row['author'] != $author){
						$myUpdate = mysql_query("UPDATE comics SET author='$author' WHERE uniqueID='$uniqueID'");
						if(!$myUpdate) {
							die('error updating ' . $author . ': ' . mysql_error());
						}else{
							echo 'author updated to: ' . $author . '<br/>';
						}
					}
					if($row['date'] != $date){
						$myUpdate = mysql_query("UPDATE comics SET date='$date' WHERE uniqueID='$uniqueID'");
						if(!$myUpdate) {
							die('error updating ' . $date . ': ' . mysql_error());
						}else{
							echo 'date updated to: ' . $date . '<br/>';
						}
					}

					if($row['tags'] != $tags){
						$myUpdate = mysql_query("UPDATE comics SET tags='$tags' WHERE uniqueID='$uniqueID'");
						if(!$myUpdate) {
							die('error updating ' . $tags . ': ' . mysql_error());
						}else{
							echo 'tags updated to: ' . $tags . '<br/>';
						}
					}
					if($row['caption'] != $caption){
						$caption = str_replace('"', '\"', $caption);
						$caption = str_replace("'", "\'", $caption);

						$myUpdate = mysql_query("UPDATE comics SET caption='$caption' WHERE uniqueID='$uniqueID'");

						if(!$myUpdate) {
							die('error updating caption: ' . mysql_error());
						}else{
							echo 'caption updated to: ' . $caption . '<br/>';
						}
					}
					if($row['body'] != $body){
						$body = str_replace('"', '\"', $body);
						$body = str_replace("'", "\'", $body);

						$myUpdate = mysql_query("UPDATE comics SET body='$body' WHERE uniqueID='$uniqueID'");

						if(!$myUpdate) {
							die('error updating body: ' . mysql_error());
						}else{
							echo 'body updated to: ' . $body . '<br/>';
						}
					}
					if($row['color'] != $color){
						$myUpdate = mysql_query("UPDATE comics SET color='$color' WHERE uniqueID='$uniqueID'");
						if(!$myUpdate) {
							die('error updating ' . $color . ': ' . mysql_error());
						}else{
							echo 'color updated to: ' . $color . '<br/>';
						}
					}
					if($row['bw'] != $bw){
						$myUpdate = mysql_query("UPDATE comics SET bw='$bw' WHERE uniqueID='$uniqueID'");
						if(!$myUpdate) {
							die('error updating ' . $bw . ': ' . mysql_error());
						}else{
							echo 'bw updated to: ' . $bw . '<br/>';
						}
					}
					if($row['colorLink'] != $colorLink){
						$myUpdate = mysql_query("UPDATE comics SET colorLink='$colorLink' WHERE uniqueID='$uniqueID'");
						if(!$myUpdate) {
							die('error updating ' . $colorLink . ': ' . mysql_error());
						}else{
							echo 'colorLink updated to: ' . $colorLink . '<br/>';
						}
					}
					if($row['bwLink'] != $bwLink){
						$myUpdate = mysql_query("UPDATE comics SET bwLink='$bwLink' WHERE uniqueID='$uniqueID'");
						if(!$myUpdate) {
							die('error updating ' . $bwLink . ': ' . mysql_error());
						}else{
							echo 'bwLink updated to: ' . $bwLink . '<br/>';
						}
					}
					if($row['thumb'] != $thumb){
						$myUpdate = mysql_query("UPDATE comics SET thumb='$thumb' WHERE uniqueID='$uniqueID'");
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