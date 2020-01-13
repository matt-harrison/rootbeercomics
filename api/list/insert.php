<?php

include($_SERVER['DOCUMENT_ROOT'] . '/includes/utils.php');

$data   = json_decode($_REQUEST['data']);
$errors = array();

if (!isSuperuser()) {
  $errors[] = 'Permission denied.';
}

if (count($errors) < 1) {
  $type     = $data->item->type;
  $title    = str_replace("'", "\'", $data->item->title);
  $date     = $data->item->date;
  $isFirst  = $data->item->isFirst;
  $response = [];

  $insert = "INSERT INTO list (
    type,
    title,
    date,
    isFirst
  ) VALUES (
    '$type',
    '$title',
    '$date',
    '$isFirst'
  )";

  $result = execute($insert, 'kittenb1_list');

  if (!$result) {
    $errors[] = 'An error occured. Please try again.';
  }
}

$response = array(
  'success' => (count($errors) < 1),
  'errors'  => $errors,
  'data' => $data,
  'select' => $select,
  'insert' => $insert
);

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
echo json_encode($response);
