<?php
$json = $_POST['json'];
if (file_exists('json/comics.json')) {
	rename('json/comics.json', 'json/comics' . time() . '.json');
}
if (file_put_contents('json/comics.json', $json, FILE_USE_INCLUDE_PATH)) {
	echo 'success';
} else {
	echo 'error';
}
