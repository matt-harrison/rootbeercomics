<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Hackathon NSU Team 2 - Avatars</title>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<link type="text/css" href="css/styles.css" rel="stylesheet"/>
		<style>
			.overlay {
				position:absolute;
				left:0;
				top:0;
				width:90px;
				background-color:white;
				text-align:center;
			}
		</style>
	</head>
	<body class="m5">
		<div class="line">
			<?php for($i=0;$i<500;$i++){ ?>
				<?php ///http://www.doppelme.com/avatar.png?xx=&style=1101&s=ffffff&fa=69&ff=null&ha=null&h=null&t=47&b=111&f=190&e=null&ffc=ffffff&hac=ffffff&hc=ffffff&tc=ffffff&bc=ffffff&fc=ffffff ?>
					<img src="http://www.doppelme.com/avatar.png?xx=&style=1101&fa=<?= $i; ?>" class="dBlock unit mr5 bdrGry w100 avatar" alt="<?= $i; ?>"/>
			<?php } ?>
		</div>
		<div class="bdrGray p5 overlay hide"></div>
		<script>
			$('.avatar').hover(function(){
				offsetY = $(this).position().top + 84;
				$('.overlay').css('left', $(this).position().left).css('top', offsetY).removeClass('hide').html($(this).attr('alt'));
			}, function(){
				$('.overlay').css('left', '0').css('top', '0').addClass('hide');
			});
		</script>
	</body>
</html>
