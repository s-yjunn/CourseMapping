////// SETTING UP //////
// set variables
var canvas = document.getElementById('canvas'),
    context = canvas.getContext('2d'),
    mouseX = 0,
    mouseY = 0,
    width = 501, // 500px + 1 to get the borders on right and bottom of canvas
    height = 501,
	gridDiv = 20, // how much we x % and y % (mod); 501/gridDiv determines number of squares
	fillColor = '#000', // default fill color is black
	bgColor = [255, 255, 255, 255], // default bg color of squares is white
    mousedown = false,
	colorPick = document.getElementById('colorPicker'),
	btnClear = document.getElementById('btnClear'),
	btnSave = document.getElementById('btnSave');
// set canvas size
canvas.width = width;
canvas.height = height;

////// GRID DRAW //////
// subroutine to draw one pixel at a time
function colorPixel(x,y) {
    context.fillRect(x,y,1,1);
}
// subroutine to determine what color to draw pixel
function pixColor(x,y) {
    if ((x%gridDiv < 1)||(y%gridDiv < 1)) { // every 20th pixel in either x/y direction is gray
      return "#ccc";
    } else { // otherwise, pixel is white
      return "white";
    }
}
// drawing the grid pixel by pixel, row by row
function drawGrid() {
    var x, y;
    for (x = 0; x < canvas.width; x++) { // loop over x's of canvas
		for (y = 0; y < canvas.height; y++) { // loop over y's in each x
			var color = pixColor(x,y); // determine what to color pixel
			context.fillStyle = color; // set color
			colorPixel(x,y); // color pixel accordingly
		}
    }
}
// actually draw grid on canvas
drawGrid();

////// COLOR SELECT //////
// user selects from default colors
function selectColor(color) {
	fillColor = color;
}
// user selects from color picker
colorPick.addEventListener('input', function(event) {
    fillColor = colorPick.value;
}, false);

////// FLOOD FILL //////
// subroutine to compare two colors
function colorEqual(color1, color2) {
    for (i = 0; i < color1.length; i++) {
      if (color1[i] != color2[i]) {
        return false;
      }
    }
    return true;
}
// filling a square on the grid, starting at (x,y) and recursing until a diff color
function floodFill(x, y, bgColor) {
    if (mousedown) {
		var currentColor = context.getImageData(x, y, 1, 1).data;
		if (colorEqual(currentColor, bgColor) == false) {
			return;
		} else {
			context.fillRect(x, y, 1, 1);
			floodFill(x+1, y, bgColor);
			floodFill(x-1, y, bgColor);
			floodFill(x, y+1, bgColor);
			floodFill(x, y-1, bgColor);
		}
	}
}

////// GET COORDINATES //////
// track position of user's mouse
canvas.addEventListener('mousemove', function(event) {
    mouseX = event.offsetX; // x position relative to canvas
    mouseY = event.offsetY; // y position relative to canvas
	bgColor = context.getImageData(mouseX, mouseY, 1, 1).data; // get color at (x,y)
	context.fillStyle = fillColor; // set the fill color
    floodFill(mouseX, mouseY, bgColor); // call fill function
}, false );
// check for clicks
canvas.addEventListener('mousedown', function(event) {
    mousedown = true;
}, false );
canvas.addEventListener('mouseup', function(event) {
    mousedown = false;
}, false );

////// BUTTONS //////
// clear canvas
btnClear.addEventListener('click', function(event){
	context.clearRect(0, 0, canvas.width, canvas.height);
	drawGrid(); // need to redraw grid
}, false);
// save pattern
btnSave.addEventListener('click', function(event) {
    btnSave.href = canvas.toDataURL(); // set href to our canvas for download
    btnSave.download = "MyPattern.png"; // set download filename
}, false);