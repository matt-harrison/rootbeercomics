<?php
$tables = array('blog', 'burgg', 'comics', 'pain');
$today  = date("Y-m-d");

$con = mysql_connect('localhost','kittenb1_matt','uncannyx0545');
mysql_select_db('kittenb1_main', $con);

if ($_POST['tag'] != NULL) {
	$tag = $_POST['tag'];
	$where = " WHERE tags LIKE '%" . $tag . "%' OR title LIKE '%" . $tag . "%'";
} else {
	if ($_GET['tag'] != NULL) {
		$tag = $_GET['tag'];
		$where = " WHERE tags LIKE '%" . $tag . "%' OR title LIKE '%" . $tag . "%'";
	} else {
		$where = "";
		$tag = '';
	}
}

$matches = 0;
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="line mAuto w1000">
    <?php for ($tableNum = 0; $tableNum < count($tables); $tableNum++) { ?>
        <?php
        $nextTable = $tables[$tableNum];
        if ($nextTable == 'burgg') {
            $path = '/projects/burgg/';
            $query = mysql_query(
                "SELECT *, DATEDIFF('$today', date) AS diff FROM $nextTable
                    WHERE tags LIKE '%$tag%'
                    OR title LIKE '%$tag%'
                    OR author LIKE '%$tag%'
                    OR answer LIKE '%$tag%'
                    ORDER BY uniqueID DESC",
                $con
            );
        } else if ($nextTable == 'blog') {
            $path = '/blog/';
            $query = mysql_query(
                "SELECT *, DATEDIFF('$today', date) AS diff FROM $nextTable
                    WHERE tags LIKE '%$tag%'
                    OR title LIKE '%$tag%'
                    OR body LIKE '%$tag%'
                    ORDER BY uniqueID DESC",
                $con
            );
        } else {
            if ($nextTable == 'comics') {
                $path = '/comics/';
            } else if($nextTable == 'pain') {
                $path = '/projects/pain/';
            }
            $query = mysql_query(
                "SELECT *, DATEDIFF('$today', date) AS diff FROM $nextTable
                    WHERE tags LIKE '%$tag%'
                    OR title LIKE '%$tag%'
                    OR author LIKE '%$tag%'
                    ORDER BY uniqueID DESC",
                $con
            );
        }
        ?>
        <?php while ($row = mysql_fetch_array($query)) { ?>
            <?php if (!empty($row) && $row['diff'] >= 0) { ?>
                <div class="unit mr5 mb5 <?= ($nextTable == 'burgg' ? 'burgg' : 'thumb'); ?>">
                    <a href="<?= $path ?>index.php?id=<?= $row['uniqueID'] ?>&records=1" target="_blank">
                        <img src="<?= $row['thumb']?>" class="w100<?= ($nextTable != 'burgg' ? ' h100' : ''); ?>"/>
                    </a>
                </div>
                <?php $matches++; ?>
            <?php } ?>
        <?php } ?>
    <?php } ?>
    <?php if ($matches === 0) { ?>
        <p>no content matched your weird search for: <?= $tag; ?></p>
    <?php } ?>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>