timeout = false;
firstCard = '';
typeCount = 0;

colors = [['Red', 'ff0000'], ['Blue', '0000ff'], ['Yellow', 'ffff00']];
expressions = [['Happy', '67'], ['Sad', '69'], ['Wink','1'], ['Angry','3'], ['Silly', '240'], ['Evil grin','243'], ['Bored','418'], ['Sleepy','5'], ['Crying','416']];
shirts = [['T-shirt','189'], ['Sweater', '41'], ['Logo', '47'], ['Baseball', '45'], ['Tuxedo', '38'], ['Racing suit','35'], ['Leather jacket','36'], ['Nightwear','37'],['Skull t-shirt','89'],['Robe','149'], ['Knight armor', '169'], ['Ballerina', '272'], ['Superwoman', '274'], ['Superman', '275'], ['Stormtrooper', '278'], ['Santa Claus', '299'], ['Darth Vader', '133'], ['Batman','385']];
hats = [['Ballcap', '20'], ['Beanie', '22'], ['Top hat', '25'],['Cowboy hat','30'],['Crown','164'], ['Viking helmet', '167'], ['Knight helmet', '168'], ['Stormtrooper helmet', '250'], ['Santa Claus hat', '300'], ['Pharaoh crown', '463'], ['Scream mask', '387'], ['Batman mask', '386']];
cards = [];

$(function(){
	for(var i=0;i<10;i++){
		card = getAvatar();
		cards.push(card, card);
	}
	cards = shuffle(cards);
	for(var i=0;i<cards.length;i++){
		var img = 'http://www.doppelme.com/avatar.png?xx=&b=107&f=190&fa=' + cards[i][0] + '&ha=' + cards[i][1] + '&t=' + cards[i][2] + '&hac=' + cards[i][3] + '&tc=' + cards[i][3] + '&bc=' + cards[i][3] + '&fc=' + cards[i][3];
		$('#match').append('<div id="card' + i + '" data-type="' + cards[i][4] + '" class="unit mr5 mb5 bdrGray p5 csrPointer rndBox5 card"/>');
		$('#card' + i).append('<img src="' + img + '" class="front"/>').find('.front').hide();
		$('#card' + i).append('<img src="img/playing-card.jpg" class="back"/>');
	}
	
	$('#match').delegate('.card', 'click', function(){
		if(!timeout){
			thisCard = $(this);
			if(firstCard == ''){
				firstCard = thisCard;
			} else {
				if(thisCard .attr('id') != firstCard.attr('id') && firstCard.attr('data-type') == thisCard.attr('data-type')){
					firstCard.removeClass('card bdrGray csrPointer').addClass('bdrBlue matched');
					thisCard.removeClass('card bdrGray csrPointer').addClass('bdrBlue matched');
				} else {
					revert();
				}
				firstCard = '';
			}
			thisCard.find('.front').toggle();
			thisCard.find('.back').toggle();
		}
	});
});

function getAvatar(){
	var expression = expressions[Math.floor(Math.random()*expressions.length)][1];
	var hat = hats[Math.floor(Math.random()*hats.length)][1];
	var shirt = shirts[Math.floor(Math.random()*shirts.length)][1];
	var color = colors[Math.floor(Math.random()*colors.length)][1];
	
	for(var i=0;i<cards.length;i++){
		if(cards[i][0] == shirt && cards[i][0] == hat){
			getAvatar();
			continue;
		}
	}
	typeCount++;
	return [expression, hat, shirt, color, typeCount];
}

function revert(){
	timeout = true;
	setTimeout(function(){
		$('.card>.front').hide();
		$('.card>.back').show();
		timeout = false;
	}, 1000);
}

function shuffle(arr){
	count = arr.length;
	var arr2 = [];
	for(var i=0;i<count;i++){
		rand = Math.floor(Math.random()*arr.length);
		arr2.push(arr[rand]);
		arr.splice(rand, 1);
	}
	return arr2;
}