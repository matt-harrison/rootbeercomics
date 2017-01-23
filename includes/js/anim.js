$(document).ready(function(){
	$('#anim>img').load(function(){
		x = 0;
		imgWidth = $('#anim>img').width() * window.zoom;
		frameWidth = (imgWidth/8);
		$('.resize').css('width', frameWidth).removeClass('invisible');
		$('#anim>img').css('width', imgWidth);
	});
	$('#playBackward').click(function(){
		spin = 'clock';
		stepBackward();
	});
	$('#stepBackward').click(function(){
		spin = '';
		stepBackward();
	});
	$('#stop').click(function(){
		clearInterval(int);
		spin = '';
	});
	$('#stepForward').click(function(){
		spin = '';
		stepForward();
	});
	$('#playForward').click(function(){
		spin = 'cclock';
		stepForward();
	});
	function stepBackward(){
		if(typeof int != 'undefined'){
			clearInterval(int);
		}
		if(x < 0){
			x += frameWidth;
		} else {
			x = frameWidth-imgWidth;
		}
		$('.anim>img').css('margin-left', x);
		if(spin == 'clock'){
			int = setTimeout(stepBackward, 1000/8);
		}
	}
	function stepForward(){
		if(typeof int != 'undefined'){
			clearInterval(int);
		}
		if(x > frameWidth-imgWidth){
			x -= frameWidth;
		} else {
			x = 0;
		}
		$('.anim>img').css('margin-left', x);
		if(spin == 'cclock'){
			int = setTimeout(stepForward, 1000/8);
		}
	}
});