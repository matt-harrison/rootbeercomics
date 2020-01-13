<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include($_SERVER['DOCUMENT_ROOT'] . '/includes/utils.php');

$where    = ($_REQUEST['type']) ? ' WHERE type = "' . $_REQUEST['type'] . '"' : '';
$response = select("SELECT * from list $where ORDER BY date ASC, id ASC", 'kittenb1_list');
$data     = array('items' => $response);
$json     = json_encode($data);

echo $json;
