<?php
include($_SERVER['DOCUMENT_ROOT'] . '/api/longbox/utils.php');

$publishers = getPublishers()['results'];
?>
<!doctype html>
<html>
  <head profile="http://www.w3.org/2005/10/profile">
    <title>publishers view</title>
    <link href="/assets/css/table.css" rel="stylesheet" type="text/css">
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