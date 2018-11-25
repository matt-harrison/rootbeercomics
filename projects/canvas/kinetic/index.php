<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>HTML5 canvas</title>
        <link href="/assets/css/library.css" rel="stylesheet" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=0" />
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <script type="text/javascript" src="kinetic.js"></script>
		<script type="text/javascript">
			var colorArr = new Array("red","blue","yellow","green","purple","orange");
            window.onload = function() {
				var frameArr = new Array;
				var currentFrame = 0;
				var animVar = false;

				var stage = new Kinetic.Stage({
					container:"container",
					width:100,
					height:100
				});
				var circles = new Kinetic.Layer();
				var buttons = new Kinetic.Layer();

				stage.add(circles);
				stage.add(buttons);

				document.getElementById("add").addEventListener("click", function() {
					add();
				}, false);

				document.getElementById("save").addEventListener("click", function() {
					save();
				}, false);

				document.getElementById("play").addEventListener("click", function() {
					animVar = true;
				}, false);

				document.getElementById("stop").addEventListener("click", function() {
					animVar = false;
				}, false);

				var int=self.setInterval(animate,250);

				function add(){
					console.log('add');
					var myX = Math.floor(Math.random()*100);
					var myY = Math.floor(Math.random()*100);
					var colorVar = Math.floor(Math.random()*colorArr.length);
					var myColor = colorArr[colorVar];
					var myRad = 5+Math.floor(Math.random()*25);
					circle = new Kinetic.Circle({
						x:myX,
						y:myY,
						radius:myRad,
						fill:myColor,
						draggable:true
					});
					circle.on("mouseover", function() {
						document.body.style.cursor = "pointer";
					});
					circle.on("mouseout", function() {
						document.body.style.cursor = "default";
					});
					circle.on("mousedown", function() {
						this.moveToTop();
					});
					circles.add(circle);
					circles.draw();
				}

				function save(){
					console.log('save');
					stage.toDataURL(function(dataUrl) {
						$('#saved').append('<img src="'+dataUrl+'" class="unit mr10 mb10 bBlack w100 bgWhite"/>').removeClass('hide');

						$('#anim').append('<img src="'+dataUrl+'" id="frame'+frameArr.length+'" class="unit w100"/>');
						if(frameArr.length == 0){
							$('#saveBox').removeClass('hide');
						}else{
							$('#frame'+frameArr.length).addClass('hide');
							if(frameArr.length == 1){
								$('#animBox').removeClass('hide');
								$('#play').removeClass('hide');
								$('#stop').removeClass('hide');
							}
						}
						frame = document.getElementById('frame'+frameArr.length);
						frameArr.push(frame);
					});
				}

				function animate(){
					console.log('animate');
					if(animVar == true){
						$("img[id^='frame']").addClass('hide');
						$('#frame'+currentFrame).removeClass('hide');
						if(currentFrame == frameArr.length-1){
							currentFrame = 0;
						}else{
							currentFrame++;
						}
						$('#frameNum').html(currentFrame);
					}
				}
            }
        </script>
    </head>
    <body class="m10">
		<div id="currentBox" class="mb20">
			<div class="mb5 fs24">current:</div>
			<div class="line">
				<div id="container" class="unit mr10 mb10 bBlack w100 bgWhite"></div>
				<div class="unit">
					<button id="add" class="dBlock mb10 w100">add</button>
					<button id="save" class="dBlock mb10 w100">save</button>
				</div>
			</div>
		</div>

		<div id="saveBox" class="mb20 hide">
			<div class="mb5 fs24">images:</div>
			<div id="saved" class="line hide"></div>
		</div>

		<div id="animBox" class="hide">
			<div class="mb5 fs24">frame: <span id="frameNum">0</span></div>
			<div class="line">
				<div class="unit mr10 mb10 bBlack w100 bgWhite">
					<div id="anim"></div>
				</div>
				<div class="unit">
					<button id="play" class="dBlock mb10 w100 hide">play</button>
					<button id="stop" class="dBlock w100 hide">stop</button>
				</div>
			</div>
		</div>
    </body>
</html>