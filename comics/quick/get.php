<?php
$today = date('Y-m-d H:i:s');
$id = $_REQUEST['id'];

$conn = new mysqli('localhost', 'kittenb1_matt', 'uncannyx0545', 'kittenb1_main');
if ($conn->connect_error) {
	die('connection failed: ' . $conn->connect_error);
}
$query = <<<SQL
SELECT 
	uniqueID, 
	bw, 
	color 
FROM comics 
WHERE DATEDIFF('$today', date) >= 0 
AND uniqueID < $id
OR date = 0 
ORDER BY uniqueID DESC 
LIMIT 1
SQL;
$results = $conn->query($query);

$data = array();

while ($comic = $results->fetch_assoc()) {
	$data['id'] = $comic['uniqueID'];
	$data['img'] = ($comic['color']) ? $comic['color'] : $comic['bw'];
}

if (is_null($data['id'])) {
	$data['noResults'] = true;
}

echo json_encode($data);
