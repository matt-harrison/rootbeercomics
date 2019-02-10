<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/query.php');

$data     = json_decode($_POST['data']);
$type     = $data->type;
$title    = str_replace("'", "\'", $data->title);
$date     = $data->date;
$first    = $data->first;
$response = [];

$query = "INSERT INTO list (
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

$result   = execute($query);
$response = array(
  'success' => $result,
  'query'   => $query
);

header('Content-Type: application/json');
echo json_encode($response);
