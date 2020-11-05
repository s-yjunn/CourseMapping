<div id="Vote" class="tabcontent">
<div class="slideshow-container">
	<div class="card">
	  <h3>Vote for your favorite design, or submit your own!</h3>
	  <?php
 $contestants = glob('images/contestants/*'); 
$numPics = count($contestants);
if($numPics == 0){
    echo '<p>There are currently no submissions! Come back later, or submit a design of your own!</p>';    
    }
    else{
        for ($i = 0; $i < $numPics; $i++){
    echo '<div class="mySlides fade">',
    '<div class="numbertext">'.($i + 1 ). ' / ' . $numPics .'</div>',
    '<img src="'.$contestants[$i].'" style="width:100%">';
        }
    }
?> 
</div>
</div>
<?php
$contestants = glob('images/contestants/*');
$numPics = count($contestants);
if($numPics > 0){
echo '<a class="prev" onclick="plusSlides(-1)">&#10094;</a>',
'<a class="next" onclick="plusSlides(1)">&#10095;</a>',
'<div style="text-align:center">';

for ($i = 1; $i <= $numPics; $i++){
echo '<span class="dot" onclick="currentSlide('.$i.')"></span> ';
  }
}
?>
  </div>

<script src="js/slides.js"></script>