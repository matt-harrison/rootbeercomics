<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/execute-query.php');
include($_SERVER['DOCUMENT_ROOT'] . '/includes/require-superuser.php');

$table = 'drawings';
$query = "SELECT * FROM $table ORDER BY id ASC";
$rows  = select($query);

foreach ($rows as $row) {
	$id = $row['id'];
	$newPath = str_replace('drawings/thumbs/', 'drawings/new-thumbs/', $row['thumb']);

	if ($row['thumb'] != $newPath) {
		echo $id . ': ' . $row['thumb'] . ' >>> ' . $newPath . '</br>';
		// rename('..' . $row['thumb'], '..' . $newPath);

		$query    = "UPDATE $table SET thumb = '$newPath' WHERE id = $id";
		// $response = executeQuery($query);
	}
}
