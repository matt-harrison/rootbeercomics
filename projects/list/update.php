<?php
$json     = json_decode($_POST['json']);
$fileName = $json->fileName;
$data     = json_encode($json->data);

if (file_exists($fileName . '/' . $fileName . '.json')) {
  rename($fileName . '/' . $fileName . '.json', $fileName . '/' . $fileName . '.' . time() . '.json');
}

if (file_put_contents($fileName . '/' . $fileName . '.json', $data, FILE_USE_INCLUDE_PATH)) {
  echo 'success';
} else {
  echo 'error';
}
