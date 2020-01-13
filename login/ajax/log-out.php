<?php
header("Access-Control-Allow-Origin: *");

include($_SERVER['DOCUMENT_ROOT'] . '/includes/utils.php');
saveCookie('user', '');

$response = array(
  'success' => true
);

echo json_encode($response);
