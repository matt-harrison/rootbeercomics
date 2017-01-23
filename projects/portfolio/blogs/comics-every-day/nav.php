<div class="line">
    <p class="left size1of2">
        <?php if ($previous > 0) { ?>
            <a href="<?= $previous; ?>.php">&lt; Day <?= $previous; ?></a>
        <?php } elseif ($previous == 0) { ?>
            <a href="0.php">&lt; Blog Intro</a>
        <?php } ?>
    </p>
    <p class="right size1of2 txtR">
        <?php if ($next <= 34) { ?>
            <a href="<?= $next; ?>.php">Day <?= $next; ?> &gt;</a>
        <?php } ?>
    </p>
    <div class="clear"></div>
</div>
