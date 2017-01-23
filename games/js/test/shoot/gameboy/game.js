$(window).load(function(){
	//prevent mobile windows from dragging and scrolling
	document.body.addEventListener('touchstart', function(e){
		e.preventDefault();
	});
	
	//set CSS-based vars
	stageW = $('#stage').width();
	stageH = $('#stage').height();
	
	//set selector shortcuts
	bullets = $('#bullets');
	enemies = $('#enemies');
	
	mouseDown = false;
	
	bombArr = new Array();
	bulletArr = new Array();
	enemyArr = new Array();
	keyArr = new Array();
	
	player = {
		selector:$('#player'),
		spriteW:360,
		frameW:40,
		frameH:48,
		bgX:0,
		bgY:0,
		x:130,
		y:127,
		hitW:40,
		hitH:48,
		hitX:0,
		hitY:0,
		count:0,
		live:true,
		dir:'right',
		speed:6,
		running:false,
		update:function(){
			if(this.live){
				if(this.running){
					if(this.bgX - this.frameW > 0-this.spriteW+this.frameW){
						this.bgX -= this.frameW;
					}else{
						this.bgX = 0-this.frameW;
					}
					if(this.dir == 'left'){
						if(this.x-this.speed>0){
							this.x -= this.speed;
						}else{
							this.x = 0;
						}
					}
					if(this.dir == 'up'){
						if(this.y-this.speed>0){
							this.y -= this.speed;
						}else{
							this.y = 0;
						}
					}
					if(this.dir == 'right'){
						if(this.x+this.speed<stageW-this.frameW){
							this.x += this.speed;
						}else{
							this.x = stageW-this.frameW;
						}
					}
					if(this.dir == 'down'){
						if(this.y+this.speed<stageH-this.frameH){
							this.y += this.speed;
						}else{
							this.y = stageH-this.frameH;
						}
					}
				}
			}else{
				if(this.count < 24){
					this.count++;
				}else{
					init();
				}
			}
		},
		draw:function(){
			this.selector.css('left', this.x).css('top', this.y).css('background-position', player.bgX + 'px ' + player.bgY + 'px');
		}
	};
	
	init();
	setInterval(function(){animate();}, 1000/16);
	
	//KEYBOARD CONTROLS
	$('body').keydown(function(event){
		//alert('event: '+event.which);
		if(player.live){
			if(event.which == 37){
				runStart('left');
			}else if(event.which == 38){
				runStart('up');
			}else if(event.which == 39){
				runStart('right');
			}else if(event.which == 40){
				runStart('down');
			}else if(event.which == 32){//spacebar
				shoot(player);
			}else if(event.which == 66){//B
				addBomb();
			}
		}
	});
	
	$('body').keyup(function(event){
		if(player.live){
			if(event.which == 37){
				runEnd('left');
			}else if(event.which == 38){
				runEnd('up');
			}else if(event.which == 39){
				runEnd('right');
			}else if(event.which == 40){
				runEnd('down');
			}
		}
	});
	
	//MOUSE AND TOUCHSCREEN CONTROLS
	$('body').bind('mousedown touchstart', function() {
        mouseDown = true;
    }).bind('mouseup', function(){
		mouseDown = false;
		keyArr.splice(0);
		$('#btnLeft').mouseout();
		$('#btnUp').mouseout();
		$('#btnRight').mouseout();
		$('#btnDown').mouseout();
    }).bind('touchend', function(e){
		var touch = e.originalEvent.changedTouches[0];
		if(!touchCollision(touch.pageX, touch.pageY, $('#btnShoot'))){
			mouseDown = false;
			keyArr.splice(0);
			$('#btnLeft').mouseout();
			$('#btnUp').mouseout();
			$('#btnRight').mouseout();
			$('#btnDown').mouseout();
		}
    });
	$('body').bind('touchmove', function(e){
		var touch = e.originalEvent.changedTouches[0];
		if(touchCollision(touch.pageX, touch.pageY, $('#btnLeft'))){
			$('#btnLeft').mouseover();
		}else{
			$('#btnLeft').removeClass('bgGrayDown').addClass('bgGray');
		}
		if(touchCollision(touch.pageX, touch.pageY, $('#btnUp'))){
			$('#btnUp').mouseover();
		}else{
			$('#btnUp').removeClass('bgGrayDown').addClass('bgGray');
		}
		if(touchCollision(touch.pageX, touch.pageY, $('#btnRight'))){
			$('#btnRight').mouseover();
		}else{
			$('#btnRight').removeClass('bgGrayDown').addClass('bgGray');
		}
		if(touchCollision(touch.pageX, touch.pageY, $('#btnDown'))){
			$('#btnDown').mouseover();
		}else{
			$('#btnDown').removeClass('bgGrayDown').addClass('bgGray');
		}
    });
	
	$('#btnLeft').bind('mousedown touchstart',function(){
		$(this).removeClass('bgGray').addClass('bgGrayDown');
		runStart('left');
	}).bind('mouseup mouseout touchend', function(){
		$(this).removeClass('bgGrayDown').addClass('bgGray');
		runEnd('left');
	}).bind('mouseover', function(){
		if(mouseDown){
			$(this).removeClass('bgGray').addClass('bgGrayDown');
			runStart('left');
		}
	});
	
	$('#btnUp').bind('mousedown touchstart',function(){
		$(this).removeClass('bgGray').addClass('bgGrayDown');
		runStart('up');
	}).bind('mouseup mouseout touchend', function(){
		$(this).removeClass('bgGrayDown').addClass('bgGray');
		runEnd('up');
	}).bind('mouseover', function(){
		if(mouseDown){
			$(this).removeClass('bgGray').addClass('bgGrayDown');
			runStart('up');
		}
	});
	
	$('#btnRight').bind('mousedown touchstart',function(){
		$(this).removeClass('bgGray').addClass('bgGrayDown');
		runStart('right');
	}).bind('mouseup mouseout touchend', function(){
		$(this).removeClass('bgGrayDown').addClass('bgGray');
		runEnd('right');
	}).bind('mouseover', function(){
		if(mouseDown){
			$(this).removeClass('bgGray').addClass('bgGrayDown');
			runStart('right');
		}
	});
	
	$('#btnDown').bind('mousedown touchstart',function(){
		$(this).removeClass('bgGray').addClass('bgGrayDown');
		runStart('down');
	}).bind('mouseup mouseout touchend', function(){
		$(this).removeClass('bgGrayDown').addClass('bgGray');
		runEnd('down');
	}).bind('mouseover', function(){
		if(mouseDown){
			$(this).removeClass('bgGray').addClass('bgGrayDown');
			runStart('down');
		}
	});
	
	$('#btnShoot').bind('mousedown touchstart',function(){
		output(' ', true);
		$(this).removeClass('bgRed').addClass('bgRedDown');
		shoot(player);
	}).bind('mouseup touchend', function(){
		$(this).removeClass('bgRedDown').addClass('bgRed');
	});
	
	//FUNCTIONS
	function init(){
		//reset player
		player.live = true;
		player.count = 0;
		player.bgX = 0
		player.bgY = 0;
		player.dir = 'right'
		
		//clear game progress
		for(var i=0; i<bombArr.length; i++){
			bombArr[i].selector.remove();
		}
		bombArr.splice(0);
		for(var i=0; i<bulletArr.length; i++){
			bulletArr[i].selector.remove();
		}
		bulletArr.splice(0);
		/*
		//enemies don't exist yet.
		for(var i=0; i<enemyArr.length; i++){
			enemyArr[i].selector.remove();
		}
		enemyArr.splice(0);
		*/
		keyArr.splice(0);
		enemyCount = 0;
		bulletCount = 0;
		bombCount = 0;
		addBomb();
	}
	
	function animate(){
		player.update();
		player.draw();
		for(var bulletNum=0; bulletNum<bulletArr.length; bulletNum++){
			bulletArr[bulletNum].update();
			bulletArr[bulletNum].draw();
		}
		for(var bombNum=0; bombNum<bombArr.length; bombNum++){
			 bombArr[bombNum].update();
			 bombArr[bombNum].draw();
		}
	}
	
	function addBomb(){
		$('#bombs').append('<div id="bomb'+bombCount+'" class="bomb abs"/>');
		var newBomb = $('#bomb'+bombCount);
		var bombW = 72;
		var bombH = 56;
		var bombX = Math.floor(Math.floor(Math.random()*(stageW-bombW))/8)*8;
		var bombY = Math.floor(Math.floor(Math.random()*(stageH-bombH))/8)*8;
		obj = {
			selector:newBomb,
			id:bombCount,
			spriteW:360,
			frameW:bombW,
			frameH:bombH,
			bgX:0,
			bgY:0,
			x:bombX,
			y:bombY,
			hitW:8,
			hitH:8,
			hitX:32,
			hitY:48,
			speed:0,
			live:true,
			update:function(){
				if(this.live){
					if(collision(player, this)){
						kill();
						this.live = false;
					}
				}else{
					if(this.bgX>0-this.spriteW+this.frameW){
						this.bgX -= this.frameW;
					}else{
						this.selector.remove();
						bombArr.splice(bombArr.indexOf(this), 1);
					}
				}
			},
			draw:function(){
				this.selector.css('background-position', this.bgX + 'px').css('width','').css('height','');
			}
		};
		if(collision(player, obj)){
			newBomb.remove();
			addBomb();
		}else{
			newBomb.css('left',obj.x).css('top',obj.y);
			bombArr.push(obj);
			bombCount++;
			if(bombCount%5 == 0){//every 5 bombs, add an extra one.
				addBomb();
			}
		}
	}
	
	function collision(obj1, obj2){
		var collisionVar = false;
		var obj1Left = obj1.x+obj1.hitX;
		var obj1Right = obj1.x+obj1.hitX+obj1.hitW;
		var obj1Top = obj1.y+obj1.hitY;
		var obj1Bottom = obj1.y+obj1.hitY+obj1.hitH;
		var obj2Left = obj2.x+obj2.hitX;
		var obj2Right = obj2.x+obj2.hitX+obj2.hitW;
		var obj2Top = obj2.y+obj2.hitY;
		var obj2Bottom = obj2.y+obj2.hitY+obj2.hitH;
		if(obj1.dir == 'left'){
			obj1Left -= obj1.speed;
		}else if(obj1.dir == 'up'){
			obj1Top -= obj1.speed;
		}else if(obj1.dir == 'right'){
			obj1Right += obj1.speed;
		}else if(obj1.dir == 'down'){
			obj1Bottom += obj1.speed;
		}
		if(obj1Right>=obj2Left && obj1Left<=obj2Right){
			if(obj1Bottom>=obj2Top && obj1Top<=obj2Bottom){
				collisionVar = true;
			}
		}
		return collisionVar;
	}
	
	function kill(){
		player.live = false;
		player.running = false;
		player.bgX = 0;
		player.bgY = 0-player.frameH*4;
		player.selector.css('background-position', player.bgX + 'px ' + player.bgY + 'px');
	}
	
	function runStart(dir){
		if(player.live){
			if(keyArr[keyArr.length-1] != dir){
				keyArr.push(dir);
			}
			if(dir == 'left'){
				player.dir = 'left';
				player.bgY = 0-player.frameH;
				player.running = true;
			}else if(dir == 'up'){
				player.dir = 'up';
				player.bgY = 0-player.frameH*3;
				player.running = true;
			}else if(dir == 'right'){
				player.dir = 'right';
				player.bgY = 0;
				player.running = true;
			}else if(dir == 'down'){
				player.dir = 'down';
				player.bgY = 0-player.frameH*2;
				player.running = true;
			}
		}
	}
	
	function runEnd(dir){
		if(player.live){
			keyArr.splice(keyArr.indexOf(dir), 1);
			if(keyArr.length == 0){
				player.running = false;
				player.bgX = 0;
			}else{
				runStart(keyArr[keyArr.length-1]);
			}
		}
	}
	
	function shoot(char){
		if(char.live){
			$('#bullets').append('<div id="bullet'+bulletCount+'" class="bullet abs"/>');
			var newBullet = $('#bullet'+bulletCount);
			var bulletX, bulletY, bulletW, bulletH;
			bulletW = 4;
			bulletH = 4;
			if(char.dir == 'left'){
				bulletX = char.x-bulletW;
				bulletY = char.y+bulletW*5;
			}else if(char.dir == 'right'){
				bulletX = char.x+char.frameW;
				bulletY = char.y+bulletW*5;
			}else if(char.dir == 'up'){
				bulletX = char.x+bulletW*7;
				bulletY = char.y;
			}else if(char.dir == 'down'){
				bulletX = char.x+bulletW*3;
				bulletY = char.y+bulletW*9;
			}  
			obj = {
				selector:newBullet,
				id:bulletCount,
				width:bulletW,
				height:bulletH,
				x:bulletX,
				y:bulletY,
				hitW:bulletW,
				hitH:bulletH,
				hitX:0,
				hitY:0,
				dir:char.dir,
				speed:16,
				live:true,
				update:function(){
					if(this.dir == 'left'){
						if(this.x>0){
							this.x -= this.speed;
						}else{
							this.live = false;
						}
					}else if(this.dir == 'up'){
						if(this.y>0){
							this.y -= this.speed;
						}else{
							this.live = false;
						}
					}else if(this.dir == 'right'){
						if(this.x+this.width<stageW){
							this.x += this.speed;
							this.selector.css('left',this.x);
						}else{
							this.live = false;
						}
					}else if(this.dir == 'down'){
						if(this.y+this.height<stageH){
							this.y += this.speed;
							this.selector.css('top',this.y);
						}else{
							this.live = false;
						}
					}
					for(var bombNum=0; bombNum<bombArr.length; bombNum++){
						var nextBomb = bombArr[bombNum];
						if(nextBomb.live){
							if(collision(this, nextBomb)){
								nextBomb.live = false;
								this.live = false;
								addBomb();
							}
						}
					}
					if(!this.live){
						this.selector.remove();
						bulletArr.splice(bulletArr.indexOf(this), 1);
					}
				},
				draw:function(){
					this.selector.css('left',this.x);
					this.selector.css('top',this.y);
				}
			};
			bulletArr.push(obj);
			bulletCount++;
			newBullet.css('left',bulletX).css('top',bulletY).css('width',bulletW).css('height',bulletH);
		}
	}
	
	function touchCollision(x, y, obj){
		var collisionVar = false;
		if(x>obj.offset().left && x<obj.offset().left+obj.width()){
			if(y>obj.offset().top && y<obj.offset().top+obj.height()){
				var collisionVar = true;
			}
		}
		return collisionVar;
	}
});

function output(msg, clear){
	if(clear){
		$('#output').html(msg);
	}else{
		$('#output').html(msg+"\n"+$('#output').html());
	}
}