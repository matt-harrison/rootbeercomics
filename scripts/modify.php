<?php
$title = 'modify database records';
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div id="updates" class="mAuto mb20 bdrLtBrown bdrRound p10 bdrBox w900 bgWhite">
    <?php
    $updateCount = 0;
    $con = mysql_connect('localhost', 'kittenb1_matt', 'uncannyx0545');
    mysql_select_db('kittenb1_main', $con);
    $updates = mysql_query("SELECT * FROM comics ORDER BY uniqueID ASC", $con);
    while ($update = mysql_fetch_array($updates)) {
        $id        = $update['uniqueID'];
        $title     = $update['title'];
        $body      = $update['body'];
        $caption   = $update['caption'];

        $color     = $update['color'];
        $colorLink = $update['colorLink'];
        $bw        = $update['bw'];
        $bwLink    = $update['bwLink'];
        $thumb     = $update['thumb'];

        //Update the content.
        $color     = str_replace('http://www.rootbeercomics.com/', '/', $color);

        if (empty($body)) {
            $body = $caption;
            //Perform the query.
            //$result = mysql_query("UPDATE comics SET body=$body WHERE uniqueID=$id");

            //Display results.
            echo $id . ': ' . $body . '<br/><br/>';

            $updateCount++;
        }
    }

    if ($updateCount == 0) {
        echo '<p class="mb0">There were no SQL queries performed.</p>';
    }
    ?>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
