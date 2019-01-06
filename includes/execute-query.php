<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/secure.php');
include($_SERVER['DOCUMENT_ROOT'] . '/includes/debug.php');

function executeQuery($database, $query) {
  global $sqlUsername, $sqlPassword;

  $rows     = array();
  $con      = new mysqli('localhost', $sqlUsername, $sqlPassword, $database);
  $response = $con->query($query);

  return $response;
}

function select($database, $query) {
  $response = executeQuery($database, $query);

  while ($row = $response->fetch_assoc()) {
    $rows[] = $row;
  }

  return $rows;
}
