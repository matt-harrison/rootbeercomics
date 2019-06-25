<?php
include($_SERVER['DOCUMENT_ROOT'] . '/api/longbox/query.php');

$data = getData();
$contributors = $data['contributors']['results'];

debug($data['contributors']['query']);
debug($data['contributors']['count']);

debug($data['issues']['query']);
debug($data['issues']['count']);
?>
<!doctype html>
<html>
  <head profile="http://www.w3.org/2005/10/profile">
    <title>contributors view</title>
    <style>
      table, th, td {border: 1px solid black;}
      th, td {padding: 5px;}
    </style>
  </head>
  <body class="m5">
    <table>
      <tr>
        <th>index</th>
        <th>issue id</th>
        <th>creator id</th>
        <th>creator</th>
        <th>creator id type</th>
        <th>creator type</th>
      </tr>
      <?php foreach ($contributors as $index => $contributor) { ?>
        <tr>
          <td><?= $index + 1; ?></td>
          <td><?= $contributor['issue_id']; ?></td>
          <td><?= $contributor['creator_id']; ?></td>
          <td><?= $contributor['creator']; ?></td>
          <td><?= $contributor['creator_type_id']; ?></td>
          <td><?= $contributor['creator_type']; ?></td>
        </tr>
      <?php } ?>
    </table>
  </body>
</html>
