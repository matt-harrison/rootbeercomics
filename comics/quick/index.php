<?php
$today = date('Y-m-d H:i:s');

$conn = new mysqli('localhost', 'kittenb1_matt', 'uncannyx0545', 'kittenb1_main');
if ($conn->connect_error) {
	die('connection failed: ' . $conn->connect_error);
}
$query = <<<SQL
SELECT 
	color, 
	bw, 
	uniqueID 
FROM comics 
WHERE DATEDIFF('$today', date) >= 0 
OR date = 0 
ORDER BY uniqueID DESC 
LIMIT 10
SQL;
$results = $conn->query($query);
?>
<!doctype html>
<html>
	<head>
		<title><?= $title; ?></title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<meta property="og:type" content="website"/>
		<meta property="og:title" content="root beer comics, by matt!"/>
		<meta property="og:image" content="/images/matt.jpg"/>
		<meta property="og:description" content="webcomics, minicomics, and sketch blog by matt harrison"/>
		<meta property="og:url" content="<?= 'http://' . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI]; ?>"/>
		<link type="image/x-icon" href="/images/icons/matt.ico" rel="icon"/>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<style>
			body, p {
				font: 16pt 'courier new';
			}
			img {
				display: block;
				margin-right: auto;
				margin-left: auto;
				margin-bottom: 100px;
				max-width: 100%;
			}
		</style>
	</head>
	<body>
		<div id="comics">
			<?php while ($comic = $results->fetch_assoc()) { ?>
				<?php $img = ($comic['color'] != '') ? $comic['color'] : $comic['bw']; ?>
				<img src="<?= $img; ?>" data-id="<?= $comic['uniqueID']; ?>"/>
			<?php } ?>
		</div>
		<script type="text/javascript">
			window.addEventListener('scroll', getComic);

			function getComic() {
				var scrollTop = (window.pageYOffset != undefined) ? window.pageYOffset : document.documentElement.scrollTop;
				if (scrollTop + document.documentElement.clientHeight >= document.documentElement.offsetHeight) {
					if (typeof(ajax) == 'undefined') {
						ajax = $.ajax(
							{
								url: 'get.php',
								dataType: 'json',
								data: {
									'id': $('img').last().data('id')
								},
								success: function(response) {
									ajax = undefined;
									if (response.noResults) {
										window.removeEventListener('scroll', getComic);
										$('#comics').append('<p>no more comics.</p>');
									} else {
										$('#comics').append('<img src="' + response.img +'" data-id="' + response.id +'"/>');
									}
								}
							}
						);
					}
				}
			}
		</script>
	</body>
</html>
