<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/debug.php');
include($_SERVER['DOCUMENT_ROOT'] . '/includes/secure.php');

function execute($query, $database = 'kittenb1_main') {
  global $sqlUsername, $sqlPassword;

  $rows     = array();
  $con      = new mysqli('localhost', $sqlUsername, $sqlPassword, $database);
  $response = $con->query($query);

  return $response;
}

function select($query, $database = 'kittenb1_main') {
  $response = execute($query, $database);

  while ($row = $response->fetch_assoc()) {
    $rows[] = $row;
  }

  return $rows;
}