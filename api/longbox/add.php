<?php
include($_SERVER['DOCUMENT_ROOT'] . '/api/longbox/utils.php');

$errors   = [];
$queries  = [];
$issueIds = [];

$md5          = $_REQUEST['md5'];
$superuserMd5 = select("SELECT * FROM login WHERE username = 'matt!'", 'kittenb1_users')[0]['md5'];

if ($md5 !== $superuserMd5) {
  $errors[] = 'Permission denied.';
}

if (count($errors) < 1) {
  $con          = getConnection('kittenb1_longbox');
  $issue        = json_decode($_REQUEST['issue']);
  $contributors = $issue->contributors;
  $format       = $issue->format;
  $isColor      = $issue->is_color ? 'true' : 'false';
  $isOwned      = $issue->is_owned ? 'true' : 'false';
  $isRead       = $issue->is_read  ? 'true' : 'false';
  $notes        = mysqli_real_escape_string($con, $issue->notes);
  $numbers      = $issue->numbers;
  $publisher    = mysqli_real_escape_string($con, $issue->publisher);
  $sortTitle    = mysqli_real_escape_string($con, $issue->sort_title);
  $title        = mysqli_real_escape_string($con, $issue->title);
  $year         = $issue->year === null ? 'null' : $issue->year;

  if (empty($format)) {
    $formatId = 'NULL';
  } else {
    $formatLower = strtolower($format);
    $query       = "SELECT * from formats WHERE lower(name) = '{$formatLower}' LIMIT 1";
    $result      = select($query, 'kittenb1_longbox');
    $formatId    = $result[0]['id'];
    $queries[]   = $query;

    if (is_null($formatId)) {
      $query     = "INSERT INTO formats (name) VALUES ('{$format}')";
      $result    = execute($query, 'kittenb1_longbox');
      $formatId  = select("SELECT id FROM formats ORDER BY id DESC LIMIT 1", 'kittenb1_longbox')[0]['id'];
      $queries[] = $query;
    }
  }

  if (empty($title)) {
    $titleId = 'NULL';
  } else {
    $titleLower = strtolower($title);
    $query      = "SELECT * from titles WHERE lower(name) = '{$titleLower}' LIMIT 1";
    $result     = select($query, 'kittenb1_longbox');
    $titleId    = $result[0]['id'];
    $queries[]  = $query;

    if (is_null($titleId)) {
      $query     = "INSERT INTO titles (name, sort_name) VALUES ('{$title}', '{$sortTitle}')";
      $result    = execute($query, 'kittenb1_longbox');
      $titleId   = select("SELECT id FROM titles ORDER BY id DESC LIMIT 1", 'kittenb1_longbox')[0]['id'];
      $queries[] = $query;
    }
  }

  if (empty($publisher)) {
    $publisherId = 'NULL';
  } else {
    $publisherLower = strtolower($publisher);
    $result         = select("SELECT * from publishers WHERE lower(name) = '{$publisherLower}' LIMIT 1", 'kittenb1_longbox');
    $publisherId    = $result[0]['id'];

    if (is_null($publisherId)) {
      $query       = "INSERT INTO publishers (name) VALUES ('{$publisher}')";
      $result      = execute($query, 'kittenb1_longbox');
      $publisherId = select("SELECT id FROM publishers ORDER BY id DESC LIMIT 1", 'kittenb1_longbox')[0]['id'];
      $queries[]   = $query;
    }
  }

  foreach ($numbers as $number) {
    $numberFilter = $number === 'NULL' ? "number IS NULL" : "number = '{$number}'";
    $notesFilter  = "number = '{$number}'";
    $query =
    "SELECT * from issues
      WHERE title_id = '{$titleId}'
      AND {$numberFilter}
      LIMIT 1";
    $result    = select($query, 'kittenb1_longbox');
    $issue     = $result[0];
    $queries[] = $query;

    if (is_null($issue)) {
      $query =
      "INSERT INTO issues (
        title_id,
        publisher_id,
        format_id,
        number,
        notes,
        year,
        is_read,
        is_owned,
        is_color
      ) VALUES (
        {$titleId},
        {$publisherId},
        {$formatId},
        {$number},
        '{$notes}',
        {$year},
        {$isRead},
        {$isOwned},
        {$isColor}
      )";

      $result     = execute($query, 'kittenb1_longbox');
      $issueId    = select("SELECT id FROM issues ORDER BY id DESC LIMIT 1", 'kittenb1_longbox')[0]['id'];
      $issueIds[] = $issueId;
      $queries[]  = $query;

      if (!$result) {
        $errors[] = 'An error occured while attempting to insert issue data. Please try again.';
      }

      if (!empty($issueId) && !empty($contributors)) {
        foreach ($contributors as $contributor) {
          $creatorId      = getCreatorId($contributor->creator);
          $creatorTypeId  = getCreatorTypeId($contributor->creator_type);
          $query =
          "INSERT INTO contributors (
            creator_id,
            creator_type_id,
            issue_id
          ) VALUES (
            {$creatorId},
            {$creatorTypeId},
            {$issueId}
          )";
          $result    = execute($query, 'kittenb1_longbox');
          $queries[] = $query;

          if (!$result) {
            $errors[] = 'An error occured while attempting to insert contributor data. Please try again.';
          }
        }
      }
    }
  }
}

$response = array(
  'success' => (count($errors) < 1),
  'errors'  => $errors,
  'params'  => $_REQUEST,
  'issues'  => $issueIds,
  'queries' => $queries
);

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
echo json_encode($response);
