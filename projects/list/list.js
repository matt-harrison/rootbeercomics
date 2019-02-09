var data;
var itemsType;

$(function() {
	itemsType = $('#items').data('type');

	getItems(showItems);

	today = new Date;

	$('#month').val(today.getMonth() + 1);
	$('#day').val(today.getDate());
	$('#year').val(today.getFullYear());

	$('#first').click(function() {
		if ($(this).html() == '') {
			$(this).html('X');
		} else {
			$(this).html('');
		}
	});

	$('#btnAdd').click(function(event) {
		event.preventDefault();

		if ($('#fname').val() != '' || $('#lname').val() != '') {
			getItems(addItem);
		}
	});

	$('#title').focus();
});

var addItem = function() {
	item = {
		"title"	: $('#title').val(),
		"month"	: $('#month').val().padStart(2, '0'),
		"day"		: $('#day').val().padStart(2, '0'),
		"year"	: $('#year').val(),
		"first"	: ($('#first').html() == 'X')
	};

	data.items.push(item);

	var payload = {
		data: data,
		fileName: itemsType
	};

	$('#title').val('');
	$('#title').focus();

	$.ajax({
		type: 'POST',
		url: '/projects/list/update.php',
		data: {json: JSON.stringify(payload)}
	}).always(function(e) {
		showItems();
	});
}

var getItems = function(callback) {
	time = new Date().getTime();

	$.getJSON(itemsType + '.json?t=' + time, function(response) {
		data = response;

		if (callback != '') {
			(callback)();
		}
	});
}

var showItems = function() {
	$('#items').html('');

	$.each(data.items, function(key, data) {
		var num = key +1;
		var item = data.title;
		var month, day;

		if (data.first === false) {
			item = '[' + item + ']';
		}

		if (data.month.length == 1) {
			month = '0' + data.month;
		} else {
			month = data.month;
		}

		if (data.day.length == 1) {
			day = '0' + data.day;
		} else {
			day = data.day;
		}

		item += ' (' + month + day + data.year.substr(2, 2) + ')';

		$('#items').prepend('<p>' + num + '. ' + item + '</p>');
	});
}
