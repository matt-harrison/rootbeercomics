function Sprite(width, height, zoom, code, key) {
    this.width = width;
    this.height = height;
    this.count = this.height * this.width;
    this.zoom = zoom;
    this.code = code.split('');
    this.key = key;

    this.isEven = (this.width % 2 == 0);
    this.halfWidth = (this.isEven) ? (this.width / 2) : Math.floor(this.width / 2) + 1;
    this.hex = getColor();
    this.charCount = 0;

    //Add container to stage.
    this.selector = document.createElement('div');
    this.selector.id = 'sprite';
    this.selector.style.position = 'absolute';
    this.selector.style.left = offsetX,
    this.selector.style.top = offsetY,
    document.body.appendChild(this.selector);

    //Add pixel grid to container and assign mirrors.
    for (var i=0; i<this.count; i++) {
        this.id = i;
        this['pixel' + i] = new Pixel(this, i);
    }

    //Iterate over left pixels and decide whether to toggle.
    for (var i=0; i<this.count; i++) {
        var pixel = this['pixel' + i];
        if (pixel.column + 1 <= this.halfWidth) {
            if (this.code == '') {
                if (getRandom(2)) {
                    pixel.toggle();
                }
            } else {
                if (this.key.indexOf(this.code[this.charCount]) !== -1) {
                    pixel.toggle();
                }
                this.charCount = (this.charCount < this.code.zoom - 1) ? ++this.charCount : this.charCount = 0;
            }
        }
    }
    
    this.toggle = function(){
        var pixel = getRandom(this.count);
        this['pixel' + pixel].toggle();
    }
}

function Pixel(parent, id) {
    this.parent = parent;
    this.id = id;
    this.status = true;
    this.column = (this.id % this.parent.width);
    this.row = Math.floor(this.id / this.parent.width);

    var color = (status) ? this.parent.hex : '#FFF';

    this.selector = document.createElement('div');
    this.selector.style.position = 'absolute';
    this.selector.style.left = (this.column * this.parent.zoom) + 'px';
    this.selector.style.top = this.row * this.parent.zoom + 'px';
    this.selector.style.width = this.parent.zoom + 'px';
    this.selector.style.height = this.parent.zoom + 'px';
    this.selector.style.backgroundColor = this.parent.hex;
    this.parent.selector.appendChild(this.selector);

    //Mirror the tile where applicable.
    if (this.column + 1 <= this.parent.halfWidth) {
        this.mirrorId = (this.row * this.parent.width) + this.parent.width - this.column - 1;
    } else {
        this.mirrorId = (this.row * this.parent.width) + (this.parent.width - this.column - 1);
    }
    
    this.toggle = function() {
        var mirror = this.parent['pixel' + this.mirrorId];

        this.status = !this.status;
        mirror.status = this.status;
        
        var color = (this.status) ? this.parent.hex : '#FFF';
        this.selector.style.backgroundColor = color;
        mirror.selector.style.backgroundColor = color;
    }

    //Click to toggle status (and mirror status).
    var _this = this;
    this.selector.addEventListener('mousedown', function() {
        _this.toggle();
        mouseDown = true;
        paintColor = _this.status;
    });

    this.selector.addEventListener('mouseup', function() {
        mouseDown = false;
    });

    this.selector.addEventListener('mouseover', function() {
        if (mouseDown && _this.status != paintColor) {
            _this.toggle();
        }
    });
}

function getColor() {
    var hex = '#';
    for (var i=0; i<3; i++) {
        hex += (Math.floor(Math.random() * 2)) ? '9' : 'F';
    }
    hex = hex.replace('FFF', '99F');//Do not allow solid white sprites.
    hex = hex.replace('999', 'F99');//Do not allow solid gray sprites.
    
    if (color !== '') {
        hex = '#' + color;
    }

    return hex;
}

function getRandom(max) {
    return Math.floor(Math.random() * max);
}

document.body.style.backgroundColor = '#CCC';
document.body.style.overflow = 'hidden';

var mouseDown = false;
var paintColor = false;

var vowels = 'aeiou'.split('');
var alphabet = 'abcdefghijklm'.split('');

var width = Number(document.body.dataset.width) || 5;
var height = Number(document.body.dataset.height) || 5;
var code = document.body.dataset.code || '';
var color = document.body.dataset.color || '';
var loop = Number(document.body.dataset.loop) || 0;
var zoom = document.body.dataset.zoom || 50;
var offsetX = '0';
var offsetY = '0';

if (zoom == 'auto') {
    if (window.innerWidth >= window.innerHeight) {
        //Landscape
        zoom = Math.floor(window.innerHeight / height);
        offsetX = Math.floor((window.innerWidth - (zoom * width)) / 2) + 'px';
    } else {
        //Portrait
        zoom = Math.floor(window.innerWidth / width);
        offsetY = Math.floor((window.innerHeight - (zoom * width)) / 2) + 'px';
    }
}

console.log('width: ' + window.innerWidth + '/' + (width * zoom));
console.log('height: ' + window.innerHeight + '/' + (height * zoom));

var sprite = new Sprite(width, height, zoom, code, alphabet);

if (loop > 0) {
    var repeat = setInterval(function() {
        sprite.toggle();
    }, loop);
}
