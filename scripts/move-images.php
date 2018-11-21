<?php
$con = mysql_connect('localhost', 'kittenb1_matt', 'uncannyx0545');
mysql_select_db('kittenb1_main', $con);
$rows = mysql_query("SELECT * FROM drawings ORDER BY id ASC", $con);
while($row = mysql_fetch_array($rows)) {
	$newPath = $row['thumb'];
	$newPath = str_replace('drawings/thumbs/', 'drawings/real-thumbs/', $newPath);

	if ($row['thumb'] != $newPath) {
		echo $row['id'] . ': ' . $row['thumb'] . ' >>> ' . $newPath . '</br>';
		//rename('..' . $row['thumb'], '..' . $newPath);
	}
}
