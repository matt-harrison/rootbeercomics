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
        <a href="index.php?id=<?= $record['id']; ?>" class="mr1 mb1">
            <img src="<?= $record['thumb']; ?>" alt="<?= $title; ?>" class="thumb"/>
        </a>
    <?php } ?>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
