<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
		<meta property="og:title" content="graphic novels matt has read"/>
		<meta property="og:image" content="http://<?= $_SERVER[HTTP_HOST]; ?>/images/matt.jpg"/>
		<meta property="og:description" content="graphic novel reading log, by matt harrison."/>
		<meta property="og:url" content="http://<?= $_SERVER[HTTP_HOST]; ?>/projects/comics/index.php"/>
		<title>graphic novels matt has read</title>
		<link rel="stylesheet" type="text/css" href="http://www.rootbeercomics.com/projects/list/list.css"/>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="js/comics.js"></script>
	</head>
	<body class="m5">
		<div class="mAuto w500">
			<p class="mb5 bold fs14">graphic novels matt has read</p>
			<?php if (isset($_COOKIE['username']) && $_COOKIE['username'] == 'matt!') { ?>
				<form class="flex mb5">
					<fieldset class="size4of5 mr5">
						<input type="text" id="title" name="title" placeholder="title" value="" class="mr5 mb5 bdrGray p5 wFull bdrBox"/>
						<fieldset class="flex">
							<fieldset id="date" class="flex">
								<input type="text" id="month" name="month" placeholder="month" value="" class="mr5 bdrGray p5 size1of3 bdrBox"/>
								<input type="text" id="day" name="day" placeholder="day" value="" class="mr5 bdrGray p5 size1of3 bdrBox"/>
								<input type="text" id="year" name="year" placeholder="year" value="" class="mr5 bdrGray p5 size1of3 bdrBox"/>
							</fieldset>
							<div id="first" class="bdrGray p5 bdrBox txtC csrPointer">X</div>
						</fieldset>
					</fieldset>
					<button type="submit" id="btnAdd" class="bdrGray p5 size1of5 bdrBox csrPointer">add</button>
				</form>
			<?php } ?>
			<div id="comics" class="bdrGray p5 bdrBox"></div>
		</div>
	</body>
</html>
