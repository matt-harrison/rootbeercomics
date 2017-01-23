$(function() {
	var searchNav = $('#searchNav');

	$('#btnShowSearch').click(function() {
		$('#archiveNav').hide();
		$('#comicsNav').hide();

		if (searchNav.hasClass('hide')) {
			searchNav.removeClass('hide');
			$('#tag').val('').focus();
		} else {
			searchNav.addClass('hide');
		}
	});

	$('#btnSearch').click(function() {
		searchNav.submit();
	});
});