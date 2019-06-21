<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/query.php');

if (($handle = fopen('master.csv', 'r')) !== FALSE) {
  while (($data = fgetcsv($handle, 5000, ',')) !== FALSE) {
    $title           = $data[0];
    $number          = empty($data[1]) ? 'NULL' : $data[1];
    $publisher       = empty($data[2]) ? 'NULL' : $data[2];
    $coverArtists    = $data[3];
    $writers         = $data[4];
    $interiorArtists = $data[5];
    $notes           = $data[6];
    $year            = empty($data[7]) ? 'NULL' : $data[7];
    $isRead          = empty($data[8]) ? 'NULL' : ($data[8] === 'Yes' ? 'true' : 'false');
    $isOwned         = empty($data[9]) ? 'NULL' : ($data[9] === 'Yes' ? 'true' : 'false');
    $isColor         = empty($data[10]) ? 'NULL' : ($data[10] === 'Yes' ? 'true' : 'false');
    $format          = empty($data[11]) ? 'NULL' : $data[11];

    if ($format === 'NULL') {
      $formatId = 'NULL';
    } else {
      $response = select("SELECT * from formats WHERE name = '{$format}' LIMIT 1", 'kittenb1_issues');
      $formatId = $response[0]['id'];

      if (is_null($formatId)) {
        execute("INSERT INTO formats (name) VALUES ('{$format}')", 'kittenb1_issues');
        $formatId = select("SELECT id FROM formats ORDER BY id DESC LIMIT 1", 'kittenb1_issues')[0]['id'];
      }
    }

    if ($title === 'NULL') {
      $titleId = 'NULL';
    } else {
      $response = select("SELECT * from titles WHERE name = '{$title}' LIMIT 1", 'kittenb1_issues');
      $titleId = $response[0]['id'];

      if (is_null($titleId)) {
        execute("INSERT INTO titles (name) VALUES ('{$title}')", 'kittenb1_issues');
        $titleId = select("SELECT id FROM titles ORDER BY id DESC LIMIT 1", 'kittenb1_issues')[0]['id'];
      }
    }

    if ($publisher === 'NULL') {
      $publisherId = 'NULL';
    } else {
      $response = select("SELECT * from publishers WHERE name = '{$publisher}' LIMIT 1", 'kittenb1_issues');
      $publisherId = $response[0]['id'];

      if (is_null($publisherId)) {
        execute("INSERT INTO publishers (name) VALUES ('{$publisher}')", 'kittenb1_issues');
        $publisherId = select("SELECT id FROM publishers ORDER BY id DESC LIMIT 1", 'kittenb1_issues')[0]['id'];
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
    $response = select($query, 'kittenb1_issues');
    $issue = $response[0];

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

      $response = execute($query, 'kittenb1_issues');
      $issueId = select("SELECT id FROM issues ORDER BY id DESC LIMIT 1", 'kittenb1_issues')[0]['id'];

      echo $issueId . '. ' . $title . '<br/>';
    }

    if (!empty($writers)) {
      $writers = explode("\r\n", $writers);
      $writerIds = [];

      foreach ($writers as $writer) {
        $response = select("SELECT * from creators WHERE name = '{$writer}' LIMIT 1", 'kittenb1_issues');
        $writerId = $response[0]['id'];

        if (is_null($writerId)) {
          execute("INSERT INTO creators (name) VALUES ('{$writer}')", 'kittenb1_issues');
          $writerId = select("SELECT id FROM creators ORDER BY id DESC LIMIT 1", 'kittenb1_issues')[0]['id'];
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
        $response = select($query, 'kittenb1_issues');
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

          execute($query, 'kittenb1_issues');
        }
      }
    }

    if (!empty($coverArtists)) {
      $coverArtists = explode("\r\n", $coverArtists);
      $coverArtistIds = [];

      foreach ($coverArtists as $coverArtist) {
        $response = select("SELECT * from creators WHERE name = '{$coverArtist}' LIMIT 1", 'kittenb1_issues');
        $coverArtistId = $response[0]['id'];

        if (is_null($coverArtistId)) {
          execute("INSERT INTO creators (name) VALUES ('{$coverArtist}')", 'kittenb1_issues');
          $coverArtistId = select("SELECT id FROM creators ORDER BY id DESC LIMIT 1", 'kittenb1_issues')[0]['id'];
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
        $response = select($query, 'kittenb1_issues');
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

          execute($query, 'kittenb1_issues');
        }
      }
    }

    if (!empty($interiorArtists)) {
      $interiorArtists = explode("\r\n", $interiorArtists);
      $interiorArtistIds = [];

      foreach ($interiorArtists as $interiorArtist) {
        $response = select("SELECT * from creators WHERE name = '{$interiorArtist}' LIMIT 1", 'kittenb1_issues');
        $interiorArtistId = $response[0]['id'];

        if (is_null($interiorArtistId)) {
          execute("INSERT INTO creators (name) VALUES ('{$interiorArtist}')", 'kittenb1_issues');
          $interiorArtistId = select("SELECT id FROM creators ORDER BY id DESC LIMIT 1", 'kittenb1_issues')[0]['id'];
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
        $response = select($query, 'kittenb1_issues');
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

          execute($query, 'kittenb1_issues');
        }
      }
    }

    /*
    echo 'publisher: ' . $publisher . " ({$publisherId})<br/>";
    echo 'format: ' . $format . " ({$formatId})<br/>";
    echo 'number: ' . $number . '<br/>';
    echo 'notes: ' . $notes . '<br/>';
    echo 'year: ' . $year . '<br/>';
    echo 'isRead: ' . $isRead . '<br/>';
    echo 'isOwned: ' . $isOwned . '<br/>';
    echo 'isColor: ' . $isColor . '<br/>';
    echo '--------------------<br/>';
    */

    unset($writers);
    unset($coverArtists);
    unset($interiorArtists);

    unset($issueId);
    unset($titleId);
    unset($publisherId);
    unset($formatId);
  }

  fclose($handle);
}
