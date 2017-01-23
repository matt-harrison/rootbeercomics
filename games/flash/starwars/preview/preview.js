$(window).load(function(){
	hexArr = new Array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
	
	//declare player object
	player = {
		selector:$('.player'),
		spriteW:4000,
		bgX:0,
		bgY:0,
		frameW:400,
		frameH:480,
		dir:'right',
		running:false,
		animate:function(){
			if(this.running){
				if(this.bgX - this.frameW > 0-this.spriteW+this.frameW){
					this.bgX -= this.frameW;
				}else{
					this.bgX = 0-this.frameW;
				}
			}
			this.selector.css('background-position', player.bgX + 'px ' + player.bgY + 'px');
		}
	};
	
	setInterval(function(){player.animate();}, 1000/16);
	
	//KEYBOARD CONTROLS
	$('body').keydown(function(event){
		//console.log('event: '+event.which);
		if(event.which == 37){
			player.dir = 'left';
			player.running = true;
			player.bgY = 0-player.frameH;
		}else if(event.which == 38){
			player.dir = 'up';
			player.running = true;
			player.bgY = 0-player.frameH*3;
		}else if(event.which == 39){
			player.dir = 'right';
			player.running = true;
			player.bgY = 0;
		}else if(event.which == 40){
			player.dir = 'down';
			player.running = true;
			player.bgY = 0-player.frameH*2;
		}else if(event.which == 32){
			player.running = false;
			player.bgX = 0-player.spriteW+player.frameW;
		}else if(event.which == 16){
			player.running = false;
			player.bgX = 0;
			player.bgY = 0-player.frameH*4;
		}
	});
	
	$('body').keyup(function(event){
		player.running = false;
		player.bgX = 0;
		if(event.which == 16){
			player.bgY = 0;
		}
	});
	
	$('#animate').click(function(){
		var hex = '#' + getHex() + getHex() + getHex() + getHex() + getHex() + getHex();
		$('.player').css('background-color', hex);
		console.log(hex);
	});
	
	function getHex(){
		var rand = Math.floor(Math.random()*16);
		digit = hexArr[rand];
		return digit;
	}
});