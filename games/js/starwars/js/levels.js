//Episode IV levels
tantive4 = {
	'name': 'Tantive IV',
	'password': '',
	'bg': 'metal',
	'textColor': black,
	'enemyInterval': 32,
	'enemyCount': 10,
	'enemyDir': 'right',
	'friendlyDir': 'left',
	'character': rebel,
	'enemy': stormtrooper,
	'boss': officerblack,
	'bossHP': 2, 
	'friendlies': [
		{
			'character': protocolwhite,
			'details': {
				'delay': 10.5 * fps,
				'dir': 'right',
				'value': 25,
				'dir': 'down'
			}
		},
		{
			'character': captainantilles,
			'details': {
				'delay': 30 * fps,
				'value': 0 - 500,
				'dir': 'left'
			}
		}
	],
	'cutScene': 'episode4-scene1.png'
};

tatooine = {
	'name': 'Tatooine',
	'password': '',
	'bg': 'sand',
	'textColor': black,
	'enemyInterval': 32,
	'enemyCount': 10,
	'obstacles': [
		{
			'type': speeder,
			'x': 33,
			'y': 33
		}
	],
	'character': luke,
	'enemy': tusken,
	'boss': bantha,
	'bossHP': 2,
	'cutScene': 'episode4-scene2.png'
};

sandcrawler = {
	'name': 'Sandcrawler',
	'password': 'endor',
	'bg': 'rust',
	'textColor': black,
	'enemyInterval': 32,
	'enemyCount': 10,
	'character': sandtrooper,
	'enemy': jawa,
	'boss': artoo,
	'bossHP': 2
};

mosEisley = {
	'name': 'Mos Eisley',
	'password': '',
	'bg': 'marble',
	'textColor': black,
	'enemyInterval': 32,
	'enemyCount': 10,
	'enemyDir': 'right',
	'obstacles': [
		{
			'type': bar,
			'x': 0,
			'y': 50
		},
		{
			'type': table,
			'x': 33,
			'y': 20
		},
		{
			'type': table,
			'x': 66,
			'y': 20
		},
		{
			'type': table,
			'x': 33,
			'y': 80
		},
		{
			'type': table,
			'x': 66,
			'y': 80
		}
	],
	'character': ben,
	'enemy': sandtrooper,
	'boss': pondababa,
	'bossHP': 1,
	'friendlies': [
		{
			'character': mawhonic,
			'details': {
				'delay': 2.5 * fps,
				'value': 25
			}
		},
		{
			'character': chewbacca,
			'details': {
				'delay': 10.5 * fps,
				'value': 0 - 500
			}
		},
		{
			'character': greedo,
			'details': {
				'delay': 30 * fps,
				'value': 25
			}
		}
	]
};

dockingBay = {
	'name': 'Docking Bay 94',
	'password': '',
	'bg': 'dust',
	'textColor': black,
	'enemyInterval': 32,
	'enemyCount': 10,
	'obstacles': [
		{
			'type': falconbig,
			'x': 100,
			'y': 0
		}
	],
	'character': hansolo,
	'enemy': stormtrooper,
	'boss': garindan,
	'bossHP': 2
};

detention = {
	'name': 'Detention',
	'password': '',
	'bg': 'dark',
	'textColor': black,
	'enemyInterval': 32,
	'enemyCount': 10,
	'character': chewbacca,
	'enemy': deathstartrooper,
	'boss': mousedroid,
	'bossHP': 2,
	'friendlies': [
		{
			'character': stormtrooperhan,
			'details': {
				'delay': 1.5 * fps,
				'value': 0 - 500,
				'dir': 'right'
			}
		},
		{
			'character': stormtrooperluke,
			'details': {
				'delay': 1.75 * fps,
				'value': 0 - 500,
				'dir': 'right'
			}
		}
	]
};

conferenceRoom = {
	'name': 'War Room',
	'password': '',
	'bg': 'dark',
	'textColor': black,
	'enemyInterval': 32,
	'enemyCount': 10,
	'character': leia,
	'enemy': tiepilot,
	'boss': tarkin,
	'bossHP': 2
};

tractorBeam = {
	'name': 'Tractor Beam',
	'password': '',
	'bg': 'dark',
	'textColor': black,
	'enemyInterval': 32,
	'enemyCount': 10,
	'character': ben,
	'enemy': stormtrooper,
	'boss': darthvader,
	'bossHP': 5
};

showdown4 = {
	'name': 'Showdown',
	'password': '',
	'bg': 'dark',
	'textColor': black,
	'enemyInterval': 32,
	'enemyCount': 0,
	'character': darthvader,
	'enemy': null,
	'boss': ben,
	'bossHP': 5
};

battleOfYavin = {
	'name': 'The Battle of Yavin',
	'password': '',
	'bg': 'space',
	'textColor': yellow,
	'enemyInterval': 32,
	'enemyCount': 10,
	'character': falcon,
	'enemy': tie,
	'boss': vadertie,
	'bossHP': 5
};

assaultOnDeathStar = {
	'name': 'Death Star',
	'password': '',
	'bg': 'space',
	'textColor': yellow,
	'enemyInterval': 32,
	'enemyCount': 0,
	'character': xwing,
	'enemy': null,
	'boss': deathstar,
	'bossHP': 10
};

//Episode V levels
hoth = {
	'name': 'Hoth',
	'password': '',
	'bg': 'snow',
	'textColor': black,
	'enemyInterval': 32,
	'enemyCount': 10,
	'character': artoo,
	'enemy': stormtrooper,
	'boss': clonecaptain,
	'bossHP': 2
};

//Episode VI levels
endor = {
	'name': 'Endor',
	'password': '',
	'bg': 'grass',
	'textColor': black,
	'enemyInterval': 32,
	'enemyCount': 10,
	'character': artoo,
	'enemy': ewok,
	'boss': logray,
	'bossHP': 2
};
