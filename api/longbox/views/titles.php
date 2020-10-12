<?php
include($_SERVER['DOCUMENT_ROOT'] . '/api/longbox/utils.php');

$response = getTitles();
$titles   = $response['results'];
?>
<!doctype html>
<html lang="en">
  <head>
    <link href="/assets/css/table.css" rel="stylesheet" type="text/css">
    <title>titles view</title>
  </head>
  <body class="m5">
    <table>
      <tr>
        <th>index</th>
        <th>id</th>
        <th>name</th>
        <th>sort name</th>
      </tr>
      <?php foreach ($titles as $index => $title) { ?>
        <tr>
          <td><?= $index + 1; ?></td>
          <td><?= $title['id']; ?></td>
          <td><?= $title['name']; ?></td>
          <td><?= $title['sort_name']; ?></td>
        </tr>
      <?php } ?>
    </table>
  </body>
</html>
