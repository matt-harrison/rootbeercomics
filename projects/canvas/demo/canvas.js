//init
canvas = document.getElementById('canvas');
context = canvas.getContext('2d');

//lines
context.lineWidth = "1";
context.strokeStyle = '#666';

context.beginPath();
context.moveTo(100, 10);
context.lineTo(100, 390);
context.stroke();

context.beginPath();
context.moveTo(200, 10);
context.lineTo(200, 390);
context.stroke();

context.beginPath();
context.moveTo(300, 10);
context.lineTo(300, 390);
context.stroke();

context.beginPath();
context.moveTo(10, 100);
context.lineTo(390, 100);
context.stroke();

context.beginPath();
context.moveTo(10, 200);
context.lineTo(390, 200);
context.stroke();

context.beginPath();
context.moveTo(10, 300);
context.lineTo(390, 300);
context.stroke();

//rectangle
context.lineWidth = "1";
context.strokeStyle = '#00f';
context.fillStyle = '#f00';
context.beginPath();
context.rect(10, 10, 80, 80);
context.fill();
context.stroke();

//circle
context.lineWidth = "2";
context.strokeStyle = '#f00';
context.fillStyle = '#00f';
context.beginPath();
context.arc(150, 50, 40, 0*(Math.PI/180), 360*(Math.PI/180));
context.fill();
context.stroke();

//triangle
context.lineWidth = "5";
context.strokeStyle = '#666';
context.fillStyle = '#ccc';
context.beginPath();
context.moveTo(210, 10);
context.lineTo(290, 50);
context.lineTo(210, 90);
context.closePath();
context.fill();
context.stroke();

//fill text
context.beginPath();
context.fillStyle = '#000';
context.font = '10pt Courier New';
context.fillText('This is my content.', 310, 30);

//stroke text
context.beginPath();
context.lineWidth = "1";
context.strokeStyle = '#0f0';
context.font = '72px Arial';
context.strokeText('Stroke Text', 10, 190);

//linear gradient
context.beginPath();
gradient = context.createLinearGradient(10, 210, 90, 210);
gradient.addColorStop(0, 'red');
gradient.addColorStop(0.5, 'white');
gradient.addColorStop(1, 'blue');
context.fillStyle = gradient;
context.fillRect(10, 210, 80, 80);

//radial gradient
context.beginPath();
gradient = context.createRadialGradient(150, 250, 5, 150, 250, 40);
gradient.addColorStop(0, 'green');
gradient.addColorStop(1, 'white');
context.fillStyle = gradient;
context.fillRect(110, 210, 80, 80);

//image detail
img = document.getElementById('img');
context.drawImage(img, 55, 150, 80, 80, 210, 210, 80, 80);

//resized image
context.drawImage(img, 0, 0, 400, 400, 310, 210, 80, 80);
/*
*/