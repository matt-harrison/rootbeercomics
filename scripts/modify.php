<?php
$title = 'modify database records';
$table = 'drawings';

$count = 0;
$index = 1000;
$con   = mysql_connect('localhost', 'kittenb1_matt', 'uncannyx0545');
mysql_select_db('kittenb1_main', $con);
$rows = mysql_query("SELECT * FROM $table ORDER BY date ASC", $con);
while ($row = mysql_fetch_array($rows)) {
    $id = $row['id'];

    $images = explode(',', $row['images']);
    $postDate = substr($row['date'], 0, 10);

    if (count($images) < 2) {
        if (!strpos($images[0], $postDate) && !strpos($images[0], 'undated')) {
            $query = "UPDATE $table SET id = '$index' WHERE id = '$id'";
            //$result = mysql_query($query);

            echo $id . ': <a href="/drawings/index.php?id=' . $id . '&records=1" target="_blank">' . $row['title'] . '</a><br/>';

            $count++;
        }
    }
    $index++;
}

if ($count == 0) {
    echo '<p class="mb0">There were no SQL queries performed.</p>';
}
