//init
var stage = new Kinetic.Stage({
	container: 'kinetic',
	width: 400,
	height: 400
});
var layer = new Kinetic.Layer();

//lines
var line = new Kinetic.Line(
	{
		points:[10, 100, 390, 100],
		stroke:'gray',
		strokeWidth:1
	}
);
layer.add(line);

var line = new Kinetic.Line({
	points:[10, 200, 390, 200],
	stroke:'gray',
	strokeWidth:1
});
layer.add(line);

var line = new Kinetic.Line({
	points:[10, 300, 390, 300],
	stroke:'gray',
	strokeWidth:1
});
layer.add(line);

var line = new Kinetic.Line({
	points:[100, 10, 100, 390],
	stroke:'gray',
	strokeWidth:1
});
layer.add(line);

var line = new Kinetic.Line({
	points:[200, 10, 200, 390],
	stroke:'gray',
	strokeWidth:1
});
layer.add(line);

var line = new Kinetic.Line({
	points:[300, 10, 300, 390],
	stroke:'gray',
	strokeWidth:1
});
layer.add(line);

//rectangle
var rect = new Kinetic.Rect({
	x:10,
	y:10,
	width:80,
	height:80,
	fill:'red',
	stroke:'blue',
	strokeWidth:1
});
layer.add(rect);

//circle
var circle = new Kinetic.Circle({
	x:150,
	y:50,
	radius:40,
	fill:'blue',
	stroke:'red',
	strokeWidth:2
});
layer.add(circle);

//triangle
var poly = new Kinetic.Line({
	points:[
		210, 10, 
		290, 50, 
		210, 90
	],
	fill:'#ccc',
	stroke:'#666',
	strokeWidth:5,
	closed:true
});
layer.add(poly);

//fill text
var text1 = new Kinetic.Text({
	x:310,
	y:23,
	text:'Fill Text',
	fontSize:13,
	fontFamily:'Courier New',
	fill:'black'
});
layer.add(text1);

//stroke text
var text2 = new Kinetic.Text({
	x:10,
	y:110,
	text:'Stroke Text',
	fontSize:72,
	fontFamily:'Arial',
	stroke:'#0f0',
	strokeWidth:1
});
layer.add(text2);

//linear gradient
var linearGradient = new Kinetic.Rect({
	x:10,
	y:210,
	width:80,
	height:80,
	stroke:'black',
	fillLinearGradientStartPoint:{x:0, y:210},
	fillLinearGradientEndPoint:{x:80, y:210},
	fillLinearGradientColorStops:[0, 'red', 0.5, 'white', 1, 'blue'],
});
layer.add(linearGradient);

//radial gradient
var radialGradient = new Kinetic.Circle({
	x:150,
	y:250,
	radius:40,
	fillRadialGradientStartRadius:5,
	fillRadialGradientEndRadius:40,
	fillRadialGradientColorStops:[0, 'green', 1, 'white']
});
layer.add(radialGradient);

//image detail
var imgLayer1 = new Kinetic.Layer();
var imageObj = new Image();
imageObj.onload = function() {
	var matt1 = new Kinetic.Image({
		x:210,
		y:210,
		image:imageObj,
		width:80,
		height:80
	});
	matt1.crop({
		x:55,
		y:150,
		width:80,
		height:80
	});
	imgLayer1.add(matt1);
	stage.add(imgLayer1);
};
imageObj.src = 'img/matt.jpg';

//resized image
var imgLayer2 = new Kinetic.Layer();
var imageObj = new Image();
imageObj.onload = function() {
	var matt1 = new Kinetic.Image({
		x:310,
		y:210,
		image:imageObj,
		width:80,
		height:80
	});
	imgLayer2.add(matt1);
	stage.add(imgLayer2);
};
imageObj.src = 'img/matt.jpg';

stage.add(layer);