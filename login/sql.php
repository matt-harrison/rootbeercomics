<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/cookies.php');
include($_SERVER['DOCUMENT_ROOT'] . '/includes/execute-query.php');

switch ($_REQUEST['action']) {
  case 'log-in':
    logIn();
    break;
  case 'update':
    updateUser();
    break;
  case 'create':
    createUser();
    break;
}

function logIn() {
  $username = $_REQUEST['username'];
  $password = $_REQUEST['password'];
  $md5      = md5($username . $password);
  $query    = "SELECT * FROM login WHERE username = '{$username}' AND md5 = '{$md5}'";
  $rows     = select('kittenb1_main', $query);
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
}

function createUser() {
  $username          = $_REQUEST['username'];
  $firstName         = $_REQUEST['firstName'];
  $lastName          = $_REQUEST['lastName'];
  $email             = $_REQUEST['email'];
  $password1         = $_REQUEST['password1'];
  $password2         = $_REQUEST['password2'];
  $md5               = md5($username . $password1);
  $emailHasAt        = (strpos($_REQUEST['email'], '@') > -1);
  $emailHasDot       = (strpos($_REQUEST['email'], '.') > -1);
  $nameHasApostrophe = (strpos($_REQUEST['username'], "'") > -1);
  $nameHasDollar     = (strpos($_REQUEST["username"], "$") > -1);
  $nameHasQuote      = (strpos($_REQUEST["username"], '"') > -1);
  $errors            = array();

  if ($username == '' || $firstName == '' || $lastName == '' || $email == '' || $password1 == '') {
    $errors[] = 'All fields are currently required. please try again.';
  }

  if ($nameHasApostrophe || $nameHasDollar || $nameHasQuote) {
    $errors[] = 'Usernames may not contain some of those characters. Please try again.';
  }

  if (!$emailHasAt || !$emailHasDot) {
    $errors[] = 'Please supply a valid email address.';
  }

  if ($password1 !== $password2) {
    $errors[] = 'Your passwords did not match. Please try again.';
  }

  $query = "SELECT * FROM login WHERE username = '{$username}'";
  $rows  = select('kittenb1_main', $query);

  if (count($rows) > 0) {
    $errors[] = 'That username already exists.';
  }

  $query = "SELECT * FROM login WHERE email = '$email'";
  $rows  = select('kittenb1_main', $query);

  if (count($rows) > 0) {
    $errors[] = 'That email address is already registered.';
  }

  if (!$errors) {
    $query = "INSERT INTO login (username, firstName, lastName, email, md5) VALUES ('$username', '$firstName', '$lastName', '$email', '$md5')";
    $rows  = select('kittenb1_main', $query);

    saveCookie('username', $username, 86400);
  }

  $response = array(
    'success' => (count($errors) === 0),
    'errors'  => $errors
  );

  echo json_encode($response);
}

function updateUser() {
  $username    = $_COOKIE['username'];
  $oldPassword = $_REQUEST['oldPassword'];
  $password1   = $_REQUEST['password1'];
  $password2   = $_REQUEST['password2'];
  $oldMd5      = md5($username . $oldPassword);
  $md5         = md5($username . $password1);
  $query       = "SELECT * FROM login WHERE username = '{$username}'";
  $rows        = select('kittenb1_main', $query);
  $errors      = array();

  if ($rows[0]['md5'] !== $oldMd5) {
    $errors[] = 'Incorrect password. Please try again.';
  }

  if ($password1 !== $password2) {
    $errors[] = 'Passwords did not match. Please try again.';
  }

  if (!$errors) {
    $query    = ("UPDATE login SET md5 = '$md5' WHERE username = '$username' AND md5 = '$oldMd5'");
    $response = select('kittenb1_main', $query);
  }

  $response = array(
    'success' => (count($errors) === 0),
    'errors'  => $errors
  );

  echo json_encode($response);
}
