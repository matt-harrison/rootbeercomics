$(function(){
	getBooks(showBooks);
	
	today = new Date;
	$('#month').val(today.getMonth() + 1);
	$('#day').val(today.getDate());
	$('#year').val(today.getFullYear());
	
	$('#first').click(function(){
		if($(this).html() == ''){
			$(this).html('X');
		} else {
			$(this).html('');
		}
	});
	$('#btnAdd').click(function(event){
		event.preventDefault();
		if($('#fname').val() != '' || $('#lname').val() != ''){
			getBooks(addBook);
		}
	});
	
	$('#title').focus();
});

var addBook = function(){
	book = {
		"title": $('#title').val(), 
		"month": $('#month').val(), 
		"day": $('#day').val(), 
		"year": $('#year').val(), 
		"first": ($('#first').html() == 'X')
	};
	bookData.books.push(book);
	$('#title').val('');
	$('#title').focus();
	var json = JSON.stringify(bookData);
	$.ajax({
		type: 'POST',
		url: 'set-json.php',
		data: {json: json}
	}).always(function(e){
		showBooks();
	});
}

var getBooks = function(callback){
	time = new Date().getTime();
	$.getJSON('json/books.json?t=' + time, function(data){
		bookData = data;
		books = data.books;
		if(callback != ''){
			(callback)();
		}
	});
}

var showBooks = function(){
	$('#books').html('');
	$.each(books, function(key, data){
		var num = key +1;
		var book = data.title;
		var month, day;
		if(data.first === false){
			book = '[' + book + ']';
		}
		if(data.month.length == 1){
			month = '0' + data.month;
		} else {
			month = data.month;
		}
		if(data.day.length == 1){
			day = '0' + data.day;
		} else {
			day = data.day;
		}
		book += ' (' + month + day + data.year.substr(2, 2) + ')';
		$('#books').prepend('<p>' + num + '. ' + book + '</p>');
	});
}