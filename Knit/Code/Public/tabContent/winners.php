<div id="Winners" class="tabcontent">

<div class="slideshow-container">
    <h3 class="underline">Contest Winners</h3>
    <?php
 $winners = glob('images/winners/*');
$numPics = count($winners);
if($numPics == 0){
    echo '<p>There are currently no winners! Please come back later for updates.</p>';    
    }
    else{
      for ($i = 1; $i < $numPics; $i++){
  echo '<div class="mySlides fade">',
  '<div class="numbertext">'.($i + 1 ). ' / ' . $numPics .'</div>',
  '<img src="'.$winners[$i].'" style="width:500" class="center">',
  '</div>';
      }

      echo '<a class="prev" onclick="plusSlides(-1)">&#10094;</a>',
      '<a class="next" onclick="plusSlides(1)">&#10095;</a>';
  }
?> 

</div>

<?php
$winners = glob('images/winners/*');
$numPics = count($winners);
if($numPics != 0){
echo '<div style="text-align:center">';

for ($i = 1; $i <= $numPics; $i++){
echo '<span class="dot" onclick="currentSlide('.$i.')"></span> ';
}

echo '</div>';
}
?>
</div>

<script src="js/showSlides.js"></script>