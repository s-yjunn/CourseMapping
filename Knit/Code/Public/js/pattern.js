////// SETTING UP //////

// establish variables (and set static ones)
var canvas = document.getElementById('canvas'),
  context = canvas.getContext('2d'),
  mouseX = 0,
	mouseY = 0,
	appxGridWidth = 500, // *approximate* dimensions of canvas GRID (excluding numbers)
	appxGridHeight = 500,
	gridWidth, // actual dimensions of canvas GRID (excluding numbers)
	gridHeight,
	gridDiv, // gridWidth (or gridHeight) divided by gridDiv = number of squares
	fillColor = '#000', // default fill color is black
	bgColor = [255, 255, 255, 255], // default bg color of squares is white
  mousedown = false,
	colorPick = document.getElementById('colorPicker'),
	btnClear = document.getElementById('btnClear'),
	btnDownload = document.getElementById('btnDownload');

////// GRID DRAW //////

// subroutine to determine what color to draw pixel
function pixColor(x,y) {
    if ((x%gridDiv < 1)||(y%gridDiv < 1)) { // every gridDivth pixel in either x/y direction is gray
      return "#ccc";
    } else { // otherwise, pixel is white
      return "white";
    }
}
// draw the grid + numbers
function drawGrid() {
	// DRAW THE GRID
    var x, y;	
    for (x = 0; x < gridWidth+1; x++) { // loop over x's of canvas; gridWidth+1 to draw that bottom-most border
		for (y = 0; y < gridHeight+1; y++) { // loop over y's in each x; gridHeight+1 to draw right-most border
			var color = pixColor(x,y); // determine what to color pixel
			context.fillStyle = color; // set color
			context.fillRect(x,y,1,1); // color pixel accordingly
		}
    }
	
	// DRAW THE NUMBERS
	var numX = (gridWidth/gridDiv); // number that gets printed along x axis; start with number of squares needed and decrement
	var numY = (gridHeight/gridDiv); // number that gets printed along y axis; start with number of squares needed and decrement
	var numXaxis = gridWidth+5; // x coordinate of canvas that y-axis numbers print along, +5px for spacing
	var numYaxis = gridHeight+15; // y coordinate of canvas that x-axis numbers print along, +15px for spacing
	// fill styles for the numbers
	context.font = "13px Arial";
	context.fillStyle = "#ccc";
	context.textAlign = "left";
	// draw the "x axis" of numbers
	for (x = 0; x < gridWidth; x++) { // 
		if (x%gridDiv < 1) { // print number every gridDiv # of pixels (same condition to determine where to make grid lines)
			context.fillText(numX, x, numYaxis); // print text of the number at point (x, numYaxis)
			numX--; // increment the number to print next
		} else {
			continue; // don't print a number at this x coord 
		}
	}
	// draw the "y axis" of numbers
	for (y = 10; y < (gridHeight+1); y++) { // need +1 to gridHeight because last number won't print otherwise
		if (y%gridDiv < 1) { // print number every gridDiv # of pixels (same condition to determine where to make grid lines)
			context.fillText(numY, numXaxis, y); // print text of the number numY at point (numXaxis, y)
			numY--; // increment the number to print next
		} else {
			continue; // don't print a number at this y coord 
		}
	}	
}

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
    if ((mouseX%gridDiv < 1)||(mouseY%gridDiv < 1)||(mouseX>gridWidth)||(mouseY>gridHeight)) { 
		return; // don't fill if clicked position lies along grid lines
	} else {
	    floodFill(mouseX, mouseY, bgColor); // call fill function
	}
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
btnClear.addEventListener('click', function(){
	context.clearRect(0, 0, canvas.width, canvas.height);
	drawGrid(); // need to redraw grid
}, false);

// download pattern
btnDownload.addEventListener('click', function() {
	btnDownload.href = canvas.toDataURL(); // set href to our canvas for download
	btnDownload.download = "MyPattern.png"; // set download filename
}, false);

// save pattern
// adapted by Isabel from https://stackoverflow.com/questions/13198131/how-to-save-an-html5-canvas-as-an-image-on-a-server
// couldn't figure out how to pass username to event listener so did normal function
function btnSave(username) {
	var canvasData = canvas.toDataURL(); // prepare canvas data for processing
	// send data to php processing file
	$.ajax ({
		type: "POST",
		url: "php/savePattern.php",
		data: {uname: username, canvas: canvasData},
		success: function(response) {
			// if php script outputs a success message
			if (response == 1) {
				// let the user know
				$("#paDiv").html("<p class='alert alert-info' role='alert'>Your pattern was saved.</p>");
				// update user patterns page
				$("#userPatterns").load(location.href+" #userPatterns>*","");
			// otherwise
			} else {
				// let the user know
				$("#paDiv").html("<p class='alert alert-info' role='alert'>Unable to save pattern.</p>");
			}
		}
	});
}

////// INITIALIZING GRID to user specifications //////
// @author Isabel
function startPatternMkr() {
	// get user input about cols x rows (for now they're the same)
	var nrCols = nrRows = $("#dimension").val();
	// make sure they didn't enter something too big (max hard-coded for now)
	if (nrCols > 30 || nrRows > 30) {
		$("#intakeFeedback").html("<p class='alert alert-danger' role='alert'>Please enter a number <= 30.</p>");
	// or too small (min hard-coded for now) 
	} else if (nrCols < 6 || nrRows < 6) {
		$("#intakeFeedback").html("<p class='alert alert-danger' role='alert'>Please enter a number > 5.</p>");
	// if all is well, take them to the grid
	} else {
	// what multiplier gets us the closest (without going over) to the approx grid height with this many squares?
	// (height because that's where non-scrolling space is limited)
	gridDiv = Math.floor(appxGridHeight/nrRows);
	// then get that 'closest number' for the actual dimensions
	gridWidth = nrCols * gridDiv; // actual dimensions of canvas GRID (excluding numbers)
	gridHeight = nrRows * gridDiv;
	canvas.width = gridWidth+20; // dimensions of canvas ELEMENT (adds 20px to fit number axes)
	canvas.height = gridHeight+20;
	drawGrid();
	hide('patternMkrIntake');
	show('patternMkrGrid');
	}
}

// short "starting over" function (-Isabel)
function restartPatternMkr() {
	// clear feedback area
	$("#intakeFeedback").html("");
	// return to the intake form
	hide('patternMkrGrid');
	show('patternMkrIntake');
}