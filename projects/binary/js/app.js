angular.module('binary', [])
.controller('binaryController', [function() {
	var vm = this;

	vm.sum = 0;
	vm.ascii = '';
	vm.digit1 = 0;
	vm.digit2 = 0;
	vm.digit4 = 0;
	vm.digit8 = 0;
	vm.digit16 = 0;
	vm.digit32 = 0;
	vm.digit64 = 0;
	vm.digit128 = 0;

	vm.digits = [
		{
			'value': 128,
			'active': 0
		},
		{
			'value': 64,
			'active': 0
		},
		{
			'value': 32,
			'active': 0
		},
		{
			'value': 16,
			'active': 0
		},
		{
			'value': 8,
			'active': 0
		},
		{
			'value': 4,
			'active': 0
		},
		{
			'value': 2,
			'active': 0
		},
		{
			'value': 1,
			'active': 0
		}
	];

	vm.toggle = function(digit) {
		vm.digits[digit].active = (vm.digits[digit].active === 1) ? 0 : 1;
		var sum = 0;
		for (var i in vm.digits) {
			if (vm.digits[i].active) {
				sum += vm.digits[i].value;
			}
		}
		vm.sum = sum;
		vm.ascii = String.fromCharCode(sum);
	}

	vm.update = function() {
		var binary = vm.sum.toString(2);
		var leadingZeroes = 8 - binary.length;
		for (var i=0; i<leadingZeroes; i++) {
			binary = '0' + binary;
		}
		for (var i=0; i<vm.digits.length; i++) {
			var oldValue = String(vm.digits[i].active);
			var newValue = binary.charAt(i);
			if (oldValue != newValue) {
				vm.toggle(i);
			}
		}
	}

	vm.add = function(integer) {
		if (vm.sum + integer <= 255) {
			vm.sum += integer;
			vm.update();
		}
	}

	vm.subtract = function(integer) {
		if (vm.sum - integer >= 0) {
			vm.sum -= integer;
			vm.update();
		}
	}

	return vm;
}]);
