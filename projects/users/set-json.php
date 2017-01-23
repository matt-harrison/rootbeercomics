<?php
$json = $_POST['json'];
if(file_exists('json/users.json')){
	rename('json/users.json', 'users/' . time() . 'users.json');
}
if(file_put_contents('json/users.json', json_encode($json), FILE_USE_INCLUDE_PATH)){
	echo 'success';
} else {
	echo 'error';
}
?>