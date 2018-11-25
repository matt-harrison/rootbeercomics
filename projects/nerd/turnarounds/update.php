<?php
$table = $_POST['table'];
$uniqueID = $_POST['uniqueID'];
$title = $_POST['title'];
$tags = $_POST['tags'];
$url = $_POST['url'];
$gif = $_POST['gif'];
$caption = $_POST['caption'];

$caption = str_replace("'", "&apos;", $caption);
$caption = str_replace("&quot;", '"', $caption);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
		<title>kittenberg, by matt!</title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
		<meta name="viewport" content="width=1010"/>
		<meta property="og:title" content="kittenberg, by matt!"/>
		<meta property="og:image" content="/images/matt.jpg"/>
		<meta property="og:description" content="webcomics, minicomics, and sketch blog by matt harrison."/>
		<meta property="og:url" content="/index.php"/>
        <link type="text/css" href="/assets/css/library.css" rel="stylesheet"/>
        <link type="image/x-icon" href="/images/icons/r.ico" rel="icon"/>
        <link type="application/rss+xml" href="/feed.php" rel="alternate"/>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    </head>
    <body class="m5">
    	<section class="mAuto bdrLtBrown bdrRound p10 w600 bgWhite">
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
    </body>
</html>