$(function() {
	$('.toggle').click(function() {
		var id = $(this).data('id');

		var target = ($(this).hasClass('final')) ? $('.original[data-id="' + id + '"]') : $('.final[data-id="' + id + '"]');
		if (target.length > 0) {
			$(this).addClass('hide')
			target.removeClass('hide');
		}
	});
});
