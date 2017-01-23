<?php
$table = 'updates';
$sort  = 'DESC';
include($_SERVER['DOCUMENT_ROOT'] . '/includes/sql.php');

$colHeight = count($archive) / 3;
if ($colHeight != floor($colHeight)) {
    $colHeight = floor($colHeight) + 1;
}

$title = 'root beer comics: updates, by matt!';
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="flex center wrap">
    <?php foreach ($archive as $update) { ?>
        <?php
        $title = $update['title'];
        $title = str_replace("'", '\&apos;', $title);
        $title = str_replace('"', "\&quot;", $title);
        ?>
        <a href="/<?= $update['type']; ?>/index.php?id=<?= $update['tableID']; ?>&records=1" class="mr5 mb5">
            <img src="<?= $update['thumb']; ?>" data-title="<?= $title; ?>" alt="<?= $title; ?>" class="w100 h100 thumb"/>
        </a>
    <?php } ?>
</div>
<div id="tooltip" class="absolute p5 bgWhite hide">
    <span></span>
    <img src="" alt=""/>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
