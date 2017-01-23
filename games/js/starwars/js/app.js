/*
TO DO: 
	- enemies sometimes shoot
	- players with no attacks?
	- post-game cutscenes (hallway, medals)
	- sliding touch?
	- preload images
	- password menu
	- 

GLITCHES:
	- blinking enemies disappear on player death
	- 
*/

//Initialize global vars
isMobile = (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/).test(navigator.userAgent);
isDebug = window.location.search.indexOf('debug') != -1;

fps = 16;//In milliseconds
hudOpacity = '0.5';
hudStatus = '';
cutsceneCount = 0;
victimCount = 0;
victimDelay = 16;
if(isMobile){
	gameWidth = window.innerWidth;
	gameHeight = window.innerHeight;
	magnification = Math.floor(window.innerWidth/100);
	titleSize = '25px';
	directionSize = '14px';
	lineHeight = '1';
	clickPrompt = 'Tap to begin.';
	startPrompt = 'Press Start';
} else {
	gameWidth = 500;
	gameHeight = 500;
	magnification = 5;
	titleSize = '40px';
	directionSize = '25px';
	lineHeight = '1.5';
	clickPrompt = 'Press Enter';
	startPrompt = 'Press Enter';
}

cardinals = ['right', 'left', 'down', 'up'];
buttonNames = ['btnRight', 'btnLeft', 'btnDown', 'btnUp', 'btnStart', 'btnAttack', 'btnAttack2'];
numerals = ['I', 'II', 'III', 'IV', 'V', 'VI'];

animations = Array();
enemies = Array();
friendlies = Array();
keys = Array();
obstacles = Array();
props = Array();

//Hex values
red = '#f00';
green = '#0f0';
blue = '#0ff';
darkBlue = '#003471';
yellow = '#ff0';
purple = '#f0f';
gray = '#ccc';

Game = function(){
	this.width = gameWidth;
	this.height = gameHeight;

	//Attach to document
	this.selector = document.createElement('div');
	this.selector.id = 'game';
	this.selector.style.position = 'relative';
	this.selector.style.margin = isMobile ? '0' : '10px auto 0';
	this.selector.style.width = this.width + 'px';
	this.selector.style.height = this.height + 'px';
	this.selector.style.overflow = 'hidden';
	this.selector.style.zIndex = '1';
	document.body.appendChild(this.selector);

	this.counter = 0;
};

Hud = function(){
	this.selector = document.createElement('div');
	this.selector.id = 'hud';
	this.selector.style.position = 'absolute';
	this.selector.style.width = '100%';
	this.selector.style.height = '100%';
	this.selector.style.zIndex = '99';
	game.selector.appendChild(this.selector);
};

CutScene = function(img){
	this.selector = document.createElement('div');
	this.selector.id = 'stage';
	this.selector.style.position = 'absolute';
	this.selector.style.top = 0;
	this.selector.style.left = 0;
	this.width = game.width;
	this.height = game.height;
	this.selector.style.width = this.width + 'px';
	this.selector.style.height = this.height + 'px';
	this.selector.style.backgroundColor = 'black';
	this.selector.style.zIndex = '101';
	this.selector.setAttribute('data-key', 'enter');
	game.selector.insertBefore(this.selector, game.selector.firstChild);
	
	cutscene = document.createElement('div');
	cutscene.style.backgroundImage = "url('img/cutscenes/" + img + ".png')";
	if(game.width <= game.height){
		cutscene.width = game.width;
		cutscene.height = game.width;
	} else {
		cutscene.width = game.height;
		cutscene.height = game.height;
	}
	cutscene.style.width = cutscene.width + 'px';
	cutscene.style.height = cutscene.height + 'px';
	cutscene.style.position = 'absolute';
	cutscene.style.top = (this.height - cutscene.height) / 2 + 'px';
	cutscene.style.left = (this.width - cutscene.width) / 2 + 'px';
	cutscene.style.backgroundSize = cutscene.width + 'px ' + cutscene.height + 'px';
	cutscene.style.zIndex = '100';
	cutscene.setAttribute('data-key', 'enter');
	this.selector.appendChild(cutscene);
	
	this.resize = function(){
		this.width = game.width;
		this.height = game.height;
		this.selector.style.width = this.width + 'px';
		this.selector.style.height = this.height + 'px';
		
		cutscene.style.top = (this.height - cutscene.height) / 2 + 'px';
		cutscene.style.left = (this.width - cutscene.width) / 2 + 'px';
		cutscene.style.backgroundSize = cutscene.width + 'px ' + cutscene.height + 'px';
	}
};

Stage = function(obj){
	importJSON(this, obj);
	
	//Attach to document
	this.selector = document.createElement('div');
	this.selector.id = 'stage';
	this.selector.style.position = 'absolute';
	this.selector.style.top = 0;
	this.selector.style.left = 0;
	this.selector.style.width = '100%';
	this.selector.style.height = '100%';
	if(this.bg != null){
		this.selector.style.backgroundImage = "url('img/backgrounds/" + this.bg + ".png')";
	} else {
		this.selector.style.backgroundColor = this.bgColor;
	}
	this.selector.style.zIndex = '1';
	game.selector.insertBefore(this.selector, game.selector.firstChild);
	
	title.style.color = this.textColor;
	directions.style.color = this.textColor;
	scoreboard.style.color = this.textColor;
	
	this.enemiesKilled = 0;
	this.bossReached = false;
	this.defeated = false;
};

Player = function(obj){
	importJSON(this, obj);
	
	this.speed = this.speed * (magnification / 5);
	
	this.x = Math.floor((game.width - this.frameWidth) / 2);
	this.y = Math.floor((game.height - this.frameHeight) / 2);
	this.dir = 'down';
	this.spriteColumn = 0;
	this.spriteRow = 2;
	this.running = false;
	this.attacking = false;
	this.active = true;
	this.dead = false;
	this.lightsaber = '';
	
	if(this.weaponType == 'projectile'){
		if(this.projectile == 'laser'){
			this.weaponDelay = fps / 4;
		} else if(typeof(this.weaponDelay) == 'undefined'){
			this.weaponDelay = fps / 2;
		}
	} else if(this.weaponType == 'bomb'){
		this.weaponDelay = 8;
	} else if(this.weaponType == 'lightsaber'){
		this.weaponDelay = 2;
	}
	this.weaponReady = true;
	this.weaponCount = 0;
	
	//Attach sprite
	this.selector = document.createElement('div');
	this.selector.id = 'player';
	this.selector.style.position = 'absolute';
	this.selector.style.width = this.frameWidth + 'px';
	this.selector.style.height = this.frameHeight + 'px';
	this.selector.style.backgroundImage = "url('img/characters/" + this.sprite + ".png')";
	this.selector.style.backgroundSize = this.width + 'px ' + this.height + 'px';
	this.selector.style.backgroundRepeat = 'no-repeat';
	this.selector.style.zIndex = '3';
	stage.selector.appendChild(this.selector);
	
	//Preload death animation for smooth transition
	if(typeof(this.death) != 'undefined'){
		preload('img/animations/' + this.death.name + '.png');
	}
	
	this.attack = function(key){
		if(this.weaponReady){
			if(this.weaponType == 'projectile'){
				projectile = new Projectile(this);
				
				//Sometimes the enemy will try to dodge
				for(var enemy in enemies){
					if(enemies[enemy].sprite != 'asteroid'){
						//Dodges will get more likely as game progresses
						if(getRandom(20 - level) == 0){
							enemies[enemy].changeDir();
						}
					}
				}
			} else if(this.weaponType == 'bomb'){
				bomb = new Bomb(this);
			} else if(this.weaponType == 'lightsaber'){
				isLongRange = (key == 'Z');
				this.lightsaber = new Lightsaber(this, isLongRange);
				keys = [key];
				
				this.running = false;
				this.attacking = true;
				this.spriteColumn = this.moveFrameCount + 1;
			} else if(this.weaponType == 'attack'){
			}
			this.weaponReady = false;
		}
	}
	
	this.kill = function(){
		this.active = false;
		if(typeof(this.death) != 'undefined'){
			this.selector.style.display = 'none';
			death = new Animation(this.death, this);
			if(this.lightsaber != ''){
				this.lightsaber.kill();
			}
		} else {
			this.spriteColumn = 0;
			this.spriteRow = 4;
		}
	}
	
	this.update = function(){
		if(this.dead){
			if(this.active){
				this.kill();
			}
		} else {
			if(!this.weaponReady){
				if(this.weaponCount++ == this.weaponDelay){
					this.weaponReady = true;
					this.weaponCount = 0;
				}
			}
			if(this.running || this.ship){
				if(this.spriteColumn < this.moveFrameCount){
					this.spriteColumn++;
				} else {
					this.spriteColumn = 1;
				}
				var obs = getObstruction(this);
				if(this.dir == 'left'){
					if(this.x - this.speed > 0){
						if(obs == ''){
							this.x -= this.speed;
						} else {
							this.x = obs.x + obs.frameWidth;
						}
					} else if(this.ship){
						this.x = 0;
						this.dir = 'right';
					}
					this.spriteRow = 1;
				} else if(this.dir == 'up'){
					if(this.y - this.speed > 0){
						var obs = getObstruction(this);
						if(obs == ''){
							this.y -= this.speed;
						} else {
							this.y = obs.y + obs.frameHeight - this.frameHeight + magnification;
						}
					} else if(this.ship){
						this.y = 0;
						this.dir = 'down';
					}
					this.spriteRow = 3;
				} else if(this.dir == 'right'){
					if(this.x + this.speed < game.width - this.frameWidth){
						var obs = getObstruction(this);
						if(obs == ''){
							this.x += this.speed;
						} else {
							this.x = obs.x - this.frameWidth;
						}
					} else if(this.ship){
						this.x = game.width - this.frameWidth;
						this.dir = 'left';
					}
					this.spriteRow = 0;
				} else if(this.dir == 'down'){
					if(this.y + this.speed < game.height - this.frameHeight){
						var obs = getObstruction(this);
						if(obs == ''){
							this.y += this.speed;
						} else {
							this.y = obs.y - this.frameHeight;
						}
					} else if(this.ship){
						this.y = game.height - this.frameHeight;
						this.dir = 'up';
					}
					this.spriteRow = 2;
				}
			}
		}
	}
	
	this.draw = function(){
		this.selector.style.backgroundPosition = (0 - this.spriteColumn * this.frameWidth) + 'px ' + (0 - this.spriteRow * this.frameHeight) + 'px';
		this.selector.style.left = this.x + 'px';
		this.selector.style.top = this.y + 'px';
	};
	
	this.draw();
};

Enemy = function(obj){
	enemies.push(this);
	importJSON(this, obj);
	
	this.count = enemyCount++;
	this.active = true;
	this.dead = false;
	this.trapped = false;
	
	this.speed = this.speed * (magnification / 5);
	
	this.weaponDelay = fps;//Shoot once per second max
	this.weaponReady = true;
	this.weaponCount = 0;
	
	this.selector = document.createElement('div');
	this.selector.id = 'enemy' + this.count;
	this.selector.style.position = 'absolute';
	this.selector.style.width = this.frameWidth + 'px';
	this.selector.style.height = this.frameHeight + 'px';
	this.selector.style.backgroundImage = "url('img/characters/" + this.sprite + ".png')";
	this.selector.style.backgroundSize = this.width + 'px ' + this.height + 'px';
	this.selector.style.backgroundRepeat = 'no-repeat';
	this.selector.style.zIndex = '2';
	stage.selector.appendChild(this.selector);
	
	this.spriteColumn = 1;
	this.blinking = false;
	this.blinkCount = 0;
	
	if(obj == stage.boss){
		this.isBoss = true;
		this.hp = stage.bossHP;
		this.value = stage.bossHP * 100;
	} else {
		this.isBoss = false;
		this.hp = 1;
		this.value = 100;
	}
	
	if(typeof(stage.enemyDir) == 'undefined'){
		this.spriteRow = getRandom(4);
		this.dir = cardinals[this.spriteRow];
	} else {
		this.dir = stage.enemyDir;
	}
	
	if(this.dir === 'left'){
		this.x = game.width;
		this.y = getRandom(game.height - this.frameHeight);
		this.spriteRow = 1;
	} else if(this.dir === 'up'){
		this.x = getRandom(game.width - this.frameWidth);
		this.y = game.height;
		this.spriteRow = 3;
	} else if(this.dir == 'right'){
		this.x = 0 - this.frameWidth;
		this.y = getRandom(game.height - this.frameHeight);
		this.spriteRow = 0;
	} else if(this.dir == 'down'){
		this.x = getRandom(game.width - this.frameWidth);
		this.y = 0 - this.frameHeight;
		this.spriteRow = 2;
	}
	
	//Preload death animation for smooth transition
	if(typeof(this.death) != 'undefined'){
		preload('img/animations/' + this.death.name + '.png');
	}
	
	this.changeDir = function(){
		if(inBounds(this)){
			this.spriteRow = getRandom(4);
			randomDir = cardinals[this.spriteRow];
			if(this.dir == randomDir){
				this.changeDir();
			} else {
				this.dir = randomDir;
			}
		}
	}
	
	this.reverse = function(){
		if(this.dir == 'left'){
			this.dir = 'right';
			this.spriteRow = 0;
		} else if(this.dir == 'up'){
			this.dir = 'down';
			this.spriteRow = 2;
		} else if(this.dir == 'right'){
			this.dir = 'left';
			this.spriteRow = 1;
		} else if(this.dir == 'down'){
			this.dir = 'up';
			this.spriteRow = 3;
		}
	}
	
	this.collide = function(){
		if(this.ship && !this.isBoss){
			this.dead = true;
		}
	}
	
	this.hit = function(){
		if(!this.blinking){
			if(--this.hp == 0){
				this.dead = true;
			} else {
				this.blinking = true;
				this.blinkCount = fps;
				this.changeDir();
			}
		}
		
		updateVictim(this, stage.textColor);
	}
	
	this.respawn = function(){
		stage.selector.removeChild(this.selector);
		position = enemies.indexOf(this);
		enemies.splice(position, 1);
		enemy = new Enemy(obj);
	}
	
	this.kill = function(){
		this.active = false;
		stage.enemiesKilled++;
		
		if(typeof(this.death) != 'undefined'){
			this.selector.style.display = 'none';
			death = new Animation(this.death, this);
		} else {
			this.blinkCount = 0;
			this.spriteColumn = 0;
			this.spriteRow = 4;
		}
		
		updateScore(this.value);
	}
	
	this.update = function(){
		if(this.blinking){
			if(game.counter%2 == 0 || this.dead){
				this.selector.style.display = '';
			} else {
				this.selector.style.display = 'none';
			}
			if(--this.blinkCount == 0){
				this.blinking = false;
				this.selector.style.display = '';
			}
		}
		if(this.dead){
			if(this.active){
				this.kill();
			}
		} else {
			if(!this.weaponReady){
				if(this.weaponCount++ == this.weaponDelay){
					this.weaponReady = true;
					this.weaponCount = 0;
				}
			}
			if(this.spriteColumn < this.moveFrameCount){
				this.spriteColumn++;
			} else {
				this.spriteColumn = 1;
			}
			
			var obs = getObstruction(this);
			if(obs != '' && !inBounds(this)){
				this.trapped = true;
			} else {
				if(this.dir == 'left'){
					if(this.x - this.speed > 0 && obs == ''){
						this.x -= this.speed;
					} else {
						if(obs != ''){
							this.x = obs.x + obs.frameWidth;
							this.changeDir();
						} else {
							this.x = 0;
							this.reverse();
						}
					}
				} else if(this.dir == 'up'){
					if(this.y - this.speed > 0 && obs == ''){
						this.y -= this.speed;
					} else {
						if(obs != ''){
							this.y = obs.y + obs.frameHeight - this.frameHeight + magnification;
							this.changeDir();
						} else {
							this.y = 0;
							this.reverse();
						}
					}
				} else if(this.dir == 'right'){
					if(this.x + this.speed < game.width - this.frameWidth && obs == ''){
						this.x += this.speed;
					} else {
						if(obs != ''){
							this.x = obs.x - this.frameHeight;
							this.changeDir();
						} else {
							this.x = game.width - this.frameWidth;
							this.reverse();
						}
					}
				} else if(this.dir == 'down'){
					if(this.y + this.speed < game.height - this.frameHeight && obs == ''){
						this.y += this.speed;
					} else {
						if(obs != ''){
							this.y = obs.y - this.frameHeight;
							this.changeDir();
						} else {
							this.y = game.height - this.frameHeight;
							this.reverse();
						}
					}
				}
			}
		}
	}
	
	this.draw = function(){
		if(this.trapped){
			this.respawn();
		} else {
			this.selector.style.backgroundPosition = (0 - this.spriteColumn * this.frameWidth) + 'px ' + (0 - this.spriteRow * this.frameHeight) + 'px';
			
			this.selector.style.left = this.x + 'px';
			this.selector.style.top = this.y + 'px';
		}
	};
	
	this.draw();
};

Friendly = function(obj, details){
	friendlies.push(this);
	importJSON(this, obj);
	importJSON(this, details);
	
	this.count = propCount++;
	this.active = true;
	this.dead = false;
	this.trapped = false;
	
	this.speed = this.speed * (magnification / 5);
	
	this.selector = document.createElement('div');
	this.selector.id = 'friendly' + this.count;
	this.selector.style.position = 'absolute';
	this.selector.style.width = this.frameWidth + 'px';
	this.selector.style.height = this.frameHeight + 'px';
	this.selector.style.backgroundImage = "url('img/characters/" + this.sprite + ".png')";
	this.selector.style.backgroundSize = this.width + 'px ' + this.height + 'px';
	this.selector.style.backgroundRepeat = 'no-repeat';
	this.selector.style.zIndex = '2';
	stage.selector.appendChild(this.selector);
	
	if(typeof(this.dir) == 'undefined'){
		this.spriteRow = getRandom(4)
		this.dir = cardinals[this.spriteRow];
	}
	
	if(this.dir == 'left'){
		this.x = game.width;
		this.y = getRandom(game.height - this.frameHeight);
		this.spriteRow = 1;
	} else if(this.dir == 'up'){
		this.x = getRandom(game.width - this.frameWidth);
		this.y = game.height;
		this.spriteRow = 3;
	} else if(this.dir == 'right'){
		this.x = 0 - this.frameWidth;
		this.y = getRandom(game.height - this.frameHeight);
		this.spriteRow = 0;
	} else if(this.dir == 'down'){
		this.x = getRandom(game.width - this.frameWidth);
		this.y = 0 - this.frameHeight;
		this.spriteRow = 2;
	}
	
	this.reverse = function(){
		if(this.dir == 'left'){
			this.dir = 'right';
			this.spriteRow = 0;
		} else if(this.dir == 'up'){
			this.dir = 'down';
			this.spriteRow = 2;
		} else if(this.dir == 'right'){
			this.dir = 'left';
			this.spriteRow = 1;
		} else if(this.dir == 'down'){
			this.dir = 'up';
			this.spriteRow = 3;
		}
	}
	
	this.remove = function(){
		position = friendlies.indexOf(this);
		friendlies.splice(position, 1);
	}
	
	this.respawn = function(){
		stage.selector.removeChild(this.selector);
		position = friendlies.indexOf(this);
		friendlies.splice(position, 1);
		friend = new Friendly(obj, details);
	}
	
	this.kill = function(){
		this.active = false;
		
		if(typeof(this.death) != 'undefined'){
			this.selector.style.display = 'none';
			death = new Animation(this.death, this);
		} else {
			this.spriteColumn = 0;
			this.spriteRow = 4;
		}
		
		if(this.value > 0){
			updateVictim(this, darkBlue);
		} else {
			updateVictim(this, red);
		}
		updateScore(this.value);
	}
	
	this.update = function(){
		if(this.active){
			if(this.spriteColumn < this.moveFrameCount){
				this.spriteColumn++;
			} else {
				this.spriteColumn = 1;
			}
			
			var obs = getObstruction(this);
			if(obs != '' && !inBounds(this)){
				this.trapped = true;
			} else {
				if(this.dir == 'left'){
					if(this.x > 0 - this.frameWidth){
						if(obs == ''){
							this.x -= this.speed;
						} else {
							this.reverse();
						}
					} else {
						this.active = false;
					}
				} else if(this.dir == 'up'){
					if(this.y > 0 - this.frameHeight){
						if(obs == ''){
							this.y -= this.speed;
						} else {
							this.reverse();
						}
					} else {
						this.active = false;
					}
				} else if(this.dir == 'right'){
					if(this.x < game.width + this.frameWidth){
						if(obs == ''){
							this.x += this.speed;
						} else {
							this.reverse();
						}
					} else {
						this.active = false;
					}
				} else if(this.dir == 'down'){
					if(this.y < game.height + this.frameHeight){
						if(obs == ''){
							this.y += this.speed;
						} else {
							this.reverse();
						}
					} else {
						this.active = false;
					}
				}
			}
		}
	}
	
	this.draw = function(){
		this.selector.style.backgroundPosition = (0 - this.spriteColumn * this.frameWidth) + 'px ' + (0 - this.spriteRow * this.frameHeight) + 'px';
		this.selector.style.left = this.x + 'px';
		this.selector.style.top = this.y + 'px';
		
		if(!this.active){
			this.remove();
		} else if(this.trapped){
			this.respawn();
		}
	};
	
	this.draw();
};

Obstacle = function(obj, objX, objY){
	obstacles.push(this);
	importJSON(this, obj);
	
	this.speed = this.speed * (magnification / 5);
	this.count = propCount++;
	this.leftPercent = objX;
	this.topPercent = objY;
	
	if(this.leftPercent == 0){
		this.x = 0;
	} else if(this.leftPercent == 100){
		this.x = game.width - this.frameWidth;
	} else {
		this.x = game.width * (this.leftPercent / 100) - (this.frameWidth / 2);
	}
	if(this.topPercent == 0){
		this.y = 0;
	} else if(this.topPercent == 100){
		this.y = game.height - this.frameHeight;
	} else {
		this.y = game.height * (this.topPercent / 100) - (this.frameHeight / 2);
	}
	
	//Attach to document
	this.selector = document.createElement('div');
	this.selector.id = 'obstacle' + this.count;
	this.selector.style.position = 'absolute';
	this.selector.style.left = this.x + 'px';
	this.selector.style.top = this.y + 'px';
	this.selector.style.width = this.frameWidth + 'px';
	this.selector.style.height = this.frameHeight + 'px';
	this.selector.style.backgroundImage = "url('img/obstacles/" + this.img + ".png')";
	this.selector.style.backgroundSize = this.width + 'px ' + this.height + 'px';
	stage.selector.appendChild(this.selector);
	
	title.style.color = this.textColor;
	directions.style.color = this.textColor;
	scoreboard.style.color = this.textColor;
	
	this.update = function(){
		if(this.frameCount > 1){
			if(this.spriteColumn + 1 < this.frameCount){
				this.spriteColumn++;
			} else {
				this.spriteColumn = 0;
			}
		}
	}
	
	this.draw = function(){
		this.selector.style.left = this.x + 'px';
		this.selector.style.top = this.y + 'px';
		this.selector.style.backgroundPosition = (0 - this.spriteColumn * this.frameWidth) + 'px 0';
	}
};

Projectile = function(origin){
	props.push(this);
	importJSON(this, origin.projectile);
	
	origin.weaponReady = false;
	
	this.type = origin.projectile;
	this.count = propCount++;
	this.origin = origin;
	this.dir = origin.dir;
	this.active = false;//Draw before animating
	this.dead = false;//Draw after collision
	this.spent = false;//Ready to remove
	this.spriteColumn = 0;
	
	this.selector = document.createElement('div');
	this.selector.id = 'projectile' + this.count;
	this.selector.style.position = 'absolute';
	
	if(origin.projectile == 'laser'){
		this.selector.style.backgroundColor = origin.weaponColor;
		if(this.dir == 'left' || this.dir == 'right'){
			this.width = 2 * magnification;
			this.height = 1 * magnification;
		} else if(this.dir == 'up' || this.dir == 'down'){
			this.width = 1 * magnification;
			this.height = 2 * magnification;
		}
		this.frameWidth = this.width;
		this.frameHeight = this.height;
		this.speed = 30;
	} else {
		this.selector.style.backgroundImage = "url('img/projectiles/" + this.name + ".png')";
	}
	this.selector.style.backgroundSize = this.width + 'px ' + this.height + 'px';
	
	this.speed = this.speed * (magnification / 5);
	
	if(this.dir == 'left'){
		this.x = origin.x + (origin.weaponOffsetLeft[0] * magnification) - this.frameWidth;
		this.y = origin.y + (origin.weaponOffsetLeft[1] * magnification);
	} else if(this.dir == 'up'){
		this.x = origin.x + (origin.weaponOffsetUp[0] * magnification);
		this.y = origin.y + (origin.weaponOffsetUp[1] * magnification) - this.frameHeight;
	} else if(this.dir == 'right'){
		this.x = origin.x + (origin.weaponOffsetRight[0] * magnification);
		this.y = origin.y + (origin.weaponOffsetRight[1] * magnification);
	} else if(this.dir == 'down'){
		this.x = origin.x + (origin.weaponOffsetDown[0] * magnification);
		this.y = origin.y + (origin.weaponOffsetDown[1] * magnification);
	}
	
	this.selector.style.width = this.frameWidth + 'px';
	this.selector.style.height = this.frameHeight + 'px';
	this.selector.style.zIndex = '4';
	stage.selector.appendChild(this.selector);
	
	this.kill = function(){
		stage.selector.removeChild(this.selector);
		position = props.indexOf(this);
		props.splice(position, 1);
	}
	
	this.update = function(){
		if(this.active){
			if(this.frameCount > 1){
				if(++this.spriteColumn > this.frameCount){
					this.spriteColumn = 0;
				}
			}
			if(this.dir == 'left'){
				if(this.x > 0 - this.frameWidth){
					this.x -= this.speed;
				} else {
					this.dead = true;
				}
			} else if(this.dir == 'up'){
				if(this.y > 0 - this.frameHeight){
					this.y -= this.speed;
				} else {
					this.dead = true;
				}
			} else if(this.dir == 'right'){
				if(this.x < game.width){
					this.x += this.speed;
				} else {
					this.dead = true;
				}
			} else if(this.dir == 'down'){
				if(this.y < game.height){
					this.y += this.speed;
				} else {
					this.dead = true;
				}
			}
		} else {
			this.active = true;
		}
	}
	
	this.draw = function(){
		if(this.dead){
			if(this.spent){
				this.kill();
			} else {
				this.spent = true;
			}
		} else {
			this.selector.style.left = this.x + 'px';
			this.selector.style.top = this.y + 'px';
			this.selector.style.backgroundPosition = (0 - this.spriteColumn * this.frameWidth) + 'px 0';
		}
	};
	
	this.draw();
};

Bomb = function(origin){
	props.push(this);
	
	this.type = 'bomb';
	this.count = propCount++;
	this.origin = origin;
	this.active = false;
	this.dead = false;
	
	this.x = origin.x + (origin.weaponOffset[0] * magnification);
	this.y = origin.y + (origin.weaponOffset[1] * magnification);
	this.frameWidth = 1 * magnification;
	this.frameHeight = 1 * magnification;
	this.spriteColumn = 0;
	this.frameCount = 5;
	
	this.bomb = document.createElement('div');
	this.bomb.id = 'bomb' + this.count;
	this.bomb.style.position = 'absolute';
	this.bomb.style.left = this.x + 'px';
	this.bomb.style.top = this.y + 'px';
	this.bomb.style.width = this.frameWidth + 'px';
	this.bomb.style.height = this.frameHeight + 'px';
	this.bomb.style.backgroundColor = 'black';
	this.bomb.style.zIndex = '2';
	stage.selector.appendChild(this.bomb);
	
	this.selector = this.bomb;
	
	this.kill = function(){
		detonation = new Animation(detonation, this);
		
		stage.selector.removeChild(this.selector);
		position = props.indexOf(this);
		props.splice(position, 1);
	}
	
	this.update = function(){
		if(!this.active){
			if(!collision(this, this.origin)){
				this.active = true;
			}
		}
	}
	
	this.draw = function(){
		if(this.active){
			if(game.counter%2 == 0){
				this.selector.style.backgroundColor = 'red';
			} else {
				this.selector.style.backgroundColor = 'black';
			}
		}
		
		if(this.dead){
			this.kill();
		}
	}
};

Lightsaber = function(origin, isLongRange){
	props.push(this);
	
	this.type = 'lightsaber';
	this.count = propCount++;
	this.origin = origin;
	this.dir = origin.dir;
	this.color = origin.weaponColor;
	this.active = !isLongRange;
	this.speed = isLongRange ? 30 * (magnification / 5) : 0;
	this.thrown = isLongRange;
	
	if(this.dir == 'left'){
		this.frameWidth = 8 * magnification;
		this.frameHeight = 1 * magnification;
		this.hiltWidth = 2 * magnification;
		this.hiltHeight = 1 * magnification;
		this.x = origin.x + (origin.weaponOffsetLeft[0] * magnification) - this.frameWidth;
		this.y = origin.y + (origin.weaponOffsetLeft[1] * magnification);
		this.hiltX = this.frameWidth - this.hiltWidth;
		this.hiltY = 0;
	} else if(this.dir == 'up'){
		this.frameWidth = 1 * magnification;
		this.frameHeight = 8 * magnification;
		this.hiltWidth = 1 * magnification;
		this.hiltHeight = 2 * magnification;
		this.x = origin.x + (origin.weaponOffsetUp[0] * magnification);
		this.y = origin.y + (origin.weaponOffsetUp[1] * magnification) - this.frameHeight;
		this.hiltX = 0;
		this.hiltY = this.frameHeight - this.hiltHeight;;
	} else if(this.dir == 'right'){
		this.frameWidth = 8 * magnification;
		this.frameHeight = 1 * magnification;
		this.hiltWidth = 2 * magnification;
		this.hiltHeight = 1 * magnification;
		this.x = origin.x + (origin.weaponOffsetRight[0] * magnification);
		this.y = origin.y + (origin.weaponOffsetRight[1] * magnification);
		this.hiltX = 0;
		this.hiltY = 0;
	} else if(this.dir == 'down'){
		this.frameWidth = 1 * magnification;
		this.frameHeight = 8 * magnification;
		this.hiltWidth = 1 * magnification;
		this.hiltHeight = 2 * magnification;
		this.x = origin.x + (origin.weaponOffsetDown[0] * magnification);
		this.y = origin.y + (origin.weaponOffsetDown[1] * magnification);
		this.hiltX = 0;
		this.hiltY = 0;
	}
	
	this.width = this.frameWidth;
	this.height = this.frameHeight;
	
	//Add container div
	this.selector = document.createElement('div');
	this.selector.id = 'lightsaber' + this.count;
	this.selector.style.position = 'absolute';
	this.selector.style.left = this.x + 'px';
	this.selector.style.top = this.y + 'px';
	this.selector.style.width = this.frameWidth + 'px';
	this.selector.style.height = this.frameHeight + 'px';
	this.selector.style.backgroundColor = this.color;
	this.selector.style.zIndex = '4';
	stage.selector.appendChild(this.selector);
	
	//Add hilt
	hilt = document.createElement('div');
	hilt.id = 'hilt' + this.count;
	hilt.style.position = 'relative';
	hilt.style.left = this.hiltX + 'px';
	hilt.style.top = this.hiltY + 'px';
	hilt.style.width = this.hiltWidth + 'px';
	hilt.style.height = this.hiltHeight + 'px';
	hilt.style.backgroundColor = gray;
	this.selector.appendChild(hilt);
	
	this.reverse = function(){
		if(this.dir == 'left'){
			this.dir = 'right';
		} else if(this.dir == 'up'){
			this.dir = 'down';
		} else if(this.dir == 'right'){
			this.dir = 'left';
		} else if(this.dir == 'down'){
			this.dir = 'up';
		}
	}
	
	this.kill = function(){
		stage.selector.removeChild(this.selector);
		position = props.indexOf(this);
		props.splice(position, 1);
		origin.lightsaber = '';
		origin.spriteColumn = 0;
	}
	
	this.update = function(){
		if(!this.active){
			if(!collision(this, this.origin)){
				this.active = true;
			}
		}
		if(this.thrown){
			if(this.dir == 'left'){
				if(this.x - this.speed > 0){
					this.x -= this.speed;
				} else {
					this.x = 0;
					this.reverse();
				}
			} else if(this.dir == 'up'){
				if(this.y - this.speed > 0){
					this.y -= this.speed;
				} else {
					this.y = 0;
					this.reverse();
				}
			} else if(this.dir == 'right'){
				if(this.x + this.speed < game.width - this.width){
					this.x += this.speed;
				} else {
					this.x = game.width - this.frameWidth;
					this.reverse();
				}
			} else if(this.dir == 'down'){
				if(this.y + this.speed < game.height - this.height){
					this.y += this.speed;
				} else {
					this.y = game.height - this.frameHeight;
					this.reverse();
				}
			}
		}
	}
	
	this.draw = function(){
		if(player.attacking){
			this.selector.style.left = this.x + 'px';
			this.selector.style.top = this.y + 'px';
		} else {
			this.kill();
		}
	}
};

Animation = function(obj, origin){
	importJSON(this, obj);
	
	this.origin = origin;
	this.count = propCount++;
	this.dead = false;
	
	animations.push(this);
	
	this.width = this.frameWidth * this.frameCount;
	this.height = this.frameHeight;
	this.spriteColumn = 0;
	
	this.x = Math.floor(origin.x + (origin.frameWidth - this.frameWidth) / 2);
	this.y = Math.floor(origin.y + (origin.frameHeight - this.frameHeight) / 2);
	
	this.selector = document.createElement('div');
	this.selector.id = 'animation' + this.count;
	this.selector.style.position = 'absolute';
	this.selector.style.left = this.x + 'px';
	this.selector.style.top = this.y + 'px';
	this.selector.style.width = this.frameWidth + 'px';
	this.selector.style.height = this.frameHeight + 'px';
	this.selector.style.backgroundImage = "url('img/animations/" + this.name + ".png')";
	this.selector.style.backgroundSize = this.width + 'px ' + this.height + 'px';
	this.selector.style.zIndex = '2';
	stage.selector.appendChild(this.selector);
	
	this.kill = function(){
		if(this.remove){
			stage.selector.removeChild(this.selector);
		}
		position = animations.indexOf(this);
		animations.splice(position, 1);
	}
	
	this.update = function(){
		if(this.spriteColumn + 1 < this.frameCount){
			this.spriteColumn++;
		} else {
			this.dead = true;
		}
	}
	
	this.draw = function(){
		if(this.dead){
			this.kill();
		}
		this.selector.style.backgroundPosition = (0 - this.spriteColumn * this.frameWidth) + 'px 0';
	}
};

//Obstacles
bar = {
	'img': 'bar',
	'width': 23 * magnification,
	'height': 14 * magnification,
	'frameWidth': 23 * magnification,
	'frameHeight': 14 * magnification,
	'frameCount': 1,
	'speed': 0,
	'impassable': true
};

desks = {
	'img': 'desks',
	'width': 13 * magnification,
	'height': 40 * magnification,
	'frameWidth': 13 * magnification,
	'frameHeight': 40 * magnification,
	'frameCount': 1,
	'speed': 0,
	'impassable': true
};

dragon = {
	'img': 'dragon',
	'width': 62 * magnification,
	'height': 13 * magnification,
	'frameWidth': 62 * magnification,
	'frameHeight': 13 * magnification,
	'frameCount': 1,
	'speed': 0,
	'impassable': true
};

falconbig = {
	'img': 'falconbig',
	'width': 76 * magnification,
	'height': 39 * magnification,
	'frameWidth': 76 * magnification,
	'frameHeight': 39 * magnification,
	'frameCount': 1,
	'speed': 0,
	'impassable': true
};

igloo = {
	'img': 'igloo',
	'width': 28 * magnification,
	'height': 17 * magnification,
	'frameWidth': 28 * magnification,
	'frameHeight': 17 * magnification,
	'frameCount': 1,
	'speed': 0,
	'impassable': true
};

speeder = {
	'img': 'speeder',
	'width': 120 * magnification,
	'height': 12 * magnification,
	'frameWidth': 30 * magnification,
	'frameHeight': 12 * magnification,
	'frameCount': 4,
	'speed': 0,
	'impassable': true
};

table = {
	'img': 'table',
	'width': 16 * magnification,
	'height': 11 * magnification,
	'frameWidth': 16 * magnification,
	'frameHeight': 11 * magnification,
	'frameCount': 1,
	'speed': 0,
	'impassable': true
};

tractorBeamGenerator = {
	'img': 'tractorBeamGenerator',
	'width': 80 * magnification,
	'height': 42 * magnification,
	'frameWidth': 20 * magnification,
	'frameHeight': 42 * magnification,
	'frameCount': 4,
	'speed': 0,
	'impassable': true
};

//Projectiles
rock = {
	'name': 'rock',
	'width': 20 * magnification,
	'height': 5 * magnification,
	'frameWidth': 5 * magnification,
	'frameHeight': 5 * magnification,
	'frameCount': 4,
	'speed': 20
};

gunganBall = {
	'name': 'gunganBall',
	'width': 36 * magnification,
	'height': 6 * magnification,
	'frameWidth': 6 * magnification,
	'frameHeight': 6 * magnification,
	'frameCount': 5,
	'speed': 20
};

stun = {
	'name': 'stun',
	'width': 60 * magnification,
	'height': 10 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 10 * magnification,
	'frameCount': 6,
	'speed': 20
};

//Animations
detonation = {
	'name': 'detonation',
	'frameWidth': 9 * magnification,
	'frameHeight': 5 * magnification,
	'frameCount': 5,
	'remove': true
};

explosion = {
	'name': 'explosion',
	'frameWidth': 10 * magnification,
	'frameHeight': 12 * magnification,
	'frameCount': 9,
	'remove': true
};

explosionsmall = {
	'name': 'explosionsmall',
	'frameWidth': 10 * magnification,
	'frameHeight': 10 * magnification,
	'frameCount': 7,
	'remove': true
};

spritz = {
	'name': 'spritz',
	'frameWidth': 10 * magnification,
	'frameHeight': 12 * magnification,
	'frameCount': 5,
	'remove': true
};

//Death Animations
arfivedeath = {
	'name': 'arfivedeath',
	'frameWidth': 5 * magnification,
	'frameHeight': 9 * magnification,
	'frameCount': 6, 
	'remove': false
};

auntberudeath = {
	'name': 'auntberudeath',
	'frameWidth': 10 * magnification,
	'frameHeight': 12 * magnification,
	'frameCount': 10, 
	'remove': false
};

bendeath = {
	'name': 'bendeath',
	'frameWidth': 10 * magnification,
	'frameHeight': 12 * magnification,
	'frameCount': 6, 
	'remove': false
};

darthvader6death = {
	'name': 'darthvader6death',
	'frameWidth': 10 * magnification,
	'frameHeight': 12 * magnification,
	'frameCount': 12,
	'remove': false
};

uncleowendeath = {
	'name': 'uncleowendeath',
	'frameWidth': 10 * magnification,
	'frameHeight': 12 * magnification,
	'frameCount': 10, 
	'remove': false
};

vadertiedeath = {
	'name': 'vadertiedeath',
	'frameWidth': 7 * magnification,
	'frameHeight': 7 * magnification,
	'frameCount': 8,
	'remove': true
};

//Characters
ackbar = {
	'name': 'Admiral Ackbar',
	'sprite': 'ackbar',
	'ship': false,
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': green,
	'weaponOffsetLeft': [0, 4],
	'weaponOffsetUp': [7, 0],
	'weaponOffsetRight': [10, 4],
	'weaponOffsetDown': [3, 8],
	'width': 90 * magnification,
	'height': 60 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 12 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

amidala = {
	'name': 'Queen Amidala',
	'sprite': 'amidala',
	'ship': false,
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': green,
	'weaponOffsetLeft': [0, 5],
	'weaponOffsetUp': [7, 0],
	'weaponOffsetRight': [10, 5],
	'weaponOffsetDown': [3, 9],
	'width': 90 * magnification,
	'height': 60 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 12 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

ani = {
	'name': 'Ani',
	'sprite': 'ani',
	'ship': false,
	'weaponType': 'bomb',
	'weaponOffset': [3, 9],
	'width': 63 * magnification,
	'height': 50 * magnification,
	'frameWidth': 7 * magnification,
	'frameHeight': 10 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

artoo = {
	'name': 'R2-D2',
	'sprite': 'artoo',
	'ship': false,
	'weaponType': 'bomb',
	'weaponOffset': [3, 7],
	'width': 14 * magnification,
	'height': 40 * magnification,
	'frameWidth': 7 * magnification,
	'frameHeight': 8 * magnification,
	'moveFrameCount': 1,
	'speed': 10
};

arfive = {
	'name': 'R5-D4',
	'sprite': 'arfive',
	'ship': false,
	'death': arfivedeath,
	'weaponType': 'bomb',
	'weaponOffset': [3, 8],
	'width': 10 * magnification,
	'height': 36 * magnification,
	'frameWidth': 5 * magnification,
	'frameHeight': 9 * magnification,
	'moveFrameCount': 1,
	'speed': 6
};

atst = {
	'name': 'AT-ST',
	'sprite': 'atst',
	'ship': false,
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': red,
	'weaponOffsetLeft': [2, 5],
	'weaponOffsetUp': [8, 0],
	'weaponOffsetRight': [13, 5],
	'weaponOffsetDown': [6, 8],
	'width': 135 * magnification,
	'height': 75 * magnification,
	'frameWidth': 15 * magnification,
	'frameHeight': 15 * magnification,
	'moveFrameCount': 8,
	'speed': 4
};

auntberu = {
	'name': 'Aunt Beru',
	'sprite': 'auntberu',
	'ship': false,
	'death': auntberudeath,
	'weaponType': 'bomb',
	'weaponOffset': [4, 10],
	'width': 40 * magnification,
	'height': 44 * magnification,
	'frameWidth': 8 * magnification,
	'frameHeight': 11 * magnification,
	'moveFrameCount': 4,
	'speed': 6
};

bantha = {
	'name': 'Bantha',
	'sprite': 'bantha',
	'ship': false,
	'weaponType': 'attack',
	'width': 100 * magnification,
	'height': 60 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 12 * magnification,
	'moveFrameCount': 8,
	'speed': 10
};

battledroid = {
	'name': 'Battle Droid',
	'sprite': 'battledroid',
	'ship': false,
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': green,
	'weaponOffsetLeft': [0, 4],
	'weaponOffsetUp': [6, 0],
	'weaponOffsetRight': [10, 4],
	'weaponOffsetDown': [3, 8],
	'width': 90 * magnification,
	'height': 55 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 11 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

bb8 = {
	'name': 'BB-8',
	'sprite': 'bb8',
	'ship': false,
	'weaponType': 'bomb',
	'weaponOffset': [3, 7],
	'width': 45 * magnification,
	'height': 35 * magnification,
	'frameWidth': 5 * magnification,
	'frameHeight': 7 * magnification,
	'moveFrameCount': 8,
	'speed': 10
};

ben = {
	'name': 'Ben Kenobi',
	'sprite': 'ben',
	'ship': false,
	'death': bendeath,
	'weaponType': 'lightsaber',
	'weaponColor': blue,
	'weaponOffsetLeft': [0, 4],
	'weaponOffsetUp': [8, 0],
	'weaponOffsetRight': [10, 4],
	'weaponOffsetDown': [1, 10],
	'width': 60 * magnification,
	'height': 60 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 12 * magnification,
	'moveFrameCount': 4,
	'speed': 6
};

bikerscout = {
	'name': 'Biker Scout',
	'sprite': 'bikerscout',
	'ship': false,
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': red,
	'weaponOffsetLeft': [0, 4],
	'weaponOffsetUp': [7, 0],
	'weaponOffsetRight': [10, 4],
	'weaponOffsetDown': [3, 8],
	'width': 90 * magnification,
	'height': 55 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 11 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

bobafett = {
	'name': 'Boba Fett',
	'sprite': 'bobafett',
	'ship': false,
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': red,
	'weaponOffsetLeft': [0, 5],
	'weaponOffsetUp': [7, 1],
	'weaponOffsetRight': [10, 5],
	'weaponOffsetDown': [3, 9],
	'width': 90 * magnification,
	'height': 60 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 12 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

bossnass = {
	'name': 'Boss Nass',
	'sprite': 'bossnass',
	'ship': false,
	'weaponType': 'attack',
	'width': 90 * magnification,
	'height': 60 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 12 * magnification,
	'moveFrameCount': 8,
	'speed': 4
};

captainantilles = {
	'name': 'Captain Antilles',
	'sprite': 'captainantilles',
	'ship': false,
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': green,
	'weaponOffsetLeft': [0, 4],
	'weaponOffsetUp': [6, 0],
	'weaponOffsetRight': [10, 4],
	'weaponOffsetDown': [3, 7],
	'width': 90 * magnification,
	'height': 55 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 11 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

carbonite = {
	'name': 'Frozen Han Solo',
	'sprite': 'carbonite',
	'ship': false,
	'weaponType': 'attack',
	'width': 20 * magnification,
	'height': 60 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 12 * magnification,
	'moveFrameCount': 1,
	'speed': 8
};

chewbacca = {
	'name': 'Chewbacca',
	'sprite': 'chewbacca',
	'ship': false,
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': green,
	'weaponOffsetLeft': [0, 5],
	'weaponOffsetUp': [7, 0],
	'weaponOffsetRight': [10, 5],
	'weaponOffsetDown': [3, 9],
	'width': 90 * magnification,
	'height': 60 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 12 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

chewbacca5 = {
	'name': 'Chewbacca',
	'sprite': 'chewbacca5',
	'ship': false,
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': green,
	'weaponOffsetLeft': [0, 8],
	'weaponOffsetUp': [8, 1],
	'weaponOffsetRight': [11, 8],
	'weaponOffsetDown': [4, 12],
	'width': 108 * magnification,
	'height': 75 * magnification,
	'frameWidth': 12 * magnification,
	'frameHeight': 15 * magnification,
	'moveFrameCount': 8,
	'speed': 6
};

clonecaptain = {
	'name': 'Clone Captain',
	'sprite': 'clonecaptain',
	'ship': false,
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': blue,
	'weaponOffsetLeft': [0, 4],
	'weaponOffsetUp': [7, 1],
	'weaponOffsetRight': [10, 4],
	'weaponOffsetDown': [3, 8],
	'width': 90 * magnification,
	'height': 55 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 11 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

clonetrooper = {
	'name': 'Clone Trooper',
	'sprite': 'clonetrooper',
	'ship': false,
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': blue,
	'weaponOffsetLeft': [0, 4],
	'weaponOffsetUp': [7, 0],
	'weaponOffsetRight': [10, 4],
	'weaponOffsetDown': [3, 8],
	'width': 90 * magnification,
	'height': 55 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 11 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

coruscantguard = {
	'name': 'Coruscant Guard',
	'sprite': 'coruscantguard',
	'ship': false,
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': red,
	'weaponOffsetLeft': [0, 5],
	'weaponOffsetUp': [7, 1],
	'weaponOffsetRight': [10, 5],
	'weaponOffsetDown': [3, 9],
	'width': 50 * magnification,
	'height': 60 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 12 * magnification,
	'moveFrameCount': 4,
	'speed': 8
};

darthmaul = {
	'name': 'Darth Maul',
	'sprite': 'darthmaul',
	'ship': false,
	'weaponType': 'lightsaber',
	'weaponColor': red,
	'weaponOffsetLeft': [0, 4],
	'weaponOffsetUp': [8, 0],
	'weaponOffsetRight': [10, 4],
	'weaponOffsetDown': [1, 10],
	'width': 100 * magnification,
	'height': 60 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 12 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

darthvader = {
	'name': 'Darth Vader',
	'sprite': 'darthvader',
	'ship': false,
	'weaponType': 'lightsaber',
	'weaponColor': red,
	'weaponOffsetLeft': [0, 5],
	'weaponOffsetUp': [8, 0],
	'weaponOffsetRight': [10, 3],
	'weaponOffsetDown': [1, 8],
	'width': 100 * magnification,
	'height': 60 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 12 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

darthvader5= {
	'name': 'Darth Vader',
	'sprite': 'darthvader5',
	'ship': false,
	'weaponType': 'lightsaber',
	'weaponColor': red,
	'weaponOffsetLeft': [0, 5],
	'weaponOffsetUp': [8, 0],
	'weaponOffsetRight': [10, 3],
	'weaponOffsetDown': [1, 8],
	'width': 100 * magnification,
	'height': 60 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 12 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

darthvader6= {
	'name': 'Darth Vader',
	'sprite': 'darthvader6',
	'ship': false,
	'death': darthvader6death,
	'weaponType': 'lightsaber',
	'weaponColor': red,
	'weaponOffsetLeft': [0, 5],
	'weaponOffsetUp': [8, 0],
	'weaponOffsetRight': [10, 3],
	'weaponOffsetDown': [1, 8],
	'width': 100 * magnification,
	'height': 60 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 12 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

deathstartrooper = {
	'name': 'Death Star Trooper',
	'sprite': 'deathstartrooper',
	'ship': false,
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': green,
	'weaponOffsetLeft': [0, 4],
	'weaponOffsetUp': [7, 0],
	'weaponOffsetRight': [10, 4],
	'weaponOffsetDown': [3, 7],
	'width': 90 * magnification,
	'height': 55 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 11 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

droideka = {
	'name': 'Droideka',
	'sprite': 'droideka',
	'ship': false,
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': red,
	'weaponOffsetLeft': [0, 5],
	'weaponOffsetUp': [7, 1],
	'weaponOffsetRight': [10, 5],
	'weaponOffsetDown': [2, 8],
	'width': 90 * magnification,
	'height': 60 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 12 * magnification,
	'moveFrameCount': 8,
	'speed': 12
};

emperor = {
	'name': 'Emperor',
	'sprite': 'emperor',
	'ship': false,
	'weaponType': 'bomb',
	'width': 90 * magnification,
	'height': 60 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 12 * magnification,
	'moveFrameCount': 8,
	'speed': 4
};

ewok = {
	'name': 'Ewok',
	'sprite': 'ewok',
	'ship': false,
	'weaponType': 'projectile',
	'projectile': rock,
	'weaponOffsetLeft': [0, 4],
	'weaponOffsetUp': [3, 0],
	'weaponOffsetRight': [10, 4],
	'weaponOffsetDown': [3, 10],
	'weaponDelay': fps / 2,
	'width': 90 * magnification,
	'height': 55 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 11 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

gamorrean = {
	'name': 'Gamorrean Guard',
	'sprite': 'gamorrean',
	'ship': false,
	'weaponType': 'attack',
	'width': 90 * magnification,
	'height': 60 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 12 * magnification,
	'moveFrameCount': 8,
	'speed': 6
};

garindan = {
	'name': 'Garindan',
	'sprite': 'garindan',
	'ship': false,
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': red,
	'weaponOffsetLeft': [0, 5],
	'weaponOffsetUp': [7, 1],
	'weaponOffsetRight': [10, 5],
	'weaponOffsetDown': [3, 9],
	'width': 90 * magnification,
	'height': 60 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 12 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

gonkdroid = {
	'name': 'Gonk Droid',
	'sprite': 'gonkdroid',
	'ship': false,
	'weaponType': 'bomb',
	'weaponOffset': [4, 11],
	'weaponDelay': fps / 2,
	'width': 90 * magnification,
	'height': 60 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 12 * magnification,
	'moveFrameCount': 8,
	'speed': 4
};

greedo = {
	'name': 'Greedo',
	'sprite': 'greedo',
	'ship': false,
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': red,
	'weaponOffsetLeft': [0, 4],
	'weaponOffsetUp': [7, 0],
	'weaponOffsetRight': [10, 4],
	'weaponOffsetDown': [3, 8],
	'width': 90 * magnification,
	'height': 55 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 11 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

gungan = {
	'name': 'Gungan',
	'sprite': 'gungan',
	'ship': false,
	'weaponType': 'projectile',
	'projectile': gunganBall,
	'weaponOffsetLeft': [0, 3],
	'weaponOffsetUp': [2, 0],
	'weaponOffsetRight': [10, 3],
	'weaponOffsetDown': [2, 12],
	'width': 90 * magnification,
	'height': 60 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 12 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

hansolo = {
	'name': 'Han Solo',
	'sprite': 'hansolo',
	'ship': false,
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': green,
	'weaponOffsetLeft': [0, 4],
	'weaponOffsetUp': [7, 0],
	'weaponOffsetRight': [10, 4],
	'weaponOffsetDown': [3, 8],
	'width': 90 * magnification,
	'height': 55 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 11 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

hansolo5 = {
	'name': 'Han Solo',
	'sprite': 'hansolo5',
	'ship': false,
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': green,
	'weaponOffsetLeft': [0, 4],
	'weaponOffsetUp': [7, 0],
	'weaponOffsetRight': [10, 4],
	'weaponOffsetDown': [3, 8],
	'width': 90 * magnification,
	'height': 55 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 11 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

imperialguard = {
	'name': 'Imperial Guard',
	'sprite': 'imperialguard',
	'ship': false,
	'weaponType': 'attack',
	'width': 50 * magnification,
	'height': 60 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 12 * magnification,
	'moveFrameCount': 4,
	'speed': 8
};

jabba = {
	'name': 'Jabba the Hutt',
	'sprite': 'jabba',
	'ship': false,
	'weaponType': 'attack',
	'width': 90 * magnification,
	'height': 55 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 11 * magnification,
	'moveFrameCount': 8,
	'speed': 4
};

jangofett = {
	'name': 'Jango Fett',
	'sprite': 'jangofett',
	'ship': false,
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': red,
	'weaponOffsetLeft': [0, 5],
	'weaponOffsetUp': [7, 1],
	'weaponOffsetRight': [10, 5],
	'weaponOffsetDown': [3, 9],
	'width': 90 * magnification,
	'height': 60 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 12 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

jarjar = {
	'name': 'Jar Jar Binks',
	'sprite': 'jarjar',
	'ship': false,
	'weaponType': 'projectile',
	'projectile': gunganBall,
	'weaponOffsetLeft': [0, 3],
	'weaponOffsetUp': [2, 0],
	'weaponOffsetRight': [10, 3],
	'weaponOffsetDown': [2, 12],
	'width': 90 * magnification,
	'height': 60 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 12 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

jawa = {
	'name': 'Jawa',
	'sprite': 'jawa',
	'ship': false,
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': red,
	'weaponOffsetLeft': [0, 4],
	'weaponOffsetUp': [7, 0],
	'weaponOffsetRight': [10, 4],
	'weaponOffsetDown': [3, 7],
	'width': 50 * magnification,
	'height': 50 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 10 * magnification,
	'moveFrameCount': 4,
	'speed': 8
};

kyloren = {
	'name': 'Kylo Ren',
	'sprite': 'kyloren',
	'ship': false,
	'weaponType': 'lightsaber',
	'weaponColor': red,
	'weaponOffsetLeft': [0, 5],
	'weaponOffsetUp': [8, 0],
	'weaponOffsetRight': [10, 3],
	'weaponOffsetDown': [1, 8],
	'width': 100 * magnification,
	'height': 60 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 12 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

kylorenunmasked = {
	'name': 'Kylo Ren',
	'sprite': 'kylorenunmasked',
	'ship': false,
	'weaponType': 'lightsaber',
	'weaponColor': red,
	'weaponOffsetLeft': [0, 5],
	'weaponOffsetUp': [8, 0],
	'weaponOffsetRight': [10, 3],
	'weaponOffsetDown': [1, 8],
	'width': 100 * magnification,
	'height': 60 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 12 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

lando = {
	'name': 'Lando Calrissian',
	'sprite': 'lando',
	'ship': false,
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': green,
	'weaponOffsetLeft': [0, 4],
	'weaponOffsetUp': [7, 0],
	'weaponOffsetRight': [10, 4],
	'weaponOffsetDown': [3, 8],
	'width': 90 * magnification,
	'height': 55 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 11 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

leia = {
	'name': 'Princess Leia',
	'sprite': 'leia',
	'ship': false,
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': green,
	'weaponOffsetLeft': [0, 4],
	'weaponOffsetUp': [7, 0],
	'weaponOffsetRight': [10, 4],
	'weaponOffsetDown': [3, 8],
	'width': 90 * magnification,
	'height': 55 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 11 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

leia6 = {
	'name': 'Princess Leia',
	'sprite': 'leia6',
	'ship': false,
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': green,
	'weaponOffsetLeft': [0, 4],
	'weaponOffsetUp': [7, 0],
	'weaponOffsetRight': [10, 4],
	'weaponOffsetDown': [3, 8],
	'width': 90 * magnification,
	'height': 55 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 11 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

lobot = {
	'name': 'Lobot',
	'sprite': 'lobot',
	'ship': false,
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': green,
	'weaponOffsetLeft': [0, 4],
	'weaponOffsetUp': [7, 0],
	'weaponOffsetRight': [10, 4],
	'weaponOffsetDown': [3, 8],
	'width': 90 * magnification,
	'height': 55 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 11 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

logray = {
	'name': 'Logray',
	'sprite': 'logray',
	'ship': false,
	'weaponType': 'projectile',
	'projectile': 'rock',
	'width': 90 * magnification,
	'height': 60 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 12 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

luke = {
	'name': 'Luke Skywalker',
	'sprite': 'luke',
	'ship': false,
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': green,
	'weaponOffsetLeft': [0, 4],
	'weaponOffsetUp': [7, 0],
	'weaponOffsetRight': [10, 4],
	'weaponOffsetDown': [3, 8],
	'width': 90 * magnification,
	'height': 55 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 11 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

luke5 = {
	'name': 'Luke Skywalker',
	'sprite': 'luke5',
	'ship': false,
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': green,
	'weaponOffsetLeft': [0, 4],
	'weaponOffsetUp': [7, 0],
	'weaponOffsetRight': [10, 4],
	'weaponOffsetDown': [3, 8],
	'width': 90 * magnification,
	'height': 55 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 11 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

luke6 = {
	'name': 'Luke Skywalker',
	'sprite': 'luke6',
	'ship': false,
	'weaponType': 'lightsaber',
	'weaponColor': green,
	'weaponOffsetLeft': [0, 3],
	'weaponOffsetUp': [8, 1],
	'weaponOffsetRight': [10, 3],
	'weaponOffsetDown': [1, 9],
	'width': 100 * magnification,
	'height': 60 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 12 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

macewindu = {
	'name': 'Mace Windu',
	'sprite': 'macewindu',
	'ship': false,
	'weaponType': 'lightsaber',
	'weaponColor': purple,
	'weaponOffsetLeft': [0, 3],
	'weaponOffsetUp': [8, 0],
	'weaponOffsetRight': [10, 3],
	'weaponOffsetDown': [1, 9],
	'width': 100 * magnification,
	'height': 55 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 11 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

mawhonic = {
	'name': 'Mawhonic',
	'sprite': 'mawhonic',
	'ship': false,
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': blue,
	'weaponOffsetLeft': [0, 4],
	'weaponOffsetUp': [7, 0],
	'weaponOffsetRight': [10, 4],
	'weaponOffsetDown': [3, 8],
	'width': 90 * magnification,
	'height': 55 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 11 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

mousedroid = {
	'name': 'Mouse Droid',
	'sprite': 'mousedroid',
	'ship': false,
	'death': detonation,
	'weaponType': 'bomb',
	'weaponOffset': [4, 5],
	'width': 16 * magnification,
	'height': 32 * magnification,
	'frameWidth': 8 * magnification,
	'frameHeight': 8 * magnification,
	'moveFrameCount': 1,
	'speed': 12
};

naboopilot = {
	'name': 'Naboo Pilot',
	'sprite': 'naboopilot',
	'ship': false,
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': blue,
	'weaponOffsetLeft': [0, 4],
	'weaponOffsetUp': [7, 0],
	'weaponOffsetRight': [10, 4],
	'weaponOffsetDown': [3, 8],
	'width': 90 * magnification,
	'height': 55 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 11 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

nutegunray = {
	'name': 'Nute Gunray',
	'sprite': 'nutegunray',
	'ship': false,
	'weaponType': 'none',
	'width': 50 * magnification,
	'height': 60 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 12 * magnification,
	'moveFrameCount': 4,
	'speed': 5
};

obiwan = {
	'name': 'Obi Wan Kenobi',
	'sprite': 'obiwan',
	'ship': false,
	'weaponType': 'lightsaber',
	'weaponColor': blue,
	'weaponOffsetLeft': [0, 3],
	'weaponOffsetUp': [8, 0],
	'weaponOffsetRight': [10, 3],
	'weaponOffsetDown': [1, 10],
	'width': 100 * magnification,
	'height': 60 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 12 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

officerblack = {
	'name': 'Imperial Officer',
	'sprite': 'officerblack',
	'ship': false,
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': red,
	'weaponOffsetLeft': [0, 4],
	'weaponOffsetUp': [7, 0],
	'weaponOffsetRight': [10, 4],
	'weaponOffsetDown': [3, 8],
	'width': 90 * magnification,
	'height': 55 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 11 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

officergreen = {
	'name': 'Imperial Officer',
	'sprite': 'officergreen',
	'ship': false,
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': red,
	'weaponOffsetLeft': [0, 4],
	'weaponOffsetUp': [7, 0],
	'weaponOffsetRight': [10, 4],
	'weaponOffsetDown': [3, 8],
	'width': 90 * magnification,
	'height': 55 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 11 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

panaka = {
	'name': 'Captain Panaka',
	'sprite': 'panaka',
	'ship': false,
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': blue,
	'weaponOffsetLeft': [0, 4],
	'weaponOffsetUp': [7, 0],
	'weaponOffsetRight': [10, 4],
	'weaponOffsetDown': [3, 8],
	'width': 90 * magnification,
	'height': 55 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 11 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

pondababa = {
	'name': 'Ponda Baba',
	'sprite': 'pondababa',
	'ship': false,
	'weaponType': 'none',
	'width': 90 * magnification,
	'height': 60 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 12 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

protocolblack = {
	'name': 'Protocol Droid',
	'sprite': 'protocolblack',
	'ship': false,
	'weaponType': 'none',
	'width': 72 * magnification,
	'height': 50 * magnification,
	'frameWidth': 8 * magnification,
	'frameHeight': 10 * magnification,
	'moveFrameCount': 8,
	'speed': 5
};

protocolwhite = {
	'name': 'Protocol Droid',
	'sprite': 'protocolwhite',
	'ship': false,
	'weaponType': 'none',
	'width': 72 * magnification,
	'height': 50 * magnification,
	'frameWidth': 8 * magnification,
	'frameHeight': 10 * magnification,
	'moveFrameCount': 8,
	'speed': 5
};

quigonjinn = {
	'name': 'Qui-Gon Jinn',
	'sprite': 'quigonjinn',
	'ship': false,
	'weaponType': 'lightsaber',
	'weaponColor': green,
	'weaponOffsetLeft': [0, 4],
	'weaponOffsetUp': [8, 0],
	'weaponOffsetRight': [10, 4],
	'weaponOffsetDown': [1, 10],
	'width': 100 * magnification,
	'height': 60 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 12 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

rancor = {
	'name': 'Rancor',
	'sprite': 'rancor',
	'ship': false,
	'weaponType': 'bomb',
	'weaponOffset': [3, 7],
	'width': 135 * magnification,
	'height': 65 * magnification,
	'frameWidth': 15 * magnification,
	'frameHeight': 13 * magnification,
	'moveFrameCount': 8,
	'speed': 4
};

rebel = {
	'name': 'Rebel',
	'sprite': 'rebel',
	'ship': false,
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': green,
	'weaponOffsetLeft': [0, 4],
	'weaponOffsetUp': [6, 0],
	'weaponOffsetRight': [10, 4],
	'weaponOffsetDown': [3, 7],
	'width': 90 * magnification,
	'height': 55 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 11 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

runehaako = {
	'name': 'Rune Haako',
	'sprite': 'runehaako',
	'ship': false,
	'weaponType': 'none',
	'width': 50 * magnification,
	'height': 60 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 12 * magnification,
	'moveFrameCount': 4,
	'speed': 5
};

sandtrooper = {
	'name': 'Sandtrooper',
	'ship': false,
	'sprite': 'sandtrooper',
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': red,
	'weaponOffsetLeft': [0, 4],
	'weaponOffsetUp': [6, 0],
	'weaponOffsetRight': [10, 4],
	'weaponOffsetDown': [3, 7],
	'width': 90 * magnification,
	'height': 55 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 11 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

sebulba = {
	'name': 'Sebulba',
	'ship': false,
	'sprite': 'sebulba',
	'weaponType': 'bomb',
	'weaponOffset': [4, 9],
	'width': 90 * magnification,
	'height': 50 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 10 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

stormtrooper = {
	'name': 'Stormtrooper',
	'ship': false,
	'sprite': 'stormtrooper',
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': red,
	'weaponOffsetLeft': [0, 4],
	'weaponOffsetUp': [6, 0],
	'weaponOffsetRight': [10, 4],
	'weaponOffsetDown': [3, 7],
	'width': 90 * magnification,
	'height': 55 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 11 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

stormtrooperhan = {
	'name': 'Han Solo',
	'ship': false,
	'sprite': 'stormtrooperhan',
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': red,
	'weaponOffsetLeft': [0, 4],
	'weaponOffsetUp': [6, 0],
	'weaponOffsetRight': [10, 4],
	'weaponOffsetDown': [3, 7],
	'width': 90 * magnification,
	'height': 55 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 11 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

stormtrooperluke = {
	'name': 'Luke Skywalker',
	'ship': false,
	'sprite': 'stormtrooperluke',
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': red,
	'weaponOffsetLeft': [0, 4],
	'weaponOffsetUp': [6, 0],
	'weaponOffsetRight': [10, 4],
	'weaponOffsetDown': [3, 7],
	'width': 90 * magnification,
	'height': 55 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 11 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

stuntrooper = {
	'name': 'Stormtrooper',
	'ship': false,
	'sprite': 'stormtrooper',
	'weaponType': 'projectile',
	'projectile': stun,
	'weaponOffsetLeft': [4, 0],
	'weaponOffsetUp': [0, 4],
	'weaponOffsetRight': [6, 0],
	'weaponOffsetDown': [0, 6],
	'weaponDelay': 2,
	'width': 90 * magnification,
	'height': 55 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 11 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

tarkin = {
	'name': 'Grand Moff Tarkin',
	'sprite': 'tarkin',
	'ship': false,
	'weaponType': 'none',
	'width': 90 * magnification,
	'height': 55 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 11 * magnification,
	'moveFrameCount': 8,
	'speed': 4
};

tauntaun = {
	'name': 'Tauntaun',
	'ship': false,
	'sprite': 'tauntaun',
	'weaponType': 'bomb',
	'weaponOffset': [5, 11],
	'width': 90 * magnification,
	'height': 60 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 12 * magnification,
	'moveFrameCount': 8,
	'speed': 10
};

threebee = {
	'name': '3B6-RA-7',
	'sprite': 'threebee',
	'ship': false,
	'death': spritz,
	'weaponType': 'none',
	'width': 72 * magnification,
	'height': 55 * magnification,
	'frameWidth': 8 * magnification,
	'frameHeight': 11 * magnification,
	'moveFrameCount': 8,
	'speed': 5
};

threepio = {
	'name': 'C-3PO',
	'sprite': 'threepio',
	'ship': false,
	'weaponType': 'none',
	'width': 72 * magnification,
	'height': 50 * magnification,
	'frameWidth': 8 * magnification,
	'frameHeight': 10 * magnification,
	'moveFrameCount': 8,
	'speed': 5
};

tiepilot = {
	'name': 'TIE Fighter Pilot',
	'ship': false,
	'sprite': 'tiepilot',
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': red,
	'weaponOffsetLeft': [0, 5],
	'weaponOffsetUp': [2, 0],
	'weaponOffsetRight': [10, 5],
	'weaponOffsetDown': [9, 9],
	'width': 90 * magnification,
	'height': 55 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 11 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

tusken = {
	'name': 'Tusken Raider',
	'ship': false,
	'sprite': 'tusken',
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': red,
	'weaponOffsetLeft': [0, 4],
	'weaponOffsetUp': [7, 0],
	'weaponOffsetRight': [10, 4],
	'weaponOffsetDown': [3, 9],
	'width': 50 * magnification,
	'height': 55 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 11 * magnification,
	'moveFrameCount': 4,
	'speed': 8
};

typho = {
	'name': 'Captain Typho',
	'ship': false,
	'sprite': 'typho',
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': blue,
	'weaponOffsetLeft': [0, 4],
	'weaponOffsetUp': [7, 0],
	'weaponOffsetRight': [10, 4],
	'weaponOffsetDown': [3, 8],
	'width': 90 * magnification,
	'height': 55 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 11 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

uncleowen = {
	'name': 'Uncle Owen',
	'sprite': 'uncleowen',
	'ship': false,
	'death': uncleowendeath,
	'weaponType': 'bomb',
	'weaponOffset': [4, 11],
	'weaponDelay': fps / 2,
	'width': 90 * magnification,
	'height': 48 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 12 * magnification,
	'moveFrameCount': 8,
	'speed': 6
};

vallorum = {
	'name': 'Chancellor Vallorum',
	'sprite': 'vallorum',
	'ship': false,
	'weaponType': 'none',
	'width': 90 * magnification,
	'height': 55 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 11 * magnification,
	'moveFrameCount': 8,
	'speed': 4
};

weequay = {
	'name': 'Weequay',
	'ship': false,
	'sprite': 'weequay',
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': red,
	'weaponOffsetLeft': [0, 4],
	'weaponOffsetUp': [7, 0],
	'weaponOffsetRight': [10, 4],
	'weaponOffsetDown': [3, 8],
	'width': 90 * magnification,
	'height': 55 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 11 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

xwingpilot = {
	'name': 'X-wing Pilot',
	'ship': false,
	'sprite': 'xwingpilot',
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': red,
	'weaponOffsetLeft': [0, 4],
	'weaponOffsetUp': [6, 0],
	'weaponOffsetRight': [10, 4],
	'weaponOffsetDown': [3, 7],
	'width': 90 * magnification,
	'height': 55 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 11 * magnification,
	'moveFrameCount': 8,
	'speed': 8
};

yoda = {
	'name': 'Yoda',
	'sprite': 'yoda',
	'ship': false,
	'weaponType': 'lightsaber',
	'weaponColor': green,
	'weaponOffsetLeft': [0, 4],
	'weaponOffsetUp': [7, 2],
	'weaponOffsetRight': [9, 4],
	'weaponOffsetDown': [1, 9],
	'width': 100 * magnification,
	'height': 50 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 10 * magnification,
	'moveFrameCount': 8,
	'speed': 4
};

//Ships
asteroid = {
	'name': 'Asteroid',
	'sprite': 'asteroid',
	'ship': true,
	'death': spritz,
	'weaponType': null,
	'width': 14 * magnification,
	'height': 28 * magnification,
	'frameWidth': 7 * magnification,
	'frameHeight': 7 * magnification,
	'moveFrameCount': 1,
	'speed': 8
};

deathstar = {
	'name': 'Death Star',
	'sprite': 'deathstar',
	'ship': true,
	'death': explosion,
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': green,
	'weaponOffsetLeft': [2, 3],
	'weaponOffsetUp': [3, 0],
	'weaponOffsetRight': [5, 3],
	'weaponOffsetDown': [3, 5],
	'width': 90 * magnification,
	'height': 40 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 10 * magnification,
	'moveFrameCount': 8,
	'speed': 4,
	'speedMin': 4,
	'speedMax': 4
};

deathstar6 = {
	'name': 'Death Star II',
	'sprite': 'deathstar6',
	'ship': true,
	'death': explosion,
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': green,
	'weaponOffsetLeft': [2, 3],
	'weaponOffsetUp': [3, 0],
	'weaponOffsetRight': [5, 3],
	'weaponOffsetDown': [3, 5],
	'width': 90 * magnification,
	'height': 40 * magnification,
	'frameWidth': 10 * magnification,
	'frameHeight': 10 * magnification,
	'moveFrameCount': 8,
	'speed': 4,
	'speedMin': 4,
	'speedMax': 4
};

destroyer = {
	'name': 'Star Destroyer',
	'sprite': 'destroyer',
	'ship': true,
	'death': explosion,
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': red,
	'weaponOffsetLeft': [16, 14],
	'weaponOffsetUp': [15, 16],
	'weaponOffsetRight': [12, 15 ],
	'weaponOffsetDown': [15, 12],
	'width': 60 * magnification,
	'height': 120 * magnification,
	'frameWidth': 30 * magnification,
	'frameHeight': 30 * magnification,
	'moveFrameCount': 1,
	'speed': 1,
	'speedMin': 1,
	'speedMax': 5
};

falcon = {
	'name': 'Millenium Falcon',
	'sprite': 'falcon',
	'ship': true,
	'death': spritz,
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': green,
	'weaponOffsetLeft': [5, 7],
	'weaponOffsetUp': [7, 6],
	'weaponOffsetRight': [8, 7],
	'weaponOffsetDown': [7, 8],
	'width': 75 * magnification,
	'height': 60 * magnification,
	'frameWidth': 15 * magnification,
	'frameHeight': 15 * magnification,
	'moveFrameCount': 4,
	'speed': 8,
	'speedMin': 8,
	'speedMax': 15
};

tie = {
	'name': 'TIE Fighter',
	'sprite': 'tie',
	'ship': true,
	'death': spritz,
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': red,
	'weaponOffsetLeft': [0, 3],
	'weaponOffsetUp': [3, 0],
	'weaponOffsetRight': [5, 3],
	'weaponOffsetDown': [3, 5],
	'width': 35 * magnification,
	'height': 28 * magnification,
	'frameWidth': 7 * magnification,
	'frameHeight': 7 * magnification,
	'moveFrameCount': 4,
	'speed': 12,
	'speedMin': 8,
	'speedMax': 12
};

vadertie = {
	'name': 'Darth Vader',
	'sprite': 'vadertie',
	'ship': true,
	'death': vadertiedeath,
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': red,
	'weaponOffsetLeft': [0, 3],
	'weaponOffsetUp': [3, 0],
	'weaponOffsetRight': [5, 3],
	'weaponOffsetDown': [3, 5],
	'width': 35 * magnification,
	'height': 28 * magnification,
	'frameWidth': 7 * magnification,
	'frameHeight': 7 * magnification,
	'moveFrameCount': 4,
	'speed': 12,
	'speedMin': 10,
	'speedMax': 12
};

xwing = {
	'name': 'X-wing',
	'sprite': 'xwing',
	'ship': true,
	'death': spritz,
	'weaponType': 'projectile',
	'projectile': 'laser',
	'weaponColor': green,
	'weaponOffsetLeft': [1, 4],
	'weaponOffsetUp': [4, 1],
	'weaponOffsetRight': [8, 4],
	'weaponOffsetDown': [4, 8],
	'width': 45 * magnification,
	'height': 36 * magnification,
	'frameWidth': 9 * magnification,
	'frameHeight': 9 * magnification,
	'moveFrameCount': 4,
	'speed': 8,
	'speedMin': 8,
	'speedMax': 12
};

//Episode IV levels
tantive4 = {
	'name': 'Tantive IV',
	'password': '',
	'cutscene': [
		'preface', 
		'episode4-destroyer'
	],
	'bg': 'metal',
	'textColor': 'black',
	'enemyInterval': 32,
	'enemyCount': 10,
	'enemyDir': 'right',
	'character': rebel,
	'enemy': stormtrooper,
	'boss': officerblack,
	'bossHP': 2
};

ambassador = {
	'name': 'Ambassador',
	'password': '',
	'cutscene': [
		'episode4-antilles'
	],
	'bg': 'metal',
	'textColor': 'black',
	'enemyInterval': 32,
	'enemyCount': 3,
	'enemyDir': 'left',
	'character': stuntrooper,
	'enemy': rebel,
	'boss': leia,
	'bossHP': 1,
	'friendlies': [
		{
			'character': protocolwhite,
			'details': {
				'delay': 5.5 * fps,
				'value': 25,
				'dir': 'down'
			}
		}
	]
};

tatooine = {
	'name': 'Tatooine',
	'password': '',
	'cutscene': [
		'episode4-pod', 
		'episode4-crash'
	],
	'bg': 'sand',
	'textColor': 'black',
	'enemyInterval': 32,
	'enemyCount': 1,
	'obstacles': [
		{
			'type': dragon,
			'x': 50,
			'y': 66
		}
	],
	'character': jawa,
	'enemy': threepio,
	'boss': artoo,
	'bossHP': 1,
	'friendlies': [
		{
			'character': jawa,
			'details': {
				'delay': 1.5 * fps,
				'value': 0 - 500
			}
		},
		{
			'character': jawa,
			'details': {
				'delay': 2.5 * fps,
				'value': 0 - 500
			}
		},
		{
			'character': jawa,
			'details': {
				'delay': 3.5 * fps,
				'value': 0 - 500
			}
		}
	]
};

search = {
	'name': 'Search',
	'password': '',
	'cutscene': [
		'episode4-jawas', 
		'episode4-hologram', 
		'episode4-binoculars'
	],
	'bg': 'sand',
	'textColor': 'black',
	'enemyInterval': 32,
	'enemyCount': 10,
	'obstacles': [
		{
			'type': speeder,
			'x': 33,
			'y': 33
		}
	],
	'character': luke,
	'enemy': tusken,
	'boss': bantha,
	'bossHP': 2,
	'friendlies': [
		{
			'character': threepio,
			'details': {
				'delay': 10.5 * fps,
				'value': 0 - 500
			}
		},
		{
			'character': artoo,
			'details': {
				'delay': 12.5 * fps,
				'value': 0 - 500
			}
		}
	]
};

sandcrawler = {
	'name': 'Sandcrawler',
	'password': 'endor',
	'cutscene': [
		'episode4-tusken'
	],
	'bg': 'rust',
	'textColor': 'black',
	'enemyInterval': 32,
	'enemyCount': 10,
	'character': sandtrooper,
	'enemy': jawa,
	'boss': threebee,
	'bossHP': 2, 
	'friendlies': [
		{
			'character': arfive,
			'details': {
				'delay': 5.5 * fps,
				'value': 25
			}
		},
		{
			'character': gonkdroid,
			'details': {
				'delay': 10.5 * fps,
				'dir': 'left',
				'value': 25
			}
		}
	]
};

farm = {
	'name': 'The Farm',
	'password': '',
	// 'cutscene' : []
	'bg': 'sand',
	'textColor': 'black',
	'enemyInterval': 16,
	'enemyCount': 1,
	'character': sandtrooper,
	'enemy': uncleowen,
	'boss': auntberu,
	'bossHP': 1,
	'obstacles': [
		{
			'type': igloo,
			'x': 66,
			'y': 33
		}
	],
};

mosEisley = {
	'name': 'Mos Eisley',
	'password': '',
	// 'cutscene' : []
	'bg': 'marble',
	'textColor': 'black',
	'enemyInterval': 32,
	'enemyCount': 10,
	'enemyDir': 'right',
	'obstacles': [
		{
			'type': bar,
			'x': 0,
			'y': 50
		},
		{
			'type': table,
			'x': 33,
			'y': 20
		},
		{
			'type': table,
			'x': 66,
			'y': 20
		},
		{
			'type': table,
			'x': 33,
			'y': 80
		},
		{
			'type': table,
			'x': 66,
			'y': 80
		}
	],
	'character': ben,
	'enemy': sandtrooper,
	'boss': pondababa,
	'bossHP': 1,
	'friendlies': [
		{
			'character': chewbacca,
			'details': {
				'delay': 10.5 * fps,
				'value': 0 - 500
			}
		},
		{
			'character': greedo,
			'details': {
				'delay': 30 * fps,
				'value': 25
			}
		}
	]
};

dockingBay = {
	'name': 'Docking Bay 94',
	'password': '',
	// 'cutscene' : []
	'bg': 'dust',
	'textColor': 'black',
	'enemyInterval': 32,
	'enemyCount': 10,
	'obstacles': [
		{
			'type': falconbig,
			'x': 100,
			'y': 0
		}
	],
	'character': hansolo,
	'enemy': sandtrooper,
	'boss': garindan,
	'bossHP': 2
};

alderaan = {
	'name': 'Alderaan',
	'password': '',
	'cutscene': [
		'episode4-tarkin', 
		'episode4-deathstar', 
		'episode4-alderaan'
	],
	'bg': 'space',
	'textColor': yellow,
	'enemyInterval': 48,
	'enemyCount': 10,
	'character': falcon,
	'enemy': asteroid,
	'boss': tie,
	'bossHP': 2
};

detention = {
	'name': 'Detention',
	'password': '',
	// 'cutscene' : []
	'bg': 'dark',
	'textColor': 'black',
	'enemyInterval': 32,
	'enemyCount': 10,
	'obstacles': [
		{
			'type': desks,
			'x': 75,
			'y': 50
		}
	],
	'character': chewbacca,
	'enemy': deathstartrooper,
	'boss': mousedroid,
	'bossHP': 2,
	'friendlies': [
		{
			'character': stormtrooperhan,
			'details': {
				'delay': 1.5 * fps,
				'value': 0 - 500,
				'dir': 'right'
			}
		},
		{
			'character': stormtrooperluke,
			'details': {
				'delay': 1.75 * fps,
				'value': 0 - 500,
				'dir': 'right'
			}
		}
	]
};

tractorBeam = {
	'name': 'Tractor Beam',
	'password': '',
	// 'cutscene' : []
	'bg': 'dark',
	'textColor': 'black',
	'enemyInterval': 32,
	'enemyCount': 10,
	'enemyDir': 'right',
	'obstacles': [
		{
			'type': tractorBeamGenerator,
			'x': 50,
			'y': 0
		}
	],
	'character': ben,
	'enemy': stormtrooper,
	'boss': darthvader,
	'bossHP': 5
};

showdown4 = {
	'name': 'Showdown',
	'password': '',
	// 'cutscene' : []
	'bg': 'dark',
	'textColor': 'black',
	'enemyInterval': 32,
	'enemyCount': 0,
	'character': darthvader,
	'enemy': null,
	'boss': ben,
	'bossHP': 1
};

escape = {
	'name': 'Escape',
	'password': '',
	// 'cutscene' : []
	'bg': 'dark',
	'textColor': 'black',
	'enemyInterval': 32,
	'enemyCount': 10,
	'character': leia,
	'enemy': stormtrooper,
	'boss': tiepilot,
	'bossHP': 2,
	'obstacles': [
		{
			'type': falconbig,
			'x': 100,
			'y': 0
		}
	],
	'friendlies': [
		{
			'character': hansolo,
			'details': {
				'delay': 5.5 * fps,
				'value': 0 - 500
			}
		},
		{
			'character': luke,
			'details': {
				'delay': 10.5 * fps,
				'value': 0 - 500
			}
		},
		{
			'character': chewbacca,
			'details': {
				'delay': 15.5 * fps,
				'value': 0 - 500
			}
		}
	]
};

battleOfYavin = {
	'name': 'The Battle of Yavin',
	'password': '',
	// 'cutscene' : []
	'bg': 'space',
	'textColor': yellow,
	'enemyInterval': 16,
	'enemyCount': 3,
	'character': falcon,
	'enemy': tie,
	'boss': vadertie,
	'bossHP': 2,
	'friendlies': [
		{
			'character': xwing,
			'details': {
				'delay': 5.5 * fps,
				'value': 0 - 500,
				'dir': 'up'
			}
		},
		{
			'character': xwing,
			'details': {
				'delay': 5.5 * fps,
				'value': 0 - 500,
				'dir': 'up'
			}
		},
		{
			'character': xwing,
			'details': {
				'delay': 5.5 * fps,
				'value': 0 - 500,
				'dir': 'up'
			}
		}
	]
};

assaultOnDeathStar = {
	'name': 'Death Star',
	'password': '',
	// 'cutscene' : []
	'bg': 'space',
	'textColor': yellow,
	'enemyInterval': 32,
	'enemyCount': 0,
	'character': xwing,
	'enemy': null,
	'boss': deathstar,
	'bossHP': 10
};

//Episode V levels
hoth = {
	'name': 'Hoth',
	'password': '',
	'bg': 'snow',
	'textColor': 'black',
	'enemyInterval': 32,
	'enemyCount': 10,
	'character': luke5,
	'enemy': tauntaun,//probedroid
	'boss': mousedroid,//wampa
	'bossHP': 2
};

//Episode VI levels
endor = {
	'name': 'Endor',
	'password': '',
	'bg': 'grass',
	'textColor': 'black',
	'enemyInterval': 32,
	'enemyCount': 10,
	'character': ewok,
	'enemy': stormtrooper,
	'boss': darthvader,
	'bossHP': 2
};

test = {
	'name': 'TEST',
	'password': '',
	'bg': 'sand',
	'textColor': 'black',
	'enemyInterval': 16,
	'enemyCount': 10,
	'character': luke,
	'enemy': threepio,
	'boss': auntberu,
	'bossHP': 1,
	'obstacles': [
		{
			'type': igloo,
			'x': 66,
			'y': 33
		}
	]
};

//Master level array
episodes = [];
episodes[0] = [endor];
episodes[1] = [endor];
episodes[2] = [endor];
episodes[3] = [tantive4, ambassador, tatooine, search, sandcrawler, farm, mosEisley, dockingBay, alderaan, detention, tractorBeam, showdown4, escape, battleOfYavin, assaultOnDeathStar];
episodes[4] = [hoth];
episodes[5] = [endor];
	
//Initialize game
(function(){
	game = new Game();
	initHud();
	initMenu('title');
	if(isDebug){
		initDebug();
	}
	loop();
})();

function initDebug(){
	episodes[episode][0] = detention;
}

function initGame(){
	clearStage();
	menuMode = '';
	gameOver = false;
	paused = false;
	scoreText.innerHTML = score;
	initLevel();
}

function initHud(){
	//Add container for buttons
	hud = new Hud();
	
	//Add title text
	title = document.createElement('h1');
	title.id = 'title';
	title.style.position = 'absolute';
	title.style.top = '30%';
	title.style.margin = '0';
	title.style.width = '100%';
	title.style.textAlign = 'center';
	title.style.fontSize = titleSize;
	title.style.zIndex = '10';
	title.style.pointerEvents = 'none';
	title.innerHTML = 'Star Wars';
	hud.selector.appendChild(title);
	
	//Add directions text
	directions = document.createElement('h2');
	directions.id = 'directions';
	directions.style.position = 'absolute';
	directions.style.bottom = '30%';
	directions.style.margin = '0';
	directions.style.width = '100%';
	directions.style.textAlign = 'center';
	directions.style.fontSize = directionSize;
	directions.style.lineHeight = lineHeight;
	directions.style.zIndex = '10';
	directions.style.pointerEvents = 'none';
	directions.innerHTML = clickPrompt;
	hud.selector.appendChild(directions);
	
	//Add score text
	scoreboard = document.createElement('h2');
	scoreboard.id = 'scoreboard';
	scoreboard.style.position = 'absolute';
	scoreboard.style.margin = '0';
	scoreboard.style.padding = '5px';
	scoreboard.style.boxSizing = 'border-box';
	scoreboard.style.width = '100%';
	scoreboard.style.zIndex = '10';
	scoreboard.innerHTML = '';
	hud.selector.appendChild(scoreboard);
	
	//Add score 
	scoreText = document.createElement('span');
	scoreText.id = 'score';
	scoreText.style.cssFloat = 'left';
	scoreText.innerHTML = '';
	scoreboard.appendChild(scoreText);
	
	//Add score 
	victimText = document.createElement('span');
	victimText.id = 'victim';
	victimText.style.cssFloat = 'right';
	victimText.innerHTML = '';
	scoreboard.appendChild(victimText);
	
	if(isMobile){
		//Disable swipe to bounce.
		document.ontouchmove = function(event) {
			event.preventDefault();
			window.scrollTo(0, 0);
		}
		
		//Add container for all buttons
		buttons = document.createElement('div');
		buttons.id = 'buttons';
		buttons.style.display = '';
		buttons.style.position = 'absolute';
		buttons.style.left = '0';
		buttons.style.bottom = '0';
		buttons.style.width = '100%';
		buttons.style.height = '165px';
		buttons.style.zIndex = '100';
		hud.selector.appendChild(buttons);
		
		//Add middle of D-pad
		dpad = document.createElement('div');
		dpad.style.position = 'absolute';
		dpad.style.left = '50px';
		dpad.style.bottom = '50px';
		dpad.style.width = '65px';
		dpad.style.height = '65px';
		dpad.style.backgroundImage = 'url("img/hud/middle.png")';
		dpad.style.opacity = hudOpacity;
		
		//Add buttons to DOM
		btnLeft = document.createElement('div');
		btnLeft.id = 'btnLeft';
		btnLeft.setAttribute('data-key', 'left');
		btnLeft.style.position = 'absolute';
		btnLeft.style.left = '5px';
		btnLeft.style.bottom = '55px';
		btnLeft.style.width = '45px';
		btnLeft.style.height = '55px';
		btnLeft.style.backgroundImage = 'url("img/hud/btnLeft.png")';
		btnLeft.style.opacity = hudOpacity;
		
		btnUp = document.createElement('div');
		btnUp.id = 'btnUp';
		btnUp.setAttribute('data-key', 'up');
		btnUp.style.position = 'absolute';
		btnUp.style.left = '55px';
		btnUp.style.bottom = '115px';
		btnUp.style.width = '55px';
		btnUp.style.height = '45px';
		btnUp.style.backgroundImage = 'url("img/hud/btnUp.png")';
		btnUp.style.opacity = hudOpacity;
		
		btnRight = document.createElement('div');
		btnRight.id = 'btnRight';
		btnRight.setAttribute('data-key', 'right');
		btnRight.style.position = 'absolute';
		btnRight.style.left = '115px';
		btnRight.style.bottom = '55px';
		btnRight.style.width = '45px';
		btnRight.style.height = '55px';
		btnRight.style.backgroundImage = 'url("img/hud/btnRight.png")';
		btnRight.style.opacity = hudOpacity;
		
		btnDown = document.createElement('div');
		btnDown.id = 'btnDown';
		btnDown.setAttribute('data-key', 'down');
		btnDown.style.position = 'absolute';
		btnDown.style.left = '55px';
		btnDown.style.bottom = '5px';
		btnDown.style.width = '55px';
		btnDown.style.height = '45px';
		btnDown.style.backgroundImage = 'url("img/hud/btnDown.png")';
		btnDown.style.opacity = hudOpacity;
		
		btnAttack = document.createElement('div');
		btnAttack.id = 'btnAttack';
		btnAttack.setAttribute('data-key', 'space');
		btnAttack.style.position = 'absolute';
		btnAttack.style.right = '5px';
		btnAttack.style.bottom = '50px';
		btnAttack.style.width = '65px';
		btnAttack.style.height = '65px';
		btnAttack.style.backgroundImage = 'url("img/hud/btnAttack.png")';
		btnAttack.style.opacity = hudOpacity;
		
		btnAttack2 = document.createElement('div');
		btnAttack2.id = 'btnAttack2';
		btnAttack2.setAttribute('data-key', 'Z');
		btnAttack2.style.position = 'absolute';
		btnAttack2.style.right = '75px';
		btnAttack2.style.bottom = '50px';
		btnAttack2.style.width = '65px';
		btnAttack2.style.height = '65px';
		btnAttack2.style.backgroundImage = 'url("img/hud/btnAttack.png")';
		btnAttack2.style.opacity = hudOpacity;
		
		btnStart = document.createElement('div');
		btnStart.id = 'btnStart';
		btnStart.setAttribute('data-key', 'enter');
		btnStart.style.position = 'absolute';
		btnStart.style.left = ((game.width - 75) / 2) + 'px';
		btnStart.style.bottom = '5px';
		btnStart.style.width = '75px';
		btnStart.style.height = '40px';
		btnStart.style.backgroundImage = 'url("img/hud/btnStart.png")';
		btnStart.style.opacity = hudOpacity;
		
		hud.selector.appendChild(buttons);
		buttons.appendChild(dpad);
		buttons.appendChild(btnLeft);
		buttons.appendChild(btnUp);
		buttons.appendChild(btnRight);
		buttons.appendChild(btnDown);
		buttons.appendChild(btnAttack);
		buttons.appendChild(btnAttack2);
		buttons.appendChild(btnStart);
		
		//Init touchscreen controls
		window.addEventListener('touchstart', function(event){
			if(typeof(event.target.getAttribute('data-key')) != 'undefined'){
				buttonPush(event.target.getAttribute('data-key'), event.target.id);
			}
		});
		window.addEventListener('touchmove', function(event){
			event.preventDefault();
			//buttonUpdate(event);
		});
		window.addEventListener('touchend', function(event){
			if(typeof(event.target.getAttribute('data-key')) != 'undefined'){
				buttonRelease(event.target.getAttribute('data-key'), event.target.id);
			}
			
			//Check if touch was released over different d-pad button
			for(var i=0; i<cardinals.length; i++){
				var button = document.querySelector('[data-key="' + cardinals[i] + '"]');
				var bounds = button.getBoundingClientRect();
				if(event.pageX > bounds.left && event.pageX < bounds.right && event.pageY > bounds.top && event.pageY < bounds.bottom){
					//buttonRelease(player.dir, button.id);
				}
			}
		});
		window.addEventListener('resize', function(){
			if(menuMode == '' && !gameOver && !paused){
				pause();
			}
			resizeGame(window.innerWidth, window.innerHeight);
		});
	} else {
		//Init desktop controls
		window.addEventListener('keydown', function(event){
			var key = '';
			var id = '';
			if(!paused){
				switch (event.keyCode){
					case 37: //left
						key = 'left';
						break;
					case 38: //up
						key = 'up';
						break;
					case 39: //right
						key = 'right';
						break;
					case 40: //down
						key = 'down';
						break;
					case 90: //Z
						key = 'Z';
						break;
				}
			}
	
			switch (event.keyCode){
				case 13: //enter
					key = 'enter';
					break;
				case 27: //escape
					key = 'escape';
					break;
				default:
					break;
			}
			if(key != ''){
				buttonPush(key, null);
			}
		});
		window.addEventListener('keypress', function(event){
			var key = '';
			if(event.charCode == 32){//space
				key = 'space';
			}
			if(key != ''){
				buttonPush(key, null);
			}
		});
		window.addEventListener('keyup', function(event){
			var key = '';
			if(!paused){
				switch (event.keyCode){
					case 37: //left
						key = 'left';
						break;
					case 38: //up
						key = 'up';
						break;
					case 39: //right
						key = 'right';
						break;
					case 40: //down
						key = 'down';
						break;
					case 32: //space
						key = 'space';
						break;
					case 90: //Z
						key = 'Z';
						break;
				}
			}
	
			switch (event.keyCode){
				case 13: //enter
					key = 'enter';
					break;
				case 27: //escape
					key = 'escape';
					break;
				default:
					break;
			}
			
			if(key != ''){
				buttonRelease(key, null);
			}
		});
	}
}

function initLevel(){
	stage = new Stage(episodes[episode][level]);
	player = new Player(stage.character);
	game.counter = 0;
	
	if(typeof(episodes[episode][level].obstacles) != 'undefined'){
		for(var obstacle in stage.obstacles){
			obstacle = new Obstacle(stage.obstacles[obstacle]['type'], stage.obstacles[obstacle]['x'], stage.obstacles[obstacle]['y']);
		}
	}
	
	hud.selector.setAttribute('data-key', '');
	title.innerHTML = '';
	directions.innerHTML = '';
	directions.style.fontSize = directionSize;
	scoreboard.style.display = '';
	if(isMobile){
		buttons.style.display = hudStatus;
	}
}

function initMenu(mode){
	menuMode = mode;
	resetMode = false;
	gameOver = true;
	paused = false;
	enemyCount = 0;
	propCount = 0;
	
	invincible = false;
	
	if(mode == 'title'){
		episode = 3;
		level = 0;
		score = 0;
		cutsceneCount = 0;
		
		stage = new Stage(tantive4);
		artoo = new Enemy(artoo);
		threepio = new Enemy(threepio);
		
		for(var i=0; i<5; i++){
			setTimeout(function(){
				if(menuMode == 'title'){
					enemy = new Enemy(stage.enemy);
				}
			}, i * 1000);
		}
		
		hud.selector.setAttribute('data-key', 'enter');
		title.innerHTML = 'Star Wars';
		directions.innerHTML = clickPrompt;
		scoreText.innerHTML = '';
		victimText.innerHTML = '';
		
		if(isMobile){
			hudStatus = buttons.style.display;
			buttons.style.display = 'none';
		}
	} else if(mode == 'episode'){
		/*
		clearStage();
		scoreboard.style.display = '';
		stage = new Stage(tantive4);
		hud.selector.setAttribute('data-key', '');
		title.innerHTML = 'Choose Episode';
		directions.innerHTML = '';
		directions.style.pointerEvents = 'all';
		if(isMobile){
			directions.style.fontSize = titleSize;
		}
		for(var i=0; i<numerals.length; i++){
			btnEpisode = document.createElement('span');
			btnEpisode.id = 'btnEpisode' + numerals[i];
			btnEpisode.style.cursor = 'pointer';
			btnEpisode.setAttribute('data-episode', i);
			btnEpisode.innerHTML = numerals[i];
			if(i != 2 && i != 5){
				btnEpisode.style.marginRight = '40px';
			}
			directions.appendChild(btnEpisode);
			
			if(i == 2){
				breakTag = document.createElement('br');
				directions.appendChild(breakTag);
			}
			
			if(i == episode){
				btnEpisode.style.color = 'white';
			}
			
			btnEpisode.addEventListener('click', function(event){
				episode = Number(this.getAttribute('data-episode'));
				cutsceneCount = 0;
				initMenu('cutscene');
			});
			
			btnEpisode.addEventListener('touchend', function(event){
				episode = Number(this.getAttribute('data-episode'));
				cutsceneCount = 0;
				initMenu('cutscene');
			});
		}
		*/
		initMenu('cutscene');
	} else if(mode == 'cutscene'){
		scoreboard.style.display = 'none';
		hud.selector.setAttribute('data-key', 'enter');
		title.innerHTML = '';
		directions.innerHTML = '';
		directions.style.pointerEvents = 'none';
		if(typeof(episodes[episode][level].cutscene) != 'undefined'){
			clearStage();
			stage = new CutScene(episodes[episode][level].cutscene[cutsceneCount])
		} else {
			initGame();
		}
	}
}

function loop(){
	if(menuMode == '' && !gameOver && !paused){
		if(keys.length > 0){
			if(!player.attacking){
				for(var key in keys){
					if(cardinals.indexOf(keys[key]) != -1){
						player.dir = keys[key];
						player.running = true;
					}
					if(keys[key] == 'space' || keys[key] == 'Z'){
						player.attack(keys[key]);
					}
				}
			}
		}
		
		//Iterate over all enemies
		for(var enemy in enemies){
			if(enemies[enemy].active){
				if(!player.dead){
					if(collision(player, enemies[enemy])){
						if(!invincible){
							player.dead = true;
						}
						enemies[enemy].collide();
					} else if(enemies[enemy].weaponType == 'projectile' && enemies[enemy].weaponReady && crossPaths(enemies[enemy], player)){
						var chance = 500 + episodes[episode].length - level;
						var rand = getRandom(chance);
						if(rand == 0){
							projectile = new Projectile(enemies[enemy]);
						}
					}
				}
				enemies[enemy].update();
				enemies[enemy].draw();
			}
		}
		
		//Iterate over all friendlies
		for(var friendly in friendlies){
			if(friendlies[friendly].ship){
				if(!player.dead && collision(player, friendlies[friendly])){
					if(!invincible){
						player.dead = true;
					}
					friendlies[friendly].kill();
				}
				friendlies[friendly].update();
				friendlies[friendly].draw();
			}
			friendlies[friendly].update();
			friendlies[friendly].draw();
		}
		
		//Iterate over all obstacles
		for(var obstacle in obstacles){
			obstacles[obstacle].update();
			obstacles[obstacle].draw();
		}
		
		//Iterate over all props
		for(var prop in props){
			if(!player.dead && collision(player, props[prop])){
				if(!invincible && props[prop].active && props[prop].origin != player){
					player.dead = true;
					props[prop].dead = true;
				}
				if(props[prop].type == 'lightsaber' && props[prop].speed > 0){
					if(props[prop].active){
						player.attacking = false;
					} else {
						props[prop].active = true;
					}
				}
			}
			
			//Compare all props to all enemies
			for(var enemy in enemies){
				if(!props[prop].dead && !enemies[enemy].dead && props[prop].origin != enemies[enemy] && collision(enemies[enemy], props[prop])){
					enemies[enemy].hit();
					if(props[prop].type != 'lightsaber'){
						props[prop].dead = true;
					}
				}
			}
			
			//Compare all props to all friendlies
			for(var friendly in friendlies){
				if(!props[prop].dead && !friendlies[friendly].dead && collision(friendlies[friendly], props[prop])){
					friendlies[friendly].kill();
					if(props[prop].type != 'lightsaber'){
						props[prop].dead = true;
					}
				}
			}
			
			props[prop].update();
			props[prop].draw();
		}
		
		//Iterate over animations
		for(var animation in animations){
			animations[animation].update();
			animations[animation].draw();
		}
		
		player.update();
		player.draw();
		
		//Check for level completion
		if(stage.enemiesKilled == (stage.enemyCount + 1) && animations.length == 0 && !stage.defeated){
			levelWin();
		}
		
		//Check for level failure
		if(!player.active && animations.length == 0){
			levelLose();
		}
		
		//Check enemy interval
		if(game.counter % stage.enemyInterval == 0){
			if(enemies.length < stage.enemyCount){
				enemy = new Enemy(stage.enemy);
			} else {
				if(stage.enemiesKilled == stage.enemyCount && !stage.bossReached){
					enemy = new Enemy(stage.boss);
					stage.bossReached = true;
				}
			}
		}
		
		//Check friendly delay
		for(var friendly in stage.friendlies){
			if(game.counter == stage.friendlies[friendly].details.delay){
				friend = new Friendly(stage.friendlies[friendly].character, stage.friendlies[friendly].details);
			}
		}
		
		//Check victim identification interval
		if(victimCount > 0){
			victimCount--;
		} else {
			victimText.innerHTML = '';
		}
		
		//Update the game counter
		game.counter++;
	} else if(menuMode == 'title'){
		//Iterate over all enemies
		for(var enemy in enemies){
			enemies[enemy].update();
			enemies[enemy].draw();
		}
	}
	setTimeout(loop, 1000/fps);
}

function adaptCoords(obj){
	if(typeof(obj.leftPercent) != 'undefined' && typeof(obj.topPercent) != 'undefined'){
		if(obj.leftPercent == 0){
			obj.x = 0;
		} else if(obj.leftPercent == 100){
			obj.x = game.width - obj.frameWidth;
		} else {
			obj.x = Math.floor(game.width * (obj.leftPercent / 100) - (obj.frameWidth / 2));
		}
		if(obj.topPercent == 0){
			obj.y = 0;
		} else if(obj.leftPercent == 100){
			obj.y = game.height - obj.frameHeight;
		} else {
			obj.y = Math.floor(game.height * (obj.topPercent / 100) - (obj.frameHeight / 2));
		}
	} else {
		var offsetX = obj.x / (game.width - obj.frameWidth);
		var offsetY = obj.y / (game.height - obj.frameHeight);
		obj.x = Math.floor((window.innerWidth - obj.frameWidth) * offsetX);
		obj.y = Math.floor((window.innerHeight - obj.frameHeight) * offsetY);
	}
	obj.draw();
}

function advanceStage(){
	if(level == episode.length){
		reset();
	} else {
		if(score == 0 || typeof(episodes[episode][level].cutscene) == 'undefined'){
			clearStage();
			initLevel();
		} else {
			cutsceneCount = 0;
			initMenu('cutscene');
		}
	}
}

function buttonPush(key, id){
	if(menuMode == ''){
		if(!player.attacking){
			if(keys.indexOf(key) == -1){
				keys.push(key);
			}
		}
	} else if(menuMode == 'episode' && cardinals.indexOf(key) != -1){
		for(var i=0; i<numerals.length; i++){
			document.getElementById('btnEpisode' + numerals[i]).style.color = 'black';
		}
		if(key == 'left'){
			episode -= 1;
		} else if(key == 'right'){
			episode += 1;
		} else if(key == 'up'){
			episode -= 3;
		} else if(key == 'down'){
			episode += 3;
		}
		episode = (episode < 0) ? 6 + episode : (episode % 6);
		document.getElementById('btnEpisode' + numerals[episode]).style.color = 'white';
	}
	if(buttonNames.indexOf(id) != -1){
		document.getElementById(id).style.opacity = 1;
	}
}

function buttonUpdate(event){
	for(var i=0; i<cardinals.length; i++){
		var previousButton = document.querySelector('[data-key="' + player.dir + '"]');
		var button = document.querySelector('[data-key="' + cardinals[i] + '"]');
		var bounds = button.getBoundingClientRect();
		if(event.changedTouches[0].pageX > bounds.left && event.changedTouches[0].pageX < bounds.right && event.changedTouches[0].pageY > bounds.top && event.changedTouches[0].pageY < bounds.bottom){
			if(keys.indexOf(cardinals[i]) == -1){
				buttonRelease(player.dir, previousButton.id);
				buttonPush(cardinals[i], button.id);
			}
		} else if(keys.indexOf(cardinals[i]) != -1){
			buttonRelease(player.dir, button.id);
		}
	}
}

function buttonRelease(key, id){
	if(key == 'enter'){
		if(resetMode){
			reset();
		} else if(menuMode == 'title'){
			initMenu('episode');
			// cutsceneCount = 0;
			// initMenu('cutscene');
		} else if(menuMode == 'episode'){
			level = 0;
			cutsceneCount = 0;
			initMenu('cutscene');
		} else if(menuMode == 'cutscene'){
			menuMode = '';
			if(isMobile){
				buttons.style.display = hudStatus;
			}
			if(++cutsceneCount < episodes[episode][level].cutscene.length){
				initMenu('cutscene');
			} else {
				if(stage.defeated){
					initLevel();
				} else {
					initGame();
				}
			}
		} else if(gameOver){
			initGame();
			advanceStage();
		} else if(stage.defeated){
			advanceStage();
		} else {
			pause();
		}
		keys.splice(0);
	} else if(key == 'escape'){
		reset();
	}
	position = keys.indexOf(key);
	if(position != -1){
		if(key == 'space'){
			player.attacking = false;
		} else if(key == 'Z'){
		} else {
			player.running = false;
			player.spriteColumn = 0;
		}
		keys.splice(position, 1);
	}
	if(buttonNames.indexOf(id) != -1){
		document.getElementById(id).style.opacity = hudOpacity;
	}
}

function clearStage(){
	game.selector.removeChild(stage.selector);
	enemies.splice(0);
	friendlies.splice(0);
	obstacles.splice(0);
	props.splice(0);
	animations.splice(0);
	keys.splice(0);
	enemyCount = 0;
	propCount = 0;
	
	scoreText.innerHTML = score;
	victimText.innerHTML = '';
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

function crossPaths(obj1, obj2){
	var cross = false;
	var rect1 = obj1.selector.getBoundingClientRect();
	var rect2 = obj2.selector.getBoundingClientRect();
	if(rect1.right > rect2.left && rect1.left < rect2.right){
		if(rect2.bottom < rect1.top && obj1.dir == 'up'){
			cross = true;
		} else if(rect2.top > rect1.bottom && obj1.dir == 'down'){
			cross = true;
		}
	} else if((rect1.bottom > rect2.top && rect1.top < rect2.bottom)){
		if(rect2.right < rect1.left && obj1.dir == 'left'){
			cross = true;
		} else if(rect2.left > rect1.right && obj1.dir == 'right'){
			cross = true;
		}
	}
	return cross;
}

function levelWin(){
	stage.defeated = true;
	directions.innerHTML = startPrompt;
	if(++level == episodes[episode].length){
		gameOver = true;
		resetMode = true;
		title.innerHTML = 'You win!';
	} else {
		title.innerHTML = 'Next:<br/>' + episodes[episode][level].name;
	}
}

function levelLose(){
	gameOver = true;
	score = 0;
	title.innerHTML = 'Game Over';
	directions.innerHTML = 'Press Start<br/>to restart level.';
	keys.splice(0);
}

function importJSON(obj, data){
	for (var prop in data) {
	    if (data.hasOwnProperty(prop)) {
	    	obj[prop] = data[prop];
	    }
	}
}

function inBounds(obj){
	return obj.x > 0 && add(obj.x, obj.frameWidth) < game.width && obj.y > 0 && add(obj.y, obj.frameHeight) < game.height;
}

function getObstruction(obj){
	var obstruction = '';
	
	var charLeft = obj.x;
	var charTop = obj.y + obj.frameHeight - magnification;
	var charRight = obj.x + obj.frameWidth;
	var charBottom = obj.y + obj.frameHeight;
	
	//Iterate over all obstacles
	for(var obstacle in obstacles){
		if(obstacles[obstacle].impassable){
			var obsLeft = obstacles[obstacle].x;
			var obsTop = obstacles[obstacle].y;
			var obsRight = obstacles[obstacle].x + obstacles[obstacle].frameWidth;
			var obsBottom = obstacles[obstacle].y + obstacles[obstacle].frameHeight;
			
			if(obj.dir == 'left' || obj.dir == 'right'){
				if(charBottom > obsTop && charTop < obsBottom){
					if(obj.dir == 'left'){
						if(charLeft - obj.speed < obsRight && charRight > obsLeft){
							obstruction = obstacles[obstacle];
						}
					} else if(obj.dir == 'right'){
						if(charRight + obj.speed > obsLeft && charLeft < obsRight){
							obstruction = obstacles[obstacle];
						}
					}
				}
			} else if(obj.dir == 'up' || obj.dir == 'down'){
				if(charRight > obsLeft && charLeft < obsRight){
					if(obj.dir == 'up'){
						if(charTop - obj.speed < obsBottom && charBottom > obsTop){
							obstruction = obstacles[obstacle];
						}
					} else if(obj.dir == 'down'){
						if(charBottom + obj.speed > obsTop && charBottom < obsBottom){
							obstruction = obstacles[obstacle];
						}
					}
				}
			}
		}
	}
	return obstruction;
}

function pause(){
	if(!paused){
		paused = true;
		title.innerHTML = 'Pause';
	} else {
		paused = false;
		title.innerHTML = '';
		directions.innerHTML = '';
	}
}

function reset(){
	clearStage();
	initMenu('title');
}

function resizeGame(width, height){
	if(menuMode == ''){
		adaptCoords(player);
		for(var enemy in enemies){
			adaptCoords(enemies[enemy]);
		}
		for(var prop in props){
			adaptCoords(props[prop]);
		}
	}
	
	game.width = width;
	game.height = height;
	game.selector.style.width = game.width + 'px';
	game.selector.style.height = game.height + 'px';
	
	if(menuMode == 'cutscene'){
		stage.resize();
	}
	
	for(var obstacle in obstacles){
		adaptCoords(obstacles[obstacle]);
	}
	
	if(game.width > game.height){
		document.getElementById('buttons').style.bottom = ((game.height - document.getElementById('buttons').clientHeight) / 2) + 'px';
		document.getElementById('buttons').style.opacity = '0.5';
	} else {
		document.getElementById('buttons').style.bottom = '0';
		document.getElementById('buttons').style.opacity = '1';
	}
	btnStart.style.left = ((game.width - 75) / 2) + 'px';
}

function updateScore(points){
	score += points;
	scoreText.innerHTML = score;
}

function updateVictim(victim, color){
	victimText.style.color = color;
	victimText.innerHTML = victim.name;
	victimCount = victimDelay;
}

//Utilities
function add(num1, num2){//To distinguish from concatenation operand
	return Number(num1) + Number(num2);
}

function getRandom(max){
	return Math.floor(Math.random() * max);
}

function preload(url) {
	var image = new Image();
	image.src = url;
}

//Cheats
function playAs(obj){
	if(menuMode != ''){
		initGame();
	}
	stage.selector.removeChild(player.selector);
	player = new Player(obj);
}

function playLevel(obj){
	if(typeof(obj) == 'number'){
		if(obj > 0 && obj < episodes[episode].length){
			skipToLevel = obj;
		}
	} else {
		for(var i=0; i<episodes[episode].length; i++){
			if(obj == episodes[episode][i]){
				skipToLevel = i;
			}
		}
	}
	if(typeof(skipToLevel) == 'number'){
		if(menuMode != ''){
			initGame();
		}
		level = skipToLevel;
		clearStage();
		initLevel();
		
		paused = false;
		pause();
	}
}

function useTheForce(){
	invincible = true;
	paused = true;
	directions.innerHTML = 'May the force be with you.<br/></br/>Press Start';
}
