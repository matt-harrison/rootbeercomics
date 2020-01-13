<?php
header("Access-Control-Allow-Origin: *");

include($_SERVER['DOCUMENT_ROOT'] . '/includes/utils.php');

$username = $_REQUEST['username'];
$md5      = $_REQUEST['md5'];
$query    = "SELECT * FROM login WHERE username = '{$username}'";
$rows     = select($query, 'kittenb1_users');
$errors   = array();

if (count($rows) < 1) {
  $errors[] = 'The username "' . $username . '" does not exist.';
} elseif ($rows[0]['md5'] !== $md5) {
  $errors[] = 'Incorrect password. Please try again.';
}

if (count($errors) < 1) {
  $user = array(
    'isAdmin'    => ($_REQUEST['username'] === 'matt!'),
    'isSignedIn' => true,
    'md5'        => $md5,
    'name'       => $_REQUEST['username'],
  );

  saveCookie('user', json_encode($user), 86400);
}

$response = array(
  'success' => (count($errors) === 0),
  'errors'  => $errors
);

echo json_encode($response);
