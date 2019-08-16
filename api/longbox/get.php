<?php
include($_SERVER['DOCUMENT_ROOT'] . '/api/longbox/utils.php');

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

echo json_encode(getIssuesWithContributors());
