<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/cookies.php');
include($_SERVER['DOCUMENT_ROOT'] . '/includes/query.php');

$username    = $_COOKIE['username'];
$oldPassword = $_REQUEST['oldPassword'];
$password1   = $_REQUEST['password1'];
$password2   = $_REQUEST['password2'];
$oldMd5      = md5($username . $oldPassword);
$md5         = md5($username . $password1);
$query       = "SELECT * FROM login WHERE username = '{$username}'";
$rows        = select($query, 'kittenb1_users');
$errors      = array();

if ($rows[0]['md5'] !== $oldMd5) {
  $errors[] = 'Incorrect password. Please try again.';
}

if ($password1 !== $password2) {
  $errors[] = 'Passwords did not match. Please try again.';
}

if (!$errors) {
  $query    = ("UPDATE login SET md5 = '$md5' WHERE username = '$username' AND md5 = '$oldMd5'");
  $response = execute($query, 'kittenb1_users');
}

$response = array(
  'success' => (count($errors) === 0),
  'errors'  => $errors
);

echo json_encode($response);
