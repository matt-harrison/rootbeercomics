<?php
// include $_SERVER['DOCUMENT_ROOT'] . '/login/secure.php';

$con = mysql_connect('localhost', 'kittenb1_matt', 'uncannyx0545');

mysql_select_db('kittenb1_users', $con);

$userName = $_GET['userName'];
$password = $_GET['password'];
$md5      = md5($userName . $password);
$query    = "SELECT * FROM login WHERE username = '{$userName}' AND md5 = '{$md5}'";
$rows     = mysql_query($query, $con);
$errors   = array();

if (count($rows)) {
  while ($row = mysql_fetch_array($rows)) {
    // submitCookie();
    echo 'success';
  }
} else {
  $errors[] ='The username "{$userName}" does not exist.';
  var_dump($errors);
}

mysql_close($con);
