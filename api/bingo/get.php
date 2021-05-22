<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include($_SERVER['DOCUMENT_ROOT'] . '/includes/utils.php');

$slug   = $_REQUEST['slug'];
$where  = ($_REQUEST['slug']) ? " WHERE slug = '$slug'" : "";
$boards = select("SELECT * from boards $where ORDER BY label ASC", 'kittenb1_bingo');

foreach ($boards as $index => $board) {
  $slug                      = $board['slug'];
  $query                     = "SELECT * from squares WHERE board = '$slug' ORDER BY label ASC";
  $squares                   = select($query, 'kittenb1_bingo');
  $boards[$index]['squares'] = $squares;
}

echo json_encode($boards);
