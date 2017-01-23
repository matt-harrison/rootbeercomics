$(document).ready(function(){
	$('.thumb').mouseover(function(event){
		var title = $(event.target).attr('data-title');
		$('#tooltip>span').html(title);
		$('#tooltip').removeClass('hide').addClass('dBlock');
		getPos(event);
	});
	$('.link').mouseover(function(event){
		var src = $(event.target).attr('data-thumb');
		var thumb = $('#tooltip>img');
		thumb.attr('src', src);
		thumb.load(function(){
			getPos(event);
			$('#tooltip').removeClass('hide').addClass('dBlock');
		});
	});
	$('.thumb, .link').mouseout(function(){
		$('#tooltip>img').attr('src', '');
		$('#tooltip>span').html('');
		$('#tooltip').removeClass('dBlock').addClass('hide');
	});
	$('.thumb, .link').mousemove(function(event){
		getPos(event);
	});
});

function getPos(event){
	var mid = Math.round($(window).height()/2);
	var hover = event.pageY - $(document).scrollTop();
	var x = event.pageX + 20;
	if(hover < mid){
		var y = event.pageY + 5;
	} else {
		var y = event.pageY - $('#tooltip').height() - 5;
	}
	$('#tooltip').css('left', x).css('top', y);
}
