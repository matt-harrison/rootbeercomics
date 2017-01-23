<?php
$table   = 'updates';
$sort    = 'DESC';
$page    = (isset($_GET['id'])) ? $_GET['id'] : null;
$pages   = (isset($_GET['ids'])) ? $_GET['ids'] : null;
$records = (isset($_GET['records'])) ? $_GET['records'] : 10;
include($_SERVER['DOCUMENT_ROOT'] . '/includes/sql.php');
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="bsBorder mAuto w800">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php'); ?>
    <?php foreach ($data as $update) { ?>
        <?php $record = $update['tableID']; ?>
        <?php if ($update['type'] == 'blog') { ?>
            <?php $posts = $conn->query("SELECT *, UNIX_TIMESTAMP(date) AS utime FROM blog WHERE uniqueID='$record'"); ?>
            <?php while ($post = $posts->fetch_assoc()) { ?>
                <p></p>
                <a href="/blog/index.php?id=<?= $post['uniqueID']; ?>&records=1" class="bsBorder mAuto mb5 dBlock p10 w800 bgWhite">
                    <?php $images = explode(',', $post['images']); ?>
                    <?php foreach ($images as $image) { ?>
                        <img src="<?= $image; ?>" class="mAuto"/>
                    <?php } ?>
                </a>
            <?php } ?>
        <?php } else if ($update['type'] == 'comics') { ?>
            <?php $comics = $conn->query("SELECT *, UNIX_TIMESTAMP(date) AS utime FROM comics WHERE uniqueID='$record'"); ?>
            <?php while ($comic = $comics->fetch_assoc()) { ?>
                <?php if ($comic['diff'] >= 0 || $comic['uniqueID'] == $page) { ?>
                    <?php $src = empty($comic['color']) ? $comic['bw'] : $comic['color']; ?>
                    <a href="/comics/index.php?id=<?= $comic['uniqueID']; ?>&records=1" class="bsBorder mAuto mb5 dBlock p10 w800 bgWhite">
                        <img src="<?= $src; ?>" class="mAuto"/>
                    </a>
                <?php } ?>
            <?php } ?>
        <?php } ?>
    <?php } ?>
    <?php include('includes/nav.php'); ?>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
