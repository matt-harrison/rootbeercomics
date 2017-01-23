var columns = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'];
var rows    = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'];
var width = columns.length;
var height = rows.length;
var size = width * height;

var carrier = {
	'name': 'Carrier',
	'size': 5
};
var battleship = {
	'name': 'Battleship',
	'size': 4
};
var submarine = {
	'name': 'Submarine',
	'size': 3
};
var destroyer = {
	'name': 'Destroyer',
	'size': 3
};
var patrol = {
	'name': 'Patrol Boat',
	'size': 2
};
var ships = [
	carrier, 
	battleship, 
	submarine, 
	destroyer, 
	patrol
];

var player = [];

for (i=0; i<size; i++) {
	player.push({
		'name': getName(i),
		'column': getColumn(i),
		'row': getRow(i),
		'occupant': '',
		'hit': false
	});
}

addShip(player, 5, carrier, 'horizontal');
addShip(player, 5, battleship, 'vertical');
// addShip(player, 14, submarine, 'horizontal');
// addShip(player, 32, destroyer, 'horizontal');
// addShip(player, 65, patrol, 'horizontal');
draw(player);

function getColumn(id) {
	return id % width;
}

function getRow(id) {
	return Math.floor(id / width);
}

function getName(id) {
	var column = getColumn(id);
	var row = getRow(id);
	return rows[row] + columns[column];
}

function findSquare(grid, id) {
	var targets = [];

	var north = id - height;
	if (checkSquare(player, north)) {
		targets.push(north);
	}

	var west = id - 1;
	if (grid[id].row == grid[west].row && checkSquare(player, west)) {
		targets.push(west);
	}

	var south = id + height;
	if (checkSquare(player, south)) {
		targets.push(south);
	}

	var east = id + 1;
	if (grid[id].row == grid[east].row && checkSquare(player, east)) {
		targets.push(east);
	}

	var rand = Math.floor(Math.random() * targets.length);
	var target = targets[rand];
	return target;
}

function checkSquare(grid, id) {
	var validTarget = true;

	if (id >= 0 && id < size) {
		var square = grid[id];

		if (square.column < 0 || square.column >= width) {
			validTarget = false;
		}
		if (square.row < 0 || square.row >= height) {
			validTarget = false;
		}
	} else {
		validTarget = false;
	}
	return validTarget;
}

function attackSquare(grid, id) {
	var square = grid[id];
	if (square.occupant != '') {
		square.hit = true;
	} else {
		square.miss = true;
	}
}

function checkShip(grid, id, ship, orientation) {
	var validTarget = true;
	var targetId;
	if (orientation == 'horizontal') {
		targetId = id + (ship.size - 1);
		if (!sameRow(grid, id, targetId) || !checkSquare(grid, targetId) || grid[targetId].occupant != '') {
			validTarget = false;
		}
	} else {
		targetId = id + ((ship.size - 1) * width);
		//Only checks last square of ship against other ships
		if (!sameColumn(grid, id, targetId) || !checkSquare(grid, targetId) || grid[targetId].occupant != '') {
			validTarget = false;
		}
	}
	return validTarget;
}

function addShip(grid, id, ship, orientation) {
	var targetId;
	if (checkShip(grid, id, ship, orientation)) {
		for (i=0; i<ship.size; i++) {
			if (orientation == 'horizontal') {
				targetId = id + i;
			} else {
				targetId = id + (i * width);
			}
			grid[targetId].occupant = ship.name;
		}
	} else {
		//alert('INVALID PLACEMENT.');
	}
}

function sameColumn(grid, square1, square2) {
	var columnMatch = true;
	if (square1 < 0 || square1 >= size || square2 < 0 || square2 >= size) {
		columnMatch = false;
	} else if (grid[square1].column != grid[square2].column) {
		columnMatch = false;
	}
	return columnMatch;
}

function sameRow(grid, square1, square2) {
	var rowMatch = true;
	if (square1 < 0 || square1 >= size || square2 < 0 || square2 >= size) {
		rowMatch = false;
	} else if (grid[square1].row != grid[square2].row) {
		rowMatch = false;
	}
	return rowMatch;
}

function draw(grid) {
	document.body.innerHTML = '';

	var player = document.createElement('div');
	player.setAttribute('id', 'player');
	player.style.position = 'absolute';
	document.body.appendChild(player);

	for (i=0; i<grid.length; i++) {
		var symbol = '+';
		if (grid[i].hit) {
			symbol = 'X';
		} else if (grid[i].miss) {
			symbol = ' ';
		} else if (grid[i].occupant != '') {
			symbol = 'O';
		}
		var element = document.createElement('span');
		element.innerHTML = symbol;
		document.getElementById('player').appendChild(element);

		if (grid[i].column == width - 1) {
			var element = document.createElement('br');
			document.getElementById('player').appendChild(element);
		}
	}
}
