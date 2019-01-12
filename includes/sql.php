<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/query.php');

//Archive pages
$page    = (isset($_GET['id'])) ? $_GET['id'] : null;
$sort    = (isset($sort)) ? $sort : 'ASC';
$query   = "SELECT * FROM $table ORDER BY id $sort";
$archive = select($query);

//Index pages
if (!isset($page)) {
    $page = (in_array($table, array('burgg', 'pain'))) ? rand(1, count($archive)) : count($archive);
}

$records = (isset($_GET['records'])) ? $_GET['records'] : 1;
$query   = "SELECT * FROM $table WHERE id <= $page ORDER BY id DESC LIMIT $records";
$rows    = select($query);
