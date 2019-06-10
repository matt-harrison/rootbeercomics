//Init game vars
var columns = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
var rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'];
var squares = columns.length * rows.length;
var sideLength = 20;

var carrier = {
	'name': 'Aircraft Carrier',
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

//Prep document
document.body.style.margin = '0';
document.body.style.position = 'relative';

//Init game objects
addGrid('player', 20, 20);
addGrid('enemy', 246, 20);

initPlacementMode('player');

// addShip('enemy', 0, 0, carrier, 'vertical');
// addShip('enemy', 2, 0, battleship, 'vertical');
// addShip('enemy', 4, 0, submarine, 'vertical');
// addShip('enemy', 6, 0, destroyer, 'vertical');
// addShip('enemy', 8, 0, patrol, 'vertical');

function addGrid(name, x, y) {
	var grid = document.createElement('div');
	grid.id = name;
	grid.style.position = 'absolute';
	grid.style.left = x + 'px';
	grid.style.top = y + 'px';
	document.body.appendChild(grid);

	for (var i=0; i<squares; i++) {
		addSquare(name, i);
	}
}

function addSquare(grid, id) {
	var row = Math.floor(id / columns.length);
	var column = id % rows.length;
	var square = document.createElement('div');
	square.setAttribute('data-id', id);
	square.setAttribute('data-column', column);
	square.setAttribute('data-row', row);
	square.setAttribute('data-position', rows[row] + columns[column]);
	square.setAttribute('data-occupant', '');
	square.setAttribute('data-revealed', false);
	square.setAttribute('data-hit', false);
	square.style.position = 'absolute';
	square.style.top = (row * sideLength) + 'px';
	square.style.left = (column * sideLength) + 'px';
	square.style.width = sideLength + 'px';
	square.style.height = sideLength + 'px';
	square.style.borderTop = '1px solid gray';
	square.style.borderLeft = '1px solid gray';
	
	if (column == 9) {
		square.style.borderRight = '1px solid gray';
	}
	if (row == 9) {
		square.style.borderBottom = '1px solid gray';
	}
	
	document.getElementById(grid).appendChild(square);
	
	// square.addEventListener('click', function(){
	// 	console.log(this.getAttribute('data-position'));
	// })
}

function addShip(grid, column, row, type, orientation) {
	for (i=0; i<type.size; i++) {
		var currentColumn = (orientation == 'horizontal') ? add(column, i) : column;
		var currentRow = (orientation == 'vertical') ? add(row, i) : row;
		var query = '#' + grid + ' [data-position="' + rows[currentRow] + columns[currentColumn] + '"]';
		var square = document.querySelector(query);
		var occupant = square.getAttribute('data-occupant');
		square.style.backgroundColor = '#999';
		square.setAttribute('data-occupant', type.name);
	}
}

function checkShip(grid, column, row, type, orientation) {
	if (orientation == 'horizontal' && add(column, type.size) > columns.length) {
		alert(type.name + ' is too long to place in column ' + columns[column] + '.');
	} else if (orientation == 'vertical' && add(row, type.size) > rows.length) {
		alert(type.name + ' is too long to place in row ' + rows[row] + '.');
	} else {
		var noCollision = true;
		for (i=0; i<type.size; i++) {
			var currentColumn = (orientation == 'horizontal') ? add(column, i) : column;
			var currentRow = (orientation == 'vertical') ? add(row, i) : row;
			var query = '#' + grid + ' [data-position="' + rows[currentRow] + columns[currentColumn] + '"]';
			var square = document.querySelector(query);
			var occupant = square.getAttribute('data-occupant');
			if (occupant != '') {
				noCollision = false;
				alert(type.name + ' cannot intersect with ' + occupant + '.');
				break;
			}
		}
	}

	return noCollision;
}

function placeShip(square, type) {
	var grid = document.getElementById('player');
	//var square = event.target;
}

function initPlacementMode(grid) {
	var shipCount = 0;
	for (i=0; i<squares; i++) {
		var query = '#' + grid + ' [data-id="' + i + '"]';
		var square = document.querySelector(query);
		square.addEventListener('click', function () {
			if (checkShip(grid, this.getAttribute('data-column'), this.getAttribute('data-row'), ships[shipCount], 'horizontal')) {
				addShip(grid, this.getAttribute('data-column'), this.getAttribute('data-row'), ships[shipCount], 'horizontal');
				if (shipCount < ships.length - 1) {
					shipCount++;
				} else {
					initGameMode(grid);
				}
			}
		});
	}
}

function initGameMode(grid) {
	for (i=0; i<squares; i++) {
		var query = '#' + grid + ' [data-id="' + i + '"]';
		var square = document.querySelector(query);
		square.removeEventListener('click', placeShip);
	}
	alert('GAME ON.');
}

function add(num1, num2){
	return Number(num1) + Number(num2);
}
