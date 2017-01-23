//Init game vars
var gameOver = false;
var fps = 32;//Frames per second
var frameRate = 1000 / fps;//Frames per milliseconds
var speed = 15;
var balls = [];
var bricks = [];

var stage = {
	width: window.innerWidth,
	height: window.innerHeight,
	update: function() {
		this.width = window.innerWidth;
		this.height = window.innerHeight;
	}
};

var columns = 5;
var rows = 3;
var brickCount = rows * columns;
var brickSpacing = 5;
var bricksWidth = stage.width - ((columns - 1) * brickSpacing);
var brickWidth = Math.floor(bricksWidth / columns);
var brickHeight = Math.floor(brickWidth / 3);

var Ball = function(color) {
	this.id = color;
	this.color = color;
	this.x = Math.floor(stage.width / 2);
	this.y = Math.floor(stage.height / 2);
	this.radius = 10;
	this.xSpeed = speed;
	this.ySpeed = speed;
	this.edges = {
		top: 0,
		right: 0,
		bottom: 0,
		left: 0
	};

	var element = document.createElement('div');
	element.id = this.id;
	element.style.position = 'absolute';
	element.style.top = this.y + 'px';
	element.style.left = this.x + 'px';
	element.style.margin = '-' + this.radius + 'px 0 0 -' + this.radius + 'px';
	element.style.borderRadius = this.radius + 'px';
	element.style.width = (this.radius * 2) + 'px';
	element.style.height = (this.radius * 2) + 'px';
	element.style.backgroundColor = this.color;
	//element.style.opacity = 0.75;
	document.body.appendChild(element);

	this.getPosition = function() {
		this.edges.top = this.y - this.radius
		this.edges.right = this.x + this.radius;
		this.edges.bottom = this.y + this.radius;
		this.edges.left = this.x - this.radius;
	};
	this.reverseX = function(surface) {
		if (this.xSpeed > 0) {
			this.x = surface - this.radius;
			this.xSpeed = 0 - this.xSpeed;
		} else {
			this.x = surface + this.radius;
			this.xSpeed = Math.abs(this.xSpeed);
		}
	}
	this.reverseY = function(surface) {
		if (this.ySpeed > 0) {
			this.y = surface - this.radius;
			this.ySpeed = 0 - this.ySpeed;
		} else {
			this.y = surface + this.radius;
			this.ySpeed = Math.abs(this.ySpeed);
		}
	}
	this.collisionCheck = function(obj) {
		var collision = {
			any: false,
			top: false,
			right: false,
			bottom: false,
			right: false
		};
		if (
			(this.edges.left + this.xSpeed) < obj.edges.right && 
			(this.edges.right) > obj.edges.left
		) {
			if (this.edges.top >= obj.edges.bottom && this.edges.top + this.ySpeed <= obj.edges.bottom) {
				collision.bottom = true;
			}
			if (this.edges.bottom <= obj.edges.top && this.edges.bottom + this.ySpeed >= obj.edges.top) {
				collision.top = true;
			}
		}
		if (
			(this.edges.top + this.ySpeed) < obj.edges.bottom && 
			(this.edges.bottom + this.ySpeed) > obj.edges.top
		) {
			if (this.edges.left >= obj.edges.right && this.edges.left + this.xSpeed <= obj.edges.right) {
				collision.right = true;
			}
			if (this.edges.right <= obj.edges.left && this.edges.right + this.xSpeed >= obj.edges.left) {
				collision.left = true;
			}
		}
		collision.any = (collision.top || collision.right || collision.bottom || collision.left);

		return collision;
	}
	this.update = function() {
		this.getPosition();

		//Test horizontal stage edges
		if (this.xSpeed > 0) {
			if (this.edges.right + this.xSpeed < stage.width
			) {
				this.x += this.xSpeed;
			} else {
				this.reverseX(stage.width);
			}
		} else {
			if (this.edges.left + this.xSpeed > 0
			) {
				this.x += this.xSpeed;
			} else {
				this.reverseX(0);
			}
		}

		//Test vertical stage edges
		if (this.ySpeed > 0) {
			if (this.edges.bottom + this.ySpeed < stage.height
			) {
				this.y += this.ySpeed;
			} else {
				this.reverseY(stage.height);
			}
		} else {
			if (this.edges.top + this.ySpeed > 0
			) {
				this.y += this.ySpeed;
			} else {
				this.reverseY(0);
			}
		}
		
		for (nextBrick=0; nextBrick<bricks.length; nextBrick++) {
			var brick = window['brick' + bricks[nextBrick]];
			var collision = this.collisionCheck(brick);
			if (collision.any) {
				if (collision.top) {
					this.reverseY(brick.edges.top);
				}
				if (collision.right) {
					this.reverseX(brick.edges.right);
				}
				if (collision.bottom) {
					this.reverseY(brick.edges.bottom);
				}
				if (collision.left) {
					this.reverseX(brick.edges.left);
				}
				brick.kill();
				bricks.splice(nextBrick, 1);
			}
		}
	};
	this.draw = function() {
		document.getElementById(this.id).style.top = this.y + 'px';
		document.getElementById(this.id).style.left = this.x + 'px';
		if (gameOver) {
			alert('game over.');
		}
	};
	
	balls.push(this.id);
};

var Brick = function(index) {
	this.id = index;
	this.column = index % columns;
	this.row = Math.floor(index / columns);
	this.width = brickWidth;
	this.height = brickHeight;
	this.x = (this.column * this.width) + (this.column * brickSpacing);
	this.y = (this.row * this.height) + (this.row * brickSpacing);
	this.edges = {
		top: this.y,
		right: this.x + this.width,
		bottom: this.y + this.height,
		left: this.x
	};

	var element = document.createElement('div');
	element.id = 'brick' + this.id;
	element.style.position = 'absolute';
	element.style.left = this.x + 'px';
	element.style.top = this.y + 'px';
	element.style.width = brickWidth + 'px';
	element.style.height = brickHeight + 'px';
	element.style.backgroundColor = 'blue';
	document.body.appendChild(element);

	this.kill = function() {
		var brick = document.getElementById('brick' + this.id);
		document.body.removeChild(brick);
	}

	bricks.push(this.id);
}

//Game loop mechanism
function animate() {
	if (!gameOver) {
		for (i=0; i<balls.length; i++) {
			window[balls[i]].update();
			window[balls[i]].draw();
		}
	}
	timer = setTimeout(animate, frameRate);
}

function initBricks() {
	for (i=0; i<brickCount; i++) {
		window['brick' + i] = new Brick(i);
	}
}

//Update stage size properties when window size changes.
window.addEventListener('resize', function () {
	stage.update();
});

//Listen for keyboard input
window.addEventListener('keydown', function (event) {
	if (event.which == 32) {//Spacebar
		gameOver = !gameOver;
	} else if (event.which == 37) {//Left arrow
		console.log('LEFT');
	} else if (event.which == 39) {//Right arrow
		console.log('RIGHT');
	}
});

initBricks();
var red = new Ball('red');
var timer = setTimeout(animate, frameRate);//Kick off game loop