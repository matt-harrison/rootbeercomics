<?php
include($_SERVER['DOCUMENT_ROOT'] . '/api/longbox/utils.php');

$username = $_REQUEST['username'];
$md5      = $_REQUEST['md5'];
$issue     = json_decode($_REQUEST['issue']);
$format    = $issue->format;
$isColor   = $issue->is_color ? 'true' : 'false';
$isOwned   = $issue->is_owned ? 'true' : 'false';
$isRead    = $issue->is_read  ? 'true' : 'false';
$notes     = $issue->notes;
$number    = $issue->number;
$publisher = $issue->publisher;
$sortTitle = $issue->sort_title;
$title     = $issue->title;
$year      = $issue->year;

$errors   = [];
$queries  = [];

if ($format === 'NULL') {
  $formatId = 'NULL';
} else {
  $formatLower = strtolower($format);
  $response    = select("SELECT * from formats WHERE lower(name) = '{$formatLower}' LIMIT 1", 'kittenb1_longbox');
  $formatId    = $response[0]['id'];

  // for now, do not allow inserting formats from the add form
  /*
  if (is_null($formatId)) {
    execute("INSERT INTO formats (name) VALUES ('{$format}')", 'kittenb1_longbox');
    $formatId = select("SELECT id FROM formats ORDER BY id DESC LIMIT 1", 'kittenb1_longbox')[0]['id'];
  }
  */
}

if ($title === 'NULL') {
  $titleId = 'NULL';
} else {
  $titleLower = strtolower($title);
  $response   = select("SELECT * from titles WHERE lower(name) = '{$titleLower}' LIMIT 1", 'kittenb1_longbox');
  $titleId    = $response[0]['id'];

  if (is_null($titleId)) {
    execute("INSERT INTO titles (name, sort_name) VALUES ('{$title}, {$sortTitle}')", 'kittenb1_longbox');
    $titleId = select("SELECT id FROM titles ORDER BY id DESC LIMIT 1", 'kittenb1_longbox')[0]['id'];
  }
}

if ($publisher === 'NULL') {
  $publisherId = 'NULL';
} else {
  $publisherLower = strtolower($publisher);
  $response       = select("SELECT * from publishers WHERE lower(name) = '{$publisherLower}' LIMIT 1", 'kittenb1_longbox');
  $publisherId    = $response[0]['id'];

  if (is_null($publisherId)) {
    execute("INSERT INTO publishers (name) VALUES ('{$publisher}')", 'kittenb1_longbox');
    $publisherId = select("SELECT id FROM publishers ORDER BY id DESC LIMIT 1", 'kittenb1_longbox')[0]['id'];
  }
}

//INSERT INTO ISSUE
$numberFilter = $number === 'NULL' ? "number IS NULL" : "number = '{$number}'";
$notesFilter  = "number = '{$number}'";
$query =
"SELECT * from issues
  WHERE title_id = '{$titleId}'
  AND notes = '{$notes}'
  AND {$numberFilter}
  LIMIT 1";
$response  = select($query, 'kittenb1_longbox');
$issue     = $response[0];
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

  $result    = execute($query, 'kittenb1_longbox');
  $issueId   = select("SELECT id FROM issues ORDER BY id DESC LIMIT 1", 'kittenb1_longbox')[0]['id'];
  $queries[] = $query;
}

/*
if (!empty($writers)) {
  $writers = explode("\r\n", $writers);
  $writerIds = [];

  foreach ($writers as $writer) {
    $response = select("SELECT * from creators WHERE name = '{$writer}' LIMIT 1", 'kittenb1_longbox');
    $writerId = $response[0]['id'];

    if (is_null($writerId)) {
      execute("INSERT INTO creators (name) VALUES ('{$writer}')", 'kittenb1_longbox');
      $writerId = select("SELECT id FROM creators ORDER BY id DESC LIMIT 1", 'kittenb1_longbox')[0]['id'];
    }

    $writerIds[] = $writerId;
  }

  foreach ($writerIds as $writerId) {
    $query =
    "SELECT * from contributors
    WHERE issue_id = '{$issueId}'
    AND creator_id = '{$writerId}'
    AND creator_type_id = 3
    LIMIT 1";
    $response = select($query, 'kittenb1_longbox');
    $hasWriter = $response[0];

    if (!$hasWriter) {
      $query =
      "INSERT INTO contributors (
        issue_id,
        creator_id,
        creator_type_id
      ) VALUES (
        $issueId,
        {$writerId},
        3
      )";

      execute($query, 'kittenb1_longbox');
    }
  }
}

if (!empty($coverArtists)) {
  $coverArtists = explode("\r\n", $coverArtists);
  $coverArtistIds = [];

  foreach ($coverArtists as $coverArtist) {
    $response = select("SELECT * from creators WHERE name = '{$coverArtist}' LIMIT 1", 'kittenb1_longbox');
    $coverArtistId = $response[0]['id'];

    if (is_null($coverArtistId)) {
      execute("INSERT INTO creators (name) VALUES ('{$coverArtist}')", 'kittenb1_longbox');
      $coverArtistId = select("SELECT id FROM creators ORDER BY id DESC LIMIT 1", 'kittenb1_longbox')[0]['id'];
    }

    $coverArtistIds[] = $coverArtistId;
  }

  foreach ($coverArtistIds as $coverArtistId) {
    $query =
    "SELECT * from contributors
    WHERE issue_id = '{$issueId}'
    AND creator_id = '{$coverArtistId}'
    AND creator_type_id = 1
    LIMIT 1";
    $response = select($query, 'kittenb1_longbox');
    $hasCoverArtist = $response[0];

    if (!$hasCoverArtist) {
      $query =
      "INSERT INTO contributors (
        issue_id,
        creator_id,
        creator_type_id
      ) VALUES (
        $issueId,
        {$coverArtistId},
        1
      )";

      execute($query, 'kittenb1_longbox');
    }
  }
}

if (!empty($interiorArtists)) {
  $interiorArtists = explode("\r\n", $interiorArtists);
  $interiorArtistIds = [];

  foreach ($interiorArtists as $interiorArtist) {
    $response = select("SELECT * from creators WHERE name = '{$interiorArtist}' LIMIT 1", 'kittenb1_longbox');
    $interiorArtistId = $response[0]['id'];

    if (is_null($interiorArtistId)) {
      execute("INSERT INTO creators (name) VALUES ('{$interiorArtist}')", 'kittenb1_longbox');
      $interiorArtistId = select("SELECT id FROM creators ORDER BY id DESC LIMIT 1", 'kittenb1_longbox')[0]['id'];
    }

    $interiorArtistIds[] = $interiorArtistId;
  }

  foreach ($interiorArtistIds as $interiorArtistId) {
    $query =
    "SELECT * from contributors
    WHERE issue_id = '{$issueId}'
    AND creator_id = '{$interiorArtistId}'
    AND creator_type_id = 2
    LIMIT 1";
    $response = select($query, 'kittenb1_longbox');
    $hasInteriorArtist = $response[0];

    if (!$hasInteriorArtist) {
      $query =
      "INSERT INTO contributors (
        issue_id,
        creator_id,
        creator_type_id
      ) VALUES (
        $issueId,
        {$interiorArtistId},
        2
      )";

      execute($query, 'kittenb1_longbox');
    }
  }
}
*/


if (!$result) {
  $errors[] = 'An error occured while attempting to add issue data. Please try again.';
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
