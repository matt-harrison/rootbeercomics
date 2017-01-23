//This version intentionally does not respond to player move.

var windowWidth, windowHeight, stageLength, squareLength, gutterLength, fontSize;
var gameOver   = false;
var playerTurn = true;
var firstMove  = true;
var delay      = 2000;//milliseconds

var patterns = [
    [0, 1, 2],
    [3, 4, 5],
    [6, 7, 8],
    [0, 3, 6],
    [1, 4, 7],
    [2, 5, 8],
    [0, 4, 8],
    [2, 4, 6]
];
var prioritySquares = [1, 3, 5, 7];
var record = {
    'win' : 0,
    'loss': 0,
    'draw': 0,
};
var squares = [
    '', '', '',
    '', '', '',
    '', '', ''
];

var ex = 'X';
var oh = 'O';

var colors = {};
colors['grid']    = 'black';
colors['squares'] = 'white';
colors['win']     = 'red';
colors['tie']     = 'gray';
colors[ex]        = 'black';
colors[oh]        = 'black';

init();

function getMove() {
    var bestMoves = getMoves(squares, oh);

    //Favor cardinal patterns where possible.
    if (bestMoves.length > 1) {
        for (var square in bestMoves) {
            var slot = bestMoves[square];
            if (prioritySquares.indexOf(slot) > -1) {
                bestMoves = [slot];
                break;
            }
        }
    }

    //Choose from moves of highest rank.
    var slot = getRandom(0, bestMoves.length);

    makeMove(bestMoves[slot], oh);
    playerTurn = true;
}

function getMoves(data, symbol) {
    var enemy = (symbol == ex) ? oh : ex;
    var bestMoves = [];
    var wins  = [];
    var saves = [];
    var votes = [
        0, 0, 0,
        0, 0, 0,
        0, 0, 0
    ];

    //Determine if move must win or block.
    for (var pattern in patterns) {
        var friends = [];
        var enemies = [];
        var blanks  = [];
        for (var move in patterns[pattern]) {
            var id     = patterns[pattern][move];
            if (data[id] == symbol) {
                friends.push(id);
            } else if (data[id] == enemy) {
                enemies.push(id);
            } else {
                blanks.push(id);
            }
        }

        if (friends.length == 2 && blanks.length == 1) {
            wins.push(blanks[0]);
        } else if (enemies.length == 2 && blanks.length == 1) {
            saves.push(blanks[0]);
        } else if (enemies.length == 0) {
            //If move is not implicit, implement ranking system.
            for (var blank in blanks) {
                var slot = blanks[blank];
                votes[slot]++;
            }
        }
    }

    if (wins.length > 0) {
        bestMoves.push(wins[0]);
    } else if (saves.length > 0) {
        bestMoves.push(saves[0]);
    } else {
        bestMoves = getBestMoves(votes);
    }

    return bestMoves;
}

function getBestMoves(votes) {
    //Ensure that at least one vote has been cast.
    var votesTotal = votes.filter(function(votes) {
        return (votes > 0);
    });

    //If no squares have votes, reset the rankings.
    if (votesTotal.length == 0) {
        votes = [
            0, 0, 0,
            0, 0, 0,
            0, 0, 0
        ];

        //Find all unoccupied squares.
        for (var i in squares) {
            if (squares[i] == '') {
                votes[i]++;
            }
        }
    }

    //Determine squares with highest rank.
    var move = votes[0];
    var bestMoves = [0];
    for (var i = 1; i < votes.length; i++) {
        if (votes[i] == move) {
            bestMoves.push(i);
        } else if (votes[i] > move) {
            move = votes[i];
            bestMoves = [i];
        }
    }

    //Returns an array of all moves of highest rank.
    return bestMoves;
}

function makeMove(id, symbol) {
    squares[id] = symbol;
    checkWin();
    draw();
}

function checkWin() {
    var win;

    //Check for winning X patterns and winning O patterns.
    for (var pattern in patterns) {
        var exes  = 0;
        var ohs   = 0;
        for (var square in patterns[pattern]) {
            if (squares[patterns[pattern][square]] == ex) {
                exes++;
            } else if (squares[patterns[pattern][square]] == oh) {
                ohs++;
            }
        }

        if (exes == 3 || ohs == 3) {
            //End game with winner.
            var outcome = (exes == 3) ? 'win' : 'loss';
            gameOver = true;
            record[outcome]++;

            var winPattern = patterns[pattern];
            setTimeout(function () {
                highlight(winPattern, colors['win']);
            }, 100);
        }
    }

    //Check for cat's games.
    var blankSquares = squares.filter(function(symbol) {
        return (symbol == '');
    });
    if (blankSquares.length == 0) {
        //End game with no winner.
        gameOver = true;
        record['draw']++;
        setTimeout(function () {
            highlight([0, 1, 2, 3, 4, 5, 6, 7, 8], colors['tie']);
        }, 100);
    }
}

function resetGame() {
    gameOver   = false;
    firstMove = !firstMove;
    playerTurn = firstMove;
    squares = [
        '', '', '',
        '', '', '',
        '', '', ''
    ];

    draw();

    //First move alternates between player and computer.
    if (!firstMove) {
        setTimeout(getMove, 250);
    }
}

function getRandom(min, max) {
    return min + Math.floor(Math.random() * (max - min));
}

function init() {
    //Add game board.
    $(document.body).append('<div id="stage"/>');

    //Add squares.
    for (var i in squares) {
        $('#stage').append('<div id="square' + i + '" data-id="' + i + '" class="square"/>');
    }

    //Style squares and add functionality.
    $('.square').css(
        {
            'position'  : 'absolute',
            'text-align': 'center',
            'cursor'    : 'pointer'
        }
    ).click(function() {
        if (gameOver) {
            resetGame();
        } else {
            if (playerTurn) {
                var id = $(this).data('id');
                if (squares[id] == '') {
                    playerTurn = false;
                    makeMove(id, ex);
                    if (!gameOver) {
                        //setTimeout(getMove, delay);
                    }
                }
            }
        }
    })

    //Determine initial browser window size/shape.
    resizeStage();

    //Listen for changes to browser window size/shape.
    $(window).resize(function() {
        resizeStage();
    });
}

function draw() {
    for (var i in squares) {
        var symbol = squares[i];
        $('#square' + i).text(symbol).css('color', colors[symbol]);
    }
}

function highlight(pattern, color) {
    for (var i in pattern) {
        $('#square' + pattern[i]).css('color', color);
    }
}

function resizeStage() {
    windowWidth  = window.innerWidth;
    windowHeight = window.innerHeight;
    stageLength  = Math.floor((windowWidth >= windowHeight) ? windowHeight : windowWidth);
    gutterLength = stageLength * 0.02;
    squareLength = (stageLength - gutterLength) / 3;
    fontSize     = Math.floor(squareLength * (3 / 4));
    $('#stage').css(
        {
            'overflow'        : 'hidden',
            'position'        : 'absolute',
            'top'             : (windowHeight - stageLength) / 2 + 'px',
            'left'            : (windowWidth - stageLength) / 2 + 'px',
            'width'           : stageLength + 'px',
            'height'          : stageLength + 'px',
            'background-color': colors.grid
        }
    );

    $('.square').each(function() {
        var id     = $(this).data('id');
        var row    = Math.floor(id / 3);
        var column = id % 3;
        $(this).css(
            {
                'top'   : (row * squareLength) + (row * gutterLength),
                'left'  : (column * squareLength) + (column * gutterLength),
                'width' : squareLength - gutterLength,
                'height': squareLength - gutterLength,
                'font'  : fontSize + 'px/' + (squareLength - gutterLength) + 'px pressStartK',
                'background-color': colors.squares
            }
        );
    });
};
