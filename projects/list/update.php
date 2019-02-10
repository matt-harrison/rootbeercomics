<?php
$payload  = json_decode($_POST['json']);
$fileName = $payload->fileName;
$response = [];

if (file_exists($fileName . '/' . $fileName . '.json')) {
  copy($fileName . '/' . $fileName . '.json', $fileName . '/' . $fileName . '.' . time() . '.json');

  $contents      = file_get_contents($fileName . '/' . $fileName . '.json');
  $json          = json_decode($contents);
  $json->items[] = $payload->item;

  $contents = json_encode($json);
}

$response['success'] = (file_put_contents($fileName . '/' . $fileName . '.json', $contents, FILE_USE_INCLUDE_PATH));

echo json_encode($response);
