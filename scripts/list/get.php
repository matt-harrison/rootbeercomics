<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include($_SERVER['DOCUMENT_ROOT'] . '/includes/query.php');

$where    = ($_REQUEST['type']) ? ' WHERE type = "' . $_REQUEST['type'] . '"' : '';
$query    = 'SELECT * from list' . $where . ' ORDER BY date ASC, id ASC';
$response = select($query);
$data     = array('items' => $response);
$json     = json_encode($data);

echo $json;
