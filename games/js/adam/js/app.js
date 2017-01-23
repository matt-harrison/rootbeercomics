//DOM is partially based on device.
isMobile = (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/).test(navigator.userAgent);
isDebug = window.location.search.indexOf('debug') != -1;
if (isMobile) {
	magnification = 0.5;
} else {
	magnification = 1;
}

//Game Functions
function adaptCoords(obj){
	var offsetX = obj.x / (game.width - obj.width);
	var offsetY = obj.y / (game.height - obj.height);
	obj.x = Math.floor((window.innerWidth - obj.width) * offsetX);
	obj.y = Math.floor((window.innerHeight - obj.height) * offsetY);
	obj.draw();
}

function collision(obj1, obj2){
	var overlap = false;
	var rect1 = obj1.selector.getBoundingClientRect();
	var rect2 = obj2.selector.getBoundingClientRect();
	if(rect1.right > rect2.left && rect1.left < rect2.right){
		if(rect1.bottom > rect2.top && rect1.top < rect2.bottom){
			overlap = true;
		}
	}
	return overlap;
}

function loop() {
	if (!gameOver && !paused) {
		player.update();
		player.draw();

		for (var enemy in enemies) {
			enemies[enemy].update();
			enemies[enemy].draw();
		}

		for (var projectile in projectiles) {
			projectiles[projectile].update();
			projectiles[projectile].draw();
		}

		if (count < enemyInterval) {
			count++;
		} else {
			enemy = new Enemy(henchman);
			count = 0;
		}

		loopInterval = setTimeout(loop, 1000/fps);
	}
}

function pause() {
	clearInterval(loopInterval);
	if (paused) {
		loopInterval = setTimeout(loop, 1000/fps);
	} else {

	}
	paused = !paused;
}

function preload(slot) {
	var image = new Image();
	var src = objects[slot].img;
	image.src = src;
	image.onload = function() {
		if (objects.length - 1 > slot++) {
			preload(slot);
		}
	};
}

function resizeGame(width, height){
	if (!gameOver && !paused) {
		pause();
	}
		
	//Vertically center controls in landscape mode.
	if (width > height) {
		dpadOffset = (height - 183) / 2;
		btnAttackOffset = (height - 90) / 2;
	} else {
		dpadOffset = 10;
		btnAttackOffset = 10;
	}
	
	if (isMobile) {
		dpad.style.bottom = dpadOffset + 'px';
		btnAttack.style.bottom = btnAttackOffset + 'px';
	}

	btnCaptainAmerica.style.top = Math.floor((height - (captainAmericaWithShield.height * magnification)) / 2) + 'px';
	btnIronMan.style.top = Math.floor((height - (ironMan.height * magnification)) / 2) + 'px';
	btnHawkeye.style.top = Math.floor((height - (hawkeyeWithArrow.height * magnification)) / 2) + 'px';

	adaptCoords(player);

	for(var enemy in enemies){
		adaptCoords(enemies[enemy]);
	}

	for(var projectile in projectiles){
		adaptCoords(projectiles[projectile]);
	}
	
	game.width = width;
	game.height = height;
	game.selector.style.width = game.width + 'px';
	game.selector.style.height = game.height + 'px';
}

//Utility Functions
function getRandom(max) {
	return Math.floor(Math.random() * max);
}

function importJSON(obj, data) {
	for (var prop in data) {
		if (data.hasOwnProperty(prop)) {
			obj[prop] = data[prop];
		}
	}
}

//Objects
Game = function() {
	this.width = window.innerWidth;
	this.height = window.innerHeight;

	//Attach to document
	this.selector = document.createElement('div');
	this.selector.id = 'game';
	this.selector.style.position = 'relative';
	this.selector.style.margin = '0';
	this.selector.style.width = this.width + 'px';
	this.selector.style.height = this.height + 'px';
	this.selector.style.overflow = 'hidden';
	this.selector.style.zIndex = '1';
	document.body.appendChild(this.selector);

	this.init = function() {
		player.assign(character);
		
		gameOver = false;
		paused = false;
		enemyCount = 0;
		projectileCount = 0;
		count = 3 * fps;
		enemyInterval = 5 * fps;
		enemyIncrement = fps / 2;
		enemyIntervalMin = fps / 4;

		loop();
	}

	this.reset = function() {
		for (var enemy in enemies) {
			game.selector.removeChild(enemies[enemy].selector);
		}
		enemies.splice(0);

		for (var projectile in projectiles) {
			projectiles[projectile].remove();
			game.selector.removeChild(projectiles[projectile].selector);
		}
		projectiles.splice(0);
	}
};

Menu = function() {
	this.visible = true;
	
	//Attach Menu
	menuContainer = document.createElement('div');
	menuContainer.id = 'menu';
	menuContainer.style.position = 'absolute';
	menuContainer.style.width = '100%';
	menuContainer.style.height = '100%';
	menuContainer.style.backgroundColor = '#fff';
	menuContainer.style.zIndex = '6';
	game.selector.appendChild(menuContainer);

	//Attach Cpatain American button
	btnHawkeye = document.createElement('div');
	btnHawkeye.id = 'btnHawkeye';
	btnHawkeye.style.cursor = 'pointer';
	btnHawkeye.style.position = 'absolute';
	btnHawkeye.style.left = '25%';
	btnHawkeye.style.top = Math.floor((game.height - (hawkeyeWithArrow.height * magnification)) / 2) + 'px';
	btnHawkeye.style.marginLeft = -((hawkeyeWithArrow.width * magnification) / 2) + 'px';
	btnHawkeye.style.width = (hawkeyeWithArrow.width * magnification) + 'px';
	btnHawkeye.style.height = (hawkeyeWithArrow.height * magnification) + 'px';
	btnHawkeye.style.backgroundImage = 'url("' + hawkeyeWithArrow.img + '")';
	btnHawkeye.style.backgroundSize = (hawkeyeWithArrow.width * magnification) + 'px ' + (hawkeyeWithArrow.height * magnification) + 'px';
	menuContainer.appendChild(btnHawkeye);

	btnHawkeye.addEventListener('click', function(event){
		character = hawkeye;
		menu.hide();
	});

	//Attach Cpatain American button
	btnCaptainAmerica = document.createElement('div');
	btnCaptainAmerica.id = 'btnCaptainAmerica';
	btnCaptainAmerica.style.cursor = 'pointer';
	btnCaptainAmerica.style.position = 'absolute';
	btnCaptainAmerica.style.left = '50%';
	btnCaptainAmerica.style.top = Math.floor((game.height - (captainAmericaWithShield.height * magnification)) / 2) + 'px';
	btnCaptainAmerica.style.marginLeft = -((captainAmericaWithShield.width * magnification) / 2) + 'px';
	btnCaptainAmerica.style.width = (captainAmericaWithShield.width * magnification) + 'px';
	btnCaptainAmerica.style.height = (captainAmericaWithShield.height * magnification) + 'px';
	btnCaptainAmerica.style.backgroundImage = 'url("' + captainAmericaWithShield.img + '")';
	btnCaptainAmerica.style.backgroundSize = (captainAmericaWithShield.width * magnification) + 'px ' + (captainAmericaWithShield.height * magnification) + 'px';
	menuContainer.appendChild(btnCaptainAmerica);

	btnCaptainAmerica.addEventListener('click', function(event){
		character = captainAmerica;
		menu.hide();
	});

	//Attach Cpatain American button
	btnIronMan = document.createElement('div');
	btnIronMan.id = 'btnIronMan';
	btnIronMan.style.cursor = 'pointer';
	btnIronMan.style.position = 'absolute';
	btnIronMan.style.left = '75%';
	btnIronMan.style.top = Math.floor((game.height - (ironMan.height * magnification)) / 2) + 'px';
	btnIronMan.style.marginLeft = -((ironMan.width * magnification) / 2) +'px';
	btnIronMan.style.width = (ironMan.width * magnification) + 'px';
	btnIronMan.style.height = (ironMan.height * magnification) + 'px';
	btnIronMan.style.backgroundImage = 'url("' + ironMan.img + '")';
	btnIronMan.style.backgroundSize = (ironMan.width * magnification) + 'px ' + (ironMan.height * magnification) + 'px';
	menuContainer.appendChild(btnIronMan);

	btnIronMan.addEventListener('click', function(event){
		character = ironMan;
		menu.hide();
	});

	this.init = function() {
		this.visible = true;
		menuContainer.style.display = 'block';
		game.reset();
	}

	this.hide = function() {
		this.visible = false;
		menuContainer.style.display = 'none';
		game.init();
	}

	if (isMobile) {
		//Disable swipe to bounce.
		document.ontouchmove = function(event) {
			event.preventDefault();
			window.scrollTo(0, 0);
		}
		
		//Vertically center controls in landscape mode.
		if (game.width > game.height) {
			dpadOffset = (game.height - 183) / 2;
			btnAttackOffset = (game.height - 90) / 2;
		} else {
			dpadOffset = 10;
			btnAttackOffset = 10;
		}
		
		//Attach D-pad
		dpad = document.createElement('div');
		dpad.id = 'dpad';
		dpad.style.position = 'absolute';
		dpad.style.left = '10px';
		dpad.style.bottom = dpadOffset + 'px';
		dpad.style.width = '183px';
		dpad.style.height = '183px';
		dpad.style.zIndex = '5';
		game.selector.appendChild(dpad);

		//Attach D-pad buttons
		btnUp = document.createElement('div');
		btnUp.id = 'btnUp';
		btnUp.style.position = 'absolute';
		btnUp.style.left = ((61 - 38) / 2) + 'px';
		btnUp.style.top = '0';
		btnUp.style.width = '61px';
		btnUp.style.height = '38px';
		btnUp.style.backgroundImage = 'url("img/buttons/btnRight.png")';
		btnUp.style.backgroundSize = '61px 38px';
		btnUp.style.transformOrigin = btnUp.style.msTransformOrigin = btnUp.style.webkitTransformOrigin = '100% 0%';
		btnUp.style.transform = btnUp.style.msTransform = btnUp.style.webkitTransform = 'rotate(270deg)';

		btnRight = document.createElement('div');
		btnRight.id = 'btnRight';
		btnRight.style.position = 'absolute';
		btnRight.style.right = '0';
		btnRight.style.top = (61 + (38 / 2)) + 'px';
		btnRight.style.width = '61px';
		btnRight.style.height = '38px';
		btnRight.style.backgroundImage = 'url("img/buttons/btnRight.png")';
		btnRight.style.backgroundSize = '61px 38px';
		dpad.appendChild(btnRight);

		btnDown = document.createElement('div');
		btnDown.id = 'btnDown';
		btnDown.style.position = 'absolute';
		btnDown.style.left = ((61 - 38) / 2) + 'px';
		btnDown.style.bottom = '0';
		btnDown.style.width = '61px';
		btnDown.style.height = '38px';
		btnDown.style.backgroundImage = 'url("img/buttons/btnRight.png")';
		btnDown.style.backgroundSize = '61px 38px';
		btnDown.style.transformOrigin = btnDown.style.msTransformOrigin = btnDown.style.webkitTransformOrigin = '100% 100%';
		btnDown.style.transform = btnDown.style.msTransform = btnDown.style.webkitTransform = 'rotate(90deg)';
		dpad.appendChild(btnDown);
		dpad.appendChild(btnUp);

		btnLeft = document.createElement('div');
		btnLeft.id = 'btnLeft';
		btnLeft.style.position = 'absolute';
		btnLeft.style.left = '61px';
		btnLeft.style.top = (61 + (38 / 2)) + 'px';
		btnLeft.style.width = '61px';
		btnLeft.style.height = '38px';
		btnLeft.style.backgroundImage = 'url("img/buttons/btnRight.png")';
		btnLeft.style.backgroundSize = '61px 38px';
		btnLeft.style.transformOrigin = btnLeft.style.msTransformOrigin = btnLeft.style.webkitTransformOrigin = '0% 50%';
		btnLeft.style.transform = btnLeft.style.msTransform = btnLeft.style.webkitTransform = 'rotate(180deg)';
		dpad.appendChild(btnLeft);

		//Attach D-pad listeners
		btnUp.addEventListener('touchstart', function(event){
			player.dir = 'up';
			player.walking = true;
		});
		btnUp.addEventListener('touchend', function(event){
			if (player.dir == 'up') {
				player.walking = false;
			}
		});

		btnRight.addEventListener('touchstart', function(event){
			if (!gameOver && !paused ) {
				player.dir = 'right';
				player.walking = true;
				player.flip('right');
			}
		});
		btnRight.addEventListener('touchend', function(event){
			if (player.dir == 'right') {
				player.walking = false;
			}
		});

		btnDown.addEventListener('touchstart', function(event){
			player.dir = 'down';
			player.walking = true;
		});
		btnDown.addEventListener('touchend', function(event){
			if (player.dir == 'down') {
				player.walking = false;
			}
		});

		btnLeft.addEventListener('touchstart', function(event){
			if (!gameOver && !paused ) {
				player.dir = 'left';
				player.walking = true;
				player.flip('left');
			}
		});
		btnLeft.addEventListener('touchend', function(event){
			if (player.dir == 'left') {
				player.walking = false;
			}
		});

		//Attach Attack button and listener
		btnAttack = document.createElement('div');
		btnAttack.id = 'btnAttack';
		btnAttack.style.position = 'absolute';
		btnAttack.style.right = '10px';
		btnAttack.style.bottom = btnAttackOffset + 'px';
		btnAttack.style.width = '86px';
		btnAttack.style.height = '90px';
		btnAttack.style.backgroundImage = 'url("img/buttons/btnCircle.png")';
		btnAttack.style.backgroundSize = '89px 90px';
		btnAttack.style.zIndex = '5';
		game.selector.appendChild(btnAttack);

		btnAttack.addEventListener('touchend', function(event){
			if (gameOver) {
				menu.init();
			} else if (paused) {
				pause();
			} else {
				player.attack();
			}
		});
	} else {
		//Key listeners
		window.addEventListener('keydown', function(event) {
			if (!gameOver && !paused ) {
				switch (event.keyCode) {
					case 37: //left
						player.dir = 'left';
						player.walking = true;
						player.flip(player.dir);
						break;
					case 38: //up
						player.dir = 'up';
						player.walking = true;
						break;
					case 39: //right
						player.dir = 'right';
						player.walking = true;
						player.flip(player.dir);
						break;
					case 40: //down
						player.dir = 'down';
						player.walking = true;
						break;
					case 32: //space
						player.attack();
						break;
				}
			}
		});

		window.addEventListener('keyup', function(event) {
			switch (event.keyCode) {
				case 37: //left
					if (player.dir == 'left') {
						player.walking = false;
					}
					break;
				case 38: //up
					if (player.dir == 'up') {
						player.walking = false;
					}
					break;
				case 39: //right
					if (player.dir == 'right') {
						player.walking = false;
					}
					break;
				case 40: //down
					if (player.dir == 'down') {
						player.walking = false;
					}
					break;
				case 32: //space
					if (player.weapon == fist) {
						if (typeof(punch == 'object')) {
							punch.remove();
						}
					}
					break;
				case 13: //enter
					if (gameOver) {
						if (menu.visible) {
							menu.hide();
						} else {
							menu.init();
						}
					} else {
						pause();
					}
					input.splice(0);
					
					break;
				case 27: //escape
					gameOver = true;
					game.reset();
					menu.init();
					break;
				default:
					if (paused) {
						input.push(String.fromCharCode(event.keyCode).toLowerCase());
						var cheat = input.join('');
						
						var hiddenCharacter = '';
						if (cheat.indexOf('cap') != -1) {
							hiddenCharacter = captainAmerica;
						} else if (cheat.indexOf('iron') != -1) {
							hiddenCharacter = ironMan;
						} else if (cheat.indexOf('hawk') != -1) {
							hiddenCharacter = hawkeye2;
						} else if (cheat.indexOf('hulk') != -1) {
							hiddenCharacter = hulk;
						} else if (cheat.indexOf('thor') != -1) {
							hiddenCharacter = thor;
						} else if (cheat.indexOf('widow') != -1) {
							hiddenCharacter = blackWidow;
						}
						
						if (hiddenCharacter != '') {
							character = hiddenCharacter;
							player.assign(character);
							input.splice(0);
						}
						
						var weapon = '';
						if (cheat.indexOf('arrow') != -1 || cheat.indexOf('bow') != -1) {
							weapon = arrow;
							weaponLimit = hawkeye.weaponLimit;
						} else if (cheat.indexOf('bullet') != -1 || cheat.indexOf('gun') != -1) {
							weapon = bullet;
							weaponLimit = blackWidow.weaponLimit;
						} else if (cheat.indexOf('fist') != -1) {
							weapon = fist;
							weaponLimit = hulk.weaponLimit;
						} else if (cheat.indexOf('hammer') != -1) {
							weapon = hammer;
							weaponLimit = thor.weaponLimit;
						} else if (cheat.indexOf('repulsor') != -1) {
							weapon = repulsor;
							weaponLimit = ironMan.weaponLimit;
						} else if (cheat.indexOf('shield') != -1) {
							weapon = shield;
							weaponLimit = captainAmerica.weaponLimit;
						}
						
						if (weapon != '') {
							player.weapon = weapon;
							player.weaponLimit = weaponLimit;
							input.splice(0);
						}
						
						if (cheat.indexOf('assemble') != -1) {
							player.invincible = !player.invincible;
						}
						
						if (cheat.indexOf('ammo') != -1) {
							player.weaponLimit = 100;
						}
					}
					break;
			}
		});
	}

	//Attach window resize listener
	window.addEventListener('resize', function(){
		if(!gameOver && !paused){
			pause();
		}
		resizeGame(window.innerWidth, window.innerHeight);
	});
}

Player = function(obj) {
	importJSON(this, obj);
	
	this.x = Math.floor((game.width - this.width) / 2);
	this.y = Math.floor((game.height - this.height) / 2);

	//Create DOM node
	this.selector = document.createElement('div');
	this.selector.id = 'player';
	this.selector.style.position = 'absolute';
	this.selector.style.zIndex = '3';

	//Attach to DOM
	game.selector.appendChild(this.selector);

	this.assign = function(obj) {
		importJSON(this, obj);

		this.width *= magnification;
		this.height *= magnification;
		this.speed *= magnification;
		this.invincible = false;

		if (gameOver) {
			this.x = Math.floor((game.width - this.width) / 2);
			this.y = Math.floor((game.height - this.height) / 2);
		}
		
		this.dir = 'right';
		this.walking = false;
		this.active = true;

		this.selector.style.width = this.width + 'px';
		this.selector.style.height = this.height + 'px';
		this.selector.style.backgroundImage = 'url("' + this.img + '")';
		this.selector.style.backgroundSize = this.width + 'px ' + this.height + 'px';
		this.selector.style.opacity = '1';

		this.flip('right');
		this.draw();
	}

	this.flip = function(dir) {
		if (dir == 'left') {
			this.selector.style.transform = 'scale(-1, 1)';
			this.selector.style.msTransform = 'scale(-1, 1)';
			this.selector.style.webkitTransform = 'scale(-1, 1)';
		} else {
			this.selector.style.transform = 'scale(1, 1)';
			this.selector.style.msTransform = 'scale(1, 1)';
			this.selector.style.webkitTransform = 'scale(1, 1)';
		}
	}
	
	this.attack = function() {
		if (projectiles.length < this.weaponLimit) {
			if (this.weapon == fist) {
				punch = new Fist(this);
			} else {
				projectile = new Projectile(this);
			}
			
		}
	}
	
	this.kill = function() {
		gameOver = true;
		clearInterval(loopInterval);
		this.selector.style.opacity = '0.25';
	}
	
	this.update = function() {
		if (this.walking) {
			if (this.dir == 'left') {
				if (this.x - this.speed >= 0) {
					this.x -= this.speed;
				} else {
					this.x = 0;
				}
			} else if (this.dir == 'right') {
				if (this.x + this.width + this.speed <= game.width) {
					this.x += this.speed;
				} else {
					this.x = game.width - this.width;
				}
			} else if (this.dir == 'up') {
				if (this.y - this.speed >= 0) {
					this.y -= this.speed;
				} else {
					this.y = 0;
				}
			} else if (this.dir == 'down') {
				if (this.y + this.height + this.speed <= game.height) {
					this.y += this.speed;
				} else {
					this.y = game.height - this.height;
				}
			}
		}
	}
	
	this.draw = function() {
		if (this.active) {
			this.selector.style.left = this.x + 'px';
			this.selector.style.top = this.y + 'px';
		}
	};
	
	this.assign(obj);
};

Enemy = function(obj) {
	importJSON(this, obj);
	this.dir = cardinals[getRandom(4)];
	this.active = true;
	this.inFrame = true;

	this.width *= magnification;
	this.height *= magnification;
	this.speed *= magnification;
	
	//Create DOM node
	this.selector = document.createElement('div');
	this.selector.id = 'enemy' + enemyCount++;
	this.selector.style.position = 'absolute';
	this.selector.style.width = this.width + 'px';
	this.selector.style.height = this.height + 'px';
	this.selector.style.backgroundImage = 'url("' + this.img + '")';
	this.selector.style.backgroundSize = this.width + 'px ' + this.height + 'px';
	this.selector.style.zIndex = '2';

	//Init behavior
	if (this.dir == 'left') {
		this.selector.style.transform = 'scale(-1, 1)';
		this.selector.style.msTransform = 'scale(-1, 1)';
		this.selector.style.webkitTransform = 'scale(-1, 1)';

		this.x = game.width;
		this.y = getRandom(game.height - this.height);
	} else if (this.dir == 'right') {
		this.x = 0 - this.width;
		this.y = getRandom(game.height - this.height);
	} else if (this.dir == 'up') {
		this.x = getRandom(game.width - this.width);
		this.y = game.height;
	} else if (this.dir == 'down') {
		this.x = getRandom(game.width - this.width);
		this.y = 0 - this.height;
	}

	//Attach to DOM
	game.selector.appendChild(this.selector);

	this.remove = function() {
		var pos = enemies.indexOf(this);
		if (pos != -1) {
			enemies.splice(pos, 1);
			game.selector.removeChild(this.selector);
		}
	}

	this.kill = function() {
		this.active = false;
		this.selector.style.opacity = '0.25';
		if (enemyInterval - enemyIncrement >= enemyIntervalMin) {
			enemyInterval -= enemyIncrement;
		} else {
			enemyInterval = enemyIntervalMin;
		}
	}

	this.update = function() {
		if (this.active) {
			if (this.dir == 'left') {
				if (this.x - this.speed >= 0 - this.width) {
					this.x -= this.speed;
				} else {
					this.inFrame = false;
				}
			} else if (this.dir == 'right') {
				if (this.x + this.speed <= game.width) {
					this.x += this.speed;
				} else {
					this.inFrame = false;
				}
			} else if (this.dir == 'up') {
				if (this.y - this.speed >= 0 - this.height) {
					this.y -= this.speed;
				} else {
					this.inFrame = false;
				}
			} else if (this.dir == 'down') {
				if (this.y + this.speed <= game.height) {
					this.y += this.speed;
				} else {
					this.inFrame = false;
				}
			}

			if (collision(this, player) && !player.invincible) {
				player.kill();
			}

			for (var projectile in projectiles) {
				if (collision(projectiles[projectile], this)) {
					projectiles[projectile].active = false;
					this.kill();
				}
			}
		}
	}

	this.draw = function() {
		if (this.active) {
			if (!this.inFrame) {
				this.remove();
			} else {
				this.selector.style.left = this.x + 'px';
				this.selector.style.top = this.y + 'px';
			}
		}
	}

	this.draw();
	enemies.push(this);
};

Fist = function(origin) {
	importJSON(this, origin.weapon);
	this.dir = origin.dir;
	this.count = projectileCount++;
	this.origin = origin;
	this.active = true;

	this.width *= magnification;
	this.height *= magnification;
	this.speed *= magnification;

	//Create DOM node
	this.selector = document.createElement('div');
	this.selector.id = 'projectile' + this.count;
	this.selector.style.position = 'absolute';
	this.selector.style.width = this.width + 'px';
	this.selector.style.height = this.height + 'px';
	this.selector.style.left = this.x + 'px';
	this.selector.style.top = this.y + 'px';
	this.selector.style.backgroundImage = 'url("' + this.img + '")';
	this.selector.style.backgroundSize = this.width + 'px ' + this.height + 'px';
	this.selector.style.backgroundRepeat = 'no-repeat';
	this.selector.style.zIndex = '4';

	//Init behavior
	if (this.dir == 'left') {
		if (this.origin.weapon != shield) {
			this.selector.style.transform = 'scale(-1, 1)';
			this.selector.style.msTransform = 'scale(-1, 1)';
			this.selector.style.webkitTransform = 'scale(-1, 1)';
		}

		this.x = this.origin.x - this.width;
		this.y = this.origin.y + (this.origin.height - this.height) / 2;
	} else if (this.dir == 'right') {
		this.x = this.origin.x + this.origin.width;
		this.y = this.origin.y + (this.origin.height - this.height) / 2;
	} else if (this.dir == 'up') {
		this.selector.style.transform = 'rotate(-90deg)';
		this.selector.style.msTransform = 'rotate(-90deg)';
		this.selector.style.webkitTransform = 'rotate(-90deg)';

		this.x = this.origin.x + (this.origin.width - this.width) / 2;
		this.y = this.origin.y - this.height;
	} else if (this.dir == 'down') {
		this.selector.style.transform = 'rotate(90deg)';
		this.selector.style.msTransform = 'rotate(90deg)';
		this.selector.style.webkitTransform = 'rotate(90deg)';

		this.x = this.origin.x + (this.origin.width - this.width) / 2;
		this.y = this.origin.y + this.origin.height;
	}

	//Attach to DOM
	game.selector.appendChild(this.selector);

	this.remove = function() {
		var pos = projectiles.indexOf(this);
		if (pos != -1) {
			projectiles.splice(pos, 1);
			game.selector.removeChild(this.selector);
		}
	}

	this.update = function() {
		if (this.dir == 'left') {
			this.x = this.origin.x - this.width - this.reach;
			this.y = this.origin.y + (this.origin.height - this.height) / 2;
		} else if (this.dir == 'right') {
			this.x = this.origin.x + this.origin.width + this.reach;
			this.y = this.origin.y + (this.origin.height - this.height) / 2;
		} else if (this.dir == 'up') {
			this.x = this.origin.x + (this.origin.width - this.width) / 2;
			this.y = this.origin.y - this.height - this.reach;
		} else if (this.dir == 'down') {
			this.x = this.origin.x + (this.origin.width - this.width) / 2;
			this.y = this.origin.y + this.origin.height + this.reach;
		}
	}

	this.draw = function() {
		if (!this.active) {
			this.remove();
		} else {
			this.selector.style.left = this.x + 'px';
			this.selector.style.top = this.y + 'px';
		}
	}

	this.draw();
	projectiles.push(this);
}

Projectile = function(origin) {
	importJSON(this, origin.weapon);
	this.dir = origin.dir;
	this.count = projectileCount++;
	this.origin = origin;
	this.active = true;

	this.width *= magnification;
	this.height *= magnification;
	this.speed *= magnification;

	//Create DOM node
	this.selector = document.createElement('div');
	this.selector.id = 'projectile' + this.count;
	this.selector.style.position = 'absolute';
	this.selector.style.width = this.width + 'px';
	this.selector.style.height = this.height + 'px';
	this.selector.style.left = this.x + 'px';
	this.selector.style.top = this.y + 'px';
	this.selector.style.backgroundImage = 'url("' + this.img + '")';
	this.selector.style.backgroundSize = this.width + 'px ' + this.height + 'px';
	this.selector.style.backgroundRepeat = 'no-repeat';
	this.selector.style.zIndex = '4';

	//Init behavior
	if (this.dir == 'left') {
		if (this.origin.weapon != shield) {
			this.selector.style.transform = 'scale(-1, 1)';
			this.selector.style.msTransform = 'scale(-1, 1)';
			this.selector.style.webkitTransform = 'scale(-1, 1)';
		}

		this.x = this.origin.x - this.width;
		this.y = this.origin.y + (this.origin.height - this.height) / 2;
	} else if (this.dir == 'right') {
		this.x = this.origin.x + this.origin.width;
		this.y = this.origin.y + (this.origin.height - this.height) / 2;
	} else if (this.dir == 'up') {
		this.selector.style.transform = 'rotate(-90deg)';
		this.selector.style.msTransform = 'rotate(-90deg)';
		this.selector.style.webkitTransform = 'rotate(-90deg)';

		this.x = this.origin.x + (this.origin.width - this.width) / 2;
		this.y = this.origin.y - this.height;
	} else if (this.dir == 'down') {
		this.selector.style.transform = 'rotate(90deg)';
		this.selector.style.msTransform = 'rotate(90deg)';
		this.selector.style.webkitTransform = 'rotate(90deg)';

		this.x = this.origin.x + (this.origin.width - this.width) / 2;
		this.y = this.origin.y + this.origin.height;
	}

	//Attach to DOM
	game.selector.appendChild(this.selector);

	this.remove = function() {
		var pos = projectiles.indexOf(this);
		if (pos != -1) {
			projectiles.splice(pos, 1);
			game.selector.removeChild(this.selector);
		}
	}

	this.update = function() {
		if (this.dir == 'left') {
			if (this.x - this.speed >= 0 - this.width) {
				this.x -= this.speed;
			} else {
				this.active = false;
			}
		} else if (this.dir == 'right') {
			if (this.x + this.speed <= game.width) {
				this.x += this.speed;
			} else {
				this.active = false;
			}
		} else if (this.dir == 'up') {
			if (this.y - this.speed >= 0 - this.height) {
				this.y -= this.speed;
			} else {
				this.active = false;
			}
		} else if (this.dir == 'down') {
			if (this.y + this.speed <= game.height) {
				this.y += this.speed;
			} else {
				this.active = false;
			}
		}
	}

	this.draw = function() {
		if (!this.active) {
			this.remove();
		} else {
			this.selector.style.left = this.x + 'px';
			this.selector.style.top = this.y + 'px';
		}
	}

	this.draw();
	projectiles.push(this);
}

//Projectiles
var arrow = {
	'img': 'img/projectiles/arrow.png',
	'width': 97,
	'height': 41,
	'speed': 50
};

var bullet = {
	'img': 'img/projectiles/bullet.png',
	'width': 4,
	'height': 3,
	'speed': 50
};

var fist = {
	'img': 'img/projectiles/fist.png',
	'width': 42,
	'height': 38,
	'speed': 25,
	'reach': 50
};

var hammer = {
	'img': 'img/projectiles/hammer.png',
	'width': 105,
	'height': 52,
	'speed': 50
};

var repulsor = {
	'img': 'img/projectiles/repulsor.png',
	'width': 84,
	'height': 7,
	'speed': 75
};

var shield = {
	'img': 'img/projectiles/shield.png',
	'width': 86,
	'height': 90,
	'speed': 50
};

//Characters
var blackWidow = {
	'img': 'img/characters/black-widow.png',
	'weapon': bullet,
	'weaponLimit': 10,
	'width': 91,
	'height': 131,
	'speed': 25
};

var captainAmerica = {
	'img': 'img/characters/captain-america.png',
	'weapon': shield,
	'weaponLimit': 1,
	'width': 89,
	'height': 131,
	'speed': 25
};

var captainAmericaWithShield = {
	'img': 'img/buttons/captain-america-with-shield.png',
	'weapon': shield,
	'weaponLimit': 1,
	'width': 86,
	'height': 140,
	'speed': 25
};

var ironMan = {
	'img': 'img/characters/iron-man.png',
	'weapon': repulsor,
	'weaponLimit': 5,
	'width': 87,
	'height': 187,
	'speed': 25
};

var hawkeye = {
	'img': 'img/characters/hawkeye.png',
	'weapon': arrow,
	'weaponLimit': 3,
	'width': 86,
	'height': 153,
	'speed': 25
};

var hawkeye2 = {
	'img': 'img/characters/hawkeye2.png',
	'weapon': arrow,
	'weaponLimit': 3,
	'width': 86,
	'height': 153,
	'speed': 25
};

var hawkeyeWithArrow = {
	'img': 'img/buttons/hawkeye-with-arrow.png',
	'weapon': arrow,
	'weaponLimit': 3,
	'width': 122,
	'height': 153,
	'speed': 25
};

var hulk = {
	'img': 'img/characters/hulk.png',
	'weapon': fist,
	'weaponLimit': 1,
	'width': 96,
	'height': 150,
	'speed': 25
};

var henchman = {
	'img': 'img/characters/enemy.png',
	'weapon': null,
	'width': 61,
	'height': 129,
	'speed': 10
};

var thor = {
	'img': 'img/characters/thor.png',
	'weapon': hammer,
	'weaponLimit': 1,
	'width': 78,
	'height': 149,
	'speed': 25
};

//Game vars
fps = 16;//In milliseconds
gameOver = true;
paused = false;
character = captainAmerica;

objects = Array(
	arrow,
	captainAmerica,
	captainAmericaWithShield,
	hawkeye,
	hawkeye2,
	hawkeyeWithArrow,
	hulk,
	henchman,
	ironMan,
	repulsor,
	shield,
	thor
);
cardinals = Array('up', 'right', 'down', 'left');
keys = Array();
enemies = Array();
projectiles = Array();
input = Array();

//Initialization
game = new Game();
menu = new Menu();
player = new Player(hawkeye);
preload(0);
