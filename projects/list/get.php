<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/query.php');

$where    = ($_REQUEST['type']) ? ' WHERE type = "' . $_REQUEST['type'] . '"' : '';
$query    = 'SELECT * from list' . $where . ' ORDER BY id';
$response = select($query);
$data     = array('items' => $response);
$json     = json_encode($data);

header('Content-Type: application/json');
echo $json;
