function init(){
	if ('ontouchstart' in window || window.navigator.msPointerEnabled) {
		touch = true;
		if(screen.width > screen.height){
			canvas_width = screen.height;
			canvas_height = screen.width;
		}else{
			canvas_width = screen.width;
			canvas_height = screen.height;
		}
		stage_width = canvas_height-200;
		stage_height = canvas_height-220;
	}else{
		touch = false;
		canvas_width = 300;
		canvas_height = 300;
		stage_width = canvas_width-10;
		stage_height = canvas_height-110;
	}
	
	canvas = document.createElement('canvas');
	canvas.setAttribute('id', 'canvas');
	canvas.width = canvas_width;
	canvas.height = canvas_height;
	document.body.appendChild(canvas);
	canvas = document.getElementById('canvas');
	if(document.getElementById('canvas').getContext){
		context = document.getElementById('canvas').getContext('2d');
		
		enemyArr = new Array();
		bulletArr = new Array();
		
		mousedown = false;
		enemyCount = 0;
		bulletCount = 0;
		time = 0;
		
		player_sprite = new Image();
		player_sprite.src = '../img/matt.png';
		
		stage = {
			x:5,
			y:5,
			draw:function(){
				context.fillStyle = "#fff";
				context.rect(this.x,this.y,stage_width,stage_height);
				context.fill();
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
		if(touch){
			window.addEventListener('orientationchange', orient);
			orient();
		}
	}
}

function addEnemy(){
	var enemy = canvas['enemy' + enemyCount];
	enemy = {
		x:0,
		y:0,
		width:40,
		height:48,
		spent:false,
		update:function(){
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
		draw:function(){
			context.beginPath();
			context.fillStyle = '#00f';
			context.rect(stage.x+this.x,stage.y+this.y,this.width,this.height);
			context.fill();
		}
	}
	enemy.x = Math.floor(Math.random()*(stage_width-enemy.width));
	enemy.y = Math.floor(Math.random()*(stage_height-enemy.height));
	
	enemyArr.push(enemy);
	enemyCount++;
}

function initControls(){
	dpad = {
		x:5,
		y:stage.y+stage_height+5,
		width:90,
		height:90,
		fill:'#666',
		down:'#333',
		draw:function(){
			btnUp.draw();
			btnRight.draw();
			btnLeft.draw();
			btnDown.draw();
			btnA.draw();
			
			context.lineWidth = 1;
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
			
			context.moveTo(this.x+this.width*1/3,this.y+this.height*1/3);
			context.lineTo(this.x+this.width*2/3,this.y+this.height*2/3);
			context.moveTo(this.x+this.width*1/3,this.y+this.height*2/3);
			context.lineTo(this.x+this.width*2/3,this.y+this.height*1/3);
			context.stroke();
		}
	}
	btnLeft = {
		x:dpad.x,
		y:dpad.y,
		width:dpad.width/2,
		height:dpad.height,
		dir:'left',
		mousedown:false,
		draw:function(){
			if(this.mousedown == false){
				context.fillStyle = dpad.fill;
			}else{
				context.fillStyle = dpad.down;
			}
			
			context.beginPath();
			context.moveTo(dpad.x+dpad.width/2,dpad.y+dpad.height/2);
			context.lineTo(dpad.x+dpad.width*1/3,dpad.y+dpad.height*2/3);
			context.lineTo(dpad.x,dpad.y+dpad.height*2/3);
			context.lineTo(dpad.x,dpad.y+dpad.height*1/3);
			context.lineTo(dpad.x+dpad.width*1/3,dpad.y+dpad.height*1/3);
			context.closePath();
			context.fill();
		}
	}
	btnRight = {
		x:dpad.x+dpad.width/2,
		y:dpad.y,
		width:dpad.width/2,
		height:dpad.height,
		dir:'right',
		mousedown:false,
		draw:function(){
			if(this.mousedown == false){
				context.fillStyle = dpad.fill;
			}else{
				context.fillStyle = dpad.down;
			}
			
			context.beginPath();
			context.moveTo(dpad.x+dpad.width/2,dpad.y+dpad.height/2);
			context.lineTo(dpad.x+dpad.width*2/3,dpad.y+dpad.height*1/3);
			context.lineTo(dpad.x+dpad.width,dpad.y+dpad.height*1/3);
			context.lineTo(dpad.x+dpad.width,dpad.y+dpad.height*2/3);
			context.lineTo(dpad.x+dpad.width*2/3,dpad.y+dpad.height*2/3);
			context.closePath();
			context.fill();
		}
	}
	btnUp = {
		x:dpad.x,
		y:dpad.y,
		width:dpad.width,
		height:dpad.height/2,
		dir:'up',
		mousedown:false,
		draw:function(){
			if(this.mousedown == false){
				context.fillStyle = dpad.fill;
			}else{
				context.fillStyle = dpad.down;
			}
			
			context.beginPath();
			context.moveTo(dpad.x+dpad.width/2,dpad.y+dpad.height/2);
			context.lineTo(dpad.x+dpad.width*1/3,dpad.y+dpad.height*1/3);
			context.lineTo(dpad.x+dpad.width*1/3,dpad.y);
			context.lineTo(dpad.x+dpad.width*2/3,dpad.y);
			context.lineTo(dpad.x+dpad.width*2/3,dpad.y+dpad.height*1/3);
			context.closePath();
			context.fill();
		}
	}
	btnDown = {
		x:dpad.x,
		y:dpad.y+dpad.height/2,
		width:dpad.width,
		height:dpad.height/2,
		dir:'down',
		mousedown:false,
		draw:function(){
			if(this.mousedown == false){
				context.fillStyle = dpad.fill;
			}else{
				context.fillStyle = dpad.down;
			}
			
			context.beginPath();
			context.moveTo(dpad.x+dpad.width/2,dpad.y+dpad.height/2);
			context.lineTo(dpad.x+dpad.width*2/3,dpad.y+dpad.height*2/3);
			context.lineTo(dpad.x+dpad.width*2/3,dpad.y+dpad.height);
			context.lineTo(dpad.x+dpad.width*1/3,dpad.y+dpad.height);
			context.lineTo(dpad.x+dpad.width*1/3,dpad.y+dpad.height*2/3);
			context.closePath();
			context.fill();
		}
	}
	btnA = {
		x:stage.x+stage_width-dpad.width,
		y:dpad.y,
		width:90,
		height:90,
		fill:'#f00',
		down:'#c00',
		mousedown:false,
		draw:function(){
			if(this.mousedown == false){
				context.fillStyle = this.fill;
			}else{
				context.fillStyle = this.down;
			}
			context.lineWidth = 2;
			context.beginPath();
			context.moveTo(this.x+this.width/2, this.y+this.height/2);
			context.arc(this.x+this.width/2, this.y+this.height/2, this.width/2, 0, (Math.PI/180)*360);
			context.stroke();
			context.fill();
		}
	}
	
	bttnArr = new Array(btnLeft, btnRight, btnUp, btnDown, btnA);
	
	if(touch){
		canvas.addEventListener('touchstart', function(e){
			mousedown = true;
			checkHit(e);
		});
		canvas.addEventListener('touchmove', function(e){
			if(mousedown){
				checkHit(e);
			}
		});
		canvas.addEventListener('touchend', function(e){
			mousedown = false;
			player.run = false;
			player.sprite_x = 0;
			for(var i=0;i<bttnArr.length;i++){
				bttnArr[i].mousedown = false;
			}
		});
	}else{
		canvas.addEventListener('mousedown', function(e){
			mousedown = true;
			checkHit(e);
		});
		canvas.addEventListener('mousemove', function(e){
			if(mousedown){
				checkHit(e);
			}
		});
		canvas.addEventListener('mouseup', function(e){
			mousedown = false;
			player.run = false;
			player.sprite_x = 0;
			for(var i=0;i<bttnArr.length;i++){
				bttnArr[i].mousedown = false;
			}
		});
	}
					
	function checkHit(e){
		var hit = false;
		if(touch){
			event.preventDefault();
			click_x = e.touches[0].pageX-canvas.offsetLeft;
			click_y = e.touches[0].pageY-canvas.offsetTop;
		}else{
			click_x = e.clientX-canvas.offsetLeft;
			click_y = e.clientY-canvas.offsetTop;
		}
		for(var i=0;i<bttnArr.length;i++){
			if(bttnArr[i] == btnA){
				if(click_x>bttnArr[i].x && click_x<bttnArr[i].x+bttnArr[i].width && click_y>bttnArr[i].y && click_y<bttnArr[i].y+bttnArr[i].height){
					btnA.mousedown = true;
					shoot(player);
					hit = true;
				}
			}else{
				var triangle = bttnArr[i];
				tan_x = triangle.x;
				if(triangle.width > triangle.height){
					//up or down button
					if(click_x<=dpad.x+dpad.width/2){//left half of dpad width
						tan_width = click_x-triangle.x;
					}else{
						tan_width = Math.abs(click_x-triangle.x-triangle.width);
					}
					if(triangle.y == dpad.y+dpad.height/2){//bottom half of dpad height
						tan_y = triangle.y+triangle.height;
						click_depth = Math.abs(dpad.y+dpad.height-click_y);
						tan_depth = Math.abs(triangle.y+triangle.height-tan_width);
					}else{
						click_depth = click_y-dpad.y;
						tan_depth = tan_width;
					}
				}else{
					//left or right button
					if(click_y<=dpad.y+dpad.height/2){//top half of dpad height
						tan_width = Math.abs(click_y-triangle.y);
					}else{
						tan_width = Math.abs(click_y-triangle.y-triangle.height);
					}
					if(triangle.x == dpad.x+dpad.width/2){//right half of dpad width
						tan_x = triangle.x+triangle.width;
						click_depth = Math.abs(dpad.x+dpad.width-click_x);
						tan_depth = Math.abs(triangle.x+triangle.width-tan_width);
					}else{
						click_depth = Math.abs(click_x-dpad.x);
						tan_depth = Math.abs(tan_width);
					}
				}
				if(click_x<triangle.x || click_x>triangle.x+triangle.width || click_y<triangle.y || click_y>triangle.y+triangle.height || click_depth>tan_width){
					triangle.mousedown = false;
				}else{
					triangle.mousedown = true;
					player.dir = bttnArr[i].dir;
					player.run = true;
					hit = true;
				}
			}
		}
		if(hit == false){
			player.run = false;
			player.sprite_x = 0;
			for(var i=0;i<bttnArr.length;i++){
				bttnArr[i].mousedown = false;
			}
		}
	}
	
	document.body.addEventListener('keydown', function(event) {
		if(event.keyCode == 37) {
			player.dir = 'left';
			player.run = true;
			btnLeft.mousedown = true;
		}
		if(event.keyCode == 39) {
			player.dir = 'right';
			player.run = true;
			btnRight.mousedown = true;
		}
		if(event.keyCode == 38) {
			player.dir = 'up';
			player.run = true;
			btnUp.mousedown = true;
		}
		if(event.keyCode == 40) {
			player.dir = 'down';
			player.run = true;
			btnDown.mousedown = true;
		}
		if(event.keyCode == 32 || event.keyCode == 88 || event.keyCode == 90) {
			shoot(player);
			btnA.mousedown = true;
		}
	});
	
	document.addEventListener('keyup', function(event) {
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
		x:0,
		y:0,
		width:40,
		height:48,
		sprite_x:0,
		sprite_y:0,
		speed:15,
		dir:'right',
		count:0,
		run:false,
		update:function(){
			if(this.run == true){
				if(this.dir == 'left'){
					this.sprite_y = this.height;
					if(this.x-this.speed > 0){
						this.x -= this.speed;
					}else{
						this.x = 0;
					}
				}else if(this.dir == 'right'){
					this.sprite_y = 0;
					temp = stage_width-this.width;
					if(this.x+this.speed < stage_width-this.width){
						this.x += this.speed;
					}else{
						this.x = stage_width-this.width;
					}
				}else if(this.dir == 'up'){
					this.sprite_y = this.height*3;
					if(this.y-this.speed > 0){
						this.y -= this.speed;
					}else{
						this.y = 0;
					}
				}else if(this.dir == 'down'){
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
		draw:function(){
			context.drawImage(player_sprite,this.sprite_x,this.sprite_y,this.width,this.height,stage.x+this.x,stage.y+this.y,this.width,this.height);
		}
	};
	player.x = (stage_width-player.width)/2;
	player.y = (stage_height-player.height)/2;
}

function orient(){
	if(Math.abs(window.orientation) == 90){//landscape
		canvas.width = canvas_height;
		canvas.height = canvas_width;
		stage.x = 100;
		stage.y = 5;
		dpad.x = 5;
		dpad.y = 90;
		btnA.x = stage.x+stage_width+5;
		btnA.y = dpad.y;
	}else{//portrait
		canvas.width = canvas_width;
		canvas.height = canvas_height;
		stage.x = 20;
		stage.y = 10;
		dpad.x = stage.x;
		dpad.y = stage.y+stage_height+10;
		btnA.x = stage.x+stage_width-btnA.width;
		btnA.y = stage.y+stage_height+10;
	}
	btnLeft.x = dpad.x;
	btnLeft.y = dpad.y;
	btnRight.x = dpad.x+dpad.width/2;
	btnRight.y = dpad.y;
	btnUp.x = dpad.x;
	btnUp.y = dpad.y;
	btnDown.x = dpad.x;
	btnDown.y = dpad.y+dpad.height/2;
	update();
	draw();
	window.scrollTo(0,1);
}

function shoot(obj){
	var bullet = canvas['bullet' + bulletCount];
	bullet = {
		x:obj.x,
		y:obj.y,
		dir:obj.dir,
		size:4,
		speed:12,
		spent:false,
		update:function(){
			if(this.dir == 'left'){
				if(this.x-this.speed>0){
					this.x -=  this.speed;
				}else{
					this.spent = true;
				}
			}else if(this.dir == 'right'){
				if(this.x+this.speed<stage_width){
					this.x +=  this.speed;
				}else{
					this.spent = true;
				}
			}else if(this.dir == 'up'){
				if(this.y-this.speed>0){
					this.y -= this.speed;
				}else{
					this.spent = true;
				}
			}else if(this.dir == 'down'){
				if(this.y+this.speed<stage_height){
					this.y +=  this.speed;
				}else{
					this.spent = true;
				}
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
		draw:function(){
			context.beginPath();
			context.fillStyle = '#f00';
			context.rect(stage.x+this.x,stage.y+this.y,this.size,this.size);
			context.fill();
		}
	}
	if(bullet.dir == 'left'){
		bullet.x -= bullet.size;
		bullet.y += 20;
	}else if(bullet.dir == 'right'){
		bullet.x += obj.width;
		bullet.y += 20;
	}else if(bullet.dir == 'up'){
		bullet.x += 28;
	}else if(bullet.dir == 'down'){
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
	dpad.draw();
	player.draw();
}