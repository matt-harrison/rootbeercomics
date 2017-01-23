$(function(){
	$('#fname').focus();
	getUsers(showUsers);
	$('#btnAdd').click(function(event){
		event.preventDefault();
		if($('#fname').val() != '' || $('#lname').val() != ''){
			getUsers(addUser);
		}
	});
});

var addUser = function(){
	user = {
		"fname": $('#fname').val(), 
		"lname": $('#lname').val(), 
		"username": $('#fname').val().substring(0,1) + $('#lname').val().replace(/ /g, '')
	};
	myData.users.push(user);
	$('#fname, #lname').val('');
	$('#fname').focus();
	$.ajax({
		type: 'POST',
		url: 'set-json.php',
		dataType: 'json',
		data: {json: myData}
	}).always(function(e){
		showUsers();
	});
}

var getUsers = function(callback){
	time = new Date().getTime();
	$.getJSON('json/users.json?t=' + time, function(data){
		myData = data;
		users = data.users;
		if(callback != ''){
			eval(callback)();
		}
	});
}

var showUsers = function(){
	$('#users').html('');
	$.each(users, function(key, user){
		var num = key +1;
		$('#users').append('<p>' + num + '. ' + user.username + '</p>');
	});
}