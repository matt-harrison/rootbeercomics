<?php
include($_SERVER['DOCUMENT_ROOT'] . '/api/longbox/utils.php');

$response = getFormats();
$formats  = $response['results'];
?>
<!doctype html>
<html lang="en">
  <head>
    <link href="/assets/css/table.css" rel="stylesheet" type="text/css">
    <title>formats view</title>
  </head>
  <body class="m5">
    <table>
      <tr>
        <th>index</th>
        <th>id</th>
        <th>name</th>
      </tr>
      <?php foreach ($formats as $index => $format) { ?>
        <tr>
          <td><?= $index + 1; ?></td>
          <td><?= $format['id']; ?></td>
          <td><?= $format['name']; ?></td>
        </tr>
      <?php } ?>
    </table>
  </body>
</html>
