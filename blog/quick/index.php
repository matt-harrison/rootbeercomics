<?php
$today = date('Y-m-d H:i:s');

$conn = new mysqli('localhost', 'kittenb1_matt', 'uncannyx0545', 'kittenb1_main');
if ($conn->connect_error) {
	die('connection failed: ' . $conn->connect_error);
}
$query = <<<SQL
SELECT 
	uniqueID, 
	title, 
	body, 
	UNIX_TIMESTAMP(date) AS utime 
FROM blog 
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
			body, h2, p, a {
				font: 16pt 'courier new';
			}
			h2, p {
				margin-top:0;
			}
			h2 {
				font-weight: bold;
			}
			img {
				display: block;
				margin-right: auto;
				margin-left: auto;
				max-width: 100%;
			}

			.floatL {
				float: left;
			}

			.floatR {
				float: right;
			}

			.clear {
				clear: both;
			}

			.size1of2 {
				width: 50%;
			}

			.txtR {
				text-align: right;
			}

			#posts {
				margin-right: auto;
				margin-left: auto;
				max-width: 800px;
			}

			.post {
				margin-bottom: 20px;
				border: 1px solid gray;
				padding: 5px;
			}
		</style>
	</head>
	<body>
		<div id="posts">
			<?php while ($post = $results->fetch_assoc()) { ?>
				<div data-id="<?= $post['uniqueID']; ?>" class="post">
					<div>
						<h2 class="floatL size1of2 title"><?= $post['title']; ?></h2>
						<p class="floatR size1of2 txtR date"><?= date('m.d.y', $post['utime']); ?></p>
						<br class="clear"/>
					</div>
					<div class="body"><?= $post['body']; ?></div>
				</div>
			<?php } ?>
		</div>
		<script type="text/javascript">
			window.addEventListener('scroll', getPost);

			function getPost() {
				var scrollTop = (window.pageYOffset != undefined) ? window.pageYOffset : document.documentElement.scrollTop;
				if (scrollTop + document.documentElement.clientHeight >= document.documentElement.offsetHeight) {
					if (typeof(ajax) == 'undefined') {
						ajax = $.ajax(
							{
								url: 'get.php',
								dataType: 'json',
								data: {
									'id': $('.post').last().data('id')
								},
								success: function(response) {
									ajax = undefined;
									if (response.noResults) {
										window.removeEventListener('scroll', getPost);
										$('#posts').append('<p>no more posts.</p>');
									} else {
										var div = $('.post:eq(0)').clone();
										div.data('id', response.id);
										div.find('.title').html(response.title);
										div.find('.date').html(response.utime);
										div.find('.body').html(response.body);
										div.appendTo($('#posts'));
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
