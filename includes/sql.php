<?php
$sort = (isset($sort)) ? $sort : 'ASC';
$records = (isset($records)) ? $records : 1;
$today = date('Y-m-d H:i:s');

//ARCHIVE PAGES
$conn = new mysqli('localhost', 'kittenb1_matt', 'uncannyx0545', 'kittenb1_main');
if ($conn->connect_error) {
    die('connection failed: ' . $conn->connect_error);
}

$fields = 'uniqueID, title, thumb';
if ($table == 'updates') {
    $fields .= ', tableID, type';
} else if ($table == 'burgg') {
    $fields .= ', caption';
}

//Count the valid rows in the table.
$query = "SELECT $fields, UNIX_TIMESTAMP(date) AS utime
    FROM $table
    WHERE DATEDIFF('$today', date) >= 0
    OR date = 0
    ORDER BY uniqueID $sort";
$results = $conn->query($query);

//Stash archive data for the view.
$archive = array();
while ($result = $results->fetch_assoc()) {
    $archive[] = $result;
}

//
$lastUpdate = ($sort == 'ASC') ? $archive[count($archive) - 1]['utime'] : $archive[0]['utime'];
$lastUpdate =  date('m.d.y', $lastUpdate);

//INDEX PAGES
if (!isset($page)) {
    if (in_array($table, array('burgg', 'pain'))) {
        $page = rand(1, count($archive));
    } else {
        $page = count($archive);
    }
}

//Return certain rows based on context.
if (empty($pages)) {
    $query = "SELECT *, UNIX_TIMESTAMP(date) AS utime
    FROM $table
    WHERE uniqueID <= $page
    ORDER BY uniqueID DESC
    LIMIT $records";
} else {
    $query = "SELECT *, UNIX_TIMESTAMP(date) AS utime
    FROM $table
    WHERE uniqueID in($pages)
    ORDER BY uniqueID DESC";
}

$results = $conn->query($query);

//Stash requested row data in the view.
$data = array();
while ($result = $results->fetch_assoc()) {
    $data[] = $result;
}
