<?php header('Content-type: text/xml'); ?>
<?= '<?xml version="1.0" encoding="ISO-8859-1" ?>'; ?>
<rss version="2.0">
	<channel>
		<title>root beer comics, by matt!</title>
		<description>webcomics, minicomics, and sketch blog by matt harrison.</description>
		<link>http://www.rootbeercomics.com</link>
		<?php
		$today = date('Y-m-d');
		$num = 0;
		$con = mysql_connect('localhost', 'kittenb1_matt', 'uncannyx0545');
		mysql_select_db('kittenb1_main', $con);
		$updates = mysql_query("SELECT *, DATEDIFF('$today', date) AS diff FROM updates ORDER BY date DESC", $con);
		?>
		<?php while($update = mysql_fetch_array($updates)){ ?>
			<?php if($update['diff'] >= 0 & $num < 25){ ?>
				<item>
					<title><?= $update['title']; ?></title>
					<link>http://www.rootbeercomics.com/<?= $update['type']; ?>/index.php?id=<?= $update['tableID']; ?>&amp;records=1</link>
					<description><?= $update['caption']; ?></description>
				</item>
				<?php $num++; ?>
			<?php } ?>
		<?php } ?>
	</channel>
</rss>