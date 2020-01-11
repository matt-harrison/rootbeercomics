<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/query.php');
include($_SERVER['DOCUMENT_ROOT'] . '/includes/require-superuser.php');

$table = 'mattman';
$rows  = select("SELECT * FROM $table ORDER BY id ASC", 'kittenb1_nerd');

foreach ($rows as $row) {
  $id  = $row['id'];
  $url = $row['url'];

  $url = str_replace('/projects/projects/projects/', '/projects/', $url);

  if ($url != $row['url']) {
    $query    = "UPDATE $table SET url = '$url' WHERE id = '$id'";
    // $response = execute($query, 'kittenb1_nerd');

    echo $id . ': ' . $query . '<br/>';
  }
}
