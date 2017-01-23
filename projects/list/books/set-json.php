<?php
$json = $_POST['json'];
if (file_exists('json/books.json')) {
	rename('json/books.json', 'json/books.' . time() . '.json');
}
if (file_put_contents('json/books.json', $json, FILE_USE_INCLUDE_PATH)) {
	echo 'success';
} else {
	echo 'error';
}
