<?php
include($_SERVER['DOCUMENT_ROOT'] . '/scripts/issues/query.php');

header('Content-Type: application/json');
echo json_encode(getData());
