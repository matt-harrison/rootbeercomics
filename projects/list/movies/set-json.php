<?php
$json = $_POST['json'];
if (file_exists('json/movies.json')) {
	rename('json/movies.json', 'json/movies.' . time() . '.json');
}
if (file_put_contents('json/movies.json', $json, FILE_USE_INCLUDE_PATH)) {
	echo 'success';
} else {
	echo 'error';
}
