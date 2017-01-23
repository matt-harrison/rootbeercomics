colors = [];
colors.push(['White', 'ffffff']);
colors.push(['Black', '111111']);
colors.push(['Gray', '808080']);
colors.push(['Peach', 'f5dabc']);
colors.push(['Brown', '754c24']);
colors.push(['Red', 'ff0000']);
colors.push(['Green', '00ff00']);
colors.push(['Blue', '0000ff']);
colors.push(['Navy Blue', '000080']);
colors.push(['Purple', '662d91']);
colors.push(['Orange', 'f7941d']);
colors.push(['Yellow', 'ffff00']);
//OLD COLORS , 'ff0000', '00ff00', '0000ff', '000000', 'ffa500', 'ffff00', '800080', '808080', '000080', 'fae7do', 'dfc183', 'aa724b', '7b4b2a', 'feb186', 'b58a3f', 'ff0033'];
totalColors = colors.length-1;

genders = [['Male', '1101'], ['Female', '1102']];
expressions = [['Happy', '67'], ['Sad', '69'], ['Wink','1'], ['Angry','3'], ['Silly', '240'], ['Evil grin','243'], ['Bored','418'], ['Sleepy','5'], ['Crying','416'], ['Zombie', '330']];
hairs = [['Ponytail', '12'], ['Chinese bang', '476'], ['Low cut','473'], ['Flat top', '15'], ['Balding', '17'],['Princess Leia','262'], ['Medium length', '18'],['Japanese bun','14'], ['Long','19'],['Mohawk','75'],['Curly','76'], ['Spikey','83'],['Afro','150'],['Dreads','154']];
beards = [['Mustache', '7'], ['Goatee', '8'], ['Beard', '11'], ['Moustache and Goatee','9'], [' Half beard', '10'], [' Full beard', '11']];
glasses = [['Round', '123'], ['Square', '126']];
shirts = [['T-shirt','189'], ['Sweater', '41'], ['Logo', '47'], ['Baseball', '45'], ['Tuxedo', '38'], ['Racing suit','35'], ['Leather jacket','36'], ['Nightwear','37'],['Skull t-shirt','89'],['Robe','149'], ['Knight armor', '169'], ['Wizard', '172'], ['Ballerina', '272'], ['Superwoman', '274'], ['Superman', '275'], ['Stormtrooper', '278'], ['Santa Claus', '299'], ['Darth Vader', '133'], ['Batman','385'], ['Scream ','388']];
pants = [['Pants', '95'], ['Jeans', '107'], ['Army pants','229'],['Gym shorts', '96'], ['Hearts', '101'], ['Slacks', '111'], ['Skirt', '117'],['Mini Skirt','100'],['Kilt','110'],['British shorts','112'],['American shorts','113']];
shoes = [['Boots', '119'], ['uggs','280'], ['High heels', '121'], ['Sandals', '122'], ['Sneakers', '190']];
hats = [['Ballcap', '20'], ['Beanie', '22'], ['Top hat', '25'],['Cowboy hat','30'],['Crown','164'], ['Viking helmet', '167'], ['Knight helmet', '168'], ['Stormtrooper helmet', '250'], ['Santa Claus hat', '300'], ['Pharaoh crown', '463'], ['Scream mask', '387'], ['Batman mask', '386']];
//accessories = [['Purse','286'], ['Starbucks cup', '129'],['ipod','181'], ['ipod', '181'], ['Drumset', '236'], ['Vampire fangs', '248'], ['Martini', '130'], ['Champagne', '131'], ['Soccer ball', '132'], ['Baseball', '133'], ['Playstation', '424'], ['Nintendo Wii', '425'], ['Surfboard', '136'], ['Skis', '137'], ['Snowboard', '138'], ['Football', '139'], ['Guitar', '141'], ['Skateboard', '142'], ['Dog', '143'], ['Cat', '144']];

//Declare constants
png = 'http://www.doppelme.com/avatar.png?xx=';
page = new String(window.location);
queryPos = page.indexOf('?');
if(queryPos != -1){
	page = page.substr(0, queryPos) + '?xx=';
} else {
	page += '?xx=';
}

//declare defaults for undefined variables
if(gender == '') gender = genders[0][1];
if(expression == '') expression = expressions[0][1];
if(hair == '') hair = 'null';
if(beard == '') beard = 'null';
if(glass == '') glass = 'null';
if(shirt == '') shirt = shirts[2][1];
if(pant == '') pant = pants[1][1];
if(pant == '') hat = 'null';
if(shoe == '') shoe = 'null';

if(skinColor == null) skinColor = colors[0][1];
if(hairColor == null) hairColor = colors[0][1];
if(beardColor == null) beardColor = colors[0][1];
if(shirtColor == null) shirtColor = colors[0][1];
if(pantColor == null) pantColor = colors[0][1];
if(shoeColor == null) shoeColor = colors[0][1];
if(hatColor == null) hatColor = colors[0][1];

$(function(){
	for(var i=0; i<genders.length; i++){
		$('#drpGenderStyle').append('<option value="' + genders[i][1] + '">' + genders[i][0] + '</option>');
		if(genders[i][0].toLowerCase() == gender.toLowerCase()){
			gender = genders[i][1];
		}
	}
	for(var i=0; i<expressions.length; i++){
		$('#drpExpressionStyle').append('<option value="' + expressions[i][1] + '">' + expressions[i][0] + '</option>');
		if(expressions[i][0].toLowerCase() == expression.toLowerCase()){
			expression = expressions[i][1];
		}
	}
	for(var i=0; i<hairs.length; i++){
		$('#drpHairStyle').append('<option value="' + hairs[i][1] + '">' + hairs[i][0] + '</option>');
		if(hairs[i][0].toLowerCase() == hair.toLowerCase()){
			hair = hairs[i][1];
		}
	}
	for(var i=0; i<beards.length; i++){
		$('#drpBeardStyle').append('<option value="' + beards[i][1] + '">' + beards[i][0] + '</option>');
		if(beards[i][0].toLowerCase() == beard.toLowerCase()){
			beard = beards[i][1];
		}
	}
	for(var i=0; i<glasses.length; i++){
		$('#drpGlassesStyle').append('<option value="' + glasses[i][1] + '">' + glasses[i][0] + '</option>');
		if(glasses[i][0].toLowerCase() == glass.toLowerCase()){
			glass = glasses[i][1];
		}
	}
	for(var i=0; i<shirts.length; i++){
		$('#drpShirtStyle').append('<option value="' + shirts[i][1] + '">' + shirts[i][0] + '</option>');
		if(shirts[i][0].toLowerCase() == shirt.toLowerCase()){
			shirt = shirts[i][1];
		}
	}
	for(var i=0; i<pants.length; i++){
		$('#drpPantStyle').append('<option value="' + pants[i][1] + '">' + pants[i][0] + '</option>');
		if(pants[i][0].toLowerCase() == pant.toLowerCase()){
			pant = pants[i][1];
		}
	}
	for(var i=0; i<shoes.length; i++){
		$('#drpShoeStyle').append('<option value="' + shoes[i][1] + '">' + shoes[i][0] + '</option>');
		if(shoes[i][0].toLowerCase() == shoe.toLowerCase()){
			shoe = shoes[i][1];
		}
	}
	for(var i=0; i<hats.length; i++){
		$('#drpHatStyle').append('<option value="' + hats[i][1] + '">' + hats[i][0] + '</option>');
		if(hats[i][0].toLowerCase() == hat.toLowerCase()){
			hats = hats[i][1];
		}
	}
	for(var i=0; i<colors.length; i++){
		$('.colorChooser').append('<option value="' + colors[i][1] + '">' + colors[i][0] + '</option>');
	}
	
	$('#drpGenderStyle').on('change', function(){
		gender = $('#drpGenderStyle>option:selected').attr('value');
		buildAvatar();
	});
	$('#drpExpressionStyle').on('change', function(){
		expression = $('#drpExpressionStyle>option:selected').attr('value');
		buildAvatar();
	});
	$('#drpHairStyle').on('change', function(){
		hair = $('#drpHairStyle>option:selected').attr('value');
		buildAvatar();
	});
	$('#drpBeardStyle').on('change', function(){
		beard = $('#drpBeardStyle>option:selected').attr('value');
		buildAvatar();
	});
	$('#drpGlassesStyle').on('change', function(){
		glass = $('#drpGlassesStyle>option:selected').attr('value');
		buildAvatar();
	});
	$('#drpShirtStyle').on('change', function(){
		shirt = $('#drpShirtStyle>option:selected').attr('value');
		buildAvatar();
	});
	$('#drpPantStyle').on('change', function(){
		pant = $('#drpPantStyle>option:selected').attr('value');
		buildAvatar();
	});
	$('#drpShoeStyle').on('change', function(){
		shoe = $('#drpShoeStyle>option:selected').attr('value');
		buildAvatar();
	});
	$('#drpHatStyle').on('change', function(){
		hat = $('#drpHatStyle>option:selected').attr('value');
		buildAvatar();
	});
	$('#drpSkinColor').on('change', function(){
		skinColor = $(this).find('option:selected').attr('value');
		buildAvatar();
	});
	$('#drpHairColor').on('change', function(){
		hairColor = $(this).find('option:selected').attr('value');
		buildAvatar();
	});
	$('#drpBeardColor').on('change', function(){
		beardColor = $(this).find('option:selected').attr('value');
		buildAvatar();
	});
	$('#drpShirtColor').on('change', function(){
		shirtColor = $(this).find('option:selected').attr('value');
		buildAvatar();
	});
	$('#drpPantColor').on('change', function(){
		pantColor = $(this).find('option:selected').attr('value');
		buildAvatar();
	});
	$('#drpShoeColor').on('change', function(){
		shoeColor = $(this).find('option:selected').attr('value');
		buildAvatar();
	});
	$('#drpHatColor').on('change', function(){
		hatColor = $(this).find('option:selected').attr('value');
		buildAvatar();
	});
	
	$('option').click(function(){
		$(this).parent().trigger('change');
	});
	
	$('#btnImage').click(function(e){
		buildAvatar(true);
		window.open(img, '_blank');
	});
	
	$('#btnLink').click(function(e){
		window.location = url;
	});
	
	buildAvatar();
});

function buildAvatar(){
	img = png + '&style=' + gender + '&s=' + skinColor + '&fa=' + expression + '&ff=' + beard + '&ha=' + hat + '&h=' + hair + '&t=' + shirt + '&b=' + pant + '&f=' + shoe + '&e=' + glass + '&ffc=' + beardColor + '&hac=' + hatColor + '&hc=' + hairColor + '&tc=' + shirtColor + '&bc=' + pantColor + '&fc=' + shoeColor;
	url = page + '&gender=' + gender + '&skinColor=' + skinColor + '&expression=' + expression + '&beard=' + beard + '&hat=' + hat + '&hair=' + hair + '&shirt=' + shirt + '&pant=' + pant + '&shoe=' + shoe + '&glass=' + glass + '&beardColor=' + beardColor + '&hatColor=' + hatColor + '&hairColor=' + hairColor + '&shirtColor=' + shirtColor + '&pantColor=' + pantColor + '&showColor=' + shoeColor;;
	$('#avatar').attr('src', img);
	console.log(img);
}