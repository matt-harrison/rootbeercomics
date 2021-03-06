<?php
include($_SERVER['DOCUMENT_ROOT'] . '/api/longbox/utils.php');

$response     = getCreatorTypes();
$creatorTypes = $response['results'];
?>
<!doctype html>
<html lang="en">
  <head>
    <link href="/assets/css/table.css" rel="stylesheet" type="text/css">
    <title>creator types view</title>
  </head>
  <body class="m5">
    <table>
      <tr>
        <th>index</th>
        <th>id</th>
        <th>name</th>
      </tr>
      <?php foreach ($creatorTypes as $index => $creatorType) { ?>
        <tr>
          <td><?= $index + 1; ?></td>
          <td><?= $creatorType['id']; ?></td>
          <td><?= $creatorType['name']; ?></td>
        </tr>
      <?php } ?>
    </table>
  </body>
</html>
