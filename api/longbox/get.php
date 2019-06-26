<?php
include($_SERVER['DOCUMENT_ROOT'] . '/api/longbox/query.php');

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
echo json_encode(getData());
