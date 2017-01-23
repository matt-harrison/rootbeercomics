<!doctype html>
<html>
	<head>
		<title>Click to Toggle</title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<link type="text/css" href="/includes/styles.css" rel="stylesheet"/>
		<link type="image/x-icon" href="/images/icons/r.ico" rel="icon"/>
		<link type="application/rss+xml" href="/scripts/feed.php" rel="alternate"/>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	</head>
	<body class="m5">
		<img id="old" data-target="new" src="img/xmen1B.jpg" class="mAuto toggle"/>
		<img id="new" data-target="old" src="img/xmen1.jpg" class="mAuto toggle hide"/>
		<script type="text/javascript">
			$('.toggle').click(function() {
				var id     = $(this).data('target');
				var target = $('#' + id);

				$(this).addClass('hide');
				target.removeClass('hide');
			});
		</script>
	</body>
</html>