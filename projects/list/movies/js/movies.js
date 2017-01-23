$(function(){
	getMovies(showMovies);
	
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
			getMovies(addMovie);
		}
	});
	
	$('#title').focus();
});

var addMovie = function(){
	movie = {
		"title": $('#title').val(), 
		"month": $('#month').val(), 
		"day": $('#day').val(), 
		"year": $('#year').val(), 
		"first": ($('#first').html() == 'X')
	};
	movieData.movies.push(movie);
	$('#title').val('');
	$('#title').focus();
	var json = JSON.stringify(movieData);
	$.ajax({
		type: 'POST',
		url: 'set-json.php',
		data: {json: json}
	}).always(function(e){
		showMovies();
	});
}

var getMovies = function(callback){
	time = new Date().getTime();
	$.getJSON('json/movies.json?t=' + time, function(data){
		movieData = data;
		movies = data.movies;
		if(callback != ''){
			(callback)();
		}
	});
}

var showMovies = function(){
	$('#movies').html('');
	$.each(movies, function(key, data){
		var num = key +1;
		var movie = data.title;
		var month, day;
		if(data.first === false){
			movie = '[' + movie + ']';
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
		movie += ' (' + month + day + data.year.substr(2, 2) + ')';
		$('#movies').prepend('<p>' + num + '. ' + movie + '</p>');
	});
}