<?php
include($_SERVER['DOCUMENT_ROOT'] . '/api/longbox/utils.php');

requireSuperuser();

$rows    = getTitles()['results'];
$queries = [];

foreach ($rows as $row) {
  $id       = $row['id'];
  $name     = $row['name'];
  $sortName = $row['sort_name'];

  if (strpos($sortName, 'The ') === 0) {
    $sortNameUpdated = substr($sortName, 4);

    echo $id . '. ' .
      $sortName . ' >>><br/>' .
      $sortNameUpdated . '<br/><br/>';

    $queries[] = "UPDATE titles SET sort_name = '$sortNameUpdated' WHERE id = $id";
  }
}

foreach ($queries as $query) {
  echo $query . '<br/>';

  // $result = execute($query, 'kittenb1_longbox');
}
