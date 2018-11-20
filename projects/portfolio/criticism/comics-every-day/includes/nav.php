<div class="flex spaceBetween">
    <p>
        <?php if ($previous > 0) { ?>
            <a href="<?= $previous; ?>.php">&lt; Day <?= $previous; ?></a>
        <?php } elseif ($previous == 0) { ?>
            <a href="0.php">&lt; Blog Intro</a>
        <?php } ?>
    </p>
    <p>
        <?php if ($next <= 34) { ?>
            <a href="<?= $next; ?>.php">Day <?= $next; ?> &gt;</a>
        <?php } ?>
    </p>
</div>
