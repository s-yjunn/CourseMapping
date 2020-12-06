<div id="Pattern" class="tabcontent">
	<h3 class="underline">Pattern Maker</h3>
	<div class="container">
		<div class="row justify-content-center">
			<div id="colorPalette" class="col-xs-1">
				<div class="palette" id="red" onclick="selectColor('red')"></div>
				<div class="palette" id="orange" onclick="selectColor('orange')"></div>
				<div class="palette" id="yellow" onclick="selectColor('yellow')"></div>
				<div class="palette" id="green" onclick="selectColor('green')"></div>
				<div class="palette" id="cyan" onclick="selectColor('cyan')"></div>
				<div class="palette" id="blue" onclick="selectColor('blue')"></div>
				<div class="palette" id="purple" onclick="selectColor('purple')"></div>
				<div class="palette" id="pink" onclick="selectColor('pink')"></div>
				<div class="palette" id="brown" onclick="selectColor('brown')"></div>				
				<div class="palette" id="gray" onclick="selectColor('gray')"></div>				
				<div class="palette" id="black" onclick="selectColor('black')"></div>
				<div class="palette" id="white" onclick="selectColor('white')"></div>
				
				
				<input id="colorPicker" type="color" value="#FF00FF">
			</div>
			<div class="col-xs-11">
				<canvas id="canvas"></canvas> 
			</div>
		</div>
		<div class="row justify-content-center">		
			<button id="btnClear" class="btn1">Clear Canvas</button>
			<a id="btnDownload" href=""><button class="btn1">Download Image</button></a>
			<?php if ($loggedIn): ?>
				<button class="btn1" onclick = "btnSave('<?= $username; ?>')">Save to my account</button>
				<!-- feedback about saving goes here -->
			<?php endif; ?>
		</div>
		<div class="row justify-content-center">		
			<div id = "paDiv"></div>
		</div>
	</div>
</div>

<script src="js/pattern.js"></script>
