<?php
$title = 'modify database records';
$table = 'blog';
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div id="updates" class="mAuto mb20 bdrBlack p10 bdrBox w900 bgWhite">
    <?php
    $updateCount = 0;
    $con = mysql_connect('localhost', 'kittenb1_matt', 'uncannyx0545');
    mysql_select_db('kittenb1_main', $con);
    $updates = mysql_query("SELECT * FROM $table ORDER BY uniqueID ASC", $con);
    while ($update = mysql_fetch_array($updates)) {
        $id   = $update['uniqueID'];
        $body = $update['body'];
        $images = array();

        preg_match_all("/<img src=\"([^\"]+)\"/", $body, $results);

        foreach ($results[1] as $result) {
            $images[] = $result;
        }

        $images = implode(',', $images);

        if (empty($update['images']) && !empty($images)) {
            //Perform the query.
            //$result = mysql_query("UPDATE blog SET images = '$images' WHERE uniqueID = $id");

            //Display results.
            echo $id . ': ' . $images . '<br/><br/>';

            $updateCount++;
        }
    }

    if ($updateCount == 0) {
        echo '<p class="mb0">There were no SQL queries performed.</p>';
    }
    ?>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
