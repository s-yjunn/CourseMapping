// grab the canvas element, get the context for API access and 
// preset some variables
var canvas = document.querySelector('canvas'),
    c = canvas.getContext('2d'),
    mouseX = 0,
    mouseY = 0,
    width = 500,
    height = 500,
    color = 'black',
    mousedown = false;

// resize canvas
canvas.width = width;
canvas.height = height;

// draw on canvas when there is a click
function draw() {
  if (mousedown) {
    // set the color
    c.fillStyle = color; 
	// fill 3x3 square at clicked coordinate (mouseX, mouseY)
	c.fillRect(mouseX, mouseY, 3, 3); 
  }
}

// get mouse coordinates on the canvas
canvas.addEventListener( 'mousemove', function( event ) {
  if (event.offsetX) {
    mouseX = event.offsetX;
    mouseY = event.offsetY;
  } else {
    mouseX = event.pageX - event.target.offsetLeft;
    mouseY = event.pageY - event.target.offsetTop;
  }
  draw();   // call draw function
}, false );

// check for click
canvas.addEventListener( 'mousedown', function( event ) {
    mousedown = true;
}, false );
canvas.addEventListener( 'mouseup', function( event ) {
    mousedown = false;
}, false );

// giving download button its functionality
var btn = document.getElementById('btn');
// listen for click...
btn.addEventListener('click', function(ev) {
    btn.href = canvas.toDataURL(); // set href to our canvas for download
    btn.download = "MyPattern.png"; // set download filename
}, false);