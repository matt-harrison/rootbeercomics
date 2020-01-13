<?php
include($_SERVER['DOCUMENT_ROOT'] . '/api/longbox/utils.php');

requireSuperuser();

$rows = getIssuesWithContributors()['issues']['results'];

foreach ($rows as $row) {
  $id           = $row['id'];
  $title        = $row['title'];
  $contributors = $row['contributors'];
  $creators     = [];
  $cartoonists  = [];

  if (count($contributors) > 0) {
    foreach ($contributors as $contributor) {
      if (!in_array($contributor['creator'], $creators) && $contributor['creator_type'] !== 'cartoonist') {
        $creators[] = $contributor['creator'];
      }
    }

    if (count($creators) === 1 && $contributors[0]['creator_type'] === 'writer' && $contributors[1]['creator_type'] === 'cover' && $contributors[2]['creator_type'] === 'penciller') {
      echo $id . '. ' . $title . '<br/>';

      foreach ($contributors as $key => $contributor) {
        $contributorId = $contributor['id'];

        if ($key === 0) {
          $query = "UPDATE contributors SET creator_type_id = '9' WHERE id = '{$contributorId}'";
        } else {
          $query = "DELETE FROM contributors WHERE id = {$contributorId}";
        }

        echo $key . ': ' . $query . '<br/>';
        // $result = execute($query, 'kittenb1_longbox');
      }

      echo '<br/>';
    }
  }
}
