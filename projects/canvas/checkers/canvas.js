window.onload = function() {
	var boxSize = 40;
	var pieceSize = boxSize*0.8;
	var turn = 'red';
	var enemyArr = new Array();
	
	var stage = new Kinetic.Stage({
		container:"checkers",
		width:boxSize*8,
		height:boxSize*8
	});
	var layer = new Kinetic.Layer();
	
	//build checkerboard
	for(i=0;i<64;i++){
		this.column = Math.floor(i/8);
		this.row = (i%8);
		if((this.column%2 == 0 & this.row%2 == 0) || (this.column%2 == 1 & this.row%2 == 1)){
			this.color = '#c00';
		}else{
			this.color = 'black'; 
		}
		box = new Kinetic.Rect({
			width:boxSize,
			height:boxSize,
			x:this.column*boxSize,
			y:this.row*boxSize,
			fill:this.color
		});
		box.num = i;
		layer.add(box);
	}
	
	var txtCaption = new Kinetic.Text({
		x: stage.width+5,
		y: 5,
		text: "red moves first.",
		fontSize: 10,
		fontFamily: "Arial",
		textFill: "black"
	});
	layer.add(txtCaption);
	
	//distribute black pieces
	var pieceArr = new Array();
	for(i=0;i<12;i++){
		row = Math.floor(i/4);
		col = (i%4);
		if(row%2 == 0){
			nextX = (boxSize*1.5) + col*(boxSize*2);
			nextY = (boxSize/2) + row*boxSize;
		}else{
			nextX = (boxSize*0.5) + col*(boxSize*2);
			nextY = (boxSize/2) + row*boxSize; 
		}
		newBlack = new Kinetic.Group({
			x:nextX,
			y:nextY
		});
		newBlack.num = i; 
		newBlack.column = Math.floor(newBlack.x-(boxSize/2))/boxSize;
		newBlack.row = Math.floor(newBlack.y-(boxSize/2))/boxSize;
		newBlack.color = 'black';
		layer.add(newBlack);
		pieceArr.push(newBlack);
		
		circle = new Kinetic.Circle({
			radius:pieceSize/2,
			stroke:'white',
			strokeWidth:2,
			fill:'black',
			easing:'ease-in-out'
		});
		newBlack.add(circle);
		newBlack.piece = circle;
		
		init(newBlack);
	}
	
	//distribute red pieces
	for(i=0;i<12;i++){
		row = 5+Math.floor(i/4);
		col = (i%4);
		if(row%2 == 0){
			nextX = (boxSize*1.5) + col*(boxSize*2);
			nextY = (boxSize/2) + row*boxSize;
		}else{
			nextX = (boxSize*0.5) + col*(boxSize*2);
			nextY = (boxSize/2) + row*boxSize; 
		}
		newRed = new Kinetic.Group({
			x:nextX,
			y:nextY
		});
		newRed.num = i;
		newRed.column = Math.floor(newRed.x-(boxSize/2))/boxSize;
		newRed.row = Math.floor(newRed.y-(boxSize/2))/boxSize;
		newRed.color = 'red';
		layer.add(newRed);
		pieceArr.push(newRed);
		
		circle = new Kinetic.Circle({
			radius:pieceSize/2,
			stroke:'white',
			strokeWidth:2,
			fill:'red',
			easing:'ease-in-out'
		});
		newRed.add(circle);
		newRed.piece = circle;
		
		init(newRed);
	}
	
	stage.add(layer);
	
	document.getElementById("save").addEventListener("click", function() {
		save();
	}, false);
	
	function init(obj){
		obj.on("mouseover touchstart", function() {
			if(turn == this.color){
				document.body.style.cursor = "pointer";
				this.moveToTop();
				this.draggable(true);
				this.dragMe = true;
				this.oldX = this.x;
				this.oldY = this.y;
			}else{
				this.draggable(false);
				this.dragMe = false;
			}
		});
		obj.on("mouseout touchend", function() {
			document.body.style.cursor = "default";
		});
		obj.on("dragstart", function() {
		});
		obj.on("dragend", function() {
			valid = true;
			
			//snap to grid
			this.x = (boxSize/2) + Math.floor(this.x/boxSize)*boxSize;
			this.y = (boxSize/2) + Math.floor(this.y/boxSize)*boxSize;
			
			/*
			*/
			//assign new position
			this.column = Math.floor(this.x-(boxSize/2))/boxSize;
			this.row = Math.floor(this.y-(boxSize/2))/boxSize;
			
			//landed on red square
			if((this.column%2 == 0 & this.row%2 == 0) || (this.column%2 == 1 & this.row%2 == 1)){
				valid = false;
			}
			
			//landed on previous square
			if(this.x == this.oldX & this.y == this.oldY){
				valid = false;
			}
			
			//landed offstage
			if(this.x>stage.width || this.y>stage.height){
				valid = false;
			}
			
			//moved backward without king
			if(this.king != true & ((this.y>this.oldY & this.color == 'red') || (this.y<this.oldY & this.color == 'black'))){
				valid = false;
			}
			
			//landed in occupied square
			for(i=0;i<pieceArr.length;i++){
				nextPiece = eval(pieceArr[i]);
				if(this.x == nextPiece.x & this.y == nextPiece.y & this != nextPiece){
					valid = false;
				}
			}
			
			//moved beyond one square
			if(valid == true){
				if(Math.abs(this.x-this.oldX) > boxSize || Math.abs(this.y-this.oldY) > boxSize){
					jumpX = null;
					jumpY = null;
					if(this.x-this.oldX == boxSize*2 & this.y-this.oldY == boxSize*2){
						jumpX = this.x-boxSize;
						jumpY = this.y-boxSize;
					}else if(this.x-this.oldX == boxSize*2 & this.y-this.oldY == -boxSize*2){
						jumpX = this.x-boxSize;
						jumpY = this.y+boxSize;
					}else if(this.x-this.oldX == -boxSize*2 & this.y-this.oldY == boxSize*2){
						jumpX = this.x+boxSize;
						jumpY = this.y-boxSize;
					}else if(this.x-this.oldX == -boxSize*2 & this.y-this.oldY == -boxSize*2){
						jumpX = this.x+boxSize;
						jumpY = this.y+boxSize;
					}else{
						valid = false;
					}
					if(jumpX != null){
						jump = false;
						for(i=0;i<pieceArr.length;i++){
							nextPiece = eval(pieceArr[i]);
							if(jumpX == nextPiece.x & jumpY == nextPiece.y & this.color != nextPiece.color){
								nextPiece.transitionTo({
									x:0-boxSize,
									y:0-boxSize,
									alpha:0,
									duration:0
								});
								pieceArr.splice(i,1);
								jump = true;
							}
						}
						if(jump == false){
							valid = false;
						}
					}else{
						valid = false;
					}
				}
			}
			
			//finalize move
			if(valid == false){
				revert(this);
			}else{
				this.draggable(false);
				this.dragMe = false;
				
				//upgrade if piece is legally landed in last row
				if((this.y == (boxSize/2) & this.color == 'red') || (this.y == stage.height-(boxSize/2) & this.color == 'black')){
					this.king = true;
					kingMe(this);
				}
			
				//enemyTurn();
				if(this.color == 'red'){
					turn = 'black';
				}else if(this.color == 'black'){
					turn = 'red';
				}
				
				document.body.style.cursor = "default";
				layer.draw();
			}
		});
	}
	
	function enemyTurn(){
		enemyArr.splice(0);
		for(i=0;i<pieceArr.length;i++){
			nextPiece = eval(pieceArr[i]);
			if(nextPiece.color == 'black'){
				enemyArr.push(nextPiece);
			}
		}
		rand = Math.floor(Math.random()*enemyArr.length);
		piece = eval(enemyArr[rand]);
		piece.transitionTo({
			x:0,
			y:0,
			fill:'blue',
			duration:0
		});
		piece.x = (boxSize/2) + Math.floor(piece.x/boxSize)*boxSize;
		piece.y = (boxSize/2) + Math.floor(piece.y/boxSize)*boxSize;
		piece.column = Math.floor(piece.x-(boxSize/2))/boxSize;
		piece.row = Math.floor(piece.y-(boxSize/2))/boxSize;
		turn = 'red';
	}
	
	function kingMe(group){
		var points = [{
			x:0,
			y:3
		}, {
			x:3,
			y:12
		}, {
			x:21,
			y:12
		}, {
			x:24,
			y:3
		}, {
			x:18,
			y:6
		}, { 
			x:12,
			y:0
		}, {
			x:6,
			y:6
		}, {
			x:0,
			y:3
		}];
		crown = new Kinetic.Polygon({
			centerOffset:{x:12, y:6},
			points:points,
			stroke:'white',
			strokeWidth:2,
			alpha:0
		});
		group.add(crown);
		crown.transitionTo({
			alpha:1,
			duration:0
		});
	}
	
	function revert(group){
		group.transitionTo({
			x:group.oldX,
			y:group.oldY,
			duration:0
		})
		group.column = Math.floor(group.x-(boxSize/2))/boxSize;
		group.row = Math.floor(group.y-(boxSize/2))/boxSize;
	}
	
	function save(){
		stage.toDataURL(function(dataUrl) {
			$('#saved').append('<a href="'+dataUrl+'" target="_blank"><img src="'+dataUrl+'" class="unit mr5 mb5 w50"/><a?');
		});
	}
};