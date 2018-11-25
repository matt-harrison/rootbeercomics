<?php
function executeQuery($query) {
  global $sqlUsername, $sqlPassword;

  $rows = array();
  $con = mysql_connect('localhost', $sqlUsername, $sqlPassword);

  mysql_select_db('kittenb1_users', $con);

  $response = mysql_query($query, $con);
  $rowCount = mysql_num_rows($response);

  if ($rowCount > 0) {
    while ($row = mysql_fetch_array($response)) {
      $rows[] = $row;
    }
  }

  mysql_close($con);

  return $rows;
}
