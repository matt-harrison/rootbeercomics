<?php
$sort    = (isset($sort)) ? $sort : 'ASC';
$records = (isset($records)) ? $records : 1;

//Archive pages
$conn = new mysqli('localhost', 'kittenb1_matt', 'uncannyx0545', 'kittenb1_main');
if ($conn->connect_error) {
    die('connection failed: ' . $conn->connect_error);
}

$query = "SELECT *
    FROM $table
    ORDER BY id $sort";
$results = $conn->query($query);

//Stash archive data for the view.
$archive = array();
while ($result = $results->fetch_assoc()) {
    $archive[] = $result;
}

//Index pages
if (!isset($page)) {
    if (in_array($table, array('burgg', 'pain'))) {
        $page = rand(1, count($archive));
    } else {
        $page = count($archive);
    }
}

$query = "SELECT *
    FROM $table
    WHERE id <= $page
    ORDER BY id DESC
    LIMIT $records";
$results = $conn->query($query);

//Stash requested row data in the view.
$rows = array();
while ($result = $results->fetch_assoc()) {
    $rows[] = $result;
}
