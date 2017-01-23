<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="mb5 mAuto bdrBox w1000 bdrLtBrown bdrRound bgWhite">
	<div class="p10">
		<?php
		$table = $_POST['table'];
		$con = mysql_connect('localhost','kittenb1_matt','uncannyx0545');
		mysql_select_db('kittenb1_main', $con);
		$result = mysql_query("SELECT * FROM $table", $con);
		$rowCount = mysql_num_rows($result);
		$num = (int)$rowCount;
		$uniqueID = ($num+1);
		?>
		<?php if($_COOKIE['username'] == 'matt!'){ ?>
			<?php if($_POST['table'] == 'blog'){ ?>
				<?php
				$title = $_POST['title'];
				$blogBody  = $_POST['blogBody'];
				$caption = $_POST['caption'];

				//escape invalid characters in the content before passing to mySQL
				$title   = str_replace("'", "\'", $title);
				$blogBody    = str_replace("'", "\'", $blogBody);
				$caption = str_replace("'", "\'", $caption);
				?>
				<?php $sql = "INSERT INTO blog (uniqueID, title, body, tags, thumb, date, caption) VALUES ('$uniqueID', '$title', '$blogBody', '$_POST[tags]', '$_POST[thumb]', '$_POST[date]', '$caption')"; ?>
				<textarea style="width:500px;height:300px;"><?= $sql; ?></textarea><br/><br/>
				<?php if(!mysql_query($sql,$con)){ ?>
					<p class="txtC">Error: <?= mysql_error(); ?></p>
				<?php } else { ?>
					<?php $url = 'http://www.rootbeercomics.com/index.php?id=' . $uniqueID . '&records=1'; ?>
					<a href="http://www.rootbeercomics.com/blog/index.php?id=<?= $uniqueID ?>&records=1" target="_blank">view blog #<?= $uniqueID ?></a><br/>
					<span>title: <?= $_POST['title']; ?></span><br/>
					<span>caption: <?= $_POST['caption']; ?></span><br/>
					<span>tags: <?= $_POST['tags']; ?></span><br/>
					<span>date: <?= $_POST['date']; ?></span><br/>
					<span>thumb: <?= $_POST['thumb']; ?></span><br/><br/>
					<span>body:</span><br/><textarea style="width:500px;height:300px;"><?= $_POST['blogBody']; ?></textarea><br/>
				<?php } ?>
			<?php } else if($_POST['table'] == 'comics'){ ?>
				<?php
				$title   = $_POST['title'];
				$caption = $_POST['caption'];
				$body    = $_POST['comicsBody'];

				//escape invalid characters in the content before passing to mySQL
				$title   = str_replace("'", "\'", $title);
				$caption = str_replace("'", "\'", $caption);
				$body    = str_replace("'", "\'", $comicsBody);
				?>
				<?php $sql = "INSERT INTO comics (uniqueID, date, colorLink, bwLink, color, bw, thumb, title, author, tags, type, caption, body) VALUES ('$uniqueID', '$_POST[date]', '$_POST[colorLink]', '$_POST[bwLink]', '$_POST[color]', '$_POST[bw]', '$_POST[thumb]', '$title', '$_POST[author]', '$_POST[tags]', '$_POST[type]', '$caption', '$body')"; ?>
				<?php if(!mysql_query($sql, $con)){ ?>
					<p class="txtC">Error: <?= mysql_error(); ?></p>'
				<?php } else { ?>
					<?php $url = 'http://www.rootbeercomics.com/comics/index.php?id=' . $uniqueID . '&records=1'; ?>
					<a href="http://www.rootbeercomics.com/comics/index.php?id=<?= $uniqueID ?>&records=1" target="_blank">view comic #<?= $uniqueID; ?></a><br/>
					<span>title: <?= $_POST['title']; ?></span><br/>
					<span>caption: <?= $_POST['caption']; ?></span><br/>
					<span>author: <?= $_POST['author']; ?></span><br/>
					<span>type: <?= $_POST['type']; ?></span><br/>
					<span>tags: <?= $_POST['tags']; ?></span><br/>
					<span>date: <?= $_POST['date']; ?></span><br/><br/>

					<span>color: <?= $_POST['color']; ?></span><br/>
					<span>bw: <?= $_POST['bw']; ?></span><br/>
					<span>colorLink: <?= $_POST['colorLink']; ?></span><br/>
					<span>bwLink: <?= $_POST['bwLink']; ?></span><br/>
					<span>thumb: <?= $_POST['thumb']; ?></span><br/>
				<?php } ?>
			<?php } ?>
			<?php
			if(!empty($url)){
				//also insert the new entry into the unified table
				$tableID = $uniqueID;
				$result = mysql_query("SELECT * FROM updates", $con);
				$rowCount = mysql_num_rows($result);
				$num = (int)$rowCount;
				$uniqueID = ($num+1);
				$sql = "INSERT INTO updates (uniqueID, title, caption, thumb, type, date, tableID) VALUES ('$uniqueID', '$title', '$caption', '$_POST[thumb]', '$_POST[type]', '$_POST[date]', '$tableID')";
			}
			?>
			<?php if(!mysql_query($sql ,$con)){ ?>
				<p class="txtC">failed to add update: <?= mysql_error(); ?></p>
			<?php } ?>
		<?php } else { ?>
			<span>you are not authorized to alter content.</span><br/>
		<?php } ?>
	</div>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>