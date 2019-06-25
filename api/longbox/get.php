<?php
include($_SERVER['DOCUMENT_ROOT'] . '/api/longbox/query.php');

header('Content-Type: application/json');
echo json_encode(getData());
