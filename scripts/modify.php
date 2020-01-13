<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/user.php');
include($_SERVER['DOCUMENT_ROOT'] . '/includes/require-superuser.php');
include($_SERVER['DOCUMENT_ROOT'] . '/includes/query.php');

$table = 'mattman';
$rows  = select("SELECT * FROM $table ORDER BY id ASC", 'kittenb1_nerd');

foreach ($rows as $row) {
  $id  = $row['id'];
  $url = $row['url'];

  $url = str_replace('', '', $url);

  if ($url != $row['url']) {
    $query    = "UPDATE $table SET url = '$url' WHERE id = '$id'";
    // $response = execute($query, 'kittenb1_nerd');

    echo $id . ': ' . $query . '<br/>';
  }
}
