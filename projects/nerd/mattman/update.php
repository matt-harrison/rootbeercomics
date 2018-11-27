<?php
$table = $_POST['table'];
$uniqueID = $_POST['uniqueID'];
$title = $_POST['title'];
$tags = $_POST['tags'];
$url = $_POST['url'];
$gif = $_POST['gif'];
$width = $_POST['width'];
$height = $_POST['height'];
$caption = $_POST['caption'];

$caption = str_replace("'", "&apos;", $caption);
$caption = str_replace("&quot;", '"', $caption);
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<section class="mAuto mb20 bdrGray p10 w600 bgWhite">
	<?php if($table != NULL && $table != ''){ ?>
		<?php
		$con = mysql_connect('localhost','kittenb1_matt','uncannyx0545');
		mysql_select_db('kittenb1_nerd', $con);
		$result = mysql_query("SELECT * FROM $table WHERE uniqueID='$uniqueID'", $con);
		?>
			<p>ID: <?= $uniqueID; ?></p>
		<?php while($row = mysql_fetch_array($result)){ ?>
			<?php
			if (!$result){
				die('<p class="txtC">Error: ' . mysql_error() . '</p>');
			}else{
				echo 'table: ' . strtoupper($table) . ', record #' . $uniqueID . '<br/><br/>';
				if($table != NULL && $uniqueID != NULL){
					if($title != $row['title']){
						echo $row['title'] . ' > ' . $title . '<br/>';
						mysql_query("UPDATE $table SET title='$title' WHERE uniqueID='$uniqueID'");
					}
					if($tags != $row['tags']){
						echo $row['tags'] . ' > ' . $tags . '<br/>';
						mysql_query("UPDATE $table SET tags='$tags' WHERE uniqueID='$uniqueID'");
					}
					if($url != $row['url']){
						echo $row['url'] . ' > ' . $url . '<br/>';
						mysql_query("UPDATE $table SET url='$url' WHERE uniqueID='$uniqueID'");
					}
					if($gif != $row['gif']){
						echo $row['gif'] . ' > ' . $gif . '<br/>';
						mysql_query("UPDATE $table SET gif='$gif' WHERE uniqueID='$uniqueID'");
					}
					if($tags != $row['width']){
						echo $row['width'] . ' > ' . $width . '<br/>';
						mysql_query("UPDATE $table SET width='$width' WHERE uniqueID='$uniqueID'");
					}
					if($height != $row['height']){
						echo $row['height'] . ' > ' . $height . '<br/>';
						mysql_query("UPDATE $table SET height='$height' WHERE uniqueID='$uniqueID'");
					}
					if($caption != $row['caption']){
						echo $row['caption'] . ' > ' . $caption . '<br/>';
						mysql_query("UPDATE $table SET caption='$caption' WHERE uniqueID='$uniqueID'");
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