<!doctype html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
		<meta content="width=360, scale=1, user-scalable=0" name="viewport"/>
		<title>game demo</title>
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.js"></script>
		<script type="text/javascript" src="game.js"></script>
        <link type="text/css" href="styles.css" rel="stylesheet"/>
	</head>
	<body>
		<div id="container" class="mAuto rel bdrRadius20">
			<div id="stage" class="mAuto mb25 w300 h300 rel">
				<textarea id="output" rows="5" disabled class="w300 h300 abs<?= ($_REQUEST['debug'] == 1) ? '' : ' hide'; ?>">DEBUG MODE</textarea>
				<div id="player" class="abs"></div>
				<div id="bombs" class="abs"></div>
				<div id="bullets" class="abs"></div>
			</div>
			<div id="buttons" class="line mAuto mr5 mb5 ml5 w300">
				<div id="btnLeft" class="unit mt40 btnArrow bdrRadius5 bgGray"></div>
				<div class="unit">
					<div id="btnUp" class="btnArrow bdrRadius5 bgGray"></div>
					<div id="btnDown" class="mt40 btnArrow bdrRadius5 bgGray"></div>
				</div>
				<div id="btnRight" class="unit mt40 btnArrow bdrRadius5 bgGray"></div>
				<div id="btnShoot" class="unitR mt35 btnShoot bdrRadius50 bgRed"></div>
			</div>
		</div>
	</body>
</html>