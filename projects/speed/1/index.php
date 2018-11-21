<!doctype html>
<html dir="ltr" lang="en-us">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>speed reading exercise #1</title>
        <link href="/images/icons/r.ico" rel="icon" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=0" />
		<style type="text/css">
			#frame.vert{
				/*
				border:1px solid red;
				*/
				margin:0;
				padding:0;
				width:320px;
				height:340px;
			}
			#frame.hor{
				/*
				border:1px solid blue;
				*/
				margin:0;
				padding:0;
				width:480px;
				height:208px;
			}
			#sidebar{
				margin-left:10px;
				border:1px solid black;
				width:320px;
				height:356px;
				display:none;
			}
			.num{
				/*
				border:1px solid red;
				*/
				padding:0;
				width:50px;
				height:34px;
				position:absolute;
				font:bold 32px/32px arial;
				text-align:center;
			}

        </style>
		<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="gyro.js"></script>
		<script>
			var coords = new Array();
			var floats;
			var list;
			var numW;
			var numH;
			$(function(){
				distribute();
				$("#frame").click(distribute);
				getGyro();
			});

			function distribute(){
				coords.splice(0);
				floats = "";
				list = "";

				numW = Math.floor($("#frame").width()/50);
				numH = Math.floor($("#frame").height()/34);

				for (x=0; x<numW; x++) {
					for (y=0; y<numH; y++) {
						coords.push(new Array(x, y));
					}
				}
				for(i=1;i<=25;i++){
					rand = Math.floor(Math.random()*coords.length);
					x = coords[rand][0]*50;
					y = coords[rand][1]*34;
					list += i+": "+coords[rand][0]+", "+coords[rand][1]+"<br/>";
					floats += "<div class='num' style='margin-left:"+x+"px;margin-top:"+y+"px;'>"+i+"</div>";
					coords.splice(rand,1);
				}
				$("#frame").html(floats);
				//$("#frame2").html(list).show();
			};
        </script>
    </head>
    <body bgcolor="#ffffff">
        <div id="frame" class="vert" style="float:left;"></div>
        <div id="frame2" style="float:left;"></div>
        <div id="" style="clear:both;"></div>
        <div id="currentOrientation"></div>
    </body>
</html>
