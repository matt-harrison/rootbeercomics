<?php
$today = date('Y-m-d H:i:s');
$comicCount = 0;

$con = mysql_connect('localhost', 'kittenb1_matt', 'uncannyx0545');
mysql_select_db('kittenb1_main', $con);
$comics = mysql_query("SELECT * FROM comics", $con);
$comicCount = mysql_num_rows($comics);

if ($_GET['id'] != NULL){
    $page = $_GET['id'];
} else {
    $page = $comicCount;
}

if ($_GET['records'] != NULL){
    $records = $_GET['records'];
} else {
    $records = 10;
}
$lastPage = $page - $records + 1;
$lastRow = $comicCount;

if ($records == 1) {
    $query = mysql_query("SELECT * FROM comics WHERE uniqueID='$page' LIMIT 1", $con);
    while ($record = mysql_fetch_array($query)){
        $title   = $record['title'];
        $caption = $record['caption'];
        $img     = $record['thumb'];
    }
}
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div id="comics" class="line mAuto w1000">
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php');
    $comics = mysql_query("SELECT *, DATEDIFF('$today', date) AS diff, UNIX_TIMESTAMP(date) AS utime FROM comics WHERE uniqueID BETWEEN $lastPage AND $page ORDER BY uniqueID DESC", $con);
    while ($comic = mysql_fetch_array($comics)){
        if($comic['diff'] >= 0){
            include($_SERVER['DOCUMENT_ROOT'] . '/includes/comic.php');
        }
    }
    include($_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php');
    ?>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>