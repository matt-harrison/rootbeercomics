$(function(){
	getComics(showComics);
	
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
			getComics(addComic);
		}
	});
	
	$('#title').focus();
});

var addComic = function(){
	comic = {
		"title": $('#title').val(), 
		"month": $('#month').val(), 
		"day": $('#day').val(), 
		"year": $('#year').val(), 
		"first": ($('#first').html() == 'X')
	};
	comicData.comics.push(comic);
	$('#title').val('');
	$('#title').focus();
	var json = JSON.stringify(comicData);
	$.ajax({
		type: 'POST',
		url: 'set-json.php',
		data: {json: json}
	}).always(function(e){
		showComics();
	});
}

var getComics = function(callback){
	time = new Date().getTime();
	$.getJSON('json/comics.json?t=' + time, function(data){
		comicData = data;
		comics = data.comics;
		if(callback != ''){
			(callback)();
		}
	});
}

var showComics = function(){
	$('#comics').html('');
	$.each(comics, function(key, data){
		var num = key +1;
		var comic = data.title;
		var month, day;
		if(data.first === false){
			comic = '[' + comic + ']';
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
		comic += ' (' + month + day + data.year.substr(2, 2) + ')';
		$('#comics').prepend('<p>' + num + '. ' + comic + '</p>');
	});
}