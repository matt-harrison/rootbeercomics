<?php
$con = mysql_connect('localhost', 'kittenb1_matt', 'uncannyx0545');
mysql_select_db('kittenb1_main', $con);
$rows = mysql_query("SELECT * FROM comics ORDER BY id ASC", $con);
while($row = mysql_fetch_array($rows)) {
	$newPath = $row['final'];
	$newPath = str_replace('display/color/', 'final/', $newPath);

	if ($row['final'] != $newPath) {
		echo $row['id'] . ': ' . $row['final'] . ' >>> ' . $newPath . '</br>';
		//rename('..' . $row['final'], '..' . $newPath);
	}
}
