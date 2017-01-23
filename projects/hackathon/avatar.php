<?php
(isset($_GET['gender'])) ? $gender = $_GET['gender'] : $gender = '';
(isset($_GET['expression'])) ? $expression = $_GET['expression'] : $expression = '';
(isset($_GET['hair'])) ? $hair = $_GET['hair'] : $hair = '';
(isset($_GET['beard'])) ? $beard = $_GET['beard'] : $beard = '';
(isset($_GET['glass'])) ? $glass = $_GET['glass'] : $glass = '';
(isset($_GET['shirt'])) ? $shirt = $_GET['shirt'] : $shirt = '';
(isset($_GET['pant'])) ? $pant = $_GET['pant'] : $pant = '';
(isset($_GET['hat'])) ? $hat = $_GET['hat'] : $hat = '';
(isset($_GET['shoe'])) ? $shoe = $_GET['shoe'] : $shoe = '';
(isset($_GET['skinColor'])) ? $skinColor = $_GET['skinColor'] : $skinColor = '';
(isset($_GET['hairColor'])) ? $hairColor = $_GET['hairColor'] : $hairColor = '';
(isset($_GET['beardColor'])) ? $beardColor = $_GET['beardColor'] : $beardColor = '';
(isset($_GET['shirtColor'])) ? $shirtColor = $_GET['shirtColor'] : $shirtColor = '';
(isset($_GET['pantColor'])) ? $pantColor = $_GET['pantColor'] : $pantColor = '';
(isset($_GET['shoeColor'])) ? $shoeColor = $_GET['shoeColor'] : $shoeColor = '';
(isset($_GET['hatColor'])) ? $hatColor = $_GET['hatColor'] : $hatColor = '';
?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Hackathon NSU Team 2 - Avatars</title>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script type="text/javascript">
			gender = '<?= $gender; ?>';
			expression = '<?= $expression; ?>';
			hair = '<?= $hair; ?>';
			beard = '<?= $beard; ?>';
			glass = '<?= $glass; ?>';
			shirt = '<?= $shirt; ?>';
			pant = '<?= $pant; ?>';
			shoe = '<?= $shoe; ?>';
			hat = '<?= $hat; ?>';
			
			skinColor = '<?= $skinColor; ?>';
			hairColor = '<?= $hairColor; ?>';
			beardColor = '<?= $beardColor; ?>';
			shirtColor = '<?= $shirtColor; ?>';
			pantColor = '<?= $pantColor; ?>';
			shoeColor = '<?= $shoeColor; ?>';
			hatColor = '<?= $hatColor; ?>';
		</script>
		<script type="text/javascript" src="js/avatar.js"></script>
		<link type="text/css" href="css/styles.css" rel="stylesheet"/>
		<meta name="viewport" content="width=360, scale=1, user-scalable=0"/>
	</head>
	<body class="m10">
		<div class="mAuto w360">
			<form id="avatarForm" method="GET">
				<div class="line mb10">
					<div class="unit bdrBox pr5 size1of2">
						<select id="drpGenderStyle" name="gender" class="bdrBox bdrBlack p5 wFull">
							<option value="null">gender...</option>
						</select>
					</div>
					<div class="unit bdrBox pl5 size1of2">
						<select id="drpSkinColor" name="skinColor" class="bdrBox bdrBlack p5 wFull colorChooser">
							<option value="null">skin color...</option>
						</select>
					</div>
				</div>
				<div class="line mb10">
					<div class="unit bdrBox pr5 size1of2">
						<select id="drpExpressionStyle" name="expression" class="bdrBox bdrBlack p5 wFull">
							<option value="null">expression...</option>
						</select>
					</div>
					<div class="unit bdrBox pl5 size1of2">
						<select id="drpGlassesStyle" name="glasses" class="bdrBox bdrBlack p5 wFull">
							<option value="null">glasses...</option>
						</select>
					</div>
				</div>
				<div class="line mb10">
					<div class="unit bdrBox pr5 size1of2">
						<select id="drpHairStyle" name="hair" class="bdrBox bdrBlack p5 wFull">
							<option value="null">hair...</option>
						</select>
					</div>
					<div class="unit bdrBox pl5 size1of2">
						<select id="drpHairColor" name="hairColor" class="bdrBox bdrBlack p5 wFull colorChooser">
							<option value="null">color...</option>
						</select>
					</div>
				</div>
				<div class="line mb10">
					<div class="unit bdrBox pr5 size1of2">
						<select id="drpBeardStyle" name="beard" class="bdrBox bdrBlack p5 wFull">
							<option value="null">beard...</option>
						</select>
					</div>
					<div class="unit bdrBox pl5 size1of2">
						<select id="drpBeardColor" name="beardColor" class="bdrBox bdrBlack p5 wFull colorChooser">
							<option value="null">color...</option>
						</select>
					</div>
				</div>
				<div class="line mb10">
					<div class="unit bdrBox pr5 size1of2">
						<select id="drpShirtStyle" name="shirt" class="bdrBox bdrBlack p5 wFull">
							<option value="null">shirt...</option>
						</select>
					</div>
					<div class="unit bdrBox pl5 size1of2">
						<select id="drpShirtColor" name="shirtStyle" class="unit bdrBlack p5 wFull colorChooser">
							<option value="null">color...</option>
						</select>
					</div>
				</div>
				<div class="line mb10">
					<div class="unit bdrBox pr5 size1of2">
						<select id="drpPantStyle" class="bdrBox bdrBlack p5 wFull">
							<option value="null">pants...</option>
						</select>
					</div>
					<div class="unit bdrBox pl5 size1of2">
						<select id="drpPantColor" name="pantColor" class="bdrBox bdrBlack p5 wFull colorChooser">
							<option value="null">color...</option>
						</select>
					</div>
				</div>
				<div class="line mb10">
					<div class="unit bdrBox pr5 size1of2">
						<select id="drpShoeStyle" name="shoe" class="bdrBox bdrBlack p5 wFull">
							<option value="null">shoes...</option>
						</select>
					</div>
					<div class="unit bdrBox pl5 size1of2">
						<select id="drpShoeColor" name="showColor" class="bdrBox bdrBlack p5 wFull colorChooser">
							<option value="null">color...</option>
						</select>
					</div>
				</div>
				<div class="line mb10">
					<div class="unit bdrBox pr5 size1of2">
						<select id="drpHatStyle" name="hat" class="bdrBox bdrBlack p5 wFull">
							<option value="null">hat...</option>
						</select>
					</div>
					<div class="unit bdrBox pl5 size1of2">
						<select id="drpHatColor" name="hatColor" class="bdrBlack p5 wFull colorChooser">
							<option value="null">color...</option>
						</select>
					</div>
				</div>
				<div class="line mb10">
					<div class="unit bdrBox pr5 size1of2">
						<input type="button" id="btnImage" value="get image URL" class="bdrBox bdrBlack p5 wFull csrPointer"/>
					</div>
					<div class="unit bdrBox pl5 size1of2">
						<input type="button" id="btnLink" value="get link URL" class="bdrBox bdrBlack p5 wFull csrPointer"/>
					</div>
				</div>
			</form>
			<img src="" id="avatar" class="dBlock mAuto"/>
		</div>
	</body>
</html>