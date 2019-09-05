<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/debug.php');
include($_SERVER['DOCUMENT_ROOT'] . '/includes/secure.php');

function execute($query, $database = 'kittenb1_main') {
  global $sqlUsername, $sqlPassword;

  $con      = new mysqli('localhost', $sqlUsername, $sqlPassword, $database);
  $response = $con->query($query);

  return $response;
}

function select($query, $database = 'kittenb1_main') {
  // die($query);
  $response = execute($query, $database);
  $rows     = array();


  while ($row = $response->fetch_assoc()) {
    $rows[] = $row;
  }

  return $rows;
}
