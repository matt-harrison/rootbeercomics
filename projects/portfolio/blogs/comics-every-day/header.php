<?php
$index    = str_replace('.php', '', basename($_SERVER['PHP_SELF']));
$previous = $index - 1;
$next     = $index + 1;
?>
<h2 class="line">
    <span>Day <?= $index; ?>: <i><?= $title; ?></i> by <?= $author; ?> - <?= $yearPublished; ?></span>
    <span class="right"><?= $date; ?></span>
</h2>
