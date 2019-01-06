<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/cookies.php');
include($_SERVER['DOCUMENT_ROOT'] . '/includes/execute-query.php');

$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
$md5      = md5($username . $password);
$query    = "SELECT * FROM login WHERE username = '{$username}' AND md5 = '{$md5}'";
$rows     = select($query, 'kittenb1_users');
$errors   = array();

if (count($rows) === 1) {
  saveCookie('username', $username, 86400);
} else {
  $errors[] = 'The username "' . $username . '" does not exist.';
}

$response = array(
  'success' => (count($errors) === 0),
  'errors'  => $errors
);

echo json_encode($response);
