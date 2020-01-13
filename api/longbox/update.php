<?php
include($_SERVER['DOCUMENT_ROOT'] . '/api/longbox/utils.php');

$errors   = [];
$queries  = [];

if (!isSuperuser()) {
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

  foreach ($contributors as &$contributor) {
    $contributorId     = $contributor->id;
    $contributorFields = [
      "issue_id = '{$issueId}'"
    ];

    unset($contributor->id);
    unset($contributor->issue_id);

    // Clear records for emptied contributors
    if ($contributor->creator === '' || $contributor->creator_type === '') {
      $query     = "DELETE FROM contributors WHERE id = {$contributorId}";
      $result    = execute($query, 'kittenb1_longbox');
      $queries[] = $query;

      if (!$result) {
        $errors[] = 'An error occured while attempting to delete contributor data. Please try again.';
      }
    } else {
      $contributor->title_id        = getTitleId($contributor->title);
      $contributor->creator_id      = getCreatorId($contributor->creator);
      $contributor->creator_type_id = getCreatorTypeId($contributor->creator_type);

      foreach ($contributor as $key => $value) {
        if (in_array($key, $contributorColumns)) {
          $contributorField    = "{$key} = '{$value}'";
          $contributorFields[] = $contributorField;
        }
      }

      $contributorFields = implode(', ', $contributorFields);

      if (empty($contributorId)) {
        $query = "
        INSERT INTO contributors (
          creator_id,
          creator_type_id,
          issue_id
        ) VALUES (
          '{$contributor->creator_id}',
          '{$contributor->creator_type_id}',
          '{$issueId}'
        )";
      } else {
        $query = "
        UPDATE contributors
        SET {$contributorFields}
        WHERE id = '{$contributorId}'";
      }

      $result    = execute($query, 'kittenb1_longbox');
      $queries[] = $query;
    }

    if (!$result) {
      $errors[] = 'An error occured while attempting to update contributor data. Please try again.';
    }
  }

  $issue->format_id    = getFormatId($issue->format);
  $issue->publisher_id = getPublisherId($issue->publisher);
  $issue->title_id     = getTitleId($issue->title);

  foreach ($issue as $key => $value) {
    if (in_array($key, $issueColumns)) {
      $issueField    = $value === '' || $value === null ? "{$key} = NULL" : "{$key} = '{$value}'";
      $issueFields[] = $issueField;
    }
  }

  $issueFields = implode(', ', $issueFields);
  $query = "
  UPDATE issues
  SET {$issueFields}
  WHERE id = '$issueId'";
  $result    = execute($query, 'kittenb1_longbox');
  $queries[] = $query;

  if (!$result) {
    $errors[] = 'An error occured while attempting to update issue data. Please try again.';
  }
}

$response = array(
  'success' => (count($errors) < 1),
  'errors'  => $errors,
  'params'  => $_REQUEST,
  'queries' => $queries
);

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
echo json_encode($response);
