<?php
$table   = 'updates';
$sort    = 'DESC';
$page    = (isset($_GET['id'])) ? $_GET['id'] : null;
$pages   = (isset($_GET['ids'])) ? $_GET['ids'] : null;
$records = (isset($_GET['records'])) ? $_GET['records'] : 3;
include($_SERVER['DOCUMENT_ROOT'] . '/includes/sql.php');
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="line mAuto w1000">
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php');
    foreach ($data as $update) {
        $record = $update['tableID'];
        if ($update['type'] == 'blog') {
            $posts = $conn->query("SELECT *, UNIX_TIMESTAMP(date) AS utime FROM blog WHERE uniqueID='$record'");
            while ($post = $posts->fetch_assoc()) {
                include($_SERVER['DOCUMENT_ROOT'] . '/includes/post.php');
            }
        } else if ($update['type'] == 'comics') {
            $comics = $conn->query("SELECT *, UNIX_TIMESTAMP(date) AS utime FROM comics WHERE uniqueID='$record'");
            while ($comic = $comics->fetch_assoc()) {
                include($_SERVER['DOCUMENT_ROOT'] . '/includes/comic.php');
            }
        }
    }
    include('includes/nav.php');
    ?>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
