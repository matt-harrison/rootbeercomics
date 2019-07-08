<?php
include($_SERVER['DOCUMENT_ROOT'] . '/api/longbox/utils.php');

$creatorTypes = getCreatorTypes()['results'];
?>
<!doctype html>
<html>
  <head profile="http://www.w3.org/2005/10/profile">
    <title>creator types view</title>
    <link href="/assets/css/table.css" rel="stylesheet" type="text/css">
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
