<?php
include($_SERVER['DOCUMENT_ROOT'] . '/api/longbox/utils.php');

$data = getData();

foreach ($data['issues']['results'] as $issue) {
  $id       = $issue['id'];
  $name     = $issue['name'];
  $year     = $issue['year'];
  $position = strpos($name, ', Vol. ');

  if ($year === '0') {
    echo $id . '. ' . $issue['title'] . ' ' . $issue['year'] . '<br/>';

    $query = "
      UPDATE issues
      SET year = NULL
      WHERE id = '$id'";
    // echo $query . '<br/>';
    // $response = execute($query, 'kittenb1_longbox');
  }
}
