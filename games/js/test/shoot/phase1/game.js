function init(){
	stage_width = 300;
	stage_height = 200;
	canvas = document.createElement("canvas");
	canvas.setAttribute("id", "canvas");
	canvas.width = stage_width;
	canvas.height = stage_height+100;
	document.body.appendChild(canvas);
	if(document.getElementById("canvas").getContext){
		context = document.getElementById("canvas").getContext("2d");
		
		enemyArr = new Array();
		bulletArr = new Array();
		
		enemyCount = 0;
		bulletCount = 0;
		time = 0;
		
		player_sprite = new Image();
		player_sprite.src = '../img/matt.png';
		
		stage = {
			draw:function(){
				context.rect(0,0,stage_width,stage_height);
				context.stroke();
				for(var i=0;i<enemyArr.length;i++){
					enemyArr[i].update();
					if(enemyArr[i]){
						enemyArr[i].draw();
					}
				}
				for(var i=0;i<bulletArr.length;i++){
					bulletArr[i].update();
					if(bulletArr[i]){
						bulletArr[i].draw();
					}
				}
			}
		};
		
		initControls();
		initPlayer();
		addEnemy();
	}
}

function addEnemy(){
	var enemy = canvas["enemy" + enemyCount];
	enemy = {
		x: 0,
		y: 0,
		width: 40,
		height: 48,
		spent: false,
		update: function(){
			for(var i=0;i<bulletArr.length;i++){
				var bullet = bulletArr[i];
				if(bullet.x+bullet.size>this.x && bullet.x<this.x+this.width && bullet.y+bullet.size>this.y && bullet.y<this.y+this.height){
					bullet.spent = true;
					this.spent = true;
				}
			}
			if(this.spent == true){
				for(var i=0;i<enemyArr.length;i++){
					if(enemyArr[i] == this){
						enemyArr.splice(i,1);
					}
				}
				delete this;
				addEnemy();
			}
		},
		draw: function(){
			context.beginPath();
			context.fillStyle = "#00f";
			context.rect(this.x,this.y,this.width,this.height);
			context.fill();
		}
	}
	enemy.x = Math.round(Math.random()*(stage_width-enemy.width));
	enemy.y = Math.round(Math.random()*(stage_height-enemy.height));
										
	enemyArr.push(enemy);
	enemyCount++;
}

function initControls(){
	controls = {
		x:0,
		y:stage_height+5,
		width:90,
		height:90,
		fill:"#666",
		down:"#333",
		draw: function(){
			btnUp.draw();
			btnRight.draw();
			btnLeft.draw();
			btnDown.draw();
			btnA.draw();
			context.beginPath();
			context.moveTo(this.x+this.width*1/3,this.y);
			context.lineTo(this.x+this.width*2/3,this.y);
			context.lineTo(this.x+this.width*2/3,this.y+this.height*1/3);
			context.lineTo(this.x+this.width,this.y+this.height*1/3);
			context.lineTo(this.x+this.width,this.y+this.height*2/3);
			context.lineTo(this.x+this.width*2/3,this.y+this.height*2/3);
			context.lineTo(this.x+this.width*2/3,this.y+this.height);
			context.lineTo(this.x+this.width*1/3,this.y+this.height);
			context.lineTo(this.x+this.width*1/3,this.y+this.height*2/3);
			context.lineTo(this.x,this.y+this.height*2/3);
			context.lineTo(this.x,this.y+this.height*1/3);
			context.lineTo(this.x+this.width*1/3,this.y+this.height*1/3);
			context.closePath();
			context.stroke();
		}
	}
	btnLeft = {
		x: controls.x,
		y: controls.y+controls.height/3,
		width: controls.width/3,
		height: controls.height/3,
		dir: "left",
		mousedown: false,
		draw: function(){
			if(this.mousedown == false){
				context.fillStyle = controls.fill;
			}else{
				context.fillStyle = controls.down;
			}
			context.beginPath();
			context.moveTo(controls.x+controls.width/2,controls.y+controls.height/2);
			context.lineTo(controls.x+controls.width*1/3,controls.y+controls.height*2/3);
			context.lineTo(controls.x,controls.y+controls.height*2/3);
			context.lineTo(controls.x,controls.y+controls.height*1/3);
			context.lineTo(controls.x+controls.width*1/3,controls.y+controls.height*1/3);
			context.closePath();
			context.fill();
		}
	}
	btnRight = {
		x: controls.x+controls.width*2/3,
		y: controls.y+controls.height/3,
		width: controls.width/3,
		height: controls.height/3,
		dir: "right",
		mousedown: false,
		draw: function(){
			if(this.mousedown == false){
				context.fillStyle = controls.fill;
			}else{
				context.fillStyle = controls.down;
			}
			//context.fillRect(this.x,this.y,this.width,this.height);
			context.beginPath();
			context.moveTo(controls.x+controls.width/2,controls.y+controls.height/2);
			context.lineTo(controls.x+controls.width*2/3,controls.y+controls.height*1/3);
			context.lineTo(controls.x+controls.width,controls.y+controls.height*1/3);
			context.lineTo(controls.x+controls.width,controls.y+controls.height*2/3);
			context.lineTo(controls.x+controls.width*2/3,controls.y+controls.height*2/3);
			context.closePath();
			context.fill();
		}
	}
	btnUp = {
		x: controls.x+controls.width/3,
		y: controls.y,
		width: controls.width/3,
		height: controls.height/3,
		dir: "up",
		mousedown: false,
		draw: function(){
			if(this.mousedown == false){
				context.fillStyle = controls.fill;
			}else{
				context.fillStyle = controls.down;
			}
			//context.fillRect(this.x,this.y,this.width,this.height);
			context.beginPath();
			context.moveTo(controls.x+controls.width/2,controls.y+controls.height/2);
			context.lineTo(controls.x+controls.width*1/3,controls.y+controls.height*1/3);
			context.lineTo(controls.x+controls.width*1/3,controls.y);
			context.lineTo(controls.x+controls.width*2/3,controls.y);
			context.lineTo(controls.x+controls.width*2/3,controls.y+controls.height*1/3);
			context.closePath();
			context.fill();
		}
	}
	btnDown = {
		x: controls.x+controls.width*1/3,
		y: controls.y+controls.height*2/3,
		width: controls.width/3,
		height: controls.height/3,
		dir: "down",
		mousedown: false,
		draw: function(){
			if(this.mousedown == false){
				context.fillStyle = controls.fill;
			}else{
				context.fillStyle = controls.down;
			}
			//context.fillRect(this.x,this.y,this.width,this.height);
			context.beginPath();
			context.moveTo(controls.x+controls.width/2,controls.y+controls.height/2);
			context.lineTo(controls.x+controls.width*2/3,controls.y+controls.height*2/3);
			context.lineTo(controls.x+controls.width*2/3,controls.y+controls.height);
			context.lineTo(controls.x+controls.width*1/3,controls.y+controls.height);
			context.lineTo(controls.x+controls.width*1/3,controls.y+controls.height*2/3);
			context.closePath();
			context.fill();
		}
	}
	btnA = {
		x: stage_width-100,
		y: stage_height+5,
		width: 90,
		height: 90,
		fill: "#f00",
		down: "#c00",
		mousedown: false,
		draw: function(){
			if(this.mousedown == false){
				context.fillStyle = this.fill;
			}else{
				context.fillStyle = this.down;
			}
			context.beginPath();
			context.moveTo(this.x+this.width/2, this.y+this.height/2);
			context.arc(this.x+this.width/2, this.y+this.height/2, this.width/2, 0, (Math.PI/180)*360);
			context.stroke();
			context.fill();
		}
	}
	
	if ('ontouchstart' in window){
		touch = true;
	}else if(window.navigator.msPointerEnabled) {
		touch = true;
	}else{
		touch = false;
	}
	
	bttnArr = new Array(btnLeft, btnRight, btnUp, btnDown, btnA);
	
	if(touch){
		canvas.addEventListener("touchstart", down, false);
		canvas.addEventListener("touchend", up, false);
		canvas.addEventListener("touchmove", move, false);
	}else{
		canvas.addEventListener("mousedown", down, false);
		canvas.addEventListener("mouseup", up, false);
		canvas.addEventListener("mousemove", move, false);
	}
	
	function down(e){
		if(touch){
			event.preventDefault();
			click_x = e.touches[0].pageX-canvas.offsetLeft;
			click_y = e.touches[0].pageY-canvas.offsetTop;
		}else{
			click_x = e.clientX-canvas.offsetLeft;
			click_y = e.clientY-canvas.offsetTop;
		}
		for(var i=0;i<bttnArr.length;i++){
			if(click_x>=bttnArr[i].x && click_x<=bttnArr[i].x+bttnArr[i].width && click_y>=bttnArr[i].y && click_y<=bttnArr[i].y+bttnArr[i].height){
				bttnArr[i].mousedown = true;
				if(bttnArr[i] == btnA){
					shoot(player);
				}else{
					player.dir = bttnArr[i].dir;
					player.run = true;
				}
			}
		}
	}
	function up(e){
		if(touch){
			for(var i=0;i<bttnArr.length;i++){
				bttnArr[i].mousedown = false;
			}
			player.run = false;
			player.sprite_x = 0;
		}else{
			click_x = e.clientX-canvas.offsetLeft;
			click_y = e.clientY-canvas.offsetTop;
			for(var i=0;i<bttnArr.length;i++){
				if(click_x>=bttnArr[i].x && click_x<=bttnArr[i].x+bttnArr[i].width && click_y>=bttnArr[i].y && click_y<=bttnArr[i].y+bttnArr[i].height){
					if(bttnArr[i] != btnA){
						bttnArr[i].mousedown = false;
						player.run = false;
						player.sprite_x = 0;
					}
				}
			}
		}
	}
	function move(e){
		if(touch){
			event.preventDefault();
			click_x = e.touches[0].pageX-canvas.offsetLeft;
			click_y = e.touches[0].pageY-canvas.offsetTop;
		}else{
			click_x = e.clientX-canvas.offsetLeft;
			click_y = e.clientY-canvas.offsetTop;
		}
		for(var i=0;i<bttnArr.length;i++){
			for(var i=0;i<bttnArr.length;i++){
				if(click_x>=bttnArr[i].x && click_x<=bttnArr[i].x+bttnArr[i].width && click_y>=bttnArr[i].y && click_y<=bttnArr[i].y+bttnArr[i].height){
				}else{
					if(bttnArr[i].mousedown == true){
						bttnArr[i].mousedown = false;
						player.run = false;
						player.sprite_x = 0;
					}
				}
			}
		}
	}
	
	document.body.addEventListener("keydown", function(event) {
		if(event.keyCode == 37) {
			player.dir = "left";
			player.run = true;
			btnLeft.mousedown = true;
		}
		if(event.keyCode == 39) {
			player.dir = "right";
			player.run = true;
			btnRight.mousedown = true;
		}
		if(event.keyCode == 38) {
			player.dir = "up";
			player.run = true;
			btnUp.mousedown = true;
		}
		if(event.keyCode == 40) {
			player.dir = "down";
			player.run = true;
			btnDown.mousedown = true;
		}
		if(event.keyCode == 32 || event.keyCode == 88 || event.keyCode == 90) {
			shoot(player);
			btnA.mousedown = true;
		}
	});
	
	document.addEventListener("keyup", function(event) {
		if(event.keyCode >= 37 && event.keyCode <= 40) {
			player.run = false;
			player.sprite_x = 0;
			btnLeft.mousedown = false;
			btnRight.mousedown = false;
			btnUp.mousedown = false;
			btnDown.mousedown = false;
		}
		if(event.keyCode == 32 || event.keyCode == 88 || event.keyCode == 90) {
			btnA.mousedown = false;
		}
	});
	
	setInterval(function(){
		update();
		draw();
		time++;
	}, 1000/16);
}
		
function initPlayer(){
	player = {
		x: 200,
		y: 200,
		width: 40,
		height: 48,
		sprite_x: 0,
		sprite_y: 0,
		speed: 15,
		dir: "right",
		count: 0,
		run: false,
		update: function(){
			if(this.run == true){
				if(this.dir == "left"){
					this.sprite_y = this.height;
					if(this.x-this.speed > 0){
						this.x -= this.speed;
					}else{
						this.x = 0;
					}
				}else if(this.dir == "right"){
					this.sprite_y = 0;
					temp = stage_width-this.width;
					if(this.x+this.speed < stage_width-this.width){
						this.x += this.speed;
					}else{
						this.x = stage_width-this.width;
					}
				}else if(this.dir == "up"){
					this.sprite_y = this.height*3;
					if(this.y-this.speed>0){
						this.y -= this.speed;
					}else{
						this.y = 0;
					}
				}else if(this.dir == "down"){
					this.sprite_y = this.height*2;
					if(this.y+this.speed < stage_height-this.height){
						this.y += this.speed;
					}else{
						this.y = stage_height-this.height;
					}
				}
				if(this.count<7){
					this.count++;
				}else{
					this.count = 0;
				}
				this.sprite_x = this.width+this.count*this.width;
			}
		},
		draw: function(){
			context.drawImage(player_sprite,this.sprite_x,this.sprite_y,this.width,this.height,this.x,this.y,this.width,this.height);
		}
	};
	player.x = (stage_width-player.width)/2;
	player.y = (stage_height-player.height)/2;
}
		
function shoot(obj){
	var bullet = canvas["bullet" + bulletCount];
	bullet = {
		x: obj.x,
		y: obj.y,
		dir: obj.dir,
		size: 4,
		speed: 15,
		spent: false,
		update: function(){
			if(this.x>0 && this.x<stage_width && this.y>0 && this.y<stage_height){
				if(this.dir == "left"){
					this.x -=  this.speed;
				}else if(this.dir == "right"){
					this.x +=  this.speed;
				}else if(this.dir == "up"){
					this.y -=  this.speed;
				}else if(this.dir == "down"){
					this.y +=  this.speed;
				}
			}else{
				this.spent = true;
			}
			if(this.spent == true){
				for(var i=0;i<bulletArr.length;i++){
					if(bulletArr[i] == this){
						bulletArr.splice(i,1);
					}
				}
				delete this;
			}
		},
		draw: function(){
			context.beginPath();
			context.fillStyle = "#f00";
			context.rect(this.x,this.y,this.size,this.size);
			context.fill();
		}
	}
	if(bullet.dir == "left"){
		bullet.x -= bullet.size;
		bullet.y += 20;
	}else if(bullet.dir == "right"){
		bullet.x += obj.width;
		bullet.y += 20;
	}else if(bullet.dir == "up"){
		bullet.x += 28;
	}else if(bullet.dir == "down"){
		bullet.x += 12;
		bullet.y += obj.height;
	}
	bulletArr.push(bullet);
	bulletCount++;
}

function update(){
	player.update();
}

function draw(){
	context.clearRect(0,0,canvas.width,canvas.height);
	stage.draw();
	controls.draw();
	player.draw();
}
