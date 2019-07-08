<?php
include($_SERVER['DOCUMENT_ROOT'] . '/api/longbox/utils.php');

$rows = getContributors()['results'];

foreach ($rows as $row) {
  $id        = $row['id'];
  $creatorId = $row['creator_id'];

  if ($creatorId === '10') {
    echo $id . '. ' . $row['name'] . '<br/>';

    $query = "
      UPDATE creators
      SET creator_id = NULL
      WHERE id = '$id'";
    // echo $query . '<br/>';
    // $response = execute($query, 'kittenb1_longbox');
  }
}
