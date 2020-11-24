// set some variables
var canvas = document.getElementById('canvas'),
    c = canvas.getContext('2d'),
    mouseX = 0,
    mouseY = 0,
    width = 500,
    height = 500,
    color = "black",
    mousedown = false;
// size canvas
canvas.width = width;
canvas.height = height;

/* COLOR SELECT */
// default colors
function selectColor(userColor) { // default color
	color = userColor;
}
// color picker
var userColor = document.getElementById('userColor');
userColor.addEventListener('input', function(ev) {
    color = document.getElementById("userColor").value;
}, false);

/* DRAWING */
function draw() {
  if (mousedown) {
	  c.fillStyle = color; // set the color
	  c.fillRect(mouseX, mouseY, 3, 3); // fill 3x3 square at clicked coordinate
  }
}

/* GETTING COORDINATES */
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


/* BUTTONS */
// clear canvas
$("#btnClear").click(function(){
	c.clearRect(0, 0,  canvas.width, canvas.height);
});
// save pattern
$("#btnDownload").click(function(){
	btn = $('#btnDownload');
    btn.href = canvas.toDataURL(); // set href to our canvas for download
   	btn.download = "MyPattern.png"; // set download filename
});