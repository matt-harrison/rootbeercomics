<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<title>matt's books</title>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="js/books.js"></script>
		<style>
			@charset "utf-8";

			.line:after {content:" x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x"; visibility:hidden; clear:both; height:0 !important; display:block; line-height:0; font-size:xx-large; overflow:hidden;}
			.line {*zoom:1;}
			.unit {float:left;}
			.unitRt {float:right;}
			
			body, div, h3, p, input, button, select, fieldset {
				display:block;
				margin:0;
				border:0;
				padding:0;
				font:10pt courier new;
			}
			
			input[type="text"], button, select {
				height:30px;
				line-height:1;
			}

			.m5 {margin: 5px;}
			.mr5 {margin-right:5px;}
			.mb5 {margin-bottom:5px;}
			.ml5 {margin-left:5px;}
			.mAuto {margin-right:auto; margin-left:auto;}
			
			.bdrBox {
				box-sizing:border-box;
				-webkit-box-sizing:border-box;
				-moz-box-sizing:border-box;
			}
			.bdrGray {border:1px solid #666;}
			
			.p5 {padding:5px;}

			.size1of5 {width: 20%;}
			.size4of5 {width: calc(80% - 5px);}
			.size1of3 {width: calc(33.33% - 5px);}
			.wFull {width:100%;}
			.w500 {max-width:500px;}
			
			.bold {font-weight:bold;}
			.csrPointer {cursor:pointer;}
			.txtC {text-align:center;}
			
			#date {
				width: calc(100% - 30px);
			}
			#first {
				width:30px;
				height:30px;
			}
			#btnAdd {min-height:65px;}
		</style>
	</head>
	<body class="m5">
		<div class="mAuto w500">
			<p class="bold">books i've read</p>
			<?php if (isset($_COOKIE['username']) && $_COOKIE['username'] == 'matt!') { ?>
				<form class="line mb5">
					<fieldset class="unit size4of5 mr5">
						<input type="text" id="title" name="title" placeholder="title" value="" class="mr5 mb5 bdrGray p5 wFull bdrBox"/>
						<fieldset class="line">
							<fieldset id="date" class="unit">
								<input type="text" id="month" name="month" placeholder="month" value="" class="unit mr5 bdrGray p5 size1of3 bdrBox"/>
								<input type="text" id="day" name="day" placeholder="day" value="" class="unit mr5 bdrGray p5 size1of3 bdrBox"/>
								<input type="text" id="year" name="year" placeholder="year" value="" class="unit mr5 bdrGray p5 size1of3 bdrBox"/>
							</fieldset>
							<div id="first" class="unitRt bdrGray p5 bdrBox txtC csrPointer">X</div>
						</fieldset>
					</fieldset>
					<button type="submit" id="btnAdd" class="unit bdrGray p5 size1of5 bdrBox csrPointer">add</button>
				</form>
			<?php } ?>
			<div id="books" class="bdrGray p5 bdrBox"></div>
		</div>
	</body>
</html>