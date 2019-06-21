<?php
include($_SERVER['DOCUMENT_ROOT'] . '/scripts/issues/query.php');

$data = getData();
$issues = $data['issues']['results'];

debug($data['contributors']['query']);
debug($data['contributors']['count']);

debug($data['issues']['query']);
debug($data['issues']['count']);
?>
<!doctype html>
<html>
  <head profile="http://www.w3.org/2005/10/profile">
    <title>issues view</title>
    <style>
      table, th, td {border: 1px solid black;}
      th, td {padding: 5px;}
      p {margin: 0;}
    </style>
  </head>
  <body class="m5">
    <table>
      <tr>
        <th>index</th>
        <th>issue id</th>
        <th>title</th>
        <th>number</th>
        <th>publisher</th>
        <th>creator: cover [1]</th>
        <th>creator: interior [2]</th>
        <th>creator: writer [3]</th>
        <th>notes</th>
        <th>year</th>
        <th>is_read</th>
        <th>is_owned</th>
        <th>is_color</th>
        <th>format</th>
      </tr>
      <?php foreach ($issues as $index => $issue) { ?>
        <tr>
          <td><?= $index + 1; ?></td>
          <td><?= $issue['id']; ?></td>
          <td>
            <?= $issue['title']; ?>
            <?php if (!is_null($issue['title_id'])) { ?>
              [<?= $issue['title_id']; ?>]
            <?php } ?>
          </td>
          <td><?= $issue['number']; ?></td>
          <td>
            <?= $issue['publisher']; ?>
            <?php if (!is_null($issue['publisher_id'])) { ?>
              [<?= $issue['publisher_id']; ?>]
            <?php } ?>
          </td>
          <td>
            <?php if (!is_null($issue['contributors'])) { ?>
              <?php foreach ($issue['contributors'] as $contributor) { ?>
                <?php if ($contributor['creator_type'] === 'cover') { ?>
                  <p><?= $contributor['creator']; ?> [<?= $contributor['creator_id']; ?>]</p>
                <?php } ?>
              <?php } ?>
            <?php } ?>
          </td>
          <td>
            <?php if (!is_null($issue['contributors'])) { ?>
              <?php foreach ($issue['contributors'] as $contributor) { ?>
                <?php if ($contributor['creator_type'] === 'interior') { ?>
                  <p><?= $contributor['creator']; ?> [<?= $contributor['creator_id']; ?>]</p>
                <?php } ?>
              <?php } ?>
            <?php } ?>
          </td>
          <td>
            <?php if (!is_null($issue['contributors'])) { ?>
              <?php foreach ($issue['contributors'] as $contributor) { ?>
                <?php if ($contributor['creator_type'] === 'writer') { ?>
                  <p><?= $contributor['creator']; ?> [<?= $contributor['creator_id']; ?>]</p>
                <?php } ?>
              <?php } ?>
            <?php } ?>
          </td>
          <td><?= $issue['notes']; ?></td>
          <td><?= $issue['year']; ?></td>
          <td><?= $issue['is_read']; ?></td>
          <td><?= $issue['is_owned']; ?></td>
          <td><?= $issue['is_color']; ?></td>
          <td>
            <?= $issue['format']; ?>
            <?php if (!is_null($issue['format_id'])) { ?>
              [<?= $issue['format_id']; ?>]
            <?php } ?>
          </td>
        </tr>
      <?php } ?>
    </table>
  </body>
</html>
