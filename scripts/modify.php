<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/query.php');
include($_SERVER['DOCUMENT_ROOT'] . '/includes/require-superuser.php');

$table = 'comics';
$index = 66;
$query = "SELECT * FROM $table ORDER BY date ASC";
$rows  = select($query);

foreach ($rows as $row) {
	$id = $row['id'];

	if ($id > 65) {
		$query    = "UPDATE $table SET id = '$index' WHERE id = '$id'";
		// $response = execute($query);

		echo $id . ': ' . $query . '<br/>';
		$index++;
	}
}
