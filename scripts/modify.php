<?php
$con   = mysql_connect('localhost', 'kittenb1_matt', 'uncannyx0545');
$title = 'modify database records';
$table = 'comics';
$index = 1000;

mysql_select_db('kittenb1_main', $con);

$rows = mysql_query("SELECT * FROM $table ORDER BY date ASC", $con);

while ($row = mysql_fetch_array($rows)) {
	$id = $row['id'];

	$original = str_replace('/full/', '/final/', $row['original']);
	$query    = "UPDATE $table SET id = '$index' WHERE id = '$id'";
	// $result = mysql_query($query);

	echo $id . ': ' . $query . '<br/>';
	$index++;
}
