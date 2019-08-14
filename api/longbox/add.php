<?php
include($_SERVER['DOCUMENT_ROOT'] . '/api/longbox/utils.php');

$username  = $_REQUEST['username'];
$md5       = $_REQUEST['md5'];
$issue     = json_decode($_REQUEST['issue']);
$format    = $issue->format;
$isColor   = $issue->is_color ? 'true' : 'false';
$isOwned   = $issue->is_owned ? 'true' : 'false';
$isRead    = $issue->is_read  ? 'true' : 'false';
$notes     = $issue->notes;
$numbers   = getNumbers($issue->number);
$publisher = $issue->publisher;
$sortTitle = $issue->sort_title;
$title     = $issue->title;
$year      = $issue->year;

$errors   = [];
$queries  = [];

if (empty($format)) {
  $formatId = 'NULL';
} else {
  $formatLower = strtolower($format);
  $query       = "SELECT * from formats WHERE lower(name) = '{$formatLower}' LIMIT 1";
  $result      = select($query, 'kittenb1_longbox');
  $formatId    = $result[0]['id'];
  $queries[]   = $query;

  // for now, do not allow inserting formats from the add form
  /*
  if (is_null($formatId)) {
    $query     = "INSERT INTO formats (name) VALUES ('{$format}')";
    $result    = execute($query, 'kittenb1_longbox');
    $formatId  = select("SELECT id FROM formats ORDER BY id DESC LIMIT 1", 'kittenb1_longbox')[0]['id'];
    $queries[] = $query;
  }
  */
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
    $query     = "INSERT INTO titles (name, sort_name) VALUES ('{$title}, {$sortTitle}')";
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

//INSERT INTO ISSUE
foreach ($numbers as $number) {
  $numberFilter = $number === 'NULL' ? "number IS NULL" : "number = '{$number}'";
  $notesFilter  = "number = '{$number}'";
  $query =
  "SELECT * from issues
    WHERE title_id = '{$titleId}'
    AND notes = '{$notes}'
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

    $result    = execute($query, 'kittenb1_longbox');
    $issueId   = select("SELECT id FROM issues ORDER BY id DESC LIMIT 1", 'kittenb1_longbox')[0]['id'];
    $queries[] = $query;
  }
}

/*
if (!empty($writers)) {
  $writers = explode("\r\n", $writers);
  $writerIds = [];

  foreach ($writers as $writer) {
    $result   = select("SELECT * from creators WHERE name = '{$writer}' LIMIT 1", 'kittenb1_longbox');
    $writerId = $result[0]['id'];

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
    $result    = select($query, 'kittenb1_longbox');
    $hasWriter = $result[0];

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
    $result        = select("SELECT * from creators WHERE name = '{$coverArtist}' LIMIT 1", 'kittenb1_longbox');
    $coverArtistId = $result[0]['id'];

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
    $result         = select($query, 'kittenb1_longbox');
    $hasCoverArtist = $result[0];

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
    $result           = select("SELECT * from creators WHERE name = '{$interiorArtist}' LIMIT 1", 'kittenb1_longbox');
    $interiorArtistId = $result[0]['id'];

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
    $result            = select($query, 'kittenb1_longbox');
    $hasInteriorArtist = $result[0];

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

// convert comma-separated list of issue numbers including ranges into an explicit array of issue numbers
// input:  '1-3,5,10-12'
// output: [1,2,3,5,10,11,12]
function getNumbers($input) {
  $output = [];
  $input  = str_replace(' ', '', $input);
  $ranges = strpos($input, ',') > -1 ? explode(',', $input) : [$input];

  foreach ($ranges as $range) {
    if (strpos($range, '-') > -1) {
      $numbers = explode('-', $range);

      for ($i = $numbers[0]; $i <= $numbers[1]; $i++) {
        $output[] = $i;
      }
    } else {
      $output[] = $range;
    }
  }

  return $output;
}
