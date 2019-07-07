<?php
include($_SERVER['DOCUMENT_ROOT'] . '/api/longbox/query.php');

// TO DO: pass username and md5
$id           = $_REQUEST['id'];
$fields       = [];
$issueColumns = [
  'format_id',
  'notes',
  'number',
  'is_color',
  'is_owned',
  'is_read',
  'publisher_id',
  'title_id',
  'year',
];

foreach ($_REQUEST as $key => $value) {
  if (in_array($key, $issueColumns)) {
    $field = "{$key} = '{$value}'";
    $fields[] = $field;
  }
}

$fields = implode(', ', $fields);
$query = "
UPDATE issues
SET {$fields}
WHERE id = '$id'";
// die($query);
$response = execute($query, 'kittenb1_longbox');

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
echo json_encode([
  'success' => false,
  'query'   => $query,
  'params'  => $_REQUEST
]);
