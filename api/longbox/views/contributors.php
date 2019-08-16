<?php
include($_SERVER['DOCUMENT_ROOT'] . '/api/longbox/utils.php');

$data         = getIssuesWithContributors();
$contributors = $data['contributors']['results'];
$issues       = $data['issues']['results'];

foreach ($contributors as $index => $contributor) {
  foreach ($issues as $issue) {
    if ($contributor['issue_id'] === $issue['id']) {
      $contributors[$index]['issue'] = $issue['number'] ? $issue['title'] . ' #' . $issue['number'] : $issue['title'];
    }
  }
}
?>
<!doctype html>
<html>
  <head profile="http://www.w3.org/2005/10/profile">
    <title>contributors view</title>
    <link href="/assets/css/table.css" rel="stylesheet" type="text/css">
  </head>
  <body class="m5">
    <table>
      <tr>
        <th>index</th>
        <th>issue id</th>
        <th>issue</th>
        <th>creator id</th>
        <th>creator</th>
        <th>creator type id</th>
        <th>creator type</th>
      </tr>
      <?php foreach ($contributors as $index => $contributor) { ?>
        <tr>
          <td><?= $index + 1; ?></td>
          <td><?= $contributor['issue_id']; ?></td>
          <td><?= $contributor['issue']; ?></td>
          <td><?= $contributor['creator_id']; ?></td>
          <td><?= $contributor['creator']; ?></td>
          <td><?= $contributor['creator_type_id']; ?></td>
          <td><?= $contributor['creator_type']; ?></td>
        </tr>
      <?php } ?>
    </table>
  </body>
</html>
