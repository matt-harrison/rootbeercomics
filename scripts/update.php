<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<?php
$messages = array();
$queries  = array();

function sqlEscape($raw) {
	$modified = str_replace('"', '\"', $raw);
	$modified = str_replace("'", "\'", $modified);

	return $modified;
}
?>
<section class="mAuto mb10 p10 w1000 bgWhite">
	<?php
	$table = $_POST['table'];
	$id    = $_POST['id'];

	unset($_POST['table']);

	if (!empty($table) && !empty($id)) {
		$con = mysql_connect('localhost','kittenb1_matt','uncannyx0545');
		mysql_select_db('kittenb1_main', $con);
		$result = mysql_query("SELECT * FROM $table WHERE id = '$id'", $con);
		while ($row = mysql_fetch_array($result)) {
			if (!$result) {
				$messages[] = 'error: ' . mysql_error();
			} else {
				foreach ($_POST as $field => $value) {
					if ($value != $row[$field]) {
						$value = sqlEscape($value);
						$query = "UPDATE $table SET $field = '$value' WHERE id = '$id'";
						$queries[] = $query;
					}
				}
			}
		}

		if (empty($queries)) {
			$messages[] = 'no queries were performed.';
		}
	} else {
		$messages[] = 'invalid POST data.';
	}
	?>
	<?php foreach ($queries as $query) { ?>
		<?php $result = mysql_query($query); ?>
		<textarea class="bsBorder mb10 wFull"><?= $query; ?></textarea>
	<?php } ?>
	<?php foreach ($messages as $message) { ?>
		<p class="mb0"><?= $message; ?></p>
	<?php } ?>
</section>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>