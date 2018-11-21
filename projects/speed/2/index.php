<!doctype html>
<html dir="ltr" lang="en-us">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>speed reading exercise #2</title>
        <link href="/images/icons/r.ico" rel="icon" type="image/x-icon">
		<style type="text/css">
			div{
				margin:0;
				padding:0;
				display:block;
			}
			#frame.vert{
				/*
				border:1px solid blue;
				*/
				margin:0;
				padding:0;
				width:1000px;
				height:1100px;
			}
			#frame.hor{
				/*
				border:1px solid red;
				*/
				margin:0 auto;
				padding:0;
				width:400px;
				height:400px;

			}
			#corner1.vert{margin-left:0;margin-top:0;}
			#corner2.vert{margin-left:800px;margin-top:0;}
			#corner3.vert{margin-left:800px;margin-top:800px;}
			#corner4.vert{margin-left:0;margin-top:800px;}

			#corner1.hor{margin-left:0;margin-top:0;}
			#corner2.hor{margin-left:300px;margin-top:0;}
			#corner3.hor{margin-left:300px;margin-top:300px;}
			#corner4.hor{margin-left:0;margin-top:300px;}
			div .vert{
				/*
				border:1px solid red;
				*/
				padding:0;
				width:200px;
				height:200px;
				position:absolute;
				float:left;
				font:bold 200px/200px arial;
				text-align:center;
			}
			div .hor{
				/*
				border:1px solid red;
				*/
				padding:0;
				width:100px;
				height:100px;
				position:absolute;
				float:left;
				font:bold 100px/100px arial;
				text-align:center;
			}
        </style>
		<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="gyro.js"></script>
		<script>
			$(function(){
				var numbers = new Array();

				distribute();

				$("#frame").click(function(){
					distribute();
				});

				function distribute(){
					numbers.splice(0);
					numbers.push(1, 2, 3, 4);
					for(i=1;i<=4;i++){
						rand = Math.floor(Math.random()*numbers.length);
						cornerNum = numbers[rand];
						$("#corner"+i).html(cornerNum);
						numbers.splice(rand,1);
						console.log($("#corner"+i));
					}
				};
				getGyro();
			});
        </script>
    </head>
    <body bgcolor="#ffffff">
    	<div id="frame" class="vert">
            <div id="corner1" class="num vert"></div>
            <div id="corner2" class="num vert"></div>
            <div id="corner3" class="num vert"></div>
            <div id="corner4" class="num vert"></div>
            <div style="clear:both;"></div>
        </div>
        <div id="currentOrientation"></div>
    </body>
</html>
