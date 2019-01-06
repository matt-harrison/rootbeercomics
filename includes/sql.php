<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/execute-query.php');

//Archive pages
$sort    = (isset($sort)) ? $sort : 'ASC';
$query   = "SELECT * FROM $table ORDER BY id $sort";
$archive = select($query);

//Index pages
if (!isset($page)) {
    if (in_array($table, array('burgg', 'pain'))) {
        $page = rand(1, count($archive));
    } else {
        $page = count($archive);
    }
}

$records = (isset($records)) ? $records : 1;
$query   = "SELECT * FROM $table WHERE id <= $page ORDER BY id DESC LIMIT $records";
$rows    = select($query);
