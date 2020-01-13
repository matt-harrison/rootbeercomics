<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/utils.php');

$id           = $_REQUEST['id'];
$bottomId     = is_null($_REQUEST['bottomId']) ? 'null' : $_REQUEST['bottomId'];
$date         = $_REQUEST['date'];
$toWashBottom = $_REQUEST['toWashBottom'] === 'true' ? 1 : 0;
$toWashTop    = $_REQUEST['toWashTop'] === 'true' ? 1 : 0;
$topId        = is_null($_REQUEST['topId']) ? 'null' : $_REQUEST['topId'];

$query = is_null($id) ? "
  INSERT INTO outfits (
    date,
    bottom_id,
    top_id,
    to_wash_bottom,
    to_wash_top
  ) VALUES (
    '{$date}',
    '{$bottomId}',
    '{$topId}',
    '{$toWashBottom}',
    '{$toWashTop}'
  )
" : "
  UPDATE outfits
  SET
    bottom_id      = '{$bottomId}',
    top_id         = '{$topId}',
    to_wash_top    = '{$toWashTop}',
    to_wash_bottom = '{$toWashBottom}'
  WHERE id = {$id}
";

// debug($query);
// die();

$success  = execute($query, 'kittenb1_wardrobe');
$response = [
  'success' => $success,
  'query'   => $query,
  'id'      => $success ? select("SELECT id FROM outfits ORDER BY id DESC LIMIT 1", 'kittenb1_wardrobe')[0]['id'] : null
];

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
echo json_encode($response);
