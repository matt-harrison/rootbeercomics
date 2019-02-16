<?php
header("Access-Control-Allow-Origin: *");

include($_SERVER['DOCUMENT_ROOT'] . '/includes/cookies.php');
saveCookie('username', '');

$response = array(
  'success' => true
);

echo json_encode($response);
