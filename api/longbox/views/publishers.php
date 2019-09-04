<?php
include($_SERVER['DOCUMENT_ROOT'] . '/api/longbox/utils.php');

$response   = getPublishers();
$publishers = $response['results'];
?>
<!doctype html>
<html lang="en">
  <head>
    <link href="/assets/css/table.css" rel="stylesheet" type="text/css">
    <title>publishers view</title>
  </head>
  <body class="m5">
    <table>
      <tr>
        <th>index</th>
        <th>id</th>
        <th>name</th>
      </tr>
      <?php foreach ($publishers as $index => $publisher) { ?>
        <tr>
          <td><?= $index + 1; ?></td>
          <td><?= $publisher['id']; ?></td>
          <td><?= $publisher['name']; ?></td>
        </tr>
      <?php } ?>
    </table>
  </body>
</html>
