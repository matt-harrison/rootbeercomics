<?php
header('Content-Type: application/json');

include($_SERVER['DOCUMENT_ROOT'] . '/includes/query.php');

$data     = json_decode($_POST['data']);
$username = $data->username;
$md5      = $data->md5;

$select = "SELECT * FROM login WHERE username = '{$username}'";
$rows   = select($select, 'kittenb1_users');
$errors = array();

if ($username !== 'matt!' || $md5 !== $rows[0]['md5']) {
  $errors[] = 'Permission denied.';
}

if (count($errors) < 1) {
  $type     = $data->item->type;
  $title    = str_replace("'", "\'", $data->item->title);
  $date     = $data->item->date;
  $first    = $data->item->first;
  $response = [];

  $insert = "INSERT INTO list (
    type,
    title,
    date,
    first
  ) VALUES (
    '$type',
    '$title',
    '$date',
    '$first'
  )";

  $result = execute($insert);

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

echo json_encode($response);
