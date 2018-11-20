<?php
$table = 'comics';
$sort  = 'DESC';
include($_SERVER['DOCUMENT_ROOT'] . '/includes/sql.php');

$title   = 'comics archive';
$desc    = 'view all comic posts.';
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="flex wrap mb5">
    <?php foreach ($archive as $record) { ?>
        <?php
        $title = $record['title'];
        $title = str_replace("'", '\&apos;', $title);
        $title = str_replace('"', "\&quot;", $title);
        ?>
        <a href="index.php?id=<?= $record['id']; ?>&records=1" class="mr1 mb1">
            <img src="<?= $record['thumb']; ?>" alt="<?= $title; ?>" class="w100 h100 thumb"/>
        </a>
    <?php } ?>
</div>
<div class="flex spaceBetween mb5 p10 bgWhite hide">
    <a href="/illustration" class="mr20">illustration</a>
    <a href="/projects/portfolio" class="mr20">writing portfolio</a>
    <a href="/comics/old/archive.php" class="mr20">old comics</a>
    <a href="/comics/jam/archive.php" class="mr20">jam comics</a>
    <a href="/comics/deadhays/archive.php" class="mr20">dead hays comics</a>
    <a href="/projects/drawsome" class="mr20">draw something</a>
    <a href="/burgg/archive.php" class="mr20">movie drawings</a>
    <a href="/pain/archive.php" class="mr20">website of pain</a>
    <a href="/games" class="mr20">games</a>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
