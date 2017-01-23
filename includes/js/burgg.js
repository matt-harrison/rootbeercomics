$(document).ready(function(){
	$('.answerBox').click(function() {
		var prompt = $(this).find('.answerPrompt');
		var answer = $(this).find('.answer');
		if (answer.hasClass('hide')) {
			prompt.addClass('hide');
			answer.removeClass('hide');
		} else {
			prompt.removeClass('hide');
			answer.addClass('hide');
		}
	});
});
