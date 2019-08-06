<?php
include($_SERVER['DOCUMENT_ROOT'] . '/api/longbox/utils.php');

$rows = getTitles()['results'];

foreach ($rows as $row) {
  $id       = $row['id'];
  $name     = $row['name'];
  $sortName = preg_replace('/^The /', '', $name);
  $sortName = str_replace("'", "\'", $sortName);

  if (empty($row['sort_name'])) {
    echo $id . '. ' . $name . ' >>> ' . $sortName . '<br/>';

    $query = "
      UPDATE titles
      SET sort_name = '$sortName'
      WHERE id = '$id'";
    // echo $query . '<br/>';
    // $response = execute($query, 'kittenb1_longbox');
  }
}
