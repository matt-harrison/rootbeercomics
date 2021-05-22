<?php
include($_SERVER['DOCUMENT_ROOT'] . '/api/longbox/utils.php');

$issues = getIssuesWithContributors()['issues']['results'];
?>
<!doctype html>
<html lang="en">
  <head>
    <link href="/assets/css/table.css" rel="stylesheet" type="text/css">
    <title>issues view</title>
  </head>
  <body class="m5">
    <table>
      <tr>
        <th>index</th>
        <th>id</th>
        <th>format_id</th>
        <th>format</th>
        <th>publisher_id</th>
        <th>publisher</th>
        <th>title_id</th>
        <th>title</th>
        <th>number</th>
        <th>is_read</th>
        <th>is_owned</th>
        <th>is_color</th>
        <th>year</th>
        <th>notes</th>
        <th>contributors</th>
      </tr>
      <?php foreach ($issues as $index => $issue) { ?>
        <tr>
          <td><?= $index + 1; ?></td>
          <td><?= $issue['id']; ?></td>
          <td><?= $issue['format_id']; ?></td>
          <td><?= $issue['format']; ?></td>
          <td><?= $issue['publisher_id']; ?></td>
          <td><?= $issue['publisher']; ?></td>
          <td><?= $issue['title_id']; ?></td>
          <td><?= $issue['title']; ?></td>
          <td><?= $issue['number']; ?></td>
          <td><?= is_null($issue['is_read'])  ? 'null' : $issue['is_read']; ?></td>
          <td><?= is_null($issue['is_owned']) ? 'null' : $issue['is_owned']; ?></td>
          <td><?= is_null($issue['is_color']) ? 'null' : $issue['is_color']; ?></td>
          <td><?= $issue['year']; ?></td>
          <td><?= $issue['notes']; ?></td>
          <td>
            <?php if (!is_null($issue['contributors'])) { ?>
                <table class="wFull">
                  <tr>
                    <th>creator_type_id</th>
                    <th>creator_type</th>
                    <th>creator_id</th>
                    <th>creator</th>
                  </tr>
                  <?php foreach ($issue['contributors'] as $contributor) { ?>
                    <tr>
                      <td><?= $contributor['creator_type_id']; ?></td>
                      <td><?= $contributor['creator_type']; ?></td>
                      <td><?= $contributor['creator_id']; ?></td>
                      <td><?= $contributor['creator']; ?></td>
                    </tr>
                  <?php } ?>
                </table>
            <?php } ?>
          </td>
        </tr>
      <?php } ?>
    </table>
  </body>
</html>
