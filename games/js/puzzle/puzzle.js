/*
    TO DO:
    - click through empty parts of higher div
    - move on collision
*/

squareLength = 20;
gameWidth = (window.innerWidth < 800) ? window.innerWidth : 800;
gameHeight = (window.innerHeight < 800) ? window.innerHeight : 800;
currentPiece = '';
clickCount = 0;

pieces = [
    {
        'id': 'box',
        'color': '#000',
        'width': 10,
        'height': 10,
        'position': [0, 0],
        'squares': [
            [0, 0],
            [1, 0],
            [2, 0],
            [3, 0],
            [4, 0],
            [5, 0],
            [6, 0],
            [7, 0],
            [8, 0],
            [9, 0],
            
            [0, 1],
            [0, 2],
            [0, 3],
            [0, 4],
            [0, 5],
            [0, 6],
            [0, 7],
            [0, 8],
            
            [9, 1],
            [9, 2],
            [9, 3],
            [9, 4],
            [9, 5],
            [9, 6],
            [9, 7],
            [9, 8],
            
            [0, 9],
            [1, 9],
            [2, 9],
            [3, 9],
            [4, 9],
            [5, 9],
            [6, 9],
            [7, 9],
            [8, 9],
            [9, 9]
        ]
    },
    {
        'id': 'cross',
        'color': '#f00',
        'width': 3,
        'height': 3,
        'squares': [
            [1, 0],
            [0, 1],
            [1, 1],
            [2, 1],
            [1, 2]
        ]
    },
    {
        'id': 'line',
        'color': '#0f0',
        'width': 5,
        'height': 1,
        'squares': [
            [0, 0],
            [1, 0],
            [2, 0],
            [3, 0],
            [4, 0]
        ]
    },
    {
        'id': 'cave',
        'color': '#00f',
        'width': 2,
        'height': 3,
        'squares': [
            [0, 0],
            [0, 1],
            [1, 0],
            [0, 2],
            [1, 2]
        ]
    },
    {
        'id': 'ell',
        'color': '#ff0',
        'width': 4,
        'height': 2,
        'squares': [
            [0, 0],
            [1, 0],
            [2, 0],
            [3, 0],
            [0, 1]
        ]
    },
    {
        'id': 'branch',
        'color': '#f0f',
        'width': 4,
        'height': 2,
        'squares': [
            [0, 0],
            [1, 0],
            [2, 0],
            [3, 0],
            [2, 1]
        ]
    },
    {
        'id': 'stairs',
        'color': '#0ff',
        'width': 3,
        'height': 3,
        'squares': [
            [1, 0],
            [2, 0],
            [0, 1],
            [1, 1],
            [0, 2]
        ]
    },
    {
        'id': 'block',
        'color': '#92278f',
        'width': 3,
        'height': 2,
        'squares': [
            [0, 0],
            [1, 0],
            [2, 0],
            [0, 1],
            [1, 1]
        ]
    },
    {
        'id': 'snake',
        'color': '#f7941d',
        'width': 3,
        'height': 3,
        'squares': [
            [2, 0],
            [0, 1],
            [1, 1],
            [2, 1],
            [0, 2]
        ]
    },
    {
        'id': 'eff',
        'color': '#603913',
        'width': 3,
        'height': 3,
        'squares': [
            [1, 0],
            [2, 0],
            [0, 1],
            [1, 1],
            [1, 2]
        ]
    },
    {
        'id': 'corner',
        'color': '#f26d7d',
        'width': 3,
        'height': 3,
        'squares': [
            [0, 0],
            [1, 0],
            [2, 0],
            [0, 1],
            [0, 2]
        ]
    },
    {
        'id': 'tee',
        'color': '#aba000',
        'width': 3,
        'height': 3,
        'squares': [
            [0, 0],
            [1, 0],
            [2, 0],
            [1, 1],
            [1, 2]
        ]
    },
    {
        'id': 'crook',
        'color': '#898989',
        'width': 4,
        'height': 2,
        'squares': [
            [0, 0],
            [1, 0],
            [2, 0],
            [2, 1],
            [3, 1]
        ]
    }
];

Piece = function(data){
    this.id = data.id;
    this.width = data.width;
    this.height = data.height;
    this.color = data.color;
    this.squares = data.squares;
    
    if(typeof(data.position) == 'undefined'){
        boxWidth = box.width * squareLength;
        boxHeight = box.height * squareLength;
        if(Math.floor(Math.random() * 2) == 0){
            this.x = boxWidth + Math.floor(Math.random() * (gameWidth - boxWidth - (this.width * squareLength)));
            this.y = Math.floor(Math.random() * (gameHeight - (this.height * squareLength)));
        } else {
            this.x = Math.floor(Math.random() * (gameWidth - (this.width * squareLength)));
            this.y = boxHeight + Math.floor(Math.random() * (gameHeight - boxHeight - (this.height * squareLength)));
        }
    } else {
        this.x = data.position[0];
        this.y = data.position[1];
    }
    
    this.selector = document.createElement('div');
    this.selector.id = this.id;
    this.selector.style.position = 'absolute';
    this.selector.style.opacity = '0.75';
    document.body.appendChild(this.selector);
    
    for(var i=0; i<this.squares.length; i++){
        var newSquare = Square(this, i);
    }
    
    this.align = function(){
        this.x = Math.round(this.x / squareLength) * squareLength;
        this.y = Math.round(this.y / squareLength) * squareLength;
    }
    
    this.turn = function(){
        var oldWidth = this.width;
        var oldHeight = this.height;
        this.width = oldHeight;
        this.height = oldWidth;
        
        for(var i=0; i<this.squares.length; i++){
            var square = document.getElementById(this.id + i);
            this.selector.removeChild(square);
            var oldX = this.squares[i][0];
            var oldY = this.squares[i][1];
            
            this.squares[i][0] = oldHeight - 1 - oldY;
            this.squares[i][1] = oldX;
            
            var newSquare = Square(this, i);
        }
    }
    
    this.flip = function(){
        for(var i=0; i<this.squares.length; i++){
            var square = document.getElementById(this.id + i);
            this.selector.removeChild(square);
            var oldX = this.squares[i][0];
            var oldY = this.squares[i][1];
            
            this.squares[i][0] = (this.width - 1) - this.squares[i][0];
            
            var newSquare = Square(this, i);
        }
    }
    
    this.draw = function(){
        this.selector.style.width = (this.width * squareLength) + 'px';
        this.selector.style.height = (this.height * squareLength) + 'px';
        this.selector.style.left = this.x + 'px';
        this.selector.style.top = this.y + 'px';
        this.selector.style.zIndex = '-1';
    }
    
    this.align();
    this.draw();
}

Square = function(piece, id){
    var square = document.createElement('div');
    square.style.position = 'absolute';
    square.id = piece.id + id;
    square.style.left = piece.squares[id][0] * squareLength + 'px';
    square.style.top = piece.squares[id][1] * squareLength + 'px';
    square.style.width = squareLength + 'px';
    square.style.height = squareLength + 'px';
    square.style.backgroundColor = piece.color;
    square.style.zIndex = '100';
    document.getElementById(piece.id).appendChild(square);
    
    var _piece = piece;
    square.addEventListener('mousedown', function(event){
        dragPress(_piece);
    });
    square.addEventListener('touchstart', function(event){
        event.preventDefault();
        dragPress(_piece);
    });
}

for(var piece in pieces){
    window[pieces[piece].id] = new Piece(pieces[piece]);
}

document.addEventListener('mousemove', function(event){
    event.preventDefault();
    dragMove(event.clientX, event.clientY);
});
document.addEventListener('mouseup', function(event){
    event.preventDefault();
    dragRelease(event, event.clientX, event.clientY);
});
document.addEventListener('touchmove', function(event){
    event.preventDefault();
    dragMove(event.pageX, event.pageY);
});
document.addEventListener('touchend', function(event){
    event.preventDefault();
    dragRelease(event, event.pageX, event.pageY);
});
window.addEventListener('contextmenu', function(event){
    event.preventDefault();
    event.preventDefault();
    dragRelease(event);
});

function dragPress(piece){
    piece.previous_x = piece.x;
    piece.previous_y = piece.y;
    currentPiece = piece;
}

function dragMove(mouseX, mouseY){
    if(currentPiece != ''){
        currentPiece.x = mouseX - (currentPiece.width * squareLength) / 2;
        currentPiece.y = mouseY - (currentPiece.height * squareLength) / 2;
        currentPiece.draw();
    }
}

function dragRelease(event, mouseX, mouseY){
    if(currentPiece != ''){
        if(currentPiece.x == currentPiece.previous_x && currentPiece.y == currentPiece.previous_y){
            if(event.which == 3){
                currentPiece.flip();
            } else {
                if(++clickCount == 2){
                    clickCount = 0;
                    clearTimeout(turnTimeout);
                    currentPiece.flip();
                } else {
                    turnTimeout = setTimeout(function(piece, mouseX, mouseY){
                        clickCount = 0;
                        piece.turn();
                        piece.x = mouseX - (piece.width * squareLength) / 2;
                        piece.y = mouseY - (piece.height * squareLength) / 2;
                        piece.align();
                        piece.draw();
                    }, 250, currentPiece, mouseX, mouseY);
                }
            }
        }
        currentPiece.align();
        currentPiece.draw();
    }
    currentPiece = '';
}
