/*
TODO: 
	- convert enemies into class
	- add projectile class
	- solve impossible-to-escape overlapping rooms
	
*/

Player = function() {
	this.column = Math.floor(columns / 2);
	this.row = Math.floor(rows / 2);
	this.slot = this.row * rows + this.column;
	this.dir = 'right';
	this.animation = 'oO';
	// this.animation = '|/-\\';
	this.move = function(column, row) {
		var slot = row * rows + column;
		var validated = true;

		//Collision test with walls
		for (var i=0; i<walls.length; i++) {
			if (slot === walls[i]) {
				validated = false;
			}
		}
		
		//Collision test with enemies
		for (var i=0; i<enemies.length; i++) {
			if (slot === enemies[i]) {
				validated = false;
			}
		}

		if (validated) {
			player.column = column;
			player.row = row;
			player.slot = slot;
		}
	}
};

function loop() {
	update();
	draw();
	
	if (!gameOver) {
		var milliseconds = 1000 / fps;
		setTimeout(loop, milliseconds);
		count++;
	}
}

function update() {
	grid = []
	for (var i=0; i<slots; i++) {
		grid.push('.');
	}
	
	//Overwrite wall slots
	for (var i=0; i<walls.length; i++) {
		grid[walls[i]] = 'W';
	}
	
	//Overwrite enemy slots
	for (var i=0; i<enemies.length; i++) {
		grid[enemies[i]] = (count%2) ? 'x' : 'X';
	}
	
	//Overwrite door slots
	for (var i=0; i<doors.length; i++) {
		grid[doors[i]] = 'D';
	}
	
	//Overwrite player slot
	var character = player.animation.substr(count%player.animation.length, 1);
	grid[player.slot] = character;
}

function draw() {
	$('#stage').html('');
	for (var i=0; i<grid.length; i++) {
		//Echo character
		$('#stage').append(grid[i] + ' ');
		
		//Create new row where appropriate
		if (i%columns === (columns - 1)) {
			$('#stage').append('<br/>');
		}
	}
}

function addEnemy(column, row) {
	if (typeof(column) == 'undefined') {
		column = Math.floor(Math.random() * columns);
	}
	if (typeof(row) == 'undefined') {
		row = Math.floor(Math.random() * rows);
	}

	var slot = row * rows + column;
	var duplicate = (enemies.indexOf(slot) !== -1);

	if (slot === player.slot) {
		duplicate = true;
	}

	for (var i=0; i<walls.length; i++) {
		if (slot === walls[i]) {
			duplicate = true;
		}
	}

	if (duplicate) {
		addEnemy();
	} else {
		enemies.push(slot);
	}
};

function addWall(column, row, width, height) {
	column = (typeof(column) == 'undefined') ? Math.floor(Math.random() * (columns - 3)) : column;
	row = (typeof(row) == 'undefined') ? Math.floor(Math.random() * (rows - 3)) : row;
	width = (typeof(width) == 'undefined') ? Math.floor(Math.random() * (columns - column - 3)) + 3 : width;
	height = (typeof(height) == 'undefined') ? Math.floor(Math.random() * (rows - row - 3)) + 3 : height;

	var wall = [];

	//Add horizontal walls
	for (var i=0; i<width; i++) {
		//Add top wall
		var slot = row * rows + column + i;
		wall.push(slot);

		//Add bottom wall
		if (i > 0 && i < (width - 1)) {
			slot += columns * (height - 1);
			wall.push(slot);
		}
	}

	//Add vertical walls
	for (var i=1; i<height; i++) {
		//Add left wall
		var slot = row * rows + column + (columns * i);
		wall.push(slot);

		//Add right wall
		slot += width - 1;
		wall.push(slot);
	}

	var doorable = [];
	for (var i=0; i<wall.length; i++) {
		var x = wall[i] % columns;
		var y = Math.floor(wall[i] / rows);
		if (!
			(
				//No doors on stage perimeter
				x === 0 ||
				x === (columns - 1) ||
				y === 0 ||
				y === (rows - 1) ||
				//No doors in room corners
				(x === column && y === row) ||
				(x === column && y === (row + height - 1)) ||
				(x === (column + width - 1) && y === row) ||
				(x === (column + width - 1) && y === (row + height - 1))
			)
		) {
			doorable.push(wall[i]);
		}
	}

	var validated = true;

	for (var i=0; i<walls.length; i++) {
		for (var x=0; x<wall.length; x++) {
			if (wall[x] === walls[i]) {
				//validated = false;
			}
		}
	}

	//Prevent walls from overlapping with player
	if (wall.indexOf(player.slot) !== -1) {
		validated = false;
	}

	if (validated) {
		var slot = Math.floor(Math.random() * doorable.length);
		var door = doorable[slot];

		for (var i=0; i<wall.length; i++) {
			if (door === wall[i]) {
				wall.splice(i, 1);
			}
		}

		walls = walls.concat(wall);
		doors.push(door);
	} else {
		addWall();
	}
}

//Game vars
var fps = 8;
var rows = 20;
var columns = 20;
var slots = rows * columns;
var gameOver = false;
var count = 0;
var grid = [];
var doors= [];
var enemies = [];
var walls= [];
var player = new Player();

//Dynamic vars
var enemyCount = Math.floor(slots * 0.01);
var roomCount = Math.floor(slots * 0.005) + 1;
console.log(roomCount);

//Key listeners
window.addEventListener('keydown', function(event) {
	switch (event.keyCode) {
		case 37: //left
			if (player.column > 0) {
				player.dir = 'left';
				player.move(player.column - 1, player.row);
			}
			break;
		case 38: //up
			if (player.row > 0) {
				player.dir = 'up';
				player.move(player.column, player.row - 1);
			}
			break;
		case 39: //right
			if (player.column < (columns - 1)) {
				player.dir = 'right';
				player.move(player.column + 1, player.row);
			}
			break;
		case 40: //down
			if (player.row < (rows - 1)) {
				player.dir = 'down';
				player.move(player.column, player.row + 1);
			}
			break;
		case 32: //space
			break;
		case 13: //enter
			gameOver = !gameOver;
			if (!gameOver) {
				loop();
			}
			break;
	}
});

//Init
for (var i=0; i<roomCount; i++) {
	addWall();
}

for (var i=0; i<enemyCount; i++) {
	addEnemy();
}

loop();
