<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/secure.php');
include($_SERVER['DOCUMENT_ROOT'] . '/includes/user.php');

function debug($subject, $indention = 0) {
  if ($indention === 0) {
    echo '<pre>';
  }

  switch (gettype($subject)) {
    case 'array':
    case 'object':
      if ($indention > 0) {
        echo '<br/>';
      }

      foreach ($subject as $key => $value) {
        echo str_repeat('  ', $indention) . $key . ': ';
        debug($value, $indention + 1);
      }
      break;
    case 'NULL':
      echo 'NULL<br/>';
      break;
    case 'boolean':
      echo (($subject) ? 'TRUE' : 'FALSE') . '<br/>';
      break;
    case 'double':
    case 'integer':
    case 'string':
      echo $subject . '<br/>';
      break;
  }

  if ($indention === 0) {
    echo '</pre>';
  }
}

function escapeSpecialCharacters($input) {
  $output = $input;
  $output = str_replace("'", '\&apos;', $output);
  $output = str_replace('"', "\&quot;", $output);

  return $output;
}

function execute($query, $database = 'kittenb1_main') {
  $con      = getConnection($database);
  $response = $con->query($query);

  return $response;
}

function getConnection($database = 'kittenb1_main') {
  global $sqlUsername, $sqlPassword;

  $con = new mysqli('localhost', $sqlUsername, $sqlPassword, $database);

  return $con;
}

function isSuperuser() {
  global $user;

  $md5 = select("SELECT * FROM login WHERE username = '{$user->name}'", 'kittenb1_users')[0]['md5'];

  return $user->name === 'matt!' && $user->md5 === $md5;
}

function saveCookie($name, $value = '', $interval = 0) {
  $expire = time() + $interval;
  setcookie($name, $value, $expire, '/');
}

function select($query, $database = 'kittenb1_main') {
  $response = execute($query, $database);
  $rows     = array();

  while ($row = $response->fetch_assoc()) {
    $rows[] = $row;
  }

  return $rows;
}

function requireSuperuser() {
  global $user;

  if (!isSuperuser()) {
    header('Location: /login');
  }
}
