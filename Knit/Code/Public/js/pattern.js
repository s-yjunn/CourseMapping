// set variables
var canvas = document.getElementById('canvas'),
    context = canvas.getContext('2d'),
    mouseX = 0,
    mouseY = 0,
    width = 500,
    height = 500,
    color = "black",
    mousedown = false;
	colorpick = document.getElementById('colorPicker');
	btnclear = document.getElementById('btnClear');
	btnsave = document.getElementById('btnSave');
// set canvas size
canvas.width = width;
canvas.height = height;

// COLOR SELECT
// select from default colors
function selectColor(col) {
	color = col;
}
// select from color picker
colorpick.addEventListener('input', function(event) {
    color = colorpick.value;
}, false);

// DRAW
function draw() {
  if (mousedown) {
	  context.fillStyle = color; // set the color
	  context.fillRect(mouseX, mouseY, 3, 3); // fill 3x3 square at clicked coordinate
  }
}

// GET COORDINATES
// get mouse coordinates on the canvas
canvas.addEventListener('mousemove', function(event) {
  if (event.offsetX) {
    mouseX = event.offsetX;
    mouseY = event.offsetY;
  } else {
    mouseX = event.pageX - event.target.offsetLeft;
    mouseY = event.pageY - event.target.offsetTop;
  }
  draw(); // call draw function
}, false );
// check for click
canvas.addEventListener('mousedown', function(event) {
    mousedown = true;
}, false );
canvas.addEventListener('mouseup', function(event) {
    mousedown = false;
}, false );


/* BUTTONS */
// clear canvas
btnclear.addEventListener('click', function(event){
	context.clearRect(0, 0, canvas.width, canvas.height);
}, false);
// save pattern
btnsave.addEventListener('click', function(event) {
    btnSave.href = canvas.toDataURL(); // set href to our canvas for download
    btnSave.download = "MyPattern.png"; // set download filename
}, false);