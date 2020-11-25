// set variables
var canvas = document.getElementById('canvas'),
    context = canvas.getContext('2d'),
    mouseX = 0,
    mouseY = 0,
    width = 501, // 500 + 1 to cover "borders" on right and bottom
    height = 501,
    color = "black", // draw in black by default
    mousedown = false;
	colorpick = document.getElementById('colorPicker');
	btnclear = document.getElementById('btnClear');
	btnsave = document.getElementById('btnSave');
// set canvas size
canvas.width = width;
canvas.height = height;

// START GRID DRAW
// drawing a pixel at a time on the canvas
function colorPixel(x,y) {
    context.fillRect(x,y,1,1);
}
// determining what color pixel should be 
function pixColor(x,y) {
	// every 20th pixel in either x/y direction is gray
    if ((x%20 < 1)||(y%20 < 1)) {
      return "#ccc";
    } else { // otherwise, pixel is white
      return "white";
    }
}
// drawing the grid
function drawGrid() {
    var x, y;
    for (x = 0; x < canvas.width; x++) { // loop over x coords ("rows")
		for (y = 0; y < canvas.height; y++) { // loop over y coords ("columns") in each x ("row")
			var color = pixColor(x,y); // determine what to color pixel
			context.fillStyle = color; // set color
			colorPixel(x,y); // color pixel accordingly
		}
    }
}
// draw the grid on the canvas!
drawGrid();
// END GRID DRAW

// COLOR SELECT
// selecting from default color list
function selectColor(col) {
	color = col;
}
// selecting from color picker
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
// set mousedown accordingly if user clicks mouse
canvas.addEventListener('mousedown', function(event) {
    mousedown = true;
}, false );
canvas.addEventListener('mouseup', function(event) {
    mousedown = false;
}, false );


// BUTTONS
// clear canvas
btnclear.addEventListener('click', function(event){
	context.clearRect(0, 0, canvas.width, canvas.height);
	drawGrid(); // redraw grid after clearing canvas;
}, false);
// save pattern
btnsave.addEventListener('click', function(event) {
    btnSave.href = canvas.toDataURL(); // set href to our canvas for download
    btnSave.download = "MyPattern.png"; // set download filename
}, false);