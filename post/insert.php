<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="mb5 mAuto bdrBox w1000 bdrLtBrown bdrRound bgWhite">
    <div class="p10">
        <?php
        $table   = $_POST['table'];

        $con = mysql_connect('localhost', 'kittenb1_matt', 'uncannyx0545');
        mysql_select_db('kittenb1_main', $con);
        $result = mysql_query("SELECT * FROM $table", $con);
        $rowCount = mysql_num_rows($result);
        $num = (int)$rowCount;
        $id = ($num + 1);

        $caption = $_POST['caption'];
        $date    = $_POST['date'];
        $tags    = $_POST['tags'];
        $title   = $_POST['title'];
        $thumb   = $_POST['thumb'];
        $type    = $_POST['type'];

        $title   = str_replace("'", "\'", $title);
        $caption = str_replace("'", "\'", $caption);
        ?>
        <?php if ($_COOKIE['username'] == 'matt!') { ?>
            <?php if ($table == 'drawings') { ?>
                <?php $sql = "INSERT INTO drawings (id, title, tags, date, thumb, caption, images)
                                VALUES ('$id', '$title', '$tags', '$date', '$thumb', '$caption', '$images')"; ?>
                <textarea style="width:500px;height:300px;"><?= $sql; ?></textarea><br/><br/>
                <?php if (!mysql_query($sql, $con)) { ?>
                    <p class="txtC">Error: <?= mysql_error(); ?></p>
                <?php } else { ?>
                    <?php $url = 'http://www.rootbeercomics.com/index.php?id=' . $id . '&records=1'; ?>
                    <a href="http://www.rootbeercomics.com/drawings/index.php?id=<?= $id ?>&records=1" target="_blank">view drawings #<?= $id ?></a><br/>
                    <span>title:   <?= $title; ?></span><br/>
                    <span>tags:    <?= $tags; ?></span><br/>
                    <span>date:    <?= $date; ?></span><br/>
                    <span>thumb:   <?= $thumb; ?></span><br/><br/>
                    <span>caption: <?= $caption; ?></span><br/>
                    <span>images:</span><br/><textarea style="width:500px;height:300px;"><?= $images; ?></textarea><br/>
                <?php } ?>
            <?php } else { ?>
                <?php
                $author = $_POST['author'];

                $final    = $_POST['final'];
                $original = $_POST['original'];
                ?>
                <?php $sql = "INSERT INTO comics (id, date, final, original, thumb, title, author, tags, type, caption)
                                VALUES ('$id', '$date', '$final', '$original', '$thumb', '$title', '$author', '$tags', '$type', '$caption')"; ?>
                <?php if (!mysql_query($sql, $con)) { ?>
                    <p class="txtC">Error: <?= mysql_error(); ?></p>
                <?php } else { ?>
                    <?php $url = 'http://www.rootbeercomics.com/comics/index.php?id=' . $id . '&records=1'; ?>
                    <a href="http://www.rootbeercomics.com/comics/index.php?id=<?= $id ?>&records=1" target="_blank">view comic #<?= $id; ?></a><br/>
                    <span>title:  <?= $title; ?></span><br/>
                    <span>tags:   <?= $tags; ?></span><br/>
                    <span>date:   <?= $date; ?></span><br/><br/>
                    <span>author: <?= $author; ?></span><br/>

                    <span>thumb:     <?= $thumb; ?></span><br/>
                    <span>final:     <?= $final; ?></span><br/>
                    <span>original:        <?= $original; ?></span><br/>

                    <span>caption: <?= $caption; ?></span><br/>
                <?php } ?>
            <?php } ?>
            <?php if (!mysql_query($sql, $con)) { ?>
                <p class="txtC">failed to add update: <?= mysql_error(); ?></p>
            <?php } ?>
        <?php } else { ?>
            <span>you are not authorized to alter content.</span><br/>
        <?php } ?>
    </div>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
