<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/utils.php');

$username = $_REQUEST['username'];
$oldMd5   = $_REQUEST['oldMd5'];
$newMd5   = $_REQUEST['newMd5'];
$query    = "SELECT * FROM login WHERE username = '{$username}'";
$rows     = select($query, 'kittenb1_users');
$errors   = array();

if ($rows[0]['md5'] !== $oldMd5) {
  $errors[] = 'Incorrect password. Please try again.';
}

if (!$errors) {
  $query    = ("UPDATE login SET md5 = '$newMd5' WHERE username = '$username' AND md5 = '$oldMd5'");
  $response = execute($query, 'kittenb1_users');
  $user     = array(
    'isSignedIn' => true,
    'md5'        => $md5,
    'name'       => $_REQUEST['username'],
  );

  saveCookie('user', json_encode($user), 86400);
}

$response = array(
  'success' => (count($errors) === 0),
  'errors'  => $errors,
  'oldMd5'  => $oldMd5,
  'oldMd5'  => $rows[0]['md5']
);

echo json_encode($response);
