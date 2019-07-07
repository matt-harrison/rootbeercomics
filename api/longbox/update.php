<?php
include($_SERVER['DOCUMENT_ROOT'] . '/api/longbox/query.php');

$username = $_REQUEST['username'];
$md5      = $_REQUEST['md5'];

$errors   = [];
$queries  = [];

$select   = "SELECT * FROM login WHERE username = '{$username}'";
$rows     = select($select, 'kittenb1_users');

if ($username !== 'matt!' || $md5 !== $rows[0]['md5']) {
  $errors[] = 'Permission denied.';
}

if (count($errors) < 1) {
  $issue              = json_decode($_REQUEST['issue']);
  $contributors       = $issue->contributors;
  $contributorColumns = [
    'issue_id',
    'creator_id',
    'creator_type_id'
  ];
  $issueFields  = [];
  $issueId      = $issue->id;
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

  if (count($contributors) > 0) {
    $creators     = getCreators();
    $creatorTypes = getCreatorTypes();
    $formats      = getFormats();
    $publishers   = getPublishers();
    $titles       = getTitles();

    foreach ($contributors as &$contributor) {
      $contributorId     = $contributor->id;
      $contributorFields = [
        "issue_id = '{$issueId}'"
      ];

      unset($contributor->id);
      unset($contributor->issue_id);

      // Clear records for emptied contributors
      if ($contributor->creator === '' || $contributor->creator_type === '') {
        $query  = "DELETE FROM contributors WHERE id = {$contributorId}";
        $result = execute($query, 'kittenb1_longbox');

        $queries[] = $query;
      } else {
        foreach ($contributor as $key => $value) {
          // Find existing Creator record
          foreach ($creators['results'] as $creator) {
            if ($contributor->creator === $creator['name']) {
              $creatorId = $creator['id'];
            }
          }

          // Find existing Creator Type record
          foreach ($creatorTypes['results'] as $creatorType) {
            if ($contributor->creator_type === $creatorType['name']) {
              $creatorTypeId = $creatorType['id'];
            }
          }
        }

        if ($creatorId !== $contributor->creator_id) {
          $contributor->creator_id = $creatorId;
        } else {
          //TO DO: add Creator
        }

        if ($creatorTypeId !== $contributor->creator_type_id) {
          $contributor->creator_type_id = $creatorTypeId;
        } else {
          // TO DO: add Creator Type
        }

        // Build SET clause
        foreach ($contributor as $key => $value) {
          if (in_array($key, $contributorColumns)) {
            $contributorField    = "{$key} = '{$value}'";
            $contributorFields[] = $contributorField;
          }
        }

        $contributorFields = implode(', ', $contributorFields);
        $query = "
        UPDATE contributors
        SET {$contributorFields}
        WHERE id = '$contributorId'";
        $result = execute($query, 'kittenb1_longbox');

        $queries[] = $query;
      }

      if (!$result) {
        $errors[] = 'An error occured while attempting to update contributor data. Please try again.';
      }
    }
  }

  foreach ($issue as $key => $value) {
    if (in_array($key, $issueColumns)) {
      if (in_array($key, ['number', 'year']) && $value === '') {
        $value = 'NULL';
      }

      $issueField    = $value === 'NULL' ? "{$key} = {$value}" : "{$key} = '{$value}'";
      $issueFields[] = $issueField;
    }
  }

  $issueFields = implode(', ', $issueFields);
  $query = "
  UPDATE issues
  SET {$issueFields}
  WHERE id = '$issueId'";
  $result = execute($query, 'kittenb1_longbox');

  $queries[] = $query;

  if (!$result) {
    $errors[] = 'An error occured while attempting to update issue data. Please try again.';
  }
}

$response = array(
  'success' => (count($errors) < 1),
  'errors'  => $errors,
  'issue'   => $issue,
  'queries' => $queries
);

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
echo json_encode($response);
